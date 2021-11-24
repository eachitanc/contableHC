<?php
// funcion que lee el archivo rtf
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header('Content-Type: text/html; charset=latin1'); 
setlocale(LC_TIME, 'Spanish');
// Variables que llegan del reporte
$contrato =$_GET['cont'];
$planilla =$_GET['proc'];
function leef($fichero)
{
$texto= file($fichero);
$tamleef = sizeof($texto);
for ($n=0; $n<$tamleef;$n++)
{
	 $todo = $todo.$texto[$n];
}
return $todo;
}
function rtf($sql, $plantilla, $fsalida, $matequivalencias, $contrato)
{
	include('../config.php');
	$pre=time();
	$fsalida="C:/Users/Usuario/Desktop/".$pre.$fsalida;
	$link=mysql_connect("$server","$dbuser","$dbpass");
	$txtplantilla=leef($plantilla);
	// toma todos los datos del archivo cargado del archivo RTF
	$matriz=explode("sectd",$txtplantilla);
	$cabecera=$matriz[0]."sectd";
	$inicio=strlen($cabecera);
	$final=strrpos($txtplantilla,"}"
	);
	$largo=$final-$inicio;
	$cuerpo=substr($txtplantilla,$inicio,$largo);
	$clausulas=explode("|",$cuerpo); // separa el cuerpo del archivo en partes divididas por |
	$punt = fopen($fsalida ,"w");
	fputs($punt,$cabecera);
	mysql_select_db("$database",$link);
	$result=mysql_query($sql,$link);
	/*while($row=mysql_fetch_array($result))
	{
		$despues=$cuerpo; // toma el mismo cuerpo para hacer varios registros dependiendo de la consulta
		foreach($matequivalencias as $dato) // meteequivlaencias es el array de equivalencias
		{
			$datosql=$row[$dato[1]];
			$datosql=stripslashes($datosql);
			$datortf=$dato[0];
			$despues=str_replace($datortf,$datosql,$despues); // este es el archivo que remplaza lso datos requeridos ingresar
		}
		fputs($punt,$despues);
		$saltopag="par page par";
		fputs($punt,$saltopag);
	}*/
	// puedo hacer consultas tomar el archivo y remplazar directamente
	$sql ="select * from contrataciones2 where num_contrato ='$contrato'";
	$res =mysql_query($sql,$link);
	$rw2 = mysql_fetch_array($res);
	// Consulto datos de la obligación presupuestal
	$sq3="select * from cobp where id_auto_crpp ='$rw2[id_auto_crpp]'";
	$re3 =mysql_query($sq3,$link);
	$rw3 = mysql_fetch_array($re3);
	$fec_inicio = strftime("%B %d de %Y",strtotime("$rw2[fec_firma]"));
	$fec_fin = strftime("%B %d de %Y",strtotime("$rw2[fecha_terminacion]"));
	$valor_inicial = number_format($rw2["valor_inicial"],2,',','.');
	include('enletras.php');
	$V = new EnLetras();
	$valor_letras= $V->ValorEnLetras($rw2["valor_inicial"],"PESOS");
	//  Valor ejecutado y pagado
	$sq4 ="select sum(vr_digitado) as ejecutado from cobp where id_auto_crpp ='$rw2[id_auto_crpp]' group by id_auto_crpp";
	$re4 =mysql_query($sq4,$link);
	$rw4=mysql_fetch_array($re4);
	$sq5 ="select sum(vr_digitado) as pagado from cobp where id_auto_crpp ='$rw2[id_auto_crpp]' and pagado ='SI' group by id_auto_crpp";
	$re5 =mysql_query($sq5,$link);
	$rw5=mysql_fetch_array($re5);
	$sq6 ="select sum(vr_digitado) as liquidado from cobp where id_auto_crpp ='$rw2[id_auto_crpp]' and liq ='SI' group by id_auto_crpp";
	$re6 =mysql_query($sq6,$link);
	$rw6=mysql_fetch_array($re6);
	$afavor = $rw4['ejecutado'] - $rw5['pagado'];
	$fecha_acta =date('Y/m/d');
	$fec_larga = strftime("%d dias del mes de %B de %Y",strtotime("$fecha_acta"));
	// llenado array
	$equiv[0][0]="#*contrato*#";
	$equiv[0][1]=$rw2['num_contrato'];
	$equiv[1][0]="#*objeto*#";
	$equiv[1][1]=$rw2['objeto'];
	$equiv[2][0]="#*fecha*#";
	$equiv[2][1]=$rw2['fec_registro'];
	$equiv[3][0]="#*ter*#";
	$equiv[3][1]=$rw3['tercero'];
	$equiv[4][0]="#*inicio*#";
	$equiv[4][1]=$fec_inicio;
	$equiv[5][0]="#*fin*#";
	$equiv[5][1]=$fec_fin;
	$equiv[6][0]="#*valor*#";
	$equiv[6][1]=$valor_inicial;
	$equiv[7][0]="#*letras*#";
	$equiv[7][1]=$valor_letras;
	$equiv[8][0]="#*plazo*#";
	$equiv[8][1]=$rw2['plazo_contrato'];
	$equiv[9][0]="#*ejecutado*#";
	$equiv[9][1]=number_format($rw4['ejecutado'],2,',','.');
	$equiv[10][0]="#*pagado*#";
	$equiv[10][1]=number_format($rw5['pagado'],2,',','.');
	$equiv[11][0]="#*afavor*#";
	$equiv[11][1]=number_format($afavor,2,',','.');
	$equiv[12][0]="#*liquidado*#";
	$equiv[12][1]=number_format($rw6['liquidado'],2,',','.');
	$equiv[13][0]="#*ccnit*#";
	$equiv[13][1]=$rw3['ccnit'];
	$equiv[14][0]="#*fec_larga*#";
	$equiv[14][1]=$fec_larga;
	//print_r ($equiv). "<br>";
	// como las remplazo en el campo de insesion
	$despues=$cuerpo;
	$cont=0;
	foreach($equiv as $dato) // equiv es el array de equivalencias
		{
			$cont++;
			$datosql=$dato[1];
			$datosql=stripslashes($datosql);
			$datortf=$dato[0];
			$despues=str_replace($datortf,$datosql,$despues); // este es el archivo que remplaza lso datos requeridos ingresar
		}
	fputs($punt,$despues);
	// ******   Inicio de tabla
/*
	$output.= "{\\rtf1\\ansi\\deff0
	\\trowd\\trgaph144\\b
	\\clbrdrt\\brdrs\\clbrdrl\\brdrs\\clbrdrb\\brdrs\\clbrdrr\\brdrs
	\\cellx1000
	\\clbrdrt\\brdrs\\clbrdrl\\brdrs\\clbrdrb\\brdrs\\clbrdrr\\brdrs
	\\cellx2000
	\\clbrdrt\\brdrs\\clbrdrl\\brdrs\\clbrdrb\\brdrs\\clbrdrr\\brdrs
	\\cellx3000
	\\intbl Titulo uno\\cell
	\\intbl Titulo uno\\cell
	\\intbl Titulo uno\\cell
	\\b0
	\\row
	\\trowd\\trgaph144
	\\clbrdrt\\brdrs\\clbrdrl\\brdrs\\clbrdrb\\brdrs\\clbrdrr\\brdrs
	\\cellx1000
	\\clbrdrt\\brdrs\\clbrdrl\\brdrs\\clbrdrb\\brdrs\\clbrdrr\\brdrs
	\\cellx2000
	\\clbrdrt\\brdrs\\clbrdrl\\brdrs\\clbrdrb\\brdrs\\clbrdrr\\brdrs
	\\cellx3000
	\\intbl cell 1\\cell
	\\intbl cell 2\\cell
	\\intbl cell 3\\cell
	\\row
	} ";
	// ***************** Fin de tabla
	fputs($punt,$output);
	// *************************** fin de la tabla
*/	
	fputs($punt,"}");
	fclose($punt);
	return $fsalida;
}
$plantilla= $planilla.".rtf";
$sql ="select * from contrataciones2 where num_contrato ='$contrato'";
$equivalencia[0][0]="#*objeto22*#";
$equivalencia[0][1]="num_contrato";
$salida=rtf($sql,$plantilla,"certificado.rtf",$equivalencia,$contrato);
$salida="<A href='$salida'>Obtener</A>";
echo("<p>$salida</p>");
?>