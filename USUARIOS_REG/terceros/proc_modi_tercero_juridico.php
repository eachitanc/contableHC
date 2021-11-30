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

$tip_id2=$_POST['tip_id2'];   
$num_id2=$_POST['num_id2'];   
$dv2=$_POST['dv2'];   
$clase2=$_POST['clase2'];   
$regimen2=$_POST['regimen2'];//   
$ent_ofi2=$_POST['ent_ofi2'];   
$raz_soc2=$_POST['raz_soc2'];   
$nom_com2=$_POST['nom_com2'];   
$pais2=$_POST['selecta'];   
$dpto2=$_POST['selectb'];   
$mpio2=$_POST['selectc'];   
$dir2=$_POST['dir2'];   
$tel2=$_POST['tel2'];   
$fax2=$_POST['fax2'];   
$em2=$_POST['email2'];   
$contabilidad2=$_POST['contabilidad2'];   
$ppto2=$_POST['ppto2'];   
$tesoreria2=$_POST['tesoreria2'];   
$almacen2=$_POST['almacen2'];   
$pri_ape2=$_POST['pri_ape2'];   
$seg_ape2=$_POST['seg_ape2'];   
$pri_nom2=$_POST['pri_nom2'];   
$seg_nom2=$_POST['seg_nom2'];   
$dir22=$_POST['dir22'];   
$tel22=$_POST['tel22'];   
$fax22=$_POST['fax22'];   
$em22=$_POST['email22'];  
$interventor=$_POST['interventor']; 
$cree=$_POST['cree'];
$act_eco=$_POST['act_eco'];


//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>",$id,$tip_id2,$num_id2,$dv2,$clase2,$regimen2,$ent_ofi2,$raz_soc2,$nom_com2,$pais2,$dpto2,$mpio2,$dir2,$tel2,$fax2,$em2,$contabilidad2,$ppto2,$tesoreria2,$almacen2,$pri_ape2,$seg_ape2,$pri_nom2,$seg_nom2,$dir22,$tel22,$fax22,$em22);

new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Update terceros_juridicos Set tip_id2='$tip_id2' , num_id2='$num_id2' , cree='$cree',act_eco='$act_eco', dv2='$dv2' , clase2='$clase2' , regimen2='$regimen2' , ent_ofi2='$ent_ofi2' , raz_soc2='$raz_soc2' , nom_com2='$nom_com2' , pais2='$pais2' , dpto2='$dpto2' , mpio2='$mpio2' , dir2='$dir2' , tel2='$tel2' , fax2='$fax2' , em2='$em2' , contabilidad2='$contabilidad2' , ppto2='$ppto2' , tesoreria2='$tesoreria2' , almacen2='$almacen2' , interventor = '$interventor', pri_ape2='$pri_ape2' , seg_ape2='$seg_ape2' , pri_nom2='$pri_nom2' , seg_nom2='$seg_nom2' , dir22='$dir22' , tel22='$tel22' , fax22='$fax22' , em22='$em22' Where id ='$id' and id_emp = '$idxx'";
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