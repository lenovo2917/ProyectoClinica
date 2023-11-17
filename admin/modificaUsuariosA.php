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
    <link rel="stylesheet" type="text/css" href="../css/doctor.css">

</head>

<body>

    <!--Header-->
    <header>
        <div class="container-fluid-lg mb-5">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <div class="logo" style="display: flex;align-items: center;">
                            <span
                                style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                            <span style="padding: 0.5rem;"><img src="../img/cora2.jpeg"
                                    alt="Descripción de la imagen"></span>
                        </div>
                        <div class="hamburger">
                            <div class="line1"></div>
                            <div class="line2"></div>
                            <div class="line3"></div>
                        </div>
                        <ul class="nav-links">
                            <li><a href="../Blog_Medico.php?rol=admin">Inicio</a></li>
                            <li><a class="login-button" type="button" style="color: white;">Admin</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <br>
    <br>

    <?php          
        include '../php/acceso.php';

        // Muestra los resultados de la consulta (DOCTORES)
        $userID = $_GET["id"];
        echo $userID;

        $sqlD = "SELECT NombreCompletoD FROM doctores where IDD = $userID";
        $resultD = $dp->query($sqlD);

        if ($resultD->num_rows > 0) {
            // Imprime el nombre del usuario
            $rowD = $resultD->fetch_assoc();
            echo "Nombre del usuario: " . $rowD["NombreCompletoD"];
        } else {
            echo "Usuario no encontrado";
        }
    ?>

    <!--Main o contenido-->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container-fluid formato">
                    <form class="form" method="post" action="../php/procesaModificaUA.php">
                        <input type="hidden" name="id" value="<?php echo $userID; ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-3 text-start">
                                        <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                            alt="Descripción de la imagen" />
                                    </div>
                                    <div class="col-5 text-center">
                                        <h2><i class="fa-solid fa-users"></i> Modificación de Usuarios</h2> <!---->
                                    </div>
                                    <div class="col-3 text-end">
                                        <img src="../img/LOGO.png" style="width: 200px; height: 190px;"
                                            alt="Descripción de la imagen" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-8" style="text-align: left;">
                                <label class="form-label">Nombre Completo:</label>
                                <input class="form-control" type="text" name="nombreD" value="<?php echo $rowD["NombreCompletoD"]; ?>" required />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">CURP:</label>
                                <input class="form-control" type="text" placeholder="'CURP RECUPERADA'" 
                                    maxlength="18" title="Ingrese correctamente su CURP" />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Fecha de Nacimiento:</label>
                                <input class="form-control" type="date" placeholder="'FECHA DE NACIMIENTO RECUPERADA'"
                                     />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Cedula:</label>
                                <input class="form-control" type="text" placeholder="'CEDULA RECUPERADA'" maxlength="20"
                                    title="Sea especifico" />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Télefono:</label>
                                <input class="form-control" type="tel" placeholder="'TELÉFONO RECUPERADO'"
                                    maxlength="10" title="Ingrese un formato válido (xxx-xxx-xxxx)" />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Correo:</label>
                                <input class="form-control" type="email" placeholder="'E-MAIL RECUPERADO'" 
                                    maxlength="25" title="ejemplo@gmail.com" />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Contraseña:</label>
                                <input class="form-control" type="password" placeholder="'CONTRASEÑA RECUPERADA'"
                                     maxlength="8" title="****" />
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <label class="form-label">Alergias:</label>
                                <input class="form-control" type="text" placeholder="'ALERGIAS RECUPERADAS'"
                                    maxlength="20" title="Sea especifico" />
                            </div>


                            <div class="col-4" style="text-align: left;">
                                <div class="form-group">
                                    <label class="form-label">Tipo de sangre:</label>
                                    <select name="tipo-sangre" id="tipo-sangre"  class="formato2"
                                        style="width: 100%;">
                                        <option value="" disabled selected>Tipo de sangre *</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <div class="form-group">
                                    <label class="form-label">Género:</label>
                                    <select name="genero" id="genero" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Género</option>
                                        <option value="F">F</option>
                                        <option value="M">M</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4" style="text-align: left;">
                                <div class="form-group">
                                    <label class="form-label">Estatus:</label>
                                    <select name="estatus" id="estatus" class="formato2" style="width: 100%;">
                                        <option value="" disabled selected>Estatus</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <button type="submit" name="submit">Modificar Usuario</button>
                            </div>

                            <div class="d-grid gap-2 col-4 mx-auto" style="padding: 1rem;">
                                <a href="consultaUsuariosA.html" type="button">
                                    <button type="button">Cancelar</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="/main.js"></script>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="/main.js"></script>
            </div>
        </div>
    </div>

    
    <br>
    <!--footer-->
    <footer class="bg-dark text-white text-center py-3">
        <p style="font-family: 'Rubik'; color: white;">&copy; 2023 Medicatec</p>
    </footer>
    </div>
    </div>



    <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>

</body>

</html>

</html>