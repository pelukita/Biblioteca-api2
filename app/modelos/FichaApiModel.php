<?php

class FichaApiModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=Biblioteca_db;charset=utf8', 'root', '');
  }

  public function getAll()
  {
    $query = $this->db->prepare('SELECT * FROM ficha');
    $query->execute([]);
    $fichas = $query->fetchAll(PDO::FETCH_OBJ);

    return $fichas;
  }

   public function get($id)
  {
    $query = $this->db->prepare('SELECT * FROM ficha  WHERE id = ?');
    $query->execute([$id]);
    $ficha = $query->fetch(PDO::FETCH_OBJ);//fetchAll() no, usar fetch() ya que se espera un solo registro.

    return $ficha;
  }

  function delete($id)
  {
    $query = $this->db->prepare('DELETE from ficha where id = ?');
    $query->execute([$id]);
  }

  function insert($usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado)
  {
    $query = $this->db->prepare("INSERT INTO ficha(usuario_id, libro_id, fecha_prestamo, fecha_devolucion, estado) VALUES(?,?,?,?,?)");

    $query->execute([$usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado]);

    return $this->db->lastInsertId();
  }

  function update($id, $usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado) {
    $query = $this->db->prepare(
      'UPDATE ficha 
      SET usuario_id = ?, libro_id = ?, fecha_prestamo = ?, fecha_devolucion = ?, estado = ?
      WHERE id = ?'
      );

  
      $query->execute([$usuario_id, $libro_id, $fecha_prestamo, $fecha_devolucion, $estado, $id]);
  }
}
