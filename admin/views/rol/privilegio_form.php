<h1>
  <?php echo ($action == 'editTask') ? 'Modificar' : 'Nuevo' ?> privilegio al Rol
</h1>
<form method="POST" action="rol.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_rol']) ?>">
<div class="mb-3">

    <label class="form-label">Elige el privilegio: </label>
    <select name="data[id_privilegio]" class="form-control" required>
      <?php
      foreach ($dataprivilegio as $key => $privilegio):
        $selected = " ";
        if ($privilegio['id_privilegio'] == $data[0]['id_privilegio']):
          $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $privilegio['id_privilegio']; ?>" <?php echo $selected; ?>> <?php echo $privilegio['privilegio']; ?> </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <input type="hidden" name="data[id_rol]" value="<?php echo ($data[0]['id_rol']) ?>">
    <?php if ($action == 'editPrivilegio'): ?>
      <input type="hidden" name="data[id_privilegio]"
        value="<?php echo isset($data_privilegio[0]['id_privilegio']) ? $data_privilegio[0]['id_privilegio'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>
