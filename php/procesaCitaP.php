<?php
session_start();

// Verifica si el usuario ha iniciado sesión como paciente
if(isset($_SESSION["NombreCompletoP"]) && $_SESSION["Rol"] === 'paciente') {
    // Accede al nombre completo del paciente
    $nombreCompletoP = $_SESSION["NombreCompletoP"];
} else {
    // Si no ha iniciado sesión como paciente, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

if (isset($_POST['crear_cita'])) {
include 'acceso.php';
// Recoger los datos del formulario
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$sintomas = $_POST['sintomas'];
$descripcion = $_POST['descripcion'];
$alergias = $_POST['alergias'];

//Preparar la consulta
$queryObtenerIDP = $dp->prepare("SELECT IDP FROM pacientes WHERE NombreCompletoP = ?");
$queryObtenerIDP->bind_param("s", $nombreCompletoP);
$queryObtenerIDP->execute();
$resultObtenerIDP = $queryObtenerIDP->get_result();

// Verifica si se obtuvo un resultado
if ($resultObtenerIDP->num_rows === 1) {
    // Obtiene el ID del paciente
    $rowObtenerIDP = $resultObtenerIDP->fetch_assoc();
    $idPaciente = $rowObtenerIDP['IDP'];

    // Prepara la consulta de inserción con el ID del paciente
    $sql = $dp->prepare("INSERT INTO citas (fechaC, HoraC, sintomasC, descripcionC, IDP, ESTATUS) 
                         VALUES (?, ?, ?, ?, ?, 'pendiente')");
    
    // Vincula los parámetros y ejecuta la consulta
    $sql->bind_param("sssss", $fecha, $hora, $sintomas, $descripcion, $idPaciente);
    $sql->execute();

    // Verifica si la inserción fue exitosa
    if ($sql->affected_rows > 0) {
        echo "Cita creada exitosamente.";
    } else {
        echo "Error al crear la cita: " . $sql->error;
    }

    // Cierra la consulta de inserción
    $sql->close();
} else {
    echo "Error al obtener el ID del paciente.";
}

// Cierra la consulta para obtener el ID del paciente
$queryObtenerIDP->close();

// Cierra la conexión a la base de datos
$dp->close();
}
?>