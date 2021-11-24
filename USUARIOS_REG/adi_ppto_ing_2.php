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
        font-size: 10px;
        color: #006699;
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

    <script>
      function objetoAjax() {
        var xmlhttp = false;
        try {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (E) {
            xmlhttp = false;
          }
        }

        if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
          xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
      }

      function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
        patron = /\d/; //ver nota 
        te = String.fromCharCode(tecla);
        return patron.test(te);
      }

      function Comprueba() {
        var rubro = document.getElementById('cod_pptal').value;
        // Iniciamos ajax
        ajax = objetoAjax();
        //uso del medotod GET
        ajax.open("POST", "comprobadores/consulta_ppto_ing.php", false);
        ajax.onreadystatechange = function() {
          if (ajax.readyState == 4) {
            //mostrar resultados en esta capa
            //divFormulario.innerHTML = ajax.responseText
            tipo = ajax.responseText;
            var datos = tipo.split(",");
            // Si es cuenta mayor valido
            if (datos[0] == 'M') {
              document.getElementById('mayor').innerHTML = '<font color=#FF0000>*</font>';
              document.getElementById('aprobado').innerHTML = '0.00';
              document.getElementById('definitivo').innerHTML = '0.00';
              document.getElementById('cod_pptal').focus();
            } else {
              document.getElementById('mayor').innerHTML = '';
              document.getElementById('aprobado').innerHTML = datos[1];
              document.getElementById('definitivo').innerHTML = datos[2];
            }
            //mostrar el formulario
          }
        }
        //como hacemos uso del metodo GET
        //colocamos null
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //enviando los valores
        ajax.send("cod=" + rubro)
      }

      function ValidarForm() {
        cuenta = document.getElementById('mayor').innerHTML;
        aprob = document.getElementById('aprobado').innerHTML;
        valor = document.a.valor_adi.value;
        acto = document.a.tipo_acto.value;
        numero = document.a.num_acto.value;
        desc = document.a.concepto_adi.value;
        if ((cuenta != '') || (aprob == '')) {
          alert("El rubro seleccionado no es de detalle");
          document.getElementById('cod_pptal').focus();
          return (false);
        }
        if (valor == "") {
          alert("El campo valor no puede estar vacio");
          document.a.valor_adi.focus();
          return (false);
        }
        if (acto == "") {
          alert("El campo tipo de acto no puede estar vacio");
          document.a.tipo_acto.focus();
          return (false);
        }
        if (numero == "") {
          alert("El campo numero de acto no puede estar vacio");
          document.a.num_acto.focus();
          return (false);
        }
        if (desc == "") {
          alert("El campo descripci�n no puede estar vacio");
          document.a.concepto_adi.focus();
          return (false);
        }

        return (true);

      }
    </script>


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
                  <div align="center"><a href='adi_ppto_ing.php' target='_parent'>VOLVER </a> </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <form name="a" method="post" action="proc_adi_ppto_ing.php">
            <table width="750" border="1" align="center" class="bordepunteado1">
              <tr>
                <td colspan="4" bgcolor="#DCE9E5">
                  <div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
                    <div align="center" class="Estilo4"><strong>MODIFICACIONES AL PRESUPUESTO DE INGRESOS<br />
                        <br />
                        Adiciones al Presupuesto </strong></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td width="178">
                  <div id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                    <div align="center"><span class="Estilo4"><strong>Cuenta Seleccionada </strong></span><br />
                    </div>
                  </div>
                </td>
                <td class="Estilo4" colspan="3">
                  <div align="center">
                    <div align="left" style="padding-left:5px;padding-top:5px;">
                      <?php


                      include('config.php');
                      $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                      $sqlxx = "SELECT * from fecha";
                      $resultadoxx = $connectionxx->query($sqlxx);
                      while ($rowxx = $resultadoxx->fetch_assoc()) {
                        $idxx = $rowxx["id_emp"];
                      }
                      $cod_pptal = $_POST['nn'];
                      $resultado = $connectionxx->query("SELECT * from car_ppto_ing where cod_pptal ='$cod_pptal' and id_emp = '$idxx'");
                      while ($row = $resultado->fetch_assoc()) {
                        $id_emp = $row["id_emp"];
                        $nom_rubro = $row["nom_rubro"];
                        $definitivo = $row["definitivo"];
                        $ppto_aprob = $row["ppto_aprob"];
                      }
                      ?>
                      <SELECT name="cod_pptal" id="cod_pptal" onchange="Comprueba();" class="Estilo4" style="width: 400px;">
                        <?php
                        $rs = $connectionxx->query("SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx'  ORDER BY cod_pptal");
                        while($r = $rs->fetch_assoc()){
                          echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</OPTION>";
                        }
                        ?>
                      </SELECT>
                      <?php $editar = isset($editar) ? $editar : '' ?>
                      <input name="id_emp" type="hidden" id="id_emp" value="<?php printf($idxx); ?>" />
                      <input name="id" type="hidden" value="<?php printf($editar); ?>" />
                      <input name="nom_rubro" type="hidden" value="<?php printf("$r[nom_rubro]"); ?>" />
                      <strong id="mayor"></strong>
                    </div>
                    <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                      <div align="center">
                        <?php //printf("%s", $cod_pptal); ?></div>
                    </div>
                </td>

              </tr>


              <tr>
                <td width="178" bgcolor="#F5F5F5">
                  <div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
                    <div align="center"><span class="Estilo4"><strong>Fecha de la Adicion </strong></span><br />
                    </div>
                  </div>
                </td>
                <td width="245" bgcolor="#F5F5F5">
                  <div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left">
                      <input name="fecha_adi" type="text" class="Estilo4" id="fecha_adi" value="<?php $bb = date("Y/m/d");
                                                                                                printf($bb); ?>" size="12" />
                      <input name="button" type="button" class="Estilo4" id="button" onclick="displayCalendar(document.forms[0].fecha_adi,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
                    </div>
                  </div>
                </td>
                <td colspan="2" bgcolor="#F5F5F5">
                  <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center">

                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div id="div3" style="padding-left:3px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><span class="Estilo4"><strong>VALOR A ADICIONAR </strong></span><br />
                    </div>
                  </div>
                </td>
                <td>
                  <div id="div4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left">
                      <input name="valor_adi" type="text" class="Estilo4" id="valor_adi" onkeypress="return validar(event)" size="30" maxlength="30" style="text-align:right" />
                    </div>
                  </div>
                </td>
                <td width="152">
                  <div id="div6" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center"> <span class="Estilo4"><strong>Presupuesto Inicial Aprobado</strong><br /></span>
                      <strong id="aprobado" class="Estilo7"></strong>

                      <input name="ppto_aprob" type="hidden" id="ppto_aprob" value="<?php printf($ppto_aprob); ?>" />
                      <br />
                    </div>
                  </div>
                </td>
                <td width="145">
                  <div id="div13" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center"> <span class="Estilo4"><strong>Presupuesto Definitivo hasta la Fecha </strong><br /></span>
                      <strong id="definitivo" class="Estilo7"></strong>
                      <br />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div id="div10" style="padding-left:3px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><span class="Estilo4"><strong> ACTO ADMINISTRATIVO </strong></span><br />
                    </div>
                  </div>
                </td>
                <td>
                  <div id="div11" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left">
                      <SELECT name="tipo_acto" class="Estilo4" id="tipo_acto">
                        <option value="ORDENANZA">ORDENANZA</option>
                        <option value="ACUERDO" SELECTed="SELECTed">ACUERDO</option>
                        <option value="DECRETO">DECRETO</option>
                        <option value="RESOLUCION">RESOLUCION</option>
                        <option value="OTRO">OTRO TIPO DE ACTO ADMTVO</option>
                        <option value="N/A">NO APLICA</option>
                      </SELECT>
                    </div>
                  </div>
                </td>
                <td colspan="2">
                  <div id="div12" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="left" class="Estilo4">
                      Numero:
                      <input name="num_acto" type="text" class="Estilo4" id="num_acto" size="30" maxlength="30" onkeyup="a.num_acto.value=a.num_acto.value.toUpperCase();" />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td width="178">&nbsp;</td>
                <td width="245">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>

              <tr>
                <td width="178">
                  <div id="div7" style="padding-left:3px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                    <div align="center"><span class="Estilo4"><strong>CONCEPTO DE LA ADICION </strong></span><br />
                    </div>
                  </div>
                </td>
                <td colspan="3">
                  <div id="div8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="left">
                      <textarea name="concepto_adi" cols="100" rows="5" class="Estilo4" onkeyup="a.concepto_adi.value=a.concepto_adi.value.toUpperCase();"></textarea>
                      <br />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="4">
                  <div id="div9" style="padding-left:3px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                    <div align="center">
                      <input name="Submit" type="submit" class="Estilo4" value="Grabar Adicion" onclick="return ValidarForm();" />
                      <span class="Estilo8">:::</span>
                      <input name="Submit2" type="reset" class="Estilo4" value="Borrar Formulario" />
                      <br />
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
          <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
            <div align="center">
              <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  <div align="center"><a href='adi_ppto_ing.php' target='_parent'>VOLVER </a> </div>
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
                  <?php
                  $resultadoxx = $connectionxx->query("SELECT * from fecha");

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