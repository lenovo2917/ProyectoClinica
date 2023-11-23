<?php
include 'acceso.php';

// Verificar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recuperar datos del formulario
    $tipoRol = isset($_POST['rolUsuario']) ? $_POST['rolUsuario'] : null;
    $nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
    $curpUsuario = isset($_POST['CURPUsuario']) ? $_POST['CURPUsuario'] : null;
    $fNUsuario = isset($_POST['fNUsuario']) ? $_POST['fNUsuario'] : null;
    $cedulaUsuario = isset($_POST['cedulaUsuario']) ? $_POST['cedulaUsuario'] : null;
    $telefonoUsuario = isset($_POST['telefonoUsuario']) ? $_POST['telefonoUsuario'] : null;
    $correoUsuario = isset($_POST['correoUsuario']) ? $_POST['correoUsuario'] : null;
    $contrasenaUsuario = isset($_POST['contrasenaUsuario']) ? $_POST['contrasenaUsuario'] : null;
    $alergiasUsuario = isset($_POST['alergiasUsuario']) ? $_POST['alergiasUsuario'] : null;
    $tipoSangreUsuario = isset($_POST['tipoSangreUsuario']) ? $_POST['tipoSangreUsuario'] : null;
    $generoUsuario = isset($_POST['generoUsuario']) ? $_POST['generoUsuario'] : null;
    $estatusUsuario = isset($_POST['estatusUsuario']) ? $_POST['estatusUsuario'] : null;
    
    // Validar datos (puedes agregar más validaciones según tus necesidades)

    // Crear y ejecutar la consulta SQL para la inserción del nuevo usuario
    if ($tipoRol === 'tipoDoctor') {
        $sql = "INSERT INTO doctores (NombreCompletoD, FechaNacimientoD, EstatusD, TipoSangreD, GeneroD, CURPD, AlergiasD, TelefonoD, CorreoD, CedulaD, ContrasenaD, IDA)
                VALUES ('$nombreUsuario', '$fNUsuario', '$estatusUsuario', '$tipoSangreUsuario', '$generoUsuario', '$curpUsuario', '$alergiasUsuario', '$telefonoUsuario', '$correoUsuario', '$cedulaUsuario', '$contrasenaUsuario', '1')";
    } elseif ($tipoRol === 'tipoSecretario') {
        $sql = "INSERT INTO secretarios (NombreCompletoS, FechaNacimientoS, TipoSangreS, GeneroS, CURPS, AlergiasS, TelefonoS, CorreoS, IDD, ContrasenaS, EstatusS)
                VALUES ('$nombreUsuario', '$fNUsuario', '$tipoSangreUsuario', '$generoUsuario', '$curpUsuario', '$alergiasUsuario', '$telefonoUsuario', '$correoUsuario', '1', '$contrasenaUsuario', '$estatusUsuario')"; //corregir el IDD
    } else {
        // Manejar el caso en que el tipo de rol no sea válido
        echo "Tipo de rol no válido";
        exit();
    }

    $result = $dp->query($sql);

    // Manejar el resultado de la consulta
    if ($result) {
        // Redireccionar a una página de éxito o a la consulta de usuarios
        header('Location: ../admin/consultaUsuariosA.php');
        exit();
    } else {
        // Manejar el error, por ejemplo:
        echo "Error al crear el usuario: " . $dp->error;
    }
} else {
    // Si el formulario no se ha enviado, redirigir a una página apropiada
    header('Location: formulario.php');
    exit();
}
?>
