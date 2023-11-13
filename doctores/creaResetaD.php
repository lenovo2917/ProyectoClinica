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
    <link rel="stylesheet" type="text/css" href="../css/nav2.css">
    <link rel="stylesheet" type="text/css" href="../css/Diseño_Crear_Receta.css">

<body>
    <!--Barra de navegacion-->
    <div class="container-fluid-lg">
        <div class="row">
            <header>
                <div class="container-fluid-lg">
                    <div class="row">
                        <div class="col-12">
                            <nav style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="logo">
                                    <span
                                        style="color: #000000; font-size: 26px; font-weight: bold; letter-spacing: 1px; margin-left: 20px;">MEDICATEC</span>
                                    <span style="padding: 0.5rem;"><img src="../img/cora2.png"
                                            alt="Descripción de la imagen"></span>
                                </div>
                                <div class="doctor-info"
                                    style="display: flex; align-items: center; margin-right: 20px;">
                                    <span
                                        style="color: #000000; font-size: 16px; font-weight: bold; letter-spacing: 1px;">Nombre
                                        del Doctor</span>
                                    <span style="margin-right: 10px;">
                                        <i class="fas fa-user-md fa-2x"></i>
                                    </span>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

            </header>
            <main>
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
                            <p>Nombre: Dr. Nombre del Doctor</p>
                            <p>Especialidad: Especialidad del Doctor</p>
                            <!-- AQUI VA PHP PARA PONER LA INFORMACION DIRECTA DE LA BASE DE DATOS -->
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
                                    <p>Nombre del doctor: <span id="doctorNombre">Nombre del doctor</span></p>
                                    <p>Cedula profesional: <span id="cedulaProfesional">Cedula del doctor</span></p>
                                    <p>Dirección: <span id="direccion">Dirección del doctor</span></p>
                                    <hr class="my-4">
                                    <!-- Contenido de la receta en forma de tabla -->
                                    <table class="table" id="datosReceta">
                                        <tr>
                                            <td>Nombre:</td>
                                            <td>${nombre}</td>
                                        </tr>
                                        <tr>
                                            <td>Apellido Paterno:</td>
                                            <td>${apellidoP}</td>
                                        </tr>
                                        <tr>
                                            <td>Apellido Materno:</td>
                                            <td>${apellidoM}</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha:</td>
                                            <td>${fecha}</td>
                                        </tr>
                                        <tr>
                                            <td>Diagnóstico:</td>
                                            <td>${diagnostico}</td>
                                        </tr>
                                        <tr>
                                            <td>Medicamento:</td>
                                            <td>${medicamento}</td>
                                        </tr>
                                        <tr>
                                            <td>Instrucciones de Uso:</td>
                                            <td>${intruccionUsoR}</td>
                                        </tr>
                                    </table>
                                    <!-- Firma y nombre del doctor -->
                                    <div class="firma">
                                        <hr class="my-4">
                                        <p>Firma del doctor: __________________________</p>
                                        <p>Nombre del doctor: <span id="nombreFirma">Nombre del doctor</span></p>
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
                            <h2>Formulario para Crear Receta Médica</h2>
                            <form id="recetaForm" method="post">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Paciente</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoPaterno">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apellidoP" name="apellidoP"
                                        placeholder="ApellidoP" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoMaterno">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellidoM" name="apellidoM"
                                        placeholder="ApellidoM" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha de la Receta</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                            <ul class="dropdown-menu" id="citasDropdown">

                                                <input type="hidden" id="idCita" name="idCita" value="">

                                            </ul>
                                        </div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="diagnostico">Diagnóstico</label>
                                    <textarea class="form-control" id="diagnostico" rows="3"
                                        placeholder="Ingrese el diagnóstico" name="diagnostico" required
                                        style="resize: none"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="medicamento">Medicamento Recetado</label>
                                    <input type="text" class="form-control" id="medicamento" name="medicamento"
                                        placeholder="Nombre del medicamento" required>
                                </div>
                                <div class="form-group">
                                    <label for="intruccionUsoR">Instrucciones de Uso</label>
                                    <textarea class="form-control" id="intruccionUsoR" rows="8"
                                        placeholder="intruccionUsoR" name="intruccionUsoR" required
                                        style="resize: none"></textarea>
                                </div>
                                <button type="button" id="crearReceta" class="btn btn-primary"
                                    data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Crear Receta</button>
                            </form>
                        </div>

                        <!-- Tab 2: Expedientes de Paciente -->
                        <div class="tab-pane fade" id="expedientes" role="tabpanel" aria-labelledby="expedientes-tab">
                            <h2>Expedientes de Paciente</h2>
                            <div class="row">
                                <!-- Fila 1: Barra de búsqueda -->

                                <div class="col-md-12" style="margin-bottom: 20px;">
                                    <div class="row align-items-center">
                                        <div class="col-md-11">
                                            <input type="text" class="form-control"
                                                placeholder="Buscar paciente por nombre" id="nombrePaciente">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-custom" type="submit" name="buscar">Buscar</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila 2: Datos del paciente y nota -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- Columna 1: Datos del paciente -->
                                        <!--ESTO TENDRA PHP Y SCRIPT PARA QUE SE LLENE AUTOMATICAMENTE SEGUN LA BASE DE DATOS-->
                                        <div class="col-md-6">
                                            <h3>Datos del Paciente</h3>
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
                                            <!-- Tabla de recetas médicas (se generará con datos de la base de datos) -->
                                            <!-- Agrega un nuevo contenedor para mostrar la información -->
                                            <div id="informacionAdicional">
                                                <h2>Información Adicional</h2>
                                                <table class="table table-striped table-hover"
                                                    id="tablaInformacionAdicional">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha de la receta medica</th>
                                                            <th>Diagnóstico:</th>
                                                            <th>Notas Médicas</th>
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
                                            <h3>Nota Médica</h3>
                                            <!-- Aquí se muestra la nota del paciente (se recupera de la base de datos) -->
                                            <textarea id="notaCompleta" class="form-control"
                                                rows="10">Contenido de la nota médica</textarea>


                                            <!-- Subtítulo para Diagnóstico y Temporalidad -->
                                            <div class="row align-items-center">
                                                <div class="col-md-11">
                                                    <h4 class="d-inline">Diagnosticos:</h4>
                                                </div>

                                                <!-- Columna 2: Botón (+) para agregar diagnósticos -->
                                                <div class="col-md-1 text-right">
                                                    <button onclick="guardarCambios()"
                                                        style="border: none; background: none; cursor: pointer;">
                                                        <i class="fa-solid fa-folder-plus fa-xl"
                                                            style="color: #004bcc;"></i>
                                                    </button>
                                              
                                                
                                                

                                                </div>
                                            </div>

                                            <!-- Diagnóstico y Temporalidad en la misma fila -->
                                            <div class="row align-items-center">
                                                <!-- Columna 1: Diagnóstico -->
                                                <div class="col-md-5">
                                                    <label for="diagnostico">Diagnóstico:</label>
                                                    <input type="text" class="form-control" id="diagnostico">
                                                </div>

                                                <!-- Columna 2: Temporalidad -->
                                                <div class="col-md-5">
                                                    <label for="Medicamento">Medicamento</label>
                                                    <input type="text" class="form-control" id="Medicamento">
                                                </div>

                                                <!-- Columna 3: Botón (✓) -->
                                                <div class="col-md-1 d-flex align-items-center">
                                                    <button style="border: none; background: none; cursor: pointer;">
                                                        <i class="fa-solid fa-circle-check fa-xl"
                                                            style="color: #00b415;"></i>
                                                    </button>
                                                </div>

                                                <!-- Columna 4: Botón (x) -->
                                                <div class="col-md-1 d-flex align-items-center">
                                                    <button style="border: none; background: none; cursor: pointer;">
                                                        <i class="fa-solid fa-circle-xmark fa-xl"
                                                            style="color: #d10000;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <label for="notaConsulta">Nota de la Consulta:</label>
                                            <textarea class="form-control" rows="4"></textarea>

                                            <!-- Botones de Guardar y Cancelar -->
                                            <button class="btn btn-custom">Guardar</button>
                                            <button class="btn btn-custom"
                                                style="background-color: gray;color: white; border-color: gray;">Cancelar</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Programar Citas Médicas -->
                        <div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="citas-tab">
                            <h2>Crear Cita Especialidad</h2>
                            <div class="row">
                                <!-- Fila 1: Datos del paciente y nota -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- Columna 1: Datos del paciente -->
                                        <!--ESTO TENDRA PHP Y SCRIPT PARA QUE SE LLENE AUTOMATICAMENTE SEGUN LA BASE DE DATOS-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fechaCita">Fecha de la Cita</label>
                                                <input type="date" class="form-control" id="fechaCita" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="horaCita">Hora de la Cita</label>
                                                <input type="time" class="form-control" id="horaCita" required>
                                            </div>
                                        </div>

                                        <div class="col-md-9">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="nombrePacienteCita">Paciente:</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="nombrePacienteCita"
                                                        placeholder="Nombre" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        id="apellidoPacientePaternoCita" placeholder="Apellido Paterno"
                                                        required>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        id="apellidoPacienteMaternoCita" placeholder="Apellido Materno"
                                                        required>
                                                </div>
                                            </div>

                                            <div style="margin-top: 10px;" class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button id="abrirEspecialidades" class="btn btn-custom"
                                                            type="button">Especialidad</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="especialidadCita"
                                                            name="especialidadCita" readonly>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="cuadroEspecialidades" class="cuadro-dialogo">
                                                <div class="opciones-especialidades">
                                                    <div class="opcion-especialidad" data-especialidad="Especialidad 1">
                                                        <img src="/Clinica_Tachirito/iconos/PACIENTE.png"
                                                            alt="Especialidad 1">
                                                        <p>Especialidad 1</p>
                                                    </div>
                                                    <div class="opcion-especialidad" data-especialidad="Especialidad 2">
                                                        <img src="/Clinica_Tachirito/iconos/PACIENTE.png"
                                                            alt="Especialidad 2">
                                                        <p>Especialidad 2</p>
                                                    </div>
                                                    <!-- Agrega más opciones de especialidades aquí -->
                                                </div>
                                            </div>

                                            <!-- Subtítulo para Diagnóstico y Temporalidad -->
                                            <div class="row align-items-center">
                                                <div class="form-group">
                                                    <label for="motivoCita">Diagnostico: </label>
                                                    <textarea class="form-control" id="motivoCita" rows="3"
                                                        placeholder="Diagnotico del paciente" required></textarea>
                                                </div>

                                                <!-- Nota Médica del Doctor (md-6) -->
                                                <div class="form-group">
                                                    <label for="notaMedica">Sintomas:</label>
                                                    <textarea class="form-control" id="notaMedica" rows="3"
                                                        placeholder="Sintomas del paciente" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="notaMedica">Motivo de cita: </label>
                                                    <textarea class="form-control" id="notaMedica" rows="3"
                                                        placeholder="Motivo de cita" required></textarea>
                                                </div>
                                            </div>

                                            <div style="margin-top: 50px;" class="row align-items-center">
                                                <div class="col-md-6">
                                                    <!-- Espacio para la firma del Doctor -->
                                                    <div class="form-group">
                                                        <label for="firmaDoctor">Firma del Doctor:</label>
                                                        <div style="border-bottom: 2px solid #5f5f5f; width: 60%; margin-top: 30px;"
                                                            class="signature-line"></div>
                                                    </div>


                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firmaDoctor">Nombre del Doctor:</label>
                                                        <div style="border-bottom: 2px solid #5f5f5f; width: 60%; margin-top: 30px;"
                                                            class="signature-line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Botón para Generar Cita (md-12) -->
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-custom">Generar Cita</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!--footer-->
            <div class="container-fluid-lg py-5">
                <footer class="bg-dark text-white text-center py-5 mt-5">
                    <div class="row">
                        <p>&copy; 2023 Medicatec</p>
                    </div>
                </footer>
            </div>

        </div>
    </div>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.esm.min.js"></script>
    <script src="../js/receta.js"></script>
    <script src="../js/Crear_Receta.js"></script>
    <script src="../js/BusquedaPaciente.js"></script>
    <script src="../js/BusquedaCitas"></script>


</body>

</html>