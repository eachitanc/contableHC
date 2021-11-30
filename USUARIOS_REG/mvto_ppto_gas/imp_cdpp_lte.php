<html>
<head>
<title>CONTAFACIL</title>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }

 @media print {
    .oculto {display:none}
  }


</style>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
<style type="text/css">
<!--
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; }
.Estilo14 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
.Estilo16 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo17 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: }
.Estilo20 {color: #FFFFFF}
.Estilo22 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 16px; color: #333333; font-weight: bold; }
-->

h1.SaltoDePagina
{
page-break-after: always
}

</style>
<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
</head>
<body>
<?php

//printf("%s",$id);
$sqlxx1 = "select * from fecha";
$resultadoxx1 = $connectionxx->query($sqlxx1);

while($rowxx1 = $resultadoxx1->fetch_assoc()) 
{
  $id_emp=$rowxx1["id_emp"];
}


			

$sqlxx = "select * from cdpp where consecutivo ='$id' and id_emp='$id_emp'  order by id desc";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $fecha_recaudo=$rowxx["fecha_reg"];
  $tercero=$rowxx["tercero"];
  $id_unico=$rowxx["id"];
  $des_recaudo=$rowxx["des"];
  $cdpp=$rowxx["cdpp"];
  $fecha_ven=$rowxx["fecha_ven"];
}


$sqlxx2 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx2 = $connectionxx->query($sqlxx2);;

while($rowxx2 = $resultadoxx2->fetch_assoc()) 
{
  $nom_jefe_ppto=$rowxx2["nom_jefe_ppto"];
  $raz_soc=$rowxx2["raz_soc"];
  $crtl_doc=$rowxx2["control_doc"];
  $nit=$rowxx2["nit"];
  $dv=$rowxx2["dv"];
  $cargo_ppto =$rowxx2["cargo_ppto"];
  $genero =$rowxx2["genero"];
  $vencimiento =$rowxx2["vencimiento"];
  $logo =$rowxx2["logo"];
}
$ver ="";
$firmas = "style='display:none'";
$ven = "style='display:none'";
if ($crtl_doc == 'NO') $ver = "style='display:none'";

if ($crtl_doc == 'SI')
{
	$firmas = "style='display:'";
}
if ($vencimiento =='SI') $ven = "style='display:'";
$sqlxx3 = "select * from vf";
$resultadoxx3 = $connectionxx->query($sqlxx3);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
  $fecha_ini=$rowxx3["fecha_ini"];
  $fecha_fin=$rowxx3["fecha_fin"];

}



$vf = substr($fecha_fin,0,4);


$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(valor) AS TOTAL from cdpp WHERE id_emp ='$id_emp' and consecutivo ='$id'",$link) or die (mysql_error());
$row=$resulta->fetch_assoc();
$total=$row[0]; 
$total_cdpp = $total;


?>
<form name="a">
<table width="800" border="1" align="center" class="bordepunteado1" >
  <tr>
    <td width="28%" class="Estilo17"><div align="center"><img src="../images/PLANTILLA PNG PARA LOGO EMPRESA.png" width="200" ><br> <?php echo "NIT: ".$nit."-".$dv; ?></div></td>
    <td width="48%"><div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
      <div align="center" class="Estilo16">
        <h4>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL <span class="Estilo22"> <?php if ($logo =='2') printf("No. %s",$cdpp); ?> </span></h4>
      </div>
    </div></td>
    <td width="24%" class="Estilo22" align="center">
	<?php
	if ($logo=='2')
	     echo "<img src='../images/Logohacienda.jpg' width='170'>";
	else printf("No. %s",$cdpp);
	?>
    
	</td>
  </tr>
  
  <tr>
    <td colspan="3">
    <table width="800" border="0">
      <tr>
        <td><div class="Estilo4" style="padding-left:30px; padding-top:40px; padding-right:5px; padding-bottom:20px;">
          <div align="left"><span class="Estilo16">Fecha de Expedicion :</span> <?php printf("%s",$fecha_recaudo); ?> </div>
        </div></td>
        <td><div class="Estilo4" style="padding-left:30px; padding-top:40px; padding-right:5px; padding-bottom:20px;">
          <div align="right" <?php printf("%s",$ven); ?> ><span class="Estilo16">Fecha de Vencimiento :</span> <?php printf("%s",$fecha_ven); ?> </div>
        </div></td>

      </tr>
      <tr>
        <td colspan="2"><div style="padding-left:10px; padding-top:40px; padding-right:10px; padding-bottom:10px;">
          <div align="center"><span class="Estilo16">EL SUSCRITO <?php printf("%s",$cargo_ppto); ?></span></div>
        </div></td>
        
      </tr>
      <tr>
        <td colspan="2"><div style="padding-left:10px; padding-top:40px; padding-right:10px; padding-bottom:10px;">
          <div align="center"><span class="Estilo22"> CERTIFICA:</span></div>
        </div></td>
      </tr>
      <tr>
<?php
$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(valor) AS TOTAL from cdpp WHERE consecutivo = '$id' AND id_emp='$id_emp' and valor >0",$link) or die (mysql_error());
$row=$resulta->fetch_assoc();
$total=$row[0]; 
$nuevo_total = $total;

?>	  
        <td colspan="2"><div style="padding-left:10px; padding-top:50px; padding-right:10px; padding-bottom:10px;">
          <div align="justify"><span class="Estilo4"> Que en el presupuesto de gastos <?php printf("%s",$genero); ?> <?php printf("%s",$raz_soc); ?>,  aprobado para la Vigencia Fiscal <?php printf("%s",$vf); ?>, existe saldo disponible y libre de afectaci&oacute;n para respaldar un compromiso por valor de ($<?php printf(number_format($nuevo_total,2,',','.')); ?>) <?php 
	$vr=$nuevo_total;
	$num=$vr;
 $V=new EnLetras();
 echo "<font class='Estilo4'>". $V->ValorEnLetras($num,"PESOS") ."</font>";//concatenar propiedades entre comilla doble
	?>
           de conformidad con el siguiente detalle: </span></div>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
          <div align="center" class="Estilo16"><strong>DATOS PRESUPUESTALES</strong></div>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <?php
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cdpp where id_emp = '$id_emp' and consecutivo ='$id'  order by id asc ";
$re = $cx->query($sq);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='225'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'><b>IMPUTACI&Oacute;N</b></span>
</div>
</td>

<td align='center' width='325'><span class='Estilo1'><b>DESCRIPCI&Oacute;N</b></span></td>
<td align='center' width='125'><span class='Estilo1'><b>FTE FINANCIACI&Oacute;N</b></span></td>
<td align='center' width='125'><span class='Estilo1'><b>VALOR</b></span></td>
</tr>
");

while($rw = $re->fetch_assoc()) 
   {
   
$cta = $rw["cuenta"];
						$sq2 = "select proc_rec from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
						$re2 = $cx->query($sq2);   
						$rw2 = $re2->fetch_assoc();
						$fte = $rw2["proc_rec"];  
						if($fte == 'P')
						{
						$fte='PROPIO';
						}
						if($fte == 'A')
						{
						$fte='ADMINISTRADO';
						}
						if($fte == 'R')
						{
						$fte='SGR';
						}
						if($fte == 'S')
						{
						$fte='SGP';
						}
						if($fte == 'C')
						{
						$fte='COLOMBIA HUMANITARIA';
						}
						if($fte == 'O')
						{
						$fte='OTROS RECURSOS';
						}
   
   $xx=$rw["valor"];
   
   if ($rw['liq1']=='SI') $liq = "Valor liquidado";
printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s &nbsp; </span></td>

</tr>

", $rw["cuenta"], $rw["nom_rubro"]." $liq", $fte, number_format($xx,2,',','.')); 


   }

printf("

  <tr>
    <td colspan='4'>&nbsp;</td>
    
  </tr>


  <tr bgcolor='#F5F5F5'>
    <td colspan='2'>&nbsp;</td>
	<td align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>VALOR TOTAL</b> </span>
	</div>
	</td>
    <td align='right'><span class='Estilo4'><b> %s &nbsp;</b> </span></td>
  </tr>
</table></center>",number_format($nuevo_total,2,',','.'));
//--------	
$sq3= "select nombre, apaterno,amaterno,cargo from usuarios2 where login = '$_SESSION[login]'";
$re3 = $cx->query($sq3);
$rw3 =mysql_fetch_array($re3); 
	?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><div style="padding-left:10px; padding-top:80px; padding-right:10px; padding-bottom:30px;">
          <div align="center">______________________________<br>
		  <span class="Estilo16"><?php printf("%s",$nom_jefe_ppto); ?><br></span><span class="Estilo14">
              <?php printf("%s",$cargo_ppto); ?></span></div>
</span></div>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="800" border="1" align="center" class="bordepunteado1" <?php echo $ver; ?>>
  <tr>
    <td width="33%"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>PREPAR&Oacute;</strong></div>
    </div></td>
    <td width="33%"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo16">REVIS&Oacute;</div>
    </div></td>
    <td width="34%"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo16">APROB&Oacute;</div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo14" >
        <!--input name="preparo" type="text" class="Estilo4" id="preparo" value="" size="30" onKeyUp="a.preparo.value=a.preparo.value.toUpperCase();" style="border:0px"-->
        <div   <?php echo $firmas; ?> >
        <?php echo  $rw3["nombre"] ." ". $rw3["apaterno"] ." ". $rw3["amaterno"]; ?><br>
         <?php echo  $rw3["cargo"];  ?>
         </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo14" <?php echo $firmas; ?> >
        <!--input name="preparo2" type="text" class="Estilo4" id="preparo2" value="" size="30" onKeyUp="a.preparo2.value=a.preparo2.value.toUpperCase();" style="border:0px"-->
        <div   <?php echo $firmas; ?> >
        <?php printf("%s",$nom_jefe_ppto); ?><br> 
		 <?php printf("%s",$cargo_ppto); ?>
        </div>  
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo14"  <?php echo $firmas; ?>>
        <!--input name="preparo3" type="text" class="Estilo4" id="preparo3" value="" size="30" onKeyUp="a.preparo3.value=a.preparo3.value.toUpperCase();" style="border:0px"-->
          <div   <?php echo $firmas; ?> >
         <?php printf("%s",$nom_jefe_ppto); ?><br> 
		 <?php printf("%s",$cargo_ppto); ?>
          </div>
      </div>
    </div></td>
  </tr>
</table>
<br>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="3"><div align="center">
      <?php
$consecutivo = $cdpp;

 include_once("../class.barcode.php");
$barcode = new BarCode($consecutivo);
$barcode->drawBarCode();

?>
      <br>
      <span class="Estilo1">Consecutivo</span></div>      <div align="center"></div></td>
    </tr>
  <tr>
    <td width="396"><div align="center"></div></td>
    <td width="6"><input type="button" class="oculto" name="imprimir" value="Imprimir" onClick="window.print();"></td>
    <td width="396"><div align="center"></div></td>
  </tr>
</table>
</form>
<h1 class='SaltoDePagina'> </h1>
</body>
</html>
