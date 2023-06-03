<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller Proyecto
 */
class Usuario extends Sistema
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
            $sql = "select * from usuario";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from usuario where id_usuario = :id";
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
        try {
            $this->db->beginTransaction();
            $sql = "insert into usuario (usuario, correo, contrasena) values (:usuario, :correo, md5(:contrasena))";
            $st = $this->db->prepare($sql);
            $st->bindParam(":usuario", $data['usuario'], PDO::PARAM_STR);
            $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
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
        
        if($data['cambiar']==1){
            $sql = "update usuario set usuario=:usuario, correo=:correo, contrasena = MD5(:contrasena) WHERE id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":usuario", $data['usuario'], PDO::PARAM_STR);
            $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();

        }else{
            $sql = "update usuario set usuario=:usuario, correo=:correo WHERE id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":usuario", $data['usuario'], PDO::PARAM_STR);
            $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();

        }

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
            $sql = "delete from usuario_rol where id_usuario=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $sql2 = "delete from usuario where id_usuario = :id";
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

    public function getRol($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select r.* from rol r join usuario_rol ur on r.id_rol = ur.id_rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select r.* from rol r join usuario_rol ur on r.id_rol = ur.id_rol where ur.id_usuario=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function deleteRol($id, $id2)
    {
        $this->db();
        $sql = "delete from usuario_rol where id_usuario = :id and id_rol=:id2";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id2", $id2, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newRol($id, $data)
    {
        $this->db();
        $rc=0;

        try{
            $sql = "insert into usuario_rol (id_rol,id_usuario) values (:id_rol, :id_usuario)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_rol",$data['id_rol'],  PDO::PARAM_INT);
            $st->bindParam(":id_usuario",$data['id_usuario'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            
        }catch(PDOException $e){
            echo "Error al insertar el privilegio, ya existe ese privilegio en este rol " ;

        }
        return $rc;
    }
}
$usuario= new Usuario;
?>