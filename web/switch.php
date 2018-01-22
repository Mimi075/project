<?php
$subject = '27430';
$pattern = '^[0-9]{5}$';

//----------------------------------------------------------------------------------------
$delimiter = "#";
$option = "";
$pattern_ = $delimiter . $pattern . $delimiter . $option;

$j = preg_match($pattern_, $subject);
$j = $subject[0] . $subject[1];
echo ($subject)."<br>";
echo "pattern:" .($pattern)."<br>";
echo $j . PHP_EOL;

switch ($j) {
    case "67":
    case "68":
        echo "Auvergne";
        break;
    case "24":
    case "33":
    case "40":
    case "47":
    case "64":
        echo "Aquitaine";
        break;
    case "03":
    case "15":
    case "43":
    case "63":
        echo "Auvergne";
        break;
    case "14":
    case "50":
    case "61":
        echo "Basse-Normandie";
        break;
    case "58":
    case "71":
    case "89":
        echo "Bourgogne";
        break;
    case "22":
    case "29":
    case "35":
    case "56":
        echo "Bretagne";
        break;
    case "18":
    case "28":
    case "36":
    case "37":
    case "41":
    case "45":
        echo "Centre";
        break;
    case "08":
    case "10":
    case "51":
    case "52":
        echo "Champagne-Ardenne";
        break;
    case "2A":
    case "2B":
        echo "Corse";
        break;
    case "25":
    case "39":
    case "70":
    case "90":
        echo "Franche-Comté";
        break;
    case "27":
    case "76":
        echo "Haute-Normandie";
        break;
    case "75":
    case "77":
    case "78":
    case "91":
    case "92":
    case "93":
    case "94":
        echo "Ile-de-France";
        break;
    case "11":
    case "30":
    case "34":
    case "48":
    case "66":
        echo "Languedoc-Roussillon";
        break;
    case "19":
    case "23":
    case "87":
        echo "Limousin";
        break;
    case "54":
    case "55":
    case "57":
    case "88":
        echo "Lorraine";
        break;
    case "09":
    case "12":
    case "31":
    case "32":
    case "46":
    case "65":
    case "81":
    case "82":
        echo "Midi-Pyrenees";
        break;
    case "59":
    case "62":
        echo "Nord-Pas-de-Calais";
        break;
    case "44":
    case "49":
    case "53":
    case "72":
    case "85":
        echo "Pays-de-la-Loire";
        break;
    case "02":
    case "60":
    case "80":
        echo "Picardie";
        break;
    case "16":
    case "17":
    case "79":
    case "86":
        echo "Poitou-Charentes";
        break;
    case "04":
    case "05":
    case "06":
    case "13":
    case "83":
    case "84":
        echo "Provence-Alpes-Côte-d'Azur";
        break;
    case "01":
    case "07":
    case "26":
    case "38":
    case "42":
    case "69":
    case "73":
    case "74":
        echo "Rhone-Alpes";
        break;
}

?>