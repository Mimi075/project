<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

include '../web/function.php';
//----------------------------------------------------------------------------------------------------
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', regionList());
})
->bind('homepage')
;
//----------------------------------------------------------------------------------------------------
$app->match('/login', function (Request $request) use ($app) {

    if (!empty($_POST)) {
        $username = $request->get('connectEmail');
        $password = $request->get('connectPassword');

        $repository = $app['em']->getRepository(Entity\Eleveur::class);
        $query = $repository->findOneBy(['email' => $username]);

        if ($query->getEmail() === $username && $query->getPassword() === $password) {
            $app['session']->set('user', array('firstname' => $query->getFirstName(), 
                                                'lastname' => $query->getLastName(),
                                                'email' => $query->getEmail()
                                                ));
            $app['global.userName'] = "Bienvenue " . $app['session']->get('user')['firstname'] . ' ' . $app['session']->get('user')['lastname'] ;
        }
    }

    else {
        echo "";
    }
    return $app['twig']->render('login.html.twig',array());
})
->bind('login')
->method('GET|POST')
;
//----------------------------------------------------------------------------------------------------
$app->post('/logout', function (Request $request) use ($app) {
    
    $app['session']->clear();
    return $app->redirect('/');
})
->bind('logout');
//----------------------------------------------------------------------------------------------------
$app->match('/inscription', function () use ($app) {
    
    $dataInscription = array();
    
    if (!empty($_POST)){
        foreach($_POST as $key => $value){
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
//----------------------------------------------------------------------------------------------------
$app->match('/formulaireContact', function () use ($app) {

    return $app['twig']->render('formulaireContact.html.twig', array());
})
->bind('formulaireContact')
->method('GET|POST')
;
//----------------------------------------------------------------------------------------------------
$app->match('/formulaireAnnonce', function () use ($app) {
    include 'upload.php';

    return $app['twig']->render('formulaireAnnonce.html.twig', formulairecategory());
})
->bind('formulaireAnnonce')
->method('GET|POST')
;
//----------------------------------------------------------------------------------------------------
$app->get('/AproposDeNous', function () use ($app) {

    return $app['twig']->render('parallax.html.twig', array());
})
->bind('AproposDeNous')
;
//----------------------------------------------------------------------------------------------------
$app->get('/annonces', function () use ($app) {
    $category = formulairecategory();
    $region = regionList();
    $alerte = [
        'category' => $category['category'],
        'val' => $category['val'],
        'regions' => $region['regions'],
        'reg' => $region['reg'] 
    ];


    $annonce = '<a class="row" href="#">
                <div class="col-3">
                    <img class="item_image" src="img/loup.jpg" alt="loup"/>
                </div>
                <div class="col-9"> 
                    <h5>Vends loup volant (très rare)</h5>
                    <p>Oiseaux-canins</p>
                    <p>Basse-Normandie</p> 
                    <p>prix : 25000 €</p>
                </div>
            </a>                ';

    return $app['twig']->render('annonces.html.twig', $alerte);
})
->bind('annonces')
;
//----------------------------------------------------------------------------------------------------
$app->get('/alerte', function () use ($app) {
    $category = formulairecategory();
    $region = regionList();
    $alerte = [
        'category' => $category['category'],
        'val' => $category['val'],
        'regions' => $region['regions'],
        'reg' => $region['reg'] 
    ];

    return $app['twig']->render('alerte.html.twig', $alerte);

})
->bind('alerte')
;
//----------------------------------------------------------------------------------------------------

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
