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

$console->setHelperSet(new Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app["em"])
)));

$console
	->register('fill-database')
	->setDescription('Fill database with category, sub category and animal')
	->setCode(function () use ($app) {

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

    	foreach ($cat as $keyCat => $valCat) {
        
    		$repository = $app['em']->getRepository(Entity\Categorie::class);
    		$query = $repository->findOneBy(['name' => $keyCat]);
    		/*echo $query->getId();*/

    		if($query === null){
      			$category = new Entity\Categorie();
      			$category->setName($keyCat);
      			$app['em']->persist($category);
      			$app['em']->flush();
    		}
    		/*echo $key;*/
        
    		foreach ($cat[$keyCat] as $keySubCat => $valSubCat) {
          
      			$repository = $app['em']->getRepository(Entity\SousCategorie::class);
      			$query = $repository->findOneBy(['name' => $keySubCat]);

      		if($query === null){
        		$repository = $app['em']->getRepository(Entity\Categorie::class);
        		$query = $repository->findOneBy(['name' => $keyCat]);

        		$subCategory = new Entity\SousCategorie();
        		$subCategory->setName($keySubCat);
        		$subCategory->setCategory($query);
        		$app['em']->persist($subCategory);
        		$app['em']->flush();
      		}
      		/*echo $key2;*/

      		foreach ($cat[$keyCat][$keySubCat] as $keyAni => $valAni) {

        		$repository = $app['em']->getRepository(Entity\Animal::class);
        		$query = $repository->findOneBy(['name' => $valAni]);

        		if($query === null){
          			$repository = $app['em']->getRepository(Entity\SousCategorie::class);
          			$query = $repository->findOneBy(['name' => $keySubCat]);
          			/*$query = $query->getId();*/

          			$animal = new Entity\Animal();
          			$animal->setName($valAni);
          			$animal->setSubCategory($query);
          			$app['em']->persist($animal);
          			$app['em']->flush();
        		}
               	/*echo $value3;*/
      		}
    	}
  	}
});

$console->addCommands(array(
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand,
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand,
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand,
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand,
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand,
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand,
    new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand,
    new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand,
    new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand,
    new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand,
    new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand,
    new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand,
    new \Doctrine\ORM\Tools\Console\Command\InfoCommand,
    new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand,
    new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand,
    new \Doctrine\DBAL\Tools\Console\Command\ImportCommand,
    new \Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand,
    new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand
));

return $console;
