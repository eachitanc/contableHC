<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
?>
<?php
  include('../config.php');

  //*** luis hillon

  $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
  $sqlxx = "select * from fecha";
  $resultadoxx = $connectionxx->query($sqlxx);

  while ($rowxx = $resultadoxx->fetch_assoc()) {
    $id_emp = $rowxx["id_emp"];
  }

  $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("no se pudo conectar a base de datos");
  $rcgy = 'RCGT' . $_REQUEST['cod'];
  $usuarios = $conexion->query("SELECT * from recaudo_rcgt where id_emp ='$id_emp' and id_manu_rcgt = '$rcgy'");
  $num = $usuarios->num_rows;
  if ($num == 0) {
    printf("<font color ='#006600'><b>...::: DISPONIBLE :::...</b></font>");
  } else {
    printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
  }
  $conexion = null;
?>
<?php
}
?>
