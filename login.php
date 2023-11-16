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
    <link rel="shortcut icon" href="img/web.png" type="img">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="css/nav2.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <!--Header-->
                <div class="container-fluid-lg ">
                    <div class="row">
                        <div class="col-12">
                            <nav>
                                <div class="logo" style="display: flex;align-items: center;">
                                    <span
                                        style="color:#000000; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">MEDICATEC</span>
                                    <span style="padding: 0.5rem;"><img src="img/cora2.png"
                                            alt="Descripción de la imagen"></span>
                                </div>
                                <div class="hamburger">
                                    <div class="line1"></div>
                                    <div class="line2"></div>
                                    <div class="line3"></div>
                                </div>

                            </nav>
                        </div>
                    </div>
                </div>
                <!--Main o contenido-->
                <!--Main o contenido-->
            <div class="container-fluid formatoLogin mt-5 mb-2">
                <form class="form" action="" method="post">
                <?php
                    include "php/acceso.php";
                   
                    
                    include "php/controlador.php";
                ?>
                    <div class="row">
                        <div class="col-12" style="padding: 2rem;">
                            <h2><i class="fa-solid fa-lock"></i> Login</h2>
                        </div>
                        <div class="col-12">
                            <input type="text" name="nombree" placeholder="Nombre Completo *" required />
                        </div>
                        <div class="col-12">
                            <input type="password" name="clave" placeholder="Contraseña *" required />
                        </div>
                        <!--<div class="d-grid gap-2 col-6 mx-auto" style="padding: 1rem;">
                            <button type="submit" name="btningresar" type="button"><i class="fa-solid fa-right-to-bracket" style="color: #ffffff;"></i> Inicia sesión</button>
                        </div>-->
                        
                        <div class="d-grid">
            
            <input type="submit" value="Iniciar Sesión" name="btningresar" class="btn btn-outline-warning fs-5 fw-bold">
          </div>
                        <div>
                            <p class="">¿No estas registrado? <a style="color: #176B87;" href="pacientes/registroP.php">Crea una cuenta</a></p>
                        </div>
                    </div>
                </form>
            </div>
                <!--footer-->
                <div class="container-fluid-lg ">
                    <footer class="bg-dark text-center py-5 mt-5">
                        <div class="row">
                            <p style="color: white;">&copy; 2023 Medicatec</p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <!-- Agregamos los scripts de Bootstrap y jQuery al final del body para una mejor carga -->
        <script src="bootstrap/js/bootstrap.esm.min.js"></script>
        <script src="js/creaCitas.js"></script>
        <script src="js/main.js"></script>
</body>

</html>