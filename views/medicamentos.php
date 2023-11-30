
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gestor de inventario</title> 
        
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>



    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark bg-img">
            <!-- Navbar Brand-->
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
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
            $query_productos_vencidos = "SELECT * FROM medicamento WHERE fechaCaducidad < CURDATE()";
            $resultado_productos_vencidos = mysqli_query($conexion, $query_productos_vencidos);

            // Consulta SQL para obtener productos que les faltan 3 días para vencer
            $query_productos_proximos_a_vencer = "SELECT * FROM medicamento WHERE fechaCaducidad = DATE_ADD(CURDATE(), INTERVAL 5 DAY)";
            $resultado_productos_proximos_a_vencer = mysqli_query($conexion, $query_productos_proximos_a_vencer);

            // Contar el número de productos vencidos
            $num_productos_vencidos = mysqli_num_rows($resultado_productos_vencidos);

            // Contar el número de productos que les faltan 3 días para vencer
            $num_productos_proximos_a_vencer = mysqli_num_rows($resultado_productos_proximos_a_vencer);

            // Mostrar notificaciones en php, javascript, css
            if ($num_productos_vencidos > 0) {
                echo "<style>
                .elemento3 { 
                    display: none;
                        background-color: #f44336;
                        color: white;
                        padding: 1px;
                        text-align: center;        
                }
            </style>";

                echo "<div class='elemento3' id='myAlert3'>
                Hay $num_productos_vencidos productos vencidos.
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

            if ($num_productos_proximos_a_vencer > 0) {
            
                echo "<style>
                .elemento4 { 
                    display: none;
                        background-color: #FFA500;
                        color: white;
                        padding: 1px;
                        text-align: center;        
                }
            </style>";

                echo "<div class='elemento4' id='myAlert4'>
                Hay $num_productos_proximos_a_vencer productos que les faltan 5 días para vencer.<br>
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



                            
                <!-- Script de JavaScript para actualizar la tabla automáticamente -->

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Agregamos jQuery para facilitar las solicitudes AJAX -->
                <script class="tabla">
                    // Función para actualizar la tabla
                    function actualizarTabla() {
                        $.ajax({
                            url: '../views/registrar_vencimiento.php', // Ruta del archivo PHP que obtiene los datos de la base de datos
                            type: 'GET',
                            success: function(data) {
                                $('#miTabla').html(data); // Actualiza el contenido de la tabla con los nuevos datos
                            }
                        });
                    }

                    // Llama a la función de actualización cada cierto intervalo de tiempo (por ejemplo, cada 5 segundos)
                    setInterval(actualizarTabla, 5000); // 5000 milisegundos (5 segundos)
                </script>



                <!-- Inicia contenido de la pagina del perfil del administrador -->
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="text-center">MEDICAMENTOS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.html">Administrador</a></li> 
                            <li class="breadcrumb-item active">Medicamentos</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                    <h4>
                                        <a href="agregarMedicamento.php" class="btn btn-success float-end">Agregar</a>
                                    </h4>
                             </div>       
                            <div class="card-body">
                                
                                <table id="datatablesSimple">

                                    <thead>
            
                                    <!-- Encabezados de la tabla -->
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Lote</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Vía de administración </th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Fecha de caducidad</th>
                                            <th scope="col">Fecha de entrada</th>                                            
                                            <th scope="col">Editar</th>
                                            <th scope="col">Eliminar</th>
                                        </tr> 
            
                                        
                                    </thead>
            
                                    <tbody> <!--Contenido de la tabla  -->
            
                                        <?php
                                      
            
                                        // Inicia sentencia php para llamar y obtener los datos de la tabla alimento de la base de datos con una sentencia SQL
            
                                        require("../config/conexion.php");
                                        $sql = $conexion -> query("SELECT * FROM medicamento");
            
                                        while ($resultado = $sql ->fetch_assoc()) {
                                           
                                        ?>
            
                                        
                                            <tr>
                                                    <!-- Muestra en pantalla la tabla html los datos actuales de la base de datos -->
                                                <th scope="row"><?php echo $resultado ['idmedicamento']?></th>
                                                <th scope="row"><?php echo $resultado ['lote']?></th>
                                                <th scope="row"><?php echo $resultado ['nombre']?></th>
                                                <th scope="row"><?php echo $resultado ['viaadmon']?></th>
                                                <th scope="row"><?php echo $resultado ['precio']?></th>
                                                <th scope="row"><?php echo $resultado ['cantidad']?></th>
                                                <th scope="row"><?php echo date('d-m-Y', strtotime($resultado ['fechaCaducidad']))?></th>
                                                <th scope="row"><?php echo date('d-m-Y', strtotime($resultado ['fechaEntrada']))?></th>
                                            
                                                
                                            
                                                <!-- Botones editar(amarillo) y eliminar(rojo) -->
                                                <th>
                                                    <a href="editarmedicamentos.php?idmedicamento=<?= $resultado['idmedicamento']; ?>" class="btn btn-warning" style="padding: 0px;">
                                                        <button class="btn btn-warning btn-sm">                                         
                                                            <i class="bi bi-trash">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                                </svg>
                                                            </i>
                                                        </button>
                                                    </a>
                                                </th>

                                                <th>
                                                        <form action="crudmedicamentos.php" method="POST" class="d-inline">
                                                            <button type="submit" name="eliminar_medicamento" value="<?=$resultado['idmedicamento'];?>" class="btn btn-danger btn-sm">
                                                                <i class="bi bi-pen">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                                    </svg>
                                                                </i>
                                                            </button>
                                                        </form>
                                                </th>                          
                                            </tr>
            
                                    <?php  }  // Finaliza php ?>
            
                                    </tbody> 
            
                                </table><!-- Finaliza tabla html -->
                            </div>
                        </div>
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
        <script src="../js/simple-datatables.min.js"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
