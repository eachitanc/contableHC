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
    </style>
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    <style type="text/css">
      .Estilo8 {
        color: #990000;
        font-weight: bold;
      }
    </style>
  </head>

  <body>
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
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='consulta_ppto_gas.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>

      <tr>
        <?php

        include('../config.php');
        $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
        $sqlxx = "select * from fecha";
        $resultadoxx = $connectionxx->query($sqlxx);

        while ($rowxx = $resultadoxx->fetch_assoc()) {

          $idxx = $rowxx["id_emp"];
        }

        $cod_pptal = $_POST['cod_pptal'];
        $definitivo = $_POST['definitivo'];
        $meses = $_POST['meses'];

        //printf('%s <br> %s <br> %s',$cod_pptal,$definitivo,$meses);


        $a1 = $connectionxx->query("select * from car_ppto_gas where cod_pptal = '$cod_pptal' and id_emp ='$idxx'");

        while ($row = $a1->fetch_assoc()) {
          $nom_rubro = $row["nom_rubro"];
        }

        ?>
        <td colspan="3">
          <form name="a" method="post" action="pac_ingresos_recalc.php">
            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr>
                <td width="250" bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>CODIGO : </strong></div>
                    </div>
                  </div>
                </td>
                <td colspan="2">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="left"><?php printf('%s', $cod_pptal); ?>
                        <input name="cod_pptal" type="hidden" class="Estilo4" id="cod_pptal" value="<?php printf('%s', $cod_pptal); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td width="250" bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="right"><span class="Estilo4"><strong>CUENTA : </strong></span></div>
                  </div>
                </td>
                <td colspan="2">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><span class="Estilo4"><?php printf('%s', $nom_rubro); ?>
                        <input name="nom_rubro" type="hidden" class="Estilo4" id="nom_rubro" value="<?php printf('%s', $nom_rubro); ?>" />
                      </span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="right"><span class="Estilo4"><strong>VALOR APROPIADO : </strong></span></div>
                  </div>
                </td>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><span class="Estilo4"><?php printf('%.2f', $definitivo); ?>
                        <input name="definitivo" type="hidden" class="Estilo4" id="definitivo" value="<?php printf('%.2f', $definitivo); ?>" />
                      </span></div>
                  </div>
                </td>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td width="250" bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>NUMERO DE MESES A DIVIDIR : </strong></div>
                    </div>
                  </div>
                </td>
                <td width="250">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><span class="Estilo4">
                        <?php printf('%s', $meses); ?>
                        <input name="meses" type="hidden" class="Estilo4" id="meses" value="<?php printf('%s', $meses); ?>" />
                      </span></div>
                  </div>
                </td>
                <td width="250">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"></div>
                  </div>
                </td>
              </tr>
            </table>
            <br />
            <?php

            switch ($meses) {
              case (0):
                printf("<center class='Estilo4'><br><b>El numero de meses debe estar entre 1 y 13 (incluido el Rezago)</b><br>
		Verifique nuevamente su informacion<BR>--- PRESIONE VOLVER PARA CORREGIR ---<br><br><br>
		</center>");
                $enero = 0;
                $febrero = 0;
                $marzo = 0;
                $abril = 0;
                $mayo = 0;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (1):
                $enero = $definitivo / $meses;
                $febrero = 0;
                $marzo = 0;
                $abril = 0;
                $mayo = 0;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (2):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = 0;
                $abril = 0;
                $mayo = 0;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (3):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = 0;
                $mayo = 0;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (4):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = 0;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (5):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (6):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (7):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (8):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = $definitivo / $meses;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (9):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = $definitivo / $meses;
                $septiembre = $definitivo / $meses;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (10):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = $definitivo / $meses;
                $septiembre = $definitivo / $meses;
                $octubre = $definitivo / $meses;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (11):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = $definitivo / $meses;
                $septiembre = $definitivo / $meses;
                $octubre = $definitivo / $meses;
                $noviembre = $definitivo / $meses;
                $diciembre = 0;
                $rezago = 0;
                break;
              case (12):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = $definitivo / $meses;
                $septiembre = $definitivo / $meses;
                $octubre = $definitivo / $meses;
                $noviembre = $definitivo / $meses;
                $diciembre = $definitivo / $meses;
                $rezago = 0;
                break;
              case (13):
                $enero = $definitivo / $meses;
                $febrero = $definitivo / $meses;
                $marzo = $definitivo / $meses;
                $abril = $definitivo / $meses;
                $mayo = $definitivo / $meses;
                $junio = $definitivo / $meses;
                $julio = $definitivo / $meses;
                $agosto = $definitivo / $meses;
                $septiembre = $definitivo / $meses;
                $octubre = $definitivo / $meses;
                $noviembre = $definitivo / $meses;
                $diciembre = $definitivo / $meses;
                $rezago = $definitivo / $meses;
                break;
              default:
                printf("<center class='Estilo4'><br><b>El numero de meses debe estar entre 1 y 13 (incluido el Rezago)</b><br>
		Verifique nuevamente su informacion<BR>--- PRESIONE VOLVER PARA CORREGIR ---<br><br><br>
		</center>");
                $enero = 0;
                $febrero = 0;
                $marzo = 0;
                $abril = 0;
                $mayo = 0;
                $junio = 0;
                $julio = 0;
                $agosto = 0;
                $septiembre = 0;
                $octubre = 0;
                $noviembre = 0;
                $diciembre = 0;
                $rezago = 0;
            }

            $total = $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $octubre + $noviembre + $diciembre + $rezago;
            $diferencia = $definitivo - $total;
            ?>
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:550px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center" class="Estilo4"><strong>UTILICE CORTAR - PEGAR PARA REUBICAR LOS VALORES </strong><strong></strong></div>
                </div>
              </div>
            </div><BR />
            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr>
                <td width="187" bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>ENERO</strong></div>
                    </div>
                  </div>
                </td>
                <td width="187" bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="enero" type="text" class="Estilo4" id="enero" size="30" value="<?php printf('%.2f', $enero); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
                <td width="187" bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>JULIO</strong></div>
                    </div>
                  </div>
                </td>
                <td width="187" bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="julio" type="text" class="Estilo4" id="julio" size="30" value="<?php printf('%.2f', $julio); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>FEBRERO</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="febrero" type="text" class="Estilo4" id="febrero" size="30" value="<?php printf('%.2f', $febrero); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>AGOSTO</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="agosto" type="text" class="Estilo4" id="agosto" size="30" value="<?php printf('%.2f', $agosto); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>MARZO</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="marzo" type="text" class="Estilo4" id="marzo" size="30" value="<?php printf('%.2f', $marzo); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>SEPTIEMBRE</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="septiembre" type="text" class="Estilo4" id="septiembre" size="30" value="<?php printf('%.2f', $septiembre); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>ABRIL</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="abril" type="text" class="Estilo4" id="abril" size="30" value="<?php printf('%.2f', $abril); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>OCTUBRE</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="octubre" type="text" class="Estilo4" id="octubre" size="30" value="<?php printf('%.2f', $octubre); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>MAYO</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="mayo" type="text" class="Estilo4" id="mayo" size="30" value="<?php printf('%.2f', $mayo); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>NOVIEMBRE</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="noviembre" type="text" class="Estilo4" id="noviembre" size="30" value="<?php printf('%.2f', $noviembre); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>JUNIO</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="junio" type="text" class="Estilo4" id="junio" size="30" value="<?php printf('%.2f', $junio); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>DICIEMBRE</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="diciembre" type="text" class="Estilo4" id="diciembre" size="30" value="<?php printf('%.2f', $diciembre); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="2" bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>REZAGO</strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="rezago" type="text" class="Estilo4" id="rezago" size="30" value="<?php printf('%.2f', $rezago); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#DCE9E5">&nbsp;</td>
                <td colspan="2" bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>TOTAL SUMA </strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="total" type="text" class="Estilo4" id="total" size="30" value="<?php printf('%.2f', $total); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td colspan="2" bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right"><strong>DIFERENCIA PAC Y APROPIACION </strong></div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">

                        <input name="diferencia" type="text" class="Estilo4" id="diferencia" size="30" value="<?php printf('%.2f', $diferencia); ?>" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="4" bgcolor="#FFFFFF">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="center">
                        Si ha hecho cambios a los valores presione --&gt;
                        <input name="Submit" type="submit" class="Estilo4" value="Recalcular" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:5px;">
            <form action="proc_pac_ing.php" method="post" name="b" class="Estilo4" onsubmit="return confirm('Una vez grabado el P.A.C solo podra realizarle Adiciones y Reducciones, � Desea Continuar ?')">
              <div align="center">
                <input name="cod_pptal" type="hidden" class="Estilo4" id="cod_pptal" value="<?php printf('%s', $cod_pptal); ?>" />

                <input name="nom_rubro" type="hidden" class="Estilo4" id="nom_rubro" value="<?php printf('%s', $nom_rubro); ?>" />

                <input name="definitivo" type="hidden" class="Estilo4" id="definitivo" value="<?php printf('%.2f', $definitivo); ?>" />

                <input name="meses" type="hidden" class="Estilo4" id="meses" value="<?php printf('%s', $meses); ?>" />

                <input name="enero" type="hidden" class="Estilo4" id="enero" size="30" value="<?php printf('%.2f', $enero); ?>" />
                <input name="febrero" type="hidden" class="Estilo4" id="febrero" size="30" value="<?php printf('%.2f', $febrero); ?>" />
                <input name="marzo" type="hidden" class="Estilo4" id="marzo" size="30" value="<?php printf('%.2f', $marzo); ?>" />
                <input name="abril" type="hidden" class="Estilo4" id="abril" size="30" value="<?php printf('%.2f', $abril); ?>" />
                <input name="mayo" type="hidden" class="Estilo4" id="mayo" size="30" value="<?php printf('%.2f', $mayo); ?>" />
                <input name="junio" type="hidden" class="Estilo4" id="junio" size="30" value="<?php printf('%.2f', $junio); ?>" />
                <input name="julio" type="hidden" class="Estilo4" id="julio" size="30" value="<?php printf('%.2f', $julio); ?>" />
                <input name="agosto" type="hidden" class="Estilo4" id="agosto" size="30" value="<?php printf('%.2f', $agosto); ?>" />
                <input name="septiembre" type="hidden" class="Estilo4" id="septiembre" size="30" value="<?php printf('%.2f', $septiembre); ?>" />
                <input name="octubre" type="hidden" class="Estilo4" id="octubre" size="30" value="<?php printf('%.2f', $octubre); ?>" />
                <input name="noviembre" type="hidden" class="Estilo4" id="noviembre" size="30" value="<?php printf('%.2f', $noviembre); ?>" />
                <input name="diciembre" type="hidden" class="Estilo4" id="diciembre" size="30" value="<?php printf('%.2f', $diciembre); ?>" />
                <input name="rezago" type="hidden" class="Estilo4" id="rezago" size="30" value="<?php printf('%.2f', $rezago); ?>" />
                <input name="total" type="hidden" class="Estilo4" id="total" size="30" value="<?php printf('%.2f', $total); ?>" />
                <input name="diferencia" type="hidden" class="Estilo4" id="diferencia" size="30" value="<?php printf('%.2f', $diferencia); ?>" />

                <span class="Estilo8">Si no tiene cambios que realizar presione -&gt;</span>
                <input name="Submit2" type="submit" class="Estilo4" value="Grabar P.A.C" />
              </div>
            </form>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='consulta_ppto_gas.php' target='_parent'>VOLVER </a> </div>
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