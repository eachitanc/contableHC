<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>CONTAFACIL</title>

    <style type="text/css">
      .Estilo2 {
        font-size: 9px
      }

      .Estilo4 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }

      a {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
      }

      a:link {
        text-decoration: none;
      }

      a:visited {
        text-decoration: none;
        color: #666666;
      }

      a:hover {
        text-decoration: underline;
        color: #666666;
      }

      a:active {
        text-decoration: none;
        color: #666666;
      }

      .Estilo7 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 9px;
        color: #666666;
      }
    </style>

    <style>
      .fc_main {
        background: #FFFFFF;
        border: 1px solid #000000;
        font-family: Verdana;
        font-size: 10px;
      }

      .fc_date {
        border: 1px solid #D9D9D9;
        cursor: pointer;
        font-size: 10px;
        text-align: center;
      }

      .fc_dateHover,
      TD.fc_date:hover {
        cursor: pointer;
        border-top: 1px solid #FFFFFF;
        border-left: 1px solid #FFFFFF;
        border-right: 1px solid #999999;
        border-bottom: 1px solid #999999;
        background: #E7E7E7;
        font-size: 10px;
        text-align: center;
      }

      .fc_wk {
        font-family: Verdana;
        font-size: 10px;
        text-align: center;
      }

      .fc_wknd {
        color: #FF0000;
        font-weight: bold;
        font-size: 10px;
        text-align: center;
      }

      .fc_head {
        background: #000066;
        color: #FFFFFF;
        font-weight: bold;
        text-align: left;
        font-size: 11px;
      }
    </style>
    <style type="text/css">
      table.bordepunteado1 {
        border-style: solid;
        border-collapse: collapse;
        border-width: 2px;
        border-color: #004080;
      }

      .Estilo9 {
        color: #FFFFFF
      }

      .Estilo12 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }

      .Estilo12 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }

      .Estilo10 {
        color: #F5F5F5
      }
    </style>
    <!--muestra - oculta naturales -->
    <SCRIPT language="javascript">
      function MostrarOcultar(objetoVisualizar) {


        if (document.all['naturales'].style.display == 'none') {
          document.all['naturales'].style.display = 'block';
          document.a.ter_nat.disabled = false;
          document.all['juridicos'].style.display = 'none';
          document.a.ter_jur.disabled = true;
        } else {
          document.a.ter_nat.disabled = true;
          document.a.ter_jur.disabled = true;
          document.all['naturales'].style.display = 'none';
          document.all['juridicos'].style.display = 'none';
        }
      }
    </SCRIPT>
    <!--muestra - oculta juridicos -->
    <SCRIPT language="javascript">
      function MostrarOcultar2(objetoVisualizar) {

        if (document.all['juridicos'].style.display == 'none') {
          document.all['naturales'].style.display = 'none';
          document.a.ter_nat.disabled = true;
          document.all['juridicos'].style.display = 'block';
          document.a.ter_jur.disabled = false;
        } else {
          document.a.ter_nat.disabled = true;
          document.a.ter_jur.disabled = true;
          document.all['naturales'].style.display = 'none';
          document.all['juridicos'].style.display = 'none';
        }

      }
    </SCRIPT>


    <script>
      function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
        patron = /\d/; //ver nota 
        te = String.fromCharCode(tecla);
        return patron.test(te);
      }
    </script>

    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type='text/javascript' src='jquery.autocomplete.js'></script>


    <script>
      function chk_pgcp1() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp1').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp2() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp2').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado2').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp3() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp3').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado3').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp4() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp4').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado4').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp5() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp5').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado5').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp6() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp6').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado6').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp7() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp7').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado7').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp8() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp8').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado8').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp9() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp9').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado9').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp10() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp10').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado10').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>
    <script>
      function chk_pgcp11() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp11').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado11').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp12() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp12').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado12').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp13() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp13').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado13').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp14() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp14').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado14').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp15() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp15').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado15').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>



    <!--validacion de forms-->
    <script type="text/javascript" src="../jquery.validate.js"></script>
    <style type="text/css">
      * {
        font-family: Verdana;
        font-size: 10px;
      }

      label {
        width: 10em;
        float: left;
      }

      label.error {
        float: none;
        color: red;
        padding-left: .5em;
        vertical-align: top;
      }

      p {
        clear: both;
      }

      .submit {
        margin-left: 12em;
      }

      em {
        font-weight: bold;
        padding-right: 1em;
        vertical-align: top;
      }

      .Estilo10 {
        color: #990000;
        font-style: italic;
      }
    </style>

    <script>
      $(document).ready(function() {
        $("#commentForm").validate();
      });
    </script>

    <script>
      function chk_crpp() {
        var pos_url = '../comprobadores/comprueba_crpp.php';
        var cod = document.getElementById('crpp').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4) {
              document.getElementById('res_crpp').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>





    <script>
      var contt;
      var contad;


      function validarValor() {

        for (iii = 0; iii < contad; iii++) {

          var valor_digitado = parseFloat(document.getElementById("vr_digitado" + iii).value);
          var valor_original = parseFloat(document.getElementById("vr_original" + iii).value);
          var valor_obligado = parseFloat(document.getElementById("obligado" + iii).value);
          valor = valor_original - valor_digitado - valor_obligado;
          if (valor < 0) {
            valor2 = valor_original - valor_obligado;
            valor3 = Math.round(valor2 * 100) / 100;
            alert("El valor que intenta registrar es mayor al saldo pendiente");
            document.getElementById("vr_digitado" + iii).value = valor3;
            document.getElementById("vr_deb_1" + iii).value = valor3;
            document.getElementById("vr_cre_2" + iii).value = valor3;
          } else {

            for (ii = 0; ii < contt; ii++) {

              var valor = document.getElementById("vr_digitado" + ii).value;
              document.getElementById("vr_deb_1" + ii).value = valor;
              document.getElementById("vr_cre_2" + ii).value = valor;

            }
          }


        }

      }


      function consecutivo2() {
        var fec = document.getElementById('fecha_crpp').value;
        var pos_url2 = 'consultas/concec_crpp.php';
        var req1 = new XMLHttpRequest();
        if (req1) {
          req1.onreadystatechange = function() {
            if (req1.readyState == 4) {
              var dato = req1.responseText;
              var elem = dato.split(',');
              concec = elem[0];
              fecha2 = elem[1];
              document.getElementById('crpp').value = concec;
              if (fec != fecha2) {
                alert("Fecha sugerida para el consecutivo disponible: " + fecha2);
              }
            }
          }
          req1.open('POST', pos_url2 + '?cod=' + fec, true);
          req1.send(null);
        }

      }
      var fecha_reg;

      function validar_form() {
        var fecha_crpp = document.getElementById('fecha_crpp').value;
        if (fecha_crpp < fecha_reg) {
          alert("La fecha del Registro es menor a la fecha del CDPP");
          document.getElementById('fecha_crpp').focus();
          return false;
        }

        var crpp = document.getElementById('crpp').value;
        if (crpp == '') {
          alert("Falta determinar el n�mero de consecutivo del registro");
          document.getElementById('crpp').focus();
          return false;
        }
        var crpp_ctrl = document.getElementById('res_crpp').innerHTML;
        if (crpp_ctrl == null) {
          alert("El n�mero de consecutivo ya fue utilizado");
          document.getElementById('crpp').focus();
          return false;
        }

        var ter_nat = document.getElementById('ter_nat').value;
        var ter_jur = document.getElementById('ter_jur').value;
        if (ter_nat == '' && ter_jur == '') {
          alert("Falta seleccionar un tercero");
          return false;
        }


        return true;
      }

      $().ready(function() {
        $("#tercero").autocomplete("terceros.php", {
          width: 500,
          matchContains: true,
          mustMatch: true,
          //minChars: 0,
          multiple: true,
          //highlight: false,
          //multipleSeparator: " ",
          selectFirst: false
        });
        $("#tercero").result(function(event, data, formatted) {
          $("#valtercero").val(data[1]);
        });
      });
    </script>
    <!--fin val forms-->
  </head>

  <body onload=" consecutivo2();">
    <table width="800" border="0" align="center">
      <tr>

        <td colspan="3">
          <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
            <div align="center">
              <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
            </div>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="3">
          <?php

          $id = $_GET['a'];
          $id_aux = $id;

          include('../config.php');
          $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
          $sqlxx = "select * from fecha";
          $resultadoxx = $connectionxx->query($sqlxx);

          while ($rowxx = $resultadoxx->fetch_assoc()) {

            $idxx = $rowxx["id_emp"];
            $id_emp = $rowxx["id_emp"];
            $ano = $rowxx["ano"];
          }
          ?>
          <div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">


            <div align="center"><br />
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <span class="Estilo4"><strong>CERTIFICADO DE REGISTRO PRESUPUESTAL<BR />
                    ...::: CRPP :::...
                  </strong></span></div>
              <?php

              $cx = new mysqli($server, $dbuser, $dbpass, $database);
              $resulta = $cx->query("SHOW TABLE STATUS FROM $database LIKE 'crpp'");
              while ($array = $resulta->fetch_assoc()) {
                $consecutivo = $array['Auto_increment'];
              }

              ?><br />
              <form name="a" method="post" id="commentForm" action="p_crpp.php">
                <table width="800" border="1" align="center" class="bordepunteado1">
                  <tr>
                    <td width="200"></td>
                    <td width="200"></td>
                    <td width="200"></td>
                    <td width="200"></td>
                  </tr>
                  <tr>
                    <td bgcolor="#F5F5F5">
                      <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="right"><span class="Estilo4"><strong>Fecha de Registro del CRPP :</strong> </span></div>
                      </div>
                    </td>

                    <script type="text/javascript">
                      function mostrarVentana() {
                        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
                        var x = screen.width;
                        ventana.style.marginTop = "200px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
                        ventana.style.marginLeft = x - 300; //((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
                        ventana.style.display = 'block'; // Y lo hacemos visible
                        parent.frames['datamain'].window.location.reload();

                      }

                      function ocultarVentana() {
                        var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
                        ventana.style.display = 'none'; // Y lo hacemos invisible
                      }
                    </script>
                    <?php
                    include('../config.php');
                    $cx = new mysqli($server, $dbuser, $dbpass, $database);
                    $sql3 = $cx->query("select * from cdpp where consecutivo ='$id'");
                    $rw2 = $sql3->fetch_assoc();
                    $fecha_cdpp = $rw2["fecha_reg"];
                    ?>
                    <td colspan="2">
                      <div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="left">
                          <input name="fecha_crpp" type="text" class="required Estilo4" id="fecha_crpp" value="<?php printf("%s", $fecha_cdpp); ?>" size="12" onchange="consecutivo2();" />
                          <span class="Estilo9">:::</span>
                          <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_crpp,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
                        </div>
                      </div>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#F5F5F5">
                      <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="right"><span class="Estilo12"><strong>Consecutivo del Sistema :</strong> </span></div>
                      </div>
                    </td>
                    <td>
                      <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                        <div align="center" class="Estilo12">
                          <div align="center"><?php printf("%s", $consecutivo); ?></div>
                        </div>
                      </div>
                    </td>
                    <td bgcolor="#F5F5F5">
                      <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                        <div align="center" class="Estilo4">
                          <div align="right"><strong>Digite Numero de CRPP : </strong></div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="center">
                          <input name="crpp" type="text" class="required Estilo4" id="crpp" size="20" onkeypress="return validar(event)" style="text-align:center" onkeyup="chk_crpp();" />
                          <a href="javascript:mostrarVentana();">Mas</a>
                          <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
                            <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">CDPP</div>
                            <iframe id="datamain" src="crppconsecutivo.php" width="200" height="250" marginwidth="0" marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
                            <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 6px;">
                              <input id="btnAceptar" onclick="ocultarVentana();" name="btnAceptar" size="20" type="button" value=".:ok:." />
                            </div>
                          </div>
                          <br />

                          <div align="center" id='res_crpp'></div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#F5F5F5">
                      <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="left" class="Estilo4">
                          <div align="right"><strong>SELECCIONE TERCERO : </strong></div>
                        </div>
                      </div>
                    </td>
                    <td colspan="3" align="left">
                      <div style="padding-left:10px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
                        <input type='text' name='tercero' class='Estilo4' id='tercero' size='70' /> &nbsp;<a href="../terceros/terceros.php" target="_new">Nuevo</a>
                        <input type='hidden' name='valtercero' id='valtercero' />
                      </div>
                    </td>



        </td>
      </tr>
      <tr>
        <?php
        $sql0 = "select distinct(consecutivo), fecha_reg, ter_nat, ter_jur, tercero, des, cdpp from cdpp where id_emp ='$id_emp' and consecutivo = '$id' ";
        $resultado0 = $connectionxx->query($sql0);
        while ($row0 = $resultado0->fetch_assoc()) {

          $fecha_reg = $row0["fecha_reg"];
          $ter_nat = $row0["ter_nat"];
          $ter_jur = $row0["ter_jur"];
          $tercero = $row0["tercero"];
          $des = $row0["des"];
          $cdpp = $row0["cdpp"];

          // onkeyup="a.detalle_crpp.value=a.detalle_crpp.value.toUpperCase()  matusculas

        }
        ?>
        <td bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>CONCEPTO - DETALLE CRPP: </strong></div>
            </div>
          </div>
        </td>
        <td colspan="3">
          <div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left">
                <textarea name="detalle_crpp" class="required Estilo4" id="detalle_crpp" rows="4" cols="80"><?php print($des); ?></textarea>
              </div>
            </div>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="4" bgcolor="#DCE9E5">
          <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
            <div align="center" class="Estilo4">
              <div align="center"><strong>INFORMACION GENERAL DE LA DISPONIBILIDAD PRESUPUESTAL </strong></div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>No. CDPP : </strong></div>
            </div>
          </div>
        </td>
        <td>
          <div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left">CDPP<?php printf("%s", $cdpp); ?>
                <input name="id_manu_cdpp" type="hidden" class="Estilo4" id="id_manu_cdpp" value="<?php printf("%s", $cdpp); ?>" />
              </div>
            </div>
          </div>
        </td>
        <td><input name="id_auto_cdpp" type="hidden" class="Estilo4" id="id_auto_cdpp" value="<?php printf("%s", $id); ?>" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>FECHA CDPP : </strong></div>
            </div>
          </div>
        </td>
        <td>
          <div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left"><?php printf("%s", $fecha_reg); ?>
                <input name="fecha_cdpp" type="hidden" class="Estilo4" id="fecha_cdpp" value="<?php printf("%s", $fecha_reg); ?>" />
              </div>
            </div>
          </div>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>DESCRIPCION DEL CDPP : </strong></div>
            </div>
          </div>
        </td>
        <td colspan="3">
          <div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="left"><?php printf("%s", $des); ?>
                <input name="des_cdpp" type="hidden" class="Estilo4" id="des_cdpp" value="<?php printf("%s", $des); ?>" />
              </div>
            </div>
          </div>
        </td>
      </tr>
    </table>
    <br />
    <table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="900" colspan="4" bgcolor="#DCE9E5">
          <div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
            <div align="center" class="Estilo4"><strong>DATOS DEL CERTIFICADO DE REGISTRO PRESUPUESTAL </strong></div>
          </div>
        </td>
      </tr>
    </table>
    <br />
    <?php
    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
    $sq = "select sum(valor) as valor, cuenta,consecutivo from cdpp where id_emp = '$id_emp' and consecutivo ='$id' group by cuenta ";
    $re = $cx->query($sq);

    printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#F5F5F5'>
<td align='center' width='200'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='300'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center' width='150'><span class='Estilo4'><b>VALOR x REGISTRAR</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR REGISTRADO</b></span></td>
<td align='center' width='120'><span class='Estilo4'><b>SIT. DE FONDOS</b></span></td>
</tr>
");

    $contador = 0;
    $contador2 = 0;
    $total = 0;
    $vr1x = 0;
    $vr2x = 0;
    while ($rw = $re->fetch_assoc()) {

      //***** CONSULTA SITUACION DE FONDOS   
      $cta = $rw["cuenta"];
      $sqlx1 = "select * from car_ppto_gas where id_emp ='$id_emp' and cod_pptal ='$cta'";
      $resultadox1 = $connectionxx->query($sqlx1);

      while ($rowx1 = $resultadox1->fetch_assoc()) {

        $nom_cuenta = $rowx1["nom_rubro"];
        $situacion = $rowx1["situacion"];
        if ($situacion == 'C') {
          $situacion = 'Con Situacion';
        } else {
          $situacion = 'Sin Situacion';
        }
      }

      //calculo del vr liquidado x el usuario
      $sqlx1a = "select * from cdpp where cuenta ='$cta'";
      $resultadox1a = $connectionxx->query($sqlx1a);

      while ($rowx1a = $resultadox1a->fetch_assoc()) {
        $liq2 = $rowx1a["liq2"];
      }
      $sql3 = "select sum(vr_digitado) as registrado from crpp where id_auto_cdpp = '$rw[consecutivo]' and cuenta ='$cta'";
      $res3 = $cx->query($sql3);
      while ($row3 = $res3->fetch_assoc()) {
        $registrado = $row3['registrado'];
      }
      if ($registrado == '') $registrado = 0;
      $dif =  $rw["valor"] - $registrado;

      printf("
<span class='Estilo4'>

<!--cuenta-->
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<!--nom_rubro-->
<input name='nom_rubro" . $contador . "' type='hidden' value='%s'>
<td align='left'><span class='Estilo4'> &nbsp; %s </span></td>

<td align='center'>
<input name='vr_orig_cdpp" . $contador . "' type='hidden' value='%s' id='vr_original" . $contador . "'>
<input name='vr_digitado" . $contador . "' type='text' size='20' class='Estilo4' id='vr_digitado" . $contador . "' style='text-align:right' onkeypress=\"return validar(event)\" onchange='validarValor()' value='%.2f'>
</td>

<!--vr obligado-->
<td align='right'><span class='Estilo4'>%.2f</span>
<input name='obligado" . $contador . "' type='hidden' id='obligado" . $contador . "' value='%s'>
</td>


<!--situacion-->
<td align='center'><span class='Estilo4'> %s <input name='situacion" . $contador . "' type='hidden' value='%s'> </span></td>

<!--id_auto_crpp-->
<input name='consecutivo" . $contador . "' type='hidden' value='%s'>

<!--cuenta-->
<input name='cuenta" . $contador . "' type='hidden' value='%s'>


</tr>", $rw["cuenta"], $nom_cuenta, $nom_cuenta, $rw["valor"], $dif, $registrado, $registrado, $situacion, $situacion, $consecutivo, $rw["cuenta"]);

      $valor1 = $registrado;

      $contador++;
      $total = $total + $rw["valor"];
      $vr1x = $vr1x + $dif;
      $vr2x = $vr2x + $registrado;
    }

    printf("

<td colspan ='2' align='right'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>  TOTALES &nbsp;</span>
</div>
</td>
<td align='right'><span class='Estilo4'>  %.2f&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
<td align='right'><span class='Estilo4'> %.2f &nbsp; </span></td>
<td align='right'><span class='Estilo4'>  </span></td>

</table></center>", $vr1x, $vr2x);
    //--------	

    ?>
    <input name="contador" type="hidden" class="Estilo4" id="contador" value="<?php printf("%s", $contador); ?>" />

    <script>
      var contad = "<?php echo $contador; ?>";
    </script>


    <input name="total" type="hidden" class="Estilo4" id="total" value="<?php printf("%s", $total); ?>" />
    <br />
    <table width="800" border="1" align="center" class="bordepunteado1">
      <tr>
        <td colspan="4" bgcolor="#DCE9E5">
          <div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
            <div align="center" class="Estilo4"><strong>OTROS DATOS DEL REGISTRO PRESUPUESTAL </strong></div>
          </div>
        </td>
      </tr>
      <tr>
        <td width="200" bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>MANEJA CONTRATO : </strong></div>
            </div>
          </div>
        </td>
        <td width="200">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <select name="contrato" class="Estilo4" id="contrato">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
              </select>
              <input name="n_contrato" id="n_contrato" value="" size="10">
            </div>
          </div>
        </td>
        <td width="200" bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong> ADICION : </strong></div>
            </div>
          </div>
        </td>
        <td width="200">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <select name="adicion" class="Estilo4" id="adicion">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
              </select>
            </div>
          </div>
        </td>
      </tr>
      <!--tr>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>DATOS INVERSION : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <select name="inversion" class="Estilo4" id="inversion">
          <option value="NO">NO</option>
          <option value="SI">SI</option>
        </select>
      </div>
    </div></td>
    <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <div align="right"><strong>TALENTO HUMANO  : </strong></div>
      </div>
    </div></td>
    <td><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center" class="Estilo4">
        <select name="t_humano" class="Estilo4" id="t_humano">
          <option value="NO">NO</option>
          <option value="SI">SI</option>
        </select>
      </div>
    </div></td>
  </tr-->
      <tr>
        <td bgcolor="#F5F5F5">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>FORMA DE PAGO : </strong></div>
            </div>
          </div>
        </td>
        <td>
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <select name="pago" class="Estilo4" id="pago">
                <option value="ANTICIPO">ANTICIPOS %</option>
                <option value="PAGOS PARCIALES">PAGOS PARCIALES</option>
                <option value="PAGO TOTAL" selected="selected">PAGO TOTAL</option>
              </select>
            </div>
          </div>
        </td>
        <td bgcolor="#F5F5F5">
          <div align="center" class="Estilo4">
            <div align="right"><strong>REGIMEN SUBSIDIADO : </strong></div>
          </div>
        </td>
        <td>
          <div align="center" class="Estilo4">
            <select name="subsidiado" class="Estilo4" id="subsidiado">
              <option value="NO">NO</option>
              <option value="SI">SI</option>
            </select>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="4">
          <div class="Estilo12" style="padding-left:5px; padding-top:25px; padding-right:5px; padding-bottom:20px;">
            <div align="center">
              <input name="Submit322" type="submit" class="Estilo12" value="Guardar Certificado de Registro Presupuestal" onClick="return validar_form()" />
            </div>
          </div>
        </td>
      </tr>


    </table>



    </form>
    </div>
    </div>
    </td>
    </tr>

    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">
        <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
          <div align="center">

            <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
              <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                <div align="center">
                  <?php
                  printf("

<center class='Estilo9'>
<form method='post' action='mvto.php'>
<input type='hidden' name='nn' value='CDPP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
            <span class="Estilo4"> <strong>
                <?php include('../config.php');
                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                $sqlxx = "select * from fecha";
                $resultadoxx = $connectionxx->query($sqlxx);

                while ($rowxx = $resultadoxx->fetch_assoc()) {
                  $ano = $rowxx["ano"];
                }
                echo $ano;
                ?>
              </strong> </span> <br />
            <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td width="266">
        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="center"><?php include('../config.php');
                              echo $nom_emp ?><br />
            <?php echo $dir_tel ?><BR />
            <?php echo $muni ?> <br />

            <?php echo $email ?> </div>
        </div>
      </td>
      <td width="266">
        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
          <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
            </a><BR />
            <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
          </div>
        </div>
      </td>
      <td width="266">
        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
          <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
            Derechos Reservados - 2009
          </div>
        </div>
      </td>
    </tr>
    </table>
  </body>

  </html>
<?php
}
?>