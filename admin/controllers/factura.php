<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Departamento
 */
class Factura extends Sistema
{
    /**
     * Nuevo departamento
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo departamento
     */
    public function new ($data)
    {
        $this->db2();
        $sql = "insert into factura (factura) 
        values (:factura)";
        $st = $this->db2->prepare($sql);
        $st->bindParam(":factura", $data, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$factura = new Factura;
?>