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
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>

<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script type="text/javascript">
function slctr(texto,valor){
	this.texto = texto
	this.valor = valor
}
var Colombia=new Array()
	Colombia[0] = new slctr('- - Departamento - -')
	Colombia[1] = new slctr("Amazonas",'Amazonas')
	Colombia[2] = new slctr("Antioquia",'Antioquia')
	Colombia[3] = new slctr("Arauca",'Arauca')
	Colombia[4] = new slctr("Atlantico",'Atlantico')
	Colombia[5] = new slctr("Bolivar",'Bolivar')
	Colombia[6] = new slctr("Boyaca",'Boyaca')
	Colombia[7] = new slctr("Caldas",'Caldas')
	Colombia[8] = new slctr("Caqueta",'Caqueta')
	Colombia[9] = new slctr("Casanare",'Casanare')
	Colombia[10] = new slctr("Cauca",'Cauca')
	Colombia[11] = new slctr("Cesar",'Cesar')
	Colombia[12] = new slctr("Choco",'Choco')
	Colombia[13] = new slctr("Cordoba",'Cordoba')
	Colombia[14] = new slctr("Cundinamarca",'Cundinamarca')
	Colombia[15] = new slctr("Guainia",'Guainia')
	Colombia[16] = new slctr("Guajira",'Guajira')
	Colombia[17] = new slctr("Guaviare",'Guaviare')
	Colombia[18] = new slctr("Huila",'Huila')
	Colombia[19] = new slctr("Magdalena",'Magdalena')
	Colombia[20] = new slctr("Meta",'Meta')
	Colombia[21] = new slctr("Narino",'Narino')
	Colombia[22] = new slctr("N_de_Santander",'N_de_Santander')
	Colombia[23] = new slctr("Putumayo",'Putumayo')
	Colombia[24] = new slctr("Quindio",'Quindio')
	Colombia[25] = new slctr("Risaralda",'Risaralda')
	Colombia[26] = new slctr("San_Andres",'San_Andres')
	Colombia[27] = new slctr("Santander",'Santander')
	Colombia[28] = new slctr("Sucre",'Sucre')
	Colombia[29] = new slctr("Tolima",'Tolima')
	Colombia[30] = new slctr("Valle",'Valle')
	Colombia[31] = new slctr("Vaupes",'Vaupes')
	Colombia[32] = new slctr("Vichada",'Vichada')
	

//*******Nietos*******************
var Amazonas = new Array()
	Amazonas[0] = new slctr('- - Amazonas - -')
	Amazonas[1] = new slctr("Leticia",null)
	

var Antioquia = new Array()
	Antioquia[0] = new slctr('- - Antioquia - -')
	Antioquia[1] = new slctr("Medellin",null)
	
var Arauca = new Array()
	Arauca[0] = new slctr('- - Arauca - -')
	Arauca[1] = new slctr("Arauca",null)

var Atlantico = new Array()
	Atlantico[0] = new slctr('- - Atlantico - -')
	Atlantico[1] = new slctr("Barranquilla",null)
	
var Bolivar = new Array()
	Bolivar[0] = new slctr('- - Bolivar - -')
	Bolivar[1] = new slctr("Cartagena",null)
	
var Boyaca = new Array()
	Boyaca[0] = new slctr('- - Boyaca - -')
	Boyaca[1] = new slctr("Tunja",null)
	
var Caldas = new Array()
	Caldas[0] = new slctr('- - Caldas - -')
	Caldas[1] = new slctr("Manizales",null)
	
var Caqueta = new Array()
	Caqueta[0] = new slctr('- - Caqueta - -')
	Caqueta[1] = new slctr("Florencia",null)
	
var Casanare = new Array()
	Casanare[0] = new slctr('- - Casanare - -')
	Casanare[1] = new slctr("Yopal",null)
	
var Cauca = new Array()
	Cauca[0] = new slctr('- - Cauca - -')
	Cauca[1] = new slctr("Popayan",null)
	
var Cesar = new Array()
	Cesar[0] = new slctr('- - Cesar - -')
	Cesar[1] = new slctr("Valledupar",null)
	
var Choco = new Array()
	Choco[0] = new slctr('- - Choco - -')
	Choco[1] = new slctr("Quibdo",null)
	
var Cordoba = new Array()
	Cordoba[0] = new slctr('- - Cordoba - -')
	Cordoba[1] = new slctr("Monteria",null)
	
var Cundinamarca = new Array()
	Cundinamarca[0] = new slctr('- - Cundinamarca - -')
	Cundinamarca[1] = new slctr("Bogota D.C",null)
	
var Guainia = new Array()
	Guainia[0] = new slctr('- - Guainia - -')
	Guainia[1] = new slctr("Puerto Inirida",null)
	
var Guajira = new Array()
	Guajira[0] = new slctr('- - Guajira - -')
	Guajira[1] = new slctr("Riohacha",null)
	
var Guaviare = new Array()
	Guaviare[0] = new slctr('- - Guaviare - -')
	Guaviare[1] = new slctr("San Jose del Guaviare",null)
	
var Huila = new Array()
	Huila[0] = new slctr('- - Huila - -')
	Huila[1] = new slctr("Neiva",null)
	
var Magdalena = new Array()
	Magdalena[0] = new slctr('- - Magdalena - -')
	Magdalena[1] = new slctr("Santa Marta",null)
	
var Meta = new Array()
	Meta[0] = new slctr('- - Meta - -')
	Meta[1] = new slctr("Villavicencio",null)
	
var Narino = new Array()
	Narino[0] = new slctr('- - Narino - -')
	Narino[1] = new slctr("Pasto",null)
	
var N_de_Santander = new Array()
	N_de_Santander[0] = new slctr('- - N_de_Santander - -')
	N_de_Santander[1] = new slctr("Cucuta",null)
	
var Putumayo = new Array()
	Putumayo[0] = new slctr('- - Putumayo - -')
	Putumayo[1] = new slctr("Mocoa",null)
	
var Quindio = new Array()
	Quindio[0] = new slctr('- - Quindio - -')
	Quindio[1] = new slctr("Armenia",null)
	
var Risaralda = new Array()
	Risaralda[0] = new slctr('- - Risaralda - -')
	Risaralda[1] = new slctr("Pereira",null)
	
var San_Andres = new Array()
	San_Andres[0] = new slctr('- - San_Andres - -')
	San_Andres[1] = new slctr("San Andres",null)
	
var Santander = new Array()
	Santander[0] = new slctr('- - Santander - -')
	Santander[1] = new slctr("Bucaramanga",null)
	
var Sucre = new Array()
	Sucre[0] = new slctr('- - Sucre - -')
	Sucre[1] = new slctr("Sincelejo",null)
	
var Tolima = new Array()
	Tolima[0] = new slctr('- - Tolima - -')
	Tolima[1] = new slctr("Ibague",null)
	
var Valle = new Array()
	Valle[0] = new slctr('- - Valle - -')
	Valle[1] = new slctr("Cali",null)
	
var Vaupes = new Array()
	Vaupes[0] = new slctr('- - Vaupes - -')
	Vaupes[1] = new slctr("Mitu",null)
	
var Vichada = new Array()
	Vichada[0] = new slctr('- - Vichada - -')
	Vichada[1] = new slctr("Puerto Carreno",null)
	
	

function slctryole(cual,donde){
	if(cual.selectedIndex != 0){
		donde.length=0
		cual = eval(cual.value)
		for(m=0;m<cual.length;m++){
			var nuevaOpcion = new Option(cual[m].texto);
			donde.options[m] = nuevaOpcion;
			if(cual[m].valor != null){
				donde.options[m].value = cual[m].valor
			}
			else{
				donde.options[m].value = cual[m].texto
			}
		}
	}
}
</script> 

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
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='dctos_fuente.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
	<? 
		$dcto=$_POST['a'];
		//printf("%s",$dcto);
	?>
	<? 
	   if($dcto == 'SOPORTES')
	   {
	?>
	<form name="a" method="post" action="proc_soportes.php" onsubmit="return confirm('Verifique su Informacion antes de Grabar')">
	  <table width="600" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="3" bgcolor="#DCE9E5">
		  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		    <div align="center" class="Estilo4"><strong>SOPORTES		  </strong></div>
		  </div>		  </td>
          </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>CODIGO : </strong></div>
            </div>
          </div></td>
          <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left">
             <input name="cod" type="text" class="Estilo4" id="cod" size="30" onkeyup="a.cod.value=a.cod.value.toUpperCase();" />
              </div>
            </div>
          </div></td>
          </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>NOMBRE DEL SOPORTE : </strong></div>
            </div>
          </div></td>
          <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left">
   <input name="nombre" type="text" class="Estilo4" id="nombre" size="60" onkeyup="a.nombre.value=a.nombre.value.toUpperCase();" />
              </div>
            </div>
          </div></td>
          </tr>
        <tr>
          <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>AFECTA PPTO DE INGRESOS  </strong>?</div>
            </div>
          </div></td>
          <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              SI
              <input name="afecta_ing" type="radio" value="SI" />
            </div>
          </div></td>
          <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              NO
              <input name="afecta_ing" type="radio" value="NO" checked="checked" />
            </div>
          </div></td>
        </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>AFECTA PPTO DE GASTOS </strong>?</div>
            </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              SI 
              <input name="afecta_gas" type="radio" value="SI" />
            </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              NO
              <input name="afecta_gas" type="radio" value="NO" checked="checked" />
            </div>
          </div></td>
        </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>AFECTA TESORERIA </strong>?</div>
            </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              SI
              <input name="afecta_tes" type="radio" value="SI" />
            </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              NO
              <input name="afecta_tes" type="radio" value="NO" checked="checked" />
            </div>
          </div></td>
        </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>AFECTA CONTABILIDAD </strong>?</div>
            </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              SI
              <input name="afecta_con" type="radio" value="SI" checked="checked" />
            </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              NO
              <input name="afecta_con" type="radio" value="NO" />
            </div>
          </div></td>
        </tr>
        <tr>
          <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo4">
              <input name="Submit" type="submit" class="Estilo4" value="Grabar Soporte" />
            </div>
          </div></td>
          </tr>
      </table>
	</form>
	<? } else { ?>   
	<form name="b" method="post" action="proc_comprobantes.php" onsubmit="return confirm('Verifique su Informacion antes de Grabar')">
	  <table width="540" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="3" bgcolor="#DCE9E5">
		  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center" class="Estilo4"><strong>COMPROBANTES </strong></div>
          </div></td>
        </tr>
        <tr>
          <td width="200"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><strong>CODIGO : </strong></div>
              </div>
          </div></td>
          <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="left">
                  <input name="cod" type="text" class="Estilo4" id="cod" size="30" onkeyup="b.cod.value=b.cod.value.toUpperCase();" />
                </div>
              </div>
          </div></td>
        </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><strong>NOMBRE  COMPROBANTE : </strong></div>
              </div>
          </div></td>
          <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="left">
                  <input name="nombre" type="text" class="Estilo4" id="nombre" size="60" onkeyup="b.nombre.value=b.nombre.value.toUpperCase();" />
                </div>
              </div>
          </div></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#F5F5F5">
		  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo4">
              <div align="center" class="Estilo4"><strong>...::: PRESUPUESTO :::... </strong></div>
            </div>
          </div></td>
          </tr>
        <tr>
          <td width="200" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center"><strong>Ingresos</strong></div>
            </div>
          </div></td>
          <td width="180" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center"><strong>Gastos</strong></div>
            </div>
          </div></td>
          <td width="180" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center"><strong>Cuentas por Pagar </strong></div>
            </div>
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center">
                <input name="ppto_ing" type="checkbox" id="ppto_ing" value="SI" />
              </div>
            </div>
          </div></td>
          <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center">
                <input name="ppto_gas" type="checkbox" id="ppto_gas" value="SI" />
              </div>
            </div>
          </div></td>
          <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="center">
                <input name="ppto_cxp" type="checkbox" id="ppto_cxp" value="SI" />
              </div>
            </div>
          </div></td>
        </tr>
        <tr>
          <td colspan="3">
		  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center" class="Estilo4">
              
                 
                <strong>...::: TESORERIA :::...</strong></div>
          </div></td>
        </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>Ingresos</strong></div>
              </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>Gastos</strong></div>
              </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>Cuentas por Pagar </strong></div>
              </div>
          </div></td>
        </tr>
        <tr>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <input name="tes_ing" type="checkbox" id="tes_ing" value="SI" />
                </div>
              </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <input name="tes_gas" type="checkbox" id="tes_gas" value="SI" />
                </div>
              </div>
          </div></td>
          <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <input name="tes_cxp" type="checkbox" id="tes_cxp" value="SI" />
                </div>
              </div>
          </div></td>
        </tr>
        
        
        <tr>
          <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>CONTABILIDAD</strong> : </div>
            </div>
          </div></td>
          <td colspan="2" bgcolor="#F5F5F5"><div style="padding-left:20px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left"><strong>
                <input name="cont" type="checkbox" id="cont" value="SI" checked="checked" />
              </strong></div>
            </div>
          </div></td>
          </tr>
        <tr>
          <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center" class="Estilo4">
                <input name="Submit2" type="submit" class="Estilo4" value="Grabar Comprobante" />
              </div>
          </div></td>
        </tr>
      </table>
	</form>
	
	<? } ?>
	</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='dctos_fuente.php' target='_parent'>VOLVER </a> </div>
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
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
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
<p>&nbsp;</p>
</body>
</html>






<?
}
?>