<?
set_time_limit(1200);
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
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo5 {font-size: 10px; color: #333333; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body>
<div align="center">
<?php 
include('../config.php');		
		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

// ide emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
//**** borro tabla por si las moscas
$tabla6="aux_contaduria_gral";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
///**** creo la tabla
$tabla7="aux_contaduria_gral";
$anadir7="CREATE TABLE ";
$anadir7.=$tabla7;
$anadir7.="
(
`fecha` varchar(200) NOT NULL default '',	
`d` varchar(200) NOT NULL default '',
`nivel` varchar(200) NOT NULL default '',
`cuenta` varchar(200) NOT NULL default '',
`nombre` varchar(200) NOT NULL default '',
`inicial` decimal(20,2) NOT NULL default '0.00',
`debito` decimal(20,2) NOT NULL default '0.00',
`credito` decimal(20,2) NOT NULL default '0.00',
`saldo` decimal(20,2) NOT NULL default '0.00',
`corriente` decimal(20,2) NOT NULL default '0.00',
`no_corriente` decimal(20,2) NOT NULL default '0.00'

)TYPE=MyISAM CHARSET=latin1 COLLATE=latin1_general_ci ";

mysql_select_db ($base, $conexion);

if(mysql_query ($anadir7 ,$conexion)) 
{
//echo "listo";
}
else
{
//echo "no se pudo";
}

//corte
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select corte from aux_corte_cgn";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $corte=$rowxx["corte"];
}
//fecha_ini_op
$sqlxx1 = "select * from vf";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $fecha_ini_op=$rowxx1["fecha_ini"];
}

//****	sacar el anio actual
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$ano=$rowxx["ano"];
}
$anio = substr($ano,0,4);
//****
$val1=$anio."/03/31";
$val2=$anio."/06/30";
$val3=$anio."/09/30";
$val4=$anio."/12/31";
if($corte == $val1)
{
  $fecha_aux = $anio."/01/01";
}
if($corte == $val2)
{
$fecha_aux = $anio."/04/01";
}
if($corte == $val3)
{
$fecha_aux = $anio."/07/01";
}
if($corte == $val4)
{
$fecha_aux = $anio."/10/01";
}
//*********************************
//********************************* si tienen sico y si tienen mvto en lib_aux
//*********************************
$sqlxx2 = "select lib_aux.cuenta from lib_aux inner join sico where lib_aux.cuenta = sico.cuenta group by lib_aux.cuenta";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
		// campo 1 ok
					 $fecha=$corte;
		// campo 2 ok			 
					 $d='D';
		// campo 4 ok
					 $cuenta=$rowxx2["cuenta"];			 
		// campo 3 ok			 
		//********************************* NIVEL		  
		$sql = "select * from pgcp where cod_pptal = '$cuenta'";
		$result = mysql_query($sql, $connectionxx) or die(mysql_error());
		if (mysql_num_rows($result) == 0)
		{
		$nivel = 'error';
		}
		else
		{
			$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
			$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
			
			while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
			{
			$nivel=$rowxx2a["nivel"];
			}
		}
		// campo 5 ok
		//******************************** NOMBRE			  
		$sql = "select * from pgcp where cod_pptal = '$cuenta'";
		$result = mysql_query($sql, $connectionxx) or die(mysql_error());
		if (mysql_num_rows($result) == 0)
		{
		$nombre = 'error';
		}
		else
		{
		$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
		$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
		
		while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
		{
		$nombre=$rowxx2a["nom_rubro"];
		}
		}			 
		// *************************************** campo 6 ok
		//******* naturaleza de la cuenta
			$nat1 = substr($cuenta,0,1);
			
			$nat2 = substr($cuenta,0,2);
			
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
				$sqlxx2a = "select * from sico where cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $debito_sico=$rowxx2a["debito"];
				}
				// calculo del inicial
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];	
				
				}
				//calculo del tot deb y tot cre
				
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta'";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				
				//****************************** CALCULO SALDOS

				$saldo_aux = $saldo_inicial + $total_debitos - $total_creditos;
		
}

else// else de la naturaleza
{
				$sqlxx2a = "select * from sico where cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $credito_sico=$rowxx2a["credito"];
				}
				//calculo del inicial
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$credito_sico - $rowxx2a[debitos] + $rowxx2a[creditos];	
				
				}
				
				
				//calculo del tot deb y tot cre
				
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta'";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				//****************************** CALCULO SALDOS
				$saldo_aux = $saldo_inicial - $total_debitos + $total_creditos;
}
//********************************* CTE  - NO CTE		  
$cte_aux='0';
$n_cte_aux='0';
$sql_ok = "INSERT INTO aux_contaduria_gral  
						(fecha,d,nivel,cuenta,nombre,inicial,debito,credito,saldo,corriente,no_corriente) 
						VALUES 
						('$fecha','$d','$nivel','$cuenta','$nombre','$saldo_inicial','$total_debitos','$total_creditos','$saldo_aux','$cte_aux','$n_cte_aux')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());				
} 

//*********************************
//********************************* no tienen sico y si tienen mvto en lib_aux
//*********************************
$sqlxx2 = "SELECT distinct(lib_aux.cuenta) FROM lib_aux WHERE NOT EXISTS(select sico.cuenta from sico WHERE sico.cuenta=lib_aux.cuenta)";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
		  
		// campo 1 ok
					 $fecha=$corte;
		// campo 2 ok			 
					 $d='D';
		// campo 4 ok
					 $cuenta=$rowxx2["cuenta"];			 
		// campo 3 ok			 
					 
		//********************************* NIVEL		  
		
		$sql = "select * from pgcp where cod_pptal = '$cuenta'";
		$result = mysql_query($sql, $connectionxx) or die(mysql_error());
		if (mysql_num_rows($result) == 0)
		{
		$nivel = 'error';
		}
		else
		{
			$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
			$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
			
			while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
			{
			$nivel=$rowxx2a["nivel"];
			}
		}
		
		// campo 5 ok
		
		//******************************** NOMBRE			  
					  
		$sql = "select * from pgcp where cod_pptal = '$cuenta'";
		$result = mysql_query($sql, $connectionxx) or die(mysql_error());
		if (mysql_num_rows($result) == 0)
		{
		$nombre = 'error';
		}
		else
		{
		$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
		$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
		
		while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
		{
		$nombre=$rowxx2a["nom_rubro"];
		}
		}			 
		
		// *************************************** campo 6 ok
		
		//******* naturaleza de la cuenta
			$nat1 = substr($cuenta,0,1);
			
			$nat2 = substr($cuenta,0,2);
			
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
				
				   $debito_sico= 0 ;
				
				// calculo del inicial
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];	
				
				}
				//calculo del tot deb y tot cre
				
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta'";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				
				//****************************** CALCULO SALDOS

				$saldo_aux = $saldo_inicial + $total_debitos - $total_creditos;
		
}

else// else de la naturaleza
{
				
				   $credito_sico= 0 ;
				
				//calculo del inicial
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$credito_sico - $rowxx2a[debitos] + $rowxx2a[creditos];	
				
				}
				
				
				//calculo del tot deb y tot cre
				
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta'";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				
				//****************************** CALCULO SALDOS

				$saldo_aux = $saldo_inicial - $total_debitos + $total_creditos;
				
				
}
		
		 

 
//********************************* CTE  - NO CTE		  
				
$cte_aux='0';
$n_cte_aux='0';
				
				
$sql_ok = "INSERT INTO aux_contaduria_gral  
						(fecha,d,nivel,cuenta,nombre,inicial,debito,credito,saldo,corriente,no_corriente) 
						VALUES 
						('$fecha','$d','$nivel','$cuenta','$nombre','$saldo_inicial','$total_debitos','$total_creditos','$saldo_aux','$cte_aux','$n_cte_aux')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());				
				
				
				
				
		  
}  
		  
//*********************************
//********************************* si tienen sico y no tienen mvto en lib_aux
//*********************************
$sqlxx2 = "SELECT cuenta, debito, credito FROM sico where not exists (select cuenta from lib_aux where sico.cuenta=lib_aux.cuenta)";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
		  
$cuenta=$rowxx2["cuenta"];
$debito_sico=$rowxx2["debito"];
$credito_sico=$rowxx2["credito"];
$fecha=$fecha_ini_op;
$d='D';
			 
$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{			 
	$tip_dato =	 $rowxx2a["tip_dato"];
		
		
	if($tip_dato == 'M')
	{
	}
	else
	{		
			 
			 
			 
			 
			 
			 //********************************* NIVEL		  
				
			  	$sql = "select * from pgcp where cod_pptal = '$cuenta'";
				$result = mysql_query($sql, $connectionxx) or die(mysql_error());
				if (mysql_num_rows($result) == 0)
				{
				  $nivel = 'error';
				}
				else
				{
					$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
					$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
					
					while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
					{
					  $nivel=$rowxx2a["nivel"];
					}
				}
				
			//******************************** NOMBRE			  
			  
			     $sql = "select * from pgcp where cod_pptal = '$cuenta'";
				$result = mysql_query($sql, $connectionxx) or die(mysql_error());
				if (mysql_num_rows($result) == 0)
				{
				  $nombre = 'error';
				}
				else
				{
					$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
					$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
					
					while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
					{
					  $nombre=$rowxx2a["nom_rubro"];
					}
				}
				
			  
					//******************************* SICO		  
				
					  
		//******* naturaleza de la cuenta
			$nat1 = substr($cuenta,0,1);
			
			$nat2 = substr($cuenta,0,2);
			
			if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
			{	$naturaleza = "DEBITO";	}
			else
			{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89')
				{
				$naturaleza = "CREDITO";
				}
			}
						
					  if($naturaleza == "DEBITO")
					  {
					  $saldo_sico = $debito_sico;
					  }
					  else
					  {
					  $saldo_sico = $credito_sico;
					  }
				

					//***************************** debito - credito
					
					$debito = '0';
					$credito = '0';
					
					//****************************** CALCULO SALDOS
					
					 $saldo=$saldo_sico;
					//********************************* CTE  - NO CTE		  
									
					$cte_sico='0';
					$n_cte_sico='0';
									
									
					$sql_ok = "INSERT INTO aux_contaduria_gral  
											(fecha,d,nivel,cuenta,nombre,inicial,debito,credito,saldo,corriente,no_corriente) 
											VALUES 																						
											('$fecha','$d','$nivel','$cuenta','$nombre','$saldo_sico',
											'$debito','$credito','$saldo','$cte_sico','$n_cte_sico')";
											mysql_query($sql_ok, $connectionxx) or die(mysql_error());				
				
				
	}		//fin else
 }//fin segundo while				
		  
} 		  

//*********************************
//********************************* carga cuentas 0 
//*********************************
//*********************************		  
		  
$sqlxx2 = "select * from aux_cta_0 group by cuenta order by cuenta asc";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
		  
			 
			 
$cuenta=$rowxx2["cuenta"];
$fecha=$rowxx2["fecha"];
$d='D'; 
			 
	 
			 //********************************* NIVEL		  
				
			  	$sql = "select * from pgcp where cod_pptal = '$cuenta'";
				$result = mysql_query($sql, $connectionxx) or die(mysql_error());
				if (mysql_num_rows($result) == 0)
				{
				  $nivel = 'error';
				}
				else
				{
					$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
					$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
					
					while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
					{
					  $nivel=$rowxx2a["nivel"];
					}
				}
				
			//******************************** NOMBRE			  
			  
			     $sql = "select * from pgcp where cod_pptal = '$cuenta'";
				$result = mysql_query($sql, $connectionxx) or die(mysql_error());
				if (mysql_num_rows($result) == 0)
				{
				  $nombre = 'error';
				}
				else
				{
					$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta'";
					$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
					
					while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
					{
					  $nombre=$rowxx2a["nom_rubro"];
					}
				}
				
			  
					//******************************* SICO		  
//nat de la cuentas 0

//******* naturaleza de la cuenta
$nat1 = substr($cuenta,0,4);

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
}

					if($naturaleza == "DEBITO")
					  {
$debito_sico= 0 ;

// calculo del inicial
$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from aux_cta_0 where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{
   $saldo_inicial=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];	

}
//calculo del tot deb y tot cre

$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from aux_cta_0 
where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta'";
$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);

while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
{
   $total_debitos = $rowxx2a1[debitos];
   $total_creditos = $rowxx2a1[creditos];	

}

//****************************** CALCULO SALDOS

$saldo_aux = $saldo_inicial + $total_debitos - $total_creditos;
					  
					  
					  
					  }
					  else
					  {
					  
					  
					  
$credito_sico= 0 ;

//calculo del inicial
$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from aux_cta_0 where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{
$saldo_inicial=$credito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];	

}


//calculo del tot deb y tot cre

$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from aux_cta_0 
where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta'";
$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);

while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
{
$total_debitos = $rowxx2a1[debitos];
$total_creditos = $rowxx2a1[creditos];	

}

//****************************** CALCULO SALDOS

$saldo_aux = $saldo_inicial - $total_debitos + $total_creditos;

					  }
					  
					//********************************* CTE  - NO CTE		  
									
					$cte_sico='0';
					$n_cte_sico='0';
									
									
					$sql_ok = "INSERT INTO aux_contaduria_gral  
											(fecha,d,nivel,cuenta,nombre,inicial,debito,credito,saldo,corriente,no_corriente) 
											VALUES 																						
											('$corte','$d','$nivel','$cuenta','$nombre','$saldo_inicial',
											'$total_debitos','$total_creditos','$saldo_aux','$cte_sico','$n_cte_sico')";
											mysql_query($sql_ok, $connectionxx) or die(mysql_error());				
				
				
				
		  
}  

 

?>
<br />
<span class="Estilo4">SALDOS Y MOVIMIENTOS CARGADOS CON EXITO</span><BR />
<BR />
<a href="informe2.php" target="_parent"><span class="Estilo5">PRESIONE AQUI PARA CONTINUAR</span></a></div>
<table width="800" border="0" align="center">
  
  <tr>
    <td width="798" colspan="3"><div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='a.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
</table>
</body>
</html>
<?
}
?>