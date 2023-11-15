<?php
// Recuperar el id del paciente de la URL
$id = $_GET['id'];

// Realizar una consulta para obtener los datos del paciente con el id proporcionado
$sql = "SELECT NombreCompletoP, CURPP, correoP, Estatus FROM pacientes WHERE CURPP = '$id'";
$result = $dp->query($sql);

// Verificar si hay errores en la consulta
if (!$result) {
    die("Error en la consulta: " . $dp->error);
}

// Verificar si hay datos para mostrar
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Ahora puedes utilizar los datos para llenar el formulario o realizar otras acciones
    // ...
} else {
    echo "No se encontró el paciente con ID: $id";
}

// Cerrar la conexión a la base de datos
$dp->close();
?>
 



