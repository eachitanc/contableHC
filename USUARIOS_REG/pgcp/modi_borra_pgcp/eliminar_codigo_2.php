<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../../login.php");
exit;
} else {
// recibo informacion del usuario
   $ingresa=$_POST['nn'];      				
// cx bd
// saco el id de la empresa
include('../config.php');				
global $server, $database, $dbpass,$dbuser,$charset;
// Conexion con la base de datos
$cx= new mysqli ($server, $dbuser, $dbpass, $database);		   
 $sqlxx = "select * from fecha";
	    $resultadoxx = $cx->query($sqlxx);
	    while($rowxx = $resultadoxx->fetch_array())
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
   
   
// verifico que los campos afectado y afectado_otros sean 0   
   	    $sq = "select * from pgcp where id_emp = '$idxx' and cod_pptal = '$ingresa'";
	    $re = $cx->query($sq);
	    while($r = $re->fetch_array())
  	    
  	    {
     	 $a1=$r["afectado"]; 
    	}
		
// valido el resultado
	if($a1 == '0')
	{
		//resto el valor a todos sus padres
        $longitud = strlen($ingresa);
		switch ($longitud)
  		 {
		   case (0):
						$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
     					break;
						//---------
						case (1):
     						
	                     break;
						//---------
						case (2):
     					 $tipo = 1;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 2;
	 					 
						 // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
	                     break;
						//---------
						case (3):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (4):
     					 $tipo = 2;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 3;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
	                     break;
						//---------
						case (5):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (6):
     					 $tipo = 4;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 4;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2); 
						} 
	                     break;
						//---------
						case (7):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (8):
     					 $tipo = 6;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 5;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
	                     break;
						//---------
						case (9):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (10):
 						 $tipo = 8;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 6;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
						  
	                     break;
						//---------
						case (11):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (12):
     					 $tipo = 10;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 7;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
	                     break;
						//---------
						case (13):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (14):
     					 $tipo = 12;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 8;
						 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 						 					 
	                     break;
						//---------
						case (15):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (16):
     					 $tipo = 14;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 9;
	 					
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 		
						 break;
						//---------
						case (17):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (18):
     					 $tipo = 16;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 10;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 	
						 break;
						//---------
						case (19):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (20):
     					 $tipo = 18;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 11;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 =$cx->query($sql2);
						} 	
						 break;
						//---------
						case (21):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (22):
     					 $tipo = 20;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 12;
						
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 	
						 break;
						//---------
						case (23):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (24):
     					 $tipo = 22;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 13;
						
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 	
						 break;
						//---------
						case (25):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (26):
     					 $tipo = 24;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 14;
	 					
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 	
						 break;
						//---------
						case (27):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (28):
     					 $tipo = 26;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 15;
	 					
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
						 break;
						//---------
						case (29):
     					 $error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" .$ingresa. ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	                     break;
						//---------
						case (30):
     					 $tipo = 28;
						 $codigo = $ingresa;
						 $padre = substr($codigo,0,$tipo);
	 					 $nivel = 16;
	 					 
                         // actualizo afectado del padre a 0 si este no tiene mas hijos 
						$result = $cx->query("SELECT * from pgcp where padre ='$padre' and id_emp ='$idxx' ", $link);
						$num_rows = $result->num_rows;
						if($num_rows > '1')
						{
						}	
						else
						{
						 $sql2 = "update pgcp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					     $resultado2 = $cx->query($sql2);
						} 
						 break;
						//---------
						
		                default:
                        $error = "<center class='Estilo4'><br><br><b>La Extension del Codigo contable Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>"; 
		 }
		printf("%s <br><br></center>",$error);
		//elimino el registro
		$sSQL="Delete from pgcp Where cod_pptal='$ingresa' and id_emp = '$idxx'";
		$cx->query($sSQL);
		printf("<center class='Estilo4'><br><br>Cuenta <b>ELIMINADA</b> con exito<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='../consulta_pgcp.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>"); 
	}
	else
	{
	   echo "<br><br><center class='Estilo4'>El codigo contable que intenta <b>ELIMINAR</b><br>
<b>NO EXISTE </b> o ha sido afectado por otras cuentas<br><BR><B>NO SE PUEDE EJECUTAR ESTA ACCION</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>"; 
	}
	
	

}
?>

<title>CONTAFACIL</title>
<style type="text/css">
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
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
.Estilo8 {color: #FFFFFF}
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
.Estilo15 {font-size: 11px}
</style>