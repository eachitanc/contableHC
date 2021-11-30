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

  $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("no se pudo conectar a base de datos");
  $mcrpp = "CRPP" . $_REQUEST['cod'];
  $usuarios = $conexion->query("Select * from crpp where id_emp ='$id_emp' and id_manu_crpp = '$mcrpp'");

  $num = $usuarios->num_rows;

  if ($num == 0) {
  } else {
    printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
  }
  $conexion = null;
?>
<?php
}
?>

