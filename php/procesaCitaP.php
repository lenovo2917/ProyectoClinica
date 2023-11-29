<?php
include('../php/controlador.php');

// Verifica si el usuario ha iniciado sesión como paciente
if (isset($_SESSION["NombreCompleto"]) && $_SESSION["Rol"] === 'paciente') {
    // Accede al nombre completo del paciente
    $nombreCompletoP = $_SESSION["NombreCompleto"];
} else {
    // Si no ha iniciado sesión como paciente, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['crear_cita'])) {
    // Recoger los datos del formulario
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $sintomas = $_POST['sintomas'];
    $descripcion = $_POST['descripcion'];

    // Preparar la consulta para obtener el ID del paciente
    $queryObtenerIDP = $dp->prepare("SELECT IDP FROM pacientes WHERE NombreCompletoP = ?");
    $queryObtenerIDP->bind_param("s", $nombreCompletoP);
    $queryObtenerIDP->execute();
    $resultObtenerIDP = $queryObtenerIDP->get_result();

    // Verifica si se obtuvo un resultado
    if ($resultObtenerIDP->num_rows === 1) {
        // Obtiene el ID del paciente
        $rowObtenerIDP = $resultObtenerIDP->fetch_assoc();
        $idPaciente = $rowObtenerIDP['IDP'];

        // Cierra la consulta para obtener el ID del paciente
        $queryObtenerIDP->close();

        // Ahora, realiza la consulta para obtener el ID del doctor con especialidad 'Medico General'
        $queryObtenerIDDoctor = $dp->prepare("SELECT IDD FROM doctores WHERE especialidadD = 'Medico General'");
        $queryObtenerIDDoctor->execute();
        $resultObtenerIDDoctor = $queryObtenerIDDoctor->get_result();

        // Verifica si se obtuvo un resultado
        if ($resultObtenerIDDoctor->num_rows === 1) {
            // Obtiene el ID del doctor
            $rowObtenerIDDoctor = $resultObtenerIDDoctor->fetch_assoc();
            $idDoctor = $rowObtenerIDDoctor['IDD'];

            // Cierra la consulta para obtener el ID del doctor
            $queryObtenerIDDoctor->close();

            // Prepara la consulta de inserción con el ID del paciente y del doctor
            $sql = $dp->prepare("INSERT INTO citas (fechaC, HoraC, sintomasC, descripcionC, IDP, IDD, ESTATUS) 
                                VALUES (?, ?, ?, ?, ?, ?, 'pendiente')");

            // Vincula los parámetros y ejecuta la consulta
            $sql->bind_param("ssssss", $fecha, $hora, $sintomas, $descripcion, $idPaciente, $idDoctor);
            $sql->execute();

            // Verifica si la inserción fue exitosa
            if ($sql->affected_rows > 0) {
                $_SESSION['mensaje_crear_cita'] = ' *La cita fue creada exitosamente.*';
                header("Location: ../pacientes/consultaCitasP.php");
                exit();
            } else {
                $_SESSION['mensaje_crear_cita'] = ' *La cita no pudo ser creada.*';
                header("Location: ../pacientes/consultaCitasP.php");
                exit();
            }

            // Cierra la consulta de inserción
            $sql->close();
        } else {
            echo "Error al obtener el ID del doctor con especialidad 'Medico General'.";
        }
    } else {
        echo "Error al obtener el ID del paciente.";
    }

    // Cierra la conexión a la base de datos
    $dp->close();
}
?>