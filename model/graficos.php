<?php
require_once 'conexion.php';

class Graficos extends Conexion{

  private $conexion;
  
     //Método constructor
     public function __CONSTRUCT(){
      $this->conexion = parent::getConexion();
  }

    public function getTotalSemana(){
      try{
        $query = $this->conexion->prepare("");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }


}

?>