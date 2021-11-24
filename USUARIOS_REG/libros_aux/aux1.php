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
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo15 {font-size: 11px}
</style>

<style type="text/css">
<!--
.Estilo4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
a:link {
	color: #666666;
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
</head>

<body>
<div align="center"><BR />
    <span class="Estilo1">LISTA DE TODOS LOS MOVIMIENTOS CONTABLES  HASTA LA FECHA</span><BR />
  <BR />
  <?

include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}



$sq2 = "select distinct(id_recau) , fecha_recaudo, des_recaudo, tercero, pgcp1 , pgcp2, pgcp3, pgcp4, pgcp5, pgcp6, pgcp7, pgcp8, pgcp9, pgcp10, pgcp11, pgcp12, pgcp13, pgcp14, pgcp15, vr_deb_1, vr_deb_2, vr_deb_3, vr_deb_4, vr_deb_5, vr_deb_6, vr_deb_7, vr_deb_8, vr_deb_9, vr_deb_10, vr_deb_11, vr_deb_12, vr_deb_13, vr_deb_14, vr_deb_15, vr_cre_1, vr_cre_2, vr_cre_3, vr_cre_4, vr_cre_5, vr_cre_6, vr_cre_7, vr_cre_8, vr_cre_9, vr_cre_10, vr_cre_11, vr_cre_12, vr_cre_13, vr_cre_14, vr_cre_15 from recaudo_roit where id_emp = '$id_emp' order by fecha_recaudo asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='1200' BORDER='1' class='bordepunteado1'>

<tr>
<td colspan='7' align='center' bgcolor='#F5F5F5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'>MOVIMIENTOS CONTABLES DEL RECAUDO</span>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='90'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'><b>FECHA</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
</tr>
");


while($rw2 = mysql_fetch_array($re2))
{
	for($i=1;$i < 16 ; $i++)
	{

 		if($rw2["vr_deb_".$i] == 0 and $rw2["vr_cre_".$i] == 0)
 		{
 		}
 		else
 		{
 
 			$cod=$rw2["pgcp".$i];
			$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
			$rr2 = mysql_db_query($database, $ss2, $cx);
			while($rrw2 = mysql_fetch_array($rr2)) 
			{
			  $nom_rubro=$rrw2["nom_rubro"];
			}

 
 			//printf("recaudos");//contador
 
			 printf("
			<span class='Estilo4'>
			<tr>
			
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			
			<td align='left'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<span class='Estilo4'> %s - %s </span>
			</div>
			</td>
			<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
			<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
			<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
			<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

			</tr>", $rw2["fecha_recaudo"], $rw2["id_recau"] , $rw2["pgcp".$i], $nom_rubro, $rw2["des_recaudo"], $rw2["tercero"], $rw2["vr_deb_".$i], $rw2["vr_cre_".$i]); 
			
 		}//else
 
	}//for
	
}//while

//***************************************
$sq3 = "select * from cartera_cont where id_emp = '$id_emp' order by fecha_causa asc ";
$re3 = mysql_db_query($database, $sq3, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES DE CARTERA</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw3 = mysql_fetch_array($re3))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw3["vr_deb_".$i] == 0 and $rw3["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw3["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro2=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw3["fecha_causa"],$rw3["consec_cartera"], $rw3["pgcp".$i], $nom_rubro2, $rw3["ref"], $rw3["tercero"], $rw3["vr_deb_".$i], $rw3["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************

//***************************************
$sq4 = "select * from recaudo_ncbt where id_emp = '$id_emp' order by fecha_recaudo asc ";
$re4 = mysql_db_query($database, $sq4, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES NOTAS CREDITO BANCARIAS</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw4 = mysql_fetch_array($re4))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw4["vr_deb_".$i] == 0 and $rw4["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw4["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro3=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw4["fecha_recaudo"], $rw4["id_recau"], $rw4["pgcp".$i], $nom_rubro3, $rw4["des_recaudo"], $rw4["tercero"], $rw4["vr_deb_".$i], $rw4["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************
//***************************************
$sq5 = "select * from recaudo_tnat where id_emp = '$id_emp' order by fecha_recaudo asc ";
$re5 = mysql_db_query($database, $sq5, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES TRANSFERENCIAS DE LA NACION</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw5 = mysql_fetch_array($re5))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw5["vr_deb_".$i] == 0 and $rw5["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw5["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro4=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw5["fecha_recaudo"], $rw5["id_recau"], $rw5["pgcp".$i], $nom_rubro4, $rw5["des_recaudo"], $rw5["tercero"], $rw5["vr_deb_".$i], $rw5["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************

//***************************************
$sq6 = "select * from recaudo_rcgt where id_emp = '$id_emp' order by fecha_recaudo asc ";
$re6 = mysql_db_query($database, $sq6, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES RECIBO DE CAJA GENERAL</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw6 = mysql_fetch_array($re6))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw6["vr_deb_".$i] == 0 and $rw6["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw6["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro5=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw6["fecha_recaudo"], $rw6["id_recau"], $rw6["pgcp".$i], $nom_rubro5, $rw6["des_recaudo"], $rw6["tercero"], $rw6["vr_deb_".$i], $rw6["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************


//***************************************
$sq7 = "select distinct(id_auto_crpp), fecha_crpp, id_manu_crpp, pago, tercero,  pgcp1 , pgcp2, pgcp3, pgcp4, pgcp5, pgcp6, pgcp7, pgcp8, pgcp9, pgcp10, pgcp11, pgcp12, pgcp13, pgcp14, pgcp15, vr_deb_1, vr_deb_2, vr_deb_3, vr_deb_4, vr_deb_5, vr_deb_6, vr_deb_7, vr_deb_8, vr_deb_9, vr_deb_10, vr_deb_11, vr_deb_12, vr_deb_13, vr_deb_14, vr_deb_15, vr_cre_1, vr_cre_2, vr_cre_3, vr_cre_4, vr_cre_5, vr_cre_6, vr_cre_7, vr_cre_8, vr_cre_9, vr_cre_10, vr_cre_11, vr_cre_12, vr_cre_13, vr_cre_14, vr_cre_15

 from crpp where id_emp = '$id_emp' order by id_manu_crpp asc ";
$re7 = mysql_db_query($database, $sq7, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES CERTIFICADOS DE REGISTRO PPTAL</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw7 = mysql_fetch_array($re7))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw7["vr_deb_".$i] == 0 and $rw7["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw7["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro6=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw7["fecha_crpp"], $rw7["id_manu_crpp"], $rw7["pgcp".$i], $nom_rubro6, $rw7["pago"], $rw7["tercero"], $rw7["vr_deb_".$i], $rw7["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************


//***************************************
$sq8 = "select distinct(id_auto_cobp), fecha_cobp, id_manu_cobp, des_cobp, tercero,  pgcp1 , pgcp2, pgcp3, pgcp4, pgcp5, pgcp6, pgcp7, pgcp8, pgcp9, pgcp10, pgcp11, pgcp12, pgcp13, pgcp14, pgcp15, vr_deb_1, vr_deb_2, vr_deb_3, vr_deb_4, vr_deb_5, vr_deb_6, vr_deb_7, vr_deb_8, vr_deb_9, vr_deb_10, vr_deb_11, vr_deb_12, vr_deb_13, vr_deb_14, vr_deb_15, vr_cre_1, vr_cre_2, vr_cre_3, vr_cre_4, vr_cre_5, vr_cre_6, vr_cre_7, vr_cre_8, vr_cre_9, vr_cre_10, vr_cre_11, vr_cre_12, vr_cre_13, vr_cre_14, vr_cre_15

 from cobp where id_emp = '$id_emp' order by id_manu_cobp asc ";
$re8 = mysql_db_query($database, $sq8, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES CERTIFICADOS DE OBLIGACION PPTAL</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw8 = mysql_fetch_array($re8))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw8["vr_deb_".$i] == 0 and $rw8["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw8["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro8=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw8["fecha_cobp"], $rw8["id_manu_cobp"], $rw8["pgcp".$i], $nom_rubro8, $rw8["des_cobp"], $rw8["tercero"], $rw8["vr_deb_".$i], $rw8["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************

//***************************************
$sq9 = "select * from obcg where id_emp = '$id_emp' order by id_manu_obcg asc ";
$re9 = mysql_db_query($database, $sq9, $cx);

		printf("
		
		<tr>
		<td colspan='7' align='center' bgcolor='#F5F5F5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'>MOVIMIENTOS CONTABLES OBLIGACION CONTABLE DEL GASTO</span>
		</div>
		</td>
		</tr>
		<tr bgcolor='#F5F5F5'>
		<td align='center' width='90'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo1'><b>FECHA</b></span>
		</div>
		</td>
		<td align='center' width='100'><span class='Estilo1'><b>DCTO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>CODIGO</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
		<td align='center' width='250'><span class='Estilo1'><b>TERCERO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>DEBITO</b></span></td>
		<td align='center' width='130'><span class='Estilo1'><b>CREDITO</b></span></td>
		</tr>
		
		");

while($rw9 = mysql_fetch_array($re9))
{		



		for($i=1;$i < 16 ; $i++)
		{
 			if($rw9["vr_deb_".$i] == 0 and $rw9["vr_cre_".$i] == 0)
 			{
 			}
 			else
 			{
 
	 			$cod=$rw9["pgcp".$i];
				$ss22 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
				$rr22 = mysql_db_query($database, $ss22, $cx);
				while($rrw22 = mysql_fetch_array($rr22)) 
				{
				  $nom_rubro9=$rrw22["nom_rubro"];
				}

 			
  				//printf("cartera cont");//contador
 
				 printf("
				<span class='Estilo4'>
				<tr>
				
				<td align='center'><span class='Estilo4'> %s </span></td>
				<td align='center'><span class='Estilo4'> %s </span></td>
				
				<td align='left'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
				<span class='Estilo4'> %s - %s </span>
				</div>
				</td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
				<td align='right'><span class='Estilo4'> %.2f&nbsp; </span></td>
				<td align='right'><span class='Estilo4'> %.2f &nbsp;</span></td>

				</tr>", $rw9["fecha_obcg"], $rw9["id_manu_obcg"], $rw9["pgcp".$i], $nom_rubro9, $rw9["concepto_obcg"], $rw9["tercero"], $rw9["vr_deb_".$i], $rw9["vr_cre_".$i]); 
				
		 }//else
 
	}//for
	
}//while
//********************************************

printf("</table></center>");
//--------	

?>
</div>
<br />
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../user.php' target='_parent' class="Estilo4">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?
}
?>