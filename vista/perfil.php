<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>NOMBRE DEL USUARIO</title></head>
  <body>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#">Home</a>
            </div>
        </nav>
        
        <div class="my-md-5 mx-auto" style="max-width: 1100px;">
          <div class="row no-gutters" style="margin:5px;">

            <div class="col-lg-4" style="padding: 3px">
              <div class="card bg-faded tab-content">
                <div class="card border-0 bg-faded" style="height: 250px;
                background-image:url(https://imgur.com/hBcLTUo.png);
                background-size:contain;
                background-position:center;
                background-repeat:no-repeat;
                "></div>
                <div class="my-2 lead display-6 text-uppercase text-center" style="height: 272px;">
                  $username
                </div>
              </div>

            </div>

            <div class="col-lg-7 order-md-1 order-1" style="padding: 3px;">
              <div class="card bg-faded tab-content" style="height: 540px;">
                  <div class="card-body">
                    <h3 style="font-weight:bold;">Detalles personales</h3><hr>

                    <div class="row no gutters my-n2">

                      <div class="col-sm-6-my-1">
                      <span class="mr-2" style="font-weight: bold; color:steelblue;">Nombre completo: </span>
                      $nombre $apellido
                      </div>

                      <div class="col-sm-6-my-1">
                      <span class="mr-2" style="font-weight: bold; color:steelblue;">Correo electronico: </span>
                      $email
                      </div>

                      <div class="col-sm-6-my-1">
                      <span class="mr-2" style="font-weight: bold; color:steelblue;">Edad: </span>
                      $edad
                      </div>

                      <div class="col-sm-6-my-1">
                      <span class="mr-2" style="font-weight: bold; color:steelblue;">Trabaja para: </span>
                      $comp
                      </div>

                      <div class="col-sm-6-my-1">
                      <span class="mr-2" style="font-weight: bold; color:steelblue;">Valoración: </span>
                      $valor
                      </div>

                    </div><hr>
                    <div>W.I.P</div>
                  </div>
              </div>
            </div>

          </div>
        </div>

  </body>
</html>