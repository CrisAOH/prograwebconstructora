<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Departamento
 */
class Caso extends Sistema
{
    /**
     * Obtiene los departamentos solicitado
     *
     * @return array $data los departamentos solicitados
     * @param integer $id si se especifica un id solo obtiene el departamento solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from caso_exito";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from caso_exito where id_caso = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo departamento
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo departamento
     */
    public function new($data)
    {
        $this->db();
        $nombrearchivo = str_replace(" ", "_", $data['caso_exito']);
        $nombrearchivo = substr($nombrearchivo, 0, 20);
        $sql = "insert into caso_exito (caso_exito, descripcion, resumen, imagen, activo) 
        values (:caso_exito, :descripcion, :resumen, :imagen, :activo)";
        $sesubio = $this->uploadfile("imagen", "upload/casos_exito/", $nombrearchivo);
        $default = "../images/default.jpeg";
        $st = $this->db->prepare($sql);
        $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
        $st->bindParam(":activo", $data['activo'], PDO::PARAM_INT);
        if ($sesubio) {
            $st->bindParam(":imagen", $sesubio, PDO::PARAM_STR);
        }
        else
        {
            $st->bindParam(":imagen", $default, PDO::PARAM_STR);
        }
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del departamento a editar
     *         array $data los datos modificados del departamento
     */
    public function edit($id, $data)
    {
        $this->db();
        $nombrearchivo = str_replace(" ", "_", $data['caso_exito']);
        $nombrearchivo = substr($nombrearchivo, 0, 20);
        $sesubio = $this->uploadfile("imagen", "upload/casos_exito/", $nombrearchivo);
        $default = "../images/default.jpeg";
        $sql = "update caso_exito set caso_exito = :caso_exito, descripcion = :descripcion, 
        resumen = :resumen, imagen = :imagen, activo= :activo where id_caso = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
        $st->bindParam(":activo", $data['activo'], PDO::PARAM_INT);
        if ($sesubio) {
            $st->bindParam(":imagen", $sesubio, PDO::PARAM_STR);
        }
        else
        {
            $st->bindParam(":imagen", $default, PDO::PARAM_STR);
        }
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del departamento a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from caso_exito where id_caso = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$caso = new Caso;
?>