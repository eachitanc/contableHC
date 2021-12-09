<?php
session_start();
echo "<div style='color:gray;font-size: 12px;'>LOGIN : " . $_SESSION["login"] . "</div>";
unset($_SESSION["fecha"]);
unset($_SESSION["pendiente"]);
unset($_SESSION["fecha2"]);
unset($_SESSION["registrado"]);
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
} else {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>CONTAFACIL</title>
        <style type="text/css">
            .Estilo1 {
                font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-weight: bold;
            }

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

            .Estilo9 {
                color: #FF0000;
                font-weight: bold;
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
                font-weight: bold
            }
        </style>
        <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar.css?random=20051112" media="screen">
        </LINK>

        <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar.js?random=20060118"></script>
        <style type="text/css">
            .Estilo15 {
                color: #000000
            }

            .Estilo17 {
                font-weight: bold
            }

            .Estilo18 {
                color: #FF0000;
                font-weight: bold;
            }

            .Estilo18 {
                font-weight: bold
            }
        </style>
        <script>
            var par = false;

            function parpadeo() {
                document.getElementById('txt').style.visibility = (par) ? 'visible' : 'hidden';
                par = !par;
            }
        </script>


        <SCRIPT language="javascript">
            function MostrarOcultar(objetoVisualizar) {
                if (document.all[objetoVisualizar].style.display == 'none') {
                    document.all[objetoVisualizar].style.display = 'block';
                } else {
                    document.all[objetoVisualizar].style.display = 'none';
                }
            }
        </SCRIPT>



        <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="js/popup.js"></script>
        <link href="css/popup.css" rel="stylesheet" type="text/css">

        <script>
            function mostrar() {
                $("#pop").fadeIn('slow');
            } //checkHover




            function mostrar2() {
                var ban = 0;
                if (ban == 0)


                    document.all['pop'].style.visibility = 'visible';

            }

            function mostrarFecha() {


                var fechav = document.getElementById('fecha_v').value;
                ahora = new Date();
                anoActual = ahora.getYear();
                mesActual = ahora.getMonth() + 1;

                if (mesActual < 10)
                    mesActual = '0' + mesActual;
                diaActual = ahora.getDate();
                if (diaActual < 10)
                    diaActual = '0' + diaActual;
                var fechav;
                Fecha = anoActual + "/" + mesActual + "/" + diaActual;

                //if(Fecha>fechav)
                //wmostrar2();
                //else alert ("contrario");




                //obtener fecha de vigencia



                //Retorno del resultado

            }



            function dos() {
                mostrarFecha();

                //fecha_vigencia();
                setInterval('parpadeo()', 1000);


                //alert(document.getElementById('fecha_v').value);
                var fecha = document.getElementById('inicio').value;
                var pos_url = 'consultas/ecuacion_presupuestal.php';
                var req = new XMLHttpRequest();
                if (req) {
                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            var valor = req.responseText;
                            if (valor != 0) {
                                document.getElementById('ecuation').style.color = 'red';
                            }
                        }
                    }
                    req.open('GET', pos_url + '?fecha=' + fecha, false);
                    req.send(null);
                }
            }
        </script>


    </head>

    <body onload="dos();">
        <?
        include("sesiones/mata_sesiones.php");
        ?>

        <input name="fechavig" type="hidden" id="fechavig" value="" />
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
                    <table width="750" border="1" align="center" class="bordepunteado1">
                        <tr>
                            <td colspan="2" bgcolor="#DCE9E5">
                                <div id="div2" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
                                    <div align="center" class="Estilo18">
                                        <div align="center" class="Estilo4">PRIMEROS PASOS </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">


                                    <div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:20px;">
                                        <center class="Estilo4">
                                            <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:300px'>
                                                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'> <strong>VIGENCIA FISCAL ACTUAL</strong><br />
                                                    <br />
                                                    <?php
                                                    // cx bd
                                                    include('config.php');
                                                    global $server, $database, $dbpass, $dbuser, $charset;
                                                    // Conexion con la base de datos
                                                    $cx = new mysqli($server, $dbuser, $dbpass, $database);
                                                    /*
if($cx->connect_errno) 
	{
		echo "error";
	} else {
    echo "si se concto";
  }*/
                                                    $sql = "select * from vf";
                                                    $consulta = $cx->query($sql);
                                                    while ($row = $consulta->fetch_assoc()) {
                                                        $a = $row["fecha_ini"];
                                                        $b = $row["fecha_fin"];
                                                    }
                                                    $anno = explode("/", $a);
                                                    $ano2 = $anno[0];
                                                    printf('De: %s - Hasta: %s/12/31', $a, $ano2);
                                                    ?>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                    <div align="center"><span class="Estilo1"><br />
                                        </span>
                                        <span class="Estilo4">
                                            <font color="#990000">
                                                <span id="txt">
                                                    <b><U>ANTES DE COMENZAR</U></b>
                                                </span>
                                            </font>
                                            <br />
                                            <br />
                                            <strong>DEFINIR FECHA DE TRABAJO PARA ESTA SESION</strong><br />
                                            (VERIFIQUE QUE LA FECHA DE SU COMPUTADORA ESTE CORRECTAMENTE CONFIGURADA)
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td width="400">
                                <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                    <form name="fecha" method="post" action="cambio_fecha.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
                                        <input name="fecha_v" id="fecha_v" type="hidden" value="<?php printf("%s", $b); ?>" />

                                        <table width="400" border="1" align="center" class="bordepunteado1">
                                            <tr>
                                                <td colspan="2" class="Estilo4" bgcolor='#DCE9E5'>
                                                    <div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
                                                        <div align="center" class="Estilo9">
                                                            <div align="center" class="Estilo15">1. Seleccione Fecha de Trabajo para esta Sesion : </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="Estilo4">
                                                    <div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">


                                                        <div align="center">
                                                            <input name="inicio" type="text" class="Estilo4" id="inicio" value="<?php $bb = date("Y/m/d");
                                                                                                                                printf($bb); ?>" size="12" />
                                                            <span class="Estilo6 Estilo8">:::</span>
                                                            <input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].inicio,'yyyy/mm/dd',this)" value="Ver Calendario" />
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td width="150" class="Estilo4" bgcolor='#DCE9E5'>
                                                    <div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
                                                        <div align="right" class="Estilo9">
                                                            <div align="center" class="Estilo15">2. Seleccione Empresa : </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="240" class="Estilo4">
                                                    <div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">

                                                        <div align="center">
                                                            <select name="id_emp" class="Estilo4">
                                                                <?php
                                                                $sq2 = "SELECT * FROM empresa ORDER BY cod_emp";
                                                                $res = $cx->query($sq2);
                                                                $nr = $res->num_rows;
                                                                $r = $res->fetch_assoc();
                                                                for ($i = 0; $i < $nr; $i++) {
                                                                    //$rw2 = mysql_fetch_array($rs);
                                                                    echo "<OPTION VALUE=\"" . $r["cod_emp"] . "\">" . $r["raz_soc"] . "</OPTION>";
                                                                }
                                                                ?>
                                                            </select> <input type="submit" name="Submit" value="Procesar" class="Estilo4" />
                                                        </div>
                                                    </div>
                                                </td>



                                            </tr>


                                            <tr>
                                                <td colspan="2" class="Estilo4">
                                                    <div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
                                                        <div align="center">
                                                            <br />
                                                            <a href="cierre/cierre.php" target="_parent">CERRAR PERIODOS</a>


                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" bgcolor="#F5F5F5" class="Estilo4">

                                                    <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                        <div align="center">
                                                            <?php
                                                            //-------
                                                            $sq3 = "select * from fecha where user ='$_SESSION[login]'";
                                                            $re3 = $cx->query($sq3);

                                                            while ($row = $re3->fetch_assoc()) {
                                                                $fecha_s = $row["ano"];
                                                                echo "<span class='Estilo4'><b>Fecha de Trabajo ACTUAL =" . $row["ano"] . " </b></span><BR> ";
                                                                $id = $row["id_emp"];
                                                            }

                                                            //--------	
                                                            ?>

                                                            <?php
                                                            //-------

                                                            $sqlx = "select raz_soc from empresa where cod_emp = '$row[id_emp]'";
                                                            $re4 = $cx->query($sqlx);

                                                            while ($rowx = $re4->fetch_assoc()) {
                                                                printf("<span class='Estilo4'><b>Empresa ACTUAL =  %s </b></span>", $rowx["raz_soc"]);
                                                            }
                                                            //--------	
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                        <div align="center" class="Estilo4"> <strong> <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar('menu');"> ...::: MENU PRINCIPAL CONTAFACIL :::...</span></strong></div>
                    </div>

                    <!--ventana de alerta-->

                    <div id="pop" style="visibility:hidden; ">
                        <div id="cerrar">X</div>


                        <img src="simbolos/alerta.JPG" width="720" height="424" alt="alerta" />


                        <!-- <img src="images/publicidad.jpg" width="400" height="400" alt="alerta" />-->
                        <!-- <img src="imgages/publicidad.jpg" height="507" width="600" border="0">  -->
                    </div>
                    <!-- cierra ventana de alerta-->

                    <!--MARCA DE EMERGENTE-->
                    <table width="750" border="1" align="center" class="bordepunteado1" id="menu" style="display:block">

                        <tr>
                            <td valign="top" bgcolor="#DCE9E5">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    <div align="center"><b class="Estilo4">1. CONFIG DEL SISTEMA</b><br />
                                    </div>
                                </div>
                            </td>
                            <td valign="top" bgcolor="#DCE9E5" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    <div align="center"><b>2. MODULO PRESUPUESTO</b><br />
                                    </div>
                                </div>
                            </td>
                            <td valign="top" bgcolor="#DCE9E5" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    <div align="center"> <span class="Estilo4"><b>3. MODULO TESORERIA</b><br />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="250" valign="top">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">

                                    <span class="Estilo4">1.1 <a href="crear_empresa.php" target="_parent">Crear - Modificar Empresa </a>
                                        <br />

                                        1.2 <a href="editadmin.php" target="_parent">Cambiar Contrasena</a>

                                        <br />
                                        1.3 <a href="bd/act_bd.php" target="_parent">Actualizar Base de Datos</a>

                                        <br />
                                        1.4 <a href="consulta_errores/a.php" target="_parent">Validar Registros Contables</a>
                                        <br />
                                        1.5 <a href="terceros/terceros.php" target="_parent">Terceros</a><br />



                                    </span>
                                </div>

                                </div>
                            </td>
                            <td width="250" valign="top" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">


                                    2.0. <a href="ecuacion_pptal/index.php" target="_parent" id="ecuation">Ecuacion Presupuestal</a></br>
                                    2.1. <a href="carga_ppto_ing.php">Presupuesto de Ingresos </a> <br />
                                    2.2. <a href="ppto_gastos/carga_ppto_gas.php">Presupuesto de Gastos </a> <br />
                                    2.3. <a href="cxp/carga_ppto_gas.php">C x P Vigencia Anterior</a> <br />



                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    2.4. <a href="#" onmouseover="Tip('<br>2.4.1. <a href=\'mvto_ppto_ing/mvto.php\'>Movimientos Ppto Ingresos<\/a><br><br>2.4.2. <a href=\'mvto_ppto_gas/mvto.php\'>Movimientos Ppto Gastos<\/a><br><br>2.4.3. <a href=\'#\'>Movimientos Cuentas x Pagar<\/a><br><br>', WIDTH, 270, TITLE, '<center>Movimientos - Ejecucion</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Movimientos - Ejecucion </a><br />





                                    <BR />
                                </div>
                            </td>
                            <td width="250" valign="top" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">



                                    3.1. <a href="recaudos_tesoreria/recaudos_tesoreria.php" target="_parent">Recaudos</a><br />
                                    3.2. <a href="recaudos_masivos/upload.php" target="_parent">Recaudos masivos</a><br />

                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    3.3. <a href="#" onmouseover="Tip('<br>3.2.1. <a href=\'pagos_tesoreria/pagos_tesoreria.php\'>Pagos Vigencia Actual<\/a><br><br>3.2.2. <a href=\'pagos_tesoreria/pagos_tesoreria_ceac.php\'>Pagos Acumulados<\/a><br><br>3.2.3. <a href=\'pagos_tesoreria/pagos_tesoreria_cxp.php\'>Pagos Vigencia Anterior<\/a><br><br>3.2.4. <a href=\'pagos_tesoreria/pagos_anulados.php\'>Pagos Anulados<\/a><br><br>', WIDTH, 200, TITLE, '<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAGOS</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Pagos Presupuestales</a><br />


                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    3.4. <a href="#" onmouseover="Tip('<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\'actualiza_mvtos/a.php\' target=\'_parent\'>ACTUALIZAR MVTOS CONTABLES<\/a><br><br>3.3.1. <a href=\'carga_conciliaciones/conciliaciones_vig_ant.php\' target=\'_parent\'>Cargar Mvtos Bancarios Vig Ant<\/a><br><br>4.5.3. &lt;a href=\'conciliaciones/conciliacionesmes.php\' target=\'_parent\'&gt;Consultar conciliaciones por mes&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 300, TITLE, '<center>&nbsp;&nbsp;Conciliaciones Bancarias</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Conciliaciones Bancarias</a><br />

                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    3.5. <a href="#" onmouseover="Tip('<br>3.4.1. <a href=\'consulta_ppto_ing.php\'>P.A.C Ingresos<\/a><br><br>3.4.2. <a href=\'ppto_gastos/consulta_ppto_gas.php\'>P.A.C Ppto Gastos<\/a><br><br>3.4.3. <a href=\'cxp/consulta_ppto_gas.php\'>P.A.C Cuentas x Pagar<\/a><br><br>3.4.4. <a href=\'pagos_tesoreria/pac_aprob_ing.php\'>P.A.C de ingresos aprobado<\/a><br><br>3.4.5. <a href=\'pagos_tesoreria/pac_aprob_gas.php\'>P.A.C de gastos aprobado<\/a><br><br>3.4.6. <a href=\'pagos_tesoreria/ejec_pptal_gastos2.php\'>Ejecucion P.A.C Gastos<\/a><br><br>3.4.7. <a href=\'pagos_tesoreria/ejec_pptal_ing.php\'>Ejecucion P.A.C Ingresos<\/a><br><br>', WIDTH, 200, TITLE, '<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P.A.C</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">P.A.C </a><br />




                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    3.7. <a href="#" onmouseover="Tip('<br>3.5.1. <a href=\'mvto_ppto_gas/cxp_lista2.php\'>Reservas y C x P<\/a><br><br>3.5.2. <a href=\'informes_tesoreria/relacion_pagos_det.php\'>Relacion de Pagos - Detallada<\/a><br><br>3.5.3. <a href=\'informes_tesoreria/retefuente.php\'>Relacion de Pagos - Retefuente<\/a><br><br>3.5.4. <a href=\'informes_terceros/terceros.php\'>Informe de ejecucion por tercero<\/a><br><br>3.5.5. <a href=\'informes_tesoreria/relacion_ingresos_corte.php\'>Relacion de Ingresos<\/a><br><br>3.5.6. <a href=\'informes_tesoreria/relacion_gastos_corte.php\'>Relacion de Pagos<\/a><br><br>3.5.7. <a href=\'informes_tesoreria/cuentas_x_pagar_corte.php\'>Relacion de C x P<\/a><br><br>3.5.8. <a href=\'informes_terceros/certificaciones/index.php\'>Certificaciones<\/a><br><br>', WIDTH, 250, TITLE, '<center>Informes Tesoreria</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Informes</a><br />


                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    3.8. <a href="#" onmouseover="Tip('<br>3.6.1. <a href=\'pagos_tesoreria/desctos.php\'>Descuentos en Pagos Tesoreria<\/a><br><br>', WIDTH, 250, TITLE, '<center>Configuraciones</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Configuraciones</a><br />

                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    3.9. <a href="#" onmouseover="Tip('<br>3.7.1. <a href=\'pagos_tesoreria/cheques.php\'>Buscar cheques<\/a><br><br>3.7.2. <a href=\'informes_tesoreria/relacion_cheques_corte.php\'>Libro radicador cheques<\/a><br><br>3.7.3. <a href=\'informes_tesoreria/estampillas.php\'>Descuento de estampillas<\/a><br><br>3.7.4. <a href=\'informes_tesoreria/retefuente.php\'>Retenci&oacute;n en la fuente<\/a><br><br>3.7.5. <a href=\'informes_tesoreria/certifi.php\'>Certificado de retenciones<\/a><br><br>', WIDTH, 250, TITLE, '<center>Herramientas</center>', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Herramientas</a><br />


                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" bgcolor="#DCE9E5" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    <div align="center"><b>4. MODULO CONTABILIDAD</b><br />
                                    </div>
                                </div>
                            </td>
                            <td valign="top" bgcolor="#DCE9E5" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    <div align="center"><b class="Estilo4">5. MODULO INFORMES PARA TERCEROS</b><br />
                                    </div>
                                </div>
                            </td>
                            <td valign="top" bgcolor="#DCE9E5">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    <div align="center"><b class="Estilo4">6. MODULOS DE GESTION</b><br />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="Estilo4">
                                <div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;"> 4.1. <a href="mvto_contable/menu_cont.php" target="_parent">Movimientos</a><br />
                                    4.2. <a href="facturacion/upload.php" target="_parent">Facturaci&oacute;n </a><br />
                                    4.3. <a href="pgcp/index_pgcp.php" target="_parent">Plan de Cuentas P.G.C.P </a><br />
                                    4.4. <a href="dctos_fuente/dctos_fuente.php" target="_parent">Documentos Fuente</a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    4.5. <a href="#" onmouseover="Tip('&lt;br&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href=\'actualiza_mvtos/a.php\' target=\'_parent\'&gt;ACTUALIZAR MVTOS CONTABLES&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.1. &lt;a href=\'informes_contabilidad/libro_auxiliar.php\' target=\'_parent\'&gt;Libros Auxiliares&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.2. &lt;a href=\'informes_contabilidad/libro_auxiliar_cta_0.php\' target=\'_parent\'&gt;Libros Auxiliares Cuentas 0&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.3. &lt;a href=\'informes_contabilidad/libro_auxiliarg.php\' target=\'_parent\'&gt;Libros Auxiliares x Fecha de Corte&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.4. &lt;a href=\'balance_prueba/balance_prueba.php\'&gt;Balance de Prueba&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.5. &lt;a href=\'informes_contabilidad/mayor_balance_corte_f.php\'&gt;Libro Mayor y Balance&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.6. &lt;a href=\'balance_prueba/balance_prueba_cta_0.php\'&gt;Balance de Prueba Ctas 0&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.4.7. &lt;a href=\'informes_contabilidad/mayor_balance0.php\'&gt;Libros Oficiales&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 300, TITLE, '&lt;center&gt;&nbsp;&nbsp;Libros Contables&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Libros Contables</a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    4.6. <a href="#" onmouseover="Tip('&lt;br&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href=\'actualiza_mvtos/a.php\' target=\'_parent\'&gt;ACTUALIZAR MVTOS CONTABLES&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.5.1. &lt;a href=\'carga_conciliaciones/conciliaciones_vig_ant.php\' target=\'_parent\'&gt;Cargar Mvtos Bancarios Vig Ant&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.5.3. &lt;a href=\'conciliaciones/conciliacionesmes.php\' target=\'_parent\'&gt;Consultar conciliaciones por mes&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.5.4. &lt;a href=\'carga_conciliaciones/pendientes.php\' target=\'_parent\'&gt;Exporta plantilla nueva vigencia&lt;\/a&gt;&lt;br&gt;', WIDTH, 300, TITLE, '&lt;center&gt;&nbsp;&nbsp;Conciliaciones Bancarias&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Conciliaciones Bancarias</a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    4.7. <a href="#" onmouseover="Tip('&lt;br&gt;4.6.1. &lt;a href=\'mvto_contable/con_x_tip.php\'&gt;Consulta x Tipo de dcto&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.6.2. &lt;a href=\'informes_contabilidad/balance_general_corte.php\'&gt;Balance general&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.6.3. &lt;a href=\'informes_contabilidad/estado_resultados_corte.php\'&gt;Estado de resultados&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 250, TITLE, '&lt;center&gt;Informes&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Informes</a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    4.8. <a href="informes_contabilidad/upload.php" target="_parent">Carga de Saldos Iniciales</a><br />

                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    4.9. <a href="#" onmouseover="Tip('&lt;br&gt;4.10.1. &lt;a href=\'cca/ingresos.php\'&gt;Conf. Cont. Aut. Ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.10.2. &lt;a href=\'cca/gastos.php\'&gt;Conf. Cont. Aut. Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;4.10.3. &lt;a href=\'cca/cxp.php\'&gt;Conf. Cont. Aut. CxP&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 250, TITLE, '&lt;center&gt;&nbsp;&nbsp;Conf. Contabilidad Automatica&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Contabilidad automatica</a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    4.10. <a href="informes_contabilidad/esfa.php" target="_parent">Generar ESFA</a><br />

                                </div>
                            </td>
                            <td valign="top" class="Estilo4">
                                <div class="Estilo4" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
                                    5.1. <a href="#" onmouseover="Tip('&lt;br&gt;5.1.1. &lt;a href=\'informes_contaduria_gral/a.php\'&gt;Actualizar Mvtos y Saldos Contables&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.1.2. &lt;a href=\'informes_contaduria_gral/cuenta_puntos.php\'&gt;Saldos y Mvtos CGN2005.001&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.1.3. &lt;a href=\'informes_chip/fut_ingresos.php\'&gt;Formato Unico Territorial - F.U.T&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.1.4. &lt;a href=\'informes_chip/cgr_ingresos.php\'&gt;C.G.R de Ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.1.5. &lt;a href=\'informes_chip/cgr_gastos.php\'&gt;C.G.R de Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.1.6. &lt;a href=\'informes_chip/upload.php\'&gt;Acumular C.G.R. Programacion de Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.1.7. &lt;a href=\'informes_chip/upload_ejc_cgr.php\'&gt;Acumular C.G.R. Ejecucion de Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 300, TITLE, '&lt;center&gt;Contaduria Gral&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Contaduria Gral</a><br />
                                    5.2. <a href="#" onmouseover="Tip('&lt;br&gt;5.2.1. &lt;a href=\'informes_chip/chip_legal_gas_corte.php\'&gt;Libro Legalizacion Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 300, TITLE, '&lt;center&gt;Contaduria Gral&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Contraloria General</a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    5.3. <a href="#" onmouseover="Tip('&lt;br&gt;5.3.1. &lt;a href=\'informes_terceros/f28_cdn.php\'&gt;F28_CDN - Control Proceso Contractual&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.3.2. &lt;a href=\'informes_terceros/f_cdn11_cxp.php\'&gt;F11_CDN - Relacion de Pagos CxP&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.3.3. &lt;a href=\'informes_sia/index.php\'&gt; SIA - Sistema Integral de Auditorias&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.3.4. &lt;a href=\'informes_sia/busca_contrato.php\'&gt; SIA - Observa&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 350, TITLE, '&lt;center&gt;Contraloria Dptal&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Contraloria Dptal </a><br />
                                    5.4. Superintedencia Salud.<br />
                                    5.5. Superintedencia SS.PP.<br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    5.6. <a href="#" onmouseover="Tip('&lt;br&gt;5.6.1. &lt;a href=\'mod_informes/ejec_pptal_ing.php\'&gt;Ejecucion Presupuestal de Ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.6.2. &lt;a href=\'mod_informes/ejec_pptal_gastos.php\'&gt;Ejecucion Presupuestal de Gastos con Disponibilidad&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.6.3. &lt;a href=\'mod_informes/ejec_pptal_gastos2.php\'&gt;Ejecucion Presupuestal de Gastos con Registro&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.6.4. &lt;a href=\'mod_informes/ejec_pptal_cxp.php\'&gt;Ejecucion Presupuestal de CxP&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 350, TITLE, '&lt;center&gt;Ejecuciones Presupuestales&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Ejecuciones Presupuestales </a><br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    5.7. <a href="#" onmouseover="Tip('&lt;br&gt;5.7.1. &lt;a href=\'2193/2193_hom_ing.php\'&gt;Informe 2193 - Homologacion Ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.7.2. &lt;a href=\'2193_gas/2193_hom_ing.php\'&gt;Informe 2193 - Homologacion Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.7.3. &lt;a href=\'2193/a.php\'&gt;Generar Informe 2193 - Ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.7.4. &lt;a href=\'2193_gas/a.php\'&gt;Generar Informe 2193 - Gastos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.7.5. &lt;a href=\'2193_cxc/inf_2193.php\'&gt;Generar Informe 2193 - Cuentas x Cobrar&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.7.6. &lt;a href=\'informes_tesoreria/relacion_mant_corte.php\'&gt;Mantenimiento hospitalario&lt;\/a&gt;&lt;br&gt;&lt;br&gt', WIDTH, 350, TITLE, '&lt;center&gt;Min. Proteccion Social&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Min. Proteccion Social </a> <br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    5.8. <a href="#" onmouseover="Tip('&lt;br&gt;5.8.1. &lt;a href=\'informes_minhacienda/ejec_pptal_ing.php\'&gt;Informe Marco fiscal - ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.8.2. &lt;a href=\'informes_minhacienda/ejec_pptal_gastos2.php\'&gt;Informe Marco fiscal - Gastos&lt;\/a&gt;&lt;br&gt;', WIDTH, 350, TITLE, '&lt;center&gt;Min. Proteccion Social&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Min. Hacienda </a> <br />
                                    <script type="text/javascript" src="wz_tooltip/wz_tooltip.js"></script>
                                    5.9. <a href="#" onmouseover="Tip('&lt;br&gt;5.9.1. &lt;a href=\'informes_dian/index.php\'&gt;Informacion Exogena&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.9.2. &lt;a href=\'informes_dian/upload.php\'&gt;Acumular Formato 1001&lt;\/a&gt;&lt;br&gt;&lt;br&gt;5.9.3. &lt;a href=\'informes_tesoreria/certifi.php\'&gt;Certificado de ingresos&lt;\/a&gt;&lt;br&gt;&lt;br&gt;', WIDTH, 350, TITLE, '&lt;center&gt;Informes Dian&lt;/center&gt;', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, true, CLICKCLOSE, true)" onmouseout="UnTip()">Dian </a>
                                </div>
                            </td>

                            <td valign="top">
                                <div class="Estilo4" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;"> 6.1. <a href="nomina/menu_nomina.php" target="_parent">Talento Humano</a><br />
                                    6.2 Inventarios<br />
                                    6.3 Centros de Costos<br />
                                    6.4 Facturacion Servicios Publicos <br /> <?php echo "6.5 <a href=\"contratacion/index.php?fec=fecha_s\" target=\"_parent\">Contrataci&oacute;n</a>"; ?><br /></div>
                                <br />
                                <center>
                                    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                                            <div align="center">
                                                <a href='logout.php' target='_parent'>SALIR DEL SISTEMA </a>
                                            </div>
                                        </div>
                                    </div>
                                </center>


                            </td>
                        </tr>


                        <tr>
                            <td colspan="3">
                                <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                    <div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
                                        <span class="Estilo4"> <strong>
                                                <?php
                                                $sqlxx = "select * from fecha";
                                                $re5 = $cx->query($sqlxx);

                                                while ($rowxx = $re5->fetch_assoc()) {
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
                    </table>

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