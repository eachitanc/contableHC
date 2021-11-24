<div id="content">
    <div id="izquierda">
    	<?php include('menu_ver.php'); ?>
    </div>
    
    <div id="derecha">
    	<div>&nbsp;</div>
        <div class="tabbed-area">
       <input name="ctrl" id="ctrl" type="hidden" value="1" />
        <!-- menu pestañas-->
                            <ul class="tabs group">
                                <li><a href='#' onclick=ocultaMenu()>&nbsp;<i style="color:#999" class='fa fa-reorder'></i></a>
                                <li><a href="#box-1">Ingresos</a></li>
                                <li><a href="#box-2">Gastos</a></li>
                                <li><a href="#box-3">Cuentas por pagar</a></li>
                            </ul>
       	</div>
        <div id="contenedor">
                            <div id="contenidos">
                                <div id="columna1"></div>
                                <div id="columna2" style="display:none">Columna 2</div>
                                <div id="columna2" style="display:none">Columna 3</div>
                            </div>
         </div>
        
    </div>
</div> 