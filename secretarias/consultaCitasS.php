<!--Creo Antonio-->
<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>MEDICATEC</title>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@5 00&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    
    <!--ESTILOS CSS-->
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/secretarias.css">
    <link rel="stylesheet" type="text/css" href="../css/Blog.css">
</head>

<body   >
    <!--Header-->
    <div class="container-fluid-lg mb-4">
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="logo" style="display: flex;align-items: center;">
                        <span
                            style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                        <span style="padding: 0.5rem;"><img src="../img/cora2.png"
                                alt="Descripción de la imagen"></span>
                    </div>
                    <div class="hamburger">
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="line3"></div>
                    </div>
                    <?php 
                        $rol=$_SESSION['Rol'];
                        // Incluye barraNavegacion.php antes de llamar a la función generarMenu
                        include('../php/barraNavegacion.php');
                  
                        // Llama a la función generarMenu con el rol del usuario
                        generarMenu($rol);
                    ?>
                </nav>
            </div>
        </div>
    </div>

    <!--Main o contenido-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row mt-3 border border-1 border-opacity-25 rounded-2" style="background-color: #EEEEEE;">
                    <div class="col-12">
                        <div class="row text-start align-items-center">
                            <div class="col-4 ps-5 text-start">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Secretaria:</h5>
                                    </div>
                                    <div class="col-12">
                                        <h4>Ana Lucia Garcia Gomez</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <h3>Consultar citas</h3 >
                            </div>
                            <div class="col-4 text-end">
                                <img src="../img/LOGO.png" style="width: 180px; height: 170px;"
                                    alt="Descripción de la imagen">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-5">
                        <form class="form" method="post">
                            <div class="row ">
                                <div class="col-12 text-center">
                                    <?php
                                        if(isset($_SESSION['mensajeIncorrecto'])) {
                                            $mensaje = $_SESSION['mensajeIncorrecto'];
                                            echo "<div class='alert alert-danger'>$mensaje</div>";
                                            unset($_SESSION['mensajeIncorrecto']);
                                        }
                                        if(isset($_SESSION['mensajeCorrecto'])) {
                                            $mensaje = $_SESSION['mensajeCorrecto'];
                                            echo "<div class='alert alert-success'>$mensaje</div>";
                                            unset($_SESSION['mensajeCorrecto']);
                                        }
                                    ?>
                                </div>
                                <div class="col-12">
                                    <div class="row mb-1">
                                        <label for="nombre" class="col-2 col-form-label">Buscar por nombre:</label>
                                        <div class="col-5 text-start">
                                            <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="">
                                        </div>
                                        <div class="col-1"></div>
                                        <label for="mes" class="text-end col-2 col-form-label">Buscar por mes:</label>
                                        <div class="col-2 text-start">
                                            <select id="mesCita" name="mesCita" class="form-select" aria-label="">
                                                <option value="">Todos los meses</option>
                                                <option value="1">enero</option>
                                                <option value="2">febrero</option>
                                                <option value="3">marzo</option>
                                                <option value="4">abril</option>
                                                <option value="5">mayo</option>
                                                <option value="6">junio</option>
                                                <option value="7">julio</option>
                                                <option value="8">agosto</option>
                                                <option value="9">septiembre</option>
                                                <option value="10">octubre</option>
                                                <option value="11">noviembre</option>
                                                <option value="12">diciembre</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 my-2">
                                            <h5 class="">Pacientes:</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class=" row mb-4 border border-1 border-secondary border-opacity-75 rounded-1"
                                        id="listaPacientes" style="background-color: white ">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-4">Paciente</th>
                                                    <th class="col-1">Fecha</th>
                                                    <th class="col-1">Hora</th>
                                                    <th class="col-1">Estado</th>
                                                    <th class="col-4">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyPacientes">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--footer-->
    <div class="container-fluid-lg ">
        <footer class="bg-dark text-center py-5 mt-5">
            <div class="row">
                <p style="color: white;">&copy; 2023 Medicatec</p>
            </div>
        </footer>
    </div>

    <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/consultarCitasS.js"></script>
    <script src="../js/main.js"></script>

</body>

</html>