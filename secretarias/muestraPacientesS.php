<?php
session_start();
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
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/doctor.css">
</head>

<body>

    <!--Header-->
    <header>
        <div class="container-fluid-lg">
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
                        <?php 
                        $rol=$_SESSION['Rol'];
                        // Incluye barraNavegacion.php antes de llamar a la función generarMenu
                        include('../php/barraNavegacion.php');
                  
                        // Llama a la función generarMenu con el rol del usuario
                        generarMenu($rol);
                    ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!--Main o contenido-->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container-fluid formato mt-5 mb-2">
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-3 text-start">
                                <img src="../img/LOGO.png" 
                                    style="width: 200px; height: 190px;" alt="Descripción de la imagen" />
                            </div>
                            <div class="col-6 text-center">
                                <h2><i class="fa-solid fa-hospital-user"></i> Consulta de Pacientes</h2> <!---->
                            </div>
                            <div class="col-3 text-end">
                                <img src="../img/LOGO.png" 
                                    style="width: 200px; height: 190px;" alt="Descripción de la imagen" />
                            </div>
                        </div>
                    </div>
                 <div class="col-12 text-center">
                    <?php
                    // En muestraPacientesD.php
                   
                    if(isset($_SESSION['mensajeModificacion'])) {
                        $mensaje = $_SESSION['mensajeModificacion'];
                        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">';
                        echo '<i class="fa-solid fa-circle-exclamation" style="color: #0d6efd;"></i> '.$mensaje;
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                        unset($_SESSION['mensajeModificacion']);
                    }
                    if(isset($_SESSION['mensajeEliminacion'])) {
                        $mensaje = $_SESSION['mensajeEliminacion'];
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$mensaje; 
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                        unset($_SESSION['mensajeEliminacion']);
                    }
                    if(isset($_SESSION['mensajeError'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$mensaje;
                        echo '<i class="fa-solid fa-triangle-exclamation fa-sm" style="color: #7d0003;"></i>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                        unset($_SESSION['mensajeError']);
                    }
                    ?>
                    </div>
                    <div class="col-12">
                    <table class="table table-striped" style="vertical-align: middle;">
                            <tr>
                                <th>Nombre</th>
                                <th>CURP</th>
                                <th>Correo</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                            <?php
                            // Incluye el archivo de conexión
                            include '../php/acceso.php';
                            // Realizar la consulta para obtener los registros de pacientes dependiendo de la secretaria
                            //$IDS = $_SESSION['IDS'];
                            $sql = "SELECT * FROM pacientes where Estatus = 'Activo'";
                            $result = $dp->query($sql);
                            
                            if (!$result) {
                                die("Error en la consulta: " . $dp->error);
                            }
                            

                            // Imprimir los registros en la tabla
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td >" . $row['NombreCompletoP'] . "</td>";
                                    echo "<td>" . $row['CURPP'] . "</td>";
                                    echo "<td>" . $row['correoP'] . "</td>";
                                    echo "<td>" . $row['Estatus'] . "</td>";
                                    echo "<td>";
                                    echo '<div class="gap-2 mx-auto form" style="padding: 1rem;">';
                                    echo '<a href="modificaPacientesS.php?idPaciente=' . $row["IDP"] . '" type="button" "><button >Modificar</button></a>';
                                    echo '&nbsp;';  
                                    echo '<a href="eliminaPacientesS.php?idPaciente=' . $row["IDP"] . '" type="button"><button >Borrar</button></a>';
                                    echo '&nbsp;'; 
                                    echo '<a href="consultaPacientesS.php?idPaciente=' . $row["IDP"] . '" type="button"><button >Consultar</button></a>';
                                    echo '&nbsp;'; 
                                    echo '</div>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay pacientes registrados.</td></tr>";
                            }

                            // Cerrar la conexión a la base de datos
                            $dp->close();
                            ?>
                        </table>

                        <div class="d-grid gap-2 col-6 mx-auto form" style="padding: 1rem;">
                            <a href="../Blog_Medico.php?rol=secretario"> 
                                <button type=""><i class="fa-solid fa-person-walking-arrow-loop-left" style="color: #ffffff;"></i> Regresar</button>
                            </a>
                        </div>
                         
                </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>

      <!--footer-->
      <div class="container-fluid-lg ">
        <footer class="bg-dark text-center py-5 mt-5">
            <div class="row">
                <p style="color: white;">&copy; 2023 Medicatec</p>
            </div>
        </footer>
    </div>
    
         <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
         <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/creaCitas.js"></script>
    <script src="../main.js"></script>
    <script src="../js/ValidacionesCampos.js"></script>
</body>

</html>