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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.php">Administrador</a>
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
                            <div class="sb-sidenav-menu-heading">Tablas</div>
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
                                    <a class="nav-link" href="paciente.php">Paciente</a>
                                    <a class="nav-link" href="propietario.php">Propietario</a>
                                    <a class="nav-link" href="vacunacion.php">Programa de vacunación</a>
                                </nav>
                            </div>
                </nav>
            </div>



                <!-- Inicia contenido de la pagina del perfil del administrador -->

            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">DESCONTAR PRODUCTO</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Administrador</a></li> 
                            <li class="breadcrumb-item active">Accesorios</li>
                        </ol>
                        <!-- cOMIENZA CÓDIGO PARA DESCONTAR-->
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $lote = $_POST["Lote"];
                            $cantidad_a_descontar = $_POST["cantidad_a_descontar"];

                            // Conexión a la base de datos
                            $conn = new mysqli("localhost", "root", "123456789", "veteri");

                            if ($conn->connect_error) {
                                die("Error de conexión a la base de datos: " . $conn->connect_error);
                            }

                            // Consulta SQL para obtener la cantidad disponible del lote
                            $sql = "SELECT cantidad FROM alimento WHERE lote = '$lote'";
                            $result = $conn->query($sql);
                            $query_run = mysqli_query($conn, $sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $cantidad_disponible = $row['cantidad'];
                                
                                if ($cantidad_disponible >= $cantidad_a_descontar) {
                                    // Realizar el descuento
                                    $nueva_cantidad = $cantidad_disponible - $cantidad_a_descontar;
                                    
                                    // Actualizar la cantidad en la base de datos
                                    $update_sql = "UPDATE alimento SET cantidad = $nueva_cantidad WHERE lote = '$lote'";    
                                    
                                    if ($conn->query($update_sql) === TRUE) {  
                                        echo "
                                        Descuento exitoso. Cantidad restante: $nueva_cantidad "  ;
                                    } else {
                                        echo "Error al actualizar la cantidad: " . $conn->error;
                                    }
                                } else {
                                    echo "No hay suficiente cantidad disponible para descontar.";
                                }
                            } else {
                                echo "El lote no existe en la base de datos.";
                            }
                            }
                            // Cierra la conexión a la base de datos
                            ?>



                                    
                        <div class="card mb-4">                        
                            <div class="card-body">
                                <div id="alertaCantidad" class="oculto"></div>
                                    <form method="POST" id="formularioDescontar">
                                        <div class="container">
                                            <div class="row row-cols-auto">

                                            <div class="mb-3">
                                                    <label for="Lote">Lote:</label>
                                                    <input type="text" name="Lote" id="Lote" required><br>
                                                </div>  
                                                <div class="mb-3">
                                                    <label for="cantidad_a_descontar">Cantidad a descontar:</label>
                                                    <input type="number" name="cantidad_a_descontar" id="cantidad_a_descontar" required><br>
                                                </div>                                        
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="submit" value="Descontar Cantidad">   
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                    <!--<script>
                        $('#formularioDescontar').submit(function(event) {
                            event.preventDefault(); // Evita la recarga de la página

                            $.ajax({
                                url: 'crudAgotar.php', // Ruta al archivo PHP que procesa el formulario
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(data) {
                                    if (data !== "No hay suficiente cantidad disponible.") {
                                        // Actualiza el contenido en la página
                                        $('#alertaCantidad').text('Cantidad disponible: ' + data);
                                    } else {
                                        alert(data);
                                    }
                                },
                                error: function() {
                                    $('#alertaCantidad').text('Error al actualizar la cantidad.');
                                }
                            });
                        });
                    </script> -->                

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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>