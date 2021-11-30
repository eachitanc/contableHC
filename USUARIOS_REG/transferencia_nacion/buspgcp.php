<?php
if (isset($_POST["val"])) {
  $conten = $_POST["val"];
  include('../config.php');
  $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
  $sqlxx = "SELECT id_emp from fecha";
  $resultadoxx = $conexion->query($sqlxx);
  $rsl = $resultadoxx->fetch_assoc();
  $id_emp = $rsl['id_emp'];
  $usuario_consulta = $conexion->query("Select nom_rubro from pgcp where cod_pptal = '$conten' and id_emp ='$id_emp' and tip_dato = 'D'");
  $ntuplas = $usuario_consulta->fetch_assoc();
  if (empty($ntuplas)) {
    echo '';
  } else {
    echo $ntuplas['nom_rubro'];
  }
  $conexion = null;
}
