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
                        <ul class="nav-links">
                            <li><a href="../Blog_Medico.php">Inicio</a></li>
                        </ul>
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
                            $ID_secretaria = $_SESSION['Rol=?secretario'];
                            $ID_secretaria = mysqli_real_escape_string($dp, $ID_secretaria);

                            $sql = "SELECT NombreCompletoP, CURPP, correoP, Estatus FROM pacientes WHERE IDS = $ID_secretaria";
                            $result = $dp->query($sql);
                            
                            if (!$result) {
                                die("Error en la consulta: " . $dp->error);
                            }
                            

                            // Imprimir los registros en la tabla
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['NombreCompletoP'] . "</td>";
                                    echo "<td>" . $row['CURPP'] . "</td>";
                                    echo "<td>" . $row['correoP'] . "</td>";
                                    echo "<td>" . $row['Estatus'] . "</td>";
                                    echo '<td>
                                            <div class="gap-2 mx-auto form" style="padding: 1rem;">
                                                <a href="modificaPacientesS.php?id=' . $row['CURPP'] . '" type="button">
                                                    <button>Modificar</button>
                                                </a>
                                                <a href="eliminaPacientesS.php?id=' . $row['CURPP'] . '" type="button">
                                                    <button>Borrar</button>
                                                </a>
                                                <a href="consultaPacientesS.php?id=' . $row['CURPP'] . '" type="button">
                                                    <button>Consultar</button>
                                                </a>
                                            </div>
                                        </td>';
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
         <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
    <script src="../js/creaCitas.js"></script>
    <script src="../main.js"></script>
</body>

</html>