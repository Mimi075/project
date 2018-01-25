<?php

/*
*Ce script est définit en deux grande parti.
*La première partie est celle qui permet de tester si il n'y a pas d'erreur dans les inputs ou les fichiers reçu.
*La deuxième partie est celle est éxécuté a condition qu'il n'y est aucune erreur dans la première partie.
*Elle permet d'enregistrer les données reçu par le formulaire avec doctrine dans la base de donnée.
*/

//-----------------------------------------------------------------------------------------------------
//Première partie : Les tests

    //Test si $_POST n'est pas vide
    if (!empty($_POST)){
        //si il est pas vide, on rentre les données de $_POST dans le tableaux $post
        foreach($_POST as $key => $value){
            $post[$key] = $value;
        }
        
        //On déclare le tableaux ou seront contenue les erreurs
        $errors = array();

        //Différent test pour voir si il y'a des erreur. Si il y'a une erreur, elle se rajoute dans le tableaux $errors

        //Test si le titre de l'annonce contient bien 3 caractère
        if(strlen($post['title']) < 3){
            $errors[] = 'Le titre doit comporter au moins 3 caractères';
        }
        
        //Test si category correspond a autre chose que 'Choisir...'
        if($post['animal'] == "Choisir..."){
            $errors[] = 'Vous devez choisir autre chose que "Choisir..."';
        }
        
        //Test si Le texte de l'annonce fait au minimum 25 caractère
        if(strlen($post['textAnnonce']) < 25){
            $errors[] = 'Le texte de l\'annonce doit contenir au minimum 25 caractères';
        }

        //Test si le prix est bien indiquer
        if($post['price'] ==  ''){
            $errors[] = 'Vous devez indiquer un prix!';
        }

        //Instance de la variable qui permettra de définir si il y'a un ou des fichier(s) contenue dans $_FILES
        $testFile = false;

        //Test si il y'a un ou des fichier(s) dans $_FILES
        for ($i=0; $i < 5; $i++) { 
            
            $j = $_FILES["fileToUpload"]["name"][$i];
            if ($j != "") {
                $testFile = true;
            } 
        }

        //Test si il y'a une ou des photo(s) grace a la variable défini précédemment
        if ($testFile){
            //Parcour du tableaux $_FILES["fileToUpload"]["name"]
            foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
                //Test si $_FILES["fileToUpload"]["name"] n'est pas vide
                if ($_FILES["fileToUpload"]["name"][$key] != "") {

                    //Récupération de l'extension du fichier
                    $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"][$key]),PATHINFO_EXTENSION));

                    //Test si le fichier est bien une image
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
                    if($check == false) {
                        $errors[] = "Le fichier n'est pas une image.<br>";
                    }

                    // Test la taille du fichier
                    if ($_FILES["fileToUpload"]["size"][$key] > 500000) {
                        $errors[] = "Désolé, votre fichier est trop volumineux.<br>";
                    }

                    // Test le format du fichier
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                        $errors[] = "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisé.<br>";
                    }

                    // Test si il n'y a pas d'erreur 
                    if (count($errors) != 0) {
                        $errors[] = "Désolé, votre fichier n'a pas été charger.";
                
                    } 
                }
            }

        }

//-----------------------------------------------------------------------------------------------------
//Deuxième partie : L'enregistrement
        
        //Si il y'a 0 erreur, on lance la procédure pour enregistrer dans la base de données
        if(count($errors) == 0){
            //Récupération de l'email de l'utilisateur actuel
            $email = $app['session']->get('user')['email'];

            //Requete doctrine pour récupérer l'objet de l'eleveur actuel
            $repository = $app['em']->getRepository(Entity\Farmer::class);
            $farmer = $repository->findOneBy(['email' => $email]);

            //Requete doctrine pour récupérer la catégorie choisi
            $repository = $app['em']->getRepository(Entity\Animal::class);
            $animal = $repository->findOneBy(['name' => $post['animal']]);

            //Procédure d'enregistrement avec doctrine doctrine dans base de données
            $ad = new Entity\Ad();
            $ad->setFarmer($farmer);
            $ad->setAnimal($animal);
            $ad->setTitle($post['title']);
            $ad->setContainer($post['textAnnonce']);
            $ad->setPrice($post['price']);
            $ad->setCreationDate(new \DateTime());
            $app['em']->persist($ad);
            $app['em']->flush();
            

            //Test si il y'a une ou des photo(s)
            if ($testFile){
                //Récupération de l'id de l'annonce précédemment créer
                $id = $ad->getId();

                //Création du lien du dossier de l'utilisateur
                $target_dir = "img/". $app['session']->get('user')['email'] . "/";

                //Test si le lien existe, si il existe pas la creation ce fait
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0700);
                }

                //Création du lien du dossier de reception final 
                $target_dir = $target_dir . $id .'/';
                //Création du dossier de reception final 
                mkdir($target_dir, 0700);

                //Parcour du tableaux $_FILES["fileToUpload"]["name"]
                foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
                    //Test si $_FILES["fileToUpload"]["name"] n'est pas vide
                    if ($_FILES["fileToUpload"]["name"][$key] != "") {

                        //Creation du lien complet de la cible
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);

                        //Récupération de l'extension du fichier
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                        //Envoi du fichier dans le lien définit dans $target_file
                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file);
                        
                        //Renomme les fichier dans l'ordre d'arrivée
                        rename($target_file, $target_dir . $key .'.'. $imageFileType);

                        //Procédure d'enregistrement avec doctrine doctrine dans base de données
                        $picture = new Entity\Photo();
                        $picture->setAd($ad);
                        $picture->setUrl($target_dir . $key .'.'. $imageFileType);
                        //Test si c'est la première image uploader pour définir qui sera afficher
                        //dans la liste des annonces
                        if ($key == 0) {$picture->setBool(1);}
                        else {$picture->setBool(0);}
                        $app['em']->persist($picture);
                        $app['em']->flush();
                        /*echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$key]). " a bien été télécharger.<br>";*/
                        
                    }
                }
            }
            //si il n'y a pas de photo, on stock le lien de l'image noFoto.jpg dans la base de données
            else{
                $picture = new Entity\Photo();
                $picture->setAd($ad);
                $picture->setUrl('img/noFoto.png');
                $picture->setBool(1);
                $app['em']->persist($picture);
                $app['em']->flush();
            }
            //variable qui permet de définir la page qui sera rendu avec twig
            $render = true;
        }
    }
