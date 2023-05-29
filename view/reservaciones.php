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
                                    <a class="nav-link" href="./usuarios.php">Nuevo Usuario</a>
                                    <a class="nav-link" href="">Nuevo Empleado</a>
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
                <!-- CONTENIDO  -->
                <div class="container">
                    <div class="row mt-3">

                        <div class="col-md-12 col-lg-12">
                            <form action="" id="form-reservaciones" autocomplete="off">
                                <div class="card">
                                    <div class="card-header">
                                        Registro de reservaciones
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="idempleado" class="form-label">Empleado</label>
                                            <select  id="idempleado" class="form-select">
                                                <option value="">Selección</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="idusuario" class="form-label">Usuario</label>
                                            <select  id="idusuario" class="form-select">
                                                <option value="">Selección</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="idhabitacion" class="form-label">Habitacion</label>
                                            <select  id="idhabitacion" class="form-select">
                                                <option value="">Selección</option>
                                            </select>            
                                        </div>
                                        <div class="mb-3">
                                            <label for="numcuarto" class="form-label">N° cuartos</label>
                                            <input type="number" id="numcuarto" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fechaentrada" class="form-label">Fecha de entrada</label>
                                            <input type="date" id="fechaentrada" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fechasalida" class="form-label">Fecha de salida</label>
                                            <input type="date" id="fechasalida" class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tipocomprobante" class="form-label">Tipo de comprobante (FACTURA - BOLETA)</label>
                                            <select  id="tipocomprobante" class="form-select">
                                                <option value="">Selección</option>
                                                <option value="F">F</option>
                                                <option value="B">B</option>
                                            </select>                                                        
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


        <script>
            document.addEventListener("DOMContentLoaded", () =>{

                //Objetos
                const lsEmpleado = document.querySelector("#idempleado");
                const lsUsuario = document.querySelector("#idusuario");
                const lsHabitacion = document.querySelector("#idhabitacion");
                const btnRegistrar = document.querySelector("#guardar");

                //Métodos
                function mostrarEmpleado(){
                    const parameters = new URLSearchParams();
                    parameters.append("operacion", "empleadosGet");

                    fetch("../controller/reservacion.controller.php", {
                        method: 'POST',
                        body: parameters
                    })
                    .then(response => response.json())
                    .then(data => {
                        lsEmpleado.innerHTML = "<option value=''>Seleccione</option>";
                        data.forEach(element => {
                            const optionTag = document.createElement("option");
                            optionTag.value = element.idempleado
                            optionTag.text = element.nombres;
                            lsEmpleado.appendChild(optionTag);                        
                        });
                    });
                }

                function mostrarUsuario(){
                    const parameters = new URLSearchParams();
                    parameters.append("operacion", "usuariosGet");

                    fetch("../controller/reservacion.controller.php", {
                        method: 'POST',
                        body: parameters
                    })
                    .then(response => response.json())
                    .then(data => {
                        lsUsuario.innerHTML = "<option value=''>Seleccione</option>";
                        data.forEach(element => {
                            const optionTag = document.createElement("option");
                            optionTag.value = element.idusuario
                            optionTag.text = element.nombreusuario;
                            lsUsuario.appendChild(optionTag);                        
                        });
                    });
                }

                function mostrarHabitacion(){
                    const parameters = new URLSearchParams();
                    parameters.append("operacion", "habitacionesGet");

                    fetch("../controller/reservacion.controller.php", {
                        method: 'POST',
                        body: parameters
                    })
                    .then(response => response.json())
                    .then(data => {
                        lsHabitacion.innerHTML = "<option value=''>Seleccione</option>";
                        data.forEach(element => {
                            const optionTag = document.createElement("option");
                            optionTag.value = element.idhabitacion
                            optionTag.text = element.tipo;
                            lsHabitacion.appendChild(optionTag);                        
                        });
                    });
                }

                function registrarReservacion(){
                    if(confirm("¿Está seguro de registrar?")){
                        const parameters = new URLSearchParams();
                        parameters.append("operacion", "reservacionRegistrar");
                        parameters.append("idempleado", document.querySelector("#idempleado").value);
                        parameters.append("idusuario", document.querySelector("#idusuario").value);
                        parameters.append("idhabitacion", document.querySelector("#idhabitacion").value);
                        parameters.append("numcuarto", document.querySelector("#numcuarto").value);
                        parameters.append("fechaentrada", document.querySelector("#fechaentrada").value);
                        parameters.append("fechasalida", document.querySelector("#fechasalida").value);
                        parameters.append("tipocomprobante", document.querySelector("#tipocomprobante").value);

                        fetch("../controller/reservacion.controller.php", {
                            method: 'POST',
                            body: parameters
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if(data.status){
                                document.querySelector("#form-reservaciones").reset();                            
                            }else{
                                alert(data.message);
                            }
                        });

                    }        
                }



                mostrarEmpleado();
                mostrarUsuario();
                mostrarHabitacion();


                btnRegistrar.addEventListener("click", registrarReservacion);
                
            });
  
        </script>
    </body>
</html>
