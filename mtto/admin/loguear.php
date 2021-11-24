<?php
session_start();
global $server, $database, $dbpass, $dbuser, $res;
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include '../config.php';
$cx= new mysqli ($server, $dbuser, $dbpass, $database);
$user = $_GET['usuario'];
$pass = $_GET['pass'];
$passm =sha1(md5(trim($pass)));
if($cx->connect_errno)
{ 
	echo "no conectado..";
	exit;

}else{ 
	$sql="select * from usuarios where usuario = '$user' and pass = '$pass' ";
	$res =$cx->query($sql);
	$row =$res->fetch_assoc();
	$fil =$res->num_rows;
	if ($fil >0)
		{
			$_SESSION["id"]=$row['id'];
			echo "<script>cargaArchivo('menu/menu_act.php?id=$row[tipo_user]','menu_nav');
				 cargaArchivo('menu/menu_ver.php?id=$row[tipo_user]','menu_vert');
				 document.getElementById('login').reset();
				cerrarLogin('formLogin');	
			</script>";
		// Si las credenciales no son scorrectas 
		}else{
			echo "<script>
					alert('El usuario no esta registrado en el sistema... ');
					mostrarLogin('formLogin');
				</script>";
			//echo "<script>cargaArchivo('inicio.php?id=$row[id]','proceso');</script>";
			session_unset();
		}
	$res->free();
}
$cx->close();

?>
