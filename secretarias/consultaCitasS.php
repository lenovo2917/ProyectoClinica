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
                                <h3>Consultar citas</h3>
                            </div>
                            <div class="col-4 text-end">
                                <img src="../img/LOGO.png" style="width: 180px; height: 170px;"
                                    alt="Descripción de la imagen">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-5">
                        <div class="my-3">
                            <a href="/proyectoClinica/Blog_Medico.php"> 
                                <button type=""><i class="fa-solid fa-person-walking-arrow-loop-left" style="color: #ffffff;"></i> Ir a inicio</button>
                            </a>
                        </div>
                        <form class="form" method="post">
                            <div class="row ">
                                <div class="col-12 text-center">
                                    <?php
                                        if(isset($_SESSION['mensajeModificacion'])) {
                                            $mensaje = $_SESSION['mensajeModificacion'];
                                            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">';
                                            echo '<i class="fa-solid fa-circle-exclamation" style="color: #0d6efd;"></i> '.$mensaje;
                                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                            echo '</div>';
                                            unset($_SESSION['mensajeModificacion']);
                                        }
                                        if(isset($_SESSION['mensajeEliminacion'])) {
                                            $mensaje = $_SESSION['mensajeEliminacion'];
                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'; 
                                            echo '<i class="fa-solid fa-eraser" style="color: #660909;"></i>'.$mensaje;
                                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                            echo '</div>';
                                            unset($_SESSION['mensajeEliminacion']);
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
                                <div class="col-12">
                                    <div class="row mb-1">
                                        <label for="nombre" class="col-2 col-form-label">Buscar por nombre:</label>
                                        <div class="col-5 text-start">
                                            <input type="text" class="form-control" id="nombrePaciente"
                                                name="nombrePaciente" value="">
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
                                
                                <div class="col-12 mt-4">
                                    <div class=" row mb-4 rounded-1" id="listaPacientes"
                                        style="background-color: white; height: 500px; overflow-y: auto;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/consultarCitasS.js"></script>
    <script src="../js/main.js"></script>

</body>

</html>