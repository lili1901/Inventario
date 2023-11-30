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
        <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                (function() {
                    'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                    })
                })

                function formatNumber(n) {
                    // format number 1000000 to 1,234,567
                    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                function formatCurrency(input, currency, blur) {
                    // appends $ to value, validates decimal side
                    // and puts cursor back in right position.
                    // get input value
                    var input_val = input.value;
                    // don't validate empty input
                    if (input_val === "") {
                    return;
                    }

                    // original length
                    var original_len = input_val.length;

                    // initial caret position
                    var caret_pos = input.selectionStart;

                    // check for decimal
                    if (input_val.indexOf(".") >= 0) {
                    // get position of first decimal
                    // this prevents multiple decimals from
                    // being entered
                    var decimal_pos = input_val.indexOf(".");

                    // split number by decimal point
                    var left_side = input_val.substring(0, decimal_pos);
                    var right_side = input_val.substring(decimal_pos);

                    // add commas to left side of number
                    left_side = formatNumber(left_side);

                    // validate right side
                    right_side = formatNumber(right_side);

                    // On blur make sure 2 numbers after decimal
                    if (blur === "blur") {
                        right_side += "00";
                    }

                    // Limit decimal to only 2 digits
                    right_side = right_side.substring(0, 2);

                    // join number by .
                    input_val = currency + left_side + "." + right_side;
                    } else {
                    // no decimal entered
                    // add commas to number
                    // remove all non-digits
                    input_val = formatNumber(input_val);
                    input_val = currency + input_val;

                    // final formatting
                    if (blur === "blur") {
                        input_val += ".00";
                    }
                    }

                    // send updated string to input
                    input.value = input_val;

                    // put caret back in the right position
                    var updated_len = input_val.length;
                    caret_pos = updated_len - original_len + caret_pos;
                    input.setSelectionRange(caret_pos, caret_pos);
                }
            </script>



                <!-- Inicia contenido de la pagina del perfil del administrador -->

                <div id="layoutSidenav_content">
             <main>
                <div class="container-fluid px-4">
                    <h1 class="text-center">AGREGAR ALIMENTOS</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="admin.php">Administrador</a></li> 
                        <li class="breadcrumb-item active">Alimentos</li>
                    </ol>

                    
                    
                    <div class="card mb-4">                        
                        <div class="card-body">
                        <form action="crudalimento.php" method="POST" class="row g-3 needs-validation" >
                                    <div class="col-md-4">
                                        <label for="lote" class="form-label">Lote</label>
                                        <input id="lote" type="text" name="lote" class="form-control is-invalid" required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input id="nombre" type="text" name="nombre" class="form-control  is-invalid" required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>                                         
                                    <div class="col-md-4">
                                        <label for="especie" class="form-label">Especie</label>
                                        <input id="especie" type="text" name="especie" class="form-control  is-invalid" required >
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="edad" class="form-label">Edad</label>
                                        <input id="edad" type="text" name="edad" class="form-control  is-invalid"  required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input id="precio" type="text" name="precio" class="form-control  is-invalid" 
                                            onBlur="formatCurrency(this, '$ ', 'blur');" onkeyup="formatCurrency(this, '$ ');" placeholder="$ " required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cantidad" class="form-label">Cantidad</label>                                        
                                        <input id="cantidad" type="text" name="cantidad" class="form-control is-invalid" required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cad" class="form-label">Fecha de caducidad</label>                                        
                                        <input id="cad" type="date" name="fechaCaducidad" class="form-control  is-invalid" required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ent" class="form-label">Fecha de entrada</label>                                        
                                        <input id="ent" type="date" name="fechaEntrada" class="form-control  is-invalid" required>
                                        <div class="invalid-feedback">
                                             Campo requerido
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="guardar_alimento" class="btn btn-primary">Guardar</button>
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