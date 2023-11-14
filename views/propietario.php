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
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.html">Administrador</a>
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
                            <a class="nav-link" href="admin.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Inicio
                            </a>
                            <div class="sb-sidenav-menu-heading">Tablas</div>
                <!-- Categorias de productos barra lateral -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Categorias
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

            <div id="layoutSidenav_content">

                <!-- Inicia contenido de la pagina del perfil del administrador -->
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">PROPIETARIO</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.html">Administrador</a></li> 
                            <li class="breadcrumb-item active">Propietario</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">

                                    <thead>
            
                                    <!-- Encabezados de la tabla -->
                                        <tr>
                                        <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellidos</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Telefóno</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mascota</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Eliminar</th>
                                        </tr> 
            
                                        
                                    </thead>
            
                                    <tbody> <!--Contenido de la tabla  -->
            
                                        <?php
                                      
            
                                        // Inicia sentencia php para llamar y obtener los datos de la tabla alimento de la base de datos con una sentencia SQL
            
                                        require("../config/conexion.php");
                                        $sql = $conexion -> query("SELECT * FROM propietario");
            
                                        while ($resultado = $sql ->fetch_assoc()) {
                                           
                                        ?>
            
                                        
                                            <tr>
                                                <!-- Muestra en pantalla la tabla html los datos actuales de la base de datos -->
                                            <th scope="row"><?php echo $resultado ['idpropietario']?></th>                                            
                                            <th scope="row"><?php echo $resultado ['nombre']?></th>
                                            <th scope="row"><?php echo $resultado ['apellidos']?></th>
                                            <th scope="row"><?php echo $resultado ['direccion']?></th>
                                            <th scope="row"><?php echo $resultado ['email']?></th>
                                            <th scope="row"><?php echo $resultado ['telefono']?></th>
                                            <th scope="row"><?php echo $resultado ['idpaciente']?></th>
                                            
                                        
                                            <!-- Botones editar(amarillo) y eliminar(rojo) -->
                                            <th><a href="" class="btn btn-warning">Editar</a></th>
                                            <th><form action="" method="POST" class="d-inline">
                                                <!-- Aparece una notificación flotante -->
                                                <input type="submit" onclick="return confirm('¿Deseas borrar este dato?')" value="Borrar" class="btn btn-danger">
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
