<?php
declare(strict_types=1);
require_once(__DIR__ . "/controllers/factura.php");
require_once("../vendor/autoload.php");
header('Content-Type: application/json; charset=utf-8');
use PhpCfdi\CfdiToJson\JsonConverter;

$contents = file_get_contents('facturas/VES150827JW60.xml');
$json = JsonConverter::convertToJson($contents);
echo $json;
$cantidad = $factura->new($json);
echo($cantidad);
?>