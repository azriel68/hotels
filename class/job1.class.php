<?php

namespace job1;

trait JSONExtract {
    public function toJSON() {
        return json_encode($this);
    }
}

class HotelDistribution {

    use JSONExtract;

    private $m_bonotel;
    private $m_gta;
    private $m_ati;

    /**
     * @return string
     */
    public function getBonotel()
    {
        return $this->m_bonotel;
    }

    /**
     * @param string $m_bonotel
     */
    public function setBonotel($m_bonotel)
    {
        $this->m_bonotel = $m_bonotel;
    }

    /**
     * @return string
     */
    public function getGta()
    {
        return $this->m_gta;
    }

    /**
     * @param string $m_gta
     */
    public function setGta($m_gta)
    {
        $this->m_gta = $m_gta;
    }

    /**
     * @return string
     */
    public function getAti()
    {
        return $this->m_ati;
    }

    /**
     * @param string $m_ati
     */
    public function setAti($m_ati)
    {
        $this->m_ati = $m_ati;
    }

}


class Hotel {

    use JSONExtract;

    public $code;

    public $latitude;
    public $longitude;
    public  $m_nature;
    public  $m_language;
    public  $m_rating_description;
    public  $m_rating_level;
    public  $m_swimmingpool;
    public  $m_parking;
    public  $m_fitness;
    public  $m_golf;
    public  $m_seaside;
    public  $m_spa;
    public  $m_charm;
    public  $m_ecotourism;
    public  $m_exceptional;
    public  $m_family_friendly;
    public  $m_pmr;
    public  $m_preferred;
    public  $m_wedding;

    public   $m_distributon;

    public function __construct()
    {
        $this->setDistributon( new HotelDistribution() );
    }

    /**
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $m_code
     */
    public function setCode($m_code)
    {
        $this->code = (int) $m_code;
    }

    /**
     * @return HotelDistribution
     */
    public function getDistributon()
    {
        return $this->m_distributon;
    }

    /**
     * @param HotelDistribution $m_distributon
     */
    public function setDistributon(HotelDistribution $m_distributon)
    {
        $this->m_distributon = $m_distributon;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $m_latitude
     */
    public function setLatitude($m_latitude)
    {
        $this->latitude = (String) $m_latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $m_longitude
     */
    public function setLongitude($m_longitude)
    {
        $this->longitude =  (String) $m_longitude;
    }

    /**
     * @return mixed
     */
    public function getNature()
    {
        return $this->m_nature;
    }

    /**
     * @param mixed $m_nature
     */
    public function setNature($m_nature)
    {
        $this->m_nature = $m_nature;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->m_language;
    }

    /**
     * @param mixed $m_language
     */
    public function setLanguage($m_language)
    {
        $this->m_language = $m_language;
    }

    /**
     * @return mixed
     */
    public function getRatingDescription()
    {
        return $this->m_rating_description;
    }

    /**
     * @param mixed $m_rating_description
     */
    public function setRatingDescription($m_rating_description)
    {
        $this->m_rating_description = $m_rating_description;
    }

    /**
     * @return mixed
     */
    public function getRatingLevel()
    {
        return $this->m_rating_level;
    }

    /**
     * @param mixed $m_rating_level
     */
    public function setRatingLevel($m_rating_level)
    {
        $this->m_rating_level = $m_rating_level;
    }

    /**
     * @return mixed
     */
    public function getSwimmingpool()
    {
        return $this->m_swimmingpool;
    }

    /**
     * @param mixed $m_swimmingpool
     */
    public function setSwimmingpool($m_swimmingpool)
    {
        $this->m_swimmingpool = $m_swimmingpool;
    }

    /**
     * @return mixed
     */
    public function getParking()
    {
        return $this->m_parking;
    }

    /**
     * @param mixed $m_parking
     */
    public function setParking($m_parking)
    {
        $this->m_parking = $m_parking;
    }

    /**
     * @return mixed
     */
    public function getFitness()
    {
        return $this->m_fitness;
    }

    /**
     * @param mixed $m_fitness
     */
    public function setFitness($m_fitness)
    {
        $this->m_fitness = $m_fitness;
    }

    /**
     * @return mixed
     */
    public function getGolf()
    {
        return $this->m_golf;
    }

    /**
     * @param mixed $m_golf
     */
    public function setGolf($m_golf)
    {
        $this->m_golf = $m_golf;
    }

    /**
     * @return mixed
     */
    public function getSeaside()
    {
        return $this->m_seaside;
    }

    /**
     * @param mixed $m_seaside
     */
    public function setSeaside($m_seaside)
    {
        $this->m_seaside = $m_seaside;
    }

    /**
     * @return mixed
     */
    public function getSpa()
    {
        return $this->m_spa;
    }

    /**
     * @param mixed $m_spa
     */
    public function setSpa($m_spa)
    {
        $this->m_spa = $m_spa;
    }

    /**
     * @return mixed
     */
    public function getCharm()
    {
        return $this->m_charm;
    }

    /**
     * @param mixed $m_charm
     */
    public function setCharm($m_charm)
    {
        $this->m_charm = $m_charm;
    }

    /**
     * @return mixed
     */
    public function getEcotourism()
    {
        return $this->m_ecotourism;
    }

    /**
     * @param mixed $m_ecotourism
     */
    public function setEcotourism($m_ecotourism)
    {
        $this->m_ecotourism = $m_ecotourism;
    }

    /**
     * @return mixed
     */
    public function getExceptional()
    {
        return $this->m_exceptional;
    }

    /**
     * @param mixed $m_exceptional
     */
    public function setExceptional($m_exceptional)
    {
        $this->m_exceptional = $m_exceptional;
    }

    /**
     * @return mixed
     */
    public function getFamilyFriendly()
    {
        return $this->m_family_friendly;
    }

    /**
     * @param mixed $m_family_friendly
     */
    public function setFamilyFriendly($m_family_friendly)
    {
        $this->m_family_friendly = $m_family_friendly;
    }

    /**
     * @return mixed
     */
    public function getPmr()
    {
        return $this->m_pmr;
    }

    /**
     * @param mixed $m_pmr
     */
    public function setPmr($m_pmr)
    {
        $this->m_pmr = $m_pmr;
    }

    /**
     * @return mixed
     */
    public function getPreferred()
    {
        return $this->m_preferred;
    }

    /**
     * @param mixed $m_preferred
     */
    public function setPreferred($m_preferred)
    {
        $this->m_preferred = $m_preferred;
    }

    /**
     * @return mixed
     */
    public function getWedding()
    {
        return $this->m_wedding;
    }

    /**
     * @param mixed $m_wedding
     */
    public function setWedding($m_wedding)
    {
        $this->m_wedding = $m_wedding;
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