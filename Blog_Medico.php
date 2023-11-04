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
  <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css"rel="stylesheet">
  <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css"rel="stylesheet">
  <!--ESTILOS CSS-->
  <link rel="shortcut icon" href="img/web.png" type="img">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/nav2.css">
  <link rel="stylesheet" type="text/css" href="css/Blog.css">
</head>

<body>
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
                  <span style="padding: 0.5rem;"><img src="./img/cora2.png" alt="Descripción de la imagen"></span>
                </div>
                <div class="hamburger">
                  <div class="line1"></div>
                  <div class="line2"></div>
                  <div class="line3"></div>
                </div>
                <ul class="nav-links">
                  <li><a href="Blog_Medico.html">Inicio</a></li>
                  <?php 
                  // Recupera el valor de rol de la URL
                  $rol = isset($_GET['rol']) ? $_GET['rol'] : '';
                  // Incluye barraNavegacion.php antes de llamar a la función generarMenu
                  include('php/barraNavegacion.php');
                  
                  // Llama a la función generarMenu con el rol del usuario
                  generarMenu($rol);
                  ?>
                  
                  <li><a class="login-button" type="button" style="color: white;" href="login.html">Login</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12">
        <div class="container">
          <header class="showcase">
            <h1 class="estilo-independiente">La Transformacion a llegado</h1>
            <a href="../pacientes/creaCitasP.html" class="">
              Pide una cita <i class="fas fa-chevron-right"></i>
            </a>

          </header>
          <section class="home-cards">
            <div>
              <img
                src="https://assets.mayoclinic.org/content/dam/media/global/images/2023/06/26/healing-starts-here-unmasked-21-7949-600x800.jpg"
                alt="">
              <h3>La recuperación empieza aquí</h3>
              <p>
                Las respuestas correctas, desde el principio

                La eficacia del tratamiento depende del diagnóstico
                correcto. Nuestros expertos diagnostican y tratan
                los problemas médicos más complicados.
              </p>
              <a href="#">leer mas <i class="fas fa-chevron-right"></i></a>
            </div>
            <div>
              <img
                src="https://assets.mayoclinic.org/content/dam/media/global/images/2023/05/30/photo_people_man-standing-turban-rocks-sea_600x800.png"
                alt="" />
              <h3>Atención médica de primera categoría para pacientes de todo el mundo</h3>
              <p>
                Hacemos que sea fácil recibir
                atención médica en Clinica Tachirito para los pacientes.

              </p>
              <a href="#">Leer mas <i class="fas fa-chevron-right"></i></a>
            </div>
            <div>
              <img
                src="https://assets.mayoclinic.org/content/dam/media/global/images/2023/06/26/providing-peace-26-10320-600x800.jpg"
                alt="" />
              <h3>Brindar esperanza y tranquilidad</h3>
              <p>
                Obtener el diagnóstico correcto desde el principio
                significa que comenzarás con el plan más eficaz de
                tratamiento.
              </p>
              <a href="#">leer mas<i class="fas fa-chevron-right"></i></a>
            </div>
            <div>
              <img
                src="https://assets.mayoclinic.org/content/dam/media/global/images/2023/06/12/innovation-impact-1200x1600.jpg"
                alt="" />
              <h3>El punto es elaborar un plan que funcione para ti</h3>
              <p>
                El punto es elaborar un plan que funcione para ti
                Un equipo de especialistas evaluará exhaustiva y atentamente tu
                afección para elaborar contigo un plan personalizado que cumpla
                con tus objetivos.
              </p>
              <a href="#">leer mas <i class="fas fa-chevron-right"></i></a>
            </div>
          </section>



          <!-- Xbox -->
          <section class="xbox">
            <div class="content">
              <h3>¿Por qué elegir Clinica Tachirio?</h3>
              <p>«Nunca he visto a profesionales de la salud comportarse como lo hacen los Clinica Tachirito.
                Sentí mucha gratitud al recibir tratamiento con tanto respeto y cuidado».
              </p>
              <a href="#">
                Saber más <i class="fas fa-chevron-right"></i>
              </a>
            </div>
          </section>


          <div class="container">
            <h2 class="subtitulo">Recuerda Prevenir</h2>
            <div class="row">
              <div class="col-md-3">
                <div class="card card-custom card-color-4 white-text">
                  <div class="custom-card-img-top custom-card-img-custom"
                    style="background-image: url('./img/Lentes.png');">
                    <h4 class="custom-title">Lentes</h4>
                  </div>
                  <div class="card-body">
                    <p class="custom-text">La mayoría de los defectos de la vista pueden ser corregidos con un par de
                      lentes.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-custom card-color-3 white-text">
                  <div class="custom-card-img-top custom-card-img-custom"
                    style="background-image: url('./img/Emabrazo.png');">
                    <h4 class="custom-title">Embarazo</h4>
                  </div>
                  <div class="card-body">
                    <p class="custom-text">De manera preventiva o de diagnóstico, una prueba de laboratorio ofrece
                      información valiosa.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-custom card-color-2 white-text">
                  <div class="custom-card-img-top custom-card-img-custom"
                    style="background-image: url('./img/Laboratorio.png');">
                    <h4 class="custom-title">Laboratorio</h4>
                  </div>
                  <div class="card-body">
                    <p class="custom-text">Los laboratorios médicos son cruciales para diagnosticar y cuidar tu salud.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-custom card-color-4 white-text">
                  <div class="custom-card-img-top custom-card-img-custom"
                    style="background-image: url('./img/Rayos X.png');">
                    <h4 class="custom-title">Rayos X</h4>
                  </div>
                  <div class="card-body">
                    <p class="custom-text">Aprecia tus órganos, huesos y otros tejidos a simple vista, con la mínima
                      dosis de radiación.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <br>
          <br>

          <div class="container">
  <div class="row justify-content-center">
    <h2 class="subtitulo">También puede interesarte</h5>
      <br>
      <br>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #053B50;">
        <i class="fa-solid fa-x-ray" style="color: #053B50;"></i>
        <a href="#">
          <p>Rayos X</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #0E4F64;">
        <i class="fa-solid fa-flask-vial" style="color: #0E4F64;"></i>
        <a href="#">
          <p>Laboratorio</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color:#176379;">
        <i class="fas fa-female" style="color: #176379;"></i>
        <a href="#">
          <p>Mastografía</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #20788D;">
        <i class="fas fa-utensils" style="color: #20788D;"></i>
        <a href="#">
          <p>Nutrición</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #299CA2;">
        <i class="fas fa-magnet" style="color: #299CA2;"></i>
        <a href="#">
          <p>Resonancia Magnética</p>
        </a>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-2">
      <div class="sd-item" style="border-color:#32B1B6;">
        <i class="fas fa-camera" style="color: #32B1B6;"></i>
        <a href="#">
          <p>Tomografía</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #3BC5CB;">
        <i class="fas fa-heartbeat" style="color: #3BC5CB;"></i>
        <a href="#">
          <p>Electrocardio- grama</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #44DAE0;">
        <i class="fas fa-stethoscope" style="color:#44DAE0"></i>
        <a href="#">
          <p>Ultrasonido</p>
        </a>
      </div>
    </div>
    <div class="col-md-2">
      <div class="sd-item" style="border-color: #71dde1;">
        <i class="fa-solid fa-bed-pulse" style="color:#71dde1"></i>
        <a href="#">
          <p>Densitometría</p>
        </a>
      </div>
    </div>
  </div>
</div>

          <br>
          <br>
        </div>
      </div>
      <!--Main o contenido-->

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
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/creaCitas.js"></script>
  <script src="js/calendario.js"></script>
</body>

</html>