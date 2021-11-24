(function($) {
    var showError = function(id) {
        $('#e' + id).show();
        setTimeout(function() {
            $('#e' + id).fadeOut(600);
        }, 800);
    };
    var bordeError = function(p) {
        $('#' + p).css("border", "2px solid #F5B7B1");
        $('#' + p).css('box-shadow', '0 0 4px 3px pink');
    };
    $("#btnShowAddNovEps").click(function() {
        $('#btnShowAddNovEps').hide();
        $('#divhidden').show();
        return false;
    });
    $("#btnXNovedadEps").click(function() {
        $("#formAddEpsNovedad")[0].reset();
        $('#divhidden').hide();
        $('#btnShowAddNovEps').show();
        return false;
    });
    $("#btnShowAddNovArl").click(function() {
        $('#btnShowAddNovArl').hide();
        $('#divhiddenArl').show();
        return false;
    });
    $("#btnXNovedadArl").click(function() {
        $("#formAddArlNovedad")[0].reset();
        $('#divhiddenArl').hide();
        $('#btnShowAddNovArl').show();
        return false;
    });
    $("#btnShowAddNovAfp").click(function() {
        $('#btnShowAddNovAfp').hide();
        $('#divhiddenAfp').show();
        return false;
    });
    $("#btnXNovedadAfp").click(function() {
        $("#formAddAfpNovedad")[0].reset();
        $('#divhiddenAfp').hide();
        $('#btnShowAddNovAfp').show();
        return false;
    });
    $("#btnShowAddLibranza").click(function() {
        $('#btnShowAddLibranza').hide();
        $('#divhiddenLibranza').show();
        return false;
    });
    $("#btnXAddLibranza").click(function() {
        $("#formAddLibranza")[0].reset();
        $('#divhiddenLibranza').hide();
        $('#btnShowAddLibranza').show();
        return false;
    });
    $("#btnShowAddEmbargo").click(function() {
        $('#btnShowAddEmbargo').hide();
        $('#divhiddenEmbargo').show();
        return false;
    });
    $("#btnXAddEmbargo").click(function() {
        $("#formAddEmbargo")[0].reset();
        $('#divhiddenEmbargo').hide();
        $('#btnShowAddEmbargo').show();
        return false;
    });
    $("#btnShowAddSindicato").click(function() {
        $('#btnShowAddSindicato').hide();
        $('#divhiddenSindicato').show();
        return false;
    });
    $("#btnXAddSindicato").click(function() {
        $("#formAddSindicato")[0].reset();
        $('#divhiddenSindicato').hide();
        $('#btnShowAddSindicato').show();
        return false;
    });
    $("#btnShowAddIncapacidad").click(function() {
        $('#btnShowAddIncapacidad').hide();
        $('#divhiddenIncapacidad').show();
        return false;
    });
    $("#btnXAddIncapacidad").click(function() {
        $("#formAddIncapacidad")[0].reset();
        $('#divhiddenIncapacidad').hide();
        $('#btnShowAddIncapacidad').show();
        return false;
    });
    $("#btnShowAddVacacion").click(function() {
        $('#btnShowAddVacacion').hide();
        $('#divhiddenVacaciones').show();
        return false;
    });
    $("#btnXAddVacacion").click(function() {
        $("#formAddVacaciones")[0].reset();
        $('#divhiddenVacaciones').hide();
        $('#btnShowAddVacacion').show();
        return false;
    });
    $("#btnShowAddLicencia").click(function() {
        $('#btnShowAddLicencia').hide();
        $('#divhiddenLicencia').show();
        return false;
    });
    $("#btnXAddLicencia").click(function() {
        $("#formAddLicencia")[0].reset();
        $('#divhiddenLicencia').hide();
        $('#btnShowAddLicencia').show();
        return false;
    });
    $("#btnCerrarModalupEmpH").click(function() {
        $('#divModalupEmpHecho').modal('hide');
        window.location = '../listempleados.php';
    });
    $("#btnConfirDelEmpleado").click(function() { //del empleado confirmado
        $('#divModalConfirmarDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delempleado.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    rowdel();
                    $('#divModalDone').modal('show');
                    $('#divMsgExitoDelEmpl').html("Empleado eliminado correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
    });
    //Nuevo empleado
    //Validar solo numeros
    var numeros = function(i) {
        $("#" + i).on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "");
                });
            }
        });
    };
    $("#txtCCempleado").keyup(function() {
        let id = 'txtCCempleado';
        numeros(id);
    });
    $("#txtTelEmp").keyup(function() {
        let id = 'txtTelEmp';
        numeros(id);
    });
    $("#txtCuentaBanc").keyup(function() {
        let id = 'txtCuentaBanc';
        numeros(id);
    });
    $("#txtNitEmpresa").keyup(function() {
        let id = 'txtNitEmpresa';
        numeros(id);
    });
    $("#txtUpTel").keyup(function() {
        let id = 'txtUpTel';
        numeros(id);
    });
    $("#numDiasLab").keyup(function() {
        let id = 'numDiasLab';
        numeros(id);
    });
    $("#numDiasIncap").keyup(function() {
        let id = 'numDiasIncap';
        numeros(id);
    });
    $("#numDiasVac").keyup(function() {
        let id = 'numDiasVac';
        numeros(id);
    });
    $("#numDiasLic").keyup(function() {
        let id = 'numDiasLic';
        numeros(id);
    });
    $("#txtNitAfp").keyup(function() {
        let id = 'txtNitAfp';
        numeros(id);
    });
    $("#txtTelAfp").keyup(function() {
        let id = 'txtTelAfp';
        numeros(id);
    });
    $("#txtNitUpAfp").keyup(function() {
        let id = 'txtNitUpAfp';
        numeros(id);
    });
    $("#txtTelUpAfp").keyup(function() {
        let id = 'txtTelUpAfp';
        numeros(id);
    });
    $("#txtNitArl").keyup(function() {
        let id = 'txtNitArl';
        numeros(id);
    });
    $("#txtTelArl").keyup(function() {
        let id = 'txtTelArl';
        numeros(id);
    });
    $("#txtNitUpArl").keyup(function() {
        let id = 'txtNitUpArl';
        numeros(id);
    });
    $("#txtTelUpArl").keyup(function() {
        let id = 'txtTelUpArl';
        numeros(id);
    });
    $("#txtNitEps").keyup(function() {
        let id = 'txtNitEps';
        numeros(id);
    });
    $("#txtTelEps").keyup(function() {
        let id = 'txtTelEps';
        numeros(id);
    });
    $("#txtNitUpEps").keyup(function() {
        let id = 'txtNitUpEps';
        numeros(id);
    });
    $("#txtTelUpEps").keyup(function() {
        let id = 'txtTelUpEps';
        numeros(id);
    });
    $("#txtCCuser").keyup(function() {
        let id = 'txtCCuser';
        numeros(id);
    });
    $("#txtccUpUser").keyup(function() {
        let id = 'txtccUpUser';
        numeros(id);
    });
    //Separadores de mil
    var miles = function(i) {
        $("#" + i).on({
            "focus": function(e) {
                $(e.target).select();
            },
            "keyup": function(e) {
                $(e.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });
    };
    $("#numSalarioEmp").keyup(function() {
        let id = 'numSalarioEmp';
        miles(id);
    });
    $("#numValTotal").keyup(function() {
        let id = 'numValTotal';
        miles(id);
    });
    $("#divUpNovLibranza").on('keyup', '#numUpValTotal', function() {
        let id = 'numUpValTotal';
        miles(id);
    });
    $("#numTotEmbargo").keyup(function() {
        let id = 'numTotEmbargo';
        miles(id);
    });
    $("#divUpNovEmbargo").on('keyup', '#numUpTotEmbargo', function() {
        let id = 'numUpTotEmbargo';
        miles(id);
    });
    $("#numAuxTransp").keyup(function() {
        let id = 'numAuxTransp';
        miles(id);
    });
    $("#numAportSalud").keyup(function() {
        let id = 'numAportSalud';
        miles(id);
    });
    $("#numAportPension").keyup(function() {
        let id = 'numAportPension';
        miles(id);
    });
    $("#numAportPenSolid").keyup(function() {
        let id = 'numAportPenSolid';
        miles(id);
    });
    $("#numValIncap").keyup(function() {
        let id = 'numValIncap';
        miles(id);
    });
    $("#numValVac").keyup(function() {
        let id = 'numValVac';
        miles(id);
    });
    $("#numValLica").keyup(function() {
        let id = 'numValLica';
        miles(id);
    });
    $("#numDeduccionesEmb").keyup(function() {
        let id = 'numDeduccionesEmb';
        miles(id);
    });
    $("#numDeduccionesLib").keyup(function() {
        let id = 'numDeduccionesLib';
        miles(id);
    });
    $("#numDeduccionesSind").keyup(function() {
        let id = 'numDeduccionesSind';
        miles(id);
    });
    $("#numValDiasLab").keyup(function() {
        let id = 'numValDiasLab';
        miles(id);
    });
    $("#numSalNeto").keyup(function() {
        let id = 'numSalNeto';
        miles(id);
    });
    $("#numProvSalud").keyup(function() {
        let id = 'numProvSalud';
        miles(id);
    });
    $("#numProvPension").keyup(function() {
        let id = 'numProvPension';
        miles(id);
    });
    $("#numProvARL").keyup(function() {
        let id = 'numProvARL';
        miles(id);
    });
    $("#numProvSENA").keyup(function() {
        let id = 'numProvSENA';
        miles(id);
    });
    $("#numProvICBF").keyup(function() {
        let id = 'numProvICBF';
        miles(id);
    });
    $("#numProvCOMFAM").keyup(function() {
        let id = 'numProvCOMFAM';
        miles(id);
    });
    $("#numProvCesan").keyup(function() {
        let id = 'numProvCesan';
        miles(id);
    });
    $("#numProvIntCesan").keyup(function() {
        let id = 'numProvIntCesan';
        miles(id);
    });
    $("#numProvVac").keyup(function() {
        let id = 'numProvVac';
        miles(id);
    });
    $("#numProvPrima").keyup(function() {
        let id = 'numProvPrima';
        miles(id);
    });
    $("#numValIncapEmpresa").keyup(function() {
        let id = 'numValIncapEmpresa';
        miles(id);
    });
    $("#numValIncapEPS").keyup(function() {
        let id = 'numValIncapEPS';
        miles(id);
    });
    $("#numValIncapARL").keyup(function() {
        let id = 'numValIncapARL';
        miles(id);
    });
    $("#btnNuevoEmpleado").click(function() {
        let ced = $("#txtCCempleado").val();
        let eps = $("#slcEps").val();
        let arl = $("#slcArl").val();
        let afp = $("#slcAfp").val();
        let rl = $("#slcRiesLab").val();
        let par;
        if ($("#slcTipoEmp").val() === '0') {
            par = "slcTipoEmp";
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcSubTipoEmp").val() === '0') {
            par = 'slcSubTipoEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcAltoRiesgo").val() === 'a') {
            par = 'slcAltoRiesgo';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcTipoContratoEmp").val() === '0') {
            par = 'slcTipoContratoEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcTipoDocEmp").val() === '0') {
            par = 'slcTipoDocEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcGenero").val() === '0') {
            par = 'slcGenero';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#datInicio").val() === '') {
            par = 'datInicio';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcSalIntegral").val() === 'a') {
            par = 'slcSalIntegral';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#numSalarioEmp").val() < '1') {
            par = 'numSalarioEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcPaisEmp").val() === '0') {
            par = 'slcPaisEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcDptoEmp").val() === '0') {
            par = 'slcDptoEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcMunicipioEmp").val() === '0') {
            par = 'slcMunicipioEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#txtDireccion").val() === '') {
            par = 'txtDireccion';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#slcBancoEmp").val() === '0') {
            par = 'slcBancoEmp';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#selTipoCta").val() === '0') {
            par = 'selTipoCta';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else if ($("#txtCuentaBanc").val() === '') {
            par = 'txtCuentaBanc';
            $('#' + par).focus();
            bordeError(par);
            showError(par);
        } else {
            if (ced === "") {
                $('#divModalError').modal('show');
                $('#divMsgError').html("Ingresar numero de documento");
                return false;
            } else {
                if (eps === '0' || arl === '0' || rl === '0' || afp === '0') {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html("Debe selecionar EPS, AFP, ARL y Riesgo laboral");
                    return false;
                } else {
                    let datos = $("#formNuevoEmpleado").serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'newempleado.php',
                        data: datos,
                        success: function(r) {
                            switch (r) {
                                case '0':
                                    $('#divModalError').modal('show');
                                    $('#divMsgError').html("Empleado ya está registrado");
                                    break;
                                case '1':
                                    $("#formNuevoEmpleado")[0].reset();
                                    $('#divModalDone').modal('show');
                                    $('#divMsgDone').html("Empleado registrado correctamente");
                                    break;
                                default:
                                    $('#divModalError').modal('show');
                                    $('#divMsgError').html(r);
                                    break;
                            }
                        }
                    });
                    return false;
                }
            }
        }
        return false;
    });
    //Actualizar empleado
    $("#btnUpEmpleado").click(function() {
        var datos = $("#formUpEmpleado").serialize();
        if ($('#txtCCempleado').val() === '') {
            $('#divModalupError').modal('show');
            $('#divcontenido').html('Debe ingresar un número de documento');
        } else if ($("#numSalarioEmp").val() === '') {
            $('#divModalupError').modal('show');
            $('#divcontenido').html('Debe ingresar el salario basico del empleado');
        } else {
            $.ajax({
                type: 'POST',
                url: 'upempleado.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalupEmpHecho').modal('show');
                    } else {
                        $('#divModalupError').modal('show');
                        $('#divcontenido').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Registrar novedad ARL
    $("#btnAddNovedadArl").click(function() {
        let inicio = $("#datFecAfilArlNovedad").val();
        let fin = $("#datFecRetArlNovedad").val();
        if ($("#slcArlNovedad").val() === "0") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Debe elegir una ARL ");
        } else if ($("#slcRiesLabNov").val() === "0") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Debe elegir Riesgo laboral");
        } else if ($("#datFecAfilArlNovedad").val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicial no puede estar vacia");
        } else if (fin !== '' && inicio > fin) {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicial debe ser menor");
        } else {
            let dnovarl = $("#formAddArlNovedad").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newnovedadarl.php',
                data: dnovarl,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableArl';
                        $("#formAddArlNovedad")[0].reset();
                        $('#divhiddenArl').hide();
                        $('#btnShowAddNovArl').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad registrada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP novedad ARL
    $('#modificarArls').on('click', 'tr td div .editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novedadarl.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovedadARL').show();
                $('#divUpNovedadARL').html(r);
                $('#slcUpNovArl').focus();
            }
        });
    });
    //Actualizar novedad ARL
    $("#divUpNovedadARL").on('click', 'div form center .cancelar', function() {
        $('#divUpNovedadARL').hide();
    });
    $("#divUpNovedadARL").on('click', 'div form center button', function() {
        let inicio = $("#datFecAfilUpNovArl").val();
        let fin = $("#datFecRetUpNovArl").val();
        if (inicio === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicial no puede estar vacia");
        } else if (fin !== '' && inicio > fin) {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicial debe ser menor");
        } else {
            let dupnovarl = $('#formUpNovArl').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upnovedadarl.php',
                data: dupnovarl,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableArl';
                        reloadtable(id);
                        $('#divActuNovArl').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad Actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Novedad ARL
    $("#divBtnsModalDel").on('click', '#btnConfirDelArl', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delnovedadarl.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableArl';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("ARL eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
    });
    //Registrar novedad EPS
    $("#btnAddNovedadEps").click(function() {
        let inicio = $('#datFecAfilEpsNovedad').val();
        let fin = $('#datFecRetEpsNovedad').val();
        if ($("#slcEpsNovedad").val() === "0") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Debe elegir una EPS");
        } else if ($('#datFecAfilEpsNovedad').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial no puede estar vacia');
        } else if (fin !== '' && inicio > fin) {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial debe ser menor');
        } else {
            let dnoveps = $("#formAddEpsNovedad").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newnovedadeps.php',
                data: dnoveps,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableEps';
                        $("#formAddEpsNovedad")[0].reset();
                        $('#divhidden').hide();
                        $('#btnShowAddNovEps').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad registrada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP novedad EPS
    $('#modificarEpss').on('click', 'tr td div .editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novedadeps.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovedadEPS').show();
                $('#divUpNovedadEPS').html(r);
                $('#slcUpNovEps').focus();
            }
        });
    });
    //Actualizar novedad EPS
    $("#divUpNovedadEPS").on('click', 'div form center .cancelar', function() {
        $('#divUpNovedadEPS').hide();
    });
    $("#divUpNovedadEPS").on('click', 'div form center .actualizar', function() {
        let inicio = $('#datFecAfilUpNovEps').val();
        let fin = $('#datFecRetUpNovEps').val();
        if (inicio === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial no puede estar vacia');
        } else if (fin !== '' && inicio > fin) {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial debe ser menor');
        } else {
            let dupnov = $('#formUpNovEps').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upnovedadeps.php',
                data: dupnov,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableEps';
                        reloadtable(id);
                        $('#divActuNov').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad Actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Novedad EPS
    $("#divBtnsModalDel").on('click', '#btnConfirDelEps', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delnovedad.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableEps';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("EPS eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
    });
    //Registrar novedad AFP
    $("#btnAddNovedadAfp").click(function() {
        let inicio = $('#datFecAfilAfpNovedad').val();
        let fin = $('#datFecRetAfpNovedad').val();
        if ($("#slcAfpNovedad").val() === "0") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Debe elegir una AFP");
        } else if (inicio === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial no puede estar vacia');
        } else if (fin !== '' && inicio > fin) {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial debe ser menor');
        } else {
            let dnovafp = $("#formAddAfpNovedad").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newnovedadafp.php',
                data: dnovafp,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableAfp';
                        $("#formAddAfpNovedad")[0].reset();
                        $('#divhiddenAfp').hide();
                        $('#btnShowAddNovAfp').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad registrada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP novedad AFP
    $('#modificarAfps').on('click', 'tr td div .editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novedadafp.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovedadAFP').show();
                $('#divUpNovedadAFP').html(r);
                $('#slcUpNovAfp').focus();
            }
        });
    });
    //Actualizar novedad AFP
    $("#divUpNovedadAFP").on('click', 'div form center .cancelar', function() {
        $('#divUpNovedadAFP').hide();
    });
    $("#divUpNovedadAFP").on('click', 'div form center .actualizar', function() {
        let inicio = $('#datFecAfilUpNovAfp').val();
        let fin = $('#datFecRetUpNovAfp').val();
        if (inicio === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial no puede estar vacia');
        } else if (fin !== '' && inicio > fin) {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Fecha Inicial debe ser menor');
        } else {
            let dupnovafp = $('#formUpNovAfp').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upnovedadafp.php',
                data: dupnovafp,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableAfp';
                        reloadtable(id);
                        $('#divActuNov').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad Actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Novedad AFP
    $("#divBtnsModalDel").on('click', '#btnConfirDelAfp', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delnovedadafp.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableAfp';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("AFP eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);;
                }
            }
        });
    });
    //Registrar Libranza
    $("#btnAddLibranza").click(function() {
        if ($("#slcEntidad").val() === "0") {
            let id = 'slcEntidad';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#numValTotal").val() === '' || parseInt($("#numValTotal").val()) <= 0) {
            let id = 'numValTotal';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#numTotCuotasLib').val() === '' || parseInt($('#numTotCuotasLib').val()) <= 0) {
            let id = 'numTotCuotasLib';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#txtDescripLib').val() === '') {
            let id = 'txtDescripLib';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#txtValLibMes").val() === '' || parseInt($("#txtValLibMes").val()) <= 0) {
            let id = 'txtValLibMes';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('datFecInicioLib').val() === '') {
            let id = 'datFecInicioLib';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if (parseInt($('#txtPorcLibMes').val()) >= 100) {
            $('#txtPorcLibMes').val(0);
            $('#txtValLibMes').val(0);
            $('#divModalError').modal('show');
            $('#divMsgError').html('Porcentaje dede ser menor al 100%');
        } else {
            let dlibranza = $("#formAddLibranza").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newlibranza.php',
                data: dlibranza,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableLibranza';
                        $("#formAddLibranza")[0].reset();
                        $('#divhiddenLibranza').hide();
                        $('#btnShowAddLibranza').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Libranza registrada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP Libranza
    $('#modificarLibranzas').on('click', 'tr td div .editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novlibranza.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovLibranza').show();
                $('#divUpNovLibranza').html(r);
                $('#slcUpEntidad').focus();
            }
        });
    });
    //Actualizar Libranza
    $("#divUpNovLibranza").on('click', 'div form center .cancelar', function() {
        $('#divUpNovLibranza').hide();
    });
    $("#divUpNovLibranza").on('click', 'div form center .actualizar', function() {
        if ($("#numUpValTotal").val() === '' || parseInt($("#numUpValTotal").val()) <= 0) {
            let id = 'numUpValTotal';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#numUpTotCuotasLib').val() === '' || parseInt($('#numUpTotCuotasLib').val()) <= 0) {
            let id = 'numUpTotCuotasLib';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#txtUpDescripLib').val() === '') {
            let id = 'txtUpDescripLib';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#txtUpValLibMes").val() === '' || parseInt($("#txtUpValLibMes").val()) <= 0) {
            let id = 'txtUpValLibMes';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('datUpFecInicioLib').val() === '') {
            let id = 'datUpFecInicioLib';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if (parseInt($('#txtUpPorcLibMes').val()) >= 100) {
            $('#txtUpPorcLibMes').val(0);
            $('#txtUpValLibMes').val(0);
            $('#divModalError').modal('show');
            $('#divMsgError').html('Porcentaje dede ser menor al 100%');
        } else {
            let duplibranza = $('#formUpLibranza').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/uplibranza.php',
                data: duplibranza,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableLibranza';
                        reloadtable(id);
                        $('#divActuLibranza').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Libranza Actualizada correctamente");
                    } else {

                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Libranza
    $("#divBtnsModalDel").on('click', '#btnConfirDelLib', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/dellibranza.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableLibranza';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Libranza eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);;
                }
            }
        });
        return false;
    });
    //listar detalles de libranza
    $('#modificarLibranzas').on('click', 'tr td div button i', function() {
        let idlib = $(this).attr('value');
        let boton = $(this).hasClass('fa-eye');
        if (boton) {
            $.ajax({
                type: 'POST',
                url: 'listar/listlibranza.php',
                data: { idlib: idlib },
                success: function(r) {
                    $('#divShowResLibranza').show();
                    $('#divShowResLibranza').html(r);
                }
            });
            $('#modificarLibranzas tr td div .btn-change').removeClass('btn-outline-secondary');
            $('#modificarLibranzas tr td div .btn-change').addClass('btn-outline-warning');
            $('#modificarLibranzas tr td div .i-change').removeClass('fa-eye-slash');
            $('#modificarLibranzas tr td div .i-change').addClass('fa-eye');
            $('#datalles_' + idlib).removeClass('btn-outline-warning');
            $('#datalles_' + idlib).addClass('btn-outline-secondary');
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
        } else {
            $('#divShowResLibranza').hide();
            $('#datalles_' + idlib).removeClass('btn-outline-secondary');
            $('#datalles_' + idlib).addClass('btn-outline-warning');
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
        }
    });
    //Registrar Embargo 
    var showError = function(id) {
        $('#e' + id).show();
        setTimeout(function() {
            $('#e' + id).fadeOut(600);
        }, 800);
    };
    $("#btnAddEmbargo").click(function() {
        if ($("#slcJuzgado").val() === "0") {
            let id = 'slcJuzgado';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#slcTipoEmbargo").val() === "0") {
            let id = 'slcTipoEmbargo';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#numTotEmbargo").val() === "") {
            let id = 'numTotEmbargo';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#txtValEmbargoMes").val() === "") {
            let id = 'txtValEmbargoMes';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#datFecInicioEmb').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicial no puede estar vacia");
        } else if (parseInt($('#txtValEmbargoMes').val()) > parseInt($('#numDctoAprox').val())) {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Embargo mensual no debe ser mayor que el máximo descuento");
        } else {
            let dembargo = $("#formAddEmbargo").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newembargo.php',
                data: dembargo,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableEmbargo';
                        $("#formAddEmbargo")[0].reset();
                        $('#divhiddenEmbargo').hide();
                        $('#btnShowAddEmbargo').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Embargo registrado correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Validad fechas todos
    var validafec = function(tip, ex, up) {
        let inicio = $('#dat' + up + 'FecInicio' + tip).val();
        let fin = $('#dat' + up + 'FecFin' + tip).val();
        if (inicio > fin) {
            $('#dat' + up + 'Fec' + ex + tip).focus();
            $('#dat' + up + 'Fec' + ex + tip).val('');
            $('#edat' + up + 'Fec' + ex + tip).show();
            setTimeout(function() {
                $('#edat' + up + 'Fec' + ex + tip).fadeOut(600);
            }, 800);
            return false;
        }
        return false;
    };
    //Calcular dias incapacidad
    var caldiasincap = function(ini, fin, u, t) {
        $.ajax({
            type: 'POST',
            url: 'registrar/calcfec.php',
            data: { inicio: ini, fin: fin, up: u, tip: t },
            success: function(r) {
                if (parseInt(r) > 180) {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html("Máximo 180 días");
                    $('#dat' + u + 'FecFin' + t).val('');
                } else {
                    $('#div' + u + 'CantDias' + t).html(r);
                }

            }
        });
        return false;
    };
    $('#datFecInicioInc').on('input', function() {
        let t = 'Inc';
        let e = 'Fin';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecFinInc').on('input', function() {
        let t = 'Inc';
        let e = 'Inicio';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecInicioVacs').on('input', function() {
        let t = 'Vacs';
        let e = 'Fin';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecFinVacs').on('input', function() {
        let t = 'Vacs';
        let e = 'Inicio';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecInicioLics').on('input', function() {
        let t = 'Lics';
        let e = 'Fin';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecFinLics').on('input', function() {
        let t = 'Lics';
        let e = 'Inicio';
        let u = '';
        validafec(t, e, u);
    });
    //Embargo
    $('#datFecFinEmb').on('input', function() {
        let t = 'Emb';
        let e = 'Inicio';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecInicioEmb').on('input', function() {
        let t = 'Emb';
        let e = 'Fin';
        let u = '';
        validafec(t, e, u);
    });
    $('#divUpNovEmbargo').on('input', '#datUpFecInicioEmb', function() {
        let t = 'Emb';
        let e = 'Fin';
        let u = 'Up';
        validafec(t, e, u);
    });
    $('#divUpNovEmbargo').on('input', '#datUpFecFinEmb', function() {
        let t = 'Emb';
        let e = 'Inicio';
        let u = 'Up';
        validafec(t, e, u);
    });
    //libranza
    $('#datFecFinLib').on('input', function() {
        let t = 'Lib';
        let e = 'Inicio';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecInicioLib').on('input', function() {
        let t = 'Lib';
        let e = 'Fin';
        let u = '';
        validafec(t, e, u);
    });
    $('#divUpNovLibranza').on('input', '#datUpFecFinLib', function() {
        let t = 'Lib';
        let e = 'Inicio';
        let u = 'Up';
        validafec(t, e, u);
    });
    $('#divUpNovLibranza').on('input', '#datUpFecInicioLib', function() {
        let t = 'Lib';
        let e = 'Fin';
        let u = 'Up';
        validafec(t, e, u);
    });
    //Sindicato
    $('#datFecFinSind').on('input', function() {
        let t = 'Sind';
        let e = 'Inicio';
        let u = '';
        validafec(t, e, u);
    });
    $('#datFecInicioSind').on('input', function() {
        let t = 'Sind';
        let e = 'Fin';
        let u = '';
        validafec(t, e, u);
    });
    $('#divUpNovSindicato').on('input', '#datUpFecFinSind', function() {
        let t = 'Sind';
        let e = 'Inicio';
        let u = 'Up';
        validafec(t, e, u);
    });
    $('#divUpNovSindicato').on('input', '#datUpFecInicioSind', function() {
        let t = 'Sind';
        let e = 'Fin';
        let u = 'Up';
        validafec(t, e, u);
    });
    //Incapacidad
    $('#datFecFinIncap').on('input', function() {
        let inincap = $('#datFecInicioIncap').val();
        let finincap = $('#datFecFinIncap').val();
        let u = '';
        let t = 'Incap';
        if (inincap > finincap) {
            let e = 'Inicio';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#datFecInicioIncap').on('input', function() {
        let inincap = $('#datFecInicioIncap').val();
        let finincap = $('#datFecFinIncap').val();
        let u = '';
        let t = 'Incap';
        if (inincap > finincap) {
            let e = 'Fin';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#divUpNovIncapacidad').on('input', '#datUpFecFinIncap', function() {
        let inincap = $('#datUpFecInicioIncap').val();
        let finincap = $('#datUpFecFinIncap').val();
        let u = 'Up';
        let t = 'Incap';
        if (inincap > finincap) {
            let e = 'Inicio';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#divUpNovIncapacidad').on('input', '#datUpFecInicioIncap', function() {
        let inincap = $('#datUpFecInicioIncap').val();
        let finincap = $('#datUpFecFinIncap').val();
        let u = 'Up';
        let t = 'Incap';
        if (inincap > finincap) {
            let e = 'Fin';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    //Vacaciones
    $('#datFecFinVac').on('input', function() {
        let inincap = $('#datFecInicioVac').val();
        let finincap = $('#datFecFinVac').val();
        let u = '';
        let t = 'Vac';
        if (inincap > finincap) {
            let e = 'Inicio';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#datFecInicioVac').on('input', function() {
        let inincap = $('#datFecInicioVac').val();
        let finincap = $('#datFecFinVac').val();
        let u = '';
        let t = 'Vac';
        if (inincap > finincap) {
            let e = 'Fin';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#divUpNovVacacion').on('input', '#datUpFecFinVac', function() {
        let inincap = $('#datUpFecInicioVac').val();
        let finincap = $('#datUpFecFinVac').val();
        let u = 'Up';
        let t = 'Vac';
        if (inincap > finincap) {
            let e = 'Inicio';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#divUpNovVacacion').on('input', '#datUpFecInicioVac', function() {
        let inincap = $('#datUpFecInicioVac').val();
        let finincap = $('#datUpFecFinVac').val();
        let u = 'Up';
        let t = 'Vac';
        if (inincap > finincap) {
            let e = 'Fin';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    //Licencias
    $('#datFecFinLic').on('input', function() {
        let inincap = $('#datFecInicioLic').val();
        let finincap = $('#datFecFinLic').val();
        let u = '';
        let t = 'Lic';
        if (inincap > finincap) {
            let e = 'Inicio';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#datFecInicioLic').on('input', function() {
        let inincap = $('#datFecInicioLic').val();
        let finincap = $('#datFecFinLic').val();
        let u = '';
        let t = 'Lic';
        if (inincap > finincap) {
            let e = 'Fin';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#divUpNovLicencia').on('input', '#datUpFecFinLic', function() {
        let inincap = $('#datUpFecInicioLic').val();
        let finincap = $('#datUpFecFinLic').val();
        let u = 'Up';
        let t = 'Lic';
        if (inincap > finincap) {
            let e = 'Inicio';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    $('#divUpNovLicencia').on('input', '#datUpFecInicioLic', function() {
        let inincap = $('#datUpFecInicioLic').val();
        let finincap = $('#datUpFecFinLic').val();
        let u = 'Up';
        let t = 'Lic';
        if (inincap > finincap) {
            let e = 'Fin';
            validafec(t, e, u);
        } else {
            caldiasincap(inincap, finincap, u, t);
        }
    });
    //UP Embargo
    $('#modificarEmbargos').on('click', 'tr td div .editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novembargo.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovEmbargo').show();
                $('#divUpNovEmbargo').html(r);
                $('#slcUpJuzgado').focus();
            }
        });
    });
    //Actualizar Embargo
    $("#divUpNovEmbargo").on('click', '.cancelar', function() {
        $('#divActuEmbargo').hide();
    });
    $("#divUpNovEmbargo").on('click', '.actualizar', function() {
        if ($("#numUpTotEmbargo").val() === "") {
            let id = 'numUpTotEmbargo';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($("#txtUpValEmbargoMes").val() === "" || $("#txtUpValEmbargoMes").val() === "0") {
            let id = 'txtUpValEmbargoMes';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#datUpFecInicioEmb').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicial no puede estar vacia");
        } else if (parseInt($('#txtUpValEmbargoMes').val()) > parseInt($('#numUpDctoAprox').val())) {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Embargo mensual no debe ser mayor que el máximo descuento");
        } else {
            let dupembargo = $('#formUpEmbargo').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upembargo.php',
                data: dupembargo,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableEmbargo';
                        reloadtable(id);
                        $('#divActuEmbargo').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Embargo Actualizado correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Embargo
    $("#divBtnsModalDel").on('click', '#btnConfirDelEmb', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delembargo.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableEmbargo';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Embargo eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);;
                }
            }
        });
        return false;
    });
    //listar detalles embargo
    $('#modificarEmbargos').on('click', '.i-change', function() {
        let idemb = $(this).attr('value');
        let boton = $(this).hasClass('fa-eye');
        if (boton) {
            $.ajax({
                type: 'POST',
                url: 'listar/listembargo.php',
                data: { idemb: idemb },
                success: function(r) {
                    $('#divShowResEmbargo').show();
                    $('#divShowResEmbargo').html(r);
                }
            });
            $('#modificarEmbargos .btn-change').removeClass('btn-outline-secondary');
            $('#modificarEmbargos .btn-change').addClass('btn-outline-warning');
            $('#modificarEmbargos .i-change').removeClass('fa-eye-slash');
            $('#modificarEmbargos .i-change').addClass('fa-eye');
            $('#datallesEmb_' + idemb).removeClass('btn-outline-warning');
            $('#datallesEmb_' + idemb).addClass('btn-outline-secondary');
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
        } else {
            $('#divShowResEmbargo').hide();
            $('#datallesEmb_' + idemb).removeClass('btn-outline-secondary');
            $('#datallesEmb_' + idemb).addClass('btn-outline-warning');
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
        }
    });
    //Registrar Sindicato
    $("#btnAddSindicato").click(function() {
        if ($("#slcSindicato").val() === "0") {
            let id = 'slcSindicato';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#txtPorcentajeSind').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Porcentaje no puede estar vacio");
        } else if ($('#datFecInicioSind').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicio no puede estar vacia");
        } else {
            let dsind = $("#formAddSindicato").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newsindicato.php',
                data: dsind,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableSindicato';
                        $("#formAddSindicato")[0].reset();
                        $('#divhiddenSindicato').hide();
                        $('#btnShowAddSindicato').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Sindicato registrado correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP Sindicato
    $('#modificarSindicatos').on('click', '.editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novsindicato.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovSindicato').show();
                $('#divUpNovSindicato').html(r);
                $('#slcUpSindicato').focus();
            }
        });
    });
    //Actualizar Sindicato
    $("#divUpNovSindicato").on('click', '.cancelar', function() {
        $('#divUpNovSindicato').hide();
    });
    $("#divUpNovSindicato").on('click', '.actualizar', function() {
        if ($('#datUpFecInicioSind').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fecha Inicio no puede estar vacia");
        } else {
            let dupsind = $('#formUpSindicato').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upsindicato.php',
                data: dupsind,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableSindicato';
                        reloadtable(id);
                        $('#divActuSindicato').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Novedad Actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Sindicato
    $("#divBtnsModalDel").on('click', '#btnConfirDelSind', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delsindicato.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableSindicato';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Sindicato eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //listar detalles Sindicato
    $('#modificarSindicatos').on('click', '.i-change', function() {
        let idaporte = $(this).attr('value');
        let boton = $(this).hasClass('fa-eye');
        if (boton) {
            $.ajax({
                type: 'POST',
                url: 'listar/listaportsind.php',
                data: { idaporte: idaporte },
                success: function(r) {
                    $('#divShowResSindicato').show();
                    $('#divShowResSindicato').html(r);
                }
            });
            $('#modificarSindicatos .btn-change').removeClass('btn-outline-secondary');
            $('#modificarSindicatos .btn-change').addClass('btn-outline-warning');
            $('#modificarSindicatos .i-change').removeClass('fa-eye-slash');
            $('#modificarSindicatos .i-change').addClass('fa-eye');
            $('#datallesSind_' + idaporte).removeClass('btn-outline-warning');
            $('#datallesSind_' + idaporte).addClass('btn-outline-secondary');
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
        } else {
            $('#divShowResSindicato').hide();
            $('#datallesSind_' + idaporte).removeClass('btn-outline-secondary');
            $('#datallesSind_' + idaporte).addClass('btn-outline-warning');
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
        }
    });
    //Registrar Incapacidad
    $("#btnAddIncapacidad").click(function() {
        if ($("#slcTipIncapacidad").val() === "0") {
            let id = 'slcTipIncapacidad';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#datFecInicioIncap').val() === '' || $('#datFecFinIncap').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fechas no pueden estar vacias");
        } else {
            let dincap = $("#formAddIncapacidad").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newincapacidad.php',
                data: dincap,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableIncapacidad';
                        $("#formAddIncapacidad")[0].reset();
                        $('#divhiddenIncapacidad').hide();
                        $('#btnShowAddIncapacidad').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Incapacidad registrada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP Incapacidad
    $('#modificarIncapacidades').on('click', '.editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novincapacidad.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovIncapacidad').show();
                $('#divUpNovIncapacidad').html(r);
                $('#slcUpTipIncapacidad').focus();
            }
        });
    });
    //Actualizar Incapacidad
    $("#divUpNovIncapacidad").on('click', '.cancelar', function() {
        $('#divUpNovIncapacidad').hide();
    });
    $("#divUpNovIncapacidad").on('click', '.actualizar', function() {
        if ($('#datUpFecInicioIncap').val() === '' || $('#datUpFecFinIncap').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fechas no pueden estar vacias");
        } else {
            let dupincap = $('#formUpIncapacidad').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upincapacidad.php',
                data: dupincap,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableIncapacidad';
                        reloadtable(id);
                        $('#divActuIncapacidad').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Incapacidad Actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Incapacidad
    $("#divBtnsModalDel").on('click', '#btnConfirDelIncap', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delincapacidad.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableIncapacidad';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Incapacidad eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //Registrar Vacaciones
    $("#btnAddVacacion").click(function() {
        let diainac = $('#numCantDiasVac').val();
        let diahab = $('#numCantDiasHabVac').val();
        if ($("#slcVacAnticip").val() === "0") {
            let id = 'slcVacAnticip';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if ($('#datFecInicioVac').val() === '' || $('#datFecFinVac').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fechas no pueden estar vacias");
        } else if (parseInt(diahab) > parseInt(diainac)) {
            let id = 'numCantDiasHabVac';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if (diahab === '' || parseInt(diahab) === 0) {
            let id = 'numCantDiasHabVac';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else {
            let dvac = $("#formAddVacaciones").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newvacacion.php',
                data: dvac,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableVacaciones';
                        $("#formAddVacaciones")[0].reset();
                        $('#divhiddenVacaciones').hide();
                        $('#btnShowAddVacacion').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Vacaciones registradas correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP Vacaciones
    $('#modificarVacaciones').on('click', '.editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novvacaciones.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovVacacion').show();
                $('#divUpNovVacacion').html(r);
                $('#slcUpVacAnticip').focus();
            }
        });
    });
    //Actualizar Vacaciones
    $("#divUpNovVacacion").on('click', '.cancelar', function() {
        $('#divUpNovVacacion').hide();
    });
    $("#divUpNovVacacion").on('click', '.actualizar', function() {
        let diainac = $('#numUpCantDiasVac').val();
        let diahab = $('#numUpCantDiasHabVac').val();
        if ($('#datUpFecInicioVac').val() === '' || $('#datUpFecFinVac').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fechas no pueden estar vacias");
            return false;
        } else if (parseInt(diahab) > parseInt(diainac)) {
            let id = 'numUpCantDiasHabVac';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if (diahab === '' || parseInt(diahab) === 0) {
            let id = 'numUpCantDiasHabVac';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else {
            let dupvac = $('#formUpVacaciones').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/upvacacion.php',
                data: dupvac,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableVacaciones';
                        reloadtable(id);
                        $('#divActuVacacion').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Vacaciones Actualizadas correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Vacaciones
    $("#divBtnsModalDel").on('click', '#btnConfirDelVac', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/delvacacion.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableVacaciones';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Vacaciones eliminadas correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //Registrar Licencia MP
    $("#btnAddLicencia").click(function() {
        let diainac = $('#numCantDiasLic').val();
        let diahab = $('#numCantDiasHabLic').val();
        if ($('#datFecInicioLic').val() === '' || $('#datFecFinLic').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fechas no pueden estar vacias");
            return false;
        } else if (parseInt(diahab) > parseInt(diainac)) {
            let id = 'numCantDiasHabLic';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if (diahab === '' || parseInt(diahab) === 0) {
            let id = 'numCantDiasHabLic';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else {
            let dvac = $("#formAddLicencia").serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/newlicencia.php',
                data: dvac,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableLicencia';
                        $("#formAddLicencia")[0].reset();
                        $('#divhiddenLicencia').hide();
                        $('#btnShowAddLicencia').show();
                        reloadtable(id);
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Vacaciones registradas correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //UP Licencia
    $('#modificarLicencias').on('click', '.editar', function() {
        let id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/actualizar/up_novlicencia.php',
            data: { id: id },
            success: function(r) {
                $('#divUpNovLicencia').show();
                $('#divUpNovLicencia').html(r);
                $('#datUpFecInicioLic').focus();
            }
        });
    });
    //Actualizar Licencia
    $("#divUpNovLicencia").on('click', '.cancelar', function() {
        $('#divUpNovLicencia').hide();
    });
    $("#divUpNovLicencia").on('click', '.actualizar', function() {
        let diainac = $('#numUpCantDiasLic').val();
        let diahab = $('#numUpCantDiasHabLic').val();
        if ($('#datUpFecInicioLic').val() === '' || $('#datUpFecFinLic').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Fechas no pueden estar vacias");
        } else if (parseInt(diahab) > parseInt(diainac)) {
            let id = 'numUpCantDiasHabLic';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else if (diahab === '' || parseInt(diahab) === 0) {
            let id = 'numUpCantDiasHabLic';
            $('#' + id).focus();
            showError(id);
            bordeError(id);
        } else {
            let duplic = $('#formUpLicencia').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/uplicencia.php',
                data: duplic,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableLicencia';
                        reloadtable(id);
                        $('#divActuLicencia').css('display', 'none');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Licencia Actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Eliminar Licencia
    $("#divBtnsModalDel").on('click', '#btnConfirDelLic', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/dellicencia.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableLicencia';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Licencia eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //Confirmar eliminar
    var confdel = function(i, t) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'eliminar/confirdel.php',
            data: { id: i, tip: t }
        }).done(function(res) {
            $('#divModalConfDel').modal('show');
            $('#divMsgConfdel').html(res.msg);
            $('#divBtnsModalDel').html(res.btns);
        });
        return false;
    };
    //Borrar EPS confirmar
    $('#modificarEpss').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Eps';
        confdel(id, tip);
    });
    //Borrar novedad ARL confirmar
    $('#modificarArls').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Arl';
        confdel(id, tip);
    });
    //Borrar novedad AFP confirmar
    $('#modificarAfps').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Afp';
        confdel(id, tip);
    });
    //Borrar Libranza confirmar
    $('#modificarLibranzas').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Lib';
        confdel(id, tip);
    });
    //Borrar Embargo confirmar
    $('#modificarEmbargos').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Emb';
        confdel(id, tip);
    });
    //Borrar Sindicato confirmar
    $('#modificarSindicatos').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Sind';
        confdel(id, tip);
    });
    //Borrar Incapacidad confirmar
    $('#modificarIncapacidades').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Incap';
        confdel(id, tip);
    });
    //Borrar Vacaciones confirmar
    $('#modificarVacaciones').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Vac';
        confdel(id, tip);
    });
    //Borrar Licencia confirmar
    $('#modificarLicencias').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Lic';
        confdel(id, tip);
    });
    //Confirmar eliminar empleado
    $("#evaluate button").click(function() {
        let idempleado = $(this).val();
        window.rowdel = $(this).closest("tr").get(0);
        $.ajax({
            type: 'POST',
            url: 'eliminar/busempleado.php',
            data: { idempleado: idempleado },
            success: function(r) {
                $('#divModalConfirmarDel').modal('show');
                $('#divConfirmdel').html(r);
            }
        });
        return false;
    });
    //cambiar estado empleado
    $("#tdEstado button").click(function() {
        let idemp = $(this).val();
        let divestM = "divIconoshow" + idemp;
        let divestO = "divIcono" + idemp;
        $('#' + divestM).hide();
        $.ajax({
            type: 'POST',
            url: 'actualizar/upestado.php',
            data: { idemp: idemp },
            success: function(r) {
                $('#' + divestO).html(r);
                $('#' + divestO).show();
            }
        });
        return false;
    });
    //Cambiar Municipios por departamento
    $('#slcDptoEmp').on('change', function() {
        let dpto = $(this).val();
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/empleados/registrar/slcmunicipio.php',
            data: { dpto: dpto },
            success: function(r) {
                $('#slcMunicipioEmp').html(r);
            }
        });
        return false;
    });
    //Calcular valor máximo embargo mensual
    var calmaxemb = function(p, up) {
        let dat = p + '&up=' + up;
        $.ajax({
            type: 'POST',
            url: 'registrar/slctipemb.php',
            data: dat,
            success: function(r) {
                $('#div' + up + 'DctoAprox').html(r);
            }
        });
    };
    $('#slcTipoEmbargo').on('change', function() {
        let tipemb = $(this).val();
        let u = '';
        calmaxemb(tipemb, u);
        return false;
    });
    //up
    $('#divUpNovEmbargo').on('change', '#slcUpTipoEmbargo', function() {
        let tipemb = $(this).val();
        let o = 'Up';
        calmaxemb(tipemb, o);
        return false;
    });
    //Calcular % embargo - libranza
    var calporcemb = function(v, s, u, t) {
        let dat = 'val=' + v + '&sal=' + s;
        $.ajax({
            type: 'POST',
            url: 'registrar/cal_porcent.php',
            data: dat,
            success: function(r) {
                $('#txt' + u + 'Porc' + t + 'Mes').val(r);
            }
        });
    };
    $("#txtValEmbargoMes").keyup(function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = '';
        let tip = 'Emb';
        calporcemb(val, sal, up, tip);
        return false;
    });
    $("#divUpNovEmbargo").on('keyup', '#txtUpValEmbargoMes', function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = 'Up';
        let tip = 'Emb';
        calporcemb(val, sal, up, tip);
        return false;
    });
    $("#txtValLibMes").keyup(function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = '';
        let tip = 'Lib';
        calporcemb(val, sal, up, tip);
        return false;
    });
    $("#divUpNovLibranza").on('keyup', '#txtUpValLibMes', function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = 'Up';
        let tip = 'Lib';
        calporcemb(val, sal, up, tip);
        return false;
    });
    //Calcular val mensual
    var calvalmesemb = function(v, s, u, t) {
        let dat = 'val=' + v + '&sal=' + s;
        $.ajax({
            type: 'POST',
            url: 'registrar/cal_valembar.php',
            data: dat,
            success: function(r) {
                $('#txt' + u + 'Val' + t + 'Mes').val(r);
            }
        });
    };
    $("#txtPorcEmbMes").keyup(function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = '';
        let tip = 'Embargo';
        calvalmesemb(val, sal, up, tip);
        return false;
    });
    $("#divUpNovEmbargo").on('keyup', '#txtUpPorcEmbMes', function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = 'Up';
        let tip = 'Embargo';
        calvalmesemb(val, sal, up, tip);
        return false;
    });
    $("#txtPorcLibMes").keyup(function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = '';
        let tip = 'Lib';
        calvalmesemb(val, sal, up, tip);
        return false;
    });
    $("#divUpNovLibranza").on('keyup', '#txtUpPorcLibMes', function() {
        let val = $(this).val();
        let sal = $('#txtSalBas').val();
        let up = 'Up';
        let tip = 'Lib';
        calvalmesemb(val, sal, up, tip);
        return false;
    });
    var rowdel = function() {
        $(document).ready(function() {
            var table = $('.table').DataTable();
            table.row(window.rowdel).remove().draw();
        });
    };
    var reloadtable = function(nom) {
        $(document).ready(function() {
            var table = $('#' + nom).DataTable();
            table.ajax.reload();
        });
    };
})(jQuery);