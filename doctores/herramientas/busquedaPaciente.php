<?php
include '../../php/acceso.php';

if (isset($_POST['buscar'])) {
    $nombrePaciente = $_POST['nombrePaciente'];

    $consulta = "SELECT *, Estatus FROM pacientes WHERE NombreCompletoP = '$nombrePaciente'";
    $resultado = mysqli_query($dp, $consulta);

    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $paciente = mysqli_fetch_assoc($resultado);

            // Verificar si el campo ESTATUS está presente
            $estadoPaciente = isset($paciente['Estatus']) ? $paciente['Estatus'] : '';

            // Si el paciente está inactivo, actualiza el estado y devuelve los datos
          
                // Devuelve los datos como respuesta JSON
                header('Content-Type: application/json');
                echo json_encode(array(
                    'success' => true,
                    'data' => array(
                        'nombre' => $paciente['NombreCompletoP'],
                        'fecha' => $paciente['fechaP'],
                        'tipoSangre' => $paciente['tipoSangreP'],
                        'alergias' => $paciente['alergiasP'],
                        'estado' => $estadoPaciente,
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
            'error' => 'Hubo un error en la consulta: ' . mysqli_error($dp),
        ));
    }
}

mysqli_close($dp);
?>
