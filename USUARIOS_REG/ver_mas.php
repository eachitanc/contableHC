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
      <!--
      .Estilo4 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
        font-weight: bold;
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
      -->
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

      .Estilo5 {
        font-size: 10px;
        color: #333333;
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
      }
    </style>
    <script>
      function cerrarse() {
        window.close()
      }
    </script>
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    <style type="text/css">
      <!--
      .Estilo9 {
        color: #FFFFFF
      }

      .Estilo10 {
        font-family: Verdana;
        font-size: 10px;
        color: #FFFFFF;
      }
      -->
    </style>
  </head>

  <body>
    <?php
    $cuentax = isset($_POST['cuenta']) ? $_POST['cuenta'] : '';
    $cuenta = isset($_GET['vr']) ? $_GET['vr'] . $cuentax : $cuentax;
    //printf("%s",$cuenta);

    include('config.php');
    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
    $sqlxx = "SELECT * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);

    while ($rowxx = $resultadoxx->fetch_assoc()) {

      $idxx = $rowxx["id_emp"];
      $id_emp = $rowxx["id_emp"];
      $ano = $rowxx["ano"];
    }

    $resultadoxx2 = $connectionxx->query("SELECT * from car_ppto_ing where id_emp='$id_emp' and cod_pptal ='$cuenta'");
    while ($rowxx2 = $resultadoxx2->fetch_assoc()) {

      $nom_rubro = $rowxx2["nom_rubro"];
      $definitivo = $rowxx2["ppto_aprob"];
      $tip_dato = $rowxx2["tip_dato"];
    }

    $resultadoxx3 = $connectionxx->query("SELECT * from fecha_ini_op");

    while ($rowxx3 = $resultadoxx3->fetch_assoc()) {

      $desde = $rowxx3["fecha_ini_op"];
      $desde_a = substr($desde, 0, 7);
    }

    $ts = strtotime('-1 month');
    $hasta = date('Y/m/d', $ts);
    $hasta_a = substr($hasta, 0, 7);
    $actual = date('Y/m/d');
    $actual_a = substr($actual, 0, 7);


    if ($tip_dato == 'M') {
      printf("<br><br><center><span class ='Estilo4'>LA CUENTA SELECCIONADA ES UNA CUENTA DE TIPO MAYOR</span></center><br><br>");
    } else {
    ?>
      <form name="a" method="post" action="ver_mas.php">
        <table width="400" border="1" align="center" class="bordepunteado1">

          <tr>
            <td colspan="4" bgcolor="#DCE9E5">
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">CONSULTA DE SALDOS PRESUPUESTALES </div>
              </div>
            </td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5">
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="right">CUENTA : </div>
              </div>
            </td>
            <td colspan="3">
              <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center"><?php printf("%s", $cuenta); ?>
                  <input name="cuenta" type="hidden" value="<?php printf("%s", $cuenta); ?>" />
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td bordercolor="#F5F5F5" bgcolor="#F5F5F5">
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="right">NOMBRE : </div>
              </div>
            </td>
            <td colspan="3">
              <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center"><?php printf("%s", $nom_rubro); ?>
                  <input name="nom_rubro" type="hidden" value="<?php printf("%s", $nom_rubro); ?>" />
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#F5F5F5">
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="right">PRESUPUESTO INICIAL : </div>
              </div>
            </td>
            <td colspan="2">
              <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="right"><?php echo number_format($definitivo, 2, ',', '.'); // printf("%s",$definitivo);
                                    ?>
                  <input name="definitivo" type="hidden" value="<?php printf("%s", $definitivo); ?>" />
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td width="100"></td>
            <td width="100"></td>
            <td width="100"></td>
            <td width="100"></td>
          </tr>
        </table>
        <br />
        <table width="600" border="1" align="center" class="bordepunteado1">
          <tr>
            <td colspan="2" bgcolor="#DCE9E5">
              <div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                <div align="center" class="Estilo5"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">SELECCIONE FECHA DE INICIO </div>
              </div>
            </td>
            <td>
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">SELECCIONE FECHA FINAL </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center">
                  <input name="fecha_ini" type="text" class="Estilo5" id="fecha_ini" value="<?php printf($desde); ?>" size="12" />
                  <span class="Estilo9">::</span>
                  <input name="button" type="button" class="Estilo5" id="button" onclick="displayCalendar(document.a.fecha_ini,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                </div>
              </div>
            </td>
            <td>
              <div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center">
                  <input name="fecha_fin" type="text" class="Estilo5" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
                  <span class="Estilo9">::</span>
                  <input name="button2" type="button" class="Estilo5" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="Submit" type="submit" class="Estilo5" value="Consultar" />
                </div>
              </div>
            </td>
          </tr>
        </table>
      </form>
      <br />
      <table width="800" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="4" bgcolor="#990000">
            <?php
            $fecha_ini = isset($_POST['fecha_ini']) ? $_POST['fecha_ini'] : null;
            $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
            $cuenta = isset($_POST['cuenta']) ? $_POST['cuenta'] : null;
            $nom_rubro = isset($_POST['nom_rubro']) ? $_POST['nom_rubro'] : null;
            $definitivo = isset($_POST['definitivo']) ? $_POST['definitivo'] : null;
            printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	", $fecha_ini, $fecha_fin);
            ?></td>
        </tr>
        <tr>
          <td width="200" bgcolor="#F5F5F5"></td>
          <td width="200" bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center">TOTAL CONSULTA (+) </div>
            </div>
          </td>
          <td width="200" bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center"></div>
            </div>
          </td>
          <td width="200" bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center">TOTAL CONSULTA (-) </div>
            </div>
          </td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">ADICIONES : </div>
            </div>
          </td>
          <td>
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php
                $resulta = $connectionxx->query("SELECT SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cod_pptal ='$cuenta'") or die("Conexion no Exitosa");
                $row = $resulta->fetch_array();
                $total_adi = $row[0];
                echo number_format($total_adi, 2, ',', '.');
                ?> </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">REDUCCIONES : </div>
            </div>
          </td>
          <td>
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php
                $resulta2 = $connectionxx->query("SELECT SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cod_pptal ='$cuenta'") or die("Conexion no Exitosa");
                $row2 = $resulta2->fetch_array();
                $total_red = $row2[0];
                echo number_format($total_red, 2, ',', '.');
                ?> </div>
            </div>
          </td>
        </tr>



        <tr>
          <td colspan="4" bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
              <div align="center">PRESUPUESTO DEFINITIVO : <?php $ppto_def = $definitivo + $total_adi - $total_red;
                                                            echo "$" . number_format($ppto_def, 2, ',', '.') . "=";  ?></div>
            </div>
          </td>
        </tr>

        <tr>
          <td bgcolor="#F5F5F5"></td>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center">ACUMULADO RECONO. </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5"></td>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center">ACUMULADO RECAUDOS </div>
            </div>
          </td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">SUMA RECONOCIMIENTOS : </div>
            </div>
          </td>
          <td>
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php
                $resulta3 = $connectionxx->query("SELECT SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cuenta ='$cuenta'") or die("Conexion no Exitosa");
                $row3 = $resulta3->fetch_array();
                $total_reip = $row3[0];
                echo number_format($total_reip, 2, ',', '.');
                ?>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">SUMA RECIBOS OFI. DE ING : </div>
            </div>
          </td>
          <td>
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php
                $resulta4 = $connectionxx->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cuenta ='$cuenta'") or die("Conexion no Exitosa");
                $row4 = $resulta4->fetch_array();
                $total_roit = $row4[0];
                echo number_format($total_roit, 2, ',', '.');
                ?>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">SUMA RECON. OTROS DCTOS : </div>
            </div>
          </td>
          <td>
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php

                $resulta5 = $connectionxx->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_ncbt 
	WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cuenta ='$cuenta'") or die("Conexion no Exitosa");
                $row5 = $resulta5->fetch_array();
                $total_ncbt = $row5[0];

                $resulta6 = $connectionxx->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_rcgt 
	WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cuenta ='$cuenta'") or die("Conexion no Exitosa");
                $row6 = $resulta6->fetch_array();
                $total_rcgt = $row6[0];

                $resulta7 = $connectionxx->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_tnat 
	WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$idxx' and cuenta ='$cuenta'") or die("Conexion no Exitosa");
                $row7 = $resulta7->fetch_array();
                $total_tnat = $row7[0];

                $otros_rec = $total_ncbt + $total_rcgt + $total_tnat;
                echo number_format($otros_rec, 2, ',', '.');
                ?>
              </div>
            </div>
          </td>
          <td>
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">SUMA RECAUDO OTROS DCTOS : </div>
            </div>
          </td>
          <td>
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php

                $otros_rec2 = $otros_rec;
                echo number_format($otros_rec2, 2, ',', '.');
                ?>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td bgcolor="#00CCCC">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">TOTAL ING. RECONOCIDOS : </div>
            </div>
          </td>
          <td bgcolor="#00CCCC">
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php
                $suma1 = $total_reip + $otros_rec;
                echo number_format($suma1, 2, ',', '.');
                ?>
              </div>
            </div>
          </td>
          <td bgcolor="#00CCCC">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">TOTAL ING. RECAUDADOS : </div>
            </div>
          </td>
          <td bgcolor="#00CCCC">
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">
                <?php
                $suma2 = $total_roit + $otros_rec;
                echo number_format($suma2, 2, ',', '.');
                ?>
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="2" bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">SALDO POR EJECUTAR : </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center" class="Estilo5">
                <div align="right">
                  <?php $tx9 = $ppto_def - $total_reip - $otros_rec;
                  echo number_format($tx9, 2, ',', '.'); ?>
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5"></td>
        </tr>

        <tr>
          <td colspan="2" bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">TOTAL RECONOCIDO : </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center" class="Estilo5">
                <div align="right">
                  <?php $tx9a = $total_reip + $otros_rec;
                  echo number_format($tx9a, 2, ',', '.'); ?>
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5"></td>
        </tr>

        <tr>
          <td colspan="2" bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">TOTAL RECAUDADO : </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center" class="Estilo5">
                <div align="right">
                  <?php $tx9aA = $total_roit + $otros_rec;
                  echo number_format($tx9aA, 2, ',', '.'); ?>
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5"></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#DCE9E5">
            <div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="right">SALDO POR RECAUDAR : </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5">
            <div class="Estilo5" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
              <div align="center" class="Estilo4">
                <div align="right">
                  <?php $tx10 = $total_reip - $total_roit;
                  echo number_format($tx10, 2, ',', '.'); ?>
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#DCE9E5"></td>
        </tr>
      </table>
      <BR />
    <?php
    }
    ?>
    <form>
      <div align="center">
        <input type=button class="Estilo5" onclick="cerrarse()" value="Cerrar Consulta">
      </div>
    </form>
  </body>

  </html>
<?php
}
?>