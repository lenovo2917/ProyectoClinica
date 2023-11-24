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
                            <li><a href="../doctores/IndexDoctores.php">Inicio</a></li>
                          </ul>
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
            echo "Id de paciente no proporcionado";

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
                    <form class="form" method="post" action="../php/procesaModificaPD.php">
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-3 text-start">
                                        <img src="../img/LOGO.png" 
                                            style="width: 200px; height: 190px;" alt="Descripción de la imagen" />
                                    </div>
                                    <div class="col-6 text-center">
                                        <h2><i class="fa-solid fa-check"></i> Modificación de Pacientes</h2> <!---->
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
                                    $rowPaciente["nombreP"]) ? $rowPaciente["nombreP"] : ''; ?>" required />
                            </div>
                            <div class="col-6" style="text-align: left; padding: 1rem;" >
                                <label class="form-label">CURP:</label>
                                <input class="form-control" readonly type="text" placeholder="CURP *" required maxlength="18"
                                    title="Ingrese correctamente su CURP" name="CURPPaciente" value ="<?php echo isset(
                                    $rowPaciente["CURPP"]) ? $rowPaciente["CURPP"] : ''; ?>" required />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label">Fecha de Nacimiento:</label>
                                <input class="form-control" type="date" placeholder="Fecha de Nacimiento *" name="fNPaciente" value ="<?php echo isset(
                                    $rowPaciente["fNP"]) ? $rowPaciente["fNP"] : ''; ?>" required />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label">Télefono:</label>
                                <input class="form-control" type="tel" placeholder="Teléfono" maxlength="10"
                                    title="Ingrese un formato válido (xxx-xxx-xxxx)" name="telefonoPaciente" value ="<?php echo isset(
                                    $rowPaciente["telefonoP"]) ? $rowPaciente["telefonoP"] : ''; ?>" required />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label">Correo:</label>
                                <input class="form-control" type="email" placeholder="ejemplo@gmail.com" required
                                     title="ejemplo@gmail.com" name="correoPaciente" value ="<?php echo isset(
                                    $rowPaciente["correoP"]) ? $rowPaciente["correoP"] : ''; ?>" required />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label">Contraseña:</label>
                                <input class="form-control" type="password" placeholder="Contraseña *" name="contrasenaPaciente" value ="<?php echo isset(
                                    $rowPaciente["contrasenaP"]) ? $rowPaciente["contrasenaP"] : ''; ?>" required
                                    maxlength="8" placeholder="********" />
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
    <label class="form-label">Capacidades diferentes:</label>
    <!--<input class="form-control" type="text" placeholder="Capacidades diferentes" maxlength="20"
    title="Sea especifico" />-->
    <input class="form-control" type="text" id="capacidades" 
        placeholder="Capacidades diferentes...." name="capacidadesPaciente" value ="<?php echo isset(
        $rowPaciente["capacidadesP"]) ? $rowPaciente["capacidadesP"] : ''; ?>" required />
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <label class="form-label">Alergias:</label>
    <!--<input class="form-control" type="text" placeholder="Alergias" maxlength="20"
    title="Sea especifico" />-->
    <input class="form-control" type="text" id="alergias" placeholder="Alergias...."name="alergiasPaciente" value ="<?php echo isset(
        $rowPaciente["alergiasP"]) ? $rowPaciente["alergiasP"] : ''; ?>" required />
</div>
<div class="col-4" style="text-align: left; padding: 1rem;">
    <label class="form-label">Enfermedades patológicas:</label>
    <!--<input class="form-control" type="text" placeholder="Enfermedades patológicas" maxlength="20"
    title="Sea especifico" />-->
    <input class="form-control" type="text" id="enfermedades" name="enfermedadesPaciente" placeholder="Enfermedades patológicas...." value ="<?php echo isset(
        $rowPaciente["enfermedadesP"]) ? $rowPaciente["enfermedadesP"] : ''; ?>" required />
</div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Tipo de sangre:</label>
                                    <select name="tipoSangrePaciente" id="tipo-sangre" required class="formato2"
                                        style="width: 100%;">
                                        <option value="" disabled selected>Tipo de sangre *</option>
                                        <option value="A+" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "A+" ? 'selected' : ''; ?>>A+</option>
                                        <option value="A-" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "A-" ? 'selected' : ''; ?>>A-</option>
                                        <option value="B+" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "B+" ? 'selected' : ''; ?>>B+</option>
                                        <option value="B-" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "B-" ? 'selected' : ''; ?>>B-</option>
                                        <option value="O+" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "O+" ? 'selected' : ''; ?>>O+</option>
                                        <option value="O-" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "O-" ? 'selected' : ''; ?>>O-</option>
                                        <option value="AB+" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "AB+" ? 'selected' : ''; ?>>AB+</option>
                                        <option value="AB-" <?php echo isset($rowPaciente["tipoSangreP"]) && $rowPaciente["tipoSangreP"] == "AB-" ? 'selected' : ''; ?>>AB-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Género:</label>
                                    <select name="generoPaciente" id="genero" class="formato2" style="width: 100%;">
                                    <option value="F" <?php echo isset($rowPaciente["generoP"]) && $rowPaciente["generoP"] == "F" ? 'selected' : ''; ?>>F</option>
                                        <option value="M" <?php echo isset($rowPaciente["generoP"]) && $rowPaciente["generoP"] == "M" ? 'selected' : ''; ?>>M</option>
                                        <option value="Otro" <?php echo isset($rowPaciente["generoP"]) && $rowPaciente["generoP"] == "Otro" ? 'selected' : ''; ?>>Otro</option>
                                    </select>
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
                            <div class="col-4"></div>
                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <button type="submit" type="button"><i class="fa-solid fa-file-arrow-down" style="color: #ffffff;"></i> Modificar Paciente</button>
                            </div>

                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <a href="../doctores/muestraPacientesD.php" type="button"> 
                                    <button type="button"> <i class="fa-solid fa-person-walking-arrow-loop-left" style="color: #ffffff;"></i> Regresar</button>
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