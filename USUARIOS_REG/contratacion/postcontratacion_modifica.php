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

<script type="text/javascript" src="valida.js"></script>
<style type="text/css">
<!--
.Estilo8 {
	color: #0000CC;
	font-weight: bold;
}
-->
</style>
</head>
<body>

	
	<div id="encabezado">
		<center>
			<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
			<br />
  			<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><br />
			<span class="titlelista"><strong><B>SEGUIMINETO ETAPA POSTCONTRACTUAL</B></strong></span>
			</div>
		</center><br />
	</div>

<?php
	
	// Obtengo las variables enviadas del contrato a modificar 
	$procedimiento=$_GET["proc"]; 
	$num_contrato=$_GET["num"];
	$id = $_GET["id"];   
	// Consulto la base para obtener toda la informacion del contrato recibido
	include('../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	 
	$contratos = mysql_query("select * from contrataciones2 where num_contrato ='$num_contrato'", $cx);
	while ($row_contratos = mysql_fetch_array($contratos))
	{ // primer while
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
		// Asigno valor de la variable de acuerodo a la modalidad selecionada
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
		
		// asigno variables para la modalidad de interventoria
		
		if ($tipo_vinculacion_interventor =="E")
		{
			$tipo_vinculacion_interventor2 = "EXTERNA";
		}
		if ($tipo_vinculacion_interventor =="I")
		{
			$tipo_vinculacion_interventor2 = "INTERNA";
		}			
// Variables que paso a javascript para validar las fechas 
$fecha_c=$fecha_cdpp;
echo '<script languaje="JavaScript">
     		 var fecha_cdp="'.$fecha_c.'";
	  		 var fecha_crp="'.$fecha_crpp.'";
      </script>';
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
	   	
	// selecciono opciones de formulario seg�n procedimiento seleccionado
	
	if ($procedimiento =="CONSTITUCION GARANTIAS")
	{
	
		$ver_adicion="none";
		$ver_prorroga ="none";
		$ver_garantias ="";
		$ver_interventoria="none";
		$ver_liquidacion="none";
		$funcion_valida = "return validar_garantia()";
	}		
	
	if ($procedimiento =="ADICION O PRORROGA")
	{
	
		$ver_adicion="";
		$ver_prorroga ="";
		$ver_garantias ="none";
		$ver_interventoria="none";
		$ver_liquidacion="none";
		$funcion_valida = "return validar_adicion()";
	}	
	
	if ($procedimiento =="INFORME INTERVENTORIA")
	{
	
		$ver_adicion="none";
		$ver_prorroga ="none";
		$ver_garantias ="none";
		$ver_interventoria="";
		$ver_liquidacion="none";
		$funcion_valida = "return validar_interventoria()";
	}	
	if ($procedimiento =="LIQUIDACION")
	{
	
		$ver_adicion="none";
		$ver_prorroga ="none";
		$ver_garantias ="none";
		$ver_interventoria="none";
		$ver_liquidacion="";
		$funcion_valida = "return validar_liquidacion()";
	}	
	
	if (($procedimiento =="ACTA DE INICIO") or ($procedimiento =="MODIFICACION") or ($procedimiento =="ACLARACION") or ($procedimiento =="SUSPENCION"))
	{
	
		$ver_adicion="none";
		$ver_prorroga ="none";
		$ver_garantias ="none";
		$ver_interventoria="none";
		$ver_liquidacion="none";
		$funcion_valida = "return validar_todas()";
	}	
	
	

?>

<!-- Presento la informaci�n presupuestal del contrato -->

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
			TERCERO :
	</td>
	<td  class="Estilo4" colspan="3">
			<? printf("%s",$tercero);?>
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
<tr>
	<td  class="Titulotd">
			VALOR :
	</td>
	<td  class="Estilo4" colspan="3">
			<? printf("%s",number_format($valor_inicial,2,",","."));?>
	</td>
</tr>
</table>
<br>
<?php 
$res =mysql_db_query($database,"select * from postcontratacion where id ='$id'",$cx);
$row = mysql_fetch_array($res);
$numacto = explode("-", $row["num_acto"]);
$acto = $numacto[0];
$numero = $numacto[1];  
$compa =$row["compania_poliza"];
$id =$row["id"];
?>


<table border="1" align="center" cellpadding="0" cellspacing="0" class="bordepunteado1" width="70%">
<form name="procedimientos" method="post" action="postcontratacion_guarda.php">
<tr>
	<td colspan="4" class="Titulotd" align="center">
			<? printf("%s",$procedimiento);?>
			<input type="hidden" name="procedimientos" value="<? printf("%s",$procedimiento);?>">
            <input type="hidden" name="id" value="<? printf("%s",$id);?>">
			<input type="hidden" name="num_contrato" value="<? printf("%s",$num_contrato);?>">	</td>
</tr>

<tr>
	<td  class="Titulofor">
			No. ACTO ADMIN/DOC :	</td>
	<td  class="Estilo4">
			<select  name="tipo_acto" size="1" class="Estilo4" onChange="valida_numero()">
				<?php 
					$tip_acto = array("RESOLUCION","ACTA","DECRETO","OTRO");
					$i=0;
					for ($i=0;$i<=3;$i++)
					{
						if ($acto == $tip_acto[$i])
						{
							echo "<option value=$tip_acto[$i] selected>$tip_acto[$i]</option>";
						}else{
							echo "<option value=$tip_acto[$i]>$tip_acto[$i]</option>";
						}
					
					}
				?>	
			</select>
			<input name="acto" type="text" size="10" class="Estilo4" value="<?php echo $numero; ?>" onKeyUp="valida_numero()"><div class="Estilo4" align="center" id='resp'></div>
				</td>
	<td  class="Titulofor">
			FECHA ACTO :	</td>
	<td  class="Estilo4">
			<input name="fecha_acto" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_acto]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_acto,'yyyy/mm/dd',this)" value="Ver Calendario" />	</td>
</tr>

<tr>
	<td  class="Titulofor" >
			DESCRIPCION :	</td>
	<td  class="Estilo4" colspan="3">
			<input name="descripcion" type="text" size="113" class="Estilo4" value="<?php echo $row[descripcion]; ?>">	</td>
</tr>

<!-- Campos para procedimiento ADICION -->
<tr style="display:<? echo ($ver_adicion); ?> ">
	<td  class="Titulofor">
			NUMERO CRPP :	</td>
	<td  class="Estilo4">
			<select  name="id_manu_crpp" size="1" class="Estilo4" onChange="busca_valor()">
			<option value="<?php echo $row[id_manu_crpp]; ?>"><?php echo $row[id_manu_crpp]; ?></option>
			<?
			$adiciones = mysql_query("select id_manu_crpp from crpp where tercero = '$tercero' and adicion ='SI'", $cx);
			while ($row_adiciones = mysql_fetch_array($adiciones))
			{ // primer while
			
						// Asigna a la variable todos los terceros interventores encontrados
			 
				 		
					echo '<option value= '.$row_adiciones["id_manu_crpp"].'>'.$row_adiciones["id_manu_crpp"].'</option>';	// si es otro tercero simplemente lo lista sin seleccionarlo 
						
					}
			?>
			</select>
			
	</td>
	<td  class="Titulofor">
			VALOR ADICION :	</td>
	<td  class="Estilo4">
			<input name="valor_adicion" type="text" size="20" class="Estilo4" style="text-align:right" value="<?php echo $row[valor_adicion]; ?>">	</td>
</tr>


<!-- Campos para procedimiento PRORROGA -->
<tr style="display:<? echo ($ver_prorroga); ?> ">
	<td  class="Titulofor">
			PLAZO :	</td>
	<td  class="Estilo4">
			<input name="plazo_numero" type="text" size="8" class="Estilo4" value="<?php echo $row[plazo_numero]; ?>">	</td>
	<td  class="Titulofor">
			UNIDAD :	</td>
	<td  class="Estilo4">
	
			<select  name="plazo_unidad" size="1" class="Estilo4">
			<option value="D">DIAS</option>
			</select>	</td>
</tr>

<!-- Campos para procedimiento GARANTIAS -->
<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor">
			NUMERO DE POLIZA :	</td>
	<td  class="Estilo4">
			<input name="numero_poliza" type="text" size="20" class="Estilo4" value="<?php echo $row[numero_poliza]; ?>">	</td>

	<td  class="Titulofor">
			FECHA DE POLIZA :	</td>
	<td  class="Estilo4">
			<input name="fecha_poliza" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>	
<tr  style="display:<? echo ($ver_garantias); ?> ">	
	<td  class="Titulofor" >
			ASEGURADORA :	</td>
	<td  class="Estilo4" colspan="3">
			<select name="aseguradora"  class="Estilo4">
				<?php 
				
					$aseg = array("","ACE SEGUROS S.A","CHARTIS S.A","ASEGURADORA COLSEGUROS S.A.", "ASEGURADORA SOLIDARIA DE COLOMBIA LTDA. ENTIDAD COOPERATIVA","BBVA SEGUROS COLOMBIA S.A.","CONDOR S.A. COMPA��A DE SEGUROS GENERALES","COMPA��A MUNDIAL DE SEGUROS S.A","SEGUROS GENERALES SURAMERICANA S.A.","CHUBB DE COLOMBIA COMPA��A DE SEGUROS S.A.","GENERALI COLOMBIA SEGUROS GENERALES S.A.","LA PREVISORA S.A. COMPA��A DE SEGUROS","LIBERTY SEGUROS S.A.","SEGUROS ALFA S.A.","SEGUROS DEL ESTADO S.A.","COMPA�IA ASEGURADORA DE FINANZAS S.A. CONFIANZA","OTRA");
					$i=0;
					for ($i=0;$i<=16;$i++)
					{
						if ($compa == 'AS'.$i)
						{
							echo "<option value=AS$i selected>$aseg[$i]</option>";
						}else{
							echo "<option value=AS$i>$aseg[$i]</option>";
						}
					
					}
				?>
			</select>	</td>
</tr>


<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulotd" colspan="4" align="center">
			TIPO DE GARANTIAS	</td>
</tr>

<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
			AMPAROS	</td>
	<td  class="Titulofor" align="center">
			VALOR ASEGURADO	</td>
	<td  class="Titulofor" align="center">
			VIGENCIA	</td>
</tr>
<?php 
if ($row[cr_poliza1] ==1)
{
	$ck1 ="checked";
}
?>
<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
			<input name="cr_poliza1" type="checkbox" value="1" <?php echo $ck1; ?>/>
			GARANTIA DE SERIEDAD DE LA OFERTA	</td>
	<td  class="Titulofor" align="center">
			
			<input name="vr_poliza1" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza1]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza1_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza1_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza1_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza1_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza1_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza1_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>
<?php 
if ($row[cr_poliza2] ==1)
{
	$ck2 ="checked";
}
?>

<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
<input name="cr_poliza2" type="checkbox" value="1" <?php echo $ck2; ?> />			
CUMPLIMIENTO DEL CONTRATO	</td>
	<td  class="Titulofor" align="center">
			<input name="vr_poliza2" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza2]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza2_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza2_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza2_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza2_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza2_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza2_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>
<?php 
if ($row[cr_poliza3] ==1)
{
	$ck3 ="checked";
}
?>
<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
<input name="cr_poliza3" type="checkbox" value="1" <?php echo $ck3; ?>/>			
BUEN MANEJO E INVERSI�N DEL ANTICIPO	</td>
	<td  class="Titulofor" align="center">
			<input name="vr_poliza3" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza3]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza3_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza3_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza3_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza3_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza3_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza3_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>
<?php 
if ($row[cr_poliza4] ==1)
{
	$ck4 ="checked";
}
?>

<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
			<input name="cr_poliza4" type="checkbox" value="1" <?php echo $ck4; ?> />
			SALARIOS Y PRESTACIONES SOCIALES	</td>
	<td  class="Titulofor" align="center">
			<input name="vr_poliza4" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza4]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza4_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza4_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza4_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza4_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza4_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza4_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>
<?php 
if ($row[cr_poliza5] ==1)
{
	$ck5 ="checked";
}
?>

<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
			<input name="cr_poliza5" type="checkbox" value="1" <?php echo $ck5; ?> />
			CALIDAD DEL BIEN O SERVICIO	</td>
	<td  class="Titulofor" align="center">
			<input name="vr_poliza5" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza5]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza5_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza5_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza5_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza5_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza5_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza5_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>
<?php 
if ($row[cr_poliza6] ==1)
{
	$ck6 ="checked";
}
?>
<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
<input name="cr_poliza6" type="checkbox" value="1" <?php echo $ck6; ?>/>			
ESTABILIDAD DE LA OBRA	</td>
	<td  class="Titulofor" align="center">
			<input name="vr_poliza6" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza6]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza6_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza6_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza6_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza6_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza6_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza6_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>
<?php 
if ($row[cr_poliza7] ==1)
{
	$ck7 ="checked";
}
?>
<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
			<input name="cr_poliza7" type="checkbox" value="1" <?php echo $ck7; ?> />
			OTRO AMPARO	</td>
	<td  class="Titulofor" align="center">
			<input name="vr_poliza7" type="text" size="15" style="text-align:right" value="<?php echo $row[vr_poliza7]; ?>">	</td>
	<td  class="Titulofor" align="center">
			<input name="fecha_poliza7_d" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza7_d]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza7_d,'yyyy/mm/dd',this)" value="Desde" />&nbsp;&nbsp;
			<input name="fecha_poliza7_h" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_poliza7_h]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_poliza7_h,'yyyy/mm/dd',this)" value="Hasta" />	</td>
</tr>

<tr style="display:<? echo ($ver_garantias); ?> ">
	<td  class="Titulofor" colspan="2">
			�CUAL?	</td>
	<td  class="Titulofor" align="left" colspan="2">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="otro_amparo" type="text" size="80" value="<?php echo $row[fecha_poliza1_h]; ?>">	</td>
</tr>


<!-- Campos para procedimiento INTERVENTORIA -->
<tr style="display:<? echo ($ver_interventoria); ?> ">
	<td  class="Titulofor">
			TIPO ACTA INTERVENTORIA :	</td>
	<td  class="Estilo4" colspan="3">
			<select name="tipo_acta_interventoria" class="Estilo4">
				<?php 
					$tip_interv = array("","PARCIAL","FINAL","OTRO");
					$i=0;
					for ($i=0;$i<=3;$i++)
					{
						if ($row[tipo_acta_interventoria] == $tip_interv[$i])
						{
							echo "<option value=$tip_interv[$i] selected>$tip_interv[$i]</option>";
						}else{
							echo "<option value=$tip_interv[$i]>$tip_interv[$i]</option>";
						}
					
					}
				?>	
				
			</select>
			
	</td>
</tr>

<!-- Campos para procedimiento LIQUIDACION -->
<tr style="display:<? echo ($ver_liquidacion); ?> ">
	<td  class="Titulofor" colspan="2">
			FECHA DE TERMINACION DEL CONTRATO :	</td>
	<td  class="Estilo4" colspan="2">
			<input name="fecha_termina" type="text" size="12" class="Estilo4" value="<?php echo $row[fecha_terminacion]; ?>">
			<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_termina,'yyyy/mm/dd',this)" value="Ver Calendario" />	</td>
</tr>

<tr>
	<td  class="Titulofor">
			OBSERVACIONES :	</td>
	<td  class="Estilo4" colspan="3">
			<textarea  name="observaciones" cols="115" rows="6" style="font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333;	line-height:12px;"><?php echo $row[observaciones]; ?></textarea>	</td>
</tr>

<tr>
	<td colspan="4" class="Titulotd" align="center">
			<input type="submit" class="Estilo4" value="Guardar" onClick=" <? echo "$funcion_valida"; ?>">	</td>
</tr>
</form>
</table>

<br>
<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"> <? echo "<a href='postcontratacion.php?num=$num_contrato' target='_parent' class='sidebar2'>VOLVER</a>"; ?>
				 		</div>
		        	</div>
        	    </div>      
</div>

<div id="piedepag">
	<img src="imagenes/q.png"  />
</div>

</body> 
</html> 

