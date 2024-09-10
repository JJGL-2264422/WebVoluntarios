<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Registrarse</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
    </head>
    <body>
        <p>&nbsp;&nbsp;</p>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Registrarse
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                            <div class="form-row">
                            <div class="col-md-7 mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Usuario123" required>
                            </div>
                            <div class="col-md-7 mb-3">
                            <label for="pass">Contraseña</label>
                            <input type="text" class="form-control" id="pass" placeholder="Contraseña%1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                            <div class="invalid-feedback">
                            La contraseña debe tener minimo una (1) mayuscula, un (1) número y un (1) simbolo.
                            </div>
                            </div>
                            <form class="needs-validation" novalidate>
                            <div class="form-row">
                            <div class="col-md-7 mb-3">
                            <label for="usrnom">Nombre</label>
                            <input type="text" class="form-control" id="usrnm" placeholder="Nombre" value="Adrian" required>
                            </div>
                            <div class="col-md-7 mb-3">
                            <label for="usrapd">Apellido</label>
                            <input type="text" class="form-control" id="usrapd" placeholder="Apellido" value="Perez" required>
                            </div>
                            <div class="col-md-7 mb-3">
                            <label for="email">Email</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="email" placeholder=" Email " 
                            aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                            Email no valido.
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="col-md-5 mb-3">
                            <label for="role">Tipo de Cuenta</label>
                            <select type="text" class="form-control" id="role" placeholder="-Seleccione el tipo-" required>
                                <option value="" selected disabled>-Seleccione el tipo-</option>
                                <option value="manager">Manager</option>
                                <option value="volunt">Voluntario</option>
                            </select>
                            <div class="invalid-feedback">
                            Seleccione el tipo de cuenta.
                            </div>
                            </div>
                            <div class="col-md-7 mb-3">
                            <label for="validationCustom06">State</label>
                            <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                            <div class="invalid-feedback">
                            Please provide a valid state.
                            </div>
                            </div>
                            <div class="col-md-7 mb-3">
                            <label for="validationCustom07">Zip</label>
                            <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                            <div class="invalid-feedback">
                            Please provide a valid zip.
                            </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                            Agree to <a href="#">terms and conditions</a>
                            </label>
                            <div class="invalid-feedback">
                            You must agree before submitting.
                            </div>
                            </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Registrarse</button>
                            </form>
                            <script>
                             // Example starter JavaScript for disabling form submissions if there are invalid fields
                              (function () {
                             'use strict'; 
                            window.addEventListener('load', function () {
                                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                  var forms = document.getElementsByClassName('needs-validation');
                                  // Loop over them and prevent submission
                                  var validation = Array.prototype.filter.call(forms, function (form) {
                                    form.addEventListener('submit', function (event) {
                                      if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                      }
                            form.classList.add('was-validated');
                               }, false);
                               });
                              }, false);
                             })();
                            </script>
                            
                            
                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </body>
</html>