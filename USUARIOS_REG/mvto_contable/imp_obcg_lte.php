<?
set_time_limit(150);
session_start();
/*
if(!isset($_SESSION["login"])))
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>CONTAFACIL</title>



<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
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
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
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
h1.SaltoDePagina
{
page-break-after: always
}
-->
</style>
</head>

<body>


<?
include('../config.php');

//**** variables para generacion dinamica

//**********************
				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");



$sql25 = "select * from obcg where fecha_obcg ='2020/06/30'";
$re25 = mysql_db_query($database, $sql25, $cx);
while($row25 = mysql_fetch_array($re25)) 
{
//********************

$sqlxx = "select * from obcg where id_auto_obcg ='$row25[id_auto_obcg]'";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

$total=0;
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  
  $id_manu_obcg=$rowxx["id_manu_obcg"];
  $fecha_obcg=$rowxx["fecha_obcg"];
  $tercero=$rowxx["tercero"];
  $ccnit=$rowxx["ccnit"];
  $concepto_obcg=$rowxx["concepto_obcg"];
  $total=$rowxx["tot_deb"]; 
  $id_auto_cobp=$rowxx["id_auto_cobp"];  
  
 

}

$sqlxx24 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx24 = mysql_db_query($database, $sqlxx24, $cx);

while($rowxx24 = mysql_fetch_array($resultadoxx24)) 
{
  $nom_jefe_ppto=$rowxx24["nom_jefe_ppto"];
  $raz_soc=$rowxx24["raz_soc"];

  
}
?>
<form name="a">
<table width="796" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="209" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo4"><img src="../images/PLANTILLA PNG PARA LOGO EMPRESA.png" width="107" height="88"><br/><b> <?php echo $raz_soc; ?> </b></div>
	</div>	</td>
    <td width="348" bgcolor="#FFFFFF">
	<div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center" class="Estilo16">
	  <h3>OBLIGACION CONTABLE DEL GASTO </h3> 
	</div>
	</div>	</td>
    <td width="217" bgcolor="#FFFFFF">
	<div class="Estilo4" style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center">
	  <span class="Estilo9"><strong class="Estilo17">No. <? printf("%s",$id_manu_obcg); ?></strong>	  </span></div>
	</div>	</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Fecha : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left"><? printf("%s",$fecha_obcg); ?> </div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">A Favor de  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <? printf("%s",$tercero); ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right">CC / NIT  : </div>
      </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

          <div align="left">
         <? printf("%s",$ccnit); ?></div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Concepto Obligacion Contable   : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
<? printf("%s",$concepto_obcg); ?>
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
      <div align="right" class="Estilo16">No. de Obligacion Afectada : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
<? printf("%s",$id_auto_cobp); ?>
    </div></td>
  </tr>
</table>
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
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");	
$sq2 = "select *  from obcg where id_auto_obcg ='$row25[id_auto_obcg]' order by id asc ";
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


while($rw2 = mysql_fetch_array($re2))
{
	for($i=1;$i < 51 ; $i++)
{

 if($rw2["vr_deb_".$i] == 0 and $rw2["vr_cre_".$i] == 0)
 {
 }
 else
 {

	$cod=$rw2["pgcp".$i];
	$ss2 = "select * from pgcp where cod_pptal = '$cod'";
	$rr2 = mysql_db_query($database, $ss2, $cx);
	while($rrw2 = mysql_fetch_array($rr2)) 
	{
	  $nom_rubro2=$rrw2["nom_rubro"];
	}
	


//printf("%s",$nom_rubro);
 
 $x1=$rw2["vr_deb_".$i];
 $x2=$rw2["vr_cre_".$i];
 printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s - %s </span>
</div>
</td>

<td align='right'><span class='Estilo4'> %s&nbsp; </span></td>
<td align='right'><span class='Estilo4'> %s&nbsp;</span></td>

</tr>", $rw2["pgcp".$i], $nom_rubro2 , number_format($x1,2,',','.') ,number_format($x2,2,',','.')); 
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
    <td width="400" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4"><strong>SUMAS IGUALES </strong>: </div>
    </div></td>
    <td width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><? echo number_format($total,2,',','.'); // printf("%.2f",$total); ?> </div>
    </div></td>
    <td width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right"><? echo number_format($total,2,',','.'); // printf("%.2f",$total); ?> </div>
    </div></td>
  </tr>
</table>
<br>
<table width="800" border="1" align="center" class="bordepunteado1">
  
  
  
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" class="Estilo4"><p>
      <?
	$sqlxx2 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $cx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $nom_jefe_ppto=$rowxx2["nom_jefe_ppto"];
  $raz_soc=$rowxx2["raz_soc"];
    $crtl_doc=$rowxx2["control_doc"];
}
$ver ="";
if ($crtl_doc == 'NO') $ver = "style='display:none'";

	$sq3 ="select * from usuarios2 where login ='$_SESSION[login]'";
	$rs3 = mysql_db_query($database,$sq3,$cx);
	$rw3 = mysql_fetch_array($rs3);
	?>
    </p>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
      <div align="center"><img src="../simbolos/fuentes/firma.png" width="200" /></div>
      <div align="center">______________________________<br>
                    <span class="Estilo16"><? echo strtoupper($rw3["nombre"]). " ". strtoupper($rw3["apaterno"])." ". strtoupper($rw3["amaterno"]) ; ?><br>
            <?php echo $rw3["cargo"]; ?></span></div>
      <br></td>
  </tr>
</table>
<br>
<table width="800" border="1" align="center" class="bordepunteado1" <?php echo $ver; ?>>
  <tr>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4"><strong>PREPAR&Oacute;</strong></div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo16">REVIS&Oacute;</div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo16">APROB&Oacute;</div>
    </div></td>
  </tr>
  <tr>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <input name="preparo" type="text" class="Estilo4" id="preparo" value="" size="30" onKeyUp="a.preparo.value=a.preparo.value.toUpperCase();" style="border:0px">
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <input name="preparo2" type="text" class="Estilo4" id="preparo2" value="" size="30" onKeyUp="a.preparo2.value=a.preparo2.value.toUpperCase();" style="border:0px">
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <input name="preparo3" type="text" class="Estilo4" id="preparo3" value="" size="30" onKeyUp="a.preparo3.value=a.preparo3.value.toUpperCase();" style="border:0px">
      </div>
    </div></td>
  </tr>
</table>
<br>
<table width="800" border="0" align="center">
  <tr>
    <td width="396"><div align="center">
      <?
$consecutivo = $id_manu_obcg;

 include_once("../class.barcode.php");
$barcode = new BarCode($consecutivo);
$barcode->drawBarCode();


?>
      <br>
      <span class="Estilo1">Consecutivo</span></div></td>
    <td width="6"><input type="button" class="oculto" name="imprimir" value="Imprimir" onClick="window.print();"></td>
    <td width="396"><div align="center"><span class="Estilo1">Todos los Derechos Reservados<br>
      www.qualisoft.com.co </span></div></td>
  </tr>
</table>
</form>
<h1 class='SaltoDePagina'> </h1>
<?
//****************************************************************** fin
}
?>

</body>
</html>


