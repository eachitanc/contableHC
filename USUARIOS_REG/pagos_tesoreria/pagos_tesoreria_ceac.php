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

            .Estilo9 {
                color: #990000
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
                        <div align="center" class="Estilo4"><strong>PAGOS TESORERIA ACUMULADOS</strong></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
                        <form method="post" action="pagos_tesoreria_cxp.php">
                            <table width="800" border="0" align="center">
                                <tr>
                                    <td width="600">
                                        <?php
                                        include('../config.php');
                                        $mesh = array('cc', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
                                        $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                        $sqlxx = "select * from fecha";
                                        $resultadoxx = $connectionxx->query($sqlxx);

                                        $sq3 = "select cargo from usuarios2 where login = '$_SESSION[login]'";
                                        $re3 = $connectionxx->query($sq3);
                                        $rw3 = $re3->fetch_assoc();
                                        if ($rw3['cargo'] == "REVISOR") {
                                            $ver_boton = "style=display:none";
                                        }

                                        while ($rowxx = $resultadoxx->fetch_assoc()) {

                                            $idxx = $rowxx["id_emp"];
                                            $id_emp = $rowxx["id_emp"];
                                            $ano = $rowxx["ano"];
                                        }
                                        list($an, $me, $di)  = explode('/', $ano);
                                        //  $f1 = "$an/$me/01";
                                        //$f2 = "$an/$me/31";

                                        ?>
                                    </td>
                                    <td width="190">
                                        <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;"></div>
                                    </td>
                                </tr>
                            </table>
                        </form>


                        <div align="center">
                            <?php
                            $a = "CECP";
                            $b = "";
                            if ($a == 'CECP') {

                            ?>
                                <BR />
                                <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'></div>
                                <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:400px'>
                                    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                                        <a href="nuevo_ceac.php" target="_parent">...::: CREAR NUEVO CEVA ACUMULADO:::... </a>
                                    </div>
                                </div>
                                <br />
                                <br />
                                <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                                    <div align="center"><strong><span class="Estilo9">COMPROBANTES DE EGRESO ACUMULADOS<br />
                                            </span></strong></div>
                                </div>
                                <br />
                                <?php
                                $document2 = "CECP";
                                include('../objetos/filtro.php');
                                $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                $sqlz1 = "select * from ceva where id_emp = '$id_emp' and fecha_cecp between '$f1' and '$f2' order by id_manu_cecp asc ";
                                $resz1 = $cx->query($sqlz1);


                                if (isset($_POST["buscar"])) {
                                    $filtro = "and (id_manu_ceva LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%')";
                                } else {
                                    $filtro = '';
                                }

                                $a = "select * from ceva where id_emp='$id_emp' and id_auto_cobp ='AUTO'";
                                if (empty($tercero)) {
                                    $c = "";
                                } else {
                                    $c = "and tercero =$tercero2";
                                }
                                if ($fecha2 == "MES") {
                                    $f = "and fecha_ceva between '$f1' and '$f2'";
                                }
                                if ($fecha2 == "DIA") {
                                    $f = "and fecha_ceva ='$fechafil'";
                                }
                                if ($fecha2 == "A�O") {
                                    $f = "and fecha_ceva between '$a1' and '$a2'";
                                }
                                $gby = "group by id_auto_ceva";
                                $orden = "order by fecha_ceva desc";
                                $sq2 = "$a $b $c $filtro $f $gby $orden";

                                $resz1 = $cx->query($sq2);


                                printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CECP</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center'><span class='Estilo4'><b>No CHEQUE</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>

</tr>

");
                                while ($rowz1 = $resz1->fetch_assoc()) {

                                    $tot_deb  = $rowz1["tot_deb"];

                                    $tot_cheques = "";
                                    if (trim($rowz1["num_cheque"]) != "") {
                                        $tot_cheques = $tot_cheques . trim($rw2["num_cheque"]);
                                    }
                                    if (trim($rowz1["num_cheque2"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque2"]);
                                    }
                                    if (trim($rowz1["num_cheque3"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque3"]);
                                    }
                                    if (trim($rowz1["num_cheque4"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque4"]);
                                    }
                                    if (trim($rowz1["num_cheque5"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque5"]);
                                    }
                                    if (trim($rowz1["num_cheque6"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque6"]);
                                    }
                                    if (trim($rowz1["num_cheque7"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque7"]);
                                    }
                                    if (trim($rowz1["num_cheque8"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque8"]);
                                    }
                                    if (trim($rowz1["num_cheque9"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque9"]);
                                    }
                                    if (trim($rowz1["num_cheque10"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque10"]);
                                    }
                                    if (trim($rowz1["num_cheque11"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque11"]);
                                    }
                                    if (trim($rowz1["num_cheque12"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque12"]);
                                    }
                                    if (trim($rowz1["num_cheque13"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque13"]);
                                    }
                                    if (trim($rowz1["num_cheque14"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque14"]);
                                    }
                                    if (trim($rowz1["num_cheque15"]) != "") {
                                        $tot_cheques = $tot_cheques . "&nbsp;" . trim($rowz1["num_cheque15"]);
                                    }
                                    $tot_cheques = trim($tot_cheques);
                                    $modi = 'modi';

                                    printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a $ver_boton href=\"confirma_borra_ceac.php?id1=%s&fechac=%s\" onclick=\"if(!confirm('�Esta seguro de borrar el comprobante seleccionado?'))return false\">
<img src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"modi_ceac.php?id2=%s\" target='_parent' style='color:#0033FF'><img src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>
<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ceac.php?id1=%s\" style='color:#0033FF' target='_blank'><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"../contratacion_doc/generar_archivo_rp.php?id=%s&clase=Rp&id_ceva=$rowz1[id_auto_ceva]\" target='_parent' style='color:#0033FF'><img src='../simbolos/reporte2.jpg' width='20' height='20' border='0' title='Resoluci&oacute;n de pagos'></a>
</span>
</div>
</td>


</tr>", $rowz1["id_manu_ceva"], $rowz1["fecha_ceva"], $rowz1["tercero"], number_format($tot_deb, 2, ',', '.'), $tot_cheques, $rowz1["id_auto_ceva"], $rowz1["fecha_ceva"], $rowz1["id_auto_ceva"], $rowz1["id_auto_ceva"], $rw2r["id_auto_crpp"]);
                                }

                                printf("</table></center>");


                                ?>
                                <br />
                            <?php
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
}
?>