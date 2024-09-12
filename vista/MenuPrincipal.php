<?php 
    include("../navbar/dir_navbar.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php 
    incluir_navbar();
 ?>
    <div class="container text-center">
        <div class="row ">
            <div class="col">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="../imagen/voluntario3.png" class="d-block w-100" alt="...">
                        </div>

                        <div class="carousel-item">
                        <img src="../imagen/voluntarios.png" class="d-block w-100" alt="...">
                        </div>

                        <div class="carousel-item">
                        <img src="../imagen/voluntario2.png" class="d-block w-100" alt="...">
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
                <h1>ya no she</h1>
            </div>
        </div>
    </div>

    <footer>
        <div class="bg-secondary">
            <div class="container text-center ">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    <div class="col">Desarrolladores</div>
                    <div class="col">¿Quienes somos?</div>
                    <div class="col">Contactanos</div>
                    <div class="col">Ubicanos</div>
                    
                </div>
            </div>  
        </div>
    </footer>
</body>
</html>