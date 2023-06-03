<?php
/**
 * Enrutador departamento
 */
require_once(__DIR__."/controllers/privilegio.php");
include_once('views/header.php');
include_once('views/menu.php');
$privilegio -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $privilegio->new($data);
            if ($cantidad) {
                $privilegio->flash('success', "Registro dado de alta con éxito");
                $data = $privilegio->get();
                include('views/privilegio/index.php');
            } else {
                $privilegio->flash('danger', "Algo salió mal.");
                include('views/privilegio/form.php');
            }
        } else {
            include('views/privilegio/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_privilegio'];
            $cantidad = $privilegio->edit($id, $data);
            if ($cantidad) {
                $privilegio->flash('success', "Registro actualizado con éxito");
                $data = $privilegio->get();
                include('views/privilegio/index.php');
            } else {
                $privilegio->flash('warning', "Algo falló o no hubo cambios");
                $data = $privilegio->get();
                include('views/privilegio/index.php');
            }
        } else {
            $data = $privilegio->get($id);
            include('views/privilegio/form.php');
        }
        break;
    case 'delete':
        $cantidad = $privilegio->delete($id);
        if ($cantidad) {
            $privilegio->flash('success', "Registro eliminado con éxito");
            $data = $privilegio->get();
            include('views/privilegio/index.php');
        } else {
            $privilegio->flash('danger', "Algo fallo");
            $data = $privilegio->get();
            include('views/privilegio/index.php');
        }
        break;
    case 'get':
    default:
        $data = $privilegio->get($id);
        include("views/privilegio/index.php");
}
include_once('views/footer.php');
?>