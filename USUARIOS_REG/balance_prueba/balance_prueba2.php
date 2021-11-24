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
.Estilo1x {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
</style>
</head>




<body>
<table width="800" border="0" align="center">
  
  

  <tr>
    <td width="2394" colspan="3">
      <div align="center">
<?


include('../config.php');

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// id emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
$ano=$rowxx["ano"];
}
// fecha ini - fecha fin - cod ini - cod fin
$sqlxx3 = "select * from aux_bal_prueba";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
$fecha_ini=$rowxx3["fecha_ini"];
$fecha_fin=$rowxx3["fecha_fin"];
$cod_ini=$rowxx3["cod_ini"];
$cod_fin=$rowxx3["cod_fin"];
$mov=$rowxx3["mov"];
}
// restar 1 a la fecha inicial
$ts11 = strtotime($fecha_fin);
$tsa = strtotime('-1 day',$ts11);
$aux_fecha=date('Y/m/d', $tsa);
// fecha_ini_op
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $fecha_ini_op=$rowxx3["fecha_ini_op"];
   }  

printf("<center class='Estilo4'><b>BALANCE DE PRUEBA GENERADO CON EXITO <BR><BR>DATOS SELECCIONADOS POR EL USUARIO</b><br><br><b>Fecha Inicial :</b> %s --- ",$fecha_ini);
printf("<b>Fecha de Corte :</b> %s --- ",$fecha_fin);
//printf("<b>Nivel :</b> %s --- ",$nivel);
printf("<b>Codigo Inicial :</b> %s --- ",$cod_ini);
printf("<b>Codigo Final :</b> %s </center><br>",$cod_fin);
?>

<?
///***** tabla auxiliar

//**** variables para generacion dinamica
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//**** borro tabla por si las moscas 

$tabla6="bal_prueba_deb";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";
mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{echo "";}else{echo "";}	

///**** creo la tabla 

$tabla7="bal_prueba_deb";
$anadir7="CREATE TABLE ";
$anadir7.=$tabla7;
$anadir7.="
(
`codigo` varchar(200) NOT NULL default '',
`nombre` varchar(200) NOT NULL default '',
`tipo` varchar(200) NOT NULL default '',
`nivel` INT( 2 ) NOT NULL,
`debito` decimal(20,2) NOT NULL default '0.00',
`credito` decimal(20,2) NOT NULL default '0.00'
)TYPE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci";

mysql_select_db ($base, $conexion);

if(mysql_query ($anadir7 ,$conexion)) 
{echo "";}else{echo "";}


//**** consulta de todo el pgcp			
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//$sq = "select * from pgcp where id_emp = '$id_emp' and nivel <= '$nivel' and (cod_pptal between '$cod_ini' and '$cod_fin') order by cod_pptal asc ";
$sq = "select * from pgcp where id_emp = '$id_emp' and nivel <= '16' and (cod_pptal between '$cod_ini' and '$cod_fin') order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	$nn=$rw["cod_pptal"];
	$tip_dato=$rw["tip_dato"];

	//**** sico
	$ss22a = "select * from sico where cuenta = '$nn'";
	$rr22a = mysql_db_query($database, $ss22a, $connectionxx);
	while($rrw22a = mysql_fetch_array($rr22a)) 
	{
	  $sico_d=$rrw22a["debito"];
	  $sico_c=$rrw22a["credito"];
	}
	if($sico_d == '')
	{	  $sico_d=1;	}
	if($sico_c == '')
	{	  $sico_c=0;	}
	//******* naturaleza de la cuenta
	$nat1 = substr($nn,0,1);
	$nat2 = substr($nn,0,2);
	if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
	{	$naturaleza = "DEBITO";	}
	else
	{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89')
		{
		$naturaleza = "CREDITO";
		}
	}

//********** calculo saldo incial de la cuenta
//*******************************************
if ($mov =='')
{
	if($naturaleza == 'DEBITO')
		{
			//************ inicial cuando SI SICO Y SI LIB_AUX
			$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) != 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
						
						$saldo_inicial = $sico_d;
						
						}
					}
			//***************** *******************************
			//************ inicial cuando NO SICO Y SI LIB_AUX
			$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) == 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
						 $saldo_inicial =0;
						}
					}			
			//************************************************					
			//************ inicial cuando SI SICO Y NO LIB_AUX
			$sql = "select * from sico where cuenta ='$nn'";
			$result = mysql_query($sql, $connection) or die(mysql_error());
			if (mysql_num_rows($result) != 0)
			{
				$sql = "select * from lib_aux where cuenta ='$nn'";
				$result = mysql_query($sql, $connection) or die(mysql_error());
				if (mysql_num_rows($result) == 0)
				{	
				$saldo_inicial =$sico_d;
				}
			}	
			//************************************************
		}
		else
		{
			//************ inicial cuando SI SICO Y SI LIB_AUX
			$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) != 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
						
						$saldo_inicial = $sico_c;
						
						}
					}
			//************************************************	
			//************ inicial cuando NO SICO Y SI LIB_AUX
			$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) == 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
						 $saldo_inicial =0;
						}
					}			
			//************************************************
			//************ inicial cuando SI SICO Y NO LIB_AUX
			$sql = "select * from sico where cuenta ='$nn'";
			$result = mysql_query($sql, $connection) or die(mysql_error());
			if (mysql_num_rows($result) != 0)
			{
				$sql = "select * from lib_aux where cuenta ='$nn'";
				$result = mysql_query($sql, $connection) or die(mysql_error());
				if (mysql_num_rows($result) == 0)
				{	
				$saldo_inicial =$sico_c;
				}
			}	
			//************************************************					    
		}
//************* fin calculo saldo inicial
}
//***************************************
	if($tip_dato == 'D')  
	{
			if($naturaleza == 'DEBITO')
			{	
				//************************** SI SICO Y SI LIB_AUX
				//***********************************************
					$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) != 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
							//**************** DEBITIOS CREDITOS
							$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
							where (fecha between '$fecha_ini' and '$fecha_fin') and cuenta = '$nn'";
							$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
							
							while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
							{
							   $total_debitos = $rowxx2a1[debitos];
							   $total_creditos = $rowxx2a1[creditos];	
							}
						
							$saldo_final = $saldo_inicial + $total_debitos - $total_creditos;
							$codigo=$rw["cod_pptal"];
							$nombre=$rw["nom_rubro"];
							$tipo=$rw["tip_dato"];
							$nivel=$rw["nivel"];
							$debito=$saldo_final;
							$credito=0;
							//*** si el saldo es 0 no grabes
							if($debito == '0')
							{}
							else
							{
							$sql_ok = "INSERT INTO bal_prueba_deb 
							(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
							if ($mov =='SI')
								{
									$sql_ok = "INSERT INTO bal_prueba_deb 
									(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$total_debitos','$total_creditos')";	
								}
							mysql_query($sql_ok, $conexion) or die(mysql_error());
							}
						
						}
					} 
				//************************** NO SICO Y SI LIB_AUX
				//***********************************************
					$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) == 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
						
							//**************** DEBITIOS CREDITOS
							$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
							where (fecha between '$fecha_ini' and '$fecha_fin') and cuenta = '$nn'";
							$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
							
							while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
							{
							   $total_debitos = $rowxx2a1[debitos];
							   $total_creditos = $rowxx2a1[creditos];	
							   	
							
							}
							
							$saldo_final = $saldo_inicial + $total_debitos - $total_creditos;
							$codigo=$rw["cod_pptal"];
							$nombre=$rw["nom_rubro"];
							$tipo=$rw["tip_dato"];
							$nivel=$rw["nivel"];
							$debito=$saldo_final;
							$credito=0;
							//*** si el saldo es 0 no grabes
							if($debito == '0')
							{}
							else
							{
							$sql_ok = "INSERT INTO bal_prueba_deb 
							(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
							if ($mov =='SI')
								{
									$sql_ok = "INSERT INTO bal_prueba_deb 
									(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$total_debitos','$total_creditos')";	
								}

							mysql_query($sql_ok, $conexion) or die(mysql_error());
							}
						
						}
					}
				//************************** SI SICO Y NO LIB_AUX
				//***********************************************
					$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) != 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) == 0)
						{
							
							$total_debitos = 0;
							$total_creditos = 0;	
							
				
							$saldo_final = $saldo_inicial + $total_debitos - $total_creditos;
							$codigo=$rw["cod_pptal"];
							$nombre=$rw["nom_rubro"];
							$tipo=$rw["tip_dato"];
							$nivel=$rw["nivel"];
							$debito=$saldo_final;
							$credito=0;
							//*** si el saldo es 0 no grabes
							if($debito == '0')
							{}
							else
							{
							$sql_ok = "INSERT INTO bal_prueba_deb 
							(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
							if ($mov =='SI')
								{
									$sql_ok = "INSERT INTO bal_prueba_deb 
									(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$total_debitos','$total_creditos')";	
								}

							mysql_query($sql_ok, $conexion) or die(mysql_error());
							}
						
						}
					}
			} 
			else// NATURALEZA CREDITO
			{
				//************************** SI SICO Y SI LIB_AUX
				//***********************************************
					$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) != 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
							//**************** INICIAL DEBITIOS CREDITOS
							$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
							where (fecha >= '$fecha_ini' and fecha <= '$fecha_fin') and cuenta = '$nn'";
							$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
							
							while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
							{
							   $total_debitos = $rowxx2a1[debitos];
							   $total_creditos = $rowxx2a1[creditos];	
							}
						
							$saldo_final = $saldo_inicial - $total_debitos + $total_creditos;
							$codigo=$rw["cod_pptal"];
							$nombre=$rw["nom_rubro"];
							$tipo=$rw["tip_dato"];
							$nivel=$rw["nivel"];
							$debito=0;
							$credito=$saldo_final;
							//*** si el saldo es 0 no grabes
							if($credito == '0')
							{}
							else
							{
							$sql_ok = "INSERT INTO bal_prueba_deb 
							(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
							if ($mov =='SI')
								{
									$sql_ok = "INSERT INTO bal_prueba_deb 
									(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$total_debitos','$total_creditos')";	
								}

							mysql_query($sql_ok, $conexion) or die(mysql_error());
							}
						
						}
					}
				//************************** NO SICO Y SI LIB_AUX
				//***********************************************
					$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) == 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) != 0)
						{
							
							
							//**************** INICIAL DEBITIOS CREDITOS
							$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
							where (fecha >= '$fecha_ini' and fecha <= '$fecha_fin') and cuenta = '$nn'";
							$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
							
							while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
							{
							   $total_debitos = $rowxx2a1[debitos];
							   $total_creditos = $rowxx2a1[creditos];	
							   
							
							}
						
							$saldo_final = $saldo_inicial - $total_debitos + $total_creditos;
							$codigo=$rw["cod_pptal"];
							$nombre=$rw["nom_rubro"];
							$tipo=$rw["tip_dato"];
							$nivel=$rw["nivel"];
							$debito=0;
							$credito=$saldo_final;
							//*** si el saldo es 0 no grabes
							if($credito == '0')
							{}
							else
							{
							$sql_ok = "INSERT INTO bal_prueba_deb 
							(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
							if ($mov =='SI')
								{
									$sql_ok = "INSERT INTO bal_prueba_deb 
									(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$total_debitos','$total_creditos')";	
								}

							mysql_query($sql_ok, $conexion) or die(mysql_error());
							}
						
						}
					}
				//************************** SI SICO Y NO LIB_AUX
				//***********************************************
					$sql = "select * from sico where cuenta ='$nn'";
					$result = mysql_query($sql, $connection) or die(mysql_error());
					if (mysql_num_rows($result) != 0)
					{
						$sql = "select * from lib_aux where cuenta ='$nn'";
						$result = mysql_query($sql, $connection) or die(mysql_error());
						if (mysql_num_rows($result) == 0)
						{
							
							$total_debitos = 0;
							$total_creditos = 0;	
							
				
							$saldo_final = $saldo_inicial - $total_debitos + $total_creditos;
							$codigo=$rw["cod_pptal"];
							$nombre=$rw["nom_rubro"];
							$tipo=$rw["tip_dato"];
							$nivel=$rw["nivel"];
							$debito=0;
							$credito=$saldo_final;
							//*** si el saldo es 0 no grabes
							if($credito == '0')
							{}
							else
							{
							$sql_ok = "INSERT INTO bal_prueba_deb 
							(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
							if ($mov =='SI')
								{
									$sql_ok = "INSERT INTO bal_prueba_deb 
									(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$total_debitos','$total_creditos')";	
								}

							mysql_query($sql_ok, $conexion) or die(mysql_error());
							}
						
						}
					}
			}// FIN ELSE NATURALEZA
	}
  else // ELSE PARA TIPO DE DATOS MAYOR
	{
		$codigo=$rw["cod_pptal"];
		$nombre=$rw["nom_rubro"];
		$tipo=$rw["tip_dato"];
		$nivel=$rw["nivel"];
		$debito=0;
		$credito=0;
		
		$sql_ok = "INSERT INTO bal_prueba_deb 
		(codigo,nombre,tipo,nivel,debito,credito) VALUES('$codigo','$nombre','$tipo','$nivel','$debito','$credito')";
		mysql_query($sql_ok, $conexion) or die(mysql_error());
	}	
		
		
		
}// fin while
?>
      </div></td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<form id="form1" name="form1" method="post" action="balance_prueba3.php">
      <div align="center" class="Estilo4"><strong>Paso 3 
        : <BR /><br />
        Clic en el Boton &quot;Ver Balance</strong>&quot;<br />
        <BR />
        <input name="fecha_ini" type="hidden" value="<? printf("%s",$fecha_ini); ?>" />
        <input name="fecha_fin" type="hidden" value="<? printf("%s",$fecha_fin); ?>" />
        <input name="cod_ini" type="hidden" value="<? printf("%s",$cod_ini); ?>" />
        <input name="cod_fin" type="hidden" value="<? printf("%s",$cod_fin); ?>" />
        <input name="Submit" type="submit" class="Estilo4" value="Ver Balance" />
        <a href="balance_prueba34.php?fecha_ini=<?php echo $fecha_ini;?>&fecha_fin=<?php echo $fecha_fin; ?>&cod_ini=<?php echo $cod_ini;?>&cod_fin=<?php echo $cod_fin;?>" style='color:#0033FF'><br /> 
        <img src="../simbolos/CALC.png" width="60" height="50" alt="calc" title="Exportar a Excel"  onmouseover="hand();" onmouseout="nohand();" border="0"  /> </a>
        </div>
    </form>
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:200px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='balance_prueba.php' target='_parent' class="Estilo1x">VOLVER A PASO 1 </a> </div>
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