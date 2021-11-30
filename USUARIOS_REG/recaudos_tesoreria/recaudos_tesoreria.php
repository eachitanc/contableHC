<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
  // verifico permisos del usuario
  include('../config.php');
  $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

  $sql = "SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
  $res = $cx->query($sql);
  $rw = $res->fetch_assoc();
  if ($rw['teso'] == 'SI') {

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
          color: #990000;
          font-weight: bold;
        }
      </style>
      <!--muestra - oculta naturales -->
      <SCRIPT language="javascript">
        function MostrarOcultar(objetoVisualizar) {


          if (document.all['naturales'].style.display == 'none') {
            document.all['naturales'].style.display = 'block';
            document.a.ter_nat.disabled = false;
            document.all['juridicos'].style.display = 'none';
            document.a.ter_jur.disabled = true;
          } else {
            document.a.ter_nat.disabled = true;
            document.a.ter_jur.disabled = true;
            document.all['naturales'].style.display = 'none';
            document.all['juridicos'].style.display = 'none';
          }



        }
      </SCRIPT>
      <!--muestra - oculta juridicos -->
      <SCRIPT language="javascript">
        function MostrarOcultar2(objetoVisualizar) {

          if (document.all['juridicos'].style.display == 'none') {
            document.all['naturales'].style.display = 'none';
            document.a.ter_nat.disabled = true;
            document.all['juridicos'].style.display = 'block';
            document.a.ter_jur.disabled = false;
          } else {
            document.a.ter_nat.disabled = true;
            document.a.ter_jur.disabled = true;
            document.all['naturales'].style.display = 'none';
            document.all['juridicos'].style.display = 'none';
          }



        }
      </SCRIPT>



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
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
              <div align="center">
                <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                    <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
              <div align="center" class="Estilo4"><strong>RECAUDOS TESORERIA </strong></div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
              <form method="post" action="recaudos_tesoreria.php">
                <table width="800" border="0" align="center">
                  <tr>
                    <td width="600">
                      <?php
                      include('../config.php');
                      $mesh = array('cc', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
                      $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                      $sqlxx = "select * from fecha";
                      $resultadoxx = $connectionxx->query($sqlxx);
                      $b = '';
                      $limitar='';
                      while ($rowxx = $resultadoxx->fetch_assoc()) {

                        $idxx = $rowxx["id_emp"];
                        $id_emp = $rowxx["id_emp"];
                        $ano = $rowxx["ano"];
                      }
                      list($an, $me, $di)  = explode('/', $ano);

                      // Datos para mostrar listas
                      $ini = isset($_GET['ini']) ? $_GET['ini'] : '';
                      $fin = isset($_GET['fin']) ? $_GET['fin'] : '';
                      $indice = isset($_GET['k']) ? $_GET['k'] : '';
                      $muestra = 250;
                      if (!isset($_GET['ini'])) {
                        $ini = 0;
                        $fin = $muestra;
                      }
                      ?>
                      <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                        <div align="center"><span class="Estilo4"><strong>Seleccione el Documento Fuente </strong>: </span>
                          <select name="nn" class="Estilo4" style="width: 350px;">
                            <?php
                            include('../config.php');
                            $db = new mysqli($server, $dbuser, $dbpass, $database);

                            $strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE  tes_ing = 'SI' ";
                            $rs = $db->query($strSQL);
                            while ($r = $rs->fetch_assoc()) {
                              echo "<OPTION VALUE=\"" . $r["cod"] . "\">" . $r["cod"] . " - " . $r["nombre"] . "</b></OPTION>";
                            }
                            $sq3 = "select cargo from usuarios2 where login = '$_SESSION[login]'";
                            $re3 = $db->query($sq3);
                            $rw3 = $re3->fetch_assoc();
                            $ver_boton = '';
                            if ($rw3['cargo'] == "REVISOR") {
                              $ver_boton = "style=display:none";
                            }

                            ?>
                          </select>
                        </div>
                      </div>
                    </td>
                    <td width="190">
                      <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                        <div align="center">
                          <input name="Submit" type="submit" class="Estilo4" value="Seleccionar Documento" />
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
              </form>


              <div align="center">
                <?php
                if (isset($_GET['a'])) {
                  $a = $_GET['a'];
                } else {
                  $a = '';
                }
                if (isset($_POST['nn'])) {
                  $a = $_POST['nn'];
                }

                if ($a == 'ROIT') {

                ?>
                  <BR />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong>RECIBO OFICIAL DE INGRESO - ROIT<BR />
                        <BR />
                        <BR />
                        CARTERA CONTABILIZADA <BR />
                      </strong> <span class="Estilo8">&quot;SIN RECAUDAR O RECAUDADA PARCIALMENTE &quot; </span></div>
                  </div>
                  <BR />
                  <?php
                  //-------


                  include('../config.php');
                  $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                  $sqlxx = "select * from fecha";
                  $resultadoxx = $connectionxx->query($sqlxx);

                  while ($rowxx = $resultadoxx->fetch_assoc()) {
                    $id_emp = $rowxx["id_emp"];
                    $ano = $rowxx["ano"];
                  }

                  include('../objetos/filtro.php');

                  if ($pendiente == "") {
                  } else {


                    include('../config.php');
                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    if (isset($_POST["buscar"])) {
                      $filtro = "and (consec_cartera LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                    } else {
                      $filtro = '';
                    }


                    $sa = "select * from cartera_cont where id_emp = '$id_emp' and recaudado = 'NO'";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_causa between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_causa ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_causa <= '$a2'";
                    }
                    $gby = "";
                    $orden = "order by  fecha_causa DESC";
                    $sq = "$sa $b $c $filtro $f $gby $orden";

                    $re = $cx->query($sq);

                    printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1' cellspacing='2' cellpadding='3'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RECON.</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>CAUSACION</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA CAUSAC.</b></span></td>
<td align='center' width='400'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>RECAUDAR</b></span></td>
</tr>
");

                    while ($rw = $re->fetch_assoc()) {
                      $sq3 = "select * from reip_ing where consecutivo = '$rw[id_reip]'";
                      $rs3 = $cx->query($sq3);
                      $rw3 = $rs3->fetch_assoc();
                      $sq32 = "select sum(vr_digitado) from recaudo_roit where id_reip = '$rw[id_reip]'";
                      $rs32 = $cx->query($sq32);
                      $rw32 = $rs32->fetch_assoc();
                      $saldo = $rw["valor_rec"] - $rw32["sum(vr_digitado)"];

                      printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='right'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>
<a $ver_boton href=\"recaudar1.php?id=%d\">
Recaudar
</a>
</span></td>
</tr>", $rw3["id_manu_reip"], $rw["consec_cartera"], $rw["fecha_causa"], $rw["tercero"], number_format($saldo, 2, ',', '.'), $rw["id"]);
                    }
                    printf("</table></center>");
                    //--------  ------------------------------------------------------
                  }
                  if (!isset($registrado)) {
                  } else {

                  ?>
                    <BR />
                    <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                      <div align="center"><strong> CARTERA RECAUDADA <BR />
                        </strong> <span class="Estilo8">&quot;COMPLETAMENTE &quot; </span></div>
                    </div>
                    <BR />
                    <?php
                    include('../config.php');
                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    if (isset($_POST["buscar"])) {
                      $filtro = "and (consec_cartera LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                    } else {
                      $filtro = '';
                    }


                    $sa = "select * from cartera_cont where id_emp = '$id_emp' and recaudado = 'SI'";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_causa between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_causa ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_causa between '$a1' and '$a2'";
                    }
                    $gby = "";
                    $orden = "order by fecha_causa desc";
                    $sq2 = "$sa $b $c $filtro $f $gby $orden";

                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='730' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONSEC.</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA CAUSAC.</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR RECAUDADO</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>CONSULTAR</b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='right'><span class='Estilo4'>%.2f&nbsp;</span></td>
<td align='center'><span class='Estilo4'><a $ver_boton href=\"consulta_caic.php?id=%s\">consultar</a></span></td>

</tr>", $rw2["consec_cartera"], $rw2["fecha_causa"], $rw2["tercero"], $rw2["valor_rec"], $rw2["id"]);
                    }

                    printf("</table></center>");
                    //--------  ------------------------------------------------------



                    ?>



                    <br />
                    <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                      <div align="center"><strong> RECIBOS OFICIALES DE INGRESO GENERADOS <br />
                        </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span></div>
                    </div>
                    <br />
                    <?php
                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");



                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_recau  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                    } else {
                      $filtro = '';
                    }


                    $sa = "select distinct(id_recau) , fecha_recaudo , id_reip , id_caic, tercero, id_manu_roit,vr_digitado  from recaudo_roit where id_emp = '$id_emp' and id_recau LIKE 'ROIT%'";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "";
                    $orden = "order by fecha_recaudo asc";
                    $sq = "$sa $b $c $filtro $f $gby $orden";



                    $re = $cx->query($sq);

                    printf("
<center>
<table width='840' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>No. ROIT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>No. REC/to</b></span></td>
<td align='center'><span class='Estilo4'><b>No. CAUS/n</b></span></td>
<td align='left'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='left'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>

</tr>

");

                    while ($rw = $re->fetch_assoc()) {


                      $sa = $rw["id_reip"];

                      $sqlxx1a = "select * from reip_ing where id_emp = '$id_emp' and consecutivo = '$sa' ";
                      $resultadoxx1a = $cx->query($sqlxx1a);
                      while ($rowxx1a = $resultadoxx1a->fetch_assoc()) {
                        $id_manu_reip = $rowxx1a["id_manu_reip"];
                      }


                      printf("
<span class='Estilo4'>
<tr>
<td align='center'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>

<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a href=\"borra_roit.php?id_recau=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a href=\"borra_roit.php?id_recau=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"roit_paso1.php?id2=%s\" target=\"_blank\">
<span class='Estilo4'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</span>
</a>
</td>

</tr>", $rw["id_manu_roit"], $rw["fecha_recaudo"], $id_manu_reip, $rw["id_caic"], $rw["tercero"], $rw["vr_digitado"], $rw["id_recau"], $rw["id_recau"], $rw["id_recau"]);
                    }

                    printf("</table></center>");
                    ?>
                  <?php
                  }
                } // fin esle roit 

                //******************************************************

                if ($a == 'NCBT') {

                  ?>
                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> NOTAS CREDITO BANCARIAS GENERADAS <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recaudos_sh/recaudar1.php" target="_parent">...::: CREAR NUEVA NOTA CREDITO BANCARIA :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />
                  <?php

                  include('../objetos/filtro.php');

                  if (!isset($registrado)) {
                  } else {

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");



                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_ncbt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                    } else {
                      $filtro = '';
                    }


                    $as = "select distinct(id_recau) , id_manu_ncbt, fecha_recaudo , des_recaudo, tercero from recaudo_ncbt where id_emp = '$id_emp'";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "";
                    $orden = "order by id desc";
                    $sq2 = "$as $b $c $filtro $f $gby $orden";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>NCBT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>

</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a href=\"../recaudos_sh/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a href=\"../recaudos_sh/confirma_borra_roit.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a href=\"../recaudos_sh/imp_ncbt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</span>
</td>

</tr>", $rw2["id_manu_ncbt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");
                  }
                }
                //******************************************************

                if ($a == 'TNAT') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> TRANSFERENCIAS GENERADAS <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?> &quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../transferencia_nacion/recaudar1.php" target="_parent">...::: CREAR NUEVA TRANSFERENCIA :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />

                  <?php


                  include('../objetos/filtro.php');

                  if (!isset($registrado)) {
                  } else {


                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_tnat  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    //$as = "select distinct(id_recau) , id_manu_tnat, fecha_recaudo , des_recaudo, tercero from recaudo_tnat where id_emp = '$id_emp' ";
                    $as = "select distinct(id_recau), id_manu_tnat , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_tnat where id_emp = '$id_emp' and id_manu_tnat like 'TNAT%'";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";

                    $orden = "order by id desc";
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";

                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>TNAT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>

</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../transferencia_nacion/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../transferencia_nacion/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../transferencia_nacion/imp_rcgt.php?id2=%s\" target='_blank'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>


</tr>", $rw2["id_manu_tnat"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");
                  }
                }
                //******************************************************
                if ($a == 'RCGT') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> RECIBOS DE CAJA GENERAL GENERADOS <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_caja/recaudar1.php" target="_parent">...::: CREAR NUEVO RECIBO DE CAJA GENERAL :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />

                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rcgt where id_emp = '$id_emp' and id_manu_rcgt like 'RCGT%'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by fecha_recaudo desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_caja/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_caja/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_caja/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      $archivo = '';
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }
                $sq4 = "select nombre from dctos_fuente_comprobantes where cod ='$a'";
                $rs4 = $cx->query($sq4);
                $rw4 = $rs4->fetch_assoc();

                if ($a == 'RIIP') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_predial/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />

                  <div align="left" style="padding-left:3px;"><input type="button" name="boton" value="Importar" style="background:#72A0CF; color:#FFFFFF; border:none" onclick="window.open('../imp_predial/upload.php','_self')" /></div>
                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_riip where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);
                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_predial/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_predial/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_predial/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }

                if ($a == 'RIUR') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_urban/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />

                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_riur where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_urban/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_urban/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_urban/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }


                if ($a == 'RTIC') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_rtic/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />

                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rtic where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_rtic/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_rtic/mod_ recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_rtic/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }

                if ($a == 'RICA') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_ica/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />

                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rica where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=RCGT&k=$k&nn=RCGT'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }

                if ($a == 'ICA1') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_ica1/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />
                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rica1 where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica1/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica1/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica1/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA1&k=$k&nn=ICA1'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA1&k=$k&nn=ICA1'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }

                if ($a == 'ICA2') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_ica2/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />
                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rica2 where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica2/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica2/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica2/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA2&k=$k&nn=ICA2'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA2&k=$k&nn=ICA2'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }


                if ($a == 'ICA3') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_ica3/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />
                  <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rica2 where id_emp = '$id_emp'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica3/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica3/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_ica3/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA2&k=$k&nn=ICA2'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA2&k=$k&nn=ICA2'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }



                if ($a == 'REIN') {

                  ?>

                  <br />
                  <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                    <div align="center"><strong> <?php echo $rw4['nombre']; ?> <br />
                      </strong> <span class="Estilo8">&quot;EN <?php echo $mesh[$me + 0] . " DE " . $an; ?>&quot; </span>
                      <br /><br />
                      <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                          <a href="../recibo_rever/recaudar1.php?nom=<?php echo $rw4['nombre']; ?>" target="_parent">...::: NUEVO <?php echo $rw4['nombre']; ?> :::... </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br />
                  <div align="left" style="padding-left:3px;"></div>
                <?php

                  include('../objetos/filtro.php');



                  if (!isset($registrado)) {
                  } else {



                    $limitar = "limit $ini,$fin";
                    if (isset($_POST["buscar"])) {
                      $filtro = "and (id_manu_rcgt  LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                      $limitar = '';
                    } else {
                      $filtro = '';
                    }

                    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                    $as = "select distinct(id_recau), id_manu_rcgt , fecha_recaudo , des_recaudo, tercero, sum(vr_digitado) as valor from recaudo_rcgt where id_emp = '$id_emp' and id_manu_rcgt like 'REIN%'  ";
                    if (empty($tercero)) {
                      $c = "";
                    } else {
                      $c = "and tercero =$tercero2";
                    }
                    if ($fecha2 == "MES") {
                      $f = "and fecha_recaudo between '$f1' and '$f2'";
                    }
                    if ($fecha2 == "DIA") {
                      $f = "and fecha_recaudo ='$fechafil'";
                    }
                    if ($fecha2 == "A�O") {
                      $f = "and fecha_recaudo between '$a1' and '$a2'";
                    }
                    $gby = "group by id_recau";
                    $orden = "order by id desc";


                    // Gerero listas de paginacion
                    $sql = "$as $b $c $filtro $f $gby $orden";
                    $resf = $cx->query($sql);
                    $filas = $resf->num_rows;
                    $listas = ceil($filas / $muestra);
                    $sq2 = "$as $b $c $filtro $f  $gby  $orden $limitar ";


                    $re2 = $cx->query($sq2);

                    printf("
<center>
<table width='990' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RCGT</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>

");

                    while ($rw2 = $re2->fetch_assoc()) {
                      printf("
<span class='Estilo4'>
<tr>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>%s</span>
</div>
</td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_rever/borra_alterna.php?id_recau=%s&fecha_c=%s\">
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_rever/mod_recaudar1.php?id_recau2=%s\">
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"../recibo_rever/imp_rcgt.php?id2=%s\" target=\"_blank\">
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

</tr>", $rw2["id_manu_rcgt"], $rw2["fecha_recaudo"], $rw2["des_recaudo"], $rw2["tercero"], number_format($rw2["valor"], 2, ',', '.'), $rw2["id_recau"], $rw2["fecha_recaudo"], $rw2["id_recau"], $rw2["id_recau"]);
                    }

                    printf("</table></center>");

                    echo "<&nbsp;";
                    for ($i = 0; $i < $listas; $i++) {
                      $inicio = ($i * $muestra) + 1;
                      $k = $i + 1;
                      if ($k == $indice) {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA2&k=$k&nn=ICA2'><b>$k</b></a>&nbsp;";
                      } else {
                        echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=ICA2&k=$k&nn=ICA2'>$k</a>&nbsp;";
                      }
                    }
                    echo ">&nbsp;";
                  }
                }


                ?>
              </div>
          </td>
        </tr>

        <tr>
          <td colspan="3">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
              <div align="center">

                <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                    <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
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
                    <?php echo $ano; ?>
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
  } else { // si no tiene persisos de usuario
    echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
    echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
  }
}
?>