<?php
/**
 * Enrutador departamento
 */
require_once("controllers/usuario.php");
require_once("controllers/rol.php");
include_once('views/header.php');
include_once('views/menu.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_rol = (isset($_GET['id_rol'])) ? $_GET['id_rol'] : null;
switch ($action) {
    case 'new':
        $datarol = $rol->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $usuario->new($data);
            if ($cantidad) {
                $usuario->flash('success', "Registro dado de alta con éxito");
                $data = $usuario->get();
                include('views/usuario/index.php');
            } else {
                $usuario->flash('danger', "Algo fallo");
                include('views/usuario/form.php');
            }
        } else {
            include('views/usuario/form.php');
        }
        break;
    case 'edit':
        $datarol = $rol->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_usuario'];
            $cantidad = $usuario->edit($id, $data);
            if ($cantidad) {
                $usuario->flash('success', "Registro actualizado con éxito");
                $data = $usuario->get();
                include('views/usuario/index.php');
            } else {
                $usuario->flash('warning', "Algo falló o no hubo cambios");
                $data = $usuario->get();
                include('views/usuario/index.php');
            }
        } else {
            $data = $usuario->get($id);
            include('views/usuario/form.php');
        }
        break;
    case 'delete':
        $cantidad = $usuario->delete($id);
        if ($cantidad) {
            $usuario->flash('success', "Registro eliminado con éxito");
            $data = $usuario->get();
            include('views/usuario/index.php');
        } else {
            $usuario->flash('danger', "Algo fallo");
            $data = $usuario->get();
            include('views/usuario/index.php');
        }
        break;
    case 'rol':
        $data = $usuario->get($id);
        $data_rol = $usuario->getRol($id);
        include('views/usuario/rol.php');
        break;
    case 'deleteRol':
        $cantidad = $usuario->deleteRol($id,$id_rol);
        if ($cantidad) {
            $usuario->flash('success', "Registro eliminado con éxito");
            $data = $usuario->get($id);
            $data_rol = $usuario->getRol($id);
            include('views/usuario/rol.php');
        } else {
            $usuario->flash('danger', "Algo fallo");
            $data = $usuario->get($id);
            $data_rol = $usuario->getRol($id);
            include('views/usuario/rol.php');
        }
        break;
    case 'newRol':
        $data = $usuario->get($id);
        $datarol = $rol->get();
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $cantidad = $usuario->newRol($id, $data2);
            if ($cantidad) {
                $usuario->flash('success', "Registro dado de alta con éxito");

            } else {
                $usuario->flash('danger', "Algo falló.");
            }
            $data_rol = $usuario->getRol($id);
            include('views/usuario/rol.php');
        } else {
            include('views/usuario/rol_form.php');
        }
        break;
    case 'get':
    default:
        $data = $usuario->get($id);
        include("views/usuario/index.php");
}
include_once('views/footer.php');
?>