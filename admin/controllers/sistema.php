<?php
/**
 * Clase principal del sistema.
 *
 * @autor 2023 Escribe tu nombre
 */
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//echo(__DIR__.'/../config.php');
//die();
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../config2.php');
class Sistema
{
   var $db = null;
   var $db2 = null;
   /**
    * Conexión a la base de datos
    *
    * @return PDOObject en $this->db
    * @param del archivo de configuracion config.php
    */
   public function db()
   {
      $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
      $this->db = new PDO($dsn, DBUSER, DBPASS);
   }

   public function db2()
   {
      $dsn2 = DBDRIVER2 . ':host=' . DBHOST2 . ';dbname=' . DBNAME2 . ';port=' . DBPORT2;
      $this->db2 = new PDO($dsn2, DBUSER2, DBPASS2);
   }

   /**
    * Imprime un mensaje usando alerts de bootstrap
    *
    * @param $color el color del alert
    *        $msg el mesaje a imprimir
    */
   public function flash($color, $msg)
   {
      include('views/flash.php');
   }

   /**
    * Aquí al documentación
    *
    * @param 
    */
    public function uploadfile($tipo, $ruta, $archivo)
    {
       $name = false;
       $uploads['archivo'] = array("application/gzip", "application/zip", "application/x-zip-compressed");
       $uploads['imagen'] = array("image/jpeg", "image/jpg", "image/gif", "image/png");
       if ($_FILES[$tipo]['error'] == 4) {
          return $name;
       }
       if ($_FILES[$tipo]['error'] == 0) {
          if (in_array($_FILES[$tipo]['type'], $uploads['archivo'])||in_array($_FILES[$tipo]['type'], $uploads['imagen'])) {
             if ($_FILES[$tipo]['size'] <= 10 * 1048 * 1048) //Se puede declarar otro arreglo de tamaños
             {
                $origen = $_FILES[$tipo]['tmp_name'];
                $ext = explode(".", $_FILES[$tipo]['name']);
                $ext = $ext[sizeof($ext) - 1];
                $destino = $ruta . $archivo . "." . $ext;
                if (move_uploaded_file($origen, __DIR__.'/../'.$destino)) {
                   $name = $destino;
                }
             }
          }
       }
       return $name;
    }

   /*function cargarImagen($id, $atributo, $ruta)
   {
   $resultado = false;
   $extensiones = array("image/jpeg", "image/png", "image/gif");
   if (isset($_FILES[$atributo])) {
   if ($_FILES[$atributo]['error'] == 0) {
   if ($_FILES[$atributo]['size'] <= 500 * 1024) {
   if (in_array($_FILES[$atributo]['type'], $extensiones)) {
   $extension = explode('.', $_FILES[$atributo]['name']);
   $extension = $extension[count($extension) - 1];
   $ruta = $ruta . $id . "." . $extension;
   if (move_uploaded_file($_FILES[$atributo]['tmp_name'], $ruta)) {
   $resultado = $ruta;
   } else {
   $resultado = false;
   }
   }
   }
   }
   }
   return $resultado;
   }*/

   public function login($correo, $contrasena)
   {
      if (!is_null($contrasena)) {
         if (strlen($contrasena) > 0) {
            if ($this->validateEmail($correo)) {
               $contrasena = md5($contrasena);
               $this->db();
               $sql = 'select id_usuario, correo from usuario where correo = :correo and contrasena = :contrasena';
               $st = $this->db->prepare($sql);
               $st->bindParam(":correo", $correo, PDO::PARAM_STR);
               $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
               $st->execute();
               $data = $st->fetchAll(PDO::FETCH_ASSOC);
               if (isset($data[0])) {
                  $data = $data[0];
                  $_SESSION = $data;
                  $_SESSION['roles'] = $this->getRoles($correo);
                  $_SESSION['privilegios'] = $this->getPrivilegios($correo);
                  $_SESSION['validado'] = true;
                  return true;
               }
            }
         }
      }
      return false;
   }

   public function logout()
   {
      unset($_SESSION["logueado"]);
      session_destroy();
   }

   public function getRoles($correo)
   {
      $roles = array();
      if ($this->validateEmail($correo)) {
         $this->db();
         $sql = 'select r.rol from usuario u 
         join usuario_rol ur on u.id_usuario = ur.id_usuario 
         join rol r on r.id_rol = ur.id_rol
         where u.correo = :correo';
         $st = $this->db->prepare($sql);
         $st->bindParam(":correo", $correo, PDO::PARAM_STR);
         $st->execute();
         $data = $st->fetchAll(PDO::FETCH_ASSOC);
         foreach ($data as $key => $rol) {
            array_push($roles, $rol['rol']);
         }
      }
      return $roles;
   }

   public function getPrivilegios($correo)
   {
      $privilegios = array();
      if ($this->validateEmail($correo)) {
         $this->db();
         $sql = 'select p.privilegio from privilegio p 
         join rol_privilegio rp on p.id_privilegio = rp.id_privilegio
         join rol r on r.id_rol = rp.id_rol
         join usuario_rol ur on r.id_rol = ur.id_rol
         join usuario u on u.id_usuario = ur.id_usuario
         where u.correo = :correo';
         $st = $this->db->prepare($sql);
         $st->bindParam(":correo", $correo, PDO::PARAM_STR);
         $st->execute();
         $data = $st->fetchAll(PDO::FETCH_ASSOC);
         foreach ($data as $key => $privilegio) {
            array_push($privilegios, $privilegio['privilegio']);
         }
      }
      return $privilegios;
   }

   public function validateEmail($correo)
   {
      if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
         return true;
      }
      return false;
   }

   public function validateRol($rol)
   {
      if (isset($_SESSION['validado'])) {
         if ($_SESSION['validado']) {
            if (isset($_SESSION['roles'])) {
               if (count($_SESSION['roles']) == 1 && in_array('Usuario', $_SESSION['roles'])) {
                  // Si el usuario solo tiene el rol "Usuario", redirige a la página deseada
                  header("Location: ../casos/index.php");
               } else {
                  // El usuario tiene otros roles además de "Usuario"
                  if (in_array($rol, $_SESSION['roles'])) {
                     // El usuario tiene el rol adecuado, continua con la operación
                     print('Eres un usuario también');
                  } else {
                     // El usuario no tiene el rol adecuado, muestra un mensaje de error
                     $this->killApp('No tienes el rol adecuado.');
                  }
               }
            } else {
               $this->killApp('No tienes roles asignados.');
            }
         } else {
            $this->killApp('No estás validado.');
         }
      } else {
         $this->killApp('No te has logueado.');
      }

   }

   public function validatePrivilegio($privilegio)
   {
      if (isset($_SESSION['validado'])) {
         if ($_SESSION['validado']) {
            if (isset($_SESSION['privilegios'])) {
               if (!in_array($privilegio, $_SESSION['privilegios'])) {
                  $this->killApp('No tienes el privilegio adecuado.');
               }
            } else {
               $this->killApp('No tienes privilegios asignados.');
            }
         } else {
            $this->killApp('No estás validado.');
         }
      } else {
         $this->killApp('No te has logueado.');
      }
   }
   public function killApp($mensaje)
   {
      ob_end_clean();
      include('views/header_error.php');
      $this->flash('danger', $mensaje);
      include('views/footer_error.php');
      die();
   }

   public function forgot($destinatario, $token)
   {
      if ($this->validateEmail($destinatario)) {
         require '../vendor/autoload.php';
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->SMTPDebug = SMTP::DEBUG_OFF;
         $mail->Host = 'smtp.gmail.com';
         $mail->Port = 465;
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
         $mail->SMTPAuth = true;
         $mail->Username = '20031091@itcelaya.edu.mx';
         $mail->Password = 'ssksrpejjvydgkrj';
         $mail->setFrom('20031091@itcelaya.edu.mx', 'Cristhian Ortega');
         $mail->addAddress($destinatario, 'Sistema de Constructora');
         $mail->Subject = 'Recuperación de contraseña';
         $mensaje = "
            Estimado usuario <br> 
            <a href =\"http://localhost/programacionwebconstructora-main/admin/login.php?action=recovery&token=$token&correo=$destinatario\">Presione aquí para recuperar la contraseña. </a> <br>
            Atentamente Constructora,
         ";
         $mail->msgHTML($mensaje);
         if (!$mail->send()) {
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
         } else {
            //echo 'Message sent!';
         }
      }
   }
   public function generarToken($correo)
   {
      $token = "papaschicas";
      $n = rand(1, 1000000);
      $x = md5(md5($token));
      $y = md5($x . $n);
      $token = md5($y);
      $token = md5($token . 'calamardo');
      $token = md5('patricio') . md5($token . $correo);
      return $token;
   }

   public function loginSend($correo)
   {
      $rc = 0;
      if ($this->validateEmail($correo)) {
         $this->db();
         $sql = 'select correo from usuario where correo = :correo';
         $st = $this->db->prepare($sql);
         $st->bindParam(":correo", $correo, PDO::PARAM_STR);
         $st->execute();
         $data = $st->fetchAll(PDO::FETCH_ASSOC);
         if (isset($data[0])) {
            $token = $this->generarToken($correo);
            $sql2 = 'update usuario set token = :token where correo = :correo';
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st2->bindParam(":token", $token, PDO::PARAM_STR);
            $st2->execute();
            $rc = $st2->rowCount();
            $this->forgot($correo, $token);
         }
      }
      return $rc;
   }

   public function validateToken($correo, $token)
   {
      if (strlen($token) == 64) {
         if ($this->validateEmail($correo)) {
            $this->db();
            $sql = 'select correo from usuario where correo = :correo and token = :token';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->bindParam(":token", $token, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            if (isset($data[0])) {
               return true;
            }
         }
      }
      return false;
   }

   public function resetPassword($correo, $token, $contrasena)
   {
      $rc = 0;
      if (strlen($token) == 64 and strlen($contrasena) > 0) {
         if ($this->validateEmail($correo)) {
            $contrasena = md5($contrasena);
            $this->db();
            $sql = 'update usuario set contrasena = :contrasena, token = null where correo = :correo and token = :token';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->bindParam(":token", $token, PDO::PARAM_STR);
            $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();
         }
      }
      return $rc;
   }
}
$sistema = new sistema;
?>