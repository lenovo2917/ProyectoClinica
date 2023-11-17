<?php
include 'acceso.php';

    // Recupera los datos del formulario
    $userID = $_POST["id"];
    $nombreD = $_POST["nombreD"]; // Asegúrate de que este nombre coincide con el atributo name en tu campo de entrada

    // Actualiza el nombre en la base de datos
    $sqlUpdate = "UPDATE doctores SET NombreCompletoD = '$nombreD' WHERE IDD = $userID";
    $resultUpdate = $dp->query($sqlUpdate);

    // Verifica si la actualización fue exitosa
    if ($resultUpdate) {
        // Redirige al índice después de la modificación
        header("Location: ../admin/consultaUsuariosA.php"); // Reemplaza "index.php" con la página a la que deseas redirigir
        exit();
    } else {
        echo "Error al actualizar el usuario";
    }

?>
