<?php
include 'acceso.php';

$query = "SELECT * FROM pacientes_citas_vista WHERE NombreCompletoP LIKE '%$nombrePaciente%' AND MONTH(fechaC) = MONTH('$mesCita')";
$result = $dp->query($query);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');  // Establece el encabezado JSON
echo json_encode($data);

$dp->close();
?>

