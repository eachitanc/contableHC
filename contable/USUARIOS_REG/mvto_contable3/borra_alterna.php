<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<?
$id_recau=$_GET['id'];
$fecha_c=$_GET['fecha_c'];// echo $fecha_c;
?>
<br />
<br />
<br />

<form method="post" action="borra1.php" onsubmit="return confirm('Desea Proceder?')">

  <div align="center">
  <span class="Estilo1">Esta accion eliminara el registro permanentemente, desea Continuar ?<br />
  </span><br />

    <input type='hidden' name='id_recau' value='<? printf("%s",$id_recau); ?>'>
    <input type='hidden' name='fecha_c' value='<? printf("%s",$fecha_c); ?>'>
    
  <input type='submit' name='Submit' value='Eliminar' class='Estilo1' />
    
  </div>
</form><br />

  <?
printf("

<center class='Estilo9'>
<form method='post' action='../mvto_contable/menu_cont.php'>
<input type='hidden' name='nn' value='NCSF'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo1' /> :::...
</form>
</center>
");

?>
</body>
</html>
