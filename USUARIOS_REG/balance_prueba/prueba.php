<?

//**** consulta de todo el pgcp			
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//$sq = "select * from pgcp where id_emp = '$id_emp' and nivel <= '$nivel' and (cod_pptal between '$cod_ini' and '$cod_fin') order by cod_pptal asc ";
$sq = "select * from pgcp where id_emp = '$id_emp' and nivel <= '16' and (cod_pptal = '11050108') order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);


while($rw = mysql_fetch_array($re)) 
{

	$nn='11050108';
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
	{	  $sico_d=0;	}
	if($sico_c == '')
	{	  $sico_c=0;	}
	//******* naturaleza de la cuenta
	$nat1 = substr($nn,0,1);
	$nat2 = substr($nn,0,2);
	if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
{	$naturaleza = "DEBITO";	}
else
{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89' )
	{
	$naturaleza = "CREDITO";
	}
}


	if($naturaleza == 'DEBITO')
		{
			$saldo_inicial=$sico_d;	
			$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) group by cuenta having cuenta = '$nn'";
			
			$re1 = mysql_db_query($database, $sq1, $cx1) or die ($sq1 .mysql_error()."");
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
				$saldo_inicial=$sico_d + $rw1[sumadebito] - $rw1[sumacredito];	
				printf("$saldo_inicial");		
			}//fin while
		}
		else
		{
			$saldo_inicial=$sico_c;	
			$cx1 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq1 = "select  cuenta, sum(debito) as sumadebito ,sum(credito) as sumacredito from lib_aux where (fecha between '$fecha_ini_op' and '$aux_fecha' ) group by cuenta having cuenta = '$nn'";		
			$re1 = mysql_db_query($database, $sq1, $cx1);
			
			while($rw1 = mysql_fetch_array($re1)) 
			{
				$saldo_inicial=$sico_c - $rw1[sumadebito] + $rw1[sumacredito];	
				printf("$saldo_inicial");							
			}//fin while
		}
		
}		
?>