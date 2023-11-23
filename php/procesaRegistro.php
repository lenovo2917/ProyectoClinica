
<?php
session_start();
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
// Establecer el estatus como 'activo'
$estatus = "activo";

// Verificar si ya existe un paciente con el mismo CURP
$check_sql = "SELECT * FROM pacientes WHERE CURPP = '$curp'";
$result = $dp->query($check_sql);

if ($result && $result->num_rows > 0) {
    session_start(); // Asegúrate de iniciar la sesión
    $_SESSION['error_message'] = "*Ya existe un paciente con este CURP.*";
    header("Location: /ProyectoClinica/pacientes/registroP.php");
    exit();
} else {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO pacientes (NombreCompletoP, CURPP, fechaP, enfermedadesP, generoP, tipoSangreP, telefonoP, correoP, alergiasP, ContrasenaP, capacidadesdiferentesP, Estatus) 
            VALUES ('$nombreCompleto', '$curp', '$fecha', '$enfermedades', '$genero', '$tipoSangre', '$telefono', '$correo', '$alergias', '$contraseña', '$capacidades', '$estatus')";

    if ($dp->query($sql) == TRUE) { 
        $_SESSION['registrado'] = "*El paciente se registro exitosamente.*";
        header("Location: /ProyectoClinica/login.php");
        exit();
    } else {
        $_SESSION['NO_registrado'] = "*Error al registrar al paciente*".$dp->error;
        header("Location: /ProyectoClinica/pacientes/registroP.php");
    }
}
// Cerrar la conexión a la base de datos
$dp->close();
}
?>
