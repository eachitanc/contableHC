<?php
session_start();
if(!isset($_SESSION["login"]))
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
.Estilo8 {	color: #FF0000;
	font-weight: bold;
}
</style>
</head>

<body>
<table width="750" border="0" align="center">
  <tr>
    
    <td width="750" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  
  <tr>
  
    <td colspan="3">
	<?php 
	  include('../../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
 
   }
	  ?>
	<form name="empresa" method="post" action="bloqueo2.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
	  <table width="700"  border ='1' align="center" class='bordepunteado1' >
       
      <tr>
        <td colspan="2" bgcolor="#DCE9E5" class="Estilo4"><div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="center"><strong>BLOQUEAR CUENTA DEL PLAN GENERAL DE CONTABILIDAD PUBLICA <BR />
              P.G.C.P</strong></div>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" class="Estilo4"><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:10px;">
          <div align="center"><strong>PASO 1. </strong><br />
            SELECCIONE la cuenta que desea BLOQUEAR
            
          </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" bgcolor="#F5F5F5" class="Estilo4"><div id="div6" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
            <div align="center"><strong>CUENTAS DETALLE CARGADAS EN P.G.C.P </strong><br />
              <br />
              <select name="nn" class="Estilo4" style="width: 400px;">
                <?php
include('../../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database);
$strSQL = "SELECT * FROM pgcp WHERE id_emp = '$idxx' AND tip_dato ='D' AND bloqueo = 'NO' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_assoc();
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</OPTION>";
}
?>
                </select>
            </div>
        </div></td>
        </tr>
      <tr>
        <td width="350" class="Estilo4"><div id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
          <div align="center"><strong>PASO 2.</strong><BR />
            Verifique su seleccion </div>
        </div></td>
        <td width="350" class="Estilo4"><div id="div4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
          
          <div align="center">
              <input name="Submit" type="submit" class="Estilo4" value="Verificar" />
           </div>
        </div></td>
      </tr>
    </table>
	</form>	
	
	<div align="center">
	<?php
//-------
include('../../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from pgcp where id_emp = '$idxx' and bloqueo = 'SI' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<br><center class='Estilo4'><b>LISTADO GENERAL DE CUENTAS BLOQUEADAS</b></center><br>
<center>

<table width='700' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Desbloquear</b></span>
</div>
</td>
<td align='center' width='200'><span class='Estilo4'><b>Cod. Pptal</b></span></td>
<td align='center' width='350'><span class='Estilo4'><b>Nombre Rubro</b></span></td>





");

while($rw = mysql_fetch_array($re)) 
   {
printf("
<span class='Estilo4'>
<tr>
<td align='center'><span class='Estilo4'><a href=\"desbloqueo.php?id=%s\"> Desbloquear </a></span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>


</tr>", $rw["cod_pptal"], $rw["cod_pptal"], 
		$rw["nom_rubro"]); 


   }

printf("</table></center>");
//--------	
?>
     </div>
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <?php include('../../config.php');				
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
          <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">
	<div style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px ">
    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF">
	<div align="center">
	<a href="../index_pgcp.php" target="_parent">VOLVER</a>	</div>
	</div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="250">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
	</div>	</td>
    <td width="250">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="250">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>