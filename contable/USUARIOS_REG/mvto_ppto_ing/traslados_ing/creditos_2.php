<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../../login.php");
exit;
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
.Estilo8 {color: #FFFFFF}
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="../../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="../../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script> 
var comp;
var def;

function ValidaValor()
{
valor0=document.a.valor_adi.value;
valor1= def;
valor2= comp;  
valor3 =valor1 - valor2;
if (valor3 < valor0)
	{
	alert("El valor a reducir es mayor al saldo del rubro");
	document.a.valor_adi.value= '';
	}
}

function cambia()
{

cambia1();
cambia2();

}


function cambia1()
{
cod_pptal = document.a.cod_pptal.value;
	var pos_url2 = 'comprobadores/comprueba_valores.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = cod_pptal;						// Lee de un campo o id la variable que se pasa al servidor
	var req3 = new XMLHttpRequest();												// Crea el objeto XML
	if (req3)
	{																	
		req3.onreadystatechange = function() 
		{
			if (req3.readyState == 4 && (req3.status == 200 || req3.status == 304)) 
			{
				//document.procedimientos.observaciones.value = req.responseText;
				document.getElementById('resp').innerHTML = formatCurrency(req3.responseText);
				comp = parseFloat(req3.responseText);
				return comp;
			}
		}
	
	req3.open('POST', pos_url2 +'?cod='+cod,false);
	req3.send(null);
	
	}
}

function cambia2()
{
	cod_pptal = document.a.cod_pptal.value;
	var pos_url = 'comprobadores/comprueba_def.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = cod_pptal;						// Lee de un campo o id la variable que se pasa al servidor
	var req2 = new XMLHttpRequest();												// Crea el objeto XML
	if (req2)
	{																	
		req2.onreadystatechange = function()
			{
					if (req2.readyState == 4 && (req2.status == 200 || req2.status == 304)) 
					{
						document.getElementById('resp2').innerHTML = formatCurrency(req2.responseText);	
						def = parseFloat(req2.responseText);
						var saldo = def - comp;
						saldof = Math.round(saldo*100)/100; 
						//document.getElementById('saldo').innerHTML =formatCurrency(saldof);	
						return def;			
					}
			}
			req2.open('POST', pos_url +'?cod='+cod,false);
			req2.send(null);
	}
}

function formatCurrency(num) { 
num = num.toString().replace(/$|,/g,''); 
if(isNaN(num)) 
num = "0"; 
sign = (num == (num = Math.abs(num))); 
num = Math.floor(num*100+0.50000000001); 
cents = num%100; 
num = Math.floor(num/100).toString(); 
if(cents<10) 
cents = "0" + cents; 
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++) 
num = num.substring(0,num.length-(4*i+3))+'.'+ 
num.substring(num.length-(4*i+3)); 
return (((sign)?'':'-') + '' + num + ',' + cents); 
}


	

function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
} 

function ValidarForm()
{
valor = document.a.valor_adi.value;
acto = document.a.tipo_acto.value;
numero= document.a.num_acto.value;
desc  = document.a.concepto_adi.value;
if (valor =="")
	{
		alert("El campo valor no puede estar vacio");
		document.a.valor_adi.focus();
		return (false);
	}
if (valor <= 0)
	{
		alert("El valor a acreditar no puede ser \"0\" ");
		document.a.valor_adi.focus();
		return (false);
	}
if (acto =="")
	{
		alert("El campo tipo de acto no puede estar vacio");
		document.a.tipo_acto.focus();
		return (false);
	}
if (numero =="")
	{
		alert("El campo numero de acto no puede estar vacio");
		document.a.num_acto.focus();
		return (false);
	}
if (desc =="")
	{
		alert("El campo descripci�n no puede estar vacio");
		document.a.concepto_adi.focus();
		return (false);
	}
	
return (true);
	
}
//*****VALIDAR CUENTA DETALLE
function val_cta_dlle()
{
cod_pptal = document.a.cod_pptal.value;
	var pos_url2 = 'comprobadores/comprueba_cuenta.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = cod_pptal;						// Lee de un campo o id la variable que se pasa al servidor
	var req3 = new XMLHttpRequest();												// Crea el objeto XML
	if (req3)
	{																	
		req3.onreadystatechange = function() 
		{
			if (req3.readyState == 4 && (req3.status == 200 || req3.status == 304)) 
			{
				//document.procedimientos.observaciones.value = req.responseText;
				var tipo=req3.responseText;
				if(tipo=='M')
				{
					alert("La cuenta seleccionada no es de Detalle")
					document.getElementById('cod_pptal').focus();
				}
			}
		}
	
	req3.open('POST', pos_url2 +'?cod='+cod,false);
	req3.send(null);
	
	}
}

</script>


</head>


<body onload="cambia();">
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='creditos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
	<form name="a" method="post" action="proc_credito.php" onsubmit="return confirm('Verifique que la Informacion es Correcta')">
	<table width="750" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
          <div align="center" class="Estilo4"><strong>CREDITOS</strong></div>
        </div></td>
        </tr>
      <tr>
       <td ><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
         <div align="center"><span class="Estilo4"><strong>Seleccione una cuenta</strong>
         </span><br />
         </div>
       </div></td>
        <td  colspan="3"><div id="div6" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <?php 
include('../../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
  $ano =$rowxx["ano"];
}
?>
            <select name="cod_pptal" onchange="cambia()" class="Estilo4" style="width: 400px;" onblur="val_cta_dlle();">
                <?
				include('../../config.php');
				$db = mysql_connect($server, $dbuser, $dbpass);
				mysql_select_db($database);
				$strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx'  ORDER BY cod_pptal";
				$rs = mysql_query($strSQL);
				$nr = mysql_num_rows($rs);
				for ($i=0; $i<$nr; $i++) {
					$r = mysql_fetch_array($rs);
					echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</OPTION>";
				}
				?>

              </select>
  <input name="nom_rubro" type="hidden" id="id_emp" value="<?php printf($r[nom_rubro]); ?>"/>
  <input name="id_emp" type="hidden" value="<?php echo $idxx; ?>"/>
          </div>
        </div></td>
        </tr>
      <tr>
        <td width="178" bgcolor="#F5F5F5"><div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
          <div align="center"><span class="Estilo4"><strong>Fecha del Credito </strong></span><br />
          </div>
        </div></td>
        <td width="245" bgcolor="#F5F5F5"><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <input name="fecha_adi" type="text" class="Estilo4" id="fecha_adi" value="<?php printf($ano); ?>" size="12" />
            <input name="button" type="button" class="Estilo4" id="button" onclick="displayCalendar(document.forms[0].fecha_adi,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
		  </div>
        </div></td>
        <td colspan="2" bgcolor="#F5F5F5">
		<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
          
          </div>
		</div>		</td>
      </tr>
      <tr>
        <td><div id="div3" style="padding-left:3px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center"><span class="Estilo4"><strong>VALOR A ACREDITAR </strong></span><br />
            </div>
        </div></td>
        <td><div id="div4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="left">
              <input name="valor_adi" type="text" class="Estilo4" id="valor_adi" onkeypress="return validar(event)" size="30" maxlength="30" style="text-align:right"/>
            </div>
        </div></td>
        <td width="152"><div id="div6" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center"> <span class="Estilo4"><strong>Presupuesto Inicial</strong><br />
               <div id="resp"></div>
              </span>
                
                <br />
            </div>
        </div></td>
        <td width="145"><div id="div13" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center"> <span class="Estilo4"><strong>Presupuesto Definitivo </strong><br />
                <div id="resp2"></div>
            </span><br />
          </div>
        </div></td>
      </tr>
      <tr>
        <td><div id="div10" style="padding-left:3px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"><span class="Estilo4"><strong> ACTO ADMINISTRATIVO </strong></span><br />
          </div>
        </div></td>
        <td><div id="div11" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <select name="tipo_acto" class="Estilo4" id="tipo_acto">
               <option value="" selected="selected"></option>
			  <option value="ORDENANZA">ORDENANZA</option>
              <option value="ACUERDO">ACUERDO</option>
              <option value="DECRETO">DECRETO</option>
              <option value="RESOLUCION">RESOLUCION</option>
              <option value="OTRO">OTRO TIPO DE ACTO ADMTVO</option>
              <option value="N/A">NO APLICA</option>
            </select>
            </div>
        </div></td>
        <td colspan="2"><div id="div12" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4">
            <b>Numero:</b>
            <input name="num_acto" type="text" class="Estilo4" id="num_acto" size="30" maxlength="30" onkeyup="a.num_acto.value=a.num_acto.value.toUpperCase();" />
          </div>
        </div></td>
      </tr>
      <tr>
        <td width="178">&nbsp;</td>
        <td width="245">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      
      <tr>
       <td width="178"><div id="div7" style="padding-left:3px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
         <div align="center"><span class="Estilo4"><strong>CONCEPTO DEL CREDITO </strong></span><br />
         </div>
       </div></td>
        <td colspan="3"><div id="div8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="left">
            <textarea name="concepto_adi" cols="90" rows="5" class="Estilo4" onkeyup="a.concepto_adi.value=a.concepto_adi.value.toUpperCase();" ></textarea>
            <br />
          </div>
        </div></td>
        </tr>
      <tr>
       <td colspan="4"><div id="div9" style="padding-left:3px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
         <div align="center">
           <input name="Submit" type="submit" class="Estilo4" value="Grabar Credito" onClick="return ValidarForm();" />
            <span class="Estilo8">:::</span> 
            <input name="Submit2" type="reset" class="Estilo4" value="Borrar Formulario" />
            <br />
         </div>
       </div></td>
        </tr>
    </table>
	</form>
	
	</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='creditos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?
}
?>