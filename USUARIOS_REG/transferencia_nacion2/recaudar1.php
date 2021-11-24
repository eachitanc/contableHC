<?
session_start();
if(!session_is_registered("login"))
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

<script>
var par=false;
function parpadeo() {
	document.getElementById('txt').style.visibility= (par) ? 'visible' : 'hidden';
	par = !par;
}
</script>




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
.Estilo14 {color: #0000CC}
.Estilo15 {color: #0000FF}
</style>
<script>
$(document).ready(function(){
$("#commentForm").validate();
});
</script>

<script>
function chk_ncbt(){
var pos_url = '../comprobadores/comprueba_tnat.php';
var cod = document.getElementById('id_manu_tnat').value;
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

function consecutivo2()
{
var fec = document.getElementById('fecha_recaudo').value;
var pos_url2 = 'consultas/concec_tnat.php';	
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
				document.getElementById('id_manu_tnat').value =concec;
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

//*************TABLA AUTO ************

var contLin=1;
function tabla_ini()
{
	agregar();
	agregar();
}


function agregar()
 {
	 fila = document.all.tablaf.rows.length - 1;
	 if(fila<14)
	 {
	var tr, td;
	//var v1=document.getElementById('retefuente').value;
	//var v2=document.getElementById('reteiva').value;
	//var v55=document.getElementById('id_obcg').value;

	tr = document.all.tablaf.insertRow();
	td = tr.insertCell();
	td.innerHTML = "<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'> <input type='text' size='25' style='text-align:left' id='pgcp"+contLin+"' name='pgcp"+contLin+"' value='' onkeyup='lookup(this.value,"+contLin+");' >  </span></div> <div class='suggestionsBox' id='sugges"+contLin+"' style='display: none; position:absolute; left: 130px;'><img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug"+contLin+"' align=left> &nbsp;  </div> </div>";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='50' style='text-align:left' name='des"+contLin+"' id='des"+contLin+"' value='' readonly >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='25' style='text-align:right' name='vr_deb_"+contLin+"' id='vr_deb_" + contLin + "' value=0  onKeyUp='suma_tab();' onkeypress='return validar(event)' >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='26' style='text-align:right' name='vr_cre_" + contLin + "' id='vr_cre_" + contLin + "' value=0  onKeyUp='suma_tab();' onkeypress='return validar(event)' >";
	
	document.getElementById("contis").innerHTML=contLin;
	contLin++;
	
	
	
	 }
}



function borrarUltima() 
{
	
	ultima = document.all.tablaf.rows.length - 1;
	//alert (ultima);
	if(ultima >=0)
	{
		document.all.tablaf.deleteRow(ultima);
		contLin--;
		document.getElementById("contis").innerHTML=contLin-1;
	}
}


//***********************************

function onload1()
{
		consecutivo2();
		document.getElementById("btn2").disabled=true;
	   // tabla_ini();

	//setInterval('parpadeo()',1000);
}

function generar_movimiento()
{ 


    var valor= document.getElementById("valor").value;
	var cuenta=document.getElementById("cuenta").value;	
	var sel1=document.getElementById("ter_nat").value;
	var sel2=document.getElementById("ter_jur").value;
	var sw1=0; sw2=0; 
	
	if(sel1=="" && sel2 =="")
	{
		alert("Debe seleccionar tercero para continuar...");
		sw1=1;
		
	}
	if(valor==''||cuenta=='')
	{
		if(cuenta==''&&sw1==0)
		{
			alert("No ha seleccionado cuenta");
			document.getElementById("cuenta").focus()
			sw1=1;
		}
		if(valor==''&&sw1==0)
		{
			alert("El campo valor esta vacio...");
			document.getElementById("valor").focus()
		}
	}
	else {

	con = document.all.tablaf.rows.length;
	aux=con;
	//alert ("fil"+con);
	for(var j=1; j<=con;j++)
	{
		borrarUltima();
	}
	contLin=1;
    agregar();
    agregar();	
	
	//alert ("cuenta" + cuenta);
	var pos_url2 = 'consultas/con_cca.php';	
	var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				var elem = dato.split(',');
				var pgcp1 = elem[0];
				var pgcp6 = elem[1];
				var rubro1 = elem[2];
				var rubro2 = elem[3];
				
				document.getElementById("pgcp1").value=pgcp1;
				document.getElementById("pgcp2").value=pgcp6;
				document.getElementById("des1").value=rubro1;
				document.getElementById("des2").value=rubro2;
				document.getElementById("vr_deb_1").value=valor;
				document.getElementById("vr_cre_2").value=valor;
				suma_tab();
				document.getElementById("btn1").disabled=false;
				document.getElementById("btn2").disabled=false;
				//alert(dato);
			}
		}
	req1.open('POST', pos_url2 +'?cod='+cuenta,false);
	req1.send(null);
	}
}
}
function suma_tab()
{
 	filas = document.all.tablaf.rows.length;	
	sum_deb=0;
	sum_cre=0;
	for(var i=1; i<=filas;i++)
	{ 
	     sum_deb=sum_deb+parseFloat(document.getElementById("vr_deb_"+i).value);
		 sum_cre=sum_cre+parseFloat(document.getElementById("vr_cre_"+i).value);
		 
		 
	}
	total=sum_deb-sum_cre;
	document.getElementById("tot_deb_a").value=Math.round(sum_deb*100)/100;
	document.getElementById("tot_cre_a").value=Math.round(sum_cre*100)/100;
	document.getElementById("total").value=Math.round(total*100)/100;

//	alert(sum_deb);
}



</script>

<!--fin val forms--> 

</head>

<body onload="onload1();">

<form name="a" method="POST" id="commentForm" action="proc_ncbt.php">
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3">
	<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>TRANSFERENCIA</strong>
        <?

include('../config.php');

// conexion				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// extraer datos
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}		

?>
      </div>
	</div>	</td>
  </tr>
  
  
  <tr>
  <td colspan="3">
 
  
	<table width="780" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="174"></td>
        <td width="160"></td>
        <td width="181"></td>
        <td width="235"></td>
      </tr>
     
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>INFORMACION REQUERIDA PARA LA TRANSFERENCIA  </strong></div>
        </div></td>
      </tr>
      
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tercero</strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="left" class="Estilo4">
            <table border="0" align="center">
              <tr>
                <td><div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"> <strong> Seleccione el Tipo de Tercero</strong> <br />
                        <br />
                        <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar('naturales');"> NATURAL</span> - <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar2('juridicos');"> JURIDICO</span> - <a href="../terceros/terceros.php" target="_parent">&iquest; NUEVO ?</a> </div>
                </div></td>
              </tr>
              <tr>
                <td id="naturales" style="display:none"><div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                    <div align="center">
                                            <select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" disabled="disabled">
                                            <option value=""> </option>
                        <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$id_emp' order by  pri_ape asc ";
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
                    <option value=""> </option>
                      <?
include('../config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$id_emp' order by raz_soc2 asc ";
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
                <td>
				<div align="center" class="Estilo4 Estilo10">NO OLVIDE SELECCIONAR EL TERCERO  </div>
				</td>
              </tr>
            </table>
          </div>
        </div></td>
        </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Consecutivo</strong></div>
            </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center"> <span class="Estilo4">
              <?

new mysqli($server, $dbuser, $dbpass, $database);
$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'recaudo_tnat'");
while($array = mysql_fetch_array($resulta)) 
{
$consec_recaudo = $array[Auto_increment];
}

?>
              <? printf("%s",$consec_recaudo);?>
              <input name="consec_ncbt" type="hidden" id="consec_ncbt" value="<? printf("%s",$consec_recaudo);?>" />
            </span></div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Consecutivo Manual : </strong></div>
          </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <input name="id_manu_tnat" type="text" class="required Estilo12" id="id_manu_tnat" size="20" onkeypress="return validar(event)" style="text-align:center" onkeyup="chk_ncbt();" />
            
          
        
        
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
                      <iframe id="datamain" src="tnatconsecutivo.php"  width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
              </div>
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                  <div class="Estilo4" align="center" id='res_ncon'></div>
              </div>
        
        
        
          </div>
        </div></td>
      </tr>
      
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>Fecha de la TNAT </strong></div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          
            <div align="center">
              <input name="fecha_recaudo" type="text" class="required Estilo4" id="fecha_recaudo" value="<? printf("%s",$ano);?>" size="12" />
              <span class="Estilo8">:::</span>
              <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_recaudo,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
              </div>
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Detalle  de la TNAT </strong></div>
            </div>
        </div></td>
        <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">

                  <div align="center">
                    <input name="des_recaudo" type="text" class="required Estilo4" id="des_recaudo"  size="80" />
                    </div>
            </div></div></td>
      </tr>
      
      <tr>
        <td width="174"></td>
        <td width="160"></td>
        <td width="181"></td>
        <td width="235"></td>
      </tr>
    </table>
	<br />
	<table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="196" bgcolor="#FFFFFF"></td>
        <td width="190" bgcolor="#FFFFFF"></td>
        <td width="186" bgcolor="#FFFFFF"></td>
        <td width="198" bgcolor="#FFFFFF"></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo12">
              <div align="center"><strong>SELECCIONE IMPUTACION PRESUPUESTAL</strong></div>
            </div>
        </div></td>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center"><span class="Estilo12"><strong>Valor</strong></span><br />
            </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center">


              <select name="cuenta" class="required Estilo12" id="cuenta" style="width: 400px;">
                <option value=""></option>
                <?
include('config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);

$strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$id_emp' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
              </select>
            </div>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center">
              <input name="valor" type="text" class="required Estilo12" id="valor" size="20" onkeypress="return validar(event)" style="text-align:right" />
            </div>
        </div></td>
      </tr>
    </table>
	<br />
<center>
			 
			  <script>
function muestraURL(){
var miPopup
miPopup = window.open("../pgcp/consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
              </script>
</center>
	<table width="300" border="0" align="center">
  <tr>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
    <td width="200" valign="middle"><div align="center"><a href="#" onclick="muestraURL()">BUSCAR CUENTA PGCP</a></div></td>
    <td width="50"><div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div></td>
  </tr>
</table>
	</td>
  </tr>
  <tr>
    <td colspan="3">
	<table width="900" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="4" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>IMPORTANTE</strong><br />
                <br />
              Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
              Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot; </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE
          <input type="hidden" name='contador' value='0' id="contador"><br>
          <input name="generar" type="button" value="Generar movimiento" onclick="generar_movimiento();"/>
          <br>
          <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='agregar();'>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span id='contis' class='Estilo4'>0</span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='borrarUltima();'>
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
	  
    </tr>
    
    </table>
    <table width="900" border="1" align="center" class="bordepunteado1">
    <? 
    
    ?>
    
    
    <table width="900" border="1" id="tablaf" align="center" class="bordepunteado1">   
 
    </table>
    
     </table>
    <table width="900" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR: </strong></div>
      </div></td>
      <td bgcolor="#990000" width="130"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00" onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000" width="134"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00" onkeyup='Calcular();'>
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

    </tr>
    <tr>
      <td colspan="4" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8">
            <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
          </div>
      </div></td>

      </tr>
    <tr>
        <td colspan="4"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <input name="Submit3222" type="submit" id="btn1" class="Estilo12"  value="Agregar Otra Imputacion Presupuestal y Continuar" 
			onclick="this.form.action = 'proc_ncbt_2.php'" />
            <span class="Estilo8">:::</span>
            <input name="submit" type="submit" id="btn2" class="Estilo12"  value="Guardar Nota Credito Bancaria y Terminar" 
			onclick="return noVacio4(this.form,this.form.contador.value)" />
          </div>
        </div></td>
      </tr>
      <!--secciones de fila -->
      <!--secciones de fila -->
    </table></td>
  </tr>
  

<?
/*}*/
?>  
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
	  
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../recaudos_tesoreria/recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
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
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>

</table>
  </form>
</body>
</html>






<?
}
?>