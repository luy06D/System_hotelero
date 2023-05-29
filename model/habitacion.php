<?php
require_once 'conexion.php';

class Habitaciones extends Conexion{

    private $conexion;

    //Método constructor
    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }
    //Método para mostrar habitaciones
    public function habitacionesGet(){
        try{
            $query = $this->conexion->prepare("CALL spu_habitaciones_data()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $e){
            die($e->getMessage());

        }
    }


}


?>