<?php
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
    <link rel="shortcut icon" href="/img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/actualizaCitas.css">
    
</head>
<body>
    <?php
         $conexion = new mysqli('localhost', 'root', '', 'medicatec_2023');

         if(isset($_POST['enviar'])){
            $id=$_POST['id'];
            $fecha=$_POST['fecha'];
            $hora=$_POST['hora'];
            $sintomas=$_POST['sintomas'];
            $descripcion=$_POST['descripcion'];

            $sql="UPDATE citas set fechaC='".$fecha."', HoraC='".$hora."', sintomasC='".$sintomas."', descripcionC='".$descripcion."' WHERE IDC='".$id."'";
            $resultado = $conexion->query($sql);
            if($resultado){
                echo "<script language='JavaScript'>
                alert('La cita fue actualizada exitosamente.');
                location.assign('consultaCitasP.php');
                </script>";
            }else{
                echo "<script language='JavaScript'>
                alert('La cita no se pudo actualizar.');
                location.assign('consultaCitasP.php');
                </script>";
            }

         }else{
            $id=$_GET['IDC'];
            $sql="SELECT * FROM citas where IDC='".$id."'";
            $resultado = $conexion->query($sql);

            $fila=$resultado->fetch_assoc();
            $fecha=$fila["fechaC"];
            $hora=$fila["HoraC"];
            $sintomas=$fila["sintomasC"];
            $descripcion=$fila["descripcionC"];
         }
    ?>
<div class="container-fluid-lg" style="background-color: #eeeeee;">
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
                                    <span style="padding: 0.5rem;"><img src="../img/cora2.png"
                                            alt="Descripción de la imagen"></span>
                                </div>
                                <div class="hamburger">
                                    <div class="line1"></div>
                                    <div class="line2"></div>
                                    <div class="line3"></div>
                                </div>
                                <ul class="nav-links">
                                    <li><a href="../Blog_Medico.php?rol=paciente">Inicio</a></li>
                                    <li><a href="creaCitasP.php">Crear cita</a></li>
                                    <li><a href="consultaCitasP.php">Consultar citas</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            
            <!--Main o contenido-->
    <div class="container" style="text-align: center; margin-top: 100px;">
            <h1><img src="../img/mod.png" style="width: 40px; height: 40px; margin-right: 10px; margin-bottom: 7px;" alt="Des">Modifique los datos de su cita:</h1>

    <form id="citaForm" action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
        <img src="../img/ct.png" alt="img" style="width: 180px; height: 170px;">
        <input type="hidden" name="id" value="<?php echo $id;?>">

        <label for="fecha">Fecha de cita:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" required><br>

        <label for="fecha">Hora de cita:</label>
        <input type="time" id="hora" name="hora" value="<?php echo $hora;?>" required><br>
        
        <label for="sintomas">Síntomas:</label>
        <textarea id="sintomas" name="sintomas" rows="4" required><?php echo htmlspecialchars($sintomas);?></textarea><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($descripcion);?></textarea><br>

        <input type="submit" name="enviar" value="Modificar cita">
        <a href="consultaCitasP.php" style="background-color: #176b87; color: #fff; float: left; padding-top: 8px;
        margin-top: 30px; margin-left: 100px; border: none; border-radius: 3px; cursor: pointer; width: 20%; height: 5%; text-decoration: none;">Regresar</a>
    </form>
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

    <script src="../js/actualizaCitas.js"></script>
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>

</body>
</html>