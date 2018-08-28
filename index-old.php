<?php
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  require './vendor/autoload.php';

  $app = new \Slim\App;

  /**
   * Inicio do bang :)
   * @var string
   */
  $app->get('/', function(Request $request, Response $response) use ($app){
    $response->getBody()->write("Teste de Microservice!");
    return $response;
  });
  $app->run();
