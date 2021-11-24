<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: login.php");
exit;
} else {
?>
<?php
   include('../config.php');				
   $connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
   
   	
   $id=$_POST['id']; 
   $raz_soc=$_POST['raz_soc'];    
   $nit=$_POST['nit'];    
   $dv=$_POST['dv']; 
   $cod_ins=$_POST['cod_ins'];    
   $cod_cgn=$_POST['cod_cgn'];    
   $cod_dep=$_POST['cod_dep'];    
   $cod_mpio=$_POST['cod_mpio']; 
   $dir=$_POST['dir'];    
   $tel=$_POST['tel'];    
   $fax=$_POST['fax'];    
   $email=$_POST['email']; 
   $web_site=$_POST['web_site'];    
   $uni_eje=$_POST['uni_eje'];    
   $nom_rep_leg=$_POST['nom_rep_leg'];    
   $ced_rep_leg=$_POST['ced_rep_leg']; 
   $tp_rep_leg=$_POST['tp_rep_leg'];    
   $nom_cont=$_POST['nom_cont'];    
   $ced_cont=$_POST['ced_cont'];    
   $tp_cont=$_POST['tp_cont']; 
   $nom_rev_fis=$_POST['nom_rev_fis'];    
   $ced_rev_fis=$_POST['ced_rev_fis'];    
   $tp_rev_fis=$_POST['tp_rev_fis'];    
   $nom_ctrl_int=$_POST['nom_ctrl_int']; 
   $ced_ctrl_int=$_POST['ced_ctrl_int'];
   $tp_ctrl_int=$_POST['tp_ctrl_int'];    
   $nom_jefe_ppto=$_POST['nom_jefe_ppto'];    
   $ced_jefe_ppto=$_POST['ced_jefe_ppto']; 
   $tp_jefe_ppto=$_POST['tp_jefe_ppto'];    
   $otr_resp=$_POST['otr_resp'];    
   $nom_otr_resp=$_POST['nom_otr_resp'];    
   $ced_otr_resp=$_POST['ced_otr_resp']; 
   $tp_otr_resp=$_POST['tp_otr_resp'];    
   $fut=$_POST['fut'];
   $cgr=$_POST['cgr']; 
    $otra_uni_eje=$_POST['otra_uni_eje']; 
   $tipo_entidad=$_POST['tipo_entidad'];
   $regional=$_POST['regional'];
   $contratacion=$_POST['contratacion']; 
   $orden=$_POST['orden']; 
   $cargo_rep_leg=$_POST['cargo_rep_leg']; 
   $cargo_conta=$_POST['cargo_conta']; 
   $cargo_rev=$_POST['cargo_rev']; 
   $cargo_ci=$_POST['cargo_ci']; 
   $cargo_teso=$_POST['cargo_teso']; 
   $cargo_ppto=$_POST['cargo_ppto']; 
	  
	  	
			$sql = "UPDATE empresa SET raz_soc='$raz_soc', nit='$nit', dv='$dv', cod_ins='$cod_ins', cod_cgn='$cod_cgn', cod_dep='$cod_dep', cod_mpio='$cod_mpio', dir='$dir', tel='$tel', fax='$fax', email='$email', web_site='$web_site', uni_eje='$uni_eje', nom_rep_leg='$nom_rep_leg', ced_rep_leg='$ced_rep_leg', tp_rep_leg='$tp_rep_leg', nom_cont='$nom_cont', ced_cont='$ced_cont', tp_cont='$tp_cont', nom_rev_fis='$nom_rev_fis', ced_rev_fis='$ced_rev_fis', tp_rev_fis='$tp_rev_fis', nom_ctrl_int='$nom_ctrl_int', ced_ctrl_int='$ced_ctrl_int', tp_ctrl_int='$tp_ctrl_int', nom_jefe_ppto='$nom_jefe_ppto', ced_jefe_ppto='$ced_jefe_ppto' , tp_jefe_ppto='$tp_jefe_ppto', otr_resp='$otr_resp' , nom_otr_resp='$nom_otr_resp', ced_otr_resp='$ced_otr_resp', tp_otr_resp='$tp_otr_resp', fut='$fut', cgr='$cgr', otra_uni_eje='$otra_uni_eje', tipo_entidad='$tipo_entidad', regional = '$regional', reg_contratacion ='$contratacion', orden='$orden',cargo_rep_leg='$cargo_rep_leg',cargo_conta='$cargo_conta',cargo_rev='$cargo_rev',cargo_ci='$cargo_ci',cargo_teso='$cargo_teso',cargo_ppto ='$cargo_ppto' WHERE cod_emp='$id' "; 
			$resultado = mysql_db_query($database, $sql, $connection);

			echo "<span class='Estilo1'<br><br><br><center>Los Datos han sido Actualizados con &Eacute;xito<br><BR>";
  
			echo "<a href='../crear_empresa.php'>Volver</a></center></span>";
   		  

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
</style> 
<?
}
?>