<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__ . '/../admin/controllers/sistema.php');
include_once(__DIR__ . '/../admin/controllers/proyecto.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;
$id_tarea = isset($_GET['id_tarea']) ? $_GET['id_tarea'] : null;
switch ($action):
    case 'DELETE':
        $data['mensaje'] = 'No existe la tarea.';
        if (!is_null($id_tarea)) {
            $contador = $proyecto->deleteTask($id_tarea);
            if ($contador == 1)
                $data['mensaje'] = 'Se eliminó la tarea.';
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $proyecto->newTask($id, $data);
            if ($cantidad != 0)
                $data['mensaje'] = 'Se insertó la tarea.';
            //$data[]
            else
                $data['mensaje'] = 'Ocurrió un error.';
        } else {
            $cantidad = $proyect->editTask($id, $id_tarea, $data);
            if ($cantidad != 0)
                $data['mensaje'] = 'Se modificó la tarea.';
            //$data[]
            else
                $data['mensaje'] = 'Ocurrió un error.';
        }
        break;
    case 'GET':
    default:
        if (is_null($id))
            $data = $proyecto->getTask();
        else
            $data = $proyecto->getTask($id);
endswitch;
$data = json_encode($data);
echo ($data);
?>