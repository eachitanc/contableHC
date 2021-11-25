<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<style type="text/css">
<!--
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
.Estilo9 {font-weight: bold}
.Estilo10 {font-weight: bold}
.Estilo11 {font-weight: bold}
</style>
<style type="text/css">
<!--
.Estilo8 {color: #FFFFFF}
-->
</style>
<?php

$id_unico=$_GET['var'];
$consecutivo = $_GET['var2'];

//printf("$id_unico <br> $consecutivo");

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From reip_ing Where id='$id_unico'";
mysql_query($sSQL);

//sacar total de vr_obligado y comparar con total de valor, si son =0 -> contab = si

$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(vr_recaudado) AS TOTAL from reip_ing WHERE consecutivo = '$consecutivo'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$tot_vr_obligado = $total;

$resulta2=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE consecutivo = '$consecutivo'",$link) or die (mysql_error());
$row2=$resulta2->fetch_array();
$total2=$row2[0]; 
$tot_vr = $total2;

/*if($tot_vr != $tot_vr_obligado)
{

$sql3 = "update reip_ing set contab='NO' where consecutivo = '$consecutivo'";
$resultado3 = mysql_db_query($database, $sql3, $connectionxx);

}   
*/		
		
		
?>	
<DIV id="prepage" style="position:absolute; font-family:arial; font-size:16; left:0px; top:0px; background-color:white; layer-background-color:white; height:100%; width:100%;"> 
<TABLE width=100%>
<TR>
<TD>
<br />
<br />
<br />
<center class='Estilo4'>
<B>LA REVERSION SE ELIMINO CON EXITO</B><BR />
<font color="#990000"><B>RECUERDE REALIZAR UNA NOTA DE CONTABILIDAD AJUSTANDO LA CUENTA POR COBRAR</B></font>
<br />
<br />
<a href="hisreip.php?consecutivo=<?php printf("$consecutivo"); ?>" target="_parent">VOLVER</a>
</center>
</TD>
</TR>
</TABLE>
</DIV>

<?php
}
?>