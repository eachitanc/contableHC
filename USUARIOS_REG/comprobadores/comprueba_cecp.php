<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
} else {
    include('../config.php');

    //*** luis hillon

    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
    $sqlxx = "select * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);

    while ($rowxx = $resultadoxx->fetch_assoc()) {
        $id_emp = $rowxx["id_emp"];
    }

    $servidor = $server;
    $usuario = $dbuser;
    $password = $dbpass;

    $conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("no se pudo conectar a base de datos" . mysqli_error($conexion));
    $codd = 'CECP' . $_REQUEST['cod'];
    $usuarios =  $conexion->query("Select * from cecp where id_emp ='$id_emp' and id_manu_cecp = '$codd'") or die(mysqli_error(($conexion)));

    $num = $usuarios->fetch_assoc();

    if (empty($num)) {
        printf("<font color ='#006600'><b>...::: DISPONIBLE :::...</b></font>");
    } else {
        printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
    }
    $conexion = null;
}
