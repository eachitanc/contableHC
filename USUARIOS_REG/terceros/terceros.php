<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
} else {

  // verifico permisos del usuario
  include('../config.php');
  $cx = new mysqli($server, $dbuser, $dbpass, $database);
  $sql = "SELECT ter FROM usuarios2 where login = '$_SESSION[login]'";
  $res = $cx->query($sql);
  $rw = $res->fetch_assoc();
  if ($rw['ter'] == 'SI') {

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
      <title>CONTAFACIL</title>
      <script type="text/javascript" src="../jquery.js"></script>
      <script type="text/javascript" src="../js/carga.js"></script>

      <style type="text/css">
        .Estilo2 {
          font-size: 9px;
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

        table.bordepunteado1 {
          border-style: solid;
          border-collapse: collapse;
          border-width: 2px;
          border-color: #004080;
        }

        #divCargando {
          position: absolute;
          top: 5px;
          right: 5px;
          background-color: red;
          color: white;
          font-family: Arial, Helvetica, sans-serif;
          font-size: 12px;
          font-weight: bold;
          padding: 5px;
        }
      </style>
    </head>

    <body onload="cargaTerceros('terceros_lista.php','A');">
      <div id="divCargando" style="display:none">
        Por favor espere...
      </div>
      <table width="46%" border="0" align="center">
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
        <tr>
          <td colspan="3">
            <form name="a" method="post" action="terceros2.php" onsubmit="return confirm('Confirme su seleccion')">
              <table border="1" align="center" class="bordepunteado1">
                <tr>
                  <td colspan="3" bgcolor="#DCE9E5">
                    <div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
                      <div align="center" class="Estilo4"><strong>REGISTRO Y CONSULTA DE TERCEROS </strong>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="163" class="Estilo4">
                    <div class="Estilo9" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
                      <div align="center">PERSONA NATURAL</div>
                    </div>
                  </td>
                  <td colspan="2" class="Estilo4">
                    <div class="Estilo10" style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
                      <div align="center">PERSONA JURIDICA
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
                      <div align="center">
                        <input name="a" type="radio" value="NATURAL" checked="checked" />
                      </div>
                    </div>
                  </td>
                  <td colspan="2">
                    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>

                      <div align="center">
                        <input name="a" type="radio" value="JURIDICA" />
                      </div>

                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
                      <div align="center">
                        <input name="Submit" type="submit" class="Estilo4" value="Nuevo" />
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td width="80"></td>
                  <td width="78"></td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
      <br />
      <div align="center"><a href="reporte.php">Ver todos los terceros</a></div><br />
      <table width='800' BORDER='1' class='bordepunteado1' align="center">
        <tr bgcolor='#DCE9E5'>
          <td class="Estilo4" align="center">
            <a href="#" id="A" onClick="cargaTerceros('terceros_lista.php',id);">A</a>&nbsp;
            <a href="#" id="B" onClick="cargaTerceros('terceros_lista.php',id);">B</a>&nbsp;
            <a href="#" id="C" onClick="cargaTerceros('terceros_lista.php',id);">C</a>&nbsp;
            <a href="#" id="D" onClick="cargaTerceros('terceros_lista.php',id);">D</a>&nbsp;
            <a href="#" id="E" onClick="cargaTerceros('terceros_lista.php',id);">E</a>&nbsp;
            <a href="#" id="F" onClick="cargaTerceros('terceros_lista.php',id);">F</a>&nbsp;
            <a href="#" id="G" onClick="cargaTerceros('terceros_lista.php',id);">G</a>&nbsp;
            <a href="#" id="H" onClick="cargaTerceros('terceros_lista.php',id);">H</a>&nbsp;
            <a href="#" id="I" onClick="cargaTerceros('terceros_lista.php',id);">I</a>&nbsp;
            <a href="#" id="J" onClick="cargaTerceros('terceros_lista.php',id);">J</a>&nbsp;
            <a href="#" id="K" onClick="cargaTerceros('terceros_lista.php',id);">K</a>&nbsp;
            <a href="#" id="L" onClick="cargaTerceros('terceros_lista.php',id);">L</a>&nbsp;
            <a href="#" id="M" onClick="cargaTerceros('terceros_lista.php',id);">M</a>&nbsp;
            <a href="#" id="N" onClick="cargaTerceros('terceros_lista.php',id);">N</a>&nbsp;
            <a href="#" id="O" onClick="cargaTerceros('terceros_lista.php',id);">O</a>&nbsp;
            <a href="#" id="P" onClick="cargaTerceros('terceros_lista.php',id);">P</a>&nbsp;
            <a href="#" id="Q" onClick="cargaTerceros('terceros_lista.php',id);">Q</a>&nbsp;
            <a href="#" id="R" onClick="cargaTerceros('terceros_lista.php',id);">R</a>&nbsp;
            <a href="#" id="S" onClick="cargaTerceros('terceros_lista.php',id);">S</a>&nbsp;
            <a href="#" id="T" onClick="cargaTerceros('terceros_lista.php',id);">T</a>&nbsp;
            <a href="#" id="U" onClick="cargaTerceros('terceros_lista.php',id);">U</a>&nbsp;
            <a href="#" id="V" onClick="cargaTerceros('terceros_lista.php',id);">V</a>&nbsp;
            <a href="#" id="W" onClick="cargaTerceros('terceros_lista.php',id);">W</a>&nbsp;
            <a href="#" id="X" onClick="cargaTerceros('terceros_lista.php',id);">X</a>&nbsp;
            <a href="#" id="Y" onClick="cargaTerceros('terceros_lista.php',id);">Y</a>&nbsp;
            <a href="#" id="Z" onClick="cargaTerceros('terceros_lista.php',id);">Z</a>&nbsp;
          </td>
        </tr>
      </table>
      <br />
      <div id="mainContent" align="center"></div>
      <br />
      <table BORDER='0' align="center">
        <tr>
          <td>
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
      </table>
    </body>

    </html>
<?php
  } else { // si no tiene persisos de usuario
    echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
    echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
  }
}
?>