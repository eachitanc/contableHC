<?
session_start();
/*
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
*/
class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "MENOS";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "CERO ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "MILLONES " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "MILLONES " || substr($s,-7, 7) == "MILLON ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " CON " . $this->SubValLetra(intval($Frc)) . "CENTAVOS";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . " M/CTE");
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "CERO" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" MIL MIL", " UN MIL", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "MIL ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "MIL ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "MIL ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "CIEN ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "CIEN", "CIENTO", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("DIEZ UN", "ONCE", $Rtn );
    $Rtn=str_replace("DIEZ DOS", "DOCE", $Rtn );
    $Rtn=str_replace("DIEZ TRES", "TRECE", $Rtn );
    $Rtn=str_replace("DIEZ CUATRO", "CATORCE", $Rtn );
    $Rtn=str_replace("DIEZ CINCO", "QUINCE", $Rtn );
    $Rtn=str_replace("DIEZ SEIS", "DIECISEIS", $Rtn );
    $Rtn=str_replace("DIEZ SIETE", "DIECISIETE", $Rtn );
    $Rtn=str_replace("DIEZ OCHO", "DIECIOCHO", $Rtn );
    $Rtn=str_replace("DIEZ NUEVE", "DIECINUEVE", $Rtn );
    $Rtn=str_replace("VEINTE UN", "VEINTIUN", $Rtn );
    $Rtn=str_replace("VEINTE DOS", "VEINTIDOS", $Rtn );
    $Rtn=str_replace("VEINTE TRES", "VEINTITRES", $Rtn );
    $Rtn=str_replace("VEINTE CUATRO", "VEINTICUATRO", $Rtn );
    $Rtn=str_replace("VEINTE CINCO", "VEINTICINCO", $Rtn );
    $Rtn=str_replace("VEINTE SEIS", "VEINTISEIS", $Rtn );
    $Rtn=str_replace("VEINTE SIETE", "VEINTISIETE", $Rtn );
    $Rtn=str_replace("VEINTE OCHO", "VEINTIOCHO", $Rtn );
    $Rtn=str_replace("VEINTE NUEVE", "VEINTINUEVE", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "UN " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("A " . Chr($i), "* Y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "A" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "CERO";break;
         Case 1:  $t = "UN";break;
         Case 2:  $t = "DOS";break;
         Case 3:  $t = "TRES";break;
         Case 4:  $t = "CUATRO";break;
         Case 5:  $t = "CINCO";break;
         Case 6:  $t = "SEIS";break;
         Case 7:  $t = "SIETE";break;
         Case 8:  $t = "OCHO";break;
         Case 9:  $t = "NUEVE";break;
         Case 10: $t = "DIEZ";break;
         Case 20: $t = "VEINTE";break;
         Case 30: $t = "TREINTA";break;
         Case 40: $t = "CUARENTA";break;
         Case 50: $t = "CINCUENTA";break;
         Case 60: $t = "SESENTA";break;
         Case 70: $t = "SETENTA";break;
         Case 80: $t = "OCHENTA";break;
         Case 90: $t = "NOVENTA";break;
         Case 100: $t = "CIEN";break;
         Case 200: $t = "DOSCIENTOS";break;
         Case 300: $t = "TRESCIENTOS";break;
         Case 400: $t = "CUATROCIENTOS";break;
         Case 500: $t = "QUINIENTOS";break;
         Case 600: $t = "SEISCIENTOS";break;
         Case 700: $t = "SETECIENTOS";break;
         Case 800: $t = "OCHOCIENTOS";break;
         Case 900: $t = "NOVECIENTOS";break;
         Case 1000: $t = "MIL";break;
         Case 1000000: $t = "MILLON";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " MIL";break;
       Case 2: $t = " MILLONES";break;
       Case 3: $t = " BILLONES";break;
    }
    return($Rtn . $t);
}

}
?>
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
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo9 {font-weight: bold}
.Estilo16 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: bold; }
.Estilo17 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.Estilo161 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; font-weight: bold; }

h1.SaltoDePagina
{
page-break-after: always
}
-->
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
<?

//printf("%s",$id);
include('../config.php');	
	
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx1 = "select * from fecha";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $id_emp=$rowxx1["id_emp"];
}

$sql25 = "select * from cobp where fecha_cobp ='2020/03/25'";
$re25 = mysql_db_query($database, $sql25, $connectionxx);
while($row25 = mysql_fetch_array($re25)) 
{
	
	
$sqlxx = "select * from cobp where id_auto_cobp ='$row25[id_auto_cobp]'";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

$total=0;
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  
  $id_manu_cobp=$rowxx["id_manu_cobp"];
  $fecha_cobp=$rowxx["fecha_cobp"];
  $tercero=$rowxx["tercero"];
  $ccnit=$rowxx["ccnit"];
 
  $des_cobp=$rowxx["des_cobp"];
  //$total=$rowxx["total"];
  $vr_digitado=$rowxx["vr_digitado"];
  
  $id_manu_crpp=$rowxx["id_manu_crpp"];
  $id_auto_crpp=$rowxx["id_auto_crpp"];
 
 
$total=$total + $rowxx["vr_digitado"];  
}

$sqlxx23 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx23 = mysql_db_query($database, $sqlxx23, $connectionxx);

while($rowxx23 = mysql_fetch_array($resultadoxx23)) 
{
  $nom_jefe_ppto=$rowxx23["nom_jefe_ppto"];
  $raz_soc=$rowxx23["raz_soc"];
  $nit=$rowxx23["nit"];
  $dv=$rowxx23["dv"];
  $crtl_doc=$rowxx23["control_doc"];
  $cargo_ppto =$rowxx23["cargo_ppto"];
  $logo =$rowxx23["logo"];
  
}
$firmas = "style='display:none'";
if ($crtl_doc == 'SI')
{
	$firmas = "style='display:'";
}
$sq3= "select nombre, apaterno,amaterno,cargo from usuarios2 where login = '$_SESSION[login]'";
$re3 = mysql_db_query($database, $sq3, $connectionxx);
$rw3 =mysql_fetch_array($re3); 

$ver ="";
if ($crtl_doc == 'NO') $ver = "style='display:none'";

?>
<form name="a">
<table width="798" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="209" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo4"><img src="../images/PLANTILLA PNG PARA LOGO EMPRESA.png" width="180" > <?php echo $nit."-".$dv; ?></div>
	</div>	</td>
    <td width="348" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center" class="Estilo16">
	  <h4>OBLIGACION PRESUPUESTAL <br> <? if ($logo =='2') printf("No. %s",$id_manu_cobp); ?></h4> 
	</div>
	</div>	</td>
    <td width="217" bgcolor="#FFFFFF">
	<div class="Estilo4" style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center">
	  <span class="Estilo9"><strong class="Estilo17"><?php
	if ($logo=='2')
	     echo "<img src='../images/Logohacienda.jpg' width='170'>";
	else printf("No. %s",$id_manu_cobp);
	?></strong>	  </span></div>
	</div>	</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Fecha : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left"><? printf("%s",$fecha_cobp); ?> </div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">A Favor de  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <input name="tercerox" class="Estilo4" size="80" id="tercerox" type="text" value="<? printf("%s",$tercero); ?>" style="border:0px" /></div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right">CC / NIT  : </div>
      </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

          <div align="left">
              <? printf("%s",$ccnit); ?>      

</div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Concepto  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
<? printf("%s",$des_cobp); ?>
    </div></td>
    </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="right" class="Estilo16">Por Valor de : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <? 
	
	
	$vr=$total;
	$num=$vr;
 $V=new EnLetras();
 echo "<font class='Estilo1'>". $V->ValorEnLetras($num,"PESOS") ."</font>";//concatenar propiedades entre comilla doble
	?>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">No. de Registro que Afecta : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
<? printf("%s",$id_manu_crpp); ?>
    </div></td>
  </tr>
</table>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="900" colspan="4" bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo4"><strong>DATOS PRESUPUESTALES</strong></div>
	</div>
	</td>
  </tr>
</table><br>
<div align="center">
  <?
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$row25[id_auto_cobp]' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='225'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='325'><span class='Estilo1'><b>DESCRIPCION</b></span></td>
<td align='center' width='125'><span class='Estilo1'><b>FTE FINANCIACION</b></span></td>
<td align='center' width='125'><span class='Estilo1'><b>VALOR</b></span></td>
</tr>
");

$nuevo_total=0;
while($rw = mysql_fetch_array($re)) 
   {
   
$cta = $rw["cuenta"];

$sq2 = "select proc_rec, nom_rubro from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);   
while($rw2 = mysql_fetch_array($re2))
{

	$fte = $rw2["proc_rec"];  
	$nom_rubro = $rw2["nom_rubro"];  
	
}
if($fte == 'P')
{
$fte='PROPIO';
}
else
{
$fte='ADMINISTRADO';
}

$xxx=$rw["vr_digitado"];


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




", $rw["cuenta"], $nom_rubro, $fte, number_format($xxx,2,',','.')); 

$nuevo_total=$nuevo_total + $rw["vr_digitado"];
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
    <td align='right'><span class='Estilo4'><b>".number_format($nuevo_total,2,',','.')." &nbsp;</b> </span></td>
  </tr>
</table></center>",$nuevo_total);
//--------	

	?>
</div>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">
  
  
  
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" class="Estilo4"><p>
 
    </p>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
      <div align="center"><img src="../simbolos/fuentes/firma.png" width="200" /></div>
      <div align="center">______________________________<br>
          
          <span class="Estilo16"><? printf("%s",$nom_jefe_ppto); ?><br>
          </span><span class="Estilo14">
              <? printf("%s",$cargo_ppto); ?></span></div>
      <br></td>
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
      <div align="center" class="Estilo4">
        <!--input name="preparo" type="text" class="Estilo4" id="preparo" value="" size="30" onKeyUp="a.preparo.value=a.preparo.value.toUpperCase();" style="border:0px"-->
          <div   <?php echo $firmas; ?> >
     	<?php echo  $rw3["nombre"] ." ". $rw3["apaterno"] ." ". $rw3["amaterno"]; ?><br>
         <?php echo  $rw3["cargo"];  ?>
         </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <!--input name="preparo2" type="text" class="Estilo4" id="preparo2" value="" size="30" onKeyUp="a.preparo2.value=a.preparo2.value.toUpperCase();" style="border:0px"-->
          <div   <?php echo $firmas; ?> >
       <? printf("%s",$nom_jefe_ppto); ?><br> 
		    <? printf("%s",$cargo_ppto); ?>
          </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <!--input name="preparo3" type="text" class="Estilo4" id="preparo3" value="" size="30" onKeyUp="a.preparo3.value=a.preparo3.value.toUpperCase();" style="border:0px"-->
          <div   <?php echo $firmas; ?> >
        <? printf("%s",$nom_jefe_ppto); ?><br> 
		     <? printf("%s",$cargo_ppto); ?>
          </div>
      </div>
    </div></td>
  </tr>
</table>
<br>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="3"><div align="center">
      <?
$consecutivo = $id_manu_cobp;

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
<?
}
?>
</body>
</html>
