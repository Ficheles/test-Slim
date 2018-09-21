<?php

/**
 * Grupo dos enpoints iniciados por v1
 */
$app->group('/v1', function() {

    /**
     * Dentro de v1, o recurso /book
     */
    $this->group('/book', function() {
        $this->get('', '\App\v1\Controllers\BookController:listBook');
        $this->post('', '\App\v1\Controllers\BookController:createBook');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\v1\Controllers\BookController:viewBook');
        $this->put('/{id:[0-9]+}', '\App\v1\Controllers\BookController:updateBook');
        $this->delete('/{id:[0-9]+}', '\App\v1\Controllers\BookController:deleteBook');
    });

    /**
     * Dentro de v1, o recurso /ticket
     */
    $this->group('/ticket', function() {
        $this->get('', '\App\v1\Controllers\TicketController:listTicket');
        $this->post('', '\App\v1\Controllers\TicketController:createTicket');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\v1\Controllers\TicketController:viewTicket');
        $this->put('/{id:[0-9]+}', '\App\v1\Controllers\TicketController:updateTicket');
        $this->delete('/{id:[0-9]+}', '\App\v1\Controllers\TicketController:deleteTicket');
    });

    /**
     * Dentro de v1, o recurso /stage
     */
    $this->group('/stage', function() {
        $this->get('', '\App\v1\Controllers\StageController:listStage');
        $this->post('', '\App\v1\Controllers\StageController:createStage');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\v1\Controllers\StageController:viewStage');
        $this->put('/{id:[0-9]+}', '\App\v1\Controllers\StageController:updateStage');
        $this->delete('/{id:[0-9]+}', '\App\v1\Controllers\StageController:deleteStage');
    });

    /**
     * Dentro de v1, o recurso /auth
     */
    $this->group('/auth', function() {
        $this->get('', \App\v1\Controllers\AuthController::class);
    });
});