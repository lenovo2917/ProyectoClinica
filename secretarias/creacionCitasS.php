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
                <div class="row mt-3 border border-1  border-opacity-25 rounded-2 " style="background-color: #EEEEEE;">
                    <div class="col-12 px-5 mt-3">
                        <a href="/proyectoClinica/Blog_Medico.php"> 
                            <button type=""><i class="fa-solid fa-person-walking-arrow-loop-left" style="color: #ffffff;"></i> Ir a inicio</button>
                        </a>
                    </div>
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
                            <form id="citaForm" action="../php/procesaCreacionCS.php" class="needs-validation" novalidate method="post">
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 mt-4">
                                            <h4 class="">Datos de la cita:</h4>
                                        </div>
                                        <div class="col-7">
                                            <label for="nombrePacienteF" class="col-form-label">Paciente:</label>
                                            <input type="text" readonly id="nombrePacienteF" name="nombrePacienteF"
                                                class="form-control" style="border: none; background-color: #EEEEEE;" required>
                                            <div class="invalid-feedback">Campo obligatorio*</div>
                                        </div>
                                        <div class="col-5">
                                            <label for="" class="col-form-label">CURP:</label>
                                            <input type="text" readonly id="curpPacienteF" name="curpPacienteF"
                                                class="form-control" style="border: none; background-color: #EEEEEE;" >
                                        </div>
                                        <div class="col-3">
                                            <label for="sangrePacienteF" class="col-form-label">tipo de sangre:</label>
                                            <input type="text" readonly id="sangrePacienteF" name="sangrePacienteF"
                                                class="form-control" style="border: none; background-color: #EEEEEE;" >
                                        </div>
                                        <div class="col-9">
                                            <label for="" class="col-form-label">Alergias:</label>
                                            <input type="text" readonly id="alergiasPacienteF"  
                                                name="alergiasPacienteF" style="border: none; background-color: #EEEEEE;"  class="form-control">
                                        </div>
                                        <div class="col-3">
                                            <label for="fechaPacienteF" class="col-form-label">Fecha:</label>
                                            <input type="date" id="fechaPacienteF" name="fechaPacienteF"
                                                class="form-control" style="border: none; background-color: #cecece;"  required>                                                    
                                            <div class="invalid-feedback">Campo obligatorio*</div>
                                        </div>
                                        <div class="col-2">
                                            <label for="horaPacienteF" class="col-form-label">Hora:</label>
                                            <select  id="horaPacienteF" name="horaPacienteF"
                                                class="form-control" style="border: none; background-color: #cecece;" required>
                                            </select>
                                            <div class="invalid-feedback">Campo obligatorio*</div>
                                        </div>
                                        <div class="col-7">
                                            <label for="sintomasPacienteF" class="col-form-label">Sintomas:</label>
                                            <input type="text" id="sintomasPacienteF" name="sintomasPacienteF"
                                                class="form-control" style="border: none; background-color: #cecece;" >
                                        </div>
                                        <div class="col-12">
                                            <label for="descripcionPacienteF" class="col-form-label">Descripcion:</label>
                                            <input type="text" id="descripcionPacienteF" name="descripcionPacienteF"
                                                class="form-control" style="border: none; background-color: #cecece;" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end my-4">
                                    <input class="botonCrear" type="submit" value="Crear cita">
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
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/buscarPaciente.js"></script>
    <script src="../js/FechaCalendario.js"></script>
    <script src="../js/creaCitasS.js"></script>
    <script src="../js/ValidacionesCampos.js"></script>
    <script src="../js/Busqueda_horas.js"></script> <!-- SCRIPT PARA HORAS-->
</body>

</html>