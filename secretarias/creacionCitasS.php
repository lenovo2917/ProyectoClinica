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
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@500&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css" rel="stylesheet">
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/secretarias.css">
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
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row mt-3 border border-1  border-opacity-25 rounded-2 " style="background-color: #EEEEEE;">
                    <div class="col-12">
                        <div class="row text-start align-items-center">
                            <div class="col-4 ps-5 text-start">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Secretaria:</h4>
                                    </div>
                                    <div class="col-12">
                                        <h4>
                                            <?php
                                        
                                        if (isset($_SESSION["NombreCompleto"])) {
                                            $nombreUsuario = $_SESSION["NombreCompleto"];
                                            echo "$nombreUsuario";
                                        }    
                                        ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <h3>Crear cita</h2>
                            </div>
                            <div class="col-4 text-end">
                                <img src="../img/LOGO.png" style="width: 180px; height: 170px;"
                                    alt="Descripción de la imagen">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-1 text-center">
                        <?php
                            if(isset($_SESSION['mensajeCreacion'])) {
                                $mensaje = $_SESSION['mensajeCreacion'];
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                echo '<i class="fa-solid fa-circle-check" style="color: #198754;"></i>'.$mensaje;
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                unset($_SESSION['mensajeCreacion']);
                            }
                            if(isset($_SESSION['mensajeError'])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$mensaje;
                                echo '<i class="fa-solid fa-triangle-exclamation fa-sm" style="color: #7d0003;"></i>';
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                unset($_SESSION['mensajeError']);
                            }
                        ?>
                    </div>

                    <div class="col-12 px-5">
                        <div class="row ">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label for="" class=" col-3 col-form-label">Ingrese el nombre:</label>
                                    <div class="col-7 text-center border-bottom border-secondary">
                                        <input type="text" class="form-control-plaintext" name="nombrePaciente" id="">
                                    </div>
                                    <div class="col-2 text-end mt-2">
                                        <button class="" id="buscarP">Buscar</button>
                                    </div>
                                    <div class="col-12 text-center mt-3" id="mensajeError">
                                    </div>
                                </div>
                            </div>
                            <form id="citaForm" action="../php/procesaCreacionCS.php" class="form" method="post">
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 mt-4">
                                            <h4 class="">Datos del paciente:</h4>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class=" py-2 col-2 col-form-label">Paciente:</label>
                                            <div class="border-bottom border-secondary col-4 text-start">
                                                <input type="text" readonly id="nombrePacienteF" name="nombrePacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                            <label for="" class=" col-1 col-form-label">CURP:</label>
                                            <div class="border-bottom border-secondary col-2 text-start">
                                                <input type="text" readonly id="curpPacienteF" name="curpPacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                            <label for="" class="col-2 col-form-label text-end">tipo de sangre:</label>
                                            <div class="border-bottom border-secondary col-1 text-start">
                                                <input type="text" readonly id="sangrePacienteF" name="sangrePacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class="col-2 col-form-label">Alergias:</label>
                                            <div class="border-bottom border-secondary col-4 text-start">
                                                <input type="text" readonly id="alergiasPacienteF"
                                                    name="alergiasPacienteF" class="form-control-plaintext">
                                            </div>
                                            <label for="" class="col-1 col-form-label">Fecha:</label>
                                            <div class="border-bottom border-secondary col-3 text-start">
                                                <input type="date" required id="fechaPacienteF" name="fechaPacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                            <label for="" class="col-1 col-form-label">Hora:</label>
                                            <div class="border-bottom border-secondary col-1 text-start">
                                                <input type="time" required  id="horaPacienteF" name="horaPacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class=" col-2 col-form-label">Sintomas:</label>
                                            <div class="border-bottom border-secondary col-10 text-start">
                                                <input type="text" required id="sintomasPacienteF" name="sintomasPacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label class="col-2 mt-1 col-form-label">Descripcion:</label>
                                            <div class="border-bottom border-secondary col-10 text-start">
                                                <input type="text" required id="descripcionPacienteF" name="descripcionPacienteF"
                                                    class="form-control-plaintext">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <input type="submit" name="crearCitaS" value="Crear cita">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/buscarPaciente.js"></script>
    <script src="../js/creaCitasS.js"></script>

</body>

</html>