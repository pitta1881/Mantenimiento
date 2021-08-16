<?php

namespace App\Models;

use App\Core\Model;
use Firebase\JWT\JWT;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LogInOutModel extends Model
{
    public function buscarUsuario($table, array $datos)
    {
        if ($this->db->buscarIfExists($table, $datos)) {
            $usuario = $this->db->selectAllWhere($table, $datos)[0];
            return $usuario;
        } else {
            return false;
        }
    }
    
    public function setToken($usuario, $mustRemember)
    {
        $key = $_ENV['KEYSEED'];
        $data = array('usuario' => $usuario, 'remember' => $mustRemember);
        $time = time();
        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60*24*30), // Tiempo que expirará el token (+30 dias)
            //'exp' => $time + (5), // Tiempo que expirará el token (+5 segundos)
            'data' => $data
        );
        return JWT::encode($token, $key);
    }

    public function validarToken($token)
    {
        try {
            $key = $_ENV['KEYSEED'];
            $data = JWT::decode($token, $key, array('HS256'))->data;
            if ($this->db->buscarIfExists(tableUsuarios, array('nick' => $data->usuario->nick, 'password' => $data->usuario->password))) {
                return array('login' => true, 'remember' => $data->remember);
            } else {
                return array('login' => false,'info' => 'Usuario o Contraseña inválidos');
            }
        } catch (\Throwable $th) {
            return array('login' => false,'info' => $th->getMessage());
        }
    }

    public function recoverPassword($email)
    {
        if ($this->db->buscarIfExists(tablePersonas, array('email' => $email))) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->CharSet = 'UTF-8';
                $mail->Host       = $_ENV['EMAILHOST'];                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $_ENV['EMAILUSER'];                     //SMTP username
                $mail->Password   = $_ENV['EMAILPASSWORD'];                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom($_ENV['EMAILUSER'], 'Sistema de Mantenimiento HNDBS');
                $mail->addAddress($email);     //Add a recipient
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperar Contraseña - Sistema de Mantenimiento HNDBS';
                $mail->Body    = 'Para recuperar su contraseña por favor haga click en el siguiente link <a href="#">Link</a>';
            
                $mail->send();
                return array('status' => true);
            } catch (Exception $e) {
                return array('status' => false, 'info' => $mail->ErrorInfo);
            }
        } else {
            return array('status' => false, 'info' => 'Email no encontrado');
        }
    }
}
