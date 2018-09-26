<?php

namespace Hotel;

/**
 * Class IntroductionMedia
 * @package Hotel
 */
class IntroductionMedia {
    use \Job1\JSONExtract;

    private $m_type;
    private $m_weight;
    private $m_size;
    private $m_url;

    /**
     * @param string $url
     * @param string $type
     */
    public function setFromURL($url, $type) {

        if(ENV === DEV)$url = '2989.jpg'; /* Juste parce qu'en prod ça prend sa vie ;-) */

        $content = file_get_contents($url);

        list($h, $w) = getimagesizefromstring($content);

        $this->setSize($h, $w);
        $this->setWeight(strlen($content));
        $this->setUrl($url);
        $this->setType($type);
    }

    /**
     * @param int $h
     * @param int $w
     */
    public function setSize($h, $w) {

        $obj = new \stdClass();
        $obj->width = (int)$w;
        $obj->height = (int)$h;
        $obj->unit = 'px';

        $this->m_size = $obj;

    }

    /**
     * @param int $weight
     */
    public function setWeight($weight) {

        $obj = new \stdClass();
        $obj->value = (int)$weight;
        $obj->unit = 'Byte';

        $this->m_weight = $obj;

    }

    /**
     * @param string $url
     */
    public function setUrl($url) {
        $this->m_url = (string)$url;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->m_type = (string)$type;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->m_url;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->m_type;
    }

    /**
     * @return mixed
     */
    public function getSize() {
        return $this->m_size;
    }

    /**
     * @return mixed
     */
    public function getWeight() {
        return $this->m_weight;
    }


}

/**
 * Class IntroductionText
 * @package Hotel
 */
class IntroductionText {

    use \Job1\JSONExtract;

    private $m_language;
    private $m_type_code;
    private $m_title;
    private $m_text;

    /**
     * @param mixed $language
     */
    public function setLanguage($language) {
        $this->m_language = (String)$language;
    }

    /**
     * @param mixed $type_code
     */
    public function setTypeCode($type_code) {
        $this->m_type_code = (String)$type_code;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) {
        $this->m_title = (String)$title;
    }

    /**
     * @param mixed $text
     */
    public function setMText($text) {
        $this->m_text = (String)$text;
    }

}

/**
 * Class HotelDistribution
 * @package Hotel
 */
class HotelDistribution {

    use \Job1\JSONExtract;

    /**
     * @return string
     */
    public function getTravellerKey($traveller) {
        return isset($this->{$traveller}) ? $this->{$traveller} : false;
    }

    /**
     * @param string $bonotel
     */
    public function setTravellerKey($traveller, $key) {
        $this->{$traveller} = (String)$key;
    }


}


/**
 * Class Hotel
 * @package Hotel
 */
class Hotel {

    use \Job1\JSONExtract;

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

    public function __construct() {
        $this->m_introduction_texts = array();
        $this->m_introduction_medias = array();

        $this->m_distribution = new HotelDistribution();

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


    /**
     * Extract some tags from recreation and add it as introductionText
     * @param \SimpleXMLIterator $xmlIterator
     */
    public function setRecreation(\SimpleXMLIterator $xmlIterator) {

        $matches = $this->getListFromHTML($xmlIterator);

        if (!empty($matches)) {
            foreach ($matches[1] as $match) {

                if (preg_match('/(pools|swimming\spool)/i', $match)) {
                    $this->setSwimmingpool(true);
                }
                if (preg_match('/(spa|spas)/i', $match)) {
                    $this->setSpa(true);
                }
                if (preg_match('/(fitness)/i', $match)) {
                    $this->setFitness(true);
                }
                if (preg_match('/(golf)/i', $match)) {
                    $this->setGolf(true);
                }
                if (preg_match('/(weddings|wedding)/i', $match)) {
                    $this->setWedding(true);
                }

            }
        }

        $this->addIntroductionText((String)$xmlIterator, 'Recreation');
    }

    /**
     * @param string $introductionText
     * @param string $type
     */
    public function addIntroductionText($introductionText, $type) {
        $it = new \Hotel\IntroductionText();
        $it->setLanguage($this->m_language);
        $it->setMText($introductionText);
        $it->setTitle($type); /* ok it's a bad choice, but i have to check the project manager what */
        $it->setTypeCode($type);


        $this->introduction_texts[] = $it;
    }

    /**
     * Extract some tags from facilities and add it as introductionText
     * @param \SimpleXMLIterator $xmlIterator
     */
    public function setFacilities(\SimpleXMLIterator $xmlIterator) {

        $matches = $this->getListFromHTML($xmlIterator);

        if (!empty($matches)) {
            foreach ($matches[1] as $match) {

                if (preg_match('/(parking|self-parking|self parking)/i', $match)) {
                    $this->setParking(true);
                }
                if (preg_match('/(handicap|wheelchair|wheelchairs)/i', $match)) {
                    $this->setPmr(true);
                }

            }
        }

        $this->addIntroductionText((String)$xmlIterator, 'Facilities');
    }

    /**
     * Extract some tags from description and add description as introductionText
     * @param \SimpleXMLIterator $xmlIterator
     */
    public function setDescription(\SimpleXMLIterator $xmlIterator) {

        $matches = $this->getListFromHTML($xmlIterator);

        if (!empty($matches)) {
            foreach ($matches[1] as $match) {

                if (preg_match('/(seaside)/i', $match)) {
                    $this->setSeaside(true);
                }
                if (preg_match('/(charms|charming)/i', $match)) {
                    $this->setCharm(true);
                }
                if (preg_match('/(eco-friendly|ecotour)/i', $match)) {
                    $this->setEcotourism(true);
                }
                if (preg_match('/(family-friendly)/i', $match)) {
                    $this->setFamilyFriendly(true);
                }
                if (preg_match('/(preferred choice)/i', $match)) {
                    $this->setPreferred(true);
                }

            }
        }

        $this->addIntroductionText((String)$xmlIterator, 'Description');
    }

    /**
     * @param \SimpleXMLIterator $xmlIterator
     * @param $type
     */
    public function setImages(\SimpleXMLIterator $xmlIterator, $type) {
        $xml = new \SimpleXMLElement($xmlIterator->asXML());
        foreach ($xml->children() as $child) {
            $image = (string)$child;

            $im = new \Hotel\IntroductionMedia();
            $im->setFromURL($image, $type);

            $this->addIntroductionMedia($im);
        }

    }

    /**
     * @param IntroductionMedia $introductionMedia
     */
    public function addIntroductionMedia(IntroductionMedia $introductionMedia) {
        $this->introduction_medias[] = $introductionMedia;
    }

    /**
     * @return HotelDistribution
     */
    public function getDistribution() {
        return $this->m_distribution;
    }

    /**
     * @param HotelDistribution $distribution
     */
    public function setDistribution(HotelDistribution $distribution) {
        $this->m_distribution = $distribution;
    }

    /**
     * @param bool $swimmingpool
     */
    public function setSwimmingpool($swimmingpool) {
        $this->m_swimmingpool = (bool)$swimmingpool;
    }

    /**
     * @param bool $spa
     */
    public function setSpa($spa) {
        $this->m_spa = (bool)$spa;
    }

    /**
     * @param bool $fitness
     */
    public function setFitness($fitness) {
        $this->m_fitness = (bool)$fitness;
    }

    /**
     * @param bool $golf
     */
    public function setGolf($golf) {
        $this->m_golf = (bool)$golf;
    }

    /**
     * @param bool $wedding
     */
    public function setWedding($wedding) {
        $this->m_wedding = (bool)$wedding;
    }

    /**
     * @param bool $parking
     */
    public function setParking($parking) {
        $this->m_parking = (bool)$parking;
    }

    /**
     * @param bool $pmr
     */
    public function setPmr($pmr) {
        $this->m_pmr = (bool)$pmr;
    }
    /**
     * @param bool $seaside
     */
    public function setSeaside($seaside) {
        $this->m_seaside = (bool)$seaside;
    }

    /**
     * @param mixed $charm
     */
    public function setCharm($charm) {
        $this->m_charm = (bool)$charm;
    }

    /**
     * @param bool $ecotourism
     */
    public function setEcotourism($ecotourism) {
        $this->m_ecotourism = (bool)$ecotourism;
    }

    /**
     * @param bool $family_friendly
     */
    public function setFamilyFriendly($family_friendly) {
        $this->m_family_friendly = (bool)$family_friendly;
    }

    /**
     * @param bool $preferred
     */
    public function setPreferred($preferred) {
        $this->m_preferred = (bool)$preferred;
    }

    /**
     * @return String
     */
    public function getLatitude() {
        return $this->m_latitude;
    }

    /**
     * @param String $latitude
     */
    public function setLatitude($latitude) {
        $this->m_latitude = (String)$latitude;
    }

    /**
     * @return String
     */
    public function getLongitude() {
        return $this->m_longitude;
    }

    /**
     * @param String $longitude
     */
    public function setLongitude($longitude) {
        $this->m_longitude = (String)$longitude;
    }

    /**
     * @return String
     */
    public function getNature() {
        return $this->m_nature;
    }

    /**
     * @param String $nature
     */
    public function setNature($nature) {
        $this->m_nature = (String)$nature;
    }

    /**
     * @return String
     */
    public function getLanguage() {
        return $this->m_language;
    }

    /**
     * @param String $language
     */
    public function setLanguage($language) {
        $this->m_language = (String)$language;
    }

    /**
     * @return string
     */
    public function getRatingDescription() {
        return $this->m_rating_description;
    }

    /**
     * @param string $rating_description
     */
    public function setRatingDescription($rating_description) {
        $this->m_rating_description = (String)$rating_description;
    }

    /**
     * @return int
     */
    public function getRatingLevel() {
        return $this->m_rating_level;
    }

    /**
     * @param int $rating_level
     */
    public function setRatingLevel($rating_level) {
        $this->m_rating_level = (int)$rating_level; /* a little ugly to convert string to int, but it is simple ;-) */
    }

    /**
     * @return bool
     */
    public function getSwimmingpool() {
        return $this->m_swimmingpool;
    }

    /**
     * @return bool
     */
    public function getParking() {
        return $this->m_parking;
    }

    /**
     * @return bool
     */
    public function getFitness() {
        return $this->m_fitness;
    }

    /**
     * @return bool
     */
    public function getGolf() {
        return $this->m_golf;
    }

    /**
     * @return
     */
    public function getSeaside() {
        return $this->m_seaside;
    }

    /**
     * @return bool
     */
    public function getSpa() {
        return $this->m_spa;
    }

    /**
     * @return mixed
     */
    public function getCharm() {
        return $this->m_charm;
    }

    /**
     * @return bool
     */
    public function getEcotourism() {
        return $this->m_ecotourism;
    }

    /**
     * @return bool
     */
    public function getExceptional() {
        return $this->exceptional;
    }

    /**
     * @param bool $exceptional
     */
    public function setExceptional($exceptional) {
        $this->m_exceptional = (bool)$exceptional;
    }

    /**
     * @return bool
     */
    public function getFamilyFriendly() {
        return $this->m_family_friendly;
    }

    /**
     * @return bool
     */
    public function getPmr() {
        return $this->m_pmr;
    }

    /**
     * @return bool
     */
    public function getPreferred() {
        return $this->m_preferred;
    }

    /**
     * @return bool
     */
    public function getWedding() {
        return $this->m_wedding;
    }


    private function getListFromHTML(\SimpleXMLIterator $xmlIterator, $patten = '/<li>(.*?)<\/li>/i') {
        $xmlIterator->rewind();
        $xml = (String)$xmlIterator->getChildren();

        preg_match_all($patten, $xml, $matches);

        return $matches;
    }

}