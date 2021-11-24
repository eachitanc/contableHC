<script>
	// increase the default animation speed to exaggerate the effect
	$(function() {
		// especificaciones de la ventana de dialogo
		$( "#dialog" ).dialog({
			autoOpen: false,  // Abrir automaicamente
			height: 200, // Tamaño de la ventana
			width: 300,
			modal: true,  // bloqueo de la pagian que genera el evento
		}); 

		// funcion que se carga cuando se llama el archivo onload
		$( "#opener" ).ready(function() {
			$( "#dialog" ).dialog( "open" );
			$('#form1').each (function(){
									  this.reset();
									});

			return false;
		});
		// Cerrar el cuadro de dialogo
		$( "#enviar" ).click(function()
						{
							$( "#dialog:ui-dialog" ).dialog( "close" );
						}
		); 
	});

</script>

<!-- Espacio para cargar formulario -->
<div id="opener"></div>
    <div id="dialog" title="Iniciar sesion">
    <br />
     	<?php include('formulario.php'); ?>
    </div>



