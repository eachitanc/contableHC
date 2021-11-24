<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
<title>CONTAFACIL</title>
<script>
function chk_pgcp1(){
var pos_url = 'comprueba_cta2.php';
var cod = document.getElementById('pgcp1').value;
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
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
</head>
<body>
<div align="center" class="Estilo1"><a href="reporte.php">Ver plan de cuentas</a></div>
<form name="a">
  <div align="center">
  <span class="Estilo1">Digite el Codigo Contable, el sistema mostrara, nivel por nivel, las cuentas que en este se encuentren contenidas<br>
  <BR><b>COPIE Y PEGUE EL CODIGO DONDE CONSIDERE NECESARIO</b></span><br><br>
  <input name="pgcp1" type="text" class="Estilo1" id="pgcp1" style="width:180px;" onKeyUp="chk_pgcp1();"/>
  <br /><br>
  </div>
  <div align="center" id='resultado'></div>
</form>
</body>
</html>

<?php
}
?>