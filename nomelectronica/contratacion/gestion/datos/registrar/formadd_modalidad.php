<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../../index.php");</script>';
    exit();
}
include '../../../../conexion.php';
$error = "Debe diligenciar este campo";
?>
<div class="px-0">
    <div class="shadow">
        <div class="card-header" style="background-color: #16a085 !important;">
            <h5 style="color: white;">REGISTRAR MODALIDAD DE CONTRATACION</h5>
        </div>
        <form id="formAddModalidad">
            <div class="form-row px-4 pt-2">
                <div class="form-group col-md-12">
                    <label for="txtModalidad" class="small">NOMBRE MODALIDAD</label>
                    <input id="txtModalidad" type="text" name="txtModalidad" class="form-control form-control-sm py-0 sm" aria-label="Default select example">
                </div>
                <div class="text-center pb-3">
                    <button class="btn btn-primary btn-sm" id="btnAddModalidad">Agregar</button>
                    <a type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancelar</a>
                </div>
        </form>
    </div>
</div>