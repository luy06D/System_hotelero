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
             <!-- estilos de select2   -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                    <div class="row">
                        <div class="col-md-10 col-lg-6 mt-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Aqui se renderiza en grafico -->
                                    <canvas id="graficoReservaciones"></canvas>
                                    <h5 class="card-title mt-3">Gráfico 1</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 col-lg-5 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Aqui se renderiza en grafico -->
                                    <canvas id="graficoMonto"></canvas>
                                    <h5 class="card-title mt-2">Gráfico 2</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

 
                <!-- Tabla -->
                <div class=" tableR mt-5">
                <table id="table_reservaciones" class="table table-bordered border-secondary table-sm display responsive nowrap"  width="100%" >
                    <thead>
                      <tr>
                        <th>#</th>                        
                        <th>Cliente</th>
                        <th>Fecha entrada</th>
                        <th>Fecha Salida</th>
                        <th>N° habitacion</th>
                        <th>Piso</th>
                        <th>Capacidad</th>
                        <th>Precio</th>                        
                        <th>Operaciones</th> 
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
            
                <!-- Modal Body -->
                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                <div class="modal fade" id="modal-actualizar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Actualizar reservacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="" id="form-reservaciones" autocomplete="off">
                                      
                                        <div class="mb-3">
                                            <label for="idcliente" class="form-label">Cliente</label>
                                            <select  id="idcliente" class="form-select" disabled>
                                                <option value="">Selección</option>
                                            </select>
                                        </div> 
                                        <div class="mb-3">
                                            <label for="idempleado" class="form-label">Empleado</label>
                                            <select  id="idempleado" class="form-select" disabled>
                                                <option value="">Selección</option>
                                            </select>
                                        </div>                                       
                                        <div class="mb-3">
                                            <label for="idusuario" class="form-label">Usuario</label>
                                            <select  id="idusuario" class="form-select" disabled>
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
                                                          
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success" id="btnActualizar">Actualizar</button>
                            </div>
                        </div>
                    </div>
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
        <!-- select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
          <!-- CDN sweetAlert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- CDN para crear graficos -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../js/grafico1.js"></script>
        <script src="../js/grafico2.js"></script>
        <script src="../js/mostrarSelect.js"></script>

  
        <script>
                    
          $(document).ready(function (){
             //Activa el select2 en clientes
            $("#cliente").select2();

            let idreservacion = 0;

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

            function reservacionEliminar(id){
                Swal.fire({
                    title: "¿Está seguro de eliminar la reservación?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",

                }).then(function (result){
                    if(result.isConfirmed){
                        $.ajax({
                        url: '../controller/reservacion.controller.php',
                        type: 'POST',
                        data: {
                            'operacion' : 'reservacionEliminar',
                            'idreservacion' : id
                        },
                        success: function(){
                            get_reservaciones();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Eliminando reservacion',
                                showConfirmButton: false,
                                timer: 1500
                                })
                        }
                    });

                    }
                });
                   
                
            }

            
            function reservacionesUpdate(){

                let enviar = {
                    'operacion'         : 'reservacionUpdate',  
                    'idreservacion'     : idreservacion,                  
                    'idcliente'         : $("#idcliente").val(),
                    'idempleado'        : $("#idempleado").val(),
                    'idusuario'         : $("#idusuario").val(),
                    'idhabitacion'      : $("#idhabitacion").val(),
                    'fechaentrada'      : $("#fechaentrada").val(),
                    'fechasalida'       : $("#fechasalida").val(),
                    'tipocomprobante'   : $("#tipocomprobante").val(),

                }

                Swal.fire({
                    title: "¿Está seguro de realizar esta acción?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Cancelar",

                }).then(function (result){
                    if(result.isConfirmed){
                        $.ajax({
                        url: '../controller/reservacion.controller.php',
                        type: 'POST',
                        data:enviar,
                        success: function(result){
                            get_reservaciones();

                            $("#modal-actualizar").modal('hide');
                        }
                    });
                    }
                })
                   

                

            }

            function recuperarReser(id){
                $("#form-reservaciones")[0].reset();

                $.ajax({
                    url: '../controller/reservacion.controller.php',
                    type: 'POST',
                    data: {
                        'operacion' : 'recuperarDatos',
                        'idreservacion' : id                       
                    },
                    dataType: 'JSON',
                    success: function(result){
                        $("#idcliente").val(result.idcliente);
                        $("#idempleado").val(result.idempleado);
                        $("#idusuario").val(result.idusuario);
                        $("#idhabitacion").val(result.idhabitacion);
                        $("#fechaentrada").val(result.fechaentrada);
                        $("#fechasalida").val(result.fechasalida);
                        $("#tipocomprobante").val(result.tipocomprobante);
                    }
                });

                $("#modal-actualizar").modal('show');

            }


            //Eventos
            $("#table_reservaciones tbody").on("click", ".eliminar", function(){
                idreservacion = $(this).data("ideliminar");
                reservacionEliminar(idreservacion);

            });

            $("#table_reservaciones tbody").on("click", ".editar", function(){
                idreservacion = $(this).data("ideditar");
                recuperarReser(idreservacion);
            })

            $("#btnActualizar").click(reservacionesUpdate);

           
            get_reservaciones();
            mostrarClientes();
            mostrarEmpleados();

          });
        </script>

    </body>
</html>
