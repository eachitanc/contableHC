<div class="nav-side-menu">
        <div class="brand">Menu</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
           <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li onclick="cargaArchivo('user/empresa/emp.php','area')">
                      <a href="#" >
                      <i class="fas fa-tachometer-alt fa-lg"></i> Empresa
                      </a>
                    </li>
                    <li>
                      <a href="#">
                      <i class="fa fa-users fa-lg"></i> Usuarios
                      </a>
                    </li>
                    <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                      <a href="#"><i class="fa fa-cog fa-lg"></i> Mantenimiento <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="products">
                        <li onclick="cargaArchivo('user/equipos/equipos.php','area')" class="active"><a href="#">Equipos biomédicos</a></li>
                        <li><a href="#">Equipo industrial hospitalario</a></li>
                        <li><a href="#">Equipo de computo</a></li>
                        <li><a href="#">Muebles </a></li>
                        <li><a href="#">Instalaciones físcias</a></li>
                        <li><a href="#">Sistema de redes</a></li>
                        <li><a href="#">Areas adyacentes</a></li>
                    </ul>


                    <li data-toggle="collapse" data-target="#service" class="collapsed">
                      <a href="#"><i class="fab fa-fort-awesome-alt fa-lg"></i> Servicios <span class="arrow"></span></a>
                    </li>  
                    <ul class="sub-menu collapse" id="service">
                      <li>New Service 1</li>
                      <li>New Service 2</li>
                      <li>New Service 3</li>
                    </ul>
                    <li>
                      <a href="#">
                      <i class="fas fa-user-tie fa-lg"></i> Salir
                      </a>
                      </li>

                    
                </ul>
        </div>
       </div>