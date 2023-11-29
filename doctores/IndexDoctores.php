<?php
session_start();
if(empty($_SESSION["NombreCompleto"])) {
    header("Location:../login.php"); // Si no hay ninguna sesión activa, redirige al login
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
       <link rel="stylesheet" href="../fontawesome/css/all.css" rel="stylesheet">

        <link rel="stylesheet" href="../fontawesome-free-6.4.2-web/css/fontawesome.css"rel="stylesheet">
        <link rel="stylesheet" href="../fontawesome-free-6.4.2-web/css/all.min.css"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">

    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/IndexDoctores.css">
</head>

<body>
   <!--Header-->
<div class="container-fluid-lg mb-5">
    <div class="row">
        <div class="col-12">
            <nav style="display: flex; justify-content: space-between; align-items: center;">
                <div class="logo">
                    <span
                        style="color: #000000; font-size: 26px; font-weight: bold; letter-spacing: 1px; margin-left: 20px;">MEDICATEC</span>
                    <span style="padding: 0.5rem;"><img src="../img/cora2.png" alt="Descripción de la imagen"></span>
                    </div>
                    <div></div>
                    <div class="doctor-info" style="display: flex; align-items: center; margin-right: 20px;">
                        <?php
                        if ($_SESSION["Rol"] === 'doctor') {
                            echo '<span style="color: #000000; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Bienvenido Doctor/a ' . $_SESSION["NombreCompleto"] . '</span>';
                            echo '<span style="margin-right: 20px;"><i class="fas fa-user-md fa-2x"></i></span>';
                        }
                        ?>
                    </div>

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
                  header("Location:../login.php");
                  exit();
              } else if(!isset($_SESSION['sesion_cerrada'])) {
                echo '
                <ul class="nav-links" style="justify-content: end; margin-right: 5rem;">
                <li><a href="../login.php?cerrar_sesion=true" class="login-button"  onclick="return confirm(\'¿Seguro que quieres salir?\')" 
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <!-- Barra de navegación izquierda personalizada -->
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Citas
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <ul>
                                <li>
                                    <a class="accordion-link collapsed" href="../doctores/consultaCitasD.php">
                                        Consultar Citas
                                    </a>
                                </li>
                                <li>
                                    <a class="accordion-link collapsed" href="../doctores/cancelarCitasD.php">
                                        Cancelar Citas
                                    </a>
                                </li>
                                <li>
                                <a class="accordion-link collapsed" href="../doctores/creaResetaD.php?tab=citas">
                                   Crear Citas
                                </a>

                                                                        
                                </li>
                                <li>
                                    <a class="accordion-link collapsed" href="../doctores/consultaCitasD.php">
                                        Modificar Citas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Receta
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <ul>
                                <li>
                                    <a class="accordion-link collapsed" href="../doctores/creaResetaD.php">
                                        Crear Recetas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Paciente
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <ul>
                                <li>
                                    <a class="accordion-link collapsed" href="muestraPacientesD.php">
                                        Consultar Paciente
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-9">
                <!-- Contenido principal -->
                <h1>Perfil</h1>
                
                <?php
              include '../php/acceso.php';

              if ($_SESSION["Rol"] === 'doctor') {
                  // Obtener los datos del doctor
                  $sql = "SELECT * FROM doctores WHERE IDD = '{$_SESSION["ID"]}'"; 
                  $result = mysqli_query($dp, $sql);
              
                  if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th scope="col">Campo</th>';
                          echo '<th scope="col">Valor</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';
                          echo '<tr><td><i class="fas fa-user"></i> Nombre Completo</td><td>' . $row['NombreCompletoD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-birthday-cake"></i> Fecha de Nacimiento</td><td>' . $row['FechaNacimientoD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-toggle-on"></i> Estatus</td><td>' . $row['EstatusD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-tint"></i> Tipo de Sangre</td><td>' . $row['TipoSangreD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-venus-mars"></i> Género</td><td>' . $row['GeneroD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-id-card"></i> CURP</td><td>' . $row['CURPD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-allergies"></i> Alergias</td><td>' . $row['AlergiasD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-phone"></i> Teléfono</td><td>' . $row['TelefonoD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-envelope"></i> Correo</td><td>' . $row['CorreoD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-id-badge"></i> Cédula</td><td>' . $row['CedulaD'] . '</td></tr>';
                          echo '<tr><td><i class="fas fa-user-md"></i> Especialidad</td><td>' . $row['EspecialidadD'] . '</td></tr>';
                          echo '</tbody>';
                          echo '</table>';
                      }
                  } else {
                      echo '<div class="alert alert-danger">No se encontraron datos del doctor.</div>';
                  }
              }
              
               
                ?>
            </div>
        </div>
    </div>
    
    <!--footer-->
    <div class="container-fluid-lg py-5">
        <footer class="bg-dark text-white text-center py-5 mt-5">
            <div class="row">
                <p>&copy; 2023 Medicatec</p>
            </div>
        </footer>
    </div>
    <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
    <script src="../bootstrap/js/bootstrap.js"></script>

</body>

</html>
