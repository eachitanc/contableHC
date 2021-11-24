<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
			
	// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT info FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['info']=='SI')
{

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CGN_001.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<style type="text/css">
<!--
.Estilo4 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #333333;
	
}
</style>
<?
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$rea =mysql_db_query($database,"select * from aux_contaduria_gral",$cx);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
printf("
<table width='850' border ='1'  class='bordepunteado1'>
<tr>
<td width='30' align='center' ><b>S</b></td>
<td width='100' align='center' ><b>$cod_cgn</b></td>
<td width='120' align='center' ><b>$periodo2</b></td>
<td width='120' align='center' ><b>$anno</b></td>
<td width='120' align='center' ><b>CGN2005_001_SALDOS_Y_MOVIMIENTOS</b></td>
<td width='120' align='center' ><b></b></td>
<td width='120' align='center' ><b></b></td>
<td width='120' align='center' ><b></b></td>
</tr>
");
$sq = "select cuenta,sum(inicial),sum(debito),sum(credito),sum(saldo),sum(corriente),sum(no_corriente) from aux_contaduria_gral_may group by left(cuenta,6)";
$re = mysql_db_query($database, $sq, $cx)or die ($resultadoxx2 .mysql_error()."");
while($rw = mysql_fetch_array($re)) 
{
		$cuenta=$rw["cuenta"];
		$cod= substr($cuenta ,0,6);
		$inicial=$rw["sum(inicial)"];
		$debito=$rw["sum(debito)"];
		$credito=$rw["sum(credito)"];
		$saldo=$rw["sum(saldo)"];
		$totals=round(abs($inicial) + abs($debito) + abs($credito) + abs($saldo)); 
if ($inicial !='0' or $totals !='0')
{		
		$nat1 = substr($cuenta,0,1); 
		$nat2 = substr($cuenta,0,2);
			if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
			{	$naturaleza = "DEBITO";	}
			else
			{   
				if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89' )
				{
				$naturaleza = "CREDITO";
				}
			}
	if ($naturaleza =="DEBITO")
		{$c_nc = substr($cod,0,2);
				
				// condicion 1
				if($c_nc == '11' or $c_nc == '12' or $c_nc == '13' or $c_nc == '14' or $c_nc == '15' or $c_nc == '21' or $c_nc == '22' or $c_nc == '23' or $c_nc == '24' or $c_nc == '25' or 				$c_nc == '27')
				{ $nat_c_nc = "C";          }
				//condicion 2  
			  if($c_nc == '16' or $c_nc == '17' or $c_nc == '18' or $c_nc == '19' or $c_nc == '26' or $c_nc == '28' or $c_nc == '29' /*or $c_nc == '27'*/)
				{ $nat_c_nc = "NC";			}
				//condicion 3
			   if($c_nc > '29')
				{ $nat_c_nc = "NC";			}
							
				if($nat_c_nc == 'C')
				{
						$corriente=$rw["sum(corriente)"];
						$no_corriente=$rw["sum(no_corriente)"];
						
						$ini = $inicial;
						//$deb = round($debito /1000);
						$cred = $credito;
						$sal= $saldo;
						if ($debito ==0)
							{
							$deb=round($debito); $cred= ($sal - $ini + $deb) *-1; 
							}else{$deb = $sal -$ini + $cred;}
						//$deb = $sal -$ini + $cred;
						$cte = $corriente;
						$no_cte = $no_corriente;
						
						$uno = substr($cod, 0,-5);
						$dos = substr($cod , 1,-4);
						$tres = substr($cod , 2,-2);
						$cuatro = substr($cod , 4);
						$codigo = $uno . '.' . $dos . '.' . $tres . '.'. $cuatro;
						printf("<tr>");
						printf("<td align ='center' class='Estilo4'>D</td>");
						printf("<td align ='left' class='Estilo4'>%s</td>",$codigo);
						printf("<td align ='right' class='Estilo4'>%s</td>",$ini);
						printf("<td align ='right' class='Estilo4'>%s</td>",$deb);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cred);
						printf("<td align ='right' class='Estilo4'>%s</td>",$sal);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cte);
						printf("<td align ='right' class='Estilo4'>0</td>");
						printf("</tr>");
				}
				else// cuando es no corriente
				{
				        $corriente=$rw["sum(corriente)"];
						$no_corriente=$rw["sum(no_corriente)"];
						$ini = $inicial;
						//$deb = round($debito /1000);
						$cred = $credito;
						$sal= $saldo;
						if (round($debito) ==0 and round($credito)!=0)
							{
							$deb=round($debito); $cred=($sal - $ini + $deb)*-1; 
							}else{$deb = $sal -$ini + $cred;}
						//$deb = $sal -$ini + $cred;
						$cte = $corriente;
						$no_cte = $no_corriente;
						$uno = substr($cod, 0,-5);
						$dos = substr($cod , 1,-4);
						$tres = substr($cod , 2,-2);
						$cuatro = substr($cod , 4);
						$codigo = $uno . '.' . $dos . '.' . $tres . '.'. $cuatro;
						printf("<tr>");
						printf("<td align ='center' class='Estilo4'>D</td>");
						printf("<td align ='left' class='Estilo4'>%s</td>",$codigo);
						printf("<td align ='right' class='Estilo4'>%s</td>",$ini);
						printf("<td align ='right' class='Estilo4'>%s</td>",$deb);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cred);
						printf("<td align ='right' class='Estilo4'>%s</td>",$sal);
						printf("<td align ='right' class='Estilo4'>0</td>");
						printf("<td align ='right' class='Estilo4'>%s</td>",$no_cte);
						printf("</tr>");
				} // fin else
} // fin if debito

if ($naturaleza =="CREDITO")
{
				$c_nc = substr($cod,0,2);
				
				// condicion 1
				if($c_nc == '11' or $c_nc == '12' or $c_nc == '13' or $c_nc == '14' or $c_nc == '15' or $c_nc == '21' or $c_nc == '22' or $c_nc == '23' or $c_nc == '24' or $c_nc == '25' or $c_nc == '27')
				{ $nat_c_nc = "C";          }
				//condicion 2  
			  if($c_nc == '16' or $c_nc == '17' or $c_nc == '18' or $c_nc == '19' or $c_nc == '26' or $c_nc == '28' or $c_nc == '29' /*or $c_nc == '27'*/)
				{ $nat_c_nc = "NC";			}
				//condicion 3
			   if($c_nc > '29')
				{ $nat_c_nc = "NC";			}
							
				if($nat_c_nc == 'C')
				{
						$corriente=$rw["sum(corriente)"];
						$no_corriente=$rw["sum(no_corriente)"];
						$ini = $inicial;
						$deb = $debito;
						//$cred = round($credito /1000);
						$sal= $saldo;
						if (round($credito) ==0 and round($debito)!=0)
							{
							$cred=round($credito); $deb=($sal - $ini + $cred)*-1; 
							}else{$cred = $sal -$ini + $deb;}				
//						$cred = $sal - $ini + $deb;
						$cte = $corriente;
						$no_cte = $no_corriente;
						$uno = substr($cod, 0,-5);
						$dos = substr($cod , 1,-4);
						$tres = substr($cod , 2,-2);
						$cuatro = substr($cod , 4);
						$codigo = $uno . '.' . $dos . '.' . $tres . '.'. $cuatro;
						printf("<tr>");
						printf("<td align ='center' class='Estilo4'>D</td>");
						printf("<td align ='left' class='Estilo4'>%s</td>",$codigo);
						printf("<td align ='right' class='Estilo4'>%s</td>",$ini);
						printf("<td align ='right' class='Estilo4'>%s</td>",$deb);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cred);
						printf("<td align ='right' class='Estilo4'>%s</td>",$sal);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cte);
						printf("<td align ='right' class='Estilo4'>0</td>");
						printf("</tr>");
				}
				else// cuando es no corriente
				{
				        $corriente=$rw["sum(corriente)"];
						$no_corriente=$rw["sum(no_corriente)"];
						$ini = $inicial;
						$deb = $debito;
						//$cred = round($credito /1000);
						$sal= $saldo;
						if (round($credito) ==0 and round($debito)!=0)
							{
							$cred=round($credito); $deb=($sal - $ini + $cred)*-1; 
							}else{$cred = $sal -$ini + $deb;}	
						//$cred = $sal - $ini + $deb;
						$cte = $corriente;
						$no_cte = $no_corriente;
						$uno = substr($cod, 0,-5);
						$dos = substr($cod , 1,-4);
						$tres = substr($cod , 2,-2);
						$cuatro = substr($cod , 4);
						$codigo = $uno . '.' . $dos . '.' . $tres . '.'. $cuatro;
						printf("<tr>");
						printf("<td align ='center' class='Estilo4'>D</td>");
						printf("<td align ='left' class='Estilo4'>%s</td>",$codigo);
						printf("<td align ='right' class='Estilo4'>%s</td>",$ini);
						printf("<td align ='right' class='Estilo4'>%s</td>",$deb);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cred);
						printf("<td align ='right' class='Estilo4'>%s</td>",$sal);
						printf("<td align ='right' class='Estilo4'>0</td>");
						printf("<td align ='right' class='Estilo4'>%s</td>",$no_cte);
						printf("</tr>");
				} // fin else
	} // fin credito
$nat3 = substr($cuenta,0,4);
if ($nat3 == '0202' or $nat3 == '0203' or $nat3 == '0204' or $nat3 == '0207' or $nat3 == '0208' or $nat3 == '0209' or $nat3 == '0213' or $nat3 == '0243' or $nat3 == '0252' or $nat3 == '0331' or $nat3 == '0332' or $nat3 == '0334' or $nat3 == '0335' or $nat3 == '0336' or $nat3 == '0337' or $nat3 == '0350' or $nat3 == '0351' or $nat3 == '0352' or $nat3 == '0353' or $nat3 == '0354' or $nat3 == '0355' or $nat3 == '0360' or $nat3 == '0361' or $nat3 == '0362' or $nat3 == '0363' or $nat3 == '0364' or $nat3 == '0365' or $nat3 == '0370' or $nat3 == '0371' or $nat3 == '0372' or $nat3 == '0373' or $nat3 == '0374' or $nat3 == '0375' or $nat3 == '0378' or $nat3 == '0399' or $nat3 == '0432' or $nat3 == '0434' or $nat3 == '0436' or $nat3 == '0438' or $nat3 == '0440' or $nat3 == '0442' or $nat3 == '0444' or $nat3 == '0446' or $nat3 == '0450' or $nat3 == '0555' or $nat3 == '0556' or $nat3 == '0557' or $nat3 == '0558' or $nat3 == '0559' or $nat3 == '0560' or $nat3 == '0561' or $nat3 == '0562' or $nat3 == '0563' or $nat3 == '0564' or $nat3 == '0565' or $nat3 == '0566' or $nat3 == '0567' or $nat3 == '0568' or $nat3 == '0569' or $nat3 == '0570' or $nat3 == '0571' or $nat3 == '0572' or $nat3 == '0630' or $nat3 == '0631' or $nat3 == '0632' or $nat3 == '0633' or $nat3 == '0634' or $nat3 == '0635' or $nat3 == '0636' or $nat3 == '0637' or $nat3 == '0638' or $nat3 == '0639' or $nat3 == '0640' or $nat3 == '0641' or $nat3 == '0642' or $nat3 == '0643' or $nat3 == '0644' or $nat3 == '0645' or $nat3 == '0646' or $nat3 == '0647' or $nat3 == '0655' or $nat3 == '0656' or $nat3 == '0657' or $nat3 == '0658' or $nat3 == '0659' or $nat3 == '0660' or $nat3 == '0661' or $nat3 == '0662' or $nat3 == '0663' or $nat3 == '0664' or $nat3 == '0665' or $nat3 == '0666' or $nat3 == '0667' or $nat3 == '0668' or $nat3 == '0669' or $nat3 == '0670' or $nat3 == '0671' or $nat3 == '0672' or $nat3 == '0730' or $nat3 == '0731' or $nat3 == '0732' or $nat3 == '0733' or $nat3 == '0734' or $nat3 == '0735' or $nat3 == '0736' or $nat3 == '0737' or $nat3 == '0738' or $nat3 == '0739' or $nat3 == '0740' or $nat3 == '0741' or $nat3 == '0742' or $nat3 == '0743' or $nat3 == '0744' or $nat3 == '0745' or $nat3 == '0746' or $nat3 == '0747' or $nat3 == '0755' or $nat3 == '0756' or $nat3 == '0757' or $nat3 == '0758' or $nat3 == '0759' or $nat3 == '0760' or $nat3 == '0761' or $nat3 == '0762' or $nat3 == '0763' or $nat3 == '0764' or $nat3 == '0765' or $nat3 == '0766' or $nat3 == '0767' or $nat3 == '0768' or $nat3 == '0769' or $nat3 == '0770' or $nat3 == '0771' or $nat3 == '0772' or $nat3 == '0835' or $nat3 == '0840' or $nat3 == '0845' or $nat3 == '0855' or $nat3 == '0860' or $nat3 == '0935' or $nat3 == '0940')
{
						$corriente=$rw["sum(corriente)"];
						$no_corriente=$rw["sum(no_corriente)"];
						$ini = $inicial;
						//$deb = round($debito /1000);
						$cred = $credito;
						$sal= $saldo;
						if (round($debito) ==0 and round($credito)!=0)
							{
							$deb=round($debito); $cred=($sal - $ini + $deb)*-1; 
							}else{$deb = $sal -$ini + $cred;}
						//$deb = $sal - $ini + $cred;
						$cte = $corriente;
						$no_cte = $no_corriente;
						$uno = substr($cod, 0,-5);
						$dos = substr($cod , 1,-4);
						$tres = substr($cod , 2,-2);
						$cuatro = substr($cod , 4);
						$codigo = $uno . '.' . $dos . '.' . $tres . '.'. $cuatro;
						printf("<tr>");
						printf("<td align ='center' class='Estilo4'>D</td>");
						printf("<td align ='left' class='Estilo4'>%s</td>",$codigo);
						printf("<td align ='right' class='Estilo4'>%s</td>",$ini);
						printf("<td align ='right' class='Estilo4'>%s</td>",$deb);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cred);
						printf("<td align ='right' class='Estilo4'>%s</td>",$sal);
						printf("<td align ='right' class='Estilo4'>0</td>");
						printf("<td align ='right' class='Estilo4'>%s</td>",$no_cte);
						
						printf("</tr>");
} 
if ($nat3 == '0216' or $nat3 == '0217' or $nat3 == '0218' or $nat3 == '0219' or $nat3 == '0221' or $nat3 == '0222' or $nat3 == '0223' or $nat3 == '0224' or $nat3 == '0226' or $nat3 == '0227' or $nat3 == '0228' or $nat3 == '0229' or $nat3 == '0231' or $nat3 == '0242' or $nat3 == '0253' or $nat3 == '0254' or $nat3 == '0320' or $nat3 == '0321' or $nat3 == '0323' or $nat3 == '0324' or $nat3 == '0325' or $nat3 == '0326' or $nat3 == '0425' or $nat3 == '0430' or $nat3 == '0530' or $nat3 == '0531' or $nat3 == '0532' or $nat3 == '0533' or $nat3 == '0534' or $nat3 == '0535' or $nat3 == '0536' or $nat3 == '0537' or $nat3 == '0538' or $nat3 == '0539' or $nat3 == '0540' or $nat3 == '0541' or $nat3 == '0542' or $nat3 == '0543' or $nat3 == '0544' or $nat3 == '0545' or $nat3 == '0546' or $nat3 == '0547' or $nat3 == '0830' or $nat3 == '0850' or $nat3 == '0930')
{
						$corriente=$rw["sum(corriente)"];
						$no_corriente=$rw["sum(no_corriente)"];
						
						$ini = $inicial;
						$deb = $debito;
						//$cred = round($credito /1000);
						$sal= $saldo;
						
						if ($credito ==0 and $debito !=0)
							{
							$cred=($credito); $deb=($ini + $cred - $sal)*-1; 
							}else{$cred = $ini + $deb - $sal;}	
						//$cred = $ini + $deb - $sal;
						$cte = $corriente;
						$no_cte = $no_corriente;
						$uno = substr($cod, 0,-5);
						$dos = substr($cod , 1,-4);
						$tres = substr($cod , 2,-2);
						$cuatro = substr($cod , 4);
						$codigo = $uno . '.' . $dos . '.' . $tres . '.'. $cuatro;
						printf("<tr>");
						printf("<td align ='center' class='Estilo4'>D</td>");
						printf("<td align ='left' class='Estilo4'>%s</td>",$codigo);
						printf("<td align ='right' class='Estilo4'>%s</td>",$ini);
						printf("<td align ='right' class='Estilo4'>%s</td>",$deb);
						printf("<td align ='right' class='Estilo4'>%s</td>",$cred);
						printf("<td align ='right' class='Estilo4'>%s</td>",$sal);
						printf("<td align ='right' class='Estilo4'>0</td>");
						printf("<td align ='right' class='Estilo4'>%s</td>",$no_cte);
						printf("</tr>");

} 

}
}
printf("</table>");
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
} // fin encabezado
?>
