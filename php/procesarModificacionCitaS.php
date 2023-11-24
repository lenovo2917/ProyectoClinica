<?php
include 'acceso.php';

$fechaC = isset($_POST["fechaPacienteF"]) ? $_POST["fechaPacienteF"] : null;
$horaC = isset($_POST["horaPacienteF"]) ? $_POST["horaPacienteF"] : null;
$simtomasC = isset($_POST["sintomasPacienteF"]) ? $_POST["sintomasPacienteF"] : null;
$DescripcionC = isset($_POST["descripcionPacienteF"]) ? $_POST["descripcionPacienteF"] : null;
$idCita = isset($_POST["IDCita"]) ? $_POST['IDCita'];
$idPaciente = isset($_POST["IDPaciente"]) ? $_POST['IDPaciente'];

if ($resultCheckPaciente->num_rows > 0) {
    $sql = "SELECT * FROM citas WHERE  WHERE IDP = $idPaciente AND IDC = $idCita";
    $result = $dp->query($sql);
    // Actualiza el nombre en la tabla de doctores
    $sqlUpdatePaciente = "UPDATE pacientes SET 
        NombreCompletoP = '$nombrePaciente',
        CURPP = '$CURPPaciente',
        fechaP = '$fechaNacimientoPaciente',
        
        enfermedadesP = '$enfermedadesPaciente',
        capacidadesdiferentesP = '$capacidadesPaciente',
        telefonoP = '$telefonoPaciente',
        CorreoP = '$correoPaciente',
        ContrasenaP = '$contrasenaPaciente',
        alergiasP = '$alergiasPaciente',
        generoP = '$generoPaciente',
        tipoSangreP = '$tipoSangrePaciente'
    WHERE IDP = $idP";

    $resultUpdatePaciente = $dp->query($sqlUpdatePaciente);

    if ($resultUpdatePaciente === false) {
        echo "Error al actualizar al paciente : " . $dp->error;
    } else {
        // Establece un mensaje en la variable de sesión
        session_start();
        $_SESSION['mensaje1'] = "*Los datos del paciente $nombrePaciente se han modificado correctamente.*";

        // Redirige al índice después de la modificación
        header("Location: ../secretarias/muestraPacientesS.php");
        exit();
    }
}