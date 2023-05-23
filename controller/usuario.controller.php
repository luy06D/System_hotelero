<?php

require_once '../model/usuario.php';

if(isset($_POST['operacion'])){

  //Instancia de la clase usuario
  $usuario = new Usuario();

  if($_POST['operacion'] == 'destruir'){
    session_destroy(); //Elimina la sesión
    session_unset(); //unset libera recursos
    header('Location:../index.html');
  }


  if($_POST['operacion'] == 'iniciarSesion'){
    
    $acceso = [
      "login"     => false,
      "apellidos" => "",
      "nombres"   => "",
      "mensaje"   => "" 
    ];

    $data = $usuario->iniciarSesion($_POST['nombreusuario']);
    $claveI = $_POST['password'];

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