<?
session_start();
$fecha1 =$_SESSION["fecha"]; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<Title>GCP - CONTRATACIONES</title>
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" /> 
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
	font-size: 11px; 
	color: #333333;
	line-height:11px;
	 }
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 1px; border-color: #004080; }
<!--
.Estilo14 {font-size: 14px}
-->
</style>
<link rel="pingback" href="http://api.jquery.com/xmlrpc.php">
<link rel="stylesheet" type="text/css" href="styles/yepsua/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script>
<link rel="shortcut icon" href="imagenes/logo_gcp.ico" type="image/x-icon">
<script type="text/javascript" src="valida.js"></script>



<script>
function validar2(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}




function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
	var x =screen.width;
    ventana.style.marginTop = "300px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
    ventana.style.marginLeft = x-600;//((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
	parent.frames['datamain'].window.location.reload();

}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
}

function Puntero()
{
	document.body.style.cursor="Pointer";
}

function PunteroNormal()
{
	document.body.style.cursor="Default";
}

function consecutivo2()
{
var fec = document.getElementById('fecha_contrato').value;
var tipo= document.getElementById('clase_contrato').value;

var pos_url2 = 'concec_contrato.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				var elem = dato.split(',');
				concec = elem[0];
				fecha2 = elem[1];
				document.getElementById('numero_contrato').value =concec;
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2+dato);
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+fec+'&tipo='+tipo,false);
	req1.send(null);
	}

}


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
</head>
<body >

<div id="contenedor">
<div id="encabezado">
<center><br />
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />

</center><br />
  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><br />

<span class="Estilo13 Estilo14"><strong><B>CONTRATAR</B></strong></span></div>

</div>


<?php
  $numero_crpp = $_GET['num'];
  $valor_contrato = $_GET['valor'];

  
   $a = substr($numero_crpp,4,100);
   

include('../config.php');		
$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
 
$sq2 ="SELECT id_emp, id_manu_cdpp, fecha_cdpp, id_manu_crpp, fecha_crpp, tercero,id_auto_crpp, detalle_crpp,pago,n_contrato FROM crpp WHERE id_manu_crpp='$numero_crpp' and liq1=''";
$result = mysql_query($sq2, $cx);
while ($row = mysql_fetch_array($result))
{
$id_emp=$row["id_emp"];
$numero=$row["id_manu_crpp"];
$id_auto_crpp=$row["id_auto_crpp"];
$numero_cdpp=$row["id_manu_cdpp"];
$fecha_cdpp=$row["fecha_cdpp"];
$fecha_crpp=$row["fecha_crpp"];
$detalle_crpp=$row["detalle_crpp"];
$tercero=$row["tercero"];
$pago=$row["pago"];
$n_contrato= $row["n_contrato"];
}
$fecha_c=$fecha_cdpp;
echo '<script languaje="JavaScript">
      var fecha_cdp="'.$fecha_c.'";
	  var fecha_crp="'.$fecha_crpp.'";
      </script>';
?>
<div id="formulario" align="center">
 <center>
<FORM METHOD="post" name="a" id="a"  action="datos.php"> 
<table width="800" border="1" align="center" class="bordepunteado1" cellspacing="0" cellpadding="2">
<tr>
    <td colspan="4" bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4">
        <div align="center"><strong>INFORMACION GENERAL </strong></div>
      </div>
    </div></td>
    </tr>
  <tr>
    <td width="211"></td>
    <td width="201"></td>
    <td width="179"></td>
    <td width="183"></td>
  </tr>
   <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>NUMERO DE CDPP : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left"><? printf("%s",$numero_cdpp);?>        </div>
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
        <div align="left"><? printf("%s",$numero_crpp);?>        </div>
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
        <div align="left"><? printf("%s",number_format($valor_contrato,2,",","."));?> </div>
      </div>
    </div></td>
    </tr>
</table>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">

 <tr>
    <td width="250"></td>
    <td width="527"></td>
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
 
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="center" class="Estilo4">
    	<div align="right"><strong>FECHA DEL CONTRATO : </strong></div>
      	</div>
    	</div>	</td>
	
    <td colspan="2" align="left"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
 		<div id="dialogId">
  		<input id="fecha_contrato"  name="fecha_contrato" size="10" value="<? echo ($fecha_crpp); ?>" class="Estilo4" onblur="consecutivo2();"/>
 		<input name="button" type="button" class="Estilo4" on onClick="displayCalendar(document.forms[0].fecha_contrato,'yyyy/mm/dd',this)" value="Ver Calendario" />
		</div>
		</div>	</td>
</tr>

<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
   	   <div align="center" class="Estilo4">
        <div align="right"><strong>MODALIDAD DE CONTRATACION :</strong></div>
    	</div>
    	</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
		<select  name="modalidad_seleccion" class="Estilo4" size="1"> 
		<option value='CDF4' selected>CONTRATACION DIRECTA</option>
   		<option value='CMF6'>CONCURSO DE M�RITOS</option>
		<option value='CMF7'>CONCURSO DE M�RITOS - CON PRECLASIFICACION</option>
		<option value='LPF5'>LICITACI�N PUBLICA </option> 
		<option value='OPF8'>MINIMA CUANTIA</option>
        <option value='SAF1'>SELECCI�N ABREVIADA </option> 
		</select>
     	</div>
      	</div>
    	</div>	</td>
</tr>

<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="center" class="Estilo4">
    	  <div align="right"><strong> CLASE DE CONTRATO : </strong></div>
      		</div>
    		</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left">
		<select  name="clase_contrato" id="clase_contrato" class="Estilo4" > 
			<?php
			$sql = "select * from aux_tipocontrato order by clase asc" ;
			$res43 = mysql_db_query($database, $sql, $cx);
			$fil = mysql_num_rows($res43);
				for ($i=0; $i<$fil; $i++) 
						{
							$r = mysql_fetch_array($res43);
							echo "<OPTION value='$r[clase]'>$r[clase]</OPTION>";
						}
			?>
		</select>  
	   </div>
	      </div>
    	</div>	</td>
  </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="center" class="Estilo4">
    	  <div align="right"><strong> PERFIL DEL CARGO : </strong></div>
      		</div>
    		</div>	</td>
    <!--td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left">
       		<select size="1" name="perfil" id="perfil" class="Estilo4"> 
			<?php 
            /* $sql = "select * from perfiles order by cargo asc" ;
			$res43 = mysql_db_query($database, $sql, $cx);
			$fil = mysql_num_rows($res43);
			echo " esta eson las filas" .$fil;
				for ($i=0; $i<$fil; $i++) 
						{
							$r = mysql_fetch_array($res43);
							echo "<OPTION value=".$r['id'].">".$r['cargo']."</OPTION>";
						}
			*/
			?>
            </select>
	      </div>
	      </div>
    	</div>	</td>
  </tr-->

   <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="right"><strong>NUMERO DE CONTRATO : </strong></div>
      	</div>
    	</div>	</td>
  	
	<td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
          <input type="text" name="numero_contrato"  id="numero_contrato" size="10" onBlur="valida_contneo();"  class="Estilo4" value="<?php echo $n_contrato; ?>"  >
          
            
                 <a href="javascript:mostrarVentana();">Mas</a>
               <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana,
                    Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 
                     3px solid; background-color: #FAFAFA; color: #000000; display:none;"> 
                     
                    <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">
                          <table border="0" width="100%">
                           <tr>
                              <td>Consecutivos del Documento</td>
                              <td align="right"><img src="../simbolos/cerrar.png"  width="15" border="0"
                                 onclick="ocultarVentana();" onmouseover="Puntero();" onmouseout="PunteroNormal();">
                               </td>
                            </tr> 
                          </table>
                      </div>
                      <iframe id="datamain" src="cntratoconsecutivo.php"  width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
              </div>
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div class="Estilo4" align="center" id='res_ncon'></div>
              </div>
        <input type="hidden" name="numero_crpp" value="<? printf($numero) ?>">
		<input type="hidden" name="valor_contrato" value="<? printf($valor_contrato) ?>">
		<input type="hidden" name="id_auto_crpp" value="<? printf($id_auto_crpp) ?>">
		<strong id="respc"></strong>
      
	    </div>
     	 </div>
    	</div>	</td>
 </tr>

  
  
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
      <div align="right"><strong>FECHA DE LA FIRMA : </strong></div>
      </div>
	 </div>	 </td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      	<div align="center" class="Estilo4">
    	<div align="left"><div id="dialogId">
    	  <input name="fecha_firma" size="10" value="<? echo ($fecha_crpp); ?>" class="Estilo4"/>
    	  <input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_firma,'yyyy/mm/dd',this)" value="Ver Calendario" />
		</div>
		</div>
     	</div>
   	 	</div>	</td>
 </tr>
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="center" class="Estilo4">
    	  <div align="right"><strong>OBJETO DEL CONTRATO : </strong></div>
     	  </div>
    	  </div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div>
        	<div><textarea  name="objeto" cols="80" rows="6" style="font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333;	line-height:12px;"><? printf("%s",$detalle_crpp);?></textarea>
			</div>
			</div>
      		</div>    </td>  
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
       	  <input name="fecha_ter" id="fecha_ter" size="10" value="" class="Estilo4" onchange="dias();"/>
    	  <input name="button" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_ter,'yyyy/mm/dd',this)" value="Ver Calendario"  />
      		</div>
    		</div></div>	</td>
 </tr>
 <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="center" class="Estilo4">
    	    <div align="right"><strong>PLAZO DE CONTRATO : </strong></div>
     	 </div>
    	</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left"><input type="text" name="plazo" id="plazo" size="10" class="Estilo4" onfocus="dias();" >
     		<select  name="plazo_unidad" size="1" class="Estilo4"> 
			<option value="D" selected>DIAS</option> 
			</select></div>
      		</div>
    		</div>	</td>
 </tr>
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="center" class="Estilo4">
    	    <div align="right"><strong>NOMBRE DEL INTERVENTOR : </strong></div>
     		 </div>
    		</div>	</td>
	
			<? $x1i ="(SELECT raz_soc2 as nombre, num_id2 as numero FROM terceros_juridicos WHERE interventor ='SI' order by raz_soc2 asc) UNION ALL
			(SELECT CONCAT(pri_ape, ' ',seg_ape,' ',pri_nom,' ',seg_nom) as nombre, num_id as numero FROM terceros_naturales WHERE interventor ='SI' order by pri_ape,seg_ape,pri_nom,seg_nom asc)";	
			$rsg = mysql_query($x1i);
			?>
    <td colspan="2">
		<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	<div align="center" class="Estilo4">
        <div align="left">
		
			<select  name="cedula_interventor" size="1" class="Estilo4">
				<option value="">				</option> 
					<?
					 while ($rowg = mysql_fetch_assoc($rsg))
					 {
					 	 echo '<option value= '.$rowg["numero"].'>'.$rowg["nombre"].'</option>';
					 } 
					?> 
			</select>
		</div>
      	</div>
    	</div>	</td>
</tr>  
  
<tr>
	<td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	 <div align="center" class="Estilo4">
        <div align="right"><strong>TIPO DE VINCULACION  : </strong></div>
      	</div>
    	</div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    	  <div align="center" class="Estilo4">
        	<div align="left">
			<select  name="tipo_vinculacion" size="1" class="Estilo4"> 
			<option value="I">INTERNO</option> 
			<option value="E">EXTERNO</option> 
			<option value="ND">ND</option>
			</select>
			</div>
      		</div>
    		</div>	</td>
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
				<input type="text" name="val_anticipo" id="val_anticipo" size="20" class="Estilo4" style="text-align:right" >
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
			<input type="text" name="bpin" id="bpin" size="20" class="Estilo4"  >
			</div>
      		</div>
    		</div>	</td>
  </tr>
  
<tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	      <div align="right"><span class="Estilo4"><strong></strong> </span></div>
   		 </div>	</td>
    <td colspan="2"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
    
         </div>	</td>
</tr>
</table>
<? 
echo '<script languaje="JavaScript">
var fecha_crpp="'.$fecha_crpp.'";
</script>';
?>
<br>
<table border="0">
<tr>
<td>
<input name="send" type="submit" id="enviar" class="Estilo4" value="GUARDAR" onClick="return validar(fecha_crpp)"/>
</form>
</td>
<td>
<form action="index.php" method="post" target="_self" >
<!--<input name="fecha" type="hidden" value="<? //printf($fecha); ?>" />
<input name="fecha2" type="hidden" value="<? //printf($fecha2); ?>" />
<input name="pendiente" type="hidden" value="<? // printf($pendiente); ?>" />
<input name="registrado" type="hidden" value="<? //printf($registrado); ?>" />-->
<input type="submit" class="Estilo4" value="VOLVER" />
</form> 
</center>
</div>
</td>
</tr>
</table>
<div id="piedepag">
<img src="imagenes/q.png"  /></div>
</div>
</body> 
</html> 

