<?php
include '../../php/acceso.php';

// Recibir datos del formulario
$fechaCita = $_POST['fechaCita'];
$horaCita = $_POST['horaCita'];
$nombrePaciente = $_POST['nombrePacienteCita'];
$apellidoPaterno = $_POST['apellidoPacientePaternoCita'];
$apellidoMaterno = $_POST['apellidoPacienteMaternoCita'];
$especialidadCita = $_POST['especialidadCita'];
$motivoCita = $_POST['motivoCita'];
$notaMedica = $_POST['notaMedica'];
$Descripcion = $_POST['Descripcion'];

// Concatenar nombre completo del paciente
$nombreCompletoPaciente = "$nombrePaciente $apellidoPaterno $apellidoMaterno";

// Insertar cita en la base de datos
$query = "INSERT INTO citas (fechaC, HoraC, IDP, IDD, IDS, sintomasC, diagnosticoC, descripcionC)
         VALUES ('$fechaCita', '$horaCita', 
         (SELECT IDP FROM pacientes WHERE NombreCompletoP = '$nombreCompletoPaciente'), 
         (SELECT IDD FROM doctores WHERE EspecialidadD = '$especialidadCita' LIMIT 1), 1, 
         '$notaMedica', '$motivoCita', '$Descripcion')";

if (mysqli_query($dp, $query)) {
    echo "Cita creada exitosamente";
} else {
    echo "Error al crear la cita: " . mysqli_error($dp);
}

// Cerrar la conexión
mysqli_close($dp);
?>
