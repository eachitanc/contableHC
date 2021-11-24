<?
session_start();
$fecha1 =$_SESSION["fecha"]; 
?>

<html>
<head>
<Title>GCP - CONTRATACIONES</title>
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<link rel="stylesheet" type="text/css" href="css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->

<style type="text/css">
<!--
.Estilo9 {
	color: #006699;
	font-size: 12px;
}
-->
</style>
</head>
<body>

	
	<div id="encabezado">
		<center><br /><br />
			<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
			<br />
  			<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><br />
			<span class="titlelista"><strong><B>SEGUIMINETO ETAPA POSTCONTRACTUAL</B></strong></span>
			</div>
		</center><br />
	</div>

<?php

	// Consulto la base para obtener toda la informacion del contrato recibido
	$num_contrato = $_GET['num'];
	include('../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	 
	
	$contratos = mysql_query("select * from contrataciones2 where num_contrato ='$num_contrato'", $cx);
	while ($row_contratos = mysql_fetch_array($contratos))
	{ // primer while
		$num_contrato	=$row_contratos["num_contrato"];
		$id_auto_crpp	=$row_contratos["id_auto_crpp"];
		$num_crpp		=$row_contratos["num_crpp"];
		$fec_registro	=$row_contratos["fec_registro"];
		$clas_contrato 	=$row_contratos["clas_contrato"];
		$modalidad		=$row_contratos["modalidad"];
		$fec_firma 		=$row_contratos["fec_firma"];
		$objeto			=$row_contratos["objeto"];
		$plazo_contrato =$row_contratos["plazo_contrato"];
		$plazo_unidad	=$row_contratos["plazo_unidad"];
		$cedula_interventor					=$row_contratos["cedula_interventor"];
		$tipo_vinculacion_interventor 		=$row_contratos["tipo_vinculacion_interventor"];
		$valor_inicial 						=$row_contratos["valor_inicial"];
		
		
	
		$registros = mysql_query("select * from crpp where id_auto_crpp ='$id_auto_crpp' group by id_auto_crpp", $cx); 
		while ($row_registros = mysql_fetch_array($registros))
		{
			$id_manu_cdpp	=$row_registros["id_manu_cdpp"];
			$fecha_cdpp 	=$row_registros["fecha_cdpp"];
			$id_manu_crpp 	=$row_registros["id_manu_crpp"];
			$fecha_crpp 	=$row_registros["fecha_crpp"];
			$tercero 		=$row_registros["tercero"];
			$detalle_crpp 	=$row_registros["detalle_crpp"];
			
		}
		
		
	} // end primer while
	
	
	// consulto la tabla de terceros juridocos buscando el documento del interventor y tomo el nombre en la variable interventor
			
		$juridicos = mysql_query("select raz_soc2,num_id2 FROM terceros_juridicos WHERE num_id2 ='$cedula_interventor'", $cx);
		if (!$juridicos) 
		{
				echo ("Error al seleccionar los elementos de la tabla juridicos, Int�ntelo m�s tarde");
		}
		if ($juridicos) 
		{
				while ($row_j = mysql_fetch_row($juridicos))
				{
					$interventor = $row_j[0];
				}
		}
	
		$natura =mysql_query("select CONCAT(pri_ape, ' ',seg_ape,' ',pri_nom,' ',seg_nom) as nombre, num_id  FROM terceros_naturales WHERE num_id ='$cedula_interventor'",$cx);
		if (!$natura) 
		{
			echo ("Error al seleccionar los elementos de la tabla naturales, Int�ntelo m�s tarde");
		}
		if ($natura)
		{
			while ($row_natura = mysql_fetch_row($natura))
			{
				$interventor = $row_natura[0];
			}
		}
	   	
		
	
// Variables que paso a javascript para validar las fechas 
$fecha_c=$fecha_cdpp;
echo '<script languaje="JavaScript">
     		 var fecha_cdp="'.$fecha_c.'";
	  		 var fecha_crp="'.$fecha_crpp.'";
      </script>';


	// Realizo equivalencias de acuerdo a la modalidad seleccionada para mostrar en pantalla
			if ($modalidad =="SAF1")
			{
				$modalidad2 = "SELECCI�N ABREVIADA - MENOR CUANT�A"; 					
			}
			if ($modalidad =="SAF2")
			{
				$modalidad2 = "SELECCI�N ABREVIADA - CARACTER�STICAS T�CNICAS UNIFORMES"; 
			}
			if ($modalidad =="SAF3")
			{
				$modalidad2 = "SELECCI�N ABREVIADA - HASTA 10% DE LA MENOR CUANT�A"; 
			}
     		if ($modalidad =="CDF4")
			{
				$modalidad2 = "CONTRATACION DIRECTA"; 
			}
			if ($modalidad =="LPF5")
			{
				$modalidad2 = "LICITACI�N PUBLICA"; 
			}
			if ($modalidad =="CMF6")
			{
				$modalidad2 = "CONCURSO DE M�RITOS - HASTA 10% DE LA MENOR CUANT�A"; 
			}
			if ($modalidad =="CMF7")
			{
				$modalidad2 = "CONCURSO DE M�RITOS"; 
			}
			if ($modalidad =="OPF8")
			{
				$modalidad2 = "OTRO PROCEDIMIENTO"; 
			}
		// Realizo convwersion de la variable de acuerdo a unidad de plazo seleccionada	

			if ($plazo_unidad =="A")
			{
				$plazo_unidad2 = "A�O"; 
			}
			if ($plazo_unidad =="M")
			{
				$plazo_unidad2 = "MES(ES)"; 
			}
			if ($plazo_unidad =="M")
			{
				$plazo_unidad2 = "DIA(S)"; 
			}
			
		// Realizon conversion de variables de aucerdo al tipo de auditor�a seleccionada
			
			if ($tipo_vinculacion_interventor =="E")
			{
				$tipo_vinculacion_interventor2 = "EXTERNA";
			}
			if ($tipo_vinculacion_interventor =="I")
			{
				$tipo_vinculacion_interventor2 = "INTERNA";  
			}

	
		// consulto la tabla de terceros juridocos buscando el documento del interventor y tomo el nombre en la variable interventor
		
			
		$juridicos = mysql_query("select raz_soc2,num_id2 FROM terceros_juridicos WHERE num_id2 ='$cedula_interventor'", $cx);
		if (!$juridicos) 
		{
				echo ("Error al seleccionar los elementos de la tabla juridicos, Int�ntelo m�s tarde");
		}
		if ($juridicos) 
		{
				while ($row_j = mysql_fetch_row($juridicos))
				{
					$interventor = $row_j[0];
				}
		}
	
		$natura =mysql_query("select CONCAT(pri_ape, ' ',seg_ape,' ',pri_nom,' ',seg_nom) as nombre, num_id  FROM terceros_naturales WHERE num_id ='$cedula_interventor'",$cx);
		if (!$natura) 
		{
			echo ("Error al seleccionar los elementos de la tabla naturales, Int�ntelo m�s tarde");
		}
		if ($natura)
		{
			while ($row_natura = mysql_fetch_row($natura))
			{
				$interventor = $row_natura[0];
			}
		}
	   	


?>

<!-- Presento la informaci�n presupuestal del contrato -->

<table border="1" align="center" cellpadding="2" cellspacing="0" class="bordepunteado1" width="70%">
<tr>
	<td colspan="4" class="Titulotd" align="center">
			INFORMACION PRESUPUESTAL
	</td>
</tr>

<tr>
	<td width="23%"  class="Titulotd">
			NUMERO CDPP :	</td>
	<td width="28%"  class="Estilo4">
			<? printf("%s",$id_manu_cdpp);?>	</td>
	<td width="21%"  class="Titulotd">
			FECHA CDP :	</td>
	<td width="28%"  class="Estilo4">
			<? printf("%s",$fecha_cdpp);?>	</td>
</tr>
<tr>
	<td  class="Titulotd">
			NUMERO CRPP :
	</td>
	<td  class="Estilo4">
			<? printf("%s",$id_manu_crpp);?>
	</td>
	<td  class="Titulotd">
			FECHA CRPP :
	</td>
	<td  class="Estilo4">
			<? printf("%s",$fecha_crpp);?>
	</td>
</tr>

<tr>
	<td  class="Titulotd">
			TERCERO :
	</td>
	<td  class="Estilo4" colspan="3">
			<? printf("%s",$tercero);?>
	</td>
	
</tr>

<tr>
	<td  class="Titulotd">
			CONCEPTO CRPP :
	</td>
	<td  class="Estilo4" colspan="3">
		  <? printf("%s",$detalle_crpp);?>
</td>

<tr>
	<td  class="Titulotd">
			VALOR CRPP :
	</td>
	<td  class="Estilo4" colspan="3">
			 <? printf("%s",number_format($valor_inicial,2,",","."));?>
	</td>
	
</tr>
</table>
<br>
<table border="1" align="center" cellpadding="2" cellspacing="0" class="bordepunteado1" width="70%">
<tr>
	<td colspan="4" class="Titulotd" align="center">
			INFORMACION CONTRACTUAL
	</td>
</tr>

<tr>
	<td width="23%"  class="Titulotd">
			NUMERO CONTRATO :	</td>
	<td width="28%"  class="Estilo4">
			<? printf("%s",$num_contrato);?>	</td>
	<td width="21%"  class="Titulotd">
			FECHA CONTRATO :	</td>
	<td width="28%"  class="Estilo4">
			<? printf("%s",$fec_registro);?>	</td>
</tr>
<tr>
	<td  class="Titulotd">
			MODALIDAD :
	</td>
	<td  class="Estilo4">
			<? printf("%s",$modalidad2);?>
	</td>
	<td  class="Titulotd">
			CLASE :
	</td>
	<td  class="Estilo4">
			<? printf("%s",strtoupper($clas_contrato));?>
	</td>
</tr>

<tr>
	<td  class="Titulotd">
			OBJETO :
	</td>
	<td  class="Estilo4" colspan="3">
			<? printf("%s",$objeto);?>
	</td>
	
</tr>

<tr>
<td  class="Titulotd">
			PLAZO :
	</td>
	<td  class="Estilo4">
			<? printf("%s",$plazo_contrato ." ". $plazo_unidad2);?>
</td>
<td  class="Titulotd">
			FECHA FIRMA :
	</td>
	<td  class="Estilo4">
			<? printf("%s",$fec_firma);?>
	</td>
</tr>

<tr>
	<td  class="Titulotd">
			INTERVENTORIA :
	</td>
	<td  class="Estilo4" colspan="3">
			<? printf("%s",$interventor);?>
	</td>
</tr>
<tr>
	<td  class="Titulotd">
			MODALIDAD :
	</td>
	<td  class="Estilo4" colspan="3">
			<? printf("%s",$tipo_vinculacion_interventor2);?>
	</td>
</tr>
</table>
<br>

<!-- Tabla que muestra el menu de selecci�n para agragar evento postcontractual -->

<table border="0" align="center" cellpadding="0" cellspacing="0"  width="70%">
<form name="postcontracion" action="postcontratacion_evento.php" method="post">
<tr bgcolor="#E8E8E8">
	<td width="22%" class="Estilo9">
	Seleccione la acci�n : </td>
	
	<td width="78%"  align="left"  class="Estilo4">
			
			<select name="procedimiento" class="Estilo4" >
			<option value="CONSTITUCION GARANTIAS" selected>CONSTITUCION GARANTIAS</option>
			<option value="ACTA DE INICIO">ACTA DE INICIO</option>
			<option value="ADICION O PRORROGA">ADICION O PRORROGA</option>
			<option value="MODIFICACION">MODIFICACION</option>
			<option value="ACLARACION">ACLARACION</option>
			<option value="SUSPENCION">SUSPENCION</option>
			<option value="INFORME INTERVENTORIA">INFORME INTERVENTORIA</option>
			<option value="LIQUIDACION">LIQUIDACION</option>
			</select>
			<input name="num_contrato" type="hidden" value="<? printf("%s",$num_contrato);?>"> 
	  <input name="send" class="Estilo4" type="submit" id="enviar" value="Agregar"/>	</td>
			
</tr>
</form>
</table>

<!-- Tabla que me muestra todos las acciones post contractuales asociadas al contrato recibido -->
<?
			include('../config.php');		
			$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
			
			$sql = "select * from postcontratacion where num_contrato = '$num_contrato'";
			$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{		

}
else
{
		?>
			
		<table border="1" align="center" cellpadding="2" cellspacing="0" class="bordepunteado1" width="70%">
		<tr>
			<td colspan="7" class="Titulotd" align="center">
					INFORMACION POSTCONTRACTUAL			</td>
		</tr>
		
		<tr align="center">
			<td width="20%" class="Titulotd">
				PROCEDIMIENTO	</td>
			
			<td width="9%" class="Titulotd">
				FECHA	</td>
			
			<td width="11%" class="Titulotd">
				DOCUMENTO	</td>
			
			<td width="48%" class="Titulotd" colspan="4">
				DESCRIPCION	</td>
					
		  </tr>
		<?
			
			while ($row3 = mysql_fetch_array($result))
			{
				$procedimientos = $row3["procedimientos"]; 
				$fecha_acto = $row3["fecha_acto"];
				$descripcion = $row3["descripcion"]; 
				$num_acto = $row3["num_acto"];
				$id = $row3["id"];
				?>

				<tr >
					<td width="20%" class="Estilo4">
						<? printf("%s",$procedimientos);?>					</td>
					
					<td width="9%" class="Estilo4">
						<? printf("%s",$fecha_acto);?>					</td>
					
					<td width="11%" class="Estilo4">
						<? printf("%s",$num_acto);?>					</td>
					
					<td width="48%" class="Estilo4">
						<? printf("%s",$descripcion);?>					</td>
					
					<td width="4%" class="Titulotd">
						<?php echo "<a href='postcontratacion_elimina.php?id=$id&num=$num_contrato' onclick=\"if(!confirm('�Esta seguro de borrar el Acto registrado?'))return false\"><img src='imagenes/eliminar.png' width='20px' alt='Eliminar' border='0'></a>";	 ?>		
					</td>
					
					<td width="4%" class="Titulotd">
						<?php echo "<a href='postcontratacion_modifica.php?id=$id&num=$num_contrato&proc=$procedimientos'><img src='imagenes/modificar.png' width='20px' alt='Editar' border='0'></a>"; ?>		
					</td>
					
					<td width="4%" class="Titulotd">
     					<?php echo "<a href='../contratacion_doc/generar_archivo_post.php?cont=$num_contrato&proc=$procedimientos&id=$id'><img src='imagenes/reporte2.jpg' width='20px' alt='Imprimir' border='0'></a>"; ?>					
					</td>
				</tr>

			<?
			} // END WHILE
			?>
</table>
<?
} // END ELSE
?>
<br>
<br>

			<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='index.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>



<div id="piedepag">
	<img src="imagenes/q.png"  />
</div>

</body> 
</html> 

