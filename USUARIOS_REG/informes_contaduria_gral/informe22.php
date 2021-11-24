<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CATALOGO_CUENTAS_DETALLE.xls");
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
	mso-number-format:"#,##0.00"	
	}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
</head>
<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <!--img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /-->	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <!--div align="center"><a href='a.php' target='_parent'>VOLVER </a> </div-->
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>CATALOGO DE CUENTAS A NIVEL DE DETALLE (MILES DE PESOS) </strong></div>
	   <div align="center" class="Estilo4"><strong>Las celdas marcadas con color presentan errores</strong></div>
    </div></td>
  </tr>
</table>
<div align="center">
<?php 
include('../config.php');		
		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

// ide emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
// corte
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select corte from aux_corte_cgn";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $corte=$rowxx["corte"];
}
// fecha ini op
$sqlxx1 = "select * from vf";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $fecha_ini_op=$rowxx1["fecha_ini"];
}



include('../config.php');		
		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//**** borro tabla por si las moscas

$tabla6="aux_contaduria_gral_may";
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
};	

///**** creo la tabla

$tabla7="aux_contaduria_gral_may";
$anadir7="CREATE TABLE ";
$anadir7.=$tabla7;
$anadir7.="
(
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

)TYPE=MyISAM COLLATE=latin1_general_ci";
mysql_select_db ($base, $conexion);

if(mysql_query ($anadir7 ,$conexion)) 
{
//echo "listo";
}
else
{
//echo "no se pudo";
}
//encabezado tabla
printf("
<center>
<table width='1360' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='30'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'></span>
</div>
</td>
<td align='center' width='30'><span class='Estilo4'><b>NIVEL</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>INICIAL</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CREDITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>SALDO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CORRIENTE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>NO CORRIENTE</b></span></td>
</tr>

");



$sqlxx2 = "select aux_contaduria_gral.cuenta_ant,aux_contaduria_gral.debito, aux_contaduria_gral.credito, inicial from aux_contaduria_gral where (aux_contaduria_gral.fecha <= '$corte') group by aux_contaduria_gral.cuenta order by aux_contaduria_gral.cuenta_ant asc";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
		  
			   printf("<span class='Estilo4'><tr>");
			   printf("<td align='center'><span class='Estilo4'> D </span></td>");
			  
			  $cuenta_aux=$rowxx2["cuenta_ant"];
			  
			  $sd=round(($rowxx2["debito"]),0);
			  $sc=round(($rowxx2["credito"]),0);
			  
			  $inicial_aux=round(($rowxx2["inicial"]),0);
		  
//********************************* NIVEL		  

$sql = "select * from pgcp where homologacion = '$cuenta_aux'";
$result = mysql_query($sql, $connectionxx) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{
//NIVEL
 printf("<td align='center' bgcolor ='#990000'><span class='Estilo4' style='color:#FFFF00'> error </span></td>");
}
else
{
$sqlxx2a = "select * from pgcp where homologacion = '$cuenta_aux'";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{
  $nivel=$rowxx2a["nivel"];
}

 //NIVEL
 printf("<td align='center'><span class='Estilo4'> %s </span></td>",$nivel);
}

//*************************** CUENTA	

//CUENTA
 printf("<td align='left' class='text'>%s</td>",$cuenta_aux);

//******************************** NOMBRE			  
$sql = "select * from pgcp where homologacion = '$cuenta_aux'";
$result = mysql_query($sql, $connectionxx) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{
//NOMBRE
 printf("<td align='center' bgcolor ='#990000'><span class='Estilo4' style='color:#FFFF00'> error </span></td>");
}
else
{
$sqlxx2a = "select * from pgcp where homologacion = '$cuenta_aux'";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{
  $nom_rubro_pgcp=$rowxx2a["nom_rubro"];
}

  //NOMBRE
 printf("<td align='left'><span class='Estilo4'> %s </span></td>",$nom_rubro_pgcp);
}
			  
//******************************* SICO		  
					  $saldo_sico = $inicial_aux;
					  //SICO
				       printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($inicial_aux,2,',','.'));
			//	}
//************************ DEBITO Y CREDITO ACUMULADO				
		  		//TOT DEBITO ACUMULADO
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($sd,2,',','.'));
				//TOT CREDITO ACUMULADO
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($sc,2,',','.'));
//****************************** CALCULO SALDOS

			/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
			LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/
			//******* naturaleza de la cuenta
			$nat1 = substr($cuenta_aux,0,1);
			$nat2 = substr($cuenta_aux,0,2);
			if($nat1 != 0)
			{
				
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
						
						   $saldo=$saldo_sico + $sd - $sc;
						//SALDO
							 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
						}
						else
						{
						   $saldo=$saldo_sico - $sd + $sc;
						//SALDO
							 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
						}
			}
			else
			{
						$saldo=$saldo_sico + $sd - $sc;
						//SALDO
						printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
			}			
//********************************* CTE  - NO CTE		  
				
			$c_nc = substr($cuenta_aux,0,2);
			
if($c_nc == '11' or $c_nc == '12' or $c_nc == '13' or $c_nc == '14' or $c_nc == '15' or $c_nc == '21' or $c_nc == '22' or $c_nc == '23' or $c_nc == '24' or $c_nc == '25' or $c_nc == '27')
			
			{	
			$nat_c_nc = "C";	
			}
			  
		  if($c_nc == '16' or $c_nc == '17' or $c_nc == '18' or $c_nc == '19' or $c_nc == '26' or $c_nc == '28' or $c_nc == '29')
		  
			{
			$nat_c_nc = "NC";
			}
			
		   if($c_nc > '29')
		   
			{
			$nat_c_nc = "NC";
			}
				if($nat_c_nc == 'C')
				{
				$cte_aux=$saldo;
				//CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
				//NO CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> 0,00 </span></td>");
				}
				else
				{
				$n_cte_aux=$saldo;
				//CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> 0,00 </span></td>");
				//NO CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
				}
$sql_ok = "INSERT INTO aux_contaduria_gral_may  
(d,nivel,cuenta,nombre,inicial,debito,credito,saldo,corriente,no_corriente) 
VALUES 
('$d','$nivel','$cuenta_aux','$nom_rubro_pgcp','$saldo_sico','$sd','$sc','$saldo','$cte_aux','$n_cte_aux')";
mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				
				
				
				printf("</tr>"); 
		  		  
		  
} 
?>

 <?php
//-------
 printf("</table></center>");
//--------	
?>

</div>
<!--table width="800" border="0" align="center">
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='a.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
            <span class="Estilo4"> <strong>
            <?/* include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
*/
?>
            </strong> </span> <br />
            <span class="Estilo4"><b>Usuario: </b><u><? //echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?PHP //include('../config.php'); echo $nom_emp ?>
        <br />
        <?PHP //echo $dir_tel ?><br />
        <?PHP //echo $muni ?> <br />
        <?PHP //echo $email?> </div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
        </a><br />
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a></div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
        Derechos Reservados - 2009 </div>
    </div></td>
  </tr>
<--/table>
</body>
</html>
<?
}
?>