<?php
session_start();
if(empty($_SESSION["NombreCompleto"])) {
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
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/doctor.css">
</head>

<body>

    <style>
        nav {
            position: fixed;
            z-index: 1000; /* Asegura que la barra de navegación esté en la parte superior */
        }

        .container {
            margin-top: 80px; /* Ajusta el margen superior del contenido para dar espacio a la barra de navegación */
        }
        /* Agrega estilos CSS para el pie de página */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40; /* Color de fondo del pie de página */
            color: white; /* Color del texto del pie de página */
            text-align: center;
            padding: 1rem;
        }
    </style>
    <!--Header header-->
    <header>
        <div class="container-fluid-lg mb-5">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <div class="logo" style="display: flex;align-items: center;">
                            <span
                                style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                            <span style="padding: 0.5rem;"><img src="../img/cora2.jpeg"
                                    alt="Descripción de la imagen"></span>
                        </div>
                        <div class="hamburger">
                            <div class="line1"></div>
                            <div class="line2"></div>
                            <div class="line3"></div>
                        </div>
                        <ul class="nav-links">
                            <li><a href="../Blog_Medico.php?rol=admin">Inicio</a></li>
                            <li><a href="../admin/creacionUsuarios.php">Crear Usuario</a></li>
                            <li><a class="login-button" type="button" style="color: white;">Admin</a></li> 
                        </ul>
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
    </header>

    <br>
    <br>

    <br>
    <!--Main o contenido-->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container-fluid formato mt-3 mb-3">
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-3 text-start">
                                <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                    alt="Descripción de la imagen" /> 
                            </div>
                            <div class="col-5 text-end">
                                <h2><i class="fa-solid fa-users"></i> Consulta de Usuarios</h2> <!---->
                            </div>
                            <div class="col-3 text-end">
                                <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                    alt="Descripción de la imagen" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped" style="vertical-align: middle;">
                            <tr>
                                <th colspan="5" class="text-center">DOCTORES</th>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <th>CURP</th>
                                <th>Email</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                            <!--<tr>
                                <td>Juan Pérez</td>
                                <td>ABC123456XYZ78901</td>
                                <td>juanperez@example.com</td>
                                <td>Activo</td>
                                <td>
                                    <div class="gap-2 mx-auto form" style="padding: 1rem;">
                                        <a href="modificaUsuariosA.html" type="button">
                                            <button >Modificar</button>
                                        </a>
                                        <a href="eliminaUsuariosA.html" type="button">
                                            <button>Borrar</button>
                                        </a>
                                        <a href="detallesUsuariosA.html" type="button">
                                            <button class="btn btn-info">Detalles</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>-->
                            <?php
                                include '../php/acceso.php';

                                // Muestra los resultados de la consulta (DOCTORES)
                                $sqlD = "SELECT * FROM doctores";
                                $resultD = $dp->query($sqlD);

                                if ($resultD->num_rows > 0) {
                                    while ($rowD = $resultD->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $rowD["NombreCompletoD"] . "</td>";
                                        echo "<td>" . $rowD["CURPD"] . "</td>";
                                        echo "<td>" . $rowD["CorreoD"] . "</td>";
                                        echo "<td>" . $rowD["EstatusD"] . "</td>";
                                        echo "<td>";
                                        echo '<div class="gap-2 mx-auto form" style="padding: 1rem;">';
                                        echo '<a href="modificaUsuariosA.php?idDoctor=' . $rowD["IDD"] . '" type="button"><button>Modificar</button></a>';
                                        echo '&nbsp;';  // Agrega un espacio en blanco entre los botones
                                        echo '<a href="eliminaUsuariosA.php?idDoctor=' . $rowD["IDD"] . '" type="button"><button>Borrar</button></a>';
                                        echo '&nbsp;';  // Agrega otro espacio en blanco entre los botones
                                        echo '<a href="detallesUsuariosA.php?idDoctor=' . $rowD["IDD"] . '" type="button"><button>Detalles</button></a>';
                                        echo '</div>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No hay usuarios (DOCTORES)</td></tr>";
                                }
                            ?>
                        
                            <tr>
                                <th colspan="5" class="text-center">SECRETARIOS</th>
                            </tr>

                            <tr>
                                <th>Nombre</th>
                                <th>CURP</th>
                                <th>Email</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>

                            <?php
                                include '../php/acceso.php';

                                // Muestra los resultados de la consulta (SECRETARIOS)
                                $sqlS = "SELECT * FROM secretarios";
                                $resultS = $dp->query($sqlS);

                                if ($resultS->num_rows > 0) {
                                    while ($rowS = $resultS->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $rowS["NombreCompletoS"] . "</td>";
                                        echo "<td>" . $rowS["CURPS"] . "</td>";
                                        echo "<td>" . $rowS["CorreoS"] . "</td>";
                                        echo "<td>" . $rowS["EstatusS"] . "</td>";
                                        echo "<td>";
                                        echo '<div class="gap-2 mx-auto form" style="padding: 1rem;">';
                                        echo '<a href="modificaUsuariosA.php?idSecretario=' . $rowS["IDS"] . '" type="button"><button>Modificar</button></a>';
                                        echo '&nbsp;';  // Agrega un espacio en blanco entre los botones
                                        echo '<a href="eliminaUsuariosA.php?idSecretario=' . $rowS["IDS"] . '" type="button"><button>Borrar</button></a>';
                                        echo '&nbsp;';  // Agrega otro espacio en blanco entre los botones
                                        echo '<a href="detallesUsuariosA.php?idSecretario=' . $rowS["IDS"] . '" type="button"><button>Detalles</button></a>';
                                        echo '</div>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No hay usuarios (SECRETARIOS)</td></tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>

    <br>
    <!--footer-->
    <footer class="bg-dark text-white text-center py-3">
        <p style="font-family: 'Rubik'; color: white;">&copy; 2023 Medicatec</p>
    </footer>
    </div>
    </div>



    <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
    <script src="../main.js"></script>

</body>

</html>
