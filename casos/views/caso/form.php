
<hr style="height: 2px; background-color: #555">

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1><strong>Caso de Éxito:</strong> <?php echo isset($data[0]['caso_exito']) ? $data[0]['caso_exito'] : ''; ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <p class="lead"><strong>Descripción:</strong> <?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <p class="lead"> <strong>Resumen:</strong> <?php echo isset($data[0]['resumen']) ? $data[0]['resumen'] : ''; ?></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <p><strong>Imagen:</strong> </p><img src="<?php echo (isset($data[0]['imagen']) ? "../admin/".$data[0]['imagen'] : ''); ?>" class="rounded mx-auto d-block" alt="Imagen no encontrada">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <p class="lead"><strong>Activo:</strong> <?php echo isset($data[0]['activo']) && $data[0]['activo'] == 1 ? 'Sí' : 'No'; ?></p>
    </div>
</div>

  </div>
  <?php if ($action == 'edit'): ?>
  <form method="POST" action="caso.php?action=<?php echo $action; ?>">
    <input type="hidden" name="data[id_caso]" value="<?php echo isset($data[0]['id_caso']) ? $data[0]['id_caso'] : ''; ?>">
    <div class="row">
      <div class="col-md-12">
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary">Volver</a>
      </div>
    </div>
  </form>
  <?php endif; ?>
</div>
<hr style="height: 2px; background-color: #555">