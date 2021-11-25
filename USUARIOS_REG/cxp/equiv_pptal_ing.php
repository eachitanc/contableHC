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

      .Estilo8 {
        color: #FFFFFF
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
      .Estilo9 {
        font-weight: bold
      }

      .Estilo11 {
        font-weight: bold
      }

      .Estilo12 {
        font-weight: bold
      }

      .Estilo13 {
        font-weight: bold
      }

      .Estilo14 {
        font-weight: bold
      }

      .Estilo15 {
        font-weight: bold
      }

      .Estilo16 {
        font-weight: bold
      }

      .Estilo17 {
        font-weight: bold
      }

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
        font-weight: bold
      }

      .Estilo22 {
        font-weight: bold
      }

      .Estilo23 {
        font-weight: bold
      }
    </style>

    <script type="text/javascript" language="javascript">
      function mostrarDato() {
        var campoTexto = document.getElementById('nom_rubro');
        var combo = document.getElementById('cod_pptal');
        var indice = combo.selectedIndex;
        campoTexto.value = combo.options[indice].text;
      }
      //
    </script>
    <script language="JavaScript">
      var nav4 = window.Event ? true : false;

      function acceptNum(evt) {
        // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
        var key = nav4 ? evt.which : evt.keyCode;
        return (key <= 13 || (key >= 48 && key <= 57));
      }
      //
    </script>
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
                  <div align="center"><a href='equiv_pptal_ing_aa.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <form name='a' method="post" action="proc_equiv_pptal_ing.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr>
                <td colspan="3" bgcolor="#DCE9E5">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <?php

                      $cod_pptal = $_POST['cod_pptal'];
                      //$nom_rubro=$_POST['nom_rubro'];

                      include('../config.php');
                      $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                      $sqlxx = "select * from fecha";
                      $resultadoxx = $connectionxx->query($sqlxx);

                      while ($rowxx = $resultadoxx->fetch_assoc()) {

                        $idxx = $rowxx["id_emp"];
                      }

                      $a = isset($_GET['id']) ? $_GET['id'] : '';
                      $a1 = $connectionxx->query("select * from cxp where cod_pptal = '$cod_pptal' and id_emp ='$idxx'");

                      while ($row = $a1->fetch_assoc()) {
                        $c3 = $row["nom_rubro"];
                        $c4 = $row["cod_fut"]; //ok
                        $c5 = $row["fuentes_recursos"];
                        $c6 = $row["unidad_ejecutora"];
                        $c7 = $row["situacion"]; //ok
                        //-----------------
                        $c9 = $row["cod_cgr"]; //ok
                        $c10 = $row["cod_rec"]; //ok
                        $c11 = $row["oer"]; //ok
                        $c12 = $row["cda"]; //ok
                        $c13 = $row["vigencia_gasto"];
                        $c14 = $row["finalidad_gasto"];
                        $c15 = $row["uni_ejec_cgr"];
                        $c16 = $row["ent_recip"];
                      }

                      ?>

                      <strong>DEFINIR HOMOLOGACION PRESUPUESTAL DE CUENTAS POR PAGAR </strong>

                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td width="225" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">CODIGO PRESUPUESTAL</div>
                  </div>
                </td>
                <td width="507" colspan="2" class="Estilo4">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left">
                      <?php printf("%s", $cod_pptal); ?>
                      <input name="cod_pptal" type="hidden" value="<?php printf("%s", $cod_pptal); ?>" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="Estilo4">
                  <div class="Estilo11" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">NOMBRE DEL RUBRO </div>
                  </div>
                </td>
                <td colspan="2" class="Estilo4">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left">
                      <?php printf("%s", $c3); ?>
                      <input name="nom_rubro" type="hidden" value="<?php printf("%s", $c3); ?>" />
                    </div>
                  </div>
                </td>
              </tr>
            </table>
            <BR />
            <?php
            $c1 = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
            $s1 = "select * from empresa where cod_emp = '$idxx' ";
            $r1 = $c1->query($s1);
            while ($rw1 = $r1->fetch_assoc()) {
              $uni_eje = $rw1["uni_eje"];
            }

            if ($uni_eje != 'EMPRESA') {
            ?>

              <table width="750" border="1" align="center" class="bordepunteado1">

                <tr>
                  <td width="726" bgcolor="#F5F5F5" class="Estilo4">
                    <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center"><strong>FORMATO UNICO TERRITORIAL DE GASTOS <br />
                          - F.U.T - </strong></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="Estilo4">
                    <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><strong>CODIGO - F.U.T - </strong></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><b>ACTUALMENTE</b> : <?php printf("%s", $c4); ?></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center">

                        <select name="cod_fut" class="Estilo4" id="cod_fut" style="width: 700px;">
                          <option value=""></option>
                          <?php
                          include('../config.php');
                          $query = "SELECT * FROM fut_gastos ORDER BY cod_fut";
                          $link = new mysqli($server, $dbuser, $dbpass, $database);
                          $result = $link->query($query);
                          while ($row = $result->fetch_assoc()) {
                            if ($row['cod_fut'] == $c4) {
                              echo "<OPTION VALUE=\"" . $row["cod_fut"] . "\" selected>" . $row["cod_fut"] . " - " . $row["nom_fut"] . "</b></OPTION>";
                            } else {
                              echo "<OPTION VALUE=\"" . $row["cod_fut"] . "\">" . $row["cod_fut"] . " - " . $row["nom_fut"] . "</b></OPTION>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#F5F5F5" class="Estilo4">
                    <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><strong>FUENTES RECURSOS </strong></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#F5F5F5" class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><b>ACTUALMENTE</b> : <?php printf("%s", $c5); ?></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#F5F5F5" class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center">


                        <select name="fuentes_recursos" class="Estilo4" id="fuentes_recursos" style="width: 700px;">
                          <option value=""></option>
                          <?php
                          include('../config.php');
                          $query = "SELECT * FROM fuentes_recursos ORDER BY cod";
                          $link = new mysqli($server, $dbuser, $dbpass, $database);
                          $result = $link->query($query);
                          while ($row = $result->fetch_assoc()) {
                            if ($row['cod'] == $c5) {
                              echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                            } else {
                              echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="Estilo4">
                    <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><strong>UNIDAD EJECUTORA </strong></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><b>ACTUALMENTE</b> : <?php printf("%s", $c6); ?></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center">


                        <select name="unidad_ejecutora" class="Estilo4" id="unidad_ejecutora" style="width: 700px;">
                          <option value=""></option>
                          <?php
                          include('../config.php');
                          $query = "SELECT * FROM uni_eje_fut_gastos ORDER BY cod";
                          $link = new mysqli($server, $dbuser, $dbpass, $database);
                          $result = $link->query($query);
                          while ($row = $result->fetch_assoc()) {
                            if ($row['cod'] == $c6) {
                              echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                            } else {
                              echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#F5F5F5" class="Estilo4">
                    <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><strong>CON O SIN SITUACION DE FONDOS </strong></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#F5F5F5" class="Estilo4">
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left"><b>ACTUALMENTE</b> : <?php printf("%s", $c7); ?></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor="#F5F5F5" class="Estilo4">
                    <div style="padding-left:20px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="left">
                        <select name="situacion" class="Estilo4" id="situacion">
                          <option value="C">Con Situacion</option>
                          <option value="S">Sin Situacion</option>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            <?php
            } else {
            }
            ?>

            <BR />
            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4"><strong>CATEGORIA PRESUPUESTAL DE GASTOS <br />
                        - C.G.R - </strong></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><strong>CODIGO - C.G.R - </strong></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c9); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

                    <div align="center">


                      <select name="cod_cgr" class="Estilo4" id="cod_cgr" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM cgr_gastos ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c9) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>



                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><strong>CODIGO DEL RECURSO </strong></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c10); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

                    <div align="center">


                      <select name="cod_rec" class="Estilo4" id="cod_rec" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM cod_recurso_cgr_gastos ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c10) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><strong>ORIGEN ESPECIFICO DE INGRESOS </strong>(OER)</div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c11); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

                    <div align="center">

                      <select name="oer" class="Estilo4" id="oer" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM oer_cgr_gastos ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c11) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>

                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><strong>CODIGO DESTINACION ACTIVIDAD </strong> (CDA) </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c12); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

                    <div align="center">


                      <select name="cda" class="Estilo4" id="cda" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM cda_cgr_gastos ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c12) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><strong>VIGENCIA DEL GASTO </strong></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c13); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">


                      <select name="vigencia_gasto" class="Estilo4" id="vigencia_gasto" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM vigencia_gasto_cgr ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c13) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="left"><strong>FINALIDAD DEL GASTO </strong></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c14); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">


                      <select name="finalidad_gasto" class="Estilo4" id="finalidad_gasto" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM finalidad_gasto_cgr ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c14) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="left"><strong>UNIDAD EJECUTORA </strong></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c15); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">

                      <select name="uni_ejec_cgr" class="Estilo4" id="uni_ejec_cgr" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM uni_eje_cgr_gas ORDER BY cod";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod'] == $c15) {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\" selected>" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod"] . "\">" . $row["cod"] . " - " . $row["nom"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                        <div align="left"><strong>ENTIDAD RECIPROCA </strong></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><b class="Estilo4">ACTUALMENTE</b> : <span class="Estilo4"><?php printf("%s", $c16); ?></span></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">

                      <select name="ent_recip" class="Estilo4" id="ent_recip" style="width: 700px;">
                        <option value=""></option>
                        <?php
                        include('../config.php');
                        $query = "SELECT * FROM terceros_cgr_ing ORDER BY cod_ter";
                        $link = new mysqli($server, $dbuser, $dbpass, $database);
                        $result = $link->query($query);
                        while ($row = $result->fetch_assoc()) {
                          if ($row['cod_ter'] == $c16) {
                            echo "<OPTION VALUE=\"" . $row["cod_ter"] . "\" selected>" . $row["cod_ter"] . " - " . $row["nom_ter"] . "</b></OPTION>";
                          } else {
                            echo "<OPTION VALUE=\"" . $row["cod_ter"] . "\">" . $row["cod_ter"] . " - " . $row["nom_ter"] . "</b></OPTION>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
            <br />

            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr class="bordepunteado1">
                <td width="736">
                  <div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:15px;">
                    <div align="center">
                      <input name="Submit" type="submit" class="Estilo4" value="Grabar" />
                      <span class="Estilo8">:::::</span>
                      <input name="Submit2" type="reset" class="Estilo4" value="Cancelar" />
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
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='equiv_pptal_ing_aa.php' target='_parent'>VOLVER </a> </div>
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