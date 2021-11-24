<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>
<?php
include("config.php");
 
$id=$_POST['id'];

// saco el id de la empresa
   $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	    while($rowxx = mysql_fetch_array($resultadoxx)) 
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
		
// saco el valor a adicionar y cod_pptal
			
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from red_ppto_ing where id ='$id' and id_emp ='$idxx'";
	$resultadoxx = mysql_db_query($database, $sqlxx, $cx);
	while($r = mysql_fetch_array($resultadoxx)) 
	{
 	$h=$r["valor_adi"];
	$ingresa=$r["cod_pptal"];
	}
	
//	printf("%s<br>%s<br>%s<br>",$idxx,$h,$ingresa);
  
	   
//sumo el valor a todos sus padres
		$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		
		$longitud = strlen($ingresa);
		switch ($longitud)
  		 {
		   case (0):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0', $afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
						 
	                     break;
						//---------
						case (3):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
                         
	                     break;
						//---------
						case (5):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
                         
	                     break;
						//---------
						case (7):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
                        
	                     break;
						//---------
						case (9):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                        
						  
	                     break;
						//---------
						case (11):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
	                     break;
						//---------
						case (13):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         	 					 
	                     break;
						//---------
						case (15):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (17):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                        
						 break;
						//---------
						case (19):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj + $h;
						 $sqlpj = "update car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (21):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk + $h;
						 $sqlpk = "update car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj + $h;
						 $sqlpj = "update car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (23):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl + $h;
						 $sqlpl = "update car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk + $h;
						 $sqlpk = "update car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj + $h;
						 $sqlpj = "update car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (25):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_ing where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm + $h;
						 $sqlpm = "update car_ppto_ing set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl + $h;
						 $sqlpl = "update car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk + $h;
						 $sqlpk = "update car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj + $h;
						 $sqlpj = "update car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (27):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 15
						 $pn = substr($codigo,0,26); 
					$consultapn=mysql_query("select * from car_ppto_ing where cod_pptal ='$pn' and id_emp ='$idxx'",$connection);
     					 while($rowpn = mysql_fetch_array($consultapn)) 
      				     {	 
						   $vrpn=$rowpn["definitivo"];
					     } 
						 $respn = $vrpn + $h;
						 $sqlpn = "update car_ppto_ing set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
					     $resultadopn = mysql_db_query($database, $sqlpn, $connection);
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_ing where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm + $h;
						 $sqlpm = "update car_ppto_ing set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl + $h;
						 $sqlpl = "update car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk + $h;
						 $sqlpk = "update car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj + $h;
						 $sqlpj = "update car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						case (29):
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
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
						 $c=mysql_query("select * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'",$connection);
     					 while($r = mysql_fetch_array($c)) 
      				     {	 
						   $vr=$r["definitivo"];
					     } 
						 $re = $vr + $h;
						 $sql = "update car_ppto_ing set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
					     $res = mysql_db_query($database, $sql, $connection);
	 					 // actualizo el valor de todos los padres
						 // padre cuenta nivel 16
						 $po = substr($codigo,0,28); 
					$consultapo=mysql_query("select * from car_ppto_ing where cod_pptal ='$po' and id_emp ='$idxx'",$connection);
     					 while($rowpo = mysql_fetch_array($consultapo)) 
      				     {	 
						   $vrpo=$rowpo["definitivo"];
					     } 
						 $respo = $vrpo + $h;
						 $sqlpo = "update car_ppto_ing set definitivo = '$respo' where cod_pptal ='$po' and id_emp ='$idxx'";
					     $resultadopo = mysql_db_query($database, $sqlpo, $connection);
						 // padre cuenta nivel 15
						 $pn = substr($codigo,0,26); 
					$consultapn=mysql_query("select * from car_ppto_ing where cod_pptal ='$pn' and id_emp ='$idxx'",$connection);
     					 while($rowpn = mysql_fetch_array($consultapn)) 
      				     {	 
						   $vrpn=$rowpn["definitivo"];
					     } 
						 $respn = $vrpn + $h;
						 $sqlpn = "update car_ppto_ing set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
					     $resultadopn = mysql_db_query($database, $sqlpn, $connection);
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_ing where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm + $h;
						 $sqlpm = "update car_ppto_ing set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl + $h;
						 $sqlpl = "update car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk + $h;
						 $sqlpk = "update car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj + $h;
						 $sqlpj = "update car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi + $h;
						 $sqlpi = "update car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph + $h;
						 $sqlph = "update car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg + $h;
						 $sqlpg = "update car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf + $h;
						 $sqlpf = "update car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe + $h;
						 $sqlpe = "update car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd + $h;
						 $sqlpd = "update car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc + $h;
						 $sqlpc = "update car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb + $h;
						 $sqlpb = "update car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa + $h;
						 $sqlpa = "update car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
                         
						 break;
						//---------
						
		                default:
						$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
		 }
		 
		 
printf("%s <br><br></center>",$error);   


new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From red_ppto_ing Where id='$id' and id_emp ='$idxx'";
mysql_query($sSQL);

					printf("
<center class='Estilo4'><br><br><b>REDUCCION ELIMINADA CON EXITO</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>");



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