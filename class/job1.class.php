<?php

namespace job1;

trait JSONExtract {
    public function toJSON() {
        $vars = get_object_vars($this);

        $result = new \stdClass();

        foreach($vars as $key => $var) {

            if(preg_match('/^_m/', $key)) {
                $key = preg_replace('/^_m/'; '//'; $key); //TODO fix
            }

            $result->{$key} = $var;
        }
        return json_encode($this);
    }
}

class IntroductionMedia {
    public $type;
    public $weight;
    public $size;
    public $url;

    public function setFromURL($url) {

        $content = file_get_contents($url);

        list($h, $w) = getimagesizefromstring($content);

        $this->setSize();
    }
}

class IntroductionText {

    public $language;
    public $type_code;
    public $title;
    public $text;

}

class HotelDistribution {

    use JSONExtract;

    public $bonotel;
    public $gta;
    public $ati;

    /**
     * @return string
     */
    public function getBonotel()
    {
        return $this->bonotel;
    }

    /**
     * @param string $bonotel
     */
    public function setBonotel($bonotel)
    {
        $this->bonotel = $bonotel;
    }

    /**
     * @return string
     */
    public function getGta()
    {
        return $this->gta;
    }

    /**
     * @param string $gta
     */
    public function setGta($gta)
    {
        $this->gta = $gta;
    }

    /**
     * @return string
     */
    public function getAti()
    {
        return $this->ati;
    }

    /**
     * @param string $ati
     */
    public function setAti($ati)
    {
        $this->ati = $ati;
    }

}


class Hotel {

    use JSONExtract;

    public $code;

    public $latitude;
    public $longitude;
    public  $nature;
    public  $language;
    public  $rating_description;
    public  $rating_level;
    public  $swimmingpool;
    public  $parking;
    public  $fitness;
    public  $golf;
    public  $seaside;
    public  $spa;
    public  $charm;
    public  $ecotourism;
    public  $exceptional;
    public  $family_friendly;
    public  $pmr;
    public  $preferred;
    public  $wedding;

    public  $distributon;

    public  $introduction_texts;
    public  $introduction_medias;

    public function __construct()
    {
        $this->introduction_texts = array();

        $this->setDistributon( new HotelDistribution() );
    }

    public function addIntroductionText(IntroductionText $introductionText) {
        $this->introduction_texts[] = $introductionText;
    }

    public function addIntroductionMedia(IntroductionMedia $introductionMedia) {
        $this->introduction_medias[] = $introductionMedia;
    }

    /**
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = (int) $code;
    }

    /**
     * @return HotelDistribution
     */
    public function getDistributon()
    {
        return $this->distributon;
    }

    /**
     * @param HotelDistribution $distributon
     */
    public function setDistributon(HotelDistribution $distributon)
    {
        $this->distributon = $distributon;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = (String) $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude =  (String) $longitude;
    }

    /**
     * @return mixed
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @param mixed $nature
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getRatingDescription()
    {
        return $this->rating_description;
    }

    /**
     * @param mixed $rating_description
     */
    public function setRatingDescription($rating_description)
    {
        $this->rating_description = $rating_description;
    }

    /**
     * @return mixed
     */
    public function getRatingLevel()
    {
        return $this->rating_level;
    }

    /**
     * @param mixed $rating_level
     */
    public function setRatingLevel($rating_level)
    {
        $this->rating_level = $rating_level;
    }

    /**
     * @return mixed
     */
    public function getSwimmingpool()
    {
        return $this->swimmingpool;
    }

    /**
     * @param mixed $swimmingpool
     */
    public function setSwimmingpool($swimmingpool)
    {
        $this->swimmingpool = $swimmingpool;
    }

    /**
     * @return mixed
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * @param mixed $parking
     */
    public function setParking($parking)
    {
        $this->parking = $parking;
    }

    /**
     * @return mixed
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * @param mixed $fitness
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * @return mixed
     */
    public function getGolf()
    {
        return $this->golf;
    }

    /**
     * @param mixed $golf
     */
    public function setGolf($golf)
    {
        $this->golf = $golf;
    }

    /**
     * @return mixed
     */
    public function getSeaside()
    {
        return $this->seaside;
    }

    /**
     * @param mixed $seaside
     */
    public function setSeaside($seaside)
    {
        $this->seaside = $seaside;
    }

    /**
     * @return mixed
     */
    public function getSpa()
    {
        return $this->spa;
    }

    /**
     * @param mixed $spa
     */
    public function setSpa($spa)
    {
        $this->spa = $spa;
    }

    /**
     * @return mixed
     */
    public function getCharm()
    {
        return $this->charm;
    }

    /**
     * @param mixed $charm
     */
    public function setCharm($charm)
    {
        $this->charm = $charm;
    }

    /**
     * @return mixed
     */
    public function getEcotourism()
    {
        return $this->ecotourism;
    }

    /**
     * @param mixed $ecotourism
     */
    public function setEcotourism($ecotourism)
    {
        $this->ecotourism = $ecotourism;
    }

    /**
     * @return mixed
     */
    public function getExceptional()
    {
        return $this->exceptional;
    }

    /**
     * @param mixed $exceptional
     */
    public function setExceptional($exceptional)
    {
        $this->exceptional = $exceptional;
    }

    /**
     * @return mixed
     */
    public function getFamilyFriendly()
    {
        return $this->family_friendly;
    }

    /**
     * @param mixed $family_friendly
     */
    public function setFamilyFriendly($family_friendly)
    {
        $this->family_friendly = $family_friendly;
    }

    /**
     * @return mixed
     */
    public function getPmr()
    {
        return $this->pmr;
    }

    /**
     * @param mixed $pmr
     */
    public function setPmr($pmr)
    {
        $this->pmr = $pmr;
    }

    /**
     * @return mixed
     */
    public function getPreferred()
    {
        return $this->preferred;
    }

    /**
     * @param mixed $preferred
     */
    public function setPreferred($preferred)
    {
        $this->preferred = $preferred;
    }

    /**
     * @return mixed
     */
    public function getWedding()
    {
        return $this->wedding;
    }

    /**
     * @param mixed $wedding
     */
    public function setWedding($wedding)
    {
        $this->wedding = $wedding;
    }


}

class Loader {

    public function __construct($sourcefile)
    {

        $this->items = array();

        $this->makeDirectory();

        try {
            $content = file_get_contents($sourcefile);
        }
        catch (\Exception $e) {
            echo 'Exception : '.  $e->getessage() . "\n";
            exit;
        }

        if(empty($content)) {
            throw new \Exception('Unable to get content from '.$sourcefile);
        }

        $xmlIterator = new \SimpleXMLIterator($content);
        for( $xmlIterator->rewind(); $xmlIterator->valid(); $xmlIterator->next() ) {
            $raw = $xmlIterator->getChildren();
            $code = (String) $raw->hotelCode;

            $hotel=new Hotel();
            $hotel->setCode($raw->hotelCode);
            $hotel->setLatitude($raw->latitude);
            $hotel->setLongitude($raw->longitude);

            $this->writeJsonFile($hotel);
            exit;
        }



    }

    private function writeJsonFile(Hotel $hotel) {
        if(false === file_put_contents(DIR_OUT . '/HS_BNO_H_' .$hotel->getCode().'.json',$hotel->toJSON())) {
            throw new \Exception('Unabled to write final file for hotel '.$hotel->getCode());
            }
    }

    private function makeDirectory() {

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

}