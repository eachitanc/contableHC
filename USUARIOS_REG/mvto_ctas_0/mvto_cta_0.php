<?
set_time_limit(180);
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
-->
</style>
</head>
<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
</table>
<div align="center">
<?
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

$tabla6="aux_cta_0";
$anadir6="DROP TABLE ";
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


$tabla7="aux_cta_0";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  
  `id` varchar(200)  NOT NULL default '',
  `cuenta` varchar(200)  NOT NULL default '',
  `fecha` varchar(200)  NOT NULL default '',
  `dcto` varchar(200)  NOT NULL default '',
  `tercero` varchar(200)  NOT NULL default '',
  `detalle` varchar(200)  NOT NULL default '',
  `debito` decimal(20,2) NOT NULL default '0.00',
  `credito` decimal(20,2) NOT NULL default '0.00'
    
)TYPE=MyISAM AUTO_INCREMENT=1 ";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		//echo "listo";
		}
		else
		{
		//echo "no se pudo";
		}
		

//*** nombre de la empresa

$sxxq = "select * from empresa";
$rxxq = mysql_db_query($database, $sxxq, $conexion) or die ($rxxq .mysql_error()."");

while($rowxxxq = mysql_fetch_array($rxxq)) 
   {
   
   $raz_soc=$rowxxxq["raz_soc"];


   }  

//******************* fecha ini op

$sxxq = "select * from fecha_ini_op";
$rxxq = mysql_db_query($database, $sxxq, $conexion) or die ($rxxq .mysql_error()."");

while($rowxxxq = mysql_fetch_array($rxxq)) 
   {
   
   $fecha_ini_op=$rowxxxq["fecha_ini_op"];


   }  
   
   
$ts1 = strtotime($fecha_ini_op);
$primer_t = strtotime('+3 month -1 day',$ts1);
$segundo_t = strtotime('+6 month -1 day',$ts1);
$tercer_t = strtotime('+9 month -1 day',$ts1);
$cuarto_t = strtotime('+12 month -1 day',$ts1);

$uno=date('Y/m/d', $primer_t);
$dos=date('Y/m/d', $segundo_t);
$tres=date('Y/m/d', $tercer_t);
//$cuatro=date('Y/m/d', $cuarto_t);
$cuatro =$_POST['corte'];


//***** carga vrs del ppto de ing aprob
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from car_ppto_ing where tip_dato ='D' and (ano <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$ano=$rw["ano"];
$cod_pptal=$rw["cod_pptal"];
$ppto_aprob=$rw["ppto_aprob"];
$situacion=$rw["situacion"];


		

		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
	
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_ing_apr','$ano','COPI','$raz_soc','CARGA INICIAL PPTO ING','$ppto_aprob','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_ing_x_eje','$ano','COPI','$raz_soc','CARGA INICIAL PPTO ING','0.00','$ppto_aprob')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


}//fin while			

printf("<br><br><center class='Estilo4'>Cuentas 0 Presupuesto de Ingresos Cargadas con Exito</center><br>");

?>
<?
//adiciones
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from adi_ppto_ing where (fecha_adi <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_adi=$rw["fecha_adi"];
$valor_adi=$rw["valor_adi"];
$concepto_adi=$rw["concepto_adi"];
$cod_pptal_adi=$rw["cod_pptal"];

	

		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cod_pptal_adi'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
		
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_ing_apr','$fecha_adi','ADPI','$raz_soc','$concepto_adi','$valor_adi','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_ing_x_eje','$fecha_adi','ADPI','$raz_soc','$concepto_adi','0.00','$valor_adi')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


}//fin while			

printf("<center class='Estilo4'>Cuentas 0 Presupuesto de Ingresos - ADICIONES - Cargadas con Exito</center><br>");
?>
<?
//reducciones
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from red_ppto_ing where (fecha_adi <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_adi=$rw["fecha_adi"];
$valor_adi=$rw["valor_adi"];
$concepto_adi=$rw["concepto_adi"];
$cod_pptal_red=$rw["cod_pptal"];
	

		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cod_pptal_red'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
		
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_ing_x_eje','$fecha_adi','RDPI','$raz_soc','$concepto_adi','$valor_adi','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_ing_apr','$fecha_adi','RDPI','$raz_soc','$concepto_adi','0.00','$valor_adi')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


}//fin while			

printf("<center class='Estilo4'>Cuentas 0 Presupuesto de Ingresos - REDUCCIONES - Cargadas con Exito</center><br>");
?>
<?
//recaudo roit
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from recaudo_roit where (fecha_recaudo <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$id_manu_roit=$rw["id_manu_roit"];
$fecha_recaudo=$rw["fecha_recaudo"];
$des_recaudo=$rw["des_recaudo"];
$tercero=$rw["tercero"];
$cuenta=$rw["cuenta"];
$vr_digitado=$rw["vr_digitado"];

	
		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_eje =$rw2["cod_pptal_ing_eje"];
			$cod_pptal_no_aforados =$rw2["cod_pptal_no_aforados"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
			$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
		}	
				$resultax=mysql_query("select SUM(debito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a1=$rowx[0];
				$resulta=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' and dcto ='RDPI' ",$cx) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$red=$row[0];
				$a1 = $a1 - $red;
				$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_eje' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a2=$rowx[0];
				$a3=$a2+$vr_digitado;
				if($a1 >= $a3)
				{
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','0.00','$vr_digitado')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
								
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','$vr_digitado','0.00')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
								
								
								//printf("entro a aprobado  >=  a ejecutado + vr digitado<br>");
				
				}
				else
				{
								
								if($a1 < $a3)
								{
								// Obtengo el salod que puedo ingresar a la cuenta normalemente
										$saldo_roit = $a1 - $a2;
										$saldo_no_aprb_roit = $vr_digitado - $saldo_roit;
									if ($saldo_roit > 0)
									{
								// Grabo el saldo cuando alcanza en el moviemiento normal
									
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','0.00','$saldo_roit')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','$saldo_roit','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','0.00','$saldo_no_aprb_roit')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','$saldo_no_aprb_roit','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
									}else{
									
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','0.00','$vr_digitado')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_roit','$tercero','$des_recaudo','$vr_digitado','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
									}
							     //printf("entro a aprobado menor a ejecutado + vr digitado<br>");
												
								}
				  
				
				
				}
				
				
				

//printf("<br>--------------</br>");

}//fin while			
?>
<?
//recaudo ncbt
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// seleccionamos toda la tabla recaudo de acuerdo a la fecha de corte
$sq = "select * from recaudo_ncbt where (fecha_recaudo <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");
while($rw = mysql_fetch_array($re)) 
{
$id_manu_ncbt=$rw["id_manu_ncbt"];
$fecha_recaudo=$rw["fecha_recaudo"];
$des_recaudo=$rw["des_recaudo"];
$tercero=$rw["tercero"];
$cuenta=$rw["cuenta"];
$vr_digitado=$rw["vr_digitado"];
		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_eje =$rw2["cod_pptal_ing_eje"];
			$cod_pptal_no_aforados =$rw2["cod_pptal_no_aforados"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
			$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
		}	
				// Selecciono la suma de los debitos y creditos de la tabla auxiliar de cuenta cero antes de grabar
				$resultax=mysql_query("select SUM(debito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a1=$rowx[0];
				$resulta=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' and dcto ='RDPI' ",$cx) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$red=$row[0];
				$a1 = $a1 - $red;
				$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_eje' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a2=$rowx[0];
				$a3=$a2+$vr_digitado;	
				if($a1 >= $a3) // el asiento se graba normal
				{
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','0.00','$vr_digitado')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
								
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','$vr_digitado','0.00')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
				}
				else
				{
								if($a1 < $a3)
								{
									// Obtengo el salod que puedo ingresar a la cuenta normalemente
										$saldo_ncbt = $a1 - $a2;
										$saldo_no_aprobado = $vr_digitado - $saldo_ncbt;
									// Grabo el saldo cuando alcanza en el moviemiento normal
										if ($saldo_ncbt > 0)
										{	
											$sql_ok = "INSERT INTO aux_cta_0 
											(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
											VALUES 
											('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','0.00','$saldo_ncbt')";
											mysql_query($sql_ok, $cx) or die(mysql_error());
											
											$sql_ok = "INSERT INTO aux_cta_0 
											(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
											VALUES 
											('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','$saldo_ncbt','0.00')";
											mysql_query($sql_ok, $cx) or die(mysql_error());
										
											// Registro el saldo de los ingresos no aforados
											$sql_ok = "INSERT INTO aux_cta_0 
											(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
											VALUES 
											('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','0.00','$saldo_no_aprobado')";
											mysql_query($sql_ok, $cx) or die(mysql_error());
											
											$sql_ok = "INSERT INTO aux_cta_0 
											(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
											VALUES 
											('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','$saldo_no_aprobado','0.00')";
											mysql_query($sql_ok, $cx) or die(mysql_error());
										}else{
											// Registro el saldo de los ingresos no aforados
											$sql_ok = "INSERT INTO aux_cta_0 
											(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
											VALUES 
											('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','0.00','$vr_digitado')";
											mysql_query($sql_ok, $cx) or die(mysql_error());
											
											$sql_ok = "INSERT INTO aux_cta_0 
											(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
											VALUES 
											('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_ncbt','$tercero','$des_recaudo','$vr_digitado','0.00')";
											mysql_query($sql_ok, $cx) or die(mysql_error());
											}
										
								}
				  
				
				
				}
				
				
				

//printf("<br>--------------</br>");

}//fin while			
?>
<?
//recaudo tnat
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from recaudo_tnat where (fecha_recaudo <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$id_manu_tnat=$rw["id_manu_tnat"];
$fecha_recaudo=$rw["fecha_recaudo"];
$des_recaudo=$rw["des_recaudo"];
$tercero=$rw["tercero"];
$cuenta=$rw["cuenta"];
$vr_digitado=$rw["vr_digitado"];

	
		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_eje =$rw2["cod_pptal_ing_eje"];
			$cod_pptal_no_aforados =$rw2["cod_pptal_no_aforados"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
			$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
		}	
				$resultax=mysql_query("select SUM(debito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a1=$rowx[0];
				$resulta=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' and dcto ='RDPI' ",$cx) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$red=$row[0];
				$a1 = $a1 - $red;
				$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_eje' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a2=$rowx[0];
				$a3=$a2+$vr_digitado;
				if($a1 >= $a3)
				{
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','0.00','$vr_digitado')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
								
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','$vr_digitado','0.00')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
								
								
								//printf("entro a aprobado  >=  a ejecutado + vr digitado<br>");
				
				}
				else
				{
								
								if($a1 < $a3)
								{
								// Obtengo el salod que puedo ingresar a la cuenta normalemente
										$saldo_tnat = $a1 - $a2;
										$saldo_no_aprb_tnat = $vr_digitado - $saldo_tnat;
									if ($saldo_tnat > 0)
									{
								// Grabo el saldo cuando alcanza en el moviemiento normal
									
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','0.00','$saldo_tnat')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','$saldo_tnat','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
								
								
									$sql_ok = "INSERT INTO aux_cta_0 
									(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
									VALUES 
									('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','0.00','$saldo_no_aprb_tnat')";
									mysql_query($sql_ok, $cx) or die(mysql_error());
									
									$sql_ok = "INSERT INTO aux_cta_0 
									(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
									VALUES 
									('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','$saldo_no_aprb_tnat','0.00')";
									mysql_query($sql_ok, $cx) or die(mysql_error());
								}else{
									$sql_ok = "INSERT INTO aux_cta_0 
									(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
									VALUES 
									('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','0.00','$vr_digitado')";
									mysql_query($sql_ok, $cx) or die(mysql_error());
									
									$sql_ok = "INSERT INTO aux_cta_0 
									(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
									VALUES 
									('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_tnat','$tercero','$des_recaudo','$vr_digitado','0.00')";
									mysql_query($sql_ok, $cx) or die(mysql_error());
								}
								
								//printf("entro a aprobado menor a ejecutado + vr digitado<br>");
												
								}
				  
				
				
				}
				
				
				

//printf("<br>--------------</br>");

}//fin while			
?>
<?
//recaudo rcgt
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from recaudo_rcgt where (fecha_recaudo <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$id_manu_rcgt=$rw["id_manu_rcgt"];
$fecha_recaudo=$rw["fecha_recaudo"];
$des_recaudo=$rw["des_recaudo"];
$tercero=$rw["tercero"];
$cuenta=$rw["cuenta"];
$vr_digitado=$rw["vr_digitado"];

	
		$sq2 = "select * from ctas0_ing_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_ing_eje =$rw2["cod_pptal_ing_eje"];
			$cod_pptal_no_aforados =$rw2["cod_pptal_no_aforados"];
			$cod_pptal_ing_x_eje=$rw2["cod_pptal_ing_x_eje"];
			$cod_pptal_ing_apr=$rw2["cod_pptal_ing_apr"];
		}	
				$resultax=mysql_query("select SUM(debito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a1=$rowx[0];
				$resulta=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_apr' and dcto ='RDPI' ",$cx) or die (mysql_error());
				$row=mysql_fetch_row($resulta);
				$red=$row[0];
				$a1 = $a1 - $red; 
				$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE cuenta ='$cod_pptal_ing_eje' ",$cx) or die (mysql_error());
				$rowx=mysql_fetch_row($resultax);
				$a2=$rowx[0];
				$a3=$a2+$vr_digitado;
				if($a1 >= $a3)
				{
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','0.00','$vr_digitado')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
								
								$sql_ok = "INSERT INTO aux_cta_0 
								(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
								VALUES 
								('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','$vr_digitado','0.00')";
								mysql_query($sql_ok, $cx) or die(mysql_error());
				}
				else
				{
								if($a1 < $a3)
								{
								// Obtengo el salod que puedo ingresar a la cuenta normalemente
										$saldo_rcgt = $a1 - $a2;
										$saldo_no_aprb_rcgt = $vr_digitado - $saldo_rcgt;
								
									if ($saldo_rcgt > 0)
									{
								// Grabo el saldo cuando alcanza en el moviemiento normal
									
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','0.00','$saldo_rcgt')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_x_eje','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','$saldo_rcgt','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
								
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','0.00','$saldo_no_aprb_rcgt')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','$saldo_no_aprb_rcgt','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
									}else{
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_ing_eje','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','0.00','$vr_digitado')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
										
										$sql_ok = "INSERT INTO aux_cta_0 
										(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
										VALUES 
										('$cuatro','$cod_pptal_no_aforados','$fecha_recaudo','$id_manu_rcgt','$tercero','$des_recaudo','$vr_digitado','0.00')";
										mysql_query($sql_ok, $cx) or die(mysql_error());
									}	
								
								//printf("entro a aprobado menor a ejecutado + vr digitado<br>");
												
								}
				  
				
				
				}
				
				
				

//printf("<br>--------------</br>");

}//fin while		
printf("<center class='Estilo4'>Cuentas 0 Presupuesto de Ingresos - RECAUDOS - Cargadas con Exito</center><br>");

/*$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE dcto LIKE 'ROIT%'",$cx) or die (mysql_error());
$rowx=mysql_fetch_row($resultax);
$A=$rowx[0];

$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE dcto LIKE 'NCBT%'",$cx) or die (mysql_error());
$rowx=mysql_fetch_row($resultax);
$B=$rowx[0];

$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE dcto LIKE 'TNAT%'",$cx) or die (mysql_error());
$rowx=mysql_fetch_row($resultax);
$C=$rowx[0];

$resultax=mysql_query("select SUM(credito) AS TOTAL from aux_cta_0 WHERE dcto LIKE 'RCGT%'",$cx) or die (mysql_error());
$rowx=mysql_fetch_row($resultax);
$D=$rowx[0];

printf("%s",$A+$B+$C+$D);*/

?>

<?
//************* gastos - henry

// presupuesto aprobado de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from car_ppto_gas where tip_dato ='D' and (ano <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$ano=$rw["ano"];
$cod_pptal=$rw["cod_pptal"];
$ppto_aprob=$rw["ppto_aprob"];
$situacion=$rw["situacion"];

//printf("fecha : $ano <br>");
//printf("cod_pptal : $cod_pptal <br>");
//printf("ppto_aprob : $ppto_aprob <br>");
//printf("situacion : $situacion <br>");
		

		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_gas_apr=$rw2["cod_pptal_gas_apr"];
			$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
	
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr','$ano','COPG','$raz_soc','CARGA INICIAL PPTO GAT','0.00','$ppto_aprob')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr2','$ano','COPG','$raz_soc','CARGA INICIAL PPTO GAT','$ppto_aprob','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 Presupuesto de Gastos Cargadas con Exito</center><br>");

?>
<?
// Adiciones presupuesto de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from adi_ppto_gas where  (fecha_adi <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_adi=$rw["fecha_adi"];
$valor_adi=$rw["valor_adi"];
$concepto_adi=$rw["concepto_adi"];
$cod_pptal=$rw["cod_pptal"];


//printf("fecha_adi : $fecha_adi <br>");
//printf("valor_adi : $valor_adi <br>");
//printf("concepto_adi : $concepto_adi <br>");


		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_gas_apr=$rw2["cod_pptal_gas_apr"];
			$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
	
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr','$fecha_adi','ADPG','$raz_soc','$concepto_adi','0.00','$valor_adi')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr2','$fecha_adi','ADPG','$raz_soc','$concepto_adi','$valor_adi','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 ADICIONES de Gastos Cargadas con Exito</center><br>");
?>
<?

// Reduciones presupuesto de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from red_ppto_gas where  (fecha_adi <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_adi=$rw["fecha_adi"];
$valor_adi=$rw["valor_adi"];
$concepto_adi=$rw["concepto_adi"];
$cod_pptal=$rw["cod_pptal"];


//printf("fecha_adi : $fecha_adi <br>");
//printf("valor_adi : $valor_adi <br>");
//printf("concepto_adi : $concepto_adi <br>");		

		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_gas_apr=$rw2["cod_pptal_gas_apr"];
			$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
	
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr','$fecha_adi','RDPG','$raz_soc','$concepto_adi','$valor_adi','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr2','$fecha_adi','RDPG','$raz_soc','$concepto_adi','0.00','$valor_adi')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 REDUCCIONES de Gastos Cargadas con Exito</center><br>");

?>
<?

// Creditos presupuesto de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from creditos where  (fecha_adi <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_adi=$rw["fecha_adi"];
$valor_adi=$rw["valor_adi"];
$concepto_adi=$rw["concepto_adi"];
$cod_pptal=$rw["cod_pptal"];


//printf("fecha_adi : $fecha_adi <br>");
//printf("valor_adi : $valor_adi <br>");
//printf("concepto_adi : $concepto_adi <br>");		

		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_gas_apr=$rw2["cod_pptal_gas_apr"];
			$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
	
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr','$fecha_adi','CDPG','$raz_soc','$concepto_adi','0.00','$valor_adi')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr2','$fecha_adi','CDPG','$raz_soc','$concepto_adi','$valor_adi','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 CREDITOS de Gastos Cargadas con Exito</center><br>");


?>

<?
// Contracreditos presupuesto de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from contracreditos where  (fecha_adi <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_adi=$rw["fecha_adi"];
$valor_adi=$rw["valor_adi"];
$concepto_adi=$rw["concepto_adi"];
$cod_pptal=$rw["cod_pptal"];


//printf("fecha_adi : $fecha_adi <br>");
//printf("valor_adi : $valor_adi <br>");
//printf("concepto_adi : $concepto_adi <br>");	
		

		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_gas_apr=$rw2["cod_pptal_gas_apr"];
			$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
	
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr','$fecha_adi','CCPG','$raz_soc','$concepto_adi','$valor_adi','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_pptal_gas_apr2','$fecha_adi','CCPG','$raz_soc','$concepto_adi','0.00','$valor_adi')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 CONTRACREDITOS de Gastos Cargadas con Exito</center><br>");

?>
<?

//COMPROMISOS

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from crpp where (fecha_crpp <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_crpp=$rw["fecha_crpp"];
$id_manu_crpp=$rw["id_manu_crpp"];
$vr_digitado=$rw["vr_digitado"];
$detalle_crpp=$rw["detalle_crpp"];
$tercero=$rw["tercero"];
$cuenta=$rw["cuenta"];

if($vr_digitado < 0)
{
		
		$vr_digitado=$vr_digitado*-1;
		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		$cod_pptal_crp=$rw2["cod_pptal_crp"];
		$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
		}
		
		$sql_ok = "INSERT INTO aux_cta_0 
		(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
		VALUES 
		('$cuatro','$cod_pptal_crp','$fecha_crpp','$id_manu_crpp','$tercero','$detalle_crpp','0.00','$vr_digitado')";
		mysql_query($sql_ok, $cx) or die(mysql_error());
				
		$sql_ok = "INSERT INTO aux_cta_0 
		(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
		VALUES 
		('$cuatro','$cod_pptal_gas_apr2','$fecha_crpp','$id_manu_crpp','$tercero','$detalle_crpp','$vr_digitado','0.00')";
		mysql_query($sql_ok, $cx) or die(mysql_error());


}
else
{
		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		$cod_pptal_crp=$rw2["cod_pptal_crp"];
		$cod_pptal_gas_apr2=$rw2["cod_pptal_gas_apr2"];
		}
		
		
		$sql_ok = "INSERT INTO aux_cta_0 
		(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
		VALUES 
		('$cuatro','$cod_pptal_crp','$fecha_crpp','$id_manu_crpp','$tercero','$detalle_crpp','$vr_digitado','0.00')";
		mysql_query($sql_ok, $cx) or die(mysql_error());
		
		$sql_ok = "INSERT INTO aux_cta_0 
		(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
		VALUES 
		('$cuatro','$cod_pptal_gas_apr2','$fecha_crpp','$id_manu_crpp','$tercero','$detalle_crpp','0.00','$vr_digitado')";
		mysql_query($sql_ok, $cx) or die(mysql_error());
}	



//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 COMPROMISOS Cargadas con Exito</center><br>");
?>

<?

// Obligaciones presupuesto de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from cobp where  (fecha_cobp <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{
$fecha_cobp=$rw["fecha_cobp"];
$id_manu_cobp=$rw["id_manu_cobp"];
$tercero=$rw["tercero"];
$vr_digitado=$rw["vr_digitado"];
$des_cobp=$rw["des_cobp"];
$cuenta=$rw["cuenta"];

//printf("fecha_cobp : $fecha_cobp <br>");
//printf("id_manu_cobp : $id_manu_cobp <br>");
//printf("tercero : $tercero <br>");	
//printf("vr_digitado : $vr_digitado <br>");	
//printf("des_cobp : $des_cobp <br>");	
//printf("cuenta : $cuenta <br>");			

		$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cuenta'";
		$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_pptal_crp=$rw2["cod_pptal_crp"];
			$cod_pptal_cobp=$rw2["cod_pptal_cobp"];
			//printf("cod_pptal_crp : $cod_pptal_crp <br>");	
			//printf("cod_pptal_cobp : $cod_pptal_cobp <br>");
		}


						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
					('$cuatro','$cod_pptal_cobp','$fecha_cobp','$id_manu_cobp','$tercero','$des_cobp','$vr_digitado','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
					('$cuatro','$cod_pptal_crp','$fecha_cobp','$id_manu_cobp','$tercero','$des_cobp','0.00','$vr_digitado')";
						mysql_query($sql_ok, $cx) or die(mysql_error());


//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 OBLIGACIONES de Gastos Cargadas con Exito</center><br>");

?>
<?

// Pagos presupuesto de gastos

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from ceva where  (fecha_ceva <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx) or die ($re .mysql_error()."");

while($rw = mysql_fetch_array($re)) 
{

$fecha_ceva=$rw["fecha_ceva"];
$id_manu_ceva=$rw["id_manu_ceva"];
$tercero=$rw["tercero"];
$total_pagado=$rw["total_pagado"]+$rw["salud"]+$rw["pension"]+$rw["libranza"]+$rw["f_solidaridad"]+$rw["f_empleados"]+$rw["sindicato"]+$rw["embargo"]+$rw["cruce"]+$rw["otros"]+$rw["vr_retefuente"]+$rw["vr_reteiva"]+$rw["vr_reteica"]+$rw["vr_estampilla1"]+$rw["vr_estampilla2"]+$rw["vr_estampilla3"]+$rw["vr_estampilla4"]+$rw["vr_estampilla5"];


$des_ceva=$rw["des_ceva"];
$desceva=eregi_replace('[%]', ' por ciento ', $des_ceva);



	$id_auto_cobp=$rw["id_auto_cobp"];
	
	$sqx1 = "select * from cobp where  id_auto_cobp ='$id_auto_cobp'";
	$rex1 = mysql_db_query($database, $sqx1, $cx) or die ($rex1 .mysql_error()."");
	while($rwx1 = mysql_fetch_array($rex1)) 
	{
	
	
			$cuenta=$rwx1["cuenta"];
			$vr_digitado=$rwx1["vr_digitado"];
	


			$sqx2 = "select * from car_ppto_gas where  cod_pptal ='$cuenta'";
			$rex2 = mysql_db_query($database, $sqx2, $cx) or die ($rex2 .mysql_error()."");
			while($rwx2 = mysql_fetch_array($rex2)) 
			{
			$situacion=$rwx2["situacion"];
			}
			
			
			$sq2 = "select * from ctas0_gas_ok where cod_pptal ='$cuenta'";
			$re2 = mysql_db_query($database, $sq2, $cx) or die ($re2 .mysql_error()."");
			
			while($rw2 = mysql_fetch_array($re2)) 
			{
			$cod_pptal_ceva_con_sit=$rw2["cod_pptal_ceva_con_sit"];
			$cod_pptal_ceva_sin_sit=$rw2["cod_pptal_ceva_sin_sit"];
			$cod_pptal_cobp=$rw2["cod_pptal_cobp"];
			}
			
			
				
				
				
				if($situacion == 'C' or $situacion == '')
			   {
   						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
					('$cuatro','$cod_pptal_ceva_con_sit','$fecha_ceva','$id_manu_ceva','$tercero','$des_ceva','$vr_digitado','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
					('$cuatro','$cod_pptal_cobp','$fecha_ceva','$id_manu_ceva','$tercero','$des_ceva','0.00','$vr_digitado')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
			   }
			   else
			   {
			      		$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
					('$cuatro','$cod_pptal_ceva_sin_sit','$fecha_ceva','$id_manu_ceva','$tercero','$des_ceva','$vr_digitado','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
					('$cuatro','$cod_pptal_cobp','$fecha_ceva','$id_manu_ceva','$tercero','$des_ceva','0.00','$vr_digitado')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
			   }
			
			
	}




}//fin while			

printf("<center class='Estilo4'>Cuentas 0 PAGOS de Gastos Cargadas con Exito</center><br>");


?>

<?
 

// presupuesto aprobado de cuentas por pagar 

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
select * from cxp where tip_dato ='D' and (ano <= '$cuatro') ";
$re = mysql_db_query($database, $sq, $cx);

while($rw = mysql_fetch_array($re)) 
{
$ano=$rw["ano"];
$cod_pptal=$rw["cod_pptal"];
$definitivo=$rw["definitivo"];


//printf("fecha : $ano <br>");
//printf("cod_pptal : $cod_pptal <br>");
//printf("definitivo : $definitivo <br>");

		

		$sq2 = "select * from ctas0_cxp_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_cxp_consti=$rw2["cod_cxp_consti"];
			$cod_cxp_x_cancelar=$rw2["cod_cxp_x_cancelar"];
			
	
		}
			if ($definitivo >0)
			{
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_cxp_consti','$ano','CICP','$raz_soc','CARGA INICIAL CXP','0.00','$definitivo')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_cxp_x_cancelar','$ano','CICP','$raz_soc','CARGA INICIAL CXP','$definitivo','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
			}

//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 Presupuesto de cuentas por pagar Cargadas con Exito</center><br>");

?>

<?
 

// presupuesto ejecutado de cuentas por pagar 

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cecp_cuenta where fecha_cecp <= '$cuatro' ";
$re = mysql_db_query($database, $sq, $cx);

while($rw = mysql_fetch_array($re)) 
{
$ano=$rw["fecha_cecp"];
$cod_pptal=$rw["cuenta"];
$definitivo=$rw["valor"];
$id_auto_cecp =$rw["id_auto_cecp"];

	$sq2 = "select * from cecp where id_auto_cecp = '$id_auto_cecp'";
	$re2 = mysql_db_query($database, $sq2, $cx);
	while ($rw2 = mysql_fetch_array($re2))
	{
	$tercero=$rw2["nt"];
	$concepto=$rw2["concepto_cxp"];
	$doc=$rw2["id_manu_cecp"];
	}

//printf("fecha : $ano <br>");
//printf("cod_pptal : $cod_pptal <br>");
//printf("definitivo : $definitivo <br>");

		

		$sq2 = "select * from ctas0_cxp_ok where cod_pptal ='$cod_pptal'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		
		while($rw2 = mysql_fetch_array($re2)) 
		{
		 	$cod_cxp_x_cancelar=$rw2["cod_cxp_x_cancelar"];
			$cod_cxp_canceladas=$rw2["cod_cxp_canceladas"];
	
		}
			if ($definitivo >0)
			{
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_cxp_x_cancelar','$ano','$doc','$tercero','$concepto','0.00','$definitivo')";
						mysql_query($sql_ok, $cx) or die(mysql_error());
						
						$sql_ok = "INSERT INTO aux_cta_0 
						(id,cuenta,fecha,dcto,tercero,detalle,debito,credito) 
						VALUES 
						('$cuatro','$cod_cxp_canceladas','$ano','$doc','$tercero','$concepto','$definitivo','0.00')";
						mysql_query($sql_ok, $cx) or die(mysql_error());

			}
//printf("<br>--------------</br>");
}//fin while			

printf("<center class='Estilo4'>Cuentas 0 Presupuesto Ejecutado de cuentas por pagar Cargadas con Exito</center><br>");

?>


</div>
<table width="800" border="0" align="center">
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
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
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx) or die ($resultadoxx .mysql_error()."");

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
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?PHP include('../config.php'); echo $nom_emp ?>
        <br />
        <?PHP echo $dir_tel ?><br />
        <?PHP echo $muni ?> <br />
        <?PHP echo $email?> </div>
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
</table>
</body>
</html>

<?
}
?>