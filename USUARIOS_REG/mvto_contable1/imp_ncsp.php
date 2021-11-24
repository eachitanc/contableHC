<?
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
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo19 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo20 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo21 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo21 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
table.bordepunteado11 {border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
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
$id=$_GET['id3'];

//printf("%s",$id);
include('../config.php');	

				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx1 = "select * from fecha";
$resultadoxx1 = mysql_db_query($database, $sqlxx1, $connectionxx);

while($rowxx1 = mysql_fetch_array($resultadoxx1)) 
{
  $id_emp=$rowxx1["id_emp"];
}


			

$sqlxx = "select * from conta_ncsp where id_auto_ncon ='$id' and id_emp='$id_emp'";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  
  $id_auto_ncon=$rowxx["id_auto_ncon"];
  $id_manu_ncon=$rowxx["id_manu_ncon"];
  $fecha_ncon=$rowxx["fecha_ncon"];
  $tercero=$rowxx["tercero"];
  $des_ncon=$rowxx["des_ncon"];
  
	$tot_deb = $rowxx["tot_deb"];
	$tot_cre = $rowxx["tot_cre"];
  	$banco1 = $rowxx["banco1"];
	$banco2 = $rowxx["banco2"];
	$banco3 = $rowxx["banco3"];
	$banco4 = $rowxx["banco4"];
	$banco5 = $rowxx["banco5"];
	$banco6 = $rowxx['banco6'];//printf("banco6 : %s<br>",$banco6);
$banco7 = $rowxx['banco7'];//printf("banco7 : %s<br>",$banco7);
$banco8 = $rowxx['banco8'];//printf("banco8 : %s<br>",$banco8);
$banco9 = $rowxx['banco9'];//printf("banco9 : %s<br>",$banco9);
$banco10 = $rowxx['banco10'];//printf("banco10 : %s<br>",$banco10);
$banco11 = $rowxx['banco11'];//printf("banco11 : %s<br>",$banco11);
$banco12 = $rowxx['banco12'];//printf("banco12 : %s<br>",$banco12);
$banco13 = $rowxx['banco13'];//printf("banco13 : %s<br>",$banco13);
$banco14 = $rowxx['banco14'];//printf("banco14 : %s<br>",$banco14);
$banco15 = $rowxx['banco15'];//printf("banco15 : %s<br>",$banco15);
	
	
	$cta1 = $rowxx["cta1"];
	$cta2 = $rowxx["cta2"];
	$cta3 = $rowxx["cta3"];
	$cta4 = $rowxx["cta4"];
	$cta5 = $rowxx["cta5"];
	$cta6 = $rowxx['cta6'];//printf("cta6 : %s<br>",$cta6);
$cta7 = $rowxx['cta7'];//printf("cta7 : %s<br>",$cta7);
$cta8 = $rowxx['cta8'];//printf("cta8 : %s<br>",$cta8);
$cta9 = $rowxx['cta9'];//printf("cta9 : %s<br>",$cta9);
$cta10 = $rowxx['cta10'];//printf("cta10 : %s<br>",$cta10);
$cta11 = $rowxx['cta11'];//printf("cta11 : %s<br>",$cta11);
$cta12 = $rowxx['cta12'];//printf("cta12 : %s<br>",$cta12);
$cta13 = $rowxx['cta13'];//printf("cta13 : %s<br>",$cta13);
$cta14 = $rowxx['cta14'];//printf("cta14 : %s<br>",$cta14);
$cta15 = $rowxx['cta15'];//printf("cta15 : %s<br>",$cta15);
	
	
	$cheque1 = $rowxx["cheque1"];
	$cheque2 = $rowxx["cheque2"];
	$cheque3 = $rowxx["cheque3"];
	$cheque4 = $rowxx["cheque4"];
	$cheque5 = $rowxx["cheque5"];
$cheque6 = $rowxx['cheque6'];//printf("cheque6 : %s<br>",$cheque6);
$cheque7 = $rowxx['cheque7'];//printf("cheque7 : %s<br>",$cheque7);
$cheque8 = $rowxx['cheque8'];//printf("cheque8 : %s<br>",$cheque8);
$cheque9 = $rowxx['cheque9'];//printf("cheque9 : %s<br>",$cheque9);
$cheque10 = $rowxx['cheque10'];//printf("cheque10 : %s<br>",$cheque10);
$cheque11 = $rowxx['cheque11'];//printf("cheque11 : %s<br>",$cheque11);
$cheque12 = $rowxx['cheque12'];//printf("cheque12 : %s<br>",$cheque12);
$cheque13 = $rowxx['cheque13'];//printf("cheque13 : %s<br>",$cheque13);
$cheque14 = $rowxx['cheque14'];//printf("cheque14 : %s<br>",$cheque14);
$cheque15 = $rowxx['cheque15'];//printf("cheque15 : %s<br>",$cheque15);	
}


$sqlxx24 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx24 = mysql_db_query($database, $sqlxx24, $connectionxx);

while($rowxx24 = mysql_fetch_array($resultadoxx24)) 
{
  $nom_jefe_ppto=$rowxx24["nom_jefe_ppto"];
  $raz_soc=$rowxx24["raz_soc"];
    $crtl_doc=$rowxx24["control_doc"];
}
$ver ="";
if ($crtl_doc == 'NO') $ver = "style='display:none'";
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
	  <h3>NOTA CREDITO  SIN AFECTACION PRESUPUESTAL  </h3> 
	</div>
	</div>	</td>
    <td width="217" bgcolor="#FFFFFF">
	<div class="Estilo4" style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:20px;">
	<div align="center">
	  <span class="Estilo9"><strong class="Estilo17">No. <? printf("%s",$id_manu_ncon); ?></strong>	  </span></div>
	</div>	</td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">Fecha : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left"><? printf("%s",$fecha_ncon); ?> </div>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo16" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right">A Favor de  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <? printf("%s",$tercero); ?> </div></td>
    </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo16">Concepto / Descripcion  : </div>
    </div></td>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
<? printf("%s",$des_ncon); ?>
    </div></td>
  </tr>
</table>
<div align="center"><br>
    <?
$sqlxx2 = "select * from conta_ncsp where id_auto_ncon ='$id' and id_emp='$id_emp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

printf("
<table width='800' border='1' align='center' class='bordepunteado1'>
  <tr>
    <td colspan='4' bgcolor='#DCE9E5'><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='center' class='Estilo20'><strong>CONTABILIDAD</strong></div>
    </div></td>
  </tr>
  <tr>
    <td width='200' bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='center' class='Estilo20'><strong>CUENTA P.G.C.P </strong></div>
    </div></td>
    <td width='340' bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='center' class='Estilo20'><strong>NOMBRE CUENTA PGCP </strong></div>
    </div></td>
    <td width='130' bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='center' class='Estilo20'><strong>VALOR DEBITO </strong></div>
    </div></td>
    <td width='130' bgcolor='#F5F5F5'><div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
      <div align='center' class='Estilo20'><strong>VALOR CREDITO </strong></div>
    </div></td>
  </tr>
");

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{

	for($i=1;$i<16;$i++)
	{
	    if($rowxx2["pgcp".$i] == '' and $rowxx2["vr_deb_".$i] == 0.00 and $rowxx2["vr_cre_".$i] == 0.00 )
			 {
			 }
		else
		{	 
		
			$cod=$rowxx2["pgcp".$i];
			$ss2 = "select * from pgcp where id_emp = '$id_emp' and cod_pptal = '$cod'";
			$rr2 = mysql_db_query($database, $ss2, $connectionxx);
			while($rrw2 = mysql_fetch_array($rr2)) 
			{
			  $nom_rubro2=$rrw2["nom_rubro"];
			}
		
		
			printf("<tr>
			<td style='text-align:left;' class='Estilo20'>&nbsp;".$rowxx2["pgcp".$i]."</td>
			<td style='text-align:left;' class='Estilo20'>&nbsp;".$nom_rubro2."&nbsp;</td>
			<td style='text-align:right;' class='Estilo20'>".$rowxx2["vr_deb_".$i]."&nbsp;</td>
			<td style='text-align:right;' class='Estilo20'>".$rowxx2["vr_cre_".$i]."&nbsp;</td>
			</tr>");	
		}
	}
}
printf("
			<tr bgcolor='#F5F5F5'>
			<td colspan='2' style='text-align:right;' class='Estilo20'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			&nbsp;<b>SUMAS IGUALES</b>&nbsp;
			</div>
			</td>
			<td style='text-align:right;' class='Estilo20'><b>".$tot_deb."</b>&nbsp;</td>
			<td style='text-align:right;' class='Estilo20'><b>".$tot_cre."</b>&nbsp;</td>
			</tr>
</table>");
?>
    <br>
    <table width="800" border="1" align="center" class="bordepunteado1">
      
      <tr>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="right" class="Estilo16">
              <div align="center">BANCOS</div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="right" class="Estilo16">
              <div align="center">NO. DE CUENTA </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="right" class="Estilo16">
              <div align="center">
                <DIV align="center"><STRONG>No. Dcto / Cheque </STRONG></DIV>
              </div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="right" class="Estilo16">
              <div align="center">VALOR</div>
            </div>
        </div></td>
      </tr>
      <tr>
        <? if ($banco1 == '' and $cta1 == '' and $cheque1 == '') {?>
        <? } else {
			$sqlxx1a = "select * from conta_ncsp where id_emp ='$id_emp' and banco1 = '$banco1' and cta1 = '$cta1' and cheque1 = '$cheque1'";
			$resultadoxx1a = mysql_db_query($database, $sqlxx1a, $connectionxx);
			
			while($rowxx1a = mysql_fetch_array($resultadoxx1a)) 
			{
			  $vr_cre_1a=$rowxx1a["vr_cre_1"];
			}
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco1); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta1); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque1); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_1a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco2 == '' and $cta2 == '' and $cheque2 == '') {?>
        <? } else {
			$sqlxx2a = "select * from conta_ncsp where id_emp ='$id_emp' and banco2 = '$banco2' and cta2 = '$cta2' and cheque2 = '$cheque2'";
			$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);
			
			while($rowxx2a = mysql_fetch_array($resultadoxx2a)) 
			{
			  $vr_cre_2a=$rowxx2a["vr_cre_2"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco2); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta2); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque2); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_2a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr>
        <? if ($banco3 == '' and $cta3 == '' and $cheque3 == '') {?>
        <? } else {
			$sqlxx3a = "select * from conta_ncsp where id_emp ='$id_emp' and banco3 = '$banco3' and cta3 = '$cta3' and cheque3 = '$cheque3'";
			$resultadoxx3a = mysql_db_query($database, $sqlxx3a, $connectionxx);
			
			while($rowxx3a = mysql_fetch_array($resultadoxx3a)) 
			{
			  $vr_cre_3a=$rowxx3a["vr_cre_3"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco3); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta3); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque3); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_3a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco4 == '' and $cta4 == '' and $cheque4 == '') {?>
        <? } else {
			$sqlxx4a = "select * from conta_ncsp where id_emp ='$id_emp' and banco4 = '$banco4' and cta4 = '$cta4' and cheque4 = '$cheque4'";
			$resultadoxx4a = mysql_db_query($database, $sqlxx4a, $connectionxx);
			
			while($rowxx4a = mysql_fetch_array($resultadoxx4a)) 
			{
			  $vr_cre_4a=$rowxx4a["vr_cre_4"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco4); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta4); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque4); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_4a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco5 == '' and $cta5 == '' and $cheque5 == '') {?>
        <? } else {
			$sqlxx5a = "select * from conta_ncsp where id_emp ='$id_emp' and banco5 = '$banco5' and cta5 = '$cta5' and cheque5 = '$cheque5'";
			$resultadoxx5a = mysql_db_query($database, $sqlxx5a, $connectionxx);
			
			while($rowxx5a = mysql_fetch_array($resultadoxx5a)) 
			{
			  $vr_cre_5a=$rowxx5a["vr_cre_5"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco5); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta5); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque5); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_5a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco6 == '' and $cta6 == '' and $cheque6 == '') {?>
        <? } else {
			$sqlxx6a = "select * from conta_ncsp where id_emp ='$id_emp' and banco6 = '$banco6' and cta6 = '$cta6' and cheque6 = '$cheque6'";
			$resultadoxx6a = mysql_db_query($database, $sqlxx6a, $connectionxx);
			
			while($rowxx6a = mysql_fetch_array($resultadoxx6a)) 
			{
			  $vr_cre_6a=$rowxx6a["vr_cre_6"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco6); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta6); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque6); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_6a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco7 == '' and $cta7 == '' and $cheque7 == '') {?>
        <? } else {
			$sqlxx7a = "select * from conta_ncsp where id_emp ='$id_emp' and banco7 = '$banco7' and cta7 = '$cta7' and cheque7 = '$cheque7'";
			$resultadoxx7a = mysql_db_query($database, $sqlxx7a, $connectionxx);
			
			while($rowxx7a = mysql_fetch_array($resultadoxx7a)) 
			{
			  $vr_cre_7a=$rowxx7a["vr_cre_7"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco7); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta7); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque7); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_7a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco8 == '' and $cta8 == '' and $cheque8 == '') {?>
        <? } else {
			$sqlxx8a = "select * from conta_ncsp where id_emp ='$id_emp' and banco8 = '$banco8' and cta8 = '$cta8' and cheque8 = '$cheque8'";
			$resultadoxx8a = mysql_db_query($database, $sqlxx8a, $connectionxx);
			
			while($rowxx8a = mysql_fetch_array($resultadoxx8a)) 
			{
			  $vr_cre_8a=$rowxx8a["vr_cre_8"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco8); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta8); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque8); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_8a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco9 == '' and $cta9 == '' and $cheque9 == '') {?>
        <? } else {
			$sqlxx9a = "select * from conta_ncsp where id_emp ='$id_emp' and banco9 = '$banco9' and cta9 = '$cta9' and cheque9 = '$cheque9'";
			$resultadoxx9a = mysql_db_query($database, $sqlxx9a, $connectionxx);
			
			while($rowxx9a = mysql_fetch_array($resultadoxx9a)) 
			{
			  $vr_cre_9a=$rowxx9a["vr_cre_9"];
			}
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco9); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta9); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque9); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_9a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco10 == '' and $cta10 == '' and $cheque10 == '') {?>
        <? } else {
			$sqlxx10a = "select * from conta_ncsp where id_emp ='$id_emp' and banco10 = '$banco10' and cta10 = '$cta10' and cheque10 = '$cheque10'";
			$resultadoxx10a = mysql_db_query($database, $sqlxx10a, $connectionxx);
			
			while($rowxx10a = mysql_fetch_array($resultadoxx10a)) 
			{
			  $vr_cre_10a=$rowxx10a["vr_cre_10"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco10); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta10); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque10); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_10a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco11 == '' and $cta11 == '' and $cheque11 == '') {?>
        <? } else {
			$sqlxx11a = "select * from conta_ncsp where id_emp ='$id_emp' and banco11 = '$banco11' and cta11 = '$cta11' and cheque11 = '$cheque11'";
			$resultadoxx11a = mysql_db_query($database, $sqlxx11a, $connectionxx);
			
			while($rowxx11a = mysql_fetch_array($resultadoxx11a)) 
			{
			  $vr_cre_11a=$rowxx11a["vr_cre_11"];
			}	
	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco11); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta11); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque11); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_11a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco12 == '' and $cta12 == '' and $cheque12 == '') {?>
        <? } else {
			$sqlxx12a = "select * from conta_ncsp where id_emp ='$id_emp' and banco12 = '$banco12' and cta12 = '$cta12' and cheque12 = '$cheque12'";
			$resultadoxx12a = mysql_db_query($database, $sqlxx12a, $connectionxx);
			
			while($rowxx12a = mysql_fetch_array($resultadoxx12a)) 
			{
			  $vr_cre_12a=$rowxx12a["vr_cre_12"];
			}	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco12); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta12); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque12); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_12a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco13 == '' and $cta13 == '' and $cheque13 == '') {?>
        <? } else {
			$sqlxx13a = "select * from conta_ncsp where id_emp ='$id_emp' and banco13 = '$banco13' and cta13 = '$cta13' and cheque13 = '$cheque13'";
			$resultadoxx13a = mysql_db_query($database, $sqlxx13a, $connectionxx);
			
			while($rowxx13a = mysql_fetch_array($resultadoxx13a)) 
			{
			  $vr_cre_13a=$rowxx13a["vr_cre_13"];
			}	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco13); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta13); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque13); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_13a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco14 == '' and $cta14 == '' and $cheque14 == '') {?>
        <? } else {
			$sqlxx14a = "select * from conta_ncsp where id_emp ='$id_emp' and banco14 = '$banco14' and cta14 = '$cta14' and cheque14 = '$cheque14'";
			$resultadoxx14a = mysql_db_query($database, $sqlxx14a, $connectionxx);
			
			while($rowxx14a = mysql_fetch_array($resultadoxx14a)) 
			{
			  $vr_cre_14a=$rowxx14a["vr_cre_14"];
			}	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco14); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta14); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque14); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_14a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
      <tr bgcolor="#F5F5F5">
        <? if ($banco15 == '' and $cta15 == '' and $cheque15 == '') {?>
        <? } else {
			$sqlxx15a = "select * from conta_ncsp where id_emp ='$id_emp' and banco15 = '$banco15' and cta15 = '$cta15' and cheque15 = '$cheque15'";
			$resultadoxx15a = mysql_db_query($database, $sqlxx15a, $connectionxx);
			
			while($rowxx15a = mysql_fetch_array($resultadoxx15a)) 
			{
			  $vr_cre_15a=$rowxx15a["vr_cre_15"];
			}	
	?>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$banco15); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cta15); ?> </div></td>
        <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$cheque15); ?> </div></td>
        <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("".number_format($vr_cre_15a,2,',','.').""); ?>&nbsp;</div></td>
        <? } ?>
      </tr>
    </table>
</div><br>

<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" class="Estilo4"><p>
      <?
	$sqlxx2 = "select * from empresa where cod_emp='$id_emp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $nom_jefe_ppto=$rowxx2["nom_jefe_ppto"];
  $raz_soc=$rowxx2["raz_soc"];
    $crtl_doc=$rowxx2["control_doc"];
}
$ver ="";
if ($crtl_doc == 'NO') $ver = "style='display:none'";

	$sq3 ="select * from usuarios2 where login ='$_SESSION[login]'";
	$rs3 = mysql_db_query($database,$sq3,$connectionxx);
	$rw3 = mysql_fetch_array($rs3);
	?>
    </p>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
      <div align="center">______________________________<br>
          <span class="Estilo16"><? echo strtoupper($rw3["nombre"]). " ". strtoupper($rw3["apaterno"])." ". strtoupper($rw3["amaterno"]) ; ?><br>
            <?php echo $rw3["cargo"]; ?></span></div>
      <br></td>
  </tr>
</table>
<br>

<table width="800" border="1" align="center" class="bordepunteado1"  <?php echo $ver; ?>>
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
$consecutivo = $id_manu_ncon;

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
</body>
</html>
<?
}
?>