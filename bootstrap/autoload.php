<?php

/*
    [code by Tarun Dhiman contact +91-9717403522 or tarun.dhiman.india@gmail.com]
*/

ini_set('post_max_size','30M');

define('PROJECT_NAME','Ecomm');
define('PROJECT_SHORT_NAME','EC');
define('LARAVEL_START', microtime(true));
define('ADMIN_URL_PATH','admin');
define('ADMIN_FILE_PATH','lteadmin');

require __DIR__.'/../vendor/autoload.php';

$compiledPath = __DIR__.'/cache/compiled.php';


if (file_exists($compiledPath)) {
    require $compiledPath;
}

