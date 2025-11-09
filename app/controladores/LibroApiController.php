<?php
require_once 'app/modelos/LibroApiModel.php';

class LibroApiController
{
  private $modelo;

  public function __construct()
  {
    $this->modelo  = new LibroApiModel();
  }

  function getLibros($req, $res)
  {
      $Libros = $this->modelo->getLibros();
      return $res->json($Libros, 200);
  }

}
