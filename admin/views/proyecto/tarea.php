<h1 class="text-center">Tareas del proyecto:
    <?php echo $data[0]['proyecto']; ?>
</h1>
<div class="container-fluid">
    <div class='row'>
        <div class="col-3">
            <p><a href="proyecto.php?action=newTask&id=<?php echo $data[0]['id_proyecto']; ?>" class="btn btn-success"
                    role="button">Ingresar una nueva tarea </a>
            </p>
        </div>
    </div>
</div>
<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col" class="col-md-2">id</th>
            <th scope="col-md-2" class="col-md-8">Tarea</th>
            <th scope="col-md-6" class="col-md-3">% Avance</th>
            <th scope="col-md-2" class="col-md-3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_tarea as $key => $tarea): ?>
            <tr>
                <td scope="row">
                    <?php echo $tarea['id_tarea']; ?>
                </td>
                <td scope="row">
                    <?php echo $tarea['tarea']; ?>
                </td>



                <td scope="row">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $tarea['avance']; ?>%;"
                            aria-valuenow="<?php echo $tarea['avance']; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tarea['avance']; ?>%</div>
                    </div>
                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary"
                            href="proyecto.php?action=editTask&id=<?php echo $data['0']['id_proyecto'] ?>&id_tarea=<?php echo $tarea['id_tarea']; ?>">Editar</a>
                        <a class="btn btn-danger"
                            href="proyecto.php?action=deleteTask&id=<?php echo $data['0']['id_proyecto'] ?>&id_tarea=<?php echo $tarea['id_tarea']; ?>">Eliminar</a>
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