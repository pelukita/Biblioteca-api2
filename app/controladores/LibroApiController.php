<?php
require_once 'app/modelos/LibroApiModel.php';

class LibroApiController
{
  private $modelo;

  public function __construct()
  {
    $this->modelo  = new LibroApiModel();
  }

  //obteer tdoso los libros
  function getLibros($req, $res)
  {
      $Libros = $this->modelo->getLibros();
      return $res->json($Libros, 200);
  }

  //obtern libro por ID
  function getLibro($req, $res){
    $id = $req->params->id;

    if(empty($id)){
      $Libros = $this->modelo->getLibros();
      return $res->json($Libros);
    }else {
      $Libro = $this->modelo->getLibro($id);
      
      if(!empty($Libro)) {
        return $res->json($Libro);
      }else {
      return $res->json('El libro con la id= $id no existe', 404);
      }
    }
  }
}
