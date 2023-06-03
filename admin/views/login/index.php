<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="../images/draw2.svg" class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method="POST" action="login.php?action=login">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form1Example13" name='correo' class="form-control form-control-lg" />
            <label class="form-label" for="form1Example13">Correo electrónico</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="form1Example23" name='contrasena' class="form-control form-control-lg" />
            <label class="form-label" for="form1Example23">Contraseña</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <a href="login.php?action=forgot">¿Olvidó la contraseña?</a>
          </div>

          <!-- Submit button -->
          <input type="submit" name="enviar" value="Ingresar" class="btn btn-primary btn-lg btn-block">
        </form>
      </div>
    </div>
  </div>
</section>