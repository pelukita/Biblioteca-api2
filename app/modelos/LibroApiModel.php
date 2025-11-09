<?php
class LibroApiModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=Biblioteca_db;charset=utf8', 'root', '');
  }

  public function getLibros()
  {
    $query = $this->db->prepare('SELECT * FROM libro');
    $query->execute([]);
    $Libros = $query->fetchAll(PDO::FETCH_OBJ);

    return $Libros;
  }
}