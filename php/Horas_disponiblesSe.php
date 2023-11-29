<?php
session_start();
include './acceso.php';

// Obtener fecha desde el URL
$fecha = $_GET['fecha'];

// Verificar si la fecha es válida (no en el pasado)
$hoy = date("Y-m-d");
if ($fecha < $hoy) {
    die("La fecha seleccionada está en el pasado.");
}

// Filtrar por el ID de la Secretaria
if (isset($_SESSION["IDS"])) {
    $IDSecretaria = $_SESSION["IDS"];
    
    // Obtener el IDD asociado al IDS desde la tabla de secretarios
    $sqlIDD = "SELECT IDD FROM secretarios WHERE IDS = '$IDSecretaria'";
    $resultIDD = $dp->query($sqlIDD);

    if ($resultIDD->num_rows > 0) {
        $rowIDD = $resultIDD->fetch_assoc();
        $IDD = $rowIDD['IDD'];
        
        // Modificar la consulta para incluir la especialidad del médico
        $sql = "SELECT FechaDisponible, HoraDisponible FROM horas_disponibles_view 
                WHERE Estado = 'disponible' AND FechaDisponible = '$fecha' AND DoctorID = '$IDD' 
                GROUP BY FechaDisponible, HoraDisponible HAVING COUNT(*) > 0";
        
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
        error_log("Horas disponibles para fecha: $fecha y especialidad del médico asociado con IDD: $IDD");
        
    } else {
        echo "Error: No se encontró el IDD asociado al IDS.";
    }

    // Liberar resultado
    $resultIDD->free();
    
} else {
    echo "Error: IDS no disponible.";
}

// Cerrar la conexión
$dp->close();
?>
