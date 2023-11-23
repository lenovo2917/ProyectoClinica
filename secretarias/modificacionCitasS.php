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
    <!--ESTILOS CSS-->
    <link rel="shortcut icon" href="../img/web.png" type="img">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/doctores.css">
</head>

<body style="background-color: #EEEEEE;">
    <!--Header-->
    <div class="container-fluid-lg mb-4">
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
                        <li><a href="../Blog_Medico.html">Inicio</a></li>
                        <li><a href="creaCitasP.html">Crear cita</a></li>
                        <li><a href="consultaCitasP.html">Consultar citas</a></li>
                        <li><a class="login-button" type="button" style="color: white;" href="login.html">Login</a>
                        </li>
                      </ul>
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
                            <div class="col-12">
                                <div class="row text-start align-items-center">
                                    <div class="col-4 ps-5 text-start">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>Secretaria:</h5>
                                            </div>
                                            <div class="col-12">
                                                <h4>Ana Lucia Garcia Gomez</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h2>Modificación de citas</h2>
                                    </div>
                                    <div class="col-4 text-end">
                                        <img src="../img/LOGO.png" style="width: 180px; height: 170px;"
                                            alt="Descripción de la imagen">
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
                

                <div class="row border border-1 border-secondary border-opacity-50 rounded-1"  style="background-color: white;">
                    <div class="col-12 px-5">
                        <form class="form" method="post">
                            <div class="row ">
                                
                                </div>
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 mt-4">
                                            <h4 class="">Datos del paciente:</h4>
                                        </div>
                                        <input type="hidden" name="idCita" value="<?php echo $idC; ?>">
                                        <div class="row py-2">
                                            <label for="" class=" py-2 col-1 col-form-label">Paciente:</label>
                                            <div class="border-bottom border-secondary col-5 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                    value="Jorge Damian Reyes Hernandez" name="nombrePaciente" value="<?php echo isset(
                                    $rowPaciente["nombreP"]) ? $rowPaciente["nombreP"] : ''; ?>">
                                            </div>
                                            <label for="" class=" col-1 col-form-label">CURP:</label>
                                            <div class="border-bottom border-secondary col-3 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id=""
                                                name="CURPPaciente" value ="<?php echo isset(
                                    $rowPaciente["CURPP"]) ? $rowPaciente["CURPP"] : ''; ?>">
                                            </div>
                                            <label for="" class="col-1 col-form-label">Edad:</label>
                                            <div class="border-bottom border-secondary col-1 text-start">
                                                <input type="text" readonly class="form-control-plaintext" id="" name="fNPaciente" value ="<?php echo isset(
                                    $rowPaciente["fNP"]) ? $rowPaciente["fNP"] : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <label for="" class=" col-1 col-form-label">Sintomas:</label>
                                            <div class="border-bottom border-secondary col-4 text-start">
                                                <input type="text"  class="form-control-plaintext" id="" name="sintomasCita" value ="<?php echo isset(
                                    $rowPaciente["sintomasC"]) ? $rowPaciente["sintomasC"] : ''; ?>">
                                            </div>
                                            <label for="" class="col-1 col-form-label">Alergias:</label>
                                            <div class="border-bottom border-secondary col-3 text-start">
                                                <input type="text"  class="form-control-plaintext" id="" name="alergiasC" value ="<?php echo isset(
        $rowPaciente["alergiasC"]) ? $rowPaciente["alergiasC"] : ''; ?>">
                                            </div>
                                            <label for="" class="col-2 col-form-label text-end">tipo de sangre:</label>
                                            <div class="border-bottom border-secondary col-1 text-start">
                                                <select class=" form-control-plaintext" aria-label="Default select example">
                                                <option name="tipoSangreCita" disabled selected>Tipo de sangre *</option>
                                        <option value="A+" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "A+" ? 'selected' : ''; ?>>A+</option>
                                        <option value="A-" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "A-" ? 'selected' : ''; ?>>A-</option>
                                        <option value="B+" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "B+" ? 'selected' : ''; ?>>B+</option>
                                        <option value="B-" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "B-" ? 'selected' : ''; ?>>B-</option>
                                        <option value="O+" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "O+" ? 'selected' : ''; ?>>O+</option>
                                        <option value="O-" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "O-" ? 'selected' : ''; ?>>O-</option>
                                        <option value="AB+" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "AB+" ? 'selected' : ''; ?>>AB+</option>
                                        <option value="AB-" <?php echo isset($rowPaciente["tipoSangreC"]) && $rowPaciente["tipoSangreC"] == "AB-" ? 'selected' : ''; ?>>AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class=" col-12 text-end" >
                                <input type="submit" value="Modificar cita">
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
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
    <script src="../js/main.js"></script>

</body>