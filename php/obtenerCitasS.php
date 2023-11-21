<?php
include 'acceso.php';

// Obtener los valores de los campos de filtro
$nombrePaciente = $_POST['nombre'];
$mesCita = $_POST['mes'];

// Inicializar la condición de filtrado
$condicionFiltro = "pacientes.NombreCompletoP = '$nombreCompletoP'";

// Añadir condiciones solo si se proporcionan valores no vacíos
if (!empty($nombrePaciente)) {
    $condicionFiltro .= " AND pacientes.NombreCompletoP LIKE '%$nombrePaciente%'";
}

if (!empty($mesCita)) {
    $condicionFiltro .= " AND MONTH(citas.fechaC) = $mesCita";
}

// Consulta SQL con la condición de filtrado
$sql = "SELECT citas.IDC, citas.fechaC, citas.HoraC, citas.ESTATUS
        FROM citas
        JOIN pacientes ON citas.IDP = pacientes.IDP 
        WHERE $condicionFiltro";

$resultado = $conexion->query($sql);

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
