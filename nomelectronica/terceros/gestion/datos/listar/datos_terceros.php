<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
include '../../../../permisos.php';
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT 
                id_tercero, tipo_doc, no_doc, estado, descripcion
            FROM
                seg_terceros
            INNER JOIN contable.seg_tipo_tercero 
                ON (seg_terceros.id_tipo_tercero = seg_tipo_tercero.id_tipo)";
    $rs = $cmd->query($sql);
    $terEmpr = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$ced = '0';
foreach ($terEmpr as $tE) {
    $ced .= ',' . $tE['no_doc'];
}
//API URL
$url = 'http://localhost/api/terceros/datos/res/lista/' . $ced;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$terceros = json_decode($result, true);
if ($terceros !== '0') {
    foreach ($terceros as $t) {
        $idter = $t['cc_nit'];
        $idT = $t['id_tercero'];
        $key = array_search($idter, array_column($terEmpr, 'no_doc'));
        if ((intval($permisos['registrar'])) === 1) {
            $addresponsabilidad = '<a value="' . $idT . '" class="btn btn-outline-info btn-sm btn-circle shadow-gb responsabilidad" title="+ Responsabilidad Económica"><span class="fas fa-hand-holding-usd fa-lg"></span></a>';
            $addactividad = '<a value="' . $idT . '" class="btn btn-outline-success btn-sm btn-circle shadow-gb actividad" title="+ Actividad Económica"><span class="fas fa-donate fa-lg"></span></a>';
        } else {
            $addresponsabilidad = null;
            $addactividad = null;
        }
        $idTerEmp = $terEmpr[$key]['id_tercero'];
        if ((intval($permisos['editar'])) === 1) {
            $editar = '<a value="' . $idter . '" class="btn btn-outline-primary btn-sm btn-circle shadow-gb editar" title="Editar"><span class="fas fa-pencil-alt fa-lg"></span></a>';
            if ($terEmpr[$key]['estado'] === '1') {
                $estado = '<button id="btnestado_'.$idTerEmp.'" class="btn-estado" title="Activo"><span class="fas fa-toggle-on fa-lg estado activo" value="' . $idTerEmp . '"></span></button>';
            } else {
                $estado = '<button id="btnestado_'.$idTerEmp.'"  class="btn-estado" title="Inactivo"><span class="fas fa-toggle-off fa-lg estado inactivo" value="' . $idTerEmp . '"></span></button>';
            }
        } else {
            $editar = null;
            $estado = $t['estado'];
        }
        if ((intval($permisos['borrar'])) === 1) {
            $borrar = '<a value="' . $idTerEmp . '" class="btn btn-outline-danger btn-sm btn-circle shadow-gb borrar" title="Eliminar"><span class="fas fa-trash-alt fa-lg"></span></a>';
        } else {
            $borrar = null;
        }
        $detalles = '<button type="submit" class="btn btn-outline-warning btn-sm btn-circle" title="Detalles"><span class="far fa-eye fa-lg"></span></button>';

        $data[] = [
            'cc_nit' => $t['cc_nit'],
            'nombre_tercero' => mb_strtoupper($t['nombre1'] . ' ' . $t['apellido1']),
            'razon_social' => $t['razon_social'],
            'tipo' => $terEmpr[$key]['descripcion'],
            'municipio' => $t['nom_municipio'],
            'direccion' => $t['direccion'],
            'telefono' => $t['telefono'],
            'correo' => $t['correo'],
            'estado' => '<div class="center-block">' . $estado . '</div>',
            'botones' => '<div class="center-block"><form action="detalles_tercero.php" method="POST"><input type="hidden" name="id_ter" value="' . $idter . '">' . $editar . $borrar . $addresponsabilidad . $addactividad . $detalles . '</form></div>',
        ];
    }
} else {
    $data = [];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
