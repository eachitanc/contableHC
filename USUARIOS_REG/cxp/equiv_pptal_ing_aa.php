<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
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
                  <div align="center"><a href='carga_ppto_gas.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <form name='a' method="post" action="equiv_pptal_ing.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr>
                <td colspan="3" bgcolor="#DCE9E5">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <?php
                      include('../config.php');
                      $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                      $sqlxx = "select * from fecha";
                      $resultadoxx = $connectionxx->query($sqlxx);

                      while ($rowxx = $resultadoxx->fetch_assoc()) {

                        $idxx = $rowxx["id_emp"];
                      }
                      ?>

                      <strong>DEFINIR HOMOLOGACION PRESUPUESTAL PARA CUENTAS POR PAGAR </strong>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3" bgcolor="#DCE9E5">
                  <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><strong>SELECCIONE LA CUENTA </strong> </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td width="300" class="Estilo4">
                  <div class="Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">CODIGO PRESUPUESTAL</div>
                  </div>
                </td>
                <td width="432" colspan="2">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left">
                      <select name="cod_pptal" class="Estilo4" id="cod_pptal" onchange="mostrarDato();">
                        <?php
                        include('../config.php');
                        $db = new mysqli($server, $dbuser, $dbpass, $database);

                        $strSQL = "SELECT * FROM cxp WHERE id_emp = '$idxx' and tip_dato = 'D' ORDER BY cod_pptal";
                        $rs = $db->query($strSQL);
                        while ($r = $rs->fetch_assoc()) {
                          echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . " </OPTION>";
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
                      <input name="Submit" type="submit" class="Estilo4" value="Siguiente" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr class="bordepunteado1">
                <td>
                  <div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:15px;">
                    <div align="center"> <a href="rep_homologacion_ppto_cxp.php"><strong>VER INFORME DE CUENTAS HOMOLOGADAS DEL PRESUPUESTO DE CXP </strong></a> </div>
                  </div>

                  <div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:15px;">
                    <div align="center"> <a href="../sube_homo_cxp/upload.php" target="_parent"><strong>CARGAR AL SISTEMA CUENTAS HOMOLOGADAS DEL <br />
                          PRESUPUESTO DE CUENTAS X PAGAR USANDO MS Excel &copy; <br />
                        </strong> </a><img src="../Excel2007Logox50.jpg" width="50" height="50" /> </div>
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
                  <div align="center"><a href='carga_ppto_gas.php' target='_parent'>VOLVER </a> </div>
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