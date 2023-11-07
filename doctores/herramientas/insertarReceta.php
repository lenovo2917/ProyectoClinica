<?php
include '../../php/acceso.php';

// Valores obtenidos de las variables
$fecha = $_POST['fecha'];
$medicamento = $_POST['medicamento'];
$intruccionUsoR = $_POST['intruccionUsoR'];

// Para obtener el IDP (ID del paciente) a partir del nombre completo
$nombreCompleto = trim($_POST['nombre'] . ' ' . $_POST['apellidoP'] . ' ' . $_POST['apellidoM']); 
$nombreCompleto = $dp->real_escape_string($nombreCompleto);

$sqlSelectPaciente = "SELECT IDP FROM pacientes WHERE NombreCompletoP = '$nombreCompleto'";
$resultPaciente = $dp->query($sqlSelectPaciente);

if ($resultPaciente->num_rows > 0) {
    $rowPaciente = $resultPaciente->fetch_assoc();
    $IDP = $rowPaciente['IDP'];

    // Ahora que tenemos el IDP, podemos buscar el IDC e IDD
    $sqlSelectCita = "SELECT IDC, IDD FROM citas WHERE IDP = $IDP ORDER BY IDC DESC LIMIT 1";
    $resultCita = $dp->query($sqlSelectCita);

    if ($resultCita->num_rows > 0) {
        $rowCita = $resultCita->fetch_assoc();
        $IDC = $rowCita['IDC'];
        $IDD = $rowCita['IDD'];

        // Construye la consulta SQL con los valores de las variables
        $sqlInsertReceta = "INSERT INTO recetas (fechaR, medicamentoR, intruccionUsoR, IDD, IDC, IDP) 
                            VALUES ('$fecha', '$medicamento', '$intruccionUsoR', $IDD, $IDC, $IDP)";
        
        if ($dp->query($sqlInsertReceta) === TRUE) {
            // La inserción fue exitosa, puedes enviar una respuesta JSON
            $response = array('success' => true, 'message' => 'Cambios realizados');
            echo json_encode($response);
        } else {
            // La inserción falló
            $response = array('success' => false);
            echo json_encode($response);
        }
    } else {
        // No se encontraron citas para este paciente, maneja este caso según tus requerimientos
        $response = array('success' => false, 'message' => 'No se encontraron citas para este paciente.');
        echo json_encode($response);
    }
} else {
    // El paciente no existe en la tabla de pacientes, debes manejar este caso según tus requerimientos
    $response = array('success' => false, 'message' => 'El paciente no existe en la tabla de pacientes.');
    echo json_encode($response);
}

$dp->close();

?>
