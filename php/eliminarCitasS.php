<?php
include('acceso.php');
$idCita = $_POST['IDCita'];
$idPaciente = $_POST['IDPaciente'];

$sql = "UPDATE citas SET ESTATUS = 'Cancelada' WHERE IDP = $idPaciente AND IDC = $idCita";
$stmt = $dp->query($sql);

if ($stmt === false) {
    session_start();
    $_SESSION['mensajeCorrecto'] = "*Error al realizar al eliminar la cita*". $dp->error;

    header("Location: ../secretarias/consultaCitasS.php");
    exit();
} else {
    // Establecer el mensaje en una variable de sesión
    session_start();
    $_SESSION['mensajeIncorrecto'] = "*La cita se ha eliminado correctamente*";

    header("Location: ../secretarias/consultaCitasS.php");
    exit();
}
$stmt->close();
$dp->close();
exit();
?>