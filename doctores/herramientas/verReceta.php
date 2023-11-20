<?php
include '../../php/acceso.php';

if (isset($_POST['idReceta'])) {
    $idR = $_POST['idReceta'];

    $consulta = "SELECT * FROM vista_expediente_recetas WHERE idR = $idR";

    $resultado = mysqli_query($dp, $consulta);

    if ($resultado) {
        $receta = mysqli_fetch_assoc($resultado);

        // Devuelve los datos como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => true,
            'data' => $receta,
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
?>
