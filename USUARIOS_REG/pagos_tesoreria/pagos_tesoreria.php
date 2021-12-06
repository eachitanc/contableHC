<?php
set_time_limit(1800);
session_start();
if (!isset($_SESSION["login"])) {
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


            function selecti(vali) {
                var valor = pagos2.contro.checked;
                var filas = document.getElementById('fil2').value;

                var i = 0;
                if (valor == true) {
                    for (i = 1; i <= filas; i++) {
                        document.getElementById('campo_' + i).checked = true;
                    }
                }
                if (valor == false) {
                    for (i = 1; i <= filas; i++) {
                        document.getElementById('campo_' + i).checked = false;
                    }
                }
            }
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
            //PreLoad Wait - Script This script and more from http: //www.rainbow.arch.scriptmania.com 

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
                        $a = $r = '';
                        $resultadoxx = $connectionxx->query($sqlxx);
                        // Datos para mostrar listas
                        $ini = isset($_GET['ini']) ? $_GET['ini'] : '';
                        $fin = isset($_GET['fin']) ? $_GET['fin'] : '';
                        $indice = isset($_GET['k']) ? $_GET['k'] : '';
                        $muestra = 250;
                        if (!isset($_GET['ini'])) {
                            $ini = 0;
                            $fin = $muestra;
                        }



                        while ($rowxx = $resultadoxx->fetch_assoc()) {

                            $idxx = $rowxx["id_emp"];
                            $id_emp = $rowxx["id_emp"];
                            $ano = $rowxx["ano"];
                        }
                        list($an, $me, $di)  = explode('/', $ano);


                        $archivo = "pagos_tesoreria.php";  // Para que el formulario del filtro me procese el nombre del archivo como action

                        $sq3 = "select cargo from usuarios2 where login = '$_SESSION[login]'";
                        $re3 = $connectionxx->query($sq3);
                        $rw3 = $re3->fetch_assoc();
                        $ver_boton = '';
                        if ($rw3['cargo'] == "REVISOR") {
                            $ver_boton = "style=display:none";
                        }
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

                                    <?php include('../objetos/filtro.php');

                                    if ($pendiente == "") {
                                    } else {
                                    ?>
                                        <strong><br />
                                            <br />
                                            <span class="Estilo9">CERTIFICADOS Y OBLIGACIONES CONTABLES DEL GASTO<br />
                                                SIN PAGAR<BR />
                                            </span></strong>
                                </div>
                            </div>
                            <br />


                            <?php


                                        $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                        $b = '';
                                        if (isset($_POST['buscar'])) {
                                            $filtro = "and (id_manu_obcg LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                                        } else {
                                            $filtro = '';
                                        }
                                        $a = "select * from obcg where id_emp = '$id_emp' and pagado ='NO'";
                                        if (empty($tercero)) {
                                            $c = "";
                                        } else {
                                            $c = "and tercero =$tercero2";
                                        }
                                        if ($fecha2 == "MES") {
                                            $f = "and fecha_obcg between '$f1' and '$f2'";
                                        }
                                        if ($fecha2 == "DIA") {
                                            $f = "and fecha_obcg ='$fechafil'";
                                        }
                                        if ($fecha2 == "A�O") {
                                            $f = "and fecha_obcg between '$a1' and '$a2'";
                                        }
                                        $gby = "";
                                        $orden = "order by id asc ";
                                        $sq2p = "$a $b $c $filtro $f $gby $orden";
                                        $re2p = $cx->query($sq2p);
                                        echo "<form name='pagos' id='pagos' action='pagos_lote.php' method='post'>";
                                        printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<thead>

<tr bgcolor='#DCE9E5'>
<th><input type='checkbox' name='control' id='control' value='1'></th>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>OBCG</b></span>
</div>
</th>
<th align='center'><span class='Estilo4'><b>CDPP</b></span></th>
<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>X VALOR DE</b></span></th>
<th align='center'><span class='Estilo4'><b>EDAD</b></span></th>

<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>

</tr>
</thead>
<tbody>
");
                                        $k = 0;
                                        while ($rw2p = $re2p->fetch_assoc()) {
                                            $k++;
                                            $vara1 = 'CEVA';
                                            $vara2 = $rw2p["id_auto_cobp"];
                                            ///****
                                            $link = new mysqli($server, $dbuser, $dbpass, $database);
                                            $resulta = $link->query("select SUM(vr_digitado) AS TOTAL from cobp where id_emp = '$id_emp' and id_auto_cobp ='$vara2'");
                                            $row = $resulta->fetch_array();
                                            $total = $row[0];
                                            //cdpp consultar
                                            $sq2 = "select id_manu_cdpp from cobp where id_auto_cobp = '$vara2'";
                                            $rs2 = $link->query($sq2);
                                            $rw2 = $rs2->fetch_assoc();

                                            //*************** edad
                                            $startDate = $rw2p["fecha_obcg"];
                                            $id_cobp = $rw2p["id_auto_cobp"];
                                            $endDate = date("Y/m/d");
                                            list($year, $month, $day) = explode('/', $startDate);
                                            $startDate = mktime(0, 0, 0, $month, $day, $year);
                                            list($year, $month, $day) = explode('/', $endDate);
                                            $endDate = mktime(0, 0, 0, $month, $day, $year);
                                            $totalDays = ($endDate - $startDate) / (60 * 60 * 24);

                                            ///*****************

                                            printf("
<tr>
<td bgcolor='#DCE9E5'><input type='checkbox' name='camp_$k' id='camp_$k' value='$rw2p[id_auto_obcg]'> </td>
<td align='left' bgcolor='#DCE9E5' width='100'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center' width='100'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='left' width='240'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center' width='100'><span class='Estilo4'>%s</span></td>
<td align='center' width='80'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5' width='80'>

<a $ver_boton href='a.php?id=$rw2p[id_auto_obcg]&val=$total' >Pagar </a> 
</td>
<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscobp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</a>
</td>




</tr>", $rw2p["id_manu_obcg"], $rw2["id_manu_cdpp"], $rw2p["fecha_obcg"], $rw2p["tercero"], $total, number_format($totalDays, 0, ',', '.') . ' Dias', $rw2p["id_auto_cobp"]);
                                        }
                                        echo "<input name='fil' value='$k' type='hidden'>";
                                        echo "<div align='left' style='padding-left:0px;'><input  name='btn' value='Procesar selecci&oacute;n' type='submit' style='background:#72A0CF; color:#FFFFFF; border:none'></div>";

                                        printf("</tbody></table></center>");
                                        echo "</form>";
                            ?>

                            <br />

                            <?php

                                        $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

                                        if (isset($_POST['buscar'])) {
                                            $filtro = "and (id_manu_cobp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
                                        } else {
                                            $filtro = '';
                                        }

                                        $a = "select distinct(id_auto_cobp), id_manu_cobp,  id_manu_crpp, id_manu_cdpp, fecha_cobp, tercero, contab, pagado from cobp where id_emp = '$id_emp' and contab ='NO' and pagado ='NO' and tesoreria = 'SI'";
                                        if (empty($tercero)) {
                                            $c = "";
                                        } else {
                                            $c = "and tercero =$tercero2";
                                        }
                                        if ($fecha2 == "MES") {
                                            $f = "and fecha_cobp between '$f1' and '$f2'";
                                        }
                                        if ($fecha2 == "DIA") {
                                            $f = "and fecha_cobp ='$fechafil'";
                                        }
                                        if ($fecha2 == "A�O") {
                                            $f = "and fecha_cobp between '$a1' and '$a2'";
                                        }
                                        $gby = "";
                                        $orden = "order by id asc";
                                        $sq8 = "$a $filtro $c  $f  $gby $orden";


                                        $re2q = $cx->query($sq8);
                                        echo "<form name='pagos2' id='pagos2' action='pagos_lote_tes.php' method='post'>";
                                        printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>
<thead>
<tr bgcolor='#DCE9E5'>
<th><input type='checkbox' name='contro' id='contro' value='1'  onclick='selecti(id);'></th>
<th align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBP</b></span>
</div>
</th>
<th align='center'><span class='Estilo4'><b>CDPP</b></span></th>
<th align='center'><span class='Estilo4'><b>FECHA</b></span></th>
<th align='center'><span class='Estilo4'><b>TERCERO</b></span></th>
<th align='center'><span class='Estilo4'><b>X VALOR DE</b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>
<th align='center'><span class='Estilo4'><b></b></span></th>

</tr>
</thead>
<tbody>
");
                                        $aa = 'CEVA';
                                        $r;
                                        while ($rw2q = $re2q->fetch_assoc()) {
                                            $r++;
                                            $a1a1 = $rw2q["id_auto_cobp"];
                                            $link = new mysqli($server, $dbuser, $dbpass, $database);
                                            $resulta = $link->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_cobp = '$a1a1' AND id_emp='$id_emp'");
                                            $row = $resulta->fetch_array();
                                            $total = $row[0];
                                            $nuevo_totala1 = $total;

                                            printf("

<tr>
<td bgcolor='#DCE9E5'><input type='checkbox' name='campo_$r' id='campo_$r' value='$rw2q[id_auto_cobp]'> </td>
<td align='left' bgcolor='#DCE9E5' width='100'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='center' width='100'><span class='Estilo4'>%s</span></td>
<td align='center' width='100'><span class='Estilo4'>%s</span></td>
<td align='center' width='300'><span class='Estilo4'>%s</span></td>
<td align='center' width='100'><span class='Estilo4'>%s</span></td>


<td align='center' bgcolor='#DCE9E5' width='100'>

<a $ver_boton href='b.php?id=$a1a1&val=$nuevo_totala1' >pagar </a> 
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscobp2.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</a>
</td>


</tr>", $rw2q["id_manu_cobp"], $rw2q["id_manu_cdpp"], $rw2q["fecha_cobp"], $rw2q["tercero"], $nuevo_totala1, $a1a1);
                                        }
                                        echo "<input name='fil2' id='fil2' value='$r' type='hidden'>";
                                        echo "<div align='left' style='padding-left:0px;'><input  name='btn' value='Procesar selecci&oacute;n' type='submit' style='background:#72A0CF; color:#FFFFFF; border:none'></div>";

                                        printf("</tbody></table></center>");
                                        echo "</form>";
                                    }

                                    if (!isset($registrado)) {
                                    } else {

                            ?>
                            <br />
                            <div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
                                <div align="center"><strong><span class="Estilo9">CERTIFICADOS Y OBLIGACIONES CONTABLES DEL GASTO<br />
                                            PAGADAS<br />
                                        </span></strong></div>
                            </div>
                            <br>

                        <?php
                                        $nada = "anulado";
                                        $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                        $limitar = "limit $ini,$fin";
                                        if (isset($_POST['buscar'])) {
                                            $filtro = "and (id_manu_ceva LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' ) ";
                                            $limitar = '';
                                        } else {
                                            $filtro = '';
                                        }

                                        $a = "select * from ceva where id_emp = '$id_emp' and estado = 'nada' and id_auto_cobp !='AUTO'";
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
                                        $orden = "order by fecha_ceva desc, id desc";
                                        $sq9 = "$a $c $filtro $f $gby $orden";
                                        $resf = $cx->query($sq9);
                                        $filas = $resf->num_rows;
                                        $listas = ceil($filas / $muestra);
                                        $sq2 = "$a $c $filtro $f $gby $orden $limitar";


                                        $re2r = $cx->query($sq2);

                                        printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CEVA</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>COBP</b></span></td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td class='Estilo4'>No.Cheque(s)</th>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
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
<td align='center' style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>
<td align='LEFT'style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>
<td align='right'style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>
<td align='center'style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'>%s</span></td>



<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"borra_ceva.php?id_ceva=%s&fecha_c=%s\" style='color:#0033FF'><img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"modi_ceva2.php?id1=%s\" target='_parent' style='color:#0033FF'><img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"imp_ceva.php?id1=%s\" target='_blank' style='color:#0033FF'><img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"reversar_ceva.php?id1=%s\" target='_parent' style='color:#0033FF'><img src='../simbolos/fuentes/reversar.png' width='20' height='20' border='0' title='Anulacion de pagos'></a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"../contratacion_doc/generar_archivo_rp.php?id=%s&clase=Rp&id_ceva=$rw2r[id_auto_ceva]\" target='_parent' style='color:#0033FF'><img src='../simbolos/reporte2.jpg' width='20' height='20' border='0' title='Resoluci&oacute;n de pago'></a>
</span>
</div>
</td>

</tr>", $rw2r["id_manu_ceva"], $rw2r["id_manu_crpp"], $rw2r["fecha_ceva"], $rw2r["tercero"], number_format($rw2r["tot_deb"], 2, ',', '.'), $tot_cheques, $rw2r["id_auto_ceva"], $rw2r["fecha_ceva"], $rw2r["id_auto_ceva"], $rw2r["id_auto_ceva"], $rw2r["id_auto_ceva"], $rw2r["id_auto_crpp"]);
                                        }

                                        printf("</table></center>");
                                        echo "<br><&nbsp;";
                                        for ($i = 0; $i < $listas; $i++) {
                                            $inicio = ($i * $muestra) + 1;
                                            $k = $i + 1;
                                            if ($k == $indice) {
                                                echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CRPP&k=$k&nn=CRPP'><b>$k</b></a>&nbsp;";
                                            } else {
                                                echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CRPP&k=$k&nn=CRPP'>$k</a>&nbsp;";
                                            }
                                        }
                                        echo ">&nbsp;";
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