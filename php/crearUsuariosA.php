<?php
    include 'acceso.php';

    // Verificar si el formulario se ha enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Recuperar datos del formulario
        $idDoctor = isset($_POST['idDoctor']) ? $_POST['idDoctor'] : null;
        $idSecretario = isset($_POST['idSecretario']) ? $_POST['idSecretario'] : null;
        $nombreUsuario = $_POST['nombreUsuario'];
        $curpUsuario = $_POST['CURPUsuario'];
        $fNUsuario = $_POST['fNUsuario'];
        $cedulaUsuario = $_POST['cedulaUsuario'];
        $telefonoUsuario = $_POST['telefonoUsuario'];
        $correoUsuario = $_POST['correoUsuario'];
        $contrasenaUsuario = $_POST['contrasenaUsuario'];
        $alergiasUsuario = $_POST['alergiasUsuario'];
        $tipoSangreUsuario = $_POST['tipoSangreUsuario'];
        $generoUsuario = $_POST['generoUsuario'];
        $estatusUsuario = $_POST['estatusUsuario'];

        // Validar datos (puedes agregar más validaciones según tus necesidades)

        // Crear y ejecutar la consulta SQL para la modificación del usuario
        $sql = "UPDATE usuarios SET
                nombreU = '$nombreUsuario',
                CURPU = '$curpUsuario',
                fNU = '$fNUsuario',
                cedulaU = '$cedulaUsuario',
                telefonoU = '$telefonoUsuario',
                correoU = '$correoUsuario',
                contrasenaU = '$contrasenaUsuario',
                alergiasU = '$alergiasUsuario',
                tipoSangreU = '$tipoSangreUsuario',
                generoU = '$generoUsuario',
                estatusU = '$estatusUsuario'
                WHERE IDD = $idDoctor OR IDS = $idSecretario";

        $result = $dp->query($sql);

        // Manejar el resultado de la consulta
        if ($result) {
            // Redireccionar a una página de éxito o a la consulta de usuarios
            header('Location: exito.php');
            exit();
        } else {
            // Manejar el error, por ejemplo:
            echo "Error al modificar el usuario: " . $dp->error;
        }
    } else {
        // Si el formulario no se ha enviado, redirigir a una página apropiada
        header('Location: formulario.php');
        exit();
    }
?>
