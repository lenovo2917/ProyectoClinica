<?php
include('../php/controlador.php');
// Verifica si el usuario ha iniciado sesión como paciente
if(isset($_SESSION["NombreCompleto"]) && $_SESSION["Rol"] === 'paciente') {
    // Accede al nombre completo del paciente
    $nombreCompletoP = $_SESSION["NombreCompleto"];
} else {
    // Si no ha iniciado sesión como paciente, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>MEDICATEC</title>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@500&family=DM+Serif+Display&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
  <!--ESTILOS CSS-->
  <link rel="shortcut icon" href="../img/web.png" type="img">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/nav2.css">
  <link rel="stylesheet" type="text/css" href="../css/consultaCitas.css">
</head>

<body style="background-color: #eeeeee;">
<?php
     $conexion = new mysqli('localhost', 'root', '', 'medicatec_2023');
     $sql="SELECT * FROM citas
     JOIN pacientes ON citas.IDP = pacientes.IDP WHERE pacientes.NombreCompletoP = '$nombreCompletoP' AND citas.ESTATUS != 'Cancelada' ORDER BY citas.fechaC ASC";
     $resultado = $conexion->query($sql);
?>

  <div class="container-fluid-lg">
    <div class="row">
      <div class="col-12">
        <!--Header-->
        <div class="container-fluid-lg mb-5">
          <div class="row">
            <div class="col-12">
              <nav>
                <div class="logo" style="display: flex;align-items: center;">
                  <span
                    style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                  <span style="padding: 0.5rem;"><img src="../img/cora2.png" alt="Descripción de la imagen"></span>
                </div>
                <div class="hamburger">
                  <div class="line1"></div>
                  <div class="line2"></div>
                  <div class="line3"></div>
                </div>
                <ul class="nav-links">
                <?php 
                 $rol=$_SESSION['Rol'];
                  // Incluye barraNavegacion.php antes de llamar a la función generarMenu
                  include('../php/barraNavegacion.php');
                  
                  // Llama a la función generarMenu con el rol del usuario
                  generarMenu($rol);
                  ?>
                  <?php
                  if(isset($_GET['cerrar_sesion'])) {
                          // Eliminar las cookies de sesión
                          if (ini_get("session.use_cookies")) {
                              $params = session_get_cookie_params();
                              setcookie(session_name(), '', time() - 42000,
                                  $params["path"], $params["domain"],
                                  $params["secure"], $params["httponly"]
                              );
                          }
                    // Destruir la sesión
                    session_unset();
                    session_destroy();
                    $_SESSION = array();
                    // Redirigir a la página de inicio de sesión
                    header("Location: ../login.php");
                    exit();
                } else if(!isset($_SESSION['sesion_cerrada'])) {
                  echo '
                  <ul class="nav-links">
                  <li><a href="../login.php?cerrar_sesion=true" class="login-button"  onclick="return confirm(\'¿Seguro que quieres salir?\')" 
                  style="color: white;">
                  Cerrar Sesión </a>
              </li>
              </ul>';
                }else {   
            }
            unset($_SESSION['sesion_cerrada']);
            ?>
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
      <!--Main o contenido-->
      <div class="container mt-5 rowborder-secondary border-opacity-50 rounded-1"
        style="margin-top: 20%; background-color: #e4e4e4; padding: 50px; margin-left: 1%;">
        <h1 class="display-4" style="color: black; font-size: 36px; font-family: 'DM Serif Display';">Consulta de
          citas del paciente: <img src="../img/ct.png" alt="img" style="width: 180px; height: 170px; float: right;"></h1>
          <h4 style="font-family: 'DM Serif Display';">¡Hola, <?php
          if(isset($_SESSION["NombreCompleto"]) && $_SESSION["Rol"] === 'paciente') {
          // Accede al nombre completo del paciente
          $nombreCompletoP = $_SESSION["NombreCompleto"];
          echo $nombreCompletoP;
           } ?>!
          </h4>

          <div class="row mt-4">
            <div class="col-md-2">
              <div class="form-group">
                <label for="date" style="color: black; font-size: 16px; font-family: 'Rubik';">Filtrar por fecha:</label>
                <input type="date" name="fecha" class="form-control">
              </div>
            </div>
  
            <div class="col-md-3">
              <div class="form-group">
                <label for="doctor" style="color: black; font-size: 16px; font-family: 'Rubik';">Buscar por doctor:</label>
                <input type="text" name="iddoctor" class="form-control">
              </div>
            </div>
          
        </div>
        
        <table class="table table-striped mt-4" style="color: black; font-size: 16px; font-family: 'Rubik';">
          <thead class="thead-dark">
            <tr>
              <td class="col-1">ID Cita</td>
              <td class="col-1">Fecha</td>
              <td class="col-1">Hora</td>
              <td class="col-1">Estatus</td>
              <td class="col-2">Opciones</td>
            </tr>
          </thead>
          <tbody>
            <?php
                 if ($resultado->num_rows > 0) {
                 while($fila = $resultado->fetch_assoc()){    
            ?>
            <tr>
              <th><?php echo $fila['IDC'] ?></th>
              <th><?php echo $fila['fechaC'] ?></th>
              <th><?php echo $fila['HoraC'] ?></th>
              <th><?php echo $fila['ESTATUS'] ?></th>
              <td>
                <?php echo "<a href='actualizaCitasP.php?IDC=".$fila['IDC']."' style='background-color: #176b87; color: #fff;  text-decoration: none;
                margin-top: 30px;  border: none; border-radius: 3px; cursor: pointer; width: 30%; padding: 5px; text-align: center;'>Actualizar</a>";?>
    
                <?php echo "<a href='eliminaCitasP.php?IDC=".$fila['IDC']."' style='background-color: #176b87; color: #fff;  text-decoration: none;
                margin-top: 30px;  border: none; border-radius: 3px; cursor: pointer; width: 30%; padding: 5px; text-align: center;'>Eliminar</a>";?>
              </td>
            </tr>
            <?php
            }
          } else {
            echo '<tr><td colspan="5">No se han realizado citas previas.</td></tr>';
          }
            ?>
          </tbody>
        </table>
        <?php
        $conexion->close();
        ?>
        <?php
// Verifica si hay un mensaje de eliminación de cita
if (isset($_SESSION['mensaje_eliminar_cita'])) {
    echo "<div class='alert alert-success' style='color:red;'>" . $_SESSION['mensaje_eliminar_cita'] . "</div>";
    // Limpia la variable de sesión después de mostrar el mensaje
    unset($_SESSION['mensaje_eliminar_cita']);
}
if (isset($_SESSION['mensaje_actualizar_cita'])) {
  echo "<div class='alert alert-success' style='color:blue;'>" . $_SESSION['mensaje_actualizar_cita'] . "</div>";
  // Limpia la variable de sesión después de mostrar el mensaje
  unset($_SESSION['mensaje_actualizar_cita']);
}
if (isset($_SESSION['mensaje_crear_cita'])) {
  echo "<div class='alert alert-success' style='color:green;'>" . $_SESSION['mensaje_crear_cita'] . "</div>";
  // Limpia la variable de sesión después de mostrar el mensaje
  unset($_SESSION['mensaje_crear_cita']);
}
?>
      </div>
      <div class="container">
        <div class="col-md-2">
          <div class="form-group">
            
            <a href="../Blog_Medico.php?rol=paciente" style="background-color: #176b87; color: #fff; float: left; text-decoration: none;
            margin-top: 30px; margin-left: 40px; border: none; border-radius: 3px; cursor: pointer; width: 40%; padding: 5px; text-align: center;">Regresar</a>
          </div>
        </div>
      </div>
      <!--footer-->
      <div class="container-fluid-lg py-5">
        <footer class="bg-dark text-center py-5 mt-5">
          <div class="row">
            <p style="color: white;">&copy; 2023 Medicatec</p>
          </div>
        </footer>
      </div>
    </div>
  </div>



  <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
  <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
  $(document).ready(function () {
  // Guardar el contenido original de la tabla
  var tablaOriginal = $('tbody').html();

  // Manejar el evento de cambio en los campos de filtro
  $('input[name="fecha"], input[name="iddoctor"]').on('input', function () {
    // Obtener los valores de los campos de filtro
    var fecha = $('input[name="fecha"]').val();
    var iddoctor = $('input[name="iddoctor"]').val();

    // Realizar la solicitud AJAX al servidor PHP
    $.ajax({
      type: 'POST',
      url: '../php/filtrarDatos.php',
      data: { fecha: fecha, iddoctor: iddoctor },
      success: function (response) {
        // Si la respuesta está vacía, restaurar el contenido original de la tabla
        if (response.trim() === '') {
          $('tbody').html(tablaOriginal);
        } else {
          // Si hay datos filtrados, actualizar el contenido de la tabla
          $('tbody').html(response);
        }
      }
    });
  });
});
</script>
</body>
</html>