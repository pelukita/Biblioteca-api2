<?php
require_once 'app/modelos/LibroApiModel.php';

class LibroApiController
{
  private $modelo;

  public function __construct()
  {
    $this->modelo  = new LibroApiModel();
  }

  //obtener tdoso los libros
  public function getLibros($req, $res)
  {
      $Libros = $this->modelo->getAll();
      return $res->json($Libros, 200);
  }

  //obtener libro por ID
  public function getLibro($req, $res){
    $id = $req->params->id;

    if(empty($id)){
      $Libros = $this->modelo->getAll();
      return $res->json($Libros);
    }else {
      $libro = $this->modelo->get($id);
      
      if(!empty($libro)) {
        return $res->json($libro);
      }else {
      return $res->json("El libro con la id=$id no existe", 404);
      }
    }
  }
  //------------------------METPDO GET---------------------------

  //eliminar libro
  public function deleteLibro($req, $res)
  {
    $libro_id = $req->params->id;
    $libro = $this->modelo->get($libro_id);

    if (!$libro)
      {
        return $res->json("El libro con el id=$libro_id no existe", 404);
      }

    if ($libro)
      {
      $this->modelo->delete($libro_id);
      $res->json("el libro con el id=$libro_id se elimino con éxito", 204);
      }else{
        $res->json("Libro id=$libro_id not found", 404);
    }
  }
  //------------------------METODO DELETE---------------------------

//añadir lñibro
  public function insertLibro($req, $res)
  {
    $titulo = $req->body->titulo;
    $autor = $req->body->autor;
    $fecha_publicaion = $req->body->fecha_publicaion;
    $genero = $req->body->genero;
    $stock = $req->body->stock;

    $libro_id = $this->modelo->insert($titulo, $autor, $fecha_publicaion, $genero, $stock);
    $res->json($libro_id, 201); // buena practica devolver el ID creado -(°v°)?
  }

//------------------------METODO POST---------------------------

//actualizar libro (similar al POST)
  public function updateLibro($req, $res)
    {
      $libro_id = $req->params->id;
      $libro = $this->modelo->get($libro_id);
  
      if (!$libro) {
          return $res->json("El libro con el id=$libro_id no existe", 404);
      }

      if (
          empty($req->body->titulo) ||
          empty($req->body->autor) ||
          empty($req->body->fecha_publicacion) ||
          empty($req->body->genero) ||
          empty($req->body->stock)
      ) {
          return $res->json('Faltan datos', 400);
      }

      $titulo = $req->body->titulo;
      $autor = $req->body->autor;
      $fecha_publicacion = $req->body->fecha_publicacion;
      $genero = $req->body->genero;
      $stock = $req->body->stock;

      $this->modelo->update($libro_id, $titulo, $autor, $fecha_publicacion, $genero, $stock);

      $updatedLibro = $this->modelo->get($libro_id);
      return $res->json($updatedLibro, 201); 
    }

//----------------------   METODO PUT---------------------------
}
