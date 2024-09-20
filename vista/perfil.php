<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>NOMBRE DEL USUARIO</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-between">
        <div class="nav navbar-nav">
          <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="#">Actividades</a>
        </div>
        <div class="nav navbar-nav">
          <a class="nav-item nav-link" href="#">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container" style="margin-top:2%">
        <div class="main">
            <div class="row">

                <!--Card de la imagen y nombre de usuario-->
                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar">
                        <div class="col-12 card bg-faded mt-2" style="overflow:hidden;">
                            <div style="height:125px; background-color:#5c5b5b"></div>
                            <a class="bg-faded p-1 rounded-circle ml-3" style="margin-top: -70px">
                                <img src="https://imgur.com/hBcLTUo.png" class="rounded-circle" style="border: 7px solid #303030; background-color:#303030" width="150">
                            </a>
                            <div class="mt-3">
                                <h3>$username</h3>
                                <p><span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span></p>
                                <p>$valoración</p>
                                <!--Espacio para más datos-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="m-3 pt-3">Datos personales</h1>
                            <a href="#" class="btn btn-primary m-3">Cambiar usuario y contraseña</a>
                        </div>
                        <!--Filas de info-->
                        <div class="card-body"> <!--Un row por cada campo de información-->
                            <div class="row"> 
                                <div class="col-md-3">
                                    <h5>Nombre completo</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    $nombre $apellido
                                </div>
                            </div><hr>
                            <div class="row"> 
                                <div class="col-md-3">
                                    <h5>Correo Electronico</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    $correo
                                </div>
                            </div><hr>
                        </div>
                    </div>

                    <div class="card mb-3 content">
                        <h1 class="m-3 pt-3">Registros</h1>
                        <!--Filas de info-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>-Proximamente-</h5>
                                </div>
                                <div class="col-md-9 text-light">
                                    -
                                </div>
                            </div><hr>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>
</html>