<?php

require_once '../model/reservacion.php';

if(isset($_POST['operacion'])){

    $habitacion = new Habitaciones();

    if($_POST['operacion'] == 'habitacionGet'){

        $data = $habitacion->habitacionesGet();

        if($data){
            foreach($data as $registro){
                echo "
                <div>
                    <h1>{$registro['numhabitacion']}</h1>
                    <p>{$registro['tipo']}</p>
                </div>
            
                ";
            }
            
        }
      
    }

}

?>