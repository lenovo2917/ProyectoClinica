<?php
session_start();
include 'acceso.php';

$nombrePaciente = $_POST['nombrePacienteF'];
$fecha = $_POST['fechaPacienteF'];
$hora = $_POST['horaPacienteF'];
$sintomas = $_POST['sintomasPacienteF'];
$descripcion = $_POST['descripcionPacienteF'];
$alergias = $_POST['alergiasPacienteF'];
if (isset($_SESSION["IDS"]) && isset($_SESSION["IDD"])) {
    $IDSecretaria = $_SESSION["IDS"];
    $IDDoctor = $_SESSION["IDD"];
} else {
    echo "variable IDD y IDS no está disponible.";
}

$queryObtenerIDP = $dp->prepare("SELECT IDP FROM pacientes WHERE NombreCompletoP = '".$nombrePaciente."';");
$queryObtenerIDP->execute();
$resultObtenerIDP = $queryObtenerIDP->get_result();

if ($resultObtenerIDP->num_rows === 1) {
    $rowObtenerIDP = $resultObtenerIDP->fetch_assoc();
    $idPaciente = $rowObtenerIDP['IDP'];

    $sql = $dp->prepare("INSERT INTO citas (fechaC, HoraC, sintomasC, descripcionC, IDP, IDS, IDD, ESTATUS) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente')");
    
    $sql->bind_param("sssssss", $fecha, $hora, $sintomas, $descripcion, $idPaciente, $IDSecretaria, $IDDoctor);
    $sql->execute();
    if ($sql === false) {
        $_SESSION['mensajeError'] = " *Error al crear la cita*". $dp->error;
        header("Location: ../secretarias/creacionCitasS.php");
        exit();
    } else {
        $_SESSION['mensajeCreacion'] = " *La cita ha sido creada correctamente*";
        header("Location: ../secretarias/creacionCitasS.php");
        exit();
    }
    $sql->close();
} else {
    echo "Error al obtener el ID del paciente.";
}

// Cerrar la consulta para obtener el ID del paciente
$queryObtenerIDP->close();

// Cerrar la conexión a la base de datos
$dp->close();

?>