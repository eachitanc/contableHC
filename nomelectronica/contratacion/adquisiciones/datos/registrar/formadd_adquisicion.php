<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$error = "Debe diligenciar este campo";
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT * FROM seg_modalidad_contrata ORDER BY modalidad ASC";
    $rs = $cmd->query($sql);
    $modalidad = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
?>
<div class="px-0">
    <div class="shadow">
        <div class="card-header" style="background-color: #16a085 !important;">
            <h5 style="color: white;">REGISTRAR ADQUISICIÓN</h5>
        </div>
        <form id="formAddAdquisicion">
            <div class="form-row px-4 pt-2">
                <div class="form-group col-md-4">
                    <label for="datFecAdq" class="small">FECHA ADQUISICIÓN</label>
                    <input type="date" name="datFecAdq" id="datFecAdq" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-4">
                    <label for="datFecVigencia" class="small">FECHA VIGENCIA</label>
                    <input type="date" name="datFecVigencia" id="datFecVigencia" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-4">
                    <label for="slcModalidad" class="small">MODALIDAD CONTRATACIÓN</label>
                    <select id="slcModalidad" name="slcModalidad" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                        <option value="0">-- Seleccionar --</option>
                        <?php
                        foreach ($modalidad as $mo) {
                            echo '<option value="' . $mo['id_modalidad'] . '">' . $mo['modalidad'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row px-4 pt-2">
                <div class="form-group col-md-12">
                    <label for="txtObjeto" class="small">OBJETO</label>
                    <textarea  id="txtObjeto" type="text" name="txtObjeto" class="form-control form-control-sm py-0 sm" aria-label="Default select example" rows="3"></textarea>
                </div>
                <div class="text-center pb-3">
                    <button class="btn btn-primary btn-sm" id="btnAddAdquisicion">Agregar</button>
                    <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>