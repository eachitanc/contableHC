<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#"><img src="img/logo.png" class="logo-brand" alt="logo" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
            <a class="nav-link" href="#" id="inicio" onclick="cargaArchivo('menu/menu_ini.php','menu_nav')"> Cerrar sesión </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link " href="#">Contactenos</a>
        </li>
       
        <?php
        include '../config.php';
        $cx= new mysqli ($server, $dbuser, $dbpass, $database);
        // Si usuario tiene permisos de admin muestra menu
        $id=$_GET["id"];
        if ($id ==1)
        {
            echo"
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Admin
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                <a class='dropdown-item' href='#' onclick=\"cargaArchivoModal('user/empresa/emp.php','contenido','tableReport')\">Empresa</a>
                <a class='dropdown-item' href='#'>Servicios</a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item' href='#'>Usuarios del sistema</a>
                </div>
            </li>";
        }
        ?>
        
        </ul>
        </div>
    </div>
</nav>