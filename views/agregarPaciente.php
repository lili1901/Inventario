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

            <script>
                var items = 0;
                function addItem() {
                    items++;
            
                    var html = "<tr>";
                    html += "<td><input type='text' name='tipoVacuna[]'></td>";
                    html += "<td><input type='date' name='fechaProxima[]'></td>";
                    html += "<td><button type='button' onclick='deleteRow(this);'>";
                    html += "<i class='bi bi-pen'>";
                    html += "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>";
                    html += "<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>";
                    html += "<path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>";
                    html += "</svg></i>";
                    html += "</button></td>";
                    html += "</tr>";
            
                    var row = document.getElementById("tbodyVac").insertRow();
                    row.innerHTML = html;
                }
                function deleteRow(button) {
                    items--
                    button.parentElement.parentElement.remove();
                    // first parentElement will be td and second will be tr.
                }
            </script>

            <!-- Inicia contenido de la pagina del perfil del administrador -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="text-center">PROGRAMACIÓN DE CITAS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Adiministrador</a></li> 
                            <li class="breadcrumb-item active">Agregar Paciente</li>
                        </ol>
                        <?php include('message.php'); ?>                    
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="crudPaciente.php" method="POST">
                                    <div class="container">
                                        <h4 class="card-title text-center">PACIENTE</h4>
                                        <div class="row row-cols-auto">                                        
                                            <div class="mb-3">
                                                <label>Nombre</label>
                                                <input type="text" name="nombre" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Especie</label>
                                                <input type="text" name="especie" class="form-control">
                                            </div>                           
                                            <div class="mb-3">
                                                <label>Raza</label>
                                                <input type="text" name="raza" class="form-control" >
                                            </div>
                                            <div class="mb-3">
                                                <label>Color</label>
                                                <input type="text" name="color" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Sexo</label>
                                                <input type="text" name="sexo" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Fecha de nacimiento</label>                                        
                                                <input type="date" name="fechaNacimiento" class="form-control">
                                            </div>                                                          
                                        </div>

                                        <hr class="hr hr-blurry"/>
                                    
                                        <h4 class="card-title text-center">PROPIETARIO</h4>
                                        <div class="row row-cols-auto">                                  
                                            <div class="mb-3">
                                                <label>Nombre de Propietario</label>                                        
                                                <input type="text" name="nompropietario" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Apellidos de Propietario</label>                                        
                                                <input type="text" name="apellidos" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Dirección</label>                                        
                                                <input type="text" name="direccion" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Telefóno</label>                                        
                                                <input type="text" name="telefono" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label>Email</label>                                        
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                        </div>

                                      
                                        <div class="page-content page-container" id="page-content">
                                            <div class="row container d-flex justify-content-center">
                                                <div class="col-lg-8 grid-margin stretch-card">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title text-center">VACUNAS</h4>
                                                            <hr>
                                                    
                                                            <div class="table-responsive">
                                                                <table id="faqs" class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Vacuna</th>
                                                                            <th>Próxima fecha de vacunación</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbodyVac">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="button" onclick="addItem();" class="btn btn-success float-end">
                                                                    <i class="fa fa-plus"></i> Nueva vacuna
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-center" style="padding-top: 20px">
                                            <button type="submit" name="guardar_paciente" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </form>
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
