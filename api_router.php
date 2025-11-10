<?php
require_once 'app/controladores/LibroApiController.php';
require_once 'app/controladores/FichaApiController.php';
require_once 'libs/router/router.php';

$router = new Router();

//libros
$router->addRoute('libros',     'GET',  'LibroApiController', 'getLibros');
$router->addRoute('libros/:id', 'GET',  'LibroApiController', 'getLibro');
$router->addRoute('libros',     'POST', 'LibroApiController', 'insertLibro');

$router->addRoute('libros/:id', 'DELETE', 'LibroApiController', 'deleteLibro');

$router->addRoute('libros/:id', 'PUT', 'LibroApiController', 'updateLibro');

//fichas
$router->addRoute('fichas',     'GET',  'FichaApiController', 'getFichas');
$router->addRoute('fichas/:id', 'GET',  'FichaApiController', 'getFicha');
$router->addRoute('fichas',     'POST', 'FichaApiController', 'insertFicha');

$router->addRoute('fichas/:id', 'DELETE', 'FichaApiController', 'deleteFicha');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
