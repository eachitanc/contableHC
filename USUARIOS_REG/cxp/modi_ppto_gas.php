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
.Estilo23 {font-weight: bold}
.Estilo25 {font-weight: bold}
.Estilo27 {font-weight: bold}
.Estilo28 {font-size: 10px}
.Estilo29 {color: #FFFFFF}
.Estilo29 {font-weight: bold}
.Estilo30 {color: #FFFFFF}
.Estilo30 {font-weight: bold}
</style>
<script> 
var result;
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
function habilitar(id) 
{
  var tipo = document.getElementById(id).value;
   if (tipo=='M') 
  {
    document.getElementById('ppto_aprob').value='';
	document.getElementById('pto').style.display="none";
  }
 else
  {
	document.getElementById('pto').style.display="block";
	document.empresa.ppto_aprob.disabled=false;
  }
}

function cambia(){
with (document.empresa){
cod_pptal.value = nn.options[nn.selectedIndex].value;
}
}
function cursor()
{
//location.reload()
document.empresa.cod_pptal.focus();
var miTexto = document.empresa.cod_pptal.value;
document.empresa.cod_pptal.value = miTexto;
}

function verCod()
{
var cod = document.getElementById('cod_pptal').value;
	//donde se mostrar� el formulario con los datos
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST", "consultas/val_cod.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			result = ajax.responseText;
			return result;
			//mostrar el formulario
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("cod="+cod)
}

function ValidarValor(pagado,aprob)
{
var valor = document.getElementById('ppto_aprob').value;
if (valor < pagado)
	{
		vr_ctrl ="E";
		document.getElementById('ppto_aprob').value=aprob;
	}
}

function habilitar2() 
{
verCod();
existe =result.split(",");
var tipo = existe[1];
   if (tipo=='M') 
  {
    document.getElementById('ppto_aprob').value='';
	document.getElementById('pto').style.display="none";
	document.empresa.selecprod.selectedIndex= 0;
  }
 else
  {
	document.getElementById('pto').style.display="block";
	document.empresa.ppto_aprob.disabled=false;
	document.empresa.selecprod.selectedIndex= 1;
  }
}


function ValidarForm(id)
{
	verCod();
	existe =result.split(",");
	if (existe[0]=="SI")
	{
		return (true);
	}else{
		alert("El c�digo del rubro seleccionado no existe");
		return (false);
	}
}
</script>
<script type="text/javascript" language="JavaScript1.2" src="menu/stmenu.js"></script>
</head>
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
	<form name="empresa" method="post" action="proc_modi_ppto_gas.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
	<table width="750" border="0">
	<tr>
	<td>
	  <table width="750" border="1" align="center" class="bordepunteado1">
        <tr>
          <td valign="top" bgcolor="#DCE9E5">
		  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center"><strong class="Estilo4">CUENTAS POR PAGAR VIGENCIA ANTERIOR </strong><br />
              </div>
          </div></td>
        </tr>
        <tr>
          <td>
		  <div style="padding-left:30px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
		  <script type="text/javascript" language="JavaScript1.2" src="menu/menu_ppto_ing.js"></script>
		  </div>
		   
		  </td>
          </tr>
        <tr>
          <td valign="top">
		  <div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		  <div align="center">
		  <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='../user.php' target='_parent'>VOLVER AL INICIO </a> </div>
                </div>
              </div>      
		  </div>
		  </div>
		  </td>
          </tr>
      </table>
	 <br /><a name="a" id="a"></a>
	  <table width="750" border="1" align="center" class="bordepunteado1">
       <tr>
        <td colspan="3" class="Estilo4" bgcolor='#DCE9E5'>
		<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		<CENTER>
		  <span class="Estilo4"><strong>CARGAR CUENTAS POR PAGAR </strong></span>
		  <span style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;"></span>
		</CENTER>
        </div>
        </div></td>
        </tr>
	  
	   <tr>
	     <td bgcolor="#EBEBE4" class="Estilo4"><div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
           <div align="center"><strong>FECHA DE INICIO DE OPERACIONES DE LA ACTUAL VIGENCIA </strong>(aaaa/mm/dd)</div>
	     </div></td>
	     <td  colspan="2" valign="middle" bgcolor="#EBEBE4" class="Estilo4"><div id="div2" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
           <div align="center">
		   <?php
//-------
include('../config.php');
include('../objetos/obj_cxp.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$s = "select * from fecha_ini_op";
$r = mysql_db_query($database, $s, $cx);
while($rw = $r->fetch_assoc()) 
   {
printf("<center class='Estilo4'><b>%s</b><center>",$rw["fecha_ini_op"]);  
$fecha_ini_op=$rw["fecha_ini_op"];
   }
?>
           </div>
	       </div></td>
	     </tr>
	   <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">
		    <?php
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
   }
	  ?>
<strong>CUENTAS CARGADAS HASTA LA FECHA</strong><br />
		  </div>
		</div>		</td>
        <td  colspan="2" valign="middle" class="Estilo4">
		  <div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

		            <div align="left">
		              <select name="nn" onchange="cambia()" class="Estilo4" style="width: 400px;">
		                <?php

$strSQL = "SELECT * FROM cxp WHERE id_emp = '$idxx' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = $rs->fetch_assoc();
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
}
?>
		                </select>
		              </div>
		    </div></td>
      </tr>
	  <tr>
        <td bgcolor="#EBEBE4"  class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right"><span class="Estilo17">CODIGO PRESUPUESTAL : </span><br />
		    		  </div>
		</div>		</td>
        <td width="454" colspan="2" bgcolor="#EBEBE4" class="Estilo4">
		  <div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		            <div align="left">
					<?php  
					$cod_pptal =$_GET["id"];
					$consulta=mysql_query("select * from cxp where cod_pptal ='$cod_pptal'",$cx);
					while($row = $consulta->fetch_assoc())
					{
   						$nom_rubro=$row["nom_rubro"]; 
						$tip_dato=$row["tip_dato"]; 
						$ppto_aprob=$row["ppto_aprob"]; 
						$proc_rec=$row["proc_rec"]; 
						$situacion=$row["situacion"]; 
					}
					$estado ='';
					// Verifico si el rubro tiene afectaciones
					$afect = reporte_codigoutilizado($cod_pptal);
					$estado = $afect[0];
					$pagos = valor_ejecutado($cod_pptal);
					if ($pagos =='') {$pagos=0;} 
					$pagado = number_format(valor_ejecutado($cod_pptal),2,',','.');
					$saldo = number_format(($ppto_aprob - valor_ejecutado($cod_pptal)),2,',','.');
					
					if ($pagado >0)
					{
						$mensaje1 = "<font color ='red'>El rubro tiene $$pagado pagados, saldo $$saldo</font>";
					}
					if ($estado >0)
					{
						$ver_cod = "readonly";
						$ver_tipo="readonly";
						$nom_rubro =ucfirst($nom_rubro);
					}
					if ($afect[2] !='')
					{
						$ver_cod ="readonly";
						$ver_tipo="readonly";
						
					}
					
					?>
						
		              <input name="cod_pptal" type="text" class="Estilo7"  id="cod_pptal"   tabindex="0"   value="<?php printf('%s',$cod_pptal); ?>"   <?php echo $ver_cod; ?>
					  
					  onkeyup="habilitar2();" size="40" maxlength="35" /> &nbsp;<?php echo $mensaje; ?>
					  </div> 
		    </div></td>
      </tr>
	  <?php echo $afect[1]; ?>
      <tr>
        <td class="Estilo4">
		<div class="Estilo17" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">NOMBRE DEL RUBRO : </div>
		</div>		</td>
        <td colspan="2" class="Estilo4">
		<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		      <input name="nom_rubro" type="text" class="Estilo7" id="nom_rubro" tabindex="0" value="<?php echo $nom_rubro; ?>"  size="70" maxlength="200"/> 
		      <span class="Estilo9">..</span></div>
		</div>		</td>
      </tr>
      <tr>
        <td bordercolor="#EBEBE4" bgcolor="#EBEBE4" class="Estilo4">
		<div class="Estilo19" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">TIPO DE CUENTA : </div>
		</div>		</td>
        <td colspan="2" bordercolor="#EBEBE4" bgcolor="#EBEBE4" class="Estilo4">
		<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
          <div align="left">
            <select name="selecprod" class="Estilo4" id="selecprod" onchange="habilitar(id)" <?php echo $ver_tipo; ?> >
              <?php 
			  if ($tip_dato =='M')
				{
              		echo "<option value='M' selected>Mayor - M </option>";
					echo "<option value='D'>Detalle - D</option>";
				}else{
					echo "<option value='M'>Mayor - M </option>";
					echo "<option value='D' selected>Detalle - D</option>";
				}
			  ?>
            </select>
          </div>
		</div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4">
		<div class="Estilo23" id="main_div" style="padding-left:15px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">PRESUPUESTO  : </div>
		</div>		</td>
       <?php
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	    $s = "select * from fecha";
	    $r = mysql_db_query($database, $s, $cx);
	    while($rw = $r->fetch_assoc()) 
  	    {
     	 $fecha_sesion=$rw["ano"];
    	}
		$ss = "select * from fecha_ini_op";
	    $rs = mysql_db_query($database, $ss, $cx);
	    while($rws = $rs->fetch_assoc()) 
  	    {
     	 $fecha_ini_op=$rws["fecha_ini_op"];
    	}
		if($tip_dato =='M')
		{
			$ver_ppto="display:none";
		}
		?>  
	    <td colspan="2" class="Estilo4">
		<div id="main_div" style="padding-left:19px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
		  <div align="left" id="pto" style=" <?php echo $ver_ppto; ?>" >
		
		  $
		    <input name="ppto_aprob" type="text" style="text-align:right; " class="Estilo4" id="ppto_aprob" onkeypress="return validar(event)" onblur="ValidarValor(<?php echo $pagos; ?>,<?php echo $ppto_aprob; ?>);" value="<?php echo $ppto_aprob; ?>" size="20" maxlength="20" <?php echo $ver_ppto; ?>/> &nbsp; <?php echo $mensaje1; ?>
		    
		   	  
		    <input name="msj" type="text" disabled="disabled" class="Estilo4" style="border:0px" size="40"/>
		
		  </div>
		</div>		</td>
      </tr>
      <tr>
        <td bgcolor="#EBEBE4" class="Estilo4">
		<div class="Estilo25" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
		  <div align="right">PROCEDENCIA DEL RECURSO : 		</div>
		</div>		</td>
        <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
		<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		      <select name="proc_rec" class="Estilo4" id="proc_rec">
		        <?php 
				if ($proc_rec =='P')
				{
					echo "<option value='P' selected>Propio</option>
		        			<option value='A'>Administrado</option>";
				}else{
					echo "<option value='P'>Propio</option>
		        			<option value='A' selected>Administrado</option>";
				}
		        ?>
				</select>
		      </div>
		</div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4"><div class="Estilo27" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
            <div align="right">CON / SIN Situacion : </div>
        </div></td>
	    <td colspan="2" class="Estilo4"><div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="left">
              <select name="situacion" class="Estilo4" id="situacion">
                 <?php 
				if ($proc_rec =='P')
				{
					echo	"<option value='C' selected>Con Situacion</option>
		            	    <option value='S'>Sin Situacion</option>";
				}else{
                	echo	"<option value='C'>Con Situacion</option>
		            	    <option value='S' selected>Sin Situacion</option>";
				}
				?>
			  </select>
            </div>
	      </div></td>
	    </tr>
	  
      
      
      <tr>
        <td colspan="3" class="Estilo4"><div style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;" align="center">
          <input name="grabar" type="submit" class="Estilo4" id="grabar" value="Grabar" onclick="return ValidarForm(id);" />
          <span class="Estilo29">:::</span>
          <input name="cancelar" type="reset" class="Estilo4" id="cancelar" value="Cancelar" />
        </div></td>
      </tr>
    </table>
	<br />
	 
	 <table width="750" border="1" align="center" class="bordepunteado1">
       <tr class="bordepunteado1">
         <td colspan="2" valign="top" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
             <div align="center" class="Estilo4">
               <div align="center"><span class="Estilo1 Estilo28">OPCIONES ADICIONALES CUENTAS POR PAGAR </span></div>
             </div>
         </div></td>
       </tr>
       <tr class="bordepunteado1">
         <td width="375" valign="middle"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
             <div align="center"><span class="Estilo4">Cargar C x P Vigencia Anterior <br />
                 desde Plantilla MS&reg; Excel&reg; </span><br />
             </div>
         </div></td>
         <td valign="top" width="365"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
             <div align="center"><span class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">CARGANDO PRESUPUESTO A :<br />
                   <?php
//-------
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlx = "select * from empresa where cod_emp = '$idxx'";
$resultadox = mysql_db_query($database, $sqlx, $cx);

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
               <?php include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
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
$cx = null;
?>