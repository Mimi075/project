<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Query\Expr\Join;

//Request::setTrustedProxies(array('127.0.0.1'));

include '../web/function.php';

//Page d'accueil
//----------------------------------------------------------------------------------------------------
$app->get('/', function () use ($app) {
    
  return $app['twig']->render('index.html.twig', regionList());
})
->bind('homepage')
;

//Page de connexion
//----------------------------------------------------------------------------------------------------
$app->match('/login', function (Request $request) use ($app) {   

  //Test si $_POST n'est pas vide
  if (!empty($_POST)) {
    //Récupération du pseudo et du mot de passe écrit dans le formulaire
    $username = $request->get('connectEmail');
    $mdp = $request->get('connectPassword');

    //Cherche dans la base de données si le username existe
    $repository = $app['em']->getRepository(Entity\Farmer::class);
    $query = $repository->findOneBy(['email' => $username]);                        

    //Test le retour de la requete précédente et test le mot de passe chiffrer
    if ($query != null && password_verify($mdp, $query->getPassword())) {
      //Si toute les conditions sont remplies, on stock dans le cookie de session les données requis
      $app['session']->set('user', array('firstname' => $query->getFirstName(), 
        'lastname' => $query->getLastName(),
        'email' => $query->getEmail(),
        'id' => $query->getId()
      ));

      //Affichage du mot de bienvenue dans la navbar
      $app['global.userName'] = "Bienvenue " . $app['session']->get('user')['firstname'] . ' ' . $app['session']->get('user')['lastname'] ;
      return $app['twig']->render('congrulation.html.twig',array());
    }
  }

  return $app['twig']->render('login.html.twig',array());
})
->bind('login')
->method('GET|POST')
;

//Page de déconnexion
//----------------------------------------------------------------------------------------------------
$app->get('/logout', function (Request $request) use ($app) { 
  //Vide la séssion actuel
  $app['session']->clear();
  return $app->redirect('/');
})
->bind('logout');

//Page d'inscription
//----------------------------------------------------------------------------------------------------
$app->match('/inscription', function () use ($app) {

  //Déclaration du tableau de retour de données pour twig
  $dataInscription = array();
  
  //Test si $_POST n'est pas vide
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

    //Fichier avec condition pour récupérer la région grace au code postal
    include 'switch.php';
    
    //Test si le tableau $errors est vide
    if(count($errors) == 0){
      //Sotckage des données dans la base de données
      $farmer = new Entity\Farmer();
      $farmer->setLastName($post['lastname']);
      $farmer->setFirstName($post['firstname']);
      $farmer->setEmail($post['email']);
      //Chiffrage du mot de passe
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

    //Test si le tableau $errors n'est pas vide
    if(!empty($errors)){
      //Stockage de la liste des erreurs dans tableau $dataInscription pour rendue twig
      $dataInscription = ['errors' => $errors];
    }
  }
    return $app['twig']->render('inscription.html.twig', $dataInscription);
})
->bind('inscription')
->method('GET|POST')
;
//Page du formulaire de contact
//----------------------------------------------------------------------------------------------------
$app->match('/formulaireContact', function () use ($app) {

  //Déclaration du tableau de retour de données pour twig
  $datacontact = array();
   // S'il y des données de postées 
  if ($_SERVER['REQUEST_METHOD']=='POST') { 
    // Code PHP pour traiter l'envoi de l'email
          
    $nombreErreur = 0; // Variable qui compte le nombre d'erreur
          
    // Définit toutes les erreurs possibles
    if (!isset($_POST['eMail'])) { // Si la variable "email" du formulaire n'existe pas (il y a un problème)
      $nombreErreur++; // On incrémente la variable qui compte les erreurs
      $erreur1 = '<p>Il y a un problème avec la variable "email".</p>';
    }

    else { // Sinon, cela signifie que la variable existe (c'est normal)
      if (empty($_POST['eMail'])) { // Si la variable est vide
        $nombreErreur++; // On incrémente la variable qui compte les erreurs
        $erreur2 = '<p>Vous avez oublié de donner votre email.</p>';
      }

      else {
        if (!filter_var($_POST['eMail'], FILTER_VALIDATE_EMAIL)) {
          $nombreErreur++; // On incrémente la variable qui compte les erreurs
          $erreur3 = '<p>Cet email ne ressemble pas un email.</p>';
        }
      }
    }
          
    if (!isset($_POST['text'])) {
      $nombreErreur++;
      $erreur4 = '<p>Il y a un problème avec la variable "message".</p>';
    }

    else {
      if (empty($_POST['text'])) {
        $nombreErreur++;
        $erreur5 = '<p>Vous avez oublié de donner un message.</p>';
      }
    }
          
    if (!isset($_POST['object'])) {
      $nombreErreur++;
      $erreur6 = '<p>Il y a un problème avec la variable "object".</p>';
    }
          
    if ($nombreErreur==0) { 
      // S'il n'y a pas d'erreur
      // Récupération des variables et sécurisation des données
      $nom = htmlentities($_POST['name']); // htmlentities() convertit des caractères "spéciaux" en équivalent HTML
      $email = htmlentities($_POST['eMail']);
      $message = htmlentities($_POST['text']);
          
      // Variables concernant l'email
      $destinataire = 'zephyrmahe@gmail.com'; // Adresse email du webmaster
      $sujet = htmlentities($_POST['object']); // Titre de l'email
      $contenu = '<html><body>';
      $contenu .= '<p><strong>Nom</strong>: '.$nom.'</p>';
      $contenu .= '<p><strong>Email</strong>: '.$email.'</p>';
      $contenu .= '<p><strong>Message</strong>: '.$message.'</p>';
      $contenu .= '</body></html>'; // Contenu du message de l'email
      
      // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
      $headers = 'MIME-Version: 1.0'."\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
      
      mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
      
      // Afficher un message pour indiquer que le message a été envoyé
      return $app['twig']->render('confirmeMessage.html.twig', array());
    } 
    else { 
      // S'il y a un moins une erreur
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
else {
    return $app['twig']->render('formulaireContact.html.twig', array());
}

    
})
->bind('formulaireContact')
->method('GET|POST')
;

//Page du formulaire d'annonce
//----------------------------------------------------------------------------------------------------
$app->match('/formulaireAnnonce', function () use ($app) {
  //Scipt pour savoir si l'annonce est bien conforme
  include 'testAnnonce.php';

  //Déclaration du tableau de retour de données pour twig
  $dataAnnonce = ["categories" => animalCategoryCreation()];

  //Test si le tableau $errors n'est pas vide
  if(!empty($errors)){
    $dataAnnonce['errors'] = $errors;
  }

  //Test si le tableau $render existe et si il est égale a true
  //Si le test est bon faire le rendue de la page congrulationAnnonce.html.twig
  if (isset($render) && $render) {
    return $app['twig']->render('congrulationAnnonce.html.twig',array());
  }

  //Sinon faire le rendue de la page formulaireAnnonce.html.twig
  else{
    return $app['twig']->render('formulaireAnnonce.html.twig', $dataAnnonce);
  }
})
->bind('formulaireAnnonce')
->method('GET|POST')
;

//Page de présentation
//----------------------------------------------------------------------------------------------------
$app->get('/AproposDeNous', function () use ($app) {

    return $app['twig']->render('parallax.html.twig', array());
})
->bind('AproposDeNous')
;

//Page d'annonces
//----------------------------------------------------------------------------------------------------
$app->get('/annonces', function () use ($app) {

  //Récupération des tableaux
  $category = animalCategoryCreation();
  $region = regionList();
  
  //Test si $_GET['reg'] existe et si $_GET['reg'] n'est pas égal a ""(vide)
  if (isset($_GET['reg']) && $_GET['reg'] != "") {
    $reg = $_GET['reg'];
  }
  
  //Si $_GET['reg'] est vide on stock dans $reg 'default'
  else {
    $reg = 'default';
  }

  if (isset($_GET['keywords']) && $_GET['keywords']!= "") {
    $keywords = $_GET['keywords'];
  }

  else{
    $keywords = '';
  }
  /*switch (variable) {
    case 'value':
      # code...
    break;
      
    default:
      # code...
    break;
  }*/

  //Préparation de la requete pour récupérer les annonces
  $qb = $app['em']->createQueryBuilder('a');
  $qb->select('a.title', 'a.price', 'ani.name', 'p.url', 'a.container', 'f.region', 'a.id')
    ->from(Entity\Ad::class, 'a' )
    ->innerJoin(Entity\Farmer::class, 'f', Join::WITH, 'f.id = a.farmer')
    ->leftJoin(Entity\Photo::class, 'p', Join::WITH, 'a.id = p.ad')
    ->innerJoin(Entity\Animal::class, 'ani', Join::WITH, 'ani.id = a.animal')
    ->andwhere('p.bool = 1')
    ->orderBy('a.creationDate', 'DESC')
  ;
  //Test si $reg n'est pas égal 'default'
  if ($reg != 'default') {
    //Rajoute une condition dans la requete
    $qb->andwhere('f.region = :reg')->setParameter('reg', $reg);
  }

  if ($keywords != '') {
    //Rajoute une condition dans la requete
    $qb->andwhere('a.title LIKE :keywords')->setParameter('keywords', '%'.$keywords.'%');
  }

  //Récupère la requete complete sous forme SQL
  $query = $qb->getQuery();

  //Stock le résultat de la requete dans un tableau
  $query = $query->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);

  //Tableau pour envoi a twig
  $dataAd = [
    'categories' => $category,
    'regions' => $region['regions'],
    'querys' => $query,
  ];
  return $app['twig']->render('annonces.html.twig', $dataAd);
})
->bind('annonces')
;

//Page du détail d'annonce
//----------------------------------------------------------------------------------------------------
$app->get('/annonceDetail', function () use ($app) {

  //Préparation de la requete pour récupérer les annonces
  $qb = $app['em']->createQueryBuilder('a');
  $qb->select('a.title', 'a.price', 'ani.name', 'p.url', 'a.container', 'f.region', 'a.id', 'f.city', 'f.zip', 'f.phone', 'a.creationDate')
    ->from(Entity\Ad::class, 'a' )
    ->innerJoin(Entity\Farmer::class, 'f', Join::WITH, 'f.id = a.farmer')
    ->leftJoin(Entity\Photo::class, 'p', Join::WITH, 'a.id = p.ad')
    ->innerJoin(Entity\Animal::class, 'ani', Join::WITH, 'ani.id = a.animal')
    ->andwhere('a.id = :id')
    ->setParameter('id', $_GET['id'])
  ;

  //Récupère la requete complete sous forme SQL
  $query = $qb->getQuery();

  //Stock le résultat de la requete dans un tableau
  $query = $query->getResult(Doctrine\ORM\Query::HYDRATE_ARRAY);

  //
  $date = $query[0]["creationDate"];
  $day = $date->format('d-m-Y');
  $hour = $date->format('H:i');

   //Tableau pour envoi a twig
  $dataAdDetail = [
    'querys' => $query,
    'day' => $day,
    'hour' => $hour    
  ];

  return $app['twig']->render('annonceDetail.html.twig', $dataAdDetail);
})
->bind('annonceDetail')
;

//Page d'alerte
// ----------------------------------------------------------------------------------------------------
$app->get('/alerte', function () use ($app) {

  //Récupération des tableaux
  $category = formulairecategory();
  $region = regionList();
  
  //Tableau pour envoi a twig
  $dataAlerte = [
    'category' => $category['category'],
    'val' => $category['val'],
    'regions' => $region['regions'],
    'reg' => $region['reg'] 
  ];

  return $app['twig']->render('alerte.html.twig', $dataAlerte);
})
->bind('alerte')
;

//Page de succés de connexion
//----------------------------------------------------------------------------------------------------
$app->get('/congrulation', function () use ($app) {
  return $app['twig']->render('congrulation.html.twig', regionList());
})
->bind('congrulation')
;

//Retour des différents erreurs
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
