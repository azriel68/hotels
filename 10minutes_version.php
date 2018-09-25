<?php

/*
 * Version quand le client appel à 18h en panique et qu'il a besoin d'un truc vite fait, pondu en 15 minutes,
 * le format de sortie ne respecte pas la spec,
 * mais en même temps c'était en 15 minutes
 */

	//$url = 'http://api.bonotel.com/XMLCache/hotelAll0.xml';
    $url = './hotelAll0.xml';

	$dir = './hotels';
	if(!is_dir($dir) && is_writable('.')) mkdir($dir,0700);

	$results = array();

    $xmlIterator = new SimpleXMLIterator(file_get_contents($url));
    for( $xmlIterator->rewind(); $xmlIterator->valid(); $xmlIterator->next() ) {
        $hotel = $xmlIterator->getChildren();
        $code = (String) $hotel->hotelCode;

        /*
         *
         <hotelCode>3877</hotelCode>
		<name>Desert Rose Resort and Cabins</name>
		<address>701 West Main Street</address>
		<address2/>
		<city>Bluff</city>
        <cityCode>CY6435</cityCode>
        <state>Utah</state>
        <stateCode>UT</stateCode>
		<country>USA</country>
        <countryCode>US</countryCode>
		<postalCode>84512</postalCode>
        <checkIn>04:00 PM</checkIn> <checkOut>11:00 AM</checkOut> <phone>(435) 672-2303</phone> <fax>(435) 672-2217</fax>
		<latitude>37.280523</latitude>
        <longitude>-109.572199</longitude>
       <cutoffAge>10</cutoffAge> <starRating>3.5star</starRating>
        <images>
		<image>http://legacy.bonotel.com/photos/9956.jpg</image> <image>http://legacy.bonotel.com/photos/9957.jpg</image>
        </images>
		<cancelPolicies><![CDATA[<p>Applicable cancellation fees are subject to change at time of cancellation. Please be advised that the cancellation policy listed is also subject to change without notice at any time. For any concerns regarding cancellation policies/fees please contact a Bonotel representative.</p>]]></cancelPolicies> <limitationPolicies><![CDATA[<ul>
<li>100% non smoking hotel.</li>
</ul>]]></limitationPolicies> <description><![CDATA[Located at the west entrance to historic Bluff, Utah, the Desert Rose Resort and Cabins&apos; architecture is an all wood style building with massive timbers which excite the senses with their intimate charm.]]></description> <facilities><![CDATA[<ul>
<li>Complimentary Self Parking</li>
<li>Complimentary wireless internet</li>
<li>Hair dryer</li>
<li>Iron/Ironing board</li>
<li>Full bathtub/shower</li>
<li>Telephone with voicemail</li>
</ul>]]></facilities> <recreation><![CDATA[<ul>
<li>Business Center</li>
<li>Fitness Center</li>
<li>Indoor Pool</li>
</ul>]]></recreation>
   </hotel>
         *
          {
           "latitude": 42.560295684484,
           "longitude": 42.560295684484,
           "nature": "BeachHotel",
           "language" : "FR",
           "rating_description": "4.5 étoiles, Catégorie officielle",
           "rating_level": 4,
           "swimmingpool": true,
           "parking": true,
           "fitness": true,
           "golf": true,
           "seaside": true,
           "spa": true,
           "charm": true,
           "ecotourism": true,
           "exceptional": true,
           "family_friendly": true,
           "pmr": true,
           "preferred": true,
           "wedding": false,
           "distribution": {
               "BONOTEL": "123",
               "GTA": "234",
               "ATI": "345"
           },
           "introduction_text": {
               "language": "FR",
               "type_code": "Situation",
               "title": "Situation",
               "text": "Ce complexe se trouve dans le nord-est de ...."
           },
           "introduction_media": {
               "type": "Outdoor",
               "weight": {
                   "value": 3711,
                   "unit": "Byte"
               },
               "size": {
                   "width": 74,
                   "height": 74,
                   "unit": "px"
               },
               "url": "http://ghgml.giatamedia.com/webservice/rest/1.0/images/48186/717071"
           }
        }

         */

        file_put_contents($dir . '/HS_BNO_H_' .$code.'.json',json_encode($hotel));
    }
