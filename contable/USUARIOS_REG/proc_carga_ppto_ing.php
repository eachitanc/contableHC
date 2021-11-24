<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>
<?php

   include('config.php');				
    
   if($connection=mysql_connect($server, $dbuser, $dbpass)) 
	{
		mysql_select_db($database);
	} 
	else 
	{
		die("Error conectandose a la base.");
	} 
	
	////------------------
		$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	    $s = "select * from fecha";
	    $r = mysql_db_query($database, $s, $connectionxx);
	    while($rw = mysql_fetch_array($r)) 
  	    {
     	 $fecha_sesion=$rw["ano"];
    	}
		
		$ss = "select * from fecha_ini_op";
	    $rs = mysql_db_query($database, $ss, $connectionxx);
	    while($rws = mysql_fetch_array($rs)) 
  	    {
     	 $fecha_ini_op=$rws["fecha_ini_op"];
    	}
	
	$ano = $fecha_sesion;

	//asigno ppto_aprob = 0  si ano no coincide con fecha_ini op
  if($ano == $fecha_ini_op)
   {
      $ppto_aprob=$_POST['ppto_aprob'];   
   }
   else
   {
     
	  $ppto_aprob='0';   
   }
	///-------------------
	

   
   $id_emp=$_POST['id_emp']; 
   $cod_pptal=$_POST['cod_pptal'];    
   $nom_rubro=$_POST['nom_rubro'];    
   $tip_dato=$_POST['selecprod']; 
   //convierto a minusculas el nombre de las cuentas tipo DETALLE
   if($tip_dato == 'M')
   {
    
   }
   else
   {
     $nom_rubro = strtolower($nom_rubro);
   }
   
   $proc_rec=$_POST['proc_rec']; 
   $situacion=$_POST['situacion'];   
   $afectado='0';   
   
$consultax=mysql_query("select * from vf ",$connection);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 

if($ano > $bx or $ano < $ax)
{
printf("<center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual</center>");
}
else
{   
   
//---------------------------- saco el id de la empresa ----------------------------
   $connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	    while($rowxx = mysql_fetch_array($resultadoxx)) 
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
   
   
   $sql = "update tmp_cod_pptal set cod='$cod_pptal'";
   $resultado = mysql_db_query($database, $sql, $connection);
   
   $ingreso = substr($cod_pptal,0,1);
   
   if($ingreso >= 10 )
   {
   		echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar NO ES DE INGRESOS<br><br>
			<a href='carga_ppto_ing.php'>Volver</a></center>";
   }
   elseif ($ingreso == 0 || $ingreso == 1 || $ingreso == 2 || $ingreso == 3)
   {
		
		$cadena = $cod_pptal;
   		$longitud = strlen($cadena);
    	printf("<center class='Estilo4'><B>ANALISIS DE LOS DATOS INGRESADOS POR EL USUARIO</B><BR><br>
	        Codigo presupuestal = %s",$cadena);

   	switch ($longitud)
   	 {
         	  
	     case (0):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      //break;
	  //---------------------
	     case (1):
      $tipo = 1;
      $codigo = $cadena;
	  $padre = substr($codigo,0,$tipo);
	  $nivel = 1;
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  
	  //----------------------------------------------------------------------------------
      // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from car_ppto_ing where cod_pptal='$codigo' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());
		if (mysql_num_rows($result) == 0)
		{
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO car_ppto_ing ( ano , id_emp , padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , 
			proc_rec , situacion, afectado, pac, definitivo ) VALUES ( '$ano', '$id_emp', '', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel', 
			'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			mysql_query($sql, $connection) or die(mysql_error());
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br>
			<br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
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
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  
	  //----------------------------------------------------------------------------------
      // ------------------- verificar que el cod pptal no existe en la empresa actual --
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
			//------ verifico que exista el padre ---

          $sql1 = "select * from car_ppto_ing where cod_pptal= '$padre' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());

			if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
			else
			{

			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO car_ppto_ing ( ano , id_emp , padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , 
			proc_rec , situacion, afectado, pac, definitivo ) VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato',
			'$nivel', '$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			mysql_query($sql, $connection) or die(mysql_error());
			
			}   
		 
		 }   
					
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br>
			<br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		}
		    
      //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '1' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '1' 
			AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

			//------------------------------------------------------
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); 

	  }
	  
	  break;
	  //---------------------
	     case (3):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      //break;
	  //---------------------
	     case (4):
      $tipo = 2;
	  $codigo = $cadena;
	  $nivel = 3;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c2' and nivel = '2' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
			if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL DE 3ER NIVEL-----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		}
	   
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre='$padre' AND nivel=$nivel 
			AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE cod_pptal = '$c2' AND 
			nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '1' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '1' 
			AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
      }
		
      break;
	  //---------------------
	     case (5):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break;
	  //---------------------
	     case (6):
      $tipo = 4;
	  $codigo = $cadena;
	  $nivel = 4;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c3' and nivel = '3' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre='$padre' AND nivel=$nivel AND 
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' WHERE cod_pptal = '$c3' AND nivel = 
			'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '1' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '1' 
			AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
      break;
	  //---------------------
	     case (7):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>"; 
      //break;
	  //---------------------
	     case (8):
      $tipo = 6;
	  $codigo = $cadena;
	  $nivel = 5;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c4' and nivel = '4' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
      	  
	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre='$padre' AND nivel=$nivel AND 
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' WHERE cod_pptal = '$c4' AND nivel = 
			'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre='$c3' AND nivel=$niv4 AND 
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' WHERE cod_pptal = '$c3' AND nivel = 
			'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '1' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '1' 
			AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
      break;
	  //---------------------
	     case (9):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      //break;
	  //---------------------
	     case (10):
      $tipo = 8;
	  $codigo = $cadena;
	  $nivel = 6;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c5' and nivel = '5' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
	    
      break;
	  //---------------------
	     case (11):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break;
	  //---------------------
	     case (12):
      $tipo = 10;
	  $codigo = $cadena;
	  $nivel = 7;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c6' and nivel = '6' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
      break;
	  //---------------------
	     case (13):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      //break;
	  //---------------------
	     case (14):
      $tipo = 12;
	  $codigo = $cadena;
	  $nivel = 8;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c7' and nivel = '7' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
      	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
      break;
	  //---------------------
	     case (15):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break;
	  //---------------------
	     case (16):
      $tipo = 14;
	  $codigo = $cadena;
	  $nivel = 9;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c8' and nivel = '8' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	        	  
	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
      break;
	  //---------------------
	     case (17):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break;
	  //---------------------	
	     case (18):
      $tipo = 16;
	  $codigo = $cadena;
	  $nivel = 10;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c9' and nivel = '9' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
      break;
	  //---------------------
	     case (19):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break;
	  //---------------------
	     case (20):
      $tipo = 18;
	  $codigo = $cadena;
	  $nivel = 11;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
      
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c10' and nivel = '10' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }
	  
      break;
	  //---------------------
	     case (21):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break; 
	  //---------------------
	  	 case (22):
      $tipo = 20;
	  $codigo = $cadena;
	  $nivel = 12;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);

	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c11' and nivel = '11' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  	  

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }	  
	  
	  
     break;  
      //---------------------
	     case (23):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
    //  break; 
	  //---------------------
	  	 case (24):
      $tipo = 22;
	  $codigo = $cadena;
	  $nivel = 13;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c12' and nivel = '12' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }	 	  
	  
     break;  
      //---------------------	
	     case (25):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
    //  break; 
	  //---------------------
	  	 case (26):
      $tipo = 24;
	  $codigo = $cadena;
	  $nivel = 14;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c13' and nivel = '13' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 14 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 13 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c13' AND nivel = '$niv13' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	 
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c12' AND nivel=$niv13 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }	 		  
	  
     break;  
      //---------------------		  
	     case (27):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
      //break; 
	  //---------------------
	  	 case (28):
      $tipo = 26;
	  $codigo = $cadena;
	  $nivel = 15;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c14' and nivel = '14' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 15 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 14 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c14' AND nivel = '$niv14' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 14 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c13' AND nivel=$niv14 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 13 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c13' AND nivel = '$niv13' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	 
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c12' AND nivel=$niv13 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }	 	  
	  
     break;  
      //---------------------	
	     case (29):
      $error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$cadena. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion</center>";
     // break; 
	  //---------------------
	  	 case (30):
      $tipo = 28;
	  $codigo = $cadena;
	  $nivel = 16;
	  $padre = substr($cadena,0,$tipo);
	  printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s',$padre,$nivel);
	  
	  // consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
	  $consulta=mysql_query("select tip_dato from car_ppto_ing where cod_pptal ='$padre' and id_emp ='$idxx'",$connection);
      while($row = mysql_fetch_array($consulta)) 
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
	  { // igual
	  
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
   		$sql = "select * from car_ppto_ing where cod_pptal='$cod_pptal' and id_emp='$idxx'";
		$result = mysql_query($sql, $connection) or die(mysql_error());

		if (mysql_num_rows($result) == 0)
		{
		   
		   //------ verifico que exista el padre ---
          $sql1 = "select * from car_ppto_ing where cod_pptal = '$c15' and nivel = '15' and id_emp='$idxx'";
		  $result1 = mysql_query($sql1, $connection) or die(mysql_error());
		  
		  if (mysql_num_rows($result1) > 1)
			{
				echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA<br><br>
				<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
				
			}
		    else
		   {
		    
			//--------- INSERCION DEL NUEVO COD_PPTAL -----
			
			$sql = "INSERT INTO 
			        car_ppto_ing ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob')";
			        mysql_query($sql, $connection) or die(mysql_error());
					
					
			}	
		}
		else 
		{
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_ing.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
		} // aumentar el codigo al comparar padres
       
	  
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 16 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 15 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c15' AND nivel = '$niv15' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 15 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c14' AND nivel=$niv15 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 14 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c14' AND nivel = '$niv14' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 14 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c13' AND nivel=$niv14 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 13 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c13' AND nivel = '$niv13' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	 
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c12' AND nivel=$niv13 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
			$sqlB = "UPDATE car_ppto_ing SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());

	  //---------------------------------------------------	  
	  //--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
            $sqlB = "UPDATE car_ppto_ing SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			 //-----------------------------------------------------------		
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '1' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '1'	AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error());
			
			//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
			$link=mysql_connect($server,$dbuser,$dbpass);
			$resulta=mysql_query("select SUM(definitivo) AS TOTAL from car_ppto_ing 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'",$link)or die(mysql_error());
			$row=mysql_fetch_row($resulta);
			$total=$row[0]; 
			$nuevo_total = $total;
			//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
            $sqlB = "UPDATE car_ppto_ing SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
			mysql_query($sqlB, $connection) or die(mysql_error()); // cambiar
			
	  }	 	
	  
     break;  
      //---------------------		  	    
     default:
      $error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion</center>"; 
 
   	 }
    	// printf("%s <br><br></center>",$error); 

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
<?
}
?><title>CONTAFACIL</title>
<body onload = "document.forms[0]['a'].focus()">
		 <center>
		 <form name="a" action="carga_ppto_ing.php">
		 <input name="a" type="submit" class="Estilo4" value="Volver"/>
		 </form>
		 </center>
</body>