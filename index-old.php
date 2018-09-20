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


curl -X POST http://localhost:8000/v1/ticket -H "Content-type: application/json" \
     -H "X-Token:eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiQGZpZGVsaXNzYXVybyIsInR3aXR0ZXIiOiJodHRwczpcL1wvdHdpdHRlci5jb21cL2ZpZGVsaXNzYXVybyIsImdpdGh1YiI6Imh0dHBzOlwvXC9naXRodWIuY29tXC9tbXNmaWRlbGlzIn0.XUQnRUb5E7_BA7XXo7-5y_08KxuS3apX7U4Jnkmp3Go" \
     -d '{"code":"1112", "old":"", "program":"SGU2.0", "program_bio":"CAD443", "department":"Cadastro", "subject":"MIF046 - Ajustar emissão de etiquetas do beneficiário " }' 