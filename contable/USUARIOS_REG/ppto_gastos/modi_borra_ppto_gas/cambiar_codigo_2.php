<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../../login.php");
exit;
} else {
?>
<?
   include('../../config.php');
// recibo informacion del usuario
   $ingresa=$_POST['ingresa'];      				
// cx bd
   if($connection=mysql_connect($server, $dbuser, $dbpass)) 
	{
		mysql_select_db($database);
	} 
	else 
	{
		die("Error conectandose a la base.");
	} 
// saco el id de la empresa
   $connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	    while($rowxx = mysql_fetch_array($resultadoxx)) 
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
   
// verificar que sea de ppto ingresos

   $a = substr($ingresa,0,1);
   
   if($a == 1 )
   {
   echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar NO ES DE GASTOS<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
   }
   elseif ($a == 0 || $a >= 2)
   {   	

		printf("<center class='Estilo4'><B>ANALISIS DE LOS DATOS INGRESADOS POR EL USUARIO</B><BR><br>
				Codigo Presupuestal Ingresado = %s",$ingresa);
				
       // consulto si coinciden	
	   $sql = "select * from car_ppto_gas where cod_pptal='$ingresa' and id_emp='$idxx'";
	   $result = mysql_query($sql, $connection) or die(mysql_error());
       if (mysql_num_rows($result) == 0)
		 {  
		 
			 //calculo la longitud de ingresa
			 $longitud = strlen($ingresa);
			 // determino el padre
			 switch ($longitud)
  				 {
	     				case (0):
						$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
     					break;
						//---------
						case (1):
     					 $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B>debe ser una cuenta MAYOR<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (2):
     					 $tipo = 1;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 2;
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						 // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");
	                     break;
						//---------
						case (3):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						  // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						  // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");
	                     break;
						//---------
						case (5):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						  // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
  						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");
	                     break;
						//---------
						case (7):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						 // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------		
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection);
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>"); 
	                     break;
						//---------
						case (9):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						 // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     
						 $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");
						  
	                     break;
						//---------
						case (11):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						  // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						  // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");
	                     break;
						//---------
						case (13):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
						  // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------	
						  // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");						 					 
	                     break;
						//---------
						case (15):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");		
						 break;
						//---------
						case (17):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");		
						 break;
						//---------
						case (19):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "update car_ppto_gas set definitivo='$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");		
						 break;
						//---------
						case (21):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "update car_ppto_gas set definitivo='$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "update car_ppto_gas set definitivo='$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");		
						 break;
						//---------
						case (23):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "update car_ppto_gas set definitivo='$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "update car_ppto_gas set definitivo='$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "update car_ppto_gas set definitivo='$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");		
						 break;
						//---------
						case (25):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
                         // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_gas where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm - $h;
						 $sqlpm = "update car_ppto_gas set definitivo='$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "update car_ppto_gas set definitivo='$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "update car_ppto_gas set definitivo='$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "update car_ppto_gas set definitivo='$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");		
						 break;
						//---------
						case (27):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 15
						 $pn = substr($codigo,0,26); 
					$consultapn=mysql_query("select * from car_ppto_gas where cod_pptal ='$pn' and id_emp ='$idxx'",$connection);
     					 while($rowpn = mysql_fetch_array($consultapn)) 
      				     {	 
						   $vrpn=$rowpn["definitivo"];
					     } 
						 $respn = $vrpn - $h;
						 $sqlpn = "update car_ppto_gas set definitivo='$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
					     $resultadopn = mysql_db_query($database, $sqlpn, $connection);
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_gas where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm - $h;
						 $sqlpm = "update car_ppto_gas set definitivo='$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "update car_ppto_gas set definitivo='$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "update car_ppto_gas set definitivo='$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "update car_ppto_gas set definitivo='$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");	
						 break;
						//---------
						case (29):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
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
	 					 printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	                     // saco todo lo que contiene el padre y se lo doy a tmp
						 $consulta=mysql_query("select * from car_ppto_gas where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["definitivo"]; $i=$row["proc_rec"]; $j=$row["situacion"];
							 $k=$row["afectado"];  
					     } 
					     $sql = "update tmp_modi_cod_ppto_ing set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',definitivo='$h',proc_rec='$i',situacion='$j',afectado='$k' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 // actualizo el padre cambiadolo a MAYOR con VALOR = 0
						 $sql2 = "update car_ppto_gas set tip_dato='M',ppto_aprob='0' , definitivo='0' 
						 where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = mysql_db_query($database, $sql2, $connection); 
						 // actualizo el valor de todos los padres
						 // padre cuenta nivel 16
						 $po = substr($codigo,0,28); 
					$consultapo=mysql_query("select * from car_ppto_gas where cod_pptal ='$po' and id_emp ='$idxx'",$connection);
     					 while($rowpo = mysql_fetch_array($consultapo)) 
      				     {	 
						   $vrpo=$rowpo["definitivo"];
					     } 
						 $respo = $vrpo - $h;
						 $sqlpo = "update car_ppto_gas set definitivo='$respo' where cod_pptal ='$po' and id_emp ='$idxx'";
					     $resultadopo = mysql_db_query($database, $sqlpo, $connection);
						 // padre cuenta nivel 15
						 $pn = substr($codigo,0,26); 
					$consultapn=mysql_query("select * from car_ppto_gas where cod_pptal ='$pn' and id_emp ='$idxx'",$connection);
     					 while($rowpn = mysql_fetch_array($consultapn)) 
      				     {	 
						   $vrpn=$rowpn["definitivo"];
					     } 
						 $respn = $vrpn - $h;
						 $sqlpn = "update car_ppto_gas set definitivo='$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
					     $resultadopn = mysql_db_query($database, $sqlpn, $connection);
						 // padre cuenta nivel 14
						 $pm = substr($codigo,0,24); 
					$consultapm=mysql_query("select * from car_ppto_gas where cod_pptal ='$pm' and id_emp ='$idxx'",$connection);
     					 while($rowpm = mysql_fetch_array($consultapm)) 
      				     {	 
						   $vrpm=$rowpm["definitivo"];
					     } 
						 $respm = $vrpm - $h;
						 $sqlpm = "update car_ppto_gas set definitivo='$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
					     $resultadopm = mysql_db_query($database, $sqlpm, $connection);
						 // padre cuenta nivel 13
						 $pl = substr($codigo,0,22); 
					$consultapl=mysql_query("select * from car_ppto_gas where cod_pptal ='$pl' and id_emp ='$idxx'",$connection);
     					 while($rowpl = mysql_fetch_array($consultapl)) 
      				     {	 
						   $vrpl=$rowpl["definitivo"];
					     } 
						 $respl = $vrpl - $h;
						 $sqlpl = "update car_ppto_gas set definitivo='$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
					     $resultadopl = mysql_db_query($database, $sqlpl, $connection);
						 // padre cuenta nivel 12
						 $pk = substr($codigo,0,20); 
					$consultapk=mysql_query("select * from car_ppto_gas where cod_pptal ='$pk' and id_emp ='$idxx'",$connection);
     					 while($rowpk = mysql_fetch_array($consultapk)) 
      				     {	 
						   $vrpk=$rowpk["definitivo"];
					     } 
						 $respk = $vrpk - $h;
						 $sqlpk = "update car_ppto_gas set definitivo='$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
					     $resultadopk = mysql_db_query($database, $sqlpk, $connection);
						 // padre cuenta nivel 11
						 $pj = substr($codigo,0,18); 
					$consultapj=mysql_query("select * from car_ppto_gas where cod_pptal ='$pj' and id_emp ='$idxx'",$connection);
     					 while($rowpj = mysql_fetch_array($consultapj)) 
      				     {	 
						   $vrpj=$rowpj["definitivo"];
					     } 
						 $respj = $vrpj - $h;
						 $sqlpj = "update car_ppto_gas set definitivo='$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
					     $resultadopj = mysql_db_query($database, $sqlpj, $connection);
						 // padre cuenta nivel 10
						 $pi = substr($codigo,0,16); 
					$consultapi=mysql_query("select * from car_ppto_gas where cod_pptal ='$pi' and id_emp ='$idxx'",$connection);
     					 while($rowpi = mysql_fetch_array($consultapi)) 
      				     {	 
						   $vrpi=$rowpi["definitivo"];
					     } 
						 $respi = $vrpi - $h;
						 $sqlpi = "update car_ppto_gas set definitivo='$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
					     $resultadopi = mysql_db_query($database, $sqlpi, $connection);
						 // padre cuenta nivel 9
						 $ph = substr($codigo,0,14); 
					$consultaph=mysql_query("select * from car_ppto_gas where cod_pptal ='$ph' and id_emp ='$idxx'",$connection);
     					 while($rowph = mysql_fetch_array($consultaph)) 
      				     {	 
						   $vrph=$rowph["definitivo"];
					     } 
						 $resph = $vrph - $h;
						 $sqlph = "update car_ppto_gas set definitivo='$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
					     $resultadoph = mysql_db_query($database, $sqlph, $connection);
						 // padre cuenta nivel 8
						 $pg = substr($codigo,0,12); 
					$consultapg=mysql_query("select * from car_ppto_gas where cod_pptal ='$pg' and id_emp ='$idxx'",$connection);
     					 while($rowpg = mysql_fetch_array($consultapg)) 
      				     {	 
						   $vrpg=$rowpg["definitivo"];
					     } 
						 $respg = $vrpg - $h;
						 $sqlpg = "update car_ppto_gas set definitivo='$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
					     $resultadopg = mysql_db_query($database, $sqlpg, $connection);
						 // padre cuenta nivel 7
						 $pf = substr($codigo,0,10); 
					$consultapf=mysql_query("select * from car_ppto_gas where cod_pptal ='$pf' and id_emp ='$idxx'",$connection);
     					 while($rowpf = mysql_fetch_array($consultapf)) 
      				     {	 
						   $vrpf=$rowpf["definitivo"];
					     } 
						 $respf = $vrpf - $h;
						 $sqlpf = "update car_ppto_gas set definitivo='$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
					     $resultadopf = mysql_db_query($database, $sqlpf, $connection);
						 // padre cuenta nivel 6
						 $pe = substr($codigo,0,8); 
					$consultape=mysql_query("select * from car_ppto_gas where cod_pptal ='$pe' and id_emp ='$idxx'",$connection);
     					 while($rowpe = mysql_fetch_array($consultape)) 
      				     {	 
						   $vrpe=$rowpe["definitivo"];
					     } 
						 $respe = $vrpe - $h;
						 $sqlpe = "update car_ppto_gas set definitivo='$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
					     $resultadope = mysql_db_query($database, $sqlpe, $connection);
						 // padre cuenta nivel 5
						 $pd = substr($codigo,0,6); 
					$consultapd=mysql_query("select * from car_ppto_gas where cod_pptal ='$pd' and id_emp ='$idxx'",$connection);
     					 while($rowpd = mysql_fetch_array($consultapd)) 
      				     {	 
						   $vrpd=$rowpd["definitivo"];
					     } 
						 $respd = $vrpd - $h;
						 $sqlpd = "update car_ppto_gas set definitivo='$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
					     $resultadopd = mysql_db_query($database, $sqlpd, $connection);
						 // padre cuenta nivel 4
 						 $pc = substr($codigo,0,4); 
				    $consultapc=mysql_query("select * from car_ppto_gas where cod_pptal ='$pc' and id_emp ='$idxx'",$connection);
     					 while($rowpc = mysql_fetch_array($consultapc)) 
      				     {	 
						   $vrpc=$rowpc["definitivo"];
					     } 
						 $respc = $vrpc - $h;
						 $sqlpc = "update car_ppto_gas set definitivo='$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
					     $resultadopc = mysql_db_query($database, $sqlpc, $connection);
						 // padre cuenta nivel 3
 						 $pb = substr($codigo,0,2); 
					$consultapb=mysql_query("select * from car_ppto_gas where cod_pptal ='$pb' and id_emp ='$idxx'",$connection);
     					 while($rowpb = mysql_fetch_array($consultapb)) 
      				     {	 
						   $vrpb=$rowpb["definitivo"];
					     } 
						 $respb = $vrpb - $h;
						 $sqlpb = "update car_ppto_gas set definitivo='$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
					     $resultadopb = mysql_db_query($database, $sqlpb, $connection);
						 // padre cuenta nivel 2
 						 $pa = substr($codigo,0,1); 
					$consultapa=mysql_query("select * from car_ppto_gas where cod_pptal ='$pa' and id_emp ='$idxx'",$connection);
     					 while($rowpa = mysql_fetch_array($consultapa)) 
      				     {	 
						   $vrpa=$rowpa["definitivo"];
					     } 
						 $respa = $vrpa - $h;
						 $sqlpa = "update car_ppto_gas set definitivo='$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
					     $resultadopa = mysql_db_query($database, $sqlpa, $connection); 
						 // me llevo los vrs de tmp a ../proc_carga_ppto_gas.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_ppto_gas.php'>
						 <input type='hidden' name='ano' value='$a'>
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='ppto_aprob' value='$h'>
						 <input type='hidden' name='proc_rec' value='$i'>
						 <input type='hidden' name='situacion' value='$j'>
						 <input type='hidden' name='afectado' value='$k'>
						 <input type='hidden' name='inversion' value='SI'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");	
						 break;
						//---------
						
		                default:
                        $error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>"; 
                 }
                 printf("%s <br><br></center>",$error);
		 
		 
		 }
		 else
		 {
		 
		 echo "<br><br><center class='Estilo4'><B><U>ERROR</U></B><BR><BR>El codigo presupuestal que intenta grabar<br><BR>
		       pertenece a una cuenta MAYOR que ya EXISTE o<br><br>
			   <B> COINCIDE</B><br><br>con el codigo presupuestal que lo contendra<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
		 
		 }
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
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo15 {font-size: 11px}
</style>