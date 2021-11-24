<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <!--link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"-->
    <link rel="shortcut icon" href="img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>  
    <title>ELASystem</title>
    <script>
      function mostrarLogin(id){
      var dialogo = document.getElementById(id);
      dialogo.showModal();
      }
      function cerrarLogin(id){
      var dialogo = document.getElementById(id);
      dialogo.close();
      }

      function prosForm()
      {
        var camposenv = ["usuario","pass"]; 
        var datos ='';
        var element =camposenv.length;
        var ruta ='admin/loguear.php';
        var campo='contenido';
        datos ="?id=1";
        for (i=0;i<element;i++)
        {
          datos +="&"+camposenv[i]+"="+escape(document.getElementById(camposenv[i]).value);
        }
        archivo =(ruta+datos);
        $("#"+campo).load(archivo);	
        return false;
      }
      // Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
      function  cargaArchivo(archivo,div)
        {
          document.body.style.cursor = "default"; 
          $("#"+div).load(archivo);	
        }
    </script>
    </head>
  <body>
  <div id="menu_nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#"><img src="img/logo.png" class="logo-brand" alt="logo" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
              <a class="nav-link" href="#" id="inicio" onclick="mostrarLogin('formLogin')"> Iniciar sesión </a>
          </li>
          <li class="nav-item">
              <a class="nav-link " href="#">Contactenos</a>
          </li>
          
        </ul>
    </div>
    </nav>
  </div>
  
    <!-- Area de seccion de contenido -->
    <div id="contenido"></div> 
    <dialog id="tableReport">
    <div id="tableReport" class="container" ></div>
    </dialog>
    <!-- Area de formulario de login-->   
    <dialog id="formLogin">
      <div class="container">
      <div class="row justify-content-center">
         <form id="login" class="form-container" method="post" onsubmit="return prosForm('login');" >
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de usuario:</label>
            <input type="text" class="form-control" id="usuario" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="pass" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Recordar cuenta</label>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="submit" class="btn btn-secondary" onclick="cerrarLogin('formLogin')">Cerrar</button>
         </form>
    </div>
    </div>
    </dialog> 
    <div style="width: 100%; float:left;position: absolute;z-index:1;" id="menu_vert"  >
    <?php
      include 'menu/menu_ver.php';
    ?>
    </div>

    <div style="width: 100%; float:right; z-index:2;" id="area" >
     <div class="p-5 text-center bg-image"  style=" background-image: url('img/fondo.jpg'); background-size: cover;
      opacity:0.6; height: 500px; "></div>
    </div>
   
    <!-- Optional JavaScript; choose one of the two! -->
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
  </body>
</html>
