<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    
  <hr class="bg-primary my-4 border-0">
   
    <div class="container-fluid">
      <header>
        <div class="row" id="linea_azul"> 
          <div class="col-8">

          </div>
          <div class="col-4">
            <nav id="nav_contacto">

            </nav>
          </div>
        </div>
        <div class="row" id="logo">
          <div class="col 2">

          </div>
          <div class="col-10">

          </div>
        </div>
        <div class="row" id="nav_superior">
           <nav>

           </nav>
        </div>
        <div class="row" id="banner">
          <div class="col">

          </div>
        </div>
      </header>



      <header>
      <div class="row">
        <div class="col">
          <img src="images/encabezado.jpeg" class="img-fluid" alt="Responsive image">
         </div>
       </div>
      </header>

      <nav>
       <div class="row">
         <div class="col">
          <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Constructora</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="proyectos.html">Proyectos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="maquinaria.html">Maquinaria</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Nosotros
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="quienes.html">Quienes somos</a></li>
                      <li><a class="dropdown-item" href="preguntas.html">Preguntas Frecuentes</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="mapa.html">Mapa</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="../admin/login.php?action=logout">Logout</a>
                 </li>
                  
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
          </div>
        </div>

        <?php
/**
 * Enrutador casos de uso
 */
require_once("controllers/caso.php");
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $caso->new($data);
            if ($cantidad) {
                $caso->flash('success', "Registro dado de alta con éxito");
                $data = $caso->get();
                include('views/caso/index.php');
            } else {
                $caso->flash('danger', "Algo salió mal.");
                include('views/caso/form.php');
            }
        } else {
            include('views/caso/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_departamento'];
            $cantidad = $caso->edit($id, $data);
            if ($cantidad) {
                $caso->flash('success', "Registro actualizado con éxito");
                $data = $caso->get();
                include('views/caso/index.php');
            } else {
                $caso->flash('warning', "Algo falló o no hubo cambios");
                $data = $caso->get();
                include('views/caso/index.php');
            }
        } else {
            $data = $caso->get($id);
            include('views/caso/form.php');
        }
        break;
    case 'delete':
        $cantidad = $caso->delete($id);
        if ($cantidad) {
            $caso->flash('success', "Registro eliminado con éxito");
            $data = $caso->get();
            include('views/caso/index.php');
        } else {
            $caso->flash('danger', "Algo fallo");
            $data = $caso->get();
            include('views/caso/index.php');
        }
        break;
    case 'get':
    default:
        $data = $caso->get($id);
        include("views/caso/index.php");
}
?>


<hr class="bg-primary my-4 border-0">
    
<br>
        <footer class="bg-dark text-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>Información de contacto</p>
        <ul>
          <li>Teléfono: 123-456-7890</li>
          <li>Email: info@example.com</li>
        </ul>
      </div>
      <div class="col-md-6">
        <p>Otros enlaces</p>
        <ul>
          <li><a href="#">Términos y condiciones</a></li>
          <li><a href="#">Política de privacidad</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>