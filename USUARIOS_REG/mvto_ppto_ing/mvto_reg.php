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

      .Estilo8 {
        color: #FFFFFF
      }

      .Estilo9 {
        color: #990000;
        font-weight: bold;
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



      function validar_form() {

        var selec1 = document.getElementById('ter_nat').value;
        var selec2 = document.getElementById('ter_jur').value;
        var selec3 = document.getElementById('cuenta').value;

        if (selec1 == "" && selec2 == "") {
          alert("Debe seleccionar tercero...");
          return (false);
        }
        if (selec3 == "") {
          alert("Debe seleccionar imputacion presupuestal...");
          document.getElementById('cuenta').focus();
          return (false);

        }





      }
    </script>

    <!--validacion de forms-->
    <script src="../jquery.js"></script>
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
      function chk_reip() {
        var pos_url = '../comprobadores/comprueba_reip.php';
        var cod = document.getElementById('id_manu_reip').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('res_reip').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }

      function consecutivo2() {
        var fec = document.getElementById('fecha_reg').value;
        var pos_url2 = 'consultas/concec_reip.php';
        var req1 = new XMLHttpRequest();
        if (req1) {
          req1.onreadystatechange = function() {
            if (req1.readyState == 4) {
              var dato = req1.responseText;
              var elem = dato.split(',');
              concec = elem[0];
              fecha2 = elem[1];
              document.getElementById('id_manu_reip').value = concec;
              if (fec != fecha2) {
                alert("Fecha sugerida para el consecutivo disponible: " + fec);
              }
            }
          }
          req1.open('POST', pos_url2 + '?cod=' + fec, false);
          req1.send(null);
        }


      }
    </script>

    <script>
      // tipo cuenta

      function tipo_cuenta() {
        var cuenta = document.getElementById('cuenta').value;

        //alert (cuenta);
        var pos_url2 = 'consultas/tipo_cuenta.php';
        var req1 = new XMLHttpRequest();
        if (req1) {
          req1.onreadystatechange = function() {
            if (req1.readyState == 4) {
              var dato = req1.responseText;
              if (dato == 'M') {
                alert("La cuenta seleccionada no es de detalle");
                document.getElementById('cuenta').focus();
                document.getElementById('cuenta').children[0].selected=true;
              }
            }
          }
          req1.open('POST', pos_url2 + '?cod=' + cuenta, true);
          req1.send(null);
        }
      }

      function guardarCookies() {
        document.cookie = "cook =" + document.getElementById('cuenta').value;
      }
    </script>







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
    <!--fin val forms-->

    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    <style type="text/css">
      .Estilo11 {
        color: #F5F5F5
      }
    </style>
  </head>

  <body onload=consecutivo2();>
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
          <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='mvto.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">

          <form id="commentForm" name="a" method="post" action="a_mvto1.php">



            <table width="800" height="186" border="1" align="center" class="bordepunteado1">
              <tr>
                <td height="101" colspan="3">
                  <table border="0" align="center">
                    <tr>
                      <td>
                        <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                          <div align="center"> <strong> Seleccione el Tipo de Tercero</strong> <br />
                            <br />

                            <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar('naturales');"> NATURAL</span> - <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar2('juridicos');"> JURIDICO</span> - <a href="../terceros/terceros.php" target="_parent">&iquest; NUEVO ?</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td id="naturales" style="display:none">
                        <div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                          <div align="center">
                            <select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" disabled="disabled">
                              <option value="" selected="selected" />



                              <?php
                              include('../config.php');
                              $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                              $sqlxx = "select * from fecha";
                              $resultadoxx = $connectionxx->query($sqlxx);

                              while ($rowxx = $resultadoxx->fetch_assoc()) {

                                $idxx = $rowxx["id_emp"];
                              }
                              ?>




                              <?php

                              include('../config.php');
                              $db = new mysqli($server, $dbuser, $dbpass, $database);

                              $strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$idxx' order by pri_ape asc ";
                              $rs = $db->query($strSQL);
                              while ($r = $rs->fetch_assoc()) {
                                echo "<OPTION VALUE=\"" . $r["id"] . "\">" . $r["pri_ape"] . " " . $r["seg_ape"] . " " . $r["pri_nom"] . " " . $r["seg_nom"] . "</b></OPTION>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td id="juridicos" style="display:none">
                        <div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
                          <div align="center">
                            <select name="ter_jur" class="Estilo4" id="ter_jur" style="width: 350px;" disabled="disabled">
                              <option value="" selected="selected" />
                              <?php
                              include('../config.php');
                              $db = new mysqli($server, $dbuser, $dbpass, $database);

                              $strSQL = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$idxx' order by raz_soc2 asc ";
                              $rs = $db->query($strSQL);
                              while ($r = $rs->fetch_assoc()) {
                                echo "<OPTION VALUE=\"" . $r["id"] . "\">" . $r["raz_soc2"] . "</b></OPTION>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div align="center" class="Estilo4 Estilo10"> </div>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="200" bgcolor="#FFFFFF">

                  <?php

                  $cx = new mysqli($server, $dbuser, $dbpass, $database);
                  $resulta = $cx->query("SHOW TABLE STATUS FROM $database LIKE 'reip_ing'");
                  while ($array = $resulta->fetch_assoc()) {
                    $consecutivo = $array['Auto_increment'];
                  }

                  ?>

                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center"><span class="Estilo4"><strong><br />Digite No. REIP</strong></span><br /><br />
                      <input name="id_manu_reip" type="text" class="required Estilo4" id="id_manu_reip" size="20" onkeypress="return validar(event)" style="text-align:center" onkeyup="chk_reip();" />
                      <a href="javascript:mostrarVentana();">Mas</a>
                      <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">
                        <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">REIP UTILIZADO</div>
                        <iframe id="datamain" src="reipconsecutivo.php" width="200" height="250" marginwidth="0" marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
                        <div style="padding: 10px; background-color: #F0F0F0; text-align: center; margin-top: 6px;">
                          <input id="btnAceptar" onclick="ocultarVentana();" name="btnAceptar" size="20" type="button" value=".:ok:." />
                        </div>
                      </div>
                      <br />
                      <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div class="Estilo4" align="center" id='res_reip'></div>
                      </div>
                    </div>
                  </div>
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center"><span class="Estilo4"><strong>Numero :</strong> <span class="Estilo8">:::</span> <?php printf("%s", $consecutivo); ?></span>
                      <input name="consecutivo" type="hidden" class="Estilo4" id="consecutivo" value="<?php printf("%s", $consecutivo); ?>" />
                    </div>
                  </div>
                </td>
              </tr>


              <tr>
                <td width="176" bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center"><strong>DESCRIPCION DEL RECONOCIMIENTO</strong> </div>
                    </div>
                  </div>
                </td>
                <td colspan="2" bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <textarea name="des" cols="60" rows="3" class="required Estilo4" id="des"></textarea>
                    </div>
                  </div>
                </td>
                <td bgcolor="#F5F5F5">
                  <?php include('../config.php');
                  $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                  $sqlxx = "select * from fecha";
                  $resultadoxx = $connectionxx->query($sqlxx);

                  while ($rowxx = $resultadoxx->fetch_assoc()) {
                    $ano = $rowxx["ano"];
                  }

                  ?>
                  <?php $fecha_reg = $ano; //printf("%s",$fecha_reg);
                  ?>

                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><span class="Estilo4"><strong>Fecha</strong></span><br />
                      <br />
                      <input name="fecha_reg" type="text" class="Estilo4" id="fecha_reg" value="<?php printf("%s", $fecha_reg); ?>" size="12" />
                      <br /><br />
                      <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.a.fecha_reg,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td height="5"></td>
                <td width="148"></td>
                <td width="246"></td>
                <td></td>
              </tr>
            </table>

            <br />
            <br />



            <table width="800" border="1" align="center" class="bordepunteado1">
              <tr>
                <td width="196" bgcolor="#FFFFFF"></td>
                <td width="190" bgcolor="#FFFFFF"></td>
                <td width="186" bgcolor="#FFFFFF"></td>
                <td width="198" bgcolor="#FFFFFF"></td>
              </tr>

              <tr>
                <td colspan="3" bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center" class="Estilo4">
                      <div align="center"><strong>SELECCIONE IMPUTACION PRESUPUESTAL</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center"><span class="Estilo4"><strong>Valor</strong></span><br />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center">
                      <select name="cuenta" class="Estilo4" id="cuenta" style="width: 400px;" onchange="tipo_cuenta();">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $db = new mysqli($server, $dbuser, $dbpass, $database);

                        $strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx'  ORDER BY cod_pptal";
                        $rs = $db->query($strSQL);
                        while ($r = $rs->fetch_assoc()) {
                          echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</b></OPTION>";
                        }
                        ?>
                      </select>

                      <?php
                      $cookie = isset($_COOKIE['cook']) ? $_COOKIE['cook'] : '';
                      //printf("%s",$cookie);

                      ?>

                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center">
                      <input name="valor" type="text" class="required Estilo4" id="valor" size="20" onkeypress="return validar(event)" style="text-align:right" />
                    </div>
                  </div>
                </td>
              </tr>









              <tr>
                <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>

              <tr>
                <td colspan="4" bgcolor="#F5F5F5">
                  <div class="Estilo4" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center">
                      <input name="Submit3222" type="submit" class="Estilo4" value="A&ntilde;adir Otra Imputacion Presupuestal y Continuar" onclick="return validar_form();" />
                      <span class="Estilo8">:::</span>
                      <input name="Submit3223" type="submit" class="Estilo4" value="Guardar Reconocimiento y Terminar" onclick="return validar_form();" />
                    </div>
                  </div>
                </td>
              </tr>
            </table>

          </form>
          <br />
          <br />







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
                  <div align="center"><a href='mvto.php' target='_parent'>VOLVER </a> </div>
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