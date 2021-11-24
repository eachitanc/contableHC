<?php
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
?>	
                        <select name="pedido" id="pedido" onchange="consultar4(value);">
                        <option value="" ></option>
						<?php
                        $id = $_GET["id"];
						$sq24 = "SELECT * FROM farm_pedido where tip_art = '$id'  ";
                        $rs24 = mysql_query($sq24);
                        $fi24 = mysql_num_rows($rs24);
                        if($fi24 > 0 )
						{
					    for ($i=0; $i<$fi24; $i++)
						{
                            $rw24 = mysql_fetch_array($rs24);
							
		                            echo "<OPTION VALUE='$rw24[pedido]'>$rw24[pedido] $fi24</OPTION>";
        				}
						}else{
						   echo "<OPTION VALUE=''>Sin pedido</OPTION>";
						}
						?>
                        
 			</select>

