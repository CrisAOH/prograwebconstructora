<?php
/**
 * Enrutador departamento
 */
require_once("controllers/rol.php");
require_once("controllers/privilegio.php");
include_once('views/header.php');
include_once('views/menu.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_privilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;
switch ($action) {
    case 'new':
        $dataprivilegio = $privilegio->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $rol->new($data);
            if ($cantidad) {
                $rol->flash('success', "Registro dado de alta con éxito");
                $data = $rol->get();
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', "Algo fallo");
                include('views/rol/form.php');
            }
        } else {
            include('views/rol/form.php');
        }
        break;
    case 'edit':
        $dataprivilegio = $privilegio->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_rol'];
            $cantidad = $rol->edit($id, $data);
            if ($cantidad) {
                $rol->flash('success', "Registro actualizado con éxito");
                $data = $rol->get();
                include('views/rol/index.php');
            } else {
                $rol->flash('warning', "Algo falló o no hubo cambios");
                $data = $rol->get();
                include('views/rol/index.php');
            }
        } else {
            $data = $rol->get($id);
            include('views/rol/form.php');
        }
        break;
    case 'delete':
        $cantidad = $rol->delete($id);
        if ($cantidad) {
            $rol->flash('success', "Registro eliminado con éxito");
            $data = $rol->get();
            include('views/rol/index.php');
        } else {
            $rol->flash('danger', "Algo fallo");
            $data = $rol->get();
            include('views/rol/index.php');
        }
        break;
    case 'privilegio':
        $data = $rol->get($id);
        $data_privilegio = $rol->getPrivilegio($id);
        include('views/rol/privilegio.php');
        break;
    case 'deletePrivilegio':
        $cantidad = $rol->deletePrivilegio($id, $id_privilegio);
        if ($cantidad) {
            $rol->flash('success', "Registro eliminado con éxito");
            $data = $rol->get($id);
            $data_privilegio = $rol->getPrivilegio($id);
            include('views/rol/privilegio.php');
        } else {
            $rol->flash('danger', "Algo fallo");
            $data = $rol->get($id);
            $data_privilegio = $rol->getPrivilegio($id);
            include('views/rol/privilegio.php');
        }
        break;
    case 'newPrivilegio':
        $data = $rol->get($id);
        $dataprivilegio = $privilegio->get();
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $cantidad = $rol->newPrivilegio($id, $data2);
            if ($cantidad) {
                $rol->flash('success', "Registro dado de alta con éxito");

            } else {
                $rol->flash('danger', "Algo falló.");
            }
            $data_privilegio = $rol->getPrivilegio($id);
            include('views/rol/privilegio.php');
        } else {
            include('views/rol/privilegio_form.php');
        }
        break;
    case 'get':
    default:
        $data = $rol->get($id);
        include("views/rol/index.php");
}
include_once('views/footer.php');
?>