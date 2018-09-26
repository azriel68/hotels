<?php

namespace job1;

/**
 * Trait JSONExtract
 * Just for the fun
 * @package job1
 */
trait JSONExtract {

    /**
     * Convert object to JSON
     * @return false|string
     */
    public function toJSON() {

        $obj = $this->getStdObject();

        return json_encode($obj);
    }

    /**
     * transform inner properties into standard object
     * @return \stdClass
     */
    public function getStdObject() {

        $vars = get_object_vars($this);

        $result = new \stdClass();

        foreach ($vars as $key => $var) {

            if (preg_match('/^m_/i', $key)) {
                $key = preg_replace('/^m_/i', '', $key);
            }

            if (is_object($var) && method_exists($var, 'getStdObject')) {
                $var = $var->getStdObject();
            } else if (is_array($var)) { /* Et là je me dis que si j'avais laissé un objet stdCLass comme je l'avais fait au début, j'aurai un code moins WTF :-/ */
                foreach ($var as $k => &$v) {
                    if (is_object($v) && method_exists($v, 'getStdObject')) {
                        $v = $v->getStdObject();
                    }
                }
            }


            $result->{$key} = $var;

        }

        return $result;
    }
}


class Job1 {

    const STARTED = 'started';
    const ENDED = 'ended';

    /*
     * Give us the final stat of the run
     */
    public $state;

    /**
     * Job1 constructor.
     */
    public function __construct() {

    }

    /**
     * Run the ETL job
     * @param string $sourcefile
     * @param string $mapping
     * @throws \Exception
     */
    public function run($sourcefile, $mapping) {

        $this->state = self::STARTED;

        $this->makeDirectory();

        echo 'Retrieving file '.$sourcefile.'...';
        $xmlIterator = $this->getIterator($sourcefile);
        echo 'done'.PHP_EOL;

        for ($xmlIterator->rewind(); $xmlIterator->valid(); $xmlIterator->next()) {
            $raw = $xmlIterator->getChildren();
            $code = (String)$raw->hotelCode;

            echo 'Mapping of ' . $code . '...';

            $hotel = new \Hotel\Hotel();
            $this->mapper($raw, $hotel, $mapping);

            $this->writeJsonFile($hotel);

            echo 'done' . PHP_EOL;

        }

        $this->state = self::ENDED;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function makeDirectory() {

        if (is_dir(DIR_OUT)) {
            null;
        } else if (!is_writable('.')) {
            throw new \Exception('Current directory ' . __DIR__ . ' was not writable');
        } else if (!mkdir(DIR_OUT, 0700)) {
            throw new \Exception('Unable to create directory ' . DIR_OUT);
        }

        return true;
    }

    /**
     * Create SimpleXMLIterator from xml file
     * @param string $sourcefile
     * @return \SimpleXMLIterator
     * @throws \Exception
     */
    public function getIterator($sourcefile) {

        $content = file_get_contents($sourcefile);

        if (empty($content)) {
            throw new \Exception('Unable to get content from ' . $sourcefile);
        }

        return new \SimpleXMLIterator($content);

    }

    /**
     * Map values from XML to the hotel object
     * @param mixed $raw
     * @param \Hotel\Hotel $hotel
     * @param string $mapping
     * @throws \Exception
     */
    public function mapper(&$raw, \Hotel\Hotel &$hotel, $mapping) {

        if ($mapping === 'bonhotel') {

            $hotel->setLatitude($raw->latitude);
            $hotel->setLongitude($raw->longitude);

            $distribution = new \Hotel\HotelDistribution();
            $distribution->setTravellerKey('BONOTEL', $raw->hotelCode);

            $hotel->setDistribution($distribution);

            $hotel->setNature('Unknown');
            $hotel->setLanguage($raw->countryCode);
            $hotel->setRatingDescription($raw->starRating);
            $hotel->setRatingLevel($raw->starRating);

            $hotel->setRecreation($raw->recreation);
            $hotel->setFacilities($raw->facilities);

            $hotel->setDescription($raw->description);

            $hotel->addIntroductionText((String)$raw->limitationPolicies, 'limitationPolicies');

            $hotel->setImages($raw->images, 'Unknown');
        } else {
            throw new \Exception('Unknown mappging ' . $mapping);
        }

    }

    /**
     * Write the Hotel object as json file
     * @param Hotel $hotel
     * @throws \Exception
     */
    private function writeJsonFile(\Hotel\Hotel $hotel) {

        $content = $hotel->toJSON();

        $code = $hotel->getDistribution()->BONOTEL;

        if (false === file_put_contents(DIR_OUT . '/HS_BNO_H_' . $code . '.json', $content)) {
            throw new \Exception('Unabled to write final file for hotel ' . $code);
        }
    }


}