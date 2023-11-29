<?php
include('../php/controlador.php');
// Verifica si el usuario ha iniciado sesión como paciente
if(isset($_SESSION["NombreCompleto"]) && $_SESSION["Rol"] === 'paciente') {
    // Accede al nombre completo del paciente
    $nombreCompletoP = $_SESSION["NombreCompleto"];
} else {
    // Si no ha iniciado sesión como paciente, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit();
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
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/creaCitas.css">
</head>

<body>
    <div class="container-fluid-lg" style="background-color: #eeeeee;">
        <div class="row">
            <div class="col-12">
                <!--Header-->
                <div class="container-fluid-lg mb-5">
                    <div class="row">
                        <div class="col-12">
                            <nav>
                                <div class="logo" style="display: flex;align-items: center;">
                                    <span
                                        style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                                    <span style="padding: 0.5rem;"> <img src="../img/cora2.png" alt="Desc"></span>
                                </div>
                                <div class="hamburger">
                                    <div class="line1"></div>
                                    <div class="line2"></div>
                                    <div class="line3"></div>
                                </div>
                                <ul class="nav-links">
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
                    header("Location: ../login.php");
                    exit();
                } else if(!isset($_SESSION['sesion_cerrada'])) {
                  echo '
                  <ul class="nav-links">
                  <li><a href="../login.php?cerrar_sesion=true" class="login-button"  onclick="return confirm(\'¿Seguro que quieres salir?\')" 
                  style="color: white;">
                  Cerrar Sesión </a>
              </li>
              </ul>';
                }else {   
            }
            unset($_SESSION['sesion_cerrada']);
            ?>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

            <!--Main o contenido-->
            <div class="container" style="text-align: center; margin-top: 100px;">
                <h4 style="font-family: 'DM Serif Display';">¡Hola, <?php
          if(isset($_SESSION["NombreCompleto"]) && $_SESSION["Rol"] === 'paciente') {
          // Accede al nombre completo del paciente
          $nombreCompletoP = $_SESSION["NombreCompleto"];
          echo $nombreCompletoP;
           } ?>!
                </h4>
                <h1><img src="../img/li.png" style="width: 40px; height: 40px; margin-right: 10px; margin-bottom: 7px;"
                        alt="Des">Agende una nueva cita:</h1>

                <form id="citaForm" action="../php/procesaCitaP.php" method="post">
                    <img src="../img/ct.png" alt="img" style="width: 180px; height: 170px;">
                    <label for="fechaCita">Fecha de Cita:</label>
                    <input type="date" id="fechaCita" name="fecha" required><br>

                    <label for="hora">Hora cita:</label>
                    <select class="form-control-sm" id="hora" name="hora" required>
                        <option value="" disabled selected>Seleccione una hora</option>
                    </select><br>
                    
                    <label for="sintomas">Síntomas:</label>
                    <textarea id="sintomas" name="sintomas" rows="4" placeholder="Ingrese sus sintomas"
                        required></textarea><br>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        placeholder="Ingrese descripción de padecimiento"></textarea><br>

                    <input type="submit" name="crear_cita" value="Realizar cita">
                    <input type="reset" value="Borrar"
                        style="background-color: #176b87; color: #fff; padding-top: 8px;
        margin-top: 30px; margin-left: 15px; border: none; border-radius: 3px; cursor: pointer; width: 10%; height: 5%; text-decoration: none;">
                    <a class="b" href="../Blog_Medico.php?rol=paciente"
                        style="background-color: #176b87; color: #fff; float: left; padding-top: 8px;
        margin-top: 30px; margin-left: 100px; border: none; border-radius: 3px; cursor: pointer; width: 20%; height: 5%; text-decoration: none;">Regresar</a>
                </form>
            </div>

            <!--footer-->
            <div class="container-fluid-lg py-5">
                <footer class="bg-dark text-center py-5 mt-5">
                    <div class="row">
                        <p style="color: white;">&copy; 2023 Medicatec</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="../js/creaCitas.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/FechaCalendario.js"></script> <!-- SCRIPT PARA FECHA-->
    <script src="../js/Busqueda_horas.js"></script> <!-- SCRIPT PARA HORAS-->
</body>

</html>