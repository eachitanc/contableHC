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
   //id_emp
	$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sxx = "select * from fecha";
	$rxx = mysql_db_query($database, $sxx, $cxx);

	while($rowxxx = mysql_fetch_array($rxx)) 
 	  {
   
 	  $idxx=$rowxxx["id_emp"];
 
 	  }
	
   
   	$cod_pptal=$_POST['cod_pptal']; 
	$nom_rubro=$_POST['nom_rubro'];
    
	//convierto a minusculas el nombre de las cuentas tipo DETALLE	
	$sx = "select tip_dato from pgcp where id_emp='$idxx' AND cod_pptal ='$cod_pptal'";
	$rx = mysql_db_query($database, $sx, $cxx);
	while($r = mysql_fetch_array($rx)) 
 	  {
	  $td=$r["tip_dato"];
	  } 
   
    if($td == 'M')
   {
    
   }
   else
   {
     $nom_rubro = strtolower($nom_rubro);
   }
	
	$banco=$_POST['banco']; 
	$nom_banco1=$_POST['nom_banco1']; 
	$nom_banco2=$_POST['nom_banco2']; 
	$num_cta=$_POST['num_cta']; 
	$tip_cta=$_POST['tip_cta'];
	$fuentes_recursos=$_POST['fuentes_recursos']; 
	$cod_sia=$_POST['cod_sia']; 
	$sispro=$_POST['sispro']; 
	$sispro2=$_POST['sispro2']; 
	$cod_fut_el=$_POST['cod_fut_el']; 
	$naturaleza=$_POST['naturaleza']; 
	$c_nc=$_POST['c_nc']; 
	$almacen=$_POST['almacen']; 
	$depreciable=$_POST['depreciable']; 
	$cartera=$_POST['cartera']; 
	$tercero=$_POST['tercero']; 
	$base=$_POST['base']; 
	$c_costos=$_POST['c_costos']; 
	$cta_costos=$_POST['cta_costos']; 
	$ent_recip=$_POST['ent_recip']; 
	$nivel=$_POST['nivel']; 
	
	
new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database);
$sSQL="Update pgcp Set 	cod_pptal = '$cod_pptal' , nom_rubro = '$nom_rubro' , banco = '$banco' , nom_banco1 = '$nom_banco1' , nom_banco2 = '$nom_banco2' , num_cta = '$num_cta' , tip_cta = '$tip_cta' , fuentes_recursos = '$fuentes_recursos' , cod_sia = '$cod_sia' , sispro = '$sispro' , sispro2 = '$sispro2' , cod_fut_el = '$cod_fut_el' , naturaleza = '$naturaleza' , c_nc = '$c_nc' , almacen = '$almacen' , depreciable = '$depreciable' , cartera = '$cartera' , tercero = '$tercero' , base = '$base' , c_costos = '$c_costos' , cta_costos = '$cta_costos' , ent_recip = '$ent_recip' , nivel = '$nivel'   Where cod_pptal = '$cod_pptal' and id_emp ='$idxx'";
mysql_query($sSQL);	

  
printf("<center class='Estilo4'>DATOS ACTUALIZADOS CON EXITO<br><br>");  
printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='consulta_pgcp.php' target='_parent'>VOLVER </a> </div>
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