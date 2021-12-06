<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
} else {
    // verifico permisos del usuario
    include('../config.php');
    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

    $sql = "SELECT teso,conta FROM usuarios2 where login = '$_SESSION[login]'";
    $res = $cx->query($sql);
    $rw = $res->fetch_assoc();
    if ($rw['teso'] == 'SI' or $rw['conta'] == 'SI') {

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
            <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
            </LINK>

            <SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
            <style type="text/css">
                .Estilo15 {
                    color: #000000
                }

                .Estilo17 {
                    font-weight: bold
                }

                .Estilo18 {
                    font-size: 11px;
                    font-family: Verdana, Arial, Helvetica, sans-serif;
                }

                .Estilo5 {
                    color: #990000;
                    font-weight: bold;
                }
            </style>
        </head>


        </head>

        <body>
            <table width="800" border="0" align="center">
                <tr>

                    <td width="798" colspan="3">
                        <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                            <div align="center">
                                <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
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
                                        <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <br />
            <div align="center">
                <?php
                //********************
                //********************
                include('../config.php');
                $base = $database;
                $conexion = new mysqli($server, $dbuser, $dbpass, $database);

                ///**** creo la tabla aux_conciliaciones

                $tabla7 = "aux_conciliaciones_vig_ant";
                $anadir7 = "CREATE TABLE ";
                $anadir7 .= $tabla7;
                $anadir7 .= "
		(
  `fecha` varchar(200) NOT NULL default '',
  `comprobante` varchar(200) NOT NULL default '',
  `cuenta` varchar(200) NOT NULL default '',
  `nombre` varchar(200) NOT NULL default '',
  `dcto_cheque` varchar(200) NOT NULL default '',
  `tercero` varchar(200) NOT NULL default '',
  `debito` decimal(20,2) NOT NULL default '0.00',
  `credito` decimal(20,2) NOT NULL default '0.00',
  `estado` varchar(200) NOT NULL default '',
  `flag1` varchar(200) NOT NULL default '',
  `flag2` varchar(200) NOT NULL default '',
  `fecha_marca` varchar(200) NOT NULL default ''
   
  
)TYPE=MyISAM ";

                if ($conexion->query($anadir7)) {
                    //echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito<br></center>";
                } else {
                    //echo "<center class='Estilo4'> <br> <center>La tabla $tabla7 se ha creado con exito - OK!<br></center>";
                }

                //********************
                //********************
                ?>
                <br />
                <table width="800" border="1" align="center" class="bordepunteado1">
                    <tr>
                        <td bgcolor="#DCE9E5">
                            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                <div align="center" class="Estilo2 Estilo4"> <b>Pasos a seguir para realizar la carga de Movimientos Bancarios de la Vigencia Anterior </b></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 1. Descargue la plantilla de MS Excel &copy; presionando el boton izquierdo de su raton ...::: <a href="plantilla/CBVA.xls"><strong>AQUI</strong></a> :::... </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 2. Diligencie la plantilla siguiendo las instrucciones que se encuentran en los comentarios de la hoja activa </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 3. Suba el archivo usando el siguiente cuadro: </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form action="subesico.php" method="post" enctype="multipart/form-data">
                                <div align="center">
                                    <!-- <b>Campo de tipo texto:</b>
    <br>-->
                                    <!--<input type="text" name="cadenatexto" size="20" maxlength="100">-->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                    <br />
                                    <span class="Estilo18"><strong>Subir Archivo CBVA (Conciliaciones Bancarias Vigencia Anterior)</strong></span><br />
                                    <br />
                                    <span class="Estilo18"><em>Nombre del archivo CBVA.csv<br />
                                            (CSV delimitado por comas) </em></span><br />
                                    <br />
                                    <input name="userfile" type="file" class="Estilo18" />
                                    <br />
                                    <br />
                                    <input name="submit" type="submit" class="Estilo18" value="Subir Archivo" />
                                </div>
                            </form>
                            <br />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> 4. Verifique los datos cargados a continuacion:</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="Estilo18" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                <div align="center"><em>(si los datos son incorrectos, realice nuevamente todo el proceso asegurandose que la informacion sea la correcta)
                                    </em></div>
                            </div>
                        </td>
                    </tr>
                </table>
                <br />
                <?php
                //-------
                include('../config.php');
                $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                $sqlxx = "select * from fecha";
                $resultadoxx = $connectionxx->query($sqlxx);

                while ($rowxx = $resultadoxx->fetch_assoc()) {
                    $idxx = $rowxx["id_emp"];
                    $id_emp = $rowxx["id_emp"];
                }


                $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                $sq = "select * from aux_conciliaciones_vig_ant order by fecha asc ";
                $re = $cx->query($sq);
                printf("<BR><center><span class='Estilo4'><B>DATOS CARGADOS</B></span></center><BR>");
                printf("
<center>
<table width='1200' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>FECHA</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>COMPROBANTE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>DCTO/CHEQUE</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>DEBITO</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>CREDITO</b></span></td>
</tr>


");

                while ($rw = $re->fetch_assoc()) {

                    $fecha = $rw["fecha"];
                    if ($fecha == 'FECHA') {
                    } else {


                        printf(
                            "
		<span class='Estilo4'>
		<tr>
		<td align='center'><span class='Estilo4'>%s</font></span></td>
		<td align='center'><span class='Estilo4'>%s</font></span></td>
		<td align='left'><span class='Estilo4'>%s</font></span></td>
		<td align='left'><span class='Estilo4'>%s</font></span></td>
		<td align='center'><span class='Estilo4'>%s</font></span></td>
		<td align='center'><span class='Estilo4'>%s</font></span></td>
		<td align='right'><span class='Estilo4'>%s</font></span></td>
		<td align='right'><span class='Estilo4'>%s</font></span></td>

		</tr>",
                            $rw["fecha"],
                            $rw["dcto"],
                            $rw["cuenta"],
                            $rw["nombre"],
                            $rw["cheque"],
                            $rw["tercero"],
                            number_format($rw["debito"], 2, ',', '.'),
                            number_format($rw["credito"], 2, ',', '.')
                        );
                    }
                }

                printf("</table></center><br>");
                //--------	
                ?>
                <br />
            </div>
            <table width="800" border="0" align="center">

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
                        <div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                            <div align="center">
                                <?php include('../config.php');
                                echo $nom_emp ?>
                                <br />
                                <?php echo $dir_tel ?><br />
                                <?php echo $muni ?> <br />
                                <?php echo $email ?>
                            </div>
                        </div>
                    </td>
                    <td width="266">
                        <div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                            <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
                                </a><br />
                                <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
                            </div>
                        </div>
                    </td>
                    <td width="266">
                        <div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
                            <div align="center">Desarrollado por <br />
                                <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
                                Derechos Reservados - 2009
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <p>&nbsp;</p>
        </body>

        </html>

<?php

    } else { // si no tiene persisos de usuario
        echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
        echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
    }
}
?>