<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Basic Example</title>
       	<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/themes/base/jquery-ui.css";
			@import "media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>
        <script src="media/js/jquery.js" type="text/javascript"></script>
		<script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>



		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				$('#example').dataTable().columnFilter();
			} );
			
			// Abrir formulario modal
			
		
			function cambiaColor(id)
			{
				document.body.style.cursor = "pointer"; 
			}
			
			function fueraPuntero(id)
			{
				document.body.style.cursor = "default"; 
			}

		</script>
</head>
<body>
<div id="container"> <?php include('reporte.php'); ?> </div>
<br>
</body>
</html>