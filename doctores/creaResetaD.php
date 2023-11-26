<?php
session_start();
if(empty($_SESSION["NombreCompleto"])) {
  header("Location: ../login.php"); // Si no hay ninguna sesión activa, redirige al login
} 
?>
<?php include '../php/acceso.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MEDICATEC</title>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@500&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome/css/all.css" rel="stylesheet">

    <link rel="shortcut icon" href="../img/web.png" type="img">
    <!--ESTILOS CSS-->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Diseño_Crear_Receta.css">
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">

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
                        <?php
                        if ($_SESSION["Rol"] === 'doctor') {
                            echo '<span style="color: #000000; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Bienvenido Doctor/a ' . $_SESSION["NombreCompleto"] . '</span>';
                            echo '<span style="margin-right: 10px;"><i class="fas fa-user-md fa-2x"></i></span>';
                        }
                        ?>
                    </div>

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
                  header("Location:../login.php");
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
                </nav>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="titulo">Página del Médico</h1>
                        </div>
                    </div>


                    <!-- Fila con dos columnas: imagen y doctor-info -->
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="../img/LOGO_CLINICA_TACHIRITO.png" alt="Logo del médico" width="150" height="150">
                        </div>
                        <div class="col-lg-4 doctor-info">
                            <h3>Información del Doctor</h3>
                            <p>Doctor/a:
                                <?php echo $_SESSION["NombreCompleto"];?>
                            </p>
                            <p>Especialidad:
                                <?php echo isset($_SESSION["EspecialidadD"]) ? $_SESSION["EspecialidadD"] : ''; ?>
                            </p>

                        </div>
                    </div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="receta-tab" data-toggle="tab" href="#receta" role="tab"
                                aria-controls="receta" aria-selected="true">Crear Receta Médica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="expedientes-tab" data-toggle="tab" href="#expedientes" role="tab"
                                aria-controls="expedientes" aria-selected="false">Expedientes de Paciente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="citas-tab" data-toggle="tab" href="#citas" role="tab"
                                aria-controls="citas" aria-selected="false">Programar Citas Médicas</a>
                        </li>

                    </ul>



                    <!-- Tab content -->
                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- Encabezado -->
                                    <img src="../img/LOGO.png" alt="Clinica Tachirito" class="logo">
                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">RECETA MÉDICA</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Información del doctor -->
                                    <p>Nombre del doctor: <span id="doctorNombre"> <?php echo $_SESSION["NombreCompleto"];?></span></p>
                                    <p>Cedula profesional: <span id="cedulaProfesional"><?php echo $_SESSION["CedulaD"];?></span></p>
                                    <p>Dirección: <span id="direccion">Avenida de los Jacarandas #567 
                                       Colonia del Sol 
                                       Cuernavaca, Morelos. 
                                       Código Postal: 62100</span></p>
                                    <hr class="my-4">
                                    <!-- Contenido de la receta en forma de tabla -->
                                    <table class="table" id="datosReceta">
                                      
                                    </table>
                                    <!-- Firma y nombre del doctor -->
                                    <div class="firma">
                                        <hr class="my-4">
                                        <p>Firma del doctor: __________________________</p>
                                        <p>Nombre del doctor: <span id="nombreFirma"> <?php echo $_SESSION["NombreCompleto"];?></span></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="agregarExpediente" class="btn btn-primary">Agregar al
                                        expediente</button>
                                    <!-- Botones con iconos -->
                                    <button id="descargar" class="btn btn-secondary" style="display: none;"><i
                                            class="fas fa-download"></i></button>
                                    <button id="imprimir" class="btn btn-secondary" style="display: none;"><i
                                            class="fas fa-print"></i></button>
                                            
                                </div>

                                <!-- modal footer para alertas -->
                                <div class="modal-footer">
                                    <div id="alertContainerInModal"></div>
                                </div>
                                
                                <div class="modal-footer">
                                    <!-- Texto y línea adicional -->
                                    <p class="indicaciones">Seguir indicaciones y tomar tratamiento completo</p>
                                    <hr class="my-4">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Tab 1: Crear Receta Médica -->
                        <div class="tab-pane fade show active" id="receta" role="tabpanel" aria-labelledby="receta-tab">
                            <div class="navbar">
                                <a href="./IndexDoctores.php">
                                    <i class="fa-solid fa-arrow-left fa-lg"></i>
                                </a>
                                <h2>Formulario para Crear Receta Médica</h2>
                            </div>

                            <form id="recetaForm" method="post" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="nombre">Nombre del Paciente *</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre" required>
                                    <div class="invalid-feedback">Por favor, ingresa el nombre.</div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="fecha">Fecha de la Receta *</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">CITAS</button>
                                            <ul class="dropdown-menu" id="citasDropdown">
                                                <input type="hidden" id="idCita" name="idCita" value="">
                                            </ul>
                                        </div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" required>
                                        <div class="invalid-feedback">Por favor, selecciona una fecha.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="diagnostico">Diagnóstico *</label>
                                    <textarea class="form-control" id="diagnostico" rows="3"
                                        placeholder="Ingrese el diagnóstico" name="diagnostico" required
                                        style="resize: none"></textarea>
                                    <div class="invalid-feedback">Por favor, ingresa el diagnóstico.</div>
                                </div>
                                <div class="form-group">
                                    <label for="medicamento">Medicamento Recetado *</label>
                                    <input type="text" class="form-control" id="medicamento" name="medicamento"
                                        placeholder="Nombre del medicamento" required>
                                    <div class="invalid-feedback">Por favor, ingresa el medicamento recetado.</div>
                                </div>
                                <div class="form-group">
                                    <label for="intruccionUsoR">Instrucciones de Uso *</label>
                                    <textarea class="form-control" id="intruccionUsoR" rows="8"
                                        placeholder="intruccionUsoR" name="intruccionUsoR" required
                                        style="resize: none"></textarea>
                                    <div class="invalid-feedback">Por favor, ingresa las instrucciones de uso.</div>
                                </div>
                                <button type="submit" id="crearReceta" class="btn btn-custom">Crear Receta</button>

                            </form>

                        </div>
                        

                        <!-- Tab 2: Expedientes de Paciente -->
                        <div class="tab-pane fade" id="expedientes" role="tabpanel" aria-labelledby="expedientes-tab">
                            <div class="navbar">
                                <a href="./IndexDoctores.php">
                                    <i class="fa-solid fa-arrow-left fa-lg"></i>
                                </a>
                                <h2>Expedientes de Paciente</h2>
                            </div>

                            <div class="modal fade" id="pacienteNoEncontradoModal" tabindex="-1" role="dialog" aria-labelledby="pacienteNoEncontradoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pacienteNoEncontradoModalLabel">Paciente no encontrado</h5>
            </div>
            <div class="modal-body">
                <p>No se encontró un paciente con el nombre proporcionado.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



                            <div class="row">
                                <!-- Fila 1: Barra de búsqueda -->
                                <form class="needs-validation" novalidate id="searchForm">
                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                        <div class="row align-items-center">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control"
                                                    placeholder="Buscar paciente por nombre" id="nombrePaciente"
                                                    required>
                                                <div class="invalid-feedback">Por favor, ingresa el nombre del paciente.
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-custom">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>



                                <!-- Fila 2: Datos del paciente y nota -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- Columna 1: Datos del paciente -->

                                        <div class="col-md-6">

                                            <h3>Datos del Paciente</h3>
                                            <hr />
                                            <p>
                                                <i class="fa-solid fa-user fa-lg"></i>
                                                Nombre del Paciente: <span id="nombreAut">. . .</span>
                                            </p>
                                            <p>
                                                <i class="fa-regular fa-calendar-plus fa-lg"></i>
                                                Edad: <span id="edadAut">. . .</span>
                                            </p>
                                            <p>
                                                <i class="fa-solid fa-droplet fa-lg" style="color: #ff0000;"></i>
                                                Tipo de Sangre: <span id="tipoSangreAut">. . .</span>
                                            </p>
                                            <p>
                                                <i class="fa-solid fa-virus"></i>
                                                Alergias: <span id="alergiasAut">. . .</span>
                                            </p>

                                            <h3>Recetas Médicas</h3>
                                            <hr />
                                            <!-- Tabla de recetas médicas (se generará con datos de la base de datos) -->

                                            <div id="informacionAdicional">

                                                <table class="table table-striped table-hover"
                                                    id="tablaInformacionAdicional">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha de la receta medica</th>
                                                            <th>Diagnóstico:</th>
                                                            <th>Medicamento</th>
                                                            <th>Instruccion de uso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="cuerpoTablaInformacionAdicional">
                                                        <!-- Los resultados de las recetas se agregarán aquí dinámicamente -->
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <h3>Expediente Medico</h3>
                                            <div id="areaTextoReceta" class="table-responsive"></div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>





            
                        <div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="citas-tab">
                            <div class="navbar">
                                <a href="./IndexDoctores.php">
                                    <i class="fa-solid fa-arrow-left fa-lg"></i>
                                </a>
                                <h2>Crear Cita Medica</h2>
                            </div>
                            <br>
                            <div class="alerta">          
                                <div class="col-12">
                                    <div class="row my-2">
                                        <div class="col-12 my-2">
                                          
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <br>



                            <form class="row g-3 needs-validation" novalidate id="crearCitaForm" method="POST">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fechaCita" class="form-label">Fecha de la Cita *</label>
                                                <input type="date" class="form-control" id="fechaCita" name="fechaCita"
                                                    required>
                                                <div class="invalid-feedback">Campo obligatorio *</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="horaCita" class="form-label">Hora de la Cita *</label>
                                                <select class="form-select" id="horaCita" name="horaCita" required>
                                                    <!-- Las opciones de horas disponibles se cargarán dinámicamente aquí -->
                                                </select>
                                                <div class="invalid-feedback">Campo obligatorio *</div>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="nombrePacienteCita" class="form-label">Nombre completo del paciente
                                                        *</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="nombrePacienteCita"
                                                        name="nombrePacienteCita" placeholder="Nombre completo del paciente *" required>
                                                    <div class="invalid-feedback">Campo obligatorio *</div>
                                                </div>
                                                <!--
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        id="apellidoPacientePaternoCita"
                                                        name="apellidoPacientePaternoCita"
                                                        placeholder="Apellido Paterno" required>
                                                    <div class="invalid-feedback">Campo obligatorio *</div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        id="apellidoPacienteMaternoCita"
                                                        name="apellidoPacienteMaternoCita"
                                                        placeholder="Apellido Materno" required>
                                                    <div class="invalid-feedback">Campo obligatorio *</div>
                                                </div>
                                            </div>
                                               -->
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="especialidadCita" class="form-label">Especialidad
                                                            *</label>
                                                        <select class="form-select" id="especialidadCita"
                                                            name="especialidadCita"
                                                            aria-label="Especialidad select menu" required>
                                                            <!-- Las opciones de especialidades se cargarán dinámicamente aquí -->
                                                        </select>
                                                        <div class="invalid-feedback">Campo obligatorio *</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="doctorCita" class="form-label">Doctor *</label>
                                                        <select class="form-select" id="doctorCita" name="doctorCita"
                                                            aria-label="Doctor select menu" required>
                                                            <!-- Las opciones de doctores se cargarán dinámicamente aquí -->
                                                        </select>
                                                        <div class="invalid-feedback">Campo obligatorio *</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="notaMedica" class="form-label">Síntomas *</label>
                                                <textarea class="form-control" id="notaMedica" name="notaMedica"
                                                    rows="3" placeholder="Síntomas" required></textarea>
                                                <div class="invalid-feedback">Campo obligatorio *</div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="form-group">
                                                    <label for="motivoCita" class="form-label">Diagnóstico *</label>
                                                    <textarea class="form-control" id="motivoCita" name="motivoCita"
                                                        rows="3" placeholder="Diagnóstico del paciente"
                                                        required></textarea>
                                                    <div class="invalid-feedback">Campo obligatorio *</div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="Descripcion" class="form-label">Motivo de cita *</label>
                                                    <textarea class="form-control" id="Descripcion" name="Descripcion"
                                                        rows="3" placeholder="Descripción" required></textarea>
                                                    <div class="invalid-feedback">Campo obligatorio *</div>
                                                </div>
                                            </div>

                                            <div style="margin-top: 50px;" class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firmaDoctor" class="form-label">Firma del
                                                            Doctor:</label>
                                                        <div style="border-bottom: 2px solid #5f5f5f; width: 60%; margin-top: 30px;"
                                                            class="signature-line"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firmaDoctor" class="form-label">Nombre del
                                                            Doctor:</label>
                                                        <div style="border-bottom: 2px solid #5f5f5f; width: 60%; margin-top: 30px;"
                                                            class="signature-line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button id="btnGenerarCita" type="submit"
                                                        class="btn btn-custom">Generar Cita</button>
                                                </div>
                                            </div>
                                        </div>
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
    <div class="container-fluid-lg py-5">
        <footer class="bg-dark text-white text-center py-5 mt-5">
            <div class="row">
                <p>&copy; 2023 Medicatec</p>
            </div>
        </footer>
    </div>



    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/BusquedaPaciente.js"></script> <!--ESTE JS SIRVE PARA BUSCAR AL PACIENTE EN EL EXPEDIENTE EN EL APARTADP DE INFORMACION-->
    <script src="../js/receta.js"></script>  <!-- ESTE JS SIRVE PARA CREAR LA RECETA Y AGREGAR AL EXPEDIENTE -->
    <script src="../js/Crear_Receta.js"></script> <!-- ESTE JS SIRVE PARA CREAR CITAS EN EL DOCTOR -->
    <script src="../js/BusquedaCitas"></script> <!--ESTE JS SIRVE PARA BUSCAR LAS CITAS DEL PACIENTE PARA CREAR LA RECETA EN EL APARTADO DE CITAS-->
    <script src="../js/BusquedaEspecialidad.js"></script>
    <script src="../js/FechaCalendario.js"></script>  <!--SCRIPT PARA QUE EL CALENDARIO NO SE ELIJA MENOR A FECHAS ANTERIORES Y MAYOR A 20 DIAS-->
<script src="../js/ValidacionesCampos.js"></script>



</body>

</html>