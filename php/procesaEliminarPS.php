<?php
include 'acceso.php';

// Recupera los datos del formulario
$idP = isset($_POST["idPaciente"]) ? $_POST["idPaciente"] : null;
// Resto de variables

// Verifica si el ID pertenece a un paciente
if (is_numeric($idP)) {
    // Actualiza el campo activo en la tabla de pacientes a 0 para realizar el borrado lógico
    $sqlUpdatePaciente = "UPDATE pacientes SET Estatus = 0 WHERE IDP = $idP";

    $resultUpdatePaciente = $dp->query($sqlUpdatePaciente);

    if ($resultUpdatePaciente === false) {
        echo "Error al realizar el borrado lógico del paciente: " . $dp->error;
    } else {
        // Redirige al índice después de la modificación
        header("Location: ../secretarias/muestraPacientesS.php");
        exit();
    }
}
?>

