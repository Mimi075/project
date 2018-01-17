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
        'regions' => [
            'Alsace' => ["Bas-rhin","Haut-rhin"], 
            'Aquitaine' => ["Dordogne", "Gironde", "Landes", "Lot-et-Garonne", "Pyrénées-Atlantiques"], 
            'Auvergne' => ["Allier", "Cantal", "Haute-Loire", "Puy-de-Dôme"], 
            'Basse Normandie' => ["Calvados", "Manche", "Orne"], 
            'Bourgogne' => ["Nièvre", "Saône-et-Loire", "Yonne"], 
            'Bretagne' => ["Côtes d'Armor", "Finistère", "Ille-et-Vilaine", "Morbihan"], 
            'Centre' => ["Cher", "Eure-et-Loir", "Indre", "Indre-et-Loire", " Loir-et-Cher", "Loiret"], 
            'Champagne Ardenne' => ["Ardennes", "Aube", "Marne", "Haute-Marne"], 
            'Corse' => ["Corse-du-Sud", "Haute-Corse"], 
            'Franche Comté' => ["Doubs", "Jura", "Haute-Saône", "Territoire-de-Belfort"], 
            'Haute Normandie' => ["Eure", " Seine-Maritime"], 
            'Ile de France' => ["Paris", "  Seine-et-Marne", "Yvelines", "Essonne", "Hauts-de-Seine", "Seine-Saint-Denis", "Val-de-Marne"], 
            'Languedoc Roussillon' => ["Aude", "Gard", "Hérault", "Lozère", "Pyrénées-Orientales"], 
            'Limousin' => ["Corrèze", "Creuse", "Haute-Vienne"], 
            'Lorraine' => ["Meurthe-et-Moselle", "Meuse", "Moselle", "Vosges"], 
            'Midi Pyrenees' => ["Ariège", "Aveyron", "Haute-Garonne", "Gers", "Lot", "  Hautes-Pyrénées", "Tarn", "Tarn-et-Garonne"], 
            'Nord Pas de Calais' => ["Nord", "  Pas-de-Calais"], 
            'Pays de la Loire' => ["Loire-Atlantique", "Maine-et-Loire", "  Mayenne", "Sarthe", "Vendée"], 
            'Picardie' => ["Aisne", "Oise", "Somme"], 
            'Poitou Charentes' => ["Charente", "Charente-Maritime", "Deux-Sèvres", "Vienne"], 
            'Provence Alpes Cote Azur' => ["Alpes", "Hautes-Alpes", "Alpes-Maritimes", "Bouches-du-Rhône", "Var", "Vaucluse"], 
            'Rhone Alpes' => ["Ain", "Ardèche", "Drôme", "Isère", "Loire", "Rhône", "Savoie", "Haute-Savoie"]
        ],
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
