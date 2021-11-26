<?php
session_start();
if(!$_SESSION["login"])
//if( isset($_SESSION[$myusername]) )
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
<!--estilos-->
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #666666;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: underline;
}
a:active {
	color: #666666;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
.Estilo7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.Estilo9 {color: #FFFFFF}

-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
.Estilo17 {font-weight: bold}
.Estilo19 {font-weight: bold}
.Estilo27 {font-weight: bold}
.Estilo28 {font-size: 10px}
.Estilo29 {color: #FFFFFF}
.Estilo29 {font-weight: bold}
</style>
<!--solo numeros--> 
<script language="JavaScript">

var nav4 = window.Event ? true : false;
function acceptNum(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57));
}
//-->
</script>
<!--habilita - desahbilita objeto con opcion de un select-->
<script type="text/javascript">
function habilitar(obj) {
  var hab;
  frm=obj.form;
  num=obj.selectedIndex;
  if (num==0) 
  {
    hab=true;
	frm.banco.disabled=hab;
	frm.nom_banco1.disabled=hab;
	frm.nom_banco2.disabled=hab;
	frm.num_cta.disabled=hab;
	frm.fuentes_recursos.disabled=hab;
	frm.sispro.disabled=hab;
	frm.almacen.disabled=hab;
	frm.depreciable.disabled=hab;
	frm.cartera.disabled=hab;
	frm.tercero.disabled=hab;
	frm.base.disabled=hab;
	frm.c_costos.disabled=hab;
	frm.cta_costos.disabled=hab;
	frm.ent_recip.disabled=hab;
	frm.cod_sia.disabled=hab;
	frm.tip_cta.disabled=hab;
	frm.sispro2.disabled=hab;
	frm.cod_fut_el.disabled=hab;
	frm.cta_maestra.disabled=hab;
  }
  else
  {
    hab=false;
	frm.banco.disabled=hab;
	frm.nom_banco1.disabled=hab;
	frm.nom_banco2.disabled=hab;
	frm.num_cta.disabled=hab;
	frm.fuentes_recursos.disabled=hab;
	frm.sispro.disabled=hab;
	frm.almacen.disabled=hab;
	frm.depreciable.disabled=hab;
	frm.cartera.disabled=hab;
	frm.tercero.disabled=hab;
	frm.base.disabled=hab;
	frm.c_costos.disabled=hab;
	frm.cta_costos.disabled=hab;
	frm.ent_recip.disabled=hab;
	frm.cod_sia.disabled=hab;
	frm.tip_cta.disabled=hab;
	frm.sispro2.disabled=hab;
	frm.cod_fut_el.disabled=hab;
	frm.cta_maestra.disabled=hab;
  }

}
</script> 
<!--habilita - desahbilita objeto con opcion de un select - bancos - -->
<script type="text/javascript">
function habilitar2(obj) {
  var hab;
  frm=obj.form;
  num=obj.selectedIndex;
  if (num==0) 
  {
    hab=false;
	
	frm.nom_banco1.disabled=hab;
	frm.nom_banco2.disabled=hab;
	frm.num_cta.disabled=hab;
	frm.fuentes_recursos.disabled=hab;
	frm.sispro.disabled=hab;
	frm.tip_cta.disabled=hab;
	frm.cod_sia.disabled=hab;
	frm.sispro2.disabled=hab;
	frm.cod_fut_el.disabled=hab;
	frm.cta_maestra.disabled=hab;
	

  }
  else
  {
    hab=true;
	frm.nom_banco1.disabled=hab;
	frm.nom_banco2.disabled=hab;
	frm.num_cta.disabled=hab;
	frm.fuentes_recursos.disabled=hab;
	frm.sispro.disabled=hab;
	frm.tip_cta.disabled=hab;
	frm.cod_sia.disabled=hab;
	frm.sispro2.disabled=hab;
	frm.cod_fut_el.disabled=hab;
	frm.cta_maestra.disabled=hab;
	
  }

}
</script>  
<!--cambia el valor de un textbox segun cambie opcion de un select-->
<script language="JavaScript">
function cambia(){
with (document.empresa){
//indice.value = String(nn.selectedIndex);
//opcion.value = nn.options[nn.selectedIndex].text;
cod_pptal.value = nn.options[nn.selectedIndex].value;
}
}
</script>
<!--precarga cursor en textbox indicada-->
<script language="">

function cursor()
{

//location.reload()
document.empresa.cod_pptal.focus();
var miTexto = document.empresa.cod_pptal.value;
document.empresa.cod_pptal.value = miTexto;

}

</script>

<script type="text/javascript" language="JavaScript1.2" src="menu/stmenu.js"></script>

</head>
<!-- <body onLoad=cursor()>  -->
<body onload="cursor()">
<table width="750" border="0" align="center">
  <tr>
    
    <td width="750" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  
  
  <tr>
  
    <td colspan="3">
	
	<form name="empresa" method="post" action="proc_carga_pgcp.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
	<table width="850" border="0">
	<tr>
	<td>
	  <table width="850" border="1" align="center" class="bordepunteado1">

        <tr>
          <td valign="middle"><div style="padding-left:20px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <script type="text/javascript" language="JavaScript1.2" src="menu/menu_ppto_ing.js"></script>
          </div></td>
        </tr>
        <tr>
          <td valign="middle"><div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='index_pgcp.php' target='_parent'>VOLVER</a> </div>
                </div>
              </div>
            </div>
          </div></td>
          </tr>
      </table>
	  <a name="a" id="a"></a><br />
	  <table width="850" border="1" align="center" class="bordepunteado1">
       <tr>
         <td colspan="3" class="Estilo4" bgcolor='#DCE9E5'><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
           <center>
             <strong>PLAN GENERAL DE CONTABILIDAD PUBLICA - P.G.C.P </strong> -
           </center>
         </div></td>
       </tr>
       <tr>
        <td colspan="3" class="Estilo4" bgcolor='#DCE9E5'>
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
		<CENTER>
		  <span class="Estilo4"><strong>ADICION DE  CUENTAS </strong>
		  <br />
		  <br />
		  Si la cuenta es de tipo M -&gt; MAYOR o es una Cuenta &quot;0&quot;, solo se grabara CODIGO, NOMBRE, TIPO, NATURALEZA y CTE o NO CTE </span>
		</CENTER>
        </div>
        </div></td>
        </tr>
	  
	   <tr>
        <td width="254" bgcolor="#EBEBE4" class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">
		    <?php
//-------
include('../config.php');	
global $server, $database, $dbpass,$dbuser,$charset;
// Conexion con la base de datos
$cx= new mysqli ($server, $dbuser, $dbpass, $database);			
$s = "select * from fecha_ini_op";
$rs = $cx->query($s);
while($rw = $rs->fetch_assoc()) 
   {
//printf("<center class='Estilo4'><b>%s</b><center>",$rw["fecha_ini_op"]);  
$fecha_ini_op=$rw["fecha_ini_op"];
   }

//--------	
$sql = "select * from fecha";
$resultado = $cx->query($sql);
while($row = $resultado->fetch_assoc())

   {
printf("<input name='ano' type='hidden' id='ano' value='%s' size='10'/><input name='id_emp' type='hidden' id='id_emp' value='%s' size='4'/>",$fecha_ini_op, $row["id_emp"]);  
   }

$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc())
   {
    $idxx=$rowxx["id_emp"];
//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
   }
	  ?>
<strong>CUENTAS CARGADAS HASTA LA FECHA</strong><br />
		  </div>
		</div>		</td>
        <td  colspan="2" valign="middle" bgcolor="#EBEBE4" class="Estilo4">
		  <div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

		            <div align="left">
		              <select name="nn" onchange="cambia()" class="Estilo4" style="width: 400px;">
		                <?php
$strSQL = "SELECT * FROM pgcp WHERE id_emp = '$idxx' ORDER BY cod_pptal";
$rs = $cx->query($strSQL);
$nr = $rs->num_rows;
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_array();
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
		                </select>
		              </div>
		    </div></td>
      </tr>
	  <tr>
        <td bgcolor="#FFFFFF"  class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right"><span class="Estilo17">CODIGO  DE LA CUENTA: </span><br />
		    <span class="Estilo4">(Carga el Ultimo Codigo Digitado)</span>		  </div>
		</div>		</td>
        <td width="478" colspan="2" bgcolor="#FFFFFF" class="Estilo4">
		  <div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

		            <div align="left">
										  <!--muestro el ultimo cod_pptal almacenado-->
					  
					<?php
           $sq3 ="select * from tmp_cod_pptal";
           $consulta=$cx->query($sq3);
						while($row = $consulta->fetch_assoc())
   						{	$tmp_cod_pptal=$row["cod"];  }  ?>
						
		              <input name="cod_pptal" type="text" class="Estilo7" id="cod_pptal" tabindex="0" 
					  value="<?php echo $tmp_cod_pptal; ?>" 
					  onkeyup="
var options = this.form.nn.options;for(var i = 0; i < options.length; i++){var match = options[i].value == this.value;if(match)break;}this.form.nn.selectedIndex = i;cambia();" size="40" maxlength="35" />
					  </div>
		    </div></td>
      </tr>
      <tr>
        <td bgcolor="#EBEBE4" class="Estilo4">
		<div class="Estilo17" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">NOMBRE DE LA CUENTA: </div>
		</div>		</td>
        <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
		<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		      <input name="nom_rubro" type="text" class="Estilo7" id="nom_rubro" tabindex="0" onkeyup="empresa.nom_rubro.value=empresa.nom_rubro.value.toUpperCase();" size="50" maxlength="200"/> 
		      <span class="Estilo9">..</span></div>
		</div>		</td>
      </tr>
      <tr>
        <td bordercolor="#EBEBE4" bgcolor="#FFFFFF" class="Estilo4">
		<div class="Estilo19" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">TIPO DE CUENTA : </div>
		</div>		</td>
        <td colspan="2" bordercolor="#EBEBE4" bgcolor="#FFFFFF" class="Estilo4">
		<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
          <div align="left">
            <select name="selecprod" class="Estilo4" id="selecprod" onchange="habilitar(this)">
              
              <option value="M" nombre="M" >Mayor - M </option>
              <option value="D" nombre="D">Detalle - D</option>
            </select>
          </div>
		</div>		</td>
      </tr>
      <tr>
        <td bgcolor="#EBEBE4" class="Estilo4"><div class="Estilo27" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
            <div align="right">MANEJA BANCO :  </div>
        </div></td>
        <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="left">
              <select name="banco" class="Estilo4" id="banco" onchange="habilitar2(this)" disabled="disabled">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>
            </div>
        </div></td>
      </tr>
	  
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>NOMBRE 1 : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div16" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
            <input name="nom_banco1" type="text" class="Estilo7" id="nom_banco1" tabindex="0" onkeyup="empresa.nom_banco1.value=empresa.nom_banco1.value.toUpperCase();" size="50" maxlength="200" disabled="disabled"/>
          </div>
	      </div></td>
	    </tr>
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div2" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>NOMBRE 2 : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div17" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
            <input name="nom_banco2" type="text" class="Estilo7" id="nom_banco2" tabindex="0" onkeyup="empresa.nom_banco2.value=empresa.nom_banco2.value.toUpperCase();" size="50" maxlength="200" disabled="disabled"/>
          </div>
	      </div></td>
	    </tr>
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div3" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>NUMERO DE CUENTA : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div18" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
            <input name="num_cta" type="text" class="Estilo7" id="num_cta" tabindex="0" onkeyup="empresa.num_cta.value=empresa.num_cta.value.toUpperCase();" size="50" maxlength="200" disabled="disabled"/>
          </div>
	      </div></td>
	    </tr>
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div33" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>TIPO DE CUENTA : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div34" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
            <select name="tip_cta" class="Estilo4" id="tip_cta" disabled="disabled">
              <option value="CORRIENTE">CUENTA CORRIENTE</option>
              <option value="AHORROS">CUENTA DE AHORROS</option>
            </select>
            </div>
	      </div></td>
	    </tr>
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div4" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>FUENTE DE FINANCIACION S.I.A : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div19" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
            <select name="fuentes_recursos" class="Estilo4" id="fuentes_recursos" disabled="disabled">
              <option value="FF1">(FF1) para Recursos Propios</option>
              <option value="FF2">(FF2) SGP Sector Educaci&oacute;n</option>
              <option value="FF3">(FF3) SGP Sector Salud</option>
              <option value="FF4">(FF4) SGP Agua Potable y Saneamiento B&aacute;sico</option>
              <option value="FF5">(FF5) SGP Recreaci&oacute;n y Deporte</option>
              <option value="FF6">(FF6) SGP Cultura</option>
              <option value="FF7">(FF7) Convenios</option>
              <option value="FF8">(FF8) Asignaciones Especiales</option>
              <option value="FF9">(FF9) Creditos</option>
              <option value="FF10">(FF10) Otros</option>
              <option value="FF11">(FF11) Regalias</option>
            </select>
            </div>
	      </div></td>
	    </tr>
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div31" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>CODIGO S.I.A  : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div32" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
            <select name="cod_sia" class="Estilo4" id="cod_sia" disabled="disabled">
              <option value="B1">Banco de Occidente (B1)</option>
              <option value="B2">Banco de Colombia (B2)</option>
              <option value="B3">Banco Popular (B3)</option>
              <option value="B4">Banco Agrario (B4)</option>
              <option value="B5">Banco de Bogota (B5)</option>
              <option value="B6">Davivienda (B6)</option>
              <option value="B7">Colmena (B7)</option>
              <option value="B8">Av Villas (B8)</option>
              <option value="B9">Banco Caja Social (B9)</option>
              <option value="B10">Banco Santander (B10)</option>
              <option value="B11">Colpatria (B11)</option>
              <option value="B12">BBVA (B12)</option>
              <option value="B13">Lloyds TSB Bank (B13)</option>
              <option value="B14">Megabanco(B14)</option>
              <option value="B15">Citibank (B15)</option>
              <option value="B16">Boston Bank (B16)</option>
              <option value="B17">Banco Uni&oacute;n (B17)</option>
              <option value="B18">Banco Tequendama (B18)</option>
              <option value="B19">Banco Superior (B19)</option>
              <option value="B20">Banco Sudameris (B20)</option>
              <option value="B21">Banco Mercantil (B21)</option>
              <option value="B22">Banco de Cr&eacute;dito (B22)</option>
              <option value="B23">Banco HSBC (B23)</option>
              <option value="B24">Coomeva Financiera (B24)</option>
              <option value="B25">Cofinal (B25)</option>
              <option value="B26">Cooacremat (B26)</option>
                        </select>
            <input name="sispro" type="hidden" value="NO"/>
          
		  <!--              <select name="sispro" class="Estilo4" id="sispro" disabled="disabled">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
              </select>-->
		  </div>
	      </div></td>
	    </tr>
	  
	  <tr>
        <td bgcolor="#EBEBE4" class="Estilo4"><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
            <div align="right"><strong>SISPRO : </strong></div>
        </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="left">
              <select name="sispro2" class="Estilo4" id="sispro2" disabled="disabled">
                <option value="1">BANCO DE BOGOT&Aacute;</option>
                <option value="2">BANCO POPULAR</option>
                <option value="6">BANCO SANTANDER</option>
                <option value="7">BANCOLOMBIA</option>
                <option value="8">ABN AMRO BANK</option>
                <option value="9">CITIBANK</option>
                <option value="10">BANISTMO COLOMBIA</option>
                <option value="12">BANCO SUDAMERIS COLOMBIA</option>
                <option value="13">BBVA COLOMBIA</option>
                <option value="14">BANCO DE CR&Eacute;DITO HELM SERVICES</option>
                <option value="19">BANCO COLPATRIA</option>
                <option value="20">BANESTADO</option>
                <option value="22">BANCO UNI&Oacute;N COLOMBIANO</option>
                <option value="23">BANCO DE OCCIDENTE</option>
                <option value="24">BANCO STANDARD CHARTERED COLOMBIA</option>
                <option value="29">BANCO TEQUENDAMA</option>
                <option value="30">BANCO CAJA SOCIAL</option>
                <option value="34">BANCO SUPERIOR</option>
                <option value="36">BANK BOSTON</option>
                <option value="37">MEGABANCO</option>
                <option value="39">BANCO DAVIVIENDA</option>
                <option value="41">BANCO AGRARIO DE COLOMBIA</option>
                <option value="48">BANCO ALIADAS</option>
                <option value="50">GRANBANCO</option>
                <option value="52">BANCO COMERCIAL AVVILLAS</option>
                <option value="54">BANCO GRANAHORRAR</option>
                <option value="55">BANCO CONAVI</option>
                <option value="57">BANCO COLMENA</option>
              </select>
            </div>
	      </div></td>
	    </tr>
		<tr>
        <td bgcolor="#EBEBE4" class="Estilo4"><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
            <div align="right"><strong>CUENTA MAESTRA SALUD : </strong></div>
        </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="left">
              <select name="cta_maestra" class="Estilo4" id="cta_maestra" readonly>
			     <option value=""></option>
				<option value="CMS0">REGIMEN SUBSIDIADO</option>
                <option value="CMS1">SALUD PUBLICA COLECCTIVA</option>
                <option value="CMS2">PRESTACION DE SERVICIOS</option>
                <option value="CNS3">OTROS GASTOS INVERSION</option>
                <option value="CMS4">OTROS GASTOS FUNCIONAMIENTO</option>
                        </select>
            </div>
	      </div></td>
	    </tr>
	  <tr>
<?php 
$s1 = "select * from empresa where cod_emp = '$idxx' ";
$r1 = $cx->query($s1);
while($rw1 = $r1->fetch_assoc())
{
  $uni_eje=$rw1["uni_eje"];
}

if ($uni_eje != 'EMPRESA')
{
?>	  
	    <td bgcolor="#FFFFFF" class="Estilo4"><div id="div35" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong> F.U.T - EXCEDENTES DE LIQUIDEZ  : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div id="div36" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
          <select name="cod_fut_el" class="Estilo4" id="cod_fut_el" disabled="disabled" style="width:550px;">
			<option value=""></option>
           	<?php
			$sq2 ="select * from fut_exedentes order by cod_fut asc";
			$rs2 = $cx->query($sq2);
			$fi2 = $rs2->num_rows;
			for ($i=0; $i<$fi2; $i++) {
				$r = $rs2->fetch_assoc();
				echo "<option value=\"".$r["cod_fut"]."\">".$r["cod_fut"]." - ".$r["nom_fut"]."</b></OPTION>";
			}
			  ?>
          </select>
          </div>
	      </div></td>
<?php
}
else
{
}
?>		  
		  
	    </tr>
	  
	  
	  <tr>
	    <td colspan="3" class="Estilo4"><table width="722" border="0" align="center">
          <tr>
            <td><div id="div6" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>NATURALEZA : </strong></div>
            </div></td>
            <td><div id="div21" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="naturaleza" class="Estilo4" id="naturaleza">
                  <option value="D">DEBITO</option>
                  <option value="C">CREDITO</option>
                </select>
              </div>
            </div></td>
            <td bgcolor="#EBEBE4"><div id="div7" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>CORRIENTE - NO CTE : </strong></div>
            </div></td>
            <td bgcolor="#EBEBE4"><div id="div22" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="c_nc" class="Estilo4" id="c_nc">
                  <option value="C">CORRIENTE</option>
                  <option value="NC">NO CORRIENTE</option>
                </select>
              </div>
            </div></td>
          </tr>
          <tr>
            <td width="180" bgcolor="#EBEBE4"><div id="div8" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>MANEJA ALMACEN : </strong></div>
            </div></td>
            <td width="180" bgcolor="#EBEBE4"><div id="div23" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="almacen" class="Estilo4" id="almacen" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
            <td width="180" bgcolor="#FFFFFF"><div id="div9" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>DEPRECIABLE : </strong></div>
            </div></td>
            <td width="180" bgcolor="#FFFFFF"><div id="div24" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="depreciable" class="Estilo4" id="depreciable" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
          </tr>
          <tr>
            <td><div id="div10" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>CONTROLA CARTERA : </strong></div>
            </div></td>
            <td><div id="div25" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="cartera" class="Estilo4" id="cartera" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
            <td bgcolor="#EBEBE4"><div id="div11" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>EXIJE TERCERO : </strong></div>
            </div></td>
            <td bgcolor="#EBEBE4"><div id="div26" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="tercero" class="Estilo4" id="tercero" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#EBEBE4"><div id="div12" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>EXIJE VALOR BASE : </strong></div>
            </div></td>
            <td bgcolor="#EBEBE4"><div id="div27" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="base" class="Estilo4" id="base" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div id="div14" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>EXIJE CENTRO DE COSTOS : </strong></div>
            </div></td>
            <td bgcolor="#FFFFFF"><div id="div29" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="c_costos" class="Estilo4" id="c_costos" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
          </tr>
          <tr>
            <td><div id="div15" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
              <div align="right"><strong>CUENTA DE COSTOS : </strong></div>
            </div></td>
            <td><div id="div30" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
              <div align="left">
                <select name="cta_costos" class="Estilo4" id="cta_costos" disabled="disabled">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                              </select>
              </div>
            </div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
	    </tr>
	  
	  
	  <tr>
	    <td bgcolor="#EBEBE4" class="Estilo4"><div id="div13" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
          <div align="right"><strong>ENTIDAD RECIPROCA : </strong></div>
	      </div></td>
	    <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div28" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="left">
		  
            <select name="ent_recip" class="Estilo4" id="ent_recip" style="width: 400px;" disabled="disabled">
              <option value=""></option>

            </select>
          </div>
	      </div></td>
	    </tr>
	  
	  
	  
      
      
      <tr>
        <td colspan="3" class="Estilo4"><div style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;" align="center">
          <input name="grabar" type="submit" class="Estilo4" id="grabar" value="Grabar" />
          <span class="Estilo29">:::</span>
          <input name="cancelar" type="reset" class="Estilo4" id="cancelar" value="Cancelar" />
        </div></td>
      </tr>
    </table>
	<br />
	 
	 <table width="850" border="1" align="center" class="bordepunteado1">
       <tr class="bordepunteado1">
         <td colspan="2" valign="top" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
             <div align="center" class="Estilo4">
               <div align="center"><span class="Estilo1 Estilo28">OPCIONES ADICIONALES P.G.C.P </span></div>
             </div>
         </div></td>
       </tr>
       <tr class="bordepunteado1">
         <td width="375" valign="middle"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
             <div align="center"><span class="Estilo4">Cargar Plan General de Contabilidad Publica P.G.C.P <br />
                 desde Plantilla MS&reg; Excel&reg; </span><br />
             </div>
         </div></td>
         <td valign="top" width="365"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
             <div align="center"><span class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">CARGANDO  A :<br />
                   <?php
//-------
$sqlx = "select * from empresa where cod_emp = '$idxx'";
$resultadox = $cx->query($sqlx);

while($rowx = $resultadox->fetch_assoc())
   {
printf("<span class='Estilo4'><b> %s </b></span>", $rowx["raz_soc"]);  
   }
//--------	
?>
               </span><br />
             </div>
         </div></td>
       </tr>
       <tr class="bordepunteado1">
         <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
           <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
               <span class="Estilo4"> <strong>
               <?php 
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc())
   
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
               </strong> </span> <br />
               <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
         </div></td>
       </tr>
     </table>	 </td>
	</tr>
	</table>
	</form>	</td>
  </tr>
  <tr>
    <td width="250">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
	</div>	</td>
    <td width="250">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="250">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>