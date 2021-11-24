<?
session_start(listas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="css/estilos2.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>	
<script type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type="text/javascript" src="../js/carga.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<style>
#divCargando
{
	position:absolute;
	top:5px;
	right:5px;
	background-color: red;
	color: white;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	padding:5px;
}

.punteado{ 
   border-style:hidden;
   border-width: 0px; 
   border-color: 660033; 
   background-color: cc3366; 
   font-family:Arial, Helvetica, sans-serif; 
   font-size: 10pt; 
} 

</style>
</head>
<body>
<div id="divCargando" style="display:none">
	Por favor espere...
</div>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
<br />
</div>
		<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		 	<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='index.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>
		</div>
 <br />
<div id="mainContent" align="center"><?php include('perfiles_reporte.php'); ?></div>
</body>
</html>