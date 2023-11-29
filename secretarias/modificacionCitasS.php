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
                    <?php 
                        $rol=$_SESSION['Rol'];
                        // Incluye barraNavegacion.php antes de llamar a la función generarMenu
                        include('../php/barraNavegacion.php');
                  
                        // Llama a la función generarMenu con el rol del usuario
                        generarMenu($rol);
                    ?>
                    <?php
                        if(isset($_GET['cerrar_sesion'])) {
                            // Eliminar las cookies de sesión
                            if (ini_get("session.use_cookies")) {
                                $params = session_get_cookie_params();
                                setcookie(session_name(), '', time() - 42000,
                                    $params["path"], $params["domain"],
                                    $params["secure"], $params["httponly"]
                                );
                            }
                            // Destruir la sesión
                            session_unset();
                            session_destroy();
                            $_SESSION = array();
                            // Redirigir a la página de inicio de sesión
                            header("Location: login.php");
                            exit();
                        } else if(!isset($_SESSION['sesion_cerrada'])) {
                            echo '
                            <ul class="nav-links" style="justify-content: end; margin-right: 5rem;">
                            <li><a href="/ProyectoClinica/login.php?cerrar_sesion=true" class="login-button"  onclick="return confirm(\'¿Seguro que quieres salir?\')" 
                            style="color: white;">
                            Cerrar Sesión </a>
                            </li>
                            </ul>';
                        }else {   
                        }
                        unset($_SESSION['sesion_cerrada']);
                    ?>
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
                                    <div class="col">
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
                        <form action="../php/procesaModificaCS.php" class="row needs-validation" novalidate method="post">
                            <?php
                                $nombrePaciente = $_GET['D1'];
                                $fechaCita = $_GET['D2'];
                                $horaCita = $_GET['D3'];
                                $sintomasCita = $_GET['D4'];
                                $descripcionCita = $_GET['D5'];
                                $IDP = $_GET['D6'];
                                $IDC = $_GET['D7'];
                            ?>
                            <div class="col-12 mb-2">
                                <label class="col-form-label"><h3>Paciente: <?php echo"$nombrePaciente"?></h3></label>
                            </div>
                            <div class="col-12 mt-2">
                                <h4 class="">Datos de la cita:</h4>
                            </div>
                            <div class="col-12">
                                <input hidden type="text" readonly id="IDPaciente" name="IDPaciente"
                                    class="form-control" value="<?php echo"$IDP"?>"> 
                                <input hidden type="text" readonly id="IDCita" name="IDCita"
                                    class="form-control" value="<?php echo"$IDC"?>">
                            </div>
                            <div class="col-3">
                                <label for="" class="col-form-label">Fecha:</label>
                                <input type="date" id="fechaPacienteF" name="fechaPacienteF"
                                    class="form-control text-center" required value="<?php echo"$fechaCita"?>">
                                <div class="invalid-feedback">Campo obligatorio*</div>

                            </div>
                            <div class="col-2">
                                <label for="" class="col-form-label">Hora:</label>
                                <input type="time" id="horaPacienteF" name="horaPacienteF"
                                    class="form-control text-center" required value="<?php echo"$horaCita"?>">
                                <div class="invalid-feedback">Campo obligatorio*</div>
                                
                            </div>
                            <div class="col-7">
                                <label for="" class="col-form-label">Sintomas:</label>
                                <input type="text" id="sintomasPacienteF" name="sintomasPacienteF"
                                    class="form-control" value="<?php echo"$sintomasCita"?>">
                            </div>
                            <div class="col-12">
                                <label class="col-form-label">Descripcion:</label>
                                <input type="text" id="descripcionPacienteF" name="descripcionPacienteF"
                                    class="form-control" value="<?php echo"$descripcionCita"?>">
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

      <!--footer-->
      <div class="container-fluid-lg ">
        <footer class="bg-dark text-center py-5 mt-5">
            <div class="row">
                <p style="color: white;">&copy; 2023 Medicatec</p>
            </div>
        </footer>
    </div>
         
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/creaCitas.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/ValidacionesCampos.js"></script>


</body>
</html>