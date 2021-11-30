<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
?>
  <html>

  <head>
    <title>CONTAFACIL</title>
    <style type="text/css">
      a {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
      }

      a:visited {
        color: #990000;
        text-decoration: none;
      }

      a:hover {
        color: #990000;
        text-decoration: underline;
      }

      a:active {
        color: #990000;
        text-decoration: none;
      }

      a:link {
        text-decoration: none;
        color: #990000;
      }

      .Estilo4 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
        font-weight: bold;
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
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }

      .Estilo8 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }

      .Estilo8 {
        color: #FFFFFF
      }

      .Estilo9 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
      }

      .Estilo10 {
        color: #990000
      }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <script>
      function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
        patron = /\d/; //ver nota 
        te = String.fromCharCode(tecla);
        return patron.test(te);
      }
    </script>



  </head>

  <body>

    <div align="center">
      <?php
      include("../config.php");

      $consecutivo = $_GET['consecutivo'];

      // saco el id de la empresa
      $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
      $sqlxx = "select * from fecha";
      $resultadoxx = $connectionxx->query($sqlxx);
      while ($rowxx = $resultadoxx->fetch_assoc()) {
        $idxx = $rowxx["id_emp"];
      }


      $sqlxxa = "select * from reip_ing where id_emp ='$idxx' and consecutivo ='$consecutivo'";
      $resultadoxxa = $connectionxx->query($sqlxxa);

      while ($rowxxa = $resultadoxxa->fetch_assoc()) {
        $id_manu_reip = $rowxxa["id_manu_reip"];
      }


      $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
      $sq = "select * from reip_ing where id_emp = '$idxx' and consecutivo='$consecutivo' and valor > '0' order by cuenta asc ";
      $re = $cx->query($sq);

      printf("
<center>
<br>
<DIV style='background:#DCE9E5; padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px; width:800px;'>
<span class='Estilo4'>
<strong>DATOS  DEL  RECONOCIMIENTO ...::: " . $id_manu_reip . " :::...</strong>
</span>
</DIV>
<BR>
</center>
");

      printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>
<td align='center' width='250'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>MODIFICAR</b></span></td>


</tr>


");

      while ($rw = $re->fetch_assoc()) {
        printf(
          "
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo9'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo9'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo9'>&nbsp; %s </span></td>
<td align='right'><span class='Estilo9'> %.2f &nbsp;</span></td>




<td align='center'>
<br>
<form method='post' action='modi1.php'>
<input type='hidden' name='id' value='%s'>
<input type='hidden' name='cuenta' value='%s'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='hidden' name='ter_nat' value='%s'>
<input type='hidden' name='ter_jur' value='%s'>
<input type='hidden' name='des' value='%s'>
<input type='hidden' name='valor' value='%.2f'>
<input type='hidden' name='nom_rubro' value='%s'>

<input type='submit' name='Submit' value='Modificar' class='Estilo9' />
</form>
</td>



</tr>",
          $rw["cuenta"],
          $rw["nom_rubro"],
          $rw["tercero"],
          $rw["valor"],

          $rw["id"],
          $rw["cuenta"],
          $rw["consecutivo"],

          $rw["id"],
          $rw["cuenta"],
          $rw["consecutivo"],
          $rw["ter_nat"],
          $rw["ter_jur"],
          $rw["des"],
          $rw["valor"],
          $rw["nom_rubro"]

        );
      }

      ?>
      <?php
      printf("
</table>
</center>
");
      ?>
      <?php

      $sqlxx = "select * from reip_ing where consecutivo ='$consecutivo'";
      $resultadoxx = $connectionxx->query($sqlxx);
      while ($rowxx = $resultadoxx->fetch_assoc()) {
        $idxx = $rowxx["id_emp"];

        $fecha_reg = $rowxx["fecha_reg"];
        $ter_nat = $rowxx["ter_nat"];
        $ter_jur = $rowxx["ter_jur"];
        $des = $rowxx["des"];
      }
      ?>
      <br>
      <br>
      <br>
      <a href='mvto.php' target='_parent' class='Estilo10'><B> ...::: CANCELAR PROCESO y/o VOLVER :::...</B> </a><BR>
      <BR />
      <BR />
    </div>
    <div align="center"><br />
      <span class="Estilo4">SI DESEA AGREGAR UNA NUEVA IMPUTACION PRESUPUESTAL, DILIGENCIE LAS SIGUIENTES CASILLAS </span><BR />
      <BR />
    </div>
    <form name="a" method="post" onSubmit="return confirm('Verifique si todos los datos estan correctos')">
      <table width="800" border="1" align="center" class="bordepunteado1">
        <tr>
          <td width="196" bgcolor="#FFFFFF"></td>
          <td width="190" bgcolor="#FFFFFF"></td>
          <td width="186" bgcolor="#FFFFFF"></td>
          <td width="198" bgcolor="#FFFFFF"></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center" class="Estilo8">
                <div align="center" class="Estilo4"><strong>SELECCIONE IMPUTACION PRESUPUESTAL</strong></div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center"><span class="Estilo4"><strong>Valor</strong></span><br />
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#FFFFFF">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <select name="cuenta" class="Estilo9" id="cuenta" style="width: 400px;">
                  <option value=""></option>
                  <?php
                  include('../config.php');
                  $db = new mysqli($server, $dbuser, $dbpass, $database);

                  $strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx' ORDER BY cod_pptal";
                  $rs = $db->query($strSQL);
                  while ($r = $rs->fetch_assoc()) {
                    echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</b></OPTION>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </td>
          <td bgcolor="#FFFFFF">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <input name="valor" type="text" class="Estilo9" id="valor" size="20" onKeyPress="return validar(event)" style="text-align:right" />
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#FFFFFF">
            <?php $conse = substr($consecutivo, 4, 10);
            $id_manu = substr($id_manu_reip, 4, 10); ?>

            <input name="id_manu_reip" type="hidden" value="<?php printf("%s", $id_manu); ?>" />
            <input name="consecutivo" type="hidden" value="<?php printf("%s", $conse); ?>" />
            <input name="fecha_reg" type="hidden" value="<?php printf("%s", $fecha_reg); ?>" />
            <input name="ter_nat" type="hidden" value="<?php printf("%s", $ter_nat); ?>" />
            <input name="ter_jur" type="hidden" value="<?php printf("%s", $ter_jur); ?>" />
            <input name="des" type="hidden" value="<?php printf("%s", $des); ?>" />

          </td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#F5F5F5">
            <div class="Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <input name="Submit3222" type="submit" class="Estilo9" value="A&ntilde;adir Imputacion Presupuestal" onclick="this.form.action = 'p_mvto1.php'">
              </div>
            </div>
          </td>
        </tr>
      </table>

    </form>
    <br>
    <br>
    <br>
    <center><a href='mvto.php' target='_parent' class='Estilo10'><B> ...::: CANCELAR PROCESO y/o VOLVER :::...</B> </a></center><BR>
  </body>

  </html>

<?php
}
?>