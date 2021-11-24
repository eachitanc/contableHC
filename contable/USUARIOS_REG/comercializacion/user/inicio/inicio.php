<?php
session_start();
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 

echo $_SESSION["pais"];
echo "HOLA";
?>
