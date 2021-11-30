<?php
include('../config.php');
header('Content-Type: text/html; charset=latin1');
$letra = $_GET['letra'];
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);
while ($rowxx = $resultadoxx->fetch_assoc()) {
   $id_emp = $rowxx["id_emp"];
   $ano = $rowxx["ano"];
}
$sq = "select * from terceros_naturales where id_emp = '$id_emp' and pri_ape like '$letra%' order by pri_ape asc ";
$re = $cx->query($sq);

printf("<table width='800' BORDER='0'>
<tr>
	<td align='left' colspan='7'> <input class='menu1' type='button' id='menu1' value='Terceros Naturales' style='background:#D6D6D6; color: #FFFFFF; border:none;'/> <input type='button' name='boton5' value='Importar' style='background:#72A0CF; color:#FFFFFF; border:none' onclick=\"window.open('upload_ter.php','_self')\" /> </td>
</tr>
</table><table width='800' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CLASE</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>REGIMEN</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>ENT.OFICIAL</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>NOMBRE COMPLETO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>MUNICIPIO</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>MODIF.</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>BORRAR</b></span></td>
");

while ($rw = $re->fetch_assoc()) {
   $pri_apel = $rw["pri_ape"];
   $seg_apel = $rw["seg_ape"];
   $pri_nomb = $rw["pri_nom"];
   $seg_nomb = $rw["seg_nom"];
   $nom_comp = $pri_apel . " " . $seg_apel . " " . $pri_nomb . " " . $seg_nomb;
   $cadena = $rw["pais"] . $rw["dpto"] . $rw["mpio"];
   $pendiente = strrpos($cadena, "-", 1);
   $dir = $rw["dir"];
   if ($pendiente > 0 or $dir == '') {
      $fondo = "bgcolor='#ffff66'";
   } else {
      $fondo = '';
   }
   printf(
      "
<span class='Estilo4'>
<tr>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left' $fondo><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'><a href=\"modifica_tercero_natural.php?id1=%s\"> Modif </a></span></td>
<td align='center'><span class='Estilo4'><a href=\"borra_tercero_natural.php?id2=%s\"> Borrar </a></span></td>


</tr>",
      $rw["clase"],
      $rw["regimen"],
      $rw["ent_ofi"],
      $nom_comp,
      $rw["mpio"],
      $rw["id"],
      $rw["id"]
   );
}

printf("</table><br><br>");
//--------	------------------------------------------------------
$sq2 = "select * from terceros_juridicos where id_emp = '$id_emp' and raz_soc2 like'$letra%' order by raz_soc2 asc  ";
$re2 = $cx->query($sq2);
printf("
<table width='800' BORDER='0'>
<tr>
	<td align='left' colspan='7'> <input class='menu1' type='button' id='menu1' value='Terceros Juridicos' style='background:#D6D6D6; color: #FFFFFF; border:none;'/>  </td>
</tr>
</table>
");
printf("
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CLASE</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>REGIMEN</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>ENT.OFICIAL</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>RAZON SOCIAL</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>MUNICIPIO</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>MODIF.</b></span></td>
<td align='center' width='50'><span class='Estilo4'><b>BORRAR</b></span></td>
");

while ($rw2 = $re2->fetch_assoc()) {
   $cadena2 = $rw2["pais2"] . $rw2["dpto2"] . $rw2["mpio2"];
   $pendiente2 = strrpos($cadena2, "-", 1);
   $dir2 = $rw2["dir2"];
   if ($pendiente2 > 0 or $dir2 == '') {
      $fondo2 = "bgcolor='#ffff66'";
   } else {
      $fondo2 = '';
   }
   printf(
      "
<span class='Estilo4'>
<tr>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left' $fondo2><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'><a href=\"modifica_tercero_juridico.php?id1=%s\"> Modif </a></span></td>
<td align='center'><span class='Estilo4'><a href=\"borra_tercero_juridico.php?id2=%s\"> Borrar </a></span></td>


</tr>",
      $rw2["clase2"],
      $rw2["regimen2"],
      $rw2["ent_ofi2"],
      $rw2["raz_soc2"],
      $rw2["mpio2"],
      $rw2["id"],
      $rw2["id"]
   );
}
printf("</table></center>");
