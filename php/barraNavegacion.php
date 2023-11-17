<?php
function generarMenu($rolUsuario) {
    if ($rolUsuario === "paciente") {
        echo '<ul>'
        '<li><a href="pacientes/creaCitasP.html">Crear cita</a></li>'
        '<li><a href="pacientes/consultaCitasP.php">Consultar citas</a></li>'
        '<li><a class="login-button" type="button" style="color: white;">Paciente</a></li>'
        '</ul>';
    } elseif ($rolUsuario === "admin") {
        echo '<li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>';
        echo '<li><a href="admin/consultaUsuariosA.php">Usuarios</a></li>';
        echo '<li><a class="login-button" type="button" style="color: white;">Admin</a></li>';

        echo '<li><a href="pacientes/consultaCitasP.html">Consultar citas</a></li>';
        echo '<li><a class="login-button" style="co lor: white;">Paciente</a></li>';
        echo '<li><a href="pacientes/creaCitasP.php">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.php">Consultar citas</a></li>';
        echo '<li><button class="login-button" style="color: white;">Paciente</button></li>';
    } elseif ($rolUsuario === "admin") {
        echo '<li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>';
        echo '<li><a href="admin/consultaUsuariosA.html">Usuarios</a></li>';
        echo '<li><button class="login-button" style="color: white;">Admin</button></li>';
    }
    elseif ($rolUsuario === "secretario") {
        echo '<li><a href="/secretarias/muestraPacientesS.php">Pacientes</a></li>';
        echo '<li><a href="/proyectoClinica/secretarias/creacionCitasS.php">Crear cita</a></li>';
        echo '<li><a href="/proyectoClinica/secretarias/consultaCitasS.php">Consultar Citas</a></li>';
        echo '<li><button class="login-button" style="color: white;">Secretario</button></li>';
    }
}
?>
