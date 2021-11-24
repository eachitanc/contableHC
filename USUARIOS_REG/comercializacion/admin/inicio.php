<div id="content">
    <div id="izquierda">
    	<?php include('menu/menu_ver.php'); ?>
    </div>
    
    <div id="derecha">
    	<div>&nbsp;</div>
        <div class="tabbed-area">
       <input name="ctrl" id="ctrl" type="hidden" value="1" />
	        <!-- menu pestañas-->
            <?php include('menu/menu_pes.php'); ?>
       	</div>
        <div id="contenedor">
                            <div id="contenidos">
                                <div id="columna1"></div>
                                <div id="columna2" style="display:none">Columna 2</div>
                                <div id="columna3" style="display:none">Columna 3</div>
                            </div>
         </div>
        
    </div>
</div> 
<script>
document.getElementById("ctrl").select();
</script>
