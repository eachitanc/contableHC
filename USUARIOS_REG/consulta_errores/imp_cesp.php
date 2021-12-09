<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
<title>CONTAFACIL</title>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
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
.Estilo9 {
	font-weight: bold;
	font-size: 16px;
}
.Estilo16 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: bold; }
.Estilo21 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo21 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo22 {font-size: 14px}
-->
 @media print {
    .oculto {display:none}
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
<?php
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

<!--linea de insercion del jquery-->

<script type="text/javascript" language="javascript" src="../jquery.js"></script>


<!-- inicio mostrar tabla-->

<!--**************************-->
<script type="text/javascript">
$(function()
{

$("#mostrar").click(function(event) {
event.preventDefault();
$("#caja").slideToggle();
});

$("#caja a").click(function(event) {
event.preventDefault();
$("#caja").slideUp();
});
});
</script>

<!--**************************-->
<style type="text/css">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;	
}

a{color:#993300; text-decoration:none;}

#caja {
width:100%;
display: none;
padding:5px;
border:2px solid #ffffff;
background-color:#ffffff;
}
#mostrar{
display:block;
width:100%;
padding:5px;
border:2px solid #FFFFFF;
background-color:#FFFFFF;
}

</style>


</head>
<body>
<?php
$id_cesp=$_GET['id3'];

//printf("%s",$id_ceva);
include('../config.php');	
				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx1 = "select * from fecha";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $id_emp=$rowxx1["id_emp"];
}

$sq3= "select * from empresa";
$re3 = mysql_db_query($database, $sq3, $connectionxx);

while($row3 = mysql_fetch_array($re3)) 
{
  $empresa=$row3["raz_soc"];
}


$sqlxx = "select * from conta_cesp where id_auto_ncon ='$id_cesp' and id_emp='$id_emp'";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_manu_ceva = $rowxx["id_manu_ncon"];
  $fecha_ceva = $rowxx["fecha_ncon"];
  $tercero = $rowxx["tercero"];  
  $ccnit = $rowxx["ccnit"];  
  $concepto_pago = $rowxx["des_ncon"];  
  $total_pagado = $rowxx["tot_deb"];  
  $salud = $rowxx["salud"];  
  $pension = $rowxx["pension"];  
  $libranza = $rowxx["libranza"];  
  $f_solidaridad = $rowxx["f_solidaridad"];  
  $f_empleados = $rowxx["f_empleados"]; 
  $sindicato = $rowxx["sindicato"]; 
  $embargo = $rowxx["embargo"]; 
  $cruce = $rowxx["cruce"]; 
  $otros = $rowxx["otros"]; 
  $retefuente = $rowxx["retefuente"]; 
  $vr_retefuente = $rowxx["vr_retefuente"]; 
  $reteiva = $rowxx["reteiva"]; 
  $vr_reteiva = $rowxx["vr_reteiva"]; 
  $reteica = $rowxx["reteica"]; 
  $vr_reteica = $rowxx["vr_reteica"]; 
  $estampilla1 = $rowxx["estampilla1"]; 
  $vr_estampilla1 = $rowxx["vr_estampilla1"]; 
  $estampilla2 = $rowxx["estampilla2"]; 
  $vr_estampilla2 = $rowxx["vr_estampilla2"]; 
  $estampilla3 = $rowxx["estampilla3"]; 
  $vr_estampilla3 = $rowxx["vr_estampilla3"]; 
    $estampilla4 = $rowxx["estampilla4"]; 
  $vr_estampilla4 = $rowxx["vr_estampilla4"]; 
    $estampilla5 = $rowxx["estampilla5"]; 
  $vr_estampilla5 = $rowxx["vr_estampilla5"]; 
  $forma_pago = $rowxx["forma_pago"]; 
  $num_cheque = $rowxx["num_cheque"]; 
  $te = $rowxx["te"]; 
  $banco_cheque = $rowxx["banco_cheque"]; 
  $cta_cheque = $rowxx["cta_cheque"]; 
  $id_auto_cobp = $rowxx["id_auto_cobp"];   
   
  $num_cheque2 = $rowxx["num_cheque2"]; 
  $banco_cheque2 = $rowxx["banco_cheque2"]; 
  $cta_cheque2 = $rowxx["cta_cheque2"]; 
    $num_cheque3 = $rowxx["num_cheque3"]; 
  $banco_cheque3 = $rowxx["banco_cheque3"]; 
  $cta_cheque3 = $rowxx["cta_cheque3"];
    $num_cheque4 = $rowxx["num_cheque4"]; 
  $banco_cheque4 = $rowxx["banco_cheque4"]; 
  $cta_cheque4 = $rowxx["cta_cheque4"];
    $num_cheque5 = $rowxx["num_cheque5"]; 
  $banco_cheque5 = $rowxx["banco_cheque5"]; 
  $cta_cheque5 = $rowxx["cta_cheque5"];
    $num_cheque6 = $rowxx["num_cheque6"]; 
  $banco_cheque6 = $rowxx["banco_cheque6"]; 
  $cta_cheque6 = $rowxx["cta_cheque6"];
    $num_cheque7 = $rowxx["num_cheque7"]; 
  $banco_cheque7 = $rowxx["banco_cheque7"]; 
  $cta_cheque7 = $rowxx["cta_cheque7"];
    $num_cheque8 = $rowxx["num_cheque8"]; 
  $banco_cheque8 = $rowxx["banco_cheque8"]; 
  $cta_cheque8 = $rowxx["cta_cheque8"];
    $num_cheque9 = $rowxx["num_cheque9"]; 
  $banco_cheque9 = $rowxx["banco_cheque9"]; 
  $cta_cheque9 = $rowxx["cta_cheque9"];
    $num_cheque10 = $rowxx["num_cheque10"]; 
  $banco_cheque10 = $rowxx["banco_cheque10"]; 
  $cta_cheque10 = $rowxx["cta_cheque10"];
  $num_cheque11 = $rowxx["num_cheque11"]; 
  $banco_cheque11 = $rowxx["banco_cheque11"]; 
  $cta_cheque11 = $rowxx["cta_cheque11"];
    $num_cheque12 = $rowxx["num_cheque12"]; 
  $banco_cheque12 = $rowxx["banco_cheque12"]; 
  $cta_cheque12 = $rowxx["cta_cheque12"];
    $num_cheque13 = $rowxx["num_cheque13"]; 
  $banco_cheque13 = $rowxx["banco_cheque13"]; 
  $cta_cheque13 = $rowxx["cta_cheque13"];
    $num_cheque14 = $rowxx["num_cheque14"]; 
  $banco_cheque14 = $rowxx["banco_cheque14"]; 
  $cta_cheque14 = $rowxx["cta_cheque14"];
    $num_cheque15 = $rowxx["num_cheque15"]; 
  $banco_cheque15 = $rowxx["banco_cheque15"]; 
  $cta_cheque15 = $rowxx["cta_cheque15"];
  
  
}
 
	 for($j=0;$j<=50;$j++)
 {
            $sqle = "select * from conta_cesp where id_auto_ncon = '$id_cesp'";
			$rese = mysql_db_query($database, $sqle, $connectionxx);
			
			while($rowe = mysql_fetch_array($rese)) 
			{
			  $nom_e=$rowe[pgcp."$j"];
			  
			 
						$subcadena=substr($nom_e,0,4);
						if($subcadena=="1110")
						{
							
							$sqpgcp="select * from pgcp where cod_pptal = '$nom_e'";
							$respgcp=mysql_db_query($database,$sqpgcp,$connectionxx);
							while($rowpgcp=mysql_fetch_array($respgcp))
							{
								
								$valor_cr2=$rowe[vr_cre_."$j"];
							}
						}
							
}
}

?>
<form name="a">
<table width="798" border="0" align="center">
  <tr>
    <td width="209" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
	<div align="center" class="Estilo4">
    <?php
	  if($empresa =='MUNICIPIO DE IPIALES')
	     echo " <img src='../images/PLANTILLA PNG PARA LOGO EMPRESA.png' width='107' height='88'>";
	?>
   
	
    
    </div>	</td>
    <td colspan="2" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center" class="Estilo16">
	  <h3>COMPROBANTE DE EGRESO SIN AFECTACION PRESUPUESTAL No <?php printf("%s",$id_manu_ceva); ?></h3> 
	</div>
	</div>	</td>
    <td width="217" bgcolor="#FFFFFF">
	<div class="Estilo4" style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center">
	  <span class="Estilo9"><h3><?php
	  if($empresa =='MUNICIPIO DE IPIALES')
	     echo "<img src='../images/Logohacienda.jpg' width='150'>";
         else   echo " <img src='../images/PLANTILLA PNG PARA LOGO EMPRESA.png' width='107' height='88'>"
	?>	 </h3> </span></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#F5F5F5">
<a href="#" id="mostrar"><center><div class="oculto">
<span class="Estilo4" style="color:red;"><b>CLIC PARA MOSTRAR / OCULTAR ESPACIO PARA CHEQUE</b></span>
</div></center></a>
<div id="caja">
<table width="800" border="0" align="center" >
<tr>
<td>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br>
&nbsp;<br></td>
</tr>
</table>
</div>	</td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo22">Fecha  : </div>
    </div></td>
    <td width="196" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo22"><?php printf("%s",$fecha_ceva); ?></div>
    </div></td>
    <td width="158" bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
        <div align="right" class="Estilo22">CC / NIT  : </div>
      </div>
    </div></td>
    <td bgcolor="#FFFFFF"><div class="Estilo21" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo22"><?php printf("%s",$ccnit); ?></div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo22">A Favor de  : </div>
    </div></td>
    <td colspan="3" bgcolor="#FFFFFF"><div class="Estilo21" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo22"><?php printf("%s",$tercero); ?></div>
    </div></td>
  </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo22">Concepto  : </div>
    </div></td>
    <td colspan="3" bgcolor="#FFFFFF"><div class="Estilo21" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left" class="Estilo22"><?php printf("%s",$concepto_pago); ?></div>
    </div></td>
  </tr>
  
  
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo22">Por valor de   : </div>
    </div></td>
    <td colspan="3" bgcolor="#FFFFFF"><div class="Estilo22" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <?php 
	$vr=$valor_cr2;
	$num=$vr;
 $V=new EnLetras();
 echo "<font class='Estilo1'>". $V->ValorEnLetras($num,"PESOS") ."</font>";//concatenar propiedades entre comilla doble
	?></div></td>
  </tr>
</table>
<br>
<div align="center">
  <?php
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$id_auto_cobp' order by id asc ";
$re = $cx->query($sq);
/*
printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='4'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>DATOS PRESUPUESTALES</strong></div>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='225'><span class='Estilo4'><b>IMPUTACION</b></span></td>
<td align='center' width='325'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>FTE FINANCIACION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>VALOR</b></span></td>
</tr>
");
*/
$nuevo_total=0;
while($rw = $re->fetch_assoc()) 
   {
   
$cta = $rw["cuenta"];

$sq2 = "select proc_rec, nom_rubro from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
$re2 = $cx->query($sq2);   
while($rw2 = $re2->fetch_assoc())
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
$xx=$rw["vr_digitado"];
/*
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

", $rw["cuenta"], $nom_rubro, $fte, number_format($xx,2,',','.')); */

$nuevo_total=$nuevo_total + $rw["vr_digitado"];
   }
/*
printf("

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
*/
//--------	

	?>
</div>
<br>
<div align="center">
  <?php
	
$sq2 = "select *
        from conta_cesp where id_emp = '$id_emp' and id_auto_ncon ='$id_cesp' order by id asc ";
$re2 = $cx->query($sq2);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='3'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>MOVIMIENTO CONTABLE</strong></div>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='400'><span class='Estilo1'><b>CODIGO Y CUENTA P.G.C.P</b></span></td>
<td align='center' width='200'><span class='Estilo1'><b>DEBITO</b></span></td>
<td align='center' width='200'><span class='Estilo1'><b>CREDITO</b></span></td>
</tr>
");

$acu1=0;
$acu2=0;

while($rw2 = $re2->fetch_assoc())
{
	for($i=1;$i < 51 ; $i++)
	{

		if($rw2["vr_deb_".$i] == 0 and $rw2["vr_cre_".$i] == 0)
 		{
 		}
 		else
 		{

			$cod=$rw2["pgcp".$i];
			$ss2 = "select * from pgcp where  cod_pptal = '$cod'";
			$rr2 = mysql_db_query($database, $ss2, $cx);
			while($rrw2 = mysql_fetch_array($rr2)) 
			{
	 			 $nom_rubro2=$rrw2["nom_rubro"];
	  
			}
	
			$a1=$rw2["vr_deb_".$i];
			$b1=$rw2["vr_cre_".$i];

			$acu1=$acu1+$rw2["vr_deb_".$i];
			$acu2=$acu2+$rw2["vr_cre_".$i];

//printf("%s",$nom_rubro);
 
 
 printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<span class='Estilo4'> %s - %s </span>
</div>
</td>

<td align='right'><span class='Estilo4'> %s&nbsp; </span></td>
<td align='right'><span class='Estilo4'> %s&nbsp;</span></td>

</tr>", $rw2["pgcp".$i], $nom_rubro2 , number_format($a1,2,',','.'), number_format($b1,2,',','.')); 
 }
 
}
}


printf("</table></center>");
//--------	

	?>
</div>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="400" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="right" class="Estilo4"><strong>SUMAS IGUALES </strong>: </div>
    </div></td>
    <td width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><?php printf("%s,00",number_format($acu2,0,',','.')); ?> </div>
    </div></td>
    <td width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><?php printf("%s,00",number_format($acu2,0,',','.')); ?> </div>
    </div></td>
  </tr>
</table>
<br>
</table>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="220"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">
        <div align="center">BANCOS</div>
      </div>
    </div></td>
    <td width="239"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">
        <div align="center">NO. DE CUENTA </div>
      </div>
    </div></td>
    <td width="181"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">
        <div align="center">
          <DIV align="center"><STRONG><?php printf("%s",'No. Dcto / Cheque'); ?></STRONG></DIV>
        </div>
      </div>
    </div></td>
    <td width="130"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">
        <div align="center">VALOR</div>
      </div>
    </div></td>
  </tr>
 <?php
 for($j=0;$j<=50;$j++)
 {
            $sqle = "select * from conta_cesp where id_auto_ncon = '$id_cesp'";
			$rese = mysql_db_query($database, $sqle, $connectionxx);
			
			while($rowe = mysql_fetch_array($rese)) 
			{
			  $nom_e=$rowe[pgcp."$j"];
			  
			 
						$subcadena=substr($nom_e,0,4);
						if($subcadena=="1110")
						{
							
							$sqpgcp="select * from pgcp where cod_pptal = '$nom_e'";
							$respgcp=mysql_db_query($database,$sqpgcp,$connectionxx);
							while($rowpgcp=mysql_fetch_array($respgcp))
							{
								
								$no_banco=$rowpgcp["nom_banco1"];
								$no_cuenta=$rowpgcp["num_cta"];
								$no_cheque=$rowe[cheque."$j"];
								$valor_cr=$rowe[vr_cre_."$j"];
							
							?>
                             <tr>
   
    <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"><span class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"><?php printf("%s",$no_banco); ?></span></div></td>
    <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <?php printf("%s",$no_cuenta); ?> </div></td>
    <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <?php printf("%s",$no_cheque); ?></div></td>
    <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <?php printf("%s",number_format($valor_cr,0,',','.')); ?></div></td>
   
  </tr>
                            
                            <?php
							}
						}
			  		  
			  
			}
			
  } ?>
  
 
</table>
<br>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <DIV align="center"><STRONG>DESCUENTOS , DEDUCCIONES, RETENCIONES POR IMPUESTOS, TASAS Y   CONTRIBUCIONES </STRONG></DIV>
      </div>
    </div></td>
  </tr>
  <tr>
    <td width="200"></td>
    <td width="200"></td>
    <td width="200"></td>
    <td width="200"></td>
  </tr>
  <tr>
  <?php if($salud !='0') {
  }
  else
  {
  ?>  
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Salud</STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        
		<div align="right"><?php printf("%s",number_format($salud,2,',','.')); ?>		</div>
      </div>
    </div></td>
	<?php } ?>
	      <?php if($pension !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Pension </STRONG>: </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($pension,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
  </tr>
  <tr>
        <?php if($libranza !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Libranzas </STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($libranza,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
	      <?php if($f_solidaridad !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Fondo Solidaridad </STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($f_solidaridad,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
  </tr>
  <tr>
        <?php if($f_empleados !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Fondo Empleados </STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($f_empleados,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
	      <?php if($sindicato !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Sindicatos </STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($sindicato,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
  </tr>
  <tr>
        <?php if($embargo !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Embargos Judiciales </STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($embargo,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
	      <?php if($cruce !='0') {
  }
  else
  {
  ?> 
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
        <div align="right"><STRONG>Cruce de Cuentas </STRONG> : </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4">
         <div align="right"><?php printf("%s",number_format($cruce,2,',','.')); ?> </div>
      </div>
    </div></td>
	<?php } ?>
  </tr>
  <tr>
    <?php if($otros !='0') {
  }
  else
  {
  ?>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo4">
          <div align="right"><STRONG>Otros </STRONG> : </div>
        </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo4">
          <div align="right"><?php printf("%s",number_format($otros,2,',','.')); ?> </div>
        </div>
    </div></td>
    <?php } ?>
    <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF"></td>
  </tr>
  
  <tr>
    <td colspan="4"><table width="800" border="0" align="center">
      
      <tr>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
        <td width="200"></td>
      </tr>
      
      <tr>
        <td>
		            <?php 
		$tot_desc = $salud+$pension+$libranza+$f_solidaridad+$f_empleados+$sindicato+$embargo+$cruce+$otros;
		//printf("%s",number_format($tot_desc,2,',','.')); 
		
		?>		</td>
        <td colspan="2" bgcolor="#CCCCCC"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo21">
              <div align="center"><strong>TOTAL DESCTOS., DEDUCC/ y RETENCIONES</strong></div>
            </div>
        </div></td>
        <td bgcolor="#CCCCCC"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
            <div align="center" class="Estilo21">
              <div align="right"><strong>
                <?php 
		$tot_rete=$vr_retefuente+$vr_reteica+$vr_reteiva+$vr_estampilla1+$vr_estampilla2+$vr_estampilla3+$vr_estampilla4+$vr_estampilla5 + $tot_desc;
		printf("%s",number_format($tot_rete,2,',','.'));
		
		?>
              </strong></div>
            </div>
        </div></td>
      </tr>
    </table></td>
    </tr>
</table>
<br>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><div class="Estilo9" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo9">
        <div align="right">
		
		<b>VALOR NETO PAGADO&nbsp;&nbsp;&nbsp;&nbsp; = $<?php printf("%s",number_format($valor_cr2,2,',','.'));?>        </b>
        
		</div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td width="200"></td>
    <td width="200"></td>
    <td width="200"></td>
    <td width="200"></td>
  </tr>
</table>
<span class="Estilo4">
<?php
	  $sqlxx2 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $nom_jefe_ppto=$rowxx2["nom_jefe_ppto"];
  $nom_rep_leg=$rowxx2["nom_rep_leg"];
  $nom_otr_resp=$rowxx2["nom_otr_resp"];
  $cargo_teso=$rowxx2["cargo_teso"];
  $nom_otr_resp =$rowxx2["nom_otr_resp"];
  $logo =$rowxx2["logo"];
  $crtl_doc=$rowxx2["control_doc"];
  $cargo_rep_leg =$rowxx2["cargo_rep_leg"];

  
}
$firmas = "style='display:none'";
if ($crtl_doc == 'NO') $ver = "style='display:none'";
if ($crtl_doc == 'SI' or $crtl_doc == '' )
{
	$firmas = "style='display:'";
}

$sq3= "select nombre, apaterno,amaterno,cargo from usuarios2 where login = '$_SESSION[login]'";
$re3 = mysql_db_query($database, $sq3, $connectionxx);
$rw3 =mysql_fetch_array($re3); 

	  ?>
</span><BR>
<table width="800" border="1" align="center" class="bordepunteado1"  <?php echo $ver; ?>>
  <tr>
    <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo21"><strong>PREPAR&Oacute;</strong></div>
    </div></td>
    <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo16">REVIS&Oacute;</div>
    </div></td>
    <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo16">APROB&Oacute;</div>
    </div></td>
    <td width="200"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo16">BENEFICIARIO : </div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
        <div   <?php echo $firmas; ?> >
        <?php echo  $rw3["nombre"] ." ". $rw3["apaterno"] ." ". $rw3["amaterno"]; ?><br>
         <?php echo  $rw3["cargo"];  ?>
         </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
       <div   <?php echo $firmas; ?> >
        <?php printf("%s",$nom_otr_resp ); ?><br> 
		   <?php printf("%s",$cargo_teso); ?>
         </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
       <div   <?php echo $firmas; ?> >
        <?php printf("%s",$nom_rep_leg ); ?><br> 
		   <?php printf("%s",$cargo_rep_leg ); ?>
         </div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
        <input name="recibido_de" type="text" class="Estilo21" id="recibido_de" value="" size="30" onKeyUp="a.recibido_de.value=a.recibido_de.value.toUpperCase();" style="border:0px">
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td><div class="Estilo21" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"><strong> CC / NIT : </strong>
            <input name="cc_nit" type="text" class="Estilo21" id="cc_nit" value="" size="20" onKeyPress="return validar(event)" style="border:0px">
      </div>
    </div></td>
  </tr>
</table>
<br>
<table width="800" border="0" align="center" class="oculto" >
  <tr>
    <td width="396"><div align="center"></div></td>
    <td width="6"><input type="button" name="imprimir" value="Imprimir" onClick="window.print();"></td>
    <td width="396"><div align="center"></div></td>
  </tr>
</table>
</form>
</body>
</html>
<?php
}
?>