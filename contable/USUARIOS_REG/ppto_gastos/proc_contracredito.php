<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<?
$id_emp=$_POST['id_emp']; 
$cod_pptal=$_POST['cod_pptal'];

$fecha_adi=$_POST['fecha_adi'];
$ppto_aprob=$_POST['ppto_aprob'];
$tipo_acto=$_POST['tipo_acto'];
$num_acto=$_POST['num_acto'];
$valor_adi=$_POST['valor_adi'];
$concepto_adi=$_POST['concepto_adi'];
$definitivo=$_POST['definitivo'];

//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>",$id_emp,$cod_pptal,$nom_rubro,$fecha_adi,$ppto_aprob,$tipo_acto,$num_acto,$valor_adi,$concepto_adi);

// valido que el contracredito no sea mayor al definitivo


	include('../config.php');				
	$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from vf";
	$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
	while($rowxx = mysql_fetch_array($resultadoxx)) 
	{
 	 $ax=$rowxx["fecha_ini"]; $bx=$rowxx["fecha_fin"];
	}
	$res = mysql_db_query($database,"select nom_rubro from car_ppto_gas where cod_pptal='$cod_pptal'",$cx);
	while ($rw=mysql_fetch_array($res))
	{
		$nom_rubro =$rw["nom_rubro"];
	} 
	
	if($fecha_adi > $bx or $fecha_adi < $ax)
	{
		printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='contracredito.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
	}
	else
	{ 
	
	$sq = "INSERT INTO contracreditos ( id_emp , cod_pptal , nom_rubro , fecha_adi , ppto_aprob , tipo_acto , num_acto , valor_adi , concepto_adi) VALUES ( '2' , '$cod_pptal' , '$nom_rubro' , '$fecha_adi' , '$ppto_aprob' , '$tipo_acto' , '$num_acto' , '$valor_adi' , '$concepto_adi')";

	$res = mysql_db_query($database, $sq, $cx);
	
	    $afectado_otros = '1';
	    mysql_connect($server, $dbuser, $dbpass);
		mysql_select_db($database);
		$sSQL="Update car_ppto_gas Set afectado_otros='$afectado_otros' Where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'";
		mysql_query($sSQL);
	
	//resto el valor a todos sus padres
		$ingresa = $cod_pptal;
		$idxx=$id_emp;
		$h=$valor_adi;
		$connection = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
        $longitud = strlen($ingresa);
		switch ($longitud)
  		 {
		   case (0):
						$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
     					break;
						//---------
						case (1):
     						
	                     break;
						//---------
						case (2):
     					 $tipo = 1;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 2;
						 //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
						 
	                     break;
						//---------
						case (3):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (4):
     					 $tipo = 2;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 3;
	 					  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
                         
	                     break;
						//---------
						case (5):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (6):
     					 $tipo = 4;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 4;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
                         
	                     break;
						//---------
						case (7):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (8):
     					 $tipo = 6;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 5;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
                         
	                     break;
						//---------
						case (9):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (10):
 						 $tipo = 8;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 6;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                        
						  
	                     break;
						//---------
						case (11):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (12):
     					 $tipo = 10;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 7;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
	                     break;
						//---------
						case (13):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (14):
     					 $tipo = 12;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 8;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         			 					 
	                     break;
						//---------
						case (15):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (16):
     					 $tipo = 14;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 9;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (17):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (18):
     					 $tipo = 16;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 10;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (19):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (20):
     					 $tipo = 18;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 11;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "Update car_ppto_gas set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                        
						 break;
						//---------
						case (21):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (22):
     					 $tipo = 20;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 12;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "Update car_ppto_gas set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "Update car_ppto_gas set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (23):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (24):
     					 $tipo = 22;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 13;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "Update car_ppto_gas set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "Update car_ppto_gas set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "Update car_ppto_gas set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (25):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (26):
     					 $tipo = 24;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 14;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_gas where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm - $h;
						 $sqlpm = "Update car_ppto_gas set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "Update car_ppto_gas set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "Update car_ppto_gas set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "Update car_ppto_gas set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (27):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (28):
     					 $tipo = 26;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 15;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 15
						 $pn = substr($codigo,0,26); 
					$consultapn=mysql_query("select * from car_ppto_gas where cod_pptal ='$pn' and id_emp ='$idxx'",$connection);
     					 while($rowpn = mysql_fetch_array($consultapn)) 
      				     {	 
						   $vrpn=$rowpn["definitivo"];
					     } 
						 $respn = $vrpn - $h;
						 $sqlpn = "Update car_ppto_gas set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
					     $resultadopn = mysql_db_query($database, $sqlpn, $connection);
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_gas where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm - $h;
						 $sqlpm = "Update car_ppto_gas set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "Update car_ppto_gas set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "Update car_ppto_gas set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "Update car_ppto_gas set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                        
						 break;
						//---------
						case (29):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (30):
     					 $tipo = 28;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 16;
						  //lo actualizo a el mismo
						 $c=mysql_query("select * from car_ppto_gas where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr - $h;
						 $sql = "Update car_ppto_gas set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 16
						 $po = substr($codigo,0,28); 
					$consultapo=mysql_query("select * from car_ppto_gas where cod_pptal ='$po' and id_emp ='$idxx'",$connection);
     					 while($rowpo = mysql_fetch_array($consultapo)) 
      				     {	 
						   $vrpo=$rowpo["definitivo"];
					     } 
						 $respo = $vrpo - $h;
						 $sqlpo = "Update car_ppto_gas set definitivo = '$respo' where cod_pptal ='$po' and id_emp ='$idxx'";
					     $resultadopo = mysql_db_query($database, $sqlpo, $connection);
						 // padre cuenta nivel 15
						 $pn = substr($codigo,0,26); 
					$consultapn=mysql_query("select * from car_ppto_gas where cod_pptal ='$pn' and id_emp ='$idxx'",$connection);
     					 while($rowpn = mysql_fetch_array($consultapn)) 
      				     {	 
						   $vrpn=$rowpn["definitivo"];
					     } 
						 $respn = $vrpn - $h;
						 $sqlpn = "Update car_ppto_gas set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
					     $resultadopn = mysql_db_query($database, $sqlpn, $connection);
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_gas where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm - $h;
						 $sqlpm = "Update car_ppto_gas set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "Update car_ppto_gas set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "Update car_ppto_gas set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "Update car_ppto_gas set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "Update car_ppto_gas set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "Update car_ppto_gas set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "Update car_ppto_gas set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "Update car_ppto_gas set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "Update car_ppto_gas set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "Update car_ppto_gas set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "Update car_ppto_gas set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "Update car_ppto_gas set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "Update car_ppto_gas set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						
		                default:
                        $error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='contracredito.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>"; 
		 }
		printf("%s <br><br></center>",$error);



		printf("<BR><BR><center class='Estilo4'>CONTRACREDITO ALMACENADO CON EXITO<br><br>");  
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='contracredito.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");  
	
	
	
}

?>
<?
}
?><title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #666666;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: underline;
}
a:active {
	color: #666666;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
.Estilo7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>