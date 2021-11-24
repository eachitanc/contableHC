<? set_time_limit(600);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo4 {font-weight: bold}
a:link {
	color: #0000CC;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000CC;
}
a:hover {
	text-decoration: underline;
	color: #0000CC;
}
a:active {
	text-decoration: none;
	color: #0000CC;
}
.Estilo5 {
	color: #990000;
	font-weight: bold;
}
</style>
</head>

<body>
<br/><br/>

<table width="800" border="1" align="center" class="bordepunteado1">
  <tr>
    <td bgcolor="#DCE9E5">
	<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	<div align="center" class="Estilo2 Estilo4">
	Pasos para cargar plantillas de contratos</div>
	</div>	</td>
  </tr>
  <tr>
    <td>
<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	1. Descargue instructivo para nombrar plantillas y uso de variables <a href="instructivo.php"><strong>AQUI</strong></a> </div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	2. Diligencie la plantilla del contrato usando las variables requeridas <span class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"></span></div>	</td>
  </tr>
  <tr>
    <td>
	<div class="Estilo2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	
	3. Suba el archivo usando el siguiente cuadro:	</div>	</td>
  </tr>
  <tr>
    <td>
	<form action="sube_plantilla.php" method="post" enctype="multipart/form-data">
   <div align="center">
     <!-- <b>Campo de tipo texto:</b>
    <br>-->
     <!--<input type="text" name="cadenatexto" size="20" maxlength="100">-->
     <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
     <br>
     <span class="Estilo2"><strong>Subir Archivo de Plantilla </strong></span><br />
     
	 <span class="Estilo2"><em>Nombre del archivo ejemplo: C1.rtf<br />
	 </em></span><br />

     <input name="userfile" type="file" class="Estilo2">
     <br><br />
     <input type="submit" class="Estilo2" value="Subir Archivo">
   </div>
</form>	
<br /></td>
  </tr>
</table>
<br />
<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../contratacion/index.php' target='_parent' class="Estilo2">VOLVER </a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
