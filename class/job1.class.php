<?php

namespace job1;

/**
 * Trait JSONExtract
 * Initialy, i want to set up json recursively into all objects
 * But finally trait wasn't neccessary because i do that only on Hotel object
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

    public function getStdObject() {

        $vars = get_object_vars($this);

        $result = new \stdClass();

        foreach($vars as $key => $var) {

            if(preg_match('/^m_/i', $key)) {
                $key = preg_replace('/^m_/i','',$key);
            }

            if(is_object($var) && method_exists($var, 'getStdObject')) {
                $var = $var->getStdObject();
            }
            else if(is_array($var)) { /* Et là je me dis que si j'avais laissé un objet stdCLass comme je l'avais fait au début, j'aurai un code moins WTF :-/ */
                foreach($var as $k=>&$v) {
                    if(is_object($v) && method_exists($v, 'getStdObject')) {
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

    public function __construct()
    {

    }

    public function run($sourcefile, $mapping) {

        $this->state = self::STARTED;

        $this->makeDirectory();

        $xmlIterator = $this->getIterator($sourcefile);

        for( $xmlIterator->rewind(); $xmlIterator->valid(); $xmlIterator->next() ) {
            $raw = $xmlIterator->getChildren();
            $code = (String) $raw->hotelCode;

            echo 'Mapping of '.$code.'...';

            $hotel=new \Hotel\Hotel();
            $this->mapper($raw, $hotel, $mapping);

            $this->writeJsonFile($hotel);

            echo 'done'.PHP_EOL;

        }

        $this->state = self::ENDED;
    }

    /**
     * @param $sourcefile
     * @return \SimpleXMLIterator
     * @throws \Exception
     */
    public function getIterator($sourcefile) {

        $content = file_get_contents($sourcefile);

        if(empty($content)) {
            throw new \Exception('Unable to get content from '.$sourcefile);
        }

        return new \SimpleXMLIterator($content);

    }

    public function makeDirectory() {

        if(is_dir(DIR_OUT)) {
            null;
        }
        else if(!is_writable('.')) {
            throw new \Exception('Current directory '.__DIR__.' was not writable');
        }
        else if(!mkdir(DIR_OUT, 0700)) {
            throw new \Exception('Unable to create directory '.DIR_OUT);
        }

        return true;
    }

    /**
     * Write the Hotel object as json file
     * @param Hotel $hotel
     * @throws \Exception
     */
    private function writeJsonFile(\Hotel\Hotel $hotel) {

        $content = $hotel->toJSON();
//var_dump(json_decode($content),$content);
        if(false === file_put_contents(DIR_OUT . '/HS_BNO_H_' .$hotel->getCode().'.json',$content)) {
            throw new \Exception('Unabled to write final file for hotel '.$hotel->getCode());
            }
    }


    private function mapper(&$raw, \Hotel\Hotel &$hotel, $mapping) {

        if($mapping === 'bonhotel') {
//var_dump($raw);
            $hotel->setCode($raw->hotelCode);
            $hotel->setLatitude($raw->latitude);
            $hotel->setLongitude($raw->longitude);

            $distribution = new \Hotel\HotelDistribution();
            $distribution->setTravellerKey('BONOTEL',$raw->hotelCode);
 /*         $distribution->setAti();
            $distribution->setGta();
*/
            $hotel->setDistributon($distribution);

            $hotel->setNature('Unknown');
            $hotel->setLanguage($raw->countryCode);
            $hotel->setRatingDescription($raw->starRating);
            $hotel->setRatingLevel($raw->starRating);

            $hotel->setRecreation($raw->recreation);
            $hotel->setFacilities($raw->facilities);

            $hotel->setDescription($raw->description);
        }
        else {
            throw new \Exception('Unknown mappging '.$mapping);
        }

    }


}