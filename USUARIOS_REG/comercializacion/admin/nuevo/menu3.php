<?php
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
?>	
                        <select name="tipo_art2" id="tipo_art2" onchange="parametros();" >
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
 			</select><label id="tipo_art_e" style="color:#F00"></label>

