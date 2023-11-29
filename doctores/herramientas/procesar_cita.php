<?php
include '../../php/acceso.php';

// Recibir datos del formulario
$fechaCita = $_POST['fechaCita'];
$horaCita = $_POST['horaCita'];
$nombrePaciente = $_POST['nombrePacienteCita'];
$especialidadCita = $_POST['especialidadCita'];
$motivoCita = $_POST['motivoCita'];
$notaMedica = $_POST['notaMedica'];
$Descripcion = $_POST['Descripcion'];
$doctorCita = $_POST['doctorCita'];


// Verificar si el paciente existe y está activo
$consultaPaciente = "SELECT Estatus FROM pacientes WHERE NombreCompletoP = '$nombrePaciente'";
$resultadoPaciente = mysqli_query($dp, $consultaPaciente);

if ($resultadoPaciente) {
    $paciente = mysqli_fetch_assoc($resultadoPaciente);
    
    if ($paciente && isset($paciente['Estatus']) && $paciente['Estatus'] == 'Activo') {
        // Insertar cita en la base de datos
        $consultaIDD = "SELECT IDD from doctores where nombreCompletoD = '$doctorCita' AND EspecialidadD = '$especialidadCita'";
        $idDoctor = mysqli_query($dp,$consultaIDD);
        
        $consultaIDS = "SELECT IDS from secretarios where IDD = '$idDoctor'";
        $idSecretaria = mysqli_query($dp,$consultaIDS);
        $query = "INSERT INTO citas (fechaC, HoraC, IDP, IDD, sintomasC, diagnosticoC, descripcionC)
                 VALUES ('$fechaCita', '$horaCita', 
                 (SELECT IDP FROM pacientes WHERE NombreCompletoP = '$nombrePaciente'), $idDoctor,$idSecretaria 
                 '$notaMedica', '$motivoCita', '$Descripcion')";

        if (mysqli_query($dp, $query)) {
            echo "Cita creada exitosamente";
        } else {
            echo "Error al crear la cita: " . mysqli_error($dp);
        }
    } else {
        if (!$paciente) {
            echo "No se puede crear la cita. El paciente no existe.";
        } else {
            echo "No se puede crear la cita. El paciente no está activo.";
        }
    }
} else {
    echo "Error al verificar el paciente: " . mysqli_error($dp);
}

// Cerrar la conexión
mysqli_close($dp);
?>
