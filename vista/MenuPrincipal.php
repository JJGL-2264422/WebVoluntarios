<?php 
    session_start();
    $xpathNav = "";
    $xpathSess = ".";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Voluntarios S.A</title>
</head>
<body>
    <?php 
        if(isset($_SESSION['usuario_activo'])){
            include("../plantillas/navbar_actuser.php");
        }else{
            include("../plantillas/navbar_offuser.php");
        }
    ?>
    <div class="container text-center" style="margin-top:20px; margin-bottom:80px;">
        <div class="row ">
            <div class="col" style="margin-top:115px;">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="../imagen/manos-voluntariado.jpg" class="d-block w-100" alt="...">
                        </div>

                        <div class="carousel-item">
                        <img src="../imagen/remake.png" class="d-block w-100" alt="...">
                        </div>

                        <div class="carousel-item">
                        <img src="../imagen/images.png" class="d-block w-100" alt="...">
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>

            </div>
            <div class="col">
                <div>
                    <br><h1>Voluntariados S.A</h1><br>
                </div>
                <div>
                    En Voluntarios S.A, creemos que el poder del cambio está en las manos de cada uno de nosotros. Somos una plataforma dedicada a conectar a personas apasionadas con oportunidades de voluntariado que marcan la diferencia. Ya sea que busques contribuir con tu tiempo, habilidades o energía, aquí encontrarás una gran variedad de proyectos que se alinean con tus intereses y valores. <br><br>

                    El voluntariado es más que una acción desinteresada; es una oportunidad para aprender, crecer y compartir. En un mundo donde cada gesto cuenta, tu participación tiene el potencial de transformar comunidades, proteger el medio ambiente, apoyar causas humanitarias o mejorar la calidad de vida de los más vulnerables. Sabemos que cada persona tiene algo único que ofrecer, y es por eso que trabajamos para brindarte opciones accesibles y significativas, tanto a nivel local como internacional. <br><br>

                    No importa si tienes horas libres cada semana o solo algunos días al año, siempre hay una oportunidad de hacer algo positivo. Navega por nuestras categorías de voluntariado y descubre cómo puedes convertirte en parte del cambio. Desde programas de conservación, enseñanza, asistencia médica, hasta el apoyo en desastres naturales, cada proyecto tiene un impacto profundo. <br><br>

                    ¡Únete a nuestra comunidad de voluntarios hoy mismo! Juntos, podemos construir un futuro más solidario, equitativo y sostenible. <br><br>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="bg-secondary">
            <div class="container text-center" style="padding-top:30px;padding-bottom:20px">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 justify-content-center">
                    <div class="col"><h5>Desarrolladores</h5><hr>Cristian Martinez <br>Juan Jose Garcia <br>Christian Trujillo </div>
                    <div class="col"><h5>Contactanos</h5><hr>3188943014 <br>cristian.daniel.martinez@correounivalle.edu.co <br>° 2397362</div>
                    <div class="col"><h5>Ubicanos</h5><hr>Carrera 13 #5-25</div>                    
                </div>
            </div>  
        </div>
    </footer>
</body>
</html>