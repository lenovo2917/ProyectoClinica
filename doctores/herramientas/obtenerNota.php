<?php
include '../../php/acceso.php';

if (isset($_POST['idR'])) {
    $idR = $_POST['idR'];

    $consulta = "SELECT notaConsulta FROM expediente WHERE idR = $idR";
    $resultado = mysqli_query($dp, $consulta);

    if ($resultado) {
        $nota = mysqli_fetch_assoc($resultado);

        // Devuelve la nota como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => true,
            'notaConsulta' => $nota['notaConsulta'],
        ));
    } else {
        // Manejar el error y devolver una respuesta JSON
        echo json_encode(array(
            'success' => false,
            'error' => 'Hubo un error en la consulta: ' . mysqli_error($dp),
        ));
    }
}

mysqli_close($dp);
