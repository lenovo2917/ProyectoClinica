<?php
session_start();

// Verifica si el usuario ha iniciado sesión como paciente
if(isset($_SESSION["NombreCompletoP"]) && $_SESSION["Rol"] === 'paciente') {
    // Accede al nombre completo del paciente
    $nombreCompletoP = $_SESSION["NombreCompletoP"];
} else {
    // Si no ha iniciado sesión como paciente, redirige a la página de inicio de sesión
    header("Location: login.php");
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
                                    <span style="padding: 0.5rem;"> <img src="../img/cora2.png"
                                            alt="Desc"></span>
                                </div>
                                <div class="hamburger">
                                    <div class="line1"></div>
                                    <div class="line2"></div>
                                    <div class="line3"></div>
                                </div>
                                <ul class="nav-links">
                                    <li><a href="../Blog_Medico.php?rol=paciente">Inicio</a></li>
                                    <li><a href="consultaCitasP.html">Consultar citas</a></li>
                                    <li><a class="login-button" type="button" style="color: white;" href="login.html">Login</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            
            <!--Main o contenido-->
    <div class="container" style="text-align: center; margin-top: 100px;">
    
    <h1><img src="../img/li.png" style="width: 40px; height: 40px; margin-right: 10px; margin-bottom: 7px;" alt="Des">Agendar nueva cita</h1>

    <form id="citaForm" action="../php/procesaCitaP.php" method="post">
        <label for="fecha">Fecha de Cita:</label>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="hora">Hora cita:</label>
        <input type="time" id="hora" name="hora" required><br>

        <label for="sintomas">Síntomas:</label>
        <textarea id="sintomas" name="sintomas" rows="4" placeholder="Ingrese sus sintomas" required></textarea><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Ingrese descripción de padecimiento"></textarea><br>

        <label for="alergias">Alergias:</label>
        <input type="text" id="alergias" name="alergias" placeholder="Ingrese alergias si presenta"><br>

        <input type="submit" name="crear_cita" value="Realizar cita">
        <input type="reset" value="Limpiar" style="background-color: #176b87; color: #fff; padding-top: 8px;
        margin-top: 30px; margin-left: 15px; border: none; border-radius: 3px; cursor: pointer; width: 10%; height: 6%; text-decoration: none;">
        <a class="b" href="../Blog_Medico.php?rol=paciente" style="background-color: #176b87; color: #fff; float: left; padding-top: 8px;
        margin-top: 30px; margin-left: 40px; border: none; border-radius: 3px; cursor: pointer; width: 30%; height: 6%; text-decoration: none;">Regresar</a>
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
</body>
</html>