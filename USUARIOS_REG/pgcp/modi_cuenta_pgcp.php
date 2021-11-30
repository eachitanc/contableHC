<?php
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
<link rel="StyleSheet" href="dtree.css" type="text/css" />


<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
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
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo10 {font-weight: bold}
.Estilo15 {font-weight: bold}
.Estilo9 {color: #FFFFFF}
.Estilo9 {font-weight: bold}
.Estilo16 {
	color: #FF0000;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Estilo17 {color: #F5F5F5}
</style>

<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function acceptNum(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57));
}
//-->
</script>

<?php 
include('../config.php');				
$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);

while($rowxxx = mysql_fetch_array($rxx)) 
   {
   
   $idxxx=$rowxxx["id_emp"];
 
   }
?>

<?php 
		   mysql_connect($server,$dbuser,$dbpass); 
		   mysql_select_db($database);  
		   $a=$_GET['id'];  
		   $a1=mysql_query("select * from pgcp where cod_pptal = '$a' and id_emp ='$idxxx'");  
		   $result = @mysql_query($a1);
		   while($row = mysql_fetch_array($a1)) 
		   { 
			 $c = $row["cod_pptal"];
		     $c1 = $row["nom_rubro"];
			 $c2 = $row["banco"];
			 $c3 = $row["nom_banco1"];
			 $c4 = $row["nom_banco2"];
			 
			 $c5 = $row["num_cta"];
			 $c6 = $row["tip_cta"];
			 $c7 = $row["fuentes_recursos"];
			 $c8 = $row["cod_sia"];
			 $c9 = $row["sispro"];
			 $c10 = $row["sispro2"];
			 $c11 = $row["cod_fut_el"];
			 $c12 = $row["naturaleza"];
			 $c13 = $row["c_nc"];
			 $c14 = $row["almacen"];
			 $c15 = $row["depreciable"];
			 $c16 = $row["cartera"];
			 $c17 = $row["tercero"];
			 $c18 = $row["base"];
			 $c19 = $row["c_costos"];
			 $c20 = $row["cta_costos"];
			 $c21 = $row["ent_recip"];
			 $nivel = $row["nivel"];
			 
			 
			 $tipo_dato = $row["tip_dato"];
			 
					 
		   }
		   
		   $cta0 = substr($a,0,1);
		   //printf("%s",$cta0);
		   ?>
		  

<!--habilita - desahbilita objeto con opcion de un select - bancos - -->
<script type="text/javascript">
function habilitar2(obj) {
  var hab;
  frm=obj.form;
  num=obj.selectedIndex;
  if (num==0) 
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
	

  }
  else
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
	
  }

}
</script> 




</head>

<!--<body onload = "document.forms[0]['a'].focus()">-->
<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="800" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3">
			
		<table width="800" border="0" align="center">
	<tr>
	  <td>	    <div align="center"><span class="Estilo4"><strong>MODIFICA  DATOS CUENTA DEL PLAN GENERAL DE CONTABILIDAD PUBLICA  <br />P.G.C.P</strong></span><br />
              <?php 
	  include('../config.php');				
$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);

while($rowxxx = mysql_fetch_array($rxx)) 
   {
   
   $idxxx=$rowxxx["id_emp"];
 
   }
	  ?><BR />
              <?php
//-------
include('../config.php');				
$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = mysql_db_query($database, $sq2, $cx2);

while($row2 = mysql_fetch_array($re2)) 
   {
printf("<span class='Estilo4'><b>...::: %s :::...</b></span><br>", $row2["raz_soc"]);  
   }
//--------	--------------------------------------------------------------------------------------------
?>
              <br />
              <span class="Estilo16"><U>ATENCION</U><br />
              <BR />
              DEBE MODIFICAR TODOS Y CADA UNO DE LOS VALORES QUE SE ENCUENTREN EN LISTA DESPLEGABLE, CASO CONTRARIO,<BR />
              SE ALMACENARA EL VALOR MOSTRADO POR DEFECTO.</strong></span></div>
	    <BR /></td>
	  </tr>
	<tr>
	  <td>
	  <form name="empresa" method="post" action="proc_modi_pgcp.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
	  <table width="750" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='consulta_pgcp.php' target='_parent'>VOLVER</a> </div>
                </div>
              </div>
            </div>
          </div></td>
          </tr>
        <tr>
          <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo10" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center">CODIGO	CUENTA	SELECCIONADA </div>
          </div></td>
          <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center"><strong>
                <?php 
		  
			 
			 		 
			 printf("<center class='Estilo4'>%s</center>", $c); 
			 
		 
		   ?>
                </strong>
                  <input name="cod_pptal" type="hidden" id="cod_pptal" value="<?php printf("%s", $c); ?>" />
              </div>
          </div></td>
        </tr>
        <tr>
          <td width="375" bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right">NIVEL 	CUENTA	SELECCIONADA </div>
            </div>
          </div></td>
          <td width="375" bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">

                  <div align="left">
                    <select name="nivel" class="Estilo4" id="nivel">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                    </select>
                    <span class="Estilo17">:::</span> <strong>NIVEL ACTUAL : <?php printf("%s", $nivel); ?> </strong> </div>
            </div></div></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><table width="750" border="0" align="center">
            
            <tr>
              <td width="250" bgcolor="#EBEBE4" class="Estilo4"><div class="Estilo15" id="div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right">NOMBRE DE LA CUENTA: </div>
              </div></td>
              <td width="482" colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <input name="nom_rubro" type="text" class="Estilo7" id="nom_rubro" tabindex="0" onkeyup="empresa.nom_rubro.value=empresa.nom_rubro.value.toUpperCase();" size="50" maxlength="200" value="<?php printf("%s", $c1); ?>"/>
                    <span class="Estilo9">..</span></div>
              </div></td>
            </tr>
            
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div class="Estilo15" id="div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right">MANEJA BANCO : </div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
				  <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  {
				  ?>
                    <select name="banco" class="Estilo4" id="banco" onchange="habilitar2(this)">
                      <option value="NO">NO</option>
                      <option value="SI">SI</option>
                    </select>
			<?php }
			   else
			   {
			?>	
			<select name="banco" class="Estilo4" id="banco" onchange="habilitar2(this)" disabled="disabled">
                      <option value="NO">NO</option>
                      <option value="SI">SI</option>
                    </select>
			
			<?php
			}
			?>	
                    <strong>ALMACENADO</strong> : <?php printf("%s", $c2); ?>                  </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div2" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>NOMBRE 1 : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div16" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <input name="nom_banco1" type="text" class="Estilo7" id="nom_banco1" tabindex="0" onkeyup="empresa.nom_banco1.value=empresa.nom_banco1.value.toUpperCase();" value="<?php printf("%s", $c3); ?>" size="50" maxlength="200" disabled="disabled" />
                  </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div3" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>NOMBRE 2 : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div17" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <input name="nom_banco2" type="text" class="Estilo7" id="nom_banco2" tabindex="0" onkeyup="empresa.nom_banco2.value=empresa.nom_banco2.value.toUpperCase();" value="<?php printf("%s", $c4); ?>" size="50" maxlength="200" disabled="disabled" />
                  </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div4" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>NUMERO DE CUENTA : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div18" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <input name="num_cta" type="text" class="Estilo7" id="num_cta" tabindex="0" onkeyup="empresa.num_cta.value=empresa.num_cta.value.toUpperCase();" value="<?php printf("%s", $c5); ?>" size="50" maxlength="200" disabled="disabled" />
                  </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div33" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>TIPO DE CUENTA : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div34" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <select name="tip_cta" class="Estilo4" id="tip_cta" disabled="disabled" >
                      <option value="CORRIENTE">CUENTA CORRIENTE</option>
                      <option value="AHORROS">CUENTA DE AHORROS</option>
                    </select>
                    <strong>ALMACENADO</strong> : <?php printf("%s", $c6); ?> </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div5" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>FUENTE DE FINANCIACION S.I.A : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div19" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <select name="fuentes_recursos" class="Estilo4" id="fuentes_recursos" disabled="disabled" >
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
                    </select>
                    <strong>ALMACENADO</strong> : <?php printf("%s", $c7); ?> </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div31" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>CODIGO S.I.A  : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div32" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <select name="cod_sia" class="Estilo4" id="cod_sia" disabled="disabled" >
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
                    <strong>ALMACENADO</strong> : <?php printf("%s", $c8); ?> </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div6" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>INFORMES SISPRO : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <select name="sispro" class="Estilo4" id="sispro" disabled="disabled" >
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                    <strong>ALMACENADO</strong> : <?php printf("%s", $c9); ?> </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div6" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>SISPRO : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                    <select name="sispro2" class="Estilo4" id="sispro2" disabled="disabled" >
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
                    <strong>ALMACENADO</strong> : <?php printf("%s", $c10); ?> </div>
              </div></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div35" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>CODIGO F.U.T - EXCEDENTES DE LIQUIDEZ  : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div36" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  <div align="left">
                  
                    <select name="cod_fut_el" class="Estilo4" id="cod_fut_el"  style="width:400px;" disabled="disabled">
                   	<?php
						$sq2 ="select * from fut_exedentes order by cod_fut asc";
						$rs2 = mysql_db_query($database,$sq2,$connection);
						$fi2 = mysql_num_rows($rs2);
						for ($i=0; $i<$fi2; $i++) {
							$r = mysql_fetch_array($rs2);
							if ($c11 == $r["cod_fut"])
							echo "<option value=\"".$r["cod_fut"]."\" selected>".$r["cod_fut"]." - ".$r["nom_fut"]."</b></OPTION>";
							else
							echo "<option value=\"".$r["cod_fut"]."\">".$r["cod_fut"]." - ".$r["nom_fut"]."</b></OPTION>";
						}
					  ?>
                    </select><br /><br />
                    <center>
                      <strong>ALMACENADO</strong> : <?php printf("%s", $c11); ?>
                    </center>                  </div>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" class="Estilo4"><table width="722" border="0" align="center">
                  <tr>
                    <td colspan="4" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div id="div37" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                      <div align="center"></div>
                    </div></td>
                    </tr>
                  <tr>
                    <td><div id="div7" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>NATURALEZA : </strong></div>
                    </div></td>
                    <td><div id="div21" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
                            <select name="naturaleza" class="Estilo4" id="naturaleza">
                              <option value="D">DEBITO</option>
                              <option value="C">CREDITO</option>
                            </select>
                            <br /> <br /> 
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c12); ?></div>
                    </div></td>
                    <td bgcolor="#EBEBE4"><div id="div8" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>CORRIENTE - NO CTE : </strong></div>
                    </div></td>
                    <td bgcolor="#EBEBE4"><div id="div22" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
                            <select name="c_nc" class="Estilo4" id="c_nc">
                              <option value="C">CORRIENTE</option>
                              <option value="NC">NO CORRIENTE</option>
                            </select>
                            <br /><br /> 
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c13); ?></div>
                    </div></td>
                  </tr>
                  <tr>
                    <td width="150" bgcolor="#EBEBE4"><div id="div9" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>MANEJA ALMACEN : </strong></div>
                    </div></td>
                    <td width="200" bgcolor="#EBEBE4"><div id="div23" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						  <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="almacen" class="Estilo4" id="almacen" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="almacen" class="Estilo4" id="almacen" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							
							<?php
							}
							?>
                            <BR />
                            <BR /> 
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c14); ?></div>
                    </div></td>
                    <td width="150" bgcolor="#FFFFFF"><div id="div10" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>DEPRECIABLE : </strong></div>
                    </div></td>
                    <td width="204" bgcolor="#FFFFFF"><div id="div24" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						   <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="depreciable" class="Estilo4" id="depreciable" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="depreciable" class="Estilo4" id="depreciable" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							?>
							
							
							
							
                            <BR />
                            <BR />
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c15); ?></div>
                    </div></td>
                  </tr>
                  <tr>
                    <td><div id="div11" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>CONTROLA CARTERA : </strong></div>
                    </div></td>
                    <td><div id="div25" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						  <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="cartera" class="Estilo4" id="cartera" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="cartera" class="Estilo4" id="cartera" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							?>
                            <BR />
                            <BR />
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c16); ?></div>
                    </div></td>
                    <td bgcolor="#EBEBE4"><div id="div12" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>EXIJE TERCERO : </strong></div>
                    </div></td>
                    <td bgcolor="#EBEBE4"><div id="div26" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						  <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="tercero" class="Estilo4" id="tercero" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="tercero" class="Estilo4" id="tercero" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							?>
                            <BR />
                            <BR />
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c17); ?></div>
                    </div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#EBEBE4"><div id="div13" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>EXIJE VALOR BASE : </strong></div>
                    </div></td>
                    <td bgcolor="#EBEBE4"><div id="div27" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						   <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="base" class="Estilo4" id="base" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="base" class="Estilo4" id="base" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							
							<?php
							}
							?>
                            <BR />
                            <BR />
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c18); ?></div>
                    </div></td>
                    <td bgcolor="#FFFFFF"><div id="div14" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>EXIJE CENTRO DE COSTOS : </strong></div>
                    </div></td>
                    <td bgcolor="#FFFFFF"><div id="div29" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						    <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="c_costos" class="Estilo4" id="c_costos" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="c_costos" class="Estilo4" id="c_costos" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							?>
                            <BR />
                            <BR />
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c19); ?></div>
                    </div></td>
                  </tr>
                  <tr>
                    <td><div id="div15" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                        <div align="right"><strong>CUENTA DE COSTOS : </strong></div>
                    </div></td>
                    <td><div id="div30" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                        
                          <div align="center">
						  <?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                            <select name="cta_costos" class="Estilo4" id="cta_costos" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							else
							{
							?>
							<select name="cta_costos" class="Estilo4" id="cta_costos" disabled="disabled" >
                              <option value="NO">NO</option>
                              <option value="SI">SI</option>
                            </select>
							<?php
							}
							?>
                            <BR />
                            <BR />
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c20); ?></div>
                    </div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#EBEBE4" class="Estilo4"><div id="div14" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                  <div align="right"><strong>ENTIDAD RECIPROCA : </strong></div>
              </div></td>
              <td colspan="2" bgcolor="#EBEBE4" class="Estilo4"><div id="div28" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                  
                    <div align="center">
					<?php if ($tipo_dato == 'D' and $cta0 != '0')
				  			{
				 			 ?>
                      <select name="ent_recip" class="Estilo4" id="ent_recip" style="width: 400px;" >
                        <?php
include('config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database);
$strSQL = "SELECT * FROM terceros_cgr_ing ORDER BY cod_ter";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_assoc();
	echo "<OPTION VALUE=\"".$r["cod_ter"]."\">".$r["cod_ter"]." - ".$r["nom_ter"]."</OPTION>";
}

?>
                      </select>
					  <?php
					  }
					  else
					  {
					  ?>
					  <select name="ent_recip" class="Estilo4" id="ent_recip" style="width: 400px;" disabled="disabled" >
                        <?php
include('config.php');
$db = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database);
$strSQL = "SELECT * FROM terceros_cgr_ing ORDER BY cod_ter";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_assoc();
	echo "<OPTION VALUE=\"".$r["cod_ter"]."\">".$r["cod_ter"]." - ".$r["nom_ter"]."</OPTION>";
}

?>
                      </select>
					  <?php
					  }
					  ?>
                      <br />
                      <br /> 
                      <strong>ALMACENADO</strong> : <?php printf("%s", $c21); ?></div>
              </div></td>
            </tr>
            
          </table></td>
          </tr>
        <tr>
          <td colspan="2"><div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <input name="Submit" type="submit" class="Estilo4" value="Modificar" />
            </div>
          </div></td>
        </tr>
        <tr>
          <td colspan="2">
		  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
		  <div align="center">
            <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
              <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                <div align="center"><a href='consulta_pgcp.php' target='_parent'>VOLVER</a> </div>
              </div>
            </div>
            </div>
          </div></td>
          </tr>
      </table>
	  </form>
	  </td>
	</tr>
	<tr>
	  <td>
	   <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	     <div align="center">
          
		  <!--asociado en el body para el foco
		 <form name="a" action="carga_ppto_ing.php">
		  	
			<input name="a" type="submit" class="Estilo4" value="Volver"/>
		   </form>-->
		   
		   </div>
	   </div>	   </td>
	  </tr>
	<tr>
	<td>
	
	 
	  <center>
	  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
            <span class="Estilo4"> <strong>
            <?php include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
            </strong> </span> <br />
            <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
	    </div></td>
	</tr>
	</table>
	</td>
  </tr>

  <tr align="center">
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
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
</body>
</html>
<?php
}
?>