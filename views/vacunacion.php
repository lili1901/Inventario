<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>

        <link rel="stylesheet" href="../css/fullcalendar/fullcalendar.min.css" />
        <script src="../js/fullcalendar/lib/jquery.min.js"></script>
        <script src="../js/fullcalendar/lib/moment.min.js"></script>
        <script src="../js/fullcalendar/fullcalendar.min.js"></script>
        <script src="../js/fullcalendar/locale-all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        body {
            font-family: Arial;
        }
        h1#demo-title {
            margin: 30px 0px 80px 0px;
            text-align: center;
        }

        #event-action-response {
            background-color: #5ce4c6;
            border: #57d4b8 1px solid;
            padding: 10px 20px;
            border-radius: 3px;
            margin-bottom: 15px;
            color: #333;
            display: none;
        }

        /*.fc-day-grid-event .fc-content {
            background: #586e75;
            color: #FFF;
        }*/

        .fc-event, .fc-event-dot {
            background-color: #586e75;
        }

        .fc-event {
            border: 1px solid #485b6114;
        }
        .popover-header {
            padding: 0.5rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            color: inherit;
            background-color: #ddd;
            border-bottom: 1px solid #ebebeb;
            border-top-left-radius: calc(0.3rem - 1px);
            border-top-right-radius: calc(0.3rem - 1px);
        }
        .popover-body {
            padding: 0.5rem 0.75rem;
            color: #212529;
            background-color: #f7f7f7;
        }
        .popover  {
            position: absolute;
            transform: translate3d(439px, 3357px, 0px);
            top: 0px;
            left: 0px;
            will-change: transform;
        }
        .fade.show {
            opacity: 1;
        }
        .bs-popover-right {
            margin-left: 0.5rem;
        }
        </style>

        <script>
           $(document).ready(function() {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var calendar = $('#calendar').fullCalendar({
                    locale: 'es',
                    editable: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: 'getEventList.php',
                    eventRender: function(event, element, view) {
                        if (event.allDay === 'true') {
                        event.allDay = true;
                        } else {
                        event.allDay = false;
                        }
                    },
                    eventMouseover: function(event, jsEvent, view){
                        var eventid = event.id;
                        var layer = "<div id='events-layer'  style='position:absolute; background-color:#eee5e6; top:"+ jsEvent.pageY +"px; left:"+ jsEvent.pageX +"px; z-index:9999;'>"
                            +"<h3 class='popover-header' style='font-weight: bold;'>"+event.title+"</h3>"
                            +"<div class='popover-body'>"
                            +"<h6>"+event.propietario+"</h6>"
                            +"<h6>"+event.paciente+"</h6>"
                            +"</div>"
                            +"</div>";
                        $("body").append(layer);

                        console.log(jsEvent);
                    },
                    eventMouseout: function(calEvent, domEvent) {
                        $("#events-layer").remove();
                    },
                    selectable: true,
                    selectHelper: true,
                    


                    editable: true,
                    eventClick: function(data, event, view) {
                        var tooltip = '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">' + event.title + '</div>';
                        var content = '<h3>'+data.title+'</h3>' + 
                            '<p><b>Start:</b> '+data.start+'<br />' + 
                            (data.end && '<p><b>End:</b> '+data.end+'</p>' || '');

                    }
                });
            });
        </script>
   
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
                            <a class="nav-link" href="vacunacion.php">Programa de vacunación</a>
                        </nav>
                    </div>

                </nav>
            </div>

            <div id="layoutSidenav_content">

                <!-- Inicia contenido de la pagina del perfil del administrador -->
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="text-center">VACUNACION</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Administrador</a></li> 
                            <li class="breadcrumb-item active">Programa de vacunación</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="event-action-response"></div>
                                <div id="calendar"></div>
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
