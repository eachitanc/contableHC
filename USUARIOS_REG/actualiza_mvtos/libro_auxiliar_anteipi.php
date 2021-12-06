<?php
set_time_limit(2400);
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
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
</head>

<body>

<table width="800" border="0" align="center">
  
  <tr>
    <td width="2394" colspan="3">
<?php
include('../config.php');

//**** variables para generacion dinamica

$base=$database;
$conexion=new mysqli($server, $dbuser, $dbpass, $database);

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($base, $sqlxx, $conexion);
while($rowxx = $resultadoxx->fetch_assoc()) 
{  $idxx=$rowxx["id_emp"];  $id_emp=$rowxx["id_emp"];  }

//**********************
				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = $resultadoxx3->fetch_assoc()) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }  
   
$sql4 = "select * from empresa";
$res4 = mysql_db_query($database, $sql4, $connectionxx);

while($row4 = $res4->fetch_assoc()) 
   {
   $empresa=$row4["raz_soc"];
   }  
//***** generacion de tabla temporal para guardar todos los mvtos del a�o de todas las cuentas

//**** borro tabla por si las moscas

$tabla6="TRUNCATE TABLE `lib_aux`";
mysql_select_db ($base, $connectionxx);

		if(mysql_query ($tabla6,$connectionxx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};	

//********** seccion de consulta de cuentas pgcp para llenado de tabla nueva
//***	conta_cesp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_cesp where id_emp = '$id_emp'";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$cheque=$rw["cheque".$i];
						$ips=$rw["ips"];
						$id_auto = $rw['id_auto_ncon'];
						$id_cons = $rw['id']."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,cheque,dcto_a,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$cheque','$ips','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	

//***	cartera_cont
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cartera_cont where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_causa"];
						$dcto=$rw["consec_cartera"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["ref"];
						$id_reip =$rw["id_reip"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto =$rw['consec_cartera'];
						$id_cons =$rw['id']."_".$i;
						$sql52 ="select * from reip_ing where consecutivo ='$id_reip'";
						$rr23 = mysql_db_query($database, $sql52, $connectionxx);
						$rrw23 = $rr23->fetch_assoc();
						$detalle=$rrw23["des"];
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	cecp
$cx->query($sql);
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cecp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_cecp"];
						$dcto=$rw["id_manu_cecp"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["concepto_pago"];
						$x1=$rw["nt"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$ccnit=$rw["cn"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_auto_cecp"];
						$id_cons = $rw["id"]."_".$i;
						if ($i == 1) $cheque = $rw["num_cheque"]; else $cheque = $rw["num_cheque".$i];
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,cheque,ccnit,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$cheque','$ccnit','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	ceva
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from ceva where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
					$ss3 = "select * from cobp where id_auto_cobp = '$rw[id_auto_cobp]'";
					$rr3 = mysql_db_query($database, $ss3, $connectionxx);
					while($rrw3 = $rr3->fetch_assoc()) 
					{
					  $cod_pptal=$rrw3["cuenta"];
					}
						$fecha=$rw["fecha_ceva"];
						$dcto=$rw["id_manu_ceva"];
						$ref=$rw["id_manu_cobp"];
						$cuenta=ereg_replace("[^A-Za-z0-9]", " ", $rw["pgcp".$i]);
						$nombre=ereg_replace("[^A-Za-z0-9]", " ", $nom_rubro2);
						$detalle=ereg_replace("[^A-Za-z0-9]", " ", $rw["des_ceva"]);
						$tercero=ereg_replace("[^A-Za-z0-9]", " ", $rw["tercero"]);
						$ccnit = $rw['ccnit'];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_auto_ceva"];
						$id_cons = $rw["id"]."_".$i;
						if ($i == 1) $cheque = $rw["num_cheque"]; else $cheque = $rw["num_cheque".$i];
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,ref,cheque,ccnit,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ref','$cheque','$ccnit','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while				
//***	conta_ncon
/*
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_ncon where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$ips=$rw['ips'];
						$id_auto = $rw["id_auto_ncon"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,dcto_a,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ips','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while
		*/
//***	conta_ncsp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_ncsp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$ips=$rw["ips"];
						$id_auto = $rw["id_auto_ncon"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,dcto_a,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ips','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	conta_ndsp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_ndsp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$ips=$rw["ips"];
						$id_auto = $rw["id_auto_ncon"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,dcto_a,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ips','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	conta_tfin
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//$sq = "select * from conta_tfin where id_emp = '$id_emp'";
$sq = "select distinct(id_manu_ncon),fecha_ncon,des_ncon,tercero,pgcp1,pgcp2,pgcp3,pgcp4,pgcp5,pgcp6,pgcp7,pgcp8,pgcp9,pgcp10,pgcp11,pgcp12,pgcp13,pgcp14,pgcp15,vr_deb_1,vr_deb_2,vr_deb_3,vr_deb_4,vr_deb_5,vr_deb_6,vr_deb_7,vr_deb_8,vr_deb_9,vr_deb_10,vr_deb_11,vr_deb_12,vr_deb_13,vr_deb_14,vr_deb_15,vr_cre_1,vr_cre_2,vr_cre_3,vr_cre_4,vr_cre_5,vr_cre_6,vr_cre_7,vr_cre_8,vr_cre_9,vr_cre_10,vr_cre_11,vr_cre_12,vr_cre_13,vr_cre_14,vr_cre_15,id,id_auto_ncon from conta_tfin where id_emp = '$id_emp'";
$re = $cx->query($sq);
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_auto_ncon"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while
//***	conta_coba
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_coba where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$ips=$rw['ips'];
						$id_auto = $rw["id_auto_ncon"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,dcto_a,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ips','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	

		
//	obcg

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from obcg where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_obcg"];
						$dcto=$rw["id_manu_obcg"];
						$ref=$rw["id_manu_cobp"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_cobp"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$ccnit=$rw['ccnit'];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_auto_obcg"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,ref,ccnit,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ref','$ccnit','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	recaudo_ncbt
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_ncbt where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_ncbt"];
						$dcto_a=$rw["id_recau"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$ips=$rw['ips'];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,dcto_a,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$ips','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	recaudo_rcgt
/*
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_rcgt where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<161;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						$ccnit =$rw["ter"];
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons,ccnit) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons','$ccnit')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	


//***	recaudo_riip
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from lib_aux2";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
				if($rw["cuenta"] == '' and $rw["debito"] == 0.00 and $rw["credito"] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["cuenta"];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha"];
						$dcto=$rw["dcto"];
						$cuenta=$rw["cuenta"];
						$nombre=$nom_rubro2;
						$detalle=$rw["detalle"];
						$debito=$rw["debito"];
						$credito=$rw["credito"];
						$id_auto = $rw["id_auto"];
						$id_cons = $rw["id_cons"];
						$ccnit = $rw["ccnit"];
						//Consultar el tercero que biene con ese rubro
						$sq5= "select nombre from z_terceros where num_id ='$ccnit'";
						$rs5=mysql_db_query($database,$sq5,$connectionxx);
						$rw5=mysql_fetch_array($rs5);
						$tercero=$rw5['nombre'];
						if($tercero =='') $tercero='INGRESOS VARIOS';
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons,ccnit) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons','$ccnit')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
						$debito=0;
						$credito=0;

				}
				
				
}//fin while
	*/
//***	recaudo_riur
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_riur where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<161;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						$ccnit = $rw['ter'];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons,ccnit) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons','$ccnit')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	recaudo_rtic
/*
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_rtic where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<161;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						$ccnit = $rw['ter'];
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons,ccnit) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons','$ccnit')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	recaudo_rica
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_rica where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<161;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while
//***	recaudo_rica
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_rica1 where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<161;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	recaudo_rica
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_rica2 where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<161;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
*/	
//***	recaudo_roit

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select distinct(id_manu_roit),fecha_recaudo,des_recaudo,tercero,pgcp1,pgcp2,pgcp3,pgcp4,pgcp5,pgcp6,pgcp7,pgcp8,pgcp9,pgcp10,pgcp11,pgcp12,pgcp13,pgcp14,pgcp15,vr_deb_1,vr_deb_2,vr_deb_3,vr_deb_4,vr_deb_5,vr_deb_6,vr_deb_7,vr_deb_8,vr_deb_9,vr_deb_10,vr_deb_11,vr_deb_12,vr_deb_13,vr_deb_14,vr_deb_15,vr_cre_1,vr_cre_2,vr_cre_3,vr_cre_4,vr_cre_5,vr_cre_6,vr_cre_7,vr_cre_8,vr_cre_9,vr_cre_10,vr_cre_11,vr_cre_12,vr_cre_13,vr_cre_14,vr_cre_15 from recaudo_roit where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<16;$i++)
			{
				if($rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_roit"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	recaudo_tnat
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_tnat where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = $rr2->fetch_assoc()) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_tnat"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$x1=$rw["tercero"];
		                $tercero = ereg_replace("[^A-Za-z0-9]", " ", $x1);
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						$id_auto = $rw["id_recau"];
						$id_cons = $rw["id"]."_".$i;
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito,id_auto,id_cons) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito','$id_auto','$id_cons')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
?>
<div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:30px;">
  <div align="center" class="Estilo4"><strong>ACTUALIZACION REALIZADA CON EXITO</strong><BR /><BR />Puede proceder a la realizacion de:<br />Libros Auxiliares<br />Balances<br />Conciliaciones Bancarias  <br />
  </div>
</div></td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>