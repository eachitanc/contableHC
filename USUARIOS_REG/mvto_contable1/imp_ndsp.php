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


			

$sqlxx = "select * from conta_ndsp where id_auto_ncon ='$id' and id_emp='$id_emp'";
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
	  <h3>NOTA DEBITO  SIN AFECTACION PRESUPUESTAL  </h3> 
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
$sqlxx2 = "select * from conta_ndsp where id_auto_ncon ='$id' and id_emp='$id_emp'";
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
      <?php
	for($j=0;$j<=15;$j++)
	{
            $sqle = "select * from conta_ndsp where id_auto_ncon = '$id'";
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
   
    <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"><span class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"><? printf("%s",$no_banco); ?></span></div></td>
    <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$no_cuenta); ?> </div></td>
    <td><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",$no_cheque); ?></div></td>
    <td align="right"><div class="Estilo21" style="padding-left:3px; padding-top:3x; padding-right:3px; padding-bottom:3px;"> <? printf("%s",number_format($valor_cr,0,',','.')); ?></div></td>
   
  </tr>
                            
                            <?
							}
						}
			  		  
			  
			}
			
  } ?>
  


    </table>
</div>
<br>
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
        <input name="preparo4" type="text" class="Estilo21" id="preparo4" value="" size="30" onKeyUp="a.preparo.value=a.preparo.value.toUpperCase();" style="border:0px">
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
        <input name="preparo22" type="text" class="Estilo21" id="preparo22" value="" size="30" onKeyUp="a.preparo2.value=a.preparo2.value.toUpperCase();" style="border:0px">
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo21">
        <input name="preparo23" type="text" class="Estilo21" id="preparo23" value="" size="30" onKeyUp="a.preparo2.value=a.preparo2.value.toUpperCase();" style="border:0px">
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