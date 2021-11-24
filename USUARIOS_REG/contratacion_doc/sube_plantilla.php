<?
set_time_limit(600);
//tomo el valor de un elemento de tipo texto del formulario
/*$cadenatexto = $_POST["cadenatexto"];
echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>";*/

//datos del arhivo
$nombre_archivo = $HTTP_POST_FILES['userfile']['name'];
$tipo_archivo = $HTTP_POST_FILES['userfile']['type'];
$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];
if (($nombre_archivo =='C1.rtf') || ($nombre_archivo =='C2.rtf') || ($nombre_archivo =='C3.rtf') || ($nombre_archivo =='C4.rtf') || ($nombre_archivo =='C5.rtf') || ($nombre_archivo =='C6.rtf') || ($nombre_archivo =='C7.rtf') || ($nombre_archivo =='C8.rtf') || ($nombre_archivo =='C9.rtf') || ($nombre_archivo =='C10.rtf') || ($nombre_archivo =='C11.rtf') || ($nombre_archivo =='C12.rtf') || ($nombre_archivo =='C13.rtf') || ($nombre_archivo =='C14.rtf') || ($nombre_archivo =='C15.rtf') || ($nombre_archivo =='C16.rtf') || ($nombre_archivo =='C17.rtf') || ($nombre_archivo =='C18.rtf') || ($nombre_archivo =='C19.rtf') || ($nombre_archivo =='P1.rtf') || ($nombre_archivo =='P2.rtf') || ($nombre_archivo =='P3.rtf') || ($nombre_archivo =='P4.rtf') || ($nombre_archivo =='P5.rtf') || ($nombre_archivo =='P6.rtf') || ($nombre_archivo =='P7.rtf') || ($nombre_archivo =='P8.rtf'))
{ 

//printf("%s<br>%s<br>%s",$nombre_archivo,$tipo_archivo,$tamano_archivo);
//compruebo si las características del archivo son las que deseo
//if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) {
if ((!(strpos($tipo_archivo, "application/msword")) && ($tamano_archivo > 3000000)) ) {
    echo "<center><br>La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Solo se permiten archivos .rtf<br><li>se permiten archivos de 3000 Kb (3Mb) máximo.</td></tr></table></center>";
}else{
    if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_archivo)){
        echo "<center><br><br><img src=\"../homogif.gif\" width=\"160\" height=\"150\" /></center>";
		?>	
			<script type="text/javascript"> 
			alert("El archivo se ha subido correctamente");
			</script>
		<?php
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
}else{
	?>	
		<script type="text/javascript"> 
		alert("El archivo no cumple las especificaciones de nombre - Ver instructivo");
		</script>
	<?php
}
?> 
<script type="text/javascript"> 
window.location="upload.php"; 
</script>

