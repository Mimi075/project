<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());

if (null !== $app['session']->get('user')) {
	$app['global.userName'] = "Bienvenue " . $app['session']->get('user')['firstname'] . ' ' . $app['session']->get('user')['lastname'] ;
}
else{
	$app['global.userName'] = '';
}


$app['twig'] = $app->extend('twig', function ($twig, $app) {
    $twig->addGlobal('userName', $app['global.userName']);
    return $twig;
});

//Debut attribution doctrine orm (EntityManager) dans $app['em']
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Entity"), $isDevMode);
$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'dcw_projet_final',
);
$app['em'] = EntityManager::create($conn, $config);
//Fin attribution doctrine orm (EntityManager) dans $app['em']

//Clé pour utiliser google api
$app['googleKey'] = "AIzaSyCI9gyjXvzUW09sFa98eajpr6ZRUjqXF5o";
return $app;
