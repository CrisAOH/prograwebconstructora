<h1>
  <?php echo ($action == 'editRol') ? 'Modificar' : 'Nuevo' ?> rol al usuario
</h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_usuario']) ?>">
<div class="mb-3">

    <label class="form-label">Elige el rol: </label>
    <select name="data[id_rol]" class="form-control" required>
      <?php
      foreach ($datarol as $key => $rol):
        $selected = " ";
        if ($rol['id_rol'] == $data[0]['id_rol']):
          $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $rol['id_rol']; ?>" <?php echo $selected; ?>> <?php echo $rol['rol']; ?> </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="hidden" name="data[id_usuario]" value="<?php echo ($data[0]['id_usuario']) ?>">
    <?php if ($action == 'editUsuario'): ?>
      <input type="hidden" name="data[id_rol]"
        value="<?php echo isset($data_rol[0]['id_rol']) ? $data_rol[0]['id_rol'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>
