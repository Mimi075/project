<?php
$subject = $post['zip'];
$pattern = '^[0-9]{5}$';
"^0[1-79]([. -]?[0-9]{2}){4}$";
//----------------------------------------------------------------------------------------
$delimiter = "#";
$option = "";
$pattern_ = $delimiter . $pattern . $delimiter . $option;

$j = preg_match($pattern_, $subject);
$k = $subject[0] . $subject[1];

if ($j == 1) {

    switch ($k) {
        case "67":
        case "68":
            $region = "Alsace";
            break;
        case "24":
        case "33":
        case "40":
        case "47":
        case "64":
            $region = "Aquitaine";
            break;
        case "03":
        case "15":
        case "43":
        case "63":
            $region = "Auvergne";
            break;
        case "14":
        case "50":
        case "61":
            $region = "Basse-Normandie";
            break;
        case "58":
        case "71":
        case "89":
            $region = "Bourgogne";
            break;
        case "22":
        case "29":
        case "35":
        case "56":
            $region = "Bretagne";
            break;
        case "18":
        case "28":
        case "36":
        case "37":
        case "41":
        case "45":
            $region = "Centre";
            break;
        case "08":
        case "10":
        case "51":
        case "52":
            $region = "Champagne-Ardenne";
            break;
        case "2A":
        case "2B":
            $region = "Corse";
            break;
        case "25":
        case "39":
        case "70":
        case "90":
            $region = "Franche-Comté";
            break;
        case "27":
        case "76":
            $region = "Haute-Normandie";
            break;
        case "75":
        case "77":
        case "78":
        case "91":
        case "92":
        case "93":
        case "94":
            $region = "Ile-de-France";
            break;
        case "11":
        case "30":
        case "34":
        case "48":
        case "66":
            $region = "Languedoc-Roussillon";
            break;
        case "19":
        case "23":
        case "87":
            $region = "Limousin";
            break;
        case "54":
        case "55":
        case "57":
        case "88":
            $region = "Lorraine";
            break;
        case "09":
        case "12":
        case "31":
        case "32":
        case "46":
        case "65":
        case "81":
        case "82":
            $region = "Midi-Pyrenees";
            break;
        case "59":
        case "62":
            $region = "Nord-Pas-de-Calais";
            break;
        case "44":
        case "49":
        case "53":
        case "72":
        case "85":
            $region = "Pays-de-la-Loire";
            break;
        case "02":
        case "60":
        case "80":
            $region = "Picardie";
            break;
        case "16":
        case "17":
        case "79":
        case "86":
            $region = "Poitou-Charentes";
            break;
        case "04":
        case "05":
        case "06":
        case "13":
        case "83":
        case "84":
            $region = "Provence-Alpes-Côte-d'Azur";
            break;
        case "01":
        case "07":
        case "26":
        case "38":
        case "42":
        case "69":
        case "73":
        case "74":
            $region = "Rhone-Alpes";
            break;
    }
}
else{
    $errors[] = 'Le code postal est invalide';
}
?>