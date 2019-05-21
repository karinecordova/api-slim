<?php

//Autoload
$loader = require 'vendor/autoload.php';

  function getheaders(){


	     header('Access-Control-Allow-Origin: *');
	     header('Access-Control-Allow-Credentials: true');
	     header('Access-Control-Max-Age: 86400');    // cache for 1 day

	    if (isset($_SERVER['HTTP_ORIGIN'])) {
	        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	        header('Access-Control-Allow-Credentials: true');
	        header('Access-Control-Max-Age: 86400');    // cache for 1 day
	    }

	     // Access-Control headers are received during OPTIONS requests
	    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	 
	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	 
	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
	            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
	        exit(0);
	    }

	}


$app = new \Slim\Slim(array(
    'templates.path' => 'templates'
));


//Listando todas
$app->get('/pessoas/', function() use ($app){
getheaders();
	(new \controllers\Pessoa($app))->lista();
});

//get pessoa
$app->get('/pessoas/:id', function($id) use ($app){
	getheaders();
	(new \controllers\Pessoa($app))->get($id);
});

//nova pessoa
$app->post('/pessoas/', function() use ($app){
	getheaders();
	(new \controllers\Pessoa($app))->nova();
});

//edita pessoa
$app->put('/pessoas/:id', function($id) use ($app){
	getheaders();
	(new \controllers\Pessoa($app))->editar($id);
});

//apaga pessoa
$app->delete('/pessoas/:id', function($id) use ($app){
	getheaders();
	(new \controllers\Pessoa($app))->excluir($id);
});

//Rodando aplicação
$app->run();




?>