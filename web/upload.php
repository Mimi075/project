<?php
/*var_dump($_FILES["fileToUpload"]["name"]);*/
if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] ){
 /*   echo "<pre>";
    var_dump($_FILES["fileToUpload"]["name"]);
    echo "</pre> <br>";*/

    $target_dir = "img/". $app['session']->get('user')['email'] . "/";
 
    if (file_exists($target_dir)) {
        echo "Le fichier $filename existe.<br>";
    } 
    else {
        echo "Le fichier $filename n'existe pas.<br>";
        mkdir($target_dir, 0700);
    }

    foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !== false) {
            echo "Le fichier est une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 

        else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Désolé, votre fichier existe déjà.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"][$key] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisé.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été charger.";
        // if everything is ok, try to upload file
    } 

    else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
            rename($target_file, $target_dir . $key .'.'. $imageFileType);
            echo "The file ". basename( $_FILES["fileToUpload"]["name"][$key]). " telechargement réussi.";
        }

        else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
    }
}