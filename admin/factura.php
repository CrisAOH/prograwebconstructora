<?php
require_once(__DIR__."/controllers/factura.php");
include_once('views/header.php');
include_once('views/menu.php');
$factura -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $factura->new($data);
            if ($cantidad) {
                $factura->flash('success', "Registro dado de alta con éxito");
                $data = $factura->get();
                include('views/departamento/index.php');
            } else {
                $factura->flash('danger', "Algo salió mal.");
                include('views/departamento/form.php');
            }
        } else {
            include('views/factura/form.php');
        }
        break;
}
include_once('views/footer.php');
?>