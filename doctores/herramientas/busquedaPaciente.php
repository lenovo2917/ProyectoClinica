<?php
include '../../php/acceso.php';

if (isset($_POST['buscar'])) {
    $nombrePaciente = $_POST['nombrePaciente'];

    $consulta = "SELECT * FROM pacientes WHERE NombreCompletoP = '$nombrePaciente'";
    $resultado = mysqli_query($dp, $consulta);  // Cambiado a $dp

    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $paciente = mysqli_fetch_assoc($resultado);

            // Devuelve los datos como respuesta JSON
            header('Content-Type: application/json');
            echo json_encode(array(
                'success' => true,
                'data' => array(
                    'nombre' => $paciente['NombreCompletoP'],
                    'fecha' => $paciente['fechaP'],
                    'tipoSangre' => $paciente['tipoSangreP'],
                    'alergias' => $paciente['alergiasP'],
                ),
            ));
        } else {
            // No se encontraron resultados
            echo json_encode(array(
                'success' => false,
                'error' => 'No se encontraron pacientes con ese nombre.',
            ));
        }
    } else {
        // Manejar el error y devolver una respuesta JSON
        echo json_encode(array(
            'success' => false,
            'error' => 'Hubo un error en la consulta: ' . mysqli_error($dp),  // Cambiado a $dp
        ));
    }
}

mysqli_close($dp);  // Cambiado a $dp
?>

