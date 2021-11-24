<?php
session_start();
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 

		$_SESSION["pais"]=$_POST['pais'];
		$_SESSION["provincia"]=$_POST['provincia'];
		$_SESSION["comunidad"]=$_POST['comunidad'];
		$_SESSION["vigencia"]=$_POST['vigencia'];
		
		// Dependiendo del rol carga un menu especiico
		
			echo "<script>cargaArchivo('user/flujo/menu.php','contenido');</script>";
			// encabezado sesion de usuario
			echo "<script>cargaArchivo('user/inicio/actual.php','Log');</script>";
	
?>
