(function($) {
    var consec = 0;
    //Agregar horas extra
    $("#btnModalError").click(function() {
        $('#divModalError').modal('hide');
    });
    $("#btnCancelDelHe").click(function() {
        $('#divConfirmdelHex').modal('hide');
    });
    $("#btnXErrorDel").click(function() {
        $('#divModalErrorDelHex').modal('hide');
    });
    //Registrar horas extra
    $("#btnAddHe").click(function() {
        let hdo = $("#numCantHeDo").val();
        let hno = $("#numCantHeNo").val();
        let rhno = $("#numRecCantHeNo").val();
        let hdd = $("#numCantHeDd").val();
        let rhdd = $("#numRecCantHeDd").val();
        let hnd = $("#numCantHeNd").val();
        let hhd = $("#numCantHeHd").val();
        if (hdo === "99" && hno === "99" && hdd === "99" && hnd === "99" && hhd === "99" && rhno === '99' && rhdd === '99') {
            $('#divModalError').modal('show');
            $('#divMsgError').html("¡Debe ingresar todos los campos!");
            return false;
        }
        let hoex = $("#formAddHe").serialize();
        $.ajax({
            type: 'POST',
            url: 'addhoras.php',
            data: hoex,
            success: function(r) {
                if (r === '1') {
                    $('#divModalExito').modal('show');
                    $('#divMsgExito').html("¡Horas extras registradas correctamente!");
                } else {
                    $('#divModalError').modal('show');
                    $('#divMsgError').html(r);
                }
            }
        });
        return false;

    });

    //eliminar horas extra (confirmar)
    $("#elimhoex button").click(function() {
        let idhoext = $(this).val();
        window.rowdel = $(this).closest("tr").get(0);
        $.ajax({
            type: 'POST',
            url: '../eliminar/confirdel.php',
            data: { idhoext: idhoext },
            success: function(r) {
                $('#divConfirmdelHex').modal('show');
                $('#divMsgConfirmDel').html(r);
            }
        });
        return false;
    });
    //Eliminar horas extras
    $("#btnModalConfdelHe").click(function() {
        $('#divConfirmdelHex').modal('hide');
        $.ajax({
            type: 'POST',
            url: '../eliminar/delhoraex.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    rowdel();
                    $('#divModalHoExitoExito').modal('show');
                    $('#divMsgExitoHoex').html("Registro eliminado correctamente");
                } else {
                    $('#divModalErrorDelHex').modal('show');
                    $('#divMsgErrorDel').html(r);
                }
            }
        });

    });
    //Actualizar horas extra
    $("#btnUpHoex").click(function() {
        let fli = $('#datFecLabHeIup').val();
        let flf = $('#datFecLabHeFup').val();
        let hli = $('#timeInicioHeup').val();
        let hlf = $('#timeFinHeup').val();
        if (fli > flf) {
            $('#divModalErrorUpHoEx').modal('show');
            $('#divMsgErrorUpHoEx').html("Fecha Inicial no puede ser menor que Fecha Final");
        } else if (hli === '') {
            $('#divModalErrorUpHoEx').modal('show');
            $('#divMsgErrorUpHoEx').html("Hora Inicial no puede ser vacía.");
        } else if (hlf === '') {
            $('#divModalErrorUpHoEx').modal('show');
            $('#divMsgErrorUpHoEx').html("Hora final no puede ser vacía.");
        } else {
            let dhoex = $("#formupHoex").serialize();
            $.ajax({
                type: 'POST',
                url: 'uphoex.php',
                data: dhoex,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalHoExDone').modal('show');
                        $('#divMsgDoneHoEx').html("Registro actualizado correctamente");
                    } else {
                        $('#divModalErrorUpHoEx').modal('show');
                        $('#divMsgErrorUpHoEx').html(r);
                    }
                }
            });
        }
        return false;
    });
    //Actualizar viaticos
    $("#btnUpViat").click(function() {
        let form = $(this).parents("#formUpViat");
        let check = checkCampos(form);
        if (!check) {
            $('#divModalErrorUpHoEx').modal('show');
            $('#divMsgErrorUpHoEx').html('Debe completar todos los campos.');
        } else {
            let dviat = $("#formUpViat").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/extras/viaticos/actualizar/upviat.php',
                data: dviat,
                success: function(r) {
                    if (r === '1') {
                        $('#divModalViatDone').modal('show');
                        $('#divMsgDoneViat').html("Registro actualizado correctamente");
                    } else {
                        $('#divModalErrorUpHoEx').modal('show');
                        $('#divMsgErrorUpHoEx').html(r);
                    }
                }
            });
        }
        return false;
    });
    //add row viaticos
    $("#btnModalErrorNewViat").click(function() {
        $('#divModalErrorNewViat').modal('hide');
    });
    $("#btnAddRowViat button").click(function() {
        let valxdia = $(this).val();
        consec++;
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/extras/viaticos/registrar/addrow.php',
            data: { consec: consec, valxdia: valxdia },
            success: function(r) {
                if (r !== '0') {
                    $('#fila' + consec).html(r);
                } else {
                    $('#divModalErrorNewViat').modal('show');
                    $('#divMsgErrorNewViat').html("No se admiten mas registros");
                }
            }
        });

        return false;
    });
    //Comprobar inputs vacios
    var checkCampos = function(obj) {
            let camposRellenados = true;
            obj.find("input").each(function() {
                let $this = $(this);
                if ($this.val().length <= 0) {
                    camposRellenados = false;
                    return false;
                }
            });
            if (camposRellenados == false) {
                return false;
            } else {
                return true;
            }
        }
        //add viaticos
    $("#btnModalExitoNewViat").click(function() {
        $('#divModalExitoNewViat').modal('hide');
    });
    $("#btnAddViat").click(function() {
        let form = $(this).parents("#formAddViat");
        let check = checkCampos(form);
        if ($("#txtDescViat").val() === "") {
            $('#divModalErrorNewViat').modal('show');
            $('#divMsgErrorNewViat').html("Debe Ingresar una descripción");
        } else if (!check) {
            $('#divModalErrorNewViat').modal('show');
            $('#divMsgErrorNewViat').html("Debe diligenciar todos los campos");
        } else {
            let dviat = $("#formAddViat").serialize();
            $.ajax({
                type: 'POST',
                url: window.urlin + '/nomina/extras/viaticos/registrar/addviaticos.php',
                data: dviat,
                success: function(r) {
                    switch (r) {
                        case '0':
                            $('#divModalErrorNewViat').modal('show');
                            $('#divMsgErrorNewViat').html("Empleado no registrado");
                            break;
                        case '1':
                            $("#formAddViat")[0].reset();
                            for (let i = 0; i <= consec; i++) {
                                $('#fila' + i).html("");
                            }
                            consec = 0;
                            $('#divModalExitoNewViat').modal('show');
                            $('#divMsgExitoNewviat').html("Viático(s) agregado(s) correctamente");
                            break;
                        default:
                            $('#divModalErrorNewViat').modal('show');
                            $('#divMsgErrorNewViat').html(r);
                            break;
                    }
                }
            });
        }
        return false;
    });
    //add row viaticos UP
    $("#btnModalErrorNewViat").click(function() {
        $('#divModalErrorNewViat').modal('hide');
    });
    $("#btnAddRowUpViat").click(function() {
        consec++;
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/extras/viaticos/actualizar/addrowupviat.php',
            data: { consec: consec },
            success: function(r) {
                if (r !== '0') {
                    $('#filaup' + consec).html(r);
                } else {
                    $('#divModalErrorUpHoEx').modal('show');
                    $('#divMsgErrorUpHoEx').html("No se admiten mas registros");
                }
            }
        });

        return false;
    });
    //eliminar Viaticos (confirmar)
    $("#elimviat button").click(function() {
        let iddetviat = $(this).val();
        window.rowdel = $(this).closest("tr").get(0);
        $.ajax({
            type: 'POST',
            url: '../eliminar/confirdelviat.php',
            data: { iddetviat: iddetviat },
            success: function(r) {
                $('#divConfirmdelViat').modal('show');
                $('#divMsgConfirmDelviat').html(r);
            }
        });
        return false;
    });
    $("#btnModalConfdelViat").click(function() {
        $('#divConfirmdelViat').modal('hide');
        $.ajax({
            type: 'POST',
            url: '../eliminar/delviatico.php',
            data: {},
            success: function(r) {
                if (r === '1') {
                    rowdel();
                    $('#divModalExitoDelViat').modal('show');
                    $('#divMsgExitoDelViat').html("Registro eliminado correctamente");
                } else {
                    $('#divModalErrorDelHex').modal('show');
                    $('#divMsgErrorDel').html(r);
                }
            }
        });

    });
    //Funcion para hacer los calculos de cantidad de horas extra
    var calhe = function(p, r) {
        let fli = $('#dat' + r + 'FecLabHe' + p + 'I').val();
        let flf = $('#dat' + r + 'FecLabHe' + p + 'F').val();
        let hei = $('#time' + r + 'InicioHe' + p).val();
        let hef = $('#time' + r + 'FinHe' + p).val();
        let tip = p;
        if (fli === '') {
            $('#time' + r + 'FinHe' + p).val('');
            $('#dat' + r + 'FecLabHe' + p + 'I').focus();
            $('#e' + r + 'FecLabHe' + p + 'I').show();
            setTimeout(function() {
                $('#e' + r + 'FecLabHe' + p + 'I').fadeOut(600);
            }, 800);
        } else if (flf === '') {
            $('#time' + r + 'FinHe' + p).val('');
            $("#dat' + r + 'FecLabHe" + p + 'F').focus();
            $('#e' + r + 'FecLabHe' + p + 'F').show();
            setTimeout(function() {
                $('#e' + r + 'FecLabHe' + p + 'F').fadeOut(600);
            }, 800);
        } else if (hei === '') {
            $('#time' + r + 'FinHe' + p).val('');
            $('#time' + r + 'InicioHe' + p).focus();
            $('#etime' + r + 'InicioHe' + p).show();
            setTimeout(function() {
                $('#etime' + r + 'InicioHe' + p).fadeOut(600);
            }, 800);
        } else if (fli > flf) {
            $('#time' + r + 'FinHe' + p).val('');
            $('#dat' + r + 'FecLabHe' + p + 'F').focus();
            $('#dat' + r + 'FecLabHe' + p + 'F').val('');
            $('#e' + r + 'FecMenor' + p).show();
            setTimeout(function() {
                $('#e' + r + 'FecMenor' + p).fadeOut(600);
            }, 800);
            $.ajax({
                type: 'POST',
                url: 'horasnull.php',
                data: { p: p, r: r },
                success: function(rs) {
                    $('#' + r + 'CantHe' + p).html(rs);
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: 'cal_he.php',
                data: { fli: fli, flf: flf, hei: hei, hef: hef, tip: tip, r: r },
                success: function(rs) {
                    if (rs === '0') {
                        $('#time' + r + 'FinHe' + p).focus();
                        $('#time' + r + 'FinHe' + p).val('');
                        $.ajax({
                            type: 'POST',
                            url: 'horasnull.php',
                            data: { p: p, r: r },
                            success: function(rs) {
                                $('#' + r + 'CantHe' + p).html(rs);
                            }
                        });
                        $('#e' + r + 'HoraMenor' + p).show();
                        setTimeout(function() {
                            $('#e' + r + 'HoraMenor' + p).fadeOut(600);
                        }, 800);

                    } else {
                        $('#' + r + 'CantHe' + p).html(rs);
                    }
                }
            });
        }
    };
    var comhe = function(p, r) {
        let fli = $('#dat' + r + 'FecLabHe' + p + 'I').val();
        let flf = $('#dat' + r + 'FecLabHe' + p + 'F').val();
        let hei = $('#time' + r + 'InicioHe' + p).val();
        let hef = $('#time' + r + 'FinHe' + p).val();
        if (fli === '' || flf === '' || hei === '' || hef === '') {
            $('#time' + r + 'FinHe' + p).val('');
            $.ajax({
                type: 'POST',
                url: 'horasnull.php',
                data: { p: p, r: r },
                success: function(rs) {
                    $('#' + r + 'CantHe' + p).html(rs);
                }
            });
        } else {
            calhe(p, r);
        }
    };
    var validarfec = function(p, r) {
        let fli = $('#dat' + r + 'FecLabHe' + p + 'I').val();
        let flf = $('#dat' + r + 'FecLabHe' + p + 'F').val();
        if (fli > flf) {
            $('#dat' + r + 'FecLabHe' + p + 'F').val('');
            $('#e' + r + 'FecMenor' + p).show();
            setTimeout(function() {
                $('#e' + r + 'FecMenor' + p).fadeOut(600);
            }, 800);
        } else {
            comhe(p, r);
        }
    };
    var validarhora = function(p) {
        $('#timeFinHe' + p).val('');
    };
    //Calcular Hora Extra Do
    $('#datFecLabHeDoI').on('input', function() {
        let tipo = 'Do';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeDoF').on('input', function() {
        let tipo = 'Do';
        let rec = '';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeInicioHeDo').on('input', function() {
        let tipo = 'Do';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    $('#timeFinHeDo').on('input', function() {
        let tipo = 'Do';
        let rec = '';
        calhe(tipo, rec);
        return false;
    });
    //Calcular Hora Extra No
    $('#timeFinHeNo').on('input', function() {
        let tipo = 'No';
        let rec = '';
        calhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeNoI').on('input', function() {
        let tipo = 'No';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeNoF').on('input', function() {
        let tipo = 'No';
        let rec = '';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeInicioHeNo').on('input', function() {
        let tipo = 'No';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    //Calcular Hora Extra Recargo Nocturno
    $('#timeRecFinHeNo').on('input', function() {
        let tipo = 'No';
        let rec = 'Rec';
        calhe(tipo, rec);
        return false;
    });
    $('#datRecFecLabHeNoI').on('input', function() {
        let tipo = 'No';
        let rec = 'Rec';
        comhe(tipo, rec);
        return false;
    });
    $('#datRecFecLabHeNoF').on('input', function() {
        let tipo = 'No';
        let rec = 'Rec';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeRecInicioHeNo').on('input', function() {
        let tipo = 'No';
        let rec = 'Rec';
        comhe(tipo, rec);
        return false;
    });
    //Calcular Hora Extra Dominical y festivo
    $('#timeFinHeDd').on('input', function() {
        let tipo = 'Dd';
        let rec = '';
        calhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeDdI').on('input', function() {
        let tipo = 'Dd';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeDdF').on('input', function() {
        let tipo = 'Dd';
        let rec = '';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeInicioHeDd').on('input', function() {
        let tipo = 'Dd';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    //Calcular Hora Extra Recargo Dominical y festivo
    $('#timeRecFinHeDd').on('input', function() {
        let tipo = 'Dd';
        let rec = 'Rec';
        calhe(tipo, rec);
        return false;
    });
    $('#datRecFecLabHeDdF').on('input', function() {
        let tipo = 'Dd';
        let rec = 'Rec';
        comhe(tipo, rec);
        return false;
    });
    $('#datRecFecLabHeDdF').on('input', function() {
        let tipo = 'Dd';
        let rec = 'Rec';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeRecInicioHeDd').on('input', function() {
        let tipo = 'Dd';
        let rec = 'Rec';
        comhe(tipo, rec);
        return false;
    });
    //Calcular Hora Extra Nd
    $('#timeFinHeNd').on('input', function() {
        let tipo = 'Nd';
        let rec = '';
        calhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeNdI').on('input', function() {
        let tipo = 'Nd';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeNdF').on('input', function() {
        let tipo = 'Nd';
        let rec = '';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeInicioHeNd').on('input', function() {
        let tipo = 'Nd';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    //Calcular Hora Extra Hd
    $('#timeFinHeHd').on('input', function() {
        let tipo = 'Hd';
        let rec = '';
        calhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeHdI').on('input', function() {
        let tipo = 'Hd';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    $('#datFecLabHeHdF').on('input', function() {
        let tipo = 'Hd';
        let rec = '';
        validarfec(tipo, rec);
        return false;
    });
    $('#timeInicioHeHd').on('input', function() {
        let tipo = 'Hd';
        let rec = '';
        comhe(tipo, rec);
        return false;
    });
    //Calcular actualizar
    var calheup = function() {
        let fli = $('#datFecLabHeIup').val();
        let flf = $('#datFecLabHeFup').val();
        let hei = $('#timeInicioHeup').val();
        let hef = $('#timeFinHeup').val();
        let tip = "";
        $.ajax({
            type: 'POST',
            url: window.urlin + '/nomina/extras/horas/registrar/cal_he.php',
            data: { fli: fli, flf: flf, hei: hei, hef: hef, tip: tip },
            success: function(r) {
                if (r === '0') {
                    $('#timeFinHeup').val('');
                    $('#etimeFinHeup').show();
                    setTimeout(function() {
                        $('#etimeFinHeup').fadeOut(600);
                    }, 800);
                    return false;
                } else {
                    $('#CantHeup').html(r);
                }
            }
        });
    };
    $('#datFecLabHeIup').on('input', function() {
        let fli = $('#datFecLabHeIup').val();
        let flf = $('#datFecLabHeFup').val();
        if (fli > flf) {
            $('#datFecLabHeIup').val('');
            $('#edatFecLabHeIup').show();
            setTimeout(function() {
                $('#edatFecLabHeIup').fadeOut(600);
            }, 800);
            return false;
        }
        calheup();
        return false;
    });
    $('#datFecLabHeFup').on('input', function() {
        let fli = $('#datFecLabHeIup').val();
        let flf = $('#datFecLabHeFup').val();
        if (fli > flf) {
            $('#datFecLabHeFup').val('');
            $('#edatFecLabHeFup').show();
            setTimeout(function() {
                $('#edatFecLabHeFup').fadeOut(600);
            }, 800);
            return false;
        }
        calheup();
        return false;
    });
    $('#timeInicioHeup').on('input', function() {
        calheup();
        return false;
    });
    $('#timeFinHeup').on('input', function() {
        calheup();
        return false;
    });
    var rowdel = function() {
        $(document).ready(function() {
            var table = $('.table').DataTable();
            table.row(window.rowdel).remove().draw();
        });
    };
})(jQuery);