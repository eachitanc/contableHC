<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
	// verifico permisos del usuario
		include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['conta']=='SI')
{

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


<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<!--validacion de forms-->
<script src="../jquery.js"></script>
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
function chk_obcg(){
var pos_url = '../comprobadores/comprueba_obcg.php';
var cod = document.getElementById('id_manu_obcg').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_obcg').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}

function consecutivo2()
{
var fec = document.getElementById('fecha_obcg').value;
var pos_url2 = 'consultas/concec_obcg.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				var elem = dato.split(',');
				concec = elem[0];
				fecha2 = elem[1];
				document.getElementById('id_manu_obcg').value =concec;
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2);
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+fec,true);
	req1.send(null);
	}

}
</script>

    <script type="text/javascript">
function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
	var x =screen.width;
    ventana.style.marginTop = "200px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
    ventana.style.marginLeft = x-300;//((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
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
<script>

var existe=1
function validar_t()
{
		var fechaobcg=document.getElementById("fecha_obcg").value;
		var fechacobp=document.getElementById("fecha_cobp").value;
		var i=0;
		if(fechaobcg<fechacobp)
		{
			 alert("La fecha es menor a la obligacion presupuestal..");
			document.getElementById('fecha_obcg').focus();
			return (false);
		
		}
		if(document.getElementById("total").value!="0.00" && document.getElementById("total").value!="0" )
		{
			alert ("Verifique que las sumas sean Iguales...");
			document.getElementById('total').focus();
			return (false);
		}
		// validar que la cuenta no sea pgcp o este en blanco
		var filas =document.getElementById('contador').value;
		for (i=1;i<=filas;i++)
		{
			var cuenta = document.getElementById('pgcp'+i).value;
			var rest = pgcp(cuenta);
			if (rest =='')
			{
				alert('Verifique cuenta contable...');
				document.getElementById('pgcp'+i).select();
				return false;
			}	
		}

	return true;
	
}

function pgcp(id)
{
var dato='';
var pos_url2 = 'consultas/conta_pgcp.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				 dato = req1.responseText;
				
			}
		}
	
	req1.open('POST', pos_url2 +'?cod='+id,false);
	req1.send(null);
	}
	 return dato;	
}
</script>

</head>

<body onload=consecutivo2();>
<?
$id_auto_cobp = $_GET['id0'];
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where id_auto_cobp ='$id_auto_cobp'";
$re = mysql_db_query($database, $sq, $cx);
$ide=0;$con=0;
$tuplas2 = 0;
$xcodcu=array();
print_r($xcodcu);
while($rw = mysql_fetch_array($re))
{
    $cod_cca = $rw["cuenta"];
    $nom_cca = $rw["nom_rubro"];
    $sq2 = "select * from cca_gas where cod_pptal='$cod_cca'";
    $re2 = mysql_db_query($database, $sq2, $cx);
    $tuplas = @mysql_num_rows($re2);
    if($tuplas == 0){
         $xcodcu[0]='';
         $xnomcu[0]='';
         $xcodcu[1]='';
         $xnomcu[1]='';
         $vrade[0]=$vrade[0]+$rw["vr_digitado"];
         $vrade[1]='';
         $vracr[1]= $vracr[1]+$rw["vr_digitado"];
         $vracr[0]='';
       }
    else{
           $band=0;
           $cod = mysql_result($re2,0,1);
           $nom = mysql_result($re2,0,2);
           $codcp=mysql_result($re2,0,3);
           for($hg=0;$hg<count($xcodcu);$hg++){
              if($codcp==$xcodcu[$hg]){$band=1;break;}
           }
           if($band == 1){
             $vrade[$hg] = $vrade[$hg] + $rw["vr_digitado"];
           }
           else{
             $vrade[$ide] = $rw["vr_digitado"];
             $vracr[$ide] = '';
             $xcodcu[$ide] = mysql_result($re2,0,3);
             $sq3 = "Select nom_rubro from pgcp where cod_pptal = '$xcodcu[$ide]';";
			 echo $sq3;
             $re3 = mysql_db_query($database, $sq3, $cx);
             $xnomcu[$ide]=mysql_result($re3,0,0);
             $tuplas2++;
             $ide++;
           }
           $band=0;
           $codcp=mysql_result($re2,0,8);
           for($hg=0;$hg<count($xcodcu);$hg++){
              if($codcp==$xcodcu[$hg]){$band=1;break;}
           }
           if($band == 1){
             $vracr[$hg] = $vracr[$hg] + $rw["vr_digitado"];
           }
           else{
             $vracr[$ide] = $rw["vr_digitado"];
             $vrade[$ide] = '';
             $xcodcu[$ide] = mysql_result($re2,0,8);
             $sq3 = "Select nom_rubro from pgcp where cod_pptal = '$xcodcu[$ide]';";
             $re3 = mysql_db_query($database, $sq3, $cx);
             $xnomcu[$ide]=mysql_result($re3,0,0);
             $tuplas2++;
             $ide++;
          }
   }
}

if($tuplas2 == 0){$tuplas2=2;}
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
      <div align="center" class="Estilo4"><strong>OBLIGACION CONTABLE DEL GASTO  </strong>
<?php 

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $idxx=$rowxx["id_emp"];
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}

$sqlxx2 = "select * from cobp where id_emp ='$id_emp' and id_auto_cobp='$id_auto_cobp'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $cx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $id_manu_cobp=$rowxx2["id_manu_cobp"];
  $fecha_cobp=$rowxx2["fecha_cobp"];
  $tercero=$rowxx2["tercero"];
  $ccnit=$rowxx2["ccnit"];
  $des_cobp=$rowxx2["des_cobp"];
  $id_auto_crpp=$rowxx2["id_auto_crpp"];
  
  
}

$sqlxx3 = "select * from crpp where id_emp ='$id_emp' and id_auto_crpp='$id_auto_crpp'";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $cx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
{
  $pago=$rowxx3["pago"];
}

?>
      </div>
    </div>  </td>
  </tr>
  
  <form name="a" method="post" id="commentForm" action="proc_obcg.php">
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
          <div align="center" class="Estilo4"><strong>DATOS GENERALES DE LA OBLIGACION PRESUPUESTAL </strong></div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Codigo COBP :  </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><? printf("%s",$id_manu_cobp);?>
              <input name="id_manu_cobp" type="hidden" value="<? printf("%s",$id_manu_cobp);?>" />
              <input name="id_auto_cobp" type="hidden" value="<? printf("%s",$id_auto_cobp);?>" />
          </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Fecha COBP : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><? printf("%s",$fecha_cobp);?>
              <input name="fecha_cobp" type="hidden" id="fecha_cobp" value="<? printf("%s",$fecha_cobp);?>" />
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tercero : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$tercero);?>
              <input name="tercero" type="hidden" value="<? printf("%s",$tercero);?>" />
              </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>C.C. / NIT  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$ccnit);?>
              <input name="ccnit" type="hidden" value="<? printf("%s",$ccnit);?>" />
              </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Descripcion COBP : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$des_cobp);?>
                <input name="des_cobp" type="hidden" value="<? printf("%s",$des_cobp);?>" />
            </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tipo de Pago  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="left"><? printf("%s",$pago);?>
                <input name="pago" type="hidden" value="<? printf("%s",$pago);?>" />
            </div>
          </div>
        </div></td>
        </tr>
      
      <tr>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
        <td width="195"></td>
      </tr>
    </table>
    <br />  
    <table width="90%" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="90%" colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>DATOS DEL CERTIFICADO DE OBLIGACION PRESUPUESTAL </strong></div>
        </div></td>
      </tr>
    </table>
    <div align="center"><br />
        <?
$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$id_auto_cobp' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

echo "
<center>
<table width='90%' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='225'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>
<td align='center' width='325'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>FTE FINANCIACION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>VALOR</b></span></td>
</tr>
";

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
<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>

</tr>

", $rw["cuenta"], $nom_rubro, $fte, $rw["vr_digitado"]); 

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
    <td align='right'><span class='Estilo4'><b> %.2f &nbsp;</b> </span></td>
  </tr>
</table></center>",$nuevo_total);
//--------  

    ?>
        <input name="total1" type="hidden" value="<? printf("%s",$nuevo_total);?>" />
        <br />
      <br />
      <table width="90%" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>DATOS DE CONTRATACION </strong></div>
          </div>          </td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table>
    </div>
    <br />
    <br />

    <table width="90%" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4"><strong>DATOS OBLIGACION CONTABLE DEL GASTO </strong></div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fecha  OBCG : </strong></div>
          </div>
        </div></td>
        <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <input name="fecha_obcg" type="text" class="Estilo12" id="fecha_obcg" value="<? printf("%s",$fecha_cobp);?>" size="12" onchange="consecutivo2();" />
            <span class="Estilo8">:::</span>
            <input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.forms[0].fecha_obcg,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>
              <?
        $resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'obcg'");
        while($array = mysql_fetch_array($resulta)) 
        {
        $xa = $array["Auto_increment"];
        }
        ?>
              Numero OBCG   : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><? printf("%s",$xa);?>
                <input name="id_auto_obcg" type="hidden" class="Estilo12" id="id_auto_obcg" value="<? printf("%s",$xa);?>"/>
            </div>
          </div>
        </div></td>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Digite Numero  de OBCG : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <p>
                <input name="id_manu_obcg" type="text" class="required Estilo4" id="id_manu_obcg" style="text-align:center" onkeypress="return validar(event)" onkeyup="chk_obcg();" />
                
                
                 <a href="javascript:mostrarVentana();">Mas</a>
               <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana,
                    Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 
                     3px solid; background-color: #FAFAFA; color: #000000; display:none;"> 
                     
                    <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">
                          <table border="0" width="100%">
                           <tr>
                              <td>Consecutivos del Documento</td>
                              <td align="right"><img src="../simbolos/cerrar.png"  width="15" border="0"
                                 onclick="ocultarVentana();" onmouseover="Puntero();" onmouseout="PunteroNormal();">
                               </td>
                            </tr> 
                          </table>
                      </div>
                      <iframe id="datamain" src="obcgconsecutivo.php"  width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
              </div>
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div class="Estilo4" align="center" id='res_obcg'></div>
              </div>
                
                
                
            
    
          </div>
        </div>
    </div>
        </td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Concepto  OBCG : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="left">
              <input name="concepto_obcg" type="text" class="required Estilo12" id="concepto_obcg" size="100" onkeyup='a.concepto_obcg.value=a.concepto_obcg.value.toUpperCase();' value="<?php printf('%s',$des_cobp); ?>" />
            </div>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Referencia  OBCG : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="left">
              <input name="referencia_obcg" type="text" class="Estilo12" id="referencia_obcg" size="100" onkeyup="a.referencia_obcg.value=a.referencia_obcg.value.toUpperCase();" />
            </div>
          </div>
        </div></td>
        </tr>
    </table>    </td>
  </tr>
  <tr>
  <td colspan="3">
  <table width="90%" border="1" align="center" class="bordepunteado1">
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
          <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='masitem(50);'>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span id='contis' class='Estilo4'><? echo $tuplas2; ?></span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='menitem();'>
          </strong></div>
          <input type="hidden" name='contador' value=<? echo $tuplas2; ?> id="contador">
      </div></td>
    </tr>
    <tr>
      <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P &nbsp;</strong><a href="../pgcp/carga_pgcp.php" target="_new">Nuevo</a></div>
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
          <div align="center" class="Estilo4"><strong>DOCUMENTO </strong></div>
      </div></td>
    </tr>
    <?
     //$acc='block';
	 $cont=0;
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
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value=<? echo "$nuevo_total.00";?> onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value=<? echo "$nuevo_total.00";?> onkeyup='Calcular();'>
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
          <input name="Submit" type="submit" class="Estilo4" value="Grabar Obligacion Contable del Gasto"  onclick=" return validar_t();" />
          
         <!-- onclick="return noVacio4(this.form,this.form.contador.value,8,13);" -->
          
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
<input type='hidden' name='nn' value='OBCG'>
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
          <? include('../config.php');              
          echo $ano;
          mysql_close();
          ?>
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
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
}
}
?>