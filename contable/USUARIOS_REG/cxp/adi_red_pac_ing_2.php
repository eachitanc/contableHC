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
<style type="text/css">
<!--
.Estilo18 {font-weight: bold}
.Estilo19 {font-weight: bold}
.Estilo20 {font-weight: bold}
.Estilo21 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
</head>


</head>

<body>
<table width="880" border="0" align="center">
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
            <div align="center"><a href='adi_red_pac_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><table width="800" border="0" align="center">
      
      <tr>
        <td>
		<form name="b" method="post" action="proc_adi_red_pac_ing.php" onsubmit="return confirm('Desea Actualizar?')">
		<div align="center"><span class="Estilo4"><span class="Estilo21">	  - P.A.C - Cuenta Seleccionada</span>
<br />
<?php 
include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];

   }
?>
<? 
			
		   mysql_connect($server,$dbuser,$dbpass); 
		   mysql_select_db($database);  
		   $a=$_POST['nn'];  
		   $a1=mysql_query("select * from pac_cxp where cod_pptal = '$a' and id_emp ='$idxx'");  
		   $result = @mysql_query($a1);
		   while($row = mysql_fetch_array($a1)) 
		   { 
			 

	  	$cod_pptal=$row["cod_pptal"];
		$nom_rubro=$row["nom_rubro"];
		$definitivo=$row["definitivo"];
		$meses=$row["meses"];
		$enero=$row["enero"];
		$febrero=$row["febrero"];
		$marzo=$row["marzo"];
		$abril=$row["abril"];
		$mayo=$row["mayo"];
		$junio=$row["junio"];
		$julio=$row["julio"];
		$agosto=$row["agosto"];
		$septiembre=$row["septiembre"];
		$octubre=$row["octubre"];
		$noviembre=$row["noviembre"];
		$diciembre=$row["diciembre"];
		$rezago=$row["rezago"];
		$total=$row["total"];
		$diferencia=$row["diferencia"];
		
		$adi_pac_ene=$row["adi_pac_ene"];
		$red_pac_ene=$row["red_pac_ene"];
		$pac_def_ene=$row["pac_def_ene"];
		$pac_uti_ene=$row["pac_uti_ene"];
		$sal_pac_ene=$row["sal_pac_ene"];
		
		$adi_pac_feb=$row["adi_pac_feb"];
		$red_pac_feb=$row["red_pac_feb"];
		$pac_def_feb=$row["pac_def_feb"];
		$pac_uti_feb=$row["pac_uti_feb"];
		$sal_pac_feb=$row["sal_pac_feb"];
		
		$adi_pac_mar=$row["adi_pac_mar"];
		$red_pac_mar=$row["red_pac_mar"];
		$pac_def_mar=$row["pac_def_mar"];
		$pac_uti_mar=$row["pac_uti_mar"];
		$sal_pac_mar=$row["sal_pac_mar"];
		
		$adi_pac_abr=$row["adi_pac_abr"];
		$red_pac_abr=$row["red_pac_abr"];
		$pac_def_abr=$row["pac_def_abr"];
		$pac_uti_abr=$row["pac_uti_abr"];
		$sal_pac_abr=$row["sal_pac_abr"];
		
		$adi_pac_may=$row["adi_pac_may"];
		$red_pac_may=$row["red_pac_may"];
		$pac_def_may=$row["pac_def_may"];
		$pac_uti_may=$row["pac_uti_may"];
		$sal_pac_may=$row["sal_pac_may"];
		
		$adi_pac_jun=$row["adi_pac_jun"];
		$red_pac_jun=$row["red_pac_jun"];
		$pac_def_jun=$row["pac_def_jun"];
		$pac_uti_jun=$row["pac_uti_jun"];
		$sal_pac_jun=$row["sal_pac_jun"];
		
		$adi_pac_jul=$row["adi_pac_jul"];
		$red_pac_jul=$row["red_pac_jul"];
		$pac_def_jul=$row["pac_def_jul"];
		$pac_uti_jul=$row["pac_uti_jul"];
		$sal_pac_jul=$row["sal_pac_jul"];
		
		$adi_pac_ago=$row["adi_pac_ago"];
		$red_pac_ago=$row["red_pac_ago"];
		$pac_def_ago=$row["pac_def_ago"];
		$pac_uti_ago=$row["pac_uti_ago"];
		$sal_pac_ago=$row["sal_pac_ago"];
		
		$adi_pac_sep=$row["adi_pac_sep"];
		$red_pac_sep=$row["red_pac_sep"];
		$pac_def_sep=$row["pac_def_sep"];
		$pac_uti_sep=$row["pac_uti_sep"];
		$sal_pac_sep=$row["sal_pac_sep"];
		
		$adi_pac_oct=$row["adi_pac_oct"];
		$red_pac_oct=$row["red_pac_oct"];
		$pac_def_oct=$row["pac_def_oct"];
		$pac_uti_oct=$row["pac_uti_oct"];
		$sal_pac_oct=$row["sal_pac_oct"];
		
		$adi_pac_nov=$row["adi_pac_nov"];
		$red_pac_nov=$row["red_pac_nov"];
		$pac_def_nov=$row["pac_def_nov"];
		$pac_uti_nov=$row["pac_uti_nov"];
		$sal_pac_nov=$row["sal_pac_nov"];
		
		$adi_pac_dic=$row["adi_pac_dic"];
		$red_pac_dic=$row["red_pac_dic"];
		$pac_def_dic=$row["pac_def_dic"];
		$pac_uti_dic=$row["pac_uti_dic"];
		$sal_pac_dic=$row["sal_pac_dic"];
		
		$suma_adi=$row["suma_adi"];
		$suma_red=$row["suma_red"];
		//$suma_def=$row["suma_def"];
		//$suma_uti=$row["suma_uti"];
		
		$adi_rezago=$row["adi_rezago"];
		$red_rezago=$row["red_rezago"];
		$def_rezago=$row["def_rezago"];
		$uti_rezago=$row["uti_rezago"];
		$sal_rezago=$row["sal_rezago"];



			} 
?>
		</span><br />
		
		<table width="750" border="1" align="center" class="bordepunteado1">
          <tr>
            <td width="250" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right"><strong>CODIGO : </strong></div>
                </div>
            </div></td>
            <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="left"><? printf('%s',$cod_pptal); ?>
                    <input name="cod_pptal" type="hidden" id="cod_pptal" value="<? printf('%s',$cod_pptal); ?>" />
                  </div>
                </div>
            </div></td>
          </tr>
          <tr>
            <td width="250" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="right"><span class="Estilo4"><strong>CUENTA : </strong></span></div>
            </div></td>
            <td colspan="2" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="left">
                  <span class="Estilo4"><? printf('%s',$nom_rubro); ?></span>
                  <input name="nom_rubro" type="hidden" id="nom_rubro" value="<? printf('%s',$nom_rubro); ?>" />
                </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="right"><span class="Estilo4"><strong>VALOR APROPIADO : </strong></span></div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="left">
                  <span class="Estilo4"><? printf('%.2f',$definitivo); ?></span>
                  <input name="definitivo" type="hidden" id="definitivo" value="<? printf('%.2f',$definitivo); ?>" />
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center"></div>
            </div></td>
          </tr>
          <tr>
            <td width="250" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right"><strong>MESES   : </strong></div>
                </div>
            </div></td>
            <td width="250" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="left"><span class="Estilo4"> <? printf('%d',$meses); ?></span>
                  <input name="meses" type="hidden" id="meses" value="<? printf('%d',$meses); ?>" />
                </div>
            </div></td>
            <td width="250" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center"></div>
            </div></td>
          </tr>
        </table>
		<br />
		<table width="840" border="1" align="center" class="bordepunteado1">
		  <tr>
            <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>MES</strong></div>
                </div>
            </div></td>
		    <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>P.A.C PROGRAMADO </strong></div>
                </div>
		      </div></td>
		    <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>ADICIONES</strong></div>
              </div>
		      </div></td>
		    <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>REDUCCIONES</strong></div>
              </div>
		      </div></td>
		    <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>P.A.C  DEFINITIVO </strong></div>
                </div>
		      </div></td>
		    <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>P.A.C UTILIZADO </strong></div>
                </div>
		      </div></td>
		    <td bgcolor="#DCE9E5" width="120"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>SALDO P.A.C MES SIGUI. </strong></div>
                </div>
		      </div></td>
	      </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>ENERO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="enero" type="hidden" value="<? printf('%.2f',$enero); ?>" />
                    <? printf('%.2f',$enero); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a > 1)
				{
				?> 
				
                <input name="adi_pac_ene" type="hidden" value="0"/>
				
                <?
				}
				else
				{
				?>
				<input name="adi_pac_ene" type="text" class="Estilo4" id="adi_pac_ene"  style="text-align:right" value="<? printf('%.2f',$adi_pac_ene); ?>" size="20" maxlength="20"/>
				
				<?
				}
				?>
				</div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF">
			<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a > 1)
				{
				?> 
				 <input name="red_pac_ene" type="hidden" value="0"/>
				<?
				}
				else
				{
				?>
                  <input name="red_pac_ene" type="text" class="Estilo4" id="red_pac_ene" style="text-align:right" value="<? printf('%.2f',$red_pac_ene); ?>" size="20" maxlength="20" />
				<?
				}
				?>  
				  
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_ene); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_ene); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_ene); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>FEBRERO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="febrero" type="hidden" id="febrero" value="<? printf('%.2f',$febrero); ?>" />
                    <? printf('%.2f',$febrero); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <? 
				$a = date("m", strtotime($ano));
				if($a >2)
				{
				?>
                  <input name="adi_pac_feb" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
<input name="adi_pac_feb" type="text" class="Estilo4" id="adi_pac_feb" style="text-align:right" value="<? printf('%.2f',$adi_pac_feb); ?>" size="20" maxlength="20"/>
                <?
				}
				?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				 <? 
				$a = date("m", strtotime($ano));
				if($a >2)
				{
				?>
                  <input name="red_pac_feb" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_feb" type="text" class="Estilo4" id="red_pac_feb" style="text-align:right" value="<? printf('%.2f',$red_pac_feb); ?>" size="20" maxlength="20" />
				  <?
				}
				?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_feb); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_feb); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_feb); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>MARZO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="marzo" type="hidden" id="marzo" value="<? printf('%.2f',$marzo); ?>" />
                    <? printf('%.2f',$marzo); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				 <? 
				$a = date("m", strtotime($ano));
				if($a >3)
				{
				?>
                  <input name="adi_pac_mar" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_mar" type="text" class="Estilo4" id="adi_pac_mar" style="text-align:right" value="<? printf('%.2f',$adi_pac_mar); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >3)
				{
				?>
                  <input name="red_pac_mar" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_mar" type="text" class="Estilo4" id="red_pac_mar" style="text-align:right" value="<? printf('%.2f',$red_pac_mar); ?>" size="20" maxlength="20" />
				    <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_mar); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_mar); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_mar); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>ABRIL</strong></div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">

                  <div align="right">
                    <input name="abril" type="hidden" id="abril" value="<? printf('%.2f',$abril); ?>" />
                    <? printf('%.2f',$abril); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >4)
				{
				?>
                  <input name="adi_pac_abr" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_abr" type="text" class="Estilo4" id="adi_pac_abr" style="text-align:right" value="<? printf('%.2f',$adi_pac_abr); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >4)
				{
				?>
                  <input name="red_pac_abr" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_abr" type="text" class="Estilo4" id="red_pac_abr" style="text-align:right" value="<? printf('%.2f',$red_pac_abr); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_abr); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_abr); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_abr); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>MAYO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="mayo" type="hidden" id="mayo" value="<? printf('%.2f',$mayo); ?>" />
                    <? printf('%.2f',$mayo); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >5)
				{
				?>
                  <input name="adi_pac_may" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_may" type="text" class="Estilo4" id="adi_pac_may" style="text-align:right" value="<? printf('%.2f',$adi_pac_may); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >5)
				{
				?>
                  <input name="red_pac_may" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_may" type="text" class="Estilo4" id="red_pac_may" style="text-align:right" value="<? printf('%.2f',$red_pac_may); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_may); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_may); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_may); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>JUNIO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="junio" type="hidden" id="junio" value="<? printf('%.2f',$junio); ?>" />
                    <? printf('%.2f',$junio); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >6)
				{
				?>
                  <input name="adi_pac_jun" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_jun" type="text" class="Estilo4" id="adi_pac_jun" style="text-align:right" value="<? printf('%.2f',$adi_pac_jun); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >6)
				{
				?>
                  <input name="red_pac_jun" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_jun" type="text" class="Estilo4" id="red_pac_jun" style="text-align:right" value="<? printf('%.2f',$red_pac_jun); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_jun); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_jun); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_jun); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>JULIO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="julio" type="hidden" id="julio" value="<? printf('%.2f',$julio); ?>" />
                    <? printf('%.2f',$julio); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >7)
				{
				?>
                  <input name="adi_pac_jul" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_jul" type="text" class="Estilo4" id="adi_pac_jul" style="text-align:right" value="<? printf('%.2f',$adi_pac_jul); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >7)
				{
				?>
                  <input name="red_pac_jul" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_jul" type="text" class="Estilo4" id="red_pac_jul" style="text-align:right" value="<? printf('%.2f',$red_pac_jul); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_jul); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_jul); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_jul); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>AGOSTO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="agosto" type="hidden" id="agosto" value="<? printf('%.2f',$agosto); ?>" />
                    <? printf('%.2f',$agosto); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >8)
				{
				?>
                  <input name="adi_pac_ago" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_ago" type="text" class="Estilo4" id="adi_pac_ago" style="text-align:right" value="<? printf('%.2f',$adi_pac_ago); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >8)
				{
				?>
                  <input name="red_pac_ago" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_ago" type="text" class="Estilo4" id="red_pac_ago" style="text-align:right" value="<? printf('%.2f',$red_pac_ago); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_ago); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_ago); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_ago); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>SEPTIEMBRE</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="septiembre" type="hidden" id="septiembre" value="<? printf('%.2f',$septiembre); ?>" />
                    <? printf('%.2f',$septiembre); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >9)
				{
				?>
                  <input name="adi_pac_sep" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_sep" type="text" class="Estilo4" id="adi_pac_sep" style="text-align:right" value="<? printf('%.2f',$adi_pac_sep); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >9)
				{
				?>
                  <input name="red_pac_sep" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_sep" type="text" class="Estilo4" id="red_pac_sep" style="text-align:right" value="<? printf('%.2f',$red_pac_sep); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_sep); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_sep); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_sep); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>OCTUBRE</strong></div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="octubre" type="hidden" id="octubre" value="<? printf('%.2f',$octubre); ?>" />
                    <? printf('%.2f',$octubre); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >10)
				{
				?>
                  <input name="adi_pac_oct" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_oct" type="text" class="Estilo4" id="adi_pac_oct" style="text-align:right" value="<? printf('%.2f',$adi_pac_oct); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >10)
				{
				?>
                  <input name="red_pac_oct" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_oct" type="text" class="Estilo4" id="red_pac_oct" style="text-align:right" value="<? printf('%.2f',$red_pac_oct); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_oct); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_oct); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_oct); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>NOVIEMBRE</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="noviembre" type="hidden" id="noviembre" value="<? printf('%.2f',$noviembre); ?>" />
                    <? printf('%.2f',$noviembre); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >11)
				{
				?>
                  <input name="adi_pac_nov" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_nov" type="text" class="Estilo4" id="adi_pac_nov" style="text-align:right" value="<? printf('%.2f',$adi_pac_nov); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >11)
				{
				?>
                  <input name="red_pac_nov" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_nov" type="text" class="Estilo4" id="red_pac_nov" style="text-align:right" value="<? printf('%.2f',$red_pac_nov); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_nov); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_nov); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_nov); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>DICIEMBRE</strong></div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="diciembre" type="hidden" id="diciembre" value="<? printf('%.2f',$diciembre); ?>" />
                    <? printf('%.2f',$diciembre); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >12)
				{
				?>
                  <input name="adi_pac_dic" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="adi_pac_dic" type="text" class="Estilo4" id="adi_pac_dic" style="text-align:right" value="<? printf('%.2f',$adi_pac_dic); ?>" size="20" maxlength="20"/>
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
				<? 
				$a = date("m", strtotime($ano));
				if($a >12)
				{
				?>
                  <input name="red_pac_dic" type="hidden" id="adi_pac_feb" value="0"/>
                  <?
				}
				else
				{
				?>
                  <input name="red_pac_dic" type="text" class="Estilo4" id="red_pac_dic" style="text-align:right" value="<? printf('%.2f',$red_pac_dic); ?>" size="20" maxlength="20" />
				  <? } ?>
                </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_def_dic); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$pac_uti_dic); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_pac_dic); ?> </div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="center"><strong>REZAGO</strong></div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo4">
                  <div align="right">
                    <input name="rezago" type="hidden" id="rezago" value="<? printf('%.2f',$rezago); ?>" />
                    <? printf('%.2f',$rezago); ?> </div>
                </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <input name="adi_rezago" type="text" class="Estilo4" id="adi_rezago" style="text-align:right" value="<? printf('%.2f',$adi_rezago); ?>" size="20" maxlength="20"/>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <input name="red_rezago" type="text" class="Estilo4" id="red_rezago" style="text-align:right" value="<? printf('%.2f',$red_rezago); ?>" size="20" maxlength="20"/>
                </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$def_rezago); ?></div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$uti_rezago); ?></div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$sal_rezago); ?></div>
              </div>
            </div></td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>TOTAL SUMA </strong></div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                 <div align="right">
                   <input name="total" type="hidden" id="total" value="<? printf('%.2f',$total); ?>" />
                   <? printf('%.2f',$total); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div class="Estilo19" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$suma_adi); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5"><div class="Estilo20" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="right"><? printf('%.2f',$suma_red); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>DIF. P.A.C APROP.</strong></div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                 <div align="right">
                   <input name="diferencia" type="hidden" id="diferencia" value="<? printf('%.2f',$diferencia); ?>" />
                   <? printf('%.2f',$diferencia); ?> </div>
              </div>
            </div></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
	</div>
			
			
			
			<div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
               <input name="Submit" type="submit" class="Estilo4" id="Submit" value="Actualizar P.A.C" />
              </div>
            </div>
			</form>		</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='adi_red_pac_ing.php' target='_parent'>VOLVER </a> </div>
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
    <td width="289">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="289">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="288">
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