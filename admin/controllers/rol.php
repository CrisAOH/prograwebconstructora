<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Proyecto
 */
class Rol extends Sistema
{
    /**
     * Obtiene los proyectos solicitado
     *
     * @return array $data los proyectos solicitados
     * @param integer $id si se especifica un id solo obtiene el proyecto solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from rol where id_rol = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo proyecto
     */
    public function new($data)
    {
        $this->db();
        $sql = "insert into rol (rol) values (:rol)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del proyecto a editar
     *         array $data los datos modificados del proyecto
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update rol set rol = :rol where id_rol = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del proyecto a eliminar
     */public function delete($id)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "delete from rol_privilegio where id_rol = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $sql2 = "delete from rol where id_rol = :id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $st2->execute();
            $rc = $st2->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;

    }

    public function getPrivilegio($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select p.* from privilegio p join rol_privilegio rp on p.id_privilegio = rp.id_privilegio";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select p.* from privilegio p join rol_privilegio rp on p.id_privilegio = rp.id_privilegio where rp.id_rol=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function deletePrivilegio($id, $id2)
    {
        $this->db();
        $sql = "delete from rol_privilegio where id_rol = :id and id_privilegio=:id2";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id2", $id2, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newPrivilegio($id, $data)
    {
        $this->db();
        $rc=0;

        try{
            $sql = "insert into rol_privilegio (id_privilegio,id_rol) values (:id_privilegio, :id_rol)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_privilegio",$data['id_privilegio'],  PDO::PARAM_INT);
            $st->bindParam(":id_rol",$data['id_rol'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            
        }catch(PDOException $e){
            echo "Error al insertar el privilegio, ya existe ese privilegio en este rol " ;

        }
        return $rc;

       
    }
}
$rol = new Rol;
?>