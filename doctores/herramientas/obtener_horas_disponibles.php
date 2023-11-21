<?php
// Incluir archivo de conexión
include '../../php/acceso.php';

// Obtener fecha, especialidad y doctor desde la URL
$fecha = $_GET['fecha'];
$especialidad = $_GET['especialidad'];
$doctor = $_GET['doctor']; // Agregar esta línea

// Verificar si la fecha es válida (no en el pasado)
$hoy = date("Y-m-d");
if ($fecha < $hoy) {
    die("La fecha seleccionada está en el pasado.");
}

// Modificar la consulta SQL para incluir el doctor
$sql = "SELECT HoraDisponible FROM horas_disponibles_view WHERE FechaDisponible = '$fecha' AND EspecialidadID = 
'$especialidad' AND DoctorID = '$doctor' AND Estado = 'disponible'";
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
error_log("Horas disponibles para fecha: $fecha, especialidad: $especialidad, doctor: $doctor");

// Cerrar la conexión
$dp->close();
?>
