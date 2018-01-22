<?php

$dataAnnonce = array();
    
    if (!empty($_POST)){
        foreach($_POST as $key => $value){
            $post[$key] = $value;
        }
        
        //initialisation du tableau des erreurs
        $errors = array();

        //différent test pour voir si il y'a des erreur
        if(strlen($post['title']) < 3){
            $errors[] = 'Le prénom doit comporter au moins 3 caractères';
        }
        
        if($post['category'] == "Choisir..."){
            $errors[] = 'Vous devez choisir autre chose que "Choisir..."';
        }
        
        if(strlen($post['textAnnonce']) < 25){
            $errors[] = 'Le texte de l\'annonce doit contenir au minimum 25 caractères;'
        }

        if($post['price'] ==  ''){
            $errors[] = 'Vous devez indiquer un prix!'
        }
        
        if(count($errors) == 0){
            // errors = 0 = insertion user
            $annonce = new Entity\Annonce();
            $annonce->setFarmer($app['session']->get('user')['id']);
            $annonce->setTitle($post['title']);
            $annonce->setPrice($post['price']);
            $annonce->setEmail($post['email']);
            $annonce->setPassword($post['password']);
            $app['em']->persist($eleveur);
            $app['em']->flush();
        }

        if(!empty($errors)){
                   $dataInscription = [
                        'errors' => $errors
                   ];
        }
    }
