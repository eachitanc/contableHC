<?
set_time_limit(600);
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
include('../config.php');
$db = mysql_connect($server,$dbuser,$dbpass) or die("Could not connect.");
if(!$db) 
	die("no db");
if(!mysql_select_db($database,$db))
 	die("No database selected.");
     $filename=$nombre_archivo; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {
		 if ($data[0] =='D')
		 {
			   	   $import="INSERT INTO cgr_gastos_acumula(
				    ctrl, cod_cgr, vig_gasto, cod_rec,oer, cda, finalidad_gasto, ppto_aprob, sum_adiciones, sum_reducciones, cancelaciones, sum_creditos, sum_contracreditos, sum_aplazamientos, definitivo,suma_cdpp,reversion_cdpp)
					values ('$data[0]','$data[1]','$data[2]', '$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]', '$data[14]','$data[15]','$data[16]')";
				    mysql_query($import,$db) or die(mysql_error());
		   }
     }
    fclose($handle);
?> 

