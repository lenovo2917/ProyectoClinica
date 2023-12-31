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
    <!--Header-->
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
                            <li><a class="login-button" type="button" style="color: white;">Admin</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <?php
        include '../php/acceso.php';

        // Muestra los resultados de la consulta (DOCTORES)
        // Obtener el ID del doctor o secretario desde la URL
        $idUsuarioD = isset($_GET["idDoctor"]) ? $_GET["idDoctor"] : null;
        $idUsuarioS = isset($_GET["idSecretario"]) ? $_GET["idSecretario"] : null;

        // Realizar la lógica según el tipo de usuario
        if (!empty($idUsuarioD)) {
            $sql = "SELECT 
                NombreCompletoD as nombreU, 
                CURPD as CURPU, 
                FechaNacimientoD as fNU,
                EstatusD as estatusU,
                CedulaD as cedulaU,
                TelefonoD as telefonoU,
                CorreoD as correoU,
                ContrasenaD as contrasenaU,
                AlergiasD as alergiasU,
                GeneroD as generoU,
                TipoSangreD as tipoSangreU,
                EspecialidadD as especialidadU
            FROM doctores WHERE IDD = $idUsuarioD";
        } elseif (!empty($idUsuarioS)) {
            $sql = "SELECT 
                NombreCompletoS as nombreU, 
                CURPS as CURPU,
                FechaNacimientoS as fNU,
                TipoSangreS as tipoSangreU,
                GeneroS as generoU,
                AlergiasS as alergiasU,
                TelefonoS as telefonoU,
                CorreoS as correoU,
                IDD as IDDU,
                ContrasenaS as contrasenaU,
                EstatusS as estatusU
            FROM secretarios WHERE IDS = $idUsuarioS";
        } else {
            echo "ID de usuario no proporcionado";
            exit; // Terminar la ejecución si no se proporciona un ID de usuario válido
        }

        $result = $dp->query($sql);

        if ($result->num_rows > 0) {
            // Imprime el nombre del usuario
            $rowUsuario = $result->fetch_assoc();
            /*echo "Nombre del usuario: " . $rowUsuario["nombreU"];
            echo "CURP del usuario: " . $rowUsuario["CURPU"];
            echo "Fecha del usuario: " . $rowUsuario["fNU"];*/
        } else {
            echo "Usuario no encontrado";
        }
    ?>

    <script>
        function confirmarModificar() {
            // Preguntar al usuario si está seguro de modificar
            var confirmacion = confirm("¿Estás seguro modificar los datos de este usuario?");

            // Devolver true si el usuario hace clic en "Aceptar" y false si hace clic en "Cancelar"
            return confirmacion;
        }
    </script>
    <script src="../js/ValidacionesCampos.js"></script>


    <!--Main o contenido-->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container-fluid formato">
                    <form class="form needs-validation" novalidate method="post" action="../php/procesaModificaUA.php" onsubmit="return confirmarModificar()">                        
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-3 text-start">
                                        <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                            alt="Descripción de la imagen" />
                                    </div>
                                    <div class="col-5 text-center">
                                        <h2><i class="fa-solid fa-users"></i> Modificación de Usuarios</h2> <!---->
                                    </div>
                                    <div class="col-3 text-end">
                                        <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                            alt="Descripción de la imagen" />
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="idDoctor" value="<?php echo $idUsuarioD; ?>"> <!--Estos id son para que los tome procesaModificaUA.php y sepa qué usuario tomar-->
                            <input type="hidden" name="idSecretario" value="<?php echo $idUsuarioS; ?>">

                            <div class="col-8" style="text-align: left;">
                                <label class="form-label" for="nombre">Nombre Completo:</label>
                                <input class="form-control" type="text" id="nombre" name="nombreUsuario" value="<?php echo isset(
                                    $rowUsuario["nombreU"]) ? $rowUsuario["nombreU"] : ''; ?>" required />
                            </div>


                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">CURP:</label>
                                <input class="form-control" type="text" name="CURPUsuario" value ="<?php echo isset(
                                    $rowUsuario["CURPU"]) ? $rowUsuario["CURPU"] : ''; ?>" required />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Fecha de Nacimiento:</label>
                                <input class="form-control" type="date" name="fNUsuario" value ="<?php echo isset(
                                    $rowUsuario["fNU"]) ? $rowUsuario["fNU"] : ''; ?>" required />
                            </div>
                            
                            <div class="col-4" style="text-align: left;">
                                <?php if (!empty($idUsuarioD)) { ?>
                                    <label class="form-label">Cédula Profesional:</label>
                                    <input class="form-control" type="text" name="cedulaUsuario" value ="<?php echo isset(
                                        $rowUsuario["cedulaU"]) ? $rowUsuario["cedulaU"] : ''; ?>" required />
                                <?php }elseif(!empty($idUsuarioS)) { ?>
                                    <label class="form-label">ID Doctor:</label>
                                    <input class="form-control" type="text" name="iddUsuario" value ="<?php echo isset(
                                        $rowUsuario["IDDU"]) ? $rowUsuario["IDDU"] : ''; ?>" required />
                                <?php } ?>
                            </div>


                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Télefono:</label>
                                <input class="form-control" type="tel" name="telefonoUsuario" value ="<?php echo isset(
                                    $rowUsuario["telefonoU"]) ? $rowUsuario["telefonoU"] : ''; ?>" required />
                            </div>
                            <!--maxlength="10"-->
                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Correo:</label>
                                <input class="form-control" type="email" name="correoUsuario" value ="<?php echo isset(
                                    $rowUsuario["correoU"]) ? $rowUsuario["correoU"] : ''; ?>" required />
                            </div>
                            <!--maxlength="25"-->
                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Contraseña:</label>
                                <input class="form-control" type="password" name="contrasenaUsuario" value ="<?php echo isset(
                                    $rowUsuario["contrasenaU"]) ? $rowUsuario["contrasenaU"] : ''; ?>" required
                                    maxlength="8" placeholder="********" />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <?php if (!empty($idUsuarioD)) { ?>
                                <div class="form-group">
                                    <label class="form-label">Especialidad:</label>
                                    <select name="especialidadUsuario" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Especialidad *</option>
                                        <option value="Medico General" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Medico General" ? 'selected' : ''; ?>>Medico General</option>
                                        <option value="Nutricion" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Nutricion" ? 'selected' : ''; ?>>Nutricion</option>
                                        <option value="Oftamologo" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Oftamologo" ? 'selected' : ''; ?>>Oftamologo</option>
                                        <option value="Ginecologo" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Ginecologo" ? 'selected' : ''; ?>>Ginecologo</option>
                                        <option value="Cardiologo" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["especialidadU"] == "Cardiologo" ? 'selected' : ''; ?>>Cardiologo</option>
                                        <option value="Dermatologa" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Dermatologa" ? 'selected' : ''; ?>>Dermatologa</option>
                                        <option value="Internista" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Internista" ? 'selected' : ''; ?>>Internista</option>
                                        <option value="Neurología" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Neurología" ? 'selected' : ''; ?>>Neurología</option>
                                        <option value="Pediatría" <?php echo isset($rowUsuario["especialidadU"]) && $rowUsuario["especialidadU"] == "Pediatría" ? 'selected' : ''; ?>>Pediatría</option>
                                    </select>
                                </div>
                                <?php } ?>
                            </div>
                            <!--maxlength="8"-->
                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Alergias:</label>
                                <input class="form-control" type="text" name="alergiasUsuario" value ="<?php echo isset(
                                    $rowUsuario["alergiasU"]) ? $rowUsuario["alergiasU"] : ''; ?>" required />
                            </div>


                            <div class="col-4" style="text-align: left;">
                                <div class="form-group">
                                    <label class="form-label">Tipo de sangre:</label>
                                    <select name="tipoSangreUsuario" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Tipo de sangre *</option>
                                        <option value="A+" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "A+" ? 'selected' : ''; ?>>A+</option>
                                        <option value="A-" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "A-" ? 'selected' : ''; ?>>A-</option>
                                        <option value="B+" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "B+" ? 'selected' : ''; ?>>B+</option>
                                        <option value="B-" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "B-" ? 'selected' : ''; ?>>B-</option>
                                        <option value="O+" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "O+" ? 'selected' : ''; ?>>O+</option>
                                        <option value="O-" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "O-" ? 'selected' : ''; ?>>O-</option>
                                        <option value="AB+" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "AB+" ? 'selected' : ''; ?>>AB+</option>
                                        <option value="AB-" <?php echo isset($rowUsuario["tipoSangreU"]) && $rowUsuario["tipoSangreU"] == "AB-" ? 'selected' : ''; ?>>AB-</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-4" style="text-align: left;">
                                <div class="form-group">
                                    <label class="form-label">Género:</label>
                                    <select name="generoUsuario" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Género</option>
                                        <option value="F" <?php echo isset($rowUsuario["generoU"]) && $rowUsuario["generoU"] == "F" ? 'selected' : ''; ?>>F</option>
                                        <option value="M" <?php echo isset($rowUsuario["generoU"]) && $rowUsuario["generoU"] == "M" ? 'selected' : ''; ?>>M</option>
                                        <option value="Otro" <?php echo isset($rowUsuario["generoU"]) && $rowUsuario["generoU"] == "Otro" ? 'selected' : ''; ?>>Otro</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <!--<div class="col-4" style="text-align: left;">
                                <div class="form-group">
                                    <label class="form-label">Estatus:</label>
                                    <select name="estatusUsuario" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Estatus</option>
                                        <option value="Activo" <?php echo isset($rowUsuario["estatusU"]) && $rowUsuario["estatusU"] == "Activo" ? 'selected' : ''; ?>>Activo</option>
                                        <option value="Inactivo" <?php echo isset($rowUsuario["estatusU"]) && $rowUsuario["estatusU"] == "Inactivo" ? 'selected' : ''; ?>>Inactivo</option>
                                    </select>
                                </div>
                            </div> Este se quita, solo está para hacer pruebas con el apartado de borrado-->
                            
                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <button type="submit" name="submit">Modificar Usuario</button>
                            </div>

                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <a href="consultaUsuariosA.php" type="button">
                                    <button type="button">Cancelar</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="/main.js"></script>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="/main.js"></script>
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

</body>

</html>

</html>