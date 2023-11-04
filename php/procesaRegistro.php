
<?php
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

if ($conn->query($sql) === TRUE) {
    echo "Paciente registrado exitosamente.";
} else {
    echo "Error al registrar al paciente: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
}
?>
