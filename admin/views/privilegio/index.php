<h1>Privilegios</h1>
<a href="privilegio.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">ID</th>
      <th scope="col" class="col-md-8">Privilegio</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $privilegio): ?>
      <tr>
        <th scope="row">
          <?php echo $privilegio['id_privilegio']; ?>
        </th>
        <td>
          <?php echo $privilegio['privilegio']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="privilegio.php?action=edit&id=<?php echo $privilegio['id_privilegio'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="privilegio.php?action=delete&id=<?php echo $privilegio['id_privilegio'] ?>">Eliminar</a>
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