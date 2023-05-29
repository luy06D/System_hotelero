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
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                                    <a class="nav-link" href="layout-static.html">Nuevo Usuario</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Nuevo Empleado</a>
                                </nav>
                            </div>                                                       
                            <a class="nav-link" href="tables.html">
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
                <!-- Tabla -->
                <div class=" tableR mt-5">
                <table id="table_reservaciones" class="table table-bordered border-secondary table-sm display responsive nowrap"  width="100%" >
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>N° de cuartos</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Salida</th>
                        <th>N° habitacion</th>
                        <th>Piso</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <footer class="py-4  mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 1996-2023 Larcomar.com . Todos los derechos reservados</div>
                            <div >
                                <a href="#" style="text-decoration: none; color:#C2C2C2 ;">Privacy Policy</a>
                                &middot;
                                <a href="#" style="text-decoration: none; color:#C2C2C2 ;" >Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
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
  

        <!-- <script>

          document.addEventListener("DOMContentLoaded", () =>{



            const table_reservaciones = document.querySelector("#table_reservaciones");
            const cuerpoTabla = table_reservaciones.querySelector("tbody");

            function getReservaciones(){
              const data = new URLSearchParams();
              data.append("operacion","reservacionesGet");

              fetch("../controller/reservacion.controller.php", {
                method: 'POST',
                body: data
              })
              .then(response => response.json())
              .then(datos => {
                datos.forEach(element => {
                  let row = `
                    <tr>
                      <td>${element.idreservacion}</td>
                      <td>${element.numcuarto}</td>
                      <td>${element.fechaentrada}</td>
                      <td>${element.fechasalida}</td>
                      <td>${element.numhabitacion}</td>
                      <td>${element.piso}</td>
                      <td>${element.capacidad}</td>
                      <td>${element.precio}</td>
                      <td>
                        <a href='#' class=' eliminar btn btn-danger btn-sm ' data-iddemo='${element.idreservacion}' >Eliminar</a>
                        <a href='#' class=' editar btn btn-info btn-sm ' data-iddemo='${element.idreservacion}' >Editar</a>
                      </td>
                    </tr>
                    `;

                    cuerpoTabla.innerHTML += row;

                  
                });
              });
              
            }

            getReservaciones();

          });

        </script> -->


        <script>
          $(document).ready(function (){

            function get_reservaciones(){
              $.ajax({
                url:'../controller/reservacion.controller.php',
                type: 'POST',
                data: {'operacion' : 'reservacionesGet'},
                success: function (result){

                  var tablaDT = $("#table_reservaciones").DataTable();
                  tablaDT.destroy();

                  $("#table_reservaciones tbody").html(result);

                  $("#table_reservaciones").DataTable({
                    dom: 'Bfrtip',
                    responsive:true,
                    language: {
                                url: '../js/Spanish.json'
                            }
                  });
                }
              });
            }

           
            get_reservaciones();

          });
        </script>
    </body>
</html>
