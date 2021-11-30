<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
  $form = isset($_POST['Submit3222']) ? $_POST['Submit3222'] : ''; // printf("boton %s",$form);
  $pri_ape = '';
  $seg_ape = '';
  $pri_nom = '';
  $seg_nom = '';
  if (isset($_POST['Submit3222'])) {
    $consecutivo = 'REIP' . $_POST['consecutivo'];
    $id_manu_reip = 'REIP' . $_POST['id_manu_reip'];
    $fecha_reg = $_POST['fecha_reg'];
    $ter_nat = isset($_POST['ter_nat']) ? $_POST['ter_nat'] : '';
    $ter_jur = isset($_POST['ter_jur']) ? $_POST['ter_jur'] : '';
    $des = $_POST['des'];
    $cuenta = $_POST['cuenta'];
    $valor = $_POST['valor'];


    /*
printf(
"
consecutivo: %s<br>fecha_reg: %s<br>ter_nat: %s<br>ter_jur: %s<br>des: %s<br><br>

cta: %s<br>vr: %s

"

,$consecutivo,$fecha_reg,$ter_nat,$ter_jur,$des

,$cuenta, $valor

);
*/

    include('../config.php');

    // conexion				
    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

    // id_emp
    $sqlxx = "SELECT * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);

    while ($rowxx = $resultadoxx->fetch_assoc()) {
      $id_emp = $rowxx["id_emp"];
    }

    // consulta ppto
    $sql = "SELECT * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
    $resultado = $connectionxx->query($sql);;

    while ($row = $resultado->fetch_assoc()) {
      $tip_dato = $row["tip_dato"];
      $definitivo = $row["definitivo"];
      $nom_rubro = $row["nom_rubro"];
    }
    // consulta tercero nat
    $sqla = "SELECT * from terceros_naturales where id_emp ='$id_emp' and id ='$ter_nat'";
    $resultadoa = $connectionxx->query($sqla);

    while ($rowa = $resultadoa->fetch_assoc()) {
      $pri_ape = $rowa["pri_ape"];
      $seg_ape = $rowa["seg_ape"];
      $pri_nom = $rowa["pri_nom"];
      $seg_nom = $rowa["seg_nom"];
    }
    $natural = $pri_ape . " " . $seg_ape . " " . $pri_nom . " " . $seg_nom;
    $nat_com = $natural;
    //printf("%s",$nat_com);

    // consulta tercero jur
    $sqla = "SELECT * from terceros_juridicos where id_emp ='$id_emp' and id ='$ter_jur'";
    $resultadoa = $connectionxx->query($sqla);
    $rzn = $resultadoa->fetch_assoc();
    if (!empty($rzn)) {
      $raz_soc = $rzn["raz_soc2"];
    } else {
      $raz_soc = '';
    }

    //union de terceros

    $tercero = $nat_com . $raz_soc;

    // vigencia fiscal

    $consultax = $connectionxx->query("SELECT * from vf ");
    while ($rowx = $consultax->fetch_assoc()) {
      $ax = $rowx["fecha_ini"];
      $bx = $rowx["fecha_fin"];
    }


    // calculos


    $link = new mysqli($server, $dbuser, $dbpass, $database);
    $resulta = $link->query("SELECT SUM(valor) AS TOTAL from reip_ing WHERE id_emp ='$id_emp' and cuenta ='$cuenta'");
    $row = $resulta->fetch_array();
    $total = $row[0];
    $total_recaudado = $total;


    $resultb = $link->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'");
    $rowb = $resultb->fetch_array();
    $total_recaudado_ncbt = $rowb[0];


    $todo_lo_recaudado = $total_recaudado + $total_recaudado_ncbt;


    $vr_eval = $total_recaudado +  $total_recaudado_ncbt +  $valor;


    $saldox = $definitivo - $todo_lo_recaudado;



    $sqlx = "UPDATE reip_ing set saldo='$saldox' where id_emp= '$id_emp' and cuenta ='$cuenta' ";
    $resultado = $connectionxx->query($sqlx);



    // inicio del bloque
    /*if($vr_eval > $definitivo)
{
printf("<br><br><center class='Estilo4'>El <b>SALDO</b> disponible para realizar <B>RECONOCIMIENTOS</B> a la cuenta <b>".$cuenta."</b>  es <br><br>...::: ".$saldox." :::...<BR><BR><b>NO</b> puede hacer <b>RECONOCIMIENTOS</b> por un valor superior al indicado<BR><BR>Verifique su Informacion<br><br><br>");
			printf("<br><br><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>"); 
}
else
{*/
    if (($ter_nat == '' and $ter_jur == '') or $des == '' or $valor == '') {
      printf("<br><br><center class='Estilo4'><b>NO</b> debe dejar casillas del Reconocimiento sin diligenciar<BR><BR>");
      printf("<br><br><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto_reg.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
    } else {
      if ($fecha_reg > $bx or $fecha_reg < $ax) {
        printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
        printf("<br><br><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto_reg.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
      } else {
        if ($tip_dato == 'M') {
          printf("<br><br><center class='Estilo4'>NO DEBE REALIZAR RECONOCIMIENTOS A CUENTAS DE TIPO MAYOR<BR><BR>");
          printf("<br><br><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto_reg.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
        } else {
          /*	    if ($definitivo < $valor)
		{
	  		$excede = $valor - $definitivo;
			printf("<br><br><center class='Estilo4'>EL VALOR DEL RECONOCIMIENTO EXCEDE EN ...:::<B> $".$excede."</B>= :::... EL 
			VALOR DEFINITIVO DE
			 LA CUENTA<BR><BR>");
			printf("<center class='Estilo4'>VERIFIQUE SU INFORMACION<BR><BR>");
			printf("<br><br><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>"); 
		}
		else
		{*/

          $saldo = ($definitivo - $total_recaudado) - $valor;

          $sql = "INSERT INTO reip_ing ( 
				id_emp , consecutivo , fecha_reg , ter_nat, ter_jur , des , cuenta , 
				nom_rubro , valor, nat_com , jur_com, contab, tercero, definitivo, vr_recaudado, recaudo_completo, elim_cont, id_manu_reip
				) VALUES ( 
				'$id_emp','$consecutivo','$fecha_reg','$ter_nat', 
				'$ter_jur','$des','$cuenta','$nom_rubro','$valor',
				'$nat_com','$raz_soc','NO','$tercero','$definitivo','0','NO','0', '$id_manu_reip')";


          $connectionxx->query($sql);



          $sqlx = "UPDATE reip_ing set saldo='$saldo' where id_emp= '$id_emp' and cuenta ='$cuenta' ";
          $resultado = $connectionxx->query($sqlx);


          printf("<br><br><center class='Estilo4'>DATOS ALMACENADOS CON EXITO<BR><BR>");
          printf("<br><br><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto_reg.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
        }
      }
      //}	
      //}	
    }
?>
    <html>

    <head>
      <title>CONTAFACIL</title>

      <script>
        function validar(e) {
          tecla = (document.all) ? e.keyCode : e.which;
          if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
          patron = /\d/; //ver nota 
          te = String.fromCharCode(tecla);
          return patron.test(te);
        }
      </script>


      <style type="text/css">
        .Estilo4 {
          font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #333333;
        }

        .Estilo8 {
          color: #FFFFFF
        }

        table.bordepunteado1 {
          border-style: solid;
          border-collapse: collapse;
          border-width: 2px;
          border-color: #004080;
        }

        .Estilo9 {
          font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #333333;
        }

        .Estilo9 {
          font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #333333;
        }

        .Estilo15 {
          font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #333333;
          font-weight: bold;
        }

        .Estilo17 {
          font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #333333;
        }

        .Estilo17 {
          font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #333333;
        }
      </style>


    </head>

    <body>
      <br><br><br>
      <div align="center"><span class="Estilo15">RECONOCIMIENTO DE INGRESO PRESUPUESTAL</span><BR>
      </div>
      <form name="a" method="post" onSubmit="return confirm('Verifique si todos los datos estan correctos')">
        <table width="800" border="1" align="center" class="bordepunteado1">
          <tr>
            <td width="286" bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo10">
                  <div align="center" class="Estilo17"><strong>CONSECUTIVO</strong> </div>
                </div>
              </div>
            </td>
            <td width="215" bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo13">
                  <div align="center" class="Estilo4">
                    <?php
                    $a = substr($consecutivo, 4, 10);



                    $sqlxxa = "SELECT * from reip_ing where id_emp ='$id_emp' and consecutivo ='$consecutivo'";
                    $resultadoxxa = $connectionxx->query($sqlxxa);

                    while ($rowxxa = $resultadoxxa->fetch_assoc()) {
                      $id_manu_reip = $rowxxa["id_manu_reip"];
                    }

                    printf("%s", $id_manu_reip);
                    $b = substr($id_manu_reip, 4, 10);

                    ?>
                    <input name="consecutivo" type="hidden" id="consecutivo" value="<?php printf("%s", $a); ?>">
                    <input name="id_manu_reip" type="hidden" id="id_manu_reip" value="<?php printf("%s", $b); ?>">
                  </div>
                </div>
              </div>
            </td>
            <td width="275" bgcolor="#F5F5F5">
              <input type="hidden" name="ter_nat" value="<?php printf("%s", $ter_nat); ?>"></input>
              <input name="ter_jur" type="hidden" id="ter_jur" value="<?php printf("%s", $ter_jur); ?>">
            </td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo10">
                  <div align="center" class="Estilo4"><strong>FECHA</strong> </div>
                </div>
              </div>
            </td>
            <td bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo13">
                  <div align="center" class="Estilo4"><?php printf("%s", $fecha_reg); ?>
                    <input name="fecha_reg" type="hidden" id="fecha_reg" value="<?php printf("%s", $fecha_reg); ?>">
                  </div>
                </div>
              </div>
            </td>
            <td bgcolor="#F5F5F5">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo9">
                  <div align="center"><strong>TERCERO</strong> </div>
                </div>
              </div>
            </td>
            <td colspan="2" bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo13">
                  <div align="center" class="Estilo4"><?php printf("%s", $tercero); ?></div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo12">
                  <div align="center" class="Estilo4"><strong>DESCRIPCION DEL RECONOCIMIENTO</strong> </div>
                </div>
              </div>
            </td>
            <td colspan="2" bgcolor="#F5F5F5">
              <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center" class="Estilo13">
                  <div align="center" class="Estilo4"><?php printf("%s", $des); ?>
                    <input name="des" type="hidden" id="des" value="<?php printf("%s", $des); ?>">
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </table>
        <div align="center"><br />
          <span class="Estilo15">IMPUTACIONES PRESUPUESTALES A&Ntilde;ADIDAS AL RECONOCIMIENTO ...::: <?php printf("%s", $consecutivo); ?> :::... </span><br><br>

          <?php
          //-------
          include('../config.php');
          $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
          $sq = "SELECT * from reip_ing where id_emp = '$id_emp' and consecutivo ='$consecutivo' order by consecutivo asc ";
          $re = $cx->query($sq);

          printf("
<center>

<table width='800' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>
<td align='center' width='275'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center' width='275'><span class='Estilo4'><b>TERCERO</b></span></td>

</tr>


");

          while ($rw = $re->fetch_assoc()) {
            printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s&nbsp; </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>


</tr>", $rw["cuenta"], $rw["nom_rubro"], $rw["valor"], $rw["tercero"]);
          }

          printf("</table></center><br><br>");
          //--------	
          ?>


        </div>
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
                  <div align="center"><strong>SELECCIONE IMPUTACION PRESUPUESTAL</strong></div>
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
                  <select name="cuenta" class="Estilo4" id="cuenta" style="width: 400px;">
                    <option value=""></option>
                    <?php
                    include('../config.php');
                    $db = new mysqli($server, $dbuser, $dbpass, $database);

                    $strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$id_emp' ORDER BY cod_pptal";
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
                  <input name="valor" type="text" class="Estilo4" id="valor" size="20" onKeyPress="return validar(event)" style="text-align:right" />
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
                  <input name="Submit3222" type="submit" class="Estilo4" value="A&ntilde;adir Otra Imputacion Presupuestal y Continuar" onclick="this.form.action = 'a_mvto1.php'" />
                  <span class="Estilo8">:::</span>
                  <input name="Submit322" type="submit" class="Estilo4" value="Guardar Reconocimiento y Terminar" onclick="this.form.action = 'p_mvto1.php'" />
                </div>
              </div>
            </td>
          </tr>
        </table>
      </form>
    </body>

    </html>

  <?php
  }

  if (isset($_POST['Submit3223'])) {

  ?>



    <?php

    $id_manu_reip = strtoupper('REIP' . $_POST['id_manu_reip']);
    $consecutivo = 'REIP' . $_POST['consecutivo'];
    $fecha_reg = $_POST['fecha_reg'];
    $ter_nat = isset($_POST['ter_nat']) ? $_POST['ter_nat'] : '';
    $ter_jur = isset($_POST['ter_jur']) ? $_POST['ter_jur'] : '';
    $des = $_POST['des'];
    $cuenta = $_POST['cuenta'];
    $valor = $_POST['valor'];




    /*
printf(
"
consecutivo: %s<br>fecha_reg: %s<br>ter_nat: %s<br>ter_jur: %s<br>des: %s<br><br>

cta: %s<br>vr: %s

"

,$consecutivo,$fecha_reg,$ter_nat,$ter_jur,$des

,$cuenta, $valor

);
*/

    include('../config.php');

    // conexion				
    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

    // id_emp
    $sqlxx = "SELECT * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);

    while ($rowxx = $resultadoxx->fetch_assoc()) {
      $id_emp = $rowxx["id_emp"];
    }

    // consulta ppto
    $sql = "SELECT * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
    $resultado = $connectionxx->query($sql);;

    while ($row = $resultado->fetch_assoc()) {
      $tip_dato = $row["tip_dato"];
      $definitivo = $row["definitivo"];
      $nom_rubro = $row["nom_rubro"];
    }

    // consulta tercero nat
    $sqla = "SELECT * from terceros_naturales where id_emp ='$id_emp' and id ='$ter_nat'";
    $resultadoa = $connectionxx->query($sqla);

    while ($rowa = $resultadoa->fetch_assoc()) {
      $pri_ape = $rowa["pri_ape"];
      $seg_ape = $rowa["seg_ape"];
      $pri_nom = $rowa["pri_nom"];
      $seg_nom = $rowa["seg_nom"];
    }
    $natural = $pri_ape . " " . $seg_ape . " " . $pri_nom . " " . $seg_nom;
    $nat_com = $natural;
    //printf("%s",$nat_com);

    // consulta tercero jur
    $sqla = "SELECT * from terceros_juridicos where id_emp ='$id_emp' and id ='$ter_jur'";
    $resultadoa = $connectionxx->query($sqla);
    $rznsoc = $resultadoa->fetch_assoc();
    if (!empty($rznsoc)) {
      $raz_soc = $rznsoc["raz_soc2"];
    } else {
      $raz_soc = '';
    }

    //union de terceros

    $tercero = $nat_com . $raz_soc;

    // vigencia fiscal

    $consultax = $connectionxx->query("SELECT * from vf ");
    while ($rowx = $consultax->fetch_assoc()) {
      $ax = $rowx["fecha_ini"];
      $bx = $rowx["fecha_fin"];
    }


    // calculos


    $link = new mysqli($server, $dbuser, $dbpass, $database);
    $resulta = $link->query("SELECT SUM(valor) AS TOTAL from reip_ing WHERE id_emp ='$id_emp' and cuenta ='$cuenta'");
    $row = $resulta->fetch_array();
    $total = $row[0];
    $total_recaudado = $total;


    $resultb = $link->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'");
    $rowb = $resultb->fetch_array();
    $total_recaudado_ncbt = $rowb[0];


    $todo_lo_recaudado = $total_recaudado + $total_recaudado_ncbt;


    $vr_eval = $total_recaudado +  $total_recaudado_ncbt +  $valor;


    $saldox = $definitivo - $todo_lo_recaudado;



    $sqlx = "UPDATE reip_ing set saldo='$saldox' where id_emp= '$id_emp' and cuenta ='$cuenta' ";
    $resultado = $connectionxx->query($sqlx);



    // inicio del bloque
    /*if($vr_eval > $definitivo)
{
printf("<br><br><center class='Estilo4'>El <b>SALDO</b> disponible para realizar <B>RECONOCIMIENTOS</B> a la cuenta <b>".$cuenta."</b>  es <br><br>...::: ".$saldox." :::...<BR><BR><b>NO</b> puede hacer <b>RECONOCIMIENTOS</b> por un valor superior al indicado<BR><BR>Verifique su Informacion<br><br><br>");
printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
}
else
{*/
    if (($ter_nat == '' and $ter_jur == '') or $des == '' or $valor == '') {
      printf("<br><br><center class='Estilo4'><b>NO</b> debe dejar casillas del Reconocimiento sin diligenciar<BR><BR>");
      printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
    } else {
      if ($fecha_reg > $bx or $fecha_reg < $ax) {
        printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
        printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
      } else {
        if ($tip_dato == 'M') {
          printf("<br><br><center class='Estilo4'>NO DEBE REALIZAR RECONOCIMIENTOS A CUENTAS DE TIPO MAYOR<BR><BR>");
          printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; 
	  width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
        } else {
          /*	    if ($definitivo < $valor)
		{
	  		$excede = $valor - $definitivo;
			printf("<br><br><center class='Estilo4'>EL VALOR DEL RECONOCIMIENTO EXCEDE EN ...:::<B> $".$excede."</B>= :::... EL 
			VALOR DEFINITIVO DE
			 LA CUENTA<BR><BR>");
			printf("<center class='Estilo4'>VERIFIQUE SU INFORMACION<BR><BR>");
			printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>"); 
		}
		else
		{*/

          $saldo = ($definitivo - $total_recaudado) - $valor;

          $sql = "INSERT INTO reip_ing ( 
				id_emp , consecutivo , fecha_reg , ter_nat, ter_jur , des , cuenta , 
				nom_rubro , valor, nat_com , jur_com, contab, tercero, definitivo, vr_recaudado, recaudo_completo , elim_cont, id_manu_reip
				) VALUES ( 
				'$id_emp','$consecutivo','$fecha_reg','$ter_nat', 
				'$ter_jur','$des','$cuenta','$nom_rubro','$valor',
				'$nat_com','$raz_soc','NO','$tercero','$definitivo','0','NO','0', '$id_manu_reip')";


          $connectionxx->query($sql);



          $sqlx = "UPDATE reip_ing set saldo='$saldo' where id_emp= '$id_emp' and cuenta ='$cuenta' ";
          $resultado = $connectionxx->query($sqlx);


          printf("<br><br><center class='Estilo4'>DATOS ALMACENADOS CON EXITO<BR><BR>");
          printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto_reg.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
        }
      }
      //}	
      //}	
    }
    ?>






  <?php
  }

  ?>




<?php
}
?>
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