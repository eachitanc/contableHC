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
    <title>GCP - CONTRATACION</title>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css"><!-- Estas lineas incluyen el archivo estilosh.css -->
    <style type="text/css">
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

      .Estilo9 {
        font-size: 10px;
        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
      }
    </style>
  </head>

  <body>
    <div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
    </div>
    <br />
    <br />

    <?php

    include('../config.php');

    // conexion             
    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

    // id_emp
    $sqlxx = "select * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);

    while ($rowxx = $resultadoxx->fetch_assoc()) {
      $id_emp = $rowxx["id_emp"];
      $idxx = $rowxx["id_emp"];
      $ano = $rowxx["ano"];
    }



    // llegada de campos

    $contador = $_POST['contador']; //printf("contador : %s<br>",$contador);

    $id_cdpp = $_POST['id_auto_cdpp'];



    //**************** independizar registros *********

    $a = 0;
    for ($i1 = 0; $i1 < $contador; $i1++) {
      $vr1 = $_POST['vr_digitado' . $i1];  //printf("vr_digitado ".$i." : %.2f<br>",$vr_digitado);
      $a = $a + $vr1;
    }


    $id_auto_crpp = $_POST['id_crpp']; //echo $id_auto_crpp;
    for ($i = 0; $i < $contador; $i++) {
      $id_manu_crpp = 'CRPP' . $_POST['crpp']; //printf("id manu crpp : %s<br>",$id_manu_crpp);
      $fecha_crpp = $_POST['fecha_crpp']; //printf("fecha crpp : %s<br>",$fecha_crpp);

      $id_manu_cdpp = 'CDPP' . $_POST['id_manu_cdpp']; //printf("id manu cdpp : %s<br>",$id_manu_cdpp);
      $id_auto_cdpp = $_POST['id_auto_cdpp']; //printf("id auto cdpp : %s<br>",$id_auto_cdpp);
      $fecha_cdpp = $_POST['fecha_cdpp']; //printf("fecha cdpp : %s<br>",$fecha_cdpp);
      $ter_nat = $_POST['ter_nat']; //printf("ter nat : %s<br>",$ter_nat);
      $ter_jur = $_POST['ter_jur']; //printf("ter_jur : %s<br>",$ter_jur);
      // consulta tercero nat
      $sqla = "select * from terceros_naturales where id_emp ='$id_emp' and id ='$ter_nat'";
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
      $sqla = "select * from terceros_juridicos where id_emp ='$id_emp' and id ='$ter_jur'";
      $resultadoa = $connectionxx->query($sqla);
      $raz_soc = '';
      while ($rowa = $resultadoa->fetch_assoc()) {
        $raz_soc = $rowa["raz_soc2"];
      }
      //printf("%s",$raz_soc);
      $tercero = $nat_com . $raz_soc; //printf("tercero : %s<br>",$tercero);
      $des_cdpp = $_POST['des_cdpp']; //printf("des cdpp : %s<br>",$des_cdpp);
      $total = $_POST['total']; //printf("total: %.2f<br>",$total);

      $contrato = $_POST['contrato'];
      $adicion = $_POST['adicion'];
      $t_humano = $_POST['t_humano'];
      $inversion = isset($_POST['inversion']) ? $_POST['inversion'] : 0;
      $subsidiado = $_POST['subsidiado'];
      $pago = $_POST['pago'];
      $n_contrato = $_POST['n_contrato'];
      $situacion = $_POST['situacion' . $i];  //printf("situacion de fondos ".$i." : %s<br>",$situacion);

      $detalle_crpp = strtoupper($_POST['detalle_crpp']);

      $pgcp1 = isset($_POST['pgcp1']) ? $_POST['pgcp1'] : 0;
      $pgcp2 = isset($_POST['pgcp2']) ? $_POST['pgcp2'] : 0;
      $pgcp3 = isset($_POST['pgcp3']) ? $_POST['pgcp3'] : 0;
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
      $des1 = isset($_POST['des1']) ? $_POST['des1'] : 0;
      $des2 = isset($_POST['des2']) ? $_POST['des2'] : 0;
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
      $vr_deb_2 = isset($_POST['vr_deb_2']) ? $_POST['vr_deb_2'] + 0 : 0;
      $vr_deb_3 = isset($_POST['vr_deb_3']) ? $_POST['vr_deb_3'] + 0 : 0;
      $vr_deb_1 = isset($_POST['vr_deb_1']) ? $_POST['vr_deb_1'] + 0 : 0;
      $vr_deb_4 = isset($_POST['vr_deb_4']) ? $_POST['vr_deb_4'] + 0 : 0;
      $vr_deb_5 = isset($_POST['vr_deb_5']) ? $_POST['vr_deb_5'] + 0 : 0;
      $vr_deb_6 = isset($_POST['vr_deb_6']) ? $_POST['vr_deb_6'] + 0 : 0;
      $vr_deb_7 = isset($_POST['vr_deb_7']) ? $_POST['vr_deb_7'] + 0 : 0;
      $vr_deb_8 = isset($_POST['vr_deb_8']) ? $_POST['vr_deb_8'] + 0 : 0;
      $vr_deb_9 = isset($_POST['vr_deb_9']) ? $_POST['vr_deb_9'] + 0 : 0;
      $vr_deb_11 = isset($_POST['vr_deb_11']) ? $_POST['vr_deb_11'] + 0 : 0;
      $vr_deb_10 = isset($_POST['vr_deb_10']) ? $_POST['vr_deb_10'] + 0 : 0;
      $vr_deb_12 = isset($_POST['vr_deb_12']) ? $_POST['vr_deb_12'] + 0 : 0;
      $vr_deb_13 = isset($_POST['vr_deb_13']) ? $_POST['vr_deb_13'] + 0 : 0;
      $vr_deb_14 = isset($_POST['vr_deb_14']) ? $_POST['vr_deb_14'] + 0 : 0;
      $vr_deb_15 = isset($_POST['vr_deb_15']) ? $_POST['vr_deb_15'] + 0 : 0;
      $vr_cre_1 = isset($_POST['vr_cre_1']) ? $_POST['vr_cre_1'] + 0 : 0;
      $vr_cre_2 = isset($_POST['vr_cre_2']) ? $_POST['vr_cre_2'] + 0 : 0;
      $vr_cre_3 = isset($_POST['vr_cre_3']) ? $_POST['vr_cre_3'] + 0 : 0;
      $vr_cre_4 = isset($_POST['vr_cre_4']) ? $_POST['vr_cre_4'] + 0 : 0;
      $vr_cre_5 = isset($_POST['vr_cre_5']) ? $_POST['vr_cre_5'] + 0 : 0;
      $vr_cre_6 = isset($_POST['vr_cre_6']) ? $_POST['vr_cre_6'] + 0 : 0;
      $vr_cre_7 = isset($_POST['vr_cre_7']) ? $_POST['vr_cre_7'] + 0 : 0;
      $vr_cre_8 = isset($_POST['vr_cre_8']) ? $_POST['vr_cre_8'] + 0 : 0;
      $vr_cre_9 = isset($_POST['vr_cre_9']) ? $_POST['vr_cre_9'] + 0 : 0;
      $vr_cre_10 = isset($_POST['vr_cre_10']) ? $_POST['vr_cre_10'] + 0 : 0;
      $vr_cre_11 = isset($_POST['vr_cre_11']) ? $_POST['vr_cre_11'] + 0 : 0;
      $vr_cre_12 = isset($_POST['vr_cre_12']) ? $_POST['vr_cre_12'] + 0 : 0;
      $vr_cre_13 = isset($_POST['vr_cre_13']) ? $_POST['vr_cre_13'] + 0 : 0;
      $vr_cre_14 = isset($_POST['vr_cre_14']) ? $_POST['vr_cre_14'] + 0 : 0;
      $vr_cre_15 = isset($_POST['vr_cre_15']) ? $_POST['vr_cre_15'] + 0 : 0;
      $tot_deb = $vr_deb_1 + $vr_deb_2 + $vr_deb_3 + $vr_deb_4 + $vr_deb_5 + $vr_deb_6 + $vr_deb_7 + $vr_deb_8 + $vr_deb_9 + $vr_deb_10 + $vr_deb_11 + $vr_deb_12 + $vr_deb_13 + $vr_deb_14 + $vr_deb_15;
      $tot_cre = $vr_cre_1 + $vr_cre_2 + $vr_cre_3 + $vr_cre_4 + $vr_cre_5 + $vr_cre_6 + $vr_cre_7 + $vr_cre_8 + $vr_cre_9 + $vr_cre_10 + $vr_cre_11 + $vr_cre_12 + $vr_cre_13 + $vr_cre_14 + $vr_cre_15;

      $tot_deb_a = number_format($tot_deb, 2, ',', '.');
      $tot_cre_a = number_format($tot_cre, 2, ',', '.');

      $vr_orig = $_POST['vr_orig_cdpp' . $i];  //printf("vr_orig_cdpp ".$i." : %.2f<br>",$vr_orig_cdpp);
      $vr_digitado = $_POST['vr_digitado' . $i]; // printf("vr_digitado ".$i." : %.2f<br>",$vr_digitado);

      // vigencia fiscal

      $consultax = $connectionxx->query("select * from vf ");
      while ($rowx = $consultax->fetch_assoc()) {
        $ax = $rowx["fecha_ini"];
        $bx = $rowx["fecha_fin"];
      }


      // tipo de dato de los pgcp
      // consulta tipo_dato de pgcp
      $sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
      $resultadoa = $connectionxx->query($sqla);
      $tipa=$tipb=$tipc=$tipd=$tipe=$tipf=$tipg=$tiph=$tipi=$tipj=$tipk=$tipl=$tipm=$tipn=$tipo='';
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


      // inicio del bloque

      if ($fecha_crpp == '' or $id_manu_crpp == 'CRPP') {

        printf("<br><br><center class='Estilo9'><b>NO</b> debe dejar casillas del Certificado de Registro Presupuestal sin diligenciar<BR><BR>");
      } else {
        if ($fecha_crpp > $bx or $fecha_crpp < $ax) {
          printf("<br><br><center class='Estilo9'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
        } else {

          if ($fecha_crpp < $fecha_cdpp) {
            printf("<br><br><center class='Estilo9'>La Fecha del Registro Presupuestal <b>ES MENOR</b> a la fecha de la Disponibilidad Presupuestal<BR><BR>");
          } else {

            if (($tipa == 'M') or ($tipb == 'M') or ($tipc == 'M') or ($tipd == 'M') or ($tipe == 'M') or ($tipf == 'M') or ($tipg == 'M') or ($tiph == 'M') or ($tipi == 'M') or ($tipj == 'M') or ($tipk == 'M') or ($tipl == 'M') or ($tipm == 'M') or ($tipn == 'M') or ($tipo == 'M')) {
              printf("<br><br><center class='Estilo9'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>");
            } else {
              /*if($tot_deb_a != $tot_cre_a)
                          {
                            printf("<br><br><center class='Estilo9'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y Credito 
                            (...::: ".$tot_cre." :::...) del movimiento                     
                            <br><br>
                            <b>NO COINCIDEN</b> <BR><BR>"
                            );
                                
                          }
                         else
                          {
                                if(($tot_deb_a != $a) or ($tot_cre_a != $a) )
                                  {
                                    printf("<br><br><center class='Estilo9'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y / o Credito 
                                    (...::: ".$tot_cre." :::...) del movimiento                     
                                    <br><br>
                                    <b>NO COINCIDEN</b> con el valor TOTAL que desea Registrar (...::: ".$a." :::...) <br><br>"
                                    );
                                        
                                  }
                                 else
                                  {
                                  */

              // inserto nuevo crpp

              $cuenta = $_POST['cuenta' . $i];

              $sql = "UPDATE crpp set  
                                    
                                        id_emp= '$id_emp', id_auto_crpp='$id_auto_crpp', id_manu_crpp='$id_manu_crpp', fecha_crpp='$fecha_crpp', id_manu_cdpp='$id_manu_cdpp' , id_auto_cdpp='$id_auto_cdpp',
                                        fecha_cdpp= '$fecha_cdpp', tercero='$tercero', ter_nat='$ter_nat', ter_jur='$ter_jur', ced_nat='', ced_jur='', 
                                        des_cdpp=  '$des_cdpp', total='$total', contrato='$contrato', adicion='$adicion', t_humano='$t_humano', inversion='$inversion', subsidiado='$subsidiado', pago='$pago', situacion='$situacion' ,
                                        
                                        pgcp1='$pgcp1' , pgcp2='$pgcp2' , pgcp3='$pgcp3' , pgcp4='$pgcp4' , pgcp5='$pgcp5' , pgcp6='$pgcp6' , pgcp7='$pgcp7' , pgcp8='$pgcp8' , pgcp9='$pgcp9' , pgcp10='$pgcp10' , pgcp11='$pgcp11' , pgcp12='$pgcp12' , pgcp13='$pgcp13' , pgcp14='$pgcp14' , pgcp15='$pgcp14' , 
                                        des1='$des1' , des2='$des2' , des3='$des3' , des4='$des4' , des5='$des5' , des6='$des6' , des7='$des7' , des8='$des8' , des9='$des9' , des10='$des10' , des11='$des11' , des12='$des12' , des13='$des13' , des14='$des14' , des15='$des15' , 
                                        vr_deb_1='$vr_deb_1' , vr_deb_2='$vr_deb_2' , vr_deb_3='$vr_deb_3' , vr_deb_4='$vr_deb_4' , vr_deb_5='$vr_deb_5' , vr_deb_6='$vr_deb_6' , vr_deb_7='$vr_deb_7' , vr_deb_8='$vr_deb_8' , vr_deb_9='$vr_deb_9' , 
                                        vr_deb_10='$vr_deb_10' , vr_deb_11='$vr_deb_11' , vr_deb_12='$vr_deb_12' , vr_deb_13='$vr_deb_13' , vr_deb_14='$vr_deb_14' , vr_deb_15='$vr_deb_15' , 
                                        vr_cre_1='$vr_cre_1' , vr_cre_2='$vr_cre_2' , vr_cre_3='$vr_cre_3' , vr_cre_4='$vr_cre_4' , vr_cre_5='$vr_cre_5' , vr_cre_6='$vr_cre_6' , vr_cre_7='$vr_cre_7' , vr_cre_8='$vr_cre_8' , vr_cre_9='$vr_cre_9' , 
                                        vr_cre_10='$vr_cre_10' , vr_cre_11='$vr_cre_11' , vr_cre_12='$vr_cre_12' , vr_cre_13='$vr_cre_13' , vr_cre_14='$vr_cre_14' , vr_cre_15='$vr_cre_15' , 
                                        tot_deb='$tot_deb', tot_cre='$tot_cre', vr_orig='$vr_orig', vr_digitado='$vr_digitado', cuenta='$cuenta', detalle_crpp='$detalle_crpp',n_contrato='$n_contrato' where  id_auto_crpp = '$id_auto_crpp' and liq1 ='' and cuenta='$cuenta'";

              $connectionxx->query($sql) or die();
              $paso = '1';

              //** 1.- saco de cdpp el vr_obligado hasta la fecha 2.- le sumo el vr_digitado 3.- actualizo nuevamente
              //1
              $sqlxx = "select * from cdpp 
                                        where id_emp ='$id_emp' and consecutivo ='$id_cdpp' and cuenta ='$cuenta' and valor ='$vr_orig'";
              $resultadoxx = $connectionxx->query($sqlxx);
              while ($rowxx = $resultadoxx->fetch_assoc()) {
                $vr_obligado = $rowxx["vr_obligado"];
              }
              //2
              $nuevo_vr_obligado = $vr_obligado + $vr_digitado;
              //3
              $sql2 = "UPDATE cdpp set vr_obligado='$nuevo_vr_obligado' 
                                        where id_emp = '$id_emp' and consecutivo = '$id_auto_cdpp' and cuenta ='$cuenta' and valor ='$vr_orig' ";
              $resultado2 = $connectionxx->query($sql2);



              //}
              //} 
            }
          }
        }
      }
    } // fin for
    if ($paso == '1') {
      if ($contrato == 'SI') {
        $ver_contrato = "<a href='../contratacion/index.php?fec=$fecha_crpp&ruta=CRPP' target='_blank'><img src='../simbolos/contrato.png' border='0' /></a>";
        $concepto_cont = "Contratar";
      }
    ?>
      <center><img src='../simbolos/ok.png' width='32' height='32' /></center>
      <br />
      <center>
        <div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">REGISTRO MODIFICADO CON EXITO <?php //print $anno; ?></div>
        <br />
      </center>
      <br />
    <?php
    }


    //sacar total de vr_obligado y comparar con total de valor, si son =0 -> contab = si

    $link = new mysqli($server, $dbuser, $dbpass, $database);
    $resulta = $link->query("select SUM(valor) AS TOTAL from cdpp WHERE id_emp='$id_emp' and consecutivo = '$id_cdpp'");
    $row = $resulta->fetch_row();
    $total = $row[0];
    $tot_vr_obligado = $total;

    $resulta2 = $link->query("select SUM(vr_digitado) AS TOTAL from crpp WHERE id_emp='$id_emp' and id_auto_cdpp = '$id_cdpp'");
    $row2 = $resulta2->fetch_row();
    $total2 = $row2[0];
    $tot_vr = $total2;

    if ($tot_vr == $tot_vr_obligado) {

      $sql3 = "UPDATE cdpp set contab='SI' where id_emp = '$id_emp' and consecutivo = '$id_cdpp'";
      $resultado3 = $connectionxx->query($sql3);
    }
    // verificar el valor registrado con el valor del cdpp si primero menor cdpp contab no
    if ($tot_vr_obligado > $tot_vr) {
      $sql3 = "UPDATE cdpp set contab='NO' where id_emp = '$id_emp' and consecutivo = '$id_cdpp'";
      $resultado3 = $connectionxx->query($sql3);
    }



    printf("

<center class='Estilo4'>
<br><br>
<form method='post' action='mvto.php'>
<input type='hidden' name='nn' value='CRPP'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");




    ?>


  <?php
}
  ?>