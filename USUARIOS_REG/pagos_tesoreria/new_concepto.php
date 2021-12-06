<?php
session_start();
if (!$_SESSION["login"]) {
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
                color: #666666;
            }

            .suggestionsBox {
                position: relative;
                left: 60px;
                margin: 0px 0px 0px 0px;
                width: 600px;
                background-color: #335194;
                -moz-border-radius: 7px;
                -webkit-border-radius: 7px;
                border: 2px solid #2AAAFF;
                color: #fff;
                font-size: 11px;
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
        <script type="text/javascript" src="javas.js"> </script>
        <script type="text/javascript" src="java.js"> </script>
        <script src="../jquery.js"></script>
        <script type="text/javascript" src="../jquery.validate.js"></script>

        <script>
            var tipo_dato;

            function ValidaBase() {
                var contador = document.getElementById('contis').innerHTML;
                var concepto = document.getElementById('concepto').value;
                if (concepto == '') {
                    alert("El concepto no puede estar vacio");
                    document.getElementById('concepto').focus();
                    return (false);
                }
                for (i = 1; i <= contador; i++) {
                    var base = document.getElementById('base' + i).value;
                    if ((base == '') || (base <= 0)) {
                        alert("El valor de la base no puede ser vacio o cero");
                        document.getElementById('base' + i).focus();
                        return (false);
                    }
                    var tarifa = document.getElementById('tarifa' + i).value;
                    if (tarifa <= 0 || tarifa >= 1) {
                        alert("La tarifa debe ser un numero decimal entre 0 y 1");
                        document.getElementById('tarifa' + i).focus();
                        return (false);
                    }
                }
                return (true);
            }

            function CuentaDetalle() {
                var cont;
                var pgcp = document.getElementById('pgcp1').value;
                var pos_url2 = 'consultas/tipo_cuenta.php';
                var req = new XMLHttpRequest();
                if (req) {
                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            tipo_dato = req.responseText;
                            if (tipo_dato == 'M') {
                                alert("La cuenta seleccionada es de tipo mayor");
                                document.getElementById('pgcp1').select();
                            }
                        }

                    }
                    req.open('POST', pos_url2 + '?cod=' + pgcp, false);
                    req.send(null);
                }
            }
        </script>


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
                font-weight: bold
            }
        </style>

        <script>
            function validar(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) + punto
                patron = /\d/; //ver nota 
                te = String.fromCharCode(tecla);
                return patron.test(te);
            }
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
                    <div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
                        <div align="center" class="Estilo4"><strong>
                                <?php
                                $var = $_GET['var'];
                                include('../config.php');
                                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $sqlxx = "select * from fecha";
                                $resultadoxx = $connectionxx->query($sqlxx);

                                while ($rowxx = $resultadoxx->fetch_assoc()) {

                                    $idxx = $rowxx["id_emp"];
                                    $id_emp = $rowxx["id_emp"];
                                }


                                ?>CREAR
                                NUEVO</strong> <strong>DESCUENTO</strong> </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
                        <div align="left">
                            <form name="a" method="post" onsubmit="return confirm('Verifique que todos los datos estan correctos')" action="p_new_concepto.php">
                                <table align="center" width="800" border="1" class="bordepunteado1">
                                    <tr>
                                        <td colspan="2" bgcolor="#DCE9E5">
                                            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                                <div align="center" class="Estilo4"><strong>
                                                        <?php
                                                        if ($var == "retencion") {
                                                            $posf = "571px;"
                                                        ?>
                                                            RETENCION EN LA FUENTE
                                                            <input name="rb" type="radio" value="retefuente" checked="checked" />
                                                        <?php
                                                        }

                                                        if ($var == "iva") {
                                                            $posf = "500px;"
                                                        ?>

                                                            RETEIVA
                                                            <input name="rb" type="radio" value="reteiva" checked="checked" />

                                                        <?php
                                                        }

                                                        if ($var == "estampilla") {
                                                            $posf = "618px;"
                                                        ?>
                                                            ESTAMPILLA
                                                            <input name="rb" type="radio" value="estampillas" checked="checked" />
                                                        <?php
                                                        }

                                                        if ($var == "ica") {
                                                            $posf = "618px;"
                                                        ?>
                                                            RETEICA
                                                            <input name="rb" type="radio" value="reteica" checked="checked" />
                                                        <?php
                                                        }
                                                        if ($var == "cree") {
                                                            $posf = "618px;"
                                                        ?>
                                                            RETECREE
                                                            <input name="rb" type="radio" value="retecree" checked="checked" />
                                                        <?php
                                                        }


                                                        ?>
                                                    </strong></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="270">
                                            <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                                <strong>CONCEPTO </strong>
                                            </div>
                                        </td>
                                        <td width="310">
                                            <div align="left" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                                <input name="concepto" type="text" class="Estilo4" id="concepto" onkeyup="a.concepto.value=a.concepto.value.toUpperCase();" style="width:300px;" />
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $mostrar = '';
                                    $acc = '';
                                    for ($i = 1; $i < 2; $i++) {
                                        echo "<tr aling='left' style='display:$acc;' id='fil$i'>
					 <td><div aling='left' class='Estilo4' style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'><strong>CUENTA P.G.C.P RETENCION </strong></div></td>
					  <td><div aling='left' style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span aling='left' class='Estilo4'>
						  <input name='cuenta' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='2436' onkeyup='lookup(this.value,$i);'>
					  </span></div><div style='float:rigth;display:none' id='resulta1'></div>
					 <div aling='left' class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: $posf'>
								<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
								<div aling='left' class='suggestionList' id='autoSug$i'>
									&nbsp;
								</div>
					 </div>
					  </td>
					  
					</tr>";
                                        if ($i == 2) {
                                            $acc = 'none';
                                        }
                                    }
                                    ?>

                                    <?php
                                    if ($var == "estampilla") {
                                        $mostrar = "none";
                                    }
                                    ?>
                                    <!-- Moastrar codigo de retenci�n de acuerdo a la opcion recibida retenci�n o iva, no se muestra para estampilla-->


                                    <tr style="display:<?php echo ($mostrar); ?> ">
                                        <td>
                                            <div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"><strong>CODIGO RETENCIONES PRACTICADAS </strong></div>
                                        </td>
                                        <td>
                                            <div align="left" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

                                                <?php
                                                if ($var == "retencion") {
                                                ?><select name="codigo" class="Estilo4">
                                                        <?php
                                                        include('../config.php');
                                                        @$db = new mysqli($server, $dbuser, $dbpass, $database);

                                                        $strSQL = "SELECT * FROM conceptos_dian Where tipo='PRACTICADA' ORDER BY codigo";
                                                        $rs = $db->query($strSQL);
                                                        while ($r = $rs->fetch_assoc()) {
                                                            echo "<OPTION VALUE=\"" . $r["codigo"] . "\">" . $r["concepto"] . "</OPTION>";
                                                        }
                                                    }
                                                    if ($var == "iva") {
                                                        ?>
                                                        <select name="codigo" class="Estilo4">
                                                        <?php
                                                        include('../config.php');
                                                        @$db = new mysqli($server, $dbuser, $dbpass, $database);

                                                        $strSQL = "SELECT * FROM conceptos_dian Where tipo='IVA' ORDER BY codigo";
                                                        $rs = $db->query($strSQL);
                                                        while ($r = $rs->fetch_assoc()) {
                                                            echo "<OPTION VALUE=\"" . $r["codigo"] . "\">" . $r["concepto"] . "</OPTION>";
                                                        }
                                                    }


                                                        ?>
                                                        </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>


                                        <td colspan="2">
                                            <div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:5px;">
                                                <div align="center">
                                                    <input type="hidden" name="id" value="<?php printf("%s", $idxx); ?>" />
                                                    <!--input name="Submit322" type="submit" class="Estilo4"  value="Grabar Nuevo Descuento" 
			onclick="this.form.action = 'p_new_concepto.php'" /-->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <table width="800" border="1" align="center" class="bordepunteado1">
                                    <tr>
                                        <td colspan="3" bgcolor="#FFFFFF">
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
                                        <td colspan="3" bgcolor="#DCE9E5">
                                            <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                                <div align="center" class="Estilo4"><strong>INGRESOS DE BASES - TOPES - TARIFAS - RANGOS
                                                        <input type="hidden" name='contador' value='1' id="contador"><br>
                                                        <img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='massitem();'>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span id='contis' class='Estilo4'>1</span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='mennitem();'>
                                                    </strong></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="266" bgcolor="#F5F5F5">
                                            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                                <div align="center" class="Estilo4"><strong>BASE</strong></div>
                                            </div>
                                        </td>

                                        <td width="267" bgcolor="#F5F5F5">
                                            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                                <div align="center" class="Estilo4"><strong>TOPE</strong></div>
                                            </div>
                                        </td>
                                        <td width="263" bgcolor="#F5F5F5">
                                            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                                <div align="center" class="Estilo4"><strong>TARIFA ( Ej. Si es 5% escribir 0.05 )</strong></div>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php
                                    $acc = '';
                                    for ($i = 1; $i < 6; $i++) {
                                        echo "<tr aling='center' style='position:relative; display:$acc;' id='fil$i'>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div>
		  		<input name='base$i' type='text' class='Estilo4' id='base$i' style='width:180px; style='text-align:right' value='' onkeypress='return validar(event)' onfocus='CuentaDetalle();'>
		  	</div>
          </div>
     </div>
      </td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div>
              <input name='tope$i' type='text' class='Estilo4' id='tope$i' style='width:180px; style='text-align:right' value='' onkeypress='return validar(event)'>
            </div>
          </div>
      </div></td>
      <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
          <div align='center' class='Estilo4'>
            <div>
              <input name='tarifa$i' type='text' class='Estilo4' id='tarifa$i' style='width:180px; style='text-align:right' value='' onkeypress='return validar(event)'>
            </div>
          </div>
      </div></td>
    </tr>";
                                        if ($i == 1) {
                                            $acc = 'none';
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" bgcolor="#990000">
                                            <div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                                <div align="right" class="Estilo4">
                                                    <div align="center"><strong>
                                                            <font color="#FFFFFF"> VERIFIQUE TODOS LOS DATOS ESAN CORRECTOS ANTES DE GRABAR</font>
                                                        </strong></div>
                                                </div>
                                            </div>
                                            <div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
                                                <div align="center" class="Estilo12">
                                                    <div align="right"> </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="3">
                                            <div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                                <div align="center">
                                                    <input name="Submit" type="submit" class="Estilo4" value="Grabar Descuentos" onclick="return ValidaBase();" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--secciones de fila -->
                                    <!--secciones de fila -->
                                </table>





                            </form>
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
                                    <div align="center"><a href='desctos.php' target='_parent'>VOLVER </a> </div>
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
    </body>

    </html>
<?php
}
?>