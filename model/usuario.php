<?php
require_once 'conexion.php';

class Usuario extends Conexion{

  //Objeto
  private $acceso;

  public function __CONSTRUCT(){
    $this->acceso = parent::getConexion();
  }

  public function iniciarSesion($nombreusuario = "CALL spu_usuarios_login(?)"){
    //Manejador de excepciones try - catch
    try{
      $query = $this->acceso->prepare("");
      $query->execute(array($nombreusuario));

      return $query->fetch(PDO::FETCH_ASSOC);

    }
    catch(Exception $e){
      die($e->getMessage());

    }
  }


}

?>