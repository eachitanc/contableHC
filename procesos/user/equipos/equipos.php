<div class="row justify-content-center">
<div class="table-container table-responsive" style="width: 70%;">
	<div >
	<div class="table-titulo" style="display: table-cell;">Inventario de equipos biomédicos</div>
	</div>
	<div style="float: right;" >
		<div >
		<input type="text" class="form-control-sm" placeholder="" style="width: 200px;"  >   
		<button class="btn btn-secondary btn-sm" type="button">Buscar</button>
		<button class="btn btn-primary btn-sm" type="button" onclick="mostrarLogin('formEquipo');">Nuevo</button>
		</div>
	</div>

<table class="table table-hover ">
					<thead>
						<tr>
							<th width="40%">Nombre equipo</th>
							<th width="20%">Área</th>
							<th width="20%">Serial</th>
                            <th width="10%"></th>
						</tr>
					</thead>
					<tbody>
					<tr>
							<td>FONENDOSCOPIO </td>
							<td>URGENCIAS</td>
							<td>979262</td>
							<td><div class="input-group">
  									<div class="input-group-append tamano">
									<button type="button" style="height: 20px;" class="btn btn-outline-primary btn-accion" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">...</button>
									<div class="dropdown-menu">
									<a class="dropdown-item" href="#" style="font-size: 14px;">Eliminar</a>
									<a class="dropdown-item" href="#" style="font-size: 14px;">Editar</a>
									
									<div role="separator" class="dropdown-divider"></div>
									<a class="dropdown-item tamano" href="#" onclick="cargaArchivo('user/equipos/hoja_vida.php','area')" style="font-size: 14px;">Hoja de vida</a>
									<a class="dropdown-item tamano" href="#" style="font-size: 14px;">Mantenimiento preventivo</a>
									<a class="dropdown-item tamano" href="#" style="font-size: 14px;">Mantenimiento correctivo</a>
									<a class="dropdown-item tamano" href="#" style="font-size: 14px;">Calibración</a>
									<a class="dropdown-item tamano" href="#" style="font-size: 14px;">Acta de baja</a>
									</div>
								</div>
								</div>
							</td>
					</tr>
					<tr>
							<td>EQUIPO DE ÓRGANOS DE PARED</td>
							<td>CONSULTA EXTERNA</td>
							<td>56478</td>
							<td><div class="input-group">
  									<div class="input-group-append">
									<button type="button" style="height: 15px;" class="btn btn-outline-primary btn-accion" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">...</button>
									<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
									<div role="separator" class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Separated link</a>
									</div>
								</div>
								</div>
							</td>
					</tr>
					<tr>
							<td>LÁMPARA DE FOTOCURADO</td>
							<td>ODONTOLOGÍA</td>
							<td>45689</td>
							<td><div class="input-group">
  									<div class="input-group-append">
									<button type="button" style="height: 15px;" class="btn btn-outline-primary btn-accion" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">...</button>
									<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
									<div role="separator" class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Separated link</a>
									</div>
								</div>
								</div>
							</td>
					</tr>
					<tr>
							<td>ELECTROCARDIÓGRAFO</td>
							<td>URGENCIAS</td>
							<td>74536</td>
							<td><div class="input-group">
  									<div class="input-group-append">
									<button type="button" style="height: 15px;" class="btn btn-outline-primary btn-accion" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">...</button>
									<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
									<div role="separator" class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Separated link</a>
									</div>
								</div>
								</div>
							</td>
					</tr>
					</tbody>
</table>
</div>
</div>

<!-- Espacio para formulario emergente de registro de nuevo equipo-->
<dialog id="formEquipo"  >
    <div class="container">
    <div class="row justify-content-center" >
         <form id="equipo" class="form-container" style="width: 50%;top:12vh;" method="post" onsubmit="return prosEquipo('equipo');" >
		 		
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
				<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">Checkbox</div>
				<div class="col-sm-10">
				<div class="form-check">
				<label class="form-check-label">
				<input class="form-check-input" type="checkbox"> Check me out
				</label>
				</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				</div>
			</div>
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary" onclick="cerrarLogin('formEquipo')">Cerrar</button>
         </form>
    </div>
    </div>
</dialog> 



