<?php 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

$sql= "(select num_id as num, CONCAT(pri_ape,' ',seg_ape,' ',pri_nom,' ',seg_nom) as nom from terceros_naturales order by pri_ape asc) union (select num_id2 as num, raz_soc2 as nom from terceros_juridicos);";
$rs = mysql_query($sql,$cx) or die("Problemas al ejecutar consulta");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=latin1" />
<title>GCP - CONTRATACION</title>


<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				$('#example').dataTable().columnFilter();
			} );
</script>

</head>
<body
<div id="container">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="95%" >
	<thead>
		<tr bgcolor="#E7E7E7">
			<th>Nombre</th>
			<th>Tercero</th>
            <th>Certificaciones</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Fecha CRPP</th>
			<th >No CRPP</th>
            
		</tr>
	</tfoot>
	<tbody>
   <?php
   
   	while ($datos = mysql_fetch_array($rs))
	{
			$link ="formulario.php?id=$datos[id]";	
		?>
        
		<tr class="odd_gradeX" id="opener" onclick="window.open ('word.php?var=<?php echo $datos['num']; ?>')" style="cursor:pointer">
			<td  class="read_only"><?php echo $datos['num']; ?></td>
			<td ><?php echo $datos['nom']; ?></a></td>
            <td align="center">Action&nbsp;</td>
		</tr>
     	<?php
	}
	?>
	</tbody>
</table>
</div>
</body>
</html>
