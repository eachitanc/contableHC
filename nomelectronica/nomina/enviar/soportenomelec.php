<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.replace("../../index.php");</script>';
    exit();
}
$anio = $_SESSION['vigencia'];
$mes = $_POST['mesne'];
$fec_liq = $_POST['fec'];

include '../../conexion.php';
$dia = '01';
switch ($mes) {
    case '01':
    case '03':
    case '05':
    case '07':
    case '08':
    case '10':
    case '12':
        $fec_i = $anio . '-' . $mes . '-' . $dia;
        $fec_f = $anio . '-' . $mes . '-31';
        break;
    case '02':
        $fec_i = $anio . '-' . $mes . '-' . $dia;
        if (date('L', strtotime("$anio-01-01")) === '1') {
            $bis = '29';
        } else {
            $bis = '28';
        }
        $fec_f = $anio . '-' . $mes . '-' . $bis;
        break;
    case '04':
    case '06':
    case '09':
    case '11':
        $fec_i = $anio . '-' . $mes . '-' . $dia;
        $fec_f = $anio . '-' . $mes . '-30';
        break;
    default:
        echo 'Error Fatal';
        exit();
        break;
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_valxvig, id_concepto, valor,concepto
            FROM
                seg_valxvigencia
            INNER JOIN con_vigencias 
                ON (seg_valxvigencia.id_vigencia = con_vigencias.id_vigencia)
            INNER JOIN seg_conceptosxvigencia 
                ON (seg_valxvigencia.id_concepto = seg_conceptosxvigencia.id_concp)
            WHERE anio = '$anio' AND id_concepto = '4'";
    $rs = $cmd->query($sql);
    $concec = $rs->fetch();
    $iNonce = intval($concec['valor']);
    $idiNonce = $concec['id_valxvig'];
    $sql = "UPDATE seg_valxvigencia SET valor = '$iNonce'+1 WHERE id_valxvig = '$idiNonce'";
    $rs = $cmd->query($sql);
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
$prima = array();
if ($mes === '06' || $mes === '12') {
    $periodo = $mes == '06' ? '1' : '2';
    try {
        $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
        $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sql = "SELECT id_empleado, cant_dias, val_liq_ps, periodo, anio
                FROM
                    seg_liq_prima
                WHERE periodo = '$periodo' AND anio = '$anio'";
        $rs = $cmd->query($sql);
        $prima = $rs->fetchAll();
        $cmd = null;
    } catch (PDOException $e) {
        echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
    }
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT fech_inicio, fec_retiro, mes, correo, telefono, codigo_netc, seg_tipo_empleado.codigo AS tip_emp, seg_subtipo_empl.codigo AS subt_emp,alto_riesgo_pension, seg_tipos_documento.codigo AS tip_doc, codigo_ne, no_documento, apellido1, apellido2, nombre1, nombre2, codigo_pais, codigo_dpto, nombre_dpto, codigo_municipio, nom_municipio, direccion, salario_integral, seg_tipo_contrato.codigo AS tip_contrato, salario_basico, seg_empleado.id_empleado 
            FROM
                seg_empleado
            INNER JOIN seg_tipos_documento 
                ON (seg_empleado.tipo_doc = seg_tipos_documento.id_tipodoc)
            INNER JOIN seg_tipo_empleado 
                ON (seg_empleado.tipo_empleado = seg_tipo_empleado.id_tip_empl)
            INNER JOIN seg_subtipo_empl 
                ON (seg_empleado.subtipo_empleado = seg_subtipo_empl.id_sub_emp)
            INNER JOIN seg_pais 
                ON (seg_empleado.pais = seg_pais.id_pais)
            INNER JOIN seg_departamento 
                ON (seg_departamento.id_pais = seg_pais.id_pais) AND (seg_empleado.departamento = seg_departamento.id_dpto)
            INNER JOIN seg_municipios 
                ON (seg_municipios.id_departamento = seg_departamento.id_dpto) AND (seg_empleado.municipio = seg_municipios.id_municipio)
            INNER JOIN seg_tipo_contrato 
                ON (seg_empleado.tipo_contrato = seg_tipo_contrato.id_tip_contrato)
            INNER JOIN seg_salarios_basico 
                ON (seg_salarios_basico.id_empleado = seg_empleado.id_empleado)
            INNER JOIN seg_liq_salaro 
                ON (seg_liq_salaro.id_empleado = seg_empleado.id_empleado)
            WHERE estado = '1' AND vigencia = '$anio' AND mes = '$mes'";
    $rs = $cmd->query($sql);
    $empleados = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM
                seg_empresas
            INNER JOIN seg_departamento 
                ON (seg_empresas.id_dpto = seg_departamento.id_dpto)
            INNER JOIN seg_municipios 
                ON (seg_municipios.id_departamento = seg_departamento.id_dpto) AND (seg_empresas.id_ciudad = seg_municipios.id_municipio)
            INNER JOIN seg_pais 
                ON (seg_departamento.id_pais = seg_pais.id_pais) AND (seg_empresas.id_pais = seg_pais.id_pais)";
    $rs = $cmd->query($sql);
    $empresa = $rs->fetch();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT seg_empleado.id_empleado,forma_pago,  seg_metodo_pago.codigo, nom_banco, seg_tipo_cta.tipo_cta, cuenta_bancaria
            FROM
                seg_liq_salaro
            INNER JOIN seg_metodo_pago 
                ON (seg_liq_salaro.metodo_pago = seg_metodo_pago.id_metodo_pago)
            INNER JOIN seg_empleado 
                ON (seg_liq_salaro.id_empleado = seg_empleado.id_empleado)
            INNER JOIN seg_bancos 
                ON (seg_empleado.id_banco = seg_bancos.id_banco)
            INNER JOIN seg_tipo_cta 
                ON (seg_empleado.tipo_cta = seg_tipo_cta.id_tipo_cta)
            WHERE mes = '$mes' AND anio = '$anio' AND estado='1'";
    $rs = $cmd->query($sql);
    $bancaria = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT *
            FROM seg_liq_dlab_auxt
            WHERE mes_liq = '$mes' AND anio_liq = '$anio'";
    $rs = $cmd->query($sql);
    $liqdialab = $rs->fetchAll();
    $cmd = null;
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getCode();
}
try {
    $cmd = new PDO("$bd_driver:host=$bd_servidor;dbname=$bd_base;$charset", $bd_usuario, $bd_clave);
    $cmd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $sql = "SELECT id_empleado, id_tipo, seg_liq_incap.fec_inicio, seg_liq_incap.fec_fin, mes, anios, dias_liq, pago_empresa, pago_eps, pago_arl
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
    $sql = "SELECT id_empleado, mes_lic, anio_lic, seg_liq_licmp.fec_inicio, seg_liq_licmp.fec_fin, dias_liqs, val_liq 
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
    $sql = "SELECT id_empleado, descripcion_lib, val_mes_lib
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
    $sql = "SELECT id_empleado, val_aporte, porcentaje_cuota
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
    $sql = "SELECT id_empleado, seg_horas_ex_trab.id_he,codigo, desc_he, factor, fec_inicio, fec_fin, hora_inicio, hora_fin, cantidad_he, val_liq
            FROM
                seg_horas_ex_trab
            INNER JOIN seg_tipo_horaex 
                ON (seg_horas_ex_trab.id_he = seg_tipo_horaex.id_he)
            INNER JOIN seg_liq_horex 
                ON (seg_liq_horex.id_he_lab = seg_horas_ex_trab.id_he_trab)
            WHERE mes_he = '$mes' AND anio_he = '$anio'
            ORDER BY id_he";
    $rs = $cmd->query($sql);
    $hoex = $rs->fetchAll();
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

if ($mes) {
    $jParams = [
        'sEmail' => 'demo@taxxa.co',
        'sPass' => 'Demo2022*'
    ];

    $jApi = [
        'sMethod' => 'classTaxxa.fjTokenGenerate',
        'jParams' => $jParams
    ];

    $url_taxxa = 'https://dominiodelcliente.taxxa.co/api.djson';
    $token = ['jApi' => $jApi];
    $datatoken = json_encode($token);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url_taxxa);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datatoken);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $restoken = curl_exec($ch);
    $rst = json_decode($restoken);
    $tokenApi = $rst->jret->stoken;
    $hoy = date('Y-m-d');
    $ahora = (new DateTime('now', new DateTimeZone('America/Bogota')))->format('H:i:s');
    $nomindempl = '';
    foreach ($empleados as $o) {
        $id = $o['id_empleado'];
        $idempleado = $o['no_documento'] . '_' . $o['nombre1'] . '_' . $o['apellido1'] . '_NE_' . $id;
        $key = array_search($id, array_column($bancaria, 'id_empleado'));
        if (false !== $key) {
            $sPaymentForm = $bancaria[$key]['forma_pago'];
            $sPaymentMethod = $bancaria[$key]['codigo'];
            $sBankName = $bancaria[$key]['nom_banco'];
            $sBankAccountType = $bancaria[$key]['tipo_cta'];
            $sBankAccountNo = $bancaria[$key]['cuenta_bancaria'];
            $lPaymentDates = $fec_liq;
        } else {
            $sPaymentForm = $sPaymentMethod = $sBankName = $sBankAccountType = $sBankAccountNo = $lPaymentDates = $lPaymentDates = null;
        }
        $key = array_search($id, array_column($liqdialab, 'id_empleado'));
        if (false !== $key) {
            $nDaysWorked = intval($liqdialab[$key]['dias_liq']);
            $nAuxilioTransporte = floatval($liqdialab[$key]['val_liq_auxt']);
            $salMensual = floatval($liqdialab[$key]['val_liq_dias']);
        } else {
            $nDaysWorked = $nAuxilioTransporte = $salMensual = null;
        }
        $key = array_search($id, array_column($presoc, 'id_empleado'));
        if (false !== $key) {
            $valcesant = floatval($presoc[$key]['val_cesantia']);
            $porcentaje = floatval('12');
            $nPagoIntereses = floatval($presoc[$key]['val_interes_cesantia']);
        } else {
            $valcesant = $porcentaje = $nPagoIntereses = null;
        }
        $key = array_search($id, array_column($viaticos, 'id_emplead'));
        $nViaticoManuAlojNS = false !== $key ? floatval($viaticos[$key]['tot_viat']) : null;
        $key = array_search($id, array_column($incap, 'id_empleado'));
        if (false !== $key) {
            $valincap = floatval($incap[$key]['pago_empresa'] + $incap[$key]['pago_eps'] + $incap[$key]['pago_arl']);
            $tipoincap = intval($incap[$key]['id_tipo']);
            $inincap =  $incap[$key]['fec_inicio'];
            $diaincap =  intval($incap[$key]['dias_liq']);
            $finincap =  $incap[$key]['fec_fin'];
        } else {
            $valincap = $tipoincap = $inincap = $finincap = $diaincap = null;
        }
        $key = array_search($id, array_column($lic, 'id_empleado'));
        if (false !== $key) {
            $vallic = floatval($lic[$key]['val_liq']);
            $inlic =  $lic[$key]['fec_inicio'];
            $dialic =  intval($lic[$key]['dias_liqs']);
            $finlic =  $lic[$key]['fec_fin'];
        } else {
            $vallic = $inlic = $dialic = $finlic = null;
        }
        $key = array_search($id, array_column($emb, 'id_empleado'));
        $valEmbargo = false !== $key ? floatval($emb[$key]['val_mes_embargo']) : null;
        $key = array_search($id, array_column($sind, 'id_empleado'));
        if (false !== $key) {
            $valSind = floatval($sind[$key]['val_aporte']);
            $porcSind =  floatval($sind[$key]['porcentaje_cuota'] * 100);
        } else {
            $valSind = $porcSind = null;
        }
        $key = array_search($id, array_column($segsoc, 'id_empleado'));
        if (false !== $key) {
            $salud = floatval($segsoc[$key]['aporte_salud_emp']);
            $pension =  floatval($segsoc[$key]['aporte_pension_emp']);
            $psolid = intval($segsoc[$key]['aporte_solidaridad_pensional']) > 0 ? floatval($segsoc[$key]['aporte_solidaridad_pensional']) : null;
            $pPS = intval($psolid) > 0 ? '1' : null;
        } else {
            $salud = $pension = $psolid =  $pPS  = null;
        }
        $key = array_search($id, array_column($prima, 'id_empleado'));
        if (false !== $key) {
            $valprima = floatval($prima[$key]['val_liq_ps']);
            $diasprima =  intval($prima[$key]['cant_dias']);
        } else {
            $valprima = $diasprima = null;
        }
        $key = array_search($id, array_column($lib, 'id_empleado'));
        if (false !== $key) {
            $descripLib = $lib[$key]['descripcion_lib'];
            $valLib =  floatval($lib[$key]['val_mes_lib']);
        } else {
            $descripLib = $valLib = null;
        }
        $key = array_search($id, array_column($vac, 'id_empleado'));
        if (false !== $key) {
            $valvac = floatval($vac[$key]['val_liq']);
            $diavac =  intval($vac[$key]['dias_liqs']);
        } else {
            $valvac = $diavac = null;
        }
        $listhoex = null;
        $valHoEx = 0;
        foreach ($hoex as $he) {
            if ($he['id_empleado'] === $o['id_empleado']) {
                switch (intval($he['codigo'])) {
                    case 1:
                        $tiphe = 'HED';
                        break;
                    case 2:
                        $tiphe =  'HEN';
                        break;
                    case 3:
                        $tiphe = 'HRN';
                        break;
                    case 4:
                        $tiphe = 'HEDDF';
                        break;
                    case 5:
                        $tiphe = 'HRDDF';
                        break;
                    case 6:
                        $tiphe =  'HENDF';
                        break;
                    case 7:
                        $tiphe = 'HRNDF';
                        break;
                }
                $listhoex[] = ['wWorktimeCode' => $tiphe, 'nPaid' => floatval($he['val_liq']), 'nRateDelta' => floatval($he['cantidad_he']), 'tSince' =>  $he['fec_inicio'], 'tUntil' => $he['fec_fin']];
                $valHoEx = $valHoEx +  $he['val_liq'];
            }
        }
        $devengado = floatval($salMensual  + $nAuxilioTransporte + $nViaticoManuAlojNS + $valincap + $vallic + $valprima + $valvac + $valHoEx);
        $deducciones =  floatval($valEmbargo + $valSind + $salud + $pension + $psolid + $valLib);
        $aIncomes = [
            ['wIncomeCode' => 'Teletrabajo', 'nAmount' => null],
            ['wIncomeCode' => 'ApoyoSost', 'nAmount' => null],
            ['wIncomeCode' => 'BonifRetiro', 'nAmount' => null],
            ['wIncomeCode' => 'Dotacion', 'nAmount' => null],
            ['wIncomeCode' => 'Indemnizacion', 'nAmount' => null],
            ['wIncomeCode' => 'Reintegro', 'nAmount' => null],
            ['wIncomeCode' => 'Comision', 'nAmount' => null],
            ['wIncomeCode' => 'PagoTercero', 'nAmount' => null],
            ['wIncomeCode' => 'Anticipo', 'nAmount' => null],
            ['wIncomeCode' => 'Comision', 'nAmount' => null],
            ['wIncomeCode' => 'Auxilio', 'nAuxilioS' => null, 'nAuxilioNS' =>  null],
            ['wIncomeCode' => 'Compensacion', 'nCompensacionO' =>  null, 'nCompensacionE' =>  null],
            ['wIncomeCode' => 'Bonificacion', 'nBonificacionS' =>  null, 'nBonificacionNS' =>  null],
            ['wIncomeCode' => 'Primas', 'nAmount' => $valprima, 'nPagoNS' => null, 'nPagoS' => $valprima, 'nQuantity' => $diasprima],
            ['wIncomeCode' => 'Cesantias', 'nAmount' => $valcesant, 'nPagoIntereses' => $nPagoIntereses, 'nPercentage' => $porcentaje],
            ['wIncomeCode' => 'Transporte', 'nAuxilioTransporte' =>  $nAuxilioTransporte, 'nViaticoManuAlojS' =>  null, 'nViaticoManuAlojNS' =>  $nViaticoManuAlojNS],
            ['wIncomeCode' => 'Incapacidad', 'nAmount' =>   $valincap, 'sTipo' =>  $tipoincap, 'nQuantity' =>  $diaincap, 'tSince' =>  $inincap, 'tUntil' => $finincap],
            ['wIncomeCode' => 'BonoEPCTV', 'nPagoS' =>  null, 'nPagoNS' =>  null, 'nPagoAlimentacionS' =>  null, 'nPagoAlimentacionNS' =>  null],
            ['wIncomeCode' => 'LicenciaMP', 'tSince' => $inlic, 'tUntil' => $finlic, 'nAmount' =>  $vallic, 'nQuantity' => $dialic],
            ['wIncomeCode' => 'LicenciaR', 'tSince' => null, 'tUntil' => null, 'nAmount' => null, 'nQuantity' =>  null],
            ['wIncomeCode' => 'LicenciaNR', 'tSince' => null, 'tUntil' => null, 'nQuantity' => null],
            ['wIncomeCode' => 'VacacionesComunes', 'nAmount' => null, 'nQuantity' => null, 'tSince' => null, 'tUntil' => null],
            ['wIncomeCode' => 'VacacionesCompensadas', 'nAmount' => $valvac, 'nQuantity' => $diavac],
            ['wIncomeCode' => 'HuelgaLegal', 'nQuantity' => null, 'tSince' => null, 'tUntil' => null],
            ['wIncomeCode' => 'OtroConcepto', 'nConceptoS' => null, 'nConceptoNS' => null, 'sDescription' => null, 'xDescription' => null]
        ];
        $aContract = [
            [
                'nSalaryBase' => floatval($o['salario_basico']),
                'wContractType' => $o['codigo_netc'],
                'tContractSince' => $o['fech_inicio'],
                'tContractUntil' => $o['fec_retiro'],
                'wPayrollPeriod' => 'M',
                'wDianEmployeeType' => $o['tip_emp'],
                'wDianEmployeeSubType' => $o['subt_emp'],
                'bHighRiskWork' => ($o['alto_riesgo_pension'] == '1' ? true : false),
                'bSalarioIntegral' => ($o['salario_integral'] == '1' ? true : false)
            ]
        ];
        $aDeductions = [
            ["wDeductionCode" => "Educacion", "nAmount" => null],
            ["wDeductionCode" => "Reintegro", "nAmount" => null],
            ["wDeductionCode" => "Anticipo", "nAmount" => null],
            ["wDeductionCode" => "PagoTercero", "nAmount" => null],
            ["wDeductionCode" => "OtraDeduccion", "nAmount" => null],
            ["wDeductionCode" => "Deuda", "nAmount" => null],
            ["wDeductionCode" => "EmbargoFiscal", "nAmount" => $valEmbargo],
            ["wDeductionCode" => "Cooperativa", "nAmount" => null],
            ["wDeductionCode" => "AFC", "nAmount" => null],
            ["wDeductionCode" => "RetencionFuente", "nAmount" => null],
            ["wDeductionCode" => "PensionVoluntaria", "nAmount" => null],
            ["wDeductionCode" => "PlanComplementarios", "nAmount" => null],
            ["wDeductionCode" => "Sindicato", "nAmount" =>  $valSind, "nPercentage" => $porcSind],
            ["wDeductionCode" => "Salud", "nAmount" => $salud, "nPercentage" => 4],
            ["wDeductionCode" => "FondoPension", "nAmount" => $pension, "nPercentage" => 4],
            ["wDeductionCode" => "FondoSP", "nAmount" => $psolid, "nPercentage" => 1, "nDeduccionSub" => null, "nPorcentajeSub" => null],
            ["wDeductionCode" => "Libranza", "nAmount" => $valLib, "sDescription" => $descripLib, "xDescription" => $descripLib == '' ? null : base64_encode($descripLib)],
            ["wDeductionCode" => "Sancion", "nAmount" => null, "nSancionPriv" => null, "nSancionPublic" => null]
        ];
        $aWorkTimeDetails = $listhoex;
        $empleado[$idempleado] =
            [
                'wDocType' =>  $o['codigo_ne'],
                'sDocNo' => $o['no_documento'],
                'sBusinessName' => null,
                'sPersonNameFirst' => $o['nombre1'],
                'lPersonNamesOthers' => $o['nombre2'],
                'sPersonSurname' => $o['apellido1'],
                'lPersonSurnameOthers' => $o['apellido2'],
                'jContact' => [
                    'sEmail' => $o['correo'],
                    'sPhone' => '+57' . $o['telefono'],
                    'jAddress' => [
                        'sStreet' => $o['direccion'],
                        'sState' => $o['nombre_dpto'],
                        'sCity' => $o['nom_municipio'],
                        'wCountryCode' => $o['codigo_pais']
                    ]
                ],
                'aPaymentInfo' => [
                    [
                        'sPaymentForm' => $sPaymentForm,
                        'sPaymentMethod' => $sPaymentMethod,
                        'sBankName' => $sBankName,
                        'sBankAccountType' => $sBankAccountType,
                        'sBankAccountNo' => $sBankAccountNo,
                        'lPaymentDates' => $lPaymentDates
                    ]
                ],
                'aContract' => $aContract,
                'aPayrollInfo' => [
                    'NE-1' => [
                        'xNote' => base64_encode('Comentarios'),
                        'sReference' => 'NE-1',
                        'nDaysWorked' => $nDaysWorked,
                        'nPeriodBaseSalary' => floatval($o['salario_basico']),
                        'nTotalIncomes' =>  $devengado,
                        'nTotalDeductions' => $deducciones,
                        'nPayrollTotal' => $devengado - $deducciones,
                        'aIncomes' => $aIncomes,
                        'aDeductions' => $aDeductions,
                        'aWorkTimeDetails' => $aWorkTimeDetails,
                    ]

                ],
            ];
    }
    $jPayroll = [
        'tCalculatedSince' => $fec_i,
        'tCalculatedUntil' => $fec_f . 'T23:59:59',
        'tIssued' => $hoy . 'T' . $ahora,
    ];
    $empjson[] = [
        'jPayroll' => $jPayroll,
        'jEmployer' => [
            'wDocType' => 'NIT',
            'sDocNo' => $empresa['nit'],
            'sBusinessName' => $empresa['nombre'],
            'sPersonNameFirst' => null,
            'sPersonNamesOthers' => null,
            'sPersonSurname' => null,
            'sPersonSurnameOthers' => null,
            'jContact' => [
                'sEmail' => $empresa['correo'],
                'sPhone' => '+57' . $empresa['telefono'],
                'jAddress' => [
                    'sStreet' => $empresa['direccion'],
                    'sState' => $empresa['nombre_dpto'],
                    'sCity' => $empresa['nom_municipio'],
                    'wCountryCode' => $empresa['codigo_pais'],
                ]
            ]
        ],
        'aWorkers' => $empleado
    ];
    $jParams = [
        'wFormat' => 'taxxa.co.dian.document',
        'wVersionUBL' => 2,
        'wEnvironment' => 'test',
        'jDocument' => $empjson
    ];

    $jApi = [
        'sMethod' => 'classTaxxa.fjDocumentAdd',
        'jParams' => $jParams
    ];
    $json_string = json_encode($empjson);
    $file = 'empleados.json';
    file_put_contents($file, $json_string);
    //header('Content-Type: application/json');
    //echo json_encode($empjson);
    $nomina = [
        'sToken' => $tokenApi,
        'iNonce' => $iNonce,
        'jApi' => $jApi
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, 'https://demo1.taxxa.co/api.djson');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($nomina));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resnom = curl_exec($ch);
    print_r($resnom);
}
