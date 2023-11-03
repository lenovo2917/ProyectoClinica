<?php
// Verificar si la solicitud es una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos enviados en la solicitud (en formato JSON)
    $requestData = json_decode(file_get_contents("php://input"), true);

    if ($requestData !== null) {
        // Obtener el IDC de la cita y el nuevo estado desde la solicitud
        $citaID = $requestData['citaID'];
        $nuevoEstatus = $requestData['estatus'];
        
        // Cambiar el valor de 'estatus' dependiendo del botón
        if ($nuevoEstatus === "aceptada") {
            $nuevoEstatus = "Aceptada";
        } elseif ($nuevoEstatus === "rechazada") {
            $nuevoEstatus = "Rechazada";
        }
        
        // Realizar la actualización en la base de datos
        include '../../php/acceso.php';
        
        // Preparar una consulta para actualizar el estado de la cita
        $updateQuery = "UPDATE citas SET ESTATUS = ? WHERE IDC = ?";
        
        // Preparar la sentencia
        $stmt = $dp->prepare($updateQuery);
      
        
        if ($stmt) {
            // Vincular los parámetros
            $stmt->bind_param("si", $nuevoEstatus, $citaID);
            
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                // Éxito, enviar una respuesta JSON
                $response = array("success" => true, "message" => "Cita actualizada con éxito");
                echo json_encode($response);
            } else {
                // Error en la ejecución de la consulta
                $response = array("success" => false, "message" => "Error al actualizar la cita");
                echo json_encode($response);
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            // Error en la preparación de la sentencia
            $response = array("success" => false, "message" => "Error en la preparación de la consulta");
            echo json_encode($response);
        }

        // Cerrar la conexión a la base de datos
        $dp->close();
    } else {
        // Datos de solicitud incorrectos
        $response = array("success" => false, "message" => "Datos de solicitud incorrectos");
        echo json_encode($response);
    }
} else {
    // La solicitud no es POST
    $response = array("success" => false, "message" => "Solicitud no válida");
    echo json_encode($response);
}
?>

