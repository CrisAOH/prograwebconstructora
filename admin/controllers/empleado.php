<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Empleado
 */
class Empleado extends Sistema
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
            $sql = "select * from empleado e left join departamento d on e.id_departamento = d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from empleado e left join departamento d on e.id_departamento = d.id_departamento where id_empleado = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo Empleado
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo departamento
     */
    public function new($data)
    {
        $this->db();
        $image_parts = explode(";base64,", $_POST['foto']);
        $image_base64 = base64_decode($image_parts[1]);
        $sql = "insert into empleado (nombre, primer_apellido, segundo_apellido, fecha_nacimiento, rfc, curp, foto,  id_departamento) 
        values (:nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :rfc, :curp, :foto, :id_departamento)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":foto", $image_base64, PDO::PARAM_LOB);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
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
        $image_parts = explode(";base64,", $_POST['foto']);
        $image_base64 = base64_decode($image_parts[1]);
        $sql = "update empleado set nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, 
                fecha_nacimiento = :fecha_nacimiento, rfc = :rfc, curp = :curp, foto = :foto, id_departamento = :id_departamento where id_empleado = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":foto", $image_base64, PDO::PARAM_LOB);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar Empleado
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del empleado a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from empleado where id_empleado = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$empleado = new Empleado;
?>