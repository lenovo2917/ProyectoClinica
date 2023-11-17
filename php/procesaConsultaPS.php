<?php
include 'acceso.php';

// Recupera el ID del paciente de la sesión
$userID = $_SESSION["idp"];

// Consulta para obtener los datos del paciente
$sqlSelect = "SELECT * FROM pacientes WHERE IDP = $userID";

// Ejecuta la consulta
$resultSelect = $dp->query($sqlSelect);

// Verifica si se encontraron resultados
if ($resultSelect && $resultSelect->num_rows > 0) {
    // Obtiene los datos del paciente
    $row = $resultSelect->fetch_assoc();
    
    // Guarda los datos en variables
    $nombreP = $row["NombreCompletoP"];

    // Aquí puedes utilizar los datos obtenidos, por ejemplo, mostrarlos en un formulario
    // o realizar alguna operación con ellos.

    // Muestra los datos obtenidos (solo como ejemplo, puedes hacer lo que necesites con estos datos)
    echo "Nombre del paciente: " . $nombreP;
} else {
    echo "No se encontraron datos del paciente";
}
?>
