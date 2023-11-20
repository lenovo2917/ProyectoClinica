<!--Creo Antonio-->
<?php
session_start();
if(empty($_SESSION["NombreCompletoP"]) && empty($_SESSION["NombreCompletoS"]) && empty($_SESSION["NombreCompletoD"])) {
  header("Location: login.php"); // Si no hay ninguna sesión activa, redirige al login
} 
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
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet">
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/doctores.css">
</head>

<body style="background-color: #EEEEEE;">
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
                <div class="row border border-1 border-secondary border-opacity-50 rounded-1">
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
                                <h2>Consultar citas</h2>
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
                                <div class="col-12">
                                    <div class="row mb-1">
                                        <label for="" class=" col-2 col-form-label">Buscar por nombre:</label>
                                        <div class="col-5 text-start">
                                            <input type="text" class="form-control" id=""
                                                value="Jorge Damian Reyes Hernandez">
                                        </div>
                                        <div class="col-1">
                                        </div>
                                        <label for="" class="text-end col-2 col-form-label">Busqueda por mes:</label>
                                        <div class="col-2 text-start">
                                            <select class="form-select" aria-label="">
                                                <option value="enero">enero</option>
                                                <option value="febrero">febrero</option>
                                                <option value="marzo">marzo</option>
                                                <option value="abril">abril</option>
                                                <option value="mayo">mayo</option>
                                                <option value="junio">junio</option>
                                                <option value="julio">julio</option>
                                                <option value="agosto">agosto</option>
                                                <option value="septiempre">septiempre</option>
                                                <option value="octubre">octubre</option>
                                                <option value="noviembre">noviembre</option>
                                                <option value="diciembre">diciembre</option>
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
                                                    <th class="col-1">#</th>
                                                    <th class="col-4">Paciente</th>
                                                    <th class="col-2">Fecha</th>
                                                    <th class="col-1">Hora</th>
                                                    <th class="col-1">Estado</th>
                                                    <th class="col-3">Opciones</th>
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