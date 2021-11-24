<?
set_time_limit(1200);
//tomo el valor de un elemento de tipo texto del formulario
/*$cadenatexto = $_POST["cadenatexto"];
echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>";*/
//datos del arhivo
$nombre_archivo = $HTTP_POST_FILES['userfile']['name'];
$tipo_archivo = $HTTP_POST_FILES['userfile']['type'];
$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];
//printf("%s<br>%s<br>%s",$nombre_archivo,$tipo_archivo,$tamano_archivo);
//compruebo si las características del archivo son las que deseo
//if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) {
if ((!(strpos($tipo_archivo, "vnd.ms-excel")) && ($tamano_archivo < 1000000))) {
    echo "<center><br>La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .csv<br><li>se permiten archivos de 1000 Kb (1Mb) máximo.</td></tr></table></center>";
}else{
    if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_archivo)){
       echo "<center><br><br><img src=\"../homogif.gif\" width=\"160\" height=\"150\" /></center>";
    }else{
       echo "<center><br><br>Ocurrió algún error al subir el fichero. No pudo guardarse.</center>";
	   	   ?>
	     <script language="javascript"> 
        setTimeout("url()",3000); 
        function url() 
        { 
        window.history.back(); 
        } 
    </script> 
	   <?
    }
}
?> 
<script type="text/javascript"> 
window.location="carga_archivo_ejec_cgr.php"; 
</script>

