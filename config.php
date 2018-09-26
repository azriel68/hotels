<?php

const DEV = 'develop';
const PROD = 'production';

const DIR_OUT = './hotels';

const MAPPING = 'bonhotel';

const ENV = DEV;

$url = (ENV === DEV) ? './hotelAll0.xml' :  'http://api.bonotel.com/index.cfm/user/voyagrs_xml/action/hotel';
//$url = './hotel1.xml';