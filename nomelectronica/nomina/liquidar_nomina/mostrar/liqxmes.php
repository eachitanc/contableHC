<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
include '../../../conexion.php';
$vigencias = $_SESSION['vigencia'];
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $sql = "SELECT * 
            FROM
                (SELECT mes, nom_mes, anio
                    FROM
                        seg_liq_salaro, seg_meses
                    WHERE seg_liq_salaro.mes = seg_meses.codigo) AS t
            GROUP BY mes 
            HAVING anio = '$vigencias'";
    $rs = $cmd->query($sql);
    $mesliqdo = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../../head.php' ?>

<body class="sb-nav-fixed <?php if ($_SESSION['navarlat'] === '1') {
                                echo 'sb-sidenav-toggled';
                            } ?>">
    <?php include '../../../navsuperior.php' ?>
    <div id="layoutSidenav">
        <?php include '../../../navlateral.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-2">
                    <div class="card mb-4">
                        <div class="card-header" id="divTituloPag">
                            <i class="fas fa-house-user fa-lg" style="color: #1D80F7"></i> MESES LIQUIDADOS.
                        </div>
                        <div class="card-body mesliquidado" id="divCuerpoPag">
                            <?php
                            $c = 1;
                            foreach ($mesliqdo as $ml) {
                                if ($c === 1 || $c === 5 || $c === 9) { ?>
                                    <div class="center-block">
                                        <div class="container-fluid">
                                            <div class="input-group">
                                            <?php } ?>
                                            <div id="grupo<?php echo $ml['mes'] ?>" class="col-mb-4 py-2 px-3">
                                                <div class="card shadow-g" style="width: 6rem; border-radius: 0.7rem !important;">
                                                    <a data-toggle="collapse" href="#" role="button" aria-expanded="false" value="<?php echo $ml['mes'] ?>">
                                                        <img class="card-img-top " src="../../../images/meses/<?php echo $ml['mes'] ?>.png" title=" <?php echo ucfirst(strtolower($ml['nom_mes'])) ?>" alt="mes">
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            if ($c === 4 || $c === 8 || $c === 12) { ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php $c++;
                            }
                            if ($c <= 4 || ($c > 5  && $c <= 8) || ($c > 9  && $c < 12)) {
                                echo '</div>
                                </div>
                            </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../../../footer.php' ?>
        </div>
    </div>
    <?php include '../../../scripts.php' ?>
</body>

</html>