<?php
// Conectar a la base de datos (asegúrate de proporcionar tus propias credenciales)
$conexion = new mysqli('localhost', 'root', '', 'medicatec_2023');
include('../php/controlador.php');
// Verifica si el usuario ha iniciado sesión como paciente
if(isset($_SESSION["NombreCompleto"]) && $_SESSION["Rol"] === 'paciente') {
    // Accede al nombre completo del paciente
    $nombreCompletoP = $_SESSION["NombreCompleto"];
} else {
    // Si no ha iniciado sesión como paciente, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
// Verificar la conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener los valores de los campos de filtro
$fecha = $_POST['fecha'];
$iddoctor = $_POST['iddoctor'];

// Añadir condiciones solo si se proporcionan valores no vacíos
if (!empty($fecha)) {
    $sql = "SELECT citas.IDC, citas.fechaC, citas.HoraC, citas.ESTATUS FROM citas
    JOIN pacientes ON citas.IDP = pacientes.IDP 
    WHERE citas.fechaC = '$fecha' AND pacientes.NombreCompletoP = '$nombreCompletoP'";

    $resultado = $conexion->query($sql);

// Construir el HTML de la tabla con los resultados
$html = '';
while ($fila = $resultado->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<th>' . $fila['IDC'] . '</th>';
    $html .= '<th>' . $fila['fechaC'] . '</th>';
    $html .= '<th>' . $fila['HoraC'] . '</th>';
    $html .= '<th>' . $fila['ESTATUS'] . '</th>';
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
}

if (!empty($iddoctor)) {
    $sql = "SELECT citas.IDC, doctores.NombreCompletoD, citas.fechaC, citas.HoraC, citas.ESTATUS FROM citas
    JOIN pacientes ON citas.IDP = pacientes.IDP JOIN doctores ON citas.IDD = doctores.IDD
    WHERE doctores.NombreCompletoD = '$iddoctor' AND pacientes.NombreCompletoP = '$nombreCompletoP'";

    $resultado = $conexion->query($sql);

// Construir el HTML de la tabla con los resultados
$html = '';
while ($fila = $resultado->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<th>' . $fila['IDC'] . '</th>';
    $html .= '<th>' . $fila['fechaC'] . '</th>';
    $html .= '<th>' . $fila['HoraC'] . '</th>';
    $html .= '<th>' . $fila['ESTATUS'] . '</th>';
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
}
?>
