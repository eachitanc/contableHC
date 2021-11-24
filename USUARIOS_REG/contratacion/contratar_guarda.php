<?
session_start();
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
		<br />
		<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />

<?php
			include('../config.php');		
			$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
			mysql_select_db("$database"); 
 
				$numero= $_POST['numero_crpp']; 				
				$numeroconx= $_POST['numero_contrato'];
				$numerocon =strtoupper($numeroconx);
				$fecha=$_POST['fecha_contrato']; 
				$clase  = $_POST['clase_contrato'];
				$modalidad = $_POST['modalidad_seleccion']; 
				$fechafirma  = $_POST['fecha_firma']; 
				$fecha_ter = $_POST['fecha_ter'];
				$objeto  = $_POST['objeto']; 
				$plazo = $_POST['plazo']; 
				$plazo_unidad = $_POST['plazo_unidad']; 
				$cedula_interventor   = $_POST['cedula_interventor']; 
				$tipovinculacion  = $_POST['tipo_vinculacion']; 
				$valor_contrato  = $_POST['valor_contrato'];
				$forma_contratacion = substr($modalidad,2);  
				$id_auto_crpp  = $_POST['id_auto_crpp'];
				$bpin  = $_POST['bpin'];
				$valor_anticipo  = $_POST['val_anticipo'];
		
	$sql = "select * from contrataciones2 where id_auto_crpp = '$id_auto_crpp'";
	$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
	
	if (mysql_num_rows($result) == 0)	
	// El contrato recibido no existe en la base de datos y se guarda		
	{ 
		    	// Guardo los datos en la base 
				$IngresaDatos =	"INSERT INTO contrataciones2 
					(id_auto_crpp,num_crpp,num_contrato,fec_registro,clas_contrato,modalidad,fec_firma,
					for_contratacion,objeto,plazo_contrato,plazo_unidad,cedula_interventor, tipo_vinculacion_interventor, valor_inicial)
				VALUES 	
					('$id_auto_crpp','$numero','$numerocon','$fecha','$clase','$modalidad','$fechafirma',
					'$forma_contratacion','$objeto','$plazo','$plazo_unidad','$cedula_interventor','$tipovinculacion', '$valor_contrato')";
	    		$Resultado = mysql_query ($IngresaDatos,$cx);
				    
					if ($Resultado)
					{					// Si los datos se guardan muestra mensaje ok
       					?>   
						<br /><br /><br /><br />
						<img src="../simbolos/ok.png" width="32" height="32" /><br /><br />
						<p align="center" class="sidebar2">LOS DATOS FUERON ALMACENADOS CON EXITO	</p>
						<?  
								$sql = "UPDATE crpp SET contrato_control ='1' where id_auto_crpp = '$id_auto_crpp'";
								$result = mysql_db_query($database, $sql, $cx);  
						?> 
								<br />	<br />
								<center>			  
									<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center" class="Estilo4">
										<a href='index.php' target='_parent'>VOLVER</a>
									</div>
									</div>
									</div>
								</center>
						<?		
					}
					else
					{					// Sino muestra mensajes de error
					   	?>   
								<br /><br /><br /><br />
								<img src="../images/error.png" width="32" height="32" /><br /><br />
								<p align="center" class="sidebar2">SE PRESENTARON ERRORES AL GUARDAR LOS DATOS</p>
								<br /><br />	
								<center>			  
									<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center">
										<a href='index.php' target='_parent'>VOLVER</a>
									</div>
									</div>
									</div>
								</center>
						<? 		 
   					} 

	}
	// El contrato que se ha recibido ya existe en la base de datos y se lo tiene que editar 
	else   				
	{
		echo "<br>entro edita 2";
		$sql = "UPDATE contrataciones2 SET 
					id_auto_crpp = '$id_auto_crpp'
					,num_crpp ='$numero'
					,num_contrato =	'$numerocon'			
					,fec_registro = '$fecha'
					,clas_contrato = '$clase'
					,modalidad = '$modalidad'
					,fec_firma = '$fechafirma'
					,for_contratacion = '$forma_contratacion'
					,objeto  = '$objeto'
					,plazo_contrato = '$plazo'
					,plazo_unidad = '$plazo_unidad'
					,cedula_interventor  = '$cedula_interventor'
					,tipo_vinculacion_interventor = '$tipovinculacion'
					,valor_inicial = '$valor_contrato'
					,fecha_terminacion = '$fecha_ter'
				    ,bpin = '$bpin'
					,valor_anticipo = '$valor_anticipo'
				where id_auto_crpp = '$id_auto_crpp'
				";
		echo "<br> $sql";		
		$result = mysql_db_query($database, $sql, $cx);  
		
						?>   
						<br /><br /><br /><br />
						<img src="../simbolos/ok.png" width="32" height="32" /><br /><br />
						<p align="center" class="sidebar2">LOS DATOS DEL CONTRATO FUERON EDITADOS CON EXITO	</p>
						<br />	<br />
								<center>			  
									<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center" class="Estilo4">
										<a href='index.php' target='_parent'>VOLVER</a>
									</div>
									</div>
									</div>
								</center>
						<?		
		
	}
	$cx = null  ; 
?>




</body>
</html>
