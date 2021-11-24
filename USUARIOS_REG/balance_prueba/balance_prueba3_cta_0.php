<?
/*session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
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
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo15 {color: #000000}
.Estilo17 {font-weight: bold}
.Estilo1x {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
</head>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:200px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='balance_prueba_cta_0.php' target='_parent' class="Estilo1x">VOLVER A PRINCIPAL </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  
  <tr>
    <td colspan="3">

<?

$fecha_ini=$_POST['fecha_ini']; //printf("fecha_ini : %s <br>",$fecha_ini);
$fecha_fin=$_POST['fecha_fin'];//printf("fecha_fin : %s <br>",$fecha_fin);
$cod_ini=$_POST['cod_ini'];//printf("cod_ini : %s <br>",$cod_ini);
$cod_fin=$_POST['cod_fin'];//printf("cod_fin : %s <br>",$cod_fin);

?>
<br />
	
<form id="form1" name="form1" method="post" action="balance_prueba3_cta_0.php">
  <div align="center">
  <input type="hidden" name="fecha_ini" value="<? printf("%s",$fecha_ini); ?>" />
  <input type="hidden" name="fecha_fin" value="<? printf("%s",$fecha_fin); ?>" />
  <input type="hidden" name="cod_ini" value="<? printf("%s",$cod_ini); ?>" />
  <input type="hidden" name="cod_fin" value="<? printf("%s",$cod_fin); ?>" />
    <select name="nivel" class="Estilo4" id="nivel">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
    </select>
    <span class="Estilo8">:::</span> 
    <input name="Submit" type="submit" class="Estilo4" value="Filtrar Balance por Nivel" />
  </div>
</form>
<?

$aux=$_POST['nivel'];

if($aux == '')
{
$aux='4';
}

printf("<center><br><span class='Estilo4'>Nivel Seleccionado : %s</span></center><br><br>",$aux);

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

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

//$sq = "select * from bal_prueba_deb order by codigo asc ";
$sq = "select * from bal_prueba_deb_cta_0 where nivel <= '$aux' order by codigo asc ";

$re = mysql_db_query($database, $sq, $cx);

// encabezados de tabla
printf("
<center>

<table width='900' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Consulta</b></span>
</div>
</td>


<td align='center' width='150'><span class='Estilo4'><b>Cod. Pptal</b></span></td>
<td align='center' width='400'><span class='Estilo4'><b>Nombre Cuenta</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='65'><span class='Estilo4'><b>Naturaleza</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Nivel</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>Valor</b></span></td>


<tr>
");

while($rw = mysql_fetch_array($re)) 
{

$nn1=$rw["codigo"];
$nat=$rw["naturaleza"];
$val=$rw["valor"];
$tipo=$rw["tipo"];
$niv1=$rw["nivel"];


/*$nat1 = substr($nn1,0,4);
			
if($nat1 == '0202' or $nat1 == '0203' or $nat1 == '0204' or $nat1 == '0207' or $nat1 == '0208' or $nat1 == '0209' or $nat1 == '0213' or $nat1 == '0243' or $nat1 == '0252' or $nat1 == '0331' or $nat1 == '0332' or $nat1 == '0334' or $nat1 == '0335' or $nat1 == '0336' or $nat1 == '0337' or $nat1 == '0350' or $nat1 == '0351' or $nat1 == '0352' or $nat1 == '0353' or $nat1 == '0354' or $nat1 == '0355' or $nat1 == '0360' or $nat1 == '0361' or $nat1 == '0362' or $nat1 == '0363' or $nat1 == '0364' or $nat1 == '0365' or $nat1 == '0370' or $nat1 == '0371' or $nat1 == '0372' or $nat1 == '0373' or $nat1 == '0374' or $nat1 == '0375' or $nat1 == '0378' or $nat1 == '0399' or $nat1 == '0432' or $nat1 == '0434' or $nat1 == '0436' or $nat1 == '0438' or $nat1 == '0440' or $nat1 == '0442' or $nat1 == '0444' or $nat1 == '0446' or $nat1 == '0450' or $nat1 == '0555' or $nat1 == '0556' or $nat1 == '0557' or $nat1 == '0558' or $nat1 == '0559' or $nat1 == '0560' or $nat1 == '0561' or $nat1 == '0562' or $nat1 == '0563' or $nat1 == '0564' or $nat1 == '0565' or $nat1 == '0566' or $nat1 == '0567' or $nat1 == '0568' or $nat1 == '0569' or $nat1 == '0570' or $nat1 == '0571' or $nat1 == '0572' or $nat1 == '0630' or $nat1 == '0631' or $nat1 == '0632' or $nat1 == '0633' or $nat1 == '0634' or $nat1 == '0635' or $nat1 == '0636' or $nat1 == '0637' or $nat1 == '0638' or $nat1 == '0639' or $nat1 == '0640' or $nat1 == '0641' or $nat1 == '0642' or $nat1 == '0643' or $nat1 == '0644' or $nat1 == '0645' or $nat1 == '0646' or $nat1 == '0647' or $nat1 == '0655' or $nat1 == '0656' or $nat1 == '0657' or $nat1 == '0658' or $nat1 == '0659' or $nat1 == '0660' or $nat1 == '0661' or $nat1 == '0662' or $nat1 == '0663' or $nat1 == '0664' or $nat1 == '0665' or $nat1 == '0666' or $nat1 == '0667' or $nat1 == '0668' or $nat1 == '0669' or $nat1 == '0670' or $nat1 == '0671' or $nat1 == '0672' or $nat1 == '0730' or $nat1 == '0731' or $nat1 == '0732' or $nat1 == '0733' or $nat1 == '0734' or $nat1 == '0735' or $nat1 == '0736' or $nat1 == '0737' or $nat1 == '0738' or $nat1 == '0739' or $nat1 == '0740' or $nat1 == '0741' or $nat1 == '0742' or $nat1 == '0743' or $nat1 == '0744' or $nat1 == '0745' or $nat1 == '0746' or $nat1 == '0747' or $nat1 == '0755' or $nat1 == '0756' or $nat1 == '0757' or $nat1 == '0758' or $nat1 == '0759' or $nat1 == '0760' or $nat1 == '0761' or $nat1 == '0762' or $nat1 == '0763' or $nat1 == '0764' or $nat1 == '0765' or $nat1 == '0766' or $nat1 == '0767' or $nat1 == '0768' or $nat1 == '0769' or $nat1 == '0770' or $nat1 == '0771' or $nat1 == '0772' or $nat1 == '0835' or $nat1 == '0840' or $nat1 == '0845' or $nat1 == '0855' or $nat1 == '0860' or $nat1 == '0935' or $nat1 == '0940')
{
$naturaleza = "DEBITO";
}
else
{
	if($nat1 == '0216' or $nat1 == '0217' or $nat1 == '0218' or $nat1 == '0219' or $nat1 == '0221' or $nat1 == '0222' or $nat1 == '0223' or $nat1 == '0224' or $nat1 == '0226' or $nat1 == '0227' or $nat1 == '0228' or $nat1 == '0229' or $nat1 == '0231' or $nat1 == '0242' or $nat1 == '0253' or $nat1 == '0254' or $nat1 == '0320' or $nat1 == '0321' or $nat1 == '0323' or $nat1 == '0324' or $nat1 == '0325' or $nat1 == '0326' or $nat1 == '0425' or $nat1 == '0430' or $nat1 == '0530' or $nat1 == '0531' or $nat1 == '0532' or $nat1 == '0533' or $nat1 == '0534' or $nat1 == '0535' or $nat1 == '0536' or $nat1 == '0537' or $nat1 == '0538' or $nat1 == '0539' or $nat1 == '0540' or $nat1 == '0541' or $nat1 == '0542' or $nat1 == '0543' or $nat1 == '0544' or $nat1 == '0545' or $nat1 == '0546' or $nat1 == '0547' or $nat1 == '0830' or $nat1 == '0850' or $nat1 == '0930')
	{
	$naturaleza = "CREDITO";
	}
}*/


if($nat == '' or $tipo == 'M')
{
printf("
<span class='Estilo4'>
<tr>

<td align='center'>
<span class='Estilo4'>

</span>
</td>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'>  </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);

$codx=$rw["codigo"];
$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(valor) AS TOTAL from bal_prueba_deb_cta_0 WHERE codigo like '$codx%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$nuevo_total = $total;


printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",$nuevo_total);
		
printf("</tr>");
}


if($nat == 'DEBITO' and $tipo != 'M')
{
printf("
<span class='Estilo4'>
<tr>

<td align='center'>
<span class='Estilo4'>
<a href=\"../informes_contabilidad/libro_auxiliar3_cta_0.php?fecha_ini=%s&fecha_fin=%s&nn=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1050,height=800,scrollbars=1'); return false;\">AUXILIAR</a>
</span>
</td>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>",$fecha_ini,$fecha_fin,$rw["codigo"],$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["naturaleza"], $rw["nivel"]);

printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",$rw["valor"]);
		
printf("</tr>");		
}

if($nat == 'CREDITO' and $tipo != 'M')
{

printf("
<span class='Estilo4'>
<tr>

<td align='center'>
<span class='Estilo4'>
<a href=\"../informes_contabilidad/libro_auxiliar3_cta_0.php?fecha_ini=%s&fecha_fin=%s&nn=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1050,height=800,scrollbars=1'); return false;\">AUXILIAR</a>
</span>
</td>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>",$fecha_ini,$fecha_fin,$rw["codigo"],$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["naturaleza"], $rw["nivel"]);

printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",$rw["valor"]);
		
printf("</tr>");
}
		
	
}//fin while
printf("</table></center>");
?>
	
	
	
	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:200px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='balance_prueba_cta_0.php' target='_parent' class="Estilo1x">VOLVER A PRINCIPAL </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
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
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
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
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>

<?
//}
?>