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
.Estilo8 {	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #333333;
}
.Estilo10 {font-weight: bold}
.Estilo11 {font-weight: bold}
.Estilo12 {font-weight: bold}
.Estilo13 {font-weight: bold}
.Estilo14 {font-weight: bold}
.Estilo15 {font-weight: bold}
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
	  <td>	    <div align="center"><span class="Estilo4"><strong>MODIFICA  DATOS CUENTAS POR PAGAR </strong></span><br />
              <?php 
	  include('../config.php');				
$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);

while($rowxxx = mysql_fetch_array($rxx)) 
   {
   
   $idxxx=$rowxxx["id_emp"];
//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
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
              <span class="Estilo4"><strong>...::: OBLIGATORIO :::... </strong>HACE REFERENCIA A SELECCIONAR EL MISMO VALOR O UN NUEVO VALOR PARA LA VARIABLE ALMACENADA, SINO SE HACE ASI, SE ALMACENARA POR DEFECTO LA PRIMERA VARIABLE ENCONTRADA EN LOS MENU DE SELECCION </span></div>
	    <BR /></td>
	  </tr>
	<tr>
	  <td>
	  <form name="seg" method="post" action="proc_modi_nombre_cuenta.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
	  <table width="750" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" class="Estilo4"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='consulta_ppto_gas.php' target='_parent'>VOLVER</a> </div>
                </div>
              </div>
            </div>
          </div></td>
          </tr>
        <tr>
          <td width="375" bgcolor="#F5F5F5" class="Estilo4">
		   <div class="Estilo10" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		     <div align="center">CODIGO	PRESUPUESTAL	SELECCIONADO   </div>
		   </div>		  </td>
          <td width="375" bgcolor="#F5F5F5" class="Estilo4">
		   <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		     <div align="center"><strong>
		        <?php 
		   mysql_connect($server,$dbuser,$dbpass); 
		     
		   $a=$_GET['id'];  
		   $a1=mysql_query("select * from cxp where cod_pptal = '$a' and id_emp ='$idxxx'");  
		   $result = @mysql_query($a1);
		   while($row = mysql_fetch_array($a1)) 
		   { 
			 $c = $row["cod_pptal"];
		     $c1 = $row["nom_rubro"];
			 $c2 = $row["proc_rec"];
			 $c3 = $row["situacion"];
			 
			 printf("<center class='Estilo4'>%s</center>", $row["cod_pptal"]); 
			 
		   }
		   ?></strong>
		       <input name="cod_pptal" type="hidden" id="cod_pptal" value="<?php printf("%s", $c); ?>" />
		     </div>
		   </div>		  </td>
        </tr>
        <tr>
          <td class="Estilo4"><div class="Estilo11" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">MODIFICAR NOMBRE DEL RUBRO  </div>
          </div></td>
          <td class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><span class="Estilo8">
            <input name="nombre" type="text" class="Estilo8" id="nombre" onkeyup="seg.nombre.value=seg.nombre.value.toUpperCase()" value="<?php printf("%s", $c1); ?>" size="35" />
          </span> </div></td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo12" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">PROCEDENCIA DEL RECURSO            </div>
          </div></td>
          <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center"><strong><?php printf("%s", $c2); ?></strong><BR />
              P=PROPIO - A=ADMINISTRADO </div>
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5" class="Estilo4"><div class="Estilo13" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">SELECCIONE NUEVA PROCEDENCIA DEL RECURSO<BR />
              ...::: OBLIGATORIO :::... </div>
          </div></td>
          <td bgcolor="#F5F5F5" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <select name="proc_rec" class="Estilo4" id="proc_rec">
              <option value="P">Propio</option>
              <option value="A">Administrado</option>
            </select>
</div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo14" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">SITUACION </div>
          </div></td>
          <td bgcolor="#FFFFFF" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center"><strong><?php printf("%s", $c3); ?></strong><br />
              C=CON SITUACION - S=SIN SITUACION </div>
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" class="Estilo4"><div class="Estilo15" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center">SELECCIONE NUEVA SITUACION <br />
                ...::: OBLIGATORIO :::... </div>
          </div></td>
          <td bgcolor="#FFFFFF" class="Estilo4"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <select name="situacion" class="Estilo4" id="situacion">
                <option value="C">Con Situacion</option>
                <option value="S">Sin Situacion</option>
              </select>
          </div></td>
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
                <div align="center"><a href='consulta_ppto_gas.php' target='_parent'>VOLVER</a> </div>
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
$resultadoxx = $connectionxx->query($sqlxx);

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