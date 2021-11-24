<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../../login.php");
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
        color: #FF0000;
        font-weight: bold;
      }

      .Estilo9 {
        color: #000000;
        font-weight: bold;
      }
    </style>

    <script language="">
      function cursor() {
        document.empresa.ingresa.focus();
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
    <script language="JavaScript">
      function cambia() {
        with(document.empresa) {
          ingresa.value = nn.options[nn.selectedIndex].value;
        }
      }
    </script>
  </head>

  <body onLoad=cursor()>
    <table width="600" border="0" align="center">
      <tr>

        <td colspan="3">
          <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><img src="../../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
          </div>
        </td>
      </tr>

      <tr>

        <td colspan="3">
          <?php
          include('../../config.php');
          $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
          $sqlxx = "select * from fecha";
          $resultadoxx = $connectionxx->query($sqlxx);

          while ($rowxx = $resultadoxx->fetch_assoc()) {

            $idxx = $rowxx["id_emp"];
          }
          ?>
          <form name="empresa" method="post" action="cambiar_codigo_2.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
            <table width="700" border='1' class='bordepunteado1'>

              <tr>
                <td colspan="2" bgcolor="#DCE9E5" class="Estilo4">
                  <div id="div7" style="padding-left:3px; padding-top:15px; padding-right:3px; padding-bottom:15px;">
                    <div align="center"><strong>MODIFICAR CUENTA DEL PRESUPUESTO DE GASTOS </strong><br />
                      <br />
                      <strong>Descripcion</strong>: Este proceso consiste en CAMBIAR una cuenta DETALLE a MAYOR, que NO haya sido AFECTADA por ningun usuario del Sistema, con el objetivo de corregir errores en la <strong>Carga del Presupuesto de Gastos. </strong>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2" class="Estilo4">
                  <div id="div5" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
                    <div align="center"><strong>PASO 1. </strong><br />
                      SELECCIONE la cuenta DETALLE que desea convertir a MAYOR <br /><BR />
                      <span class="Estilo8">ATENCION</span><BR />
                      <span class="Estilo4">Si cambia una cuenta creada en la CARGA INICIAL DEL PRESUPUESTO en una fecha diferente a la de INICIO DE OPERACIONES, el valor por defecto de la misma pasara a ser cero (0)
                        y debera realizar una ADICION PRESUPUESTAL para asignarle el valor correspondiente. </span><BR />
                      <span class="Estilo8">VERIFIQUE LA FECHA EN LA QUE REALIZARA ESTE CAMBIO </span>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#F5F5F5" class="Estilo4">
                  <div id="div6" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
                    <div align="center">(Puede modificar cuentas que <strong>NO</strong> tengan P.A.C, ADICIONES, REDUCCIONES o AFECTACION ALGUNA)<br /> <br />


                      <select name="nn" onchange="cambia()" class="Estilo4" style="width: 400px;">
                        <?php
                        include('../../config.php');
                        $db = new mysqli($server, $dbuser, $dbpass, $database);

                        $strSQL = "SELECT * FROM car_ppto_gas WHERE id_emp = '$idxx' AND tip_dato = 'D' AND afectado = '0' AND afectado_otros = '0' AND pac ='NO' ORDER BY cod_pptal";
                        $rs = $db->query($strSQL);
                        while ($r = $rs->fetch_assoc()) {
                          echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</OPTION>";
                        }
                        ?>
                      </select>




                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td width="350" class="Estilo4">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><strong>PASO 2. </strong><BR />
                      Digite el codigo presupuestal de la NUEVA CUENTA que dependera de la seleccionada en el paso 1 </div>
                  </div>
                </td>
                <td width="350" class="Estilo4">
                  <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

                    <div align="center">
                      <input name="ingresa" type="text" class="Estilo4" id="ingresa" size="40" maxlength="35" onkeyup="
var options = this.form.nn.options;for(var i = 0; i < options.length; i++){var match = options[i].value == this.value;if(match)break;}this.form.nn.selectedIndex = i;cambia();" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td bgcolor="#F5F5F5" class="Estilo4">
                  <div id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                    <div align="center"><strong>PASO 3.</strong><BR />
                      Verifique si el codigo ingresado es correcto </div>
                  </div>
                </td>
                <td bgcolor="#F5F5F5" class="Estilo4">
                  <div id="div4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">

                    <div align="center">
                      <input name="Submit" type="submit" class="Estilo4" value="Verificar" />
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
              <span class="Estilo4"> <strong>
                  <?php include('../../config.php');
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
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">
          <div style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF">
              <div align="center">
                <a href="../consulta_ppto_gas.php" target="_parent">VOLVER</a>
              </div>
            </div>
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="250">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><?php include('../../config.php');
                                echo $nom_emp ?><br />
              <?php echo $dir_tel ?><BR />
              <?php echo $muni ?> <br />
              <?php echo $email ?> </div>
          </div>
        </td>
        <td width="250">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><a href="../../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
              </a><BR />
              <a href="../../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
            </div>
          </div>
        </td>
        <td width="250">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
            <div align="center">Desarrollado por <br />
              <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
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