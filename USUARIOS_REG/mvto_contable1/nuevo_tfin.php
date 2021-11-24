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
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>
<script language="JavaScript" type="text/javascript" src="javas.js"></script>

<!--muestra - oculta naturales -->
<SCRIPT language="javascript">
function MostrarOcultar (objetoVisualizar) 
{
        if (document.all['naturales'].style.display=='none')
        {
        document.all['naturales'].style.display='block';
        document.a.ter_nat.disabled=false;
        document.all['juridicos'].style.display='none';
        document.a.ter_jur.disabled=true;
        }
        else 
        {
        document.a.ter_nat.disabled=true;
        document.a.ter_jur.disabled=true;
        document.all['naturales'].style.display='none';
        document.all['juridicos'].style.display='none';
        }
}
</SCRIPT>
<!--muestra - oculta juridicos -->
<SCRIPT language="javascript">
function MostrarOcultar2 (objetoVisualizar) 
{
    
        if (document.all['juridicos'].style.display=='none') 
        {
        document.all['naturales'].style.display='none';
        document.a.ter_nat.disabled=true;
        document.all['juridicos'].style.display='block';
        document.a.ter_jur.disabled=false;
        }
        else 
        {
        document.a.ter_nat.disabled=true;
        document.a.ter_jur.disabled=true;
        document.all['naturales'].style.display='none';
        document.all['juridicos'].style.display='none';
        }
}
</SCRIPT>  
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
.Estilo14 {color: #0000FF}
</style>
<script>
$(document).ready(function(){
$("#commentForm").validate();
});
</script>

<script>
function chk_tfin(){
if(document.getElementById('id_manu_ncon').value != ""){
var pos_url = '../comprobadores/comprueba_tfin.php';
var cod = document.getElementById('id_manu_ncon').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_ncon').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
}

function consecutivo2()
{
var fec = document.getElementById('fecha_ncon').value;
var pos_url2 = 'consultas/concec_tfin.php';	
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
				document.getElementById('id_manu_ncon').value =concec;
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2);
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+fec,false);
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
<!--fin val forms--> 
</head>

<body onload=consecutivo2();>
<table width="800" border="0" align="center">
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
      <div align="center" class="Estilo4"><strong>NUEVO TRANSFERENCIA DE DATOS INTERNOS </strong></div>
    </div>  </td>
  </tr>
  
  <form name="a" method="post" class="Form" id="commentForm" action='proc_tfin.php'>
  <tr>
  <td colspan="3">
    <table width="900" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5">
        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
            <?
            include('../config.php');               
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
    }
            ?>
            <strong>DATOS TRANSFERENCIA DE FONDOS INTERNOS </strong>            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Fecha  TFIN : </strong></div>
          </div>
        </div></td>
        <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left">
            <input name="fecha_ncon" type="text" class="required Estilo12" id="fecha_ncon" value="<? printf("%s",$ano);?>" size="12" onchange="consecutivo2();" />
            <span class="Estilo8">:::</span>
            <input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.forms[0].fecha_ncon,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
          </div>
        </div></td>
        <td bgcolor="#FFFFFF">
        <input type="hidden" name="id_emp" value="<? printf("%s",$id_emp);?>" />
        </td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>
              <?
        $resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'conta_tfin'");
        while($array = mysql_fetch_array($resulta)) 
        {
        $xa = $array["Auto_increment"];
        }
        ?>
              No. Automatico de TFIN   : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><? printf("%s",$xa);?>
                <input name="id_auto_ncon" type="hidden" class="Estilo12" id="id_auto_ncon" value="<? printf("%s",$xa);?>"/>
            </div>
          </div>
        </div></td>
        <td bgcolor="#F5F5F5" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Digite Numero  de TFIN : </strong></div>
          </div>
        </div></td>
        <td bgcolor="#FFFFFF" width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="center">
              <input name="id_manu_ncon" type="text" class="required Estilo4" id="id_manu_ncon" style="text-align:center" onkeypress="return validar(event)" onkeyup="chk_tfin();" />
              
              
  
        
        
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
                      <iframe id="datamain" src="tfinconsecutivo.php"  width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
              </div>
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div class="Estilo4" align="center" id='res_ncon'></div>
              </div>
        
        
        
            </div>
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Seleccione Tercero  : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><table border="0" align="left">
          <tr>
            <td><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="left"> <strong> Seleccione el Tipo de Tercero</strong> <br />
                    <br />
                    <span class="Estilo14" 

onclick="JavaScript:MostrarOcultar('naturales');" onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'"> NATURAL</span> - <span class="Estilo14" onclick="JavaScript:MostrarOcultar2('juridicos');" onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" 

onmouseout="this.style.textDecoration='none'"> JURIDICO</span> - <a href="../terceros/terceros.php" 

target="_parent">&iquest; NUEVO ?</a> </div>
            </div></td>
          </tr>
          <tr>
            <td id="naturales" style="display:none"><div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                <div align="left">
                  <select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" disabled="disabled">
                    <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$idxx' order by pri_ape asc ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
  $r = mysql_fetch_array($rs);
  echo "<OPTION VALUE=\"".$r["id"]."\">".$r["pri_ape"]." ".$r["seg_ape"]." ".$r["pri_nom"]." ".$r["seg_nom"]."</b></OPTION>";
}
?>
                  </select>
                </div>
            </div></td>
          </tr>
          <tr>
            <td id="juridicos" style="display:none"><div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                <div align="center">
                  <select name="ter_jur" class="Estilo4" id="ter_jur" style="width: 350px;" disabled="disabled">
                    <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$idxx' order by raz_soc2 asc ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
  $r = mysql_fetch_array($rs);
  echo "<OPTION VALUE=\"".$r["id"]."\">".$r["raz_soc2"]."</b></OPTION>";
}
?>
                  </select>
                </div>
            </div></td>
          </tr>
          <tr>
            <td><div align="center" class="Estilo4 Estilo10"></div></td>

          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="right"><strong>Concepto / Detalle TFIN : </strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo12">
            <div align="left">
              <input name="des_ncon" type="text" class="required Estilo12" id="des_ncon" size="118" />
            </div>
          </div>
        </div></td>
        </tr>
    </table>    </td>
  </tr>
  <tr>
  <td colspan="3">
  <table width="900" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="5" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
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
          <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE
          <input type="hidden" name='contador' value='2' id="contador"><br>
          <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='masitem();'>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span id='contis' class='Estilo4'>2</span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='menitem();'>
          </strong></div>
      </div></td>
    </tr>
    <tr>
      <td width="192" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
      </div></td>
      <td width="429" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>NOMBRE DE LA CUENTA</strong><strong></strong> </div>
      </div></td>
      <td width="130" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
      </div></td>
      <td width="134" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
      </div></td>
	  <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>No. Dcto / Cheque </strong></div>
      </div></td>		  
    </tr>
    <?
    // $acc='block';
     for($i=1;$i<51;$i++){
     echo "<tr style='position:relative; display:$acc;' id='fil$i'>
      <td valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
          <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' onkeyup='lookup(this.value,$i);'>
      </span></div>
     <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 200px; z-index:2'>
                <img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
                <div class='suggestionList' id='autoSug$i'>
                    &nbsp;
                </div>
     </div>
      </td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='left' id='resulta$i'></div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='vr_deb_$i' type='text' class='Estilo4' id='vr_deb_$i' style='text-align:right' value='0' onkeypress='return validar(event)' onKeyUp='Calcular();' onfocus='siespgcp($i);'>
            </div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='vr_cre_$i' type='text' class='Estilo4' id='vr_cre_$i' style='text-align:right' value='0' onkeypress='return validar(event)' onKeyUp='Calcular();' onfocus='siespgcp($i);'>
            </div>
          </div>
      </div></td>
	  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div align='right'>
              <input name='cheque_$i' type='text' class='Estilo4' id='cheque_$i' value=' ' style='text-align:right'>
            </div>
          </div>
      </div></td>	  
    </tr>";
    if($i==2){$acc='none';}}
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
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00"' onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
	  
 <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
          
          </div>
        </div>
      </div></td>	  
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
	  
	  
	   <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
           
          </div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="4" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8">
            <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
          </div>
      </div></td>
	   <td bgcolor="#990000"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
          
          </div>
        </div>
      </div></td>
      </tr>
    <tr>
      <td colspan="5"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <input name="Submit" type="submit" class="Estilo4" value="Grabar TRANSFERENCIA DE FONDOS INTERNOS" onclick="return noVacio5(this.form,this.form.contador.value)" />
		  																											
        </div>
      </div></td>
    </tr>
    <!--secciones de fila -->
    <!--secciones de fila -->
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
<input type='hidden' name='nn' value='TFIN'>
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
}
?>