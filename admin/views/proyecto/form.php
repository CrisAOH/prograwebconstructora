<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Proyecto
</h1>
<form method="POST" action="proyecto.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre del Proyecto</label>
    <input type="text" name="data[proyecto]" class="form-control" placeholder="Proyecto"
      value="<?php echo isset($data[0]['proyecto']) ? $data[0]['proyecto'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <input type="text" name="data[descripcion]" class="form-control" placeholder="Descripción"
      value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha Inicial</label>
    <input type="date" name="data[fecha_inicio]" class="form-control"
      value="<?php echo isset($data[0]['fecha_inicio']) ? $data[0]['fecha_inicio'] : ''; ?>" requiered />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha Final</label>
    <input type="date" name="data[fecha_fin]" class="form-control"
      value="<?php echo isset($data[0]['fecha_fin']) ? $data[0]['fecha_fin'] : ''; ?>" required />
  </div>
  <div class="mb-3">
    <label class="form-label">Departamento</label>
    <select name="data[id_departamento]" class="form-control" required>
      <?php
      foreach ($datadepartamentos as $key => $depto):
        $selected = " ";
        if ($depto['id_departamento'] == $data[0]['id_departamento']):
          $selected = " selected";
        endif;
        ?>
        <option value="<?php echo $depto['id_departamento']; ?>" <?php echo $selected; ?>> <?php echo $depto['departamento']; ?> </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Archivo adjunto</label>
    <input type="file" name="archivo" class="form-control" />
  </div>
  <div class="mb-3">
    <div class="mb-3">
      <?php if ($action == 'edit'): ?>
        <div class="alert alert-info" role="alert">
          <a href="<?php echo $data[0]['archivo']; ?>" target="_blank"> Descargar el adjunto actual</a>
        </div>
      <?php endif; ?>
      <input type="hidden" name="data[id_proyecto]"
        value="<?php echo isset($data[0]['id_proyecto']) ? $data[0]['id_proyecto'] : ''; ?>">
      <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>