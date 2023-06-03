<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Proyecto
</h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre del usuario: </label>
    <input type="text" name="data[usuario]" class="form-control" placeholder="Usuario"
      value="<?php echo isset($data[0]['usuario']) ? $data[0]['usuario'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Correo:</label>
    <input type="text" name="data[correo]" class="form-control" placeholder="Correo"
      value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña: </label>
    <input type="text" name="data[contrasena]" class="form-control" placeholder="Contrasena" />
  </div>
  <br>

  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <div class="form-check">
        <label class="form-check-label" for="activoCheckbox">
          Marque para cambiar la contraseña
        </label>
        <input type="hidden" name="data[cambiar]" value="0">
        <input class="form-check-input" type="checkbox" name="data[cambiar]" value="1" id="activoCheckbox">
      </div>
      <br>
      <input type="hidden" name="data[id_usuario]"
        value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>