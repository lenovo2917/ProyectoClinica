<?php
include 'acceso.php';

// Recupera los datos del formulario



$idUsuarioD = isset($_POST["idDoctor"]) ? $_POST["idDoctor"] : null;
$idUsuarioS = isset($_POST["idSecretario"]) ? $_POST["idSecretario"] : null;
$nombreUsuario = isset($_POST["nombreUsuario"]) ? $_POST["nombreUsuario"] : null;
$CURPUsuario = isset($_POST["CURPUsuario"]) ? $_POST["CURPUsuario"] : null;

$fechaNacimientoUsuario = isset($_POST["fNUsuario"]) ? $_POST["fNUsuario"] : null;
$estatusUsuario = isset($_POST["estatusUsuario"]) ? $_POST["estatusUsuario"] : null;
$cedulaUsuario = isset($_POST["cedulaUsuario"]) ? $_POST["cedulaUsuario"] : null;
$telefonoUsuario = isset($_POST["telefonoUsuario"]) ? $_POST["telefonoUsuario"] : null;
$correoUsuario = isset($_POST["correoUsuario"]) ? $_POST["correoUsuario"] : null;
$contrasenaUsuario = isset($_POST["contrasenaUsuario"]) ? $_POST["contrasenaUsuario"] : null;
$alergiasUsuario = isset($_POST["alergiasUsuario"]) ? $_POST["alergiasUsuario"] : null;
$generoUsuario = isset($_POST["generoUsuario"]) ? $_POST["generoUsuario"] : null;
$tipoSangreUsuario = isset($_POST["tipoSangreUsuario"]) ? $_POST["tipoSangreUsuario"] : null;
$iddUsuario = isset($_POST["iddUsuario"]) ? $_POST["iddUsuario"] : null; //IDD de secretario en la BD
$especialidadUsuario = isset($_POST["especialidadUsuario"]) ? $_POST["especialidadUsuario"] : null;
/*






$IDAUsuario = isset($_POST["IDAU"]) ? $_POST["IDAU"] : null;*/


// Agrega mensajes de depuración
echo "ID Doctor: $idUsuarioD<br>";
echo "ID Secretario: $idUsuarioS<br>";
echo "Nombre Usuario: $nombreUsuario<br>";

// Verifica si el ID pertenece a un doctor o a un secretario
if (is_numeric($idUsuarioD)) {
    $sqlCheckDoctor = "SELECT * FROM doctores WHERE IDD = $idUsuarioD";
    $resultCheckDoctor = $dp->query($sqlCheckDoctor);

    if ($resultCheckDoctor === false) {
        echo "Error en la consulta para doctores: " . $dp->error;
    } elseif ($resultCheckDoctor->num_rows > 0) {
        // Actualiza el nombre en la tabla de doctores
        $sqlUpdateDoctor = "UPDATE doctores SET 
            NombreCompletoD = '$nombreUsuario',
            CURPD = '$CURPUsuario',
            FechaNacimientoD = '$fechaNacimientoUsuario',
            EstatusD = '$estatusUsuario',
            CedulaD = '$cedulaUsuario',
            TelefonoD = '$telefonoUsuario',
            CorreoD = '$correoUsuario',
            ContrasenaD = '$contrasenaUsuario',
            AlergiasD = '$alergiasUsuario',
            GeneroD = '$generoUsuario',
            TipoSangreD = '$tipoSangreUsuario',
            EspecialidadD = '$especialidadUsuario'
        WHERE IDD = $idUsuarioD";

        $resultUpdateDoctor = $dp->query($sqlUpdateDoctor);

        if ($resultUpdateDoctor === false) {
            echo "Error al actualizar el usuario (doctor): " . $dp->error;
        } else {
            // Redirige al índice después de la modificación
            header("Location: ../admin/consultaUsuariosA.php");
            exit();
        }
    } else {
        echo "ID de usuario doctores no válido";
    }
} elseif (is_numeric($idUsuarioS)) {
    $sqlCheckSecretario = "SELECT * FROM secretarios WHERE IDS = $idUsuarioS";
    $resultCheckSecretario = $dp->query($sqlCheckSecretario);

    if ($resultCheckSecretario === false) {
        echo "Error en la consulta para secretarios: " . $dp->error;
    } elseif ($resultCheckSecretario->num_rows > 0) {
        // Actualiza el nombre en la tabla de secretarios
        $sqlUpdateSecretario = "UPDATE secretarios SET 
            NombreCompletoS = '$nombreUsuario',
            CURPS = '$CURPUsuario',
            FechaNacimientoS = '$fechaNacimientoUsuario',
            EstatusS = '$estatusUsuario',
            TipoSangreS = '$tipoSangreUsuario',
            GeneroS = '$generoUsuario',
            AlergiasS = '$alergiasUsuario',
            TelefonoS = '$telefonoUsuario',
            CorreoS = '$correoUsuario',
            IDD = $iddUsuario/*,
            ContrasenaS = '$contrasenaUsuario'*/
        WHERE IDS = $idUsuarioS";

        $resultUpdateSecretario = $dp->query($sqlUpdateSecretario);

        if ($resultUpdateSecretario === false) {
            echo "Error al actualizar el usuario (secretario): " . $dp->error;
        } else {
            // Redirige al índice después de la modificación
            header("Location: ../admin/consultaUsuariosA.php");
            exit();
        }
    } else {
        echo "ID de usuario secretarios no válido";
    }
} else {
    echo "ID de usuario no válido";
}
?>
