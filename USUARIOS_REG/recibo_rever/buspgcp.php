<?php
  if(isset($_POST["val"])){
    $conten=$_POST["val"];
    include('../config.php');
    $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
    $sqlxx = "select id_emp from fecha";
    $resultadoxx = mysql_db_query($database, $sqlxx, $conexion);
    $id_emp  = mysql_result($resultadoxx,0,0);
    $usuario_consulta = mysql_query("Select nom_rubro from pgcp where cod_pptal = '$conten' and id_emp ='$id_emp' and tip_dato = 'D'",$conexion);
    $ntuplas = @mysql_num_rows($usuario_consulta);
    if($ntuplas > 0){
      $xcodme = @mysql_result($usuario_consulta,0,0);
      echo $xcodme;
    }
    else{echo $ntuplas;}
    @mysql_close();
  }
?>

