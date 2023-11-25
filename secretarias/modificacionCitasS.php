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
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@500&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/secretarias.css">
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
                    <ul class="nav-links">
                        <li><a href="../Blog_Medico.html">Inicio</a></li>
                        <li><a href="creaCitasP.html">Crear cita</a></li>
                        <li><a href="consultaCitasP.html">Consultar citas</a></li>
                        <li><a class="login-button" type="button" style="color: white;" href="login.html">Login</a>
                        </li>
                      </ul>
                </nav>
            </div>
        </div>
    </div>

    <!--Main o contenido-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row mt-3 border border-1 border-opacity-25 rounded-2 " style="background-color: #EEEEEE;">

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
                                <h3>Modificar cita</h3>
                            </div>
                            <div class="col-4 text-end">
                                <img src="../img/LOGO.png" style="width: 180px; height: 170px;"
                                    alt="Descripción de la imagen">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 px-5">
                        <div class="row ">
                            <form action="../php/procesaModificaCS.php" class="form" method="post">
                                <?php
                                    $nombrePaciente = $_GET['D1'];
                                    $fechaCita = $_GET['D2'];
                                    $horaCita = $_GET['D3'];
                                    $sintomasCita = $_GET['D4'];
                                    $descripcionCita = $_GET['D5'];
                                    $IDP = $_GET['D6'];
                                    $IDC = $_GET['D7'];
                                ?>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="row mb-4">
                                            <input hidden type="text" readonly id="IDPaciente" name="IDPaciente"
                                                class="form-control-plaintext" value="<?php echo"$IDP"?>"> 
                                            <input hidden type="text" readonly id="IDCita" name="IDCita"
                                                class="form-control-plaintext" value="<?php echo"$IDC"?>">

                                            <label for="" class="col-2 col-form-label"><h4>Paciente:</h4></label>
                                            <label for="" class="col-2 col-form-label"><h4><?php echo"$nombrePaciente"?></h4></label>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <h4 class="">Datos de la cita:</h4>
                                        </div>
                                        <div class="row py-2 <!--justify-content-center-->">
                                            <label for="" class="col-2 col-form-label">Fecha:</label>
                                            <div class="border-bottom border-secondary col-3 ">
                                                <input type="date" id="fechaPacienteF" name="fechaPacienteF"
                                                    class="form-control-plaintext text-center" value="<?php echo"$fechaCita"?>">
                                            </div>
                                            <div class="col-3">
                                            </div>
                                            <label for="" class="col-2 col-form-label">Hora:</label>
                                            <div class="border-bottom border-secondary col-2">
                                                <input type="time" id="horaPacienteF" name="horaPacienteF"
                                                    class="form-control-plaintext text-center" value="<?php echo"$horaCita"?>">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class=" col-2 col-form-label">Sintomas:</label>
                                            <div class="border-bottom border-secondary col-10 text-start">
                                                <input type="text" id="sintomasPacienteF" name="sintomasPacienteF"
                                                    class="form-control-plaintext" value="<?php echo"$sintomasCita"?>">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label class="col-2 mt-1 col-form-label">Descripcion:</label>
                                            <div class="border-bottom border-secondary col-10 text-start">
                                                <input type="text" id="descripcionPacienteF" name="descripcionPacienteF"
                                                    class="form-control-plaintext" value="<?php echo"$descripcionCita"?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6 text-start my-4">
                                            <a href="consultaCitasS.php"><input type="button" value="Regresar"></a>
                                        </div>
                                        <div class="col-6 text-end my-4">
                                            <input type="submit" value="Modificar">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
         
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
    <script src="../js/creaCitas.js"></script>
    <script src="../js/main.js"></script>

</body>
</html>