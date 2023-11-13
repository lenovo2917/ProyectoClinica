<?php
include '../../php/acceso.php';

if (isset($_POST['idR']) && isset($_POST['notaConsulta'])) {
    // Obtener datos y asegurarlos contra inyección SQL
    $idR = mysqli_real_escape_string($dp, $_POST['idR']);
    $nuevaNota = mysqli_real_escape_string($dp, $_POST['notaConsulta']);

    // Crear una sentencia preparada
    $consulta = "UPDATE expediente SET notaConsulta = ? WHERE idR = ?";
    $stmt = mysqli_prepare($dp, $consulta);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "si", $nuevaNota, $idR);

    // Ejecutar la sentencia preparada
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
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

    // Cerrar la sentencia preparada
    mysqli_stmt_close($stmt);
}

// Cerrar la conexión a la base de datos
mysqli_close($dp);
?>

