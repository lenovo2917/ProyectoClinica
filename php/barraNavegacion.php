<?php
function generarMenu($rolUsuario) {
    if ($rolUsuario === "paciente") {
        echo '<ul>'
        echo ''
        echo '<li><a href="pacientes/creaCitasP.html">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.php">Consultar citas</a></li>';
        echo '<li><a class="login-button" type="button" style="color: white;">Paciente</a></li>';

    } elseif ($rolUsuario === "admin") {
        echo '<li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>';
        echo '<li><a href="admin/consultaUsuariosA.php">Usuarios</a></li>';
        echo '<li><a class="login-button" type="button" style="color: white;">Admin</a></li>';
=======
        echo '<li><a href="pacientes/consultaCitasP.html">Consultar citas</a></li>';
        echo '<li><a class="login-button" style="co lor: white;">Paciente</a></li>';
        echo '<li><a href="pacientes/creaCitasP.php">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.php">Consultar citas</a></li>';
        echo '<li><button class="login-button" style="color: white;">Paciente</button></li>';
    } elseif ($rolUsuario === "admin") {
        echo '<li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>';
        echo '<li><a href="admin/consultaUsuariosA.html">Usuarios</a></li>';
        echo '<li><button class="login-button" style="color: white;">Admin</button></li>';
>>>>>>> a5be06d253891c35d10d6bf825d5ae1e35856628
>>>>>>> c6fae43364db1ab62a2592f271039c208436fc3f
    }
    elseif ($rolUsuario === "secretario") {
        echo '<li><a href="/secretarias/muestraPacientesS.php">Pacientes</a></li>';
        echo '<li><a href="/proyectoClinica/secretarias/creacionCitasS.php">Crear cita</a></li>';
        echo '<li><a href="/proyectoClinica/secretarias/consultaCitasS.php">Consultar Citas</a></li>';
        echo '<li><button class="login-button" style="color: white;">Secretario</button></li>';
    }
}
?>
