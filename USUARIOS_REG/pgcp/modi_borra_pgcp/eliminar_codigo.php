<?php
session_start();
if(!$_SESSION["login"])
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
global $server, $database, $dbpass,$dbuser,$charset;
// Conexion con la base de datos
$cx= new mysqli ($server, $dbuser, $dbpass, $database);	
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx =  $resultadoxx->fetch_assoc())
   {
   
   $idxx=$rowxx["id_emp"];
 
   }
	  ?>
	<form name="empresa" method="post" action="eliminar_codigo_2.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
	  <table width="700"  border ='1' align="center" class='bordepunteado1' >
       
      <tr>
        <td colspan="2" bgcolor="#DCE9E5" class="Estilo4"><div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="center"><strong>ELIMINAR CUENTA DEL PLAN GENERAL DE CONTABILIDAD PUBLICA <BR />P.G.C.P</strong><br />
              <br />
               <strong>Descripcion</strong>: Este proceso consiste en ELIMINAR una cuenta existente, sea MAYOR o DETALLE, que NO haya sido AFECTADA por ningun usuario del Sistema, con el objetivo de corregir errores en la <strong>Carga  del P.G.C.P </strong> o eliminar la cuenta definitivamente.          </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" class="Estilo4"><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
          <div align="center"><strong>PASO 1. </strong><br />
            SELECCIONE la cuenta que desea ELIMINAR<br />
            (Puede eliminar cuentas que <strong>NO</strong> tengan MOVIMIENTOS o AFECTACION ALGUNA) <br />
            <br />
          </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" bgcolor="#F5F5F5" class="Estilo4"><div id="div6" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
            <div align="center"><strong>CUENTAS CARGADAS HASTA LA FECHA</strong><br />
              <br />
              <select name="nn" class="Estilo4" style="width: 400px;">
                <?php
$strSQL = "SELECT * FROM pgcp WHERE id_emp = '$idxx' AND afectado = '0' ORDER BY cod_pptal";
$rs = $cx->query($strSQL);
$nr = $rs->num_rows;
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_array();
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
	</form>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <?php 
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx =  $resultadoxx->fetch_assoc())
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
	  <div align="center"><?php  echo $nom_emp ?><br />
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