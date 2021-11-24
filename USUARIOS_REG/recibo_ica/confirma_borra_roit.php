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
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder ) 
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
var pos_url = '../comprobadores/comprueba_ncbt.php';
var cod = document.getElementById('id_manu_ncbt').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('res_ncbt').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}

//FUNCIONES DE TABLA***

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
	td.innerHTML = "<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'> <input type='text' size='38' style='text-align:left' id='pgcp"+contLin+"' name='pgcp"+contLin+"' value='' onkeyup='lookup(this.value,"+contLin+");' >  </span></div> <div class='suggestionsBox' id='sugges"+contLin+"' style='display: none; position:absolute; left: 130px;'><img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug"+contLin+"' align=left> &nbsp;  </div> </div>";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='88' style='text-align:left' name='des"+contLin+"' id='des"+contLin+"' value='' readonly >";
	
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


function generar_movimiento()
{ 


    var valor= document.getElementById("valor").value;
	var cuenta=document.getElementById("cuenta").value;	
	
	if(valor==''||cuenta=='')
	{
		if(cuenta=='')
		{
			alert("No ha seleccionado cuenta");
			document.getElementById("cuenta").focus()
		}
		if(valor=='')
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
				//alert(dato);
			}
		}
	req1.open('POST', pos_url2 +'?cod='+cuenta,false);
	req1.send(null);
	}
}
}


</script>

<!--fin val forms--> 

</head>
<body>

<div align="center">
<?php
include("../config.php");
 
$id_recau=$_GET['id_recau2'];
// saco el id de la empresa
   $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	    while($rowxx = mysql_fetch_array($resultadoxx)) 
  	    {
     	 $idxx=$rowxx["id_emp"];
		 $id_emp=$rowxx["id_emp"];
    	}

	    $sqlxxq = "select * from recaudo_riip  where id_recau='$id_recau' order by id desc ";
	    $resultadoxxq = mysql_db_query($database, $sqlxxq, $connectionxx);
	    while($rowxxq = mysql_fetch_array($resultadoxxq)) 
  	    {
     	 $id_manu_ncbt=$rowxxq["id_manu_rcgt"];
		 
    	}

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from recaudo_riip where id_emp = '$idxx' and id_recau='$id_recau' order by id asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<br>
<DIV style='background:#DCE9E5; padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px; width:910px;'>
<span class='Estilo4'>
<strong>DATOS DEL RECIBO DE INGRESOS DE PREDIAL ...::: ".$id_manu_ncbt." :::...</strong>
</span>
</DIV>
<BR>
</center>
");

printf("
<center>

<table width='910' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='80'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>FECHA</b></span>
</div>
</td>

<td align='center' width='150'><span class='Estilo4'><b>IMPUTACION</b></span></td>
<td align='center' width='200'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='200'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR</b></span></td>

<td align='center' width='130'><span class='Estilo4'><b>ACCIONES</b></span></td>
</tr>
");

while($rw = mysql_fetch_array($re)) 
{
printf("
<span class='Estilo4'>
<tr>

<td align='center'><span class='Estilo9'>%s</span></td>
<td align='left'><span class='Estilo9'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo9'>%s</span></td>
<td align='center'><span class='Estilo9'>%s</span></td>
<td align='right'><span class='Estilo9'> %.2f &nbsp;</span></td>



<td align='center' width=''>
<br>
<form method='post' action='borrar_rcgt.php'>
<input type='hidden' name='id' value='%s'>
<input type='hidden' name='id_reip' value='%s'>
<input type='hidden' name='id_caic' value='%s'>
<input type='hidden' name='id_recau' value='%s'>
<input type='hidden' name='cuenta' value='%s'>
<input type='hidden' name='nombre' value='%s'>
<input type='hidden' name='vr_digitado' value='%.2f'>
<input type='hidden' name='tercero' value='%s'>
<input type='hidden' name='des_recaudo' value='%s'>
<input type='hidden' name='id_manu_ncbt' value='%s'>
<input type='hidden' name='id_recau2' value='%s'>
<input type='hidden' name='fecha_c' value='%s'>
<input type='submit' name='Submit' value='Modificar' class='Estilo9' onclick='this.form.action = \"modifica_roit.php\"'/>
<input type='submit' name='Submit2' value='Borrar' class='Estilo9' onClick= \"if(!confirm('Esta seguro de borrar el contrato registrado?'))return false\" />
</form>
</td>



</tr>", $rw["fecha_recaudo"] , $rw["cuenta"] , $rw["nombre"] , $rw["tercero"] , $rw["vr_digitado"] ,



$rw["id"] , $rw["id_reip"] , $rw["id_caic"] , $rw["id_recau"] , $rw["cuenta"] , $rw["nombre"] , $rw["vr_digitado"], $rw["tercero"], $rw["des_recaudo"], $rw["id_manu_rcgt"], $id_recau, $rw["fecha_recaudo"]
); 

$fecha = $rw["fecha_recaudo"];
$desrec = $rw["des_recaudo"];
$tercero = $rw["tercero"];
$ter_nat = $rw["ter_nat"];
$ter_jur = $rw["ter_jur"];

   }
   
   
?>
  <?
printf("
</table>
</center>
");
?>
  <br>
  <br>
  <BR />
</div>
<center>
<span class="Estilo4">SI DESEA AGREGAR UNA NUEVA IMPUTACION PRESUPUESTAL, DILIGENCIE LAS SIGUIENTES CASILLAS</span>
<form name="a" method="post" id="commentForm" action="proc_ncbt.php">
  <table width="910" border="1" align="center" class="bordepunteado1">
    <tr>
      <td width="196" bgcolor="#FFFFFF"></td>
      <td width="190" bgcolor="#FFFFFF"></td>
      <td width="186" bgcolor="#FFFFFF"></td>
      <td width="198" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#F5F5F5">
	 <? $a = substr($id_recau,4,10);
	    $aa = substr($id_manu_ncbt,4,10);
	  ?>
	  <input name="consec_ncbt" type="hidden" id="consec_ncbt" value="<? printf("%s",$a); ?>">
	  <input name="id_manu_ncbt" type="hidden" id="id_manu_ncbt" value="<? printf("%s",$aa); ?>">
	  <input name="fecha_recaudo" type="hidden" id="fecha_recaudo" value="<? printf("%s",$fecha); ?>">
	  <input name="des_recaudo" type="hidden" id="des_recaudo" value="<? printf("%s",$desrec); ?>">
	  <input name="ter_nat" type="hidden" id="ter_nat" value="<? printf("%s",$ter_nat); ?>">
  	  <input name="ter_jur" type="hidden" id="ter_jur" value="<? printf("%s",$ter_jur); ?>">
	  <input name="tercero" type="hidden" id="tercero" value="<? printf("%s",$tercero); ?>">
	  
	  	  
	  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
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
            <input name="valor" type="text" class="required Estilo12" id="valor" size="20" onKeyPress="return validar(event)" style="text-align:right" />
          </div>
      </div></td>
    </tr>
  </table>
  <center>
    <span class="Estilo4"><font color="#990000"><BR />
      <br>
      </font></span>
</center>
	<script>
function muestraURL(){
var miPopup
miPopup = window.open("../pgcp/consulta_cta.php","CONTAFACIL","width=800,height=400,menubar=no,scrollbars=yes")
}
</script>
<table width="300" border="0" align="center">
  </table>
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
          <input name="generar" type="button" value="Generar movimiento" onClick="generar_movimiento();"/>
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
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00"  readonly>
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000" width="134"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00"  readonly>
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
            <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value="0.00" readonly>
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
          <div align="center"><span class="Estilo8">:::</span>
            <input name="Submit322" type="submit" class="Estilo12"  value="Agregar Imputacion Presupuestal al recibo de caja general Actual" 
			 onclick="return noVacio4(this.form,this.form.contador.value)" />
          </div>
        </div></td>
      </tr>
    </table>
    
    <p>&nbsp;</p>
</form>
  <?
printf("

<center class='Estilo9'>
<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
<input type='hidden' name='nn' value='RIIP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo19' /> :::...
</form>
</center>
");

?>
  <BR>
  <BR />
  <BR />
</center>
</body>
</html>

<?
}
?>