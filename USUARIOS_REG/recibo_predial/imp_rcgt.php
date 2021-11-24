<?
session_start();
if(!session_is_registered("login"))
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
.Estilo9 {font-weight: bold}
.Estilo16 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: bold; }
.Estilo17 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
 @media print {
    .oculto {display:none}
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
<?
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
</head>
<body>
<?
$id=$_GET['id2'];

//printf("%s",$id);
include('../config.php');	

				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx1 = "select * from fecha";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $id_emp=$rowxx1["id_emp"];
}

$sqlxx = "select * from recaudo_riip where id_recau ='$id' and id_emp='$id_emp'";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $fecha_recaudo=$rowxx["fecha_recaudo"];
  $tercero=$rowxx["tercero"];
  $id_unico_reip=$rowxx["id_unico_reip"];
  $id_manu_rcgt=$rowxx["id_manu_rcgt"];
  $des_recaudo=$rowxx["des_recaudo"];
  
}
$id_unico = $rowxx["id"];


$sqlxx24 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx24 = mysql_db_query($database, $sqlxx24, $connectionxx);

while($rowxx24 = mysql_fetch_array($resultadoxx24)) 
{
  $nom_jefe_ppto=$rowxx24["nom_jefe_ppto"];
  $raz_soc=$rowxx24["raz_soc"];

  
}
?>
<form name="a">
<table width="798" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="209" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo4"><img src="../images/PLANTILLA PNG PARA LOGO EMPRESA.png" width="180" ><br/><b>  </div>
	</div>	</td>
    <td width="348" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center" class="Estilo16">
	  <h3>RECIBO DE INGRESOS DE PREDIAL  </h3> 
	</div>
	</div>	</td>
    <td width="217" bgcolor="#FFFFFF">
	<div class="Estilo4" style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center">
	  <span class="Estilo9"><strong class="Estilo17">No. <? printf("%s",$id_manu_rcgt); ?></strong>	  </span></div>
	</div>	</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Fecha : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left"><? printf("%s",$fecha_recaudo); ?> </div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Recibi de : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <? printf("%s",$tercero); ?> </div></td>
    </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Concepto : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
<? printf("%s",$des_recaudo); ?>
    </div></td>
    </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">Valor en Letras (Presupuestal) : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <? 
	
$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE id_recau = '$id' AND id_emp='$id_emp'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$nuevo_total = $total;
	
	$vr=$nuevo_total;
	$num=$vr;
 $V=new EnLetras();
 echo "<font class='Estilo1'>". $V->ValorEnLetras($num,"PESOS") ."</font>";//concatenar propiedades entre comilla doble
	?>
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
$sq = "select * from recaudo_riip where id_emp = '$id_emp' and id_recau ='$id' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='200'><span class='Estilo1'><b>IMPUTACION</b></span></td>
<td align='center' width='400'><span class='Estilo1'><b>DESCRIPCION</b></span></td>

<td align='center' width='200'><span class='Estilo1'><b>VALOR</b></span></td>
</tr>
");

while($rw = mysql_fetch_array($re)) 
   {
$xx=$rw["vr_digitado"];
printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<td align='left'><span class='Estilo4'> &nbsp; %s </span></td>
<td align='right'><span class='Estilo4'> %s &nbsp; </span></td>


</tr>", $rw["cuenta"], $rw["nombre"], number_format($xx,2,'.',',')); 

$tot = $tot + $xx;

   }
$tot2 = number_format($tot,2,'.',',');   
echo "<tr class='Estilo4'><td colspan=2><b>TOTAL</b></td><td align='right'><b>$tot2</b> &nbsp;</td></tr>";

printf("</table></center>");
//--------	

	?>
</div>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="3600" colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE </strong></div>
    </div></td>
  </tr>
</table>
<br>
<div align="center">
  <?
	
$sq2 = "select * from lib_aux2 where  id_auto ='$id' order by id asc ";
$re2 = mysql_db_query($database, $sq2, $cx);

printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='400'><span class='Estilo1'><b>CODIGO Y CUENTA P.G.C.P</b></span></td>
<td align='center' width='200'><span class='Estilo1'><b>DEBITO</b></span></td>
<td align='center' width='200'><span class='Estilo1'><b>CREDITO</b></span></td>
</tr>
");

$acu1=0;
$acu2=0;

while($rw2 = mysql_fetch_array($re2))
{

	$cod=$rw2["cuenta"];
	$ss2 = "select * from pgcp where cod_pptal = '$cod'";
	$rr2 = mysql_db_query($database, $ss2, $cx);
	while($rrw2 = mysql_fetch_array($rr2)) 
	{
	  $nom_rubro=$rrw2["nom_rubro"];
	}
	
	
	//printf("%s",$nom_rubro);
	 
	 $x1=$rw2["debito"];
	 $x2=$rw2["credito"];
	 
	 $acu1=$acu1+$rw2["debito".$i];
	 $acu2=$acu2+$rw2["credito".$i];
	 $sum = $rw2["debito"]+ $rw2["credito"];
	 if ($sum >0)
	 {
	 printf("
	<span class='Estilo4'>
	<tr>
	<td align='left'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'> %s - %s </span>
	</div>
	</td>
	
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s</span></td>
	
	</tr>", $rw2["cuenta"], $nom_rubro , number_format($x1,2,'.',',') , number_format($x2,2,'.',',')); 
	 }
 }
 

printf("</table></center>");
//--------	

	?>
</div>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">
  
  <tr>
    <td colspan="2">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="right" class="Estilo4">SUMAS IGUALES :  </div>
	</div>	</td>
    <td width="200">
	<div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	  <div align="right"><? echo number_format($acu1,2,',','.'); // printf("%.2f",$nuevo_total); ?>	</div>
	</div>	</td>
    <td width="200"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 
      <div align="right"><? echo number_format($acu2,2,',','.'); // printf("%.2f",$nuevo_total); ?> </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="right" class="Estilo4">SUMA CHEQUES : </div>
	</div>	</td>
    <td>&nbsp;</td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right">
          <input name="sum_cheques" type="text" class="Estilo4" style="text-align:right ; border:0px" onKeyPress="return validar(event)" value="0.00" size="30">
          </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="right" class="Estilo4">SUMA EFECTIVO : </div>
	</div>	</td>
    <td>&nbsp;</td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right">
          <input name="sum_efectivo" type="text" class="Estilo4" id="sum_efectivo" style="text-align:right; border:0px" onKeyPress="return validar(event)" value="<? echo number_format($acu2,2,',','.'); ?>" size="30">
          </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#DCE9E5" class="Estilo4">
	<div style="padding-left:20px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	  <div align="left"><strong>OBSERVACIONES</strong></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="4"><div align="left">
      <textarea name="observaciones" cols="120" rows="5" class="Estilo4" id="observaciones" onKeyUp="a.observaciones.value=a.observaciones.value.toUpperCase();" style="border:0px"></textarea>
    </div></td>
  </tr>
  <tr>
    <td>
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo4"><strong>PREPAR&Oacute;</strong></div>
	</div>	</td>
    <td width="200">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo16">REVIS&Oacute;</div>
	</div>	</td>
    <td>
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo16">APROB&Oacute;</div>
	</div>	</td>
    <td>
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo16">RECIBIDO DE : </div>
	</div>	</td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;"></div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;"></div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;"></div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;"></div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td>
	<div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	  <div align="center"><strong>
	    CC / NIT : </strong>
	      <input name="cc_nit" type="text" class="Estilo4" id="cc_nit" value="" size="20" onKeyPress="return validar(event)" style="border:0px">
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td width="200">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo16">RESPONSABLE DEL RECAUDO  </div>
	</div>	</td>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	  <div align="center"></div>
	</div>	</td>
  </tr>
</table>
<br>
<table width="800" border="0" align="center">
  <tr>
    <td width="396"><div align="center">
      <?
$consecutivo = $id_manu_rcgt;

include_once("../class.barcode.php");
$barcode = new BarCode($consecutivo);
$barcode->drawBarCode();

?>
      <br>
      <span class="Estilo1">Consecutivo</span></div></td>
    <td width="6"><input type="button" name="imprimir" class="oculto" value="Imprimir" onClick="window.print();"></td>
    <td width="396"><div align="center"><span class="Estilo1">Todos los Derechos Reservados<br>
      www.qualisoft.com.co </span></div></td>
  </tr>
</table>
</form>
</body>
</html>
<?
}
?>