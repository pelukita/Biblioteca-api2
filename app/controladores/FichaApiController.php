<?php
require_once 'app/modelos/FichaApiModel.php';

class FichaApiController
{
   private $modelo;

  public function __construct()
  {
    $this->modelo  = new FichaApiModel();
  }

  //obtener tdoso las Fichas
  public function getFichas($req, $res)
  {
      $fichas = $this->modelo->getAll();
      return $res->json($fichas, 200);
  }

  //obtener ficha por ID
  public function getFicha($req, $res){
    $id = $req->params->id;

    if(empty($id)){
      $fichas = $this->modelo->getAll();
      return $res->json($fichas);
    }else {
      $ficha= $this->modelo->get($id);
      
      if(!empty($ficha)) {
        return $res->json($ficha);
      }else {
      return $res->json("La ficha con la id=$id no existe", 404);
      }
    }
  }
  //------------------------METODO GET---------------------------

  //eliminar Ficha
  public function deleteFicha($req, $res)
  {
    $ficha_id = $req->params->id;
    $ficha = $this->modelo->get($ficha_id);
    if (!$ficha)
      {
        return $res->json("La ficha con el id=$ficha_id no existe", 404);
      }

    if ($ficha){
      $this->modelo->get($ficha_id);
      $res->json("La ficha con el id=$ficha_id se elimino con éxito", 204);
    }else{
      $res->json("FIcha id=$ficha_id not found", 404);
    }
  }
  //------------------------METODO DELETE---------------------------

  public function insertFicha($req, $res)
  {

    $usuario_id = $req->body->usuario_id;
    $libro_id = $req->body->libro_id;
    $fecha_prestamo = $req->body->fecha_prestamo;
    $fecha_devolucion = $req->body->fecha_devolucion;
    $estado = $req->body->estado;

    
    $ficha = $this->modelo->insert($usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado);
    $res->json($ficha, 201);  

   
  }

//------------------------METODO POST---------------------------

}