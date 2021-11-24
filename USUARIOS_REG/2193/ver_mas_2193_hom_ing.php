<?
session_start();
if(!session_is_registered("login"))
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

<style type="text/css">
<!--
.Estilo4 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #333333;
	font-weight: bold;
}
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
.Estilo5 {font-size: 10px; color: #333333; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
</style>

<style type="text/css">
<!--
.Estilo10 {
	font-family: Verdana;
	font-size: 10px;
	color: #FFFFFF;
}
-->
</style>

<script>
function cerrarse(){
	window.close()
}
</script>

<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>


<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
<style type="text/css">
<!--
.Estilo11 {color: #FFFFFF}
-->
</style>


<script>
function chk_cta0(){
var pos_url = 'comprueba_cta_cxp.php';
var cod = document.getElementById('id1').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>


</head>

<body>

<?
$cuentax=$_POST['cuenta'];
$cuenta=$_GET['vr'].$cuentax;
//printf("%s",$cuenta);

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }

//********* consulta si ya esta configurada

/*			$sql3 = "select * from 2193_ing_ok where cod_pptal='$cod_pptal'";
			$resultado3 = mysql_db_query($database, $sql3, $connection);
			
			while($row3 = mysql_fetch_array($resultado3)) 
			   {
			   
			   $cod=$row3["cod"];
			   $tipo=$row3["tipo"];
			   $trimestre=$row3["trimestre"];
			   $concepto=$row3["concepto"];
			   $cod_pptal=$row3["cod_pptal"];
			   $nom_rubro=$row3["nom_rubro"];
			   $definitivo=$row3["definitivo"];
			   
			
			   }*/

//*****************
   
$sqlxx2 = "select * from car_ppto_ing where id_emp='$id_emp' and cod_pptal ='$cuenta'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
   {
   
   $nom_rubro=$rowxx2["nom_rubro"];
   $definitivo=$rowxx2["ppto_aprob"];
   $tip_dato=$rowxx2["tip_dato"];

 
   }   
   



?>
<br />
<form name="a" method="post" action="guardar_2193_hom_ing.php">
<table width="600" border="1" align="center" class="bordepunteado1">
 
  <tr>
    <td colspan="4" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">HOMOLOGACION PARA INFORME 2193 - INGRESOS </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">DATOS GENERALES DE LA CUENTA SELECCIONADA </div>
    </div></td>
  </tr>
  <tr>
    <td width="284" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right">CUENTA : </div>
    </div></td>
    <td colspan="3" width="298"><div class="Estilo5" style="padding-left:15px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><? printf("%s",$cuenta);?>
        <input name="cuenta" type="hidden" value="<? printf("%s",$cuenta);?>" />
      </div>
    </div></td>
  </tr>
  <tr>
    <td bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">NOMBRE : </div>
    </div></td>
    <td colspan="3"><div class="Estilo5" style="padding-left:15px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="left"><? printf("%s",$nom_rubro);?>
            <input name="nom_rubro" type="hidden" value="<? printf("%s",$nom_rubro);?>" />
        </div>
    </div></td>
  </tr>
  <tr>
    <td bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">PRESUPUESTO INICIAL  : </div>
    </div></td>
    <td colspan="3"><div class="Estilo5" style="padding-left:15px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="left"><? echo number_format($definitivo,2,',','.'); // printf("%s",$definitivo);?>
          <input name="definitivo" type="hidden" value="<? printf("%s",$definitivo);?>" />
        </div>
    </div></td>
  </tr>
  
  <tr>
    <td colspan="4" bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">SELECCIONE CONCEPTO DE HOMOLOGACION    : </div>
    </div></td>
    </tr>
  
  <tr>
    <td colspan="4" bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <select name="concepto_2193_ing" class="Estilo5" id="cod_ini" style="width: 400px;">
          <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM 2193_ing WHERE tipo = 'D' ORDER BY cod";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod"]."\">".$r["concepto"]."</b></OPTION>";
}
?>
                        </select>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
        <div align="center">
           <input name="Submit" type="submit" class="Estilo5" value="Guardar Concepto" />
        </div>
    </div></td>
    </tr>
</table>
</form>
<BR />
<form name="aaa">
  <div align="center" class="Estilo4">
    <input name="Submit" type="button" class="Estilo5" value="Cerrar Ventana" onclick="cerrarse()" />
  </div>
</form>

</body>
</html>
<?
}
?>
