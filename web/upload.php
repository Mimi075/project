<?php
/*var_dump($_FILES["fileToUpload"]["name"]);*/

$errors = array();
if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] ){

    //Création du lien du dossier de reception
    $target_dir = "img/". $app['session']->get('user')['email'] . "/";
    
    //test si le lien existe, si il existe pas la creation ce fait
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0700);
    }


    foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
        if ($_FILES["fileToUpload"]["name"][$key] != "") {

            //creation du lien complet de la cible
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
            //variable pour tester si il n'y a pas d'erreur
            $uploadOk = 1;
            //neutralisation d'injection
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // test si le fichier est bien une image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);

            if($check !== false) {
                $uploadOk = 1;
            } 
            else {
                echo "Le fichier n'est pas une image.<br>";
                $uploadOk = 0;
            }

            // Test la taille du fichier
            if ($_FILES["fileToUpload"]["size"][$key] > 500000) {
                echo "Désolé, votre fichier est trop volumineux.<br>";
                $uploadOk = 0;
            }

            // Test le format du fichier
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
                echo "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisé.<br>";
                echo 'type : ' . $imageFileType.'<br>';
                $uploadOk = 0;
            }

            // Test si il n'y a pas d'erreur 
            if ($uploadOk == 0) {
                echo "Désolé, votre fichier n'a pas été charger.";
                
            } 
            // si tout est ok, on tente de charger le fichier
            else {

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
                    rename($target_file, $target_dir . $key .'.'. $imageFileType);
                    echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$key]). " a bien été télécharger.<br>";
                }

                else {
                    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.<br>";
                }
            }
        }
    }
}