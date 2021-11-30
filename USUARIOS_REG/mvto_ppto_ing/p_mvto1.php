<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	$id_manu_reip = strtoupper('REIP' . $_POST['id_manu_reip']);
	$consecutivo = 'REIP' . $_POST['consecutivo'];
	$fecha_reg = $_POST['fecha_reg'];
	$ter_nat = $_POST['ter_nat'];
	$ter_jur = isset($_POST['ter_jur']) ? $_POST['ter_jur'] : '';
	$des = $_POST['des'];
	$cuenta = $_POST['cuenta'];
	$valor = $_POST['valor'];
	$pri_ape = '';
	$seg_ape = '';
	$pri_nom = '';
	$seg_nom = '';



	/*
printf(
"
consecutivo: %s<br>fecha_reg: %s<br>ter_nat: %s<br>ter_jur: %s<br>des: %s<br><br>

cta: %s<br>vr: %s

"

,$consecutivo,$fecha_reg,$ter_nat,$ter_jur,$des

,$cuenta, $valor

);
*/

	include('../config.php');

	// conexion				
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

	// id_emp
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);

	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
	}

	// consulta ppto
	$sql = "select * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
	$resultado = $connectionxx->query($sql);;
	$definitivo = 0;
	while ($row = $resultado->fetch_assoc()) {
		$tip_dato = $row["tip_dato"];
		$definitivo = $row["definitivo"];
		$nom_rubro = $row["nom_rubro"];
	}
	// consulta tercero nat
	$sqla = "select * from terceros_naturales where id_emp ='$id_emp' and id ='$ter_nat'";
	$resultadoa = $connectionxx->query($sqla);

	while ($rowa = $resultadoa->fetch_assoc()) {
		$pri_ape = $rowa["pri_ape"];
		$seg_ape = $rowa["seg_ape"];
		$pri_nom = $rowa["pri_nom"];
		$seg_nom = $rowa["seg_nom"];
	}
	$natural = $pri_ape . " " . $seg_ape . " " . $pri_nom . " " . $seg_nom;
	$nat_com = $natural;
	//printf("%s",$nat_com);

	// consulta tercero jur
	$sqla = "select * from terceros_juridicos where id_emp ='$id_emp' and id ='$ter_jur'";
	$resultadoa = $connectionxx->query($sqla);
	$rowa = $resultadoa->fetch_assoc();
	if (!empty($rowa)) {
		$raz_soc = $rowa["raz_soc2"];
	} else {
		$raz_soc = '';
	}

	//union de terceros

	$tercero = $nat_com . $raz_soc;

	// vigencia fiscal

	$consultax = $connectionxx->query("select * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"];
		$bx = $rowx["fecha_fin"];
	}


	// calculos


	$link = new mysqli($server, $dbuser, $dbpass, $database);
	$resulta = $link->query("select SUM(valor) AS TOTAL from reip_ing WHERE id_emp ='$id_emp' and cuenta ='$cuenta'");
	$row = $resulta->fetch_array();
	$total = $row[0];
	$total_recaudado = $total;


	$resultb = $link->query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE id_emp ='$id_emp' and cuenta ='$cuenta'");
	$rowb = $resultb->fetch_array();
	if (!empty($rowb)) {
		$total_recaudado_ncbt = $rowb[0];
	} else {
		$total_recaudado_ncbt = 0;
	}

	$todo_lo_recaudado = $total_recaudado + $total_recaudado_ncbt;


	$vr_eval = $total_recaudado +  $total_recaudado_ncbt +  $valor;


	$saldox = $definitivo - $todo_lo_recaudado;



	$sqlx = "update reip_ing set saldo='$saldox' where id_emp= '$id_emp' and cuenta ='$cuenta' ";
	$resultado = $connectionxx->query($sqlx);



	// inicio del bloque
	/*if($vr_eval > $definitivo)
{
printf("<br><br><center class='Estilo4'>El <b>SALDO</b> disponible para realizar <B>RECONOCIMIENTOS</B> a la cuenta <b>".$cuenta."</b>  es <br><br>...::: ".$saldox." :::...<BR><BR><b>NO</b> puede hacer <b>RECONOCIMIENTOS</b> por un valor superior al indicado<BR><BR>Verifique su Informacion<br><br><br>");
printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
}
else
{*/
	if (($ter_nat == '' and $ter_jur == '') or $des == '' or $valor == '') {
		printf("<br><br><center class='Estilo4'><b>NO</b> debe dejar casillas del Reconocimiento sin diligenciar<BR><BR>");
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
	} else {
		if ($fecha_reg > $bx or $fecha_reg < $ax) {
			printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
			printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
		} else {
			if ($tip_dato == 'M') {
				printf("<br><br><center class='Estilo4'>NO DEBE REALIZAR RECONOCIMIENTOS A CUENTAS DE TIPO MAYOR<BR><BR>");
				printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; 
	  width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
			} else {
				/*	    if ($definitivo < $valor)
		{
	  		$excede = $valor - $definitivo;
			printf("<br><br><center class='Estilo4'>EL VALOR DEL RECONOCIMIENTO EXCEDE EN ...:::<B> $".$excede."</B>= :::... EL 
			VALOR DEFINITIVO DE
			 LA CUENTA<BR><BR>");
			printf("<center class='Estilo4'>VERIFIQUE SU INFORMACION<BR><BR>");
			printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>"); 
		}
		else
		{*/

				$saldo = ($definitivo - $total_recaudado) - $valor;

				$sql = "INSERT INTO reip_ing ( 
				id_emp , consecutivo , fecha_reg , ter_nat, ter_jur , des , cuenta , 
				nom_rubro , valor, nat_com , jur_com, contab, tercero, definitivo, vr_recaudado, recaudo_completo , elim_cont, id_manu_reip
				) VALUES ( 
				'$id_emp','$consecutivo','$fecha_reg','$ter_nat', 
				'$ter_jur','$des','$cuenta','$nom_rubro','$valor',
				'$nat_com','$raz_soc','NO','$tercero','$definitivo','0','NO','0', '$id_manu_reip')";


				$connectionxx->query($sql);



				$sqlx = "update reip_ing set saldo='$saldo' where id_emp= '$id_emp' and cuenta ='$cuenta' ";
				$resultado = $connectionxx->query($sqlx);


				printf("<br><br><center class='Estilo4'>DATOS ALMACENADOS CON EXITO<BR><BR>");
				printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; 
			background:#004080; 
			width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='mvto.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
			}
		}
		//}	
		//}	
	}
?>


<?php
}
?>
<style type="text/css">
	<!--
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
	-->
</style>