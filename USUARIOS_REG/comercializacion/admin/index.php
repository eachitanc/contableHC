<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
session_start();
// Verifico permisos del sistema
if ($_SESSION["rool"] =="SI") 
{
// Realizo la conexion con la base de datos
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

//
if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
// Datos generales
$sq1 ="select * from datos_resguardo";
$rs1 = mysql_query($sq1);
$fi1 = mysql_num_rows($rs1);
// Usuarios del sistema
$sq2 ="select * from usuarios";
$rs2 = mysql_query($sq2);
$fi2 = mysql_num_rows($rs2);
// Encuestadores registrados
$sq3 ="select * from encuestadores";
$rs3 = mysql_query($sq3);
$fi3 = mysql_num_rows($rs3);
// eps
$sq4 ="select * from eps";
$rs4 = mysql_query($sq4);
$fi4 = mysql_num_rows($rs4);
// is
$sq5 ="select * from instituciones";
$rs5 = mysql_query($sq5);
$fi5 = mysql_num_rows($rs5);
// partidos
$sq6 ="select * from politica";
$rs6 = mysql_query($sq6);
$fi6 = mysql_num_rows($rs6);

?>
<br />
<br />

<table width='50%'   class='punteado'  cellpadding='3' cellspacing='5' border='0' align="center"> 
    <tr>
    	<td width='10%' align='center'></td>
        <td width='70%' align='left'><a href="#" onclick="cargaArchivo('admin/datos/reporte.php','contenido')">Datos generales del Resguardo y/o Cabildo</a></td>
        <td width="20%" align="left"><?php echo $fi1; ?></td>
    </tr>
    <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('admin/usuarios/reporte.php','contenido')">Usuarios del sistema</a></td>
        <td align="left"><?php echo $fi2-1; ?></td>
    </tr>
    <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('admin/encuestadores/reporte.php','contenido')">Registro encuestadores</a></td>
         <td align="left"><?php echo $fi3; ?></td>
    </tr>
    <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('admin/eps/reporte.php','contenido')">Configuraci&oacute;n EPS's</a></td>
         <td align="left"><?php echo $fi4; ?></td>
    </tr>
    <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('admin/ie/reporte.php','contenido')">Configuraci&oacute;n Instituciones Educativas</a></td>
         <td align="left"><?php echo $fi5; ?></td>
    </tr>
    <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('admin/politica/reporte.php','contenido')">Configuraci&oacute;n Partidos pol&iacute;ticos</a></td>
         <td align="left"><?php echo $fi6; ?></td>
    </tr>
        <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('admin/actualizar/base_tablas.php','mjs')">Actualizar base de datos</a></td>
         <td align="left"></td>
    </tr>
        </tr>
        <tr>
    	<td align='center'></td>
        <td align='left'><a href="#" onclick="cargaArchivo('inicio.php','contenido')">Cerrar</a></td>
         <td align="left"></td>
    </tr>



<div id="mjs"></div>
<?php
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Admiistrador...');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>

