<?
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



<script>

function hand()
{
	document.body.style.cursor="Pointer";
}

function nohand()
{
	document.body.style.cursor="default";
}




</script>
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
            <div align="center"><a href='balance_prueba.php' target='_parent' class="Estilo1x">VOLVER A PRINCIPAL </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  
  <tr>
    <td colspan="3">

<?
include('../config.php');
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx3 = "select * from aux_bal_prueba";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
$mov=$rowxx3["mov"];
}
$fecha_ini=$_POST['fecha_ini']; //printf("fecha_ini : %s <br>",$fecha_ini);
$fecha_fin=$_POST['fecha_fin'];//printf("fecha_fin : %s <br>",$fecha_fin);
$cod_ini=$_POST['cod_ini'];//printf("cod_ini : %s <br>",$cod_ini);
$cod_fin=$_POST['cod_fin'];//printf("cod_fin : %s <br>",$cod_fin);
?>

	
<form id="form1" name="form1" method="post" action="balance_prueba3.php">
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
$sq = "select * from bal_prueba_deb where nivel <= '$aux' order by codigo asc ";
$re = mysql_db_query($database, $sq, $cx);
// encabezados de tabla
?><div> <a href="balance_prueba33.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin" style='color:#0033FF'> <img src="../simbolos/CALC.png" width="60" height="50" alt="calc" title="Exportar a Ecxel"  onmouseover="hand();" onmouseout="nohand();" border="0"  /> </a></div> <?php
printf("
<center>

<table width='960' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Consulta</b></span>
</div>
</td>


<td align='center' width='150'><span class='Estilo4'><b>Cod. Pptal</b></span></td>
<td align='center' width='400'><span class='Estilo4'><b>Nombre Cuenta</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Nivel</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>Credito</b></span></td>

<tr>
");

while($rw = mysql_fetch_array($re)) 
{

$nn1=$rw["codigo"];
/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/
//******* naturaleza de la cuenta
			$nat1 = substr($nn1,0,1);
			
			$nat2 = substr($nn1,0,2);
			
		if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
			{	$naturaleza = "DEBITO";	}
			else
			{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89')
				{
				$naturaleza = "CREDITO";
				}
			}


if($naturaleza == 'DEBITO')
{

	$tipo=$rw["tipo"];
	$nivel=$rw["nivel"];
	if($tipo == 'D')
	{
		if ($mov == 'SI') 
		{
			$cred = $rw["credito"]; }else{ $cred =0;
		}
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='center'>
			<span class='Estilo4'>
			<a href=\"../informes_contabilidad/libro_auxiliar3.php?fecha_ini=%s&fecha_fin=%s&nn=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1050,height=800,scrollbars=1'); return false;\">AUXILIAR</a>
			</span>
			</td>
			
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>",$fecha_ini,$fecha_fin,$rw["codigo"],$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
			
			printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
					<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($rw["debito"],2,'.',','),number_format($cred,2,'.',','));
			
				printf("</tr>");		
	}
	else
	{
				
				$cod=$rw["codigo"];
				$link=mysql_connect($server,$dbuser,$dbpass);
				$resulta=mysql_query("select SUM(debito) AS TOTAL, sum(credito) as tot_cre from bal_prueba_deb WHERE tipo = 'D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$total=$row[0]; 
				$tot_cre=$row[1]; 
				$nuevo_total = $total;
				//printf("acu : %s",$nuevo_total);
				
/*				if($nuevo_total == '')
				{$nuevo_total = 0.00;}*/
				
				if($nuevo_total == '')
				{
				
				}
				else
				{
				
						//*** nuevo 25/05/2010
						if($cod == '9')
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='center'><span class='Estilo4'>  </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>");
								
						printf("</tr>");
						
						}
						//**************
						else
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='center'><span class='Estilo4'>  </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($nuevo_total,2,'.',','),number_format($tot_cre,2,'.',','));
								
						printf("</tr>");
						}
						
				}
						
				
				
	
	}
	
}	
else// si la naturaleza es credito
{
	
	$tipo=$rw["tipo"];
	if($tipo == 'D')
	{
		if ($mov == 'SI') 
		{
			$debit = $rw["debito"]; }else{ $debit =0;
		}
    printf("
	<span class='Estilo4'>
	<tr>
	
				<td align='center'>
			<span class='Estilo4'>
			<a href=\"../informes_contabilidad/libro_auxiliar3.php?fecha_ini=%s&fecha_fin=%s&nn=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1050,height=800,scrollbars=1'); return false;\">AUXILIAR</a>
			</span>
			</td>
	
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='center'><span class='Estilo4'> %s </span></td>
	<td align='center'><span class='Estilo4'> %s </span></td>",$fecha_ini,$fecha_fin,$rw["codigo"],$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
	 
	
	printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
			<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($debit,2,'.',','),number_format($rw["credito"],2,'.',','));
			
		printf("</tr>");		
	
	}
	else
	{
	
	$cod=$rw["codigo"];
	$link=mysql_connect($server,$dbuser,$dbpass);
	$resulta=mysql_query("select SUM(credito) AS TOTAL, sum(debito) as tot_deb from bal_prueba_deb WHERE tipo = 'D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total=$row[0]; 
	$tot_deb=$row[1];
	$nuevo_total = $total;
	//printf("acu : %s",$nuevo_total);
/*	if($nuevo_total == '')
	{$nuevo_total = 0.00;}*/
				if($nuevo_total == '')
				{
				
				}
				else
				{
					
				
						//*** nuevo 25/05/2010
						if($cod == '9')
						{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='center'><span class='Estilo4'>  </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
						
						printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>
								<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>0.00</span></td>");
								
						printf("</tr>");
						
						}
						else
						{
						//**************
							
							
							
							
							
							printf("
							<span class='Estilo4'>
							<tr>
							<td align='center'><span class='Estilo4'>  </span></td>
							<td align='left'><span class='Estilo4'> %s </span></td>
							<td align='left'><span class='Estilo4'> %s </span></td>
							<td align='center'><span class='Estilo4'> %s </span></td>
							<td align='center'><span class='Estilo4'> %s </span></td>",$rw["codigo"], $rw["nombre"], $rw["tipo"], $rw["nivel"]);
							
							printf("<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>
									<td bgcolor='#EBEBE4' align='right'><span class='Estilo4'>%s</span></td>",number_format($tot_deb,2,'.',','),number_format($nuevo_total,2,'.',','));
									
							printf("</tr>");
						}	
				}
	
	
	}

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
            <div align="center"><a href='balance_prueba.php' target='_parent' class="Estilo1x">VOLVER A PRINCIPAL </a> </div>
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
}
?>