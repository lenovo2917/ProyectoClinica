<?php
include 'acceso.php';

// Verificar si se recibieron los datos necesarios
if (
    isset($_POST["fechaPacienteF"], $_POST["horaPacienteF"], $_POST["sintomasPacienteF"], $_POST["descripcionPacienteF"], $_POST["IDCita"], $_POST["IDPaciente"])
) {
    // Obtener los datos del formulario
    $fechaC = $_POST["fechaPacienteF"];
    $horaC = $_POST["horaPacienteF"];
    $sintomasC = $_POST["sintomasPacienteF"];
    $descripcionC = $_POST["descripcionPacienteF"];
    $idCita = $_POST["IDCita"];
    $idPaciente = $_POST["IDPaciente"];

    // Preparar la consulta SQL usando sentencias preparadas para prevenir inyección de SQL
    $sql = "UPDATE citas SET 
        fechaC = ?,
        horaC = ?,
        sintomasC = ?,
        descripcionC = ?
        WHERE IDP = ? AND IDC = ?";

    $stmt = $dp->prepare($sql);

    if ($stmt === false) {
        session_start();
        $_SESSION['mensajeError'] = "*Error en la preparación de la consulta*". $dp->error;
        header("Location: ../secretarias/consultaCitasS.php");
        exit();
    }

    $stmt->bind_param("ssssii", $fechaC, $horaC, $sintomasC, $descripcionC, $idPaciente, $idCita);
    $result = $stmt->execute();

    if ($result === false) {
        session_start();
        $_SESSION['mensajeError'] = "*Error al actualizar la cita*". $dp->error;
        header("Location: ../secretarias/consultaCitasS.php");
        exit();
    } else {
        session_start();
        $_SESSION['mensajeModificacion'] = "*La cita ha sido modificada correctamente*";
        header("Location: ../secretarias/consultaCitasS.php");
        exit();
    }

    $stmt->close();
    $dp->close();
} else {
    header("Location: ../secretarias/consultaCitasS.php");
    exit();
}
?>
