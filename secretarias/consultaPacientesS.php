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
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/doctor.css">
</head>

<body>

    <!--Header-->
    <header>
        <div class="container-fluid-lg">
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
    </header>

    <?php
        include '../php/acceso.php';

        // Muestra los resultados de la consulta (Pacientes)
        // Obtener el ID del paciente
        $idP = isset($_GET["idPaciente"]) ? $_GET["idPaciente"] : null;

        if (!empty($idP)) {
            $sql = "SELECT 
                NombreCompletoP as nombreP, 
                CURPP as CURPP, 
                fechaP as fNP,
                enfermedadesP as enfermedadesP,
                capacidadesdiferentesP as capacidadesP,  
                Estatus as estatusP,
                telefonoP as telefonoP,
                correoP as correoP,
                ContrasenaP as contrasenaP,
                alergiasP as alergiasP,
                generoP as generoP,
                tipoSangreP as tipoSangreP
            FROM pacientes WHERE IDP = $idP";
        } else {
            header("Location: ../secretarias/muestraPacientesS.php");
            exit; // Terminar la ejecución si no se proporciona un ID de usuario válido
        }

        $result = $dp->query($sql);

        if ($result->num_rows > 0) {
            // Imprime el nombre del usuario
            $rowPaciente = $result->fetch_assoc();
        } else {
            echo "Paciente no encontrado";
        }
    ?>
    
    <!--Main o contenido-->
    <div class="container">

        <div class="row">
            <div class="col">
                <div class="container-fluid formato mt-5 mb-2">
                    <form class="form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-3 text-start">
                                        <img src="../img/LOGO.png" 
                                            style="width: 200px; height: 190px;" alt="Descripción de la imagen" />
                                    </div>
                                    <div class="col-6 text-center">
                                        <h2><i class="fa-solid fa-hospital-user"></i> Consulta de Pacientes</h2> <!---->
                                    </div>
                                    <div class="col-3 text-end">
                                        <img src="../img/LOGO.png" 
                                            style="width: 200px; height: 190px;" alt="Descripción de la imagen" />
                                    </div>
                                    
                                </div>
                            </div>

                            <input type="hidden" name="idPaciente" value="<?php echo $idP; ?>"> <!--Estos id son para que los tome procesaModificaUA.php y sepa qué usuario tomar-->

                            <div class="col-6" style="text-align: left;padding: 1rem;">
    <label class="form-label">Nombre Completo:</label>
    <input class="form-control" type="text" placeholder="Nombre Completo *" name="nombrePaciente" value="<?php echo isset(
        $rowPaciente["nombreP"]) ? $rowPaciente["nombreP"] : ''; ?>" required readonly/>
</div>
<div class="col-6" style="text-align: left; padding: 1rem;" >
    <label class="form-label">CURP:</label>
    <input class="form-control" type="text" placeholder="CURP *" required maxlength="18"
        title="Ingrese correctamente su CURP" name="CURPPaciente" value ="<?php echo isset(
        $rowPaciente["CURPP"]) ? $rowPaciente["CURPP"] : ''; ?>" required readonly/>
</div>
<div class="col-3" style="text-align: left; padding: 1rem;">
    <label class="form-label">Fecha de Nacimiento:</label>
    <input class="form-control" type="date" placeholder="Fecha de Nacimiento *" name="fNPaciente" value ="<?php echo isset(
        $rowPaciente["fNP"]) ? $rowPaciente["fNP"] : ''; ?>" required readonly/>
</div>
<div class="col-3" style="text-align: left; padding: 1rem;">
    <label class="form-label">Télefono:</label>
    <input class="form-control" type="tel" placeholder="Teléfono" maxlength="10"
        title="Ingrese un formato válido (xxx-xxx-xxxx)" name="telefonoPaciente" value ="<?php echo isset(
        $rowPaciente["telefonoP"]) ? $rowPaciente["telefonoP"] : ''; ?>" required readonly/>
</div>
<div class="col-3" style="text-align: left; padding: 1rem;">
    <label class="form-label">Correo:</label>
    <input class="form-control" type="email" placeholder="ejemplo@gmail.com" required
        maxlength="8" title="ejemplo@gmail.com" name="correoPaciente" value ="<?php echo isset(
        $rowPaciente["correoP"]) ? $rowPaciente["correoP"] : ''; ?>" required readonly />
</div>
<div class="col-3" style="text-align: left; padding: 1rem;">
    <label class="form-label">Contraseña:</label>
    <input class="form-control" type="password" placeholder="Contraseña *" name="contrasenaPaciente" value ="<?php echo isset(
        $rowPaciente["contrasenaP"]) ? $rowPaciente["contrasenaP"] : ''; ?>" required readonly
        maxlength="8" placeholder="********" />
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <label class="form-label">Capacidades diferentes:</label>
    <!--<input class="form-control" type="text" placeholder="Capacidades diferentes" maxlength="20"
    title="Sea especifico" />-->
    <input class="form-control" type="text" id="capacidades" 
        placeholder="Capacidades diferentes...." name="capacidadesPaciente" value ="<?php echo isset(
        $rowPaciente["capacidadesP"]) ? $rowPaciente["capacidadesP"] : ''; ?>" required readonly/>
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <label class="form-label">Alergias:</label>
    <!--<input class="form-control" type="text" placeholder="Alergias" maxlength="20"
    title="Sea especifico" />-->
    <input class="form-control" type="text" id="alergias" placeholder="Alergias...."name="alergiasPaciente" value ="<?php echo isset(
        $rowPaciente["alergiasP"]) ? $rowPaciente["alergiasP"] : ''; ?>" required readonly/>
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <label class="form-label">Enfermedades patológicas:</label>
    <!--<input class="form-control" type="text" placeholder="Enfermedades patológicas" maxlength="20"
    title="Sea especifico" />-->
    <input class="form-control" type="text" id="enfermedades" name="enfermedadesPaciente" placeholder="Enfermedades patológicas...." value ="<?php echo isset(
        $rowPaciente["enfermedadesP"]) ? $rowPaciente["enfermedadesP"] : ''; ?>" required readonly />
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <div class="form-group">
        <label class="form-label">Tipo de sangre:</label>
        <input name="tipoSangrePaciente" id="tipo-sangre" required class="formato2" 
            style="width: 100%;" readonly value="<?php echo isset($rowPaciente["tipoSangreP"]) ? $rowPaciente["tipoSangreP"] : ''; ?>"/>
    </div>
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <div class="form-group">
        <label class="form-label">Género:</label>
        <input name="generoPaciente" id="genero" class="formato2" style="width: 100%;" readonly  value="<?php echo isset($rowPaciente["generoP"]) ? $rowPaciente["generoP"] : ''; ?>"/>
    </div>
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
            <!--      <div class="form-group">
                <label class="form-label">Estatus:</label>
                <select name="estatusPaciente" id="estatus" class="formato2" style="width: 100%;">
                <option value="" disabled selected>Estatus</option>
                    <option value="Activo" <?php echo isset($rowPaciente["estatusP"]) && $rowPaciente["estatusP"] == "Activo" ? 'selected' : ''; ?>>Activo</option>
                    <option value="Inactivo" <?php echo isset($rowPaciente["estatusP"]) && $rowPaciente["estatusP"] == "Inactivo" ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>-->
</div>
<div class="d-grid gap-2 col-6 mx-auto" style="padding: 1rem;">
                            <a href="../secretarias/muestraPacientesS.php" type="button"> 
                                    <button type="button"><i class="fa-solid fa-person-walking-arrow-loop-left" style="color: #ffffff;"></i> Regresar</button>
                                </a>
                            </div>
</div>
</form>
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
<script src="../bootstrap/js/bootstrap.esm.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/creaCitas.js"></script>
<script src="../main.js"></script>

</body>
</html>