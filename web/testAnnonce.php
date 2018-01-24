<?php

    //Test si $_POST n'est pas vide
    if (!empty($_POST)){
        //si il est pas vide, on rentre les données de $_POST dans le tableaux $post
        foreach($_POST as $key => $value){
            $post[$key] = $value;
        }
        
        //On déclare le tableaux des erreurs
        $errors = array();

        //Différent test pour voir si il y'a des erreur. Si il y'a une erreur, elle se rajoute dans le tableaux errors

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

        //Test si il y'a une ou des photo(s)
        if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] ){

            foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
                if ($_FILES["fileToUpload"]["name"][$key] != "") {

                    $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"][$key]),PATHINFO_EXTENSION));
                    // test si le fichier est bien une image
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
        
        //Si il y'a 0 erreur, on lance la procédure pour enregistrer dans la base de données
        if(count($errors) == 0){
            //récupération de l'email de l'utilisateur actuel
            $email = $app['session']->get('user')['email'];
            //requete doctrine pour récupérer l'objet de l'eleveur actuel
            $repository = $app['em']->getRepository(Entity\Eleveur::class);
            $email = $repository->findOneBy(['email' => $email]);

            //requete doctrine pour récupérer la catégorie choisi
            $repository = $app['em']->getRepository(Entity\Animal::class);
            $animal = $repository->findOneBy(['name' => $post['animal']]);

            //création de d'un objet annonce pour doctrine
            $annonce = new Entity\Annonce();
            //atribution
            $annonce->setFarmer($email);
            $annonce->setAnimal($animal);
            $annonce->setTitle($post['title']);
            $annonce->setContainer($post['textAnnonce']);
            $annonce->setPrice($post['price']);
            $annonce->setDateDeCreation(new \DateTime());
            $app['em']->persist($annonce);
            $app['em']->flush();
            

            //Test si il y'a une ou des photo(s)
            if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] ){
                //Récupération de l'id précédament créer
                $id = $annonce->getId();

                //Création du lien du dossier de reception
                $target_dir = "img/". $app['session']->get('user')['email'] . "/";

                //test si le lien existe, si il existe pas la creation ce fait
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0700);
                }

                $target_dir = $target_dir . $id .'/';

                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0700);
                }

                foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
                    if ($_FILES["fileToUpload"]["name"][$key] != "") {

                        //creation du lien complet de la cible
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);

                        //récupération de l'extension du fichier
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
                            rename($target_file, $target_dir . $key .'.'. $imageFileType);

                            $picture = new Entity\Photo();
                            $picture->setAd($annonce);
                            $picture->setUrl($target_dir . $key .'.'. $imageFileType);
                            $app['em']->persist($picture);
                            $app['em']->flush();
                            /*echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$key]). " a bien été télécharger.<br>";*/
                        }
                    }
                }
            }
            $render = 1;
        }
    }
