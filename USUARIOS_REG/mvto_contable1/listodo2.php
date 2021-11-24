<?php
  if(isset($_POST["val"])){
    $conten=$_POST["val"];
    include('../config.php');
    $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
    $sqlxx = "select id_emp from fecha";
    $resultadoxx = mysql_db_query($database, $sqlxx, $conexion);
    $id_emp  = mysql_result($resultadoxx,0,0);
    $sq2 = "select * from obcg where id_emp = '$id_emp' order by fecha_obcg desc;";
    $resultadoxx = mysql_db_query($database, $sq2, $conexion);
    printf("
<center>
<table width='1000' BORDER='1' class='bordepunteado1'>
<thead>
<tr bgcolor='#DCE9E5'>
<th align='center' colspan=9>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>TODAS</b></span>
</div>
</th>
<tr bgcolor='#DCE9E5'>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>OBCG</b></span>
</div>
</th>

<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>X VALOR DE</b></span></th>
<th align='center'><span class='Estilo4'><b>EDAD</b></span></th>
<th align='center'><span class='Estilo4'><b>ESTADO</b></span></th>

<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b>
");

while($rw2 = mysql_fetch_array($resultadoxx))
   {
$idmanuobcg=$rw2["id_manu_obcg"]; 
$td=$rw2["tot_deb"]; 
$tc=$rw2["tot_cre"]; 
$startDate = $rw2["fecha_obcg"];

$vara2=$rw2["id_auto_cobp"]; 
$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp where id_emp = '$id_emp' and id_auto_cobp ='$vara2'",$conexion) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=0;
if(isset($row[0])){$total=$row[0];}
//*************** edad
 $startDate = $rw2["fecha_obcg"];
 $endDate = date("Y/m/d");
 list($year, $month, $day) = explode('/', $startDate);  
 $startDate = mktime(0, 0, 0, $month, $day, $year);  
 list($year, $month, $day) = explode('/', $endDate);  
 $endDate = mktime(0, 0, 0, $month, $day, $year);  
 $totalDays = ($endDate - $startDate)/(60 * 60 * 24);  
//*****************

printf("
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='right'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
", $rw2["id_manu_obcg"], $rw2["fecha_obcg"], $rw2["tercero"], number_format($total,2,',','.'), number_format($totalDays,0,',','.').' Dias');

if($td == '0' && $tc == '0')
{
printf("
<td align='center' bgcolor ='#990000'><span class='Estilo4' style='color:#FFFF00'>NO</span></td>
");
}
else
{
printf("
<td align='center'><span class='Estilo4'>SI</span></td>
");
}

printf("
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_obcg.php?id2=%s\" ><img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modifica_obcg.php?id1=%s\" ><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_obcg.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir OBCG'></a>
</span>
</div>
</td>

</tr>", $rw2["id_auto_obcg"], $rw2["id_auto_obcg"], $rw2["id_auto_obcg"]); 
 }
    @mysql_close();
  }
?>

