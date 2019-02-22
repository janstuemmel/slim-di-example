<?php

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use \Doctrine\ORM\EntityManagerInterface;

use \DI\ContainerBuilder;
use \DI\Bridge\Slim\App as BridgeApp;
use \Psr\Container\ContainerInterface;

class App extends \DI\Bridge\Slim\App {

    public function __construct() {

      parent::__construct();

      // routes
      $this->get('/', ['Controller\Index', 'get']);

    }

    protected function configureContainer(ContainerBuilder $builder) {
  
      $builder->addDefinitions([
        
        // specify config files
        'config.files' => [
          '?' . __DIR__ . '/../config.yml'        
        ],

        // create config object      
        Config::class => function (ContainerInterface $container) {
          return new Config($container->get('config.files'));
        },

        // slim developer mode
        'settings.displayErrorDetails' => function (ContainerInterface $container) {
          return $container->get(Config::class)->get('dev');
        },

        // create the database entity manager
        EntityManagerInterface::class => function(ContainerInterface $container) {

          $config = $container->get(Config::class);

          return createEntityManager($config->get('database'), $config->get('dev'));
        },
      ]);

    }

    public function getEntityManager() {
      return $this->getContainer()->get(EntityManagerInterface::class);
    }

    public function getConfig() {
      return $this->getContainer()->get(Config::class);
    }
}

// helper 

function createEntityManager($db, $dev = true, $dirs = [__DIR__]) {
  $config = Setup::createAnnotationMetadataConfiguration($dirs, $dev);
  return EntityManager::create($db, $config);
}