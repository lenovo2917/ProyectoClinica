<?php
include '../../php/acceso.php';

if (isset($_POST['nombrePaciente'])) {
    $nombrePaciente = $_POST['nombrePaciente'];

    $consulta = "SELECT
    r.fechaR AS FechaReceta,
    c.diagnosticoC AS Diagnostico,
    e.notaConsulta AS NotasMedicas,
    r.intruccionUsoR AS InstruccionUso
FROM pacientes p
JOIN citas c ON p.IDP = c.IDP
LEFT JOIN recetas r ON c.IDC = r.IDC
LEFT JOIN expediente e ON c.IDC = e.IDC
WHERE p.NombreCompletoP = '$nombrePaciente'
    AND c.ESTATUS = 'finalizada'";


    $resultado = mysqli_query($dp, $consulta);

    if ($resultado) {
        $recetas = array();

        while ($row = mysqli_fetch_assoc($resultado)) {
            $recetas[] = $row;
        }

        // Devuelve los datos como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => true,
            'data' => $recetas,
        ));
    } else {
        // Manejar el error y devolver una respuesta JSON
        echo json_encode(array(
            'success' => false,
            'error' => 'Hubo un error en la consulta: ' . mysqli_error($dp),
        ));
    }
}

mysqli_close($dp);
?>
