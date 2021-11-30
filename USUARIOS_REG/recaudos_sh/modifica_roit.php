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

      .suggestionsBox {
        position: relative;
        left: 30px;
        margin: 0px 0px 0px 0px;
        width: 600px;
        background-color: #335194;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #2AAAFF;
        color: #fff;
        font-size: 10px;
      }

      .suggestionList {
        margin: 0px;
        padding: 0px;
      }

      .suggestionList li {

        margin: 0px 0px 3px 0px;
        padding: 3px;
        cursor: pointer;
      }

      .suggestionList li:hover {
        background-color: #659CD8;
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


    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>

    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

    <script>
      var par = false;

      function parpadeo() {
        document.getElementById('txt').style.visibility = (par) ? 'visible' : 'hidden';
        par = !par;
      }
    </script>




    <script>
      function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
        patron = /\d/; //ver nota 
        te = String.fromCharCode(tecla);
        return patron.test(te);
      }
    </script>
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </LINK>
    <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    <style type="text/css">
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
    </style>
    <script language="JavaScript" type="text/javascript" src="javas.js"></script>

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
      //****************TABLA 
      var contLin = 1;

      function tabla_ini() {
        agregar();
        agregar();
      }


      function agregar() {
        fila = document.all.tablaf.rows.length - 1;
        if (fila < 14) {
          var tr, td;
          //var v1=document.getElementById('retefuente').value;
          //var v2=document.getElementById('reteiva').value;
          //var v55=document.getElementById('id_obcg').value;

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


      function suma_tab() {
        filas = document.all.tablaf.rows.length;
        sum_deb = 0;
        sum_cre = 0;
        for (var i = 1; i <= filas; i++) {
          sum_deb = sum_deb + parseFloat(document.getElementById("vr_deb_" + i).value);
          sum_cre = sum_cre + parseFloat(document.getElementById("vr_cre_" + i).value);


        }
        total = sum_deb - sum_cre;
        document.getElementById("tot_deb_a").value = Math.round(sum_deb * 100) / 100;
        document.getElementById("tot_cre_a").value = Math.round(sum_cre * 100) / 100;
        document.getElementById("total").value = Math.round(total * 100) / 100;
        //	alert(sum_deb);
      }
    </SCRIPT>
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

      .Estilo14 {
        color: #0000CC
      }

      .Estilo15 {
        color: #0000FF
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

      function contabilidad() {
        var id = document.getElementById("id").value;
        //alert (id);
        //var cuenta=0;
        var dato = 0;
        var pos_url2 = 'consultas/contab.php';
        var req1 = new XMLHttpRequest();
        if (req1) {
          req1.onreadystatechange = function() {
            if (req1.readyState == 4) {
              dato = req1.responseText;

            }
          }
          req1.open('POST', pos_url2 + '?cod=' + id, false);
          req1.send(null);
        }

        var arr = dato.split('*');

        var ndes = parseInt(arr[0]);
        var ndeb = parseInt(arr[0]) * 2;
        var ncre = parseInt(arr[0]) * 3;

        for (var i = 1; i <= parseInt(arr[0]); i++) {
          agregar();
          document.getElementById("pgcp" + i).value = arr[i];
          document.getElementById("des" + i).value = arr[i + ndes];
          document.getElementById("vr_deb_" + i).value = arr[i + ndeb];
          document.getElementById("vr_cre_" + i).value = arr[i + ncre];

        }
        suma_tab();



      }

      function valida_form() {
        //alert ("ok")
        if (document.getElementById("total").value != 0 || document.getElementById("total").value != 0.00) {
          alert("Las sumas no son iguales...");
          return false;
        } else return true;
      }
    </script>

    <!--fin val forms-->




    <!--fin val forms-->
  </head>

  <body onLoad="contabilidad();">

    <?php
    $id = isset($_POST['id']) ? $_POST['id'] : ''; //echo $id;
    $id_reip = isset($_POST['id_reip']) ? $_POST['id_reip'] : '';
    $id_caic = isset($_POST['id_caic']) ? $_POST['id_caic'] : '';
    $id_recau = isset($_POST['id_recau']) ? $_POST['id_recau'] : '';
    $cuenta = isset($_POST['cuenta']) ? $_POST['cuenta'] : '';
    //$nombre = $_POST['nombre'];
    $vr_digitado = $_POST['vr_digitado'];
    $tercero = $_POST['tercero'];
    $des_recaudo = $_POST['des_recaudo'];
    $id_manu_ncbt = $_POST['id_manu_ncbt'];



    //************
    include('../config.php');
    //id _emp				
    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
    $sqlxx = "select * from fecha";
    $resultadoxx = $connectionxx->query($sqlxx);

    while ($rowxx = $resultadoxx->fetch_assoc()) {
      $idxx = $rowxx["id_emp"];
      $id_emp = $rowxx["id_emp"];
    }


    $sqlxxq = "select * from recaudo_ncbt where id_emp = '$idxx' and id_recau='$id_recau' order by id asc ";
    $resultadoxxq = $connectionxx->query($sqlxxq);
    while ($rowxxq = $resultadoxxq->fetch_assoc()) {
      $id_manu_ncbt = $rowxxq["id_manu_ncbt"];
    }

    $sql1 = "select * from recaudo_ncbt where id_emp ='$idxx' and id ='$id'";
    $resultado1 = $connectionxx->query($sql1);

    while ($rw1 = $resultado1->fetch_array()) {

      $fecha_recau = $rw1["fecha_recaudo"];

      $des1 = isset($rw1["des1"]) ? $rw1["des1"] : '';
      $des2 = isset($rw1["des2"]) ? $rw1["des2"] : '';
      $des3 = isset($rw1["des3"]) ? $rw1["des3"] : '';
      $des4 = isset($rw1["des4"]) ? $rw1["des4"] : '';
      $des5 = isset($rw1["des5"]) ? $rw1["des5"] : '';
      $des6 = isset($rw1["des6"]) ? $rw1["des6"] : '';
      $des7 = isset($rw1["des7"]) ? $rw1["des7"] : '';
      $des8 = isset($rw1["des8"]) ? $rw1["des8"] : '';
      $des9 = isset($rw1["des9"]) ? $rw1["des9"] : '';
      $des10 = isset($rw1["des10"]) ? $rw1["des10"] : '';
      $des11 = isset($rw1["des11"]) ? $rw1["des11"] : '';
      $des12 = isset($rw1["des12"]) ? $rw1["des12"] : '';
      $des13 = isset($rw1["des13"]) ? $rw1["des13"] : '';
      $des14 = isset($rw1["des14"]) ? $rw1["des14"] : '';
      $des15 = isset($rw1["des15"]) ? $rw1["des15"] : '';


      $pgcp[1] = isset($rw1['pgcp1']) ? $rw1['pgcp1'] : 0;
      $pgcp[2] = isset($rw1['pgcp2']) ? $rw1['pgcp2'] : 0;
      $pgcp[3] = isset($rw1['pgcp3']) ? $rw1['pgcp3'] : 0;
      $pgcp[4] = isset($rw1['pgcp4']) ? $rw1['pgcp4'] : 0;
      $pgcp[5] = isset($rw1['pgcp5']) ? $rw1['pgcp5'] : 0;
      $pgcp[6] = isset($rw1['pgcp6']) ? $rw1['pgcp6'] : 0;
      $pgcp[7] = isset($rw1['pgcp7']) ? $rw1['pgcp7'] : 0;
      $pgcp[8] = isset($rw1['pgcp8']) ? $rw1['pgcp8'] : 0;
      $pgcp[9] = isset($rw1['pgcp9']) ? $rw1['pgcp9'] : 0;
      $pgcp[10] = isset($rw1['pgcp10']) ? $rw1['pgcp10'] : 0;
      $pgcp[11] = isset($rw1['pgcp11']) ? $rw1['pgcp11'] : 0;
      $pgcp[12] = isset($rw1['pgcp12']) ? $rw1['pgcp12'] : 0;
      $pgcp[13] = isset($rw1['pgcp13']) ? $rw1['pgcp13'] : 0;
      $pgcp[14] = isset($rw1['pgcp14']) ? $rw1['pgcp14'] : 0;
      $pgcp[15] = isset($rw1['pgcp15']) ? $rw1['pgcp15'] : 0;
      $pgcp[16] = isset($rw1['pgcp16']) ? $rw1['pgcp16'] : 0;
      $pgcp[17] = isset($rw1['pgcp17']) ? $rw1['pgcp17'] : 0;
      $pgcp[18] = isset($rw1['pgcp18']) ? $rw1['pgcp18'] : 0;
      $pgcp[19] = isset($rw1['pgcp19']) ? $rw1['pgcp19'] : 0;
      $pgcp[20] = isset($rw1['pgcp20']) ? $rw1['pgcp20'] : 0;
      $pgcp[21] = isset($rw1['pgcp21']) ? $rw1['pgcp21'] : 0;
      $pgcp[22] = isset($rw1['pgcp22']) ? $rw1['pgcp22'] : 0;
      $pgcp[23] = isset($rw1['pgcp23']) ? $rw1['pgcp23'] : 0;
      $pgcp[24] = isset($rw1['pgcp24']) ? $rw1['pgcp24'] : 0;
      $pgcp[25] = isset($rw1['pgcp25']) ? $rw1['pgcp25'] : 0;
      $pgcp[26] = isset($rw1['pgcp26']) ? $rw1['pgcp26'] : 0;
      $pgcp[27] = isset($rw1['pgcp27']) ? $rw1['pgcp27'] : 0;
      $pgcp[28] = isset($rw1['pgcp28']) ? $rw1['pgcp28'] : 0;
      $pgcp[29] = isset($rw1['pgcp29']) ? $rw1['pgcp29'] : 0;
      $pgcp[30] = isset($rw1['pgcp30']) ? $rw1['pgcp30'] : 0;
      $pgcp[31] = isset($rw1['pgcp31']) ? $rw1['pgcp31'] : 0;
      $pgcp[32] = isset($rw1['pgcp32']) ? $rw1['pgcp32'] : 0;
      $pgcp[33] = isset($rw1['pgcp33']) ? $rw1['pgcp33'] : 0;
      $pgcp[34] = isset($rw1['pgcp34']) ? $rw1['pgcp34'] : 0;
      $pgcp[35] = isset($rw1['pgcp35']) ? $rw1['pgcp35'] : 0;
      $pgcp[36] = isset($rw1['pgcp36']) ? $rw1['pgcp36'] : 0;
      $pgcp[37] = isset($rw1['pgcp37']) ? $rw1['pgcp37'] : 0;
      $pgcp[38] = isset($rw1['pgcp38']) ? $rw1['pgcp38'] : 0;
      $pgcp[39] = isset($rw1['pgcp39']) ? $rw1['pgcp39'] : 0;
      $pgcp[40] = isset($rw1['pgcp40']) ? $rw1['pgcp40'] : 0;
      $pgcp[41] = isset($rw1['pgcp41']) ? $rw1['pgcp41'] : 0;
      $pgcp[42] = isset($rw1['pgcp42']) ? $rw1['pgcp42'] : 0;
      $pgcp[43] = isset($rw1['pgcp43']) ? $rw1['pgcp43'] : 0;
      $pgcp[44] = isset($rw1['pgcp44']) ? $rw1['pgcp44'] : 0;
      $pgcp[45] = isset($rw1['pgcp45']) ? $rw1['pgcp45'] : 0;
      $pgcp[46] = isset($rw1['pgcp46']) ? $rw1['pgcp46'] : 0;
      $pgcp[47] = isset($rw1['pgcp47']) ? $rw1['pgcp47'] : 0;
      $pgcp[48] = isset($rw1['pgcp48']) ? $rw1['pgcp48'] : 0;
      $pgcp[49] = isset($rw1['pgcp49']) ? $rw1['pgcp49'] : 0;
      $pgcp[50] = isset($rw1['pgcp50']) ? $rw1['pgcp50'] : 0;
      for ($i = 1; $i <= 50; $i++) {
        if ($pgcp[$i] == "") {
          break;
        }
      }
      $contis = $i - 1;

      $vr_deb[1] = isset($rw1['vr_deb_1']) ? $rw1['vr_deb_1'] : 0;
      $vr_deb[2] = isset($rw1['vr_deb_2']) ? $rw1['vr_deb_2'] : 0;
      $vr_deb[3] = isset($rw1['vr_deb_3']) ? $rw1['vr_deb_3'] : 0;
      $vr_deb[4] = isset($rw1['vr_deb_4']) ? $rw1['vr_deb_4'] : 0;
      $vr_deb[5] = isset($rw1['vr_deb_5']) ? $rw1['vr_deb_5'] : 0;
      $vr_deb[6] = isset($rw1['vr_deb_6']) ? $rw1['vr_deb_6'] : 0;
      $vr_deb[7] = isset($rw1['vr_deb_7']) ? $rw1['vr_deb_7'] : 0;
      $vr_deb[8] = isset($rw1['vr_deb_8']) ? $rw1['vr_deb_8'] : 0;
      $vr_deb[9] = isset($rw1['vr_deb_9']) ? $rw1['vr_deb_9'] : 0;
      $vr_deb[10] = isset($rw1['vr_deb_10']) ? $rw1['vr_deb_10'] : 0;
      $vr_deb[11] = isset($rw1['vr_deb_11']) ? $rw1['vr_deb_11'] : 0;
      $vr_deb[12] = isset($rw1['vr_deb_12']) ? $rw1['vr_deb_12'] : 0;
      $vr_deb[13] = isset($rw1['vr_deb_13']) ? $rw1['vr_deb_13'] : 0;
      $vr_deb[14] = isset($rw1['vr_deb_14']) ? $rw1['vr_deb_14'] : 0;
      $vr_deb[15] = isset($rw1['vr_deb_15']) ? $rw1['vr_deb_15'] : 0;
      $vr_deb[16] = isset($rw1['vr_deb_16']) ? $rw1['vr_deb_16'] : 0;
      $vr_deb[17] = isset($rw1['vr_deb_17']) ? $rw1['vr_deb_17'] : 0;
      $vr_deb[18] = isset($rw1['vr_deb_18']) ? $rw1['vr_deb_18'] : 0;
      $vr_deb[19] = isset($rw1['vr_deb_19']) ? $rw1['vr_deb_19'] : 0;
      $vr_deb[20] = isset($rw1['vr_deb_20']) ? $rw1['vr_deb_20'] : 0;
      $vr_deb[21] = isset($rw1['vr_deb_21']) ? $rw1['vr_deb_21'] : 0;
      $vr_deb[22] = isset($rw1['vr_deb_22']) ? $rw1['vr_deb_22'] : 0;
      $vr_deb[23] = isset($rw1['vr_deb_23']) ? $rw1['vr_deb_23'] : 0;
      $vr_deb[24] = isset($rw1['vr_deb_24']) ? $rw1['vr_deb_24'] : 0;
      $vr_deb[25] = isset($rw1['vr_deb_25']) ? $rw1['vr_deb_25'] : 0;
      $vr_deb[26] = isset($rw1['vr_deb_26']) ? $rw1['vr_deb_26'] : 0;
      $vr_deb[27] = isset($rw1['vr_deb_27']) ? $rw1['vr_deb_27'] : 0;
      $vr_deb[28] = isset($rw1['vr_deb_28']) ? $rw1['vr_deb_28'] : 0;
      $vr_deb[29] = isset($rw1['vr_deb_29']) ? $rw1['vr_deb_29'] : 0;
      $vr_deb[30] = isset($rw1['vr_deb_30']) ? $rw1['vr_deb_30'] : 0;
      $vr_deb[31] = isset($rw1['vr_deb_31']) ? $rw1['vr_deb_31'] : 0;
      $vr_deb[32] = isset($rw1['vr_deb_32']) ? $rw1['vr_deb_32'] : 0;
      $vr_deb[33] = isset($rw1['vr_deb_33']) ? $rw1['vr_deb_33'] : 0;
      $vr_deb[34] = isset($rw1['vr_deb_34']) ? $rw1['vr_deb_34'] : 0;
      $vr_deb[35] = isset($rw1['vr_deb_35']) ? $rw1['vr_deb_35'] : 0;
      $vr_deb[36] = isset($rw1['vr_deb_36']) ? $rw1['vr_deb_36'] : 0;
      $vr_deb[37] = isset($rw1['vr_deb_37']) ? $rw1['vr_deb_37'] : 0;
      $vr_deb[38] = isset($rw1['vr_deb_38']) ? $rw1['vr_deb_38'] : 0;
      $vr_deb[39] = isset($rw1['vr_deb_39']) ? $rw1['vr_deb_39'] : 0;
      $vr_deb[40] = isset($rw1['vr_deb_40']) ? $rw1['vr_deb_40'] : 0;
      $vr_deb[41] = isset($rw1['vr_deb_41']) ? $rw1['vr_deb_41'] : 0;
      $vr_deb[42] = isset($rw1['vr_deb_42']) ? $rw1['vr_deb_42'] : 0;
      $vr_deb[43] = isset($rw1['vr_deb_43']) ? $rw1['vr_deb_43'] : 0;
      $vr_deb[44] = isset($rw1['vr_deb_44']) ? $rw1['vr_deb_44'] : 0;
      $vr_deb[45] = isset($rw1['vr_deb_45']) ? $rw1['vr_deb_45'] : 0;
      $vr_deb[46] = isset($rw1['vr_deb_46']) ? $rw1['vr_deb_46'] : 0;
      $vr_deb[47] = isset($rw1['vr_deb_47']) ? $rw1['vr_deb_47'] : 0;
      $vr_deb[48] = isset($rw1['vr_deb_48']) ? $rw1['vr_deb_48'] : 0;
      $vr_deb[49] = isset($rw1['vr_deb_49']) ? $rw1['vr_deb_49'] : 0;
      $vr_deb[50] = isset($rw1['vr_deb_50']) ? $rw1['vr_deb_50'] : 0;
      $vr_cre[1] = isset($rw1['vr_cre_1']) ? $rw1['vr_cre_1'] : 0;
      $vr_cre[2] = isset($rw1['vr_cre_2']) ? $rw1['vr_cre_2'] : 0;
      $vr_cre[3] = isset($rw1['vr_cre_3']) ? $rw1['vr_cre_3'] : 0;
      $vr_cre[4] = isset($rw1['vr_cre_4']) ? $rw1['vr_cre_4'] : 0;
      $vr_cre[5] = isset($rw1['vr_cre_5']) ? $rw1['vr_cre_5'] : 0;
      $vr_cre[6] = isset($rw1['vr_cre_6']) ? $rw1['vr_cre_6'] : 0;
      $vr_cre[7] = isset($rw1['vr_cre_7']) ? $rw1['vr_cre_7'] : 0;
      $vr_cre[8] = isset($rw1['vr_cre_8']) ? $rw1['vr_cre_8'] : 0;
      $vr_cre[9] = isset($rw1['vr_cre_9']) ? $rw1['vr_cre_9'] : 0;
      $vr_cre[10] = isset($rw1['vr_cre_10']) ? $rw1['vr_cre_10'] : 0;
      $vr_cre[11] = isset($rw1['vr_cre_11']) ? $rw1['vr_cre_11'] : 0;
      $vr_cre[12] = isset($rw1['vr_cre_12']) ? $rw1['vr_cre_12'] : 0;
      $vr_cre[13] = isset($rw1['vr_cre_13']) ? $rw1['vr_cre_13'] : 0;
      $vr_cre[14] = isset($rw1['vr_cre_14']) ? $rw1['vr_cre_14'] : 0;
      $vr_cre[15] = isset($rw1['vr_cre_15']) ? $rw1['vr_cre_15'] : 0;
      $vr_cre[16] = isset($rw1['vr_cre_16']) ? $rw1['vr_cre_16'] : 0;
      $vr_cre[17] = isset($rw1['vr_cre_17']) ? $rw1['vr_cre_17'] : 0;
      $vr_cre[18] = isset($rw1['vr_cre_18']) ? $rw1['vr_cre_18'] : 0;
      $vr_cre[19] = isset($rw1['vr_cre_19']) ? $rw1['vr_cre_19'] : 0;
      $vr_cre[20] = isset($rw1['vr_cre_20']) ? $rw1['vr_cre_20'] : 0;
      $vr_cre[21] = isset($rw1['vr_cre_21']) ? $rw1['vr_cre_21'] : 0;
      $vr_cre[22] = isset($rw1['vr_cre_22']) ? $rw1['vr_cre_22'] : 0;
      $vr_cre[23] = isset($rw1['vr_cre_23']) ? $rw1['vr_cre_23'] : 0;
      $vr_cre[24] = isset($rw1['vr_cre_24']) ? $rw1['vr_cre_24'] : 0;
      $vr_cre[25] = isset($rw1['vr_cre_25']) ? $rw1['vr_cre_25'] : 0;
      $vr_cre[26] = isset($rw1['vr_cre_26']) ? $rw1['vr_cre_26'] : 0;
      $vr_cre[27] = isset($rw1['vr_cre_27']) ? $rw1['vr_cre_27'] : 0;
      $vr_cre[28] = isset($rw1['vr_cre_28']) ? $rw1['vr_cre_28'] : 0;
      $vr_cre[29] = isset($rw1['vr_cre_29']) ? $rw1['vr_cre_29'] : 0;
      $vr_cre[30] = isset($rw1['vr_cre_30']) ? $rw1['vr_cre_30'] : 0;
      $vr_cre[31] = isset($rw1['vr_cre_31']) ? $rw1['vr_cre_31'] : 0;
      $vr_cre[32] = isset($rw1['vr_cre_32']) ? $rw1['vr_cre_32'] : 0;
      $vr_cre[33] = isset($rw1['vr_cre_33']) ? $rw1['vr_cre_33'] : 0;
      $vr_cre[34] = isset($rw1['vr_cre_34']) ? $rw1['vr_cre_34'] : 0;
      $vr_cre[35] = isset($rw1['vr_cre_35']) ? $rw1['vr_cre_35'] : 0;
      $vr_cre[36] = isset($rw1['vr_cre_36']) ? $rw1['vr_cre_36'] : 0;
      $vr_cre[37] = isset($rw1['vr_cre_37']) ? $rw1['vr_cre_37'] : 0;
      $vr_cre[38] = isset($rw1['vr_cre_38']) ? $rw1['vr_cre_38'] : 0;
      $vr_cre[39] = isset($rw1['vr_cre_39']) ? $rw1['vr_cre_39'] : 0;
      $vr_cre[40] = isset($rw1['vr_cre_40']) ? $rw1['vr_cre_40'] : 0;
      $vr_cre[41] = isset($rw1['vr_cre_41']) ? $rw1['vr_cre_41'] : 0;
      $vr_cre[42] = isset($rw1['vr_cre_42']) ? $rw1['vr_cre_42'] : 0;
      $vr_cre[43] = isset($rw1['vr_cre_43']) ? $rw1['vr_cre_43'] : 0;
      $vr_cre[44] = isset($rw1['vr_cre_44']) ? $rw1['vr_cre_44'] : 0;
      $vr_cre[45] = isset($rw1['vr_cre_45']) ? $rw1['vr_cre_45'] : 0;
      $vr_cre[46] = isset($rw1['vr_cre_46']) ? $rw1['vr_cre_46'] : 0;
      $vr_cre[47] = isset($rw1['vr_cre_47']) ? $rw1['vr_cre_47'] : 0;
      $vr_cre[48] = isset($rw1['vr_cre_48']) ? $rw1['vr_cre_48'] : 0;
      $vr_cre[49] = isset($rw1['vr_cre_49']) ? $rw1['vr_cre_49'] : 0;
      $vr_cre[50] = isset($rw1['vr_cre_50']) ? $rw1['vr_cre_50'] : 0;

      $tot_deb = isset($rw1["tot_deb"]) ? $rw1["tot_deb"] : 0;
      $tot_cre = isset($rw1["tot_cre"]) ? $rw1["tot_cre"] : 0;
      $difere = $tot_deb - $tot_cre;
    }


    ?>

    <center>
      <span class="Estilo4"><strong>MODIFICACION DE LA NOTA CREDITO BANCARIA No. ...::: <?php printf("%s", $id_manu_ncbt); ?> :::...</strong></span><br />
    </center>
    <form method="post" name="a" id="commentForm" action="modifica_roit2.php">
      <table width="910" height="36" border="1" align="center" class="bordepunteado1">
        <tr>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo21">
                <div align="center"><strong>MODIFICACION DEL CONSECUTIVO </strong> </div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo22">
                <div align="center">
                  <input name="id_manu_ncbt" type="text" class="required Estilo4" id="id_manu_ncbt" onKeyUp="a.id_manu_ncbt.value=a.id_manu_ncbt.value.toUpperCase();" size="80" value="<?php printf("%s", $id_manu_ncbt); ?>" />
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo21">
                <div align="center">ingrese consecutivo manual si la casilla de la izquierda se encuentra en blanco </div>
              </div>
            </div>
          </td>
        </tr>

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
              <div align="center" class="Estilo4"><?php printf("%s", $tercero); ?></div>
            </div>
          </td>
          <td width="200" bgcolor="#F5F5F5">
            <input name="id" type="hidden" value="<?php printf("%s", $id); ?>" />
            <input name="id_reip" type="hidden" value="<?php printf("%s", $id_reip); ?>" />
            <input name="id_caic" type="hidden" value="<?php printf("%s", $id_caic); ?>" />
            <input name="id_recau" type="hidden" value="<?php printf("%s", $id_recau); ?>" />
            <!--input name="cuenta" type="hidden" value="<?php //printf("%s",$cuenta); 
                                                          ?>" /-->
            <input name="tercero" type="hidden" value="<?php printf("%s", $tercero); ?>" />
          </td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center"><strong>MODIFICA DESCRIPCION</strong> </div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div align="center" class="Estilo4">
                <div align="center">
                  <input name="des_recaudo" type="text" class="required Estilo4" id="des_recaudo" onKeyUp="a.des_recaudo.value=a.des_recaudo.value.toUpperCase();" size="80" value="<?php printf("%s", $des_recaudo); ?>" />
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#F5F5F5">
            <div align="center">
              <input name="fecha_recaudo" type="text" class="required Estilo4" id="fecha_recaudo" value="<?php printf("%s", $fecha_recau); ?>" size="12" />
              <span class="Estilo8">:::</span>
              <input name="button2" type="button" class="Estilo4" onClick="displayCalendar(document.forms[0].fecha_recaudo,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
            </div>

          </td>
        </tr>
      </table>
      <br />
      <table width="910" border="1" align="center" class="bordepunteado1">
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


                <?php
                include('../config.php');
                $db = new mysqli($server, $dbuser, $dbpass, $database);

                $strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$id_emp' and cod_pptal='$cuenta'";
                $rs = $db->query($strSQL);
                $rw1 = $rs->fetch_assoc();
                printf(
                  "
			<input name='cuenta2' size='150' id='cuenta2' type='text' readonly style='border:#FFF' value='%s - %s' /> 
			<input name='cuenta' size='150' id='cuenta' type='hidden' readonly style='border:#FFF' value='%s' /> 
			
			",
                  $cuenta,
                  $rw1["nom_rubro"],
                  $cuenta
                );


                ?>


                <input name="nombre2" type="hidden" style="border:#FFF" value="<?php printf($rw1['nom_rubro']); ?>" />
              </div>
          </td>
          <td bgcolor="#FFFFFF">
            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
              <div align="center">
                <input name="vr_digitado" type="text" class="required Estilo4" id="vr_digitado" size="20" onKeyPress="return validar(event)" style="text-align:right" value="<?php printf("%s", $vr_digitado); ?>" />
              </div>
            </div>
          </td>
        </tr>
      </table>
      <br />
      <center>
      </center>
      <br />
      <script>
        function muestraURL() {
          var miPopup
          miPopup = window.open("../pgcp/consulta_cta.php", "CONTAFACIL", "width=800,height=400,menubar=no,scrollbars=yes")
        }
      </script>
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
                  <input type="hidden" name='contador' value='0' id="contador"><br>

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
      <table width="900" border="1" align="center" class="bordepunteado1">
        <table width="900" border="1" id="tablaf" align="center" class="bordepunteado1">
        </table>
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
                  <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00" readonly>
                </div>
              </div>
            </div>
          </td>
          <td bgcolor="#990000" width="134">
            <div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
              <div align="center" class="Estilo12">
                <div align="right">
                  <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00" readonly>
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
                  <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value="0.00" readonly>
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
              <div align="center"><span class="Estilo8">:::</span>
                <input name="Submit322" type="submit" class="Estilo19" value="Modificar" onclick="return valida_form();" />
              </div>
            </div>
          </td>
        </tr>
      </table>

    </form>
    <center class='Estilo19'>
      <a href="confirma_borra_roit.php?id_recau2=<?php printf("%s", $id_recau); ?>"><B>...::: VOLVER :::...</B></a>
    </center>
  </body>

  </html>
<?php
}
?>