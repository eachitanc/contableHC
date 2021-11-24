<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../index.php");</script>';
    exit();
}
include '../../conexion.php';
include '../../permisos.php';

function pesos($valor)
{
    return '$' . number_format($valor, 2);
}
$id = $_POST['id_ter'];
//API URL
$url = 'http://localhost/api/terceros/datos/res/lista/' . $id;
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$tercero = json_decode($result, true);
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT 
                id_tercero, tipo_doc, no_doc, estado, descripcion, fec_inicio
            FROM
                seg_terceros
            INNER JOIN contable.seg_tipo_tercero 
                ON (seg_terceros.id_tipo_tercero = seg_tipo_tercero.id_tipo)
            WHERE no_doc = '$id'";
    $rs = $cmd->query($sql);
    $terEmpr = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_tipo_docs_tercero";
    $rs = $cmd->query($sql);
    $list_docs = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
//API URL
$url = 'http://localhost/api/terceros/datos/res/lista/docs/' . $id;
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$docs = json_decode($result, true);
if($docs === '0'){
    $docs=[
        'fec_vig'=>''
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../head.php' ?>

<body class="sb-nav-fixed 
<?php
if (isset($_SESSION['navarlat'])) {
    if ($_SESSION['navarlat'] === '1') {
        echo 'sb-sidenav-toggled';
    }
}
?>">
    <?php
    include '../../navsuperior.php';
    ?>
    <div id="layoutSidenav">
        <?php
        include '../../navlateral.php';
        ?>
        <div id='layoutSidenav_content' style="width:100%">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <div class="row">
                                <div class="col-md-11">
                                    <i class="fas fa-address-book fa-lg" style="color: #07CF74;"></i>
                                    DETALLES TERCERO
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="divCuerpoPag">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="headingOne">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#datosperson" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="far fa-address-book fa-lg" style="color: #3498DB;"></span>
                                                    </div>
                                                    <div>
                                                        DATOS PERSONALES
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="datosperson" class="collapse show" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <div class="shadow detalles-empleado">
                                                <div class="row">
                                                    <input type="hidden" id="id_tercero" value="<?php echo $tercero[0]['id_tercero'] ?>">
                                                    <div class="div-mostrar bor-top-left col-md-2">
                                                        <label class="lbl-mostrar">C.C. y/o NIT</label>
                                                        <div class="div-cont"><?php echo $tercero[0]['cc_nit'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-5">
                                                        <label class="lbl-mostrar">NOMBRE COMPLETO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($tercero[0]['nombre1'] . ' ' . $tercero[0]['nombre2'] . ' ' . $tercero[0]['apellido1'] . ' ' . $tercero[0]['apellido2']) ?></div>
                                                    </div>
                                                    <div class="div-mostrar bor-top-right col-md-5">
                                                        <label class="lbl-mostrar">RAZÓN SOCIAL</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($tercero[0]['razon_social'] ? $tercero[0]['razon_social'] : 'no se registró razón social') ?></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="div-mostrar  col-md-2">
                                                        <label class="lbl-mostrar">GENERO</label>
                                                        <div class="div-cont"><?php echo $tercero[0]['genero'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar  col-md-3">
                                                        <label class="lbl-mostrar">TIPO</label>
                                                        <div class="div-cont"><?php echo $terEmpr['descripcion'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar  col-md-3">
                                                        <label class="lbl-mostrar">ESTADO</label>
                                                        <div class="div-cont"><?php echo $terEmpr['estado'] == '1' ? 'ACTIVO' : 'INACTIVO' ?></div>
                                                    </div>
                                                    <div class="div-mostrar  col-md-2">
                                                        <label class="lbl-mostrar">FECHA DE NACIMIENTO</label>
                                                        <div class="div-cont"><?php echo $tercero[0]['fec_nacimiento'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar  col-md-2">
                                                        <label class="lbl-mostrar">FECHA INICIO</label>
                                                        <div class="div-cont"><?php echo $terEmpr['fec_inicio'] ?></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="div-mostrar bor-bottom-left col-md-4">
                                                        <label class="lbl-mostrar">CORREO</label>
                                                        <div class="div-cont"><?php echo $tercero[0]['correo'] ?></div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">DEPARTAMENTO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($tercero[0]['nombre_dpto']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">MUNICIPIO</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($tercero[0]['nom_municipio']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="div-mostrar col-md-2">
                                                        <label class="lbl-mostrar">DIRECCIÓN</label>
                                                        <div class="div-cont"><?php echo mb_strtoupper($tercero[0]['direccion']) ?></div>
                                                    </div>
                                                    <div class="div-mostrar bor-bottom-right col-md-2">
                                                        <label class="lbl-mostrar">CONTACTO</label>
                                                        <div class="div-cont"><?php echo $tercero[0]['telefono'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="resposabilidad">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseRespEcon" aria-expanded="true" aria-controls="collapseRespEcon">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-hand-holding-usd fa-lg" style="color: #7D3C98;"></span>
                                                    </div>
                                                    <div>
                                                        RESPOSABILIDADES ECONÓMICAS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseRespEcon" class="collapse" aria-labelledby="resposabilidad">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar Responsabilidad Económica">
                                                        <button id="btnAgregaRespEcon" value="<?php echo $tercero[0]['id_tercero'] ?>" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div>
                                                <table id="tableRespEcon" class="table table-striped table-bordered table-sm nowrap table-hover shadow" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="modificarRespEcons">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="actvidades">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseActvEcon" aria-expanded="true" aria-controls="collapseAtcvEcon">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-donate fa-lg" style="color: #F39C12;"></span>
                                                    </div>
                                                    <div>
                                                        ACTIVIDADES ECONÓMICAS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseActvEcon" class="collapse" aria-labelledby="actividad">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <?php if ((intval($permisos['registrar'])) === 1) { ?>
                                                    <div class="col-md-1 offset-md-11" title="Registrar Actvidad Económica">
                                                        <button id="btnAgregaActvEcon" value="<?php echo $tercero[0]['id_tercero'] ?>" class="btn btn-success btn-sm btn-circle-plus float-right">
                                                            <i class="fas fa-plus fa-lg"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <table id="tableActvEcon" class="table table-striped table-bordered table-sm nowrap table-hover shadow" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Código CIIU</th>
                                                        <th>Descripción</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="modificarActvEcons">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- parte-->
                                <div class="card">
                                    <div class="card-header card-header-detalles py-0 headings" id="documentos">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link-acordeon collapsed" data-toggle="collapse" data-target="#collapseDocs" aria-expanded="true" aria-controls="collapseDocs">
                                                <div class="form-row">
                                                    <div class="div-icono">
                                                        <span class="fas fa-copy fa-lg" style="color: #3498DB;"></span>
                                                    </div>
                                                    <div>
                                                        DOCUMENTOS
                                                    </div>
                                                </div>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseDocs" class="collapse" aria-labelledby="documentos">
                                        <div class="card-body">
                                        <div class="row pb-3 px-3">
                                                <?php
                                                foreach ($list_docs as $ld) {
                                                    $key = array_search($ld['id_doc'], array_column($docs, 'id_tipo_doc'));
                                                    $color = false !== $key ? 'success' : 'danger';
                                                    if($color === 'success' && $docs[$key]['fec_vig'] <= date('Y-m-d')){
                                                        $color = 'secondary';
                                                    }
                                                ?>
                                                    <div class="bg-<?php echo $color ?> text-white col-2 border border-light shadow-gb"><?php echo $ld['descripcion'] ?></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <table id="tableDocumento" class="table table-striped table-bordered table-sm nowrap table-hover shadow" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo Documento</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Vigencia</th>
                                                        <th>Vigente</th>
                                                        <th>Documento</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="modificarDocs">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['user'])) { ?>
                                <div class="text-center pt-4">
                                    <a type="button" class="btn btn-danger" style="width: 7rem;" href="listterceros.php"> CANCELAR</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../footer.php' ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeader">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-circle fa-lg" style="color:red"></i>
                            ¡Error!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgError">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalConfDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divModalHeaderConfir">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle fa-lg" style="color: #E67E22;"></i>
                            ¡Confirmar!
                        </h5>
                    </div>
                    <div class="modal-body" id="divMsgConfdel">

                    </div>
                    <div class="modal-footer" id="divBtnsModalDel">
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="divModalDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="divDone">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-check-circle fa-lg" style="color:#2FDA49"></i>
                            ¡Correcto!
                        </h5>
                    </div>
                    <div class="modal-body text-center" id="divMsgDone">

                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-primary btn-sm" data-dismiss="modal" href="#"> Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="divModalForms" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div id="divTamModalForms" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center" id="divForms">

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <?php
    if (isset($_SESSION['user'])) {
        include '../../scripts.php';
    } else { ?>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/js/funciones.js"></script>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/js/sha.js"></script>
        <script type="text/javascript" src="<?php echo $_SESSION['urlin'] ?>/terceros/gestion/js/funcionesterceros.js"></script>
        <script type="text/javascript">
            window.urlin = "<?php echo $_SESSION['urlin']; ?> "
        </script>
    <?php } ?>
</body>

</html>