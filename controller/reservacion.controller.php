<?php

require_once '../model/reservacion.php';

if(isset($_POST['operacion'])){

    $reservacion = new Reservaciones();

    if($_POST['operacion'] == 'clientesBuscar'){
         echo json_encode($reservacion->clientes_buscar());
    }

    if($_POST['operacion'] == 'reservacionesGet'){
        $data = $reservacion->reservaciones_get();

        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                    <td>{$registro['idreservacion']}</td>
                    <td>{$registro['cliente']}</td>
                    <td>{$registro['fechaentrada']}</td>
                    <td>{$registro['fechasalida']}</td>
                    <td>{$registro['numhabitacion']}</td>
                    <td>{$registro['piso']}</td>
                    <td>{$registro['capacidad']}</td>
                    <td>{$registro['precio']}</td> 
                </tr>          
                ";
            }
        }
    }

    if($_POST['operacion'] == 'pagosGet'){
        $data = $reservacion->pagos_get();
        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                <td>{$registro['cliente']}</td>
                <td>{$registro['fechapago']}</td>
                <td>{$registro['mediopago']}</td>
                <td>{$registro['montoDia']}</td>                
            </tr> 
                ";
            }
        }
    }

    if($_POST['operacion'] == 'reservacionRegistrar'){
        $dataSave = [
            "idusuario"         => $_POST['idusuario'],
            "idhabitacion"      => $_POST['idhabitacion'],
            "idcliente"         => $_POST['idcliente'],
            "idempleado"        => $_POST['idempleado'],
            "fechaentrada"      => $_POST['fechaentrada'],
            "fechasalida"       => $_POST['fechasalida'],
            "tipocomprobante"   => $_POST['tipocomprobante'],
            "mediopago"         => $_POST['mediopago']
        ];

        $response = $reservacion->reservaciones_register($dataSave);
        echo json_encode($response);
    }

    if($_POST['operacion'] == 'empleadosGet'){
        echo json_encode($reservacion->empleado_get());
    }

    if($_POST['operacion'] == 'usuariosGet'){
        echo json_encode($reservacion->usuario_get());
    }

    if($_POST['operacion'] == 'habitacionesGet'){
        echo json_encode($reservacion->habitacion_get());
    }

   



}



?>