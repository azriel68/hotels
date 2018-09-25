<?php

namespace Hotel;

class IntroductionMedia {
    use \Job1\JSONExtract;

    private $m_type;
    private $m_weight;
    private $m_size;
    private $m_url;

    public function setFromURL($url) {

        $content = file_get_contents($url);

        list($h, $w) = getimagesizefromstring($content);

        $this->setSize();
    }
}

class IntroductionText {

    use \Job1\JSONExtract;
    private $m_language;
    private $m_type_code;
    private $m_title;
    private $m_text;

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->m_language = (String) $language;
    }

    /**
     * @param mixed $type_code
     */
    public function setTypeCode($type_code)
    {
        $this->m_type_code =(String)  $type_code;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->m_title =(String)  $title;
    }

    /**
     * @param mixed $text
     */
    public function setMText($text)
    {
        $this->m_text =(String)  $text;
    }

}

class HotelDistribution {

    use \Job1\JSONExtract;

    private $m_BONOTEL;
    private $m_GTA;
    private $m_ATI;

    /**
     * @return string
     */
    public function getBonotel()
    {
        return $this->m_BONOTEL;
    }

    /**
     * @param string $bonotel
     */
    public function setBonotel($bonotel)
    {
        $this->m_BONOTEL = $bonotel;
    }

    /**
     * @return string
     */
    public function getGta()
    {
        return $this->m_GTA;
    }

    /**
     * @param string $gta
     */
    public function setGta($gta)
    {
        $this->m_GTA = $gta;
    }

    /**
     * @return string
     */
    public function getAti()
    {
        return $this->m_ATI;
    }

    /**
     * @param string $ati
     */
    public function setAti($ati)
    {
        $this->m_ATI = $ati;
    }

}


class Hotel {

    use \Job1\JSONExtract;

    private $m_code;

    private $m_latitude;
    private $m_longitude;
    private $m_nature;
    private $m_language;
    private $m_rating_description;
    private $m_rating_level;
    private $m_swimmingpool;
    private $m_parking;
    private $m_fitness;
    private $m_golf;
    private $m_seaside;
    private $m_spa;
    private $m_charm;
    private $m_ecotourism;
    private $m_exceptional;
    private $m_family_friendly;
    private $m_pmr;
    private $m_preferred;
    private $m_wedding;

    private $m_distribution;

    private $m_introduction_texts;
    private $m_introduction_medias;

    public function __construct()
    {
        $this->m_introduction_texts = array();
        $this->m_introduction_medias = array();

        $this->m_distribution = new HotelDistribution() ;

        $this->m_swimmingpool = false;
        $this->m_parking = false;
        $this->m_fitness = false;
        $this->m_spa = false;
        $this->m_golf = false;
        $this->m_seaside = false;
        $this->m_charm = false;
        $this->m_ecotourism = false;
        $this->m_exceptional = false;
        $this->m_family_friendly = false;
        $this->m_pmr = false;
        $this->m_preferred = false;
        $this->m_wedding = false;

    }


    public function setRecreation(\SimpleXMLIterator $xmlIterator) {

        $matches = $this->getListFromHTML($xmlIterator);

        if(!empty($matches)) {
            foreach ($matches[1] as $match) {

                if(preg_match('/(pools|swimming\spool)/', $match)) $this->setSwimmingpool(true);
                else if(preg_match('/(spa|spas)/', $match)) $this->setSpa(true);
                else if(preg_match('/(fitness)/', $match)) $this->setFitness(true);
                else if(preg_match('/(golf)/', $match)) $this->setGolf(true);

            }
        }

        $this->addIntroductionText((String)$xmlIterator,'Recreation');
    }

    public function setFacilities(\SimpleXMLIterator $xmlIterator) {

        $matches = $this->getListFromHTML($xmlIterator);

        if(!empty($matches)) {
            foreach ($matches[1] as $match) {

                if(preg_match('/(parking|self-parking)/', $match)) $this->setParking(true);


            }
        }

        $this->addIntroductionText((String)$xmlIterator,'Facilities');
    }

    public function setDescription(\SimpleXMLIterator $xmlIterator) {

        $matches = $this->getListFromHTML($xmlIterator);

        if(!empty($matches)) {
            foreach ($matches[1] as $match) {

                if(preg_match('/(seaside)/', $match)) $this->setSeaside(true);
                else if(preg_match('/(charms|charming)/', $match)) $this->setCharm(true);
                else if(preg_match('/(eco-friendly|ecotour)/', $match)) $this->setEcotourism(true);


            }
        }

        $this->addIntroductionText((String)$xmlIterator,'Description');
    }

    public function addIntroductionText($introductionText, $type) {
        $it=new \Hotel\IntroductionText();
        $it->setLanguage($this->m_language);
        $it->setMText($introductionText);
        $it->setTitle($type); /* ok it's a bad choice, but i have to check the project manager what */
        $it->setTypeCode($type);


        $this->introduction_texts[] = $it;
    }

    public function addIntroductionMedia(IntroductionMedia $introductionMedia) {
        $this->introduction_medias[] = $introductionMedia;
    }

    /**
     * @return integer
     */
    public function getCode()
    {
        return $this->m_code;
    }

    /**
     * @param mixed $m_code
     */
    public function setCode($m_code)
    {
        $this->m_code = (int) $m_code;
    }

    /**
     * @return HotelDistribution
     */
    public function getDistributon()
    {
        return $this->m_distribution;
    }

    /**
     * @param HotelDistribution $distribution
     */
    public function setDistributon(HotelDistribution $distribution)
    {
        $this->m_distribution= $distribution;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->m_latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->m_latitude = (String) $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->m_longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->m_longitude =  (String) $longitude;
    }

    /**
     * @return mixed
     */
    public function getNature()
    {
        return $this->m_nature;
    }

    /**
     * @param mixed $nature
     */
    public function setNature($nature)
    {
        $this->m_nature = (String) $nature;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->m_language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->m_language = $language;
    }

    /**
     * @return mixed
     */
    public function getRatingDescription()
    {
        return $this->m_rating_description;
    }

    /**
     * @param mixed $rating_description
     */
    public function setRatingDescription($rating_description)
    {
        $this->m_rating_description = (String) $rating_description;
    }

    /**
     * @return mixed
     */
    public function getRatingLevel()
    {
        return $this->m_rating_level;
    }

    /**
     * @param mixed $rating_level
     */
    public function setRatingLevel($rating_level)
    {
        $this->m_rating_level =(int) $rating_level; /* a little ugly to convert string to int, but it is simple ;-) */
    }

    /**
     * @return bool
     */
    public function getSwimmingpool()
    {
        return $this->m_swimmingpool;
    }

    /**
     * @param bool $swimmingpool
     */
    public function setSwimmingpool($swimmingpool)
    {
        $this->m_swimmingpool = (bool)$swimmingpool;
    }

    /**
     * @return bool
     */
    public function getParking()
    {
        return $this->m_parking;
    }

    /**
     * @param bool $parking
     */
    public function setParking($parking)
    {
        $this->m_parking = (bool)$parking;
    }

    /**
     * @return mixed
     */
    public function getFitness()
    {
        return $this->m_fitness;
    }

    /**
     * @param mixed $fitness
     */
    public function setFitness($fitness)
    {
        $this->m_fitness = (bool) $fitness;
    }

    /**
     * @return bool
     */
    public function getGolf()
    {
        return $this->m_golf;
    }

    /**
     * @param bool $golf
     */
    public function setGolf($golf)
    {
        $this->m_golf = (bool)$golf;
    }

    /**
     * @return
     */
    public function getSeaside()
    {
        return $this->m_seaside;
    }

    /**
     * @param bool $seaside
     */
    public function setSeaside($seaside)
    {
        $this->m_seaside = (bool)$seaside;
    }

    /**
     * @return bool
     */
    public function getSpa()
    {
        return $this->m_spa;
    }

    /**
     * @param bool $spa
     */
    public function setSpa($spa)
    {
        $this->m_spa =(bool) $spa;
    }

    /**
     * @return mixed
     */
    public function getCharm()
    {
        return $this->m_charm;
    }

    /**
     * @param mixed $charm
     */
    public function setCharm($charm)
    {
        $this->m_charm = (bool) $charm;
    }

    /**
     * @return bool
     */
    public function getEcotourism()
    {
        return $this->m_ecotourism;
    }

    /**
     * @param bool $ecotourism
     */
    public function setEcotourism($ecotourism)
    {
        $this->m_ecotourism = (bool) $ecotourism;
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

    private function getListFromHTML(\SimpleXMLIterator $xmlIterator) {
        $xmlIterator->rewind();
        $xml = (String) $xmlIterator->getChildren();

        preg_match_all('/<li>(.*?)<\/li>/i', $xml, $matches);

        return $matches;
    }


}