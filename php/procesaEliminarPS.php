<?php
include 'acceso.php';

// Recupera los datos del formulario o sesión
$userID = $_SESSION["NombreCompletoP"];

// Sentencia SQL para eliminar el registro
$sqlDelete = "DELETE FROM pacientes WHERE IDP = $userID";

// Ejecuta la sentencia SQL
$resultDelete = $dp->query($sqlDelete);

// Verifica si la eliminación fue exitosa
if ($resultDelete) {
    // Redirige a la página después de la eliminación
    header("Location: ../secretarios/consultaPacientesS.php");
    exit();
} else {
    echo "Error al eliminar al paciente";
}
?>
