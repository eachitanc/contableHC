let timeout;
let actual = "EAC" + window.location + 'II';
let esta = actual.indexOf('index')
if (esta === -1) {
    document.onmousemove = function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: window.urlin + '/cerrar_sesion.php',
                success: function(r) {
                    $('#divModalXSesion').modal('show');

                }
            });
        }, 600000);
    }
}
(function($) {
    "use strict";
    $("#sidebarToggle").click(function() {
        let val = $(this).val();
        $.ajax({
            type: 'POST',
            url: window.urlin + '/actualizar/hidenav.php',
            data: { val: val }
        });
        $("body").toggleClass("sb-sidenav-toggled");
        let a = $('.sb-nav-fixed').hasClass('sb-sidenav-toggled');
        if (a) {
            $('#navlateralSH').removeClass('fa-bars');
            $('#navlateralSH').addClass('fa-ellipsis-v');
        } else {
            $('#navlateralSH').removeClass('fa-ellipsis-v');
            $('#navlateralSH').addClass('fa-bars');
        }
    });

    $("#btnLogin").click(function() {
        let user = $("#txtUser").val();
        let pass = $("#passuser").val();
        if (user === "") {
            $('#divModalError').modal('show');
            $('#divErrorLogin').html("Debe ingresar Usuario");
        } else if (pass === "") {
            $('#divModalError').modal('show');
            $('#divErrorLogin').html("Debe ingresar Contraseña");
        } else {
            pass = hex_sha512(pass);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'validarLogin.php',
                data: { user: user, pass: pass }
            }).done(function(res) {
                switch (res.mensaje) {
                    case 0:
                        $('#divModalError').modal('show');
                        $('#divErrorLogin').html("Usuario y/o Contraseña incorrecto(s)");
                        break;
                    case 1:
                        window.location = "vigencia.php";
                        break;
                    case 2:
                        window.location = "terceros/gestion/detalles_tercero.php";
                        break;
                    case 3:
                        $('#divModalError').modal('show');
                        $('#divErrorLogin').html("Usuario suspendido temporalmente");
                        break;
                    default:
                        break;
                }
            });
        }
        return false;
    });

    $("#btnEntrar").click(function() {
        var emp = $("#slcEmpresa").val();
        var vig = $("#slcVigencia").val();
        if (emp === '0') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Debe selecionar una empresa');
        } else if (vig === '0') {
            $('#divModalError').modal('show');
            $('#divMsgError').html('Debe selecionar una vigencia');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'variablesinicio.php',
                data: { vig: vig }
            }).done(function(res) {
                if (res === 1) {
                    window.location = "inicio.php";
                }
            });
        }
        return false;
    });
    $("#btnUpEmpresa").click(function() {
        let nit = $("#txtUplogin").val();
        let nombre = $("#passUpuser").val();
        if (nit === "") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("NIT no puede ser vacio");
            return false;
        } else if (nombre === "") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Nombre no puede ser vacio");
            return false;
        } else {
            let dempresa = $("#formUpEmpresa").serialize();
            $.ajax({
                type: 'POST',
                url: 'upempresa.php',
                data: dempresa,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Empresa actualizada correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
            return false;
        }

    });
    var setIdioma = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ - _END_ registros de _TOTAL_ ",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ entradas en total )",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "_MENU_ Registros",
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
    //Registar Actividad Economica desde Detalles
    $('#hrefPermisos').on('click', function() {
        $.post(window.urlin + "/actualizar/datos_up_permisos.php", function(he) {
            $('#divTamModalPermisos').removeClass('modal-xl');
            $('#divTamModalPermisos').removeClass('modal-sm');
            $('#divTamModalPermisos').addClass('modal-lg');
            $('#divModalPermisos').modal('show');
            $("#divTablePermisos").html(he);
        });
    });
    $("#divTablePermisos").on('click', 'span', function() {
        let caden = $(this).attr('value');
        let cad = caden.split("|");
        let est = cad[0] == 'SI' ? '1' : '0';
        let id = cad[1];
        let perm = cad[2];
        if (est === '1') {
            $(this).removeClass('fa-check-circle');
            $(this).removeClass('circle-verde');
            $(this).addClass('fa-times-circle');
            $(this).addClass('circle-rojo');
            $(this).attr('value', 'NO|' + id + '|' + perm)
        } else {
            $(this).removeClass('fa-times-circle');
            $(this).removeClass('circle-rojo');
            $(this).addClass('fa-check-circle');
            $(this).addClass('circle-verde');
            $(this).attr('value', 'SI|' + id + '|' + perm)
        }
        $.ajax({
            type: 'POST',
            url: window.urlin + '/actualizar/uppermisos.php',
            data: { est: est, id: id, perm: perm },
            success: function(r) {
                if (r !== '1') {
                    alert(r + ' Recargar Página');
                }
            }
        });
        return false;
    });
    $('#fullscreen a').click(function() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
            $('#iconFS').removeClass('fas fa-expand-arrows-alt fa-lg').addClass('fas fa-compress-arrows-alt fa-lg');
            $('#iconFS').attr('title', 'Reducir')
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
            $('#iconFS').removeClass('fas fa-compress-arrows-alt fa-lg').addClass('fas fa-expand-arrows-alt fa-lg');
            $('#iconFS').attr('title', 'Ampliar')
        }
    });
    //Actualizar Perfil usuario del sistema
    $("#btnUpUserPerfil").click(function() {
        let login = $("#txtUsuario").val();
        if (login === "") {
            $('#divModalError').modal('show');
            $('#divMsgError').html("Login  no puede estar vacio");
        } else {
            let duser = $("#formUpUser").serialize();
            $.ajax({
                type: 'POST',
                url: 'upuser.php',
                data: duser,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalDone').modal('show');
                        $('#divMsgDone').html("Usuario actualizado correctamente");
                    } else {
                        $('#divModalError').modal('show');
                        $('#divMsgError').html(r);
                    }
                }
            });
            return false;
        }

    });
    //ocultar navsuperior
    /*
    $(document).ready(function() {
        let lastScrollTop = 0;
        $(window).scroll(function(event) {
            let st = $(this).scrollTop();
            if (st < lastScrollTop) {
                $('#navMenu').removeClass('scrolled-down');
                $('#navMenu').addClass('scrolled-up');
            } else {
                $('#navMenu').removeClass('scrolled-up');
                $('#navMenu').addClass('scrolled-down');
            }
            lastScrollTop = st;
        });
    });
    */
    $('.table-hover tbody').on('dblclick', 'tr', function() {
        let table = $('.table-hover').DataTable();
        if ($(this).hasClass('selecionada')) {
            $(this).removeClass('selecionada');
        } else {
            table.$('tr.selecionada').removeClass('selecionada');
            $(this).addClass('selecionada');
        }
    });
    $('#dataTableLiqNom tbody').on('dblclick', 'tr', function() {
        let table = $('#dataTableLiqNom').DataTable();
        if ($(this).hasClass('selecionada')) {
            $(this).removeClass('selecionada');
        } else {
            table.$('tr.selecionada').removeClass('selecionada');
            $(this).addClass('selecionada');
        }
    });
    $(document).ready(function() {
        let id = $('#idEmpNovEps').val();
        $('#dataTableLiqNom').DataTable({
            scrollY: false,
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: {
                left: 1
            },
            language: setIdioma,
        });
        $('#dataTable').DataTable({
            "autoWidth": false,
            language: setIdioma,
            "pageLength": 10,
        });
        $('#dataTablePermiso').DataTable({
            "autoWidth": true,
            language: setIdioma,
            paging: false,
        });
        //dataTable EPS
        $('#tableEps').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_eps.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': "nombre_eps" },
                { 'data': "nit" },
                { 'data': "fec_afiliacion" },
                { 'data': 'fec_retiro' },
                { 'data': 'botones' },
            ],
            "order": [
                [2, "asc"]
            ]
        });
        $('#tableEps').wrap('<div class="overflow" />');
        //dataTable ARL
        $('#tableArl').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_arl.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': "nombre_arl" },
                { 'data': "nitarl" },
                { 'data': "riesgo" },
                { 'data': "fec_afiliacion" },
                { 'data': 'fec_retiro' },
                { 'data': 'botones' },
            ],
            "order": [
                [3, "asc"]
            ]
        });
        $('#tableArl').wrap('<div class="overflow" />');
        //dataTable AFP
        $('#tableAfp').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_afp.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': "nombre_afp" },
                { 'data': "nitafp" },
                { 'data': "fec_afiliacion" },
                { 'data': 'fec_retiro' },
                { 'data': 'botones' },
            ],
            "order": [
                [2, "asc"]
            ]
        });
        $('#tableAfp').wrap('<div class="overflow" />');
        //dataTable Libranza
        $('#tableLibranza').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_libranza.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': 'nom_banco' },
                { 'data': 'valor_total' },
                { 'data': 'cuotas' },
                { 'data': 'val_mes' },
                { 'data': 'porcentaje' },
                { 'data': 'val_pagado' },
                { 'data': 'cuotas_pag' },
                { 'data': 'fecha_inicio' },
                { 'data': 'fecha_fin' },
                { 'data': 'botones' },
            ],
            "order": [
                [7, "asc"]
            ]
        });
        $('#tableLibranza').wrap('<div class="overflow" />');
        //dataTable Embargo
        $('#tableEmbargo').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_embargo.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': 'juzgado' },
                { 'data': 'valor_total' },
                { 'data': 'porcentaje' },
                { 'data': 'val_mes' },
                { 'data': 'val_pagado' },
                { 'data': 'fecha_inicio' },
                { 'data': 'fecha_fin' },
                { 'data': 'botones' },
            ],
            "order": [
                [5, "asc"]
            ]
        });
        $('#tableEmbargo').wrap('<div class="overflow" />');
        //dataTable Sindicato
        $('#tableSindicato').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_sindicato.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': 'sindicato' },
                { 'data': 'porcentaje' },
                { 'data': 'cantidad_aportes' },
                { 'data': 'total_aportes' },
                { 'data': 'fec_inicio' },
                { 'data': 'fec_fin' },
                { 'data': 'botones' },
            ],
            "order": [
                [5, "asc"]
            ]
        });
        $('#tableSindicato').wrap('<div class="overflow" />');
        //dataTable Incapacidad
        $('#tableIncapacidad').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_incapacidad.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': 'tipo' },
                { 'data': 'fec_inicio' },
                { 'data': 'fec_fin' },
                { 'data': 'dias' },
                { 'data': 'valor' },
                { 'data': 'botones' },
            ],
            "order": [
                [1, "asc"]
            ]
        });
        $('#tableIncapacidad').wrap('<div class="overflow" />');
        //dataTable Vacaciones
        $('#tableVacaciones').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_vacaciones.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': 'anticipada' },
                { 'data': 'fec_inicio' },
                { 'data': 'fec_fin' },
                { 'data': 'dias_inactivo' },
                { 'data': 'dias_hab' },
                { 'data': 'botones' },
            ],
            "order": [
                [1, "asc"]
            ]
        });
        $('#tableVacaciones').wrap('<div class="overflow" />');
        //dataTable Licencia
        $('#tableLicencia').DataTable({
            language: setIdioma,
            "ajax": {
                url: 'datos/listar/datos_licencia.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
            },
            "columns": [
                { 'data': 'fec_inicio' },
                { 'data': 'fec_fin' },
                { 'data': 'dias_inactivo' },
                { 'data': 'dias_hab' },
                { 'data': 'botones' },
            ],
            "order": [
                [0, "asc"]
            ]
        });
        $('#tableLicencia').wrap('<div class="overflow" />');
    });
})(jQuery);

function elegirmes(id) {
    if (id > 0) {
        document.forms[0].submit();
    }
}