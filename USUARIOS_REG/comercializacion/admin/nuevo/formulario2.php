<?php 
    session_start();
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
    $sq3="select * from farma_temp where login='$_SESSION[user]'";
	$re3=mysql_query($sq3,$cx);
	$rw3=mysql_fetch_array($re3);
	$id = $_GET["id"];
	$fecha =date('Y/m/d');
	// si id llega con datos consultar para llenar los campos del formulario
	if($id !='')
	{
		$sq5 = "select * from farm_med where id ='$id'";
		$re5 = mysql_query($sq5,$cx);
		$rw5 = mysql_fetch_array($re5);
		$fecha = $rw5['fecha_alta'];
		// Consulta nombre presentaciòn 
		$sq6 = "select * from farm_forma where id ='$rw5[presentacion]'"; 
		$re6 = mysql_query($sq6,$cx);
		$rw6 = mysql_fetch_array($re6);
		// Consulto laboratorio
		$sq7 = "select * from farm_lab where id ='$rw5[laboratorio]'"; 
		$re7 = mysql_query($sq7,$cx);
		$rw7 = mysql_fetch_array($re7);

		
	}
?>
<div id="tutulo" align="left" >
<form action="" method="post" name="form3" id="form3">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">CREAR NUEVO PRODUCTO</td>
        <td  align="right" id="cerrar" onClick="CierrVentana()" onMouseOver="punteroOn();" onMouseOut="punteroOff();" > X</td>
	</tr>
 </table>

 <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">   
    <tr bgcolor="#F5F5F5">
    	<td align='left'>&nbsp;</td>
    </tr>
 </table> 
   <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">  
     <tr>  
         <td width="15%">Bodega:</td>
         <td width="85%">
         				<select name="bodega2" id="bodega2" onchange="llamaMenu5(value);" >
                        <option value=""></option>
						<?php
                        $sq4 = "SELECT * FROM farm_bodega where usuario ='$_SESSION[id]'";
                        $rs4 = mysql_query($sq4);
                        $fi4 = mysql_num_rows($rs4);
                        for ($i=0; $i<$fi4; $i++) {
                            $rw4 = mysql_fetch_array($rs4);
								if ($rw4['id'] == $rw3['bodega'])
		                            echo "<OPTION VALUE='$rw4[id]' selected>$rw4[nombre]</OPTION>";
        						else 
									echo "<OPTION VALUE='$rw4[id]'>$rw4[nombre]</OPTION>";
		                }
						?>
                       </select><label id="bodega_e" style="color:#F00"></label>
						</td>
     </tr>
     <tr>  
         <td>Tipo Articulo:</td>
         <td id="articulo_llega2"> <select name="tipo_art2" id="tipo_art2" onchange="parametros();" >
                        <option value="" ></option>
						<?php
                       	$sq23 = "SELECT * FROM farm_articulos where bodega = '$rw3[bodega]'";
                        $rs23 = mysql_query($sq23);
                        $fi23 = mysql_num_rows($rs23);
                        for ($i=0; $i<$fi23; $i++)
						{
                            $rw23 = mysql_fetch_array($rs23);
							if ($rw23['cod_art'] == $rw3['producto'])
		                            echo "<OPTION VALUE='$rw23[cod_art]' selected>$rw23[nombre]</OPTION>";
							else
								    echo "<OPTION VALUE='$rw23[cod_art]' >$rw23[nombre]</OPTION>";		
        				}
						?>
                        </select><label id="tipo_art2_e" style="color:#F00"></label>
                        </td>
     </tr>
   	 <tr>  
         <td>Fecha:</td>
         <td><input name="menos" type="button" onClick="sumarfechas(-1,'menu1_fecha_pdo');" value="-" style='background:#E8EEFA;'/>
        <input type="text" name="dir" id="menu1_fecha_pdo" size="12" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);'  /> 
         <input name="mas" type="button" onClick="sumarfechas(1,'menu1_fecha_pdo');" value="+"  style='background:#E8EEFA;'/> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form3.menu1_fecha_pdo,'yyyy/mm/dd',this)" value="Selecionar fecha"  /><label id="menu1_fecha_pdo_e" style="color:#F00"></label></td>
     </tr>
     <tr>
         <td>Producto:</td>
         <td><input type='text' name='nombre2' id='nombre2' size='80' value='<?php echo $rw5['nombre']; ?>' /><label id="nombre2_e" style="color:#F00"></label></td>
     </tr>
     <tr>
         <td>Presentaci&oacute;n:</td>
         <td><input type='text' name='pres' id='pres' size='20' value='<?php echo $rw6['nombre']; ?>' /><input type='hidden' name='cod_pres' id='cod_pres' size='20' value='<?php echo $rw5['presentacion']; ?>' />&nbsp;<i class="fa fa-plus-square" style="font-size:20px;color:#06F;cursor:pointer" aria-hidden="true" title="Nueva presentación" onclick="Presentacion();"></i><label id="pres_e" style="color:#F00"></label></td>
     </tr>
     <tr>
         <td>Laboratorio:</td>
         <td><input type='text' name='lab' id='lab' size='40' value='<?php echo $rw7['lab']; ?>' /><input type='hidden' name='cod_lab' id='cod_lab' size='20' value='<?php echo $rw5['laboratorio']; ?>' />&nbsp;<i class="fa fa-plus-square" style="font-size:20px;color:#06F;cursor:pointer" aria-hidden="true" title="Nuevo Laboratorio" onclick="Laboratorio();"></i><label id="lab_e" style="color:#F00"></label></td>
     </tr>
     <tr>
         <td>No CUM:</td>
         <td><input type='text' name='cum' id='cum' size='15' value='<?php echo $rw5['cum']; ?>' /></td>
     </tr>
      <tr>
         <td>Consecutivo:</td>
         <td><input type='text' name='cons' id='cons' size='3' value='<?php echo $rw5['consecutivo']; ?>' /></td>
     </tr>
     
     <tr height="50" valign="top">  
         <td></td>
       
         <td colspan="2"> <input name="nuevo" id="nuevo2" type="button" class="myButton" value="Guardar" style="background-color:#E8EEFA" onClick="nuevoArt2();"   /></td>
         <td></td>
     </tr>
 </table>
 
</form> 
  </div>
    
