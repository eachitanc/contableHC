(function($) {
    $("#btnLiqNom").click(function() {
        let mes = $("#slcMesLiqNom").val();
        if (mes === '00') {
            $('#divModalErrorliqnom').modal('show');
            $('#divMsgErrorliqnom').html("Debe elegir MES");
            return false;
        }
        let dliqnom = $("#formLiqNomina").serialize();
        $('#divModalEspera').modal('show');
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/liquidar_nomina/liquidarnomina.php',
            data: dliqnom,
            success: function(r) {
                $('.modal-backdrop').remove();
                $('#divModalEspera').fadeOut(0);
                if (r === '0') {
                    $('#divModalError').modal('show');
                    $('#btnDetallesLiq').attr('href', 'detalles_nomina.php?mes=' + mes);
                } else {
                    $('#divModalExito').modal('show');
                    $('#divMsgExito').html(r);

                }
            }
        });
        return false;
    });
    $('#slcMesLiqNom').on('input', function() {
        let mes = $(this).val();
        window.location = window.urlin + '/nomina/liquidar_nomina/listempliquidar.php?mes=' + mes;
        return false;
    });
    $('#slcMesLiqNomEmp').on('input', function() {
        let mes = $(this).val();
        window.location = window.urlin + '/nomina/liquidar_nomina/liqxempleado.php?mes=' + mes;
        return false;
    });
    $('#slcLiqEmpleado').on('input', function() {
        let mes = $('#slcMesLiqNomEmp').val();
        let emp = $(this).val();
        window.location = window.urlin + '/nomina/liquidar_nomina/liqxempleado.php?mes=' + mes + '&emp=' + emp;
        return false;
    });
    $("#btnLiqPrima").click(function() {
        let mes = $("#slcMesLiqNom").val();
        let p;
        if (mes === '06') {
            p = '1';
        } else {
            p = '2';
        }
        if (mes === '00') {
            $('#divModalErrorliqnom').modal('show');
            $('#divMsgErrorliqnom').html("Debe elegir MES");
            return false;
        }
        let dliqnom = $("#formLiqNomina").serialize();
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/liquidar_nomina/liquidarprima.php',
            data: dliqnom,
            success: function(r) {
                if (r === '0') {
                    $('#divModalError').modal('show');
                    $('#btnDetallesLiq').attr('href', 'detalles_prima.php?per=' + p);
                } else {
                    $('#divModalExito').modal('show');
                    $('#divMsgExito').html(r);
                }
            }
        });
        return false;
    });
    $("#btnReporNomElec").click(function() {
        fec = $('#fecLiqNomElec').val();
        mesne = $('#mesNomElec').val();
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/enviar/soportenomelec.php',
            data: { fec: fec, mesne: mesne },
            success: function(r) {
                $('#divModalExito').modal('show');
                $('#divMsgExito').html(r);
            }
        });
        return false;
    });
    var showError = function(id) {
        $('#e' + id).show();
        $('#' + id).focus();
        setTimeout(function() {
            $('#e' + id).fadeOut(600);
        }, 800);
    };
    $("#btnLiqNomXempleado").click(function() {
        let empleado = $('#slcLiqEmpleado').val();
        let dlab = parseInt($('#numDiasLab').val());
        let dincap = 0;
        let dvac = 0;
        let dlic = 0;
        let pSalud = $('#numProvSalud').val();
        let ppension = $('#numProvPension').val();
        let parl = $('#numProvARL').val();
        let psena = $('#numProvSENA').val();
        let picbf = $('#numProvICBF').val();
        let pcomfam = $('#numProvCOMFAM').val();
        let pcesan = $('#numProvCesan').val();
        let picesan = $('#numProvIntCesan').val();
        let pvac = $('#numProvVac').val();
        if (empleado === '0') {
            let id = 'slcLiqEmpleado';
            showError(id);
            return false;
        } else if (dlab < 0 || $('#numDiasLab').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Dias laborados debe ser mayor o igual a  0');
            return false;
        } else if ($('#numAportSalud').val() === '' || $('#numAportPension').val() === '') {
            $('#divModalError').modal('show');
            $('#numAportSalud').focus();
            $('#divMsgError').html('Salud y/o Pensión no pueden estar vacios');
            return false;
        } else if (parseInt($('#numValDiasLab').val()) < 0 || $('#numValDiasLab').val() === '') {
            $('#numValDiasLab').focus();
            let id = 'numValDiasLab';
            showError(id);
            return false;
        } else if (parseInt($('#numSalNeto').val()) <= 0 || $('#numSalNeto').val() === '') {
            $('#numSalNeto').focus();
            let id = 'numSalNeto';
            showError(id);
            return false;
        }
        if ($('#divEmbargos').length > 0) {
            if ($('#slcEmbargos').val() === '0') {
                let id = 'slcEmbargos';
                showError(id);
                return false;
            } else if ($('#numDeduccionesEmb').val() === '' || parseInt($('#numDeduccionesEmb').val()) <= 0) {
                let id = 'numDeduccionesEmb';
                showError(id);
                return false;
            }
        }
        if ($('#divLibranzas').length > 0) {
            if ($('#slcLibranzas').val() === '0') {
                let id = 'slcLibranzas';
                showError(id);
                return false;
            } else if ($('#numDeduccionesLib').val() === '' || parseInt($('#numDeduccionesLib').val()) <= 0) {
                let id = 'numDeduccionesLib';
                showError(id);
                return false;
            }
        }
        if ($('#divSindicatos').length > 0) {
            if ($('#slcSindicato').val() === '0') {
                let id = 'slcSindicato';
                showError(id);
                return false;
            } else if ($('#numDeduccionesSind').val() === '' || parseInt($('#numDeduccionesSind').val()) <= 0) {
                let id = 'numDeduccionesSind';
                showError(id);
                return false;
            }
        }
        if ($('#divIncapacidad').length > 0) {
            let vemp = parseInt($('#numValIncapEmpresa').val());
            let veps = parseInt($('#numValIncapEPS').val());
            let varl = parseInt($('#numValIncapARL').val());
            let tincap = vemp + veps + varl;
            if ($('#slcIncapacidad').val() === '0') {
                let id = 'slcIncapacidad';
                showError(id);
                return false;
            } else if ($('#numDiasIncap').val() === '0' || $('#numDiasIncap').val() === '') {
                let id = 'numDiasIncap';
                showError(id);
                return false;
            } else if ($('#numValIncapEmpresa').val() === '' || $('#numValIncapEPS').val() === '' || $('#numValIncapARL').val() === '') {
                $('#divModalError').modal('show');
                $('#divMsgError').html('Los valores de Incapacidad deben ser mayor o igual a cero');
                return false;
            } else if (tincap <= 0) {
                $('#divModalError').modal('show');
                $('#divMsgError').html('Valor total de Incapacidad debe ser mayor a cero');
                return false;
            } else if ($('#datFecInicioInc').val() === '' || $('#datFecFinInc').val() === '') {
                $('#divModalError').modal('show');
                $('#divMsgError').html('Fechas de Incapacidad no pueden estar vacias');
                return false;
            }
            dincap = parseInt($('#numDiasIncap').val());
        }
        if ($('#divVacaciones').length > 0) {
            if ($('#slcVacaciones').val() === '0') {
                let id = 'slcVacaciones';
                showError(id);
                return false;
            } else if ($('#numDiasVac').val() === '0' || $('#numDiasVac').val() === '') {
                let id = 'numDiasVac';
                showError(id);
                return false;
            } else if ($('#numValVac').val() === '' || $('#numValVac').val() === '0') {
                let id = 'numValVac';
                showError(id);
                return false;
            } else if ($('#datFecInicioVacs').val() === '' || $('#datFecFinVacs').val() === '') {
                $('#divModalError').modal('show');
                $('#divMsgError').html('Fechas de Vacaciones no pueden estar vacias');
                return false;
            }
            dvac = parseInt($('#numDiasVac').val());
        }
        if ($('#divLicencias').length > 0) {
            if ($('#slcLicencias').val() === '0') {
                let id = 'slcLicencias';
                showError(id);
                return false;
            } else if ($('#numDiasLic').val() === '0' || $('#numDiasLic').val() === '') {
                let id = 'numDiasLic';
                showError(id);
                return false;
            } else if ($('#numValLica').val() === '' || $('#numValLica').val() === '0') {
                let id = 'numValLica';
                showError(id);
                return false;
            } else if ($('#datFecInicioLics').val() === '' || $('#datFecInicioLics').val() === '') {
                $('#divModalError').modal('show');
                $('#divMsgError').html('Fechas de Licencia no pueden estar vacias');
                return false;
            }
            dlic = parseInt($('#numDiasLic').val());
        }
        let tdias = dincap + dvac + dlic + dlab;
        if (tdias > 30) {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Dias liquidados debe ser menor o igual a 30');
        } else if (pSalud === '' || ppension === '' || parl === '' || psena === '' || picbf === '' || pcomfam === '' || pcesan === '' || picesan === '' || pvac === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Debe diligenciar todos los Provisionamientos');
        } else {
            let dliqind = $("#formLiqNominaEmpleado").serialize();
            $.ajax({
                type: 'POST',
                url: 'liqnomindividual.php',
                data: dliqind,
                success: function(r) {
                    if (r === '1') {
                        $("#formLiqNominaEmpleado")[0].reset();
                        $('#divModalExito').modal('show');
                        $('#divMsgExito').html('Empleado liquidado correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });

    $('#selectAll').change(function() {
        $('.listado > input[type=checkbox]').prop('checked', $(this).is(':checked'));
    });
    $('.diaslab > input[type=number]').keyup(function() {
        let dato = $(this).attr('name').split('_');
        let id = dato[1];
        let dlab = parseInt($(this).val()) + parseInt($('#dayIncap_' + id).val()) + parseInt($('#dayLic_' + id).val()) + parseInt($('#dayVac_' + id).val());
        if (dlab > 30 || parseInt($(this).val()) < 0) {
            $(this).focus();
            $(this).val('');
        }
        if ($(this).val() === '') {
            $(this).val('0');
        }
    });
    $('.mesliquidado a').on('click', function() {
        let mes = $(this).attr('value');
        window.location = window.urlin + '/nomina/liquidar_nomina/detalles_nomina.php?mes=' + mes;
    });
})(jQuery);