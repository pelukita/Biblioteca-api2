<?php
require_once 'app/modelos/FichaApiModel.php';

class FichaApiController
{
   private $modelo;
   private $libroModelo;
   
   public function __construct()
  {
    $this->modelo  = new FichaApiModel();
    $this->libroModelo  = new LibroApiModel();
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

    $this->modelo->delete($ficha_id);
    $res->json("La ficha con el id= $ficha_id se elimino con éxito", 204);
    
  }
  //------------------------METODO DELETE---------------------------

  public function insertFicha($req, $res)
  { 
    $usuario_id = $req->body->usuario_id;
    $libro_id = $req->body->libro_id;
    $fecha_prestamo = $req->body->fecha_prestamo;
    $fecha_devolucion = $req->body->fecha_devolucion;
    $estado = $req->body->estado;
    
    $newLibro = $this->libroModelo->get($libro_id);

    if(!$newLibro){
      return $res->json("No exite el libro con la id:$libro_id", 404);
    }

    $ficha = $this->modelo->insert($usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado);
    return $res->json($ficha, 201); 
   
  }

//------------------------METODO POST---------------------------

//actualizar ficha
  public function updateFicha($req, $res)
    {
      $ficha_id = $req->params->id;
      $ficha = $this->modelo->get($ficha_id);
  
      if (!$ficha) {
          return $res->json("La ficha con el id= $ficha_id no existe", 404);
      }

      if (
          empty($req->body->usuario_id) ||
          empty($req->body->libro_id) ||
          empty($req->body->fecha_prestamo) ||
          empty($req->body->fecha_devolucion) ||
          empty($req->body->estado)
        ){
          return $res->json('Faltan datos', 400);
      }

    $usuario_id = $req->body->usuario_id;
    $libro_id = $req->body->libro_id;
    $fecha_prestamo = $req->body->fecha_prestamo;
    $fecha_devolucion = $req->body->fecha_devolucion;
    $estado = $req->body->estado;

    $this->modelo->update($ficha_id, $usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado);

    $updatedFicha = $this->modelo->get($ficha_id);
    return $res->json($updatedFicha, 201); 
    }

//----------------------   METODO PUT---------------------------




//Informational Responses (100-199)

//Successful Responses (200-299)
// 200 OK: La solicitud ha tenido éxito. El significado de un éxito varía dependiendo del método HTTP:
// 201 Created: La solicitud ha tenido éxito y se ha creado un nuevo recurso como resultado de ello. Ésta es típicamente la respuesta enviada después de una petición PUT.
// 202 Accepted: La solicitud se ha recibido, pero aún no se ha actuado. Está pensado para los casos en que otro proceso o servidor maneja la solicitud, o para el procesamiento por lotes.

//Redirection Messages (300-399)
// 301 Moved Permanently: la URI del recurso solicitado ha sido cambiado. Probablemente una nueva URI sea devuelta en la respuesta.
// 302 Found: Este código de respuesta significa que el recurso de la URI solicitada ha sido cambiado temporalmente.

//Client Error Responses (400-499)
// 400 Bad Request: el servidor no pudo interpretar la solicitud dada una sintaxis inválida.
// 401 Unauthorized: Es necesario autenticar para obtener la respuesta solicitada. Esta es similar a 403, pero en este caso, la autenticación es posible.
// 403 Forbidden: El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.
// 404 Not Found: El servidor no pudo encontrar el contenido solicitado. Este código de respuesta es uno de los más famosos dada su alta ocurrencia en la web.
// 410 Gone: Esta respuesta puede ser enviada cuando el contenido solicitado ha sido borrado del servidor.

//Server Error Responses (500-599)
// 500 Internal Server Error: El servidor ha encontrado una situación que no sabe cómo manejarla.
// 503 Service Unavailable: El servidor no está listo para manejar la petición. Causas comunes puede ser que el servidor está caído por mantenimiento o está sobrecargado


}

