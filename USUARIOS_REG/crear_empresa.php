<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
} else {
    // verifico permisos del usuario
    include('config.php');
    $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
    $sql = "SELECT confi FROM usuarios2 where login = '$_SESSION[login]'";
    $res = $cx->query($sql);
    $rw = $res->fetch_assoc();
    if ($rw['confi'] == 'SI') {
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

                .Estilo9 {
                    font-weight: bold
                }

                .Estilo10 {
                    font-weight: bold
                }

                .Estilo11 {
                    font-weight: bold
                }

                .Estilo12 {
                    font-weight: bold
                }

                .Estilo13 {
                    font-weight: bold
                }

                .Estilo14 {
                    font-weight: bold
                }

                .Estilo15 {
                    font-size: 12px
                }
            </style>

            <script language="">
                function cursor() {
                    document.empresa.raz_soc.focus();
                }
                // 
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



        </head>

        <body onLoad=cursor()>
            <table width="600" border="0" align="center">
                <tr>

                    <td width="600" colspan="3">
                        <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
                            <div align="center"><img src="../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">


                        <table width="595" border="0" align="center">
                            <tr>
                                <td align="center">
                                    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                                        <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                                            <div align="center"><a href='user.php' target='_parent'>VOLVER</a> </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>

                                    <div align="center">

                                        <?php
                                        //-------
                                        include('config.php');
                                        $cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                        $sq = "select * from empresa";
                                        $re = $cx->query($sq);

                                        printf("<br><center><span class='Estilo4'><b>LISTA DE EMPRESAS CREADAS HASTA LA FECHA</b></span></center><br>");
                                        printf("<center><span class='Estilo4'>
<table width='595' border ='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='30'><B>COD</B></td>
<td align='center' width='230'><B>RAZ.SOCIAL</B></td>
<td align='center' width='230'><B>REPRESENTANTE LEGAL</B></td>
<td align='center' width='50'><B>ELIMINAR</B></td>
<td align='center' width='50'><B>MODIFICAR</B></td>
");

                                        while ($rw = $re->fetch_assoc()) {
                                            printf("
<span class='Estilo4'>
<tr>
<td align='center'> %s </td>
<td align='center'> %s </td>
<td align='center'> %s </td>
<td align='center'> <a href=\"empresa/eli_empresa.php?id=%d\">Borrar</a> </td>
<td align='center'> <a href=\"empresa/modi_empresa.php?id1=%d\">Modificar</a> </td>

</tr>", $rw["cod_emp"], $rw["raz_soc"], $rw["nom_rep_leg"], $rw["cod_emp"], $rw["cod_emp"]);
                                        }

                                        printf("</table></center>");
                                        //--------	
                                        ?>
                                        <br />
                                    </div>
                                </td>
                            </tr>
                        </table>



                    </td>
                </tr>
                <tr>

                    <td colspan="3">

                        <form name="empresa" method="post" action="proc_crear_emp.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">

                            <table width="590" border='1' class='bordepunteado1'>

                                <tr>
                                    <td colspan="2" bgcolor="#DCE9E5" class="Estilo4">
                                        <div id="div31" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
                                            <div align="center"><strong>CREAR EMPRESA </strong></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="295" class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">RAZON SOCIAL </div>
                                        </div>
                                    </td>
                                    <td width="285" class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                            <input name="raz_soc" type="text" class="Estilo7" id="raz_soc" tabindex="0" size="40" onkeyup="empresa.raz_soc.value=empresa.raz_soc.value.toUpperCase();" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">NIT </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="nit" type="text" class="Estilo7" id="nit" tabindex="0" size="15" onkeypress="return validar(event)" />
                                            <span class="Estilo8">..</span> DV
                                            <select name="dv" class="Estilo4" id="dv">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                            0 - 9
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">CODIGO INSTITUCION </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="cod_ins" type="text" class="Estilo7" id="cod_ins" tabindex="0" size="15" onkeyup="empresa.cod_ins.value=empresa.cod_ins.value.toUpperCase();" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">CODIGO C.G.N </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="cod_cgn" type="text" class="Estilo7" id="cod_cgn" tabindex="0" size="15" onkeyup="empresa.cod_cgn.value=empresa.cod_cgn.value.toUpperCase();" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">CODIGO DEPARTAMENTO </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="cod_dep" type="text" class="Estilo7" id="cod_dep" tabindex="0" value="52" size="5" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right"> MUNICIPIO </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <select name="cod_mpio" class="Estilo4" id="cod_mpio">
                                                <option value="001">PASTO</option>
                                                <option value="019">ALBAN</option>
                                                <option value="022">ALDANA</option>
                                                <option value="036">ANCUYA</option>
                                                <option value="051">ARBOLEDA</option>
                                                <option value="079">BARBACOAS</option>
                                                <option value="083">BELEN</option>
                                                <option value="110">BUESACO</option>
                                                <option value="203">COLON (GENOVA)</option>
                                                <option value="207">CONSACA</option>
                                                <option value="210">CONTADERO</option>
                                                <option value="215">CORDOBA</option>
                                                <option value="224">CUASPUD</option>
                                                <option value="227">CUMBAL</option>
                                                <option value="233">CUMBITARA</option>
                                                <option value="240">CHACHAGUI</option>
                                                <option value="250">EL CHARCO</option>
                                                <option value="254">EL PE&Ntilde;OL</option>
                                                <option value="256">EL ROSARIO</option>
                                                <option value="258">EL TABLON</option>
                                                <option value="260">EL TAMBO</option>
                                                <option value="287">FUNES</option>
                                                <option value="317">GUACHUCAL</option>
                                                <option value="320">GUATARILLA</option>
                                                <option value="323">GUALMATAN</option>
                                                <option value="352">ILES</option>
                                                <option value="354">IMUES</option>
                                                <option value="356">IPIALES</option>
                                                <option value="378">LA CRUZ</option>
                                                <option value="381">LA FLORIDA</option>
                                                <option value="385">LA LLANADA</option>
                                                <option value="390">LA TOLA</option>
                                                <option value="399">LA UNION</option>
                                                <option value="405">LEIVA</option>
                                                <option value="411">LINARES</option>
                                                <option value="418">LOS ANDES</option>
                                                <option value="427">MAGUI</option>
                                                <option value="435">MALLAMA</option>
                                                <option value="473">MOSQUERA</option>
                                                <option value="480">NARI&Ntilde;O</option>
                                                <option value="490">OLAYA HERRERA</option>
                                                <option value="506">OSPINA</option>
                                                <option value="520">PIZARRO</option>
                                                <option value="540">POLICARPA</option>
                                                <option value="560">POTOSI</option>
                                                <option value="565">PROVIDENCIA</option>
                                                <option value="573">PUERRES</option>
                                                <option value="585">PUPIALES</option>
                                                <option value="612">RICAURTE</option>
                                                <option value="621">ROBERTO PAYAN</option>
                                                <option value="678">SAMANIEGO</option>
                                                <option value="683">SANDONA</option>
                                                <option value="685">SAN BERNARDO</option>
                                                <option value="687">SAN LORENZO</option>
                                                <option value="693">SAN PABLO</option>
                                                <option value="694">SAN PEDRO DE CARTAGO</option>
                                                <option value="696">SANTA BARBARA</option>
                                                <option value="699">SANTACRUZ</option>
                                                <option value="720">SAPUYES</option>
                                                <option value="786">TAMINANGO</option>
                                                <option value="788">TANGUA</option>
                                                <option value="835">TUMACO</option>
                                                <option value="838">TUQUERRES</option>
                                                <option value="885">YACUANQUER</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">DIRECCION EMPRESA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="dir" type="text" class="Estilo7" id="dir" tabindex="0" size="40" onkeyup="empresa.dir.value=empresa.dir.value.toUpperCase();" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">TELEFONO EMPRESA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="tel" type="text" class="Estilo7" id="tel" tabindex="0" size="15" onkeypress="return validar(event)" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">FAX EMPRESA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="fax" type="text" class="Estilo7" id="fax" tabindex="0" size="15" onkeypress="return validar(event)" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">E - MAIL EMPRESA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="email" type="text" class="Estilo7" id="email" tabindex="0" size="40" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">SITIO WEB EMPRESA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="web_site" type="text" class="Estilo7" id="web_site" tabindex="0" size="40" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">UNIDAD EJECUTORA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <select name="uni_eje" class="Estilo4" id="uni_eje">
                                                <option value="ALCALDIA SECTOR CENTRAL">ALCALDIA SECTOR CENTRAL</option>
                                                <option value="CONCEJO">CONCEJO</option>
                                                <option value="CABILDO">CABILDO</option>
                                                <option value="DLS">DLS</option>
                                                <option value="EMPRESA">EMPRESA</option>
                                                <option value="PERSONERIA">PERSONERIA</option>
                                                <option value="OTRA">OTRA</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">OTRA UNIDAD EJECUTORA </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="otra_uni_eje" type="text" class="Estilo7" id="otra_uni_eje" tabindex="0" size="40" />
                                        </div>
                                    </td>
                                </tr>



                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">TIPO DE ENTIDAD </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <select name="tipo_entidad" class="Estilo4" id="uni_eje">
                                                <option value="ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES">ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES</option>
                                                <option value="EMPRESAS NACIONALES Y TERRITORIALES">EMPRESAS NACIONALES Y TERRITORIALES</option>
                                                <option value="ENTIDADES TERRITORIALES">ENTIDADES TERRITORIALES</option>

                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">REGIONAL </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <input name="regional" type="text" class="Estilo7" id="regional" tabindex="0" size="40" />
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="2" class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="center"><B>DEFINA EQUIVALENCIA PARA UNIDAD EJECUTORA </B></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">CODIGO F.U.T : </div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                            <div align="left">
                                                <select name="fut" class="Estilo4" id="fut">
                                                    <option value="1">1 . Admin.Central</option>
                                                    <option value="2">2. Concejo (Mpio)</option>
                                                    <option value="3">3. Asamblea (Dpto)</option>
                                                    <option value="4">4. Contraloria</option>
                                                    <option value="5">5. Personeria (Mpio)</option>
                                                    <option value="6">6. Sec. Educacion</option>
                                                    <option value="7">7. Sec. Salud</option>
                                                    <option value="8">8. Uni. Serv. Publicos</option>
                                                    <option value="9">9. Licores (Dpto)</option>
                                                    <option value="10">10. NINGUNA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="right">CODIGO C.G.R :</div>
                                        </div>
                                    </td>
                                    <td class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                            <div align="left">
                                                <select name="cgr" class="Estilo4" id="cgr">
                                                    <option value="0">0. Consolidado Entidad</option>
                                                    <option value="2">2. Concejo</option>
                                                    <option value="3">3. Contraloria</option>
                                                    <option value="4">4. Personeria</option>
                                                    <option value="7">7. Admin. Central</option>
                                                    <option value="14">14. Educacion</option>
                                                    <option value="16">16. Salud</option>
                                                    <option value="10">10. NINGUNA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <div align="center" class="Estilo8">RESPONSABLES </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="Estilo4">
                                        <div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                            <table width="580" border="0">
                                                <tr>
                                                    <td width="154">
                                                        <div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                        </div>
                                                    </td>
                                                    <td width="194">
                                                        <div class="Estilo9" id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">NOMBRES COMPLETOS </div>
                                                        </div>
                                                    </td>
                                                    <td width="109">
                                                        <div class="Estilo10" id="div28" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">No. CEDULA </div>
                                                        </div>
                                                    </td>
                                                    <td width="107">
                                                        <div class="Estilo11" id="div6" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">No. T.P. </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="div2" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="right">REPRESENTANTE LEGAL </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div10" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="nom_rep_leg" type="text" class="Estilo4" id="nom_rep_leg" size="35" onkeyup="empresa.nom_rep_leg.value=empresa.nom_rep_leg.value.toUpperCase();" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div27" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="ced_rep_leg" type="text" class="Estilo4" id="ced_rep_leg" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div16" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                                            <div align="center">
                                                                <input name="tp_rep_leg" type="text" class="Estilo4" id="tp_rep_leg" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="right">CONTADOR </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div11" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="nom_cont" type="text" class="Estilo4" id="nom_cont" size="35" onkeyup="empresa.nom_cont.value=empresa.nom_cont.value.toUpperCase();" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div26" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="ced_cont" type="text" class="Estilo4" id="ced_cont" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div17" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                                            <div align="center">
                                                                <input name="tp_cont" type="text" class="Estilo4" id="tp_cont" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="div4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="right">REVISOR FISCAL </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div12" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="nom_rev_fis" type="text" class="Estilo4" id="nom_rev_fis" size="35" onkeyup="empresa.nom_rev_fis.value=empresa.nom_rev_fis.value.toUpperCase();" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div25" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="ced_rev_fis" type="text" class="Estilo4" id="ced_rev_fis" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div18" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                                            <div align="center">
                                                                <input name="tp_rev_fis" type="text" class="Estilo4" id="tp_rev_fis" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="div7" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="right">CONTROL INTERNO </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div13" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="nom_ctrl_int" type="text" class="Estilo4" id="nom_ctrl_int" size="35" onkeyup="empresa.nom_ctrl_int.value=empresa.nom_ctrl_int.value.toUpperCase();" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div24" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="ced_ctrl_int" type="text" class="Estilo4" id="ced_ctrl_int" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div19" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                                            <div align="center">
                                                                <input name="tp_ctrl_int" type="text" class="Estilo4" id="tp_ctrl_int" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="div8" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="right">JEFE PRESUPUESTO </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div14" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="nom_jefe_ppto" type="text" class="Estilo4" id="nom_jefe_ppto" size="35" onkeyup="empresa.nom_jefe_ppto.value=empresa.nom_jefe_ppto.value.toUpperCase();" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div23" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                                                            <div align="center">
                                                                <input name="ced_jefe_ppto" type="text" class="Estilo4" id="ced_jefe_ppto" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="div20" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

                                                            <div align="center">
                                                                <input name="tp_jefe_ppto" type="text" class="Estilo4" id="tp_jefe_ppto" onkeypress="return validar(event)" size="20" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <table width="576" border="0" align="center">
                                                            <tr>
                                                                <td width="156" valign="middle">
                                                                    <div class="Estilo12" id="div9" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">
                                                                        <div align="center">OTROS RESPONSABLES </div>
                                                                    </div>
                                                                </td>
                                                                <td width="202" valign="middle">
                                                                    <div class="Estilo13" id="div29" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">
                                                                        <div align="center">NOMBRES COMPLETOS </div>
                                                                    </div>
                                                                </td>
                                                                <td width="100" valign="middle">
                                                                    <div align="center"><strong>No. CEDULA </strong></div>
                                                                </td>
                                                                <td width="100" valign="middle">
                                                                    <div class="Estilo14" id="div22" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">
                                                                        <div align="center">No.T.P.</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="156" valign="middle"><select name="otr_resp" class="Estilo4" id="otr_resp">
                                                                        <option value="TESORERO (A)">TESORERO (A)</option>
                                                                        <option value="SUB GER. AVO Y FRO.">SUB GER. AVO Y FRO.</option>
                                                                        <option value="PAGADOR (A)">PAGADOR (A)</option>
                                                                    </select></td>
                                                                <td width="202" valign="middle">
                                                                    <div id="div15" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">

                                                                        <div align="center">
                                                                            <input name="nom_otr_resp" type="text" class="Estilo4" id="nom_otr_resp" size="35" onkeyup="empresa.nom_otr_resp.value=empresa.nom_otr_resp.value.toUpperCase();" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="100" valign="middle">
                                                                    <div id="div21" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">

                                                                        <div align="center">
                                                                            <input name="ced_otr_resp" type="text" class="Estilo4" id="ced_otr_resp" onkeypress="return validar(event)" size="20" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="100" valign="middle">
                                                                    <div id="div22" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">

                                                                        <div align="center">
                                                                            <input name="tp_otr_resp" type="text" class="Estilo4" id="tp_otr_resp" onkeypress="return validar(event)" size="20" />
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><?php
                                                                    //-------
                                                                    include('config.php');
                                                                    $connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                                                    $sql = "select * from fecha";
                                                                    $resultado = $connection->query($sql);

                                                                    while ($row = $resultado->fetch_assoc()) {
                                                                        printf(" <input name='ano' id='ano' type='hidden' value='%s' />", $row["ano"]);
                                                                    }
                                                                    //--------	
                                                                    ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="Estilo4" id="div30" style="padding-left:0px; padding-top:15px; padding-right:0px; padding-bottom:15px;">
                                                            <div align="center">
                                                                <input name="Submit" type="submit" class="Estilo4" value="Crear Empresa" />
                                                                </label>
                                                                <span class="Estilo8">:::</span>
                                                                <input name="Submit2" type="reset" class="Estilo4" value="Restablecer" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                                                            <div align="center"> Fecha de esta Sesion: <br />
                                                                <strong>
                                                                    <?php include('config.php');
                                                                    $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
                                                                    $sqlxx = "select * from fecha";
                                                                    $resultadoxx = $connectionxx->query($sqlxx);

                                                                    while ($rowxx = $resultadoxx->fetch_assoc()) {
                                                                        $ano = $rowxx["ano"];
                                                                    }
                                                                    echo $ano;
                                                                    ?>
                                                                </strong> <br />
                                                                <b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>


                        </form><br />
                        <div align="center">
                            <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                                <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                                    <div align="center"><a href='user.php' target='_parent'>VOLVER</a> </div>
                                </div>
                            </div>
                        </div>

                    </td>

                </tr>
                <tr>
                    <td width="200">
                        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                            <div align="center"><?php include('config.php');
                                                echo $nom_emp ?><br />
                                <?php echo $dir_tel ?><BR />
                                <?php echo $muni ?> <br />
                                <?php echo $email ?> </div>
                        </div>
                    </td>
                    <td width="200">
                        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                            <div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
                                </a><BR />
                                <a href="../condiciones.php" target="_blank">CONDICIONES DE USO </a>
                            </div>
                        </div>
                    </td>
                    <td width="200">
                        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
                            <div align="center">Desarrollado por <br />
                                <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../ADMIN/images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
                                Derechos Reservados - 2009
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </body>

        </html>

<?php
    } else { // si no tiene persisos de usuario
        echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
        echo "<center>Click <a href=\"user.php\">aqu&iacute; para volver</a></center>";
    }
}
?>