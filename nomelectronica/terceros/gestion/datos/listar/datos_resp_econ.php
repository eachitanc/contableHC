<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
include '../../../../permisos.php';
$id_t = $_POST['id_t'];
//API URL
$url = 'http://localhost/api/terceros/datos/res/lista/resp_econ/' . $id_t;
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$responsabilidades = json_decode($result, true);
if (!empty($responsabilidades)) {
    foreach ($responsabilidades as $r) {
        $idre = $r['id_resptercero'];
        $estado = $r['estado'] == '1' ? '<span class="fas fa-toggle-on fa-lg activo"></span>' : '<span class="fas fa-toggle-off fa-lg inactivo"></span>';
        $data[] = [
            'codigo' => '<div class="text-center">' . $r['codigo'] . '</div>',
            'descripcion' => mb_strtoupper($r['descripcion']),
            'estado' => '<div class="text-center">' . $estado . '</div>'
        ];
    }
} else {
    $data = [];
}

$datos = ['data' => $data];
//header('Content-Type: application/json');
echo json_encode($datos);
