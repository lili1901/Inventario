<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gestor de inventario</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark bg-img">
            <!-- Navbar Brand-->
            <!-- Sidebar Toggle
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>-->
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../index.html">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Páginas</div>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Inicio
                            </a>
                <!-- Categorias de productos barra lateral -->
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Categorías
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="alimento.php">Alimentos</a>
                                    <a class="nav-link" href="accesorios.php">Accesorios</a>
                                    <a class="nav-link" href="medicamentos.php">Medicamentos</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Citas próximas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="paciente.php">Paciente y vacunas</a>
                                <a class="nav-link" href="vacunacion.php">Programa de vacunación</a>
                            </nav>
                        </div>
                </nav>
            </div>           

            <div id="layoutSidenav_content">
                <?php 
                require("../config/conexion.php");
                // Consulta SQL para obtener productos vencidos
                $query_productos_vencidos = "SELECT * FROM alimento WHERE fechaCaducidad < CURDATE()";
                $resultado_productos_vencidos = mysqli_query($conexion, $query_productos_vencidos);

                // Consulta SQL para obtener productos que les faltan 3 días para vencer
                $query_productos_proximos_a_vencer = "SELECT * FROM alimento WHERE fechaCaducidad = DATE_ADD(CURDATE(), INTERVAL 5 DAY)";
                $resultado_productos_proximos_a_vencer = mysqli_query($conexion, $query_productos_proximos_a_vencer);

                // Contar el número de productos vencidos
                $num_productos_vencidos = mysqli_num_rows($resultado_productos_vencidos);

                // Contar el número de productos que les faltan 3 días para vencer
                $num_productos_proximos_a_vencer = mysqli_num_rows($resultado_productos_proximos_a_vencer);

                // Mostrar notificaciones en php, javascript, css
                if ($num_productos_vencidos > 0) {
                    echo "<style>
                    .elemento { 
                        display: none;
                            background-color: #a18262;
                            color: white;
                            padding: 1px;
                            text-align: center;        
                    }
                </style>";

                    echo "<div class='elemento' id='myAlert'>
                    Hay $num_productos_vencidos productos vencidos en la tabla alimento.
                </div><script>
                function mostrarAlerta() {
                    var alerta = document.getElementById('myAlert');
                    alerta.style.display = 'block'; // Mostrar la alerta
                
                    // Programar el cierre después de 5 segundos (5000 milisegundos)

                    setTimeout(function() {
                        alerta.style.display = 'none'; // Ocultar la alerta
                    }, 5000);
                }

                // Llamar a la función para mostrar la alerta automáticamente
                mostrarAlerta();</script>";


                }

                if ($num_productos_proximos_a_vencer > 0) {
                
                    echo "<style>
                    .elemento2 { 
                        display: none;
                            background-color: #d0aa55;
                            color: white;
                            padding: 1px;
                            text-align: center;        
                    }
                </style>";

                    echo "<div class='elemento2' id='myAlert2'>
                    Hay $num_productos_proximos_a_vencer productos que les faltan 5 días para vencer en la tabla alimento.<br>
                </div><script>function mostrarAlerta() {
                    var alerta = document.getElementById('myAlert2');
                    alerta.style.display = 'block'; // Mostrar la alerta

                    // Programar el cierre después de 5 segundos (5000 milisegundos)
                    setTimeout(function() {
                        alerta.style.display = 'none'; // Ocultar la alerta
                    }, 5000);
                }

                // Llamar a la función para mostrar la alerta automáticamente
                mostrarAlerta();</script>";
                }

                
                //MEDICAMENTOS---------------------------------------------------------------------------------------------------------


                // Consulta SQL para obtener productos vencidos
                $query_medicamento_vencidos = "SELECT * FROM medicamento WHERE fechaCaducidad < CURDATE()";
                $resultado_medicamento_vencidos = mysqli_query($conexion, $query_medicamento_vencidos);

                // Consulta SQL para obtener productos que les faltan 3 días para vencer
                $query_medicamento_proximos_a_vencer = "SELECT * FROM medicamento WHERE fechaCaducidad = DATE_ADD(CURDATE(), INTERVAL 5 DAY)";
                $resultado_medicamento_proximos_a_vencer = mysqli_query($conexion, $query_medicamento_proximos_a_vencer);

                // Contar el número de productos vencidos
                $num_medicamento_vencidos = mysqli_num_rows($resultado_medicamento_vencidos);

                // Contar el número de productos que les faltan 3 días para vencer
                $num_medicamento_proximos_a_vencer = mysqli_num_rows($resultado_medicamento_proximos_a_vencer);

                // Mostrar notificaciones en php, javascript, css
                if ($num_medicamento_vencidos > 0) {
                    echo "<style>
                    .elemento3 { 
                        display: none;
                            background-color: #0a497b ;
                            color: white;
                            padding: 1px;
                            text-align: center;        
                    }
                </style>";

                    echo "<div class='elemento3' id='myAlert3'>
                    Hay $num_medicamento_vencidos productos vencidos en la tabla medicamentos.
                </div><script>
                function mostrarAlerta() {
                    var alerta = document.getElementById('myAlert3');
                    alerta.style.display = 'block'; // Mostrar la alerta
                
                    // Programar el cierre después de 5 segundos (5000 milisegundos)

                    setTimeout(function() {
                        alerta.style.display = 'none'; // Ocultar la alerta
                    }, 5000);
                }

                // Llamar a la función para mostrar la alerta automáticamente
                mostrarAlerta();</script>";


                }

                if ($num_medicamento_proximos_a_vencer > 0) {
                
                    echo "<style>
                    .elemento4 { 
                        display: none;
                            background-color: #215589;
                            color: white;
                            padding: 1px;
                            text-align: center;        
                    }
                </style>";

                    echo "<div class='elemento4' id='myAlert4'>
                    Hay $num_medicamento_proximos_a_vencer productos que les faltan 5 días para vencer en la tabla medicamento.<br>
                </div><script>function mostrarAlerta() {
                    var alerta = document.getElementById('myAlert4');
                    alerta.style.display = 'block'; // Mostrar la alerta

                    // Programar el cierre después de 5 segundos (5000 milisegundos)
                    setTimeout(function() {
                        alerta.style.display = 'none'; // Ocultar la alerta
                    }, 5000);
                }

                // Llamar a la función para mostrar la alerta automáticamente
                mostrarAlerta();</script>";
                }
                
                ?>

                <!-- Inicia contenido de la pagina del perfil del administrador -->
                <main>
                    <div class="container-fluid px-4">
                        <ol class="breadcrumb mb-4">
                            <!-- <li class="breadcrumb-item"><a href="admin.html">Administrador</a></li> -->
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            <div class="bg-img2"></div>
                            </div>
                        </div>
                        <div style="height: 100vh"></div>
                    </div>
                </main>

                <!-- Finaliza el contenido central de la pagina -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Veterinaria 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
