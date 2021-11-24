<?php
set_time_limit(2600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<?
include('../config.php');
include('../objetos/digito_verificacion.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
// Consulto fecha de incio de operaciones
$sq7 ="select * from fecha_ini_op";
$re7 = mysql_db_query($database, $sq7, $cx);
$rw7 = mysql_fetch_array($re7); 
//************ Borro la tabla
$anadir6.="truncate TABLE dian_exogena";
mysql_select_db ($database, $cx);
		if(mysql_query ($anadir6 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};		
//************** creo tabla f28_cdn
		$anadir7.="CREATE TABLE dian_exogena
		( 
  `tipo` varchar(200) NOT NULL default '',
  `codigo_1001` varchar(200) NOT NULL default '',
  `codigo_1002` varchar(200) NOT NULL default '',
  `tipo_documento` varchar(200) NOT NULL default '',
  `documento` varchar(200) NOT NULL default '',
  `dv` varchar(200) NOT NULL default '',
  `apellido_1` varchar(200) NOT NULL default '',
  `apellido_2` varchar(200) NOT NULL default '',
  `nombre_1` varchar(200) NOT NULL default '',
  `otros_nombres` varchar(200) NOT NULL default '',
  `razon_social` varchar(200) NOT NULL default '',
  `direccion` varchar(200) NOT NULL default '',
  `depto` varchar(200) NOT NULL default '',
  `mcipio` varchar(200) NOT NULL default '',
  `pais` varchar(200) NOT NULL default '',
  `valor` decimal(20,2) NOT NULL default '0.00',
  `retencion` decimal(20,2) NOT NULL default '0.00',
  `reteiva` decimal(20,2) NOT NULL default '0.00',
  `base` decimal(20,2) NOT NULL default '0.00',
  `cuenta` varchar(200) NOT NULL default '',
  `nom_cuenta` varchar(200) NOT NULL default '',
  `id_ceva` varchar(200) NOT NULL default '',
  `concepto` varchar(200) NOT NULL default ''
)TYPE=MyISAM AUTO_INCREMENT=1 COLLATE=latin1_general_ci";
		mysql_select_db ($database, $cx);
// ************* Verifico si la tabla fue creada correctamente
		if(mysql_query ($anadir7 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}

// **** Defino los tipos de documentos utiliados por la Dian
$tipo=array(13,31,22,41,42,11,12,21,43);

//*************************************************************************                                                    RETENCION EN LA FUENTE
// d ***** Consulto la base para llenar la tabla con los comprabantes de egreso vigencia atual CEVA
$sq = "SELECT id_auto_ceva,id_manu_ceva,id_auto_crpp,id_auto_cobp,ccnit, vr_retefuente,vr_reteiva, total_pagado,id_auto_ceva, retefuente, iva,des_ceva FROM ceva where fecha_ceva >= '$rw7[fecha_ini_op]'";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	$retefuente=$rw["vr_retefuente"];
	$id_auto_ceva=$rw["id_auto_ceva"];	
	$cod_rtefte= $rw["retefuente"];
		if ($retefuente >0) // unicamente consulto el codigo dian cuando se aplico retenci�n
		{
		$sq3 = "SELECT codigo_ret from retefuente where concepto ='$cod_rtefte'";
				$re3 = mysql_db_query($database, $sq3, $cx);
				while($rw3 = mysql_fetch_array($re3))
				{
					$codigo_1002 =$rw3["codigo_ret"];
				}
		}else{
		$codigo_1002 ="";
		}
	$ceva=$rw["id_manu_ceva"];
	$ccnit=$rw["ccnit"];
	$id_auto_crpp=$rw["id_auto_crpp"];
	$id_auto_cobp=$rw["id_auto_cobp"];
	$iva_ceva=$rw["iva"];	
	$id_auto_ceva=$rw["id_auto_ceva"];
	$des_ceva=$rw["des_ceva"];
 	// calcular retencion proporcional al valor de los rubros y la tarifa
	$sq8 = "SELECT cuenta,vr_digitado,nom_rubro,des_cobp from cobp where id_auto_cobp = '$id_auto_cobp' OR ceva ='$id_auto_ceva'";
	$re8 = mysql_db_query($database, $sq8, $cx);
	while($rw8 = mysql_fetch_array($re8)) 
	{
	$cuenta = $rw8["cuenta"]; 
	$valor_pagado=$rw8["vr_digitado"];
	$base = $valor_pagado /(1+$iva_ceva);
	$nom_rubro =$rw8["nom_rubro"];
	$des_cobp=	ucfirst(strtolower($rw8["des_cobp"]));
			$sq9 = "SELECT sum(vr_digitado) as pagado from cobp where id_auto_cobp = '$id_auto_cobp' or ceva ='$id_auto_ceva'";
			$re9 = mysql_db_query($database, $sq9, $cx);
			while($rw9 = mysql_fetch_array($re9)) 
			{
				$pagado =$rw9["0"] / (1+$iva_ceva);; 
			}
	$tarifa =$retefuente / $pagado;
	$retefuente2=$tarifa * $base;
		
		// BUSCAR TERCEROS
		$sq7 = "SELECT ter_nat, ter_jur FROM crpp where id_auto_crpp= '$id_auto_crpp' and (liq1='' or liq1 is null)";	
		$re7 = mysql_db_query($database, $sq7, $cx);
		while($rw7 = mysql_fetch_array($re7))
		{
			$ter_nat =$rw7["ter_nat"];
			$ter_jur =$rw7["ter_jur"];
		}
		// Terceros para pagos acumulados
		// consulto si el ceva corresponde a un pago acumulado
		$sq2 ="select ceva,ccnit from cobp where ceva = '$id_auto_ceva'";
		$rs2 =mysql_db_query($database,$sq2,$cx);
		$fi2 = mysql_num_rows($rs2);
		$rw2 = mysql_fetch_array($rs2);
		if ($fi2 >0) 
		{
		// es pago acumulado
				// selecciono el documento registrado en el ceva
				$ter = $rw2['ccnit'];

				// Consulto la tabla naturales para ver si esta alli
				$ic=1;
				$sq4 = "SELECT * FROM terceros_naturales where num_id='$ter'";	
				$re4 = mysql_db_query($database, $sq4, $cx);
				$fi4 = mysql_num_rows($re4);
				if ($fi4 >0)
				{
					while($rw4 = mysql_fetch_array($re4))
					{
					$tipo_documento =$rw4["tipo_id"]; 
					for ($ic=1; $ic<=9; $ic++)
					{
					if ($tipo_documento ==$ic)
						{
							$i=$ic-1;
							$tipo_documento=$tipo[$i];
							$ic=10;
						}
					}					
					$documento =$rw4["num_id"];
					$dv ="";
					$pri_ape =$rw4["pri_ape"]; 
					$seg_ape =$rw4["seg_ape"];
					$pri_nom =$rw4["pri_nom"];
					$seg_nom =$rw4["seg_nom"];
					$direccion  =$rw4["dir"];
					$depto =$rw4["dpto"];
					$mcipio =$rw4["mpio"]; 
					$pais =$rw4["pais"];
		// Consulto tipo de retencion en la fuente que le aplicaron 2436
					
					$sq6="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,apellido_1, apellido_2,nombre_1,otros_nombres,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('retefuente','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv','$pri_ape','$seg_ape','$pri_nom','$seg_nom','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$ceva . $des_ceva','$id_auto_ceva')";
					mysql_select_db ($database, $cx);
					mysql_query($sq6, $cx);
					}
				}else{ // sino esta consulto la tabla juridicos
					
					$ij=1;
				$sq1 = "SELECT * FROM terceros_juridicos where num_id2='$ter'";	
				$re1 = mysql_db_query($database, $sq1, $cx);
				while($rw1 = mysql_fetch_array($re1))
				{
					$tipo_documento =$rw1["tip_id2"]; 
					for ($ij=1; $ij<=9; $ij++)
					{
					if ($tipo_documento ==$ij)
						{
							$j=$ij-1;
							$tipo_documento=$tipo[$j];
							$ij=10;
						}
					}	
					$documento =$rw1["num_id2"];
					$dv2 =digito_verificacion($documento); // aplico la funcion a nit del tercero juridoco
					$razon_social =$rw1["raz_soc2"];
					$direccion  =$rw1["dir2"];
					$depto =$rw1["dpto2"];
					$mcipio =$rw1["mpio2"]; 
					$pais =$rw1["pais2"];
					$sq5="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,razon_social,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('retefuente','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv2','$razon_social','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$ceva . $des_ceva','$id_auto_ceva')";
					mysql_select_db ($database, $cx);
					mysql_query($sq5, $cx); 
					} 		
								
				}
				
				
				// end es pago acumulado	
		}else{
		// no es pago acumulado	
			if (!empty($ter_nat))
			{
				// ********* CONSULTO TERCEROS NATURALES	
				$ic=1;
				$sq4 = "SELECT * FROM terceros_naturales where id='$ter_nat'";	
				$re4 = mysql_db_query($database, $sq4, $cx);
					while($rw4 = mysql_fetch_array($re4))
					{
					$tipo_documento =$rw4["tipo_id"]; 
					for ($ic=1; $ic<=9; $ic++)
					{
					if ($tipo_documento ==$ic)
						{
							$i=$ic-1;
							$tipo_documento=$tipo[$i];
							$ic=10;
						}
					}					
					$documento =$rw4["num_id"];
					$dv ="";
					$pri_ape =$rw4["pri_ape"]; 
					$seg_ape =$rw4["seg_ape"];
					$pri_nom =$rw4["pri_nom"];
					$seg_nom =$rw4["seg_nom"];
					$direccion  =$rw4["dir"];
					$depto =$rw4["dpto"];
					$mcipio =$rw4["mpio"]; 
					$pais =$rw4["pais"];
					$sq6="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,apellido_1, apellido_2,nombre_1,otros_nombres,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('retefuente','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv','$pri_ape','$seg_ape','$pri_nom','$seg_nom','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$ceva . $des_ceva','$id_auto_ceva')";
					mysql_select_db ($database, $cx);
					mysql_query($sq6, $cx);
				} 		
				
			}//else{ // fin if ter	naturales
			// ********** 	SI ter_jur NO ESTA VACIO CONSULTO TABLA JURIDICOS
			if (!empty($ter_jur))
			{
				$ij=1;
				$sq1 = "SELECT * FROM terceros_juridicos where id='$ter_jur'";	
				$re1 = mysql_db_query($database, $sq1, $cx);
				while($rw1 = mysql_fetch_array($re1))
				{
					$tipo_documento =$rw1["tip_id2"]; 
					for ($ij=1; $ij<=9; $ij++)
					{
					if ($tipo_documento ==$ij)
						{
							$j=$ij-1;
							$tipo_documento=$tipo[$j];
							$ij=10;
						}
					}	
					$documento =$rw1["num_id2"];
					$dv2 =digito_verificacion($documento); // aplico la funcion a nit del tercero juridoco
					$razon_social =$rw1["raz_soc2"];
					$direccion  =$rw1["dir2"];
					$depto =$rw1["dpto2"];
					$mcipio =$rw1["mpio2"]; 
					$pais =$rw1["pais2"];
					$sq5="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,razon_social,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('retefuente','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv2','$razon_social','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$ceva . $des_ceva','$id_auto_ceva')";
					mysql_select_db ($database, $cx);
					mysql_query($sq5, $cx); 
				} 		
				
			}
		} // end cuando no es pago acumulado
		$id_auto_crpp='';
	}
	
} //****************************************************************************** FIN WHILE CONSULTA CEVA

//*************************************************************************                                                   RETE IVA VIGENCIA ACTUAL
// d ***** Consulto la base para llenar la tabla con los comprabantes de egreso vigencia atual CEVA
$sq = "SELECT id_manu_ceva,id_auto_crpp,id_auto_cobp,ccnit, vr_retefuente,vr_reteiva, total_pagado, reteiva,iva FROM ceva where fecha_ceva >= '$rw7[fecha_ini_op]'";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	$reteiva=$rw["vr_reteiva"];	
	$id_auto_ceva=$rw["id_auto_ceva"];
	$cod_rtefte= $rw["reteiva"];
		if ($reteiva>0) // unicamente consulto el codigo dian cuando se aplico retenci�n
		{
		$sq3 = "SELECT codigo_ret from reteiva where concepto ='$cod_rtefte'";
				$re3 = mysql_db_query($database, $sq3, $cx);
				while($rw3 = mysql_fetch_array($re3))
				{
					$codigo_1002 =$rw3["codigo_ret"];
				}
		}else{
		$codigo_1002 ="";
		}
	$ceva=$rw["id_manu_ceva"];
	$ccnit=$rw["ccnit"];
	$id_auto_crpp=$rw["id_auto_crpp"];
	$id_auto_cobp=$rw["id_auto_cobp"];	
	$iva_ceva2 =$rw["iva"];
	$retefuente2=$rw["vr_reteiva"];
	$base = $retefuente2 * 2;
 	// calcular retencion proporcional al valor de los rubros y la tarifa
	$sq8 = "SELECT cuenta,nom_rubro,des_cobp from cobp where id_auto_cobp = '$id_auto_cobp' and vr_digitado > '0'";
	$re8 = mysql_db_query($database, $sq8, $cx);
	while($rw8 = mysql_fetch_array($re8)) 
	{
	$cuenta = $rw8["cuenta"]; 
	//$valor_pagado=$rw8["vr_digitado"]/(1+$iva_ceva2);
	//$base = $rw8["vr_digitado"] - $valor_pagado;
	$nom_rubro =$rw8["nom_rubro"];
	$des_cobp=	ucfirst(strtolower($rw8["des_cobp"]));
		//	$sq9 = "SELECT sum(vr_digitado) as pagado from cobp where id_auto_cobp = '$id_auto_cobp'";
		//	$re9 = mysql_db_query($database, $sq9, $cx);
		//	while($rw9 = mysql_fetch_array($re9)) 
		//	{
		//		$pagado =$rw9["0"]/(1+$iva_ceva2); 
		//	}
	//$tarifa =$reteiva / $pagado;

		$sq7 = "SELECT ter_nat, ter_jur FROM crpp where id_auto_crpp='$id_auto_crpp' and liq1=''";	
		$re7 = mysql_db_query($database, $sq7, $cx);
		while($rw7 = mysql_fetch_array($re7))
		{
		$ter_nat =$rw7["ter_nat"];
		$ter_jur =$rw7["ter_jur"];
		}
		if (!empty($ter_nat))
		{
			// ********* CONSULTO TERCEROS NATURALES	
			$ic=1;
			$sq4 = "SELECT * FROM terceros_naturales where id='$ter_nat'";	
			$re4 = mysql_db_query($database, $sq4, $cx);
			while($rw4 = mysql_fetch_array($re4))
			{
				$tipo_documento =$rw4["tipo_id"]; 
				for ($ic=1; $ic<=9; $ic++)
				{
				if ($tipo_documento ==$ic)
					{
						$i=$ic-1;
						$tipo_documento=$tipo[$i];
						$ic=10;
					}
				}					
				if ($retefuente2 >0)
				{
				$documento =$rw4["num_id"];
				$dv ="";
				$pri_ape =$rw4["pri_ape"]; 
				$seg_ape =$rw4["seg_ape"];
				$pri_nom =$rw4["pri_nom"];
				$seg_nom =$rw4["seg_nom"];
				$direccion  =$rw4["dir"];
				$depto =$rw4["dpto"];
				$mcipio =$rw4["mpio"]; 
				$pais =$rw4["pais"];
				$sq6="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,apellido_1, apellido_2,nombre_1,otros_nombres,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,id_ceva,concepto) values('reteiva','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv','$pri_ape','$seg_ape','$pri_nom','$seg_nom','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$id_auto_ceva','$des_cobp')";
				mysql_select_db ($database, $cx);
				mysql_query($sq6, $cx);
				}
			} 		
			
		} // fin if ter	naturales
		// ********** 	SI ter_jur NO ESTA VACIO CONSULTO TABLA JURIDICOS
		if (!empty($ter_jur))
		{
			$ij=1;
			$sq1 = "SELECT * FROM terceros_juridicos where id='$ter_jur'";	
			$re1 = mysql_db_query($database, $sq1, $cx);
			while($rw1 = mysql_fetch_array($re1))
			{
				$tipo_documento =$rw1["tip_id2"]; 
				for ($ij=1; $ij<=9; $ij++)
				{
				if ($tipo_documento ==$ij)
					{
						$j=$ij-1;
						$tipo_documento=$tipo[$j];
						$ij=10;
					}
				}	
				if ($retefuente2 >0)
				{
				$documento =$rw1["num_id2"];
				$dv2 =digito_verificacion($documento); // aplico la funcion a nit del tercero juridoco
				$razon_social =$rw1["raz_soc2"];
				$direccion  =$rw1["dir2"];
				$depto =$rw1["dpto2"];
				$mcipio =$rw1["mpio2"]; 
				$pais =$rw1["pais2"];
				
				$sq5="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,razon_social,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,id_ceva,concepto) values('reteiva','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv2','$razon_social','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$id_auto_ceva','$des_cobp')";
				mysql_select_db ($database, $cx);
				mysql_query($sq5, $cx); 
				}
			} 		
			
		}
	}
} //***************** FIN RETEIVA

// *******************************************************************************************************************    RETENCIONES CECP 
$sq = "SELECT cn,concepto_pago,cuenta_cxp,vr_obli_para_pago_mas_iva,concepto_pago,retefuente,vr_retefuente,iva,id_auto_cecp,id_manu_cecp FROM cecp where fecha_cecp >= '$rw7[fecha_ini_op]'";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	$id_manu_cecp = $rw['id_manu_cecp'];
	$retefuente=$rw["vr_retefuente"];	
	$cod_rtefte= $rw["retefuente"];
	$iva_cecp=$rw["iva"];
	$valor_pagado= $rw["vr_obli_para_pago_mas_iva"];
	$base = $valor_pagado /(1+$iva_cecp);
	$retefuente2= $rw["vr_retefuente"];
	// cuenta presupuesta de cxp
	$sq10 ="select * from cecp_cuenta where id_auto_cecp = '$rw[id_auto_cecp]'";
	$rs10 = mysql_db_query($database,$sq10,$cx);
	$rw10 = mysql_fetch_array($rs10);
	$cuenta= $rw10["cuenta"];
	// nombre cuenta
	$sq101 ="select nom_rubro from cxp where cod_pptal = '$cuenta'";
	$rs101 =mysql_db_query($database,$sq101,$cx);
	$rw101 =mysql_fetch_array($rs101);
	$nom_rubro = $rw101["nom_rubro"];
	// descripcion	
	$des_cobp= "CXP ".$rw["concepto_pago"];
	
		if ($retefuente >0) // unicamente consulto el codigo dian cuando se aplico retenci�n
		{
		$sq3 = "SELECT codigo_ret from retefuente where concepto ='$cod_rtefte'";
				$re3 = mysql_db_query($database, $sq3, $cx);
				while($rw3 = mysql_fetch_array($re3))
				{
					$codigo_1002 =$rw3["codigo_ret"];
				}
		}else{
		$codigo_1002 ="";
		}

	$ccnit=$rw["cn"];
		// ********* CONSULTO TERCEROS NATURALES	
			$ic=1;
			$sq4 = "SELECT * FROM terceros_naturales where num_id='$ccnit'";	
			$re4 = mysql_db_query($database, $sq4, $cx);
			$nat = mysql_num_rows($re4);
			if ($nat >0)
			{
					while($rw4 = mysql_fetch_array($re4))
					{
						$tipo_documento =$rw4["tipo_id"]; 
						for ($ic=1; $ic<=9; $ic++)
						{
						if ($tipo_documento ==$ic)
							{
								$i=$ic-1;
								$tipo_documento=$tipo[$i];
								$ic=10;
							}
						}					
						$documento =$rw4["num_id"];
						$dv ="";
						$pri_ape =$rw4["pri_ape"]; 
						$seg_ape =$rw4["seg_ape"];
						$pri_nom =$rw4["pri_nom"];
						$seg_nom =$rw4["seg_nom"];
						$direccion  =$rw4["dir"];
						$depto =$rw4["dpto"];
						$mcipio =$rw4["mpio"]; 
						$pais =$rw4["pais"];
						$sq6="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,apellido_1, apellido_2,nombre_1,otros_nombres,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('retefuente','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv','$pri_ape','$seg_ape','$pri_nom','$seg_nom','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$des_cobp','$id_manu_cecp')";
						mysql_select_db ($database, $cx);
						mysql_query($sq6, $cx);
					} 		
			
		 // fin if ter	naturales ***** Consulto terceros JURIDICOS
		
		}
		else
		{
			$ij=1;
			$sq1 = "SELECT * FROM terceros_juridicos where num_id2='$ccnit'";	
			$re1 = mysql_db_query($database, $sq1, $cx);
			while($rw1 = mysql_fetch_array($re1))
			{
				$tipo_documento =$rw1["tip_id2"]; 
				for ($ij=1; $ij<=9; $ij++)
				{
				if ($tipo_documento ==$ij)
					{
						$j=$ij-1;
						$tipo_documento=$tipo[$j];
						$ij=10;
					}
				}	
				$documento =$rw1["num_id2"];
				$dv2 =digito_verificacion($documento); // aplico la funcion a nit del tercero juridoco
				$razon_social =$rw1["raz_soc2"];
				$direccion  =$rw1["dir2"];
				$depto =$rw1["dpto2"];
				$mcipio =$rw1["mpio2"]; 
				$pais =$rw1["pais2"];
				
				$sq5="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,razon_social,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('retefuente','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv2','$razon_social','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$des_cobp','$id_manu_cecp')";
				mysql_select_db ($database, $cx);
				mysql_query($sq5, $cx); 
			} 		
			
		}
	
} //****************************************************************************** FIN WHILE CONSULTA CECP


// *******************************************************************************************************************    RETENCIONES IVA CECP 
$sq = "SELECT cn,concepto_pago,cuenta_cxp,vr_obli_para_pago_mas_iva,concepto_pago,retefuente,vr_reteiva,iva,reteiva,id_manu_cecp FROM cecp where fecha_cecp >= '$rw7[fecha_ini_op]'";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	$id_manu_cecp =$rw['id_manu_cecp'];
	$retefuente=$rw["vr_reteiva"];	
	$cod_rtefte= $rw["reteiva"];
	$iva_cecp =$rw["iva"];
	$valor_pagado= $rw["vr_obli_para_pago_mas_iva"]/(1+$iva_cecp);
	$base = $rw["vr_obli_para_pago_mas_iva"] - $valor_pagado;
	$retefuente2= $base / 2;
	// cuenta presupuesta de cxp
	$sq11 ="select * from cecp_cuenta where id_auto_cecp = '$rw[id_auto_cecp]'";
	$rs11 = mysql_db_query($database,$sq11,$cx);
	$rw11 = mysql_fetch_array($rs11);
	$cuenta= $rw11["cuenta"];
	// nombre cuenta
	$sq101 ="select nom_rubro from cxp where cod_pptal = '$cuenta'";
	$rs101 =mysql_db_query($database,$sq101,$cx);
	$rw101 =mysql_fetch_array($rs101);
	$nom_rubro = $rw101["nom_rubro"];
	$des_cobp= "CXP ".$rw["concepto_pago"];
	
		if ($retefuente >0) // unicamente consulto el codigo dian cuando se aplico retenci�n
		{
		$sq3 = "SELECT codigo_ret from reteiva where concepto ='$cod_rtefte'";
				$re3 = mysql_db_query($database, $sq3, $cx);
				while($rw3 = mysql_fetch_array($re3))
				{
					$codigo_1002 =$rw3["codigo_ret"];
				}
		}else{
		$codigo_1002 ="";
		}

	$ccnit=$rw["cn"];
		// ********* CONSULTO TERCEROS NATURALES	
			$ic=1;
			$sq4 = "SELECT * FROM terceros_naturales where num_id='$ccnit'";	
			$re4 = mysql_db_query($database, $sq4, $cx);
			$nat = mysql_num_rows($re4);
			if ($nat >0)
			{
					while($rw4 = mysql_fetch_array($re4))
					{
						$tipo_documento =$rw4["tipo_id"]; 
						for ($ic=1; $ic<=9; $ic++)
						{
						if ($tipo_documento ==$ic)
							{
								$i=$ic-1;
								$tipo_documento=$tipo[$i];
								$ic=10;
							}
						}					
						$documento =$rw4["num_id"];
						$dv ="";
						$pri_ape =$rw4["pri_ape"]; 
						$seg_ape =$rw4["seg_ape"];
						$pri_nom =$rw4["pri_nom"];
						$seg_nom =$rw4["seg_nom"];
						$direccion  =$rw4["dir"];
						$depto =$rw4["dpto"];
						$mcipio =$rw4["mpio"]; 
						$pais =$rw4["pais"];
						$sq6="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,apellido_1, apellido_2,nombre_1,otros_nombres,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('reteiva','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv','$pri_ape','$seg_ape','$pri_nom','$seg_nom','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$des_cobp','$id_manu_cecp')";
						mysql_select_db ($database, $cx);
						mysql_query($sq6, $cx);
					} 		
			
		 // fin if ter	naturales ***** Consulto terceros JURIDICOS
		
		}
		else
		{
			$ij=1;
			$sq1 = "SELECT * FROM terceros_juridicos where num_id2='$ccnit'";	
			$re1 = mysql_db_query($database, $sq1, $cx);
			while($rw1 = mysql_fetch_array($re1))
			{
				$tipo_documento =$rw1["tip_id2"]; 
				for ($ij=1; $ij<=9; $ij++)
				{
				if ($tipo_documento ==$ij)
					{
						$j=$ij-1;
						$tipo_documento=$tipo[$j];
						$ij=10;
					}
				}	
				$documento =$rw1["num_id2"];
				$dv2 =digito_verificacion($documento); // aplico la funcion a nit del tercero juridoco
				$razon_social =$rw1["raz_soc2"];
				$direccion  =$rw1["dir2"];
				$depto =$rw1["dpto2"];
				$mcipio =$rw1["mpio2"]; 
				$pais =$rw1["pais2"];
				
				$sq5="INSERT INTO dian_exogena (tipo,codigo_1001,codigo_1002,tipo_documento,documento,dv,razon_social,direccion,depto,mcipio,pais,valor,base,retencion,cuenta,nom_cuenta,concepto,id_ceva) values('reteiva','$codigo_1001','$codigo_1002','$tipo_documento','$documento','$dv2','$razon_social','$direccion','$depto','$mcipio','$pais','$valor_pagado','$base','$retefuente2','$cuenta','$nom_rubro','$des_cobp','$id_manu_cecp')";
				mysql_select_db ($database, $cx);
				mysql_query($sq5, $cx); 
			} 		
			
		}
	
} //****************************************************************************** FIN WHILE CONSULTA CECP

// consulta y llenado de pagos sin afectaci�n presupuestal
$sq = "SELECT * FROM conta_cesp ";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
	$sq5="INSERT INTO dian_exogena (tipo,tipo_documento,razon_social,valor,base,retencion,concepto,cuenta,id_ceva) values('retefuente','13','$rw[tercero]','$rw[tot_deb]','0','0','$rw[des_ncon]','$rw[id_manu_ncon]','$rw[id_manu_ncon]')";
	mysql_select_db ($database, $cx);
    mysql_query($sq5, $cx); 

} 



$cx = null;
?>
<br />
<center>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">REPORTES DE INFORMACION EXOGENA TRIBUTARIA A LA DIAN</div>
<br />
<table border="1" align="center" cellpadding="2" cellspacing="0"  width="40%">
	<tr>	
		<td class="Estilo4"><a href="dian_1001.php"><font color="#0033FF">Formato 1001 - Pagos y retenciones practicadas (Versi&oacute;n 8)</font></a></td>
	</tr>
    <tr >	
		<td class="Estilo4"><a href="../informes_tesoreria/certifi.php"><font color="#0033FF">Formato 1001 - Certificado de ingresos</font></a></td>
	</tr>
	<tr style="display:none">	
		<td class="Estilo4"><a href="dian_1002.php"><font color="#0033FF">Formato 1002 - Retenciones practicadas</font></a></td>
	</tr>
</table>
</center>
<br />
<br />
<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		 	<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='../user.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>
</div>
</body>
</html>
<?
		
}

?>