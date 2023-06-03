<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Empleado
</h1>
<form method="POST" action="empleado.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre del Empleado</label>
    <input type="text" name="data[nombre]" class="form-control" placeholder="Nombre"
      value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" required minlength="3"
      maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">Primer apellido</label>
    <input type="text" name="data[primer_apellido]" class="form-control" placeholder="Primer apellido"
      value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>" required
      minlength="3" maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">Segundo apellido</label>
    <input type="text" name="data[segundo_apellido]" class="form-control" placeholder="Segundo apellido"
      value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>" required
      minlength="3" maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha nacimiento</label>
    <input type="date" name="data[fecha_nacimiento]" class="form-control" placeholder="dd/mm/aaaa"
      value="<?php echo isset($data[0]['fecha_nacimiento']) ? $data[0]['fecha_nacimiento'] : ''; ?>" required
      minlength="3" maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">RFC</label>
    <input type="text" name="data[rfc]" class="form-control" placeholder="ABCD123456EF7"
      value="<?php echo isset($data[0]['rfc']) ? $data[0]['rfc'] : ''; ?>" required minlength="3" maxlength="13" />
  </div>
  <div class="mb-3">
    <label class="form-label">Curp</label>
    <input type="text" name="data[curp]" class="form-control" placeholder="ABCD123456MDFEFG00"
      value="<?php echo isset($data[0]['curp']) ? $data[0]['curp'] : ''; ?>" required minlength="3" maxlength="18" />
  </div>
  <div class="mb-3">
    <div class="row">
      <label> Fotografía </label>
      <div class="col-lg-6" align="center">
        <label>Tomar Fotografía</label>
        <div id="my_camera" class="pre_capture_frame"></div>
        <input type="hidden" name="foto" id="foto">
        <br>
        <input type="button" class="btn btn-info btn-round btn-file" value="Take Snapshot" onClick="take_snapshot()">
      </div>
      <div class="col-lg-6" align="center">
        <label>Vista previa</label>
        <div id="results">
          <img style="width: 350px;" class="after_capture_frame" src="../images/invitado.jpg" />
        </div>
      </div>
    </div><!--  end row -->
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
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_empleado]"
        value="<?php echo isset($data[0]['id_empleado']) ? $data[0]['id_empleado'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" onclick="saveSnap()" />
  </div>
</form>

<script language="JavaScript">
  // Configure a few settings and attach camera 250x187
  Webcam.set({
    width: 350,
    height: 287,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');

  function take_snapshot() {
    // play sound effect
    //shutter.play();
    // take snapshot and get image data
    Webcam.snap(function (data_uri) {
      // display results in page
      document.getElementById('results').innerHTML =
        '<img class="after_capture_frame" src="' + data_uri + '"/>';
      $("#foto").val(data_uri);
    });
  }

  function saveSnap() {
    var base64data = $("#foto").val();
    console.log("base64data:", base64data);
    $.ajax({
      type: "POST",
      url: "controllers/empleado.php",
      data: { foto: base64data },
      success: function (data) {
        console.log("respuesta del servidor:", data);
      }
    });
  }
</script>