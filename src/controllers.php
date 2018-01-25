<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Query\Expr\Join;

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
    $mdp = $request->get('connectPassword');
    $repository = $app['em']->getRepository(Entity\Farmer::class);
    $query = $repository->findOneBy(['email' => $username]);                  
    $repository = $app['em']->getRepository(Entity\Farmer::class);
    $query = $repository->findOneBy(['email' => $username]);       

    if ($query != null && password_verify($mdp, $query->getPassword())) {
      $app['session']->set('user', array('firstname' => $query->getFirstName(), 
        'lastname' => $query->getLastName(),
        'email' => $query->getEmail(),
        'id' => $query->getId()
      ));
      $app['global.userName'] = "Bienvenue " . $app['session']->get('user')['firstname'] . ' ' . $app['session']->get('user')['lastname'] ;
      return $app['twig']->render('congrulation.html.twig',array());
    }
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

         if(strlen($post['phone']) != 10 ){
            $errors[] = 'Le n° de téléphone doit comporter 10 chiffres';
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

        include 'switch.php';
        
        if(count($errors) == 0){
            // errors = 0 = insertion user
            $farmer = new Entity\Farmer();
            $farmer->setLastName($post['lastname']);
            $farmer->setFirstName($post['firstname']);
            $farmer->setEmail($post['email']);
            $mdp = $post['password'];
            $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
            $farmer->setPassword($hash_mdp);
            $farmer->setAdress($post['adress']);
            $farmer->setZip($post['zip']);
            $farmer->setCity($post['city']);
            $farmer->setPhone($post['phone']);
            $farmer->setSiren($post['siren']);
            $farmer->setRegion($region);
            $farmer->setRegistrationDate(new \DateTime());
            $app['em']->persist($farmer);
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

    $datacontact = array();
             // S'il y des données de postées
          if ($_SERVER['REQUEST_METHOD']=='POST') {
          // Code PHP pour traiter l'envoi de l'email
          
          $nombreErreur = 0; // Variable qui compte le nombre d'erreur
          
          // Définit toutes les erreurs possibles
          if (!isset($_POST['email'])) { // Si la variable "email" du formulaire n'existe pas (il y a un problème)
          $nombreErreur++; // On incrémente la variable qui compte les erreurs
          $erreur1 = '<p>Il y a un problème avec la variable "email".</p>';
          } else { // Sinon, cela signifie que la variable existe (c'est normal)
          if (empty($_POST['email'])) { // Si la variable est vide
          $nombreErreur++; // On incrémente la variable qui compte les erreurs
          $erreur2 = '<p>Vous avez oublié de donner votre email.</p>';
          } else {
          if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $nombreErreur++; // On incrémente la variable qui compte les erreurs
          $erreur3 = '<p>Cet email ne ressemble pas un email.</p>';
          }
          }
          }
          
          if (!isset($_POST['message'])) {
          $nombreErreur++;
          $erreur4 = '<p>Il y a un problème avec la variable "message".</p>';
          } else {
          if (empty($_POST['message'])) {
          $nombreErreur++;
          $erreur5 = '<p>Vous avez oublié de donner un message.</p>';
          }
          }
          
          if (!isset($_POST['captcha'])) {
          $nombreErreur++;
          $erreur6 = '<p>Il y a un problème avec la variable "captcha".</p>';
          } else {
          if ($_POST['captcha']!=4) {
          $nombreErreur++;
          $erreur7 = '<p>Désolé, le captcha anti-spam est erroné.</p>';
          }
          }
          
          if ($nombreErreur==0) { // S'il n'y a pas d'erreur
          // Récupération des variables et sécurisation des données
          $nom = htmlentities($_POST['nom']); // htmlentities() convertit des caractères "spéciaux" en équivalent HTML
          $email = htmlentities($_POST['email']);
          $message = htmlentities($_POST['message']);
          
          // Variables concernant l'email
          $destinataire = 'zephyrmahe@msn.com'; // Adresse email du webmaster
          $sujet = 'Titre du message'; // Titre de l'email
        $contenu = '<html><head><title>Titre du message</title></head><body>';
        $contenu .= '<p>Bonjour, vous avez reçu un message à partir de votre site web.</p>';
        $contenu .= '<p><strong>Nom</strong>: '.$nom.'</p>';
        $contenu .= '<p><strong>Email</strong>: '.$email.'</p>';
        $contenu .= '<p><strong>Message</strong>: '.$message.'</p>';
      $contenu .= '</body></html>'; // Contenu du message de l'email
      
      // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
      $headers = 'MIME-Version: 1.0'."\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
      
      @mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
      
      echo '<h2>Message envoyé!</h2>'; // Afficher un message pour indiquer que le message a été envoyé
      } else { // S'il y a un moins une erreur
      echo '<div style="border:1px solid #ff0000; padding:5px;">';
        echo '<p style="color:#ff0000;">Désolé, il y a eu '.$nombreErreur.' erreur(s). Voici le détail des erreurs:</p>';
        if (isset($erreur1)) echo '<p>'.$erreur1.'</p>';
        if (isset($erreur2)) echo '<p>'.$erreur2.'</p>';
        if (isset($erreur3)) echo '<p>'.$erreur3.'</p>';
        if (isset($erreur4)) echo '<p>'.$erreur4.'</p>';
        if (isset($erreur5)) echo '<p>'.$erreur5.'</p>';
          if (isset($erreur6)) echo '<p>'.$erreur6.'</p>';
          if (isset($erreur7)) echo '<p>'.$erreur7.'</p>';
      echo '</div>';
      }
      }
    

    return $app['twig']->render('formulaireContact.html.twig', array());
})
->bind('formulaireContact')
->method('GET|POST')
;
//----------------------------------------------------------------------------------------------------
$app->match('/formulaireAnnonce', function () use ($app) {
  include 'testAnnonce.php';

  $dataAnnonce = ["categories" => animalCategoryCreation()];

  if(!empty($errors)){
    $dataAnnonce['errors'] = $errors;
  }

  if (isset($render) && $render) {
    return $app['twig']->render('congrulationAnnonce.html.twig',array());
  }

  else{
    return $app['twig']->render('formulaireAnnonce.html.twig', $dataAnnonce);
  }
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
    $category = animalCategoryCreation();
    $region = regionList();
    

    if (isset($_GET['reg']) && $_GET['reg'] != "") {
      $reg = $_GET['reg'];
    }
    else {
      $reg = 'default';
    }
    if (isset($_GET['t'])) {
      # code...
    }

    /*switch (variable) {
      case 'value':
        # code...
        break;
      
      default:
        # code...
        break;
    }*/

    $qb = $app['em']->createQueryBuilder('a');
    $qb->select('a.title', 'a.price', 'ani.name', 'p.url', 'a.container', 'f.region', 'a.id')
              ->from(Entity\Ad::class, 'a' )
              ->innerJoin(Entity\Farmer::class, 'f', Join::WITH, 'f.id = a.farmer')
              ->leftJoin(Entity\Photo::class, 'p', Join::WITH, 'a.id = p.ad')
              ->innerJoin(Entity\Animal::class, 'ani', Join::WITH, 'ani.id = a.animal')
              ->andwhere('p.bool = 1')
              ->orderBy('a.price', 'ASC')
              ;
    if ($reg != 'default') {
       $qb->andwhere('f.region = :reg')->setParameter('reg', $reg);
    }
   

    $query = $qb->getQuery();

/*echo $query->getDQL(), "\n";*/
$query = $query->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);
/*echo "<pre>";
var_dump($query);
echo "</pre>";*/
$dataAd = [
        'categories' => $category,
        'regions' => $region['regions'],
        'querys' => $query,
    ];
    return $app['twig']->render('annonces.html.twig', $dataAd);
})
->bind('annonces')
;
//----------------------------------------------------------------------------------------------------
$app->get('/annonceDetail', function () use ($app) {

    $qb = $app['em']->createQueryBuilder('a');
    $qb->select('a.title', 'a.price', 'ani.name', 'p.url', 'a.container', 'f.region', 'a.id', 'f.city', 'f.zip', 'f.phone')
              ->from(Entity\Ad::class, 'a' )
              ->innerJoin(Entity\Farmer::class, 'f', Join::WITH, 'f.id = a.farmer')
              ->leftJoin(Entity\Photo::class, 'p', Join::WITH, 'a.id = p.ad')
              ->innerJoin(Entity\Animal::class, 'ani', Join::WITH, 'ani.id = a.animal')
              ->andwhere('a.id = :id')
              ->setParameter('id', $_GET['id']);

    $query = $qb->getQuery();

/*echo $query->getDQL(), "\n";*/
$query = $query->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);
/*echo "<pre>";
var_dump($query);
echo "</pre>";*/
$dataAdDetail = [
        'querys' => $query,
    ];

    return $app['twig']->render('annonceDetail.html.twig', $dataAdDetail);
})
->bind('annonceDetail')
;
// ----------------------------------------------------------------------------------------------------
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

$app->get('/congrulation', function () use ($app) {
    return $app['twig']->render('congrulation.html.twig', regionList());
})
->bind('congrulation')
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
