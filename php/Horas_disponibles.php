<?php
// Incluir archivo de conexión
include './acceso.php';

// Obtener fecha desde el URL
$fecha = $_GET['fecha'];

// Verificar si la fecha es válida (no en el pasado)
$hoy = date("Y-m-d");
if ($fecha < $hoy) {
    die("La fecha seleccionada está en el pasado.");
}

// Modificar la consulta SQL para incluir solo la fecha y la especialidad 'Medico General'
$sql = "SELECT FechaDisponible, HoraDisponible FROM horas_disponibles_view WHERE EspecialidadID = 'Medico General'
AND Estado = 'disponible' AND FechaDisponible = '$fecha' GROUP BY FechaDisponible, HoraDisponible HAVING COUNT(*) > 0";
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
error_log("Horas disponibles para fecha: $fecha y especialidad 'Medico General'");

// Cerrar la conexión
$dp->close();
?>
