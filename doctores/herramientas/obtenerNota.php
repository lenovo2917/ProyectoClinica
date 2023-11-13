<?php
include '../../php/acceso.php';

if (isset($_POST['idR'])) {
    $idR = mysqli_real_escape_string($dp, $_POST['idR']);

    // Crear una sentencia preparada
    $consulta = "SELECT e.notaConsulta, c.diagnosticoC, r.medicamentoR 
                 FROM expediente e
                 LEFT JOIN citas c ON e.IDC = c.IDC
                 LEFT JOIN recetas r ON e.IDR = r.IDR
                 WHERE e.idR = ?";
                 
    $stmt = mysqli_prepare($dp, $consulta);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "i", $idR);

    // Ejecutar la sentencia preparada
    mysqli_stmt_execute($stmt);

    // Vincular resultados
    mysqli_stmt_bind_result($stmt, $notaConsulta, $Diagnostico, $medicamento);

    // Obtener los resultados
    mysqli_stmt_fetch($stmt);

    // Devolver resultados como JSON
    header('Content-Type: application/json');
    echo json_encode(array('notaConsulta' => $notaConsulta, 'Diagnostico' => $Diagnostico, 'medicamento' => $medicamento));

    // Cerrar la sentencia preparada
    mysqli_stmt_close($stmt);
}

// Cerrar la conexión a la base de datos
mysqli_close($dp);
?>
