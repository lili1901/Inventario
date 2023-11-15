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



                <!-- Inicia contenido de la pagina del perfil del administrador -->

          <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="text-center">EDITAR PACIENTE</h1>
                        <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="admin.html">Administrador</a></li> 
                                <li class="breadcrumb-item active">Accesorios</li>
                        </ol>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['idpaciente']))
                                {
                                //id de la tabla de consulta
                                    $id_paciente = mysqli_real_escape_string($conexion, $_GET['idpaciente']);

                                    $query = "SELECT pa.idpaciente, pa.nombrePaciente as nompaciente,pa.fechaNacimiento,pa.raza,
                                    pa.color,pa.especie,pa.sexo,p.nombre as nompropietario, p.idpropietario,p.apellidos,p.direccion,p.telefono,p.email
                                    FROM paciente as pa 
                                    INNER JOIN propietario as p ON p.idpaciente = pa.idpaciente
                                    WHERE pa.idpaciente='$id_paciente'";                   
                                    
                                            
                                     $query_run = mysqli_query($conexion, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        $resultado = mysqli_fetch_array($query_run);
                                    }
                                ?>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <form action="crudPaciente.php" method="POST">
                                                <div class="container">                                             
                                                    <h4 class="card-title text-center">PACIENTE</h4>
                                                    <div class="row row-cols-auto">
                                                        <input type="hidden" name="idpaciente" value="<?= $resultado['idpaciente']; ?>">
                                                        <input type="hidden" name="idpropietario" value="<?= $resultado['idpropietario']; ?>">                                                   
                                                        
                                                        <div class="mb-3">
                                                            <label>Nombre paciente</label>
                                                            <input type="text" name="nombrePaciente" value="<?=$resultado['nompaciente'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Fecha de nacimiento</label>
                                                            <input type="text" name="fechaNacimiento" value="<?=$resultado['fechaNacimiento'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Raza</label>
                                                            <input type="text" name="raza" value="<?=$resultado['raza'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Color</label>
                                                            <input type="text" name="color" value="<?=$resultado['color'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Especie</label>
                                                            <input type="text" name="especie" value="<?=$resultado['especie'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Sexo</label>
                                                            <input type="text" name="sexo" value="<?=$resultado['sexo'];?>" class="form-control">
                                                        </div>
                                                    </div>
                                                        
                                                    <hr class="hr hr-blurry"/>
                                                    <h4 class="card-title text-center">PROPIETARIO</h4> 
                                                    <div class="row row-cols-auto">                                                            
                                                        <div class="mb-3">
                                                            <label>Nombre propietario</label>
                                                            <input type="text" name="nombrepropietario" value="<?=$resultado['nompropietario'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Apellidos</label>
                                                            <input type="text" name="apellidos" value="<?=$resultado['apellidos'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Dirección</label>
                                                            <input type="text" name="direccion" value="<?=$resultado['direccion'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Telefóno</label>
                                                            <input type="text" name="telefono" value="<?=$resultado['telefono'];?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Correo electrónico</label>
                                                            <input type="email" name="email" value="<?=$resultado['email'];?>" class="form-control">
                                                        </div>    
                                                    </div>

                                                    <script>
                                                        var items = 0;
                                                        function addItem() {
                                                            items++;
                                                    
                                                            var html = "<tr>";
                                                            html += "<input type='hidden' name='idprogramavacunacion[]'>";
                                                            html += "<td><input type='text' name='tipoVacuna[]'></td>";
                                                            html += "<td><input type='date' name='fechaProxima[]'></td>";
                                                            html += "<td><button type='button' onclick='deleteRow(this);'>Eliminar</button></td>"
                                                            html += "</tr>";
                                                    
                                                            var row = document.getElementById("tbodyVac").insertRow();
                                                            row.innerHTML = html;
                                                        }
                                                    </script>

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
                                                                                <?php
                                                                                    require("../config/conexion.php");
                                                                                    $sql = $conexion -> query("SELECT va.idprogramavacunacion,va.tipoVacuna as vacuna,va.fechaProxima as proximaFecha
                                                                                    FROM paciente as pa 
                                                                                    INNER JOIN programavacunacion as va ON va.idPacie = pa.idpaciente
                                                                                    WHERE pa.idpaciente='$id_paciente'"); 
                                                                                    
                                                                                    $i = 0;
                                                                                    while ($resultado = $sql ->fetch_assoc()) {
                                                                                        $tipoVacuna[$i] = $resultado['vacuna'];
                                                                                        $fechaProxima[$i] = $resultado['proximaFecha']
                                                                                ?> 
                                                                                    <tr>
                                                                                        <input type="hidden" name="idprogramavacunacion[]" value="<?= $resultado['idprogramavacunacion']; ?>"> 
                                                                                        <td>
                                                                                            <input type='text' name='tipoVacuna[]' value="<?=$resultado['vacuna'];?>">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type='date' name='fechaProxima[]' value="<?=$resultado['proximaFecha'];?>">
                                                                                        </td>
                                                                                        <td>
                                                                                            <button type='button' onclick='deleteRow(this);'>Eliminar</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php  } $i++;  // Finaliza php ?>                                                                   
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
                                                
                                                    <div class="card-title text-center" style="padding-top: 20px">
                                                        <button type="submit" name="update_paciente" class="btn btn-primary">
                                                            Actualizar datos
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    
                                        <?php
                                        }
                                        else
                                        {
                                            echo "<h4>No Such Id Found</h4>";
                                        }
                                        
                                        ?>
                                    </div>
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