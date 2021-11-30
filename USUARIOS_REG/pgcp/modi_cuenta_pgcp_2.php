<?php
session_start();
if (!$_SESSION["login"]) {
  header("Location: ../login.php");
  exit;
} else {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>CONTAFACIL</title>
    <link rel="StyleSheet" href="dtree.css" type="text/css" />


    <style type="text/css">
      a {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
      }

      a:visited {
        color: #666666;
        text-decoration: none;
      }

      a:hover {
        color: #666666;
        text-decoration: underline;
      }

      a:active {
        color: #666666;
        text-decoration: none;
      }

      a:link {
        text-decoration: none;
      }

      .Estilo7 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
      }

      .Estilo4 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
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

      .Estilo9 {
        font-weight: bold
      }

      .Estilo16 {
        color: #FF0000;
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: bold;
      }

      .Estilo17 {
        color: #000000
      }

      .Estilo18 {
        font-weight: bold;
        color: #000000;
      }
    </style>

    <script language="JavaScript">
      var nav4 = window.Event ? true : false;

      function acceptNum(evt) {
        // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
        var key = nav4 ? evt.which : evt.keyCode;
        return (key <= 13 || (key >= 48 && key <= 57));
      }
    </script>

    <!--habilita - desahbilita objeto con opcion de un select - bancos - -->
    <script type="text/javascript">
      function habilitar2(obj) {
        var hab;
        frm = obj.form;
        num = obj.selectedIndex;

        if (num == 0) {
          hab = true;
          frm.nom_banco1.disabled = hab;
          frm.nom_banco2.disabled = hab;
          frm.num_cta.disabled = hab;
          frm.fuentes_recursos.disabled = hab;
          frm.sispro.disabled = hab;
          frm.tip_cta.disabled = hab;
          frm.cod_sia.disabled = hab;
          frm.sispro2.disabled = hab;
          frm.cod_fut_el.disabled = hab;
        } else {
          hab = false;
          frm.nom_banco1.disabled = hab;
          frm.nom_banco2.disabled = hab;
          frm.num_cta.disabled = hab;
          frm.fuentes_recursos.disabled = hab;
          frm.sispro.disabled = hab;
          frm.tip_cta.disabled = hab;
          frm.cod_sia.disabled = hab;
          frm.sispro2.disabled = hab;
          frm.cod_fut_el.disabled = hab;
        }
      }
    </script>
  </head>

  <!--<body onload = "document.forms[0]['a'].focus()">-->

  <body>
    <?php
    include('../config.php');
    global $server, $database, $dbpass, $dbuser, $charset;
    // Conexion con la base de datos
    $cx = new mysqli($server, $dbuser, $dbpass, $database);
    $ver_banco = '';
    $sxx = "select * from fecha";
    $rxx = $cx->query($sxx);
    while ($rowxxx = $rxx->fetch_array()) {


      $idxxx = $rowxxx["id_emp"];
    }
    $a = $_GET['id'];
    $sql = "select * from pgcp where cod_pptal = '$a' and id_emp ='$idxxx'";
    $a1 = $cx->query($sql);
    //$result = $a1->fetch_array();
    while ($row = $a1->fetch_array()) {

      $nivel = $row["nivel"];
      $tip_dato = $row["tip_dato"];
      $c = $row["cod_pptal"];
      $c1 = $row["nom_rubro"];
      $c2 = $row["banco"];
      $c3 = $row["nom_banco1"];
      $c4 = $row["nom_banco2"];

      $c5 = $row["num_cta"];
      $c6 = $row["tip_cta"];
      $c7 = $row["fuentes_recursos"];
      $c8 = $row["cod_sia"];
      $c9 = $row["sispro"];
      $c10 = $row["sispro2"];
      $c11 = $row["cod_fut_el"];
      $c12 = $row["naturaleza"];
      $c13 = $row["c_nc"];
      $c14 = $row["almacen"];
      $c15 = $row["depreciable"];
      $c16 = $row["cartera"];
      $c17 = $row["tercero"];
      $c18 = $row["base"];
      $c19 = $row["c_costos"];
      $c20 = $row["cta_costos"];
      $c21 = $row["ent_recip"];
      $tipo_dato = $row["tip_dato"];
      $cta_maestra = $row["cta_maestra"];
    }
    $cta0 = substr($a, 0, 1);
    //printf("%s",$cta0);
    ?>
    <table width="630" border="0" align="center">
      <tr>
        <td>
          <div align="center"><span class="Estilo4"><strong>MODIFICA DATOS CUENTA DEL PLAN GENERAL DE CONTABILIDAD PUBLICA <br />
                P.G.C.P</strong></span><br />
            <?php
            $sxx = "select * from fecha";
            $rxx = $cx->query($sxx);

            while ($rowxxx = $rxx->fetch_array()) {

              $idxxx = $rowxxx["id_emp"];
            }
            ?>
            <BR /><span class="Estilo16"><U>ATENCION</U><br />
              <br />
              DEBE MODIFICAR TODOS Y CADA UNO DE LOS VALORES QUE SE ENCUENTREN EN LISTA DESPLEGABLE, CASO CONTRARIO,<br />
              SE ALMACENARA EL VALOR MOSTRADO POR DEFECTO.</strong></span>
          </div>
          <br />
        </td>
      </tr>
      <tr>
        <td>
          <form action="proc_modi_pgcp_2.php" method="post" name="empresa" id="empresa" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
            <table width="620" border="1" align="center" class="bordepunteado1">
              <tr>
                <td width="304" bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right">CODIGO CUENTA SELECCIONADA </div>
                    </div>
                  </div>
                </td>
                <td colspan="2" bgcolor="#F5F5F5" class="Estilo4">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left"><strong>
                        <?php



                        printf("%s", $c);


                        ?>
                      </strong>
                      <input name="cod_pptal" type="hidden" id="cod_pptal" value="<?php printf("%s", $c); ?>" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right">NIVEL CUENTA SELECCIONADA </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right">
                        <select name="nivel" class="Estilo4" id="nivel">
                          <?php
                          $niv = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);
                          for ($i = 1; $i <= 16; $i++) {
                            if ($nivel == $niv[$i]) {
                              print "<option value='$i' selected>$i</option>";
                            } else {
                              print "<option value='$i'>$i</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
                <td bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="left"></div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right">TIPO DE CUENTA </div>
                    </div>
                  </div>
                </td>
                <td width="59" bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="right">
                        <select name="tip_dato" class="Estilo4" id="tip_dato">
                          <?php
                          if ($tip_dato == 'M') {
                            print "<option value='M' selected>M</option>
                       <option value='D'>D</option>";
                          } else {
                            print "
				  <option value='M'>M</option>
                  <option value='D' selected>D</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </td>
                <td width="237" bgcolor="#F5F5F5" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center" class="Estilo4">
                      <div align="left"></div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#FFFFFF" class="Estilo4">
                  <table width="612" border="0" align="center">
                    <tr>
                      <td width="169" bgcolor="#EBEBE4" class="Estilo4">
                        <div class="Estilo17" id="div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>NOMBRE DE LA CUENTA: </strong></div>
                        </div>
                      </td>
                      <td width="433" colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <input name="nom_rubro" type="text" class="Estilo7" id="nom_rubro" tabindex="0" onkeyup="empresa.nom_rubro.value=empresa.nom_rubro.value.toUpperCase();" size="50" maxlength="200" value="<?php printf("%s", $c1); ?>" />
                            <span class="Estilo9">..</span>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div class="Estilo18" id="div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right">MANEJA BANCO : </div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                            ?>
                              <select name="banco" class="Estilo4" id="banco" onchange="habilitar2(this)">
                                <?php
                                if ($c2 == 'SI') {
                                  print "<option value='NO'>NO</option>
					    <option value='SI' selected>SI</option>";
                                } else {
                                  print "<option value='NO' selected>NO</option>
					  	<option value='SI'>SI</option>";
                                  $ver_banco = '';
                                }
                                ?>
                              </select>
                            <?php
                            } else {
                            ?>
                              <select name="banco" class="Estilo4" id="banco" onchange="habilitar2(this)" disabled="disabled">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                              </select>
                            <?php
                              $ver_banco = 'disabled="disabled"';
                            }
                            ?>

                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div2" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>NOMBRE 1 : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div16" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <input name="nom_banco1" type="text" class="Estilo7" id="nom_banco1" tabindex="0" onkeyup="empresa.nom_banco1.value=empresa.nom_banco1.value.toUpperCase();" value="<?php echo  $c3; ?>" size="50" maxlength="200" <?php echo $ver_banco; ?> />
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div3" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>NOMBRE 2 : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div17" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <input name="nom_banco2" type="text" class="Estilo7" id="nom_banco2" tabindex="0" onkeyup="empresa.nom_banco2.value=empresa.nom_banco2.value.toUpperCase();" value="<?php echo $c4; ?>" size="50" maxlength="200" <?php echo $ver_banco; ?> />
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div4" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>NUMERO DE CUENTA : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div18" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <input name="num_cta" type="text" class="Estilo7" id="num_cta" tabindex="0" onkeyup="empresa.num_cta.value=empresa.num_cta.value.toUpperCase();" value="<?php printf("%s", $c5); ?>" size="50" maxlength="200" <?php print($ver_banco); ?> />
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div33" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>TIPO DE CUENTA : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div34" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="tip_cta" class="Estilo4" id="tip_cta" <?php print($ver_banco); ?>>
                              <?php
                              if ($c6 == 'CORRIENTE') {
                                print "<option value='CORRIENTE' selected>CUENTA CORRIENTE</option>
						<option value='AHORROS'>CUENTA DE AHORROS</option>";
                              } else {
                                print "<option value='CORRIENTE'>CUENTA CORRIENTE</option>
						<option value='AHORROS' selected>CUENTA DE AHORROS</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div5" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>FUENTE DE FINANCIACION S.I.A : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div19" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="fuentes_recursos" class="Estilo4" id="fuentes_recursos" <?php print($ver_banco); ?>>
                              <?php
                              $i = 0;
                              $cod_sia = array('vacio', 'para Recursos Propios', 'SGP Sector Educacion', 'SGP Sector Salud', 'SGP Agua Potable y Saneamiento Basico', 'SGP Recreacion y Deporte', 'SGP Cultura', 'Convenios', 'Asignaciones Especiales', 'Creditos', 'Otros', 'Regalias');
                              for ($i = 1; $i <= 11; $i++) {
                                if ($c7 == "FF$i") {
                                  print "<option value='FF$i' selected> FF$i - $cod_sia[$i] </option>";
                                } else {
                                  print "<option value='FF$i'> FF$i - $cod_sia[$i] </option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div31" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>CODIGO S.I.A : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div32" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="cod_sia" class="Estilo4" id="cod_sia" <?php print($ver_banco); ?>>
                              <?php
                              $i = 0;
                              $cod_bancos = array('vacio', 'Banco de Occidente', 'Banco de Colombia', 'Banco Popular', 'Banco Agrario', 'Banco de Bogota', 'Davivienda', 'Colmena', 'Av Villas', 'Banco Caja Social', 'Banco Santander', 'Colpatria', 'BBVA', 'Lloyds TSB Bank', 'Megabanco', 'Citibank', 'Boston Bank', 'Banco Uni&oacute;n', 'Banco Tequendama', 'Banco Superior', 'Banco Sudameris', 'Banco Mercantil', 'Banco de Cr&eacute;dito', 'Banco HSBC', 'Coomeva Financiera', 'Cofinal', 'Cooacremat', 'Finamerica', 'Otros');
                              for ($i = 1; $i <= 28; $i++) {
                                if ($c8 == "B$i") {
                                  print "<option value='B$i' selected>$cod_bancos[$i] (B$i)</option>";
                                } else {
                                  print "<option value='B$i'>$cod_bancos[$i] (B$i)</option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div6" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>INFORMES SISPRO : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="sispro" class="Estilo4" id="sispro" <?php print($ver_banco); ?>>
                              <?php
                              if ($c9 == 'SI') {
                                print "<option value='SI' selected>SI</option>
						<option value='NO'>NO</option>";
                              } else {
                                print "<option value='SI'>SI</option>
						<option value='NO' selected>NO</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div6" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>SISPRO : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="sispro2" class="Estilo4" id="sispro2" <?php print($ver_banco); ?>>
                              <option value="0"></option>
                              <option value="1">BANCO DE BOGOT&Aacute;</option>
                              <option value="2">BANCO POPULAR</option>
                              <option value="6">BANCO SANTANDER</option>
                              <option value="7">BANCOLOMBIA</option>
                              <option value="8">ABN AMRO BANK</option>
                              <option value="9">CITIBANK</option>
                              <option value="10">BANISTMO COLOMBIA</option>
                              <option value="12">BANCO SUDAMERIS COLOMBIA</option>
                              <option value="13">BBVA COLOMBIA</option>
                              <option value="14">BANCO DE CR&Eacute;DITO HELM SERVICES</option>
                              <option value="19">BANCO COLPATRIA</option>
                              <option value="20">BANESTADO</option>
                              <option value="22">BANCO UNI&Oacute;N COLOMBIANO</option>
                              <option value="23">BANCO DE OCCIDENTE</option>
                              <option value="24">BANCO STANDARD CHARTERED COLOMBIA</option>
                              <option value="29">BANCO TEQUENDAMA</option>
                              <option value="30">BANCO CAJA SOCIAL</option>
                              <option value="34">BANCO SUPERIOR</option>
                              <option value="36">BANK BOSTON</option>
                              <option value="37">MEGABANCO</option>
                              <option value="39">BANCO DAVIVIENDA</option>
                              <option value="41">BANCO AGRARIO DE COLOMBIA</option>
                              <option value="48">BANCO ALIADAS</option>
                              <option value="50">GRANBANCO</option>
                              <option value="52">BANCO COMERCIAL AVVILLAS</option>
                              <option value="54">BANCO GRANAHORRAR</option>
                              <option value="55">BANCO CONAVI</option>
                              <option value="57">BANCO COLMENA</option>
                            </select>
                            <strong>ALMACENADO</strong> : <?php printf("%s", $c10); ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div6" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>CUENTA MAESTRA SALUD : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div20" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="cta_maestra" class="Estilo4" id="cta_maestra" <?php print($ver_banco); ?>>
                              <option value=''></option>
                              <?php
                              $i = 0;
                              $cuentas_m = array('REGIMEN SUBSIDIADO', 'SALUD PUBLICA COLECCTIVA', 'PRESTACION DE SERVICIOS', 'OTROS GASTOS INVERSION', 'OTROS GASTOS FUNCIONAMIENTO');

                              for ($i = 0; $i <= 4; $i++) {
                                if ($cta_maestra == "CMS$i") {
                                  print "<option value='CMS$i' selected>$cuentas_m[$i]</option>";
                                } else {
                                  print "<option value='CMS$i'>$cuentas_m[$i]</option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div35" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>CODIGO F.U.T - EXCEDENTES DE LIQUIDEZ : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div36" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="left">
                            <select name="cod_fut_el" class="Estilo4" id="cod_fut_el" style="width:400px;">
                              <option value=""></option>
                              <?php
                              $sq2 = "select * from fut_exedentes order by cod_fut asc";
                              $rs2 = $cx->query($sq2);
                              $fi2 = $rs2->num_rows;
                              for ($i = 0; $i < $fi2; $i++) {
                                $r = $rs2->fetch_array();
                                if ($c11 == $r["cod_fut"])
                                  echo "<option value=\"" . $r["cod_fut"] . "\" selected>" . $r["cod_fut"] . " - " . $r["nom_fut"] . "</b></OPTION>";
                                else
                                  echo "<option value=\"" . $r["cod_fut"] . "\">" . $r["cod_fut"] . " - " . $r["nom_fut"] . "</b></OPTION>";
                              }
                              ?>
                            </select>
                            <br />
                            <br />
                            <center>
                            </center>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="Estilo4">
                        <table width="587" border="0" align="center">
                          <tr>
                            <td colspan="4" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                              <div id="div37" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div id="div7" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>NATURALEZA </strong></div>
                              </div>
                            </td>
                            <td>
                              <div id="div21" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <select name="naturaleza" class="Estilo4" id="naturaleza">
                                    <?php
                                    if ($c12 == 'D') {
                                      print "<option value='D' selected>DEBITO</option>
                        	<option value='C'>CREDITO</option>";
                                    } else {
                                      print "<option value='D'>DEBITO</option>
                        	<option value='C' selected>CREDITO</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                            </td>
                            <td bgcolor="#EBEBE4">
                              <div id="div8" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>CORRIENTE - NO CTE</strong></div>
                              </div>
                            </td>
                            <td bgcolor="#EBEBE4">
                              <div id="div22" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <select name="c_nc" class="Estilo4" id="c_nc">
                                    <?php
                                    if ($c13 == 'C') {
                                      print "<option value='C' selected>CORRIENTE</option>
							<option value='NC'>NO CORRIENTE</option>";
                                    } else {
                                      print "<option value='C'>CORRIENTE</option>
							<option value='NC' selected>NO CORRIENTE</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td width="150" bgcolor="#EBEBE4">
                              <div id="div9" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>MANEJA ALMACEN</strong></div>
                              </div>
                            </td>
                            <td width="200" bgcolor="#EBEBE4">
                              <div id="div23" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="almacen" class="Estilo4" id="almacen">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="almacen" class="Estilo4" id="almacen" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                            <td width="150" bgcolor="#FFFFFF">
                              <div id="div10" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>DEPRECIABLE</strong></div>
                              </div>
                            </td>
                            <td width="204" bgcolor="#FFFFFF">
                              <div id="div24" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="depreciable" class="Estilo4" id="depreciable">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="depreciable" class="Estilo4" id="depreciable" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div id="div11" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>CONTROLA CARTERA</strong></div>
                              </div>
                            </td>
                            <td>
                              <div id="div25" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="cartera" class="Estilo4" id="cartera">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="cartera" class="Estilo4" id="cartera" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                            <td bgcolor="#EBEBE4">
                              <div id="div12" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>EXIJE TERCERO</strong></div>
                              </div>
                            </td>
                            <td bgcolor="#EBEBE4">
                              <div id="div26" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="tercero" class="Estilo4" id="tercero">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="tercero" class="Estilo4" id="tercero" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td bgcolor="#EBEBE4">
                              <div id="div13" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>EXIJE VALOR BASE</strong></div>
                              </div>
                            </td>
                            <td bgcolor="#EBEBE4">
                              <div id="div27" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="base" class="Estilo4" id="base">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="base" class="Estilo4" id="base" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                            <td bgcolor="#FFFFFF">
                              <div id="div14" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>EXIJE CENTRO DE COSTOS</strong></div>
                              </div>
                            </td>
                            <td bgcolor="#FFFFFF">
                              <div id="div29" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="c_costos" class="Estilo4" id="c_costos">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="c_costos" class="Estilo4" id="c_costos" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div id="div15" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                                <div align="center"><strong>CUENTA DE COSTOS</strong></div>
                              </div>
                            </td>
                            <td>
                              <div id="div30" style="padding-left:10px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                <div align="center">
                                  <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                                  ?>
                                    <select name="cta_costos" class="Estilo4" id="cta_costos">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  } else {
                                  ?>
                                    <select name="cta_costos" class="Estilo4" id="cta_costos" disabled="disabled">
                                      <option value="NO">NO</option>
                                      <option value="SI">SI</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </div>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div14" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
                          <div align="right"><strong>ENTIDAD RECIPROCA : </strong></div>
                        </div>
                      </td>
                      <td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
                        <div id="div28" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                          <div align="center">
                            <?php if ($tipo_dato == 'D' and $cta0 != '0') {
                            ?>
                              <select name="ent_recip" class="Estilo4" id="ent_recip" style="width: 400px;">
                                <?php
                                $strSQL = "SELECT * FROM terceros_cgr_ing ORDER BY cod_ter";
                                $rs = $cx->query($strSQL);
                                $nr = $rs->num_rows;
                                for ($i = 0; $i < $nr; $i++) {
                                  $r = $rs->fetch_array();
                                  echo "<OPTION VALUE=\"" . $r["cod_ter"] . "\">" . $r["cod_ter"] . " - " . $r["nom_ter"] . "</OPTION>";
                                }

                                ?>
                              </select>
                            <?php
                            } else {
                            ?>
                              <select name="ent_recip" class="Estilo4" id="ent_recip" style="width: 400px;" disabled="disabled">
                                <?php
                                $strSQL = "SELECT * FROM terceros_cgr_ing ORDER BY cod_ter";
                                $rs = $cx->query($strSQL);
                                $nr = $rs->num_rows;
                                for ($i = 0; $i < $nr; $i++) {
                                  $r = $rs->fetch_array();
                                  echo "<OPTION VALUE=\"" . $r["cod_ter"] . "\">" . $r["cod_ter"] . " - " . $r["nom_ter"] . "</OPTION>";
                                }

                                ?>
                              </select>
                            <?php
                            }
                            ?>
                          </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <input name="Submit" type="submit" class="Estilo4" value="Modificar" />
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
      <tr>
        <td>
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <!--asociado en el body para el foco
		 <form name="a" action="carga_ppto_ing.php">
		  	
			<input name="a" type="submit" class="Estilo4" value="Volver"/>
		   </form>-->
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