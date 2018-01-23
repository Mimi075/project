<?php

function generereCatAni(){

    $cat = array(
        'Animaux de compagnie' => array (
            'Carnivores' => array(
                'Chien',
                'Chat',
                'Furet',
                'Autre'
            ),
            'Equidés' => array(
                'Cheval',
                'Ane',
                'Autre'
            ),
            'Oiseaux' => array(
                'Perruche',
                'Perroquet',
                'Canari',
                'Serin',
                'Pigeon',
                'Tourterelle',
                'Autre'
            ),
            'Aquariophilie' => array(
                'Poisson rouge',
                'Guppy',
                'Autre'
            ),
            'NAC' => array(
                'Iguane',
                'Chinchilla',
                'Gerbille',
                'Autre'
            )
        ),
        'Animaux de basse-cour' => array(
            'Aviculture' => array(
                'Poule',
                'Dinde',
                'Canard',
                'Oie',
                'Pigeon',
                'Caille',
                'Faisan',
                'Autre'
            ),
            'Lapin et rongeur' => array(
                'Lapin',
                "Cochon d'inde",
                'Rat',
                'Autre'
            )
        ),
        'Animaux de pacage (bétail)' =>array(
            'Bovins' => array(
                'Vache',
                'Buffle',
                'Bison',
                'Yack',
                'Autre'
            ),
            'Ovins' => array(
                'Mouton',
                'Autre'
            ),
            'Caprins' => array(
                'Chèvre',
                'Autre'
            ),
            'Porcins' => array(
                'Cochon',
                'Sanglier',
                'Autre'
            ),
            'Camélidés' => array(
                'Chameau',
                'Dromadaire',
                'Lama',
                'Alpaga',
                'Autre'
            ),
            'Cervidés' => array(
                'Renne',
                'Cerf',
                'Autre'
            )

        ),
        'Animaux aquatique' => array(
            'Pisciculture' => array(
                'Pisciculture marine',
                "Pisciculture d'étang",
                "Pisciculture d'eau douce",
                'Autre'
            ),
            'Conchyliculture' => array(
                'Ostréiculture',
                'Mytiliculture',
                'Autre'
            ),
            'Crustacés' => array(
                'Astaciculture',
                'Crevetticulture',
                'Autre'
            )
        )
    );
    
return $cat;
}

function departementListe(){
    $departementListe = [
        'departements' => ["01-Ain", "02-Aisne", "03-Allier", "04-Alpes-de-Haute-Provence", "05-Hautes-alpes", "06-Alpes-maritimes", "07-Ardèche", "08-Ardennes", "09-Ariège", "10-Aube", "11-Aude", "12-Aveyron", "13-Bouches-du-Rhône", "14-Calvados", "15-Cantal", "16-Charente", "17-Charente-maritime", "18-Cher", "19-Corrèze", "2A-Corse-du-sud", "2B-Haute-Corse", "21-Côte-d'Or", "22-Côtes-d'Armor", "23-Creuse", "24-Dordogne", "25-Doubs", "26-Drôme", "27-Eure", "28-Eure-et-loir", "29-Finistère", "30-Gard", "31-Haute-Garonne", "32-Gers", "33-Gironde", "34-Hérault", "35-Ille-et-vilaine", "36-Indre", "37-Indre-et-loire", "38-Isère", "39-Jura", "40-Landes", "41-Loir-et-cher", "42-Loire", "43-Haute-Loire", "44-Loire-atlantique", "45-Loiret", "46-Lot", "47-Lot-et-garonne", "48-Lozère", "49-Maine-et-loire", "50-Manche", "51-Marne", "52-Haute-marne", "53-Mayenne", "54-Meurthe-et-moselle", "55-Meuse", "56-Morbihan", "57-Moselle", "58-Nièvre", "59-Nord", "60-Oise", "61-Orne", "62-Pas-de-Calais", "63-Puy-de-dôme", "64-Pyrénées-atlantiques", "65-Hautes-Pyrénées", "66-Pyrénées-orientales", "67-Bas-rhin", "68-Haut-rhin", "69-Rhône", "70-Haute-saône", "71-Saône-et-loire", "72-Sarthe", "73-Savoie", "74-Haute-Savoie", "75-Paris", "76-Seine-maritime", "77-Seine-et-marne", "78-Yvelines", "79-Deux-Sèvres", "80-Somme", "81-Tarn", "82-Tarn-et-garonne", "83-Var", "84-Vaucluse", "85-Vendée", "86-Vienne", "87-Haute-vienne", "88-Vosges", "89-Yonne", "90-Territoire de belfort", "91-Essonne", "92-Hauts-de-seine", "93-Seine-SAint-Denis", "94-Val-de-marne", "95-Val-d'oise"],
        'dep' => 1
    ];
    return $departementListe;
};

function regionList(){
    $regionList = [
        'regions' => [
            'Alsace' => ["67-Bas-rhin","68-Haut-rhin"], 
            'Aquitaine' => ["24-Dordogne", "33-Gironde", "40-Landes", "47-Lot-et-Garonne", "64-Pyrénées-Atlantiques"], 
            'Auvergne' => ["03-Allier", "15-Cantal", "43-Haute-Loire", "63-Puy-de-Dôme"], 
            'Basse-Normandie' => ["14-Calvados", "50-Manche", "61-Orne"], 
            'Bourgogne' => ["58-Nièvre", "71-Saône-et-Loire", "89-Yonne"], 
            'Bretagne' => ["22-Côtes-d'Armor", "29-Finistère", "35-Ille-et-vilaine", "56-Morbihan"], 
            'Centre' => ["18-Cher", "28-Eure-et-Loir", "36-Indre", "37-Indre-et-Loire", " 41-Loir-et-Cher", "45-Loiret"], 
            'Champagne-Ardenne' => ["08-Ardennes", "10-Aube", "51-Marne", "52-Haute-Marne"], 
            'Corse' => ["2A-Corse-du-Sud", "2B-Haute-Corse"], 
            'Franche-Comté' => ["25-Doubs", "39-Jura", "70-Haute-Saône", "90-Territoire-de-Belfort"], 
            'Haute-Normandie' => ["27-Eure", " 76-Seine-Maritime"], 
            'Ile-de-France' => ["75-Paris", "77-Seine-et-Marne", "78-Yvelines", "91-Essonne", "92-Hauts-de-Seine", "93-Seine-SAint-Denis", "94-Val-de-Marne"], 
            'Languedoc-Roussillon' => ["11-Aude", "30-Gard", "34-Hérault", "48-Lozère", "66-Pyrénées-Orientales"], 
            'Limousin' => ["19-Corrèze", "23-Creuse", "87-Haute-Vienne"], 
            'Lorraine' => ["54-Meurthe-et-Moselle", "55-Meuse", "57-Moselle", "88-Vosges"], 
            'Midi-Pyrenees' => ["09-Ariège", "12-Aveyron", "31-Haute-Garonne", "32-Gers", "46-Lot", "65-Hautes-Pyrénées", "81-Tarn", "82-Tarn-et-Garonne"], 
            'Nord-Pas-de-Calais' => ["59-Nord", "62-Pas-de-Calais"], 
            'Pays-de-la-Loire' => ["44-Loire-Atlantique", "49-Maine-et-Loire", "53-Mayenne", "72-Sarthe", "85-Vendée"], 
            'Picardie' => ["02-Aisne", "60-Oise", "80-Somme"], 
            'Poitou-Charentes' => ["16-Charente", "17-Charente-Maritime", "79-Deux-Sèvres", "86-Vienne"], 
            'Provence-Alpes-Côte-d\'Azur' => ["04-Alpes-de-Haute-Provence", "05-Hautes-alpes", "06-Alpes-Maritimes", "13-Bouches-du-Rhône", "83-Var", "84-Vaucluse"], 
            'Rhone-Alpes' => ["01-Ain", "07-Ardèche", "26-Drôme", "38-Isère", "42-Loire", "69-Rhône", "73-Savoie", "74-Haute-Savoie"]
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
