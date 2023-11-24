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

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        // Manejar el error
        session_start();
        $_SESSION['mensajeCorrecto'] = "*Error en la preparación de la consulta*". $dp->error;
        header("Location: ../secretarias/consultaCitasS.php");
        exit();
    }

    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("ssssii", $fechaC, $horaC, $sintomasC, $descripcionC, $idPaciente, $idCita);
    $result = $stmt->execute();

    // Verificar si la consulta se ejecutó correctamente
    if ($result === false) {
        // Manejar el error
        session_start();
        $_SESSION['mensajeInorrecto'] = "*Error al actualizar la cita*". $dp->error;
        header("Location: ../secretarias/consultaCitasS.php");
        exit();
    } else {
        // Todo está bien, redirigir con mensaje de éxito
        session_start();
        $_SESSION['mensajeCorrecto'] = "*La cita ha sido modificada correctamente*";
        header("Location: ../secretarias/consultaCitasS.php");
        exit();
    }

    // Cerrar el statement y la conexión
    $stmt->close();
    $dp->close();
} else {
    // Redirigir si no se recibieron todos los datos esperados
    header("Location: ../secretarias/consultaCitasS.php");
    exit();
}
?>
