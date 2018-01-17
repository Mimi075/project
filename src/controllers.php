<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

$app->get('/login', function (Request $request) use ($app) {
    $username = $request->server->get('PHP_AUTH_USER', false);
    $password = $request->server->get('PHP_AUTH_PW');

    if ('igor' === $username && 'password' === $password) {
        $app['session']->set('user', array('username' => $username));
        return $app->redirect('/');
    }

    $response = new Response();
    $response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', 'site_login'));
    $response->setStatusCode(401, 'Please sign in.');
    return $response;
})
->bind('login');

$app->get('/logout', function (Request $request) use ($app) {
    
    $request = $this->getRequest();
   $session = $request->getSession();
   $session->remove();
    return $app->redirect('/');
})
->bind('logout');

$app->match('/inscription', function () use ($app) {
    $dataInscription = array();
    if (!empty($_POST)){
        foreach($_POST as $key => $value){
            //stockage dans un tableau des valeur reçu par $_POST avec neutralisation
            $post[$key] = $value;
        }
        //initialisation du tableau des erreurs
        $errors = array();

        //différent test pour voir si il y'a des erreur
        if(strlen($post['firstname']) < 3){
            $errors[] = 'Le prénom doit comporter au moins 3 caractères';
        }
        if(strlen($post['lastname']) < 3){
            $errors[] = 'Le nom doit comporter au moins 3 caractères';
        }
        if(strlen($post['adress']) < 3){
            $errors[] = 'L\'adresse doit comporter au moins 3 caractères';
        }
        if(strlen($post['zip']) != 5 ){
            $errors[] = 'Le code postale doit comporter 5 chiffres';
        }
        if(empty($post['city'])){
            $errors[] = 'La ville ne peut être vide';
        }
        if(strlen($post['siren']) != 9 ){
            $errors[] = 'Le n° siren doit comporter 9 chiffres';
        }
        if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'L\'adresse email est invalide';
        }
         if(strlen($post['password']) < 6 ){
            $errors[] = 'Le mot de passe doit comporter au moins 6 caractères';
        }
         if($post['password'] != $post['confPassword']){
            $errors[] = 'Les mot de passe ne sont pas identique';
        }
        if(count($errors) == 0){
            // errors = 0 = insertion user
            $eleveur = new Entity\Eleveur();
            $eleveur->setLastName($post['lastname']);
            $eleveur->setFirstName($post['firstname']);
            $eleveur->setEmail($post['email']);
            $eleveur->setPassword($post['password']);
            $eleveur->setAdress($post['adress']);
            $eleveur->setZip($post['zip']);
            $eleveur->setCity($post['city']);
            $eleveur->setSiren($post['siren']);
            $app['em']->persist($eleveur);
            $app['em']->flush();
        }
        if(!empty($errors)){
                   $dataInscription = [
                        'errors' => $errors
                   ];
        }
   
    }
    return $app['twig']->render('inscription.html.twig', $dataInscription);
})
->bind('inscription')
->method('GET|POST')
;

$app->match('/formulaireContact', function () use ($app) {
    return $app['twig']->render('formulaireContact.html.twig', array());
})
->bind('formulaireContact')
->method('GET|POST')
;

$app->get('/formulaireAnnonce', function () use ($app) {
    $formulairecategory = [
    'category' => ['Bovins', 'Equins', 'Ovins', 'Caprins', 'Volailles', 'Rongeurs', 'Poissons', 'Oiseaux', 'Félinx', 'Canins', 'Réptiles', 'Autre'],
    'val' => 1
    ];

    return $app['twig']->render('formulaireAnnonce.html.twig', $formulairecategory);
})
->bind('formulaireAnnonce')
;

$app->get('/AproposDeNous', function () use ($app) {
    return $app['twig']->render('parallax.html.twig', array());
})
->bind('AproposDeNous')
;

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
