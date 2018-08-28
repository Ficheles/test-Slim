<?php
  
  use Doctrine\ORM\Tools\Setup;
  use Doctrine\ORM\EntityManager;

  /*
   * Container Resources do Slim
   * Aqui dentro dele vamos carregar todas as dependencias
   * da nossa aplicação que vão ser consumidas durante a execução
   * da nossa API
   */
  require 'vendor/autoload.php';

  $container = new \Slim\Container();

  $isDevMode = true;

  /*
   * Diretório de Entidades e Metadados do Doctrine
   */
  $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Models/Entity"), $isDevMode);
  
  /*
   * Array de configurações da nossa conexão com o banco
   */
  $conn = array(
  	'driver' => 'pdo_sqlite',
  	'path' => __DIR__ . '/db.sqlite',
  );

  /*
   * Instância do Entity Manager
   */
  $entityManager = EntityManager::create($conn, $config);

  /*
   * Coloca o Entity manager do container com o nome de em (Entity Manager)
   */
  $container['em'] = $entityManager;
  $app = new \Slim\App;