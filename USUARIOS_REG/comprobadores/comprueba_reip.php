<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
  include('../config.php');

  //*** luis hillon

  $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
  $sqlxx = "select * from fecha";
  $resultadoxx = $connectionxx->query($sqlxx);

  while ($rowxx = $resultadoxx->fetch_assoc()) {
    $id_emp = $rowxx["id_emp"];
  }

  $servidor = $server;
  $usuario = $dbuser;
  $password = $dbpass;

  $reip = 'REIP' . $_REQUEST['cod'];
  $usuarios = $connectionxx->query("SELECT * from reip_ing where id_emp ='$id_emp' and id_manu_reip = '$reip'");
  $user = $usuarios->fetch_assoc();
  if (empty($user)) {
    printf("<font color ='#006600'><b>...::: DISPONIBLE :::...</b></font>");
  } else {
    printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
  }
  $conexion = null;
}
