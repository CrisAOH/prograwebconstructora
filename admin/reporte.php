<?php
require_once(__DIR__ . "/controllers/sistema.php");
require_once("../vendor/autoload.php");
use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$sistema->db();
switch ($action):
    case 'proyecto':
        $sql = "select * from vw_proyecto where id_proyecto = :id_proyecto";
        $st = $sistema->db->prepare($sql);
        $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);

        $html = '
        <head>
            <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        </head>
        <body>
        <div class="container">
		<div class="title"> Nombre del proyecto: ' . $data[0]['proyecto'] . '</div>
        </div>

        <div style="text-align: center;">
        <img src="../images/logo.png" width="300" height="150" alt="x" style="display: block; border: 1px solid black; padding: 10px;">
        </div> 
        <hr>

        <div style="text-align: center;">
        <h2> <i>Información General</i></h2>
        </div>         
        ';

        $html .= "<div class='texto'>
         <p><b>Departamento: </b>" . $data[0]['departamento'] . "</p>
        <p><b>Fecha de inicio: </b>" . $data[0]['fecha_inicio'] . "</p>
        <p><b>Fecha de finalización: </b>" . $data[0]['fecha_fin'] . "</p>
        <p><b>Descripción: </b>" . $data[0]['descripcion'] . "</p>
        </div>";

        $html .= " 
        <hr>

        <div style='text-align: center;'>
        <h2><i>Tareas de este proyecto</i></h2>
        </div>
        <br>

        <table class='table-fill'>
        <thead>
            <tr>
                <th class='text-center'>Numero</th>
                <th class='text-center'>Nombre</th>
                <th class='text-center'>Avance</th>
            </tr>
        </thead>
        <tbody class='table-hover'>";
        foreach ($data as $key => $tarea):
            $html .=
                "
            <tr>
                <td class='text-center'>" . $tarea['id_tarea'] . "</td>
                <td class='text-center'>" . $tarea['tarea'] . "</td>
                <td class='text-center'>" . $tarea['avance'] . "</td>
            </tr>
             ";
        endforeach;
        $html .= "
        </tbody>
        </table>
        <br>
        <br>
        <hr>
        </body>
        ";

        break;
    default:
        $html = '<h1>Sin reporte</h1>No hay ningún reporte por generar.';
endswitch;
$html2pdf->writeHTML($html);
$html2pdf->output();
?>