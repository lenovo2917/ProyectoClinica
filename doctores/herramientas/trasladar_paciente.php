<?php
include '../../php/acceso.php';

if (isset($_POST['citaID'], $_POST['fechaCita'], $_POST['especialidadCita'], $_POST['doctorCita'], $_POST['horaCita'])) {
    $citaID = $_POST['citaID'];
    $fechaCita = $_POST['fechaCita'];
    $especialidadCita = $_POST['especialidadCita'];
    $doctorCita = $_POST['doctorCita'];
    $horaCita = $_POST['horaCita'];

    // Obtener IDD y especialidad del doctor seleccionado
    $queryDoctor = "SELECT IDD, EspecialidadD FROM doctores WHERE IDD = ?";
    $stmtDoctor = mysqli_prepare($dp, $queryDoctor);

    if ($stmtDoctor) {
        mysqli_stmt_bind_param($stmtDoctor, 'i', $doctorCita);
        mysqli_stmt_execute($stmtDoctor);
        mysqli_stmt_bind_result($stmtDoctor, $IDD, $especialidadDoctor);
        mysqli_stmt_fetch($stmtDoctor);
        mysqli_stmt_close($stmtDoctor);

        // Actualizar la tabla citas con el nuevo médico y especialidad
        $queryCitas = "UPDATE citas SET IDD = ?, fechaC = ?, HoraC = ? ,ESTATUS = 'Pendiente' WHERE IDC = ?";
        $stmtCitas = mysqli_prepare($dp, $queryCitas);

        if ($stmtCitas) {
            mysqli_stmt_bind_param($stmtCitas, 'issi', $IDD, $fechaCita, $horaCita, $citaID);

            if (mysqli_stmt_execute($stmtCitas)) {
                echo "Cita trasladada con éxito.";
            } else {
                echo "Error al trasladar la cita.";
            }

            mysqli_stmt_close($stmtCitas);
        } else {
            echo "Error en la preparación de la consulta de citas.";
        }
    } else {
        echo "Error en la preparación de la consulta de doctores.";
    }
} else {
    echo "Datos insuficientes para realizar el traslado de la cita.";
}
?>
