<?php
function generarMenu($rolUsuario) {
    if ($rolUsuario === "paciente") {
        echo '<li><a href="pacientes/creaCitasP.html">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.html">Consultar citas</a></li>';
        echo '<li><a class="login-button" style="color: white;">Paciente</a></li>';
        echo '<li><a href="pacientes/creaCitasP.php">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.php">Consultar citas</a></li>';
        echo '<li><a class="login-button" style="color: white;">Paciente</a></li>';
    } elseif ($rolUsuario === "admin") {
        echo '<li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>';
        echo '<li><a href="admin/consultaUsuariosA.html">Usuarios</a></li>';
        echo '<li><a class="login-button" style="color: white;">Admin</a></li>';
    }
    elseif ($rolUsuario === "secretario") {
<<<<<<< HEAD
        echo '<li><a href="/secretarias/muestraPacientesS.php">Pacientes</a></li>';
        echo '<li><a href="/proyectoClinica/secretarias/creacionCitasS.php">Crear cita</a></li>';
        echo '<li><a href="/proyectoClinica/secretarias/consultaCitasS.php">Consultar Citas</a></li>';
        echo '<li><a class="login-button" type="button" style="color: white;">Secretario</a></li>';
=======
        echo '<li><a href="secretarias/muestraPacientesS.php">Pacientes</a></li>';
        echo '<li><a href="secretarias/creacionCitasS.html">Crear cita</a></li>';
        echo '<li><a href="secretarias/muestraCitasS.html">Consultar Citas</a></li>';
        echo '<li><a class="login-button" style="color: white;">Secretario</a></li>';
>>>>>>> 68d41a72dd947a6b481461d50388280883bc4ec1
    }
}
?>
