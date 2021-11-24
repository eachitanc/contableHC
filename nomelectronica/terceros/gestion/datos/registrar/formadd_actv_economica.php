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
    $sql = "SELECT * FROM seg_actividades_economicas";
    $rs = $cmd->query($sql);
    $actividades = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
?>
<div class="px-0">
    <div class="shadow">
        <div class="card-header" style="background-color: #16a085 !important;">
            <h5 style="color: white;">REGISTRAR ACTIVIDAD ECONÓMICA DE TERCERO</h5>
        </div>
        <form id="formAddActvEcon">
            <input type="number" id="idTercero" name="idTercero" value="<?php echo $idT ?>" hidden>
            <div class="form-row px-4 pt-2">
                <div class="form-group col-md-10">
                    <label for="slcActvEcon" class="small">ACTIVIDAD ECONÓMICA</label>
                    <select id="slcActvEcon" name="slcActvEcon" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                        <option value="0">-- Seleccionar --</option>
                        <?php
                        foreach ($actividades as $a) {
                            echo '<option value="' . $a['id_actividad'] . '">' . $a['codigo_ciiu'] . ' || ' . $a['descripcion'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="datFecInicio" class="small">FECHA INICIO</label>
                    <input type="date" class="form-control form-control-sm" id="datFecInicio" name="datFecInicio">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-sm" id="btnAddActvEcon">Agregar</button>
                <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancelar</a>
            </div>
            <br>
        </form>
    </div>
</div>