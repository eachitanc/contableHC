<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=latin1" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/carga.js"></script>
	<!-- Formulario emergente -->
	<link rel="stylesheet" href="js/themes/base/jquery.ui.all.css">
	<link rel="stylesheet" href="js/demos.css">
	<script src="js/jquery.js"></script>
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
	<script src="js/ui/jquery.ui.mouse.js"></script>
	<script src="js/ui/jquery.ui.draggable.js"></script>
	<script src="js/ui/jquery.ui.position.js"></script>
	<script src="js/ui/jquery.ui.resizable.js"></script>
	<script src="js/ui/jquery.ui.dialog.js"></script>
	<script src="js/ui/jquery.effects.core.js"></script>

	<!-- Data table -->
	<link rel="stylesheet" href="media/css/demo_page.css">
	<link rel="stylesheet" href="media/css/demo_table.css">
	<script src="media/js/jquery.dataTables.js"></script>
	<script src="media/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
	<!-- Table tool -->
	<link rel="stylesheet" href="media/css/TableTools.css">
	<script type="text/javascript" charset="utf-8" src="media/js/ZeroClipboard.js"></script>
	<script type="text/javascript" charset="utf-8" src="media/js/TableTools.js"></script>
	<script>
		function cambiaColortr(id) {
			document.getElementById(id).style.backgroundColor = '#FFFF00';
		}

		function cambiaColortr2(id) {

			document.getElementById(id).style.backgroundColor = '#ffffff';
		}
	</script>

</head>
<?php include('../../config.php');
// verifico permisos del usuario
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");


?>

<body onload="cargaArchivo('conten.php','contenido');">
	<div id="menu" align="center"></div>
	<div id="contenido"></div>
	<div id="emergente"></div>
</body>

</html>