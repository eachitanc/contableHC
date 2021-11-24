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
<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
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
</style>

</head>

<!--<body onload = "document.forms[0]['a'].focus()">-->
<body>




<table width="850" border="0" align="center">
  <tr>
    
    <td width="980" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3">
			
		<table width="800" border="0" align="center">
	<tr>
	  <td>	    <div align="center">
	    <span class="Estilo1"><BR />MAESTRO PLAN GENERAL DE CONTABILIDAD PUBLICA<BR />P.G.C.P </span><BR />
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
	  ?>
	      <?php
//-------
include('../config.php');				
$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = mysql_db_query($database, $sq2, $cx2);

while($row2 = mysql_fetch_array($re2)) 
   {
printf("<span class='Estilo4'><br><b>...::: %s :::...</b></span><br>", $row2["raz_soc"]);  
   }
//--------	--------------------------------------------------------------------------------------------
?>
	      <br />
	      <?php
//-------
include('../config.php');				
$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   $id=$row["id_emp"];
   }
//--------	
?>
	    <table width="800" border="1" align="center" class="bordepunteado1">
                <tr bgcolor='#DCE9E5'>
                  <td colspan="3"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                      <div align="center" class="Estilo1">Opciones Maestro P.G.C.P </div>
                  </div></td>
                </tr>
                <tr>
                  <td class="Estilo4">

				  <div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                  <div align="center">
				  <a href="modi_borra_pgcp/cambiar_codigo.php" target="_parent">
				  Cambiar Cuenta				  </a></div>
                  </div>
				  
				  
				  
				  </td>
                  <td class="Estilo4"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                      <div align="center"><a href="modi_borra_pgcp/eliminar_codigo.php" target="_parent">Borrar Cuenta</a> </div>
                  </div></td>
                  <td class="Estilo4"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                      <div align="center"><a href="carga_pgcp.php#a" target="_parent">Nueva Cuenta </a> </div>
                  </div></td>
                </tr>
                <tr>
                  <td width="266" class="Estilo4"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                      <div align="center">Buscar Cuenta  </div>
                  </div></td>
                  <td width="266" class="Estilo4"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                    <div align="center"><a href="bloqueo/bloqueo.php" target="_parent">Bloquear Cuenta </a></div>
                  </div></td>
                  <td width="266" class="Estilo4">&nbsp;</td>
                </tr>
              </table>
			  <script language="JavaScript">
function muestra(queCosa)
{
    alert(queCosa);
}
</script>
<?

include('../config.php');	
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);

while($rowxxx = mysql_fetch_array($rxx)) 
   {
   
   $idxxx=$rowxxx["id_emp"];
 
   }			

$sql="select * from pgcp where id_emp = '$idxxx'";
$res=mysql_query($sql);
$numeroRegistros=mysql_num_rows($res);
if($numeroRegistros<=0)
{
    echo "<div align='center'>";
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
    echo "</div>";
}else{
    //////////elementos para el orden
    if(!isset($orden))
    {
       $orden="cod_pptal";
    }
    //////////fin elementos de orden

    //////////calculo de elementos necesarios para paginacion
    //tama�o de la pagina
    $tamPag=50;

    //pagina actual si no esta definida y limites
    if(!isset($_GET["pagina"]))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $pagina = $_GET["pagina"];
    }
    //calculo del limite inferior
    $limitInf=($pagina-1)*$tamPag;

    //calculo del numero de paginas
    $numPags=ceil($numeroRegistros/$tamPag);
    if(!isset($pagina))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $seccionActual=intval(($pagina-1)/$tamPag);
       $inicio=($seccionActual*$tamPag)+1;

       if($pagina<$numPags)
       {
          $final=$inicio+$tamPag-1;
       }else{
          $final=$numPags;
       }

       if ($final>$numPags){
          $final=$numPags;
       }
    }

//////////fin de dicho calculo

//////////creacion de la consulta con limites
$sql="select * from pgcp where id_emp = '$idxxx' ORDER BY ".$orden." ASC LIMIT ".$limitInf.",".$tamPag;
$res=mysql_query($sql);

//////////fin consulta con limites
echo "<div align='center'>";
echo "<font face='verdana' size='-2'><br>Encontrados ".$numeroRegistros." resultados<br><br>";
echo "</font></div>";

////*****

	printf("
	
	<table border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr><td align='center' valign='middle'>
	
	");
	
	if($pagina>1)
    {
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."'>";
       echo "<font face='verdana' size='-2'>anterior</font>";
       echo "</a> ";
    }

    for($i=$inicio;$i<=$final;$i++)
    {
       if($i==$pagina)
       {
          echo "<font face='verdana' size='-2'><b>".$i."</b> </font>";
       }else{
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."'>";
          echo "<font face='verdana' size='-2'>".$i."</font></a> ";
       }
    }
    if($pagina<$numPags)
   {
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."'>";
       echo "<font face='verdana' size='-2'>siguiente</font></a>";
   }

printf("

   </td>
   </tr>
    </table><br>
");

/*printf("

   </td>
   <td valign='middle'>&nbsp;&nbsp;&nbsp;<a href=\"consulta_pgcp_a.php\"><span class='Estilo4'>Ver Todo el P.G.C.P</span></a></td>   
	</tr>
    </table><br>
");*/


////****

printf("
<table width='750' BORDER='1' class='bordepunteado1' align = 'center'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='70'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'>Detalle</span>
</div>
</td>
<td align='center' width='180'><span class='Estilo1'>Cod. Pptal</span></td>
<td align='center' width='350'><span class='Estilo1'>Nombre Rubro</span></td>
<td align='center' width='30'><span class='Estilo1'>Tip</span></td>
<td align='center' width='30'><span class='Estilo1'>Niv</span></td>
<td align='center' width='30'><span class='Estilo1'>Ban</span></td>
<td align='center' width='30'><span class='Estilo1'>Nat</span></td>
<td align='center' width='30'><span class='Estilo1'>Cte</span></td>

</tr>


");

while($registro=mysql_fetch_array($res))
{

printf("
<tr>
<td align='center'><span class='Estilo4'> Ver Mas </span></td>
<td align='left'><span class='Estilo4'><a href=\"modi_cuenta_pgcp.php?id=%s\"> %s </a></span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td bgcolor='#EBEBE4' align='center'><span class='Estilo4'> %s </span></td>

</tr>", $registro["cod_pptal"], $registro["cod_pptal"], 
		$registro["nom_rubro"], $registro["tip_dato"], $registro["nivel"],
		$registro["banco"], $registro["naturaleza"], 
		$registro["c_nc"]); 
}//fin while
echo "</table>";
}//fin if
//////////a partir de aqui viene la paginacion
?>
<br />
<table width="800" border="1" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
      <div align="center" class="Estilo4"><strong>IMPORTANTE</strong></div>
    </div></td>
  </tr>
  <tr>
    <td align="left"><div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <span class="Estilo4"> 1 . Si selecciona un <strong>CODIGO PRESUPUESTAL</strong> puede <strong>MODIFICAR</strong> los datos basicos de la cuenta. <br />
      2 . <strong>TIP</strong> = tipo -&gt; D = detalle ; M = mayor <br />
      3
      . <strong>NIV</strong> = nivel <br />
      4
      . <strong>BAN</strong> = banco<br />
      5
      . <strong>NAT</strong> = naturaleza -&gt; D = debito ; C = credito <br />
      6
      . <strong>CTE</strong> = corriente -&gt; C = corriente ; NC = no corriente <br />
    </span> </div></td>
  </tr>
</table>
              </div></td>
	  </tr>
	
	
	<tr>
	  <td><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
          <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
            <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
              <div align="center"><a href='index_pgcp.php' target='_parent'>VOLVER</a> </div>
            </div>
          </div>
        </div>
	    </div></td>
	  </tr>
	<tr>
	<td>
	
	 
	  
	    <div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center">
		<span class="Estilo4">Fecha de  esta Sesion:</span> 
		<br />
        <span class="Estilo4">
		<strong>
<? include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
		</strong>
		</span>
		<br />
        <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u>
		</span> 
		</div>
	    </div>
	  </td>
	</tr>
	</table>
	</td>
  </tr>

  <tr align="center">
    <td width="283">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email ?>	</div>
	</div>	</td>
    <td width="283">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="283">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?
}
?>