<?php

	//$url = 'http://api.bonotel.com/XMLCache/hotelAll0.xml';
    $url = './hotelAll0.xml';

	$xml =  simplexml_load_file($url);

	$dir = './hotels';
	if(!is_dir($dir) && is_writable('.')) mkdir($dir,0700);

	$results = array();

    $xmlIterator = new SimpleXMLIterator($xml->asXML());
    for( $xmlIterator->rewind(); $xmlIterator->valid(); $xmlIterator->next() ) {
        $hotel = $xmlIterator->getChildren();
        $code = (String) $hotel->hotelCode;
//var_dump($code,$hotel);exit;
        $results[$code]=$hotel;
    }

    foreach($results as $code=>&$result) {
        file_put_contents($dir . '/HS_BNO_H_' .$code.'.json',json_encode($result));
    }