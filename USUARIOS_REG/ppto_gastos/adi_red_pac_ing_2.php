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
      .Estilo18 {
        font-weight: bold
      }

      .Estilo19 {
        font-weight: bold
      }

      .Estilo20 {
        font-weight: bold
      }

      .Estilo21 {
        font-size: 12px;
        font-weight: bold;
      }

      .Estilo22 {
        color: #FFFFFF
      }

      .Estilo23 {
        font-size: 10px;
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
      }
    </style>
  </head>


  </head>

  <body>
    <table width="880" border="0" align="center">
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
                <form name="b" method="post" action="proc_adi_red_pac_ing.php" onsubmit="return confirm('Desea Actualizar?')">
                  <div align="center"><span class="Estilo4"><span class="Estilo21"> - P.A.C - Cuenta Seleccionada</span>
                      <br />
                      <?php
                      include('../config.php');
                      $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                      $sqlxx = "SELECT * from fecha";
                      $resultadoxx = $connectionxx->query($sqlxx);

                      while ($rowxx = $resultadoxx->fetch_assoc()) {

                        $idxx = $rowxx["id_emp"];
                        $id_emp = $rowxx["id_emp"];
                        $ano = $rowxx["ano"];
                      }
                      $a = $_POST['nn'];
                      $a1x = $_POST['nn'];
                      $a1 = $connectionxx->query("SELECT * from pac_gastos where cod_pptal = '$a' and id_emp ='$idxx'");
                      while ($row = $a1->fetch_assoc()) {


                        $cod_pptal = $row["cod_pptal"];
                        $nom_rubro = $row["nom_rubro"];
                        $definitivo = $row["definitivo"];
                        $meses = $row["meses"];
                        $enero = $row["enero"];
                        $febrero = $row["febrero"];
                        $marzo = $row["marzo"];
                        $abril = $row["abril"];
                        $mayo = $row["mayo"];
                        $junio = $row["junio"];
                        $julio = $row["julio"];
                        $agosto = $row["agosto"];
                        $septiembre = $row["septiembre"];
                        $octubre = $row["octubre"];
                        $noviembre = $row["noviembre"];
                        $diciembre = $row["diciembre"];
                        $rezago = $row["rezago"];
                        $total = $row["total"];
                        $diferencia = $row["diferencia"];

                        $adi_pac_ene = $row["adi_pac_ene"];
                        $red_pac_ene = $row["red_pac_ene"];
                        $pac_def_ene = $row["pac_def_ene"];
                        $pac_uti_ene = $row["pac_uti_ene"];
                        $sal_pac_ene = $row["sal_pac_ene"];

                        $adi_pac_feb = $row["adi_pac_feb"];
                        $red_pac_feb = $row["red_pac_feb"];
                        $pac_def_feb = $row["pac_def_feb"];
                        $pac_uti_feb = $row["pac_uti_feb"];
                        $sal_pac_feb = $row["sal_pac_feb"];

                        $adi_pac_mar = $row["adi_pac_mar"];
                        $red_pac_mar = $row["red_pac_mar"];
                        $pac_def_mar = $row["pac_def_mar"];
                        $pac_uti_mar = $row["pac_uti_mar"];
                        $sal_pac_mar = $row["sal_pac_mar"];

                        $adi_pac_abr = $row["adi_pac_abr"];
                        $red_pac_abr = $row["red_pac_abr"];
                        $pac_def_abr = $row["pac_def_abr"];
                        $pac_uti_abr = $row["pac_uti_abr"];
                        $sal_pac_abr = $row["sal_pac_abr"];

                        $adi_pac_may = $row["adi_pac_may"];
                        $red_pac_may = $row["red_pac_may"];
                        $pac_def_may = $row["pac_def_may"];
                        $pac_uti_may = $row["pac_uti_may"];
                        $sal_pac_may = $row["sal_pac_may"];

                        $adi_pac_jun = $row["adi_pac_jun"];
                        $red_pac_jun = $row["red_pac_jun"];
                        $pac_def_jun = $row["pac_def_jun"];
                        $pac_uti_jun = $row["pac_uti_jun"];
                        $sal_pac_jun = $row["sal_pac_jun"];

                        $adi_pac_jul = $row["adi_pac_jul"];
                        $red_pac_jul = $row["red_pac_jul"];
                        $pac_def_jul = $row["pac_def_jul"];
                        $pac_uti_jul = $row["pac_uti_jul"];
                        $sal_pac_jul = $row["sal_pac_jul"];

                        $adi_pac_ago = $row["adi_pac_ago"];
                        $red_pac_ago = $row["red_pac_ago"];
                        $pac_def_ago = $row["pac_def_ago"];
                        $pac_uti_ago = $row["pac_uti_ago"];
                        $sal_pac_ago = $row["sal_pac_ago"];

                        $adi_pac_sep = $row["adi_pac_sep"];
                        $red_pac_sep = $row["red_pac_sep"];
                        $pac_def_sep = $row["pac_def_sep"];
                        $pac_uti_sep = $row["pac_uti_sep"];
                        $sal_pac_sep = $row["sal_pac_sep"];

                        $adi_pac_oct = $row["adi_pac_oct"];
                        $red_pac_oct = $row["red_pac_oct"];
                        $pac_def_oct = $row["pac_def_oct"];
                        $pac_uti_oct = $row["pac_uti_oct"];
                        $sal_pac_oct = $row["sal_pac_oct"];

                        $adi_pac_nov = $row["adi_pac_nov"];
                        $red_pac_nov = $row["red_pac_nov"];
                        $pac_def_nov = $row["pac_def_nov"];
                        $pac_uti_nov = $row["pac_uti_nov"];
                        $sal_pac_nov = $row["sal_pac_nov"];

                        $adi_pac_dic = $row["adi_pac_dic"];
                        $red_pac_dic = $row["red_pac_dic"];
                        $pac_def_dic = $row["pac_def_dic"];
                        $pac_uti_dic = $row["pac_uti_dic"];
                        $sal_pac_dic = $row["sal_pac_dic"];

                        $suma_adi = $row["suma_adi"];
                        $suma_red = $row["suma_red"];
                        //$suma_def=$row["suma_def"];
                        //$suma_uti=$row["suma_uti"];

                        $adi_rezago = $row["adi_rezago"];
                        $red_rezago = $row["red_rezago"];
                        $def_rezago = $row["def_rezago"];
                        $uti_rezago = $row["uti_rezago"];
                        $sal_rezago = $row["sal_rezago"];
                      }
                      $comprobar_consulta = isset($cod_pptal) ? $cod_pptal : 0;
                      if($comprobar_consulta == 0){
                        echo "<br><br>REDUCCION P.A.C DE GASTOS: NO OBTUVO NINGUN REUSLTADO";
                        exit();
                      }
                      ?>
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
                    <table width="840" border="1" align="center" class="bordepunteado1">
                      <tr>
                        <td bgcolor="#DCE9E5" width="120">
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
                        <td bgcolor="#DCE9E5" width="120">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center"><strong>ADICIONES</strong></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#DCE9E5" width="120">
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
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                //$a=date("m");
                                if ($a > 1) {
                                ?>
                                  <input name="adi_pac_ene" type="hidden" id="adi_pac_ene" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_ene" type="text" class="Estilo4" id="adi_pac_ene" style="text-align:right" value="<?php printf('%.2f', $adi_pac_ene); ?>" size="20" maxlength="20" />

                                <?php
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                //$a=date("m");
                                if ($a > 1) {
                                ?>
                                  <input name="red_pac_ene" type="hidden" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_ene" type="text" class="Estilo4" id="red_pac_ene" style="text-align:right" value="<?php printf('%.2f', $red_pac_ene); ?>" size="20" maxlength="20" />
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_ene); ?></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">

                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_ene = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/01/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_ene = $acum_ene + $vr_digitado;
                                }
                                printf('%.2f', $acum_ene);
                                ?>
                                <input name="pac_uti_ene" type="hidden" id="pac_uti_ene" value="<?php printf('%.2f', $acum_ene); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_ene = $pac_def_ene - $acum_ene;
                                printf('%.2f', $sal_pac_ene); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 2) {
                                ?>
                                  <input name="adi_pac_feb" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_feb" type="text" class="Estilo4" id="adi_pac_feb" style="text-align:right" value="<?php printf('%.2f', $adi_pac_feb); ?>" size="20" maxlength="20" />
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 2) {
                                ?>
                                  <input name="red_pac_feb" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_feb" type="text" class="Estilo4" id="red_pac_feb" style="text-align:right" value="<?php printf('%.2f', $red_pac_feb); ?>" size="20" maxlength="20" />
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_feb); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_feb = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/02/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_feb = $acum_feb + $vr_digitado;
                                }
                                printf('%.2f', $acum_feb);
                                ?>
                                <input name="pac_uti_feb" type="hidden" id="pac_uti_feb" value="<?php printf('%.2f', $acum_feb); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php $sal_pac_feb = $pac_def_feb - $acum_feb;
                                                  printf('%.2f', $sal_pac_feb); ?> </div>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 3) {
                                ?>
                                  <input name="adi_pac_mar" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_mar" type="text" class="Estilo4" id="adi_pac_mar" style="text-align:right" value="<?php printf('%.2f', $adi_pac_mar); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 3) {
                                ?>
                                  <input name="red_pac_mar" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_mar" type="text" class="Estilo4" id="red_pac_mar" style="text-align:right" value="<?php printf('%.2f', $red_pac_mar); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_mar); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_mar = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/03/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_mar = $acum_mar + $vr_digitado;
                                }
                                printf('%.2f', $acum_mar);
                                ?>
                                <input name="pac_uti_mar" type="hidden" id="pac_uti_mar" value="<?php printf('%.2f', $acum_mar); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php $sal_pac_mar = $pac_def_mar - $acum_mar;
                                                  printf('%.2f', $sal_pac_mar); ?></div>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 4) {
                                ?>
                                  <input name="adi_pac_abr" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_abr" type="text" class="Estilo4" id="adi_pac_abr" style="text-align:right" value="<?php printf('%.2f', $adi_pac_abr); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 4) {
                                ?>
                                  <input name="red_pac_abr" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_abr" type="text" class="Estilo4" id="red_pac_abr" style="text-align:right" value="<?php printf('%.2f', $red_pac_abr); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_abr); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_abr = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/04/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_abr = $acum_abr + $vr_digitado;
                                }
                                printf('%.2f', $acum_abr);
                                ?>
                                <input name="pac_uti_abr" type="hidden" id="pac_uti_abr" value="<?php printf('%.2f', $acum_abr); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_abr = $pac_def_abr - $acum_abr;
                                printf('%.2f', $sal_pac_abr); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 5) {
                                ?>
                                  <input name="adi_pac_may" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_may" type="text" class="Estilo4" id="adi_pac_may" style="text-align:right" value="<?php printf('%.2f', $adi_pac_may); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 5) {
                                ?>
                                  <input name="red_pac_may" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_may" type="text" class="Estilo4" id="red_pac_may" style="text-align:right" value="<?php printf('%.2f', $red_pac_may); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_may); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_may = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/05/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_may = $acum_may + $vr_digitado;
                                }
                                printf('%.2f', $acum_may);
                                ?>
                                <input name="pac_uti_may" type="hidden" id="pac_uti_may" value="<?php printf('%.2f', $acum_may); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_may = $pac_def_may - $acum_may;
                                printf('%.2f', $sal_pac_may); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 6) {
                                ?>
                                  <input name="adi_pac_jun" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_jun" type="text" class="Estilo4" id="adi_pac_jun" style="text-align:right" value="<?php printf('%.2f', $adi_pac_jun); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 6) {
                                ?>
                                  <input name="red_pac_jun" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_jun" type="text" class="Estilo4" id="red_pac_jun" style="text-align:right" value="<?php printf('%.2f', $red_pac_jun); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_jun); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_jun = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/06/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_jun = $acum_jun + $vr_digitado;
                                }
                                printf('%.2f', $acum_jun);
                                ?>
                                <input name="pac_uti_jun" type="hidden" id="pac_uti_jun" value="<?php printf('%.2f', $acum_jun); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_jun = $pac_def_jun - $acum_jun;
                                printf('%.2f', $sal_pac_jun); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 7) {
                                ?>
                                  <input name="adi_pac_jul" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_jul" type="text" class="Estilo4" id="adi_pac_jul" style="text-align:right" value="<?php printf('%.2f', $adi_pac_jul); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 7) {
                                ?>
                                  <input name="red_pac_jul" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_jul" type="text" class="Estilo4" id="red_pac_jul" style="text-align:right" value="<?php printf('%.2f', $red_pac_jul); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_jul); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_jul = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/07/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_jul = $acum_jul + $vr_digitado;
                                }
                                printf('%.2f', $acum_jul);
                                ?>
                                <input name="pac_uti_jul" type="hidden" id="pac_uti_jul" value="<?php printf('%.2f', $acum_jul); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_jul = $pac_def_jul - $acum_jul;
                                printf('%.2f', $sal_pac_jul); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 8) {
                                ?>
                                  <input name="adi_pac_ago" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_ago" type="text" class="Estilo4" id="adi_pac_ago" style="text-align:right" value="<?php printf('%.2f', $adi_pac_ago); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 8) {
                                ?>
                                  <input name="red_pac_ago" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_ago" type="text" class="Estilo4" id="red_pac_ago" style="text-align:right" value="<?php printf('%.2f', $red_pac_ago); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_ago); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_ago = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/08/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_ago = $acum_ago + $vr_digitado;
                                }
                                printf('%.2f', $acum_ago);
                                ?>
                                <input name="pac_uti_ago" type="hidden" id="pac_uti_ago" value="<?php printf('%.2f', $acum_ago); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_ago = $pac_def_ago - $acum_ago;
                                printf('%.2f', $sal_pac_ago); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 9) {
                                ?>
                                  <input name="adi_pac_sep" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_sep" type="text" class="Estilo4" id="adi_pac_sep" style="text-align:right" value="<?php printf('%.2f', $adi_pac_sep); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 9) {
                                ?>
                                  <input name="red_pac_sep" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_sep" type="text" class="Estilo4" id="red_pac_sep" style="text-align:right" value="<?php printf('%.2f', $red_pac_sep); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_sep); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_sep = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/09/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_sep = $acum_sep + $vr_digitado;
                                }
                                printf('%.2f', $acum_sep);
                                ?>
                                <input name="pac_uti_sep" type="hidden" id="pac_uti_sep" value="<?php printf('%.2f', $acum_sep); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_sep = $pac_def_sep - $acum_sep;
                                printf('%.2f', $sal_pac_sep); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 10) {
                                ?>
                                  <input name="adi_pac_oct" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_oct" type="text" class="Estilo4" id="adi_pac_oct" style="text-align:right" value="<?php printf('%.2f', $adi_pac_oct); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 10) {
                                ?>
                                  <input name="red_pac_oct" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_oct" type="text" class="Estilo4" id="red_pac_oct" style="text-align:right" value="<?php printf('%.2f', $red_pac_oct); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_oct); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_oct = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/10/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_oct = $acum_oct + $vr_digitado;
                                }
                                printf('%.2f', $acum_oct);
                                ?>
                                <input name="pac_uti_oct" type="hidden" id="pac_uti_oct" value="<?php printf('%.2f', $acum_oct); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_oct = $pac_def_oct - $acum_oct;
                                printf('%.2f', $sal_pac_oct); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 11) {
                                ?>
                                  <input name="adi_pac_nov" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_nov" type="text" class="Estilo4" id="adi_pac_nov" style="text-align:right" value="<?php printf('%.2f', $adi_pac_nov); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 11) {
                                ?>
                                  <input name="red_pac_nov" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_nov" type="text" class="Estilo4" id="red_pac_nov" style="text-align:right" value="<?php printf('%.2f', $red_pac_nov); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_nov); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_nov = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/11/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_nov = $acum_nov + $vr_digitado;
                                }
                                printf('%.2f', $acum_nov);
                                ?>
                                <input name="pac_uti_nov" type="hidden" id="pac_uti_nov" value="<?php printf('%.2f', $acum_nov); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_nov = $pac_def_nov - $acum_nov;
                                printf('%.2f', $sal_pac_nov); ?>
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
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 12) {
                                ?>
                                  <input name="adi_pac_dic" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="adi_pac_dic" type="text" class="Estilo4" id="adi_pac_dic" style="text-align:right" value="<?php printf('%.2f', $adi_pac_dic); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <?php
                                $a = date("m", strtotime($ano));
                                if ($a > 12) {
                                ?>
                                  <input name="red_pac_dic" type="hidden" id="adi_pac_feb" value="0" />
                                <?php
                                } else {
                                ?>
                                  <input name="red_pac_dic" type="text" class="Estilo4" id="red_pac_dic" style="text-align:right" value="<?php printf('%.2f', $red_pac_dic); ?>" size="20" maxlength="20" />
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $pac_def_dic); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php

                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $acum_dic = 0;
                                $sqlxx2 = "SELECT * from ceva where id_emp = '$id_emp' and fecha_ceva LIKE '2010/12/%'";
                                $resultadoxx2 = $connectionxx->query($sqlxx2);
                                while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
                                  $id_auto_cobp = $rowxx2["id_auto_cobp"];

                                  $sqlxx2a = "SELECT * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp' and cuenta = '$a1x' and pagado = 'SI'";
                                  $resultadoxx2a = $connectionxx->query($sqlxx2a);
                                  while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
                                    $vr_digitado = $rowxx2a["vr_digitado"];
                                  }
                                  $acum_dic = $acum_dic + $vr_digitado;
                                }
                                printf('%.2f', $acum_dic);
                                ?>
                                <input name="pac_uti_dic" type="hidden" id="pac_uti_dic" value="<?php printf('%.2f', $acum_dic); ?>" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <?php $sal_pac_dic = $pac_def_dic - $acum_dic;
                                printf('%.2f', $sal_pac_dic); ?>
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
                              <div align="center">
                                <input name="adi_rezago" type="text" class="Estilo4" id="adi_rezago" style="text-align:right" value="<?php printf('%.2f', $adi_rezago); ?>" size="20" maxlength="20" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="center">
                                <input name="red_rezago" type="text" class="Estilo4" id="red_rezago" style="text-align:right" value="<?php printf('%.2f', $red_rezago); ?>" size="20" maxlength="20" />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $def_rezago); ?></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $uti_rezago); ?></div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $sal_rezago); ?></div>
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
                          <div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right">
                                <input name="total" type="hidden" id="total" value="<?php printf('%.2f', $total); ?>" />
                                <?php printf('%.2f', $total); ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div class="Estilo19" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $suma_adi); ?> </div>
                            </div>
                          </div>
                        </td>
                        <td bgcolor="#F5F5F5">
                          <div class="Estilo20" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                            <div align="center" class="Estilo4">
                              <div align="right"><?php printf('%.2f', $suma_red); ?> </div>
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
                              <div align="center"><strong>DIF. P.A.C APROP.</strong></div>
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
                    <div align="center" class="Estilo4 Estilo22"><strong>
                        <input name="Submit" type="submit" class="Estilo23" id="Submit" value="Actualizar P.A.C para CALCULAR LOS NUEVOS SALDOS" />
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
        <td width="289">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><?php include('../config.php');
                                echo $nom_emp ?><br />
              <?php echo $dir_tel ?><BR />
              <?php echo $muni ?> <br />
              <?php echo $email ?> </div>
          </div>
        </td>
        <td width="289">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
              </a><BR />
              <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
            </div>
          </div>
        </td>
        <td width="288">
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