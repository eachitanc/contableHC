<?
session_start();
//header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// Recibo variables del formulario
		$id=$_GET['id']; 
		$id_crpp=$_GET['id_crpp'];
		$ccostos=$_GET['centros'];
		$ccostos = explode("-", $ccostos);
		$ccostos = $ccostos[0];
		$valor=$_GET['valor'];
    	$log = date("Y/m/d H:i:s");
		$log .= " ".$_SESSION['login']; 
		
        $id='';
		// Valido para ingresar nuevo registro o editar
		if ($id =='')
		{
		// Para determinar el consecutivo ionterno
		/*$sq8= "SHOW TABLE STATUS FROM $database LIKE 'comprobante'";
					$rs8 = mysql_query($sq8,$cx);
					while($rw8 = mysql_fetch_array($rs8)) 
					{
					$id_auto_doc = $rw8[Auto_increment];
					} 
		*/
                    // Inserta articulo en listado
        $log .=" [IN]";
		$sql4 ="insert into cc_obcg (id_doc,id_cc,valor,log) values( '$id_crpp','$ccostos','$valor','$log')";
        echo $sql4;
        $rel4 = mysql_query($sql4);	
       
		}else{
		$log .=" [ED]";
		$sq5="UPDATE cc_obcg SET 
				`emp` = '$emp',
				`tipo_doc` = '$tipo_doc',
				`id_manu_doc` = '$id_manu_doc',
				`fecha` = '$fecha',
				`tercero` = '$tercero',
				`concepto` = '$concepto',
				`valor` = '$valor',
				`log` = '$log'
				WHERE `id` ='$id' ;
				";	
		$re5 = mysql_query($sq5);	
		}
// editar los campos comunes de libors auxiliares
// Archivo a mostar desùes de guardar
		echo "<script>cargaArchivo('cc.php?id=$id_crpp','mostrar');</script>	";	
?>
