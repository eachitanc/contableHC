<!-- Menu bar. -->
<div class="menuBar" style="width:99,5%;" id="menuBar">
<a class="menuButton" href="" onClick="return buttonClick(event, 'fileMenu');" onMouseOver="buttonMouseover(event, 'fileMenu');">Inicio</a>
</div>
<!-- Main menus. -->
<div id="fileMenu" class="menu" onMouseOver="menuMouseover(event)">
<a class="menuItem" href="#" onclick="cargaMenu(event,'admin/form_log.php','contenido','fileMenu');">Iniciar sesi&oacute;n</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="#" onclick="cargaMenu(event,'admin/borrar_session.php','Log','fileMenu');">Salir</a>
</div>
<!-- File menu end -->

