<?php
require_once(__DIR__."/controllers/sistema.php");
require_once('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

//Arreglos de estilos
//Estilo para el encabezado
$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 14
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '000000'
        ]
    ]
];
$titulo = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 20
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'A58E4E'
        ]
    ]
];
$subTitulo = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => true,
        'size' => 16
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFFFF'
        ]
    ]
];
$infoGral = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => true,
        'size' => 12
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'D7DBDD'
        ]
    ]
];
$infoGral2 = [
    'font' => [
        'color' => [
            'rgb' => '000000'
        ],
        'bold' => false,
        'size' => 12
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'D7DBDD'
        ]
    ]
];
$evenRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'D7DBDD'
        ]
    ]
];
$oddRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'BDC3C7'
        ]
    ]
];
$aesthetic = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFFFF'
        ]
    ]
];
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
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
        //Establecer fuente de la letra
        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(10);
        //Encabezado
        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', "Reporte de proyecto: " . $data[0]['proyecto']);
        $spreadsheet->getActiveSheet()
            ->mergeCells("A1:G1");
        $spreadsheet->getActiveSheet()
            ->getStyle('A1')
            ->applyFromArray($titulo);
        $spreadsheet->getActiveSheet()
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Subencabezado
        $spreadsheet->getActiveSheet()
            ->setCellValue('A2', "Información General");
        $spreadsheet->getActiveSheet()
            ->mergeCells("A2:G2");
        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->applyFromArray($subTitulo);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Información General
        $spreadsheet->getActiveSheet()
            ->setCellValue('A3', "Departamento:")
            ->setCellValue('A4', "Fecha de inicio:")
            ->setCellValue('A5', "Fecha de finalización:")
            ->setCellValue('A6', "Descripción:");
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:A6')
            ->applyFromArray($infoGral);
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:A6')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()
            ->setCellValue('B3', $data[0]['departamento'])
            ->setCellValue('B4', $data[0]['fecha_inicio'])
            ->setCellValue('B5', $data[0]['fecha_fin'])
            ->setCellValue('B6', $data[0]['descripcion']);
        $spreadsheet->getActiveSheet()
            ->mergeCells("B3:G3")
            ->mergeCells("B4:G4")
            ->mergeCells("B5:G5")
            ->mergeCells("B6:G6");
        $spreadsheet->getActiveSheet()
            ->getStyle('B3:B6')
            ->applyFromArray($infoGral2);
        $spreadsheet->getActiveSheet()
            ->getStyle('B3:B6')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Otro subencabezado
        $spreadsheet->getActiveSheet()
            ->setCellValue('A7', "Tareas");
        $spreadsheet->getActiveSheet()
            ->mergeCells("A7:G7");
        $spreadsheet->getActiveSheet()
            ->getStyle('A7')
            ->applyFromArray($subTitulo);
        $spreadsheet->getActiveSheet()
            ->getStyle('A7')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Establecer ancho de columnas
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('A')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('B')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('C')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('D')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('E')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('F')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('G')
            ->setAutoSize(true);
        //Encabezados tabla
        $spreadsheet->getActiveSheet()
            ->setCellValue('B8', "ID")
            ->setCellValue('C8', "Tarea")
            ->setCellValue('D8', "Avance");
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->getFont()
            ->setSize(12);
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->getFont()
            ->setBold(true);
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->applyFromArray($tableHead);
        $spreadsheet->getActiveSheet()
            ->getStyle('B8:D8')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Celdas extra
        $spreadsheet->getActiveSheet()
            ->mergeCells("E8:G8");
        $spreadsheet->getActiveSheet()
            ->getStyle('E8:G8')
            ->applyFromArray($aesthetic);
        $spreadsheet->getActiveSheet()
            ->getStyle('A8')
            ->applyFromArray($aesthetic);
        //Contenido de la tabla
        $row = 9;
        foreach ($data as $key => $tarea):
            $spreadsheet->getActiveSheet()
                ->setCellValue('B' . $row, $tarea['id_tarea'])
                ->setCellValue('C' . $row, $tarea['tarea'])
                ->setCellValue('D' . $row, $tarea['tarea']);
            if ($row % 2 == 0) {
                $spreadsheet->getActiveSheet()
                    ->getStyle('B' . $row . ':D' . $row)
                    ->applyFromArray($evenRow);
            } else {
                $spreadsheet->getActiveSheet()
                    ->getStyle('B' . $row . ':D' . $row)
                    ->applyFromArray($oddRow);
            }
            $spreadsheet->getActiveSheet()
                ->getStyle('B' . $row . ':D' . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()
                ->getStyle('A' . $row)
                ->applyFromArray($aesthetic);
            $spreadsheet->getActiveSheet()
                ->mergeCells("E" . $row . ":G" . $row);
            $spreadsheet->getActiveSheet()
                ->getStyle('E' . $row . ':G' . $row)
                ->applyFromArray($aesthetic);
            $row++;
        endforeach;
        break;
    default:
endswitch;
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteProyectos.xlsx"');
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>