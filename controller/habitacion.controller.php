<?php

require_once '../model/habitacion.php';

if(isset($_POST['operacion'])){

    $habitacion = new Habitaciones();

    if($_POST['operacion'] == 'habitacionGet'){
        $dataObtenida = $habitacion->habitacionesGet();
        if($dataObtenida){
            echo json_encode($dataObtenida);
        }

    


      
    }

}

?>