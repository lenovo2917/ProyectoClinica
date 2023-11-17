<?php
include('acceso.php');

// Obtener el nombre del paciente desde la solicitud POST
$nombrePaciente = $_POST['nombrePaciente'];

// Consulta SQL para buscar al paciente
$consulta = "SELECT * FROM pacientes WHERE nombreCompletoP = '$nombrePaciente'";

$resultado = $dp->query($consulta);
// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Convertir resultados a formato JSON y enviarlos
    $fila = $resultado->fetch_assoc();
    echo json_encode($fila);
} else {
    // Enviar un mensaje si no se encontraron resultados
    echo json_encode(['mensaje' => 'Paciente: '. $nombrePaciente .' no encontrado']);
}

// Cerrar la conexión
$dp->close();
?>
