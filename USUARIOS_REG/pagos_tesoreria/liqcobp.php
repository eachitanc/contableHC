<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<style type="text/css">
<!--
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
.Estilo9 {font-weight: bold}
.Estilo10 {font-weight: bold}
.Estilo11 {font-weight: bold}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
<?php
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id emp
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
$idxx=$rowxx["id_emp"];
$id_emp=$rowxx["id_emp"];
}


$id_auto_crpp=$_GET['id_auto_crpp'];	//printf("id_auto_crpp : $id_auto_crpp<br>");
$id_manu_crpp=$_GET['id_manu_crpp'];	//printf("id_manu_crpp : $id_manu_crpp<br>");
$id_auto_cdpp=$_GET['id_auto_cdpp'];	//printf("id_auto_cdpp : $id_auto_cdpp<br>");
$id_manu_cdpp=$_GET['id_manu_cdpp'];	//printf("id_manu_cdpp : $id_manu_cdpp<br>");
$cta_crpp=$_GET['cta_crpp'];			//printf("cta_crpp : $cta_crpp<br>");
$vr_x_obli_crpp=$_GET['vr_x_obli_crpp'];//printf("vr_x_obli_crpp : $vr_x_obli_crpp<br>");
$valor=$_GET['vr_x_obli_crpp'];			//printf("valor : $valor<br>");
$tercero=$_GET['tercero'];				//printf("tercero : $tercero<br>");
$valcobp=$_GET['valorcobp'];			//printf("tercero : $valcobp<br>");
$id_auto_cobp=$_GET['id_auto_cobp']; 	//printf("id_auto_cobp : $id_auto_cobp<br>");
$id_manu_cobp=$_GET['id_manu_cobp']; 	//printf("id_manu_cobp : $id_manu_cobp<br>");
$tercero=$_GET['tercero_cobp']; 		//printf("tercero : $tercero<br>");
$cuenta=$_GET['cuenta']; 				//printf("cuenta : $cuenta<br>");
$vr_cobp=$_GET['vr_digitado']*-1; 		//printf("vr_cobp : $vr_cobp<br>");
$fecha_cobp=$_GET['fecha_cobp'];		//printf("fecha_cobp : $fecha_cobp<br>");
$des_cobp=$_GET['des_cobp'];			//printf("des_cobp : $des_cobp<br>");
$id=$_GET['id'];						//printf("id : $id<br>");


include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");




?>
<style type="text/css">
<!--
.Estilo8 {color: #FFFFFF}
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
.Estilo13 {color: #000000}
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});
</script>
<center>
  <form name="form1" method="post" id="commentForm" action="liqcobp.php">
    <table width="500" border="1" align="center" class="bordepunteado1">
      <tr>
        <td bgcolor="#F5F5F5">
		<div class="Estilo4 Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
		  <div align="right">FECHA DE LIQUIDACION.</div>
		</div>		</td>
        <td colspan="2"><div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
          <div align="center">
		  
		    <input type="hidden" name="id_auto_cobp" value="<?php printf("$id_auto_cobp"); ?>" />
			<input type="hidden" name="id_manu_cobp" value="<?php printf("$id_manu_cobp"); ?>" />
			<input type="hidden" name="tercero" value="<?php printf("$tercero"); ?>" />            
			<input type="hidden" name="cuenta" value="<?php printf("$cuenta"); ?>" />             
			<input type="hidden" name="vr_cobp" value="<?php printf("$vr_cobp"); ?>" />            
			<input type="hidden" name="fecha_cobp" value="<?php printf("$fecha_cobp"); ?>" />
			<input type="hidden" name="des_cobp" value="<?php printf("$des_cobp"); ?>" />
            <input type="hidden" name="liq1" value="SI" />
            <input type="hidden" name="id_auto_crpp" value="<?php printf("$id_auto_crpp"); ?>" />
            <input type="hidden" name="id" value="<?php printf("$id"); ?>" />
			          
            
			<?php
			$sqlxx = "select * from fecha";
			$resultadoxx = $connectionxx->query($sqlxx);

			while($rowxx = $resultadoxx->fetch_assoc()) 
			{
  			$ano=$rowxx["ano"];
			}
            ?>
            <input name="fecha_crpp" type="text" class="Estilo4" id="fecha_crpp" value="<?php printf($ano); ?>" size="12" />
            <span class="Estilo6 Estilo8">:::</span>
            <input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.form1.fecha_crpp,'yyyy/mm/dd',this)" value="Ver Calendario" />
          </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div class="Estilo4 Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="right">CONCEPTO  DE LIQUIDACION.</div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <textarea name="detalle_crpp" cols="50" rows="5" class="Estilo4" id="detalle_crpp" onkeyup="form1.detalle_crpp.value=form1.detalle_crpp.value.toUpperCase();">LIQUIDACION DE SALDO</textarea>
          </div>
        </div>          </td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><div class="Estilo4 Estilo11" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="right">VALOR DE LIQUIDACION.</div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <input name="vr_digitado" type="text" class="required max Estilo4" id="vr_digitado" onkeypress="return validar(event)" style="text-align:center" value="<?php printf("%s",$valcobp);?>" max="<?php printf("%s",$valcobp);?>" readonly="readonly"/>
         </div>
        </div></td>
      </tr>
      <tr>
        <td colspan="3"><div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:5px;">
          <div align="center">
            <input name="Submit" type="submit" class="Estilo4" value="Liquidar Saldo" />
            </div>
        </div></td>
      </tr>
      <tr>
        <td width="200"></td>
        <td width="150"></td>
        <td width="150"></td>
      </tr>
    </table>
  </form>
  
<!--*********************************************************************************************************-->  

<?php

$id_empa=$id_emp; 						// printf("id_empa : $id_empa<br>"); 
$id_auto_cobp=$_POST['id_auto_cobp']; 	//printf("id_auto_cobp : $id_auto_cobp<br>"); 
$id_manu_cobp=$_POST['id_manu_cobp']; 	//printf("id_manu_cobp : $id_manu_cobp<br>"); 
$tercero=$_POST['tercero']; 			//printf("tercero : $tercero<br>"); 
$cuenta=$_POST['cuenta']; 				//printf("cuenta : $cuenta<br>"); 
$vr_cobp=$_POST['vr_cobp']; 			//printf("vr_cobp : $vr_cobp<br>"); 
$fecha_cobp=$_POST['fecha_cobp']; 		//printf("fecha_cobp : $fecha_cobp<br>"); 
$liq1a=$_POST['liq1'];  				//printf("liq1a : $liq1<br>");  printf("id_empa : $id_empa<br>"); 
$id_auto_crpp=$_POST['id_auto_crpp']; 	//printf("id_auto_crpp : $id_auto_crpp<br>");
$id=$_POST['id']; 						//printf("id : $id<br>"); 



 
			          

if($liq1a != '') 
{
	
		include('../config.php');				
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		$sql = "INSERT INTO cobp   
		(id_emp , id_auto_cobp , id_manu_cobp , tercero , cuenta , vr_digitado , fecha_cobp ,  des_cobp , liq,id_auto_crpp) 
		VALUES  
		('$id_empa' , '$id_auto_cobp','$id_manu_cobp','$tercero', '$cuenta','$vr_cobp','$fecha_cobp','$des_cobp','SI','$id_auto_crpp')";
		mysql_db_query($database, $sql, $connectionxx) or die(mysql_error());

		
		
		if($tot_vr == $tot_vr_obligado)
		{
		
		$sql3 = "update cobp set contab='SI',liq='SI' where id_auto_cobp = '$id_auto_cobp' and id='$id'";
		$resultado3 = mysql_db_query($database, $sql3, $connectionxx);
		
		$sql4 = "update crpp set ctrl='NO' where id_auto_crpp = '$id_auto_crpp'";
		$resultado4 = mysql_db_query($database, $sql4, $connectionxx);
		
		}
		
		 

?>	
<DIV id="prepage" style="position:absolute; font-family:arial; font-size:16; left:0px; top:0px; background-color:white; layer-background-color:white; height:100%; width:100%;"> 
<TABLE width=100%>
<TR>
<TD>
<br />
<br />
<br />
<center>
<B>LA LIQUIDACION SE REALIZO CON EXITO  </B>
<br />
<br />
<a href="hiscobp2.php?vr=<?php printf($id_auto_cobp); ?>" target="_parent">VOLVER</a>
</center>
</TD>
</TR>
</TABLE>
</DIV>

<?php
		
} //en if

?>

<form name="form2">
<input type="button" value="Atr�s" onclick="history.back()" class = "Estilo4">
</form>
</center>
<?php
}
?>