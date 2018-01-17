<?php
function departementListe(){
    $departementListe = [
        'departements' => ["Ain", "Aisne", "Allier", "Alpes-de-Haute-Provence", "Hautes-alpes", "Alpes-maritimes", "Ardèche", "Ardennes", "Ariège", "Aube", "Aude", "Aveyron", "Bouches-du-Rhône", "Calvados", "Cantal", "Charente", "Charente-maritime", "Cher", "Corrèze", "Corse-du-sud", "Haute-Corse", "Côte-d'Or", "Côtes-d'Armor", "Creuse", "Dordogne", "Doubs", "Drôme", "Eure", "Eure-et-loir", "Finistère", "Gard", "Haute-garonne", "Gers", "Gironde", "Hérault", "Ille-et-vilaine", "Indre", "Indre-et-loire", "Isère", "Jura", "Landes", "Loir-et-cher", "Loire", "Haute-loire", "Loire-atlantique", "Loiret", "Lot", "Lot-et-garonne", "Lozère", "Maine-et-loire", "Manche", "Marne", "Haute-marne", "Mayenne", "Meurthe-et-moselle", "Meuse", "Morbihan", "Moselle", "Nièvre", "Nord", "Oise", "Orne", "Pas-de-calais", "Puy-de-dôme", "Pyrénées-atlantiques", "Hautes-Pyrénées", "Pyrénées-orientales", "Bas-rhin", "Haut-rhin", "Rhône", "Haute-saône", "Saône-et-loire", "Sarthe", "Savoie", "Haute-savoie", "Paris", "Seine-maritime", "Seine-et-marne", "Yvelines", "Deux-sèvres", "Somme", "Tarn", "Tarn-et-garonne", "Var", "Vaucluse", "Vendée", "Vienne", "Haute-vienne", "Vosges", "Yonne", "Territoire de belfort", "Essonne", "Hauts-de-seine", "Seine-Saint-Denis", "Val-de-marne", "Val-d'oise"],
        'dep' => 1
    ];
    return $departementListe;
};
function regionList(){
    $regionList = [
        'regions' => ['Alsace', 'Aquitaine', 'Auvergne', 'Basse Normandie', 'Bourgogne', 'Bretagne', 'Centre', 'Champagne Ardenne', 'Corse', 'Franche Comté', 'Haute Normandie', 'Ile de France', 'Languedoc Roussillon', 'Limousin', 'Lorraine', 'Midi Pyrenees', 'Nord Pas de Calais', 'Pays de la Loire', 'Picardie', 'Poitou Charentes', 'Provence Alpes Cote Azur', 'Rhone Alpes'],
        'reg' => 1
    ];
    return $regionList;
};

function formulairecategory(){
    $formulairecategory = [
        'category' => ['Bovins', 'Equins', 'Ovins', 'Caprins', 'Volailles', 'Rongeurs', 'Poissons', 'Oiseaux', 'Félinx', 'Canins', 'Réptiles', 'Autre'],
        'val' => 1
    ];
    return $formulairecategory;
};

?>
