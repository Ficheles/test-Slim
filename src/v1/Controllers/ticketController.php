<?php
namespace App\v1\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Entity\Ticket;

/**
 * Controller v1 de Ticket
 */
class TicketController{

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
     * Listagem de Ticket
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function listTicket($request, $response, $args){
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');
        
        /**
         * Instância da nossa Entidade 
         */
        $ticketRepository = $entityManager->getRepository('App\Models\Entity\Ticket');

        /**
         * Retorna dados da consulta
         */
        foreach ($ticketRepository->findAll() as $ticket){
            $tickets[] = $ticket->getValues();  // para acessar as propriedades do tickets
        }   
        
        /**
         * 
         */
        $return = $response->withJson($tickets, 200)
                ->withHeader('Content-Type', 'application/json');
        return $return;

    }
    
    /**
     * Cria um ticket
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function createTicket($request, $response, $args){
        $param = (object) $request->getParams();
        
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');

        /**
         * Instância da nossa Entidade preenchida com nossos parametros do post
         */
        
        $ticket = (new Ticket())->setCod($request->getParam('code'))
                                ->setOld($request->getParam('old'))
                                ->setProgram($request->getParam('program'))
                                ->setTemplate($request->getParam('program_bio'))
                                ->setDepartment($request->getParam('department'))
                                ->setSubject($request->getParam('subject'));

        /**
         * Registra a criação do ticket
         */
        $logger = $this->container->get('logger');
        $logger->info('Ticket Created!', $ticket->getValues());

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($ticket);
        $entityManager->flush();

        $return = $response->withJson($ticket, 200)
                ->withHeader('Content-Type', 'application/json');

        return $return;     

    }

    /**
     * Exibe as informações de um ticket
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function viewTicket($request, $response, $args){

        $id = (int) $args['id'];

        $entityManager = $this->container->get('em');
        $ticketRepository = $entityManager->getRepository('App\Models\Entity\Ticket');
        $ticket = $ticketRepository->find($id);

        /**
         * Verifica se existe um ticket com a ID informada
         */
        if(!$ticket){
            $logger = $this->container->get('logger');
            $logger->warning("Ticket {$id} Not Found");
            throw new \Exception("Ticket not Found", 404);
        }

        $return = $response->withJson($ticket, 200)
                ->withHeader('Content-Type', 'application/json');

        return $return;
    }

    /**
     * Atualiza um ticket
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function updateTicket($request, $response, $args){

        $id = (int) $args['id'];

        /**
         * Encontra o ticket no Banco
         */
        $entityManager = $this->container->get('em');
        $ticketRepository = $entityManager->getRepository('App\Models\Entity\Ticket');
        $ticket = $ticketRepository->find($id);

        /**
         * Verifica se existe um ticket com a ID informada
         */
        if(!$ticket){
            $logger = $this->container->get('logger');
            $logger->warning("Ticket {$id} not Found");
            throw new \Exception("Ticket not Found", 404);
        }

        /**
         * Atualiza e Persiste o ticket com os parâmetros recebidos no request
         */
        $ticket->setCod($request->getParam('code'))
               ->setOld($request->getParam('old'))
               ->setProgram($request->getParam('program'))
               ->setTemplate($request->getParam('program_bio'))
               ->setDepartment($request->getParam('department'))
               ->setSubject($request->getParam('subject'));

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($ticket);
        $entityManager->flush();

        $return = $response->withJson($ticket, 200)
                ->withHeader('Content-Type', 'application/json');

        return $return;
    }

    /**
     * Deleta um ticket
     * @param  [type] $request
     * @param  [type] $response
     * @param  [type] $args
     * @return Response
     */
    public function deleteTicket($request, $response, $args){

        $id = (int) $args['id'];

        /**
         * Encotra o ticket no Banco
         */
        $entityManager = $this->container->get('em');
        $ticketRepository = $entityManager->getRepository('App\Models\Entity\Ticket');
        $ticket = $ticketRepository->find($id);

        /**
         * Verifica se existe um ticket com a ID informada
         */
        if(!$ticket){
            $logger = $this->container->get('logger');
            $logger->warning("Ticket {$id} not Found");
            throw new \Exception("Ticket not Found", 404);      
        }

        /**
         * Remove a entidade
         */
        $entityManager->remove($ticket);
        $entityManager->flush();

        //$return = $response->withJson(['msg' => "Deletando o ticket {$id}"], 200)
        //    ->withHeader('Content-type', 'application/json');

        $return = $response->withJson(null, 204);

        return $return;     
    }

}