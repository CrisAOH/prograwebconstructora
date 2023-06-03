<?php
/**
 * Enrutador departamento
 */
require_once(__DIR__."/controllers/empleado.php");
require_once(__DIR__."/controllers/departamento.php");
include_once('views/header.php');
include_once('views/menu.php');
$empleado -> validateRol('RH');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        $empleado -> validatePrivilegio('Empleado Crear');
        $datadepartamentos = $departamento->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $empleado->new($data);
            if ($cantidad) {
                $empleado->flash('success', "Registro dado de alta con éxito");
                $data = $empleado->get();
                include('views/empleado/index.php');
            } else {
                $departamento->flash('danger', "Algo salió mal.");
                include('views/empleado/form.php');
            }
        } else {
            include('views/empleado/form.php');
        }
        break;
    case 'edit':
        $empleado -> validatePrivilegio('Empleado Editar');
        $datadepartamentos = $departamento->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_empleado'];
            $cantidad = $empleado->edit($id, $data);
            if ($cantidad) {
                $empleado->flash('success', "Registro actualizado con éxito");
                $data = $empleado->get();
                include('views/empleado/index.php');
            } else {
                $empleado->flash('warning', "Algo falló o no hubo cambios");
                $data = $empleado->get();
                include('views/empleado/index.php');
            }
        } else {
            $data = $empleado->get($id);
            include('views/empleado/form.php');
        }
        break;
    case 'delete':
        $empleado -> validatePrivilegio('Empleado Eliminar');
        $cantidad = $empleado->delete($id);
        if ($cantidad) {
            $empleado->flash('success', "Registro eliminado con éxito");
            $data = $empleado->get();
            include('views/empleado/index.php');
        } else {
            $departamento->flash('danger', "Algo fallo");
            $data = $departamento->get();
            include('views/empleado/index.php');
        }
        break;
    case 'get':
    default:
        $data = $empleado->get($id);
        include("views/empleado/index.php");
}
include_once('views/footer.php');
?>