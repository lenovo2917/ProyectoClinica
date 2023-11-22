<?php
session_start();
include 'acceso.php';

if (!empty($_POST["nombree"]) && !empty($_POST["clave"])) {
    $nombre = $_POST["nombree"];
    $password = $_POST["clave"];

    // Consulta para pacientes
    $sql1 = $dp->prepare("SELECT * FROM pacientes WHERE NombreCompletoP=? AND ContrasenaP=?");
    $sql1->bind_param("ss", $nombre, $password);
    $sql1->execute();
    $result1 = $sql1->get_result();

    // Consulta para secretarios
    $sql2 = $dp->prepare("SELECT * FROM secretarios WHERE NombreCompletoS=? AND ContrasenaS=?");
    $sql2->bind_param("ss", $nombre, $password);
    $sql2->execute();
    $result2 = $sql2->get_result();

    // Consulta para doctores
    $sql3 = $dp->prepare("SELECT * FROM doctores WHERE NombreCompletoD=? AND ContrasenaD=?");
    $sql3->bind_param("ss", $nombre, $password);
    $sql3->execute();
    $result3 = $sql3->get_result();

    // Consulta para doctores
    $sql4 = $dp->prepare("SELECT * FROM administrador WHERE UsuarioA=? AND ContrasenaA=?");
    $sql4->bind_param("ss", $nombre, $password);
    $sql4->execute();
    $result4 = $sql4->get_result();

    // Verificación de la autenticación y asignación de roles
    if ($result1->num_rows === 1) {
        $row1 = $result1->fetch_assoc();
        $_SESSION["NombreCompleto"] = $nombre;
        $_SESSION["Rol"] = 'paciente';
        $_SESSION["ID"] = $row1['IDP']; 
        header("Location: Blog_Medico.php"); // Redirigir al paciente
        exit();
    } elseif ($result2->num_rows === 1) {
        $row2 = $result2->fetch_assoc();
        $_SESSION["NombreCompleto"] =$nombre;
        $_SESSION["Rol"] = 'secretario';
        $_SESSION["IDS"] = $row2['IDS'];
        $_SESSION["IDD"] = $row2['IDD']; 
        header("Location: Blog_Medico.php"); // Redirigir al secretario
        exit();
    } elseif ($result3->num_rows === 1) {
        $row3 = $result3->fetch_assoc();
        $_SESSION["NombreCompleto"] = $nombre;
        $_SESSION["Rol"] = 'doctor';
        $_SESSION["ID"] = $row3['IDD'];
        $_SESSION["EspecialidadD"] = $row3['EspecialidadD']; // Almacenar la especialidad en la sesión
        header("Location: doctores/IndexDoctores.php"); // Redirigir al doctor
        exit();
    }
    else if ($result4->num_rows === 1) {
        $row4 = $result4->fetch_assoc();
        $_SESSION["NombreCompleto"] =$nombre;
        $_SESSION["Rol"] = 'admin';
        $_SESSION["ID"] = $row4['IDA']; 
        header("Location: Blog_Medico.php"); // Redirigir al doctor
        exit();
    }{
        echo "<div class='alert alert-danger'>ACCESO DENEGADO</div>";
    }
}
?>
