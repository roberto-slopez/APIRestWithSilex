<?php
$app = new Silex\Application(); 
$app['debug'] = true;

// https://github.com/silexphp/Silex/wiki/Third-Party-ServiceProviders#database
$app->register(
    new \Arseniew\Silex\Provider\IdiormServiceProvider(),
    [
        'idiorm.db.options' => [
            'connection_string' => 'mysql:host=localhost;dbname=Prueba',
            'username' => 'root',
            'password' => '1234',
        ]
    ]
);

// Descomentar si se desea usar Doctrine
//$app->register(
//    new Silex\Provider\DoctrineServiceProvider(),
//    [
//        'dbs.options' => [
//            'default' => [
//                'driver' => 'pdo_mysql',
//                'host' => 'localhost',
//                'dbname' => 'Prueba',
//                'user' => 'root',
//                'password' => '1234',
//                'charset' => 'utf8',
//            ]
//        ],
//    ]
//);

$app->mount('/', new TS\Controller\StockcodeController());

return $app;