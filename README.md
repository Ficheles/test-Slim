# Test-Slim

> Referencias:

* [Vue.js - jwt](https://imasters.com.br/back-end/trabalhando-autenticacao-com-jwt-e-vue-2)

* [Slim-FW:01](https://medium.com/@fidelissauro/slim-framework-criando-microservices-01-composer-e-depend%C3%AAncias-f9c8b8798205) Composer e Dependencias
	* $ mkdir slim-microservices
	* $ cd slim-microservices/
	* $ composer require slim/slim
	* $ touch index.php
	* $ php -S localhost:8000
* [Slim-FW:02](https://medium.com/@fidelissauro/slim-framework-criando-microservices-02-implementando-m%C3%A9todos-e-responses-http-708570fa748d) Implementando metodos e responses
	* $ php -S localhost:8000
	* $ curl -X GET http://localhost:8000/book
	* $ curl -X GET http://localhost:8000/book/12
	* $ curl -X POST http://localhost:8000/book
	* $ curl -X PUT http://localhost:8000/book/12
	* $ curl -X DELETE http://localhost:8000/book/12

* [Slim-FW:03](https://medium.com/@fidelissauro/slim-framework-criando-microservices-03-camada-de-persist%C3%AAncia-com-doctrine-e-data-mapping-a15df5483bc2) Camada de persistencia com doctrine
	* $ touch bootstrap.php
	* $ mkdir -p src/Models/Entity
	* $ composer require doctrine/orm
	* $ vendor/bin/doctrine orm:schema-tool:update --force
* [Slim-FW:04](https://medium.com/@fidelissauro/slim-framework-criando-microservices-04-crud-completo-via-api-com-doctrine-13e839432610) Crud completo via API
	* $ curl -X GET http://localhost/book
	* $ curl -X GET http://localhost/book/1
	* $ curl -X POST http://localhost:8000/book -H "Content-type: application/json" -d '{"name":"Deuses Americanos Versão 2", "author":"Neil Gaiman"}'
	* $ curl -X PUT http://localhost:8000/book/2 -H "Content-type: application/json" -d '{"name":"Deuses Americanos Versão 2", "author":"Neil Gaiman"}'
	* $ curl -X DELETE http://localhost:8000/book/3

* [Slim-FW:05](https://medium.com/@fidelissauro/slim-framework-criando-microservices-05-valida%C3%A7%C3%B5es-e-exceptions-na-api-fd1f48087a2d) Validações e exceptions
	* $ curl -X POST http://localhost:8000/book -H "Content-type: application/json" -i
	* throw new \Exception("Exception de Teste", 503);
* [Slim-FW:06](https://medium.com/@fidelissauro/slim-framework-criando-microservices-06-middlewares-logging-e-http-errors-fallback-8b45bd6ce85c) Middlewares loggin e http errors
	* $ composer require oscarotero/psr7-middlewares
	* use Psr7Middlewares\Middleware\TrailingSlash;
	* $app->add(new TrailingSlash(false));
	* $ composer require monolog/monolog
	* $ mkdir logs/
	* $ curl -X PATCH  --verbose http://localhost:8000/book
	* $ curl -X PATCH  --verbose http://localhost:8000/book/1
* [Slim-FW:07](https://medium.com/@fidelissauro/slim-framework-criando-microservices-07-implementando-seguran%C3%A7a-b%C3%A1sica-com-http-auth-e-proxy-ed6dd6d517f4) Implementando seguranca com auth
	* $ composer require tuupola/slim-basic-auth
	* $ curl -X GET http://localhost:8000/auth
	* $ curl -u root:toor -X GET http://localhost:8000/auth
	* $ composer require firebase/php-jwt
	* $ composer require tuupola/slim-jwt-auth
	* $ composer require akrabat/rka-scheme-and-host-detection-middleware
	
* [Slim-FW:08](https://medium.com/@fidelissauro/lim-framework-criando-microservices-08-implementando-versionamento-e-controllers-para-as-routes-4572b67716cc) Implemetando versionamento e controllers para routes
	* $ mkdir -p src/v1/Controllers
	* $ touch src/v1/Controllers/booksController.php
	* $ touch src/v1/Controllers/AuthController.php
	* $ touch routes.php
	* \App\v1\Controllers\AuthController::class

> Complementares:

* [Gist Auth](https://packagist.org/packages/tuupola/slim-basic-auth)

* [Auth from DB](http://www.appelsiini.net/2014/slim-database-basic-authentication)

* [Doctrine ORM](https://www.webdevbr.com.br/instalando-o-doctrine-orm-como-criar-um-crud-com-php)

* [ORM DOCs](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/annotations-reference.html#annref_column) Doctrine Documentação (annotations reference)

* [json API](https://jsonplaceholder.typicode.com/)

* [table-edit](https://markcell.github.io/jquery-tabledit/#examples)

* Links Twig
	* [Twig 1](http://www.diegobrocanelli.com.br/php/twig-a-super-engine-template-para-php/)
	* [Twig 2](http://www.devfuria.com.br/php/introducao-ao-twig-template/)

*Dica*
[.gitignore](https://gist.github.com/kelvinst/7d508da482d13bb301c9)
[git Flow](http://danielkummer.github.io/git-flow-cheatsheet/index.pt_BR.html)
[Branch Git](https://nvie.com/posts/a-successful-git-branching-model/)
[charset utf8](https://www.fileformat.info/info/charset/UTF-8/list.htm)
[School-VueJs](https://github.com/Webschool-io/vuejs-2-na-pratica/tree/master/Apostila)
[FlexBox](https://demos.scotch.io/visual-guide-to-css3-flexbox-flexbox-playground/demos/)
