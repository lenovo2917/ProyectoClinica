<?php
function generarMenu($rolUsuario) {
    if ($rolUsuario === "paciente") {
        echo '<ul class="nav-links">
        <li><a href="/ProyectoClinica/pacientes/creaCitasP.php">Crear cita</a></li>
        <li><a href="/ProyectoClinica/pacientes/consultaCitasP.php">Consultar citas</a></li>
        </ul>';
    } elseif ($rolUsuario === "admin") {
        echo '<ul class="nav-links">
        <li><a href="admin/creacionUsuarios.html">Crear usuario</a></li>
        <li><a href="admin/consultaUsuariosA.php">Usuarios</a></li>
        <li><button class="login-button" style="color: white;">Admin</button></li>
        </ul>';
    }elseif ($rolUsuario === "secretario") {
        echo '<ul class="nav-links">
        <li><a href="/proyectoClinica/secretarias/muestraPacientesS.php">Pacientes</a></li>
        <li><a href="/proyectoClinica/secretarias/creacionCitasS.php">Crear cita</a></li>
        <li><a href="/proyectoClinica/secretarias/consultaCitasS.php">Consultar Citas</a></li>
        </ul>';
    }
}
?>
