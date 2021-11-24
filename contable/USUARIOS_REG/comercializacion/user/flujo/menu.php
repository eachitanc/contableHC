<?php
session_start();
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 
?>
<br />
<br />
<br />
<div><img src="../../img/menu.png" width="794" height="349" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="263,46,541,82" href="#"  />
    <area shape="rect" coords="143,155,346,194" href="#" onclick="cargaArchivo('user/flujo/inicio.php','contenido')" />
    <area shape="rect" coords="449,157,653,193" href="#" />
    <area shape="rect" coords="96,265,208,306" href="#" />
    <area shape="rect" coords="219,265,329,305" href="#" />
    <area shape="rect" coords="337,264,447,304" href="#" />
    <area shape="rect" coords="453,265,563,307" href="#" />
    <area shape="rect" coords="570,266,682,305" href="#" />
  </map>
</div> 
<br />
