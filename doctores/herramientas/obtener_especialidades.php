<?php
include '../../php/acceso.php';

$query = "SELECT DISTINCT EspecialidadD FROM doctores";
$resultado = mysqli_query($dp, $query);

echo '<option selected disabled>Seleccione una especialidad</option>';

if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo '<option value="' . $row['EspecialidadD'] . '">' . $row['EspecialidadD'] . '</option>';
    }
} else {
    echo '<option value="" disabled>Error al obtener las especialidades</option>';
}

mysqli_close($dp);
?>
