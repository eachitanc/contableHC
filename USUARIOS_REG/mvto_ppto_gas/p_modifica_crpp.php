<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
<style type="text/css">
<!--
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
.Estilo9 {font-size: 10px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
-->
</style>
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />

<?

include('../config.php');

// conexion             
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $idxx=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}



// llegada de campos

$contador = $_POST['contador']; //printf("contador : %s<br>",$contador);

$id_cdpp = $_POST['id_auto_cdpp'];



//**************** independizar registros *********

$a=0;
for($i1=0 ; $i1 < $contador; $i1++)
{
$vr1=$_POST['vr_digitado'.$i1];  //printf("vr_digitado ".$i." : %.2f<br>",$vr_digitado);
$a=$a+$vr1;
}


$id_auto_crpp = $_POST['id_crpp']; //echo $id_auto_crpp;
for($i=0 ; $i < $contador; $i++)
{
    $id_manu_crpp = 'CRPP'.$_POST['crpp']; //printf("id manu crpp : %s<br>",$id_manu_crpp);
    $fecha_crpp = $_POST['fecha_crpp']; //printf("fecha crpp : %s<br>",$fecha_crpp);
    
    $id_manu_cdpp = 'CDPP'.$_POST['id_manu_cdpp']; //printf("id manu cdpp : %s<br>",$id_manu_cdpp);
    $id_auto_cdpp = $_POST['id_auto_cdpp']; //printf("id auto cdpp : %s<br>",$id_auto_cdpp);
    $fecha_cdpp = $_POST['fecha_cdpp']; //printf("fecha cdpp : %s<br>",$fecha_cdpp);
    $ter_nat = $_POST['ter_nat']; //printf("ter nat : %s<br>",$ter_nat);
    $ter_jur = $_POST['ter_jur']; //printf("ter_jur : %s<br>",$ter_jur);
    // consulta tercero nat
    $sqla = "select * from terceros_naturales where id_emp ='$id_emp' and id ='$ter_nat'";
    $resultadoa = mysql_db_query($database, $sqla, $connectionxx);
    
    while($rowa = mysql_fetch_array($resultadoa)) 
    {
      $pri_ape=$rowa["pri_ape"];
      $seg_ape=$rowa["seg_ape"];
      $pri_nom=$rowa["pri_nom"];
      $seg_nom=$rowa["seg_nom"];
    }
    $natural = $pri_ape." ".$seg_ape." ".$pri_nom." ".$seg_nom;
    $nat_com = $natural;
    //printf("%s",$nat_com);
    
    // consulta tercero jur
    $sqla = "select * from terceros_juridicos where id_emp ='$id_emp' and id ='$ter_jur'";
    $resultadoa = mysql_db_query($database, $sqla, $connectionxx);
    
    while($rowa = mysql_fetch_array($resultadoa)) 
    {
      $raz_soc=$rowa["raz_soc2"];
    }
    //printf("%s",$raz_soc);
    $tercero = $nat_com.$raz_soc; //printf("tercero : %s<br>",$tercero);
    $des_cdpp = $_POST['des_cdpp']; //printf("des cdpp : %s<br>",$des_cdpp);
    $total = $_POST['total']; //printf("total: %.2f<br>",$total);
    
    $contrato= $_POST['contrato'];
	$adicion= $_POST['adicion'];
    $t_humano = $_POST['t_humano'];
    $inversion = $_POST['inversion'];
    $subsidiado = $_POST['subsidiado'];
    $pago = $_POST['pago'];
	$n_contrato = $_POST['n_contrato'];
    $situacion=$_POST['situacion'.$i];  //printf("situacion de fondos ".$i." : %s<br>",$situacion);
    
    $detalle_crpp =strtoupper( $_POST['detalle_crpp']);
    
    $pgcp1 = $_POST['pgcp1'];
    $pgcp2 = $_POST['pgcp2'];
    $pgcp3 = $_POST['pgcp3'];
    $pgcp4 = $_POST['pgcp4'];
    $pgcp5 = $_POST['pgcp5'];
    $pgcp6 = $_POST['pgcp6'];
    $pgcp7 = $_POST['pgcp7'];
    $pgcp8 = $_POST['pgcp8'];
    $pgcp9 = $_POST['pgcp9'];
    $pgcp10 = $_POST['pgcp10'];
    $pgcp11 = $_POST['pgcp11'];
    $pgcp12 = $_POST['pgcp12'];
    $pgcp13 = $_POST['pgcp13'];
    $pgcp14 = $_POST['pgcp14'];
    $pgcp15 = $_POST['pgcp15'];
    $des1 = $_POST['des1'];
    $des2 = $_POST['des2'];
    $des3 = $_POST['des3'];
    $des4 = $_POST['des4'];
    $des5 = $_POST['des5'];
    $des6 = $_POST['des6'];
    $des7 = $_POST['des7'];
    $des8 = $_POST['des8'];
    $des9 = $_POST['des9'];
    $des10 = $_POST['des10'];
    $des11 = $_POST['des11'];
    $des12 = $_POST['des12'];
    $des13 = $_POST['des13'];
    $des14 = $_POST['des14'];
    $des15 = $_POST['des15'];
    $vr_deb_1 = $_POST['vr_deb_1']+0;
    $vr_deb_2 = $_POST['vr_deb_2']+0;
    $vr_deb_3 = $_POST['vr_deb_3']+0;
    $vr_deb_4 = $_POST['vr_deb_4']+0;
    $vr_deb_5 = $_POST['vr_deb_5']+0;
    $vr_deb_6 = $_POST['vr_deb_6']+0;
    $vr_deb_7 = $_POST['vr_deb_7']+0;
    $vr_deb_8 = $_POST['vr_deb_8']+0;
    $vr_deb_9 = $_POST['vr_deb_9']+0;
    $vr_deb_10 = $_POST['vr_deb_10']+0;
    $vr_deb_11 = $_POST['vr_deb_11']+0;
    $vr_deb_12 = $_POST['vr_deb_12']+0;
    $vr_deb_13 = $_POST['vr_deb_13']+0;
    $vr_deb_14 = $_POST['vr_deb_14']+0;
    $vr_deb_15 = $_POST['vr_deb_15']+0;
    $vr_cre_1 = $_POST['vr_cre_1']+0;
    $vr_cre_2 = $_POST['vr_cre_2']+0;
    $vr_cre_3 = $_POST['vr_cre_3']+0;
    $vr_cre_4 = $_POST['vr_cre_4']+0;
    $vr_cre_5 = $_POST['vr_cre_5']+0;
    $vr_cre_6 = $_POST['vr_cre_6']+0;
    $vr_cre_7 = $_POST['vr_cre_7']+0;
    $vr_cre_8 = $_POST['vr_cre_8']+0;
    $vr_cre_9 = $_POST['vr_cre_9']+0;
    $vr_cre_10 = $_POST['vr_cre_10']+0;
    $vr_cre_11 = $_POST['vr_cre_11']+0;
    $vr_cre_12 = $_POST['vr_cre_12']+0;
    $vr_cre_13 = $_POST['vr_cre_13']+0;
    $vr_cre_14 = $_POST['vr_cre_14']+0;
    $vr_cre_15 = $_POST['vr_cre_15']+0;
    $tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15;
    $tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15; 
    
$tot_deb_a = number_format($tot_deb,2,',','.'); 
$tot_cre_a = number_format($tot_cre,2,',','.'); 
    
    $vr_orig=$_POST['vr_orig_cdpp'.$i];  //printf("vr_orig_cdpp ".$i." : %.2f<br>",$vr_orig_cdpp);
    $vr_digitado=$_POST['vr_digitado'.$i]; // printf("vr_digitado ".$i." : %.2f<br>",$vr_digitado);
    
            // vigencia fiscal
                         
            $consultax=mysql_query("select * from vf ",$connectionxx);
            while($rowx = mysql_fetch_array($consultax)) 
            {    $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
            } 


            // tipo de dato de los pgcp
            // consulta tipo_dato de pgcp
            $sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
            $resultadoa = mysql_db_query($database, $sqla, $connectionxx);
            while($rowa = mysql_fetch_array($resultadoa)) 
            {  $tipa=$rowa["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
            $resultadob = mysql_db_query($database, $sqlb, $connectionxx);
            while($rowb = mysql_fetch_array($resultadob)) 
            {  $tipb=$rowb["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
            $resultadoc = mysql_db_query($database, $sqlc, $connectionxx);
            while($rowc = mysql_fetch_array($resultadoc)) 
            {  $tipc=$rowc["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
            $resultadod = mysql_db_query($database, $sqld, $connectionxx);
            while($rowd = mysql_fetch_array($resultadod)) 
            {  $tipd=$rowd["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
            $resultadoe = mysql_db_query($database, $sqle, $connectionxx);
            while($rowe = mysql_fetch_array($resultadoe)) 
            {  $tipe=$rowe["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
            $resultadof = mysql_db_query($database, $sqlf, $connectionxx);
            while($rowf = mysql_fetch_array($resultadof)) 
            {  $tipf=$rowf["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
            $resultadog = mysql_db_query($database, $sqlg, $connectionxx);
            while($rowg = mysql_fetch_array($resultadog)) 
            {  $tipg=$rowg["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
            $resultadoh = mysql_db_query($database, $sqlh, $connectionxx);
            while($rowh = mysql_fetch_array($resultadoh)) 
            {  $tiph=$rowh["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
            $resultadoi = mysql_db_query($database, $sqli, $connectionxx);
            while($rowi = mysql_fetch_array($resultadoi)) 
            {  $tipi=$rowi["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
            $resultadoj = mysql_db_query($database, $sqlj, $connectionxx);
            while($rowj = mysql_fetch_array($resultadoj)) 
            {  $tipj=$rowj["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
            $resultadok = mysql_db_query($database, $sqlk, $connectionxx);
            while($rowk = mysql_fetch_array($resultadok)) 
            {  $tipk=$rowk["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
            $resultadol = mysql_db_query($database, $sqll, $connectionxx);
            while($rowl = mysql_fetch_array($resultadol)) 
            {  $tipl=$rowl["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
            $resultadom = mysql_db_query($database, $sqlm, $connectionxx);
            while($rowm = mysql_fetch_array($resultadom)) 
            {  $tipm=$rowm["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
            $resultadon = mysql_db_query($database, $sqln, $connectionxx);
            while($rown = mysql_fetch_array($resultadon)) 
            {  $tipn=$rown["tip_dato"]; }
            // consulta tipo_dato de pgcp
            $sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
            $resultadoo = mysql_db_query($database, $sqlo, $connectionxx);
            while($rowo = mysql_fetch_array($resultadoo)) 
            {  $tipo=$rowo["tip_dato"]; }


// inicio del bloque

if ($fecha_crpp == '' or $id_manu_crpp == 'CRPP' )
{
    
    printf("<br><br><center class='Estilo9'><b>NO</b> debe dejar casillas del Certificado de Registro Presupuestal sin diligenciar<BR><BR>");
    
}
else
{
        if($fecha_crpp > $bx or $fecha_crpp < $ax)
        {
        printf("<br><br><center class='Estilo9'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
        
        }
        else
        { 

                if($fecha_crpp < $fecha_cdpp)
                {
                printf("<br><br><center class='Estilo9'>La Fecha del Registro Presupuestal <b>ES MENOR</b> a la fecha de la Disponibilidad Presupuestal<BR><BR>");
                
                }
                else
                { 

                        if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M'))
                    {
                    printf("<br><br><center class='Estilo9'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>");
                    
                    }
                    else
                    {
                        /*if($tot_deb_a != $tot_cre_a)
                          {
                            printf("<br><br><center class='Estilo9'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y Credito 
                            (...::: ".$tot_cre." :::...) del movimiento                     
                            <br><br>
                            <b>NO COINCIDEN</b> <BR><BR>"
                            );
                                
                          }
                         else
                          {
                                if(($tot_deb_a != $a) or ($tot_cre_a != $a) )
                                  {
                                    printf("<br><br><center class='Estilo9'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb." :::...) y / o Credito 
                                    (...::: ".$tot_cre." :::...) del movimiento                     
                                    <br><br>
                                    <b>NO COINCIDEN</b> con el valor TOTAL que desea Registrar (...::: ".$a." :::...) <br><br>"
                                    );
                                        
                                  }
                                 else
                                  {
                                  */
                                  
                                  // inserto nuevo crpp
                                  
                                        $cuenta=$_POST['cuenta'.$i];
                                  
                                        $sql = "update crpp set  
                                    
                                        id_emp= '$id_emp', id_auto_crpp='$id_auto_crpp', id_manu_crpp='$id_manu_crpp', fecha_crpp='$fecha_crpp', id_manu_cdpp='$id_manu_cdpp' , id_auto_cdpp='$id_auto_cdpp',
                                        fecha_cdpp= '$fecha_cdpp', tercero='$tercero', ter_nat='$ter_nat', ter_jur='$ter_jur', ced_nat='', ced_jur='', 
                                        des_cdpp=  '$des_cdpp', total='$total', contrato='$contrato', adicion='$adicion', t_humano='$t_humano', inversion='$inversion', subsidiado='$subsidiado', pago='$pago', situacion='$situacion' ,
                                        
                                        pgcp1='$pgcp1' , pgcp2='$pgcp2' , pgcp3='$pgcp3' , pgcp4='$pgcp4' , pgcp5='$pgcp5' , pgcp6='$pgcp6' , pgcp7='$pgcp7' , pgcp8='$pgcp8' , pgcp9='$pgcp9' , pgcp10='$pgcp10' , pgcp11='$pgcp11' , pgcp12='$pgcp12' , pgcp13='$pgcp13' , pgcp14='$pgcp14' , pgcp15='$pgcp14' , 
                                        des1='$des1' , des2='$des2' , des3='$des3' , des4='$des4' , des5='$des5' , des6='$des6' , des7='$des7' , des8='$des8' , des9='$des9' , des10='$des10' , des11='$des11' , des12='$des12' , des13='$des13' , des14='$des14' , des15='$des15' , 
                                        vr_deb_1='$vr_deb_1' , vr_deb_2='$vr_deb_2' , vr_deb_3='$vr_deb_3' , vr_deb_4='$vr_deb_4' , vr_deb_5='$vr_deb_5' , vr_deb_6='$vr_deb_6' , vr_deb_7='$vr_deb_7' , vr_deb_8='$vr_deb_8' , vr_deb_9='$vr_deb_9' , 
                                        vr_deb_10='$vr_deb_10' , vr_deb_11='$vr_deb_11' , vr_deb_12='$vr_deb_12' , vr_deb_13='$vr_deb_13' , vr_deb_14='$vr_deb_14' , vr_deb_15='$vr_deb_15' , 
                                        vr_cre_1='$vr_cre_1' , vr_cre_2='$vr_cre_2' , vr_cre_3='$vr_cre_3' , vr_cre_4='$vr_cre_4' , vr_cre_5='$vr_cre_5' , vr_cre_6='$vr_cre_6' , vr_cre_7='$vr_cre_7' , vr_cre_8='$vr_cre_8' , vr_cre_9='$vr_cre_9' , 
                                        vr_cre_10='$vr_cre_10' , vr_cre_11='$vr_cre_11' , vr_cre_12='$vr_cre_12' , vr_cre_13='$vr_cre_13' , vr_cre_14='$vr_cre_14' , vr_cre_15='$vr_cre_15' , 
                                        tot_deb='$tot_deb', tot_cre='$tot_cre', vr_orig='$vr_orig', vr_digitado='$vr_digitado', cuenta='$cuenta', detalle_crpp='$detalle_crpp',n_contrato='$n_contrato' where  id_auto_crpp = '$id_auto_crpp' and liq1 ='' and cuenta='$cuenta'" ; 
                                                                                                               
                                        mysql_query($sql, $connectionxx) or die(mysql_error());
$paso ='1';

                                        //** 1.- saco de cdpp el vr_obligado hasta la fecha 2.- le sumo el vr_digitado 3.- actualizo nuevamente
                                        //1
                                        $sqlxx = "select * from cdpp 
                                        where id_emp ='$id_emp' and consecutivo ='$id_cdpp' and cuenta ='$cuenta' and valor ='$vr_orig'";
                                        $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
                                        while($rowxx = mysql_fetch_array($resultadoxx))
                                        {$vr_obligado=$rowxx["vr_obligado"];}
                                        //2
                                        $nuevo_vr_obligado=$vr_obligado+$vr_digitado;
                                        //3
                                        $sql2 = "update cdpp set vr_obligado='$nuevo_vr_obligado' 
                                        where id_emp = '$id_emp' and consecutivo = '$id_auto_cdpp' and cuenta ='$cuenta' and valor ='$vr_orig' ";
                                        $resultado2 = mysql_db_query($database, $sql2, $connectionxx);

        
        
//}
//} 
}   
}
}
}


}// fin for
if ($paso == '1')
{
	if ($contrato =='SI')
	{
		$ver_contrato ="<a href='../contratacion/index.php?fec=$fecha_crpp&ruta=CRPP' target='_blank'><img src='../simbolos/contrato.png' border='0' /></a>";
		$concepto_cont ="Contratar";
	}	
?>
<center><img src='../simbolos/ok.png' width='32' height='32' /></center>
<br />
<center>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">REGISTRO MODIFICADO CON EXITO <?php print $anno; ?></div>
<br />
</center>
<br />
<?	
}


//sacar total de vr_obligado y comparar con total de valor, si son =0 -> contab = si

$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(valor) AS TOTAL from cdpp WHERE id_emp='$id_emp' and consecutivo = '$id_cdpp'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total=$row[0]; 
$tot_vr_obligado = $total;

$resulta2=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE id_emp='$id_emp' and id_auto_cdpp = '$id_cdpp'",$link) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$total2=$row2[0]; 
$tot_vr = $total2;

if($tot_vr == $tot_vr_obligado)
{

	$sql3 = "update cdpp set contab='SI' where id_emp = '$id_emp' and consecutivo = '$id_cdpp'";
	$resultado3 = mysql_db_query($database, $sql3, $connectionxx);

}
// verificar el valor registrado con el valor del cdpp si primero menor cdpp contab no
if ($tot_vr_obligado > $tot_vr)
{
	$sql3 = "update cdpp set contab='NO' where id_emp = '$id_emp' and consecutivo = '$id_cdpp'";
	$resultado3 = mysql_db_query($database, $sql3, $connectionxx);	
}



printf("

<center class='Estilo4'>
<br><br>
<form method='post' action='mvto.php'>
<input type='hidden' name='nn' value='CRPP'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");


                
        
?>


<?
}
?>