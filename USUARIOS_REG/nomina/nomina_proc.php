<?php
include('../config.php');
$cx =mysql_connect($server,$dbuser,$dbpass) or die ("Fallo en la Conexion a la Base de Datos");

$filas = $_POST['filas'];
$i=0;
for ($i=1;$i<=$filas;$i++)
{
	//llega id obcg como campo de control
		$id_auto_crpp = $_POST['id_'.$i];
		// obtenr el id_auto del ceva
					$sq6= "SHOW TABLE STATUS FROM $database LIKE 'cobp'";
					$rs6 = mysql_query($sq6,$cx);
					while($rw6 = mysql_fetch_array($rs6)) 
					{
					$consecutivo = $rw6[Auto_increment];
					}
		//obtener datos del registro desde cobp
		$sql ="select * from crpp where id_auto_crpp = '$id_auto_crpp'";
		$rs1 =mysql_query($sql,$cx);
		$rw1 =mysql_fetch_array($rs1);
		// consulto los datos de la disponibilidad
		$sq2="select consecutivo,cdpp,fecha_reg,des from cdpp where consecutivo ='$rw1[id_auto_cdpp]'";
		$rs2=mysql_query($sq2,$cx);
		$rw2=mysql_fetch_array($rs2);
		// datos para guardar
		$periodo =$_POST['mes'];
		$fecha =$_POST['fecha'];
		$cedula =$_POST['cedula_'.$i];
		$salario =str_replace(',','', $_POST['suel_'.$i]);
		$gastos_rep =str_replace(',','', $_POST['rep_'.$i]);
		$sub_trans =str_replace(',','', $_POST['trans_'.$i]);
		$sub_alimen =str_replace(',','', $_POST['alimen_'.$i]);
		$salud =0;
		$pension =0;
		$fondo_pen =0;
		$libranza =0;
		$fondo_sol =0;
		$sindicato =0;
		$embargo =0;
		$otros =0;
		$concepto =$_POST['concepto'];


		
		$sql = "INSERT INTO nomina_plan ( periodo,fecha,cedula,salario,gastos_rep,sub_trans,sub_alimen,salud,pension,fondo_pen,libranza,fondo_sol,sindicato,embargo,otros,concepto
			) VALUES ( 
'$periodo','$fecha','$cedula','$salario','$gastos_rep','$sub_trans','$sub_alimen','$salud','$pension','$fondo_pen','$libranza','$fondo_sol','$sindicato','$embargo','$otros','$concepto'
			)";
mysql_query($sql, $cx) or die(mysql_error());
$salario =0;
$gastos_rep =0;
$sub_trans =0;
$sub_alimen =0;
$salud =0;
$pension =0;
$fondo_pen =0;
$libranza =0;
$fondo_sol =0;
$sindicato =0;
$embargo =0;
$otros =0;

}

?>
<br />
<center>
<table border="0" width="50%">
<tr>
	<td align="center"><a href="imp_nomina.php?ref=<?php echo $ref; ?>" target="_blank"><img src="../simbolos/imprimirblanco.png" border="0" /></a></td>
</tr>
<tr style="color:#03C">
	<td class="Estilo9" align="center">Imprimir Planilla</td>
</tr>


</table>
</center>
<br />


<br />
<br />
<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
      
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='menu_nomina.php?<?php echo $ref; ?>' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
        </div>
</div>
