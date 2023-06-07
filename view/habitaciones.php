<?php
session_start();

// Comprobamos si el usuario inicio sesión
if(!isset($_SESSION['segurity']) || $_SESSION['segurity']['login'] == false ){
    header('Location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="../style/inicio.css">
        <link rel="stylesheet" href="../style/cardH.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
          <!-- Datatable for BS5 -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
            <!-- Navbar Brand-->

            <div class="px-1 ms-xl-3 mt-1">      
                <i class="bi bi-bank2" style="color: #ffffff; font-size: 30px;"> </i>
                <span class="h3  mb-0" style="color: #ffffff;">Larcomar</span>
            </div>
           
           
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 mt-2" style="font-size: 20px;" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    <label for="" class="px-1 ms-xl-3 mt-1 text-white">User : <?= $_SESSION['segurity']['nombreusuario'] ?></label></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuracion</a></li>
                        <li><a class="dropdown-item" href="#!">Registro de actividades</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Datos del usuario</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">                        
                            <a class="nav-link mt-4" href="./dashboard.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-house-fill"></i></div>
                                Inicio
                            </a>
                            <a class="nav-link" href="./reservaciones.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Reservaciones
                            </a>
                            <a class="nav-link" href="./habitaciones.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-door-open"></i></div>
                                Habitaciones
                            </a>                                                     
                            <div class="sb-sidenav-menu-heading">Complementos</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
                                Personas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./clientes.php">Nuevo Cliente</a>
                                    <a class="nav-link" href="./usuarios.php">Nuevo Usuario</a>
                                    <a class="nav-link" href="">Nuevo Empleado</a>
                                </nav>
                            </div>                            
                            <a class="nav-link" href="./graficos.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-graph-up"></i></div>
                                Graficos
                            </a>
                                                       
                            <a class="nav-link" href="../controller/usuario.controller.php?operacion=destroy">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-in-left"></i></div>
                                Cerrar sesion
                            </a>                                                     
                                                 
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="mediun  mb-2">Conectado como:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <!-- CONTENIDO -->
                 
                <div class="container">
                <button type="button" class="btn btn-success mt-3" id="btnRegistrarH" data-bs-toggle="modal" data-bs-target="#modal-registro">Nueva habitacion</button>   
                    <div class="row mt-3 mb-5">
                        <div class="col-md-4 mb-3" id="H_dispo">
                            <div>
                                <!-- DATOS ASINCRONOS -->
                            </div>
                        </div>
                        <div class="col-md-4 mb-3" id="H_ocup">
                            <div>
                                <!-- DATOS ASINCRONOS -->
                            </div>
                        </div>
                        <div class="col-md-4 mb-3" id="H_limp">
                            <div>
                                <!-- DATOS ASINCRONOS -->
                            </div>
                        </div>

                    </div>

                    
                
                    <div class="mt-1" id="cardH">                                        
                        <div class="row">
                            <!-- DATOS ASINCRONOS -->
                        </div>
                    </div>

                </div>



                
                <!-- Modal Registro -->
                
                <div class="modal fade" id="modal-registro" tabindex="-1"   role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Registrar habitacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="" autocomplete="off" id="form_habitacion">
                                        <div class="mb-3">
                                            <label for="tipoHabitacion" class="form-label">Tipo de habitacion</label>
                                            <select  id="tipoHabitacion" class="form-select">
                                                <option value="">Selección</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="numcamas" class="form-label">Numero de camas</label>
                                            <input type="number" id="numcamas" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="numhabitacion" class="form-label">Numero de habitacion</label>
                                            <input type="number" id="numhabitacion" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="piso" class="form-label">Piso</label>
                                            <input type="number" id="piso" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="capacidad" class="form-label">Capacidad</label>
                                            <input type="number" id="capacidad" class="form-control form-control-sm">
                                        </div>   
                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio</label>
                                            <input type="number" id="precio" class="form-control form-control-sm">
                                        </div>      
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn " style="background-color: #27AE60 ;" id="btnR">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

          
          
                <div class="modal fade" id="modalId" tabindex="-1"  data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Info habitacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Sin datos ...
                            </div>                           
                        </div>
                    </div>
                </div>
                            
          
            </div>
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
          <!-- Datatable for BS5 -->
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
          <!-- CDN sweetAlert2 -->
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../js/cards-habitaciones.js"></script>
        <script>      
 
          document.addEventListener("DOMContentLoaded", () =>{        
            const cardH = document.querySelector("#cardH");
            const cuerpoCard = cardH.querySelector("div");
            const lsTipoH = document.querySelector("#tipoHabitacion");
            const btnRegistrar = document.querySelector("#btnR")

            function getHabitaciones(){
              const data = new URLSearchParams();
              data.append("operacion","habitacionGet");

              fetch("../controller/habitacion.controller.php", {
                method: 'POST',
                body: data
              })             
              .then(response => response.json())
              .then(datos => {                
                cuerpoCard.innerHTML = ``
                datos.forEach(element => {
                  let row = `
                  <div class="col-12 col-md-3 col-lg-3 mb-3">
                    <div class="card shadow dispo" data-bs-toggle="modal" data-bs-target="#modalId">
                        <div class="card-body">
                        <h4 class="card-title">Nro° ${element.numhabitacion}</h4>                        
                        <p class="card-text">S/.${element.precio} , Tipo: ${element.tipo}</p> 
                        <p class="card-text cd">${element.estado}</p>                                         
                        </div>                    
                    </div>
                  </div>                                                                                                    
                    `;
                    cuerpoCard.innerHTML += row;                
                });
              });
              
            }

            function mostrarTipoH(){
            const parameters = new URLSearchParams();
            parameters.append("operacion", "mostrarTipoH");                

                fetch("../controller/habitacion.controller.php", {
                    method: 'POST',
                    body: parameters
                })
                .then(response => response.json())
                .then(data => {                        
                    lsTipoH.innerHTML = "<option value=''>Seleccione</option>";
                    data.forEach(element => {
                        const optionTag = document.createElement("option");
                        optionTag.value = element.idtipohabitacion
                        optionTag.text = element.tipo;
                        lsTipoH.appendChild(optionTag);                        
                    });
            });

            }

            function registrarHabitacion(){
                    Swal.fire({
                        title: "¿Está seguro de registrar?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Sí",
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: '#03643a',
                        customClass: {
                            confirmButton: "spacing",
                            cancelButton: "spacing"
                        }


                    }).then((result)=>{
                        if(result.isConfirmed){

                        const parameters = new URLSearchParams();
                        parameters.append("operacion", "habitacionRegistrar");
                        parameters.append("idtipohabitacion", document.querySelector("#tipoHabitacion").value);
                        parameters.append("numcamas", document.querySelector("#numcamas").value);
                        parameters.append("numhabitacion", document.querySelector("#numhabitacion").value);
                        parameters.append("piso", document.querySelector("#piso").value);
                        parameters.append("capacidad", document.querySelector("#capacidad").value);
                        parameters.append("precio", document.querySelector("#precio").value);
                
                        fetch("../controller/habitacion.controller.php", {
                            method: 'POST',
                            body: parameters
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if(data.status){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Nueva habitacion registrada',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                                document.querySelector("#form_habitacion").reset(); 
                                $("#modal-registro").modal('hide');                                                                                      
                            }else{
                                Swal.fire("Error", data.message, "error");                                
                            }
                        });

                        }
                    });                   
                }


      





            getHabitaciones();
            mostrarTipoH();
            btnRegistrar.addEventListener("click", registrarHabitacion);
            
          });

        </script>

      
    </body>
</html>
