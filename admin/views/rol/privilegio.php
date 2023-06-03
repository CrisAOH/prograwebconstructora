<h1 class="text-center">Privilegios del rol:
    <?php echo $data[0]['rol']; ?>
</h1>
<div class="container-fluid">
    <div class='row'>
        <div class="col-3">
            <p><a href="rol.php?action=newPrivilegio&id=<?php echo $data[0]['id_rol']; ?>" class="btn btn-success"
                    role="button">Añadir privilegio al rol </a>
            </p>
        </div>
    </div>
</div>
<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col" class="col-md-2">ID</th>
            <th scope="col-md-2" class="col-md-8">Privilegio</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_privilegio as $key => $privilegio): ?>
            <tr>
                <td scope="row">
                    <?php echo $privilegio['id_privilegio']; ?>
                </td>
                <td scope="row">
                    <?php echo $privilegio['privilegio']; ?>
                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-danger"
                            href="rol.php?action=deletePrivilegio&id=<?php echo $data['0']['id_rol'] ?>&id_privilegio=<?php echo $privilegio['id_privilegio']; ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col">Se encontraron
            <?php echo sizeof($data_privilegio); ?> registros.
        </th>
    </tr>
</table>