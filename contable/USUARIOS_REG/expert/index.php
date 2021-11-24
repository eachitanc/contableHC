<? header('Content-Type: text/html; charset=latin1');  ?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <!--link href="css/ionicons.min.css" rel="stylesheet"-->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <title>Mantenimiento</title>
    <script>
      function mostrarLogin(){
      var dialogo = document.getElementById('formLogin');
      dialogo.showModal();
      }
      function cerrarLogin(){
      var dialogo = document.getElementById('formLogin');
      dialogo.close();
      }
    // Para mostrar menu vertical del formulario de causacion
    function verMenu(id,archivo,campo){
    for (i=1;i<= 5;i++)
		{
			var opci = "menu"+i;
			if (opci != id)
			{
				document.getElementById(opci).style.backgroundColor="#ffffff";
				document.getElementById(opci).style.fontWeight="normal";
			}
		}
      document.getElementById(id).style.backgroundColor="rgb(220, 233, 229)";
      document.getElementById(id).style.fontWeight="bold";
      //aplicar funcion de acuerdo a archivos a cargar en el div
      document.body.style.cursor = "default"; 
		  $("#"+campo).load(archivo);	
    }
    // para cargar archivos
    function cargaArchivo(archivo,campo){
      $("#"+campo).load(archivo);	
      
    }

    </script>
    </head>
  <? //Bloque de codigo php

    include '../config.php';
    $cx=mysql_connect($server,$dbuser,$dbpass);
    mysql_select_db("$database"); 
    $id_auto_crpp = $_GET['id0'];
    // consulto los datos del registro
    $sq1="select fecha_crpp, tercero, detalle_crpp from crpp where id_auto_crpp ='$id_auto_crpp'";
    $rs1 =mysql_query($sq1,$cx);
    while ($rw1 =mysql_fetch_array($rs1))
    {
      $fecha_registro = $rw1["fecha_crpp"];
      $ter = $rw1["tercero"];
      $concepto = $rw1["detalle_crpp"];
    }
    // Consulto la fecha actual
    $hoy = date('Y-m-d');
    $fecha_ini = date("Y-m-d", strtotime($fecha_registro));
    // Consulto la fecha maxima del sistema
    $sq2="select * from vf ";
    $rs2 =mysql_query($sq2,$cx);
    while ($rw2 =mysql_fetch_array($rs2))
    {
      $fecha_fin = $rw2['fecha_fin'];
    }
    $fecha_fin = date("Y-m-d", strtotime($fecha_fin));

  ?>
  <body>
   <!-- tabla para contenido de los datos -->  
   <br>
   <input type="hidden"  id="id_crpp" value="<? echo $id_auto_crpp;?>" /> 
  <div class="container w-75">
		<div class="row mb-3">
    <div class="col-md-12">
				<table class="table table-sm table-bordered ">
					<thead>
						<tr>
							<th  colspan="3"  >Datos del registro presupuestal</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="25%"  class="m-5">Fecha</td>
							<td width="75%"><input type="date" id="start" name="trip-start" value="<? echo $hoy; ?>"  min="<? echo $fecha_ini; ?>" max="<? echo $fecha_fin; ?>"></td>
						
						</tr>
						<tr>
							<td class="m-5">Tercero</td>
							<td><? echo $ter; ?></td>
						</tr>
						<tr>
							<td class="m-5">Concepto</td>
							<td><textarea name="textarea" rows="3" cols="80"><? echo $concepto; ?></textarea></td>
						</tr>
            <tr>
							<td class="m-5">Sede</td>
							<td><select name="transporte"> 
                          <option selected></option>
                          <option>Ipiales</option>
                          <option>Tuquerres</option>
                          <option>Tumaco</option>
                        
                    </select></td></td>
						</tr>
            <tr>
							<td class="m-5 px-0 py-0">
              <ul class="list-group list-group-flush">
                <li id="menu1" class="list-group-item list-group-item-action" onclick="verMenu(id,'cc.php?id=<? echo $id_auto_crpp; ?>','mostrar')">Centros de costo</li>
                <li id="menu2" class="list-group-item list-group-item-action" onclick="verMenu(id)"><? echo "Imputaci&oacute;n presupuestal"; ?></li>
                <li id="menu3" class="list-group-item list-group-item-action" onclick="verMenu(id)">Descuentos</li>
                <li id="menu4" class="list-group-item list-group-item-action" onclick="verMenu(id)">Movimiento contable</li>
                <li id="menu5" class="list-group-item list-group-item-action" onclick="verMenu(id)">Vestibulum at eros</li>
              </ul>
              </td>
							<td >
                <!-- tabla centro de costo -->  
               <div id="mostrar" class="py-2 px-5 "></div>
              </td>
						</tr>
					</tbody>
				</table>
      </div>
		</div>
  </div>
  <!-- fin tabla contenido de datos generales-->

  <div class=" align-items-center ">
        <button type="button" class="btn btn-primary btn-sm">Primary</button>
        <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
</div>
    
    
    <!-- Optional JavaScript; choose one of the two! -->
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
   
  
  </body>
</html>
