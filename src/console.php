<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

$console = new Application('My Silex Application', 'n/a');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);

$console
    ->register('my-command')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('My command description')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
        // do something
    })
;

$console
	->register('fill-database')
	->setCode(function (){

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

		foreach ($cat as $key => $value) {
        
            /*$category = new Entity\Categorie();
            $category->setName($key);
            $app['em']->persist($category);
            $app['em']->flush();*/
        	echo $key;
        
        	foreach ($cat[$key] as $key2 => $value2) {
            
                /*$subCategory = new Entity\SousCategorie();
                $subCategory->setName($key2);
                $app['em']->persist($subCategory);
                $app['em']->flush();*/
            	echo $key2;

            	foreach ($cat[$key][$key2] as $key3 => $value3) {

                    /*$animal = new Entity\Animal();
                    $animal->setName($value3);
                    $app['em']->persist($animal);
                    $app['em']->flush();*/
                    echo $value3;
            	}
        	}
    	}

	});

return $console;
