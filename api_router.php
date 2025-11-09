<?php
require_once 'app/controladores/LibroApiController.php';
require_once 'libs/router/router.php';

$router = new Router();

$router->addRoute('libros',     'GET',  'LibroApiController', 'getLibros');
$router->addRoute('libros/:id', 'GET',  'LibroApiController', 'getLibro');
$router->addRoute('libros',     'POST', 'LibropiController', 'insertLibro');

$router->addRoute('fichas',     'GET',  'FichaApiController', 'getFichas');
$router->addRoute('fichas/:id', 'GET',  'FichaApiController', 'getFicha');
$router->addRoute('fihcas',     'POST', 'FichaApiController', 'insertFicha');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
