<h1>
    <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Casos de Éxito
</h1>
<form method="POST" action="caso.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Caso de Éxito</label>
        <input type="text" name="data[caso_exito]" class="form-control" placeholder="Caso de Éxito"
            value="<?php echo isset($data[0]['caso_exito']) ? $data[0]['caso_exito'] : ''; ?>" required minlength="3"
            maxlength="200" />
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>

        <textarea name="data[descripcion]"
            id="mytextarea"><?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?></textarea>

    </div>
    <div class="mb-3">
        <label class="form-label">Resumen</label>
        <input type="text" name="data[resumen]" class="form-control" placeholder="Resumen"
            value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>" required minlength="3"
            maxlength="200" />
    </div>
    <div class="mb-3">
        <label class="form-label">Seleccione una imagen: </label>
        <input type="file" name="imagen" class="form-control" />
    </div>
    <div class="form-check">
        <label class="form-check-label" for="activoCheckbox">
            ¿Está activo?
        </label>
        <input type="hidden" name="data[activo]" value="0">
        <input class="form-check-input" type="checkbox" name="data[activo]" value="1" id="activoCheckbox">
    </div>
    <div class="mb-3">
        <?php if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_caso]"
                value="<?php echo isset($data[0]['id_caso']) ? $data[0]['id_caso'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>