<?php
namespace App\v1\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller de Exemplo
 */
class ExemploController{

	/**
	 * Container - Ele recebe uma instancia de um 
	 * container da rota no construtor
	 * @var  object s
	 */
	protected $container;

	/**
	 * Método Construtor
	 * @param  ContainerInterface $container
	 */
	public function __construct($container){
		$this->container = $container;
	}

	/**
	 * Método de Exemplo
	 * @param  [type] $request
	 * @param  [type] $response
	 * @param  [type] $args
	 * @return  void Response
	 */
	public function metododeexemplo($request, $response, $args){
		$objectoDoContainer $this->container->get('nomedoobjeto');
		$return = $response->withJson(["Exemplo"], 200)
				->withHeader('Content-type', 'application/json');
		return $return;				
	}
}