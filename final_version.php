<?php

set_time_limit(300 );

$sapi_type = php_sapi_name();

require 'config.php';

if ($env === PROD && substr($sapi_type, 0, 3) == 'CLI') {
    echo 'Error: Execution is command line restricted.'.PHP_EOL;
    exit(-1);
}

require 'class\job1.class.php';
require 'class\hotel.class.php';

use Job1\Job1;

$loader = new Job1();

$loader->run($url, MAPPING);

if($loader->state === $loader::ENDED) {
    echo 'Jobs ended'.PHP_EOL;
}
else {
    echo 'Something went wrong'.PHP_EOL;
}