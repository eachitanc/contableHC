<script>
// Para mostrar menu vertical del formulario de causacion
    function verMenu(id,archivo,campo){
    for (i=1;i<= 6;i++)
		{
			var opci = "menu"+i;
			if (opci != id)
			{
				document.getElementById(opci).style.backgroundColor="#ffffff";
				document.getElementById(opci).style.fontWeight="bold";
			}
		}
      document.getElementById(id).style.backgroundColor="rgb(220, 233, 229)";
      document.getElementById(id).style.fontWeight="bold";
      //aplicar funcion de acuerdo a archivos a cargar en el div
      document.body.style.cursor = "default"; 
		  $("#"+campo).load(archivo);	
    }
</script>
<!-- tabla para contenido de los datos --> 
<?php
// Conslta base de datos
include '../../config.php';
$cx= new mysqli ($server, $dbuser, $dbpass, $database);
// Recibe variables de clientes
//$id = $_GET["id"];
$tamano ="";
?> 
<div class="row justify-content-center" >
<div class="table-container table-responsive w-75" >
<br>
  <input type="hidden"  id="id_crpp" value="<? echo $id_auto_crpp;?>" /> 
  <div class="container w-90" >
				<table  class="table-bordered" >
					<thead>
						<tr>
							<th  colspan="2"   style="font-size: 16px;" >Hoja de vida equipo biomedico</th>
							<th  ></th>
						</tr>
					</thead>
					<?php
					// Consulta a base de datos
					if($cx->connect_errno)
					{ 
						echo "no conectado..";
					}else{ 
						$sql="select * from equipo where id = '1'";
						$res =$cx->query($sql);
						$row =$res->fetch_assoc();
						$nombre=$row['nombre'];
						$marca=$row['marca'];
						$modelo=$row['modelo'];
						$serie=$row['serie'];
						$identificacion=$row['identificacion'];
						$referencia=$row['referencia'];
						// Consultar ubicacion del equipo 
						$sq2="select * from ubicacion where id = '$row[id_ubicacion]'";
						$re2 =$cx->query($sq2);
						$rw2 =$re2->fetch_assoc();
						$ubicacion=$rw2["ubicacion"];
						// Consultar servicio asociado a ubicación
						$sq3="select servicio from servicios where id ='$rw2[id_servicio]'";
						$re3 =$cx->query($sq3);
						$rw3 =$re3->fetch_assoc();
						$servicio = $rw3["servicio"];
					}
					?>
					<tbody  style="font-size: 14px;  font-weight:bold;" >
						<tr >
							<td width="25%"  style="margin: 15px;padding: 3px;">Nombre</td>
							<td width="55%" style="font-weight:normal;"><?php echo $nombre; ?></td>
							<td class="alinear_img" width="20%" rowspan="8" ><img  src="user/equipos/img/fonendo.jpg" width="80%" ></td>
						</tr>
						<tr >
							<td>Servicio</td>
							<td style="font-weight:normal;"><?php echo $servicio; ?></td>
							
						</tr>
						<tr>
							<td >Ubicación </td>
							<td style="font-weight:normal;"><?php echo $ubicacion; ?></td>
							
						</tr>
						<tr>
							<td >Marca </td>
							<td style="font-weight:normal;"><?php echo $marca; ?></td>
							
						</tr>
						<tr>
							<td >Modelo </td>
							<td style="font-weight:normal;"><?php echo $modelo; ?></td>
							
						</tr>
						<tr>
							<td >Serie </td>
							<td style="font-weight:normal;"><?php echo $serie; ?></td>
							
						</tr>

						<tr>
							<td >Codigo interno </td>
							<td style="font-weight:normal;"><?php echo $identificacion; ?></td>
							
						</tr>
						<tr>
							<td >Registro INVIMA </td>
							<td style="font-weight:normal;"><?php echo $referencia; ?></td>
							
						</tr>
            <tr>
			<td class="m-5 px-0 py-0" style="font-size: 14px;  font-weight:bold;">
              <ul class="list-group list-group-flush">
                <li id="menu1" class="list-group-item list-group-item-action" onclick="verMenu(id,'cc.php?id=<? echo $id_auto_crpp; ?>','mostrar')">Componentes</li>
                <li id="menu2" class="list-group-item list-group-item-action" onclick="verMenu(id,)">Fabricante</li>
                <li id="menu3" class="list-group-item list-group-item-action" onclick="verMenu(id)">Adquisicón</li>
                <li id="menu4" class="list-group-item list-group-item-action" onclick="verMenu(id)">Gastos monteje</li>
                <li id="menu5" class="list-group-item list-group-item-action" onclick="verMenu(id)">Clasificación</li>
				<li id="menu6" class="list-group-item list-group-item-action" onclick="verMenu(id)">Programa mantenimiento</li>
              </ul>
            </td>
			<td colspan="2">
                <!-- tabla centro de costo -->  
               <div id="mostrar" class="py-2 px-5 "><img  src="user/equipos/img/manten.png" width="100%"></div>
            </td>
			</tr>
					</tbody>
			</table>

  </div>
  <!-- fin tabla contenido de datos generales-->
</div>
</div>

