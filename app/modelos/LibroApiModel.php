<?php
class LibroApiModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=Biblioteca_db;charset=utf8', 'root', '');
  }

  public function getAll()
  {
    $query = $this->db->prepare('SELECT * FROM libro');
    $query->execute([]);
    $Libros = $query->fetchAll(PDO::FETCH_OBJ);

    return $Libros;
  }

   public function get($id)
  {
    $query = $this->db->prepare('SELECT * FROM libro  WHERE id = ?');
    $query->execute([$id]);
    $Libro = $query->fetchAll(PDO::FETCH_OBJ);

    return $Libro;
  }

  function delete($id)
  {
    $query = $this->db->prepare('DELETE from Libro where id = ?');
    $query->execute([$id]);
  }

  function insert($titulo, $autor, $fecha_publicacion, $genero, $stock)
  {
    $query = $this->db->prepare("INSERT INTO libro(titulo, autor, fecha_publicacion, genero, stock) VALUES(?,?,?,?,?)");

    $query->execute([$titulo, $autor, $fecha_publicacion, $genero, $stock]);

    return $this->db->lastInsertId();//vc: Returns the ID of the last inserted row or sequence value
  }
  
  function update($id, $titulo, $autor, $fecha_publicacion, $genero, $stock) {
      $query = $this->db->prepare(
        " UPDATE libro 
          SET titulo = ?, autor = ?, fecha_publicacion = ?, genero = ?, stock = ? 
          WHERE id = ? 
        ");

      $query->execute([$titulo, $autor, $fecha_publicacion, $genero, $stock, $id]);
  }
}