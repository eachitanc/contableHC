<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
//$reten = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from pgcp order by cod_pptal asc";
	$res = $cx->query($sql);
	$num=$res->num_rows;
	
	////////////////////
		
      /* echo "<table >";  
       $columnes = 2; # numero de columnas  
       if (($rows=$res->num_rows)==0) 
        {    
           echo " no hay nada"; 
        }  
       
        for ($i=1; $row = mysql_fetch_row ($res); $i++)  
        {  
            $resto = ($i % $columnes); # N&uacute;mero de celda del <tr> en que nos encontramos  
            if ($resto == 1)  
            {     
                    echo "<tr>"; 
            }     # Si es la primera celda, abrimos <tr>                      
                    //$nom="select img from productos where tipo ='$row[0]'";                     
            echo "<td><strong>$row[0]</strong></td>"; 
            echo "<td><strong>$row[1]</strong></td>";                                                                             
                    echo "</tr>";             
            if ($resto == 0)  
            {                     
            } # Si es la &uacute;ltima celda, cerramos </tr>  
        }  
        if ($resto <> 0)  
        { # Si el resultado no es m&uacute;ltiple de $columnes acabamos de rellenar los huecos  
         	$ajust = $columnes - $resto; # N&uacute;mero de huecos necesarios  
         	for ($j = 0; $j < $ajust; $j++)  
         	{             
         	}  
         	//echo "</tr>"; # se Cierra  la &uacute;ltima l&iacute;nea </tr>  
             
        }  
        echo "</table>";  
        */
          

	
	
	
	//////////////////////
	
	
	
	while ($row = $res->fetch_assoc())
	{	
		//if($valor>=$row[base]&&($valor<=$row[tope]||$row[tope]==''))
			
		$valoret=$row[cod_pptal].' '.$row[nom_rubro];
		echo "$valoret \n";
	}
	//$valort=$valoret*$valor;
	//echo $num;
$cx = null;
?>
