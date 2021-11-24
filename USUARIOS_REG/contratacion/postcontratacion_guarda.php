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
			mysql_select_db( "$database"); 
				$id= $_POST['id']; 
				$num_contrato= $_POST['num_contrato']; 			
				$procedimientos= $_POST['procedimientos'];  	
				$acto= $_POST['acto'];							
				$tipo_acto= $_POST['tipo_acto']; 				
				$fecha_acto= $_POST['fecha_acto']; 				
				$descripcion= $_POST['descripcion']; 			
				$id_manu_crpp= $_POST['id_manu_crpp']; 			
				$valor_adicion= $_POST['valor_adicion']; 
				$plazo_numero= $_POST['plazo_numero']; 
				$plazo_unidad= $_POST['plazo_unidad']; 
				$numero_poliza= $_POST['numero_poliza']; 
				$fecha_poliza= $_POST['fecha_poliza']; 
				$compania_poliza= $_POST['aseguradora']; 
				$tipo_acta_interventoria= $_POST['tipo_acta_interventoria']; 
				$fecha_termina= $_POST['fecha_termina']; 
				$observaciones= $_POST['observaciones']; 
				$cr_poliza1 = $_POST['cr_poliza1']; 
				$cr_poliza2 = $_POST['cr_poliza2']; 
				$cr_poliza3 = $_POST['cr_poliza3']; 
				$cr_poliza4 = $_POST['cr_poliza4']; 
				$cr_poliza5 = $_POST['cr_poliza5']; 
				$cr_poliza6 = $_POST['cr_poliza6']; 
				$cr_poliza7 = $_POST['cr_poliza7']; 
				$vr_poliza1 = $_POST['vr_poliza1']; 
				$vr_poliza2 = $_POST['vr_poliza2']; 
				$vr_poliza3 = $_POST['vr_poliza3']; 
				$vr_poliza4 = $_POST['vr_poliza4']; 
				$vr_poliza5 = $_POST['vr_poliza5']; 
				$vr_poliza6 = $_POST['vr_poliza6']; 
				$vr_poliza7 = $_POST['vr_poliza7']; 
				$fecha_poliza1_d = $_POST['fecha_poliza1_d']; 
				$fecha_poliza2_d = $_POST['fecha_poliza2_d']; 
				$fecha_poliza3_d = $_POST['fecha_poliza3_d']; 
				$fecha_poliza4_d = $_POST['fecha_poliza4_d']; 
				$fecha_poliza5_d = $_POST['fecha_poliza5_d']; 
				$fecha_poliza6_d = $_POST['fecha_poliza6_d']; 
				$fecha_poliza7_d = $_POST['fecha_poliza7_d']; 
				$fecha_poliza1_h = $_POST['fecha_poliza1_h']; 
				$fecha_poliza2_h = $_POST['fecha_poliza2_h']; 
				$fecha_poliza3_h = $_POST['fecha_poliza3_h']; 
				$fecha_poliza4_h = $_POST['fecha_poliza4_h']; 
				$fecha_poliza5_h = $_POST['fecha_poliza5_h']; 
				$fecha_poliza6_h = $_POST['fecha_poliza6_h']; 
				$fecha_poliza7_h = $_POST['fecha_poliza7_h']; 
	$sql = "select * from postcontratacion where num_acto = '$acto'";
	$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
	$sq3 ="SELECT MAX(id) AS id FROM postcontratacion";
	$rs3 = mysql_db_query($database,$sq3,$cx);
	$rw3 = mysql_fetch_array($rs3);
	$num_acto  = $tipo_acto ."-". $acto; 

	if (!$id)	
	// El contrato recibido no existe en la base de datos y se guarda		
	{ 
				// Guardo los datos en la base 
				$IngresaDatos =
				"INSERT INTO postcontratacion 
					(num_contrato, procedimientos, num_acto, fecha_acto, descripcion, id_manu_crpp, valor_adicion, plazo_numero, plazo_unidad, numero_poliza, fecha_poliza, compania_poliza, tipo_acta_interventoria, fecha_terminacion , observaciones , cod_archivo,
					cr_poliza1,cr_poliza2,cr_poliza3,cr_poliza4,cr_poliza5,cr_poliza6,cr_poliza7,
					vr_poliza1,vr_poliza2,vr_poliza3,vr_poliza4,vr_poliza5,vr_poliza6,vr_poliza7,
					fecha_poliza1_d,fecha_poliza2_d,fecha_poliza3_d,fecha_poliza4_d,fecha_poliza5_d,fecha_poliza6_d,fecha_poliza7_d,
					fecha_poliza1_h,fecha_poliza2_h,fecha_poliza3_h,fecha_poliza4_h,fecha_poliza5_h,fecha_poliza6_h,fecha_poliza7_h
					 )
				VALUES 	
					('$num_contrato', '$procedimientos', '$num_acto','$fecha_acto', '$descripcion', '$id_manu_crpp', '$valor_adicion', '$plazo_numero', '$plazo_unidad', '$numero_poliza',  '$fecha_poliza', '$compania_poliza', '$tipo_acta_interventoria', '$fecha_termina' , '$observaciones' , '$cod_archivo',
					
					'$cr_poliza1','$cr_poliza2','$cr_poliza3','$cr_poliza4','$cr_poliza5','$cr_poliza6','$cr_poliza7',
					'$vr_poliza1','$vr_poliza2','$vr_poliza3','$vr_poliza4','$vr_poliza5','$vr_poliza6','$vr_poliza7',
					'$fecha_poliza1_d','$fecha_poliza2_d','$fecha_poliza3_d','$fecha_poliza4_d','$fecha_poliza5_d','$fecha_poliza6_d','$fecha_poliza7_d',
					'$fecha_poliza1_h','$fecha_poliza2_h','$fecha_poliza3_h','$fecha_poliza4_h','$fecha_poliza5_h','$fecha_poliza6_h','$fecha_poliza7_h'
					
					)";

				
				$Resultado = mysql_query ($IngresaDatos, $cx) or die ($Resultado .mysql_error()."");
				
				    
					if ($Resultado)
					{					// Si los datos se guardan muestra mensaje ok
       					?>   
						<br /><br /><br /><br />
						<img src="../simbolos/ok.png" width="32" height="32" /><br /><br />
						<p align="center" class="sidebar2">LOS DATOS FUERON ALMACENADOS CON EXITO	</p>
					
								<br />	<br />
								<center>			  
									<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center" class="Estilo4">
										<? echo "<a href='postcontratacion.php?num=$num_contrato' target='_parent' class='sidebar2'>VOLVER</a>"; ?>
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
		$sql = "UPDATE postcontratacion SET 
		num_contrato='$num_contrato', procedimientos='$procedimientos', num_acto='$num_acto', fecha_acto='$fecha_acto', descripcion='$descripcion', id_manu_crpp='$id_manu_crpp', valor_adicion='$valor_adicion', plazo_numero='$plazo_numero', plazo_unidad='$plazo_unidad', numero_poliza='$numero_poliza', fecha_poliza='$fecha_poliza', compania_poliza='$compania_poliza', tipo_acta_interventoria='$tipo_acta_interventoria', fecha_terminacion='$fecha_termina', observaciones='$observaciones' , cod_archivo='$cod_archivo',			cr_poliza1='$cr_poliza1',cr_poliza2='$cr_poliza2',cr_poliza3='$cr_poliza3',cr_poliza4='$cr_poliza4',cr_poliza5='$cr_poliza5',cr_poliza6='$cr_poliza6',cr_poliza7='$cr_poliza7',					vr_poliza1='$vr_poliza1',vr_poliza2='$vr_poliza2',vr_poliza3='$vr_poliza3',vr_poliza4='$vr_poliza4',vr_poliza5='$vr_poliza5',vr_poliza6='$vr_poliza6',vr_poliza7='$vr_poliza7',					fecha_poliza1_d='$fecha_poliza1_d',fecha_poliza2_d='$fecha_poliza2_d',fecha_poliza3_d='$fecha_poliza3_d',fecha_poliza4_d='$fecha_poliza4_d',fecha_poliza5_d='$fecha_poliza5_d',fecha_poliza6_d='$fecha_poliza6_d',fecha_poliza7_d='$fecha_poliza7_d',
					fecha_poliza1_h='$fecha_poliza1_h',fecha_poliza2_h='$fecha_poliza2_h',fecha_poliza3_h='$fecha_poliza3_h',fecha_poliza4_h='$fecha_poliza4_h',fecha_poliza5_h='$fecha_poliza5_h',fecha_poliza6_h='$fecha_poliza6_h',fecha_poliza7_h='$fecha_poliza7_h'
				where id = '$id'
				";
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
										<? echo "<a href='postcontratacion.php?num=$num_contrato' target='_parent' class='sidebar2'>VOLVER</a>"; ?>
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
