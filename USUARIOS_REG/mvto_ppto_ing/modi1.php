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
      <!--
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

      .Estilo4 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }
      -->
    </style>

    <style type="text/css">
      table.bordepunteado1 {
        border-style: solid;
        border-collapse: collapse;
        border-width: 2px;
        border-color: #004080;
      }

      .Estilo8 {
        color: #FFFFFF
      }
    </style>
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

    <?php
    include("../config.php");

    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
    $sqlxx = "select * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);
    while ($rowxx = $resultadoxx->fetch_assoc()) {
      $idxx = $rowxx["id_emp"];
    }


    $id = $_POST['id'];
    $cuenta = $_POST['cuenta'];
    $consecutivo = $_POST['consecutivo'];
    $ter_nat = $_POST['ter_nat'];
    $ter_jur = $_POST['ter_jur'];
    $des = $_POST['des'];
    $valor = $_POST['valor'];
    $nom_rubro = $_POST['nom_rubro'];

    ?>


    <center><BR>
      <span class="Estilo4"><strong>MODIFICAR EL VALOR DEL RECONOCIMIENTO </strong></span><BR>
      <br>
    </center>
    <form name="a" method="post" onSubmit="return confirm('Verifique si todos los datos estan correctos')">

      <table width="800" height="36" border="1" align="center" class="bordepunteado1">
        <tr>
          <td width="176" bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>TERCERO</strong> </div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <?php
                $query = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$idxx' and id = '$ter_jur'";
                $link = new mysqli($server, $dbuser, $dbpass, $database);
                $result = $link->query($query);
                while ($row = $result->fetch_assoc()) {
                  printf("%s", $row["raz_soc2"]);
                }
                ?>
                <?php
                $query = "SELECT * FROM terceros_naturales  WHERE id_emp = '$idxx' and id = '$ter_nat'";
                $link = new mysqli($server, $dbuser, $dbpass, $database);
                $result = $link->query($query);
                while ($row = $result->fetch_assoc()) {
                  $tercero = $row["pri_ape"] . " " . $row["seg_ape"] . " " . $row["pri_nom"] . " " . $row["seg_nom"];
                  printf("%s", $tercero);
                }
                ?>
              </div>
            </div>
          </td>
          <td width="200" bgcolor="#F5F5F5">
            <input name="id" type="hidden" id="id" value="<?php printf("%s", $id); ?>">
            <input name="consecutivo" type="hidden" id="consecutivo" value="<?php printf("%s", $consecutivo); ?>">
            <input name="old_valor" type="hidden" id="old_valor" value="<?php printf("%s", $valor); ?>">
            <input name="old_cuenta" type="hidden" id="old_cuenta" value="<?php printf("%s", $cuenta); ?>">
          </td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>RECONOCIMIENTO</strong> </div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><?php

                                    $sqlxxa = "select * from reip_ing where id_emp ='$idxx' and consecutivo ='$consecutivo' and id ='$id'";
                                    $resultadoxxa = $connectionxx->query($sqlxxa);

                                    while ($rowxxa = $resultadoxxa->fetch_assoc()) {
                                      $id_manu_reip = $rowxxa["id_manu_reip"];
                                      $valor_a = $rowxxa["valor"];
                                    }



                                    printf("%s", $id_manu_reip); ?></div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">&nbsp;</td>
        </tr>
      </table>
      <BR>
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
              <div align="center" class="Estilo4">
                <div align="center"><strong>IMPUTACION PRESUPUESTAL</strong></div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center"><span class="Estilo4"><strong>Digite Nuevo Valor</strong></span><br />
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#FFFFFF">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <center class='Estilo4'><?php printf("%s - %s<br>", $cuenta, $nom_rubro); ?>
                  <input name="cuenta" type="hidden" id="cuenta" value="<?php printf("%s", $cuenta); ?>">
                </center>

              </div>
            </div>
          </td>
          <td bgcolor="#FFFFFF">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <input name="valor" type="text" class="Estilo4" id="valor" size="20" onKeyPress="return validar(event)" style="text-align:right" value="<?php printf("%s", $valor_a); ?>" />
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#F5F5F5">
            <div class="Estilo4" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <input name="Submit322" type="submit" class="Estilo4" value="Modificar Valor" onclick="this.form.action = 'modi2.php'" />
              </div>
            </div>
          </td>
        </tr>
      </table>

    </form>
    <?php
    printf("
<br>
<center class='Estilo4'>
<form method='get' action='confirma_modificar_mvto.php'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='submit' name='Submit' value='Volver sin hacer Cambios' class='Estilo4' />
</form>
</center>
", $consecutivo);
    ?>
  </body>

  </html>

<?php
}
?>