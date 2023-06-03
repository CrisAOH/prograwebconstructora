<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__ . '/../admin/controllers/sistema.php');
include_once(__DIR__ . '/../admin/controllers/empleado.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;
switch ($action):
    /*case 'DELETE':
        $data['mensaje'] = 'No existe el empleado.';
        if (!is_null($id)) {
            $contador = $empleado->delete($id);
            if ($contador == 1)
                $data['mensaje'] = 'Se eliminó el empleado.';
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $empleado->new($data);
            if ($cantidad != 0)
                $data['mensaje'] = 'Se insertó un nuevo empleado.';
            //$data[]
            else
                $data['mensaje'] = 'Ocurrió un error.';
        } else {
            $cantidad = $empleado->edit($id, $data);
            if ($cantidad != 0)
                $data['mensaje'] = 'Se modificó el empleado.';
            //$data[]
            else
                $data['mensaje'] = 'Ocurrió un error.';
        }
        break;*/
    case 'GET':
    default:
        if (is_null($id))
            $data = $empleado->get();
        else
            $data = $empleado->get($id);
endswitch;
$data = json_encode($data);
echo ($data);
?>