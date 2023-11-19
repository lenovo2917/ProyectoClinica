<?php
// Incluye el acceso a la base de datos
include 'acceso.php';

// Recupera el ID del paciente de la sesión
$name = $_SESSION["NombreCompletoP"];

// Consulta para obtener todos los campos del paciente
$sqlSelect = "SELECT * FROM pacientes WHERE NombreCompletoP = $name";

// Ejecuta la consulta
$resultSelect = $dp->query($sqlSelect);

// Verifica si se encontraron resultados
if ($resultSelect && $resultSelect->num_rows > 0) {
    $row = $resultSelect->fetch_assoc();
    // Devuelve los datos como un objeto JSON para ser utilizados en JavaScript
    echo json_encode($row);
} else {
    // Si no se encontraron datos, devuelve un mensaje de error o un objeto vacío
    echo json_encode(array("error" => "No se encontraron datos del paciente"));
}
?>

