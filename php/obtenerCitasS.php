<?php
include 'acceso.php';

// Obtener los valores de los campos de filtro
$nombrePaciente = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$mesCita = isset($_POST['mes']) ? $_POST['mes'] : null;

// Inicializar la condición de filtrado
$condicionFiltro = "1";

// Añadir condiciones solo si se proporcionan valores no vacíos
if (!empty($nombrePaciente)) {
    $condicionFiltro .= " AND NombreCompletoP LIKE '%$nombrePaciente%'";
}

if (!empty($mesCita)) {
    $condicionFiltro .= " AND MONTH(fechaC) = $mesCita";
}

// Consulta SQL con la condición de filtrado
$sql = "SELECT nombreCompletoP, fechaC, TIME_FORMAT(horaC, '%H:%i') AS horaC, estatusC 
 FROM pacientes_citas_vista WHERE $condicionFiltro";

$resultado = $dp->query($sql);

// Construir el array asociativo con los resultados
$citas = array();
while ($fila = $resultado->fetch_assoc()) {
    $citas[] = $fila;
}

// Cerrar la conexión
$dp->close();

// Enviar los datos al cliente en formato JSON
echo json_encode($citas);
?>
