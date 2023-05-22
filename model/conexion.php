<?php

class Conexion{

  private function Conectar(){
    try{
      $pdo = new PDO("mysql:host=localhost;port=3306;dbname=systemHotelero;charset=UTF8","root","");
      return $pdo;
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  //Todo el modelo utilizará este método...
  public function getConexion(){
    try{
      $pdo = $this->Conectar();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}