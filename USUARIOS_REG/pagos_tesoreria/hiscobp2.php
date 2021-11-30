<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
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
.Estilo8 {color: #990000}
</style>
<script type="text/javascript">
//Actualizar una vez al cargar p�gina
//script por tunait!
//ver condiciones de uso en http://javascript.tunait.com/
window.onunload = sale;
var valor;
if(document.cookie){
	galleta = unescape(document.cookie)
	galleta = galleta.split(';')
	for(m=0; m<galleta.length; m++){
		if(galleta[m].split('=')[0] == "recarga"){
			valor = galleta[m].split('=')[1]
			break;
		}
	}
	if(valor == "sip"){
		document.cookie = "recarga=nop"; 
		window.onunload = function(){};
		document.location.reload()
	}
	else{
	window.onunload=sale
	}
}
function sale(){
	document.cookie ="recarga=sip"
}
</script>
<script>
function cerrarVentana(){
window.opener.location.reload(); //Actualiza el padre
window.close(); //Cierra la hija.
}
</script>
</head>
<body>
<center>
<form>
<input type=button value='Cerrar Ventana' onclick='cerrarVentana()'>
</form>
</center>

<?php
$var=$_GET['vr'];

//echo $var;

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
printf("
<center>
<table width='750' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
     <td width='150'></td>
    <td width='150'></td>
    <td width='150'></td>
    <td width='150'></td>
    <td width='150'></td>
</tr>
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>HISTORICO DEL DCTO</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
    
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>FECHA</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>INFORMACION</b></center>
	</div>
	</td>
</tr>
");

// saca el id del cdpp desde crpp
$sqlcobp = "select * from cobp where id_auto_cobp = '$var'";
$resulcobp = mysql_db_query($database, $sqlcobp, $connectionxx);
while($rowcobp = mysql_fetch_array($resulcobp)) 
{
	
 	$var2=$rowcobp["id_auto_crpp"];
    //$id_manu_cobp 
 
}
// saca el id del cdpp desde crpp
$sqlxxa = "select * from crpp where id_auto_crpp = '$var2'";
$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);
while($rowxxa = mysql_fetch_array($resultadoxxa)) 
{
 $id_auto_cdpp=$rowxxa["id_auto_cdpp"];
 $id_manu_cdpp=$rowxxa["id_manu_cdpp"];
 $tercero=$rowxxa["tercero"];
}
// saca los datos del cdpp
$sqlxx = "select * from cdpp where consecutivo = '$id_auto_cdpp'";
$resultadoxx = $connectionxx->query($sqlxx);
$tot_cdpp=0;
while($rowxx = $resultadoxx->fetch_assoc()) 
{
	$id_manu_cdpp='CDPP'.$rowxx["cdpp"];
	$id_manu_cdpp2=$rowxx["cdpp"];
	$valor_cdpp=$rowxx["valor"];
	$des_cdpp=$rowxx["des"];
	$cta_cdpp=$rowxx["cuenta"];
	$fecha_cdpp=$rowxx["fecha_reg"];
	$id_unico=$rowxx["id"];
	$nom_rubro=$rowxx["nom_rubro"];
	printf("
		<tr>
		<td class='Estilo4'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<center>$id_manu_cdpp</center>
		</div>
		</td>
		<td class='Estilo4' align='left'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		%s
		</div>
		</td>
		<td class='Estilo4' align='right'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		%s
		</div>
		</td>
		<td class='Estilo4'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<center>$fecha_cdpp</center>
		</div>
		</td>
	",$cta_cdpp, number_format($valor_cdpp,2,',','.'));
		if($valor_cdpp < '0')
		{
		printf("	
		<td class='Estilo4' align='center' bgcolor ='#DCE9E5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo4' style='color:#000099'>
		Liquidacion de Saldo
		</span>
		</div>
		</td>
		");
		}
		else
		{
		printf("	
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center>
			<script type=\"text/javascript\" src=\"../wz_tooltip/wz_tooltip.js\"></script>
			<a href=\"#\" onmouseover=\"Tip('<br><b>RUBRO : </b><br><br>%s<br><br><b>CONCEPTO : </b><br><br>%s<br><br>', WIDTH, 270, TITLE, '', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, false, CLICKCLOSE, true)\" onmouseout=\"UnTip()\">Ver</a><br />
			</center>
			</div>
			</td>
		",$nom_rubro, $des_cdpp);
		}
	printf("</tr>");
	$tot_cdpp=$tot_cdpp+$valor_cdpp;
}
//****** total cdpp's 
printf("
<tr bgcolor='#F5F5F5'>
<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
</div>
</td>
<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<center><b>TOTAL CDPP's</b></center>
</div>
</td>
<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<center><b>%s</b></center>	
</div>
</td>
<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
</div>
</td>
<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
</div>
</td>
</tr>
",number_format($tot_cdpp,2,',','.'));
//****************
//***************crpp's
printf("
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>CERTIFICADO(S) DE REGISTRO PRESUPUESTAL</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>FECHA</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>INFORMACION</b></center>
	</div>
	</td>
</tr>
");
$sqlxx = "select * from crpp where id_auto_cdpp = '$id_auto_cdpp'";
$resultadoxx = $connectionxx->query($sqlxx);
$tot_crpp=0;
while($rowxx = $resultadoxx->fetch_assoc()) 
{
	$id_auto_crpp=$rowxx["id_auto_crpp"];
	$id_manu_crpp=$rowxx["id_manu_crpp"];
	$cta_crpp=$rowxx["cuenta"];
	$vr_crpp=$rowxx["vr_digitado"];
	$fecha_crpp=$rowxx["fecha_crpp"];
	$tercero_crpp=$rowxx["tercero"];
	$des_crpp=$rowxx["detalle_crpp"];
	$id_unico=$rowxx["id"];
	//**** nom rubro
	$id_a_cdpp=$rowxx["id_auto_cdpp"];
	$sqlxxe = "select * from cdpp where consecutivo = '$id_a_cdpp' and cuenta = '$cta_crpp'";
	$resultadoxxe = mysql_db_query($database, $sqlxxe, $connectionxx);
	while($rowxxe = mysql_fetch_array($resultadoxxe)) 
	{
	  $nom_rubro2=$rowxxe["nom_rubro"];
	}
if($vr_crpp != '0')
{
	
	printf("

	<tr>
	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$id_manu_crpp</center>
	</div>
	</td>
	
	<td class='Estilo4' align='left'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	$cta_crpp
	</div>
	</td>
");



		printf("	
		<td class='Estilo4' align='right'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		%s
		</div>
		</td>
		",number_format($vr_crpp,2,',','.'));


printf("	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$fecha_crpp</center>
	</div>
	</td>
");



		printf("	
		<td class='Estilo4'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<center>
		<script type=\"text/javascript\" src=\"../wz_tooltip/wz_tooltip.js\"></script>
		<a href=\"#\" onmouseover=\"Tip('<br><b>RUBRO : </b><br><br>$nom_rubro2<br><br><b>TERCERO : </b><br><br>$tercero_crpp<br><br><b>CONCEPTO : </b><br><br>%s<br><br>', WIDTH, 270, TITLE, '', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, false, CLICKCLOSE, true)\" onmouseout=\"UnTip()\">Ver</a><br />
		</center>
		</div>
		</td>
		
		</tr>
		",$des_crpp);



}//fin del if	
	$tot_crpp=$tot_crpp+$vr_crpp;
	
}//while del crpp


           //****** total crpp's 
			printf("
    
			<tr bgcolor='#F5F5F5'>
		
			
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>TOTAL CRPP's</b></center>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>%s</b></center>	
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			</tr>
		",number_format($tot_crpp,2,',','.'));
            //****************
            
			
//************************
//************************			COBP'S
printf("
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>CERTIFICADO(S) DE OBLIGACION PRESUPUESTAL</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
   
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>FECHA</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>INFORMACION</b></center>
	</div>
	</td>
</tr>
");		
$sqlxx = "select * from cobp where id_auto_crpp = '$var2'";
$resultadoxx = $connectionxx->query($sqlxx);
$tot_cobp=0;
$contt=0;
while($rowxx = $resultadoxx->fetch_assoc()) 
{
	$id_auto_cobp=$rowxx["id_auto_cobp"];
	$id_manu_cobp=$rowxx["id_manu_cobp"];
	$cuenta_cobp=$rowxx["cuenta"];
	$vr_cobp=$rowxx["vr_digitado"];
	$tercero_cobp=$rowxx["tercero"];
	$fecha_cobp=$rowxx["fecha_cobp"];
	$des_cobp=$rowxx["des_cobp"];
	$nom_rubro_cobp=$rowxx["nom_rubro"];
	$id_cobps[$contt]=$id_auto_cobp; // Llena variables de todos los cobp que afectan al resgistro 
	$cuentas[$contt]=$cuenta_cobp;
	$id2=$rowxx["id"];
	$contt++; 
	
	printf("
	
	<tr>
	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$id_manu_cobp</center>
	</div>
	</td>
	
	<td class='Estilo4' align='left'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	$cuenta_cobp
	</div>
	</td>
	
");

printf("
		<td class='Estilo4' align='right'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	%s
	</div>
	</td>
",number_format($vr_cobp,2,',','.'));

printf("
	
		<td class='Estilo4' align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	$fecha_cobp
	</div>
	</td>
	
	");
	
	if($vr_cobp < 0)
{
		printf("	
		<td class='Estilo4' align='center' bgcolor ='#000099'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo4'>
		<a href=\"eliliq3.php?var=$id2&var2=$id_auto_cobp\" target=\"_parent\" style='color:#FFFFFF'>Deshacer Liquidacion</a>
		</span>
		</div>
		</td>
		
		");
}
else
{
	
	
	printf("	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>
	<script type=\"text/javascript\" src=\"../wz_tooltip/wz_tooltip.js\"></script>
	<a href=\"#\" onmouseover=\"Tip('<br><b>RUBRO : </b><br><br>$nom_rubro_cobp<br><br><b>TERCERO : </b><br><br>$tercero_cobp<br><br><b>CONCEPTO : </b><br><br>%s<br><br>', WIDTH, 270, TITLE, '', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, false, CLICKCLOSE, true)\" onmouseout=\"UnTip()\">Ver</a><br />
	</center>
	</div>
	</td>
	
	</tr>
",$des_cobp);

}
$tot_cobp=$tot_cobp+$vr_cobp;
}	
//**** tot cobp   
printf("
 
			<tr bgcolor='#F5F5F5'>
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>TOTAL COBP's</b></center>
			</div>
			</td>
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>%s</b></center>	
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			</tr>
		",number_format($tot_cobp,2,',','.'));
//************************ cobp


printf("
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>OBLIGACION(ES) CONTABLE(S) DEL GASTO </b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
   
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>FECHA</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>INFORMACION</b></center>
	</div>
	</td>
</tr>
");	
$tot_cobp=0;
$contt2=0;
for ($i=0;$i<$contt;$i++)
{
	$sqlxx = "select * from obcg where id_auto_cobp ='$id_cobps[$i]' and liq =''";
	$resultadoxx = $connectionxx->query($sqlxx);
	$filas = mysql_num_rows($resultadoxx);
	if ($filas==0)
	{
		 $id_cobps_sinafec[$contt2]=$id_cobps[$i];
		 $contt2++;
	}
	
	while($rowxx = $resultadoxx->fetch_assoc()) 
	{
		$id_auto_cobp=$rowxx["id_auto_cobp"];
		$id_manu_obcg=$rowxx["id_manu_obcg"];
		$cuenta_cobp=$rowxx["cuenta"];
		$vr_cobp=$rowxx["tot_deb"];
		$tercero_cobp=$rowxx["tercero"];
		$fecha_cobp=$rowxx["fecha_obcg"];
		$des_cobp=$rowxx["des_cobp"];
		$nom_rubro_cobp=$rowxx["nom_rubro"];
		
		printf("
		<tr>
		<td class='Estilo4'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<center>$id_manu_obcg</center>
		</div>
		</td>
		
		<td class='Estilo4' align='left'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		$cuentas[$i]
		</div>
		</td>
		
	");
	
	printf("
			<td class='Estilo4' align='right'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		%s
		</div>
		</td>
	",number_format($vr_cobp,2,',','.'));
	
	printf("
		
			<td class='Estilo4' align='center'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		$fecha_cobp
		</div>
		</td>
		
		");
		
		printf("	
		<td class='Estilo4'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<center>
		<script type=\"text/javascript\" src=\"../wz_tooltip/wz_tooltip.js\"></script>
		<a href=\"#\" onmouseover=\"Tip('<br><b>RUBRO : </b><br><br>$nom_rubro_cobp<br><br><b>TERCERO : </b><br><br>$tercero_cobp<br><br><b>CONCEPTO : </b><br><br>%s<br><br>', WIDTH, 270, TITLE, '', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, false, CLICKCLOSE, true)\" onmouseout=\"UnTip()\">Ver</a><br />
		</center>
		</div>
		</td>
		
		</tr>
	",$des_cobp);
	
	$tot_cobp=$tot_cobp+$vr_cobp;
	}	
}
//**** tot cobp   
printf("
 
			<tr bgcolor='#F5F5F5'>
		
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>TOTAL OBCG's</b></center>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>%s</b></center>	
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			</tr>
		",number_format($tot_cobp,2,',','.'));



//************************			
			
			//****** saldo por obligar 
			
printf("
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>SALDO X OBLIGAR</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
    
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>LIQUIDAR ?</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b></b></center>
	</div>
	</td>
</tr>
");
if ($filas == 0)
{
$tot_x_reg=0;
$i=0;
$array2=array_unique($id_cobps_sinafec);
for ($i=0;$i<$contt2;$i++)
{
	$sqlxx = "select * from cobp where id_auto_cobp ='$array2[$i]' and liq =''";
	$resultadoxx = $connectionxx->query($sqlxx);
	while($rowxx = $resultadoxx->fetch_assoc()) 
	{
			$id_auto_cobp=$rowxx["id_auto_cobp"];
			$id_crpp=$rowxx["id_auto_crpp"];
			$id_manu_obcg=$rowxx["id_manu_cobp"];
			$cuenta_cobp=$rowxx["cuenta"];
			$vr_cobp=$rowxx["vr_digitado"];
			$tercero_cobp=$rowxx["tercero"];
			$fecha_cobp=$rowxx["fecha_cobp"];
			$des_cobp=$rowxx["des_cobp"];
			$nom_rubro_cobp=$rowxx["nom_rubro"];
			$id=$rowxx["id"]; 
				printf("
		
				<tr>
				<td class='Estilo4' align='center'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>$id_manu_obcg
				</div>
				</td>
				
				<td class='Estilo4' align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				$cuenta_cobp
				</div>
				</td>
				
				<td class='Estilo4' align='right'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				%s
				</div>
				</td>
				",number_format($vr_cobp,2,',','.'));
				
				if($vr_x_obli_crpp == '0')
				{
					printf("			
					<td class='Estilo4' align='center'>
					<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
					<span class='Estilo4'>
					
					</span>
					</div>
					</td>
					");
				}
				else
				{
					printf("			
					<td class='Estilo4' align='center' bgcolor ='#000099'>
					<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
					<span class='Estilo4'>
					<a href=\"liqcobp.php?id_auto_crpp=$var2&valorcobp=$vr_cobp&id_auto_cobp=$var&id_manu_cobp=$id_manu_cobp&tercero_cobp=$tercero_cobp&cuenta=$cuenta_cobp&vr_digitado=$vr_cobp&fecha_cobp=$fecha_cobp&des_cobp=$des_cobp&id_auto_crpp=$id_auto_crpp&id=$id\" target=\"_parent\" style='color:#FFFF00'>Liquidar</a>
					</span>
					</div>
					</td>
					");
				}
		
				printf("
				<td class='Estilo4'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				</div>
				</td>
			
				</tr>
				");
			
				$tot_x_reg=$tot_x_reg+$vr_x_obli_crpp;
			}	
}
}
          //****************	
//****** total x liquidar 
printf("

<tr bgcolor='#F5F5F5'>



<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
</div>
</td>

<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<center><b>TOTAL x LIQUIDAR</b></center>
</div>
</td>

<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<center><b>%s</b></center>	
</div>
</td>

<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
</div>
</td>

<td class='Estilo4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
</div>
</td>

</tr>
",number_format($tot_x_reg,2,',','.'));
//****************					
//***************
printf("</center></table>");
?>
<br>
<center>
<form>
<input type=button value='Cerrar Ventana' onclick='cerrarVentana()'>
</form>
</center>
</body>
</html>
<?php
}
?>