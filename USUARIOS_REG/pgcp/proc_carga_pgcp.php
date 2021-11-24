<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {

   include('../config.php');				
    
	////------------------
	global $server, $database, $dbpass,$dbuser,$charset;
	// Conexion con la base de datos
	$cx= new mysqli ($server, $dbuser, $dbpass, $database);
	    $s = "select * from fecha";
	    $r = $cx->query($s);
	    while($v = $r->fetch_assoc()){ 
  	    
     	 $fecha_sesion=$v["ano"];
    	}

	
   $ano = $fecha_sesion; //OK
   $id_emp=$_POST['id_emp']; //OK
   $cod_pptal=$_POST['cod_pptal'];// ok 
   $nom_rubro=$_POST['nom_rubro']; //ok 
   $tip_dato=$_POST['selecprod']; //ok
   $afectado='0'; //
   $cta_maestra =$_POST["cta_maestra"];
   //convierto a minusculas el nombre de las cuentas tipo DETALLE
   if($tip_dato == 'M')
   {
    
   }
   else
   {
     $nom_rubro = strtolower($nom_rubro);
   }
   
   //valido si es cuenta 0
   $cta0 = substr($cod_pptal,0,1);
//cuentas mayor se anulan en el combo del form anterior
   if($cta0 == '0')
   {
   $banco='';
   $nom_banco1='';
   $nom_banco2='';
   $num_cta='';
   $fuentes_recursos='';
   $cod_sia='';//**********
   $tip_cta='';//**********
   $sispro='';
   $sispro2='';//**********
   $cod_fut_el='';//**********
   $naturaleza=$_POST['naturaleza']; //
   $c_nc=$_POST['c_nc']; //
   $almacen='';
   $depreciable='';
   $cartera='';
   $tercero='';
   $base='';
   $c_costos='';
   $cta_costos='';
   $ent_recip='';
   $bloqueo='NO';
   }
   else
   {
   if (isset($_POST['banco'])) $banco=$_POST['banco']; else $banco=''; //
   if (isset($_POST['nom_banco1'])) $nom_banco1=$_POST['nom_banco1']; else $nom_banco1='';//
   if (isset($_POST['$nom_banco2'])) $nom_banco2=$_POST['nom_banco2']; else $nom_banco2='';//
   if (isset($_POST['num_cta'])) $num_cta=$_POST['num_cta']; else $num_cta='';//	
   if (isset($_POST['fuentes_recursos'])) $fuentes_recursos=$_POST['fuentes_recursos']; else $fuentes_recursos='';//
   if (isset($_POST['cod_sia'])) $cod_sia=$_POST['cod_sia']; else $cod_sia='';//
   if (isset($_POST['tip_cta'])) $tip_cta=$_POST['tip_cta']; else $tip_cta='';//
   if (isset($_POST['sispro'])) $sispro=$_POST['sispro']; else $sispro='';//
   if (isset($_POST['sispro2'])) $sispro2=$_POST['sispro2']; else $sispro2='';//
   if (isset($_POST['cod_fut_el'])) $cod_fut_el=$_POST['cod_fut_el']; else $cod_fut_el='';//
   if (isset($_POST['naturaleza'])) $naturaleza=$_POST['naturaleza']; else $naturaleza='';//
   if (isset($_POST['c_nc'])) $c_nc=$_POST['c_nc']; else $c_nc='';//
   if (isset($_POST['almacen'])) $almacen=$_POST['almacen']; else $almacen='';//
   if (isset($_POST['depreciable'])) $depreciable=$_POST['depreciable']; else $depreciable='';//
   if (isset($_POST['cartera'])) $cartera=$_POST['cartera']; else $cartera='';//
   if (isset($_POST['tercero'])) $tercero=$_POST['tercero']; else $tercero='';//
   if (isset($_POST['base'])) $base=$_POST['base']; else $base='';//
   if (isset($_POST['c_costos'])) $c_costos=$_POST['c_costos']; else $c_costos='';//
   if (isset($_POST['cta_costos'])) $cta_costos=$_POST['cta_costos']; else $cta_costos='';//
   if (isset($_POST['ent_recip'])) $ent_recip=$_POST['ent_recip']; else $ent_recip='';//

   $bloqueo='NO';
   }
   
//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>", $ano,$id_emp,$cod_pptal,$nom_rubro,$tip_dato,$afectado,$banco,$nom_banco1,$nom_banco2,$num_cta,$fuentes_recursos,$sispro,$naturaleza,$c_nc,$almacen,$depreciable,$cartera,$tercero,$base,$c_costos,$cta_costos,$ent_recip);  
  
	////------------------



  
$sq2="select * from vf ";
$consultax= $cx->query($sq2);
while($rowx =$consultax->fetch_array())
{	 
	$ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 

if($ano > $bx or $ano < $ax)
{
printf("<center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual</center>");
}
else
{   
   
//---------------------------- saco el id de la empresa ----------------------------
	    $sqlxx = "select * from fecha";
	    $resultadoxx = $cx->query($sqlxx);
	    while($rowxx = $resultadoxx->fetch_array())
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
   
   
   $sql = "update tmp_cod_pptal set cod='$cod_pptal'";
   $resultado = $cx->query($sql);
   
   $ingreso = substr($cod_pptal,0,1);
   
   if($ingreso > 9 )// *** no sirve, pero dejemolo ahi... no estorba ***
   {
   		echo "<br><br><center class='Estilo4'><b>El codigo  que intenta grabar ES SUPERIOR A 9<br><br></center>";
   }
   else//if ($ingreso == 0 || $ingreso >= 2)
   {
		
		$cadena = $cod_pptal;
   		$longitud = strlen($cadena);
    	printf("<center class='Estilo4'><B>ANALISIS DE LOS DATOS INGRESADOS POR EL USUARIO</B><BR><br>
	        Codigo presupuestal = %s",$cadena);
   	//echo $longitud;
	switch ($longitud)
   	 {
         	  
	  case (0):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	  case (1):
	  $tipo = 1;
      $codigo = $cadena;
	  $padre = substr($codigo,0,$tipo);
	  $nivel = 1;
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	$sq3=  "select tip_dato from pgcp where cod_pptal ='$padre' and id_emp ='$idxx'";
	$consulta= $cx->query($sq3);
    $row =$consulta->fetch_array();
	        
				if (isset($row["tip_dato"])) $mayor_detalle=$row["tip_dato"]; else $mayor_detalle='M';
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion </center>");
	  }
	  else
	  {
			

	  //----------------------------------------------------------------------------------
      // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$codigo' and id_emp='$idxx'";
		$result = $cx->query($sql);
		if ($result->num_rows == 0)
		{
			//--------- INSERCION DEL NUEVO COD_PPTAL -----

			$sql1 = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo,homologacion ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro','$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			
			$cx->query($sql1);
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br>
			<br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion </center>";
		} 
		
	  }	
	
	   
	  break;
	  //---------------------
    case (2):
      $tipo = 1;
	  $codigo = $cadena;
	  $nivel = 2;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	$sq4 =  "select tip_dato from pgcp where cod_pptal ='$padre' and id_emp ='$idxx'";
	$consulta= $cx->query($sq4);
      while($row =$consulta->fetch_array())
      {	
		   $mayor_detalle=$row["tip_dato"];  
		} 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  {
	  
	  //----------------------------------------------------------------------------------
      // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);

		if ( $result->num_rows == 0)
		{
			//------ verifico que exista el padre ---

          $sql1 = "select * from pgcp where cod_pptal= '$padre' and id_emp='$idxx'";
		  
		  $result1 = $cx->query($sql1);
		  $fil=$result1->num_rows;
			if ($fil == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 1<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion 
				</center>";
				
			}
			else
			{

			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			$cx->query($sql);
			
			// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$cx->query($sql2);
			
			}   
		 
		 }   
					
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br>
			<br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		}
		    
      

	  }
	  
	  break;
	  //---------------------
	     case (3):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (4):
      $tipo = 2;
	  $codigo = $cadena;
	  $nivel = 3;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	$sql4=  "select tip_dato from pgcp where cod_pptal ='$padre' and id_emp ='$idxx'";  
	$consulta= $cx->query($sql4);
      while($row = $consulta->fetch_array())
	  
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  {
	  
	  //------------------------- calculo de codigos y niveles ----------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = $nivel - 2;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = $nivel - 1;
	  	  
	   // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql); 

		if ( $result->num_rows == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c2' and nivel = '2' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  $fil=$result1->num_rows;
			if ( $fil == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 2<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			} else{
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL DE 3ER NIVEL-----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra,naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			       $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}else{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		}
	   
	  
			
      }
		
      break;
	  //---------------------
	     case (5):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (6):
      $tipo = 4;
	  $codigo = $cadena;
	  $nivel = 4;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql = "select * from pgcp where cod_pptal = '$padre' and id_emp='$idxx'";
	$consulta = $cx->query($sql);
      while($row = $consulta->fetch_array())
	  
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; //aumentar un nivel 
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c3' and nivel = '3' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  $fil=$result1->num_rows;
		  if ( $fil == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 3 $sql1<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			        $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
      break;
	  //---------------------
	     case (7):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>"; 
      break;
	  //---------------------
	     case (8):
      $tipo = 6;
	  $codigo = $cadena;
	  $nivel = 5;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	$sq4="select tip_dato from pgcp where cod_pptal ='$padre' and id_emp ='$idxx'";  
	$consulta= $cx->query($sq4);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil=$result->num_rows;
		if ($fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c4' and nivel = '4' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ($result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 4<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			        $cx->query($sql) ;
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql) ;
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
      break;
	  //---------------------
	     case (9):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (10):
      $tipo = 8;
	  $codigo = $cadena;
	  $nivel = 6;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
    $sq4 = "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'";				
	$consulta= $cx->query($sq4);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;//aumentar un nivel 
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ($fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c5' and nivel = '5' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ($result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 5<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			        $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
	    
      break;
	  //---------------------
	     case (11):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (12):
      $tipo = 10;
	  $codigo = $cadena;
	  $nivel = 7;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql4= "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'";		
	  $consulta= $cx->query($sql4);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c6' and nivel = '6' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  $fil=$result1->num_rows;
		  if ($fil == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 6<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			       $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
      break;
	  //---------------------
	     case (13):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (14):
      $tipo = 12;
	  $codigo = $cadena;
	  $nivel = 8;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	$sql4= "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'"; 
	$consulta= $cx->query($sql4);
      while($row = $consulta->fetch_array()) 
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql15 = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql15);
		$fil=$result->num_rows;
		if ( $fil== 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c7' and nivel = '7' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 7<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			       // mysql_query($sql, $connection) or die(mysql_error());
					$cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2) or die($cx->error);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
      break;
	  //---------------------
	     case (15):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (16):
      $tipo = 14;
	  $codigo = $cadena;
	  $nivel = 9;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql4= "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'";
	  $consulta= $cx->query($sql4);
      while($row = 	$consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c8' and nivel = '8' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 8<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro','$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			$result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
      break;
	  //---------------------
	     case (17):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------	
	     case (18):
      $tipo = 16;
	  $codigo = $cadena;
	  $nivel = 10;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	$sql4 = "select * from pgcp where cod_pptal = '$padre' and id_emp='$idxx'";  
	$consulta= $cx->query($sql4);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	   //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c9' and nivel = '9' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 9<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			$result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
      break;
	  //---------------------
	     case (19):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break;
	  //---------------------
	     case (20):
      $tipo = 18;
	  $codigo = $cadena;
	  $nivel = 11;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	 $sql4= "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'"; 
	  $consulta= $cx->query($sql4);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c10 = substr($codigo,0,18);
	  $niv10 = 10;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c10' and nivel = '10' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 10<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra,naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			$result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }
	  
      break;
	  //---------------------
	     case (21):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break; 
	  //---------------------
	  	 case (22):
      $tipo = 20;
	  $codigo = $cadena;
	  $nivel = 12;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);

	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql = "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'";
	  $consulta= $cx->query($sql);
      while($row = $consulta->fetch_array()) 
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	   //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c10 = substr($codigo,0,18);
	  $niv10 = 10;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c11 = substr($codigo,0,20);
	  $niv11 = 11;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ($fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c11' and nivel = '11' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ($result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 11<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			         $result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }	  
	  
	  
     break;  
      //---------------------
	     case (23):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break; 
	  //---------------------
	  	 case (24):
      $tipo = 22;
	  $codigo = $cadena;
	  $nivel = 13;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql = "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'"; 
	  $consulta= $cx->query($sql);
      while($row = 	$consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c10 = substr($codigo,0,18);
	  $niv10 = 10;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c11 = substr($codigo,0,20);
	  $niv11 = 11;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c12 = substr($codigo,0,22);
	  $niv12 = 12;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c12' and nivel = '12' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 12<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro','$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			        $result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }	 	  
	  
     break;  
      //---------------------	
	     case (25):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break; 
	  //---------------------
	  	 case (26):
      $tipo = 24;
	  $codigo = $cadena;
	  $nivel = 14;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql = "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'"; 
	  $consulta= $cx->query($sql);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c10 = substr($codigo,0,18);
	  $niv10 = 10;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c11 = substr($codigo,0,20);
	  $niv11 = 11;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c12 = substr($codigo,0,22);
	  $niv12 = 12;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c13 = substr($codigo,0,24);
	  $niv13 = 13;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c13' and nivel = '13' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 13<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra,naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro','$cta_maestra', '$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			       $result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }	 		  
	  
     break;  
      //---------------------		  
	     case (27):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break; 
	  //---------------------
	  	 case (28):
      $tipo = 26;
	  $codigo = $cadena;
	  $nivel = 15;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	 $sql = "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'"; 
	  $consulta= $cx->query($sql);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c10 = substr($codigo,0,18);
	  $niv10 = 10;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c11 = substr($codigo,0,20);
	  $niv11 = 11;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c12 = substr($codigo,0,22);
	  $niv12 = 12;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c13 = substr($codigo,0,24);
	  $niv13 = 13;
	  
	  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c14 = substr($codigo,0,26);
	  $niv14 = 14;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ( $fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c14' and nivel = '14' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 14<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro,cta_maestra, naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			        $result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }	 	  
	  
     break;  
      //---------------------	
	     case (29):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      break; 
	  //---------------------
	  	 case (30):
      $tipo = 28;
	  $codigo = $cadena;
	  $nivel = 16;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $sql = "select * from pgcp where cod_pptal = '$padre' and id_emp = '$idxx'";
	  $consulta= $cx->query($sql);
      while($row = $consulta->fetch_array())
      {	 $mayor_detalle=$row["tip_dato"];  } 
	  
	  if ($mayor_detalle == 'D')
	  {
	  printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" .$cadena. "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" .$padre. "</B>:::...<br>que es una Cuenta tipo <B>" .$mayor_detalle. "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
	  }
	  else
	  { 
	  //------------calculo de codigos y niveles-----------------------------------------------	 
	  //---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
	  $c1 = substr($codigo,0,1);
	  $niv1 = 1;
	 	  
	  //---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
	  $c2 = substr($codigo,0,2);
	  $niv2 = 2;
	  
  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c3 = substr($codigo,0,4);
	  $niv3 = 3; 
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c4 = substr($codigo,0,6);
	  $niv4 = 4;
	  
	   //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c5 = substr($codigo,0,8);
	  $niv5 = 5;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c6 = substr($codigo,0,10);
	  $niv6 = 6;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c7 = substr($codigo,0,12);
	  $niv7 = 7;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c8 = substr($codigo,0,14);
	  $niv8 = 8;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c9 = substr($codigo,0,16);
	  $niv9 = 9;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c10 = substr($codigo,0,18);
	  $niv10 = 10;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c11 = substr($codigo,0,20);
	  $niv11 = 11;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c12 = substr($codigo,0,22);
	  $niv12 = 12;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c13 = substr($codigo,0,24);
	  $niv13 = 13;
	  
	  	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c14 = substr($codigo,0,26);
	  $niv14 = 14;
	  
	  //---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
	  $c15 = substr($codigo,0,28);
	  $niv15 = 15;//aumentar un nivel 
	  
	  
	  // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from pgcp where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = $cx->query($sql);
		$fil =$result->num_rows;
		if ($fil == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from pgcp where cod_pptal = '$c15' and nivel = '15' and id_emp='$idxx'";
		  $result1 = $cx->query($sql1);
		  
		  if ( $result1->num_rows == 0)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 15<br><br>
				<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO pgcp ( ano , id_emp , cod_pptal , padre , nom_rubro , tip_dato , nivel , afectado , 
			banco , nom_banco1, nom_banco2, num_cta, fuentes_recursos, sispro, cta_maestra,naturaleza, c_nc, almacen, depreciable, cartera, tercero, base, c_costos, cta_costos, ent_recip, cod_sia, tip_cta, sispro2, cod_fut_el, bloqueo ) VALUES ( '$ano' , '$id_emp' , '$cod_pptal' , '$padre' , '$nom_rubro' , '$tip_dato' , '$nivel' , '$afectado' , '$banco' , '$nom_banco1', '$nom_banco2', '$num_cta', '$fuentes_recursos', '$sispro', '$cta_maestra','$naturaleza', '$c_nc', '$almacen', '$depreciable', '$cartera', '$tercero', '$base', '$c_costos', '$cta_costos', '$ent_recip', '$cod_sia', '$tip_cta', '$sispro2', '$cod_fut_el', '$bloqueo' )";
			       $result = $cx->query($sql);
					
					// actualizo el afectado del padre cambiadolo a 1
			$sql2 = "update pgcp set afectado='1' where cod_pptal ='$padre' and id_emp ='$idxx'";
			$resultado2 = $cx->query($sql2);
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_pgcp.php'>Consulte Maestro P.G.C.P</a> y Verifique su Informacion</center>";
		} 
			
	  }	 	
	  
     break;  
      //---------------------		  	    
     default:
      $error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion</center>"; 
 
   	 }
    	 //echo $error; 

   }
   
}
	 

?>
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
.Estilo8 {
	color: #000000;
	font-size: 12px;
	font-weight: bold;
}
.Estilo9 {color: #FFFFFF}
-->
</style> 
<?php
}
?>
<title>CONTAFACIL</title>
<body onload = "document.forms[0]['a'].focus()">
		 <center>
		 <form name="a" action="carga_pgcp.php">
		 <input name="a" type="submit" class="Estilo4" value="Volver"/>
		 </form>
		 </center>
</body>