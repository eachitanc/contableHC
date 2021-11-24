<?php
header ("Pragma: no-cache");
setlocale(LC_TIME, 'Spanish');
$plant1 =$_GET["clase"];
$id_auto_crpp=$_GET["id"];
$plant =$plant1.".rtf";
if (file_exists($plant)){ 
   $plantilla = file_get_contents($plant);
// Agregamos los escapes necesarios   
$plantilla = addslashes($plantilla);   
$plantilla = str_replace("\\'f1","'f1",$plantilla);  
$plantilla = str_replace("\\'e1","'e1",$plantilla); 
$plantilla = str_replace("\\'e9","'e9",$plantilla); 
$plantilla = str_replace("\\'ed","'ed",$plantilla); 
$plantilla = str_replace("\\'f3","'f3",$plantilla);  
$plantilla = str_replace("\\'fa","'fa",$plantilla); 
$plantilla = str_replace("\\'c1","'c1",$plantilla); 
$plantilla = str_replace("\\'c9","'c9",$plantilla); 
$plantilla = str_replace("\\'93","'93",$plantilla); 
$plantilla = str_replace("\\'94","'94",$plantilla); 
$plantilla = str_replace("\\'d3","'d3",$plantilla);
$plantilla = str_replace("\\'cd","'cd",$plantilla);
$plantilla = str_replace("\\'da","'da",$plantilla);
// Datos de la plantilla   ---  Realizar consultas para cargar datos que se mostrarar en la plantilla 
// Se puede manejar una estructura de control de acuerdo a la clase de contrato
include('../config.php');
$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");

//Consulto el a�o
$res3 = mysql_db_query($database,"select * from fecha",$cx);
$row3 = mysql_fetch_array($res3);
$fecha = $row3["ano"];
$anno = explode("/", $fecha);
$vigencia = $anno[0];
// Datos del registro presupuestal 
$res = mysql_db_query($database,"select * from crpp where id_auto_crpp ='$id_auto_crpp'",$cx);
$row = mysql_fetch_array($res);
$ter_nat =$row["ter_nat"];
$id_manu_cdpp =$row["id_manu_cdpp"];
$cuenta = $row["cuenta"];
$forma_pago =ucfirst(strtolower($row["pago"]));
$ter_jur =$row["ter_jur"];
if ($ter_nat !='')
{
	$res4 = mysql_db_query($database,"select * from terceros_naturales where id ='$ter_nat'",$cx);
	$row4 = mysql_fetch_array($res4);
	$ter = $row4["pri_nom"]." ".$row4["seg_nom"]." ".$row4["pri_ape"]." ".$row4["seg_ape"];
	$cc_nit = "C.C. ".$row4["num_id"];
}else{
	$res5 = mysql_db_query($database,"select * from terceros_juridicos where id ='$ter_jur'",$cx);
	$row5 = mysql_fetch_array($res5);
	$ter = $row5["raz_soc2"];
	$cc_nit = "NIT ".$row5["num_id2"];
}
// Datos del contrato
$res2 = mysql_db_query($database,"select * from contrataciones2 where id_auto_crpp ='$id_auto_crpp'",$cx);
$row2 = mysql_fetch_array($res2);
$clas_contrato = $row2["clas_contrato"]; 
$cl_cont =array("","PRESTACION DE SERVICIOS","CONSULTORIA","INTERVENTORIA","MANTENIMIENTO Y/O REPARACION","OBRA PUBLICA","COMPRA Y/O SUMINISTRO","CONCESION","COMODATO","ARRENDAMIENTO O ADQUISICION DE INMUEBLES","FIDUCIA O ENCARGOS FIDUCITARIOS","PRESTAMO O MUTUO","TRANSPORTE","PUBLICIDAD","DEPOSITO","SEGUROS","PRESTACION DE LOS SERVICIOS DE SALUD","CONTRATO INTERADMINISTRATIVO","DESARROLLO DE ACT. CIENTIFICAS Y TECNOLOGICAS","OTROS");
			$i=0;
			for ($i=0;$i<=19;$i++)
			{
				if ($clas_contrato =='C'.$i)
				{
					$clase_contrato = $cl_cont[$i];
				}
			}
	
$num_contrato =$row2["num_contrato"]; 
$fec_firma = $row2["fec_firma"];
$fec_larga = strftime("%d d�as del mes de %B de %Y",strtotime("$fec_firma"));
$fec_corta = strftime("%B %d de %Y",strtotime("$fec_firma"));
$valor_inicial = number_format($row2["valor_inicial"],2,',','.');
$num=$row2["valor_inicial"];
$doc_itervetor=$row2["cedula_interventor"];
	$res44 = mysql_db_query($database,"select * from terceros_naturales where num_id ='$doc_itervetor'",$cx);
	$row44 = mysql_fetch_array($res44);
	$inter = $row44["pri_nom"]." ".$row44["seg_nom"]." ".$row44["pri_ape"]." ".$row44["seg_ape"];


class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "MENOS";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "CERO ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "MILLONES " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "MILLONES " || substr($s,-7, 7) == "MILLON ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " CON " . $this->SubValLetra(intval($Frc)) . "CENTAVOS";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . " M/CTE");
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "CERO" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" MIL MIL", " UN MIL", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "MIL ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "MIL ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "MIL ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "CIEN ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "CIEN", "CIENTO", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("DIEZ UN", "ONCE", $Rtn );
    $Rtn=str_replace("DIEZ DOS", "DOCE", $Rtn );
    $Rtn=str_replace("DIEZ TRES", "TRECE", $Rtn );
    $Rtn=str_replace("DIEZ CUATRO", "CATORCE", $Rtn );
    $Rtn=str_replace("DIEZ CINCO", "QUINCE", $Rtn );
    $Rtn=str_replace("DIEZ SEIS", "DIECISEIS", $Rtn );
    $Rtn=str_replace("DIEZ SIETE", "DIECISIETE", $Rtn );
    $Rtn=str_replace("DIEZ OCHO", "DIECIOCHO", $Rtn );
    $Rtn=str_replace("DIEZ NUEVE", "DIECINUEVE", $Rtn );
    $Rtn=str_replace("VEINTE UN", "VEINTIUN", $Rtn );
    $Rtn=str_replace("VEINTE DOS", "VEINTIDOS", $Rtn );
    $Rtn=str_replace("VEINTE TRES", "VEINTITRES", $Rtn );
    $Rtn=str_replace("VEINTE CUATRO", "VEINTICUATRO", $Rtn );
    $Rtn=str_replace("VEINTE CINCO", "VEINTICINCO", $Rtn );
    $Rtn=str_replace("VEINTE SEIS", "VEINTISEIS", $Rtn );
    $Rtn=str_replace("VEINTE SIETE", "VEINTISIETE", $Rtn );
    $Rtn=str_replace("VEINTE OCHO", "VEINTIOCHO", $Rtn );
    $Rtn=str_replace("VEINTE NUEVE", "VEINTINUEVE", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "UN " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("A " . Chr($i), "* Y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "A" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "CERO";break;
         Case 1:  $t = "UN";break;
         Case 2:  $t = "DOS";break;
         Case 3:  $t = "TRES";break;
         Case 4:  $t = "CUATRO";break;
         Case 5:  $t = "CINCO";break;
         Case 6:  $t = "SEIS";break;
         Case 7:  $t = "SIETE";break;
         Case 8:  $t = "OCHO";break;
         Case 9:  $t = "NUEVE";break;
         Case 10: $t = "DIEZ";break;
         Case 20: $t = "VEINTE";break;
         Case 30: $t = "TREINTA";break;
         Case 40: $t = "CUARENTA";break;
         Case 50: $t = "CINCUENTA";break;
         Case 60: $t = "SESENTA";break;
         Case 70: $t = "SETENTA";break;
         Case 80: $t = "OCHENTA";break;
         Case 90: $t = "NOVENTA";break;
         Case 100: $t = "CIEN";break;
         Case 200: $t = "DOSCIENTOS";break;
         Case 300: $t = "TRESCIENTOS";break;
         Case 400: $t = "CUATROCIENTOS";break;
         Case 500: $t = "QUINIENTOS";break;
         Case 600: $t = "SEISCIENTOS";break;
         Case 700: $t = "SETECIENTOS";break;
         Case 800: $t = "OCHOCIENTOS";break;
         Case 900: $t = "NOVECIENTOS";break;
         Case 1000: $t = "MIL";break;
         Case 1000000: $t = "MILLON";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " MIL";break;
       Case 2: $t = " MILLONES";break;
       Case 3: $t = " BILLONES";break;
    }
    return($Rtn . $t);
}

}
$V = new EnLetras();
$valor_letras= $V->ValorEnLetras($num,"PESOS");
$multa_valor_base = round($num *0.2,0);
$multa_valor = number_format($multa_valor_base,2,',','.');
$W = new EnLetras();
$multa_letras= $W->ValorEnLetras($multa_valor_base,"PESOS");
$plazo_contrato =$row2["plazo_contrato"];
$plazo_unidad = 'D�as';
$objeto =ucfirst(strtolower($row2["objeto"]));
$espacio = ' '; 
$fec_ter1 = date("Y/m/d", strtotime( "$fec_firma + $plazo_contrato day"));
$fec_ter = strftime("el %d de %B de %Y",strtotime("$fec_ter1"));
// calculo en meses
$fec_ini= explode("/",$fec_firma);
$fec_fin= explode("/",$fec_ter1);
$meses2 = ($fec_fin[0] - $fec_ini[0])*12 + ($fec_fin[1] - $fec_ini[1]);
$dias2 = $fec_fin[2] - $fec_ini[2];
if ($dias2 >0) $plazo_mes = $meses2 ." meses " . $dias2 ." dias "; else  $plazo_mes = $meses2 ." meses ";


//*******
 
$tabla="<table><tr><td>Holas esta es una tabla</td></tr></table>"; 
 
// Procesa la plantilla   
eval( '$rtf = <<<EOF_RTF
' . $plantilla . '
EOF_RTF;
' );
//OBTENIENDO EL NOMBRE  
$aleat = rand(10,50); 
$nombre_def = "Archivo_".$num_contrato.$aleat.".doc";   
file_put_contents($nombre_def,$rtf); 

if (!file_exists ($nombre_def))
{   
	echo "Ocurrio un error al generar el documento de word correspondiente";   
}else{   
	$aleatorio = rand(1, 10000000);   
	$hash_is = md5($aleatorio);   
	$carpeta = $hash_is;   
	mkdir("$carpeta",0777);   
	$nuevoarchivo = "$carpeta/$nombre_def";   
	if (!copy($nombre_def, $nuevoarchivo)) 
	{   
		echo "Ocurrio un error al generar el documento de word Temporal correspondiente";   
	}   
	$path_a_tu_doc = "$carpeta";   
	$enlace = $path_a_tu_doc."/".$nombre_def;
	header ("Pragma: no-cache");
	header ("Content-Type: application/msword");
	header ("Content-Disposition: attachment; filename=".$nombre_def."\n\n");  
	header ("Content-Length: ".filesize($enlace));   
	readfile($enlace);      
}  
//ELIMINA ARCHIVO   
unlink($enlace);   
unlink($nombre_def);   
//ELIMINA DIRECTORIO   
rmdir($path_a_tu_doc);
}else{ 
   echo "No existe una plantilla definida para el contrato seleccionado : $plant1"; 
} 

?>
