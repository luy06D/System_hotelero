<?php

require_once '../model/usuario.php';

if(isset($_GET['operacion'])){

  //Instancia de la clase usuario
  $usuario = new Usuario();

  if($_GET['operacion'] == 'destruir'){
    session_destroy(); //Elimina la sesión
    session_unset(); //unset libera recursos
    header('Location:../index.html');
  }


  if($_GET['operacion'] == 'iniciarSesion'){
    
    $acceso = [
      "login"     => false,
      "apellidos" => "",
      "nombres"   => "",
      "mensaje"   => "" 
    ];

    $data = $usuario->iniciarSesion($_GET['nombreusuario']);
    $claveI = $_GET['password'];

    if($data){

      if(password_verify($claveI, $data['claveacceso'])){

        $acceso["login"] = true;
        $acceso["apellidos"] = $data["apellidos"];
        $acceso["nombres"] = $data["nombres"];

      }else{
        $acceso["mensaje"] = "Contraseña incorrecta";
      }

    }else{
      $acceso["mensaje"] = "El usuario ingresado no existe";
    }

    echo json_encode($acceso);


  }
}

?>