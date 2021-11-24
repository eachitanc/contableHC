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
      .Estilo1 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-weight: bold;
      }

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
    </style>
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    <style type="text/css">
      .Estilo10 {
        color: #FFFFFF;
        font-weight: bold;
      }

      .Estilo11 {
        font-size: 10px
      }
    </style>
    <script>
      function DefinePeriodo() {
        var mes = document.getElementById('mes').value;
        var fecha = document.getElementById('fecha_ini').value;
        // Extraer a�o
        var anno = fecha.split("/");
        var anno2 = anno[0];
        if (mes == 0) // enero
        {
          document.getElementById('fecha_inip').value = anno2 + "/01/01";
          document.getElementById('fecha_fin').value = anno2 + "/01/31";
        }
        if (mes == 1) {
          document.getElementById('fecha_inip').value = anno2 + "/02/01";
          document.getElementById('fecha_fin').value = anno2 + "/02/28";
        }
        if (mes == 2) {
          document.getElementById('fecha_inip').value = anno2 + "/03/01";
          document.getElementById('fecha_fin').value = anno2 + "/03/31";
        }
        if (mes == 3) {
          document.getElementById('fecha_inip').value = anno2 + "/04/01";
          document.getElementById('fecha_fin').value = anno2 + "/04/30";
        }
        if (mes == 4) {
          document.getElementById('fecha_inip').value = anno2 + "/05/01";
          document.getElementById('fecha_fin').value = anno2 + "/05/31";
        }
        if (mes == 5) {
          document.getElementById('fecha_inip').value = anno2 + "/06/01";
          document.getElementById('fecha_fin').value = anno2 + "/06/30";
        }
        if (mes == 6) {
          document.getElementById('fecha_inip').value = anno2 + "/07/01";
          document.getElementById('fecha_fin').value = anno2 + "/07/31";
        }
        if (mes == 7) {
          document.getElementById('fecha_inip').value = anno2 + "/08/01";
          document.getElementById('fecha_fin').value = anno2 + "/08/31";
        }
        if (mes == 8) {
          document.getElementById('fecha_inip').value = anno2 + "/09/01";
          document.getElementById('fecha_fin').value = anno2 + "/09/30";
        }
        if (mes == 9) {
          document.getElementById('fecha_inip').value = anno2 + "/10/01";
          document.getElementById('fecha_fin').value = anno2 + "/01/31";
        }
        if (mes == 10) {
          document.getElementById('fecha_inip').value = anno2 + "/11/01";
          document.getElementById('fecha_fin').value = anno2 + "/11/30";
        }
        if (mes == 11) {
          document.getElementById('fecha_inip').value = anno2 + "/12/01";
          document.getElementById('fecha_fin').value = anno2 + "/12/31";
        }
        if (mes == 12) {
          document.getElementById('fecha_inip').value = anno2 + "/01/01";
          document.getElementById('fecha_fin').value = anno2 + "/12/31";
        }
      }
    </script>
  </head>


  </head>

  <body onload="DefinePeriodo();">
    <table width="800" border="0" align="center">
      <tr>

        <td width="798" colspan="3">
          <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
            <div align="center">
              <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
            </div>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="3">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='../carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
            <div align="center">
              <?php
              //-------
              include('../config.php');

              $cxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
              $sxx = "SELECT * from fecha";
              $rxx = $cxx->query($sxx);

              while ($rowxxx = $rxx->fetch_assoc()) {

                $idxxx = $rowxxx["id_emp"];
                $id_emp = $rowxxx["id_emp"];
                $ano = $rowxxx["ano"];
              }


              $sxxq = "SELECT * from fecha_ini_op";
              $rxxq = $cxx->query($sxxq);

              while ($rowxxxq = $rxxq->fetch_assoc()) {

                $fecha_ini_op = $rowxxxq["fecha_ini_op"];
              }


              $cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
              $sq2 = "SELECT * from empresa where cod_emp = '$idxxx'";
              $re2 = $cx2->query($sq2);

              while ($row2 = $re2->fetch_assoc()) {
                printf("<span class='Estilo4'><b>...::: %s :::...</b></span><br>", $row2["raz_soc"]);
              }
              //--------	--------------------------------------------------------------------------------------------
              ?><br />
              <span class="Estilo1">REPORTE MODIFICACIONES MENSUALES AL PRESUPUESTO DE INGRESOS</span>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">

          <form name="a" method="post" action="modificaciones_ingresos.php">
            <table width="600" border="1" align="center" class="bordepunteado1">
              <tr>
                <td colspan="2" bgcolor="#DCE9E5">
                  <div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                    <div align="center" class="Estilo5"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td width="300">
                  <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                    <div align="center"> PERIODO </div>
                  </div>
                </td>
                <td width="300">
                  <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                    <div align="center">SELECCIONE FECHAS </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4"><strong>
                        <input type="hidden" name="fecha_ini" id="fecha_ini" value="<?php printf($fecha_ini_op); ?>" />
                        <SELECT name='mes' id='mes' class="Estilo4" onchange="DefinePeriodo();">
                          <?php
                          $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE', 'ANUAL');
                          $i = 0;
                          for ($i = 0; $i <= 12; $i++) {
                            echo "<option value='$i'>$mes[$i]</option>";
                          }
                          ?>
                        </SELECT>
                    </div>
                </td>
                <td>
                  <div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <input name="fecha_inip" type="text" class="Estilo4" id="fecha_inip" value="<?php printf($ano); ?>" size="12" />
                      <span class="Estilo10">::</span>
                      <input name="button1" type="button" class="Estilo4" id="button1" onclick="displayCalendar(document.a.fecha_inip,'yyyy/mm/dd',this)" value="Fecha Inicial" />
                    </div>
                    <div align="center">
                      <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
                      <span class="Estilo10">::</span>
                      <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Fecha Final&nbsp;&nbsp;" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                    <div align="center">
                      <input name="Submit" type="submit" class="Estilo4" value="Consultar" />
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
    </table>
    <br />
    <br />
    <table width="800" border="0" align="center">

      <tr>
        <td colspan="3">
          <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='../carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
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
                  <?php
                  include('../config.php');
                  $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                  $sqlxx = "SELECT * from fecha";
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
          <div class="Estilo7" id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center">
              <?php include('../config.php');
              echo $nom_emp ?>
              <br />
              <?php echo $dir_tel ?><br />
              <?php echo $muni ?> <br />
              <?php echo $email ?>
            </div>
          </div>
        </td>
        <td width="266">
          <div class="Estilo7" id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
              </a><br />
              <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
            </div>
          </div>
        </td>
        <td width="266">
          <div class="Estilo7" id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
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