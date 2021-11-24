<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<?php
$filas = 2780;
$muestra = 300;
$listas = ceil($filas / $muestra);
echo "<&nbsp;";
for ($i =0; $i<$listas;$i++)
{
	$inicio =($i*300)+1;
	$j =  ($i+1)*300;
	$k =$i+1;
	echo "<a href='inicio.php?ini=$inicio&fin=$j'>$k</a>&nbsp;";
}
echo ">&nbsp;";
?>
</body>
</html>