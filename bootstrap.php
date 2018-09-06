<?php
  
  require 'vendor/autoload.php';

  use Doctrine\ORM\Tools\Setup;
  use Doctrine\ORM\EntityManager;
  use Psr7Middlewares\Middleware\TrailingSlash;
  use Monolog\Logger;
  use Firebase\JWT\JWT;


  /**
   * Configurações
   */
  $configs = [
      'settings' => [
          'displayErrorDetails' => true,
      ],
  ];


  /*
   * Container Resources do Slim
   * Aqui dentro dele vamos carregar todas as dependencias
   * da nossa aplicação que vão ser consumidas durante a execução
   * da nossa API
   */
  $container = new \Slim\Container($configs);


  /**
   * Converte os Exceptions dentro da Aplicação em respostas JSON
   */
  $container['errorHandler'] = function ($container){
    return function ($request, $response, $exception) use ($container){
      $statusCode = $exception->getCode() ? $exception->getCode() : 500;
      return $container['response']->withStatus($statusCode)
          ->withHeader('Content-Type', 'Application/json')
          ->withJson(['message' => $exception->getMessage()], $statusCode);
    };
  };

  
  /**
   * Convert os Exceptions de Erros 405 - Not Allowed
   */
  $container['notAllowedHandler'] = function($container){
    return function($request, $response, $methods) use ($container) {
        return $container['response']
          ->withStatus(405)
          ->withHeader('Allow', implode(', ', $methods))
          ->withHeader('Content-Type', 'Application/json')
          ->withHeader('Access-Control-Allow-Methods', implode(', ', $methods))
          ->withJson(['message' => 'Method not Allowed; Method must be one of: ' .implode(', ', $methods)], 405);

    };
  };


  /**
   * Convert os Exceptions de Erros 404 - Hot Found
   */
  $container['notFoundHandler'] = function ($container){
    return function($request, $response) use($container){
      return $container['response']
          ->withStatus(404)
          ->withHeader('Content-Type', 'Application/json')
          ->withJson(['message' => 'Page not found']);
    };
  };


  /**
   * Serviço de Logging em Arquivo
   * 
   */
  $container['logger'] = function($container){
    $logger = new Monolog\Logger('books-microservice');
    $logfile = __DIR__ . '/logs/books-microservice.log';
    $stream = new Monolog\Handler\StreamHandler($logfile, Monolog\Logger::DEBUG);
    $fingersCrossed = new Monolog\Handler\FingersCrossedHandler($stream, Monolog\Logger::INFO);
    $logger->pushHandler($fingersCrossed);

    return $logger;
  };

  
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
  

  /**
   * Token do nosso JWT
   */
  $container['secretkey'] = "secretloko";


  $app = new \Slim\App($container);


  /**
   * @Middleware Tratamento da / do Request
   * true - Adiciona a / no final da URL
   * false - Remove a / no final da URL
   */
  $app->add(new TrailingSlash(false));


  /**
   * Auth básica HTTP
   */
   $app->add(new \Slim\Middleware\HttpBasicAuthentication([
      /**
       * Usuário existentes
       */
      "users" => [
        "root" => "toor"
      ],

      /**
       * Blacklist - Deixa todas liberadas e so protegeas dentro do array
       */
      "path" => ["/auth", "/v1/auth"],

      /**
       * Whitelist - Protege todas as rotas e so libera as de dentro do array
       */
      // "passthrough" => ["/auth/liberada", "/adim/ping"]
   ]));


  /**
   * Auth básica do JWT
   * Whitlist - Bloqueia tudo, e só libera os 
   * itens dentro do "passthrough"
   */
  $app->add(new \Slim\Middleware\JwtAuthentication([
    "regexp" => "/(.*)/", //Regex para encontrar o Token nos Headers - Livre
    "header" => "X-Token", //O Header que vai conter o token
    "path" => "/", //Vamos cobrir toda a API a partir do /
    "passthrough" => ["/auth", "/v1/auth"], //Vamos adicionar a exceção de cobertura a rota /auth
    "realm" => "Protected",
    "secret" => $container['secretkey'] //Nosso secretkey criado
  ]));