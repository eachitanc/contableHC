<?
session_start();
if(!isset($_SESSION["login"]))
{
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
<!--
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>



<script language="JavaScript">

function muestra_oculta(id)
{
	if (document.getElementById)
	{ //se obtiene el id
		var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
		el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
	}
}
window.onload = function()
{/*hace que se cargue la funci�n lo que predetermina que div estar� oculto hasta llamar a la funci�n nuevamente*/
	muestra_oculta('contenido_a_mostrar');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}

function pintar()
{
	var celdas=document.getElementById("mes").value;
	var m1=document.getElementById("m1");
	
	
	
}

//******CONSULTA VIGENCIA ACTUAL ******************
function inicial(elcolor)
{
	var mes=0;
	var id=1;
	var pos_url ='mes_vig.php';
	var req = new XMLHttpRequest();
	if (req) 
	{
		req.onreadystatechange = function() 
		{
			if (req.readyState == 4)
			 {
				mes_vig=req.responseText;
				var messplit=mes_vig.split('/');
				mes=(parseInt(messplit[1]));
				//alert (parseInt(messplit[1]));
			 }
		}
		req.open('GET', pos_url +'?cod='+id,false);
		req.send(null);
	}
	//alert (mes);
	for(var i=1; i< mes; i++)
	{
		var contenedor = document.getElementById("m"+i);
		contenedor.style.backgroundColor  = elcolor;
	}
	
}



// cambio el color de fondo de todas las etiquetas SPAN que existan en ese DIV
function cambiarColoFondo(elcolor) 
{
	
	var x=0;
	var pass=0;
	var pos_url2 ='login_user.php';
	var req = new XMLHttpRequest();
	if (req) 
	{
		req.onreadystatechange = function() 
		{
			if (req.readyState == 4)
			 {
				pass=req.responseText;
				//alert (pass);
			 }
		}
		req.open('GET', pos_url2 +'?cod='+x,false);
		req.send(null);
	}
	var clave=document.getElementById("pass").value;
	//alert (clave +"->"+pass);
	if(clave==pass)
	{ 
		//alert("OK");
	
		var mes=0;
		var nmes=document.getElementById("mes").value;
		//alert (nmes);
		var pos_url ='cerrar_mes.php';
		var req = new XMLHttpRequest();
		if (req) 
		{
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4)
				 {
					mes_vig=req.responseText;
					var messplit=mes_vig.split('/');
					mes=(parseInt(messplit[1]));
					//alert (parseInt(messplit[1])+"ok");
				 }
			}
			req.open('GET', pos_url +'?cod='+nmes,false);
			req.send(null);
		}
		//alert (mes);
		window.location.reload();  
		for(var i=1; i< mes; i++)
		{
			var contenedor = document.getElementById("m"+i);
			contenedor.style.backgroundColor  = elcolor;
		}
	}
	else
	{ 
		alert("No es posible realizar el cierre la clave no es correcta...");
	}
	
}
function algo()
{
	alert ("OK");
	var x=0;
	var pass=0;
	var pos_url2 ='login_user.php';
	var req = new XMLHttpRequest();
	if (req) 
	{
		req.onreadystatechange = function() 
		{
			if (req.readyState == 4)
			 {
				pass=req.responseText;
				//alert (pass);
			 }
		}
		req.open('GET', pos_url2 +'?cod='+x,false);
		req.send(null);
	}
	var clave=document.getElementById("pass").value;
	
	
}


function cambiar_clave()
{
	var x=0;
	var pass=0;
	var pos_url2 ='login_user.php';
	var req = new XMLHttpRequest();
	if (req) 
	{
		req.onreadystatechange = function() 
		{
			if (req.readyState == 4)
			 {
				pass=req.responseText;
				//alert (pass);
			 }
		}
		req.open('GET', pos_url2 +'?cod='+x,false);
		req.send(null);
	}	
	//alert (pass);
	
	if(pass==document.getElementById("passw").value)
	{ 
		//alert ("claves ok");
		
		if(document.getElementById("passw").value==document.getElementById("passw2").value)
		{ 
			alert ("La clave nueva es igual a la clave antigua...")
			document.getElementById("passw2").focus();
		}
		else
		{
		    
			cambiar();
			alert ("La clave ha sido actualizada...");
			window.location.reload();  
		}
	}
	else 
	{
		alert ("La clave no es correcta");
		document.getElementById("passw").focus();
	}
}

function cambiar()
{
	var x=document.getElementById("passw2").value;
	var pass=0;
	var pos_url2 ='cambiar_pass.php';
	var req = new XMLHttpRequest();
	if (req) 
	{
		req.onreadystatechange = function() 
		{
			if (req.readyState == 4)
			 {
				pass=req.responseText;
				//alert ("nueva"+pass);
			 }
		}
		req.open('GET', pos_url2 +'?cod='+x,false);
		req.send(null);
	}

}
</script>



<style type="text/css">
<!--
.Estilo9 {font-weight: bold}
.Estilo10 {font-weight: bold}
-->
</style>
</head>
</head>
<body onload="inicial('#F90');">
<table width="800" border="0" align="center">
  <tr>
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  
	  </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
	
	<table border="1" width="800" align="center" class="bordepunteado1">
      <tr>
        <td colspan="12" bgcolor="#DCE9E5" align="right">
		 <div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
		   <div align="center" class="Estilo4"><strong>Linea de tiempo</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label onclick="muestra_oculta('contenido_a_mostrar2')"  style="cursor:pointer"><font color="#0066CC">Administrar cuenta</font></label>
		   </div>
		 </div>		</td>
         
        </tr>
        
        <tr> 
        	<td colspan="12"> 
            <p></p> 
            	<p>
                	<table width="200" border="0">
                      <tr>
                        <td bgcolor="#FF9900">&nbsp;</td>
                        <td>Cerrado</td>
                      </tr>
                      <tr>
                        <td bgcolor="#0066CC">&nbsp;</td>
                        <td>Vigente</td>
                      </tr>
                    </table>

                </p> 
            <p></p>
            </td>
        </tr>
       
        
      <tr>
      <td colspan="12" >
      <table width="800" cellpadding="0">
        <td > <div id="m0" style="background:#F90" > </div> </td>	
        <td > <div id="m1" style="background:#06C" > <font color="#FFFFFF"> Enero </font> </div> </td>	
        <td > <div id="m2" style="background:#06C" > <font color="#FFFFFF"> Febrero </font></div> </td>	
        <td > <div id="m3" style="background:#06C" > <font color="#FFFFFF"> Marzo </font></div> </td>	
        <td > <div id="m4" style="background:#06C" > <font color="#FFFFFF"> Abril </font></div> </td>	
        <td > <div id="m5" style="background:#06C" > <font color="#FFFFFF"> Mayo </font></div> </td>	
        <td > <div id="m6" style="background:#06C" > <font color="#FFFFFF"> Junio </font></div> </td>	       
        <td > <div id="m7" style="background:#06C" > <font color="#FFFFFF"> Lulio </font></div> </td>	
        <td > <div id="m8" style="background:#06C" > <font color="#FFFFFF"> Agosto </font></div> </td>	
        <td > <div id="m9" style="background:#06C" > <font color="#FFFFFF"> Septiembre </font></div> </td>	
        <td > <div id="m10" style="background:#06C" > <font color="#FFFFFF"> Octubre </font></div> </td>	
        <td > <div id="m11" style="background:#06C" > <font color="#FFFFFF"> Noviembre </font></div> </td>	
        <td > <div id="m12" style="background:#06C" > <font color="#FFFFFF"> Diciembre </font></div> </td>	       
        </table>
        </td>
       </tr>
      <tr>
        <td colspan="12" align="center"> 
        <select name="mes" id="mes">
            <option value="0"> ..Seleccione Mes..</option>
         	<option value="1"> Enero</option>
            <option value="2"> Febrero</option>
            <option value="3"> Marzo</option>
            <option value="4"> Abril</option>
            <option value="5"> Mayo</option>
            <option value="6"> Junio</option>
            <option value="7"> Julio</option>
            <option value="8"> Agosto</option>
            <option value="9"> Septiembre</option>
            <option value="10"> Octubre</option>
            <option value="11"> Noviembre</option>
            <option value="12"> Diciembre</option>
        </select>
        
        <input name="BtnColor" type="button" value="Cerrar" onclick="muestra_oculta('contenido_a_mostrar')" /> </td>
       </tr>
      <tr>
       <td colspan="12" align="center">
       <p>&nbsp;</p>
	   </td>
       </tr>
       <tr>
               <td colspan="12" align="center">
					<div id="contenido_a_mostrar" style="display:none">
						<table width="200" border="0">
                          <tr>
                            <td colspan="2" align="center">Digite Contrase�a</td>
                          </tr>
                          <tr>
                            <td>Clave:</td>
                            <td><input name="pass"  id="pass" type="password" /></td>
                          </tr>
                          <tr>
                            <td colspan="2"><input name="" type="button" value="Continuar" onclick="cambiarColoFondo('#F90');"/></td>
                           
                          </tr>
                        </table>

					</div>
               
               </td>
       </tr>
        <tr>
               <td colspan="12" align="center">
					<div id="contenido_a_mostrar2" style="display:none">
						<table width="400" border="0">
                          <tr>
                            <td colspan="2" align="center">Cambiar Contrase�a</td>
                          </tr>
                          <tr>
                            <td align="right">Digite Contrase�a anterior:</td>
                            <td align="left"><input name="passw"  id="passw" type="password" /></td>
                          </tr>
                           <tr>
                            <td align="right">Digite nueva contrase�a:</td>
                            <td align="left"><input name="passw2"  id="passw2" type="password" /></td>
                          </tr>
                          <tr>
                            <td colspan="2"><input name="" type="button" value="Cambiar clave" onclick="cambiar_clave();"/></td>
                           
                          </tr>
                        </table>

					</div>
               
               </td>
       </tr>
       
    </table>
	<p>&nbsp;</p>
   
    
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
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>


<!--Al hace llamado a la funci�n solo tienes que idicar el nombre del DIV entre parentesis -->



</body>
</html>






<?
}
?>