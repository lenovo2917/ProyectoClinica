<?php
include '../../php/acceso.php';

// Valores obtenidos de las variables
$nombre = trim($_POST['nombre']);
$apellidoP = trim($_POST['apellidoP']);
$apellidoM = trim($_POST['apellidoM']);

$nombreCompleto = $nombre . ' ' . $apellidoP . ' ' . $apellidoM;

// Consulta SQL para obtener el ID del paciente a partir del nombre completo
$sqlSelectPaciente = "SELECT IDP FROM pacientes WHERE NombreCompletoP = '$nombreCompleto'";
$resultPaciente = $dp->query($sqlSelectPaciente);

if ($resultPaciente->num_rows > 0) {
    $rowPaciente = $resultPaciente->fetch_assoc();
    $IDP = $rowPaciente['IDP'];

    // Consulta SQL para obtener las citas del paciente
    $sqlSelectCitas = "SELECT IDC, fechaC, HoraC, sintomasC, diagnosticoC, descripcionC, ESTATUS FROM citas WHERE IDP = $IDP";
    $resultCitas = $dp->query($sqlSelectCitas);

    if ($resultCitas->num_rows > 0) {
        // Construir el HTML de las citas para el menú desplegable
        $htmlCitas = '';
        while ($rowCita = $resultCitas->fetch_assoc()) {
            $idCita = $rowCita['IDC'];
            $fechaCita = $rowCita['fechaC'];
            $horaCita = $rowCita['HoraC'];
            $sintomasCita = $rowCita['sintomasC'];
            $diagnosticoCita = $rowCita['diagnosticoC'];
            $descripcionCita = $rowCita['descripcionC'];
            $estatusCita = $rowCita['ESTATUS'];

            // Construir el HTML de cada opción de cita
           
            $htmlCitas .= "<li><a class='dropdown-item' href='#' data-idc='$idCita'>$fechaCita - $horaCita - $estatusCita</a></li>";

        }

        // Devolver el HTML generado como respuesta
        echo $htmlCitas;
    } else {
        echo "<li><a class='dropdown-item' href='#'>No hay citas disponibles para este paciente</a></li>";
    }
} else {
    echo "<li><a class='dropdown-item' href='#'>Paciente no encontrado</a></li>";
}

$dp->close();
?>
