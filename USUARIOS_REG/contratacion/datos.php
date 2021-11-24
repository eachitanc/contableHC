<?
session_start();
$fecha1 =$_SESSION["fecha"]; 
$fecha2 =$_SESSION["fecha2"];
$pendiente =$_SESSION["pendiente"];
$registrado =$_SESSION["registrado"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTRATACION GCP</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
	<center>
		<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
<?php
include('../config.php');		
$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
mysql_select_db( "$database"); 
$numero= $_POST['numero_crpp']; 
$numeroconx= $_POST['numero_contrato'];
$numerocon =strtoupper($numeroconx);
$fecha=$_POST['fecha_contrato']; 
$clase  = $_POST['clase_contrato']; 
$modalidad = $_POST['modalidad_seleccion'];  
$fechafirma  = $_POST['fecha_firma']; 
$fecha_ter  = $_POST['fecha_ter']; 
$objeto  = $_POST['objeto']; 
$plazo = $_POST['plazo']; 
$plazo_unidad = $_POST['plazo_unidad']; 
$cedula_interventor   = $_POST['cedula_interventor']; 
$tipovinculacion  = $_POST['tipo_vinculacion']; 
$valor_contrato  = $_POST['valor_contrato'];
$forma_contratacion = substr($modalidad,2);  
$id_auto_crpp  = $_POST['id_auto_crpp'];
$perfil = $_POST['perfil'];
$bpin = $_POST['bpin'];
$valor_anticipo  = $_POST['val_anticipo'];
    $IngresaDatos = "INSERT INTO contrataciones2 
	(id_auto_crpp,num_crpp,num_contrato,fec_registro,clas_contrato,modalidad,fec_firma,for_contratacion,objeto,plazo_contrato,plazo_unidad,cedula_interventor, tipo_vinculacion_interventor, valor_inicial,fecha_terminacion,bpin,valor_anticipo)
	
	VALUES ('$id_auto_crpp','$numero','$numerocon','$fecha','$clase','$modalidad','$fechafirma','$forma_contratacion','$objeto','$plazo','$plazo_unidad','$cedula_interventor','$tipovinculacion', '$valor_contrato','$fecha_ter','$bpin','$valor_anticipo')";
    $Resultado = mysql_query ($IngresaDatos, $cx);
    if ($Resultado){
       	?>   
		<br />
		<br />
		<br />
		<img src="../simbolos/ok.png" width="32" height="32" /><br /><br />
		<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">CONTRATO ALMACENADO CON EXITO <?php print $anno; ?></div>
		<br />
<table border="0"  width="50%">
<tr>	
	<td width="30%" class="Estilo4" align="center"><?php echo "<a href='postcontratacion.php?num=$numerocon'><img src='../simbolos/procesar.png' border='0' /></a>"; ?> </td>
	<td width="40%" class="Estilo4" align="center"></td>
	<td width="30%" class="Estilo4" align="center"><?php echo "<a href='../contratacion_doc/generar_archivo.php?id=$id_auto_crpp&clase=$clase' target='_blank'  title ='Generar'><img src='../simbolos/reporte.jpg' border='0' /></a>"; ?></td>
</tr>
<tr>	
	<td class="Estilo4" align="center"><font color='#0000FF'>Postcontrataci�n</font></td>
	<td class="Estilo4" align="center"><font color='#0000FF'></font></td>
	<td class="Estilo4" align="center"><font color='#0000FF'>Generar Plantilla</font></td>
	</tr>
</table>
		<?  
			$sql = "UPDATE crpp SET contrato_control ='1' where id_manu_crpp = '$numero'";
			$result = mysql_db_query($database, $sql, $cx);  
		?> 
		<br />
			<br />
		<center>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
		<div align="center" class="Estilo6">
		<a href='index.php' target='_parent'>VOLVER</a></div>
		</div>
		</div>
		</center>
		<?

}else {
    	?>   
		<br />
		<br />
		<br />
		<br />
		<img src="../images/error.png" width="32" height="32" /><br /><br />
		<p align="center" class="sidebar2">SE PRESENTARON ERRORES AL GUARDAR LOS DATOS</p>
		<br />
		<br />
		<center>			  
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
		<div align="center">
		<a href='index.php' target='_parent'>VOLVER</a></div>
		</div>
		</div>
		</center>
		<?
    } 


$cx = null  ; 

?>




</body>
</html>
