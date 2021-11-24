<?php
session_start();
require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();

//Configuracion servidor mail
$mail->From = "requerimientos@lcm.com"; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username = 'eacoralc@gmail.com'; //nombre usuario
$mail->Password = 'ea261382'; //contraseña

//Agregar destinatario
$mail->AddAddress('eachitanc@gmail.com');
$mail->Subject = 'Asunto?';
$mail->Body = 'Mensaje';

//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo '<script type="text/javascript">
           alert("Enviado Correctamente");
        </script>';
} else {
    echo '<script type="text/javascript">
           alert("NO ENVIADO, intentar de nuevo");
        </script>';
}
