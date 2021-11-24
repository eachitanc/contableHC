(function($) {
    //Agregar EPS
    $("#btnAddEps").click(function() {
        let nit = $("#txtNitEps").val();
        let nom = $("#txtNomEps").val();
        if (nit === "") {
            $('#divModalAddEpsError').modal('show');
            $('#divAddEpsMsgError').html("NIT  no puede estar vacio");
            return false;
        } else if (nom === "") {
            $('#divModalAddEpsError').modal('show');
            $('#divAddEpsMsgError').html("Nombre EPS no puede estar vacio");
            return false;
        } else {
            let deps = $("#formAddEps").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/seguridad_social/eps/registrar/neweps.php',
                data: deps,
                success: function(r) {
                    switch (r) {
                        case '0':
                            $('#divModalAddEpsError').modal('show');
                            $('#divAddEpsMsgError').html("EPS ya se encuentra registrada");
                            break;
                        case '1':
                            $("#formAddEps")[0].reset();
                            $('#divModalAddEpsDone').modal('show');
                            $('#divAddEpsMsgDone').html("EPS creada correctamente");
                            break;
                        default:
                            $('#divModalAddEpsError').modal('show');
                            $('#divAddEpsMsgError').html(r);
                            break;
                    }
                }
            });
            return false;
        }

    });
    //Actualizar EPS
    $("#btnUpEps").click(function() {
        let nit = $("#txtNitUpEps").val();
        let nom = $("#txtNomUpEps").val();
        if (nit === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("NIT  no puede estar vacio");
            return false;
        } else if (nom === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Nombre EPS no puede estar vacio");
            return false;
        } else {
            let deps = $("#formUpEps").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/seguridad_social/eps/actualizar/upeps.php',
                data: deps,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalAddUserDone').modal('show');
                        $('#divAddUserMsgDone').html("EPS actualizada correctamente");
                    } else {
                        $('#divModalAddUserError').modal('show');
                        $('#divAddUserMsgError').html(r);
                    }
                }
            });
            return false;
        }

    });
    //Eliminar EPS (confirmar)
    $("#divDelEps button").click(function() {
        let ideps = $(this).val();
        window.rowdel = $(this).closest("tr").get(0);
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/seguridad_social/eps/eliminar/confirdeleps.php',
            data: { ideps: ideps },
            success: function(r) {
                $('#divModalDelUserConfir').modal('show');
                $('#divdelUserMsgConfir').html(r);
            }
        });
        return false;
    });
    //Eliminar EPS
    $("#btnConfirDelEPS").click(function() {
        $('#divModalDelUserConfir').modal('hide');
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/seguridad_social/eps/eliminar/deleps.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    rowdel();
                    $('#divModalAddUserDone').modal('show');
                    $('#divAddUserMsgDone').html("Registro eliminado correctamente");
                } else {
                    $('#divModalAddUserError').modal('show');
                    $('#divAddUserMsgError').html(r);
                }
            }
        });

    });
    //Registrar ARL
    $("#btnAddArl").click(function() {
        let nit = $("#txtNitArl").val();
        let nom = $("#txtNomArl").val();
        if (nit === "") {
            $('#divModalAddEpsError').modal('show');
            $('#divAddArlMsgError').html("NIT  no puede estar vacio");
            return false;
        } else if (nom === "") {
            $('#divModalAddEpsError').modal('show');
            $('#divAddArlMsgError').html("Nombre ARL no puede estar vacio");
            return false;
        } else {
            let darl = $("#formAddArl").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/seguridad_social/arl/registrar/newarl.php',
                data: darl,
                success: function(r) {
                    switch (r) {
                        case '0':
                            $('#divModalAddEpsError').modal('show');
                            $('#divAddArlMsgError').html("ARL ya se encuentra registrada");
                            break;
                        case '1':
                            $("#formAddArl")[0].reset();
                            $('#divModalAddEpsDone').modal('show');
                            $('#divAddArlMsgDone').html("ARL creada correctamente");
                            break;
                        default:
                            $('#divModalAddEpsError').modal('show');
                            $('#divAddArlMsgError').html(r);
                            break;
                    }
                }
            });
            return false;
        }

    });
    //Actualizar ARL
    $("#btnUpArl").click(function() {
        let nit = $("#txtNitUpArl").val();
        let nom = $("#txtNomUpArl").val();
        if (nit === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("NIT  no puede estar vacio");
            return false;
        } else if (nom === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Nombre ARL no puede estar vacio");
            return false;
        } else {
            let darl = $("#formUpArl").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/seguridad_social/arl/actualizar/uparl.php',
                data: darl,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalAddUserDone').modal('show');
                        $('#divAddUserMsgDone').html("ARL actualizada correctamente");
                    } else {
                        $('#divModalAddUserError').modal('show');
                        $('#divAddUserMsgError').html(r);
                    }
                }
            });
            return false;
        }

    });
    //Eliminar ARL (confirmar)
    $("#divDelArl button").click(function() {
        let idarl = $(this).val();
        window.rowdel = $(this).closest("tr").get(0);
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/seguridad_social/arl/eliminar/confirdelarl.php',
            data: { idarl: idarl },
            success: function(r) {
                $('#divModConfirmar').modal('show');
                $('#divMsgConfir').html(r);
            }
        });
        return false;
    });
    //Eliminar ARL
    $("#btnConfirDelArl").click(function() {
        $('#divModConfirmar').modal('hide');
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/seguridad_social/arl/eliminar/delarl.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    rowdel();
                    $('#divModDone').modal('show');
                    $('#divMsgDone').html("Registro eliminado correctamente");
                } else {
                    $('#divModError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });

    });
    //Registrar AFP
    $("#btnAddAfp").click(function() {
        let nit = $("#txtNitAfp").val();
        let nom = $("#txtNomAfp").val();
        if (nit === "") {
            $('#divModalAddEpsError').modal('show');
            $('#divAddAfpMsgError').html("NIT  no puede estar vacio");
            return false;
        } else if (nom === "") {
            $('#divModalAddEpsError').modal('show');
            $('#divAddAfpMsgError').html("Nombre AFP no puede estar vacio");
            return false;
        } else {
            let dafp = $("#formAddAfp").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/seguridad_social/afp/registrar/newafp.php',
                data: dafp,
                success: function(r) {
                    switch (r) {
                        case '0':
                            $('#divModalAddEpsError').modal('show');
                            $('#divAddAfpMsgError').html("AFP ya se encuentra registrada");
                            break;
                        case '1':
                            $("#formAddAfp")[0].reset();
                            $('#divModalAddEpsDone').modal('show');
                            $('#divAddAfpMsgDone').html("AFP creada correctamente");
                            break;
                        default:
                            $('#divModalAddEpsError').modal('show');
                            $('#divAddAfpMsgError').html(r);
                            break;
                    }
                }
            });
            return false;
        }
    });
    //Actualizar AFP
    $("#btnUpAfp").click(function() {
        let nit = $("#txtNitUpAfp").val();
        let nom = $("#txtNomUpAfp").val();
        if (nit === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("NIT  no puede estar vacio");
            return false;
        } else if (nom === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Nombre AFP no puede estar vacio");
            return false;
        } else {
            let dafp = $("#formUpAfp").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/seguridad_social/afp/actualizar/upafp.php',
                data: dafp,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalAddUserDone').modal('show');
                        $('#divAddUserMsgDone').html("AFP actualizada correctamente");
                    } else {
                        $('#divModalAddUserError').modal('show');
                        $('#divAddUserMsgError').html(r);
                    }
                }
            });
            return false;
        }

    });
    //Eliminar AFP (confirmar)
    $("#divDelAfp button").click(function() {
        let idafp = $(this).val();
        window.rowdel = $(this).closest("tr").get(0);
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/seguridad_social/afp/eliminar/confirdelafp.php',
            data: { idafp: idafp },
            success: function(r) {
                $('#divModConfirmar').modal('show');
                $('#divMsgConfir').html(r);
            }
        });
        return false;
    });
    //Eliminar AFP
    $("#btnConfirDelAfp").click(function() {
        $('#divModConfirmar').modal('hide');
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/seguridad_social/afp/eliminar/delafp.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    rowdel();
                    $('#divModDone').modal('show');
                    $('#divMsgDone').html("Registro eliminado correctamente");
                } else {
                    $('#divModError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });

    });
    var rowdel = function() {
        $(document).ready(function() {
            var table = $('.table').DataTable();
            table.row(window.rowdel).remove().draw();
        });
    };
})(jQuery);