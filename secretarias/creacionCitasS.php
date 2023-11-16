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
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@500&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css"rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css"rel="stylesheet">
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/doctores.css">
    <link rel="stylesheet" type="text/css" href="../css/Blog.css">
</head>

<body>
    <!--Header-->
    <div class="container-fluid-lg mb-4">
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="logo" style="display: flex;align-items: center;">
                        <span
                            style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                        <span style="padding: 0.5rem;"><img src="../img/cora2.png" alt="Descripción de la imagen"></span>
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
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row mt-3 border border-1  border-opacity-25 rounded-2 "
                style="background-color: #EEEEEE;">
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
                                <h2>Crear cita</h2>
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
                                    <div class="row mb-3">
                                        <label for="" class=" col-2 col-form-label">Ingrese el nombre:</label>
                                        <div class="col-5 text-start">
                                            <input type="text" class="form-control" id=""
                                                value="Jorge Damian Reyes Hernandez">
                                        </div>
                                        <label for="" class=" col-2 col-form-label text-end">Fecha de
                                            cita:</label>
                                        <div class="col-2 text-end">
                                            <input type="date" class="form-control" id="" value="12/10/2023">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 mt-4">
                                            <h4 class="">Datos del paciente:</h4>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class=" py-2 col-1 col-form-label">Paciente:</label>
                                            <div class="border-bottom border-secondary col-5 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                    value="Jorge Damian Reyes Hernandez">
                                            </div>
                                            <label for="" class=" col-1 col-form-label">CURP:</label>
                                            <div class="border-bottom border-secondary col-3 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                    value="RECA020205HGRYRNA1">
                                            </div>
                                            <label for="" class="col-1 col-form-label">Edad:</label>
                                            <div class="border-bottom border-secondary col-1 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                    value="25">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class=" col-1 col-form-label">Sintomas:</label>
                                            <div class="border-bottom border-secondary col-4 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                    value="">
                                            </div>
                                            <label for="" class="col-1 col-form-label">Alergias:</label>
                                            <div class="border-bottom border-secondary col-3 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                    value="">
                                            </div>
                                            <label for="" class="col-2 col-form-label text-end">tipo de sangre:</label>
                                            <div class="border-bottom border-secondary col-1 text-start">
                                                <select class=" form-control-plaintext"
                                                    aria-label="Default select example">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 text-end">
                                <input type="submit" value="Crear cita">
                            </div>
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
    <script src="../js/creaCitas.js"></script>
    <script src="../js/main.js"></script>

</body>
</html>