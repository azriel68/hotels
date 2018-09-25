<?php

const DEV = 'develop';
const PROD = 'production';

const DIR_OUT = './hotels';

const MAPPING = 'bonhotel';

$env = DEV;

$url = ($env === DEV) ? './hotelAll0.xml' :  'http://api.bonotel.com/index.cfm/user/voyagrs_xml/action/hotel';