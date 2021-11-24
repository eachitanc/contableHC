<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RELACION DE PAGOS.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"0"	
	}
</style>
</head>

<body>
<?
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
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }    
?>	
	<form name="a" method="post" action="retefuente.php">
</form>	
	<?
	$fecha_ini=$_POST['fecha_ini'];
	$fecha_fin=$_POST['fecha_fin'];	
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?>
	 <?php
//-------

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and id_emp = '$id_emp' and cuenta like '%2436'";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>

<table width='2400' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>

<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Fecha del Pago</b></span>
</div>
</td>

<td align='center' width='100'><span class='Estilo4'><b>id_auto</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>documento</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>cta</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>base</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>valor</b></span></td>
</tr>

");

while($rw = mysql_fetch_array($re)) 
{
   
//*** INFO CEVA ***//
//*** porcentaje retefuente 
$concepto = $rw["retefuente"];  
$sqlxx = "select * from retefuente where concepto = '$concepto'";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{$tarifa=$rowxx["tarifa"]; }   
//*** vr bruto pagado
$bruto = $rw["total_pagado"] + $rw["salud"] + $rw["pension"] + $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["embargo"] + $rw["cruce"] + $rw["otros"] + $rw["vr_retefuente"] + $rw["vr_reteiva"] + $rw["vr_reteica"] + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"];
//*** otros desctos
$otros_desc = $rw["salud"] + $rw["pension"] + $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["embargo"] + $rw["cruce"] + $rw["otros"]  + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"]; 
//*** neto pagado
$neto_pagado = $bruto - $rw["vr_retefuente"] - $rw["vr_reteiva"]  - $otros_desc - $rw["vr_reteica"];

$tarifa2 =($rw["vr_retefuente"]/$bruto)*100;
printf("
<span class='Estilo4'>
<tr>

<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left' class='text'>
", $rw["fecha_ceva"]);
 

//*** imputaciones afectadas
$id_auto_cobp = $rw["id_auto_cobp"];
$sqlxx2 = "select cobp.cuenta FROM cobp INNER JOIN ceva ON ceva.id_auto_cobp = cobp.id_auto_cobp where ceva.id_auto_cobp = '$id_auto_cobp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
 $cuenta=$rowxx2["cuenta"]; 
 printf("%s<br>",$cuenta);
}  


printf("
</td>

<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> VIG. ACTUAL </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'>
"
, $rw["id_manu_ceva"],$rw["ccnit"],$rw["tercero"],$rw["des_ceva"],
number_format($bruto,2,'.',','),$tarifa2,$rw["retefuente"],number_format($rw["vr_retefuente"],2,'.',','),number_format($rw["vr_reteiva"],2,'.',','),number_format($rw["vr_reteica"],2,'.',','),number_format($otros_desc,2,'.',','),number_format($neto_pagado,2,'.',','));

//*** codigo del banco pgcp (saca nombre del banco y cuenta del pgcp)
$id_auto_ceva = $rw["id_auto_ceva"];
$sqlxx3 = "select * FROM ceva where id_emp='$id_emp' and id_auto_ceva = '$id_auto_ceva'";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{

$pgcp1 = $rowxx3["pgcp1"];
$pgcp2 = $rowxx3["pgcp2"];
$pgcp3 = $rowxx3["pgcp3"];
$pgcp4 = $rowxx3["pgcp4"];
$pgcp5 = $rowxx3["pgcp5"];
$pgcp5 = $rowxx3["pgcp6"];
$pgcp7 = $rowxx3["pgcp7"];
$pgcp8 = $rowxx3["pgcp8"];
$pgcp9 = $rowxx3["pgcp9"];
$pgcp10 = $rowxx3["pgcp10"];
$pgcp11 = $rowxx3["pgcp11"];
$pgcp12 = $rowxx3["pgcp12"];
$pgcp13 = $rowxx3["pgcp13"];
$pgcp14 = $rowxx3["pgcp14"];
$pgcp15 = $rowxx3["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

		if($a == '1110')
		{			 printf("%s<br>",$pgcp1);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp1'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco1=$rowxx["nom_banco1"];
					   $num_cta1=$rowxx["num_cta"];
					   }
					if($nom_banco1 == '' and $num_cta1 == '')
					{
					   $nom_banco1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}
					   	
						  
		
		}
		if($b == '1110')
		{			 printf("%s<br>",$pgcp2);		    
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp2'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco2=$rowxx["nom_banco1"];
					   $num_cta2=$rowxx["num_cta"];
					   }
					if($nom_banco2 == '' and $num_cta2 == '')
					{
					   $nom_banco2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   
		
		
		}
		if($c == '1110')
		{			 printf("%s<br>",$pgcp3);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp3'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco3=$rowxx["nom_banco1"];
					   $num_cta3=$rowxx["num_cta"];
					   }	
					if($nom_banco3 == '' and $num_cta3 == '')
					{
					   $nom_banco3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   		
		
		}
		if($d == '1110')
		{			 printf("%s<br>",$pgcp4);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp4'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco4=$rowxx["nom_banco1"];
					   $num_cta4=$rowxx["num_cta"];
					   }
					if($nom_banco4 == '' and $num_cta4 == '')
					{
					   $nom_banco4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($e == '1110')
		{			 printf("%s<br>",$pgcp5);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp5'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco5=$rowxx["nom_banco1"];
					   $num_cta5=$rowxx["num_cta"];
					   }	
					if($nom_banco5 == '' and $num_cta5 == '')
					{
					   $nom_banco5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($f == '1110')
		{			 printf("%s<br>",$pgcp6);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp6'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco6=$rowxx["nom_banco1"];
					   $num_cta6=$rowxx["num_cta"];
					   }
					if($nom_banco6 == '' and $num_cta6 == '')
					{
					   $nom_banco6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($g == '1110')
		{			 printf("%s<br>",$pgcp7);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp7'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco7=$rowxx["nom_banco1"];
					   $num_cta7=$rowxx["num_cta"];
					   }
					if($nom_banco7 == '' and $num_cta7 == '')
					{
					   $nom_banco7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($h == '1110')
		{			 printf("%s<br>",$pgcp8);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp8'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco8=$rowxx["nom_banco1"];
					   $num_cta8=$rowxx["num_cta"];
					   }
					if($nom_banco8 == '' and $num_cta8 == '')
					{
					   $nom_banco8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($i == '1110')
		{			 printf("%s<br>",$pgcp9);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp9'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco9=$rowxx["nom_banco1"];
					   $num_cta9=$rowxx["num_cta"];
					   }	
					if($nom_banco9 == '' and $num_cta9 == '')
					{
					   $nom_banco9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($j == '1110')
		{			 printf("%s<br>",$pgcp10);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp10'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco10=$rowxx["nom_banco1"];
					   $num_cta10=$rowxx["num_cta"];
					   }
					if($nom_banco10 == '' and $num_cta10 == '')
					{
					   $nom_banco10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   
							
					
		
		}
		if($k == '1110')
		{			 printf("%s<br>",$pgcp11);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp11'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco11=$rowxx["nom_banco1"];
					   $num_cta11=$rowxx["num_cta"];
					   }
					if($nom_banco11 == '' and $num_cta11 == '')
					{
					   $nom_banco11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($l == '1110')
		{			 printf("%s<br>",$pgcp12);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp12'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco12=$rowxx["nom_banco1"];
					   $num_cta12=$rowxx["num_cta"];
					   }	
					if($nom_banco12 == '' and $num_cta12 == '')
					{
					   $nom_banco12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($m == '1110')
		{			 printf("%s<br>",$pgcp13);	
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp13'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco13=$rowxx["nom_banco1"];
					   $num_cta13=$rowxx["num_cta"];
					   }		
					if($nom_banco13 == '' and $num_cta13 == '')
					{
					   $nom_banco13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
				
		
		}
		if($n == '1110')
		{			 printf("%s<br>",$pgcp14);	
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp14'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco14=$rowxx["nom_banco1"];
					   $num_cta14=$rowxx["num_cta"];
					   }		
					if($nom_banco14 == '' and $num_cta14 == '')
					{
					   $nom_banco14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
		 		
		
		}
		if($o == '1110')
		{			 printf("%s<br>",$pgcp15);	
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp15'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco15=$rowxx["nom_banco1"];
					   $num_cta15=$rowxx["num_cta"];
					   }		
					if($nom_banco15 == '' and $num_cta15 == '')
					{
					   $nom_banco15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
				
		
		}

} 
printf("
</span></td>
<td align='left'><span class='Estilo4'>

");
//*** nombre del banco
$sqlxx3a = "select * FROM ceva where id_emp='$id_emp' and id_auto_ceva = '$id_auto_ceva'";
$resultadoxx3a = mysql_db_query($database, $sqlxx3a, $connectionxx);
while($rowxx3a = mysql_fetch_array($resultadoxx3a)) 
{

$pgcp1 = $rowxx3a["pgcp1"];
$pgcp2 = $rowxx3a["pgcp2"];
$pgcp3 = $rowxx3a["pgcp3"];
$pgcp4 = $rowxx3a["pgcp4"];
$pgcp5 = $rowxx3a["pgcp5"];
$pgcp5 = $rowxx3a["pgcp6"];
$pgcp7 = $rowxx3a["pgcp7"];
$pgcp8 = $rowxx3a["pgcp8"];
$pgcp9 = $rowxx3a["pgcp9"];
$pgcp10 = $rowxx3a["pgcp10"];
$pgcp11 = $rowxx3a["pgcp11"];
$pgcp12 = $rowxx3a["pgcp12"];
$pgcp13 = $rowxx3a["pgcp13"];
$pgcp14 = $rowxx3a["pgcp14"];
$pgcp15 = $rowxx3a["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

		if($a == '1110')
		{			/* printf("%s<br>",$rowxx3a["banco_cheque"]);*/	 printf("# %s<br>",$nom_banco1);       	}
		if($b == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque2"]);*/ printf("# %s<br>",$nom_banco2);		    }
		if($c == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque3"]);*/ printf("# %s<br>",$nom_banco3);		    }
		if($d == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque4"]);*/ printf("# %s<br>",$nom_banco4);		    }
		if($e == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque5"]);*/ printf("# %s<br>",$nom_banco5);		    }
		if($f == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque6"]);*/ printf("# %s<br>",$nom_banco6);		    }
		if($g == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque7"]);*/ printf("# %s<br>",$nom_banco7);		    }
		if($h == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque8"]);*/ printf("# %s<br>",$nom_banco8);		    }
		if($i == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque9"]);*/ printf("# %s<br>",$nom_banco9);		    }
		if($j == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque10"]);*/ printf("# %s<br>",$nom_banco10);		    }
		if($k == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque11"]);*/ printf("# %s<br>",$nom_banco11);		    }
		if($l == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque12"]);*/ printf("# %s<br>",$nom_banco12);		    }
		if($m == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque13"]);*/ printf("# %s<br>",$nom_banco13);		    }
		if($n == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque14"]);*/ printf("# %s<br>",$nom_banco14);		    }
		if($o == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque15"]);*/ printf("# %s<br>",$nom_banco15);		    }

} 			 

printf("
</span></td>
<td align='left'><span class='Estilo4'>


");

//*** numero de cuenta
$sqlxx3b = "select * FROM ceva where id_emp='$id_emp' and id_auto_ceva = '$id_auto_ceva'";
$resultadoxx3b = mysql_db_query($database, $sqlxx3b, $connectionxx);
while($rowxx3b = mysql_fetch_array($resultadoxx3b)) 
{

$pgcp1 = $rowxx3b["pgcp1"];
$pgcp2 = $rowxx3b["pgcp2"];
$pgcp3 = $rowxx3b["pgcp3"];
$pgcp4 = $rowxx3b["pgcp4"];
$pgcp5 = $rowxx3b["pgcp5"];
$pgcp5 = $rowxx3b["pgcp6"];
$pgcp7 = $rowxx3b["pgcp7"];
$pgcp8 = $rowxx3b["pgcp8"];
$pgcp9 = $rowxx3b["pgcp9"];
$pgcp10 = $rowxx3b["pgcp10"];
$pgcp11 = $rowxx3b["pgcp11"];
$pgcp12 = $rowxx3b["pgcp12"];
$pgcp13 = $rowxx3b["pgcp13"];
$pgcp14 = $rowxx3b["pgcp14"];
$pgcp15 = $rowxx3b["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

		if($a == '1110')
		{			 /*printf("%s<br>",$cta_cheque);*/ printf("# %s<br>",$num_cta1); 	        }
		if($b == '1110')
		{			 /*printf("%s<br>",$cta_cheque2);*/ printf("# %s<br>",$num_cta2); 	        }
		if($c == '1110')
		{			 /*printf("%s<br>",$cta_cheque3);*/ printf("# %s<br>",$num_cta3); 	        }
		if($d == '1110')
		{			 /*printf("%s<br>",$cta_cheque4);*/ printf("# %s<br>",$num_cta4); 	        }
		if($e == '1110')
		{			 /*printf("%s<br>",$cta_cheque5);*/ printf("# %s<br>",$num_cta5); 	        }
		if($f == '1110')
		{			 /*printf("%s<br>",$cta_cheque6);*/ printf("# %s<br>",$num_cta6); 	        }
		if($g == '1110')
		{			 /*printf("%s<br>",$cta_cheque7);*/ printf("# %s<br>",$num_cta7); 	        }
		if($h == '1110')
		{			 /*printf("%s<br>",$cta_cheque8);*/ printf("# %s<br>",$num_cta8); 	        }
		if($i == '1110')
		{			 /*printf("%s<br>",$cta_cheque9);*/ printf("# %s<br>",$num_cta9); 	        }
		if($j == '1110')
		{			 /*printf("%s<br>",$cta_cheque10);*/ printf("# %s<br>",$num_cta10); 	        }
		if($k == '1110')
		{			 /*printf("%s<br>",$cta_cheque11);*/ printf("# %s<br>",$num_cta11); 	        }
		if($l == '1110')
		{			 /*printf("%s<br>",$cta_cheque12);*/ printf("# %s<br>",$num_cta12); 	        }
		if($m == '1110')
		{			 /*printf("%s<br>",$cta_cheque13);*/ printf("# %s<br>",$num_cta13); 	        }
		if($n == '1110')
		{			 /*printf("%s<br>",$cta_cheque14);*/ printf("# %s<br>",$num_cta14); 	        }
		if($o == '1110')
		{			 /*printf("%s<br>",$cta_cheque15);*/ printf("# %s<br>",$num_cta15); 	        }

} 			 


printf("
</span></td>
<td align='left'><span class='Estilo4'>

");


//*** numero de cheque
$id_auto_ceva = $rw["id_auto_ceva"];
$sqlxx3c = "select * FROM ceva where id_emp='$id_emp' and id_auto_ceva = '$id_auto_ceva'";
$resultadoxx3c = mysql_db_query($database, $sqlxx3c, $connectionxx);
while($rowxx3c = mysql_fetch_array($resultadoxx3c)) 
{

$pgcp1 = $rowxx3c["pgcp1"];
$pgcp2 = $rowxx3c["pgcp2"];
$pgcp3 = $rowxx3c["pgcp3"];
$pgcp4 = $rowxx3c["pgcp4"];
$pgcp5 = $rowxx3c["pgcp5"];
$pgcp5 = $rowxx3c["pgcp6"];
$pgcp7 = $rowxx3c["pgcp7"];
$pgcp8 = $rowxx3c["pgcp8"];
$pgcp9 = $rowxx3c["pgcp9"];
$pgcp10 = $rowxx3c["pgcp10"];
$pgcp11 = $rowxx3c["pgcp11"];
$pgcp12 = $rowxx3c["pgcp12"];
$pgcp13 = $rowxx3c["pgcp13"];
$pgcp14 = $rowxx3c["pgcp14"];
$pgcp15 = $rowxx3c["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

		if($a == '1110')
		{			 printf("%s<br>",$rowxx3c["num_cheque"]);	        }
		if($b == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque2"],$rowxx3c["num_cheque"]);		    }
		if($c == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque3"],$rowxx3c["num_cheque"]);			}
		if($d == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque4"],$rowxx3c["num_cheque"]);			}
		if($e == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque5"],$rowxx3c["num_cheque"]);			}
		if($f == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque6"],$rowxx3c["num_cheque"]);			}
		if($g == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque7"],$rowxx3c["num_cheque"]);			}
		if($h == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque8"],$rowxx3c["num_cheque"]);			}
		if($i == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque9"],$rowxx3c["num_cheque"]);			}
		if($j == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque10"],$rowxx3c["num_cheque"]);			}
		if($k == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque11"],$rowxx3c["num_cheque"]);			}
		if($l == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque12"],$rowxx3c["num_cheque"]);			}
		if($m == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque13"],$rowxx3c["num_cheque"]);			}
		if($n == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque14"],$rowxx3c["num_cheque"]);	 		}
		if($o == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque15"],$rowxx3c["num_cheque"]);			}

} 			 


printf("
</span></td>
</tr>"); 

}// FIN DEL WHILE



//********************************************
//********************************************
//********************************************


$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cecp where (fecha_cecp between '$fecha_ini' and '$fecha_fin' ) and id_emp = '$id_emp' order by fecha_cecp asc ";
$re = mysql_db_query($database, $sq, $cx);

while($rw = mysql_fetch_array($re)) 
{

//*** INFO CECP ***//
//*** porcentaje retefuente 
$concepto = $rw["retefuente"];  
$sqlxx = "select * from retefuente where concepto = '$concepto'";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{$tarifa=$rowxx["tarifa"]; }   
//*** vr bruto pagado
$bruto = $rw["total_pagado"] + $rw["salud"] + $rw["pension"] + $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["embargo"] + $rw["cruce"] + $rw["otros"] + $rw["vr_retefuente"] + $rw["vr_reteiva"] + $rw["vr_reteica"] + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"];
//*** otros desctos
$otros_desc = $rw["salud"] + $rw["pension"] + $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["embargo"] + $rw["cruce"] + $rw["otros"]  + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"]; 
//*** neto pagado
$neto_pagado = $bruto - $rw["vr_retefuente"] - $rw["vr_reteiva"]  - $otros_desc - $rw["vr_reteica"];
$tarifa3 = ($rw["vr_retefuente"]/$bruto)*100;

printf("
<span class='Estilo4'>
<tr>

<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'>
", $rw["fecha_cecp"]);
 

//*** imputaciones afectadas
$id_auto_cecp = $rw["id_auto_cecp"];
$sqlxx2 = "select * FROM cecp_cuenta where id_auto_cecp = '$id_auto_cecp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{$cuenta=$rowxx2["cuenta"]; 
 printf("%s<br>",$cuenta);
}  


printf("
</span></td>

<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> VIG. ANTERIOR </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'>
"
, $rw["id_manu_cecp"],$rw["cn"],$rw["nt"],$rw["concepto_pago"],
number_format($bruto,2,'.',','),$tarifa3,$rw["retefuente"],number_format($rw["vr_retefuente"],2,'.',','),number_format($rw["vr_reteiva"],2,'.',','),number_format($rw["vr_reteica"],2,'.',','),number_format($otros_desc,2,'.',','),number_format($neto_pagado,2,'.',','));

//*** codigo del banco pgcp
$id_auto_cecp = $rw["id_auto_cecp"];
$sqlxx3 = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{

$pgcp1 = $rowxx3["pgcp1"];
$pgcp2 = $rowxx3["pgcp2"];
$pgcp3 = $rowxx3["pgcp3"];
$pgcp4 = $rowxx3["pgcp4"];
$pgcp5 = $rowxx3["pgcp5"];
$pgcp5 = $rowxx3["pgcp6"];
$pgcp7 = $rowxx3["pgcp7"];
$pgcp8 = $rowxx3["pgcp8"];
$pgcp9 = $rowxx3["pgcp9"];
$pgcp10 = $rowxx3["pgcp10"];
$pgcp11 = $rowxx3["pgcp11"];
$pgcp12 = $rowxx3["pgcp12"];
$pgcp13 = $rowxx3["pgcp13"];
$pgcp14 = $rowxx3["pgcp14"];
$pgcp15 = $rowxx3["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

if($a == '1110')
		{			 printf("%s<br>",$pgcp1);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp1'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco1=$rowxx["nom_banco1"];
					   $num_cta1=$rowxx["num_cta"];
					   }
					if($nom_banco1 == '' and $num_cta1 == '')
					{
					   $nom_banco1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta1="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}
					   	
						  
		
		}
		if($b == '1110')
		{			 printf("%s<br>",$pgcp2);		    
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp2'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco2=$rowxx["nom_banco1"];
					   $num_cta2=$rowxx["num_cta"];
					   }
					if($nom_banco2 == '' and $num_cta2 == '')
					{
					   $nom_banco2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta2="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   
		
		
		}
		if($c == '1110')
		{			 printf("%s<br>",$pgcp3);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp3'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco3=$rowxx["nom_banco1"];
					   $num_cta3=$rowxx["num_cta"];
					   }	
					if($nom_banco3 == '' and $num_cta3 == '')
					{
					   $nom_banco3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta3="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}					   		
		
		}
		if($d == '1110')
		{			 printf("%s<br>",$pgcp4);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp4'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco4=$rowxx["nom_banco1"];
					   $num_cta4=$rowxx["num_cta"];
					   }
					if($nom_banco4 == '' and $num_cta4 == '')
					{
					   $nom_banco4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta4="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($e == '1110')
		{			 printf("%s<br>",$pgcp5);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp5'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco5=$rowxx["nom_banco1"];
					   $num_cta5=$rowxx["num_cta"];
					   }	
					if($nom_banco5 == '' and $num_cta5 == '')
					{
					   $nom_banco5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta5="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($f == '1110')
		{			 printf("%s<br>",$pgcp6);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp6'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco6=$rowxx["nom_banco1"];
					   $num_cta6=$rowxx["num_cta"];
					   }
					if($nom_banco6 == '' and $num_cta6 == '')
					{
					   $nom_banco6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta6="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($g == '1110')
		{			 printf("%s<br>",$pgcp7);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp7'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco7=$rowxx["nom_banco1"];
					   $num_cta7=$rowxx["num_cta"];
					   }
					if($nom_banco7 == '' and $num_cta7 == '')
					{
					   $nom_banco7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta7="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($h == '1110')
		{			 printf("%s<br>",$pgcp8);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp8'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco8=$rowxx["nom_banco1"];
					   $num_cta8=$rowxx["num_cta"];
					   }
					if($nom_banco8 == '' and $num_cta8 == '')
					{
					   $nom_banco8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta8="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($i == '1110')
		{			 printf("%s<br>",$pgcp9);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp9'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco9=$rowxx["nom_banco1"];
					   $num_cta9=$rowxx["num_cta"];
					   }	
					if($nom_banco9 == '' and $num_cta9 == '')
					{
					   $nom_banco9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta9="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($j == '1110')
		{			 printf("%s<br>",$pgcp10);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp10'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco10=$rowxx["nom_banco1"];
					   $num_cta10=$rowxx["num_cta"];
					   }
					if($nom_banco10 == '' and $num_cta10 == '')
					{
					   $nom_banco10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta10="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   
							
					
		
		}
		if($k == '1110')
		{			 printf("%s<br>",$pgcp11);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp11'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco11=$rowxx["nom_banco1"];
					   $num_cta11=$rowxx["num_cta"];
					   }
					if($nom_banco11 == '' and $num_cta11 == '')
					{
					   $nom_banco11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta11="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   			
					
		
		}
		if($l == '1110')
		{			 printf("%s<br>",$pgcp12);
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp12'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco12=$rowxx["nom_banco1"];
					   $num_cta12=$rowxx["num_cta"];
					   }	
					if($nom_banco12 == '' and $num_cta12 == '')
					{
					   $nom_banco12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta12="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   		
					
		
		}
		if($m == '1110')
		{			 printf("%s<br>",$pgcp13);	
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp13'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco13=$rowxx["nom_banco1"];
					   $num_cta13=$rowxx["num_cta"];
					   }		
					if($nom_banco13 == '' and $num_cta13 == '')
					{
					   $nom_banco13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta13="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
				
		
		}
		if($n == '1110')
		{			 printf("%s<br>",$pgcp14);	
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp14'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco14=$rowxx["nom_banco1"];
					   $num_cta14=$rowxx["num_cta"];
					   }		
					if($nom_banco14 == '' and $num_cta14 == '')
					{
					   $nom_banco14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta14="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
		 		
		
		}
		if($o == '1110')
		{			 printf("%s<br>",$pgcp15);	
					$sqlxx = "select * from pgcp where cod_pptal = '$pgcp15'";
					$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
					while($rowxx = mysql_fetch_array($resultadoxx)) 
					   {
					   $nom_banco15=$rowxx["nom_banco1"];
					   $num_cta15=$rowxx["num_cta"];
					   }		
					if($nom_banco15 == '' and $num_cta15 == '')
					{
					   $nom_banco15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					   $num_cta15="<font color ='#990000'><b>ACTUALICE PGCP</b></font>";
					}						   	
				
		
		}

} 
printf("
</span></td>
<td align='left'><span class='Estilo4'>

");
//*** nombre del banco
$sqlxx3a = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3a = mysql_db_query($database, $sqlxx3a, $connectionxx);
while($rowxx3a = mysql_fetch_array($resultadoxx3a)) 
{

$pgcp1 = $rowxx3a["pgcp1"];
$pgcp2 = $rowxx3a["pgcp2"];
$pgcp3 = $rowxx3a["pgcp3"];
$pgcp4 = $rowxx3a["pgcp4"];
$pgcp5 = $rowxx3a["pgcp5"];
$pgcp5 = $rowxx3a["pgcp6"];
$pgcp7 = $rowxx3a["pgcp7"];
$pgcp8 = $rowxx3a["pgcp8"];
$pgcp9 = $rowxx3a["pgcp9"];
$pgcp10 = $rowxx3a["pgcp10"];
$pgcp11 = $rowxx3a["pgcp11"];
$pgcp12 = $rowxx3a["pgcp12"];
$pgcp13 = $rowxx3a["pgcp13"];
$pgcp14 = $rowxx3a["pgcp14"];
$pgcp15 = $rowxx3a["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

if($a == '1110')
		{			/* printf("%s<br>",$rowxx3a["banco_cheque"]);*/	 printf("# %s<br>",$nom_banco1);       	}
		if($b == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque2"]);*/ printf("# %s<br>",$nom_banco2);		    }
		if($c == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque3"]);*/ printf("# %s<br>",$nom_banco3);		    }
		if($d == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque4"]);*/ printf("# %s<br>",$nom_banco4);		    }
		if($e == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque5"]);*/ printf("# %s<br>",$nom_banco5);		    }
		if($f == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque6"]);*/ printf("# %s<br>",$nom_banco6);		    }
		if($g == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque7"]);*/ printf("# %s<br>",$nom_banco7);		    }
		if($h == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque8"]);*/ printf("# %s<br>",$nom_banco8);		    }
		if($i == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque9"]);*/ printf("# %s<br>",$nom_banco9);		    }
		if($j == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque10"]);*/ printf("# %s<br>",$nom_banco10);		    }
		if($k == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque11"]);*/ printf("# %s<br>",$nom_banco11);		    }
		if($l == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque12"]);*/ printf("# %s<br>",$nom_banco12);		    }
		if($m == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque13"]);*/ printf("# %s<br>",$nom_banco13);		    }
		if($n == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque14"]);*/ printf("# %s<br>",$nom_banco14);		    }
		if($o == '1110')
		{			 /*printf("%s<br>",$rowxx3a["banco_cheque15"]);*/ printf("# %s<br>",$nom_banco15);		    }

} 			 

printf("
</span></td>
<td align='left'><span class='Estilo4'>


");

//*** numero de cuenta
$sqlxx3b = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3b = mysql_db_query($database, $sqlxx3b, $connectionxx);
while($rowxx3b = mysql_fetch_array($resultadoxx3b)) 
{

$pgcp1 = $rowxx3b["pgcp1"];
$pgcp2 = $rowxx3b["pgcp2"];
$pgcp3 = $rowxx3b["pgcp3"];
$pgcp4 = $rowxx3b["pgcp4"];
$pgcp5 = $rowxx3b["pgcp5"];
$pgcp5 = $rowxx3b["pgcp6"];
$pgcp7 = $rowxx3b["pgcp7"];
$pgcp8 = $rowxx3b["pgcp8"];
$pgcp9 = $rowxx3b["pgcp9"];
$pgcp10 = $rowxx3b["pgcp10"];
$pgcp11 = $rowxx3b["pgcp11"];
$pgcp12 = $rowxx3b["pgcp12"];
$pgcp13 = $rowxx3b["pgcp13"];
$pgcp14 = $rowxx3b["pgcp14"];
$pgcp15 = $rowxx3b["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

if($a == '1110')
		{			 /*printf("%s<br>",$cta_cheque);*/ printf("# %s<br>",$num_cta1); 	        }
		if($b == '1110')
		{			 /*printf("%s<br>",$cta_cheque2);*/ printf("# %s<br>",$num_cta2); 	        }
		if($c == '1110')
		{			 /*printf("%s<br>",$cta_cheque3);*/ printf("# %s<br>",$num_cta3); 	        }
		if($d == '1110')
		{			 /*printf("%s<br>",$cta_cheque4);*/ printf("# %s<br>",$num_cta4); 	        }
		if($e == '1110')
		{			 /*printf("%s<br>",$cta_cheque5);*/ printf("# %s<br>",$num_cta5); 	        }
		if($f == '1110')
		{			 /*printf("%s<br>",$cta_cheque6);*/ printf("# %s<br>",$num_cta6); 	        }
		if($g == '1110')
		{			 /*printf("%s<br>",$cta_cheque7);*/ printf("# %s<br>",$num_cta7); 	        }
		if($h == '1110')
		{			 /*printf("%s<br>",$cta_cheque8);*/ printf("# %s<br>",$num_cta8); 	        }
		if($i == '1110')
		{			 /*printf("%s<br>",$cta_cheque9);*/ printf("# %s<br>",$num_cta9); 	        }
		if($j == '1110')
		{			 /*printf("%s<br>",$cta_cheque10);*/ printf("# %s<br>",$num_cta10); 	        }
		if($k == '1110')
		{			 /*printf("%s<br>",$cta_cheque11);*/ printf("# %s<br>",$num_cta11); 	        }
		if($l == '1110')
		{			 /*printf("%s<br>",$cta_cheque12);*/ printf("# %s<br>",$num_cta12); 	        }
		if($m == '1110')
		{			 /*printf("%s<br>",$cta_cheque13);*/ printf("# %s<br>",$num_cta13); 	        }
		if($n == '1110')
		{			 /*printf("%s<br>",$cta_cheque14);*/ printf("# %s<br>",$num_cta14); 	        }
		if($o == '1110')
		{			 /*printf("%s<br>",$cta_cheque15);*/ printf("# %s<br>",$num_cta15); 	        }

} 			 


printf("
</span></td>
<td align='left'><span class='Estilo4'>

");


//*** numero de cheque
$sqlxx3c = "select * FROM cecp where id_emp='$id_emp' and id_auto_cecp = '$id_auto_cecp'";
$resultadoxx3c = mysql_db_query($database, $sqlxx3c, $connectionxx);
while($rowxx3c = mysql_fetch_array($resultadoxx3c)) 
{

$pgcp1 = $rowxx3c["pgcp1"];
$pgcp2 = $rowxx3c["pgcp2"];
$pgcp3 = $rowxx3c["pgcp3"];
$pgcp4 = $rowxx3c["pgcp4"];
$pgcp5 = $rowxx3c["pgcp5"];
$pgcp5 = $rowxx3c["pgcp6"];
$pgcp7 = $rowxx3c["pgcp7"];
$pgcp8 = $rowxx3c["pgcp8"];
$pgcp9 = $rowxx3c["pgcp9"];
$pgcp10 = $rowxx3c["pgcp10"];
$pgcp11 = $rowxx3c["pgcp11"];
$pgcp12 = $rowxx3c["pgcp12"];
$pgcp13 = $rowxx3c["pgcp13"];
$pgcp14 = $rowxx3c["pgcp14"];
$pgcp15 = $rowxx3c["pgcp15"];

$a = substr($pgcp1,0,4);
$b = substr($pgcp2,0,4);
$c = substr($pgcp3,0,4);
$d = substr($pgcp4,0,4);
$e = substr($pgcp5,0,4);
$f = substr($pgcp6,0,4);
$g = substr($pgcp7,0,4);
$h = substr($pgcp8,0,4);
$i = substr($pgcp9,0,4);
$j = substr($pgcp10,0,4);
$k = substr($pgcp11,0,4);
$l = substr($pgcp12,0,4);
$m = substr($pgcp13,0,4);
$n = substr($pgcp14,0,4);
$o = substr($pgcp15,0,4);

		if($a == '1110')
		{			 printf("%s<br>",$rowxx3c["num_cheque"]);	        }
		if($b == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque2"],$rowxx3c["num_cheque"]);		    }
		if($c == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque3"],$rowxx3c["num_cheque"]);			}
		if($d == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque4"],$rowxx3c["num_cheque"]);			}
		if($e == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque5"],$rowxx3c["num_cheque"]);			}
		if($f == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque6"],$rowxx3c["num_cheque"]);			}
		if($g == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque7"],$rowxx3c["num_cheque"]);			}
		if($h == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque8"],$rowxx3c["num_cheque"]);			}
		if($i == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque9"],$rowxx3c["num_cheque"]);			}
		if($j == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque10"],$rowxx3c["num_cheque"]);			}
		if($k == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque11"],$rowxx3c["num_cheque"]);			}
		if($l == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque12"],$rowxx3c["num_cheque"]);			}
		if($m == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque13"],$rowxx3c["num_cheque"]);			}
		if($n == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque14"],$rowxx3c["num_cheque"]);	 		}
		if($o == '1110')
		{			 printf("%s<br>%s",$rowxx3c["num_cheque15"],$rowxx3c["num_cheque"]);			}

} 			 


printf("
</span></td>
</tr>"); 


}//fin while


printf("</table></center>");
//--------	
?>	
</body>
</html>






<?
}
?>