//**** borro tabla por si las moscas

$tabla6="lib_aux";
$anadir6="DROP TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};	

///**** creo la tabla

		$tabla7="lib_aux";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `fecha` varchar(200) NOT NULL default '',
  `dcto` varchar(200) NOT NULL default '',
  `cuenta` varchar(200) NOT NULL default '',
  `nombre` varchar(200) NOT NULL default '',
  `detalle` varchar(200) NOT NULL default '',
  `tercero` varchar(200) NOT NULL default '',
  `debito` decimal(20,2) NOT NULL default '0.00',
  `credito` decimal(20,2) NOT NULL default '0.00'
)TYPE=MyISAM AUTO_INCREMENT=1 ";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		//echo "listo";
		}
		else
		{
		//echo "no se pudo";
		}
		

//********** seccion de consulta de cuentas pgcp para llenado de tabla nueva

//***	conta_cesp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_cesp where id_emp = '$id_emp'";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	

//***	cartera_cont
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cartera_cont where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_causa"];
						$dcto=$rw["consec_cartera"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["ref"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	cecp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cecp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_cecp"];
						$dcto=$rw["id_manu_cecp"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["concepto_pago"];
						$tercero=$rw["nt"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	ceva
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from ceva where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ceva"];
						$dcto=$rw["id_manu_ceva"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ceva"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while				
//***	cobp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_cobp"];
						$dcto=$rw["id_manu_cobp"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_cobp"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	conta_ncon
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_ncon where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	conta_ncsp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_ncsp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	conta_ndsp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_ndsp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	conta_tfin
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_tfin where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while


//***	conta_coba
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from conta_coba where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<51;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_ncon"];
						$dcto=$rw["id_manu_ncon"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_ncon"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	

		
//***	crpp
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from crpp where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_crpp"];
						$dcto=$rw["id_manu_crpp"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["detalle_crpp"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	obcg
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from obcg where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_obcg"];
						$dcto=$rw["id_manu_obcg"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_cobp"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	recaudo_ncbt
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_ncbt where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_ncbt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	recaudo_rcgt
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_rcgt where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_rcgt"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
//***	recaudo_roit
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_roit where id_emp = '$id_emp'";
$re = $cx->query($sq);

while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_roit"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while		
//***	recaudo_tnat
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_tnat where id_emp = '$id_emp'";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{

		for($i=1;$i<16;$i++)
			{
				if($rw["pgcp".$i] == '' and $rw["vr_deb_".$i] == 0.00 and $rw["vr_cre_".$i] == 0.00 )
				 {
				 }
				else
				{	 
					$cod=$rw["pgcp".$i];
					$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
					$rr2 = mysql_db_query($database, $ss2, $connectionxx);
					while($rrw2 = mysql_fetch_array($rr2)) 
					{
					  $nom_rubro2=$rrw2["nom_rubro"];
					}
						$fecha=$rw["fecha_recaudo"];
						$dcto=$rw["id_manu_tnat"];
						$cuenta=$rw["pgcp".$i];
						$nombre=$nom_rubro2;
						$detalle=$rw["des_recaudo"];
						$tercero=$rw["tercero"];
						$debito=$rw["vr_deb_".$i];
						$credito=$rw["vr_cre_".$i];
						
						$sql_ok = "INSERT INTO lib_aux 
						(fecha,dcto,cuenta,nombre,detalle,tercero,debito,credito) 
						VALUES 
						('$fecha','$dcto','$cuenta','$nombre','$detalle','$tercero','$debito','$credito')";
						mysql_query($sql_ok, $connectionxx) or die(mysql_error());
				}
 		  }//fin for
}//fin while	
	
