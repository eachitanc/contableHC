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

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
$ano=$rowxx["ano"];
}

$sqlxx3 = "select * from aux_bal_prueba_cta_0";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
$fecha_ini=$rowxx3["fecha_ini"];
$fecha_fin=$rowxx3["fecha_fin"];
$cod_ini=$rowxx3["cod_ini"];
$cod_fin=$rowxx3["cod_fin"];
}


printf("<center class='Estilo4'><b>BALANCE DE PRUEBA CUENTAS 0 GENERADO CON EXITO <BR><BR>DATOS SELECCIONADOS POR EL USUARIO</b><br><br><b>Fecha Inicial :</b> %s --- ",$fecha_ini);
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

$tabla6="bal_prueba_deb_cta_0";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";
mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{echo "";}else{echo "";}	

///**** creo la tabla 

		$tabla7="bal_prueba_deb_cta_0";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `codigo` varchar(200) NOT NULL default '',
  `nombre` varchar(200) NOT NULL default '',
  `tipo` varchar(200) NOT NULL default '',
  `naturaleza` varchar(200) NOT NULL default '',
  `nivel` INT( 2 ) NOT NULL,
  `valor` decimal(20,2) NOT NULL default '0.00'


)TYPE=MyISAM AUTO_INCREMENT=1 ";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{echo "";}else{echo "";}



//**** consulta de todo el pgcp			
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//$sq = "select * from pgcp where id_emp = '$id_emp' and nivel <= '$nivel' and (cod_pptal between '$cod_ini' and '$cod_fin') order by cod_pptal asc ";
$sq = "select * from pgcp where id_emp = '$id_emp' and nivel <= '16' and (cod_pptal between '$cod_ini' and '$cod_fin') order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);


while($rw = mysql_fetch_array($re)) 
{

$nn=$rw["cod_pptal"];

$sico_d=0;
$sico_c=0;

$longitud = strlen($nn);

if($longitud < 4)
{
$naturaleza = '';
}
else
{

$nat1 = substr($nn,0,4);
			
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

}


if($naturaleza == 'DEBITO')
{

		$tip_dato=$rw["tip_dato"];
		if($tip_dato == 'D')  
		{
					
	
			//************** saldo inicial cuenta detalle - debito
			
			$saldo_inicial = $sico_d;
			
			//**** variables para totalizar saldos
			$total_debitos=0;
			$total_creditos=0;
			
			
			//****** consulta en tabla auxiliar

			$cxy = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			$sqy = "select * from aux_cta_0 where (fecha between '$fecha_ini' and '$fecha_fin' )  and cuenta = '$nn' order by fecha asc ";
			$rey = mysql_db_query($database, $sqy, $cxy);
			
			$saldo=$saldo_inicial;
			
			while($rwy = mysql_fetch_array($rey)) 
			{

										
						//if($rwy["cuenta"] == $nn)
						//{
												
						$total_debitos=$total_debitos+$rwy["debito"];
						$total_creditos=$total_creditos+$rwy["credito"];
					
						//}
						//else
						//{
						//}
 		  
			}//fin while de libro aux
			
			$saldo_final = $saldo_inicial + $total_debitos - $total_creditos;
			 								
			$codigo=$rw["cod_pptal"];
			$nombre=$rw["nom_rubro"];
			$tipo=$rw["tip_dato"];
			$naturaleza=$naturaleza;
			$nivel=$rw["nivel"];
			$valor=$saldo_final;
			
			
			//*** si el saldo es 0 no grabes
			
			if($valor == '0')
			{
			
			
			}
			else
			{
			
			$sql_ok = "INSERT INTO bal_prueba_deb_cta_0 
			(codigo,nombre,tipo,naturaleza,nivel,valor) VALUES('$codigo','$nombre','$tipo','$naturaleza','$nivel','$valor')";
			mysql_query($sql_ok, $conexion) or die(mysql_error());
			
			}
			
			
			
		}
		
				
		else
		
		
		{
			$codigo=$rw["cod_pptal"];
			$nombre=$rw["nom_rubro"];
			$tipo=$rw["tip_dato"];
			$naturaleza=$naturaleza;
			$nivel=$rw["nivel"];
			$valor=0;
			
			
			$sql_ok = "INSERT INTO bal_prueba_deb_cta_0 
			(codigo,nombre,tipo,naturaleza,nivel,valor) VALUES('$codigo','$nombre','$tipo','$naturaleza','$nivel','$valor')";
			mysql_query($sql_ok, $conexion) or die(mysql_error());
		}

}
if($naturaleza == 'CREDITO')
{


		$tip_dato=$rw["tip_dato"];
		if($tip_dato == 'D')  
		{
			
			//************** saldo inicial cuenta detalle - debito
			
			$saldo_inicial = $sico_c;
			
			//**** variables para totalizar saldos
			$total_debitos=0;
			$total_creditos=0;
			
			
			//****** consulta en tabla auxiliar

			$cxy = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
			$sqy = "select * from aux_cta_0 where (fecha between '$fecha_ini' and '$fecha_fin' )  and cuenta = '$nn' order by fecha asc ";
			$rey = mysql_db_query($database, $sqy, $cxy);
			
			$saldo=$saldo_inicial;
			
			while($rwy = mysql_fetch_array($rey)) 
			{

										
						//if($rwy["cuenta"] == $nn)
						//{
												
						$total_debitos=$total_debitos+$rwy["debito"];
						$total_creditos=$total_creditos+$rwy["credito"];
					
						//}
						//else
						//{
						//}
 		  
			}//fin while de libro aux
						
			$saldo_final = $saldo_inicial - $total_debitos + $total_creditos;
			
			
			$codigo=$rw["cod_pptal"];
			$nombre=$rw["nom_rubro"];
			$tipo=$rw["tip_dato"];
			$naturaleza=$naturaleza;
			$nivel=$rw["nivel"];
			$valor=$saldo_final * -1;
			
			
			//*** si el saldo es 0 no grabes
			
			if($valor == '0')
			{
			
			
			}
			else
			{
			
			
			$sql_ok = "INSERT INTO bal_prueba_deb_cta_0 
			(codigo,nombre,tipo,naturaleza,nivel,valor) VALUES('$codigo','$nombre','$tipo','$naturaleza','$nivel','$valor')";
			mysql_query($sql_ok, $conexion) or die(mysql_error());
			
			}
			
		
		}
		else
		{
		
			$codigo=$rw["cod_pptal"];
			$nombre=$rw["nom_rubro"];
			$tipo=$rw["tip_dato"];
			$naturaleza=$naturaleza;
			$nivel=$rw["nivel"];
			$valor=0;
			
			
			$sql_ok = "INSERT INTO bal_prueba_deb_cta_0 
			(codigo,nombre,tipo,naturaleza,nivel,valor) VALUES('$codigo','$nombre','$tipo','$naturaleza','$nivel','$valor')";
			mysql_query($sql_ok, $conexion) or die(mysql_error());	
		
		}


}

if($naturaleza == '')
{

			
			$codigo=$rw["cod_pptal"];
			$nombre=$rw["nom_rubro"];
			$tipo=$rw["tip_dato"];
			$naturaleza=$naturaleza;
			$nivel=$rw["nivel"];
			$valor=0;
			
			
					
			
			$sql_ok = "INSERT INTO bal_prueba_deb_cta_0 
			(codigo,nombre,tipo,naturaleza,nivel,valor) VALUES('$codigo','$nombre','$tipo','$naturaleza','$nivel','$valor')";
			mysql_query($sql_ok, $conexion) or die(mysql_error());
			
			
}

}// fin while


//******************
//******************
//******************


// sacar el primero de una consulta
/*$cxt = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqt = "select * from bal_prueba_deb";
$ret = mysql_db_query($database, $sqt, $cxt);		
$rwt = mysql_fetch_array($ret);
$primero=$rwt["nivel"];
printf("%s",$primero);*/




?>
      </div></td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<form id="form1" name="form1" method="post" action="balance_prueba3_cta_0.php">
      <div align="center" class="Estilo4"><strong>Paso 3 
        : <BR /><br />
        Clic en el Boton &quot;Ver Balance</strong>&quot;<br />
        <BR />
        <input name="fecha_ini" type="hidden" value="<? printf("%s",$fecha_ini); ?>" />
        <input name="fecha_fin" type="hidden" value="<? printf("%s",$fecha_fin); ?>" />
        <input name="cod_ini" type="hidden" value="<? printf("%s",$cod_ini); ?>" />
        <input name="cod_fin" type="hidden" value="<? printf("%s",$cod_fin); ?>" />
        <input name="Submit" type="submit" class="Estilo4" value="Ver Balance" />
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
            <div align="center"><a href='balance_prueba_cta_0.php' target='_parent' class="Estilo1x">VOLVER A PASO 1 </a> </div>
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