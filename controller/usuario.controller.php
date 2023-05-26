
<?php
session_start();

require_once '../model/usuario.php';

if(isset($_GET['operacion'])){

  $usuario = new Usuario();

  if($_GET['operacion'] == 'destroy'){
      session_destroy();
      session_unset();
      header('Location:../index.php');

  }

  if($_GET['operacion'] == 'iniciarSesion'){

    $acceso = [
      "login"   => false,
      "apellidos" => "",
      "nombres" => "",
      "mensaje"  => ""
    ];

    $data = $usuario->iniciarSesion($_GET['email']);
    $claveIngresada = $_GET['password'];

    if($data){

      if(password_verify($claveIngresada, $data['claveacceso'])){

          $acceso["login"] = true;
          $acceso["apellidos"] = $data["apellidos"];
          $acceso["nombres"] = $data["nombres"];
      }else{
        $acceso["mensaje"] = "Error en la contraseña";
      }
    }else{
      $acceso["mensaje"] = "Usuario no encontrado";
    }

    $_SESSION['segurity'] = $acceso;

    echo json_encode($acceso);
  }



}
?>