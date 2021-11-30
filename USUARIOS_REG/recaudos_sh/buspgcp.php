<?php
if (isset($_POST["val"])) {
  $conten = $_POST["val"];
  include('../config.php');
  $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
  $sqlxx = "select id_emp from fecha";
  $resultadoxx = $conexion->query($sqlxx);
  $rsl = $resultadoxx->fetch_assoc();
  $id_emp  = $rsl['id_emp'];
  $usuario_consulta = $conexion->query("SELECT nom_rubro from pgcp where cod_pptal = '$conten' and id_emp ='$id_emp' and tip_dato = 'D'");
  $rsl = $usuario_consulta->fetch_assoc();
  $ntuplas = $rsl['nom_rubro'];
  if ($ntuplas > 0) {
    $xcodme = $ntuplas;
    echo $xcodme;
  } else {
    echo $ntuplas;
  }
  $conexion = null;
}
