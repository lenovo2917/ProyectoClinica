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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
                                            <select class="form-select" aria-label="">
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

                // Definir la consulta SQL para obtener las citas
                $query = "SELECT c.IDC, p.NombreCompletoP, c.fechaC, c.ESTATUS
                          FROM citas c
                          LEFT JOIN pacientes p ON c.IDP = p.IDP";

                // Si se ha enviado un nombre de paciente, ajustar la consulta para buscar por nombre
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombrePaciente = $_POST['nombrePaciente'];
                    if (!empty($nombrePaciente)) {
                        $query = "SELECT c.IDC, p.NombreCompletoP, c.fechaC, c.ESTATUS
                                  FROM citas c
                                  LEFT JOIN pacientes p ON c.IDP = p.IDP
                                  WHERE p.NombreCompletoP LIKE '%$nombrePaciente%'";
                    }
                }

                // Ejecutar la consulta
                $result = mysqli_query($dp, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['IDC'] . "</td>";
                    echo "<td>" . $row['NombreCompletoP'] . "</td>"; // Nombre del paciente
                    echo "<td>" . $row['fechaC'] . "</td>";
                    echo "<td>" . $row['ESTATUS'] . "</td>";
                    echo '<td class="text-center">';
                    echo '<button class="btn-aceptar" data-id="' . $row['IDC'] . '">Aceptar</button>';
                    echo '<a class="btn-rechazar" href="./cancelarCitasD.html?citaID=' . $row['IDC'] . '">Rechazar</a>';
                    echo '<a class="btn-trasladar" href="./creaResetaD.html?citaID=' . $row['IDC'] . '">Trasladar</a>';
                    echo '</td>';
                    echo "</tr>";
                }

                // Liberar los resultados
                mysqli_free_result($result);
                ?>
            </tbody>
        </table>
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
    <script src="../js/creaCitas.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/consutarCitasD.js"></script>


</body>

</html>