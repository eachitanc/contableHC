<?php 
session_start();
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
//header("Cache-Control: no-store, no-cache, must-revalidate"); 
// modificacion de codigo Xombra (www.xombra.com) 21/03/2009 para sectorweb.net
    include("config.php");
    global $server, $database, $dbpass,$dbuser,$charset;

    $login = false;
        if(isset($_POST['login'])){
    $login = htmlspecialchars(trim($_POST['login']));
    }
    $pass = false;
        if(isset($_POST['pass'])){
    $pass = sha1(md5(trim($_POST['pass'])));;
    }
    //$login = htmlspecialchars(trim($_POST['login']));
    //$pass = sha1(md5(trim($_POST['pass']))); // encriptamos en MD5 para despues comprar (Modificado)
	
	//$link=mysql_connect($server,$dbuser,$dbpass);
    $cx= new mysqli ($server, $dbuser, $dbpass, $database);
    $sql = "SELECT login,    nombre,
	 					     apaterno, 
							 amaterno,
							 email
	                   FROM usuarios2 WHERE login='$login' AND password = '$pass'";  // Ahora
              // mysql_real_escape_string($login),mysql_real_escape_string($pass)); 	  
    echo "sql". $sql;
    $res =$cx->query($sql);
    $array =$res->fetch_assoc();
    
    $fil =$res->num_rows;

      if($fil){
         $_SESSION["login"]=$array["login"];

         $_SESSION["nombre"]=$array["nombre"];

         $_SESSION["apaterno"]=$array["apaterno"];

         $_SESSION["amaterno"]=$array["amaterno"];
		 
		  $_SESSION["email"]=$array["email"]; // Agrgado Nuevo

         header("Location:user.php");
      }else{
         header("Location:login.php");
      }
?>
