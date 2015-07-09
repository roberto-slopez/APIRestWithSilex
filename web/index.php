<?php 

require_once __DIR__.'/../vendor/autoload.php'; 
$app = require __DIR__.'/../TS/app.php';

/**
* Se usa para levantar el servicio y poder acceder a http://localhost:8080 (borra si se usa nginx o apache)
*/
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

// ejecuta la aplicación (no borrar nunca)
$app->run();