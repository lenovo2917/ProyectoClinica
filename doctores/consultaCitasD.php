<!--Creo Antonio-->
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
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <!--ESTILOS CSS-->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/doctores.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">

</head>

<body style="background-color: #EEEEEE;">


    <!--Header-->
    <div class="container-fluid-lg mb-4">
        <div class="row">
            <div class="col-12">
                <nav style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="logo">
                        <span
                            style="color: #000000; font-size: 26px; font-weight: bold; letter-spacing: 1px; margin-left: 20px;">MEDICATEC</span>
                        <span style="padding: 0.5rem;"><img src="../img/cora2.png"
                                alt="Descripción de la imagen"></span>
                    </div>
                    <div class="doctor-info" style="display: flex; align-items: center; margin-right: 20px;">
                        <span style="color: #000000; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Nombre
                            del Doctor</span>
                        <span style="margin-right: 10px;">
                            <i class="fas fa-user-md fa-2x"></i>
                        </span>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!--Main o contenido-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row text-start align-items-center">
                            <div class="col-2 text-center">
                                <img src="../img/LOGO.png" style="width: 180px; height: 170px;"
                                    alt="Descripción de la imagen">
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-9">
                                <h4>Doctor: Jesus Ramon de la Cruz Perez</h5>
                                    <h5>Especialidad: Pediatra</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border border-1 border-secondary border-opacity-50 rounded-1"
                    style="background-color: #C5C5C5;">
                    <div class="col-12 text-center mb-4 mt-4">
                        <h2>Consulta citas</h2>
                    </div>
                    <div class="col-12 px-5">
                        <form class="form" method="post">
                            <div class="row ">
                                <div class="col-12">
                                    <div class="row mb-1">
                                        <label for="nombrePaciente" class="col-2 col-form-label">Buscar por
                                            nombre:</label>
                                        <div class="col-5 text-start">
                                            <input type="text" class="form-control" id="nombrePaciente"
                                                name="nombrePaciente" placeholder="Nombre del paciente">

                                        </div>

                                        <div class="col-1">
                                            <button type="submit" class="btn btn-primary">Buscar</button>

                                        </div>
                                        <label for="" class="text-end col-2 col-form-label">Busqueda por mes:</label>
                                        <div class="col-2 text-start">
                                           <select class="form-select" aria-label="" name="mes">
                                                <option value="enero">enero</option>
                                                <option value="febrero">febrero</option>
                                                <option value="marzo">marzo</option>
                                                <option value="abril">abril</option>
                                                <option value="mayo">mayo</option>
                                                <option value="junio">junio</option>
                                                <option value="julio">julio</option>
                                                <option value="agosto">agosto</option>
                                                <option value="septiempre">septiempre</option>
                                                <option value="octubre">octubre</option>
                                                <option value="noviembre">noviembre</option>
                                                <option value="diciembre">diciembre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 my-2">
                                            <h5 class="">Pacientes:</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
    <div class="row mb-4 border border-1 border-secondary border-opacity-75 rounded-1" style="background-color: white">
    <div style="height: 400px; overflow-y: auto;">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-1">#</th>
                <th class="col-3">Paciente</th>
                <th class="col-2">Fecha</th>
                <th class="col-2">Estado</th>
                <th class="col-4">Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
                                                include '../php/acceso.php';

                                                $query = "SELECT c.IDC, p.NombreCompletoP, c.fechaC, c.ESTATUS
                                                FROM citas c
                                                LEFT JOIN pacientes p ON c.IDP = p.IDP
                                                WHERE 1 = 1";  // Usamos "1=1" como marcador inicial
                                      
                                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                          $nombrePaciente = $_POST['nombrePaciente'];
                                          $mesSeleccionado = $_POST['mes'];
    
                                      
                                          if (!empty($nombrePaciente)) {
                                              $query .= " AND p.NombreCompletoP LIKE '%$nombrePaciente%'";
                                          }
                                          
                                          if (isset($_POST['mes'])) {
                                            $mesSeleccionado = $_POST['mes'];
                                        
                                            // Mapea el nombre del mes al número de mes
                                            $meses = [
                                                'enero' => '01',
                                                'febrero' => '02',
                                                'marzo' => '03',
                                                'abril' => '04',
                                                'mayo' => '05',
                                                'junio' => '06',
                                                'julio' => '07',
                                                'agosto' => '08',
                                                'septiempre' => '09',
                                                'octubre' => '10',
                                                'noviembre' => '11',
                                                'diciembre' => '12'
                                            ];
                                        
                                            if (isset($meses[$mesSeleccionado])) {
                                                $mesNumero = $meses[$mesSeleccionado];
                                                $query .= " AND MONTH(c.fechaC) = '$mesNumero'";
                                            } else {
                                                // Tratar errores o manejar casos en los que el mes no sea válido
                                            }
                                        }
                                    }
                                        
                                
                                      
          
  

            // Ejecutar la consulta
            $result = mysqli_query($dp, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['IDC'] . "</td>";
                echo "<td>" . $row['NombreCompletoP'] . "</td>"; 
                echo "<td>" . $row['fechaC'] . "</td>";
                echo "<td>" . $row['ESTATUS'] . "</td>";
                echo '<td class="text-center">';
                echo '<button class="btn-aceptar" data-id="' . $row['IDC'] . '">Aceptar</button>';
                echo '<a class="btn-rechazar" href="./cancelarCitasD.html?citaID=' . $row['IDC'] . '">Rechazar</a>';
                echo '  <button type="button" class="btn btn-rechazar  btn-trasladar" data-bs-toggle="modal" data-bs-target="#miModal" data-cita-id="' . $row['IDC'] . '">
                Trasladar
            </button>
                ';
                echo '</td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>



                                    </div>
                                </div>
                                
                                <div class="modal" tabindex="-1" id="miModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Trasladar paciente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Selecciona al nuevo médico para el paciente:</p>
                                                <select id="doctorSelect" class="form-select">
                                                    <option value="">Seleccione un médico</option>
                                                    <?php
                                                    // Realiza una consulta para obtener los médicos disponibles de la especialidad "Medico General"
                                                    include '../php/acceso.php';
                                    
                                                    $query = "SELECT IDD, NombreCompletoD FROM doctores WHERE EspecialidadD = 'Medico General' AND EstatusD = 'Activo'";
                                                    $result = mysqli_query($dp, $query);
                                    
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['IDD'] . '">' . $row['NombreCompletoD'] . '</option>';
                                                    }
                                    
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <a href="#" id="guardarCambios">Guardar Cambios</a>
                                            </div>
                                        </div>
                                    </div>
                                  </div>





                                <div class="col-1">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--footer-->
    <div class="container-fluid-lg">
        <footer class="bg-dark text-center py-5 mt-5">
            <div class="row">
                <p style="color: white;">&copy; 2023 Medicatec</p>
            </div>
        </footer>
    </div>

    <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/consutarCitasD.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../js/creaCitas.js"></script>
    <script src="../js/main.js"></script>


</body>



</body>

</html>