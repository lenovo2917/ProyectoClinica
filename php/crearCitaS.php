<?php
session_start();
if (isset($_POST['crearCitaS'])) {
include 'acceso.php';

$nombrePaciente = $_POST['nombrePacienteF'];
$fecha = $_POST['fechaPacienteF'];
$hora = $_POST['horaPacienteF'];
$sintomas = $_POST['sintomasPacienteF'];
$descripcion = $_POST['descripcionPacienteF'];
$alergias = $_POST['alergiasPacienteF'];
//obtener los ID del SESSION
if (isset($_SESSION["IDS"]) && isset($_SESSION["IDD"])) {
    // La variable de sesión $_SESSION["ID"] está disponible
    $IDSecretaria = $_SESSION["IDS"];
    $IDDoctor = $_SESSION["IDD"];
} else {
    echo "variable IDD y IDS no está disponible.";
}

//Preparar la consulta
$queryObtenerIDP = $dp->prepare("SELECT IDP FROM pacientes WHERE NombreCompletoP = '".$nombrePaciente."';");
$queryObtenerIDP->execute();
$resultObtenerIDP = $queryObtenerIDP->get_result();

// Verifica si se obtuvo un resultado
if ($resultObtenerIDP->num_rows === 1) {
    // Obtiene el ID del paciente
    $rowObtenerIDP = $resultObtenerIDP->fetch_assoc();
    $idPaciente = $rowObtenerIDP['IDP'];

    // Prepara la consulta de inserción con el ID del paciente
    $sql = $dp->prepare("INSERT INTO citas (fechaC, HoraC, sintomasC, descripcionC, IDP, IDS, IDD, ESTATUS) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente')");
    
    // Vincula los parámetros y ejecuta la consulta
    $sql->bind_param("sssssss", $fecha, $hora, $sintomas, $descripcion, $idPaciente, $IDSecretaria, $IDDoctor);
    $sql->execute();
    // Verificar si la inserción fue exitosa
    if ($sql === false) {
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
    // Cerrar la consulta de inserción
    $sql->close();
} else {
    echo "Error al obtener el ID del paciente.";
}

// Cerrar la consulta para obtener el ID del paciente
$queryObtenerIDP->close();

// Cerrar la conexión a la base de datos
$dp->close();
}
?>