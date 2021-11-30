<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?php
   include('../config.php');				
   $connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
   
	$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sxx = "select * from fecha";
	$rxx = mysql_db_query($database, $sxx, $cxx);

	while($rowxxx = mysql_fetch_array($rxx)) 
 	  {
   
 	  $idxx=$rowxxx["id_emp"];
 
 	  }
	
$id=$_POST['id'];   
$tipo_id=$_POST['tipo_id'];
$num_id=$_POST['num_id'];
$dv=$_POST['dv'];
$clase=$_POST['clase'];
$regimen=$_POST['regimen'];
$ent_ofi=$_POST['ent_ofi'];
$pri_ape=$_POST['pri_ape'];
$seg_ape=$_POST['seg_ape'];
$pri_nom=$_POST['pri_nom'];
$seg_nom=$_POST['seg_nom'];
$nom_com=$_POST['nom_com'];
$pais=$_POST['select'];
$dpto=$_POST['select2'];
$mpio=$_POST['select3'];
$dir=$_POST['dir'];
$tel=$_POST['tel'];
$fax=$_POST['fax'];
$em=$_POST['email'];
$contabilidad=$_POST['contabilidad'];
$ppto=$_POST['ppto'];
$tesoreria=$_POST['tesoreria'];
$almacen=$_POST['almacen'];
$interventor=$_POST['interventor']; 
$embargo=$_POST['embargo'];
$monto=$_POST['monto'];


//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>",$id,$tipo_id,$num_id,$dv,$clase,$regimen,$ent_ofi,$pri_ape,$seg_ape,$pri_nom,$seg_nom,$nom_com,$pais,$dpto,$mpio,$dir,$tel,$fax,$em,$contabilidad,$ppto,$tesoreria,$almacen);

new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Update terceros_naturales Set tipo_id = '$tipo_id' , num_id = '$num_id' , dv = '$dv' , clase = '$clase' , regimen = '$regimen' , ent_ofi = '$ent_ofi' , pri_ape = '$pri_ape' , seg_ape = '$seg_ape' , pri_nom = '$pri_nom' , seg_nom = '$seg_nom' , nom_com = '$nom_com' , pais = '$pais' , dpto = '$dpto' , mpio = '$mpio' , dir = '$dir' , tel = '$tel' , fax = '$fax', email = '$em' , contabilidad = '$contabilidad' , ppto = '$ppto' , tesoreria = '$tesoreria' , almacen = '$almacen', interventor = '$interventor', embargo ='$embargo',monto ='$monto' Where id ='$id' and id_emp = '$idxx'";
mysql_query($sSQL);	

  
printf("<br><br><center class='Estilo4'>DATOS ACTUALIZADOS CON EXITO<br><br>");  
printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='terceros.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>"); 
   
   ?>
<?php
}
?>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Estilo4 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
}
a:link {
	color: #990000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #990000;
}
a:hover {
	text-decoration: underline;
	color: #990000;
}
a:active {
	text-decoration: none;
	color: #990000;
}
.Estilo6 {color: #FFFFFF}
-->
</style> <title>CONTAFACIL</title>