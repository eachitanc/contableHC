<?
header("Cache-Control: no-store, no-cache, must-revalidate"); 
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
$fecha_aux = $_POST["fecha_ini"];
$corte = $_POST["fecha_fin"];
$nivel2 = $_POST["nivel2"];
$resumen = $_POST["resumen"];
$consol = $_POST["consol"];
$movi= $_POST["movi"];
$fecha_mov = $_POST["fecha_mov"];
if ($movi =='SI') $fecha_aux=$fecha_mov;
include('../config.php');		
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$base=$database;
// ide emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $fecha_ini_op=$rowxx3["fecha_ini_op"];
   }  


//**** borro tabla por si las moscas
$tabla6="aux_contaduria_gral";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";
mysql_select_db ($base, $connectionxx);
		if(mysql_query ($anadir6 ,$connectionxx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
//corte
$sqlv = mysql_db_query($database,"select * from vf",$connectionxx);
while ($rwv = mysql_fetch_array($sqlv))
	{
		$fecha_ini = $rwv["fecha_ini"];
	} 
//fecha_ini_op
$sqlxx1 = "select * from vf";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);
while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $fecha_ini_op=$rowxx1["fecha_ini"];
}
if ($consol =='SI') $consolida = ''; else $consolida ="";
//********************************* si tienen sico y si tienen mvto en lib_aux ***************************************************************************
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
				// cargo el valor inicial de la cuenta de la tabla sico
				$sqlxx2a = "select * from sico where cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $debito_sico=$rowxx2a["debito"];
				}
				// selecciono los movimientos de la cuenta desde la fecha de inicio de operaciones (no esta aportando nada)
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta' and fecha >= '$fecha_ini_op'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos]; 
				   $saldo_inicial_deb=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];	
				   $saldo_inicial_cred= 0;
				}
				// Selecciono los movimientos de la cuenta entre la fecha de auxiliar y la fecha de corte 
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta' $consolida";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos]; 
				   $total_creditos = $rowxx2a1[creditos];	
				}
				//****************************** CALCULO SALDOS
				$saldo_aux = $saldo_inicial + $total_debitos - $total_creditos;
				$saldo_aux_deb = $saldo_inicial + $total_debitos - $total_creditos;
				$saldo_aux_cred =0;
		
}

else// else de la naturaleza Credito
{
				$sqlxx2a = "select * from sico where cuenta = '$cuenta'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $credito_sico=$rowxx2a["credito"]; 
				}
				//calculo del inicial
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta' and fecha >= '$fecha_ini_op'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$credito_sico - $rowxx2a["debitos"] + $rowxx2a["creditos"]; 
				   $saldo_inicial_cred=$credito_sico - $rowxx2a[debitos] + $rowxx2a[creditos];
				   $saldo_inicial_deb= 0;	
				
				}
				//calculo del tot deb y tot cre
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta' $consolida" ;
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				//****************************** CALCULO SALDOS
				$saldo_aux = $saldo_inicial - $total_debitos + $total_creditos;
				$saldo_aux_cred = $saldo_inicial - $total_debitos + $total_creditos;
				$saldo_aux_deb =0;
}
//********************************* CTE  - NO CTE		  
$cte_aux='0';
$n_cte_aux='0';
$sql_ok = "INSERT INTO aux_contaduria_gral  
						(fecha,d,nivel,cuenta,nombre,inicial,inicial_deb,inicial_cred,debito,credito,saldo,saldo_deb,saldo_cred,corriente,no_corriente) 
						VALUES 						('$fecha','$d','$nivel','$cuenta','$nombre','$saldo_inicial','$saldo_inicial_deb','$saldo_inicial_cred','$total_debitos','$total_creditos','$saldo_aux','$saldo_aux_deb','$saldo_aux_cred','$cte_aux','$n_cte_aux')";
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
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta' and fecha >= '$fecha_ini_op'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];	
				   $saldo_inicial_deb=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];
				    $saldo_inicial_cred= 0;
				
				}
				//calculo del tot deb y tot cre
				
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta' $consolida";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				
				//****************************** CALCULO SALDOS

				$saldo_aux = $saldo_inicial + $total_debitos - $total_creditos;
				$saldo_aux_deb = $saldo_inicial + $total_debitos - $total_creditos;
				$saldo_aux_cred =0;
		
}

else// else de la naturaleza
{
				
				   $credito_sico= 0 ;
				
				//calculo del inicial
				$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux where (fecha < '$fecha_aux') and cuenta = '$cuenta' and fecha >= '$fecha_ini_op'";
				$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
				
				while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
				{
				   $saldo_inicial=$credito_sico - $rowxx2a[debitos] + $rowxx2a[creditos];	
				   $saldo_inicial_cred=$credito_sico - $rowxx2a[debitos] + $rowxx2a[creditos];
				   $saldo_inicial_deb= 0;
				}
				
				
				//calculo del tot deb y tot cre
				
				$sqlxx2a1 = "select sum(debito) as debitos, sum(credito) as creditos from lib_aux 
				where (fecha >= '$fecha_aux' and fecha <= '$corte') and cuenta = '$cuenta' $consolida";
				$resultadoxx2a1 = mysql_db_query($database, $sqlxx2a1, $connectionxx);
				
				while($rowxx2a1 = mysql_fetch_array($resultadoxx2a1)) 
				{
				   $total_debitos = $rowxx2a1[debitos];
				   $total_creditos = $rowxx2a1[creditos];	
				
				}
				
				//****************************** CALCULO SALDOS

				$saldo_aux = $saldo_inicial - $total_debitos + $total_creditos;
				$saldo_aux_cred = $saldo_inicial - $total_debitos + $total_creditos;
				$saldo_aux_deb =0;
				
				
}
		
		 

 
//********************************* CTE  - NO CTE		  
				
$cte_aux='0';
$n_cte_aux='0';
				
				
$sql_ok = "INSERT INTO aux_contaduria_gral  
						(fecha,d,nivel,cuenta,nombre,inicial,inicial_deb,inicial_cred,debito,credito,saldo,saldo_deb,saldo_cred,corriente,no_corriente) 
						VALUES 	('$fecha','$d','$nivel','$cuenta','$nombre','$saldo_inicial','$saldo_inicial_deb','$saldo_inicial_cred','$total_debitos','$total_creditos','$saldo_aux','$saldo_aux_deb','$saldo_aux_cred','$cte_aux','$n_cte_aux')";
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
					  $saldo_sico_deb = $debito_sico;
					  $saldo_sico_cred= 0;
					  }
					  else
					  {
					  $saldo_sico = $credito_sico;
					  $saldo_sico_cred = $credito_sico;
					  $saldo_sico_deb= 0;
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
											(fecha,d,nivel,cuenta,nombre,inicial,inicial_deb,inicial_cred,debito,credito,saldo,saldo_deb,saldo_cred,corriente,no_corriente) 
											VALUES 																						
											('$fecha','$d','$nivel','$cuenta','$nombre','$saldo_sico','$saldo_sico_deb','$saldo_sico_cred','$debito','$credito','$saldo','$saldo_sico_deb','$saldo_sico_cred','$cte_sico','$n_cte_sico')";
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
   $saldo_inicial_deb=$debito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];
    $saldo_inicial_cred= 0;	

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
$saldo_aux_deb = $saldo_inicial + $total_debitos - $total_creditos;
$saldo_aux_cred =0;
					  
					  
					  
}
else // ***********************  CREDITO CUENTA CERO
{
					  
					  
					  
$credito_sico= 0 ;

//calculo del inicial
$sqlxx2a = "select sum(debito) as debitos, sum(credito) as creditos from aux_cta_0 where (fecha < '$fecha_aux') and cuenta = '$cuenta'";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
{
$saldo_inicial=$credito_sico + $rowxx2a[debitos] - $rowxx2a[creditos];
$saldo_inicial_cred=($credito_sico + $rowxx2a[debitos] - $rowxx2a[creditos]);
$saldo_inicial_deb= 0;	

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
$saldo_aux_cred = $saldo_inicial_cred - $total_debitos + $total_creditos;
$saldo_aux_deb =0;

					  }
					  
					//********************************* CTE  - NO CTE		  
									
					$cte_sico='0';
					$n_cte_sico='0';
									
									
					$sql_ok = "INSERT INTO aux_contaduria_gral  
											(fecha,d,nivel,cuenta,nombre,inicial,inicial_deb,inicial_cred,debito,credito,saldo,saldo_deb,saldo_cred,corriente,no_corriente) 
											VALUES 																						
											('$corte','$d','$nivel','$cuenta','$nombre','$saldo_inicial','$saldo_inicial_deb','$saldo_inicial_cred','$total_debitos','$total_creditos','$saldo_aux','$saldo_aux_deb','$saldo_aux_cred','$cte_sico','$n_cte_sico')";
											mysql_query($sql_ok, $connectionxx) or die(mysql_error());				
}  
?>
<br />
<center>
<? 
// Mostrar icono con resultado
 print "<a href='balance_general_report.php?fec1=$fecha_aux&fec2=$corte&nivel2=$nivel2&resumen=$resumen&mov=$movi' target='_parent'><span class='Estilo5'><font color ='blue'>Balance general</font></span></a></div>"; 
 //echo"<script language='javascript'>window.location.href='mayor_balance3.php?fec1=$fecha_aux&fec2=$corte'</script>"; 
}
?>