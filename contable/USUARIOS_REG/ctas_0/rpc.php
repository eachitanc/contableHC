<?php
include('../config.php');               
$conexion = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
    if(isset($_POST['queryString']))
    {
        $queryString =$_POST['queryString'];
        $id = $_POST['qid'];
            if(strlen($queryString) > 0) {
            $query = mysql_query("Select * from ctas0_ing where cod_pptal_ing_apr like '".$queryString."%' and id_emp ='$id_emp';",$conexion);
                if($query) {
                        while($row2 = mysql_fetch_array($query))
                        {$r1=$row2["cod_pptal_ing_apr"];
                         $r2=$row2["nom_pptal_ing_apr"];
                        echo "<li value='$r1 $r2' id='$r1/$r2' onClick='fill(this,$id);'>$r1 $r2</li>";
                     }
                } else {
                    echo "ERROR: Existe un problema con la conexi&oacute;n.";
                }
            } else {

            }
        } else {
            echo 'No hay acceso directo a este script!';
        }
        mysql_close();
?>