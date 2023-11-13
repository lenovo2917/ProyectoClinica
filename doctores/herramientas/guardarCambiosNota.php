<?php
include '../../php/acceso.php';

if (isset($_POST['idR']) && isset($_POST['notaConsulta']) && isset($_POST['medicamento']) && isset($_POST['Diagnostico'])) {
    // Obtener datos y asegurarlos contra inyección SQL
    $idR = mysqli_real_escape_string($dp, $_POST['idR']);
    $nuevaNota = mysqli_real_escape_string($dp, $_POST['notaConsulta']);
    $nuevoMedicamento = mysqli_real_escape_string($dp, $_POST['medicamento']);
    $nuevoDiagnostico = mysqli_real_escape_string($dp, $_POST['Diagnostico']);

    // Obtener el IDC correspondiente al IDR
    $consultaIDC = "SELECT IDC FROM recetas WHERE IDR = ?";
    $stmtIDC = mysqli_prepare($dp, $consultaIDC);
    mysqli_stmt_bind_param($stmtIDC, "i", $idR);
    mysqli_stmt_execute($stmtIDC);
    mysqli_stmt_bind_result($stmtIDC, $idCita);
    mysqli_stmt_fetch($stmtIDC);
    mysqli_stmt_close($stmtIDC);
    
    // Actualizar diagnosticoC en la tabla citas
    $consultaCitas = "UPDATE citas SET diagnosticoC = ? WHERE IDC = ?";
    $stmtCitas = mysqli_prepare($dp, $consultaCitas);
    mysqli_stmt_bind_param($stmtCitas, "si", $nuevoDiagnostico, $idCita);
    $resultadoCitas = mysqli_stmt_execute($stmtCitas);

    // Actualizar notaConsulta en la tabla expediente
    $consultaExpediente = "UPDATE expediente SET notaConsulta = ? WHERE IDR = ?";
    $stmtExpediente = mysqli_prepare($dp, $consultaExpediente);
    mysqli_stmt_bind_param($stmtExpediente, "si", $nuevaNota, $idR);
    $resultadoExpediente = mysqli_stmt_execute($stmtExpediente);

    // Actualizar medicamentoR en la tabla recetas
    $consultaRecetas = "UPDATE recetas SET medicamentoR = ? WHERE IDR = ?";
    $stmtRecetas = mysqli_prepare($dp, $consultaRecetas);
    mysqli_stmt_bind_param($stmtRecetas, "si", $nuevoMedicamento, $idR);
    $resultadoRecetas = mysqli_stmt_execute($stmtRecetas);


    // Verificar resultados y devolver respuesta JSON
    if ($resultadoExpediente && $resultadoRecetas && $resultadoCitas) {
        // Devuelve una respuesta JSON indicando éxito
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    } else {
        // Manejar el error y devolver una respuesta JSON
        echo json_encode(array(
            'success' => false,
            'error' => 'Hubo un error en la consulta: ' . mysqli_error($dp),
        ));

        // Agregar mensajes de consola o error_log
        error_log('Error en la consulta: ' . mysqli_error($dp));
    }

    // Cerrar las sentencias preparadas
    mysqli_stmt_close($stmtExpediente);
    mysqli_stmt_close($stmtRecetas);
    mysqli_stmt_close($stmtCitas);
}

// Cerrar la conexión a la base de datos
mysqli_close($dp);
?>
