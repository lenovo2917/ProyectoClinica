<?php
// Incluir archivo de conexión
include '../../php/acceso.php';

// Obtener fecha y especialidad desde la URL
$fecha = $_GET['fecha'];
$especialidad = $_GET['especialidad'];

// Verificar si la fecha es válida (no en el pasado)
$hoy = date("Y-m-d");
if ($fecha < $hoy) {
    die("La fecha seleccionada está en el pasado.");
}

// Obtener las horas disponibles para la fecha y especialidad
$sql = "SELECT HoraDisponible FROM horas_disponibles_view WHERE FechaDisponible = '$fecha' AND EspecialidadID = '$especialidad' AND Estado = 'disponible'";
$result = $dp->query($sql);

if ($result->num_rows > 0) {
    // Construir las opciones para las horas disponibles
    $opciones = "";
    while ($row = $result->fetch_assoc()) {
        $opciones .= "<option value='{$row['HoraDisponible']}'>{$row['HoraDisponible']}</option>";
    }

    echo $opciones;
} else {
    echo "<option value='' disabled>No hay horas disponibles</option>";
}

// Agregar log
error_log("Horas disponibles para fecha: $fecha, especialidad: $especialidad");

// Cerrar la conexión
$dp->close();
?>
