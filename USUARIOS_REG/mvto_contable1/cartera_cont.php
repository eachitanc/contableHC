<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>

<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #666666;
}
a:link {
    text-decoration: none;
	color: #666666;
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
   .suggestionsBox {
        position: relative;
        left: 30px;
        margin: 0px 0px 0px 0px;
        width: 600px;
        background-color:#335194;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #2AAAFF;  
        color: #fff;
        font-size: 10px;
    }
   .suggestionList {
        margin: 0px;
        padding: 0px;
    }
    
    .suggestionList li {
        
        margin: 0px 0px 3px 0px;
        padding: 3px;
        cursor: pointer;
    }
    
    .suggestionList li:hover {
        background-color:#659CD8;
    }
-->
</style>
<script language="JavaScript" type="text/javascript" src="javas.js"></script>
<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo8 {color: #FFFFFF}
.Estilo9 {color: #F5F5F5}
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
<script>
function validar_f(form,contador)
{
	//return noValido4(form,contador,6,7);
	
	alert(form);
	alert(contador);
	
	
	
	
	return (false);
}
</script>


<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
    
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>
<!--validacion de forms-->
<script src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.validate.js"></script>
<style type="text/css">
* { font-family: Verdana; font-size: 10px; }
label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.Estilo10 {
    color: #990000;
    font-style: italic;
}
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});


function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
	var x =screen.width;
    ventana.style.marginTop = "200px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
    ventana.style.marginLeft = x-600;//((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible
	parent.frames['datamain'].window.location.reload();

}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
	
	
}

function Puntero()
{
	document.body.style.cursor="Pointer";
}

function PunteroNormal()
{
	document.body.style.cursor="Default";
}
</script>
</head>

<body>
<?
$consecutivo_reip = $_GET['valor'];
include('../config.php');               
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from reip_ing where consecutivo ='$consecutivo_reip'";
$re = mysql_db_query($database, $sq, $cx);
$ide=0;$con=0;
$tuplas2 = 2;
$xcodcu=array();
while($rw = mysql_fetch_array($re))
{
    
    $cod_cca = $rw["cuenta"];
    $nom_cca = $rw["nom_rubro"];
    $sql = "select * from cca_ing where cod_pptal='$cod_cca'";
    $result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
    $tuplas = @mysql_num_rows($result);
    if ($tuplas == 0)
       {
         $xcodcu[0]='';
         $xnomcu[0]='';
         $xcodcu[1]='';
         $xnomcu[1]='';
         $vrade[0]=$rw["valor"];
         $vrade[1]='';
         $vracr[1]=$rw["valor"];
         $vracr[0]='';
        }
            else
            {
           $band=0;
           $cod = mysql_result($result,0,1);
           $nom = mysql_result($result,0,2);
           $codcp=mysql_result($result,0,3);
           for($hg=0;$hg<count($xcodcu);$hg++){
              if($codcp==$xcodcu[$hg]){$band=1;break;}
           }
           if($band == 1){
             $vrade[$hg] = $vrade[$hg] + $rw["valor"];
           }
           else{
             $vrade[$ide] = $rw["valor"];
             $vracr[$ide] = '';
             $xcodcu[$ide] = mysql_result($result,0,3);
             $sq3 = "Select nom_rubro from pgcp where cod_pptal = '$xcodcu[$ide]';";
             $re3 = @mysql_db_query($database, $sq3, $cx);
             $xnomcu[$ide]=mysql_result($re3,0,0);
             $tuplas2++;
             $ide++;
           }
           $band=0;
           $codcp=mysql_result($result,0,8);
           for($hg=0;$hg<count($xcodcu);$hg++){
              if($codcp==$xcodcu[$hg]){$band=1;break;}
           }
           if($band == 1){
             $vracr[$hg] = $vracr[$hg] + $rw["valor"];
           }
           else{
             $vracr[$ide] = $rw["valor"];
             $vrade[$ide] = '';
             $xcodcu[$ide] = mysql_result($result,0,8);
             $sq3 = "Select nom_rubro from pgcp where cod_pptal = '$xcodcu[$ide]';";
             $re3 = @mysql_db_query($database, $sq3, $cx);
             $xnomcu[$ide]=mysql_result($re3,0,0);
             $tuplas2++;
             $ide++;
          }//fin while
      }//fin else
    
}

?>
<table width="90%" border="0" align="center">
  <tr>
    
    <td colspan="3">
    <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />    </div>
    </div>  </td>
  </tr>
  
  <tr>
    <td colspan="3">
    <div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>CAUSACION DE CARTERA </strong>
<?php 

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}
$sql = "select distinct(fecha_reg) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip'";
$resultado = mysql_db_query($database, $sql, $cx);
while($row = mysql_fetch_array($resultado)) {  $fecha_reg=$row["fecha_reg"]; }

$sql2 = "select distinct(des) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip'";
$resultado2 = mysql_db_query($database, $sql2, $cx);
while($row2 = mysql_fetch_array($resultado2)) {  $des=$row2["des"]; }

$sql3 = "select distinct(tercero) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip' group by tercero";
$resultado3 = mysql_db_query($database, $sql3, $cx);
while($row3 = mysql_fetch_array($resultado3)) {  $tercero=$row3["tercero"]; }

$sql3a = "select distinct(id_manu_reip) from reip_ing where id_emp ='$idxx' and consecutivo = '$consecutivo_reip' group by tercero";
$resultado3a = mysql_db_query($database, $sql3a, $cx);
while($row3a = mysql_fetch_array($resultado3a)) {  $id_manu_reip=$row3a["id_manu_reip"]; }

?>
      </div>
    </div>  </td>
  </tr>
  
  <form name="a" method="post" action="proc_cartera.php">
  <tr>
  <td colspan="3">
    <table width="90%" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
      </tr>
     
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>INFORMACION GENERAL DEL RECONOCIMIENTO </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>No. Reconocimiento </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><? printf("%s",$id_manu_reip);?>
          <input name="id_reip" type="hidden" value="<? printf("%s",$consecutivo_reip);?>" />
          </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>Fecha Reconocimiento </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><? printf("%s",$fecha_reg);?> </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tercero</strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"><? printf("%s",$tercero);?>
            <input name="tercero" type="hidden" id="tercero" value="<? printf("%s",$tercero);?>" />
            <input name="fecha_rec" type="hidden" id="fecha_rec" value="<? printf("%s",$fecha_reg);?>" />
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div class="Estilo4">
            <div align="right"><strong>Descripcion Reconocimiento </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4"><? printf("%s",$des);?></div>
        </div></td>
        </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">
          <div class="Estilo4">
            <div align="center">
              <?php
//-------
$sq = "select * from reip_ing where id_emp = '$idxx' and consecutivo ='$consecutivo_reip' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);
echo "<center><table width='90%'>";
printf("
<tr bgcolor='#DCE9E5'>
<td align='center' width='200'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Imputacion</b></span>
</div>
</td>
<td align='center' width='380'><span class='Estilo4'><b>Nombre</b></span></td>
<td align='center' width='200'><span class='Estilo4'><b>Valor</b></span></td>


</tr>


");

while($rw = mysql_fetch_array($re)) 
   {
printf("
<span class='Estilo4'>
<tr>


<td align='left' bgcolor='#F5F5F5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>


<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'> %.2f </span></td>



</tr>", $rw["cuenta"], $rw["nom_rubro"], $rw["valor"]); 


   }

//--------
?>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp;
        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div class="Estilo4">
            <div align="center"><strong>Valor Total Reconocimiento </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF">
        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div class="Estilo4">
            <div align="center">
$           
<?
$resulta=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE id_emp='$idxx' and consecutivo = '$consecutivo_reip' ",$cx) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$total_reip = $total;
printf("%.2f",$total_reip); 
?>
           <input name="valor_rec" type="hidden" id="valor_rec" value="<? printf("%.2f",$total_reip);?>" />
            </div>
          </div>
        </div></table></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><span class="Estilo8">I</span></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>DATOS NECESARIOS PARA  LA CAUSACION DE CARTERA </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Consecutivo</strong></div>
          </div>
        </div></td>
        <td>
        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"><span class="Estilo4">
            <?

$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'cartera_cont'");
while($array = mysql_fetch_array($resulta)) 
{
$consecutivo = $array["Auto_increment"];
}

?>
            
            
            <input name="consec_cartera" type="hidden" id="consec_cartera" value="<? printf("%s",$consecutivo);?>" />
              </span>    <input name="id_manu_ceva" type="text" class="required Estilo4" id="id_manu_ceva" style="text-align:center" onkeypress="return validar(event)"               
              
			  value="<? printf("%s",$consecutivo); ?>"  />
              
             
               
        <a href="javascript:mostrarVentana();">Mas</a>
               <div id="miVentana" style="position: fixed; width: 210px; height: 340px; top: 0; left: 0; font-family:Verdana,
                    Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 
                     3px solid; background-color: #FAFAFA; color: #000000; display:none;"> 
                     
                    <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">
                          <table border="0" width="100%">
                           <tr>
                              <td><font color="#FFFFFF"> Consecutivos del Documento </font></td>
                              <td align="right"><img src="../simbolos/cerrar.png"  width="15" border="0"
                                 onclick="ocultarVentana();" onmouseover="Puntero();" onmouseout="PunteroNormal();">
                               </td>
                            </tr> 
                          </table>
                      </div>
                      <iframe id="datamain" src="consultas/t_consecutivo.php"width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
              </div>
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div class="Estilo4" align="center" id='res_ncon'></div>
              </div>          </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>Fecha de Causacion </strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
      <? $fecha_causa = $ano; ?>
      <? include ("../objetos/incrementar_fecha.php");
	  $bb=incrementa_mes($fecha_reg); ?>
            <input name="fecha_causa" type="hidden" id="fecha_causa" value="<? printf("%s",$fecha_reg);?>" /> <input name="fecha_ca" type="text" class="required Estilo4" id="fecha_ca" value="<? printf("%s",$fecha_reg);?>" size="12" />
             <span class="Estilo8">:::</span> 
             <input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_ca,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
      </tr>
      
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"></div>
          </div>
        </div></td>
        <td  bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>Fecha de Vencimiento  </strong></div>
          </div>
        </div></td>
        <td ><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <input name="fecha_ven" type="text" class="required Estilo4" id="fecha_ven" value="<?php printf($bb); ?>" size="12" />
             <span class="Estilo8">:::</span> 
             <input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_ven,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        </tr>
        <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Referencia </strong></div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4">
            <div align="center">
              <input name="ref" type="text" class="required Estilo4" id="ref" onkeyup="a.ref.value=a.ref.value.toUpperCase();" size="60" />
            </div>
          </div>
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
  <td colspan="3"><table width="90%" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>IMPORTANTE</strong><br />
                <br />
              Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
              Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot; </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE<br>
          <input type="hidden" name='contador' value=<? echo $tuplas2; ?> id="contador">
          <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='masitem(50);'>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span id='contis' class='Estilo4'><? echo $tuplas2; ?></span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='menitem();'>
          </strong></div>
          
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DATOS DE LA CUENTA</strong><strong></strong> </div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
      </div></td>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>No. Dcto / Cheque </strong></div>
      </div></td>
    </tr>
    <?
     $acc='';$cont=0;
     for($i=1;$i<=50;$i++){
      $xnom='';$xcod='';$xvac='';$xvad='';
      if($cont < ($tuplas2-1)){
        $cont = $i - 1;
        $xvad=$vrade[$cont];
        $xvac=$vracr[$cont];
        $xnom=$xnomcu[$cont];
        $xcod=$xcodcu[$cont];
      }
     echo "<tr style='position:relative; display:$acc;' id='fil$i'>
      <td valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>
          <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' onkeyup='lookup(this.value,$i);' value='$xcod'>
      </span></div>
     <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 130px;'>
                <img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
                <div class='suggestionList' id='autoSug$i' align=left>
                    &nbsp;
                </div>
     </div>
     </td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='left' id='resulta$i'>$xnom</div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='vr_deb_$i' value='$xvad' type='text' class='Estilo4' id='vr_deb_$i' style='text-align:right' onkeypress='return validar(event)' onKeyUp='Calcular();' onfocus='siespgcp($i);'>
            </div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='vr_cre_$i' type='text' value='$xvac' class='Estilo4' id='vr_cre_$i' style='text-align:right' onkeypress='return validar(event)' onKeyUp='Calcular();' onfocus='siespgcp($i);'>
            </div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='center'>
              <input name='cheque$i' type='text' class='Estilo12' id='cheque1' style='text-align:right'/>
            </div>
          </div>
      </div></td>
    </tr>";
        if($i==($tuplas2)){$acc='none';}}
    ?>
    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR: </strong></div>
      </div></td>
      <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00" onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00" onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000">&nbsp;</td>
    </tr>
    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>DIFERENCIA: </strong></div>
      </div></td>
      <td bgcolor="#990000" colspan=2><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="center">
            <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value="0.00" onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8">
            <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
          </div>
      </div></td>
      </tr>
    <tr>
      <td colspan="5"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit" type="submit" class="Estilo4" value="Grabar Causaci&oacute;n de Cartera" onclick="return noVacio4(this.form,this.form.contador.value,8,10);" />
        </div>
      </div></td>
    </tr>
  </table></td>
  </tr>
  </form>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
      
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center">
              <?
printf("

<center class='Estilo4'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='CAIC'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

?>
            </div>
          </div>
        </div>
        </div>
    </div>  </td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <?echo $ano;?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
    <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
        <?PHP echo $dir_tel ?><BR />
        <?PHP echo $muni ?> <br />
        <?PHP echo $email?> </div>
    </div>  </td>
    <td width="266">
    <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
          </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO  </a></div>
    </div>  </td>
    <td width="266">
    <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
        <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
      Derechos Reservados - 2009    </div>
    </div>  </td>
  </tr>
</table>
</body>
</html>
<?
mysql_close();     
}
?>