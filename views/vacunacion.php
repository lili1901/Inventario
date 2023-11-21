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

        .fc-day-grid-event .fc-content {
            background: #586e75;
            color: #FFF;
        }

        .fc-event, .fc-event-dot {
            background-color: #586e75;
        }

        .fc-event {
            border: 1px solid #485b61;
        }
        </style>

        <script>
           $(document).ready(function() {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var eventsL = [];
                eventsL = [
                    {
                    "title": "Event 1",
                    "start": "2023-11-05",
                    "end": "2023-11-05"
                    },
                    {
                    "title": "Event 2",
                    "start": "2023-11-08",
                    "end": "2023-11-10"
                    }
                ]


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
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {
                        var title = prompt('Event Title:');


                        if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: 'add_events.php',
                            data: 'title='+ title+'&start='+ start +'&end='+ end,
                            type: "POST",
                            success: function(json) {
                            alert('Added Successfully');
                            }
                        });
                        calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true
                        );
                        }
                        calendar.fullCalendar('unselect');
                    },


                    editable: true,
                    eventDrop: function(event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: 'update_events.php',
                            data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
                            type: "POST",
                            success: function(json) {
                                alert("Updated Successfully");
                            }
                        });
                    },
                    eventClick: function(event) {
                        var decision = confirm("Do you really want to do that?"); 
                        if (decision) {
                        $.ajax({
                            type: "POST",
                            url: "delete_event.php",
                            data: "&id=" + event.id,
                            success: function(json) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                alert("Updated Successfully");}
                        });
                        }
                    },
                    eventResize: function(event) {
                        var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                        $.ajax({
                            url: 'update_events.php',
                            data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
                            type: "POST",
                            success: function(json) {
                            alert("Updated Successfully");
                            }
                        });
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
