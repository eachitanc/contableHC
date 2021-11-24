<?
session_start();
$fecha1 =$_SESSION["fecha"]; 
?>

<html>
<head>
<Title>GCP - CONTRATACIONES</title>
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" /> 
<script>
function dias()
{
 var fecha_ini = document.getElementById('fecha_contrato').value;
 var fecha_fin = document.getElementById('fecha_ter').value; 	
 var f1 = fecha_ini.split("/");
 var ano1 = (f1[0]);
 var mes1 = (f1[1]);
 var dia1 = (f1[2]);
 var f2 = fecha_fin.split("/");
 var ano2 = (f2[0]);
 var mes2 = (f2[1]);
 var dia2 = (f2[2]);	

 fecha1=new Date(ano1,mes1-1,dia1);
 fecha2=new Date(ano2,mes2-1,dia2);
 var resta=((fecha2-fecha1)/1000/3600/24)+1; 
 resta = Math.round(resta);
 document.getElementById('plazo').value= resta;
}

</script>

<style type="text/css"> 
 
<!--
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
-->

.Estilo13 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #990000}
.Estilo4 {	font-family: 
	Verdana, Geneva, Arial, Helvetica, sans-serif; 
	font-size: 12px; 
	color: #333333;
	line-height:12px;
	 }
<style> 
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css"> 

table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 1px; border-color: #004080; }
</style>


</style>
<link rel="pingback" href="http://api.jquery.com/xmlrpc.php">
	
	

  <link rel="stylesheet" type="text/css" href="styles/yepsua/jquery-ui-1.8.2.custom.css">

	<script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script>
	<link rel="shortcut icon" href="http://jquery4php.sourceforge.net/favicon.ico" type="image/x-icon">
	<script type="text/javascript" src="valida.js"></script>


<style type="text/css">
<!--
.Estilo14 {font-size: 14px}
-->
</style>

</head>
<body>


	
	<div id="encabezado">
	<center><br />
	<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
	</center><br />
  	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><br />
	<span class="Estilo13 Estilo14"><strong><B>CONTRATAR</B></strong></span></div>
	</div>

<?php
	$contrato = $_GET['contrato'];
	include('../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	 
	
	$contratos = mysql_query("select * from contrataciones2 where num_contrato ='$contrato'", $cx);
	while ($row_contratos = mysql_fetch_array($contratos))
	{ // primer while
		$num_contrato	=$row_contratos["num_contrato"];
		$id_auto_crpp	=$row_contratos["id_auto_crpp"];
		$num_crpp		=$row_contratos["num_crpp"];
		$fec_registro	=$row_contratos["fec_registro"];
		$clas_contrato 	=$row_contratos["clas_contrato"];
		$modalidad		=$row_contratos["modalidad"]; echo $modalidad;
		$fec_firma 		=$row_contratos["fec_firma"];
		$fec_ter 		=$row_contratos["fecha_terminacion"];
		$objeto			=$row_contratos["objeto"];
		$plazo_contrato =$row_contratos["plazo_contrato"];
		$plazo_unidad	=$row_contratos["plazo_unidad"];
		$cedula_interventor					=$row_contratos["cedula_interventor"];
		$tipo_vinculacion_interventor 		=$row_contratos["tipo_vinculacion_interventor"];
		$valor_inicial 						=$row_contratos["valor_inicial"];
		$bpin			=$row_contratos["bpin"];
		$pago=$row_contratos["pago"];
	
		$registros = mysql_query("select * from crpp where id_auto_crpp ='$id_auto_crpp' group by id_auto_crpp", $cx); 
		while ($row_registros = mysql_fetch_array($registros))
		{
			$id_manu_cdpp	=$row_registros["id_manu_cdpp"];
			$fecha_cdpp 	=$row_registros["fecha_cdpp"];
			$id_manu_crpp 	=$row_registros["id_manu_crpp"];
			$fecha_crpp 	=$row_registros["fecha_crpp"];
			$tercero 		=$row_registros["tercero"];
			$detalle_crpp 	=$row_registros["detalle_crpp"];
			$pago=$row_registros["pago"];
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

?>




<FORM METHOD="post" name="a" id="a"  action="contratar_guarda.php"> 

<table width="800" border="1" align="center" class="bordepunteado1" cellspacing="0" cellpadding="2">
<tr>
    <td colspan="4" bgcolor="#DCE9E5">
	
	
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilox4">
        <div align="center"><strong>INFORMACION GENERAL </strong></div>
      </div>
    </div></td>
    </tr>
  <tr>
    <td width="223"></td>
    <td width="188"></td>
    <td width="179"></td>
    <td width="180"></td>
  </tr>
  
  
  
   <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>NUMERO DE CDPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$id_manu_cdpp);?>        </div>
      </div>
    </div></td>
    </tr>
  
  
     <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>FECHA CDPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$fecha_cdpp);?>        </div>
      </div>
    </div></td>
    </tr>
  
  
  
       <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>NUMERO CRPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$id_manu_crpp);?>        </div>
      </div>
    </div></td>
    </tr>
  
  
  
       <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>FECHA CRPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$fecha_crpp);?>        </div>
      </div>
    </div></td>
    </tr>
  
  
  
       <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>TERCERO : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$tercero);?>        </div>
      </div>
    </div></td>
    </tr>
  
  
  
  
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>DESCRIPCION DEL CRPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$detalle_crpp);?> </div>
      </div>
    </div></td>
    </tr>
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>VALOR DEL CRPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",number_format($valor_inicial,2,",","."));?> </div>
      </div>
    </div></td>
    </tr>
</table>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">

 <tr>
    <td width="221"></td>
    <td width="554"></td>
    <td width="1"></td>
  </tr> 
  
  <tr>
    <td colspan="3" bgcolor="#DCE9E5">
		<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
    	<div align="center" class="Estilo4">
        <div align="center"><strong>FORMULARIO CONTRATACIONES </strong></div>
     	</div>
    	</div>	</td>
</tr>
<?php
$sql = "select * from postcontratacion where num_contrato = '$contrato'";
$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
	if (mysql_num_rows($result) > 0)
	{
		$ver_num="readonly style=background:#CCCCCC";
	}	
?>
 <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="right"><strong>NUMERO DE CONTRATO : </strong></div>
      	</div>
    	</div>	</td>
  	
	<td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left"><input type="text" name="numero_contrato"  id="numero_contrato" size="20" value="<? printf($num_contrato) ?>" <?php echo $ver_num; ?> onBlur="valida_contned();">
  
		<input type="hidden" name="id" value="<? printf($id) ?>" >
        <input type="hidden" name="numero_crpp" value="<? printf($id_manu_crpp) ?>" >
		<input type="hidden" name="valor_contrato" value="<? printf($valor_inicial) ?>">
		<input type="hidden" name="id_auto_crpp" value="<? printf($id_auto_crpp) ?>">
		<div id="respc"></div>
        </div>
     	 </div>
    	</div>	</td>
 </tr>
  
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="center" class="Estilo4">
    	<div align="right"><strong>FECHA DEL CONTRATO : </strong></div>
      	</div>
    	</div>	</td>
	
    <td colspan="2" align="left"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
 		<div id="dialogId">
  		<input id="fecha_contrato"  name="fecha_contrato" size="10" value="<? echo ($fec_registro); ?>"/>
 		<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_contrato,'yyyy/mm/dd',this)" value="Ver Calendario" />
		</div>
		</div>	
	</td>
</tr>

<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
   	   <div align="center" class="Estilo4">
        <div align="right"><strong>MODALIDAD DE SELECCION :</strong></div>
    	</div>
    	</div>
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
		<select  name="modalidad_seleccion" class="Estilo4" size="1">
		<? 
			if ($modalidad =="SAF1")
			{
			echo	"
						<option value='CDF4'>CONTRATACION DIRECTA</option>
						<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
						<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
						<option value='LPF5'>LICITACI�N PUBLICA </option> 
						<option value='OPF8'>MINIMA CUANTIA</option>
						<option value='SAF1' selected>SELECCI�N ABREVIADA </option> 
						
					";
			}
			if ($modalidad =="SAF2")
			{
			echo	"
		<option value='CDF4'>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA</option> 
		
					";
			}
			if ($modalidad =="SAF3")
			{
			echo	"
		<option value='CDF4'>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA </option> 
		
					";
			}
     		if ($modalidad =="CDF4")
			{
			echo    "
		<option value='CDF4' selected>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA</option> 
		
					";
			}
			if ($modalidad =="LPF5")
			{
			echo    "
		<option value='CDF4'>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5' selected>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA</option> 
		
					";
			}
			if ($modalidad =="CMF6")
			{
			echo    "
		<option value='CDF4'>CONTRATACION DIRECTA</option>
   		<option value='CMF6' selected>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA</option> 
		
					";
			}
			if ($modalidad =="CMF7")
			{
			echo    "
		<option value='CDF4'>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7' selected>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA </option> 
		
					";
			}
			if ($modalidad =="OPF8")
			{
			echo    "
		<option value='CDF4'>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS - ABIERTO</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8' selected>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA </option> 
		
					";
			}
			?>
		</select>
		</div>
      	</div>
    	</div>
	</td>
</tr>

<tr>
    <td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="center" class="Estilo4">
    	<div align="right"><strong> CLASE DE CONTRATO : </strong>
		</div>
      	</div>
    	</div>
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
		<select size="1" name="clase_contrato" class="Estilo4">
			<?
			$sq2 ="select * from aux_tipocontrato order by clase asc";
			$rs2 = mysql_db_query($database,$sq2,$cx);
			while ($rw2 = mysql_fetch_array($rs2))
			{
				if ($rw2["clase"] ==$clas_contrato)
				{
					echo "<option selected value='$rw2[clase]'>$rw2[clase]</option> ";
				}else{
					echo "<option value='$rw2[clase]'>$rw2[clase]</option> ";
				}
			}
		?> 
		</select>
		</div>
	    </div>
    	</div>
	</td>
</tr>

<tr>
    <td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      	<div align="center" class="Estilo4">
        <div align="right"><strong>FECHA DE LA FIRMA : </strong>
		</div>
        </div>
		</div>
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      	<div align="center" class="Estilo4">
    	<div align="left">
		<div id="dialogId">
  	  	<input name="fecha_firma" size="10" value="<? echo ($fec_firma); ?>"/>
 		<input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_firma,'yyyy/mm/dd',this)" value="Ver Calendario" />
		</div>
		</div>
     	</div>
   	 	</div>
	</td>
</tr>
  

<tr>
    <td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="center" class="Estilo4">
    	<div align="right"><strong>OBJETO DEL CONTRATO : </strong>
		</div>
     	</div>
    	</div>
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div>
        <div><textarea  name="objeto" cols="80" rows="6" style="font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333;	line-height:12px;"><? printf("%s",$objeto);?></textarea>
		</div>
		</div>
      	</div>
    </td>  
</tr> 
 <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="center" class="Estilo4">
    	    <div align="right"><strong>FECHA TERMINACI�N : </strong></div>
     	 </div>
    	</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left">
       	  <input name="fecha_ter" id="fecha_ter" size="10" value="<?php echo $fec_ter; ?> " class="Estilo4" onChange="dias();"/>
    	  <input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_ter,'yyyy/mm/dd',this)" value="Ver Calendario"  />
      		</div>
    		</div></div>	</td>
 </tr>

<tr>
    <td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="center" class="Estilo4">
    	<div align="right"><strong>PLAZO DE CONTRATO : </strong>
		</div>
     	</div>
    	</div>
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
		<input type="text" name="plazo" id="plazo" size="10" value="<? printf($plazo_contrato) ?>" >
     	<select  name="plazo_unidad" size="1" >
				<? 
			
			if ($plazo_unidad =="D")
			{
				echo "<option value='D' selected>DIAS</option> 
					";
			}
			?>
      	</select>
		</div>
		</div>
    	</div>
	</td>
</tr>
  
<tr>
    <td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="center" class="Estilo4">
    	<div align="right"><strong>NOMBRE DEL INTERVENTOR : </strong>
		</div>
     	</div>
    	</div>	
	</td>
	<td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
			
			
			<? //Busco todos los terceros en las tablas naturales y juridicos donde el camp�r interventor este marcado y los unifico en un solo row
			 $x1i ="(SELECT raz_soc2 as nombre, num_id2 as numero FROM terceros_juridicos WHERE interventor ='SI') UNION ALL
			(SELECT CONCAT(pri_ape, ' ',seg_ape,' ',pri_nom,' ',seg_nom) as nombre, num_id as numero FROM terceros_naturales WHERE interventor ='SI')";	
			$rsg = mysql_query($x1i);
			?>
		
			<select  name="cedula_interventor" size="1" >
			<option value="">
			</option> 
				<?
				  	while ($rowg = mysql_fetch_assoc($rsg))															// Asigna a la variable todos los terceros interventores encontrados
				 	{ 
				 		if ($cedula_interventor == $rowg["numero"])													// Busco cual de los interventores es el asociado al registro actual
						{
							echo '<option value= '.$rowg["numero"].' selected>'.$rowg["nombre"].'</option>';		// cuando el sistema lo encuentra marca el campor como selected 
						}
						else
						{
							echo '<option value= '.$rowg["numero"].'>'.$rowg["nombre"].'</option>';					// si es otro tercero simplemente lo lista sin seleccionarlo 
						}						
					}
				 ?>
			 </select>
        
		</div>
      	</div>
    	</div>
	</td>
</tr>
  
<tr>
	<td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="right"><strong>TIPO DE VINCULACION DEL INTERVENTOR : </strong>
		</div>
      	</div>
    	</div>
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
		<select  name="tipo_vinculacion" size="1">
			<?
			if ($tipo_vinculacion_interventor =="")
			{ 
				echo "<option value=''  selected></option> 
					  <option value='I'>INTERNA</option> 
			  		  <option value='E'>EXTERNA</option> 
					  <option value='ND'>ND</option> 
				";
			}
			if ($tipo_vinculacion_interventor =="I")
			{ 
				echo "<option value=''></option> 
					  <option value='I'  selected>INTERNA</option> 
			  		  <option value='E'>EXTERNA</option> 
					  <option value='ND'>ND</option> 
				";
			}
			if ($tipo_vinculacion_interventor =="E")
			{ 
				echo "<option value=''></option> 
					  <option value='I'>INTERNA</option> 
			  		  <option value='E' selected>EXTERNA</option> 
					  <option value='ND'>ND</option> 
				";
			}
			if ($tipo_vinculacion_interventor =="ND")
			{ 
				echo "<option value=''></option> 
					  <option value='I'>INTERNA</option> 
			  		  <option value='E'>EXTERNA</option> 
					  <option value='ND' selected>ND</option> 
				";
			}
			?>
		</select>
		</div>
    	</div>
    	</div>
	</td>
</tr>
<tr>
	<td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	 <div align="center" class="Estilo4">
        <div align="right"><strong>FORMA DE PAGO  : </strong></div>
      	</div>
    	</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left">
			<select  name="forma_pago" size="1" class="Estilo4"> 
			<?
			$cl_pago =array("ANTICIPO","PAGOS PARCIALES","PAGO TOTAL");
			$i=0;
			for ($i=0;$i<=2;$i++)
			{
				if ($pago ==$cl_pago[$i])
				{
					echo "<option selected value='$cl_pago[$i]'>$cl_pago[$i]</option>";
				}else{
					echo "<option value='$cl_pago[$i]'>$cl_pago[$i]</option> ";
				}
			}
			
			if ($pago =='PAGO TOTAL')
			{
				$ver_num_pag = "style='display:none'";
				$ver_por_ant = "style='display:none'";
			}
			
			if ($pago =='PAGOS PARCIALES')
			{
				$ver_por_ant = "style='display:none'";
			}
			if ($pago =='ANTICIPO')
			{
				$ver_num_pag = "style='display:none'";
			}
		?> 
			</select>
				<strong <?php echo $ver_num_pag; ?> >
				&nbsp;&nbsp;&nbsp;Numero de Pagos:
				<input type="text" name="num_pagos" id="num_pagos" size="3" class="Estilo4" style="text-align:center" >
				</strong>
				<strong <?php echo $ver_por_ant; ?>>
				&nbsp;&nbsp;&nbsp;Valor Anticipo:
				<input type="text" name="val_anticipo" id="val_anticipo" size="15" class="Estilo4" style="text-align:right" >
				</strong>
			</div>
      		</div>
    		</div>	</td>
  </tr>
   <tr>
	<td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	 <div align="center" class="Estilo4">
        <div align="right"><strong>CODIGO BPIN  : </strong></div>
      	</div>
    	</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left">
			<input type="text" name="bpin" id="bpin" size="20" class="Estilo4" value="<?php echo $bpin; ?>"  >
			</div>
      		</div>
    		</div>	</td>
  </tr>
<tr>
    <td bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="right"><span class="Estilo4"><strong></strong> </span>
		</div>
   		</div>	
	</td>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        </div>
	</td>
</tr>
</table>
		<? 
		echo '<script languaje="JavaScript">
				var fecha_crpp="'.$fecha_crpp.'";
			</script>';

		?>
<br>
<table border="0" align="center">
<tr>
	<td>
		<input name="send" type="submit" id="enviar" value="Enviar" onClick="return validar(fecha_crpp)"/>
		</form>
	</td>
	<td>
		<form action="index.php" method="post" target="_self" >
		<!--<input name="fecha" type="hidden" value="<? printf($fecha); ?>" />
		<input name="fecha2" type="hidden" value="<? printf($fecha2); ?>" />
		<input name="pendiente" type="hidden" value="<? printf($pendiente); ?>" />
		<input name="registrado" type="hidden" value="<? printf($registrado); ?>" />-->
		<input type="submit" value="Volver" />
		</form> 
	</td>
</tr>
</table>

<div id="piedepag">
	<img src="imagenes/q.png"  />
</div>

</body> 
</html> 

