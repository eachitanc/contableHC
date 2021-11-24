<?php
  if(isset($_POST["val"])){
    $conten=$_POST["val"];
    include('../config.php');
    $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
    $sqlxx = "select id_emp from fecha";
    $resultadoxx = mysql_db_query($database, $sqlxx, $conexion);
    $id_emp  = mysql_result($resultadoxx,0,0);
    $sq2 = "select * from conta_ncon where id_emp = '$id_emp' order by fecha_ncon desc ";
    $resultadoxx = mysql_db_query($database, $sq2, $conexion);
    printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>
<tr bgcolor='#DCE9E5'>
<th align='center' colspan=8>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>HASTA LA FECHA</b></span>
</div>
</th></tr>
<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NCON</b></span>
</div>
</th>
<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>CONCEPTO</b></span></th>
<th><span class='Estilo4'>VALOR</span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
</tr>
</thead>
<tbody>
");

while($rw2 = mysql_fetch_array($resultadoxx))
   {

printf("

<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'> %s</span></td>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_ncon.php?id=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_ncon.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ncon.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir NCON'></a>
</span>
</div>
</td>
</tr>", $rw2["id_manu_ncon"], $rw2["fecha_ncon"], $rw2["tercero"], $rw2["des_ncon"], number_format($rw2["tot_deb"],2,',','.'), $rw2["id_auto_ncon"], $rw2["id_auto_ncon"], $rw2["id_auto_ncon"]);

   }
    printf("</tbody></table></center>");
    @mysql_close();
  }
?>

