<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../../index.php");</script>';
    exit();
}
if (isset($_POST['mesNomElec'])) {
    $mes = $_POST['mesNomElec'];
} else {
    header('Location: ../listempliquidar.php');
    exit();
}
$anio = $_SESSION['vigencia'];
function pesos($valor)
{
    return '$' . number_format($valor, 2);
}

include '../../../conexion.php';
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT seg_empleado.id_empleado, vigencia, salario_basico, no_documento, CONCAT(nombre1, ' ',nombre2, ' ',apellido1, ' ', apellido2) AS nombre, descripcion_carg
            FROM
                seg_salarios_basico
            INNER JOIN seg_empleado 
                ON (seg_salarios_basico.id_empleado = seg_empleado.id_empleado)
            INNER JOIN seg_liq_salaro 
                ON (seg_liq_salaro.id_empleado = seg_empleado.id_empleado)
            INNER JOIN seg_cargo_empleado 
		        ON (seg_empleado.cargo = seg_cargo_empleado.id_cargo)
            WHERE estado = '1' AND vigencia = '$anio' AND mes = '$mes'";
    $rs = $cmd->query($sql);
    $obj = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, mes, anios, dias_liq, pago_empresa, pago_eps, pago_arl
            FROM
                seg_liq_incap
            INNER JOIN seg_incapacidad 
                ON (seg_liq_incap.id_incapacidad = seg_incapacidad.id_incapacidad)
            WHERE mes = '$mes' AND anios = '$anio'";
    $rs = $cmd->query($sql);
    $incap = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, mes_lic, anio_lic, dias_liqs, val_liq
            FROM
                seg_liq_licmp
            INNER JOIN seg_licenciasmp 
                ON (seg_liq_licmp.id_licmp = seg_licenciasmp.id_licmp)
            WHERE mes_lic = '$mes' AND anio_lic ='$anio'";
    $rs = $cmd->query($sql);
    $lic = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, mes_vac, anio_vac, dias_liqs, val_liq
            FROM
                seg_liq_vac
            INNER JOIN seg_vacaciones
                ON (seg_liq_vac.id_vac = seg_vacaciones.id_vac)
            WHERE mes_vac = '$mes' AND anio_vac = '$anio'";
    $rs = $cmd->query($sql);
    $vac = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, mes_liq, anio_liq, dias_liq, val_liq_dias, val_liq_auxt
            FROM
                seg_liq_dlab_auxt
            WHERE mes_liq = '$mes' AND anio_liq = '$anio'";
    $rs = $cmd->query($sql);
    $dlab = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_liq_prestaciones_sociales
            WHERE mes_prestaciones = '$mes' AND anio_prestaciones = '$anio'";
    $rs = $cmd->query($sql);
    $presoc = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_liq_segsocial_empdo
            WHERE mes = '$mes' AND anio = '$anio'";
    $rs = $cmd->query($sql);
    $segsoc = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, val_mes_lib
            FROM
                seg_liq_libranza
            INNER JOIN seg_libranzas 
                ON (seg_liq_libranza.id_libranza = seg_libranzas.id_libranza)
            WHERE mes_lib = '$mes' AND anio_lib = '$anio'";
    $rs = $cmd->query($sql);
    $lib = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, val_mes_embargo
            FROM
                seg_liq_embargo
            INNER JOIN seg_embargos
                ON (seg_liq_embargo.id_embargo = seg_embargos.id_embargo)
            WHERE mes_embargo = '$mes' AND anio_embargo = '$anio'";
    $rs = $cmd->query($sql);
    $emb = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, val_aporte
            FROM
                seg_liq_sindicato_aportes
            INNER JOIN seg_cuota_sindical
                ON (seg_liq_sindicato_aportes.id_cuota_sindical = seg_cuota_sindical.id_cuota_sindical)
            WHERE mes_aporte = '$mes' AND anio_aporte = '$anio'";
    $rs = $cmd->query($sql);
    $sind = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, SUM(val_liq) AS tot_he
            FROM
                (SELECT id_empleado,val_liq, mes_he, anio_he
                FROM
                    seg_liq_horex
                INNER JOIN seg_horas_ex_trab 
                    ON (seg_liq_horex.id_he_lab = seg_horas_ex_trab.id_he_trab)
                WHERE mes_he = '$mes' AND anio_he = '$anio') AS t
            GROUP BY id_empleado";
    $rs = $cmd->query($sql);
    $hoex = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, val_liq, fec_reg, nom_mes
    FROM seg_liq_salaro,seg_meses
    WHERE  seg_liq_salaro.mes = seg_meses.codigo AND mes = '$mes' AND anio = '$anio'";
    $rs = $cmd->query($sql);
    $saln = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM seg_liq_parafiscales
            WHERE mes_pfis = '$mes' AND anio_pfis = '$anio'";
    $rs = $cmd->query($sql);
    $pfis = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_viaticos, id_emplead, SUM(valor)AS tot_viat, rango
            FROM   
                (SELECT *
                    FROM 
                        (SELECT seg_detalle_viaticos.id_viaticos, id_emplead, concepto, valor, SUBSTRING(fviatico,1,7) AS rango
                        FROM
                            seg_detalle_viaticos
                        INNER JOIN seg_viaticos 
                            ON (seg_detalle_viaticos.id_viaticos = seg_viaticos.id_viaticos))AS t
                WHERE rango = '$anio-$mes')AS t_res
            GROUP BY id_emplead";
    $rs = $cmd->query($sql);
    $viaticos = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM seg_meses
            WHERE codigo = '$mes'";
    $rs = $cmd->query($sql);
    $nombmes = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$nomMes = $saln[0]['nom_mes'];
?>
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="EACII" />

<body>
    <?php
    header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition:attachment;filename=NOMINA_" . $nomMes . ".xls");
    $outputFile = fopen('php://output', 'w+');
    ?>
    <table border>
        <thead class="text-center centro-vertical">
            <tr>
                <th rowspan="2">LOGO</th>
                <th colspan="18" style="background-color: gray;">SISTEMA INTEGRADO</th>
            </tr>
            <tr>
                <th colspan="18">NOMINA PERSONAL DE PLANTA CORRESPONDIENTE AL MES <?php echo $nomMes . ' DE ' . $anio ?></th>
            </tr>
            <tr style="background-color: gray;">
                <th rowspan="2">Nombre completo</th>
                <th rowspan="2">C. C.</th>
                <th rowspan="2">Cargo</th>
                <th rowspan="2">Salario Base</th>
                <th rowspan="2">Gastos <br> Repre.</th>
                <th rowspan="2">Días <br>Labor</th>
                <th colspan="4">Devengado</th>
                <th colspan="7">Deducido</th>
                <th rowspan="2">Neto a Pagar</th>
                <th rowspan="2" style="width: 7rem;">Firma</th>
            </tr>
            <tr style="background-color: gray;">
                <th>Básico</th>
                <th>Aux. Transporte</th>
                <th>Horas Extra</th>
                <th>Total Devengado</th>
                <th>Salud</th>
                <th>Pensión</th>
                <th>Pensión Solidaria</th>
                <th>Sindicato</th>
                <th>Libranza</th>
                <th>Embargo</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($obj as $o) { ?>
                <tr class="ajustar">
                    <td> <?php echo mb_strtoupper($o['nombre']) ?> </td>
                    <td><?php echo $o['no_documento'] ?></td>
                    <td><?php echo mb_strtoupper($o['descripcion_carg']) ?></td>
                    <td class="text-right"><?php echo pesos($o['salario_basico']) ?></td>
                    <?php
                    $id = $o["id_empleado"];
                    $keyincap = array_search($id, array_column($incap, 'id_empleado'));
                    $keylic = array_search($id, array_column($lic, 'id_empleado'));
                    $keyvac = array_search($id, array_column($vac, 'id_empleado'));
                    $keydlab = array_search($id, array_column($dlab, 'id_empleado'));
                    $keypresoc = array_search($id, array_column($presoc, 'id_empleado'));
                    $keysegsoc = array_search($id, array_column($segsoc, 'id_empleado'));
                    $keylib = array_search($id, array_column($lib, 'id_empleado'));
                    $keyemb = array_search($id, array_column($emb, 'id_empleado'));
                    $keysind = array_search($id, array_column($sind, 'id_empleado'));
                    $keyhoex = array_search($id, array_column($hoex, 'id_empleado'));
                    $keysaln = array_search($id, array_column($saln, 'id_empleado'));
                    $keyviat = array_search($id, array_column($viaticos, 'id_emplead'));
                    ?>
                    <td class="text-right">$0.00</td>
                    <td><?php
                        if (false !== $keydlab) {
                            echo $dlab[$keydlab]['dias_liq'];
                        } else {
                            echo '0';
                        } ?></td>
                    <td class="text-right">
                        <?php
                        if (false !== $keydlab) {
                            echo pesos($d = $dlab[$keydlab]['val_liq_dias']);
                            $d = $dlab[$keydlab]['val_liq_dias'];
                        } else {
                            echo pesos($d = '0');
                        } ?></td>
                    <td class="text-right">
                        <?php
                        if (false !== $keydlab) {
                            echo pesos($e = $dlab[$keydlab]['val_liq_auxt']);
                        } else {
                            echo pesos($e = 0);
                        } ?></td>
                    <td class="text-right">
                        <?php
                        if (false !== $keyhoex) {
                            echo pesos($f = $hoex[$keyhoex]['tot_he']);
                        } else {
                            echo pesos($f = 0);
                        } ?></td>
                    <?php
                    $a = false !== $keyincap ? $incap[$keyincap]['pago_empresa'] + $incap[$keyincap]['pago_eps'] + $incap[$keyincap]['pago_arl'] : 0;
                    $b = false !== $keylic ?  $lic[$keylic]['val_liq'] : 0;
                    $c = false !== $keyvac ? $vac[$keyvac]['val_liq'] : 0;
                    ?>
                    <td class="text-right">
                        <?php echo pesos($a + $b + $c + $f + $d); ?>
                    </td>
                    <?php
                    if (false !== $keysegsoc) {
                        $g = $segsoc[$keysegsoc]['aporte_salud_emp'];
                        $i = $segsoc[$keysegsoc]['aporte_pension_emp'];
                        $j = $segsoc[$keysegsoc]['aporte_solidaridad_pensional'];
                    } else {
                        $g = '0';
                        $i = '0';
                        $j = '0';
                    } ?>
                    <td class="text-left"><?php echo pesos($g); ?></td>
                    <td class="text-right"><?php echo pesos($i); ?></td>
                    <td class="text-right"><?php echo pesos($j); ?></td>
                    <td class="text-right">
                        <?php
                        $k =  false !== $keylib ? $lib[$keylib]['val_mes_lib'] : 0;
                        echo pesos($k);
                        ?></td>
                    <td class="text-right">
                        <?php
                        $l = false !== $keyemb  ? $emb[$keyemb]['val_mes_embargo'] : 0;
                        echo pesos($l); ?></td>
                    <td class="text-right">
                        <?php
                        $m = false !== $keysind ? $sind[$keysind]['val_aporte'] : 0;
                        echo pesos($m);
                        ?></td>
                    <td class="text-right">
                        <?php
                        $deducidos = $g + $i + $j + $k + $l + $m;
                        echo pesos($deducidos);
                        ?>
                    </td>
                    <td class="text-right">
                        <?php
                        $n = false !== $keysaln ? $saln[$keysaln]['val_liq'] : 0;
                        echo pesos($n); ?></td>
                    <td></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <br>
    <table border>
        <thead class="text-center centro-vertical">
            <tr style="background-color: gray;">
                <th rowspan="2">Nombre completo</th>
                <th colspan="3">Parafiscales</th>
            </tr>
            <tr style="background-color: gray;">
                <th>SENA</th>
                <th>ICBF</th>
                <th>COMFAMILIAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($obj as $o) { ?>
                <tr class="ajustar">
                    <td> <?php echo mb_strtoupper($o['nombre']) ?> </td>
                    <?php
                    $id = $o["id_empleado"];
                    $keypfis = array_search($id, array_column($pfis, 'id_empleado'));
                    if (false !== $keypfis) {
                        $valsena = $pfis[$keypfis]['val_sena'];
                        $valicbf = $pfis[$keypfis]['val_icbf'];
                        $valconfam = $pfis[$keypfis]['val_comfam'];
                    } else {
                        $valsena = '0';
                        $valicbf = '0';
                        $valconfam = '0';
                    } ?>
                    <td class="text-right"><?php echo pesos($valsena) ?></td>
                    <td class="text-right"><?php echo pesos($valicbf) ?></td>
                    <td class="text-right"><?php echo pesos($valconfam) ?></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>

</body>

</html>