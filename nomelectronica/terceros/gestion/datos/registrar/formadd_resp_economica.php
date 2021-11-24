<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$idT = $_POST['idt'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "SELECT * FROM seg_responsabilidades_tributarias";
    $rs = $cmd->query($sql);
    $responsabilidad = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$error = "Debe diligenciar este campo";
?>
<div class="px-0">
    <div class="shadow">
        <div class="card-header" style="background-color: #16a085 !important;">
            <h5 style="color: white;">REGISTRAR RESPONSABILIDAD ECONÓMICA DE TERCERO</h5>
        </div>
        <form id="formAddRespEcon">
            <input type="number" id="idTercero" name="idTercero" value="<?php echo $idT ?>" hidden>
            <div class="form-row px-4 pt-2">
                <div class="form-group col-md-12">
                    <label for="slcRespEcon" class="small">RESPONSABILIDAD ECONÓMICA</label>
                    <select id="slcRespEcon" name="slcRespEcon" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                        <option value="0">-- Seleccionar --</option>
                        <?php
                        foreach ($responsabilidad as $re) {
                            echo '<option value="' . $re['id_responsabilidad'] . '">' . $re['codigo'] . ' || ' . $re['descripcion'] . '</option>';
                        }
                        ?>
                    </select>

                </div>
                <div class="text-center pb-3">
                    <button class="btn btn-primary btn-sm" id="btnAddRespEcon">Agregar</button>
                    <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancelar</a>
                </div>
        </form>
    </div>
</div>