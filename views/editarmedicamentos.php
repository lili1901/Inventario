<?php
session_start();
require '../config/conexion.php';
?>
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



                <!-- Inicia contenido de la pagina del perfil del administrador -->

          <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="text-center">EDITAR MEDICAMENTOS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Administrador</a></li> 
                            <li class="breadcrumb-item active">Editar medicamentos</li>
                        </ol>

                       
                        <div class="card mb-4">
                            <div class="col-md-4">
                                <div class="card-body">

                                    <?php
                                    if(isset($_GET['idmedicamento']))
                                    {
                                        $id_medicamento = mysqli_real_escape_string($conexion, $_GET['idmedicamento']);
                                        $query = "SELECT * FROM medicamento WHERE idmedicamento='$id_medicamento'";
                                        $query_run = mysqli_query($conexion, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            $resultado = mysqli_fetch_array($query_run);
                                    ?>
                                        <form action="crudmedicamentos.php" method="POST">
                                                <input type="hidden" name="idmedicamento" value="<?= $resultado['idmedicamento']; ?>">
                                                <div class="mb-3">
                                                    <label>Lote</label>
                                                    <input type="text" name="lote" value="<?=$resultado['lote'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nombre</label>
                                                    <input type="text" name="nombre" value="<?=$resultado['nombre'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Vía de administración</label>
                                                    <input type="text" name="viaadmon" value="<?=$resultado['viaadmon'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Precio</label>
                                                    <input type="text" name="precio" value="<?=$resultado['precio'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Cantidad</label>
                                                    <input type="text" name="cantidad" value="<?=$resultado['cantidad'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Fecha de caducidad</label>
                                                    <input type="text" name="fechaCaducidad" value="<?=$resultado['fechaCaducidad'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Fecha de entrada</label>
                                                    <input type="text" name="fechaEntrada" value="<?=$resultado['fechaEntrada'];?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" name="update_medicamento" class="btn btn-primary">
                                                        Actualizar
                                                    </button>
                                                </div>

                                        </form>
                                        <?php
                                        }
                                        else
                                        {
                                            echo "<h4>No Such Id Found</h4>";
                                        }
                                        }
                                        ?>

                                </div>
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