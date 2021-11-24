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
<script type="text/javascript" src="javas.js"> </script>
<script src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.validate.js"></script>
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
    .suggestionsBox {
        position: relative;
        left: 60px;
        margin: 0px 0px 0px 0px;
        width: 600px;
        background-color:#335194;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #2AAAFF;  
        color: #fff;
        font-size: 11px;
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
.Estilo5 {font-size: 10px; color: #333333; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
</style>

<style type="text/css">
<!--
.Estilo10 {
	font-family: Verdana;
	font-size: 10px;
	color: #FFFFFF;
}
-->
</style>

<script>
function cerrarse(){
	window.close()
}
</script>

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
<style type="text/css">
<!--
.Estilo11 {color: #FFFFFF}
-->
</style>


<script>
function chk_cta0(){
var pos_url = 'comprueba_cta_ing.php';
var cod = document.getElementById('id1').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
document.getElementById('resultado').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}
}
</script>


</head>

<body>

<?
$cuentax=$_POST['cuenta'];
$cuenta=$_GET['vr'].$cuentax;
//printf("%s",$cuenta);

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

//**** consulta si la cta ya esta configurada

	$sqlxx3a = "select * from ctas0_ing_ok where  cod_pptal ='$cuenta'";
	$resultadoxx3a = mysql_db_query($database, $sqlxx3a, $connectionxx);

	while($rowxx3a= mysql_fetch_array($resultadoxx3a)) 
	   {
	   
	   $cod_pptal_ing_apra=$rowxx3a["cod_pptal_ing_apr"]; 	
	   $nom_pptal_ing_apr=$rowxx3a["nom_pptal_ing_apr"];
	   
	   $cod_pptal_ing_x_eje=$rowxx3a["cod_pptal_ing_x_eje"];
	   $nom_pptal_ing_x_eje=$rowxx3a["nom_pptal_ing_x_eje"];
	   
	   $cod_pptal_ing_eje=$rowxx3a["cod_pptal_ing_eje"];
	   $nom_pptal_ing_eje=$rowxx3a["nom_pptal_ing_eje"];
	  
	   $cod_pptal_otros=$rowxx3a["cod_pptal_otros"];
	   $nom_pptal_otros=$rowxx3a["nom_pptal_otros"];
	   
   	   $cod_pptal_no_aforados=$rowxx3a["cod_pptal_no_aforados"];
	   $nom_pptal_no_aforados=$rowxx3a["nom_pptal_no_aforados"];
	   

 
       }

//*****
			

   
   
$sqlxx2 = "select * from car_ppto_ing where  cod_pptal ='$cuenta'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
   {
   
   $nom_rubro=$rowxx2["nom_rubro"];
   $definitivo=$rowxx2["ppto_aprob"];
   $tip_dato=$rowxx2["tip_dato"];

 
   }   
   



?>
<br />
<form name="a" method="post" action="ver_mas_ing.php">
<table width="600" border="1" align="center" class="bordepunteado1">
 
  <tr>
    <td colspan="4" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">CONFIGURACION DE CUENTAS 0 - PRESUPUESTO DE INGRESOS </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">DATOS GENERALES DE LA CUENTA SELECCIONADA </div>
    </div></td>
  </tr>
  <tr>
    <td width="250" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right">CUENTA : </div>
    </div></td>
    <td colspan="3" width="350"><div class="Estilo5" style="padding-left:15px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><? printf("%s",$cuenta);?>
        <input name="cuenta" type="hidden" value="<? printf("%s",$cuenta);?>" />
      </div>
    </div></td>
  </tr>
  <tr>
    <td bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">NOMBRE : </div>
    </div></td>
    <td colspan="3"><div class="Estilo5" style="padding-left:15px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="left"><? printf("%s",$nom_rubro);?>
            <input name="nom_rubro" type="hidden" value="<? printf("%s",$nom_rubro);?>" />
        </div>
    </div></td>
  </tr>
  <tr>
    <td bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">PRESUPUESTO INICIAL  : </div>
    </div></td>
    <td colspan="3"><div class="Estilo5" style="padding-left:15px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="left"><? echo number_format($definitivo,2,',','.'); // printf("%s",$definitivo);?>
          <input name="definitivo" type="hidden" value="<? printf("%s",$definitivo);?>" />
        </div>
    </div></td>
  </tr>



     

  	  		<? 
			
			$cod_pptal_ing_apr=$_POST['cod_pptal_ing_apr']; 
			if (empty($_POST['cod_pptal_ing_apr'])) 
			{
			$cuenta_ver = $cod_pptal_ing_apra;
			}
			else
			{
			$cuenta_ver = $cod_pptal_ing_apr;
			}
			
					 $acc='block';
					 for($i=1;$i<2;$i++){
					 echo "<tr aling='right' style='display:$acc;' id='fil$i'>
					 <td><div aling='right' class='Estilo5' style='padding-left:49px; padding-top:3px; padding-right:2px; padding-bottom:3px;'>DIGITE CODIGO CUENTA 0 APROBADO : </div></td>
					  <td><div aling='left' style='padding-left:15px; padding-top:3px; padding-right:0px; padding-bottom:3px;'> 
					  <input name='cod_pptal_ing_apr' type='text' class='Estilo5' id='pgcp$i' style='width:120px;' value='$cuenta_ver' onkeyup='lookup(this.value,$i);'>
					  
					 <div aling='left' class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 405px;'>
								<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
								<div aling='left' class='suggestionList' id='autoSug$i'>
									&nbsp;
								</div>
					 </div>
					  </td>
					  
					</tr>";
					if($i==2){$acc='none';}}
					?>
			
    
  
  <tr>
    <td colspan="4" bordercolor="#F5F5F5" bgcolor="#F5F5F5">
	<div style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
      <div align="center" id="resultado"></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" bordercolor="#F5F5F5" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
        <div align="center">
          Paso No. 1 -&gt; 
            <input name="Submit" type="submit" class="Estilo5" value="Configurar Cuenta 0" />
        </div>
    </div></td>
    </tr>
</table>
</form>
<br />
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="4" bgcolor="#990000">
	  <div align="center">
	    <?
	$cuenta=$_POST['cuenta']; 
	$nom_rubro=$_POST['nom_rubro']; 
	$definitivo=$_POST['definitivo']; 
	
	
	
	if (empty($_POST['cod_pptal_ing_apr'])) 
	{
	$longitud = strlen($cod_pptal_ing_apra);  //print($cod_pptal_ing_apr);
	$variable =$cod_pptal_ing_apra; // print($longitud);
	}else{
	$longitud = strlen($cod_pptal_ing_apr); 
	$variable =$cod_pptal_ing_apr;
	}
	
	if($longitud == "6")
	{
	
	
	
/*	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>
	Usted ha seleccionado: <br>
	cuenta : %s <br>
	nom rubro : %s <br>
	definitivo : %s <br>
	cod_pptal_ing_apr : %s <br>
	
	</center>
	</div>
	",$cuenta, $nom_rubro, number_format($definitivo,2,',','.'), $cod_pptal_ing_apr);*/


	$sqlxx3 = "select * from ctas0_ing where cod_pptal_ing_apr ='$variable'";
	$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);
	
	while($rowxx3= mysql_fetch_array($resultadoxx3)) 
	   {
	   
	   $nom_pptal_ing_apr=$rowxx3["nom_pptal_ing_apr"]; //print($cod_pptal_ing_apr);
	   
	   $cod_pptal_ing_x_eje=$rowxx3["cod_pptal_ing_x_eje"]; //print($cod_pptal_ing_x_eje);
	   $nom_pptal_ing_x_eje=$rowxx3["nom_pptal_ing_x_eje"]; //print($nom_pptal_ing_x_eje);
	   
	   $cod_pptal_ing_eje=$rowxx3["cod_pptal_ing_eje"]; //print($cod_pptal_ing_eje);
	   $nom_pptal_ing_eje=$rowxx3["nom_pptal_ing_eje"]; //print($nom_pptal_ing_eje);
	  
	   $cod_pptal_otros=$rowxx3["cod_pptal_otros"]; //print($cod_pptal_otros);
	   $nom_pptal_otros=$rowxx3["nom_pptal_otros"]; //print($nom_pptal_otros);
	   
   	   $cod_pptal_no_aforados=$rowxx3["cod_pptal_no_aforados"]; //print($cod_pptal_no_aforados);
	   $nom_pptal_no_aforados=$rowxx3["nom_pptal_no_aforados"]; //print($nom_pptal_no_aforados);
	   

 
       } 
	   
	   
	   
	 }
	else
	{
	
	   $nom_pptal_ing_apr='ERROR - LA CUENTA A CONFIGURAR DEBE SER DE NIVEL 4';
	   
	   //$cod_pptal_ing_x_eje=$rowxx3["cod_pptal_ing_x_eje"];
	   $nom_pptal_ing_x_eje='ERROR - LA CUENTA A CONFIGURAR DEBE SER DE NIVEL 4';
	   
	  //$cod_pptal_ing_eje=$rowxx3["cod_pptal_ing_eje"];
	   $nom_pptal_ing_eje='ERROR - LA CUENTA A CONFIGURAR DEBE SER DE NIVEL 4';
	  
	  // $cod_pptal_otros=$rowxx3["cod_pptal_otros"];
	   $nom_pptal_otros='ERROR - LA CUENTA A CONFIGURAR DEBE SER DE NIVEL 4';
	   
//   	   $cod_pptal_no_aforados=$rowxx3["cod_pptal_no_aforados"];
	   $nom_pptal_no_aforados='ERROR - LA CUENTA A CONFIGURAR DEBE SER DE NIVEL 4';
	
	}
	
	?>
        
		<div style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
		<span class="Estilo10"><strong>CODIGOS CONFIGURADOS PARA LA CUENTA 0 DIGITADA POR EL USUARIO </strong></span></div>
	  </div>		</td>
  </tr>
  

  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">PRESUPUESTO APROBADO  : </div>
    </div></td>
    
	<?
	if($cod_pptal_ing_apr == '')
	{
	
	?>
<td bgcolor="#FFFFFF"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;"><? printf("%s",$cod_pptal_ing_apra); ?>
</div></td>
	<?
	}
	else
	{
	?>
<td bgcolor="#FFFFFF"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;"><? printf("%s",$cod_pptal_ing_apr); ?>
</div></td>
	<?	
	}
	?>
	

	
	
    <td colspan="2" bgcolor="#F5F5F5"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><? printf("%s",$nom_pptal_ing_apr); ?></div>
    </div></td>
  </tr>
  <tr>
    <td width="200" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">PRESUPUESTO POR EJECUTAR : </div>
    </div></td>
    <td width="200" bgcolor="#FFFFFF"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;"><? printf("%s",$cod_pptal_ing_x_eje); ?></div></td>
    <td width="400" colspan="2" bgcolor="#F5F5F5"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><? printf("%s",$nom_pptal_ing_x_eje); ?></div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">RECAUDOS EN EFECTIVO  : </div>
    </div></td>
    <td bgcolor="#FFFFFF"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;"><? printf("%s",$cod_pptal_ing_eje); ?></div></td>
    <td colspan="2" bgcolor="#F5F5F5"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><? printf("%s",$nom_pptal_ing_eje); ?></div>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">OTROS RECUADOS DIF $  : </div>
    </div></td>
    <td bgcolor="#FFFFFF"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;"><? printf("%s",$cod_pptal_otros); ?></div></td>
    <td colspan="2" bgcolor="#F5F5F5"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="left"><? printf("%s",$nom_pptal_otros); ?></div>
    </div></td>
  </tr>
  
  <tr>
    <td bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
        <div align="right">INGRESOS NO AFORADOS   : </div>
    </div></td>
    <td bgcolor="#FFFFFF"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;"><? printf("%s",$cod_pptal_no_aforados); ?></div></td>
    <td colspan="2" bgcolor="#F5F5F5"><div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="left"><? printf("%s",$nom_pptal_no_aforados); ?></div>
    </div></td>
  </tr>
</table>
<br />
<form method="post" name="aa">

    <input type="hidden" name="id_emp" value="<? printf("%s",$id_emp); ?>" />
	<input type="hidden" name="cod_pptal" value="<? printf("%s",$cuenta); ?>" />
    <input type="hidden" name="nom_rubro" value="<? printf("%s",$nom_rubro); ?>" />
	<input type="hidden" name="vr_ini_aprob" value="<? printf("%s",$definitivo); ?>" />
	<input type="hidden" name="cod_pptal_ing_apr" value="<? printf("%s",$cod_pptal_ing_apr); ?>" />
	<input type="hidden" name="nom_pptal_ing_apr" value="<? printf("%s",$nom_pptal_ing_apr); ?>" />
	<input type="hidden" name="cod_pptal_ing_x_eje" value="<? printf("%s",$cod_pptal_ing_x_eje); ?>" />
	<input type="hidden" name="nom_pptal_ing_x_eje" value="<? printf("%s",$nom_pptal_ing_x_eje); ?>" />
	<input type="hidden" name="cod_pptal_ing_eje" value="<? printf("%s",$cod_pptal_ing_eje); ?>" />
	<input type="hidden" name="nom_pptal_ing_eje" value="<? printf("%s",$nom_pptal_ing_eje); ?>" />
	<input type="hidden" name="cod_pptal_otros" value="<? printf("%s",$cod_pptal_otros); ?>" />
	<input type="hidden" name="nom_pptal_otros" value="<? printf("%s",$nom_pptal_otros); ?>" />
	<input type="hidden" name="cod_pptal_no_aforados" value="<? printf("%s",$cod_pptal_no_aforados); ?>" />
	<input type="hidden" name="nom_pptal_no_aforados" value="<? printf("%s",$nom_pptal_no_aforados); ?>" />
	
  <div align="center" class="Estilo4">Paso No 2 -&gt; 
    <input name="Submit2" type="submit" class="Estilo5" value="Guardar Configuracion Cuenta 0" onclick="this.form.action = 'ver_mas_ing_guardar.php'" /> 
  </div>
</form>
<br />
<form name="aaa">
  <div align="center" class="Estilo4">
    <input name="Submit" type="button" class="Estilo5" value="Cerrar Ventana" onclick="cerrarse()" />
  </div>
</form>
</body>
</html>
<?
}
?>
