<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {
  include('../config.php');

  // conexion				
  $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

  // id_emp
  $sqlxx = "select * from fecha";
  $resultadoxx = $connectionxx->query($sqlxx);

  while ($rowxx = $resultadoxx->fetch_assoc()) {
    $id_emp = $rowxx["id_emp"];
  }

  $tipa = $tipb = $tipc = $tipd = $tipe = $tipf = $tipg = $tiph = $tipi = $tipj = $tipk = $tipl = $tipm = $tipn = $tipo = '';
  $id='';
  $id_reip = '';
  $id_caic = '';
  $id_unico_reip = '';
  $vr_orig_reip = 0;
  $id_manu_ncbt = 'NCBT' . $_POST['id_manu_ncbt']; //printf("<br>id_recau %s<br>",$id_recau);
  $id_recau = 'NCBT' . $_POST['consec_ncbt']; //printf("<br>id_recau %s<br>",$id_recau);
  $fecha_recaudo = $_POST['fecha_recaudo']; //printf("<br>fecha_recaudo %s<br>",$fecha_recaudo);
  $des_recaudo = $_POST['des_recaudo']; //printf("<br>des_recaudo %s<br>",$des_recaudo);
  $vr_digitado = $_POST['valor']; //printf("<br>vr_digitado %s<br>",$vr_digitado);
  $ter_nat = isset($_POST['ter_nat']) ? $_POST['ter_nat'] : ''; //printf("<br>ter_nat %s<br>",$ter_nat);
  $ter_jur = isset($_POST['ter_jur']) ? $_POST['ter_jur'] : ''; //printf("<br>ter_jur %s<br>",$ter_jur);
  // consulta tercero nat
  $sqla = "select * from terceros_naturales where id_emp ='$id_emp' and id ='$ter_nat'";
  $resultadoa = $connectionxx->query($sqla);
  $pri_ape = $seg_ape = $pri_nom = $seg_nom = '';
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
  $sqla = "select * from terceros_juridicos where id_emp ='$id_emp' and id ='$ter_jur'";
  $resultadoa = $connectionxx->query($sqla);
  $raz_soc = '';
  while ($rowa = $resultadoa->fetch_assoc()) {
    $raz_soc = $rowa["raz_soc2"];
  }
  //union de terceros
  $tercero = $nat_com . $raz_soc; //printf("<br>tercero %s<br>",$tercero);
  $cuenta = $_POST['cuenta']; //printf("<br>cuenta %s<br>",$cuenta);
  $cod = $cuenta;
  $ss2 = "select * from car_ppto_ing where id_emp = '$id_emp' and cod_pptal = '$cod'";
  $rr2 = $connectionxx->query($ss2);
  while ($rrw2 = $rr2->fetch_assoc()) {
    $nom_rubro = $rrw2["nom_rubro"];
    $tip_dato = $rrw2["tip_dato"];
    $definitivo = $rrw2["definitivo"];
  }
  $nombre = $nom_rubro;     // printf("<br>nombre %s<br>",$nombre);
  $pgcp1 = isset($_POST['pgcp1']) ? $_POST['pgcp1'] : 0; // printf("<br>pgcp1 %s<br>",$pgcp1); 
  $pgcp2 = isset($_POST['pgcp2']) ? $_POST['pgcp2'] : 0;  //printf("<br>pgcp2 %s<br>",$pgcp2);
  $pgcp3 = isset($_POST['pgcp3']) ? $_POST['pgcp3'] : 0;  //printf("<br>pgcp3 %s<br>",$pgcp3);
  $pgcp4 = isset($_POST['pgcp4']) ? $_POST['pgcp4'] : 0;
  $pgcp5 = isset($_POST['pgcp5']) ? $_POST['pgcp5'] : 0;
  $pgcp6 = isset($_POST['pgcp6']) ? $_POST['pgcp6'] : 0;
  $pgcp7 = isset($_POST['pgcp7']) ? $_POST['pgcp7'] : 0;
  $pgcp8 = isset($_POST['pgcp8']) ? $_POST['pgcp8'] : 0;
  $pgcp9 = isset($_POST['pgcp9']) ? $_POST['pgcp9'] : 0;
  $pgcp10 = isset($_POST['pgcp10']) ? $_POST['pgcp10'] : 0;
  $pgcp11 = isset($_POST['pgcp11']) ? $_POST['pgcp11'] : 0;
  $pgcp12 = isset($_POST['pgcp12']) ? $_POST['pgcp12'] : 0;
  $pgcp13 = isset($_POST['pgcp13']) ? $_POST['pgcp13'] : 0;
  $pgcp14 = isset($_POST['pgcp14']) ? $_POST['pgcp14'] : 0;
  $pgcp15 = isset($_POST['pgcp15']) ? $_POST['pgcp15'] : 0;
  $des1 = isset($_POST['des1']) ? $_POST['des1'] : 0;   //printf("<br>des1 %s<br>",$des1);
  $des2 = isset($_POST['des2']) ? $_POST['des2'] : 0;   //printf("<br>des2 %s<br>",$des2);
  $des3 = isset($_POST['des3']) ? $_POST['des3'] : 0;
  $des4 = isset($_POST['des4']) ? $_POST['des4'] : 0;
  $des5 = isset($_POST['des5']) ? $_POST['des5'] : 0;
  $des6 = isset($_POST['des6']) ? $_POST['des6'] : 0;
  $des7 = isset($_POST['des7']) ? $_POST['des7'] : 0;
  $des8 = isset($_POST['des8']) ? $_POST['des8'] : 0;
  $des9 = isset($_POST['des9']) ? $_POST['des9'] : 0;
  $des10 = isset($_POST['des10']) ? $_POST['des10'] : 0;
  $des11 = isset($_POST['des11']) ? $_POST['des11'] : 0;
  $des12 = isset($_POST['des12']) ? $_POST['des12'] : 0;
  $des13 = isset($_POST['des13']) ? $_POST['des13'] : 0;
  $des14 = isset($_POST['des14']) ? $_POST['des14'] : 0;
  $des15 = isset($_POST['des15']) ? $_POST['des15'] : 0;
  $vr_deb_1 = isset($_POST['vr_deb_1']) ? $_POST['vr_deb_1'] : 0;  //printf("<br>vr_deb_1 %s<br>",$vr_deb_1);
  $vr_deb_2 = isset($_POST['vr_deb_2']) ? $_POST['vr_deb_2'] : 0;  //printf("<br>vr_deb_2 %s<br>",$vr_deb_2);
  $vr_deb_3 = isset($_POST['vr_deb_3']) ? $_POST['vr_deb_3'] : 0;  //printf("<br>vr_deb_3 %s<br>",$vr_deb_3);
  $vr_deb_4 = isset($_POST['vr_deb_4']) ? $_POST['vr_deb_4'] : 0;
  $vr_deb_5 = isset($_POST['vr_deb_5']) ? $_POST['vr_deb_5'] : 0;
  $vr_deb_6 = isset($_POST['vr_deb_6']) ? $_POST['vr_deb_6'] : 0;
  $vr_deb_7 = isset($_POST['vr_deb_7']) ? $_POST['vr_deb_7'] : 0;
  $vr_deb_8 = isset($_POST['vr_deb_8']) ? $_POST['vr_deb_8'] : 0;
  $vr_deb_9 = isset($_POST['vr_deb_9']) ? $_POST['vr_deb_9'] : 0;
  $vr_deb_10 = isset($_POST['vr_deb_10']) ? $_POST['vr_deb_10'] : 0;
  $vr_deb_11 = isset($_POST['vr_deb_11']) ? $_POST['vr_deb_11'] : 0;
  $vr_deb_12 = isset($_POST['vr_deb_12']) ? $_POST['vr_deb_12'] : 0;
  $vr_deb_13 = isset($_POST['vr_deb_13']) ? $_POST['vr_deb_13'] : 0;
  $vr_deb_14 = isset($_POST['vr_deb_14']) ? $_POST['vr_deb_14'] : 0;
  $vr_deb_15 = isset($_POST['vr_deb_15']) ? $_POST['vr_deb_15'] : 0;
  $vr_cre_1 = isset($_POST['vr_cre_1']) ? $_POST['vr_cre_1'] : 0;  // printf("<br>vr_cre_1 %s<br>",$vr_cre_1);
  $vr_cre_2 = isset($_POST['vr_cre_2']) ? $_POST['vr_cre_2'] : 0;  // printf("<br>vr_cre_2 %s<br>",$vr_cre_2);
  $vr_cre_3 = isset($_POST['vr_cre_3']) ? $_POST['vr_cre_3'] : 0;   //printf("<br>vr_cre_3 %s<br>",$vr_cre_3);
  $vr_cre_4 = isset($_POST['vr_cre_4']) ? $_POST['vr_cre_4'] : 0;
  $vr_cre_5 = isset($_POST['vr_cre_5']) ? $_POST['vr_cre_5'] : 0;
  $vr_cre_6 = isset($_POST['vr_cre_6']) ? $_POST['vr_cre_6'] : 0;
  $vr_cre_7 = isset($_POST['vr_cre_7']) ? $_POST['vr_cre_7'] : 0;
  $vr_cre_8 = isset($_POST['vr_cre_8']) ? $_POST['vr_cre_8'] : 0;
  $vr_cre_9 = isset($_POST['vr_cre_9']) ? $_POST['vr_cre_9'] : 0;
  $vr_cre_10 = isset($_POST['vr_cre_10']) ? $_POST['vr_cre_10'] : 0;
  $vr_cre_11 = isset($_POST['vr_cre_11']) ? $_POST['vr_cre_11'] : 0;
  $vr_cre_12 = isset($_POST['vr_cre_12']) ? $_POST['vr_cre_12'] : 0;
  $vr_cre_13 = isset($_POST['vr_cre_13']) ? $_POST['vr_cre_13'] : 0;
  $vr_cre_14 = isset($_POST['vr_cre_14']) ? $_POST['vr_cre_14'] : 0;
  $vr_cre_15 = isset($_POST['vr_cre_15']) ? $_POST['vr_cre_15'] : 0;
  $tot_deb = $vr_deb_1 + $vr_deb_2 + $vr_deb_3 + $vr_deb_4 + $vr_deb_5 + $vr_deb_6 + $vr_deb_7 + $vr_deb_8 + $vr_deb_9 + $vr_deb_10 + $vr_deb_11 + $vr_deb_12 + $vr_deb_13 + $vr_deb_14 + $vr_deb_15;
  $tot_cre = $vr_cre_1 + $vr_cre_2 + $vr_cre_3 + $vr_cre_4 + $vr_cre_5 + $vr_cre_6 + $vr_cre_7 + $vr_cre_8 + $vr_cre_9 + $vr_cre_10 + $vr_cre_11 + $vr_cre_12 + $vr_cre_13 + $vr_cre_14 + $vr_cre_15;

  $tot_deb_a = number_format($tot_deb, 2, ',', '.');
  $tot_cre_a = number_format($tot_cre, 2, ',', '.');

  // vigencia fiscal

  $consultax =  $connectionxx->query("select * from vf ");
  while ($rowx = $consultax->fetch_assoc()) {
    $ax = $rowx["fecha_ini"];
    $bx = $rowx["fecha_fin"];
  }
  // consulta tipo_dato de pgcp
  $sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
  $resultadoa = $connectionxx->query($sqla);
  while ($rowa = $resultadoa->fetch_assoc()) {
    $tipa = $rowa["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
  $resultadob = $connectionxx->query($sqlb);
  while ($rowb = $resultadob->fetch_assoc()) {
    $tipb = $rowb["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
  $resultadoc = $connectionxx->query($sqlc);
  while ($rowc = $resultadoc->fetch_assoc()) {
    $tipc = $rowc["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
  $resultadod = $connectionxx->query($sqld);
  while ($rowd = $resultadod->fetch_assoc()) {
    $tipd = $rowd["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
  $resultadoe = $connectionxx->query($sqle);
  while ($rowe = $resultadoe->fetch_assoc()) {
    $tipe = $rowe["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
  $resultadof = $connectionxx->query($sqlf);
  while ($rowf = $resultadof->fetch_assoc()) {
    $tipf = $rowf["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
  $resultadog = $connectionxx->query($sqlg);
  while ($rowg = $resultadog->fetch_assoc()) {
    $tipg = $rowg["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
  $resultadoh = $connectionxx->query($sqlh);
  while ($rowh = $resultadoh->fetch_assoc()) {
    $tiph = $rowh["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
  $resultadoi = $connectionxx->query($sqli);
  while ($rowi = $resultadoi->fetch_assoc()) {
    $tipi = $rowi["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
  $resultadoj = $connectionxx->query($sqlj);
  while ($rowj = $resultadoj->fetch_assoc()) {
    $tipj = $rowj["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
  $resultadok = $connectionxx->query($sqlk);
  while ($rowk = $resultadok->fetch_assoc()) {
    $tipk = $rowk["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
  $resultadol = $connectionxx->query($sqll);
  while ($rowl = $resultadol->fetch_assoc()) {
    $tipl = $rowl["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
  $resultadom = $connectionxx->query($sqlm);
  while ($rowm = $resultadom->fetch_assoc()) {
    $tipm = $rowm["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
  $resultadon = $connectionxx->query($sqln);
  while ($rown = $resultadon->fetch_assoc()) {
    $tipn = $rown["tip_dato"];
  }
  // consulta tipo_dato de pgcp
  $sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
  $resultadoo = $connectionxx->query($sqlo);
  while ($rowo = $resultadoo->fetch_assoc()) {
    $tipo = $rowo["tip_dato"];
  }

  $link = new mysqli($server, $dbuser, $dbpass, $database);
  $resulta = $link->query("SELECT SUM(valor) AS TOTAL from reip_ing WHERE id_emp ='$id_emp' and cuenta ='$cuenta'") or die(mysqli_error($link));
  $row = $resulta->fetch_row();
  $total_recaudado_reip = $row[0];


  $resultb = $link->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'") or die(mysqli_error($link));
  $rowb = $resultb->fetch_row();
  $total_recaudado_ncbt = $rowb[0];


  $resultc = $link->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE id_emp ='$id_emp' and cuenta ='$cuenta'") or die(mysqli_error($link));
  $rowc = $resultc->fetch_row();
  $total_recaudado_tnat = $rowc[0];

  $resultd = $link->query("SELECT SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'") or die(mysqli_error($link));
  $rowd = $resultd->fetch_row();
  $total_recaudado_rcgt = $rowd[0];


  $todo_lo_recaudado = $total_recaudado_reip + $total_recaudado_ncbt + $total_recaudado_tnat + $total_recaudado_rcgt;
  $vr_eval = $total_recaudado_reip + $total_recaudado_ncbt + $total_recaudado_tnat + $total_recaudado_rcgt + $vr_digitado;
  $saldoxrecaudar = $definitivo - $todo_lo_recaudado;
  if (($ter_nat == '' and $ter_jur == '') or ($des_recaudo == '') or ($vr_digitado == '')) {
    printf("<br><br><center class='Estilo4'>No debe dejar casillas <b>EN BLANCO</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
  } else {


    if ($fecha_recaudo > $bx or $fecha_recaudo < $ax) {
      printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
    } else {


      $sql = "INSERT INTO recaudo_ncbt ( 
									
										id_emp , id_reip , id_caic , id_recau , fecha_recaudo , des_recaudo , tercero ,
										pgcp1 , pgcp2 , pgcp3 , pgcp4 , pgcp5 , pgcp6 , pgcp7 , pgcp8 , pgcp9 , pgcp10 , pgcp11 , pgcp12 , pgcp13 , pgcp14 , pgcp15 , 
										des1 , des2 , des3 , des4 , des5 , des6 , des7 , des8 , des9 , des10 , des11 , des12 , des13 , des14 , des15 , 
										vr_deb_1 , vr_deb_2 , vr_deb_3 , vr_deb_4 , vr_deb_5 , vr_deb_6 , vr_deb_7 , vr_deb_8 , vr_deb_9 , 
										vr_deb_10 , vr_deb_11 , vr_deb_12 , vr_deb_13 , vr_deb_14 , vr_deb_15 , 
										vr_cre_1 , vr_cre_2 , vr_cre_3 , vr_cre_4 , vr_cre_5 , vr_cre_6 , vr_cre_7 , vr_cre_8 , vr_cre_9 , 
										vr_cre_10 , vr_cre_11 , vr_cre_12 , vr_cre_13 , vr_cre_14 , vr_cre_15 , 
										tot_deb , tot_cre ,
										id_unico_reip, cuenta, nombre, vr_orig_reip, vr_digitado, ter_nat, ter_jur, id_manu_ncbt
									
										) VALUES ( 
													
										'$id_emp' , '$id_reip' , '$id_caic' , '$id_recau' , '$fecha_recaudo' , '$des_recaudo' ,'$tercero' ,
										'$pgcp1' , '$pgcp2' , '$pgcp3' , '$pgcp4' , '$pgcp5' , '$pgcp6' , '$pgcp7' , '$pgcp8' , '$pgcp9' , '$pgcp10' , '$pgcp11' , 
										'$pgcp12' , 
										'$pgcp13' , '$pgcp14' , '$pgcp15' , 
										'$des1' , '$des2' , '$des3' , '$des4' , '$des5' , '$des6' , '$des7' , '$des8' , '$des9' , '$des10' , '$des11' , '$des12' , 
										'$des13' , 
										'$des14' , '$des15' , 
										'$vr_deb_1' , '$vr_deb_2' , '$vr_deb_3' , '$vr_deb_4' , '$vr_deb_5' , '$vr_deb_6' , '$vr_deb_7' , '$vr_deb_8' , '$vr_deb_9' , 
										'$vr_deb_10' , '$vr_deb_11' , '$vr_deb_12' , '$vr_deb_13' , '$vr_deb_14' , '$vr_deb_15' , 
										'$vr_cre_1' , '$vr_cre_2' , '$vr_cre_3' , '$vr_cre_4', '$vr_cre_5' , '$vr_cre_6' , '$vr_cre_7' , '$vr_cre_8' , '$vr_cre_9' , 
										'$vr_cre_10' , '$vr_cre_11' , '$vr_cre_12' , '$vr_cre_13' , '$vr_cre_14' , '$vr_cre_15' , 
										'$tot_deb' , '$tot_cre' ,
										'$id' , '$cuenta' , '$nombre' , '$vr_orig_reip' , '$vr_digitado', '$ter_nat', '$ter_jur', '$id_manu_ncbt'
									
										)";


      $connectionxx->query($sql) or die(mysqli_error($connectionxx));

      printf("<br><br><center class ='Estilo4'>REGISTRO INSERTADO CON EXITO</center><br /><br />");
    }
  }
  //}

  printf("

<center class='Estilo9'>
<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
<input type='hidden' name='nn' value='NCBT'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo19' /> :::...
</form>
</center>
");
  //************************* fin grabacion

  //************************* inicio nuevos datos
?>
  <html>

  <head>
    <title>CONTAFACIL</title>
    <script language="JavaScript" type="text/javascript" src="javas.js"></script>
    <script>
      function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
        patron = /\d/; //ver nota 
        te = String.fromCharCode(tecla);
        return patron.test(te);
      }
      var contLin = 1;

      function agregar() {
        fila = document.all.tablaf.rows.length - 1;
        if (fila < 14) {
          var tr, td;

          tr = document.all.tablaf.insertRow();
          td = tr.insertCell();
          td.innerHTML = "<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'> <input type='text' size='38' style='text-align:left' id='pgcp" + contLin + "' name='pgcp" + contLin + "' value='' onkeyup='lookup(this.value," + contLin + ");' >  </span></div> <div class='suggestionsBox' id='sugges" + contLin + "' style='display: none; position:absolute; left: 130px;'><img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug" + contLin + "' align=left> &nbsp;  </div> </div>";

          td = tr.insertCell();
          td.innerHTML = "<input type='text' size='88' style='text-align:left' name='des" + contLin + "' id='des" + contLin + "' value='' readonly >";

          td = tr.insertCell();
          td.innerHTML = "<input type='text' size='25' style='text-align:right' name='vr_deb_" + contLin + "' id='vr_deb_" + contLin + "' value=0  onKeyUp='suma_tab();' onkeypress='return validar(event)' >";

          td = tr.insertCell();
          td.innerHTML = "<input type='text' size='26' style='text-align:right' name='vr_cre_" + contLin + "' id='vr_cre_" + contLin + "' value=0  onKeyUp='suma_tab();' onkeypress='return validar(event)' >";

          document.getElementById("contis").innerHTML = contLin;
          contLin++;



        }
      }



      function borrarUltima() {

        ultima = document.all.tablaf.rows.length - 1;
        //alert (ultima);
        if (ultima >= 0) {
          document.all.tablaf.deleteRow(ultima);
          contLin--;
          document.getElementById("contis").innerHTML = contLin - 1;
        }
      }


      function generar_movimiento() {


        var valor = document.getElementById("valor").value;
        var cuenta = document.getElementById("cuenta").value;

        if (valor == '' || cuenta == '') {
          if (cuenta == '') {
            alert("No ha seleccionado cuenta");
            document.getElementById("cuenta").focus()
          }



        } else {

          con = document.all.tablaf.rows.length;
          aux = con;
          //alert ("fil"+con);
          for (var j = 1; j <= con; j++) {
            borrarUltima();
          }
          contLin = 1;
          agregar();
          agregar();

          //alert ("cuenta" + cuenta);
          var pos_url2 = 'consultas/con_cca.php';
          var req1 = new XMLHttpRequest();
          if (req1) {
            req1.onreadystatechange = function() {
              if (req1.readyState == 4) {
                var dato = req1.responseText;
                var elem = dato.split(',');
                var pgcp1 = elem[0];
                var pgcp6 = elem[1];
                var rubro1 = elem[2];
                var rubro2 = elem[3];

                document.getElementById("pgcp1").value = pgcp1;
                document.getElementById("pgcp2").value = pgcp6;
                document.getElementById("des1").value = rubro1;
                document.getElementById("des2").value = rubro2;
                document.getElementById("vr_deb_1").value = valor;
                document.getElementById("vr_cre_2").value = valor;
                suma_tab();
                //alert(dato);
              }
            }
            req1.open('POST', pos_url2 + '?cod=' + cuenta, false);
            req1.send(null);
          }
        }
      }


      function suma_tab() {
        filas = document.all.tablaf.rows.length;
        sum_deb = 0;
        sum_cre = 0;
        for (var i = 1; i <= filas; i++) {
          sum_deb = sum_deb + parseInt(document.getElementById("vr_deb_" + i).value);
          sum_cre = sum_cre + parseInt(document.getElementById("vr_cre_" + i).value);


        }
        total = sum_deb - sum_cre;
        document.getElementById("tot_deb_a").value = sum_deb;
        document.getElementById("tot_cre_a").value = sum_cre;
        document.getElementById("total").value = total;

        //	alert(sum_deb);
      }

      function onload1() {
        //consecutivo2();
        document.getElementById("btn1").disabled = true;
        document.getElementById("btn2").disabled = true;
        // tabla_ini();

        //setInterval('parpadeo()',1000);
      }
    </script>


    <style type="text/css">
      <!--
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

      .Estilo12 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }

      .Estilo12 {
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #333333;
      }
      -->
      .suggestionsBox
      {
      position:
      relative;
      left:
      30px;
      margin:
      0px
      0px
      0px
      0px;
      width:
      600px;
      background-color:#335194;
      -moz-border-radius:
      7px;
      -webkit-border-radius:
      7px;
      border:
      2px
      solid
      #2AAAFF;
      color:
      #fff;
      font-size:
      10px;
      }
      .suggestionList
      {
      margin:
      0px;
      padding:
      0px;
      }
      .suggestionList
      li
      {
      margin:
      0px
      0px
      3px
      0px;
      padding:
      3px;
      cursor:
      pointer;
      }
      .suggestionList
      li:hover
      {
      background-color:#659CD8;
      }
    </style>
    <script>
      function chk_pgcp1() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp1').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp2() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp2').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado2').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp3() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp3').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado3').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp4() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp4').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado4').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp5() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp5').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado5').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp6() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp6').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado6').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp7() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp7').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado7').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp8() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp8').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado8').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp9() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp9').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado9').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp10() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp10').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado10').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>
    <script>
      function chk_pgcp11() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp11').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado11').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp12() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp12').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado12').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp13() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp13').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado13').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp14() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp14').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado14').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script>
      function chk_pgcp15() {
        var pos_url = 'comprueba_cta.php';
        var cod = document.getElementById('pgcp15').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('resultado15').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>
    <!--validacion de forms-->
    <script src="../jquery.js"></script>
    <script type="text/javascript" src="../jquery.validate.js"></script>
    <style type="text/css">
      * {
        font-family: Verdana;
        font-size: 10px;
      }

      label {
        width: 10em;
        float: left;
      }

      label.error {
        float: none;
        color: red;
        padding-left: .5em;
        vertical-align: top;
      }

      p {
        clear: both;
      }

      .submit {
        margin-left: 12em;
      }

      em {
        font-weight: bold;
        padding-right: 1em;
        vertical-align: top;
      }

      .Estilo10 {
        color: #990000;
        font-style: italic;
      }
    </style>

    <script>
      $(document).ready(function() {
        $("#commentForm").validate();
      });
    </script>

    <script>
      function chk_ncbt() {
        var pos_url = '../comprobadores/comprueba_ncbt.php';
        var cod = document.getElementById('id_manu_ncbt').value;
        var req = new XMLHttpRequest();
        if (req) {
          req.onreadystatechange = function() {
            if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
              document.getElementById('res_ncbt').innerHTML = req.responseText;
            }
          }
          req.open('GET', pos_url + '?cod=' + cod, true);
          req.send(null);
        }
      }
    </script>

    <script language="JavaScript">
      function Calcular() {

        var a1 = document.a.vr_deb_1.value;
        var a2 = document.a.vr_deb_2.value;
        var a3 = document.a.vr_deb_3.value;
        var a4 = document.a.vr_deb_4.value;
        var a5 = document.a.vr_deb_5.value;
        var a6 = document.a.vr_deb_6.value;
        var a7 = document.a.vr_deb_7.value;
        var a8 = document.a.vr_deb_8.value;
        var a9 = document.a.vr_deb_9.value;
        var a10 = document.a.vr_deb_10.value;

        var a11 = document.a.vr_deb_11.value;
        var a12 = document.a.vr_deb_12.value;
        var a13 = document.a.vr_deb_13.value;
        var a14 = document.a.vr_deb_14.value;
        var a15 = document.a.vr_deb_15.value;




        if (a1 == "") {
          a1 = 0;
        }

        if (a2 == "") {
          a2 = 0;
        }
        if (a3 == "") {
          a3 = 0;
        }
        if (a4 == "") {
          a4 = 0;
        }
        if (a5 == "") {
          a5 = 0;
        }
        if (a6 == "") {
          a6 = 0;
        }
        if (a7 == "") {
          a7 = 0;
        }
        if (a8 == "") {
          a8 = 0;
        }
        if (a9 == "") {
          a9 = 0;
        }
        if (a10 == "") {
          a10 = 0;
        }
        if (a11 == "") {
          a11 = 0;
        }

        if (a12 == "") {
          a12 = 0;
        }
        if (a13 == "") {
          a13 = 0;
        }
        if (a14 == "") {
          a14 = 0;
        }
        if (a15 == "") {
          a15 = 0;
        }




        var total = parseFloat(a1) + parseFloat(a2) + parseFloat(a3) + parseFloat(a4) + parseFloat(a5) + parseFloat(a6) + parseFloat(a7) + parseFloat(a8) + parseFloat(a9) + parseFloat(a10) + parseFloat(a11) + parseFloat(a12) + parseFloat(a13) + parseFloat(a14) + parseFloat(a15);



        document.getElementById("tot_deb_a").value = total.toFixed(2);

      }
    </script>

    <script language="JavaScript">
      function Calcularc() {

        var aa1 = document.a.vr_cre_1.value;
        var aa2 = document.a.vr_cre_2.value;
        var aa3 = document.a.vr_cre_3.value;
        var aa4 = document.a.vr_cre_4.value;
        var aa5 = document.a.vr_cre_5.value;
        var aa6 = document.a.vr_cre_6.value;
        var aa7 = document.a.vr_cre_7.value;
        var aa8 = document.a.vr_cre_8.value;
        var aa9 = document.a.vr_cre_9.value;
        var aa10 = document.a.vr_cre_10.value;

        var aa11 = document.a.vr_cre_11.value;
        var aa12 = document.a.vr_cre_12.value;
        var aa13 = document.a.vr_cre_13.value;
        var aa14 = document.a.vr_cre_14.value;
        var aa15 = document.a.vr_cre_15.value;





        if (aa1 == "") {
          aa1 = 0;
        }
        if (aa2 == "") {
          aa2 = 0;
        }
        if (aa3 == "") {
          aa3 = 0;
        }
        if (aa4 == "") {
          aa4 = 0;
        }
        if (aa5 == "") {
          aa5 = 0;
        }
        if (aa6 == "") {
          aa6 = 0;
        }
        if (aa7 == "") {
          aa7 = 0;
        }
        if (aa8 == "") {
          aa8 = 0;
        }
        if (aa9 == "") {
          aa9 = 0;
        }
        if (aa10 == "") {
          aa10 = 0;
        }
        if (aa11 == "") {
          aa11 = 0;
        }

        if (aa12 == "") {
          aa12 = 0;
        }
        if (aa13 == "") {
          aa13 = 0;
        }
        if (aa14 == "") {
          aa14 = 0;
        }
        if (aa15 == "") {
          aa15 = 0;
        }



        var totalc = parseFloat(aa1) + parseFloat(aa2) + parseFloat(aa3) + parseFloat(aa4) + parseFloat(aa5) + parseFloat(aa6) + parseFloat(aa7) + parseFloat(aa8) + parseFloat(aa9) + parseFloat(aa10) + parseFloat(aa11) + parseFloat(aa12) + parseFloat(aa13) + parseFloat(aa14) + parseFloat(aa15);


        document.getElementById("tot_cre_a").value = totalc.toFixed(2);

      }


      function valida_form() {
        var v = parseInt(document.getElementById("cuenta").value);
        var cuentan = parseInt(document.getElementById("cuentan").value);
        //alert(v+" "+cuentan);
        var sw = 0;
        if (document.getElementById("cuenta").value == "" || document.getElementById("valor").value == 0 || v == cuentan) {
          if (document.getElementById("cuenta").value == '') {
            alert("No ha seleccionado cuenta");
            document.getElementById("btn1").disabled = true;
            document.getElementById("btn2").disabled = true;
            document.getElementById("cuenta").focus();


          }

          if (v == cuentan) {
            alert("Las imputaciones no pueden ser iguales...");
            document.getElementById("btn1").disabled = true;
            document.getElementById("btn2").disabled = true;
            document.getElementById("cuenta").focus();



          }



          //alert("debe seleccionar")
          document.getElementById("cuenta").focus();
        } else {
          document.getElementById("btn1").disabled = false;
          document.getElementById("btn2").disabled = false;
        }
      }
    </script>



    <!--fin val forms-->
  </head>

  <body onLoad="onload1();">
    <br><br><br>
    <div align="center"><span class="Estilo15">NOTA DEBITO BANCARIA </span><BR>
    </div>
    <form name="a" method="post" id="commentForm" action="proc_ncbt.php">
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
                  $a = substr($id_recau, 4, 10);
                  $aa = substr($id_manu_ncbt, 4, 10);
                  printf("%s", $a);

                  ?>
                  <input name="consec_ncbt" type="hidden" id="consec_ncbt" value="<?php printf("%s", $a); ?>">
                </div>
              </div>
            </div>
          </td>
          <td width="275" bgcolor="#F5F5F5">
            <input type="hidden" name="ter_nat" value="<?php printf("%s", $ter_nat); ?>"></input>
            <input name="ter_jur" type="hidden" id="ter_jur" value="<?php printf("%s", $ter_jur); ?>">
            <input name="id_manu_ncbt" type="hidden" id="id_manu_ncbt" value="<?php printf("%s", $aa); ?>">
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
                <div align="center" class="Estilo4"><?php printf("%s", $fecha_recaudo); ?>
                  <input name="fecha_recaudo" type="hidden" id="fecha_recaudo" value="<?php printf("%s", $fecha_recaudo); ?>">
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
                <div align="center" class="Estilo4"><?php printf("%s", $des_recaudo); ?>
                  <input name="des_recaudo" type="hidden" id="des" value="<?php printf("%s", $des_recaudo); ?>">
                </div>
              </div>
            </div>
          </td>
        </tr>
      </table>
      <div align="center"><br />
        <span class="Estilo15">IMPUTACIONES PRESUPUESTALES A&Ntilde;ADIDAS AL RECONOCIMIENTO ...::: <?php printf("%s", $id_manu_ncbt); ?> :::... </span><br><br>

        <?php
        //-------
        include('../config.php');
        $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
        $sq = "select * from recaudo_ncbt where id_emp = '$id_emp' and id_recau ='$id_recau' order by id_recau asc ";
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

<input type='hidden' name='cuentan' value='%s' id='cuentan'> 

</tr>", $rw["cuenta"], $rw["nombre"], $rw["vr_digitado"], $rw["tercero"], $rw["cuenta"]);
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
                <select name="cuenta" class="required Estilo4" id="cuenta" style="width: 400px;" onChange="valida_form();">
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
                <input name="valor" type="text" class="required Estilo4" id="valor" size="20" onKeyPress="return validar(event)" style="text-align:right" value="0" onKeyUp="valida_form();" />
              </div>
            </div>
          </td>
        </tr>
      </table>
      <br />
      <center>
        <br />
        <script>
          function muestraURL() {
            var miPopup
            miPopup = window.open("../pgcp/consulta_cta.php", "CONTAFACIL", "width=800,height=400,menubar=no,scrollbars=yes")
          }
        </script>
      </center>
      <table width="300" border="0" align="center">
        <tr>
          <td width="50">
            <div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div>
          </td>
          <td width="200" valign="middle">
            <div align="center"><a href="#" onClick="muestraURL()">BUSCAR CUENTA PGCP</a></div>
          </td>
          <td width="50">
            <div align="center"><img src="../pgcp/buscax30.jpg" width="30" height="30" /></div>
          </td>
        </tr>
      </table>

      <br>

      <table width="900" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan="4" bgcolor="#FFFFFF">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>IMPORTANTE</strong><br />
                  <br />
                  Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
                  Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot;
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#DCE9E5">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE
                  <input type="hidden" name='contador' value='0' id="contador"> <br>
                  <input name="generar" type="button" value="Generar movimiento" onClick="generar_movimiento();" />
                  <br>
                  <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='agregar();'>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <span id='contis' class='Estilo4'>0</span>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='borrarUltima();'>
                </strong></div>
            </div>
          </td>
        </tr>
        <tr>
          <td width="192" bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
            </div>
          </td>
          <td width="429" bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4"><strong>NOMBRE DE LA CUENTA</strong><strong></strong> </div>
            </div>
          </td>
          <td width="130" bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
            </div>
          </td>
          <td width="134" bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
            </div>
          </td>
        </tr>
      </table>
      <table width="900" border="1" id="tablaf" align="center" class="bordepunteado1">
      </table>
      <table width="900" border="1" align="center" class="bordepunteado1">
        <tr>
          <td colspan=2 bgcolor="#990000">
            <div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="right" class="Estilo8"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR: </strong></div>
            </div>
          </td>
          <td bgcolor="#990000" width="130">
            <div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
              <div align="center" class="Estilo12">
                <div align="right">
                  <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00" onkeyup='Calcular();'>
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#990000" width="100">
            <div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
              <div align="center" class="Estilo12">
                <div align="right">
                  <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00" onkeyup='Calcular();'>
                </div>
              </div>
            </div>
          </td>




        </tr>
        <tr>
          <td colspan=2 bgcolor="#990000">
            <div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="right" class="Estilo8"><strong>DIFERENCIA: </strong></div>
            </div>
          </td>
          <td bgcolor="#990000" colspan=2>
            <div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
              <div align="center" class="Estilo12">
                <div align="center">
                  <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value="0.00" onkeyup='Calcular();'>
                </div>
              </div>
            </div>
          </td>

        </tr>
        <tr>
          <td colspan="4" bgcolor="#990000">
            <div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="right" class="Estilo8">
                <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
              </div>
            </div>
          </td>

        </tr>
        <tr>
          <td colspan="4">
            <div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <input name="Submit3222" id="btn1" type="submit" class="Estilo12" value="Agregar Otra Imputacion Presupuestal y Continuar" onclick="this.form.action = 'proc_ncbt_2.php'" />
                <span class="Estilo8">:::</span>
                <input name="submit" type="submit" class="Estilo12" value="Guardar Nota Credito Bancaria y Terminar" id="btn2" onclick="return noVacio2(this.form,this.form.contador.value)" />
              </div>
            </div>
          </td>
        </tr>
        <!--secciones de fila -->
        <!--secciones de fila -->
      </table>

      <table width="900" border="0" align="center">

        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
              <div align="center">

                <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                    <div align="center"><a href='../recaudos_tesoreria/recaudos_tesoreria.php' target='_parent'>VOLVER </a> </div>
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



    </form>
  </body>

  </html>




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