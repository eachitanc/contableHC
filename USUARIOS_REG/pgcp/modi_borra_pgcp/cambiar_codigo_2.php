<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../../login.php");
exit;
} else {
   include('../../config.php');
// recibo informacion del usuario
   $ingresa=$_POST['ingresa'];      				
// cx bd
// saco el id de la empresa
global $server, $database, $dbpass,$dbuser,$charset;
// Conexion con la base de datos
$cx= new mysqli ($server, $dbuser, $dbpass, $database);			
	    $sqlxx = "select * from fecha";
	    $resultadoxx = $cx->query($sqlxx);
	    while($rowxx = $resultadoxx->fetch_array())
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
   
// verificar que sea de ppto ingresos

   $a = substr($ingresa,0,1);
   
   if($a > 9 )
   {
   echo "<br><br><center class='Estilo4'><b>El codigo  que intenta grabar ES SUPERIOR A 9<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='cambiar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
   }
   else//if ($a == 0 || $a >= 2)
   {   	

		printf("<center class='Estilo4'><B>ANALISIS DE LOS DATOS INGRESADOS POR EL USUARIO</B><BR><br>
				Codigo Presupuestal Ingresado = %s",$ingresa);
				
       // consulto si coinciden	
	   $sql = "select * from pgcp where cod_pptal='$ingresa' and id_emp='$idxx'";
	   $result = $cx->query($sql);
       if ($result->num_rows == 0)
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     	/*marca*/		 while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
		/*marca*/ 		$sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 
		/*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
		/*marca*/		 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
  						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------		
						/*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						/*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						/*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------	
						/*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
					     // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
                          /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						/*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
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
						 $consulta=mysql_query("select * from pgcp where cod_pptal ='$padre' 
						 and id_emp ='$idxx'",$connection);
     					  while($row = mysql_fetch_array($consulta)) 
      				     {	 $a=$row["ano"]; $b=$row["id_emp"]; $c=$row["cod_pptal"]; $d=$row["padre"];
						     $e=$row["nom_rubro"]; $f=$row["tip_dato"]; $g=$row["nivel"];
							 $h=$row["afectado"]; $i=$row["banco"]; $j=$row["nom_banco1"];
							 $k=$row["nom_banco2"]; $l=$row["num_cta"]; $m=$row["fuentes_recursos"];
							 $n=$row["sispro"]; $o=$row["naturaleza"];  $p=$row["c_nc"]; $q=$row["almacen"];
							 $r=$row["depreciable"]; $s=$row["cartera"]; $t=$row["tercero"];
							 $u=$row["base"]; $v=$row["c_costos"]; $w=$row["cta_costos"];
							 $x=$row["ent_recip"]; $y=$row["cod_sia"]; $z=$row["tip_cta"]; $aa=$row["sispro2"];
							 $ab=$row["cod_fut_el"];
					     } 
						 $sql = "update tmp_pgcp set ano='$a',id_emp='$b',cod_pptal='$c',padre='$d',
						 nom_rubro='$e',tip_dato='$f',nivel='$g',afectado='$h',banco='$i',nom_banco1='$j',nom_banco2='$k',
						 num_cta='$l',fuentes_recursos='$m',sispro='$n',naturaleza='$o',c_nc='$p',almacen='$q',
						 depreciable='$r',cartera='$s',tercero='$t',base='$u',c_costos='$v',cta_costos='$w',
						 ent_recip='$x',cod_sia='$y',tip_cta='$z',sispro2='$aa',cod_fut_el='$ab' ";
					     $resultado = mysql_db_query($database, $sql, $connection);
						 //-----------------------
						 /*marca*/		 //actualizo el padre
						 
						$sql2 = "update pgcp set 
						 tip_dato='M',afectado='1',banco='',nom_banco1='',nom_banco2='',
						 num_cta='',fuentes_recursos='',sispro='',almacen='',
						 depreciable='',cartera='',tercero='',base='',c_costos='',cta_costos='',
						 ent_recip='',cod_sia='',tip_cta='',sispro2='',cod_fut_el='' 
						 where cod_pptal = '$padre' and id_emp = '$idxx' ";
					     $resultado2 = mysql_db_query($database, $sql2, $connection);				 
						 
						 
						 //-----------------------
						 // me llevo los vrs de tmp a ../proc_carga_pgcp.php y guardo la nueva cuenta
						 printf("<center class='Estilo4'><br>Cambios Realizados con Exito<br><br>
						 <form name='form1' method='post' action='../proc_carga_pgcp.php'>
						 
 						 <input type='hidden' name='id_emp' value='$b'>
 						 <input type='hidden' name='cod_pptal' value='$codigo'>
						 <input type='hidden' name='nom_rubro' value='$e'>
						 <input type='hidden' name='selecprod' value='$f'>
						 <input type='hidden' name='afectado' value='0'>
						 <input type='hidden' name='banco' value='$i'>
						 <input type='hidden' name='nom_banco1' value='$j'>
						 <input type='hidden' name='nom_banco2' value='$k'>
						 <input type='hidden' name='num_cta' value='$l'>
						 <input type='hidden' name='fuentes_recursos' value='$m'>
						 <input type='hidden' name='cod_sia' value='$y'>
						 <input type='hidden' name='tip_cta' value='$z'>
						 <input type='hidden' name='sispro' value='$n'>
						 <input type='hidden' name='sispro2' value='$aa'>
						 <input type='hidden' name='cod_fut_el' value='$ab'>
						 <input type='hidden' name='naturaleza' value='$o'>
						 <input type='hidden' name='c_nc' value='$p'>
						 <input type='hidden' name='almacen' value='$q'>
						 <input type='hidden' name='depreciable' value='$r'>
						 <input type='hidden' name='cartera' value='$s'>
						 <input type='hidden' name='tercero' value='$t'>
						 <input type='hidden' name='base' value='$u'>
						 <input type='hidden' name='c_costos' value='$v'>
						 <input type='hidden' name='cta_costos' value='$w'>
						 <input type='hidden' name='ent_recip' value='$x'>
						 <input type='submit' name='Submit' value='Volver' class='Estilo4'>
						 </form></center>");	
						 break;
						//---------
						
		                default:
                        $error = "<center class='Estilo4'><br><br><b>La Extension del Codigo contable Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion<br><br>
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
		 
		 echo "<br><br><center class='Estilo4'><B><U>ERROR</U></B><BR><BR>El codigo contable que intenta grabar<br><BR>
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