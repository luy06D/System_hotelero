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
                <!-- CONTENIDO -->
                <div class="container">
                    <div class="row mt-3">

                        <div class="col-md-12 col-lg-12">
                            <form action="" id="form-reservaciones" autocomplete="off">
                                <div class="card">
                                    <div class="card-header">
                                        Registro de usuarios
                                    </div>
                                    <div class="card-body">                                        
                                        <div class="mb-3">
                                            <label for="persona" class="form-label">Persona</label>
                                            <select  id="persona" class="form-select">
                                                <option value="">Selección</option>
                                            </select>
                                        </div>                                       
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="number" id="email" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nombreusuario" class="form-label">Nombre de usuario</label>
                                            <input type="date" id="nombreusuario" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contraseña" class="form-label">Contraseña</label>
                                            <input type="date" id="contraseña" class="form-control form-control-sm">
                                        </div>                                        
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-sm btn-success" id="guardar" type="button">Registrar</button>
                                            <button class="btn btn-sm btn-secondary" type="reset">Reiniciar</button>
                                            
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                
                
                  <!-- TABLA USUARIOS -->
                  <div class=" tableR ">
                  <table id="table_usuarios" class="table table-bordered border-secondary table-sm display responsive nowrap"  width="100%" >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Email</th>
                          <th>Nombre de usuario</th>                      
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
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

        <script>
          $(document).ready(function (){

            function get_usuarios(){
              $.ajax({
                url: '../controller/usuarionew.controller.php',
                type: 'POST',
                data: {'operacion' : 'usersGet'},
                success: function (result){
                  var dt = $("#table-usuarios").DataTable();
                  dt.destroy();

                  $("#table_usuarios tbody").html(result);

                  $("#table_usuarios").DataTable({
                    dom: 'Bfrtip',
                    responsive: true,
                    languaje: {
                       url:'../js/Spanish.json'
                    }
                  });
                }
              });
            }

            get_usuarios();
          });
        </script>

      


    </body>
</html>
