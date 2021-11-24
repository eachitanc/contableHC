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
      <!--
      .Estilo10 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
        font-weight: bold;
      }

      .Estilo9 {
        color: #FFFFFF
      }
      -->
    </style>
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
  </head>

  <body>
    <table width="800" border="0" align="center">
      <tr>

        <td colspan="3">
          <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
            <div align="center">
              <img src="images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
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
                  <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">

          <form name="a" method="post" action="con_x_tip.php">
            <table width="600" border="1" align="center" class="bordepunteado1">
              <tr>
                <td bgcolor="#DCE9E5">
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center" class="Estilo4"><strong>CONSULTA POR TIPO DE DOCUMENTO FUENTE<br />PRESUPUESTO DE INGRESOS </strong></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php
                    include('config.php');
                    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                    $sqlxx = "SELECT * from fecha";
                    $resultadoxx = $connectionxx->query($sqlxx);

                    while ($rowxx = $resultadoxx->fetch_assoc()) {

                      $idxx = $rowxx["id_emp"];
                      $id_emp = $rowxx["id_emp"];
                      $ano = $rowxx['ano'];
                    }

                    $sqlxx2 = "SELECT * from fecha_ini_op";
                    $resultadoxx2 = $connectionxx->query($sqlxx2);

                    while ($rowxx2 = $resultadoxx2->fetch_assoc()) {

                      $desde = $rowxx2["fecha_ini_op"];
                    }

                    ?>
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center"><span class="Estilo4"><strong>Seleccione el Documento Fuente </strong>: </span>
                      <SELECT name="nn" class="Estilo4" style="width: 350px;">
                        <?php
                        include('config.php');
                        $db = new mysqli($server, $dbuser, $dbpass, $database);
                        $strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE id_emp = '$idxx' AND ppto_ing = 'SI' ";
                        $rs = $db->query($strSQL);
                        while ($r = $rs->fetch_assoc()) {
                          echo "<OPTION VALUE=\"" . $r["cod"] . "\">" . $r["cod"] . " - " . $r["nombre"] . "</b></OPTION>";
                        }
                        ?>
                      </SELECT>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
            <br />
            <table width="600" border="1" align="center" class="bordepunteado1">
              <tr>
                <td colspan="2" bgcolor="#DCE9E5">
                  <div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                    <div align="center" class="Estilo4"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="Estilo10" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                    <div align="center">SELECCIONE FECHA DE INICIO </div>
                  </div>
                </td>
                <td>
                  <div class="Estilo10" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                    <div align="center">SELECCIONE FECHA FINAL </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <input name="fecha_ini" type="text" class="Estilo4" id="fecha_ini" value="<?php printf($desde); ?>" size="12" />
                      <span class="Estilo9">::</span>
                      <input name="button" type="button" class="Estilo4" id="button" onclick="displayCalendar(document.a.fecha_ini,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                    </div>
                  </div>
                </td>
                <td>
                  <div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center">
                      <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
                      <span class="Estilo9">::</span>
                      <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="Estilo10" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                    <div align="center">
                      <input name="Submit2" type="submit" class="Estilo4" value="Consultar" />
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
          <div align="center">
            <?php
            $fecha_ini = isset($_POST['fecha_ini']) ? $_POST['fecha_ini'] : '';
            $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';
            printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	", $fecha_ini, $fecha_fin);
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <?php
              $a = isset($_POST['nn']) ? $_POST['nn'] : '';
              $fecha_ini = isset($_POST['fecha_ini']) ? $_POST['fecha_ini'] : '';
              $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';
              //printf("%s<br>%s<br>%s",$a,$fecha_ini,$fecha_fin);
              if ($a == 'REIP') {

                //-------
                include('config.php');
                $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");


                //SELECT name, SUM(object1) AS o1_sum, SUM(object2) AS o2_sum FROM table GROUP BY name

                //$sq = "SELECT name, SUM(object1) AS o1_sum, SUM(object2) AS o2_sum FROM table GROUP BY name ";
                //$sq = "SELECT distinct(consecutivo),(SELECT sum(valor)), nat_com,jur_com,id_manu_reip,des from reip_ing where id_emp = '$id_emp' order by fecha_reg asc ";
                $sq = "SELECT * from reip_ing where (fecha_reg between '$fecha_ini' and '$fecha_fin' ) and id_emp = '$id_emp' order by fecha_reg asc ";
                $re = $cx->query($sq);

                printf("
<center>

<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><B>No. COMP.</b></span>
</div>
</td>
<td align='center' width='80'><span class='Estilo4'><B>FECHA</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>COD. PPTAL</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>CONCEPTO - DETALLE</b></span></td>
<td align='center' width='130'><span class='Estilo4'><B>VR. DEL DCTO</b></span></td>

</tr>

");
                $val = 0;
                while ($rw = $re->fetch_assoc()) {

                  $tercero =  $rw["nat_com"] . $rw["jur_com"];

                  printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s <br>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='right'><span class='Estilo4'> %s &nbsp;</span></td>

</tr>", $rw["id_manu_reip"], $rw["fecha_reg"], $rw["cuenta"], $rw["nom_rubro"], $tercero, $rw["des"], number_format($rw["valor"], 2, ',', '.'));
                  $val = $val + $rw["valor"];
                }

                printf("</table></center>");
                printf("
<br>
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td colspan='6' align='right'>
<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
<span class='Estilo4'><b>TOTAL: &nbsp;&nbsp;&nbsp; " . number_format($val, 2, ',', '.') . "&nbsp; </b></span>
</div>
</td>
</tr>
</table>
</center>

");
                //--------	

              }
              ?>
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
                  <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
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
                  <?php include('config.php');
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
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><?php include('config.php');
                                echo $nom_emp ?><br />
              <?php echo $dir_tel ?><BR />
              <?php echo $muni ?> <br />
              <?php echo $email ?> </div>
          </div>
        </td>
        <td width="266">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
            <div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
              </a><BR />
              <a href="../condiciones.php" target="_blank">CONDICIONES DE USO </a>
            </div>
          </div>
        </td>
        <td width="266">
          <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
            <div align="center">Desarrollado por <br />
              <a href="http://www.qualisoftsalud.com" target="_blank"><img src="images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
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