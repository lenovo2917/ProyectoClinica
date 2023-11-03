<?php
include '../../php/acceso.php';
if (isset($_POST['citaID'], $_POST['doctorID'])) {
    $citaID = $_POST['citaID'];
    $doctorID = $_POST['doctorID'];

    // Actualiza la tabla citas con el nuevo médico
    $query = "UPDATE citas SET IDD = ? WHERE IDC = ?";
    
    // Prepara la consulta
    $stmt = mysqli_prepare($dp, $query);
    
    if ($stmt) {
        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt, 'ii', $doctorID, $citaID);
        
        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Cita trasladada con éxito.";
        } else {
            echo "Error al trasladar la cita.";
        }
        
        // Cierra la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta.";
    }
} else {
    echo "Datos insuficientes para realizar el traslado de la cita.";
}
?>
