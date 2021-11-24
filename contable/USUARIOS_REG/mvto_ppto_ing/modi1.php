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
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
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


</head>
<body>

<?
include("../config.php");

$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$idxx=$rowxx["id_emp"];
}
		
	
$id =$_POST['id']; 
$cuenta =$_POST['cuenta'];
$consecutivo =$_POST['consecutivo'];
$ter_nat =$_POST['ter_nat'];
$ter_jur =$_POST['ter_jur'];
$des =$_POST['des'];
$valor =$_POST['valor']; 
$nom_rubro =$_POST['nom_rubro'];

?>


<center><BR>
  <span class="Estilo4"><strong>MODIFICAR EL VALOR DEL RECONOCIMIENTO </strong></span><BR>
  <br>
</center>
<form name="a" method="post" onSubmit="return confirm('Verifique si todos los datos estan correctos')">

<table width="800" height="36" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="176" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <div align="center"><strong>TERCERO</strong> </div>
        </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
        <div align="center" class="Estilo4">
          <? 
   $query="SELECT * FROM terceros_juridicos  WHERE id_emp = '$idxx' and id = '$ter_jur'";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=mysql_fetch_array($result))
   {
   	printf("%s",$row["raz_soc2"]);
   }
?>
<? 
   $query="SELECT * FROM terceros_naturales  WHERE id_emp = '$idxx' and id = '$ter_nat'";
   $link=mysql_connect($server,$dbuser,$dbpass);
   $result=mysql_db_query($database,$query,$link);
   while ($row=mysql_fetch_array($result))
   {
   	$tercero = $row["pri_ape"]." ".$row["seg_ape"]." ".$row["pri_nom"]." ".$row["seg_nom"];
	printf("%s",$tercero);
   }
?>
        </div>
    </div></td>
    <td width="200" bgcolor="#F5F5F5">
	  <input name="id" type="hidden" id="id" value="<? printf("%s",$id);?>">
	  <input name="consecutivo" type="hidden" id="consecutivo" value="<? printf("%s",$consecutivo);?>">
	  <input name="old_valor" type="hidden" id="old_valor" value="<? printf("%s",$valor);?>">
	  <input name="old_cuenta" type="hidden" id="old_cuenta" value="<? printf("%s",$cuenta);?>">
	  </td>
  </tr>
  <tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="center"><strong>RECONOCIMIENTO</strong> </div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="center"><? 
		
		$sqlxxa = "select * from reip_ing where id_emp ='$idxx' and consecutivo ='$consecutivo' and id ='$id'";
$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);

while($rowxxa = mysql_fetch_array($resultadoxxa)) 
{
  $id_manu_reip=$rowxxa["id_manu_reip"];
  $valor_a=$rowxxa["valor"];
}
		
		
		
		printf("%s",$id_manu_reip);?></div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5">&nbsp;</td>
  </tr>
</table>
<BR>
<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td width="196" bgcolor="#FFFFFF"></td>
    <td width="190" bgcolor="#FFFFFF"></td>
    <td width="186" bgcolor="#FFFFFF"></td>
    <td width="198" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4">
        <div align="center"><strong>IMPUTACION PRESUPUESTAL</strong></div>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center"><span class="Estilo4"><strong>Digite Nuevo Valor</strong></span><br />
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
	  <center class='Estilo4'><? printf("%s - %s<br>",$cuenta,$nom_rubro); ?>
	    <input name="cuenta" type="hidden" id="cuenta" value="<? printf("%s",$cuenta);?>">
	  </center>
       
      </div>
    </div></td>
    <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <input name="valor" type="text" class="Estilo4" id="valor" size="20" onKeyPress="return validar(event)" style="text-align:right" value="<? printf("%s",$valor_a); ?>" />
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#F5F5F5"><div class="Estilo4" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <input name="Submit322" type="submit" class="Estilo4"  value="Modificar Valor" 
			onclick="this.form.action = 'modi2.php'" />
      </div>
    </div></td>
  </tr>
</table>

</form>
<?
printf("
<br>
<center class='Estilo4'>
<form method='get' action='confirma_modificar_mvto.php'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='submit' name='Submit' value='Volver sin hacer Cambios' class='Estilo4' />
</form>
</center>
",$consecutivo);
?>
</body>
</html>

<?
}
?>