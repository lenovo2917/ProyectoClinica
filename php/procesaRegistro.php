
<?php
session_start(); // Inicia la sesión si no está iniciada
if (isset($_POST['crear_paciente'])) {
include 'acceso.php';
// Recoger los datos del formulario
$nombreCompleto = $_POST['nombre'];
$curp = $_POST['curp'];
$fecha = $_POST['fechanacimiento'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$capacidades = $_POST['capacidades'];
$alergias = $_POST['alergias'];
$capacidades = $_POST['capacidades'];
$enfermedades = $_POST['enfermedades'];
$tipoSangre = $_POST['tiposangre'];
$genero = $_POST['genero'];
$estatus = $_POST['estatus'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO pacientes (NombreCompletoP, CURPP, fechaP, enfermedadesP, generoP, tipoSangreP, telefonoP, correoP, alergiasP, ContrasenaP, capacidadesdiferentesP, Estatus) 
        VALUES ('$nombreCompleto', '$curp', '$fecha', '$enfermedades', '$genero', '$tipoSangre', '$telefono', '$correo', '$alergias', '$contraseña', '$capacidades', '$estatus')";

if ($dp->query($sql) == TRUE) {
    $_SESSION['mensaje'] = "El paciente se ha registrado exitosamente.";
    header("Location: /ProyectoClinica/login.php");
    exit();
} else {
    $_SESSION['error'] = "Error al registrar al paciente: " . $dp->error;
}

// Cerrar la conexión a la base de datos
$dp->close();
}
?>
