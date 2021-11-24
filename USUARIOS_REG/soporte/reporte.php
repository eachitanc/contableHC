<?php 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

$sql= "select id,fecha_crpp,id_manu_crpp,tercero,sum(vr_digitado),ter_nat,ter_jur from crpp group by id_auto_crpp order by fecha_crpp,id_manu_crpp asc";
$rs = mysql_query($sql,$cx) or die("Problemas al ejecutar consulta");
?>
<body id="dt_example">
<div id="container">
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >
	<thead>
		<tr bgcolor="#E7E7E7">
			<th>Fecha</th>
			<th>No CRPP</th>
			<th>Documento</th>
			<th>Tercero</th>
			<th>Valor</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Fecha CRPP</th>
			<th>No CRPP</th>
			<th>Documento</th>
			<th>Tercero</th>
			<th>Valor</th>
		</tr>
	</tfoot>
	<tbody>
   <?php
   
   	while ($datos = mysql_fetch_array($rs))
	{
					$ter=$datos['ter_nat']; 
					$terj=$datos['ter_jur'];
					$sqx1 = "select num_id from terceros_naturales where id ='$ter'";
					$resx1 = mysql_db_query($database, $sqx1, $cx);
					$rowx1 =mysql_fetch_array($resx1); 
					$num_reg = mysql_num_rows($resx1); 
					if ($num_reg >0)
					{
						$documento =$rowx1['num_id']; 
					}
					else
					{
						$sqx2 = "select num_id2 from terceros_juridicos where id ='$terj' ";
						$resx2 = mysql_db_query($database, $sqx2, $cx);
						$rowx2 =mysql_fetch_array($resx2); 
						$documento =$rowx2['num_id2'];
					}
		?>
        
		<tr class="odd_gradeX" id="opener" onClick="cargaArchivo('formulario.php?id=<?php echo $datos['id']; ?>','contenido')" >
			<td  class="read_only"><?php echo $datos['fecha_crpp']; ?></td>
			<td><?php echo $datos['id_manu_crpp']; ?></td>
			<td align="right"><?php echo $documento; ?></td>
			<td><?php echo $datos['tercero']; ?></td>
			<td align="right"><?php echo number_format($datos['sum(vr_digitado)'],2,',','.'); ?></td>
		</tr>
     	<?php
	}
	?>
	</tbody>
</table>

