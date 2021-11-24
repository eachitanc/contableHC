(function($) {
    //agregar usuario del sistema
    $("#btnAddUser").click(function() {
        let login = $("#txtlogin").val();
        let pass = $("#passuser").val();
        let rol = $("#slcRolUser").val();
        if (login === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Login  no puede estar vacio");
            return false;
        } else if (pass === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Contraseña no puede estar vacia");
            return false;
        } else if (rol === "0") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Debe elegir un Rol de usuario");
            return false;
        } else {
            let duser = $("#formAddUser").serialize();
            let passencrp = hex_sha512(pass);
            duser = duser + '&passu=' + passencrp;
            $.ajax({
                type: 'POST',
                url: window.urlin + '/usuarios/registrar/newuser.php',
                data: duser,
                success: function(r) {
                    switch (r) {
                        case '0':
                            $('#divModalAddUserError').modal('show');
                            $('#divAddUserMsgError').html("El Uusario ya se encuentra registrado");
                            break;
                        case '1':
                            $("#formAddUser")[0].reset();
                            $('#divModalAddUserDone').modal('show');
                            $('#divAddUserMsgDone').html("Usuario creado correctamente");
                            break;
                        default:
                            $('#divModalAddUserError').modal('show');
                            $('#divAddUserMsgError').html(r);
                            break;
                    }
                }
            });
            return false;
        }

    });
    //Actualizar usuario del sistema
    $("#btnUpUser").click(function() {
        let login = $("#txtUplogin").val();
        let pass = $("#passUpuser").val();
        if (login === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Login  no puede estar vacio");
            return false;
        } else if (pass === "") {
            $('#divModalAddUserError').modal('show');
            $('#divAddUserMsgError').html("Contraseña no puede estar vacia");
            return false;
        } else {
            let duser = $("#formAddUser").serialize();
            duser = duser + '&passUp=' + hex_sha512($('#passUpuser').val());
            $.ajax({
                type: 'POST',
                url: window.urlin + '/usuarios/actualizar/upuser.php',
                data: duser,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalAddUserDone').modal('show');
                        $('#divAddUserMsgDone').html("Usuario actualizado correctamente");
                    } else {
                        $('#divModalAddUserError').modal('show');
                        $('#divAddUserMsgError').html(r);
                    }
                }
            });
            return false;
        }

    });
    //Eliminar usuario (confirmar)
    $("#divDelUser button").click(function() {
        let idus = $(this).val();
        $.ajax({
            type: 'POST',
            url: window.urlin + '/usuarios/eliminar/confirdeluser.php',
            data: { idus: idus },
            success: function(r) {
                $('#divModalDelUserConfir').modal('show');
                $('#divdelUserMsgConfir').html(r);
            }
        });
        return false;
    });
    //Eliminar Usuario del sistema
    $("#btnConfirDelUser").click(function() {
        $('#divModalDelUserConfir').modal('hide');
        $.ajax({
            type: 'POST',
            url: window.urlin + '/usuarios/eliminar/deluser.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    $('#divModalAddUserDone').modal('show');
                    $('#divAddUserMsgDone').html("Registro eliminado correctamente");
                } else {
                    $('#divModalAddUserError').modal('show');
                    $('#divAddUserMsgError').html(r);
                }
            }
        });

    });
    //actualizar estado usuarios del sistema
    $("#tdEstUser button").click(function() {
        let idus = $(this).val();
        let divestM = "divIconoshow" + idus;
        let divestO = "divIcono" + idus;
        $('#' + divestM).hide();
        $.ajax({
            type: 'POST',
            url: window.urlin + '/usuarios/actualizar/upestado.php',
            data: { idus: idus },
            success: function(r) {
                $('#' + divestO).html(r);
                $('#' + divestO).show();
            }
        });
        return false;
    });
    $('.campo span').click(function() {
        let type = $('#passuser').attr('type');
        if (type === 'password') {
            $('#passuser').attr('type', 'text');
            $('#icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            $("#icon").css("color", "#E74C3C");
        } else {
            $('#passuser').attr('type', 'password');
            $('#icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            $("#icon").css("color", "#2ECC71");
        }
    });
})(jQuery);