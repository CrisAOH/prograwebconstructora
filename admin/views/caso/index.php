<h1>Casos de Éxito</h1>
<a href="caso.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">ID</th>
      <th scope="col" class="col-md-8">Caso de éxito</th>
      <th scope="col" class="col-md-3">Descripción</th>
      <th scope="col" class="col-md-3">Resumen</th>
      <th scope="col" class="col-md-3">Imagen</th>
      <th scope="col" class="col-md-3">Activo</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $caso): ?>
      <tr>
        <th scope="row">
          <?php echo $caso['id_caso']; ?>
        </th>
        <td>
          <?php echo $caso['caso_exito']; ?>
        </td>
        <td>
          <?php echo $caso['descripcion']; ?>
        </td>
        <td>
          <?php echo $caso['resumen']; ?>
        </td>
        <td>
        <img style="width: 125px;" src="<?php echo($caso['imagen']); ?>">
        </td>
        <td>
          <?php echo $caso['activo']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="caso.php?action=edit&id=<?php echo $caso['id_caso'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="caso.php?action=delete&id=<?php echo $caso['id_caso'] ?>">Eliminar</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tr>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Se encontraron
      <?php echo sizeof($data); ?> registros.
    </th>
  </tr>
</table>
