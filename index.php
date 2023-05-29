<?php
session_start();

//Si el usuario ya tiene una sesión activa.. entonces NO DEBE ESTAR AQUI !!!
if(isset($_SESSION['segurity']) && $_SESSION['segurity']['login']){
    header('Location:view/dashboard.php');

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Larcomar</title>
  <link rel="stylesheet" href="./style/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body >


  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
  
          <div class="px-5 ms-xl-1 mt-4">      
            <i class="bi bi-bank2" style="color: #03643a; font-size: 50px;"> </i>
            <span class="h2  mb-0" style="color: #03643a;">Larcomar</span>
          </div>
  
          <div class="d-flex align-items-center h-custom-3 px-5 ms-xl-4 mt-5 pt-5 pt-xl-12 mt-xl-n5">
  
            <form style="width: 40rem; text-align: center; ">
  
              <h2 class="fw-normal mb-3 pb-3 fw-bold title" >Bienvenido a Larcomar</h2>      
                <div class="form-floating mb-4">
                  <input type="text" id="email" class="form-control form-control-lg"  placeholder="Ingrese su usuario"/>
                  <label class="form-label" for="email">Nombre Usuario</label>
                </div>
  
              <div class="form-floating mb-3">
                <input type="password" id="password" class="form-control form-control-lg" placeholder="Ingrese su contraseña"/>
                <label class="form-label" for="password">Contraseña</label>
              </div>
              
                <div class="check-mostrar mb-4" style="text-align: left; font-size: 13px; color:#9A9A9A;">
                <input class="form-check-input" type="checkbox" value="" id="checkVer">
                <label class="form-check-label" >Mostrar contraseña</label>            
                
              </div>            
              <div class="pt-1 mb-4">          
                <button class=" css-button-sliding-to-left--green  shadow "  type="button" id="iniciar-sesion">Iniciar sesion</button>
              </div>
  
              <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Olvidastes tu contraseña?</a></p>
              <p>Aun no tienes una cuenta? <a href="#!" class="link-secondary" style="text-align:center;">Registrate ahora</a></p>
  
            </form>
  
          </div>
  
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="./img/hotelIndex.jpg" alt="Login image" class="w-100 vh-100 shadow " style="object-fit:cover; object-position: center;">
        </div>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <!-- CDN sweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function(){

        var ver = false;

        function verPassword(){
            if(ver){
                document.getElementById("password").setAttribute("type", "password");
                ver = false;
            }
            else{
                document.getElementById("password").setAttribute("type", "text");
                ver = true;
            }
        }

        function login(){
            const datos = {
                "operacion" : "iniciarSesion",
                "email"     : $("#email").val(),
                "password"  : $("#password").val(),
            };
            
            $.ajax({
                url:'controller/usuario.controller.php',
                type: 'GET',
                data: datos,
                dataType: 'JSON',
                success: function(result){           
                    if(result.login){
                      Swal.fire({
                        title: 'Inicio correctamente',
                        text: 'Bienvenido: '+ `${result.apellidos} ${result.nombres}`,
                        icon: 'success',              
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#03643a'
                      }).then((result) => {
                        if(result.isConfirmed){
                            window.location.href = `./view/dashboard.php`;
                        }
                      })                 
                    }
                    else if(result.mensaje == "Contraseña"){
                      Swal.fire({
                        title: 'Contraseña incorrecta',
                        icon: 'error',
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#03643a'
                      })
                    }else{
                      Swal.fire({
                        title: 'El usuario ingresado es incorrecto',
                        icon: 'error',
                        confirmButtonText: `OK`,
                        confirmButtonColor: '#03643a'
                      })
                    }
                }
              });
        }

        $("#iniciar-sesion").click(login);

        $("#checkVer").click(verPassword);

        $("#password").keypress(function (evt){
            if(evt.keyCode == 13){
                login();
            }
        });


    });
</script>









</body>
</html>