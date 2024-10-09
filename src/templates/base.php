<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard a3media</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/collection/components/icon/icon.css" integrity="sha384-**********" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="/plugins/datatables/css/jquery.dataTables.min.css">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <span class="brand-text font-weight-light">A3media</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Listado</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Contenido Principal -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <!-- Tarjetas -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="total-tasks"></h3>
                                    <p>Total de Tareas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>75%</h3>
                                    <p>Completadas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert-circled"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>75</h3>
                                    <p>Tareas OK</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-thumbsup"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>25</h3>
                                    <p>Tareas KO</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-thumbsdown"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- Repite el mismo bloque para cada tarjeta -->
                    </div>
                    <!-- Gráficas -->
                    <div class="row">
                        <!-- Tarjeta 1: Gráfica de Área y Donut -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header ui-sortable-handle" style="cursor: move;">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Progreso de Tareas
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#revenue-chart" data-toggle="tab">Area</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#sales-chart" data-toggle="tab">Donut</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <!-- Gráfica de Área -->
                                        <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px;">
                                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                        <!-- Gráfica Donut -->
                                        <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                                            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 2: Gráfica de Barras -->
                        <div class="col-lg-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Tipos de fuentes</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="barChart" style="min-height: 250px; height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón para agregar una nueva programación -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-plus"></i> Agregar Nueva Programación
                        </a>
                    </div>

                    <div id="alertContainer" class="mt-3" style="display: none;">
                        <div class="alert alert-success" role="alert" id="alertMessage">
                            Registro actualizado con éxito.
                        </div>
                    </div>

                    <!-- Tabla -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado programación</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt-programacion" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Regla</th>
                                        <th>Cuando</th>
                                        <th>Programación</th>
                                        <th>Día</th>
                                        <th>Hora</th>
                                        <th>SH</th>
                                        <th>Activo</th>
                                        <th>Acción</th> <!-- Columna para los botones de acción -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- El contenido de la tabla se cargará aquí dinámicamente con JavaScript -->
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Edit modal -->
    <?php include __DIR__ . '/edit.php'; ?>
    <!-- AdminLTE Scripts -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/js/adminlte.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <!-- DataTables Scripts -->
    <script src="/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <!-- Charts Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom Scripts -->
    <script type="module" src="/js/app.js"></script>
    <script src="/js/charts.js"></script>
    <script src="/js/dashboard.js"></script>

</body>
</html>
