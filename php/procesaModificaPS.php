<?php
include 'acceso.php';

// Recupera los datos del formulario



$idP = isset($_POST["idPaciente"]) ? $_POST["idPaciente"] : null;
$nombrePaciente = isset($_POST["nombrePaciente"]) ? $_POST["nombrePaciente"] : null;
$CURPPaciente = isset($_POST["CURPPaciente"]) ? $_POST["CURPPaciente"] : null;
$fechaNacimientoPaciente = isset($_POST["fNPaciente"]) ? $_POST["fNPaciente"] : null;
$estatusPaciente = isset($_POST["estatusUsuario"]) ? $_POST["estatusUsuario"] : null;
$enfermedadesPaciente = isset($_POST["enfermedadesPaciente"]) ? $_POST["enfermedadesPaciente"] : null;
$telefonoPaciente = isset($_POST["telefonoPaciente"]) ? $_POST["telefonoPaciente"] : null;
$correoPaciente = isset($_POST["correoPaciente"]) ? $_POST["correoPaciente"] : null;
$contrasenaPaciente = isset($_POST["contrasenaPaciente"]) ? $_POST["contrasenaPaciente"] : null;
$alergiasPaciente = isset($_POST["alergiasPaciente"]) ? $_POST["alergiasPaciente"] : null;
$generoPaciente = isset($_POST["generoPaciente"]) ? $_POST["generoPaciente"] : null;
$capacidadesPaciente = isset($_POST["capacidadesPaciente"]) ? $_POST["capacidadesPaciente"] : null;
$tipoSangrePaciente = isset($_POST["tipoSangrePaciente"]) ? $_POST["tipoSangrePaciente"] : null;

echo "ID Paciente: $idP<br>";
echo "Nombre Paciente: $nombrePaciente<br>";

// Verifica si el ID pertenece a un doctor o a un secretario
if (is_numeric($idP)) {
    $sqlCheckPaciente = "SELECT * FROM pacientes WHERE IDP = $idP";
    $resultCheckPaciente = $dp->query($sqlCheckDoctor);

    if ($resultCheckPaciente === false) {
        echo "Error en la consulta para pacientes: " . $dp->error;
    } elseif ($resultCheckPaciente->num_rows > 0) {
        // Actualiza el nombre en la tabla de doctores
        $sqlUpdatePaciente = "UPDATE pacientes SET 
            NombreCompletoP = '$nombreUsuario',
            CURPP = '$CURPUsuario',
            fechaP = '$fechaNacimientoUsuario',
            Estatus = '$estatusUsuario',
            enfermedadesP = '$cedulaUsuario',
            capacidadesP = '$capacidadesPaciente',
            telefonoP = '$telefonoUsuario',
            CorreoP = '$correoUsuario',
            ContrasenaP = '$contrasenaUsuario',
            alergiasP = '$alergiasUsuario',
            generoP = '$generoUsuario',
            tipoSangreP = '$tipoSangreUsuario'
        WHERE IDP = $idP";

        $resultUpdatePaciente = $dp->query($sqlUpdatePaciente);

        if ($resultUpdatePaciente === false) {
            echo "Error al actualizar al paciente : " . $dp->error;
        } else {
            // Redirige al índice después de la modificación
            header("Location: ../secretarias/consultaPacientesS.php");
            exit();
        }
    } else {
        echo "ID de paciente no válido";
    }
}
?>


