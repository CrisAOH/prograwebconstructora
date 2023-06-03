<div class="container">
  <h1>Casos de éxito</h1>
  <hr style="height: 2px; background-color: #555">
  <div class="row">
    <?php foreach ($data as $key => $caso): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?php echo ("../admin/" . $caso['imagen']); ?>" class="card-img-top"
            alt="<?php echo $caso['caso_exito']; ?>">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $caso['caso_exito']; ?>
            </h5>
            <p class="card-text">
              <?php echo $caso['resumen']; ?>
            </p>
            <div class="d-grid gap-2">
              <a class="btn btn-primary" href="index.php?action=edit&id=<?php echo $caso['id_caso'] ?>">Ver más</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
</div>
<hr style="height: 2px; background-color: #555">
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.43.53:81/constru/ws/caso.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=ceir4qtuqo6rd0ed40l2k7ri1v'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$response =json_decode($response);
?>

<div class="container">
  <h1>Casos de éxito de Argentina</h1>
  <hr style="height: 2px; background-color: #555"> 
  <div class="row">
    <?php foreach ($response as $key => $caso): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="http://192.168.43.53:81/constru/images/<?php  echo $caso->imagen; ?>" class="card-img-top" alt="<?php echo $caso -> caso_exito; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $caso->caso_exito; ?></h5>
            <p class="card-text"><?php echo $caso->resumen; ?></p>
            <div class="d-grid gap-2">
              <a class="btn btn-primary"
                href="index.php?action=edit&id=<?php echo $caso->id_caso ?>">Ver más</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<hr style="height: 2px; background-color: #555">
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.43.93/alumnos/prograweb1/constructora/ws/casos.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=huse8rsep2vikjv149idq0qbq7'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response =json_decode($response);
?>

<div class="container">
  <h1>Casos de éxito de Brasil</h1>
  <hr style="height: 2px; background-color: #555"> 
  <div class="row">
    <?php foreach ($response as $key => $caso): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="http://192.168.168.93/alumnos/prograweb1/constructora/admin/<?php  echo $caso->imagen; ?>" class="card-img-top" alt="<?php echo $caso -> caso_exito; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $caso->caso_exito; ?></h5>
            <p class="card-text"><?php echo $caso->resumen; ?></p>
            <div class="d-grid gap-2">
              <a class="btn btn-primary"
                href="index.php?action=edit&id=<?php echo $caso->id_caso ?>">Ver más</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<hr style="height: 2px; background-color: #555">
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8087/test.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
print_r($response);
?>