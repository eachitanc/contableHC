<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
?>
  <?php

  $cod_pptal = $_POST['cod_pptal'];
  $nom_rubro = $_POST["nom_rubro"];
  $definitivo = $_POST["definitivo"];
  $meses = $_POST["meses"];
  $enero = $_POST["enero"];
  $febrero = $_POST["febrero"];
  $marzo = $_POST["marzo"];
  $abril = $_POST["abril"];
  $mayo = $_POST["mayo"];
  $junio = $_POST["junio"];
  $julio = $_POST["julio"];
  $agosto = $_POST["agosto"];
  $septiembre = $_POST["septiembre"];
  $octubre = $_POST["octubre"];
  $noviembre = $_POST["noviembre"];
  $diciembre = $_POST["diciembre"];
  $rezago = $_POST["rezago"];
  $total = $_POST["total"];
  $diferencia = $_POST["diferencia"];

  //-------saco el id de la empresa
  include('../config.php');
  $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
  $sql = "SELECT * from fecha";
  $resultado = $cx->query($sql);
  while ($row = $resultado->fetch_assoc()) {
    $id_emp = $row["id_emp"];
  }

  //--------- saco los pac utilizados de la bd
  $sql2 = "select * from pac_gastos where cod_pptal ='$cod_pptal' and id_emp ='$id_emp' ";
  $resultado2 = $cx->query($sql2);
  while ($row2 = $resultado2->fetch_assoc()) {
    $uti_ene = $row2["pac_uti_ene"];
    $uti_feb = $row2["pac_uti_feb"];
    $uti_mar = $row2["pac_uti_mar"];
    $uti_abr = $row2["pac_uti_abr"];
    $uti_may = $row2["pac_uti_may"];
    $uti_jun = $row2["pac_uti_jun"];
    $uti_jul = $row2["pac_uti_jul"];
    $uti_ago = $row2["pac_uti_ago"];
    $uti_sep = $row2["pac_uti_sep"];
    $uti_oct = $row2["pac_uti_oct"];
    $uti_nov = $row2["pac_uti_nov"];
    $uti_dic = $row2["pac_uti_dic"];
    $uti_rez = $row2["uti_rezago"];
  }



  $adi_pac_ene = $_POST["adi_pac_ene"];
  $red_pac_ene = $_POST["red_pac_ene"];
  $pac_def_ene = ($enero + $adi_pac_ene) - $red_pac_ene;
  $pac_uti_ene = $_POST["pac_uti_ene"];
  $sal_pac_ene = $pac_def_ene - $pac_uti_ene;

  $adi_pac_feb = $_POST["adi_pac_feb"];
  $red_pac_feb = $_POST["red_pac_feb"];
  $pac_def_feb = ($febrero + $adi_pac_feb) - $red_pac_feb + $sal_pac_ene;
  $pac_uti_feb = $_POST["pac_uti_feb"];
  $sal_pac_feb = $pac_def_feb - $pac_uti_feb;

  $adi_pac_mar = $_POST["adi_pac_mar"];
  $red_pac_mar = $_POST["red_pac_mar"];
  $pac_def_mar = ($marzo + $adi_pac_mar) - $red_pac_mar + $sal_pac_feb;
  $pac_uti_mar = $_POST["pac_uti_mar"];
  $sal_pac_mar = $pac_def_mar - $pac_uti_mar;

  $adi_pac_abr = $_POST["adi_pac_abr"];
  $red_pac_abr = $_POST["red_pac_abr"];
  $pac_def_abr = ($abril + $adi_pac_abr) - $red_pac_abr + $sal_pac_mar;
  $pac_uti_abr = $_POST["pac_uti_abr"];
  $sal_pac_abr = $pac_def_abr - $pac_uti_abr;

  $adi_pac_may = $_POST["adi_pac_may"];
  $red_pac_may = $_POST["red_pac_may"];
  $pac_def_may = ($mayo + $adi_pac_may) - $red_pac_may + $sal_pac_abr;
  $pac_uti_may = $_POST["pac_uti_may"];
  $sal_pac_may = $pac_def_may - $pac_uti_may;

  $adi_pac_jun = $_POST["adi_pac_jun"];
  $red_pac_jun = $_POST["red_pac_jun"];
  $pac_def_jun = ($junio + $adi_pac_jun) - $red_pac_jun + $sal_pac_may;
  $pac_uti_jun = $_POST["pac_uti_jun"];
  $sal_pac_jun = $pac_def_jun - $pac_uti_jun;

  $adi_pac_jul = $_POST["adi_pac_jul"];
  $red_pac_jul = $_POST["red_pac_jul"];
  $pac_def_jul = ($julio + $adi_pac_jul) - $red_pac_jul + $sal_pac_jun;
  $pac_uti_jul = $_POST["pac_uti_jul"];
  $sal_pac_jul = $pac_def_jul - $pac_uti_jul;

  $adi_pac_ago = $_POST["adi_pac_ago"];
  $red_pac_ago = $_POST["red_pac_ago"];
  $pac_def_ago = ($agosto + $adi_pac_ago) - $red_pac_ago + $sal_pac_jul;
  $pac_uti_ago = $_POST["pac_uti_ago"];
  $sal_pac_ago = $pac_def_ago - $pac_uti_ago;

  $adi_pac_sep = $_POST["adi_pac_sep"];
  $red_pac_sep = $_POST["red_pac_sep"];
  $pac_def_sep = ($septiembre + $adi_pac_sep) - $red_pac_sep + $sal_pac_ago;
  $pac_uti_sep = $_POST["pac_uti_sep"];
  $sal_pac_sep = $pac_def_sep - $pac_uti_sep;

  $adi_pac_oct = $_POST["adi_pac_oct"];
  $red_pac_oct = $_POST["red_pac_oct"];
  $pac_def_oct = ($octubre + $adi_pac_oct) - $red_pac_oct + $sal_pac_sep;
  $pac_uti_oct = $_POST["pac_uti_oct"];
  $sal_pac_oct = $pac_def_oct - $pac_uti_oct;

  $adi_pac_nov = $_POST["adi_pac_nov"];
  $red_pac_nov = $_POST["red_pac_nov"];
  $pac_def_nov = ($noviembre + $adi_pac_nov) - $red_pac_nov + $sal_pac_oct;
  $pac_uti_nov = $_POST["pac_uti_nov"];
  $sal_pac_nov = $pac_def_nov - $pac_uti_nov;

  $adi_pac_dic = $_POST["adi_pac_dic"];
  $red_pac_dic = $_POST["red_pac_dic"];
  $pac_def_dic = ($diciembre + $adi_pac_dic) - $red_pac_dic + $sal_pac_nov;
  $pac_uti_dic = $_POST["pac_uti_dic"];
  $sal_pac_dic = $pac_def_dic - $pac_uti_dic;

  $adi_rezago = $_POST["adi_rezago"];
  $red_rezago = $_POST["red_rezago"];
  $def_rezago = ($rezago + $adi_rezago) - $red_rezago + $sal_pac_dic;
  $uti_rezago = $uti_rez;
  $sal_rezago = $def_rezago - $uti_rezago;

  $suma_adi = $adi_pac_ene + $adi_pac_feb + $adi_pac_mar + $adi_pac_abr + $adi_pac_may + $adi_pac_jun + $adi_pac_jul + $adi_pac_ago +
    $adi_pac_sep + $adi_pac_oct + $adi_pac_nov + $adi_pac_dic + $adi_rezago;
  $suma_red = $red_pac_ene + $red_pac_feb + $red_pac_mar + $red_pac_abr + $red_pac_may + $red_pac_jun + $red_pac_jul + $red_pac_ago +
    $red_pac_sep + $red_pac_oct + $red_pac_nov + $red_pac_dic + $red_rezago;
  $suma_def = $pac_def_ene + $pac_def_feb + $pac_def_mar + $pac_def_abr + $pac_def_may + $pac_def_jun + $pac_def_jul + $pac_def_ago +
    $pac_def_sep + $pac_def_oct + $pac_def_nov + $pac_def_dic + $def_rezago;
  $suma_uti = $pac_uti_ene + $pac_uti_feb + $pac_uti_mar + $pac_uti_abr + $pac_uti_may + $pac_uti_jun + $pac_uti_jul + $pac_uti_ago +
    $pac_uti_sep + $pac_uti_oct + $pac_uti_nov + $pac_uti_dic + $uti_rezago;



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
        font-weight: bold
      }

      .Estilo9 {
        font-weight: bold
      }

      .Estilo10 {
        color: #FFFFFF
      }

      .Estilo11 {
        font-size: 10px;
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
      }
    </style>
  </head>


  </head>

  <body>
    <table width="892" border="0" align="center">
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
                  <div align="center"><a href='adi_red_pac_ing.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <table width="800" border="0" align="center">

            <tr>
              <td>
                <form name="b" method="post" action="proc_adi_red_pac_ing_2.php" onsubmit="return confirm('Desea Grabar Cambios?')">
                  <div align="center"><span class="Estilo4"><strong> - P.A.C - Cuenta Seleccionada</strong>
                      <br />
                    </span><br />
                    <table width="750" border="1" align="center" class="bordepunteado1">
                      <tr>
                        <td width="250" bgcolor="#DCE9E5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><strong>CODIGO : </strong></div>
                            </div>
                          </div>
                        </td>
                        <td colspan="2" bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="left"><?php printf('%s', $cod_pptal); ?>
                                <input name="cod_pptal" type="hidden" id="cod_pptal" value="<?php printf('%s', $cod_pptal); ?>" />
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
                        <td colspan="2" bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="left">
                              <span class="Estilo4"><?php printf('%s', $nom_rubro); ?></span>
                              <input name="nom_rubro" type="hidden" id="nom_rubro" value="<?php printf('%s', $nom_rubro); ?>" />
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#DCE9E5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="right"><span class="Estilo4"><strong>VALOR APROPIADO : </strong></span></div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="left">
                              <span class="Estilo4"><?php printf('%.2f', $definitivo); ?></span>
                              <input name="definitivo" type="hidden" id="definitivo" value="<?php printf('%.2f', $definitivo); ?>" />
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td width="250" bgcolor="#DCE9E5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><strong>MESES : </strong></div>
                            </div>
                          </div>
                        </td>
                        <td width="250" bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="left"><span class="Estilo4"> <?php printf('%d', $meses); ?></span>
                              <input name="meses" type="hidden" id="meses" value="<?php printf('%d', $meses); ?>" />
                            </div>
                          </div>
                        </td>
                        <td width="250" bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center"></div>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <br />
                    <table width="880" border="1" align="center" class="bordepunteado1">
                      <tr>
                        <td bgcolor="#DCE9E5" width="100">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>MES</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>P.A.C PROGRAMADO </strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="150">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>ADICIONES</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="150">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>REDUCCIONES</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>P.A.C DEFINITIVO </strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>P.A.C UTILIZADO </strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>SALDO P.A.C MES SIGUI. </strong></div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>ENERO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="enero" type="hidden" value="<?php printf('%.2f', $enero); ?>" />
                                <?php printf('%.2f', $enero); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF" width="150">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_ene" type="hidden" id="adi_pac_ene" value="<?php printf('%.2f', $adi_pac_ene); ?>" />
                                <?php printf('%.2f', $adi_pac_ene); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF" width="150">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_ene" type="hidden" value="<?php printf('%.2f', $red_pac_ene); ?>" />
                                <?php printf('%.2f', $red_pac_ene); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_ene" type="hidden" value="<?php printf('%.2f', $pac_def_ene); ?>" />
                                <?php printf('%.2f', $pac_def_ene); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_ene" type="hidden" value="<?php printf('%.2f', $pac_uti_ene); ?>" />
                                <?php printf('%.2f', $pac_uti_ene); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_ene" type="hidden" value="<?php printf('%.2f', $sal_pac_ene); ?>" />
                                <?php printf('%.2f', $sal_pac_ene); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>FEBRERO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="febrero" type="hidden" id="febrero" value="<?php printf('%.2f', $febrero); ?>" />
                                <?php printf('%.2f', $febrero); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_feb" type="hidden" value="<?php printf('%.2f', $adi_pac_feb);   ?>" />
                                <?php printf('%.2f', $adi_pac_feb);  ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_feb" type="hidden" value="<?php printf('%.2f', $red_pac_feb); ?>" />
                                <?php printf('%.2f', $red_pac_feb); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_feb" type="hidden" value="<?php printf('%.2f', $pac_def_feb); ?>" />
                                <?php printf('%.2f', $pac_def_feb); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_feb" type="hidden" value="<?php printf('%.2f', $pac_uti_feb); ?>" />
                                <?php printf('%.2f', $pac_uti_feb); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_feb" type="hidden" value="<?php printf('%.2f', $sal_pac_feb); ?>" />
                                <?php printf('%.2f', $sal_pac_feb); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>MARZO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="marzo" type="hidden" id="marzo" value="<?php printf('%.2f', $marzo); ?>" />
                                <?php printf('%.2f', $marzo); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_mar" type="hidden" value="<?php printf('%.2f', $adi_pac_mar); ?>" />
                                <?php printf('%.2f', $adi_pac_mar); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_mar" type="hidden" value="<?php printf('%.2f', $red_pac_mar); ?>" />
                                <?php printf('%.2f', $red_pac_mar); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_mar" type="hidden" value="<?php printf('%.2f', $pac_def_mar); ?>" />
                                <?php printf('%.2f', $pac_def_mar); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_mar" type="hidden" value="<?php printf('%.2f', $pac_uti_mar); ?>" />
                                <?php printf('%.2f', $pac_uti_mar); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_mar" type="hidden" value="<?php printf('%.2f', $sal_pac_mar); ?>" />
                                <?php printf('%.2f', $sal_pac_mar); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>ABRIL</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">

                              <div align="right">
                                <input name="abril" type="hidden" id="abril" value="<?php printf('%.2f', $abril); ?>" />
                                <?php printf('%.2f', $abril); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_abr" type="hidden" value="<?php printf('%.2f', $adi_pac_abr); ?>" />
                                <?php printf('%.2f', $adi_pac_abr); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_abr" type="hidden" value="<?php printf('%.2f', $red_pac_abr); ?>" />
                                <?php printf('%.2f', $red_pac_abr); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_abr" type="hidden" value="<?php printf('%.2f', $pac_def_abr); ?>" />
                                <?php printf('%.2f', $pac_def_abr); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_abr" type="hidden" value="<?php printf('%.2f', $pac_uti_abr); ?>" />
                                <?php printf('%.2f', $pac_uti_abr); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_abr" type="hidden" value="<?php printf('%.2f', $sal_pac_abr); ?>" />
                                <?php printf('%.2f', $sal_pac_abr); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>MAYO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="mayo" type="hidden" id="mayo" value="<?php printf('%.2f', $mayo); ?>" />
                                <?php printf('%.2f', $mayo); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_may" type="hidden" value="<?php printf('%.2f', $adi_pac_may); ?>" />
                                <?php printf('%.2f', $adi_pac_may); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_may" type="hidden" value="<?php printf('%.2f', $red_pac_may); ?>" />
                                <?php printf('%.2f', $red_pac_may); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_may" type="hidden" value="<?php printf('%.2f', $pac_def_may); ?>" />
                                <?php printf('%.2f', $pac_def_may); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_may" type="hidden" value="<?php printf('%.2f', $pac_uti_may); ?>" />
                                <?php printf('%.2f', $pac_uti_may); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_may" type="hidden" value="<?php printf('%.2f', $sal_pac_may); ?>" />
                                <?php printf('%.2f', $sal_pac_may); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>JUNIO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="junio" type="hidden" id="junio" value="<?php printf('%.2f', $junio); ?>" />
                                <?php printf('%.2f', $junio); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_jun" type="hidden" value="<?php printf('%.2f', $adi_pac_jun); ?>" />
                                <?php printf('%.2f', $adi_pac_jun); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_jun" type="hidden" value="<?php printf('%.2f', $red_pac_jun); ?>" />
                                <?php printf('%.2f', $red_pac_jun); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_jun" type="hidden" value="<?php printf('%.2f', $pac_def_jun); ?>" />
                                <?php printf('%.2f', $pac_def_jun); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_jun" type="hidden" value="<?php printf('%.2f', $pac_uti_jun); ?>" />
                                <?php printf('%.2f', $pac_uti_jun); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_jun" type="hidden" value="<?php printf('%.2f', $sal_pac_jun); ?>" />
                                <?php printf('%.2f', $sal_pac_jun); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>JULIO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="julio" type="hidden" id="julio" value="<?php printf('%.2f', $julio); ?>" />
                                <?php printf('%.2f', $julio); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_jul" type="hidden" value="<?php printf('%.2f', $adi_pac_jul); ?>" />
                                <?php printf('%.2f', $adi_pac_jul); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_jul" type="hidden" value="<?php printf('%.2f', $red_pac_jul); ?>" />
                                <?php printf('%.2f', $red_pac_jul); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_jul" type="hidden" value="<?php printf('%.2f', $pac_def_jul); ?>" />
                                <?php printf('%.2f', $pac_def_jul); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_jul" type="hidden" value="<?php printf('%.2f', $pac_uti_jul); ?>" />
                                <?php printf('%.2f', $pac_uti_jul); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_jul" type="hidden" value="<?php printf('%.2f', $sal_pac_jul); ?>" />
                                <?php printf('%.2f', $sal_pac_jul); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>AGOSTO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="agosto" type="hidden" id="agosto" value="<?php printf('%.2f', $agosto); ?>" />
                                <?php printf('%.2f', $agosto); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_ago" type="hidden" value="<?php printf('%.2f', $adi_pac_ago); ?>" />
                                <?php printf('%.2f', $adi_pac_ago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_ago" type="hidden" value="<?php printf('%.2f', $red_pac_ago); ?>" />
                                <?php printf('%.2f', $red_pac_ago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_ago" type="hidden" value="<?php printf('%.2f', $pac_def_ago); ?>" />
                                <?php printf('%.2f', $pac_def_ago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_ago" type="hidden" value="<?php printf('%.2f', $pac_uti_ago); ?>" />
                                <?php printf('%.2f', $pac_uti_ago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_ago" type="hidden" value="<?php printf('%.2f', $sal_pac_ago); ?>" />
                                <?php printf('%.2f', $sal_pac_ago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>SEPTIEMBRE</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="septiembre" type="hidden" id="septiembre" value="<?php printf('%.2f', $septiembre); ?>" />
                                <?php printf('%.2f', $septiembre); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_sep" type="hidden" value="<?php printf('%.2f', $adi_pac_sep); ?>" />
                                <?php printf('%.2f', $adi_pac_sep); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_sep" type="hidden" value="<?php printf('%.2f', $red_pac_sep); ?>" />
                                <?php printf('%.2f', $red_pac_sep); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_sep" type="hidden" value="<?php printf('%.2f', $pac_def_sep); ?>" />
                                <?php printf('%.2f', $pac_def_sep); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_sep" type="hidden" value="<?php printf('%.2f', $pac_uti_sep); ?>" />
                                <?php printf('%.2f', $pac_uti_sep); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_sep" type="hidden" value="<?php printf('%.2f', $sal_pac_sep); ?>" />
                                <?php printf('%.2f', $sal_pac_sep); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>OCTUBRE</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="octubre" type="hidden" id="octubre" value="<?php printf('%.2f', $octubre); ?>" />
                                <?php printf('%.2f', $octubre); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_oct" type="hidden" value="<?php printf('%.2f', $adi_pac_oct); ?>" />
                                <?php printf('%.2f', $adi_pac_oct); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_oct" type="hidden" value="<?php printf('%.2f', $red_pac_oct); ?>" />
                                <?php printf('%.2f', $red_pac_oct); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_oct" type="hidden" value="<?php printf('%.2f', $pac_def_oct); ?>" />
                                <?php printf('%.2f', $pac_def_oct); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_oct" type="hidden" value="<?php printf('%.2f', $pac_uti_oct); ?>" />
                                <?php printf('%.2f', $pac_uti_oct); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_oct" type="hidden" value="<?php printf('%.2f', $sal_pac_oct); ?>" />
                                <?php printf('%.2f', $sal_pac_oct); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>NOVIEMBRE</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="noviembre" type="hidden" id="noviembre" value="<?php printf('%.2f', $noviembre); ?>" />
                                <?php printf('%.2f', $noviembre); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_nov" type="hidden" value="<?php printf('%.2f', $adi_pac_nov); ?>" />
                                <?php printf('%.2f', $adi_pac_nov); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_nov" type="hidden" value="<?php printf('%.2f', $red_pac_nov); ?>" />
                                <?php printf('%.2f', $red_pac_nov); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_nov" type="hidden" value="<?php printf('%.2f', $pac_def_nov); ?>" />
                                <?php printf('%.2f', $pac_def_nov); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_nov" type="hidden" value="<?php printf('%.2f', $pac_uti_nov); ?>" />
                                <?php printf('%.2f', $pac_uti_nov); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_nov" type="hidden" value="<?php printf('%.2f', $sal_pac_nov); ?>" />
                                <?php printf('%.2f', $sal_pac_nov); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>DICIEMBRE</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="diciembre" type="hidden" id="diciembre" value="<?php printf('%.2f', $diciembre); ?>" />
                                <?php printf('%.2f', $diciembre); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_pac_dic" type="hidden" value="<?php printf('%.2f', $adi_pac_dic); ?>" />
                                <?php printf('%.2f', $adi_pac_dic); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_pac_dic" type="hidden" value="<?php printf('%.2f', $red_pac_dic); ?>" />
                                <?php printf('%.2f', $red_pac_dic); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_def_dic" type="hidden" value="<?php printf('%.2f', $pac_def_dic); ?>" />
                                <?php printf('%.2f', $pac_def_dic); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="pac_uti_dic" type="hidden" value="<?php printf('%.2f', $pac_uti_dic); ?>" />
                                <?php printf('%.2f', $pac_uti_dic); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_pac_dic" type="hidden" value="<?php printf('%.2f', $sal_pac_dic); ?>" />
                                <?php printf('%.2f', $sal_pac_dic); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>REZAGO</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="rezago" type="hidden" id="rezago" value="<?php printf('%.2f', $rezago); ?>" />
                                <?php printf('%.2f', $rezago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="adi_rezago" type="hidden" value="<?php printf('%.2f', $adi_rezago); ?>" />
                                <?php printf('%.2f', $adi_rezago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="red_rezago" type="hidden" value="<?php printf('%.2f', $red_rezago); ?>" />
                                <?php printf('%.2f', $red_rezago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="def_rezago" type="hidden" value="<?php printf('%.2f', $def_rezago); ?>" />
                                <?php printf('%.2f', $def_rezago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="uti_rezago" type="hidden" value="<?php printf('%.2f', $uti_rezago); ?>" />
                                <?php printf('%.2f', $uti_rezago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="sal_rezago" type="hidden" value="<?php printf('%.2f', $sal_rezago); ?>" />
                                <?php printf('%.2f', $sal_rezago); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>TOTAL SUMA </strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><strong>
                                  <input name="total" type="hidden" id="total" value="<?php printf('%.2f', $total); ?>" />
                                  <?php printf('%.2f', $total); ?> </strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div class="Estilo8" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="suma_adi" type="hidden" value="<?php printf('%.2f', $suma_adi); ?>" />
                                <?php printf('%.2f', $suma_adi); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="suma_red" type="hidden" value="<?php printf('%.2f', $suma_red); ?>" />
                                <?php printf('%.2f', $suma_red); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">&nbsp;</td>
                        <td bgcolor="#F5F5F5">&nbsp;</td>
                        <td bgcolor="#F5F5F5">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>DIF. P.A.C APROP. </strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="diferencia" type="hidden" id="diferencia" value="<?php printf('%.2f', $diferencia); ?>" />
                                <?php printf('%.2f', $diferencia); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                    </table>
                  </div>



                  <div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:5px; background-color:#996600">
                    <div align="center" class="Estilo4 Estilo10"><strong>
                        <input name="Submit" type="submit" class="Estilo11" id="Submit" value="Grabar Cambios y Actualizacion del  P.A.C" />
                      </strong></div>
                  </div>
                </form>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='adi_red_pac_ing.php' target='_parent'>VOLVER </a> </div>
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
        <td width="293">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><?php include('../config.php');
                                echo $nom_emp ?><br />
              <?php echo $dir_tel ?><BR />
              <?php echo $muni ?> <br />
              <?php echo $email ?> </div>
          </div>
        </td>
        <td width="293">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
              </a><BR />
              <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
            </div>
          </div>
        </td>
        <td width="292">
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