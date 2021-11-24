<?
set_time_limit(150);
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
							// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['conta']=='SI')
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<script type="text/javascript" src="../jquery.js"></script>


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
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo11 {font-weight: bold; color: #FFFFFF; }
-->
#divCargando
{
	position:absolute;
	top:5px;
	right:5px;
	background-color: red;
	color: white;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	padding:5px;
}
</style>
<script>
	function mostrarForm(formulario,ruta)  
	// formulario: nombre del formulario que vamos a eviar por ajax, ruta: es el archivo que realizar� la petici�n del servidor
	{
		// Enciende mensaje de espera 
		$("#mainContent").hide();
		$("#divCargando").show();
		// Carga los valores del formulario en un array serializado
		var valores = $(formulario).serialize();	
		// Envio la peticion al servidor
		$.ajax({type: 'POST',
				url: ruta,
				data: valores,
				cache: false,
				// async:false,
				// �beforeSend : Indicamos el nombre de la funci�n que se ejecutar� previo al env�o de datos gif animado
				
				success: function(respuesta) // indica la funcion que se ejecutar cuando obtenemos la respuersta del servidor
						{
						// iniciamos desvanecimiento
						$("#mainContent").fadeOut(function() {
													$(this) 
													.html(respuesta) 
													.fadeIn(); 
												  });
						// Apagamos el aviso de cargando
						$("#divCargando").hide();
						}
	  		 });
	}
	
function VerFecha()
{
	if (document.getElementById("movi").checked)
		{
			document.getElementById("fecha_movimiento").style.display="inline";
			document.getElementById("mainContent").style.display="none";
			
		}else{
			document.getElementById("fecha_movimiento").style.display="none";
			document.getElementById("mainContent").style.display="none";
		}
}
</script>
</head>

<body>
	<div id="divCargando" style="display:none">
	Por favor espere...
	</div>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>BALANCE GENERAL</strong><BR />
      </div>
    </div></td>
  </tr>
  <tr>
    <td>
<?
include('../config.php');

//**** variables para generacion dinamica

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }

//**********************
				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
$sq2 ="select nit from empresa where cod_emp=2";
$res = mysql_db_query($database,$sq2,$connectionxx);
$nit = mysql_fetch_array($res);

   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }  
   

?>	
	<form name="a" method="post">
	  <table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><b></b> Seleccione la fecha de corte del informe</div>
    </div></td>
  </tr>
  <tr>
    <td align="right"><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4">Movimiento :
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4"><input name="movi" id="movi" type="checkbox"  value="SI" onclick="VerFecha();" />
      </div>
    </div></td>
  </tr>
  <tr style="display:none" id="fecha_movimiento">
    <td align="right"><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4">Fecha anterior :
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left">
        <input name="fecha_mov" type="text" class="Estilo4" id="fecha_mov" value="<?php printf($desde); ?>" size="12" />
        <span class="Estilo11">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_mov,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>

  <tr>
    <td align="right"><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4">Fecha de corte :
        <input name="fecha_ini" type="hidden" class="Estilo4" id="fecha_ini" value="<?php printf($desde); ?>" size="12" />
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left">
        <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
        <span class="Estilo11">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>
  
    <tr>
    <td align="right"><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4">Nivel :
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4"><select name="nivel2" id="nivel" class="Estilo4">
      					<option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6" selected="selected">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        </select>
      </div>
    </div></td>
  </tr>

    <tr>
    <td align="right"><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4">Resumen financiero :
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo4"><input name="resumen" id="resumen" type="checkbox" checked="checked" value="SI" />
      </div>
    </div></td>
  </tr>
<?php if ($nit[0]==837000096){
	echo"	
    <tr>
    <td align='right'><div id='div2' style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='right' class='Estilo4'>Consolidado :
      </div>
    </div></td>
    <td><div id='div' style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='left' class='Estilo4'><input name='consol' id='consol' type='checkbox' checked='checked' value='SI' />
      </div>
    </div></td>
  </tr>";
}
  ?>
  
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <div align="center">
            <input name="Submit322" type="button" class="Estilo4"  value="Generar Libro Auxiliar" 
			onClick="mostrarForm(a,'balance_general_proces.php');" />
          </div>
      </div>
    </div></td>
  </tr>
    <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="center">
          <div id="mainContent"></div>
      </div>
    </div></td>
  </tr>

</table>
</form>	</td>
  </tr>

  
  <tr>
    <td>
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
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
</table>
</body>
</html>






<?
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>