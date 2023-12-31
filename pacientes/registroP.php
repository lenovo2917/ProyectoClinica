<?php
session_start(); // Asegúrate de iniciar la sesión en la página registroP.php
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
    <link rel="stylesheet" type="text/css" href="../css/registro.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
</head>

<body>
    <div class="container-fluid-lg ">
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
                            </nav>
                        </div>
                    </div>
                </div>
                <!--Main o contenido-->
                <div class="container-fluid formato mt-5 mb-2">
                    <form class="form needs-validation" novalidate action="../php/procesaRegistro.php" method="post">
                        <div class="row ">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-3 text-start">
                                        <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                            alt="Descripción de la imagen">
                                    </div>
                                    <div class="col-6 ">
                                        <h1><i class="fa-solid fa-hospital-user"></i> Registro de pacientes</h1>
                                    </div>
                                    <div class="col-3"></div>
                                </div>
                            </div>
                            
                            <?php
if (isset($_SESSION['error_message'])) {
    $mensaje = $_SESSION['error_message'];
    echo "<div class='alert alert-danger'>$mensaje</div>";
    unset($_SESSION['error_message']); // Limpiar el mensaje después de mostrarlo
}
if (isset($_SESSION['NO_registrado'])) {
    $mensaje = $_SESSION['NO_registrado'];
    echo "<div class='alert alert-danger'>$mensaje</div>";
    unset($_SESSION['NO_registrado']); // Limpiar el mensaje después de mostrarlo
}
?>
                            <div class="col-6" style="text-align: left;padding: 1rem;">
                                <label class="form-label" for="nombre">Nombre Completo:</label>
                                <input class="form-control" name="nombre" id="nombre" type="text" placeholder="Nombre Completo *" required />
                            </div>
                            <div class="col-6" style="text-align: left; padding: 1rem;" >
                                <label class="form-label" for="curp">CURP:</label>
                                <input class="form-control" id="curp" name="curp" type="text" placeholder="CURP *" required maxlength="18"
                                    title="Ingrese correctamente su CURP" />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="fecha">Fecha de Nacimiento:</label>
                                <input class="form-control"id="fecha" name="fechanacimiento" type="date" placeholder="Fecha de Nacimiento *" required />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="telefono">Télefono:</label>
                                <input class="form-control" id="telefono" name="telefono" type="tel" placeholder="Teléfono" maxlength="10"
                                    title="Ingrese un formato válido (xxxxxxxxxx)" />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="email">Correo:</label>
                                <input class="form-control" id="email" name="correo" type="email" placeholder="ejemplo@gmail.com" 
                                 title="ejemplo@gmail.com" />
                            </div>
                            <div class="col-3" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="pass">Contraseña:</label>
                                <input class="form-control" id="pass" name="contraseña" type="password" placeholder="Contraseña *" required
                                    maxlength="6" title="letra minúscula,mayúscula,número y un carácter especial" />
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="capacidades">Capacidades diferentes:</label>
                                <!--<input class="form-control" type="text" placeholder="Capacidades diferentes" maxlength="20"
                                title="Sea especifico" />-->
                                <input class="form-control" type="text" id="capacidades" 
                            placeholder="Capacidades diferentes...." name="capacidadesPaciente"/>
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="alergias">Alergias:</label>
                                <!--<input class="form-control" type="text" placeholder="Alergias" maxlength="20"
                                title="Sea especifico" />-->
                                <input class="form-control" type="text" id="alergias" 
                            placeholder="Alergias...." name="alergiasPaciente"/>
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <label class="form-label" for="enfermedades">Enfermedades patológicas:</label>
                                <!--<input class="form-control" type="text" placeholder="Enfermedades patológicas" maxlength="20"
                                title="Sea especifico" />-->
                                <input class="form-control" type="text" id="enfermedades" name="enfermedades" placeholder="Enfermedades patológicas...."/>
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <div class="form-group">
                                    <label  class="form-label" for="tipo-sangre">Tipo de sangre:</label>
                                    <select name="tiposangre" id="tipo-sangre" required class="formato2"
                                        style="width: 100%;">
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
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                                <div class="form-group">
                                    <label class="form-label" for="genero">Género:</label>
                                    <select name="genero" id="genero" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Género</option>
                                        <option value="F">F</option>
                                        <option value="M">M</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4" style="text-align: left; padding: 1rem;">
                            <input type="hidden" name="estatus" value="activo">
                            <!--<div class="form-group">
                                    <label class="form-label">Estatus:</label>
                                    <select name="estatus" id="estatus" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Estatus</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>-->    
                            

                            <!-- <div class="col-9">
                            <div class="form-group">
                                <select name="estatus" id="estatus" class="formato2" style="width: 100%;">
                                    <option value="" disabled selected>Estatus</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-12 " style="padding: 0.5rem; text-align: left;">
                            <label class="form-label" for="estatus">Estatus Activo:</label>
                            <input type="checkbox" id="estatus" name="estatus" checked disabled>disabled-->
                         </div>
                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <button type="submit" name="crear_paciente" type="button"><i class="fa-solid fa-hospital-user" style="color: #ffffff;"></i> Crear</button>
                            </div>
                            <div>
                                <p class="">¿Ya registrado? <a style="color: #176B87;" href="../login.php">Iniciar
                                        sesión</a></p>
                            </div>

                        </div>
                    </form>

                </div>
                <!--footer-->
                <div class="container-fluid-lg ">
                    <footer class="bg-dark text-center py-5 mt-5">
                        <div class="row">
                            <p style="color: white;">&copy; 2023 Medicatec</p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
        <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/ValidacionesCampos.js"></script>
</body>

</html>