(function($) {
    //Superponer modales
    $(document).on('show.bs.modal', '.modal', function() {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    var showError = function(id) {
        $('#' + id).focus();
        $('#e' + id).show();
        setTimeout(function() {
            $('#e' + id).fadeOut(600);
        }, 800);
    };
    var bordeError = function(p) {
        $('#' + p).css("border", "2px solid #F5B7B1");
        $('#' + p).css('box-shadow', '0 0 4px 3px pink');
    };
    var reloadtable = function(nom) {
        $(document).ready(function() {
            var table = $('#' + nom).DataTable();
            table.ajax.reload();
        });
    };
    var confdel = function(i, t) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../../nomina/empleados/eliminar/confirdel.php',
            data: { id: i, tip: t }
        }).done(function(res) {
            $('#divModalConfDel').modal('show');
            $('#divMsgConfdel').html(res.msg);
            $('#divBtnsModalDel').html(res.btns);
        });
        return false;
    };
    var setIdioma = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ - _END_ registros de _TOTAL_ ",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ entradas en total )",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Ver _MENU_ Filas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": '<i class="fas fa-search fa-flip-horizontal" style="font-size:1.5rem; color:#2ECC71;"></i>',
        "zeroRecords": "No se encontraron registros",
        "paginate": {
            "first": "&#10096&#10096",
            "last": "&#10097&#10097",
            "next": "&#10097",
            "previous": "&#10096"
        }
    };
    var setdom;
    if ($("#peReg").val() === '1') {
        setdom = "<'row'<'col-md-5'l><'bttn-plus-dt col-md-2'B><'col-md-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    } else {
        setdom = "<'row'<'col-md-6'l><'col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
    }

    $(document).ready(function() {
        //dataTable adquisiciones
        $('#tableAdquisiciones').DataTable({
            dom: setdom,
            buttons: [{
                //Registar modalidad de contratación
                action: function(e, dt, node, config) {
                    $.post("datos/registrar/formadd_adquisicion.php", function(he) {
                        $('#divTamModalForms').removeClass('modal-xl');
                        $('#divTamModalForms').removeClass('modal-sm');
                        $('#divTamModalForms').addClass('modal-lg');
                        $('#divModalForms').modal('show');
                        $("#divForms").html(he);
                    });
                }
            }],
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_adquisiciones.php',
                type: 'POST',
                dataType: 'json',
            },
            "columns": [
                { 'data': 'modalidad' },
                { 'data': 'adquisicion' },
                { 'data': 'fecha' },
                { 'data': 'objeto' },
                { 'data': 'estado' },
                { 'data': 'botones' },
            ],
            "order": [
                [2, "desc"]
            ]
        });
        $('#tableAdquisiciones').wrap('<div class="overflow" />');
        //dataTable Adquisicion de bienes o servicios
        $('#tableAdqBnSv').DataTable({
            dom: "<'row'<'reg-orden col-md-6'B><'col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                text: 'ORDENAR',
                action: function() {
                    let tdatos = $("input[class=numChecks]:checked").length;
                    let datos = $('#formDetallesAdq').serialize();
                    datos = datos + '&tdatos=' + tdatos;
                    $.ajax({
                        type: 'POST',
                        url: 'registrar/new_adquisicion_bn_sv.php',
                        data: datos,
                        success: function(r) {
                            alert(r);
                            return false;
                            if (r === '1') {
                                let id = 'tableAdquisiciones';
                                reloadtable(id);
                                $('#divModalForms').modal('hide');
                                $('#divModalDone').modal('show');
                                $('#divMsgDone').html('Adquisición Agregada Correctamente');
                            } else {
                                $('#divModalError').modal('show');
                                $('#divMsgError').html(r);
                            }
                        }
                    });
                    return false;
                }
            }],
            language: setIdioma,
            paginate: false,
        });
        $('#tableAdqBnSv').wrap('<div class="overflow" />');
        $('.bttn-plus-dt span').html('<span class="icon-dt fas fa-plus-circle fa-lg"></span>');
    });
    //Agregar adquisicion
    $('#divForms').on('click', '#btnAddAdquisicion', function() {
        if ($('#datFecAdq').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Fecha de aquisición no puede ser Vacía!');
        } else if ($('#datFecVigencia').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Fecha de vigencia no puede ser Vacía!');
        } else if ($('#slcModalidad').val() === '0') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Debe seleccionar una modalidad de contratación!');
        } else {
            datos = $('#formAddAdquisicion').serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/new_adquisicion.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableAdquisiciones';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Adquisición Agregada Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Editar adquisición 
    $('#modificarAdquisiciones').on('click', '.detalles', function() {
        let id_det = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'datos/listar/detalles_adq.php',
            data: { id_det: id_det },
            success: function(r) {
                window.location = 'detalles_adquisicion.php';
            }
        });
    });
    //Borrar modalidad confirmar
    $('#modificarModalidades').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'Modalidad';
        confdel(id, tip);
    });
    //Eliminar modalidad
    $("#divBtnsModalDel").on('click', '#btnConfirDelModalidad', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/del_modalidad.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableModalidad';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Modalidad de contratación eliminada correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //Agregar tipo de contrato
    $('#divForms').on('click', '#btnAddTipoContrato', function() {
        if ($('#slcTipoCompra').val() === '0') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Tipo de compra no puede ser Vacía!');
        } else if ($('#txtTipoContrato').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Tipo de contrato no puede ser Vacío!');
        } else {
            datos = $('#formAddTipoContrato').serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/new_tipo_contrato.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableTipoContrato';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Tipo de Contrato Agregado Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Actualizar tipo de contrato -> formulario
    $('#modificarTipoContratos').on('click', '.editar', function() {
        let idtc = $(this).attr('value');
        $.post("datos/actualizar/up_tipo_contrato.php", { idtc: idtc }, function(he) {
            $('#divTamModalForms').removeClass('modal-sm');
            $('#divTamModalForms').removeClass('modal-xl');
            $('#divTamModalForms').addClass('modal-lg');
            $('#divModalForms').modal('show');
            $("#divForms").html(he);
        });
    });
    //Actualizar datos tipo de contrato
    $('#divForms').on('click', '#btnUpTipoContrato', function() {
        let id;
        if ($('#txtTipoContrato').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Tipo de contrato no puede ser Vacío!');
        } else {
            let datos = $('#formActualizaTipoContrato').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/up_datos_tipo_contrato.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        id = 'tableTipoContrato';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Datos Actualizados Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Borrar tipo de contrato confirmar
    $('#modificarTipoContratos').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'TipoContrato';
        confdel(id, tip);
    });
    //Eliminar tipo de contrato
    $("#divBtnsModalDel").on('click', '#btnConfirDelTipoContrato', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/del_tipo_contrato.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableTipoContrato';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Tipo de contrato eliminado correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //Agregar tipo de bien o servicio
    $('#divForms').on('click', '#btnAddTipoBnSv', function() {
        if ($('#slcTipoContrato').val() === '0') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Debe selecionar tipo de contrato!');
        } else if ($('#txtTipoBnSv').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Tipo de contrato no puede ser Vacío!');
        } else {
            datos = $('#formAddTipoBnSv').serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/new_tipo_bn_sv.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableTipoBnSv';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Tipo de bien o servicio Agregado Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Actualizar tipo de bien o servicio -> formulario
    $('#modificarTipoBnSvs').on('click', '.editar', function() {
        let idtbs = $(this).attr('value');
        $.post("datos/actualizar/up_tipo_bn_sv.php", { idtbs: idtbs }, function(he) {
            $('#divTamModalForms').removeClass('modal-sm');
            $('#divTamModalForms').removeClass('modal-xl');
            $('#divTamModalForms').addClass('modal-lg');
            $('#divModalForms').modal('show');
            $("#divForms").html(he);
        });
    });
    //Actualizar datos tipo de bien o servicio
    $('#divForms').on('click', '#btnUpTipoBnSv', function() {
        let id;
        if ($('#txtTipoContrato').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Tipo de bien o servicio no puede ser Vacío!');
        } else {
            let datos = $('#formActualizaBnSv').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/up_datos_tipo_bn_sv.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        id = 'tableTipoBnSv';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Datos Actualizados Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Borrar tipo de bien o servicio
    $('#modificarTipoBnSvs').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'TipoBnSv';
        confdel(id, tip);
    });
    //Eliminar tipo de bien o servicio
    $("#divBtnsModalDel").on('click', '#btnConfirDelTipoBnSv', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/del_tipo_bn_sv.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableTipoBnSv';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Tipo de bien o servicio eliminado correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
    //Agregar bien o servicio
    $('#divForms').on('click', '#btnAddBnSv', function() {
        if ($('#slcTipoBnSv').val() === '0') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Debe selecionar tipo de bien o servicio!');
        } else if ($('#txtBnSv').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Bien o servicio no puede ser Vacío!');
        } else {
            datos = $('#formAddBnSv').serialize();
            $.ajax({
                type: 'POST',
                url: 'registrar/new_bn_sv.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        let id = 'tableBnSv';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Bien o servicio Agregado Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Actualizar bien o servicio -> formulario
    $('#modificarBnSvs').on('click', '.editar', function() {
        let idbs = $(this).attr('value');
        $.post("datos/actualizar/up_bn_sv.php", { idbs: idbs }, function(he) {
            $('#divTamModalForms').removeClass('modal-sm');
            $('#divTamModalForms').removeClass('modal-xl');
            $('#divTamModalForms').addClass('modal-lg');
            $('#divModalForms').modal('show');
            $("#divForms").html(he);
        });
    });
    //Actualizar datos de bien o servicio
    $('#divForms').on('click', '#btnUpBnSv', function() {
        let id;
        if ($('#txtBnSv').val() === '') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('¡Bien o servicio no puede ser Vacío!');
        } else {
            let datos = $('#formActualizaBnSv').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar/up_datos_bn_sv.php',
                data: datos,
                success: function(r) {
                    if (r === '1') {
                        id = 'tableBnSv';
                        reloadtable(id);
                        $('#divModalForms').modal('hide');
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html('Datos Actualizados Correctamente');
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Borrar bien o servicio
    $('#modificarBnSvs').on('click', '.borrar', function() {
        let id = $(this).attr('value');
        let tip = 'BnSv';
        confdel(id, tip);
    });
    //Eliminar bien o servicio
    $("#divBtnsModalDel").on('click', '#btnConfirDelBnSv', function() {
        $('#divModalConfDel').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'eliminar/del_bn_sv.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    let id = 'tableBnSv';
                    reloadtable(id);
                    $('#divModalDone').modal('show');
                    $('#divMsgDone').html("Tipo de bien o servicio eliminado correctamente");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;
    });
})(jQuery);