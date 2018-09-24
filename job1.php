<?php

require 'config.php';

require 'class\job1.class.php';

use Job1\Loader;

$url = $env ===DEV ? './hotelAll0.xml' :  'http://api.bonotel.com/XMLCache/hotelAll0.xml';

$loader = new Loader($url);