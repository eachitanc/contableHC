<?php
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
<title>CONTAFACIL</title>
<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #666666;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: underline;
}
a:active {
	color: #666666;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
.Estilo7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>

</head>

<!--<body onload = "document.forms[0]['a'].focus()">-->
<body>
<table width="850" border="0" align="center">
  <tr>
    
    <td width="980" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3">
			
		<table width="800" border="0" align="center">
	<tr>
	  <td>	    <div align="center">
	    <p><span class="Estilo1"><BR />MAESTRO PLAN GENERAL DE CONTABILIDAD PUBLICA<BR />P.G.C.P </span><br /><BR />
	      <?php 
	  include('../config.php');				
$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);

while($rowxxx = mysql_fetch_array($rxx)) 
   {
   
   $idxxx=$rowxxx["id_emp"];
//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
   }
	  ?>
	      <?php
//-------
include('../config.php');				
$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = mysql_db_query($database, $sq2, $cx2);

while($row2 = mysql_fetch_array($re2)) 
   {
printf("<span class='Estilo4'><b>...::: %s :::...</b></span><br>", $row2["raz_soc"]);  
   }
//--------	--------------------------------------------------------------------------------------------
?>
	      <br />
	      <?php
//-------
include('../config.php');				
$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   
   $id=$row["id_emp"];
//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
   }
//--------	
?>
	      </p>
	    <table width="800" border="1" class="bordepunteado1">
          <tr>
            <td bgcolor="#DCE9E5">
			<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4"><strong>IMPORTANTE</strong></div>
            </div></td>
          </tr>
          <tr>
            <td align="left">
			<div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
			<span class="Estilo4">
			1 . Si selecciona un <strong>CODIGO PRESUPUESTAL</strong> puede <strong>MODIFICAR</strong> los datos basicos de la cuenta. 
			<br />
			2 . <strong>TIP</strong> = tipo -&gt; D = detalle ; M = mayor <br />
			3
			. <strong>NIV</strong> = nivel <br />
			4
			. <strong>BAN</strong> = banco<br />
			5
			. <strong>NAT</strong> = naturaleza -&gt; D = debito ; C = credito <br />
			6
			. <strong>CTE</strong> = corriente -&gt; C = corriente ; NC = no corriente <br />
				    </span>			</div>			</td>
          </tr>
        </table>
	   <BR />
	    <table width="800" border="1" align="center" class="bordepunteado1">
                <tr bgcolor='#DCE9E5'>
                  <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center" class="Estilo1">Opciones Maestro P.G.C.P </div>
                  </div></td>
                </tr>
                <tr>
                  <td class="Estilo4">

				  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div align="center">
				  <a href="modi_borra_pgcp/cambiar_codigo.php" target="_parent">
				  Cambiar Cuenta				  </a></div>
                  </div>
				  
				  
				  
				  </td>
                  <td class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center"><a href="modi_borra_pgcp/eliminar_codigo.php" target="_parent">Borrar Cuenta</a> </div>
                  </div></td>
                  <td class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center"><a href="carga_pgcp.php#a" target="_parent">Nueva Cuenta </a> </div>
                  </div></td>
                </tr>
                <tr>
                  <td width="266" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center">Buscar Cuenta  </div>
                  </div></td>
                  <td width="266" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><a href="bloqueo/bloqueo.php" target="_parent">Bloquear Cuenta </a></div>
                  </div></td>
                  <td width="266" class="Estilo4">&nbsp;</td>
                </tr>
              </table>
			  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                <div align="center">
                  <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                      <div align="center"><a href='consulta_pgcp.php' target='_parent'>VOLVER</a> </div>
                    </div>
                  </div>
                </div>
		      </div>
			  
	          <?php
//-------
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from pgcp where id_emp = '$id' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>

<table width='750' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='70'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'>Detalle</span>
</div>
</td>
<td align='center' width='180'><span class='Estilo1'>Cod. Pptal</span></td>
<td align='center' width='350'><span class='Estilo1'>Nombre Rubro</span></td>
<td align='center' width='30'><span class='Estilo1'>Tip</span></td>
<td align='center' width='30'><span class='Estilo1'>Niv</span></td>
<td align='center' width='30'><span class='Estilo1'>Ban</span></td>
<td align='center' width='30'><span class='Estilo1'>Nat</span></td>
<td align='center' width='30'><span class='Estilo1'>Cte</span></td>




");

while($rw = mysql_fetch_array($re)) 
   {
printf("
<span class='Estilo4'>
<tr>
<td align='center'><span class='Estilo4'> Ver Mas </span></td>
<td align='left'><span class='Estilo4'><a href=\"modi_cuenta_pgcp.php?id=%s\"> %s </a></span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>

</tr>", $rw["cod_pptal"], $rw["cod_pptal"], 
		$rw["nom_rubro"], $rw["tip_dato"], $rw["nivel"],
		$rw["banco"], $rw["naturaleza"], 
		$rw["c_nc"]); 


   }

printf("</table></center>");
//--------	
?>
	        
	        </div></td>
	  </tr>
	
	
	<tr>
	  <td><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
            <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
              <div align="center"><a href='consulta_pgcp.php' target='_parent'>VOLVER</a> </div>
            </div>
          </div>
        </div>
	    </div></td>
	  </tr>
	<tr>
	<td>
	
	 
	  
	    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center">
		<span class="Estilo4">Fecha de  esta Sesion:</span> 
		<br />
        <span class="Estilo4">
		<strong>
<?php include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
		</strong>
		</span>
		<br />
        <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u>
		</span> 
		</div>
	    </div>
	  </td>
	</tr>
	</table>
	</td>
  </tr>

  <tr align="center">
    <td width="283">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
	</div>	</td>
    <td width="283">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="283">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>