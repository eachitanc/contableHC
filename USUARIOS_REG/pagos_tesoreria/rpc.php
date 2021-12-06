<?php
include('../config.php');
$conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $conexion->query($sqlxx);
while ($rowxx = $resultadoxx->fetch_assoc()) {
    $id_emp = $rowxx["id_emp"];
}
if (isset($_POST['queryString'])) {
    $queryString = $_POST['queryString'];
    $id = $_POST['qid'];
    if (strlen($queryString) > 0) {
        $query = $conexion->query("Select * from pgcp where cod_pptal like '" . $queryString . "%' and id_emp ='$id_emp' and bloqueo != 'SI' order by cod_pptal asc;");
        if ($query) {
            while ($row2 = $query->fetch_assoc()) {
                $r1 = $row2["cod_pptal"];
                $r2 = $row2["nom_rubro"];
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
$conexion = null;
