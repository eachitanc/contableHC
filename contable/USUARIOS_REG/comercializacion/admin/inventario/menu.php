<?php
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	mysql_select_db($database);
?>	
                        <select name="articulo" id="articulo" onchange="consultar3(value);">
                        <option value="" ></option>
						<?php
                        $id = $_GET["id"];
						$sq23 = "SELECT * FROM farm_articulos where bodega = '$id'";
                        $rs23 = mysql_query($sq23);
                        $fi23 = mysql_num_rows($rs23);
                        for ($i=0; $i<$fi23; $i++)
						{
                            $rw23 = mysql_fetch_array($rs23);
							
		                            echo "<OPTION VALUE='$rw23[cod_art]'>$rw23[nombre]</OPTION>";
        				}
						?>
 			</select>

