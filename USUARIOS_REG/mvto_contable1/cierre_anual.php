<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
<script>
function validarCuenta(id){
	var cuenta_costos =document.getElementById(id).value;
	var pos_url2 = 'consultas/cuenta_cierre.php';	
	var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				if (dato == 'M')
				{
				alert ("La cuenta seleccionada no es de detalle");
				document.getElementById(id).value='';
				document.getElementById(id).focus()
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+cuenta_costos,false);
	req1.send(null);
	}
}

function ValidaVacio(){
	
	var cuenta_costos =document.getElementById("cod_cierre").value;
	var cuenta_exedent =document.getElementById("cod_exedente").value;
	var cuenta_defici =document.getElementById("cod_deficit").value;
	if (cuenta_costos ==""){
		alert ("Hace falta seleccionar una cuenta...");
				document.getElementById("cod_cierre").value='';
				document.getElementById("cod_cierre").focus()
				return false;
		}
	if (cuenta_exedent ==""){
		alert ("Hace falta seleccionar una cuenta...");
				document.getElementById("cod_exedente").value='';
				document.getElementById("cod_exedente").focus()
				return false;
		}
	if (cuenta_defici ==""){
		alert ("Hace falta seleccionar una cuenta...");
				document.getElementById("cod_deficit").value='';
				document.getElementById("cod_deficit").focus()
				return false;
		}
	return true;
	}
</script>
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<center>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">CONFIGURACION CUENTAS CIERRE ANUAL</div>
<br />
<div align="center"> 
<FORM METHOD="post" name="fomr1" id="form1"  action="cierre_anual_g.php"> 
<table width="50%" border="1" align="center" class="bordepunteado1" cellspacing="0" cellpadding="2">
<tr>
    <td colspan="4" bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4">
        <div align="center"><strong>INFORMACION GENERAL </strong></div>
      </div>
    </div></td>
    </tr>
  <tr>
    <td width="396"></td>
    <td width="16"></td>
    <td width="179"></td>
    <td width="183"></td>
  </tr>
   <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>CUENTA PARA CIERRE DE INGRESOS, GASTOS Y COSTOS : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left">
        <input name="tipo1" id="tipo1" value="CIERRE" type="hidden" />
        <select name="cod_1" class="Estilo4" id="cod_1" style="width: 350px;" onblur="validarCuenta(id)">
                <option value="" selected="selected" ></option>

          <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM pgcp WHERE cod_pptal like '59%' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
                </select></div>
      </div>
    </div></td>
    </tr>
     <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>CUENTA PARA EXCEDENTES DEL EJERCICIO  : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left">
        <input name="tipo2" id="tipo2" value="EXEDENTE" type="hidden" />
        <select name="cod_2" class="Estilo4" id="cod_2" style="width: 350px;" onblur="validarCuenta(id)">
        <option value="" selected="selected" ></option>
          <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM pgcp WHERE cod_pptal like '3110%' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
                </select></div>
      </div>
    </div></td>
    </tr>
       <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>CUENTA PARA DEFICIT DEL EJERCICIO : </strong></div>
      </div>
    </div></td>
    <td colspan="3"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="left">
        <input name="tipo3" id="tipo3" value="DEFICIT" type="hidden" />
		<select name="cod_3" class="Estilo4" id="cod_3" style="width: 350px;" onblur="validarCuenta(id)">
                <option value="" selected="selected" ></option>

          <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM pgcp WHERE cod_pptal like '3110%' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
                </select>        </div>
      </div>
    </div></td>
    </tr>
    
</table>
<br />
<input name="send" type="submit" id="enviar" class="Estilo4" value="Guardar" onclick="return ValidaVacio();"/>
<br>
</FORM>


</div>
</center>
</body>
</html>
<?php 
}
?>
