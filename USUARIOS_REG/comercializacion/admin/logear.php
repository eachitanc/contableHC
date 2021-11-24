<?php
session_start();
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../config.php'); 
$cx=mysql_connect ($server, $dbuser, $dbpass);

$doc = $_POST['usuario'];
$pass = $_POST['pass'];
$passm =sha1(md5(trim($pass)));
$sql="select * from usuarios2 where login = '$doc' and password = '$passm' ";
$res =mysql_query($sql,$cx);
$row =mysql_fetch_array($res);
$fil =mysql_num_rows($res);
if ($fil >0)
	{
		
		$_SESSION["user"]=$row['login'];
		$_SESSION["rool"]=$row['rol'];
		$_SESSION["id"]=$row['id'];
		$nombres =$row['nombre']." ".$row['apaterno'];
		$_SESSION["nombre"]=$nombres;
		// Dependiendo del rol carga un menu especiico
		if ($row['rol'] == 'Regente')
		{
			echo "<script>cargaArchivo('admin/menu/menu_adm.php','menuHoriz');</script>";
			echo "<script>cargaArchivo('admin/inicio.php','contenido');</script>";
		}
		if ($row['rol'] == 'Admin')
		{
			echo "<script>cargaArchivo('admin/menu/menu_adm.php','menuHoriz');</script>";
			echo "<script>cargaArchivo('admin/inicio.php','contenido');</script>";
		}
		if ($row['rol'] == 'Superadmin')
		{
			echo "<script>cargaArchivo('admin/sadmin/menu/menu_adm.php','menuHoriz');</script>";
			echo "<script>cargaArchivo('admin/sadmin/inicio.php','contenido');</script>";
		}

		echo $_SESSION["nombre"];

	}else{
		echo "<script>
				document.getElementById('usuario').value='';
				document.getElementById('pass').value='';
				alert('El usuario no esta registrado en el sistema.. ');
			  </script>";
		session_unset();
	}
$cx = null;
?>
