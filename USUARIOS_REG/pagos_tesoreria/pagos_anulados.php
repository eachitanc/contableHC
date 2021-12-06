<?php
session_start();
if (!$_SESSION["login"]) {
    header("Location: ../login.php");
    exit;
} else {
    $mesh = array('cc', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
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

            .Estilo10 {
                font-size: 12px;
                font-weight: bold;
                color: #990000;
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


        <!--linea de insercion del jquery-->

        <script type="text/javascript" language="javascript" src="../jquery.js"></script>


        <!-- inicio mostrar tabla-->

        <!--**************************-->
        <script type="text/javascript">
            $(function() {

                $("#mostrar").click(function(event) {
                    event.preventDefault();
                    $("#caja").slideToggle();
                });

                $("#caja a").click(function(event) {
                    event.preventDefault();
                    $("#caja").slideUp();
                });
            });

            $(function() {
                $("#mostrar100").click(function(event) {
                    event.preventDefault();
                    $("#caja100").slideToggle();
                });
                $("#caja a").click(function(event) {
                    event.preventDefault();
                    $("#caja100").slideUp();
                });
            });
        </script>
        <!--**************************-->
        <script type="text/javascript">
            $(function() {

                $("#mostrar2").click(function(event) {
                    event.preventDefault();
                    $("#caja2").slideToggle();
                });

                $("#caja a").click(function(event) {
                    event.preventDefault();
                    $("#caja2").slideUp();
                });
            });
        </script>
        <!--**************************-->
        <script type="text/javascript">
            $(function() {

                $("#mostrar3").click(function(event) {
                    event.preventDefault();
                    $("#caja3").slideToggle();
                });

                $("#caja a").click(function(event) {
                    event.preventDefault();
                    $("#caja3").slideUp();
                });
            });
        </script>
        <!--**************************-->


        <!--**************************-->
        <style type="text/css">
            body {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 11px;
                color: #666666;
            }

            a {
                color: #993300;
                text-decoration: none;
            }

            #caja {
                width: 100%;
                display: none;
                padding: 5px;
                border: 2px solid #ffffff;
                background-color: #ffffff;
            }

            #caja100 {
                width: 100%;
                display: none;
                padding: 5px;
                border: 2px solid #ffffff;
                background-color: #ffffff;
            }

            #mostrar100 {
                display: block;
                width: 100%;
                padding: 5px;
                border: 2px solid #D0E8F4;
                background-color: #ECF8FD;
            }


            #mostrar {
                display: block;
                width: 100%;
                padding: 5px;
                border: 2px solid #D0E8F4;
                background-color: #ECF8FD;
            }

            #caja2 {
                width: 100%;
                display: none;
                padding: 5px;
                border: 2px solid #ffffff;
                background-color: #ffffff;
            }

            #mostrar2 {
                display: block;
                width: 100%;
                padding: 5px;
                border: 2px solid #D0E8F4;
                background-color: #ECF8FD;
            }

            #caja3 {
                width: 100%;
                display: none;
                padding: 5px;
                border: 2px solid #ffffff;
                background-color: #ffffff;
            }

            #mostrar3 {
                display: block;
                width: 100%;
                padding: 5px;
                border: 2px solid #D0E8F4;
                background-color: #ECF8FD;
            }
        </style>
        <!--propiedades de las tablas-->

        <style type="text/css" title="currentStyle">
            @import "../libscroll/css/demo_table.css";

            .Estilo8 {
                color: #FFFFFF
            }
        </style>
        <!--<script type="text/javascript" language="javascript" src="../libscroll/js/jquery.js"></script>-->
        <script type="text/javascript" language="javascript" src="../libscroll/js/jquery.dataTables.js"></script>


        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#tabla1').dataTable({
                    "sPaginationType": "full_numbers"
                });
            });
        </script>


        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#tabla2').dataTable({
                    "sPaginationType": "full_numbers"
                });
            });
        </script>

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#tabla3').dataTable({
                    "sPaginationType": "full_numbers"
                });
            });
        </script>

        <!--fin propiedades de las tablas-->


        <SCRIPT TYPE="text/javascript" LANGUAGE="javascript">
            //PreLoad Wait - Script
            //This script and more from http://www.rainbow.arch.scriptmania.com 
            function waitPreloadPage() { //DOM
                if (document.getElementById) {
                    document.getElementById('prepage').style.visibility = 'hidden';
                } else {
                    if (document.layers) { //NS4
                        document.prepage.visibility = 'hidden';
                    } else { //IE4
                        document.all.prepage.style.visibility = 'hidden';
                    }
                }
            }
            // End -->
        </SCRIPT>
        <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
        </LINK>

        <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    </head>

    <body>
        <!--<body onLoad="waitPreloadPage();">
<DIV id="prepage" style="position:absolute; font-family:arial; font-size:16; left:0px; top:0px; background-color:white; layer-background-color:white; height:100%; width:100%;">
<center> 
<br /><br /><br /><br />
<TABLE width=100%><TR><TD align="center"><B class="Estilo4">Optimizando Listados para Busqueda y Ordenamiento Rapido ... ... Por favor Espere !</B></TD>
</TR></TABLE>
</center>
</DIV>-->

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
                    <div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
                        <?php
                        include('../config.php');
                        $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                        $sqlxx = "select * from fecha";
                        $resultadoxx = $connectionxx->query($sqlxx);
                        $b = '';
                        while ($rowxx = $resultadoxx->fetch_assoc()) {

                            $idxx = $rowxx["id_emp"];
                            $id_emp = $rowxx["id_emp"];
                            $ano = $rowxx["ano"];
                        }
                        list($an, $me, $di)  = explode('/', $ano);


                        $archivo = "pagos_anulados.php";  // Para que el formulario del filtro me procese el nombre del archivo como action



                        ?>

                        <div align="center">

                            <BR />
                            <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                                <div align="center"><strong>DOCUMENTO FUENTE ...::: CEVA :::...<br />
                                        COMPROBANTES DE EGRESO VIGENCIA ACTUAL <BR /><br />
                                    </strong>
                                    <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
                                        <div align="center">
                                            <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:500px'>
                                                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#CC9900'>
                                                    <div align="center"><span class="Estilo10">...::: ANTES DE PAGAR RECUERDE :::... </span><BR />
                                                        ACTUALICE EL P.A.C DEL (LOS) RUBRO(S) SOBRE EL CUAL APLICARA EL PAGO<BR />
                                                        PARA CONOCER LOS VALORES CORRESPONDIENTES A <BR />
                                                        <BR />
                                                        <B>SALDOS DISPONIBLES DE CADA MES </B><BR />
                                                        <BR />
                                                        <?php
                                                        printf("
                    <form method='post' action='../ppto_gastos/adi_red_pac_ing.php'>
                    <input type='submit' name='Submit' value='...::: ACTUALIZAR P.A.C :::......::: ACTUALIZAR P.A.C :::...' class='Estilo4' /> 
                    </form>
                    ");
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br />

                                    <?php
                                    $document1 = "CEVA";
                                    include('../objetos/filtro.php');

                                    if ($pendiente == "") {
                                    } else {
                                    ?>
                                        <strong><br />
                                            <span class="Estilo9"><BR />
                                            </span></strong>
                                </div>
                            </div>

                            <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                                <div align="center"><strong><span class="Estilo9">CERTIFICADOS Y OBLIGACIONES CONTABLES DEL GASTO<br />
                                            ANULADAS<br />
                                        </span></strong></div>
                            </div>
                            <br>

                        <?php

                                        $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                                        if (isset($_POST["buscar"])) {
                                            $filtro = "and (id_manu_ceva LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' ) ";
                                        } else {
                                            $filtro = '';
                                        }

                                        $a = "select * from ceva where id_emp = '$id_emp' and estado != 'anulado' and estado != 'nada'";
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
                                        $gby = "";
                                        $orden = "order by fecha_ceva desc";
                                        $sq9 = "$a $b $c $filtro $f $gby $orden";




                                        $re2r = $cx->query($sq9);

                                        printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CEVA</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td class='Estilo4'>No.Cheque(s)</th>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>


</tr>


", $mesh[$me + 0], $an);

                                        while ($rw2r = $re2r->fetch_assoc()) {
                                            $vara1 = 'CEVA';

                                            $tot_cheques = "";
                                            if (trim($rw2r["num_cheque"]) != "") {
                                                $tot_cheques = $tot_cheques . trim($rw2r["num_cheque"]);
                                            }
                                            if (trim($rw2r["num_cheque2"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque2"]);
                                            }
                                            if (trim($rw2r["num_cheque3"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque3"]);
                                            }
                                            if (trim($rw2r["num_cheque4"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque4"]);
                                            }
                                            if (trim($rw2r["num_cheque5"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque5"]);
                                            }
                                            if (trim($rw2r["num_cheque6"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque6"]);
                                            }
                                            if (trim($rw2r["num_cheque7"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque7"]);
                                            }
                                            if (trim($rw2r["num_cheque8"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque8"]);
                                            }
                                            if (trim($rw2r["num_cheque9"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque9"]);
                                            }
                                            if (trim($rw2r["num_cheque10"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque10"]);
                                            }
                                            if (trim($rw2r["num_cheque11"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque11"]);
                                            }
                                            if (trim($rw2r["num_cheque12"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque12"]);
                                            }
                                            if (trim($rw2r["num_cheque13"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque13"]);
                                            }
                                            if (trim($rw2r["num_cheque14"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque14"]);
                                            }
                                            if (trim($rw2r["num_cheque15"]) != "") {
                                                $tot_cheques = $tot_cheques . "&nbsp;" . trim($rw2r["num_cheque15"]);
                                            }
                                            $tot_cheques = trim($tot_cheques);

                                            printf("

<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='center' style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>
<td align='LEFT'style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>
<td align='right'style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>
<td align='center'style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>



<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_anulado.php?id_ceva=%s\" style='color:#0033FF'><img src='../simbolos/fuentes/Eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>



<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ceva_anulado.php?id1=%s\" target='_blank' style='color:#0033FF'><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</span>
</div>
</td>




</tr>", $rw2r["id_manu_ceva"], $rw2r["fecha_ceva"], $rw2r["tercero"], number_format($rw2r["tot_deb"], 2, ',', '.'), $tot_cheques, $rw2r["id_auto_ceva"], $rw2r["id_auto_ceva"], $rw2r["id_auto_ceva"], $rw2r["id_auto_ceva"]);
                                        }

                                        printf("</table></center>");
                                    }
                        ?>

                        <br />
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