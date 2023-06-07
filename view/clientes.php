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
                    <div class="row mt 3">
                        <div class="col-md-4">
                            <form action="" autocomplete="off" id="form_clientes">
                                <div class="card mt-4">
                                    <div class="card-header">
                                        Registro de clientes
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="nombres" class="form-label">Nombres</label>
                                            <input type="text" id="nombres" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="apellidos" class="form-label">Apellidos</label>
                                            <input type="text" id="apellidos" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="dni" class="form-label">DNI</label>
                                            <input type="number" id="dni" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="number" id="telefono" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" id="fechaNac" class="form-control form-control-sm">
                                        </div>        

                                        <div class="d-grid gap-2">
                                        <button style="background-color: #5DADE2; color:#ffffff" class="btn" id="btnRegistrar" type="button" >Registrar</button>                                            
                                        </div>                                
                                    </div>
                                  
                                </div>

                            </form>
                        </div>
                                        <!-- Tabla -->
                            <div class="col-md-8 tableR ">
                                <table id="table_clientes" class="table table-bordered border-secondary table-sm display responsive nowrap"  width="100%" >
                                    <thead>
                                    <tr>                                           
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>DNI</th>
                                        <th>Telefono</th>
                                        <th>Fecha de Nacimiento</th>                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- DATOS ASINCRONOS -->
                                    </tbody>
                                </table>
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
        <!-- SweetAlert2 CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>

            $(document).ready(function (){

                function clientesListar(){
              $.ajax({
                url:'../controller/cliente.controller.php',
                type: 'POST',
                data: {'operacion' : 'clientesListar'},
                success: function (result){

                  var tablaDT = $("#table_clientes").DataTable();
                  tablaDT.destroy();

                  $("#table_clientes tbody").html(result);

                  $("#table_clientes").DataTable({
                    dom: 'Bfrtip',
                    responsive:true,
                    language: {
                                url: '../js/Spanish.json'
                            }
                  });
                }
              });
            }

            function clientesRegistrar(){

                let dataR = {
                    'operacion'     :'clientesRegistrar',
                    'nombres'       : $("#nombres").val(),
                    'apellidos'     : $("#apellidos").val(),
                    'dni'           : $("#dni").val(),
                    'telefono'      : $("#telefono").val(),
                    'fechaNac'      : $("#fechaNac").val(),
                };

                Swal.fire({
                    title: "¿Desea registrar un nuevo cliente?",                    
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#28B463",
                    cancelButtonColor: "#5DADE2",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Cancelar",

                }).then(function (result){
                    if(result.isConfirmed){
                        $.ajax({
                            url: '../controller/cliente.controller.php',
                            type: 'POST',
                            data: dataR,
                            success: function(result){                                
                                clientesListar();
                                $("#form_clientes")[0].reset();
                                

                            }
                        });
                    }
                })

            }

            $("#btnRegistrar").click(clientesRegistrar);

            clientesListar();


            });
        </script>

    </body>
</html>



