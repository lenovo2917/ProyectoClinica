<?php
function generarMenu($rolUsuario) {
    if ($rolUsuario === "paciente") {
<<<<<<< HEAD
        echo '<li><a href="pacientes/creaCitasP.html">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.html">Consultar citas</a></li>';
        echo '<li><a class="login-button" style="color: white;">Paciente</a></li>';
=======
        echo '<li><a href="pacientes/creaCitasP.php">Crear cita</a></li>';
        echo '<li><a href="pacientes/consultaCitasP.php">Consultar citas</a></li>';
        echo '<li><a class="login-button" type="button" style="color: white;">Paciente</a></li>';
>>>>>>> 13bf0fc426c2887b9659e1b90cce8b63f9bbeb36
    } elseif ($rolUsuario === "admin") {
        echo '<li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>';
        echo '<li><a href="admin/consultaUsuariosA.html">Usuarios</a></li>';
        echo '<li><a class="login-button" style="color: white;">Admin</a></li>';
    }
    elseif ($rolUsuario === "secretario") {
        echo '<li><a href="secretarias/muestraPacientesS.php">Pacientes</a></li>';
        echo '<li><a href="secretarias/creacionCitasS.html">Crear cita</a></li>';
        echo '<li><a href="secretarias/muestraCitasS.html">Consultar Citas</a></li>';
        echo '<li><a class="login-button"  style="color: white;">Secretario</a></li>';
    }
}
?>
