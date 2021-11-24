<!-- Menu bar. -->
<div class="menuBar" style="width:99,5%;" id="menuBar">
<a class="menuButton" href="" onClick="return buttonClick(event, 'fileMenu');" onMouseOver="buttonMouseover(event, 'fileMenu');">Inicio</a>
<a class="menuButton" href="" onClick="return buttonClick(event, 'editMenu');" onMouseOver="buttonMouseover(event, 'editMenu');">Gesti&oacute;n</a>
<a class="menuButton" href="" onClick="return buttonClick(event, 'herrMenu');" onMouseOver="buttonMouseover(event, 'herrMenu');">Herramientas</a>
</div>

<!-- Main menus. -->

<div id="fileMenu" class="menu" onMouseOver="menuMouseover(event)">
<a class="menuItem" href="#" onclick="cargaMenu(event,'user/inicio/formulario.php','contenido','fileMenu');">Sesi&oacute;n de trabajo</a>
<a class="menuItem" href="#" onclick="cargaMenu(event,'admin/usuarios/reporte.php','contenido','fileMenu');">Cambiar contrase&ntilde;a</a>
<a class="menuItem" href="#" onclick="cargaMenu(event,'admin/entidad/reporte.php','contenido','fileMenu');">Actualizar datos</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="#" onclick="cargaMenu(event,'admin/borrar_session.php','Log','fileMenu');">Salir</a>

</div>
<!-- File menu end -->


<div id="editMenu" class="menu" onMouseOver="menuMouseover(event)">
<a class="menuItem" href="#" onclick="cargaMenu(event,'user/flujo/formulario.php','contenido','editMenu');">Flujo de efectivo</a>
<a class="menuItem" href="#" >Inventarios</a>

</div>

<div id="herrMenu" class="menu">
<a class="menuItem" href="#" onclick="cargaMenu('user/herramientas/fichas/buscar.php','contenido','herrMenu');">Editar encabezado de fichas</a>
</div>


<div id="viewMenu" class="menu">
<a class="menuItem" href="#" onclick="cargaMenu('user/reportes/fichas_dia/buscar.php','contenido','viewMenu');">Registro de fichas</a>
<a class="menuItem" href="#" onclick="cargaMenu('user/reportes/filtros/control.php','contenido','viewMenu');">Listado General</a>
<a class="menuItem" href="user/reportes/listado/reporte_etnias.php">Direcci&oacute;n de Etnias</a>
<a class="menuItem" href="user/reportes/adulto/reporte_adulto_potenciales.php">Adulto mayor sin cobertura</a>
<a class="menuItem" href="user/reportes/familias/reporte_familias.php">Familias en Acci&oacute;n</a>
</div>

<div id="toolsMenu" class="menu" onMouseOver="menuMouseover(event)">
<a class="menuItem" href="" onClick="return false;" onMouseOver="menuItemMouseover(event, 'toolsMenu1');"
><span class="menuItemText">Tools Menu Item 1</span><span class="menuItemArrow">&#9654;</span></a>
<a class="menuItem" href="blank.html">Tools Menu Item 2</a>
<a class="menuItem" href="blank.html">Tools Menu Item 3</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="" onClick="return false;" onMouseOver="menuItemMouseover(event, 'toolsMenu4');"
><span class="menuItemText">Tools Menu Item 4</span><span class="menuItemArrow">&#9654;</span></a>
<a class="menuItem" href="blank.html">Tools Menu Item 5</a>
</div>

<div id="optionsMenu" class="menu">

<a class="menuItem" href="blank.html">Options Menu Item 1</a>
<a class="menuItem" href="blank.html">Options Menu Item 2</a>
<a class="menuItem" href="blank.html">Options Menu Item 3</a>
</div>

<div id="helpMenu" class="menu">
<a class="menuItem" href="blank.html">Help Menu Item 1</a>
<a class="menuItem" href="blank.html">Help Menu Item 2</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="blank.html">Help Menu Item 3</a>
</div>

<!-- File sub menus. -->

<div id="fileMenu2" class="menu">
<a class="menuItem" href="blank.html">File Menu 2 Item 1</a>
<a class="menuItem" href="blank.html">File Menu 2 Item 2</a>
</div>

<!-- Edit sub menus. -->

<div id="editMenu3" class="menu" onMouseOver="menuMouseover(event)">
<a class="menuItem" href="blank.html">Edit Menu 3 Item 1</a>
<a class="menuItem" href="blank.html">Edit Menu 3 Item 2</a>

<div class="menuItemSep"></div>
<a class="menuItem" href="" onClick="return false;" onMouseOver="menuItemMouseover(event, 'editMenu3_3');"
><span class="menuItemText">Edit Menu 3 Item 3</span><span class="menuItemArrow">&#9654;</span></a>
<a class="menuItem" href="blank.html">Edit Menu 3 Item 4</a>
</div>

<div id="editMenu3_3" class="menu">
<a class="menuItem" href="blank.html">Edit Menu 3-3 Item 1</a>
<a class="menuItem" href="blank.html">Edit Menu 3-3 Item 2</a>
<a class="menuItem" href="blank.html">Edit Menu 3-3 Item 3</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="blank.html">Edit Menu 3-3 Item 4</a>

</div>

<!-- Tools sub menus. -->

<div id="toolsMenu1" class="menu">
<a class="menuItem" href="blank.html">Tools Menu 1 Item 1</a>
<a class="menuItem" href="blank.html">Tools Menu 1 Item 2</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="blank.html">Tools Menu 1 Item 3</a>
<a class="menuItem" href="blank.html">Tools Menu 1 Item 4</a>
<div class="menuItemSep"></div>
<a class="menuItem" href="blank.html">Tools Menu 1 Item 5</a>

</div>

<div id="toolsMenu4" class="menu" onMouseOver="menuMouseover(event)">
<a class="menuItem" href="blank.html">Tools Menu 4 Item 1</a>
<a class="menuItem" href="blank.html">Tools Menu 4 Item 2</a>
<a class="menuItem" href="blank.html" onClick="return false;" onMouseOver="menuItemMouseover(event, 'toolsMenu4_3');"><span class="menuItemText">Tools Menu 4 Item 3</span><span class="menuItemArrow">&#9654;</span></a>
</div>

<div id="toolsMenu4_3" class="menu">
<a class="menuItem" href="blank.html">Tools Menu 4-3 Item 1</a>
<a class="menuItem" href="blank.html">Tools Menu 4-3 Item 2</a>
<a class="menuItem" href="blank.html">Tools Menu 4-3 Item 3</a>

<a class="menuItem" href="blank.html">Tools Menu 4-3 Item 4</a>
</div>