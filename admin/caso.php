<?php
/**
 * Enrutador casos de uso
 */
require_once(__DIR__."/controllers/caso.php");
include_once('views/header.php');
include_once('views/menu.php');
$caso -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $caso->new($data);
            if ($cantidad) {
                $caso->flash('success', "Registro dado de alta con éxito");
                $data = $caso->get();
                include('views/caso/index.php');
            } else {
                $caso->flash('danger', "Algo salió mal.");
                include('views/caso/form.php');
            }
        } else {
            include('views/caso/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_caso'];
            $cantidad = $caso->edit($id, $data);
            if ($cantidad) {
                $caso->flash('success', "Registro actualizado con éxito");
                $data = $caso->get();
                include('views/caso/index.php');
            } else {
                $caso->flash('warning', "Algo falló o no hubo cambios");
                $data = $caso->get();
                include('views/caso/index.php');
            }
        } else {
            $data = $caso->get($id);
            include('views/caso/form.php');
        }
        break;
    case 'delete':
        $cantidad = $caso->delete($id);
        if ($cantidad) {
            $caso->flash('success', "Registro eliminado con éxito");
            $data = $caso->get();
            include('views/caso/index.php');
        } else {
            $caso->flash('danger', "Algo fallo");
            $data = $caso->get();
            include('views/caso/index.php');
        }
        break;
    case 'get':
    default:
        $data = $caso->get($id);
        include("views/caso/index.php");
}
include_once('views/footer.php');
?>