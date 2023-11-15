<?php
// Incluir archivo de conexión
include '../../php/acceso.php';

// Obtener especialidad desde la URL
$especialidad = $_GET['especialidad'];

// Obtener los nombres de los doctores para la especialidad seleccionada
$sql = "SELECT IDD, NombreCompletoD FROM doctores WHERE EspecialidadD = '$especialidad' AND EstatusD = 'Activo'";
$result = $dp->query($sql);

if ($result->num_rows > 0) {
    // Construir las opciones para los nombres de los doctores
    $opciones = "";
    while ($row = $result->fetch_assoc()) {
        $opciones .= "<option value='{$row['IDD']}'>{$row['NombreCompletoD']}</option>";
    }

    echo $opciones;
} else {
    echo "<option value='' disabled>No hay doctores disponibles</option>";
}

// Cerrar la conexión
$dp->close();
?>
