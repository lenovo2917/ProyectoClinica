<?php
include 'acceso.php';

// Recupera los datos del formulario
$idP = isset($_POST["idPaciente"]) ? $_POST["idPaciente"] : null;
// Resto de variables

// Verifica si el ID pertenece a un paciente
if (is_numeric($idP)) {
    // Obtener el nombre del paciente antes de realizar el borrado lógico
    $sqlGetPaciente = "SELECT NombreCompletoP FROM pacientes WHERE IDP = $idP";
    $resultGetPaciente = $dp->query($sqlGetPaciente);

    if ($resultGetPaciente) {
        $nombrePaciente = $resultGetPaciente->fetch_assoc()['NombreCompletoP'];

        // Actualiza el campo activo en la tabla de pacientes a 0 para realizar el borrado lógico
        $sqlUpdatePaciente = "UPDATE pacientes SET Estatus = 'Inactivo' WHERE IDP = $idP";
        $resultUpdatePaciente = $dp->query($sqlUpdatePaciente);

        if ($resultUpdatePaciente === false) {
            session_start();
            $_SESSION['mensajeError'] = "*No se ha podido eliminar el paciente.*";
            header("Location: ../secretarias/muestraPacientesS.php");
            exit();
        } else {
            session_start();
            $_SESSION['mensajeEliminacion'] = "*El paciente $nombrePaciente se han eliminado correctamente.*";
            header("Location: ../secretarias/muestraPacientesS.php");
            exit();
        }
    }
}
?>

