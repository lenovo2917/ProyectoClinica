<?php
if (isset($_POST['crear_cita'])) {
include 'acceso.php';
// Recoger los datos del formulario
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$sintomas = $_POST['sintomas'];
$descripcion = $_POST['descripcion'];
$alergias = $_POST['alergias'];
$tps = $_POST['tipo_sangre'];

$sql = "INSERT INTO citas (fechaC, HoraC, sintomasC, descripcionC, tipoSangreP, IDP, ESTATUS) 
        VALUES ('$fecha', '$hora', '$sintomas', '$descripcion', '$tps', '$idp', 'pendiente')";

if ($dp->query($sql) == TRUE) {
    echo "Paciente registrado exitosamente.";
} else {
    echo "Error al registrar al paciente: " . $dp->error;
}

// Cerrar la conexión a la base de datos
$dp->close();
}
?>