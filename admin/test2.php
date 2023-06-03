<?php
require_once(__DIR__."/controllers/sistema.php");
$sistema->db2();
$sql = "select * from factura";
$st = $sistema->db->prepare($sql);
$st->execute();
$data = $st->fetchAll(PDO::FETCH_ASSOC);
echo($data);
?>