<?php
include '../../php/acceso.php';

// Valores obtenidos de las variables
$fecha = $_POST['fecha'];
$medicamento = $_POST['medicamento'];
$intruccionUsoR = $_POST['intruccionUsoR'];
$diagnostico = $_POST['diagnostico'];


// Para obtener el IDP (ID del paciente) a partir del nombre completo
$nombreCompleto = trim($_POST['nombre'] . ' ' . $_POST['apellidoP'] . ' ' . $_POST['apellidoM']); 
$nombreCompleto = $dp->real_escape_string($nombreCompleto);

$sqlSelectPaciente = "SELECT IDP FROM pacientes WHERE NombreCompletoP = '$nombreCompleto'";
$resultPaciente = $dp->query($sqlSelectPaciente);

if ($resultPaciente->num_rows > 0) {
    $rowPaciente = $resultPaciente->fetch_assoc();
    $IDP = $rowPaciente['IDP'];

    // Obtener el IDC del campo oculto
    $IDC = $_POST['IDC'];

    // Ahora que tenemos el IDP, podemos buscar el IDD
    $sqlSelectCita = "SELECT IDD, fechaC, ESTATUS FROM citas WHERE IDC = $IDC";
    $resultCita = $dp->query($sqlSelectCita);

    if ($resultCita->num_rows > 0) {
        $rowCita = $resultCita->fetch_assoc();
        $IDD = $rowCita['IDD'];
        $fechaCita = $rowCita['fechaC'];
        $estatusCita = $rowCita['ESTATUS'];

        // Verificar si la fecha de la cita coincide con la fecha del formulario
        if ($fechaCita !== $_POST['fecha']) {
            $response = array('success' => false, 'message' => "La fecha de la cita ($fechaCita) no coincide con la fecha del formulario ({$_POST['fecha']}).");
            echo json_encode($response);
        } else {
            // Verificar si la cita está en estatus "pendiente"
            if ($estatusCita !== 'pendiente') {
                $response = array('success' => false, 'message' => 'La cita no está en estatus "pendiente".');
                echo json_encode($response);
            } else {
                // Verificar si ya existe una receta para esta cita
                $sqlCheckReceta = "SELECT * FROM recetas WHERE IDC = $IDC";
                $resultCheckReceta = $dp->query($sqlCheckReceta);

                if ($resultCheckReceta->num_rows > 0) {
                    // Ya existe una receta para esta cita
                    $response = array('success' => false, 'message' => 'Ya existe una receta para esta cita.');
                    echo json_encode($response);
                } else {
                    // No existe una receta, proceder con la inserción
                    $sqlInsertReceta = "INSERT INTO recetas (fechaR, medicamentoR, intruccionUsoR, IDD, IDC, IDP) 
                                        VALUES ('{$_POST['fecha']}', '{$_POST['medicamento']}', '{$_POST['intruccionUsoR']}', $IDD, $IDC, $IDP)";

                    if ($dp->query($sqlInsertReceta) === TRUE) {
                        // La inserción fue exitosa, ahora actualiza el diagnóstico en la tabla citas
                        $sqlUpdateDiagnostico = "UPDATE citas SET diagnosticoC = '{$_POST['diagnostico']}' WHERE IDC = $IDC";
                        if ($dp->query($sqlUpdateDiagnostico) === TRUE) {
                            // Actualización del diagnóstico exitosa
                            $response = array('success' => true, 'message' => 'Cambios realizados');
                            echo json_encode($response);
                        } else {
                            // Falló la actualización del diagnóstico
                            $response = array('success' => false, 'message' => 'Error al actualizar el diagnóstico en la cita.');
                            echo json_encode($response);
                        }
                    } else {
                        // La inserción falló
                        $response = array('success' => false, 'message' => 'Error al insertar la receta.');
                        echo json_encode($response);
                    }
                }
            }
        }
    } else {
        // No se encontró la cita
        $response = array('success' => false, 'message' => 'No se encontró la cita.');
        echo json_encode($response);
    }
} else {
    // El paciente no existe en la tabla de pacientes
    $response = array('success' => false, 'message' => 'No se encontró al paciente.');
    echo json_encode($response);
}

$dp->close();