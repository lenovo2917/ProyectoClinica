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
    <link rel="shortcut icon" href="../img/web.png" type="img">
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

    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <!--Header-->
                <div class="container-fluid-lg ">
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
                                <ul class="nav-links">
                                    <li><a href="../Blog_Medico.php?rol=admin">Inicio</a></li>
                                    <li><a href="consultaUsuariosA.php">Consultar pacientes</a></li>
                                        
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
            </div>

            <!--Main o contenido-->
            <div class="container-fluid formato mt-5 mb-2">
                <form class="form needs-validation" novalidate method="post" action="../php/crearUsuariosA.php"
                    onsubmit="return confirmarCreacion()">
                    <div class="row ">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-3 text-start">
                                    <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                        alt="Descripción de la imagen">
                                </div>
                                <div class="col-6 ">
                                    <h1><i class="fa-solid fa-users"></i> Creación de Usuarios</h1>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Rol:</label>
                                    <select name="rolUsuario" id="rolUsuario" required class="formato2"
                                        style="width: 100%;">
                                        <option value="" disabled selected>Tipo de rol*</option>
                                        <option value="tipoDoctor">Doctor</option>
                                        <option value="tipoSecretario">Secretario</option>
                                    </select>
                                </div>

                                <div class="col-4" id="especialidadContainer" style="text-align: left; display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Especialidad:</label>
                                        <select name="especialidadUsuario" class="formato2" style="width: 100%;">
                                            <option value="" disabled selected>Especialidad *</option>
                                            <option value="Medico General">Medico General</option>
                                            <option value="Nutricion">Nutricion</option>
                                            <option value="Oftamologo">Oftamologo</option>
                                            <option value="Ginecologo">Ginecologo</option>
                                            <option value="Cardiologo">Cardiologo</option>
                                            <option value="Dermatologa">Dermatologa</option>
                                            <option value="Internista">Internista</option>
                                            <option value="Neurología">Neurología</option>
                                            <option value="Pediatría">Pediatría</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4" id="cedulaContainer" style="text-align: left;">
                                    <label class="form-label">Cedula:</label>
                                    <input class="form-control" type="text" required name="cedulaUsuario" placeholder="Cedula" maxlength="20" title="Sea especifico" />
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Obtén la referencia al campo de selección del rol y al campo de cédula
                                        var rolSelect = document.getElementById("rolUsuario");
                                        var especialidadContainer = document.getElementById("especialidadContainer");
                                        var cedulaContainer = document.getElementById("cedulaContainer");
                                        var crearUsuarioButton = document.querySelector('button[type="submit"]');

                                        // Función para mostrar u ocultar el campo de especialidad y cédula según el rol seleccionado
                                        function toggleFields() {
                                            if (rolSelect.value === "tipoDoctor") {
                                                especialidadContainer.style.display = "block";
                                                cedulaContainer.style.display = "block";
                                                crearUsuarioButton.style.marginTop = "1rem"; // Ajusta el margen superior del botón
                                            } else if (rolSelect.value === "tipoSecretario") {
                                                especialidadContainer.style.display = "none";
                                                cedulaContainer.style.display = "none";
                                                crearUsuarioButton.style.marginTop = "1rem"; // Ajusta el margen superior del botón
                                            }
                                        }

                                        // Llama a la función al cargar la página para configurar el estado inicial
                                        toggleFields();

                                        // Agrega un evento de cambio al campo de selección del rol
                                        rolSelect.addEventListener("change", toggleFields);
                                    });

                                    function confirmarCreacion() {
                                        // Preguntar al usuario si está seguro de crear
                                        var confirmacion = confirm("¿Estás seguro de que quieres crear este usuario?");

                                        // Devolver true si el usuario hace clic en "Aceptar" y false si hace clic en "Cancelar"
                                        return confirmacion;
                                    }
                                </script>

                            </div>
                        </div>
                        <div class="col-8" style="text-align: left;">
                            <label class="form-label" for="nombre">Nombre Completo:</label>
                            <input class="form-control" type="text" id="nombre" name="nombreUsuario" placeholder="Nombre Completo *"
                                required />
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <label class="form-label" for="curp">CURP:</label>
                            <input class="form-control" type="text" id="curp" name="CURPUsuario" placeholder="CURP *" required maxlength="18"
                                title="Ingrese correctamente su CURP" />
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <label class="form-label" for="fecha">Fecha de Nacimiento:</label>
                            <input class="form-control" type="date" id="fecha" name="fNUsuario" placeholder="Fecha de Nacimiento *"
                                required />
                        </div>
                        
                        <div class="col-4" style="text-align: left;">
                            <label class="form-label" for="telefono">Télefono:</label>
                            <input class="form-control" type="tel" id="telefono" name="telefonoUsuario" placeholder="Teléfono" maxlength="10"
                                title="Ingrese un formato válido (xxx-xxx-xxxx)" />
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <label class="form-label" for="correo">Correo:</label>
                            <input class="form-control" type="email" if="correo" name="correoUsuario" placeholder="ejemplo@gmail.com" required
                                title="ejemplo@gmail.com" />
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <label class="form-label" for="contraseña">Contraseña:</label>
                            <input class="form-control" type="password" id="contraseña" name="contrasenaUsuario" placeholder="Contraseña *"
                                required maxlength="8" title="**" />
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <label class="form-label" for="alergias">Alergias:</label>
                            <input class="form-control" type="text" id="alergias" name="alergiasUsuario" placeholder="Alergias" maxlength="20"
                                title="Sea especifico" />
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <div class="form-group">
                                <label class="form-label">Tipo de sangre:</label>
                                <select name="tipoSangreUsuario" required class="formato2" style="width: 100%;">
                                    <option value="" disabled selected>Tipo de sangre *</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4" style="text-align: left;">
                            <div class="form-group">
                                <label class="form-label" id="genero">Género:</label>
                                <select name="generoUsuario" class="formato2" style="width: 100%;">
                                    <option value="" disabled selected>Género</option>
                                    <option value="F">F</option>
                                    <option value="M">M</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4" style="text-align: left;">
                                <input class="form-control" type="hidden" name="estatusUsuario" value ="Activo" required readonly/>
                        </div>

                        <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                            <button type="submit">Crear Usuario</button>
                        </div>
                    </div>
                </form>
            </div>

            <!--footer-->
            <footer class="bg-dark text-white text-center py-3">
                <p style="font-family: 'Rubik'; color: white;">&copy; 2023 Medicatec</p>
            </footer>
        </div>
    </div>

    <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/ValidacionesCampos.js"></script>

</body>

</html>
