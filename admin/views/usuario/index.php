<h1>Usuarios</h1>
<a href="usuario.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-4">ID</th>
      <th scope="col" class="col-md-4">Usuario</th>
      <th scope="col" class="col-md-4">Correo</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $usuario): ?>
      <tr>
        <th scope="row">
          <?php echo $usuario['id_usuario']; ?>
        </th>
        <td>
          <?php echo $usuario['usuario']; ?>
        </td>
        <td>
          <?php echo $usuario['correo']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-dark" href="usuario.php?action=rol&id=<?php echo $usuario['id_usuario'] ?>">Roles</a>
            <a class="btn btn-primary"
              href="usuario.php?action=edit&id=<?php echo $usuario['id_usuario'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="usuario.php?action=delete&id=<?php echo $usuario['id_usuario'] ?>">Eliminar</a>
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