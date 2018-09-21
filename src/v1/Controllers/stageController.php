<?php
namespace App\v1\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Entity\Stage;

/**
 * Controller v1 de Stage
 */
class StageController{

    /**
     * Container Class
     * @var  [object]
     */
    private $container;

    /**
     * Undocumented function
     * @param  [object] $container
     */
    public function __construct($container){
        $this->container = $container;
    }

    /**
     * Listagem de Stage
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function listStage($request, $response, $args){
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');
        
        /**
         * Instância da nossa Entidade 
         */
        $stageRepository = $entityManager->getRepository('App\Models\Entity\Stage');

        /**
         * Retorna dados da consulta
         */
        foreach ($stageRepository->findAll() as $stagekey => $value) {
            $stages[] = $stage->getValues();
        }
        /**
         * 
         */
        $return = $response->withJson($stages, 200)
                ->withHeader('Content-Type', 'application/json');
        return $return;

    }
    
    /**
     * Cria um Stage
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function createStage($request, $response, $args){
        $param = (object) $request->getParams();
        
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');

        /**
         * Instância da nossa Entidade preenchida com nossos parametros do post
         */
        
        $stage = (new Stage())->setTicket($request->getParam('ticket'))
                              ->setTimestemp($request->getParam('dataHora'))
                              ->setObs($request->getParam('note'));

        /**
         * Registra a criação do stage
         */
        $logger = $this->container->get('logger');
        $logger->info('Ticket Created!', $stage->getValues());

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($stage);
        $entityManager->flush();

        $return = $response->withJson($stage, 200)
                ->withHeader('Content-Type', 'application/json');

        return $return;     

    }

    /**
     * Exibe as informações de um stage
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function viewStage($request, $response, $args){

        $id = (int) $args['id'];

        $entityManager = $this->container->get('em');
        $stageRepository = $entityManager->getRepository('App\Models\Entity\Stage');
        $stage = $stageRepository->find($id);

        /**
         * Verifica se existe um stage com a ID informada
         */
        if(!$stage){
            $logger = $this->container->get('logger');
            $logger->warning("Stage {$id} Not Found");
            throw new \Exception("Stage not Found", 404);
        }

        $return = $response->withJson($stage, 200)
                ->withHeader('Content-Type', 'application/json');

        return $return;
    }

    /**
     * Atualiza um stage
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function updateStage($request, $response, $args){

        $id = (int) $args['id'];

        /**
         * Encontra o stage no Banco
         */
        $entityManager = $this->container->get('em');
        $stageRepository = $entityManager->getRepository('App\Models\Entity\Stage');
        $stage = $stageRepository->find($id);

        /**
         * Verifica se existe um stage com a ID informada
         */
        if(!$stage){
            $logger = $this->container->get('logger');
            $logger->warning("Stage {$id} not Found");
            throw new \Exception("Stage not Found", 404);
        }

        /**
         * Atualiza e Persiste o stage com os parâmetros recebidos no request
         */
        $stage->setTicket($request->getParam('ticket'))
              ->setTimestemp($request->getParam('dataHora'))
              ->setObs($request->getParam('note'));
        
        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($stage);
        $entityManager->flush();

        $return = $response->withJson($stage, 200)
                ->withHeader('Content-Type', 'application/json');

        return $return;
    }

    /**
     * Deleta um stage
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function deleteStage($request, $response, $args){

        $id = (int) $args['id'];

        /**
         * Encotra o stage no Banco
         */
        $entityManager = $this->container->get('em');
        $stageRepository = $entityManager->getRepository('App\Models\Entity\Stage');
        $stage = $stageRepository->find($id);

        /**
         * Verifica se existe um stage com a ID informada
         */
        if(!$stage){
            $logger = $this->container->get('logger');
            $logger->warning("Stage {$id} not Found");
            throw new \Exception("Stage not Found", 404);      
        }

        /**
         * Remove a entidade
         */
        $entityManager->remove($stage);
        $entityManager->flush();

        //$return = $response->withJson(['msg' => "Deletando o stage {$id}"], 200)
        //    ->withHeader('Content-type', 'application/json');

        $return = $response->withJson(null, 204);

        return $return;     
    }

}