<?php
include 'acceso.php';

    // Recupera los datos del formulario
    $userID = $_SESSION["idp"];
    $nombreP = $_SESSION["NombreCompletoP"]; // Asegúrate de que este nombre coincide con el atributo name en tu campo de entrada

    // Actualiza el nombre en la base de datos
    $sqlUpdate = "UPDATE pacientes SET NombreCompletoP = '$nombreP' WHERE IDP = $userID";
    $resultUpdate = $dp->query($sqlUpdate);

    // Verifica si la actualización fue exitosa
    if ($resultUpdate) {
        // Redirige al índice después de la modificación
        header("Location: ../secretarios/consultaPacientesS.php"); // Reemplaza "index.php" con la página a la que deseas redirigir
        exit();
    } else {
        echo "Error al actualizar el usuario";
    }
?>