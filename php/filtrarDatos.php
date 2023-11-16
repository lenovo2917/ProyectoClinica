<?php
// Conectar a la base de datos (asegúrate de proporcionar tus propias credenciales)
$conexion = new mysqli('localhost', 'root', '', 'medicatec_2023');

// Verificar la conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener los valores de los campos de filtro
$fecha = $_POST['fecha'];
$Nomdoctor = $_POST['iddoctor'];

// Construir la consulta SQL con los filtros
$sql = "SELECT citas.IDC, pacientes.NombreCompletoP, doctores.NombreCompletoD, citas.fechaC
FROM citas
JOIN pacientes ON citas.IDP = pacientes.IDP
JOIN doctores ON citas.IDD = doctores.IDD where citas.fechaC = '$fecha' AND doctores.NombreCompletoD = '$Nomdoctor'";
// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Construir el HTML de la tabla con los resultados
$html = '';
while ($fila = $resultado->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<th>' . $fila['IDC'] . '</th>';
    $html .= '<th>' . $fila['NombreCompletoP'] . '</th>';
    $html .= '<th>' . $fila['NombreCompletoD'] . '</th>';
    $html .= '<th>' . $fila['fechaC'] . '</th>';
    $html .= '<td>
    <a href="../pacientes/actualizaCitasP.html" style="background-color: #176b87; color: #fff;  text-decoration: none;
    margin-top: 30px;  border: none; border-radius: 3px; cursor: pointer; width: 30%; padding: 5px; text-align: center;">Actualizar</a>
    <a href="../pacientes/eliminaCitasP.html" style="background-color: #176b87; color: #fff;  text-decoration: none;
    margin-top: 30px; margin-left: 40px; border: none; border-radius: 3px; cursor: pointer; width: 30%; padding: 5px; text-align: center;">Eliminar</a>
    </td>';
    $html .= '</tr>';
}

// Cerrar la conexión
$conexion->close();

// Enviar el HTML de la tabla al cliente
echo $html;
?>
