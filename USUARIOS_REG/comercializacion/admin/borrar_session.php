<?php
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 
session_start(login);
session_unset(login);
echo "<script>cargaArchivo('inicio.php','contenido')</script>";
echo "<script>cargaArchivo('menu/menu_inicio.php','menuHoriz');</script>";
?>
