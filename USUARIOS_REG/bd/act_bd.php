<?php
set_time_limit(150);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	// verifico permisos del usuario
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
	$sql = "SELECT confi FROM usuarios2 where login = '$_SESSION[login]'";
	$res =  $cx->query($sql);
	$rw = $res->fetch_assoc();
	if ($rw['confi'] == 'SI') {
?>

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
<?php
		//printf("<b><center class='Estilo1'> LISTA DE ACTUALIZACIONES HECHAS A LA BASE DE DATOS</center></b>");
		include('../config.php');
		$conexion = new mysqli($server, $dbuser, $dbpass, $database);


		//**********************adiciona campo tabla cdpp
		$tabla = " cdpp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `fecha_ven` VARCHAR(10) NOT NULL AFTER `fecha_reg`";

		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//**********************adiciona campo tabla usuarios2
		$tabla = " usuarios2";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `crea` VARCHAR(2) NOT NULL , 
ADD `edita` VARCHAR(2) NOT NULL ,
ADD `elimina` VARCHAR(2) NOT NULL ,
ADD `impri` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//**********************adiciona campo empresa
		$tabla = " empresa";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `cargo_ppto` VARCHAR( 200 ) NOT NULL AFTER `tp_ctrl_int`";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** adiciona campos a conta_ncon
		$tabla = " conta_cesp";
		$anadir = "ALTER TABLE ";
		$anadir .= $tabla;
		$anadir .= " ADD pgcp16 VARCHAR(200) not null , ADD pgcp17 VARCHAR(200) not null , ADD pgcp18 VARCHAR(200) not null , ADD pgcp19 VARCHAR(200) not null , ADD pgcp20 VARCHAR(200) not null , ADD pgcp21 VARCHAR(200) not null , ADD pgcp22 VARCHAR(200) not null , ADD pgcp23 VARCHAR(200) not null , ADD pgcp24 VARCHAR(200) not null , ADD pgcp25 VARCHAR(200) not null , ADD pgcp26 VARCHAR(200) not null , ADD pgcp27 VARCHAR(200) not null , ADD pgcp28 VARCHAR(200) not null , ADD pgcp29 VARCHAR(200) not null , ADD pgcp30 VARCHAR(200) not null , ADD pgcp31 VARCHAR(200) not null , ADD pgcp32 VARCHAR(200) not null , ADD pgcp33 VARCHAR(200) not null , ADD pgcp34 VARCHAR(200) not null , ADD pgcp35 VARCHAR(200) not null , ADD pgcp36 VARCHAR(200) not null , ADD pgcp37 VARCHAR(200) not null , ADD pgcp38 VARCHAR(200) not null , ADD pgcp39 VARCHAR(200) not null , ADD pgcp40 VARCHAR(200) not null , ADD pgcp41 VARCHAR(200) not null , ADD pgcp42 VARCHAR(200) not null , ADD pgcp43 VARCHAR(200) not null , ADD pgcp44 VARCHAR(200) not null , ADD pgcp45 VARCHAR(200) not null , ADD pgcp46 VARCHAR(200) not null , ADD pgcp47 VARCHAR(200) not null , ADD pgcp48 VARCHAR(200) not null , ADD pgcp49 VARCHAR(200) not null , ADD pgcp50 VARCHAR(200) not null , ADD vr_deb_16 DECIMAL(20,2) not null , ADD vr_deb_17 DECIMAL(20,2) not null , ADD vr_deb_18 DECIMAL(20,2) not null , ADD vr_deb_19 DECIMAL(20,2) not null , ADD vr_deb_20 DECIMAL(20,2) not null , ADD vr_deb_21 DECIMAL(20,2) not null , ADD vr_deb_22 DECIMAL(20,2) not null , ADD vr_deb_23 DECIMAL(20,2) not null , ADD vr_deb_24 DECIMAL(20,2) not null , ADD vr_deb_25 DECIMAL(20,2) not null , ADD vr_deb_26 DECIMAL(20,2) not null , ADD vr_deb_27 DECIMAL(20,2) not null , ADD vr_deb_28 DECIMAL(20,2) not null , ADD vr_deb_29 DECIMAL(20,2) not null , ADD vr_deb_30 DECIMAL(20,2) not null , ADD vr_deb_31 DECIMAL(20,2) not null , ADD vr_deb_32 DECIMAL(20,2) not null , ADD vr_deb_33 DECIMAL(20,2) not null , ADD vr_deb_34 DECIMAL(20,2) not null , ADD vr_deb_35 DECIMAL(20,2) not null , ADD vr_deb_36 DECIMAL(20,2) not null , ADD vr_deb_37 DECIMAL(20,2) not null , ADD vr_deb_38 DECIMAL(20,2) not null , ADD vr_deb_39 DECIMAL(20,2) not null , ADD vr_deb_40 DECIMAL(20,2) not null , ADD vr_deb_41 DECIMAL(20,2) not null , ADD vr_deb_42 DECIMAL(20,2) not null , ADD vr_deb_43 DECIMAL(20,2) not null , ADD vr_deb_44 DECIMAL(20,2) not null , ADD vr_deb_45 DECIMAL(20,2) not null , ADD vr_deb_46 DECIMAL(20,2) not null , ADD vr_deb_47 DECIMAL(20,2) not null , ADD vr_deb_48 DECIMAL(20,2) not null , ADD vr_deb_49 DECIMAL(20,2) not null , ADD vr_deb_50 DECIMAL(20,2) not null , ADD vr_cre_16 DECIMAL(20,2) not null , ADD vr_cre_17 DECIMAL(20,2) not null , ADD vr_cre_18 DECIMAL(20,2) not null , ADD vr_cre_19 DECIMAL(20,2) not null , ADD vr_cre_20 DECIMAL(20,2) not null , ADD vr_cre_21 DECIMAL(20,2) not null , ADD vr_cre_22 DECIMAL(20,2) not null , ADD vr_cre_23 DECIMAL(20,2) not null , ADD vr_cre_24 DECIMAL(20,2) not null , ADD vr_cre_25 DECIMAL(20,2) not null , ADD vr_cre_26 DECIMAL(20,2) not null , ADD vr_cre_27 DECIMAL(20,2) not null , ADD vr_cre_28 DECIMAL(20,2) not null , ADD vr_cre_29 DECIMAL(20,2) not null , ADD vr_cre_30 DECIMAL(20,2) not null , ADD vr_cre_31 DECIMAL(20,2) not null , ADD vr_cre_32 DECIMAL(20,2) not null , ADD vr_cre_33 DECIMAL(20,2) not null , ADD vr_cre_34 DECIMAL(20,2) not null , ADD vr_cre_35 DECIMAL(20,2) not null , ADD vr_cre_36 DECIMAL(20,2) not null , ADD vr_cre_37 DECIMAL(20,2) not null , ADD vr_cre_38 DECIMAL(20,2) not null , ADD vr_cre_39 DECIMAL(20,2) not null , ADD vr_cre_40 DECIMAL(20,2) not null , ADD vr_cre_41 DECIMAL(20,2) not null , ADD vr_cre_42 DECIMAL(20,2) not null , ADD vr_cre_43 DECIMAL(20,2) not null , ADD vr_cre_44 DECIMAL(20,2) not null , ADD vr_cre_45 DECIMAL(20,2) not null , ADD vr_cre_46 DECIMAL(20,2) not null , ADD vr_cre_47 DECIMAL(20,2) not null , ADD vr_cre_48 DECIMAL(20,2) not null , ADD vr_cre_49 DECIMAL(20,2) not null , ADD vr_cre_50 DECIMAL(20,2) not null";



		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		//********************** adiciona campos a conta_ncon
		$tabla = " conta_cesp";
		$anadir = "ALTER TABLE ";
		$anadir .= $tabla;
		$anadir .= " ADD `cheque16` VARCHAR( 200 ) NOT NULL,
ADD `cheque17` VARCHAR( 200 ) NOT NULL,
ADD `cheque18` VARCHAR( 200 ) NOT NULL,
ADD `cheque19` VARCHAR( 200 ) NOT NULL,
ADD `cheque20` VARCHAR( 200 ) NOT NULL,
ADD `cheque21` VARCHAR( 200 ) NOT NULL,
ADD `cheque22` VARCHAR( 200 ) NOT NULL,
ADD `cheque23` VARCHAR( 200 ) NOT NULL,
ADD `cheque24` VARCHAR( 200 ) NOT NULL,
ADD `cheque25` VARCHAR( 200 ) NOT NULL,
ADD `cheque26` VARCHAR( 200 ) NOT NULL,
ADD `cheque27` VARCHAR( 200 ) NOT NULL,
ADD `cheque28` VARCHAR( 200 ) NOT NULL,
ADD `cheque29` VARCHAR( 200 ) NOT NULL,
ADD `cheque30` VARCHAR( 200 ) NOT NULL,
ADD `cheque31` VARCHAR( 200 ) NOT NULL,
ADD `cheque32` VARCHAR( 200 ) NOT NULL,
ADD `cheque33` VARCHAR( 200 ) NOT NULL,
ADD `cheque34` VARCHAR( 200 ) NOT NULL,
ADD `cheque35` VARCHAR( 200 ) NOT NULL,
ADD `cheque36` VARCHAR( 200 ) NOT NULL,
ADD `cheque37` VARCHAR( 200 ) NOT NULL,
ADD `cheque38` VARCHAR( 200 ) NOT NULL,
ADD `cheque39` VARCHAR( 200 ) NOT NULL,
ADD `cheque40` VARCHAR( 200 ) NOT NULL,
ADD `cheque41` VARCHAR( 200 ) NOT NULL,
ADD `cheque42` VARCHAR( 200 ) NOT NULL,
ADD `cheque43` VARCHAR( 200 ) NOT NULL,
ADD `cheque44` VARCHAR( 200 ) NOT NULL,
ADD `cheque45` VARCHAR( 200 ) NOT NULL,
ADD `cheque46` VARCHAR( 200 ) NOT NULL,
ADD `cheque47` VARCHAR( 200 ) NOT NULL,
ADD `cheque48` VARCHAR( 200 ) NOT NULL,
ADD `cheque49` VARCHAR( 200 ) NOT NULL,
ADD `cheque50` VARCHAR( 200 ) NOT NULL,
ADD `banco16` VARCHAR( 200 ) NOT NULL,
ADD `banco17` VARCHAR( 200 ) NOT NULL,
ADD `banco18` VARCHAR( 200 ) NOT NULL,
ADD `banco19` VARCHAR( 200 ) NOT NULL,
ADD `banco20` VARCHAR( 200 ) NOT NULL,
ADD `banco21` VARCHAR( 200 ) NOT NULL,
ADD `banco22` VARCHAR( 200 ) NOT NULL,
ADD `banco23` VARCHAR( 200 ) NOT NULL,
ADD `banco24` VARCHAR( 200 ) NOT NULL,
ADD `banco25` VARCHAR( 200 ) NOT NULL,
ADD `banco26` VARCHAR( 200 ) NOT NULL,
ADD `banco27` VARCHAR( 200 ) NOT NULL,
ADD `banco28` VARCHAR( 200 ) NOT NULL,
ADD `banco29` VARCHAR( 200 ) NOT NULL,
ADD `banco30` VARCHAR( 200 ) NOT NULL,
ADD `banco31` VARCHAR( 200 ) NOT NULL,
ADD `banco32` VARCHAR( 200 ) NOT NULL,
ADD `banco33` VARCHAR( 200 ) NOT NULL,
ADD `banco34` VARCHAR( 200 ) NOT NULL,
ADD `banco35` VARCHAR( 200 ) NOT NULL,
ADD `banco36` VARCHAR( 200 ) NOT NULL,
ADD `banco37` VARCHAR( 200 ) NOT NULL,
ADD `banco38` VARCHAR( 200 ) NOT NULL,
ADD `banco39` VARCHAR( 200 ) NOT NULL,
ADD `banco40` VARCHAR( 200 ) NOT NULL,
ADD `banco41` VARCHAR( 200 ) NOT NULL,
ADD `banco42` VARCHAR( 200 ) NOT NULL,
ADD `banco43` VARCHAR( 200 ) NOT NULL,
ADD `banco44` VARCHAR( 200 ) NOT NULL,
ADD `banco45` VARCHAR( 200 ) NOT NULL,
ADD `banco46` VARCHAR( 200 ) NOT NULL,
ADD `banco47` VARCHAR( 200 ) NOT NULL,
ADD `banco48` VARCHAR( 200 ) NOT NULL,
ADD `banco49` VARCHAR( 200 ) NOT NULL,
ADD `banco50` VARCHAR( 200 ) NOT NULL 
";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		//**********************adiciona campo empresa genero
		$tabla = " empresa";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `genero` VARCHAR(10) NOT NULL AFTER `control_doc`,
ADD `vencimiento` VARCHAR(2) NOT NULL,
ADD `cargo_rep_leg` VARCHAR(100) NOT NULL,
ADD `cargo_conta` VARCHAR(100) NOT NULL,
ADD `cargo_rev` VARCHAR(100) NOT NULL,
ADD `cargo_ci` VARCHAR(100) NOT NULL,
ADD `cargo_teso` VARCHAR(100) NOT NULL,
ADD `logo` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo referencia a crpp
		$tabla = " crpp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ref` VARCHAR(50) NOT NULL AFTER `contrato_control`";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo referencia a cdpp
		$tabla = " cdpp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ref` VARCHAR( 50 ) NOT NULL AFTER `vr_obligado`";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo referencia a terceros naturlaes
		$tabla = " terceros_naturales";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ref` VARCHAR( 50 ) NOT NULL AFTER `interventor`";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** adiciona campos a conta_ncon
		$tabla = " recaudo_rcgt";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `pgcp16` varchar(100) NOT NULL,
ADD `pgcp17` varchar(100) NOT NULL,
ADD `pgcp18` varchar(100) NOT NULL,
ADD `pgcp19` varchar(100) NOT NULL,
ADD `pgcp20` varchar(100) NOT NULL,
ADD `pgcp21` varchar(100) NOT NULL,
ADD `pgcp22` varchar(100) NOT NULL,
ADD `pgcp23` varchar(100) NOT NULL,
ADD `pgcp24` varchar(100) NOT NULL,
ADD `pgcp25` varchar(100) NOT NULL,
ADD `pgcp26` varchar(100) NOT NULL,
ADD `pgcp27` varchar(100) NOT NULL,
ADD `pgcp28` varchar(100) NOT NULL,
ADD `pgcp29` varchar(100) NOT NULL,
ADD `pgcp30` varchar(100) NOT NULL,
ADD `pgcp31` varchar(100) NOT NULL,
ADD `pgcp32` varchar(100) NOT NULL,
ADD `pgcp33` varchar(100) NOT NULL,
ADD `pgcp34` varchar(100) NOT NULL,
ADD `pgcp35` varchar(100) NOT NULL,
ADD `pgcp36` varchar(100) NOT NULL,
ADD `pgcp37` varchar(100) NOT NULL,
ADD `pgcp38` varchar(100) NOT NULL,
ADD `pgcp39` varchar(100) NOT NULL,
ADD `pgcp40` varchar(100) NOT NULL,
ADD `pgcp41` varchar(100) NOT NULL,
ADD `pgcp42` varchar(100) NOT NULL,
ADD `pgcp43` varchar(100) NOT NULL,
ADD `pgcp44` varchar(100) NOT NULL,
ADD `pgcp45` varchar(100) NOT NULL,
ADD `pgcp46` varchar(100) NOT NULL,
ADD `pgcp47` varchar(100) NOT NULL,
ADD `pgcp48` varchar(100) NOT NULL,
ADD `pgcp49` varchar(100) NOT NULL,
ADD `pgcp50` varchar(100) NOT NULL,
ADD `pgcp51` varchar(100) NOT NULL,
ADD `pgcp52` varchar(100) NOT NULL,
ADD `pgcp53` varchar(100) NOT NULL,
ADD `pgcp54` varchar(100) NOT NULL,
ADD `pgcp55` varchar(100) NOT NULL,
ADD `pgcp56` varchar(100) NOT NULL,
ADD `pgcp57` varchar(100) NOT NULL,
ADD `pgcp58` varchar(100) NOT NULL,
ADD `pgcp59` varchar(100) NOT NULL,
ADD `pgcp60` varchar(100) NOT NULL,
ADD `pgcp61` varchar(100) NOT NULL,
ADD `pgcp62` varchar(100) NOT NULL,
ADD `pgcp63` varchar(100) NOT NULL,
ADD `pgcp64` varchar(100) NOT NULL,
ADD `pgcp65` varchar(100) NOT NULL,
ADD `pgcp66` varchar(100) NOT NULL,
ADD `pgcp67` varchar(100) NOT NULL,
ADD `pgcp68` varchar(100) NOT NULL,
ADD `pgcp69` varchar(100) NOT NULL,
ADD `pgcp70` varchar(100) NOT NULL,
ADD `pgcp71` varchar(100) NOT NULL,
ADD `pgcp72` varchar(100) NOT NULL,
ADD `pgcp73` varchar(100) NOT NULL,
ADD `pgcp74` varchar(100) NOT NULL,
ADD `pgcp75` varchar(100) NOT NULL,
ADD `pgcp76` varchar(100) NOT NULL,
ADD `pgcp77` varchar(100) NOT NULL,
ADD `pgcp78` varchar(100) NOT NULL,
ADD `pgcp79` varchar(100) NOT NULL,
ADD `pgcp80` varchar(100) NOT NULL,
ADD `pgcp81` varchar(100) NOT NULL,
ADD `pgcp82` varchar(100) NOT NULL,
ADD `pgcp83` varchar(100) NOT NULL,
ADD `pgcp84` varchar(100) NOT NULL,
ADD `pgcp85` varchar(100) NOT NULL,
ADD `pgcp86` varchar(100) NOT NULL,
ADD `pgcp87` varchar(100) NOT NULL,
ADD `pgcp88` varchar(100) NOT NULL,
ADD `pgcp89` varchar(100) NOT NULL,
ADD `pgcp90` varchar(100) NOT NULL,
ADD `pgcp91` varchar(100) NOT NULL,
ADD `pgcp92` varchar(100) NOT NULL,
ADD `pgcp93` varchar(100) NOT NULL,
ADD `pgcp94` varchar(100) NOT NULL,
ADD `pgcp95` varchar(100) NOT NULL,
ADD `pgcp96` varchar(100) NOT NULL,
ADD `pgcp97` varchar(100) NOT NULL,
ADD `pgcp98` varchar(100) NOT NULL,
ADD `pgcp99` varchar(100) NOT NULL,
ADD `pgcp100` varchar(100) NOT NULL,
ADD `pgcp101` varchar(100) NOT NULL,
ADD `pgcp102` varchar(100) NOT NULL,
ADD `pgcp103` varchar(100) NOT NULL,
ADD `pgcp104` varchar(100) NOT NULL,
ADD `pgcp105` varchar(100) NOT NULL,
ADD `pgcp106` varchar(100) NOT NULL,
ADD `pgcp107` varchar(100) NOT NULL,
ADD `pgcp108` varchar(100) NOT NULL,
ADD `pgcp109` varchar(100) NOT NULL,
ADD `pgcp110` varchar(100) NOT NULL,
ADD `pgcp111` varchar(100) NOT NULL,
ADD `pgcp112` varchar(100) NOT NULL,
ADD `pgcp113` varchar(100) NOT NULL,
ADD `pgcp114` varchar(100) NOT NULL,
ADD `pgcp115` varchar(100) NOT NULL,
ADD `pgcp116` varchar(100) NOT NULL,
ADD `pgcp117` varchar(100) NOT NULL,
ADD `pgcp118` varchar(100) NOT NULL,
ADD `pgcp119` varchar(100) NOT NULL,
ADD `pgcp120` varchar(100) NOT NULL,
ADD `pgcp121` varchar(100) NOT NULL,
ADD `pgcp122` varchar(100) NOT NULL,
ADD `pgcp123` varchar(100) NOT NULL,
ADD `pgcp124` varchar(100) NOT NULL,
ADD `pgcp125` varchar(100) NOT NULL,
ADD `pgcp126` varchar(100) NOT NULL,
ADD `pgcp127` varchar(100) NOT NULL,
ADD `pgcp128` varchar(100) NOT NULL,
ADD `pgcp129` varchar(100) NOT NULL,
ADD `pgcp130` varchar(100) NOT NULL,
ADD `pgcp131` varchar(100) NOT NULL,
ADD `pgcp132` varchar(100) NOT NULL,
ADD `pgcp133` varchar(100) NOT NULL,
ADD `pgcp134` varchar(100) NOT NULL,
ADD `pgcp135` varchar(100) NOT NULL,
ADD `pgcp136` varchar(100) NOT NULL,
ADD `pgcp137` varchar(100) NOT NULL,
ADD `pgcp138` varchar(100) NOT NULL,
ADD `pgcp139` varchar(100) NOT NULL,
ADD `pgcp140` varchar(100) NOT NULL,
ADD `pgcp141` varchar(100) NOT NULL,
ADD `pgcp142` varchar(100) NOT NULL,
ADD `pgcp143` varchar(100) NOT NULL,
ADD `pgcp144` varchar(100) NOT NULL,
ADD `pgcp145` varchar(100) NOT NULL,
ADD `pgcp146` varchar(100) NOT NULL,
ADD `pgcp147` varchar(100) NOT NULL,
ADD `pgcp148` varchar(100) NOT NULL,
ADD `pgcp149` varchar(100) NOT NULL,
ADD `pgcp150` varchar(100) NOT NULL,
ADD `pgcp151` varchar(100) NOT NULL,
ADD `pgcp152` varchar(100) NOT NULL,
ADD `pgcp153` varchar(100) NOT NULL,
ADD `pgcp154` varchar(100) NOT NULL,
ADD `pgcp155` varchar(100) NOT NULL,
ADD `pgcp156` varchar(100) NOT NULL,
ADD `pgcp157` varchar(100) NOT NULL,
ADD `pgcp158` varchar(100) NOT NULL,
ADD `pgcp159` varchar(100) NOT NULL,
ADD `pgcp160` varchar(100) NOT NULL
";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** adiciona campos a conta_ncon
		$tabla = " recaudo_rcgt";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `vr_deb_16` decimal(20,2) NOT NULL,
ADD `vr_deb_17` decimal(20,2) NOT NULL,
ADD `vr_deb_18` decimal(20,2) NOT NULL,
ADD `vr_deb_19` decimal(20,2) NOT NULL,
ADD `vr_deb_20` decimal(20,2) NOT NULL,
ADD `vr_deb_21` decimal(20,2) NOT NULL,
ADD `vr_deb_22` decimal(20,2) NOT NULL,
ADD `vr_deb_23` decimal(20,2) NOT NULL,
ADD `vr_deb_24` decimal(20,2) NOT NULL,
ADD `vr_deb_25` decimal(20,2) NOT NULL,
ADD `vr_deb_26` decimal(20,2) NOT NULL,
ADD `vr_deb_27` decimal(20,2) NOT NULL,
ADD `vr_deb_28` decimal(20,2) NOT NULL,
ADD `vr_deb_29` decimal(20,2) NOT NULL,
ADD `vr_deb_30` decimal(20,2) NOT NULL,
ADD `vr_deb_31` decimal(20,2) NOT NULL,
ADD `vr_deb_32` decimal(20,2) NOT NULL,
ADD `vr_deb_33` decimal(20,2) NOT NULL,
ADD `vr_deb_34` decimal(20,2) NOT NULL,
ADD `vr_deb_35` decimal(20,2) NOT NULL,
ADD `vr_deb_36` decimal(20,2) NOT NULL,
ADD `vr_deb_37` decimal(20,2) NOT NULL,
ADD `vr_deb_38` decimal(20,2) NOT NULL,
ADD `vr_deb_39` decimal(20,2) NOT NULL,
ADD `vr_deb_40` decimal(20,2) NOT NULL,
ADD `vr_deb_41` decimal(20,2) NOT NULL,
ADD `vr_deb_42` decimal(20,2) NOT NULL,
ADD `vr_deb_43` decimal(20,2) NOT NULL,
ADD `vr_deb_44` decimal(20,2) NOT NULL,
ADD `vr_deb_45` decimal(20,2) NOT NULL,
ADD `vr_deb_46` decimal(20,2) NOT NULL,
ADD `vr_deb_47` decimal(20,2) NOT NULL,
ADD `vr_deb_48` decimal(20,2) NOT NULL,
ADD `vr_deb_49` decimal(20,2) NOT NULL,
ADD `vr_deb_50` decimal(20,2) NOT NULL,
ADD `vr_deb_51` decimal(20,2) NOT NULL,
ADD `vr_deb_52` decimal(20,2) NOT NULL,
ADD `vr_deb_53` decimal(20,2) NOT NULL,
ADD `vr_deb_54` decimal(20,2) NOT NULL,
ADD `vr_deb_55` decimal(20,2) NOT NULL,
ADD `vr_deb_56` decimal(20,2) NOT NULL,
ADD `vr_deb_57` decimal(20,2) NOT NULL,
ADD `vr_deb_58` decimal(20,2) NOT NULL,
ADD `vr_deb_59` decimal(20,2) NOT NULL,
ADD `vr_deb_60` decimal(20,2) NOT NULL,
ADD `vr_deb_61` decimal(20,2) NOT NULL,
ADD `vr_deb_62` decimal(20,2) NOT NULL,
ADD `vr_deb_63` decimal(20,2) NOT NULL,
ADD `vr_deb_64` decimal(20,2) NOT NULL,
ADD `vr_deb_65` decimal(20,2) NOT NULL,
ADD `vr_deb_66` decimal(20,2) NOT NULL,
ADD `vr_deb_67` decimal(20,2) NOT NULL,
ADD `vr_deb_68` decimal(20,2) NOT NULL,
ADD `vr_deb_69` decimal(20,2) NOT NULL,
ADD `vr_deb_70` decimal(20,2) NOT NULL,
ADD `vr_deb_71` decimal(20,2) NOT NULL,
ADD `vr_deb_72` decimal(20,2) NOT NULL,
ADD `vr_deb_73` decimal(20,2) NOT NULL,
ADD `vr_deb_74` decimal(20,2) NOT NULL,
ADD `vr_deb_75` decimal(20,2) NOT NULL,
ADD `vr_deb_76` decimal(20,2) NOT NULL,
ADD `vr_deb_77` decimal(20,2) NOT NULL,
ADD `vr_deb_78` decimal(20,2) NOT NULL,
ADD `vr_deb_79` decimal(20,2) NOT NULL,
ADD `vr_deb_80` decimal(20,2) NOT NULL,
ADD `vr_deb_81` decimal(20,2) NOT NULL,
ADD `vr_deb_82` decimal(20,2) NOT NULL,
ADD `vr_deb_83` decimal(20,2) NOT NULL,
ADD `vr_deb_84` decimal(20,2) NOT NULL,
ADD `vr_deb_85` decimal(20,2) NOT NULL,
ADD `vr_deb_86` decimal(20,2) NOT NULL,
ADD `vr_deb_87` decimal(20,2) NOT NULL,
ADD `vr_deb_88` decimal(20,2) NOT NULL,
ADD `vr_deb_89` decimal(20,2) NOT NULL,
ADD `vr_deb_90` decimal(20,2) NOT NULL,
ADD `vr_deb_91` decimal(20,2) NOT NULL,
ADD `vr_deb_92` decimal(20,2) NOT NULL,
ADD `vr_deb_93` decimal(20,2) NOT NULL,
ADD `vr_deb_94` decimal(20,2) NOT NULL,
ADD `vr_deb_95` decimal(20,2) NOT NULL,
ADD `vr_deb_96` decimal(20,2) NOT NULL,
ADD `vr_deb_97` decimal(20,2) NOT NULL,
ADD `vr_deb_98` decimal(20,2) NOT NULL,
ADD `vr_deb_99` decimal(20,2) NOT NULL,
ADD `vr_deb_100` decimal(20,2) NOT NULL,
ADD `vr_deb_101` decimal(20,2) NOT NULL,
ADD `vr_deb_102` decimal(20,2) NOT NULL,
ADD `vr_deb_103` decimal(20,2) NOT NULL,
ADD `vr_deb_104` decimal(20,2) NOT NULL,
ADD `vr_deb_105` decimal(20,2) NOT NULL,
ADD `vr_deb_106` decimal(20,2) NOT NULL,
ADD `vr_deb_107` decimal(20,2) NOT NULL,
ADD `vr_deb_108` decimal(20,2) NOT NULL,
ADD `vr_deb_109` decimal(20,2) NOT NULL,
ADD `vr_deb_110` decimal(20,2) NOT NULL,
ADD `vr_deb_111` decimal(20,2) NOT NULL,
ADD `vr_deb_112` decimal(20,2) NOT NULL,
ADD `vr_deb_113` decimal(20,2) NOT NULL,
ADD `vr_deb_114` decimal(20,2) NOT NULL,
ADD `vr_deb_115` decimal(20,2) NOT NULL,
ADD `vr_deb_116` decimal(20,2) NOT NULL,
ADD `vr_deb_117` decimal(20,2) NOT NULL,
ADD `vr_deb_118` decimal(20,2) NOT NULL,
ADD `vr_deb_119` decimal(20,2) NOT NULL,
ADD `vr_deb_120` decimal(20,2) NOT NULL,
ADD `vr_deb_121` decimal(20,2) NOT NULL,
ADD `vr_deb_122` decimal(20,2) NOT NULL,
ADD `vr_deb_123` decimal(20,2) NOT NULL,
ADD `vr_deb_124` decimal(20,2) NOT NULL,
ADD `vr_deb_125` decimal(20,2) NOT NULL,
ADD `vr_deb_126` decimal(20,2) NOT NULL,
ADD `vr_deb_127` decimal(20,2) NOT NULL,
ADD `vr_deb_128` decimal(20,2) NOT NULL,
ADD `vr_deb_129` decimal(20,2) NOT NULL,
ADD `vr_deb_130` decimal(20,2) NOT NULL,
ADD `vr_deb_131` decimal(20,2) NOT NULL,
ADD `vr_deb_132` decimal(20,2) NOT NULL,
ADD `vr_deb_133` decimal(20,2) NOT NULL,
ADD `vr_deb_134` decimal(20,2) NOT NULL,
ADD `vr_deb_135` decimal(20,2) NOT NULL,
ADD `vr_deb_136` decimal(20,2) NOT NULL,
ADD `vr_deb_137` decimal(20,2) NOT NULL,
ADD `vr_deb_138` decimal(20,2) NOT NULL,
ADD `vr_deb_139` decimal(20,2) NOT NULL,
ADD `vr_deb_140` decimal(20,2) NOT NULL,
ADD `vr_deb_141` decimal(20,2) NOT NULL,
ADD `vr_deb_142` decimal(20,2) NOT NULL,
ADD `vr_deb_143` decimal(20,2) NOT NULL,
ADD `vr_deb_144` decimal(20,2) NOT NULL,
ADD `vr_deb_145` decimal(20,2) NOT NULL,
ADD `vr_deb_146` decimal(20,2) NOT NULL,
ADD `vr_deb_147` decimal(20,2) NOT NULL,
ADD `vr_deb_148` decimal(20,2) NOT NULL,
ADD `vr_deb_149` decimal(20,2) NOT NULL,
ADD `vr_deb_150` decimal(20,2) NOT NULL,
ADD `vr_deb_151` decimal(20,2) NOT NULL,
ADD `vr_deb_152` decimal(20,2) NOT NULL,
ADD `vr_deb_153` decimal(20,2) NOT NULL,
ADD `vr_deb_154` decimal(20,2) NOT NULL,
ADD `vr_deb_155` decimal(20,2) NOT NULL,
ADD `vr_deb_156` decimal(20,2) NOT NULL,
ADD `vr_deb_157` decimal(20,2) NOT NULL,
ADD `vr_deb_158` decimal(20,2) NOT NULL,
ADD `vr_deb_159` decimal(20,2) NOT NULL,
ADD `vr_deb_160` decimal(20,2) NOT NULL,
ADD `vr_cre_16` decimal(20,2) NOT NULL,
ADD `vr_cre_17` decimal(20,2) NOT NULL,
ADD `vr_cre_18` decimal(20,2) NOT NULL,
ADD `vr_cre_19` decimal(20,2) NOT NULL,
ADD `vr_cre_20` decimal(20,2) NOT NULL,
ADD `vr_cre_21` decimal(20,2) NOT NULL,
ADD `vr_cre_22` decimal(20,2) NOT NULL,
ADD `vr_cre_23` decimal(20,2) NOT NULL,
ADD `vr_cre_24` decimal(20,2) NOT NULL,
ADD `vr_cre_25` decimal(20,2) NOT NULL,
ADD `vr_cre_26` decimal(20,2) NOT NULL,
ADD `vr_cre_27` decimal(20,2) NOT NULL,
ADD `vr_cre_28` decimal(20,2) NOT NULL,
ADD `vr_cre_29` decimal(20,2) NOT NULL,
ADD `vr_cre_30` decimal(20,2) NOT NULL,
ADD `vr_cre_31` decimal(20,2) NOT NULL,
ADD `vr_cre_32` decimal(20,2) NOT NULL,
ADD `vr_cre_33` decimal(20,2) NOT NULL,
ADD `vr_cre_34` decimal(20,2) NOT NULL,
ADD `vr_cre_35` decimal(20,2) NOT NULL,
ADD `vr_cre_36` decimal(20,2) NOT NULL,
ADD `vr_cre_37` decimal(20,2) NOT NULL,
ADD `vr_cre_38` decimal(20,2) NOT NULL,
ADD `vr_cre_39` decimal(20,2) NOT NULL,
ADD `vr_cre_40` decimal(20,2) NOT NULL,
ADD `vr_cre_41` decimal(20,2) NOT NULL,
ADD `vr_cre_42` decimal(20,2) NOT NULL,
ADD `vr_cre_43` decimal(20,2) NOT NULL,
ADD `vr_cre_44` decimal(20,2) NOT NULL,
ADD `vr_cre_45` decimal(20,2) NOT NULL,
ADD `vr_cre_46` decimal(20,2) NOT NULL,
ADD `vr_cre_47` decimal(20,2) NOT NULL,
ADD `vr_cre_48` decimal(20,2) NOT NULL,
ADD `vr_cre_49` decimal(20,2) NOT NULL,
ADD `vr_cre_50` decimal(20,2) NOT NULL,
ADD `vr_cre_51` decimal(20,2) NOT NULL,
ADD `vr_cre_52` decimal(20,2) NOT NULL,
ADD `vr_cre_53` decimal(20,2) NOT NULL,
ADD `vr_cre_54` decimal(20,2) NOT NULL,
ADD `vr_cre_55` decimal(20,2) NOT NULL,
ADD `vr_cre_56` decimal(20,2) NOT NULL,
ADD `vr_cre_57` decimal(20,2) NOT NULL,
ADD `vr_cre_58` decimal(20,2) NOT NULL,
ADD `vr_cre_59` decimal(20,2) NOT NULL,
ADD `vr_cre_60` decimal(20,2) NOT NULL,
ADD `vr_cre_61` decimal(20,2) NOT NULL,
ADD `vr_cre_62` decimal(20,2) NOT NULL,
ADD `vr_cre_63` decimal(20,2) NOT NULL,
ADD `vr_cre_64` decimal(20,2) NOT NULL,
ADD `vr_cre_65` decimal(20,2) NOT NULL,
ADD `vr_cre_66` decimal(20,2) NOT NULL,
ADD `vr_cre_67` decimal(20,2) NOT NULL,
ADD `vr_cre_68` decimal(20,2) NOT NULL,
ADD `vr_cre_69` decimal(20,2) NOT NULL,
ADD `vr_cre_70` decimal(20,2) NOT NULL,
ADD `vr_cre_71` decimal(20,2) NOT NULL,
ADD `vr_cre_72` decimal(20,2) NOT NULL,
ADD `vr_cre_73` decimal(20,2) NOT NULL,
ADD `vr_cre_74` decimal(20,2) NOT NULL,
ADD `vr_cre_75` decimal(20,2) NOT NULL,
ADD `vr_cre_76` decimal(20,2) NOT NULL,
ADD `vr_cre_77` decimal(20,2) NOT NULL,
ADD `vr_cre_78` decimal(20,2) NOT NULL,
ADD `vr_cre_79` decimal(20,2) NOT NULL,
ADD `vr_cre_80` decimal(20,2) NOT NULL,
ADD `vr_cre_81` decimal(20,2) NOT NULL,
ADD `vr_cre_82` decimal(20,2) NOT NULL,
ADD `vr_cre_83` decimal(20,2) NOT NULL,
ADD `vr_cre_84` decimal(20,2) NOT NULL,
ADD `vr_cre_85` decimal(20,2) NOT NULL,
ADD `vr_cre_86` decimal(20,2) NOT NULL,
ADD `vr_cre_87` decimal(20,2) NOT NULL,
ADD `vr_cre_88` decimal(20,2) NOT NULL,
ADD `vr_cre_89` decimal(20,2) NOT NULL,
ADD `vr_cre_90` decimal(20,2) NOT NULL,
ADD `vr_cre_91` decimal(20,2) NOT NULL,
ADD `vr_cre_92` decimal(20,2) NOT NULL,
ADD `vr_cre_93` decimal(20,2) NOT NULL,
ADD `vr_cre_94` decimal(20,2) NOT NULL,
ADD `vr_cre_95` decimal(20,2) NOT NULL,
ADD `vr_cre_96` decimal(20,2) NOT NULL,
ADD `vr_cre_97` decimal(20,2) NOT NULL,
ADD `vr_cre_98` decimal(20,2) NOT NULL,
ADD `vr_cre_99` decimal(20,2) NOT NULL,
ADD `vr_cre_100` decimal(20,2) NOT NULL,
ADD `vr_cre_101` decimal(20,2) NOT NULL,
ADD `vr_cre_102` decimal(20,2) NOT NULL,
ADD `vr_cre_103` decimal(20,2) NOT NULL,
ADD `vr_cre_104` decimal(20,2) NOT NULL,
ADD `vr_cre_105` decimal(20,2) NOT NULL,
ADD `vr_cre_106` decimal(20,2) NOT NULL,
ADD `vr_cre_107` decimal(20,2) NOT NULL,
ADD `vr_cre_108` decimal(20,2) NOT NULL,
ADD `vr_cre_109` decimal(20,2) NOT NULL,
ADD `vr_cre_110` decimal(20,2) NOT NULL,
ADD `vr_cre_111` decimal(20,2) NOT NULL,
ADD `vr_cre_112` decimal(20,2) NOT NULL,
ADD `vr_cre_113` decimal(20,2) NOT NULL,
ADD `vr_cre_114` decimal(20,2) NOT NULL,
ADD `vr_cre_115` decimal(20,2) NOT NULL,
ADD `vr_cre_116` decimal(20,2) NOT NULL,
ADD `vr_cre_117` decimal(20,2) NOT NULL,
ADD `vr_cre_118` decimal(20,2) NOT NULL,
ADD `vr_cre_119` decimal(20,2) NOT NULL,
ADD `vr_cre_120` decimal(20,2) NOT NULL,
ADD `vr_cre_121` decimal(20,2) NOT NULL,
ADD `vr_cre_122` decimal(20,2) NOT NULL,
ADD `vr_cre_123` decimal(20,2) NOT NULL,
ADD `vr_cre_124` decimal(20,2) NOT NULL,
ADD `vr_cre_125` decimal(20,2) NOT NULL,
ADD `vr_cre_126` decimal(20,2) NOT NULL,
ADD `vr_cre_127` decimal(20,2) NOT NULL,
ADD `vr_cre_128` decimal(20,2) NOT NULL,
ADD `vr_cre_129` decimal(20,2) NOT NULL,
ADD `vr_cre_130` decimal(20,2) NOT NULL,
ADD `vr_cre_131` decimal(20,2) NOT NULL,
ADD `vr_cre_132` decimal(20,2) NOT NULL,
ADD `vr_cre_133` decimal(20,2) NOT NULL,
ADD `vr_cre_134` decimal(20,2) NOT NULL,
ADD `vr_cre_135` decimal(20,2) NOT NULL,
ADD `vr_cre_136` decimal(20,2) NOT NULL,
ADD `vr_cre_137` decimal(20,2) NOT NULL,
ADD `vr_cre_138` decimal(20,2) NOT NULL,
ADD `vr_cre_139` decimal(20,2) NOT NULL,
ADD `vr_cre_140` decimal(20,2) NOT NULL,
ADD `vr_cre_141` decimal(20,2) NOT NULL,
ADD `vr_cre_142` decimal(20,2) NOT NULL,
ADD `vr_cre_143` decimal(20,2) NOT NULL,
ADD `vr_cre_144` decimal(20,2) NOT NULL,
ADD `vr_cre_145` decimal(20,2) NOT NULL,
ADD `vr_cre_146` decimal(20,2) NOT NULL,
ADD `vr_cre_147` decimal(20,2) NOT NULL,
ADD `vr_cre_148` decimal(20,2) NOT NULL,
ADD `vr_cre_149` decimal(20,2) NOT NULL,
ADD `vr_cre_150` decimal(20,2) NOT NULL,
ADD `vr_cre_151` decimal(20,2) NOT NULL,
ADD `vr_cre_152` decimal(20,2) NOT NULL,
ADD `vr_cre_153` decimal(20,2) NOT NULL,
ADD `vr_cre_154` decimal(20,2) NOT NULL,
ADD `vr_cre_155` decimal(20,2) NOT NULL,
ADD `vr_cre_156` decimal(20,2) NOT NULL,
ADD `vr_cre_157` decimal(20,2) NOT NULL,
ADD `vr_cre_158` decimal(20,2) NOT NULL,
ADD `vr_cre_159` decimal(20,2) NOT NULL,
ADD `vr_cre_160` decimal(20,2) NOT NULL
";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo conta_cesp 
		$tabla = " conta_cesp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ips` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo conta_cesp 
		$tabla = " conta_coba";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ips` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo conta_cesp 
		$tabla = " conta_ncon";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ips` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo conta_cesp 
		$tabla = " conta_ncsp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ips` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo conta_cesp 
		$tabla = " conta_ndsp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ips` VARCHAR(2) NOT NULL";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		//************************* carga tabla fuentes recursos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");

		$filename = 'fuentes_recursos.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into fuentes_recursos ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	   
		//********************vacia tabla fut_ingresos
		$tabla6 = "fut_ingresos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga fuentes recursos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'fut_ingresos.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into fut_ingresos ( cod_fut , nom_fut ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 
		//********************vacia tabla fut_gastos
		$tabla6 = "fut_gastos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga fuentes recursos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'fut_gastos.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into fut_gastos ( cod_fut , nom_fut ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 
		//********************vaciar tabla fut_cod_ser_deuda
		$tabla6 = "fut_cod_ser_deuda";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga fuentes recursos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'fut_cod_ser_deuda.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

			$import = "INSERT into fut_cod_ser_deuda ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//******************** CREA TABLA INGRESOS 2193
		$tabla6 = "2193_ing";
		$anadir6 = "truncate TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};


		$tabla7 = "2193_ing";
		$anadir7 = "CREATE TABLE ";
		$anadir7 .= $tabla7;
		$anadir7 .= "
		(
  `id` int(11) NOT NULL auto_increment,
  `cod` varchar(100) NOT NULL default '',
  `tipo` varchar(200) NOT NULL default '',
  `trimestre` varchar(200) NOT NULL default '',
  `concepto` varchar(200) NOT NULL default '',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 ";



		if ($conexion->query($anadir7)) {
			echo "";
		} else {
			echo "";
		}
		//************************* carga 2193 ing***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = '2193_ing.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into 2193_ing ( 
	   cod, tipo , trimestre , concepto
	   ) 
	  values
	   ('$data[0]','$data[1]','$data[2]','$data[3]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		print "";

		//************************* carga 2193 gas***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");
		//******************** CREA TABLA INGRESOS 2193
		$tabla6 = "2193_gas";
		$anadir6 = "truncate TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};











		$filename = '2193_gas.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into 2193_gas ( 
	   cod, tipo , trimestre , concepto
	   ) 
	  values
	   ('$data[0]','$data[1]','$data[2]','$data[3]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		print "";
		//********************vacia tabla cgr_ingresos
		$tabla6 = "cgr_ingresos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cgr_ingresos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_ingresos.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into cgr_ingresos ( cod_cgr , nom_cgr ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//********************vacia tabla cgr_gastos
		$tabla6 = "cgr_gastos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cgr_gastos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_gastos.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into cgr_gastos ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//********************vacia tabla cod_recurso_cgr_ing
		$tabla6 = "cod_recurso_cgr_ing";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cod_recurso_cgr_ing ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_recurso.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into cod_recurso_cgr_ing ( cod_rec , nom_rec ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//********************vacia tabla cod_recurso_cgr_gastos
		$tabla6 = "cod_recurso_cgr_gastos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cod_recurso_cgr_gastos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_recurso.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into cod_recurso_cgr_gastos ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";

		//********************vacia tabla uidad ejecutora
		$tabla6 = "uni_eje_cgr_gas";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cod_recurso_cgr_gastos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_unid_ejec.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into uni_eje_cgr_gas ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 	  

		//********************vacia tabla oer_cgr_ing
		$tabla6 = "oer_cgr_ing";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga oer_cgr_ing ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_orig_esp.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into oer_cgr_ing ( cod_oer , nom_oer ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 	  
		//********************vacia tabla oer_cgr_gastos
		$tabla6 = "oer_cgr_gastos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga oer_cgr_gastos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_orig_esp.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into oer_cgr_gastos ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 	 	    
		//********************vacia tabla cda_cgr_ing
		$tabla6 = "cda_cgr_ing";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cda_cgr_ing ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_destin.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into cda_cgr_ing ( cod_cda , nom_cda ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//********************vacia tabla cda_cgr_gastos
		$tabla6 = "cda_cgr_gastos";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cda_cgr_gastos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_destin.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into cda_cgr_gastos ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 		   	   	   	   	   		   		   	   	   	   	   	

		//********************vacia tabla terceros_cgr_ing
		$tabla6 = "terceros_cgr_ing";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga cda_cgr_gastos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_terceros.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into terceros_cgr_ing ( cod_ter , nom_ter ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	

		//********************vacia tabla finalidad_gasto_cgr
		$tabla6 = "finalidad_gasto_cgr";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga finalidad_gasto_cgr ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'cgr_finalidad.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into finalidad_gasto_cgr ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//******************** CREA TABLA CONTABILIDAD AUTOMATICA INGRESOS
		$tabla7 = "cca_ing";
		$anadir7 = "CREATE TABLE ";
		$anadir7 .= $tabla7;
		$anadir7 .= "
		(
  `id` int(11) NOT NULL auto_increment,
  `cod_pptal` varchar(200) NOT NULL default '',
  `nom_rubro` varchar(200) NOT NULL default '',
  `pgcp1` varchar(200) NOT NULL default '',
  `pgcp2` varchar(200) NOT NULL default '',
  `pgcp3` varchar(200) NOT NULL default '',
  `pgcp4` varchar(200) NOT NULL default '',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 ";



		if ($conexion->query($anadir7)) {
			echo "";
		} else {
			echo "";
		}
		//******************** CREA TABLA ACTUALIZAR
		$resultado = $conexion->query("SELECT * FROM actualizar ");
		if ($resultado == '') {
			//$val = mysql_num_fields($resultado);	
			$anadir78 = " CREATE TABLE actualizar (
  `estado` varchar(2) collate latin1_general_ci NOT NULL, `nivel` int(10) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO `actualizar` VALUES ('1', 10);";

			if ($$conexion->query($anadir78)) {
				echo "";
			} else {
				echo "$anadir78";
			}
		}
		//********************vacia tabla fut_cod_vig_ant
		$tabla6 = "fut_cod_vig_ant";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga fuentes recursos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'fut_cod_vig_ant.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

			$import = "INSERT into fut_cod_vig_ant ( cod , nom ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);






		//************************ terceros ceva vacios

		$sq10 = "select * from ceva";
		$rs10 = $conexion->query($sq10);
		while ($rw10 = $rs10->fetch_assoc()) {
			if ($rw10["tercero"] == "") {
				$sq11 = "select * from cobp where id_auto_cobp ='$rw10[id_auto_cobp]'";
				$rs11 = $conexion->query($sq11);
				$rw11 = $rs11->fetch_assoc();
				$sq12 = "update ceva set tercero ='$rw11[tercero]', ccnit ='$rw11[ccnit]' where id_auto_cobp ='$rw11[id_auto_cobp]'";
				$conexion->query($sq12) or die(mysqli_error($conexion));
			}
		}



		// ******************** fin


		// ************************* ACTUALIZA PAGODO CUANDO COBP TIENE CEVA
		$sq14 = "update cobp SET pagado = 'SI' WHERE ceva !=''";
		$conexion->query($sq14) or die(mysqli_error($conexion));

		$sq15 = "update cobp SET tesoreria = 'NO' where tesoreria =''";
		$conexion->query($sq15) or die(mysqli_error($conexion));

		$sq19 = "update obcg SET pagado = 'SI' where ceva !=''";
		$conexion->query($sq19) or die(mysqli_error($conexion));


		// cdp liquidado sin consecutivo

		$sq16 = "select * from cdpp where cdpp =''";
		$rs16 = $conexion->query($sq16);
		while ($rw16 = $rs16->fetch_assoc()) {
			$sq17 = "select * from cdpp where consecutivo ='$rw16[consecutivo]' order by id asc";
			$rs17 = $conexion->query($sq17);
			$rw17 = $rs17->fetch_assoc();

			$sq18 = "update cdpp SET cdpp = '$rw17[cdpp]' where consecutivo ='$rw16[consecutivo]'";
			$conexion->query($sq18) or die(mysqli_error($conexion));
		}



		//********************vacia tabla fut_ingresos
		$tabla6 = "fut_exedentes";
		$anadir6 = "TRUNCATE TABLE ";
		$anadir6 .= $tabla6;
		$anadir6 .= " ";



		if ($conexion->query($añadir6)) {
			echo "";
		} else {
			echo "";
		};
		//************************* carga fuentes recursos ***************
		$db = new mysqli($server, $dbuser, $dbpass, $database) or die("Could not connect.");











		$filename = 'fut_exedentes.csv';

		$handle = fopen("$filename", "r");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import = "INSERT into fut_exedentes ( cod_fut , nom_fut ) values ('$data[0]','$data[1]')";

			$db->query($import) or die(mysqli_error($db));
		}

		fclose($handle);

		//print "<center class='Estilo4'><br>fuentes_recursos - OK<br></center>";	 

		// lib aux automatico para exedentes de liquidez

		$anadir70 = "ALTER TABLE `lib_aux` ADD `dcto_a` VARCHAR(200) DEFAULT '' NOT NULL;";

		if ($conexion->query($anadir70)) {
			echo "";
		} else {
			echo "";
		};
		// lib aux automatico para exedentes de liquidez
		$anadir71 = "ALTER TABLE `recaudo_rcgt` ADD `ter` VARCHAR(20) NOT NULL ;";

		if ($conexion->query($anadir71)) {
			echo "";
		} else {
			echo "";
		};
		// lib aux automatico para exedentes de liquidez
		$anadir71 = "ALTER TABLE `recaudo_tnat` ADD `ter` VARCHAR(20) NOT NULL ;";

		if ($conexion->query($anadir71)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo conta_cesp 
		$tabla = " recaudo_rica";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `tip_ica` VARCHAR(50) NOT NULL ,
ADD `cod_ica` VARCHAR(8) NOT NULL ;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** campo ref cuenta por pagar
		$tabla = " cecp";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `ref` VARCHAR(200) NOT NULL; ";

		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		//**********************adiciona campo tabla lib_aux
		$tabla = " lib_aux";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `id_auto` VARCHAR(20) NOT NULL,
ADD `id_cons` VARCHAR(20) NOT NULL,
ADD `ccnit` VARCHAR(20) NOT NULL;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//**********************adiciona campo tabla aux_bal_prueba 
		$tabla = " aux_bal_prueba";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `mov` VARCHAR(2) NOT NULL;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		//**********************adiciona campo tabla fecha
		$tabla = " fecha";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `user` VARCHAR(30) NOT NULL;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//**********************adiciona campo tabla car_pto
		$tabla = " car_ppto_gas";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `vg_futura` VARCHAR(2) NOT NULL;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		// CREO TRABAL TERCEROS
		//**********************adiciona campo tabla car_pto
		$anadir56 = " CREATE `z_terceros` AS select `terceros_naturales`.`id` AS `id`,`terceros_naturales`.`num_id` AS `num_id`,concat(`terceros_naturales`.`pri_ape`,_latin1' ',`terceros_naturales`.`seg_ape`,_latin1' ',`terceros_naturales`.`pri_nom`,_latin1' ',`terceros_naturales`.`seg_nom`) AS `nombre` from `terceros_naturales` union select `terceros_juridicos`.`id` AS `id`,`terceros_juridicos`.`num_id2` AS `num_id2`,`terceros_juridicos`.`raz_soc2` AS `nombre` from `terceros_juridicos`;
";


		if ($conexion->query($anadir56)) {
			echo "";
		} else {
			echo "";
		};


		// CREO TRABAL TERCEROS
		// borrar tabla
		$sql2 = "drop view z_aux_ing";
		$conexion->query($sql2);
		//**********************adiciona campo tabla car_pto
		$anadir56 = " CREATE VIEW `z_aux_ing` AS select `recaudo_ncbt`.`fecha_recaudo` AS `fecha`,`recaudo_ncbt`.`id_manu_ncbt` AS `num`,`recaudo_ncbt`.`des_recaudo` AS `des`,`recaudo_ncbt`.`tercero` AS `ter`,`recaudo_ncbt`.`cuenta` AS `rubro`,`recaudo_ncbt`.`vr_digitado` AS `valor` from `recaudo_ncbt` union select `recaudo_rcgt`.`fecha_recaudo` AS `fecha`,`recaudo_rcgt`.`id_manu_rcgt` AS `num`,`recaudo_rcgt`.`des_recaudo` AS `des`,`recaudo_rcgt`.`tercero` AS `ter`,`recaudo_rcgt`.`cuenta` AS `rubro`,`recaudo_rcgt`.`vr_digitado` AS `valor` from `recaudo_rcgt`  union select `recaudo_roit`.`fecha_recaudo` AS `fecha`,`recaudo_roit`.`id_manu_roit` AS `num`,`recaudo_roit`.`des_recaudo` AS `des`,`recaudo_roit`.`tercero` AS `ter`,`recaudo_roit`.`cuenta` AS `rubro`,`recaudo_roit`.`vr_digitado` AS `valor` from `recaudo_roit`  union select `recaudo_tnat`.`fecha_recaudo` AS `fecha`,`recaudo_tnat`.`id_manu_tnat` AS `num`,`recaudo_tnat`.`des_recaudo` AS `des`,`recaudo_tnat`.`tercero` AS `ter`,`recaudo_tnat`.`cuenta` AS `rubro`,`recaudo_tnat`.`vr_digitado` AS `valor` from `recaudo_tnat`;";


		if ($conexion->query($anadir56)) {
			echo "";
		} else {
			echo "";
		};

		//**********************adiciona campo tabla car_pto
		$tabla = " car_ppto_ing";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `vigencia` VARCHAR(10) NOT NULL;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		$anadir2 = " UPDATE `crpp` SET `ctrl` = 'NO' WHERE `id` =673 LIMIT 1 ;";


		if ($conexion->query($anadir2)) {
			echo "";
		} else {
			echo "";
		};

		//**********************adiciona campo tabla car_pto
		//$tabla=" car_ppto_ing";
		//$anadir="ALTER TABLE";
		//$anadir.=$tabla;
		$anadir = "drop view z_terceros;";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		$anadir2 = "CREATE  VIEW `z_terceros` AS select `terceros_naturales`.`id` AS `id`,`terceros_naturales`.`num_id` AS `num_id`,concat(`terceros_naturales`.`pri_ape`,_latin1' ',`terceros_naturales`.`seg_ape`,_latin1' ',`terceros_naturales`.`pri_nom`,_latin1' ',`terceros_naturales`.`seg_nom`) AS `nombre` from `terceros_naturales` union select `terceros_juridicos`.`id` AS `id`,`terceros_juridicos`.`num_id2` AS `num_id2`,`terceros_juridicos`.`raz_soc2` AS `nombre` from `terceros_juridicos`;
 ";


		if ($conexion->query($anadir2)) {
			echo "";
		} else {
			echo "";
		};
		$anadir3 = "drop view lib_aux10;";


		if ($conexion->query($anadir3)) {
			echo "";
		} else {
			echo "";
		};
		$anadir3 = "CREATE  VIEW `lib_aux10` AS select `lib_aux2`.`id` AS `id`,`lib_aux2`.`id_auto` AS `id_auto`,`lib_aux2`.`id_cons` AS `id_cons`,`lib_aux2`.`fecha` AS `fecha`,`lib_aux2`.`dcto` AS `dcto`,`lib_aux2`.`cuenta` AS `cuenta`,`lib_aux2`.`detalle` AS `detalle`,`lib_aux2`.`tercero` AS `tercero`,`lib_aux2`.`ccnit` AS `ccnit`,`lib_aux2`.`debito` AS `debito`,`lib_aux2`.`credito` AS `credito`,`lib_aux2`.`cheque` AS `cheque` from `lib_aux2` union select `lib_aux3`.`id` AS `id`,`lib_aux3`.`id_auto` AS `id_auto`,`lib_aux3`.`id_cons` AS `id_cons`,`lib_aux3`.`fecha` AS `fecha`,`lib_aux3`.`dcto` AS `dcto`,`lib_aux3`.`cuenta` AS `cuenta`,`lib_aux3`.`detalle` AS `detalle`,`lib_aux3`.`tercero` AS `tercero`,`lib_aux3`.`ccnit` AS `ccnit`,`lib_aux3`.`debito` AS `debito`,`lib_aux3`.`credito` AS `credito`,`lib_aux3`.`cheque` AS `cheque` from `lib_aux3` union select `lib_aux4`.`id` AS `id`,`lib_aux4`.`id_auto` AS `id_auto`,`lib_aux4`.`id_cons` AS `id_cons`,`lib_aux4`.`fecha` AS `fecha`,`lib_aux4`.`dcto` AS `dcto`,`lib_aux4`.`cuenta` AS `cuenta`,`lib_aux4`.`detalle` AS `detalle`,`lib_aux4`.`tercero` AS `tercero`,`lib_aux4`.`ccnit` AS `ccnit`,`lib_aux4`.`debito` AS `debito`,`lib_aux4`.`credito` AS `credito`,`lib_aux4`.`cheque` AS `cheque` from `lib_aux4`;
";


		if ($conexion->query($anadir3)) {
			echo "";
		} else {
			echo "";
		};
		$anadir4 = "ALTER TABLE `terceros_naturales` ADD `monto` DECIMAL( 20, 2 ) NOT NULL ,
ADD `embargo` VARCHAR( 2 ) NOT NULL ;  ";


		if ($conexion->query($anadir4)) {
			echo "";
		} else {
			echo "";
		};
		/********************** adiciona campos a conta_ncon */
		$tabla = " recaudo_tnat";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `pgcp16` varchar(100) NOT NULL,
ADD `pgcp17` varchar(100) NOT NULL,
ADD `pgcp18` varchar(100) NOT NULL,
ADD `pgcp19` varchar(100) NOT NULL,
ADD `pgcp20` varchar(100) NOT NULL,
ADD `pgcp21` varchar(100) NOT NULL,
ADD `pgcp22` varchar(100) NOT NULL,
ADD `pgcp23` varchar(100) NOT NULL,
ADD `pgcp24` varchar(100) NOT NULL,
ADD `pgcp25` varchar(100) NOT NULL,
ADD `pgcp26` varchar(100) NOT NULL,
ADD `pgcp27` varchar(100) NOT NULL,
ADD `pgcp28` varchar(100) NOT NULL,
ADD `pgcp29` varchar(100) NOT NULL,
ADD `pgcp30` varchar(100) NOT NULL,
ADD `pgcp31` varchar(100) NOT NULL,
ADD `pgcp32` varchar(100) NOT NULL,
ADD `pgcp33` varchar(100) NOT NULL,
ADD `pgcp34` varchar(100) NOT NULL,
ADD `pgcp35` varchar(100) NOT NULL,
ADD `pgcp36` varchar(100) NOT NULL,
ADD `pgcp37` varchar(100) NOT NULL,
ADD `pgcp38` varchar(100) NOT NULL,
ADD `pgcp39` varchar(100) NOT NULL,
ADD `pgcp40` varchar(100) NOT NULL,
ADD `pgcp41` varchar(100) NOT NULL,
ADD `pgcp42` varchar(100) NOT NULL,
ADD `pgcp43` varchar(100) NOT NULL,
ADD `pgcp44` varchar(100) NOT NULL,
ADD `pgcp45` varchar(100) NOT NULL,
ADD `pgcp46` varchar(100) NOT NULL,
ADD `pgcp47` varchar(100) NOT NULL,
ADD `pgcp48` varchar(100) NOT NULL,
ADD `pgcp49` varchar(100) NOT NULL,
ADD `pgcp50` varchar(100) NOT NULL,
ADD `pgcp51` varchar(100) NOT NULL,
ADD `pgcp52` varchar(100) NOT NULL,
ADD `pgcp53` varchar(100) NOT NULL,
ADD `pgcp54` varchar(100) NOT NULL,
ADD `pgcp55` varchar(100) NOT NULL,
ADD `pgcp56` varchar(100) NOT NULL,
ADD `pgcp57` varchar(100) NOT NULL,
ADD `pgcp58` varchar(100) NOT NULL,
ADD `pgcp59` varchar(100) NOT NULL,
ADD `pgcp60` varchar(100) NOT NULL,
ADD `pgcp61` varchar(100) NOT NULL,
ADD `pgcp62` varchar(100) NOT NULL,
ADD `pgcp63` varchar(100) NOT NULL,
ADD `pgcp64` varchar(100) NOT NULL,
ADD `pgcp65` varchar(100) NOT NULL,
ADD `pgcp66` varchar(100) NOT NULL,
ADD `pgcp67` varchar(100) NOT NULL,
ADD `pgcp68` varchar(100) NOT NULL,
ADD `pgcp69` varchar(100) NOT NULL,
ADD `pgcp70` varchar(100) NOT NULL,
ADD `pgcp71` varchar(100) NOT NULL,
ADD `pgcp72` varchar(100) NOT NULL,
ADD `pgcp73` varchar(100) NOT NULL,
ADD `pgcp74` varchar(100) NOT NULL,
ADD `pgcp75` varchar(100) NOT NULL,
ADD `pgcp76` varchar(100) NOT NULL,
ADD `pgcp77` varchar(100) NOT NULL,
ADD `pgcp78` varchar(100) NOT NULL,
ADD `pgcp79` varchar(100) NOT NULL,
ADD `pgcp80` varchar(100) NOT NULL,
ADD `pgcp81` varchar(100) NOT NULL,
ADD `pgcp82` varchar(100) NOT NULL,
ADD `pgcp83` varchar(100) NOT NULL,
ADD `pgcp84` varchar(100) NOT NULL,
ADD `pgcp85` varchar(100) NOT NULL,
ADD `pgcp86` varchar(100) NOT NULL,
ADD `pgcp87` varchar(100) NOT NULL,
ADD `pgcp88` varchar(100) NOT NULL,
ADD `pgcp89` varchar(100) NOT NULL,
ADD `pgcp90` varchar(100) NOT NULL,
ADD `pgcp91` varchar(100) NOT NULL,
ADD `pgcp92` varchar(100) NOT NULL,
ADD `pgcp93` varchar(100) NOT NULL,
ADD `pgcp94` varchar(100) NOT NULL,
ADD `pgcp95` varchar(100) NOT NULL,
ADD `pgcp96` varchar(100) NOT NULL,
ADD `pgcp97` varchar(100) NOT NULL,
ADD `pgcp98` varchar(100) NOT NULL,
ADD `pgcp99` varchar(100) NOT NULL,
ADD `pgcp100` varchar(100) NOT NULL,
ADD `pgcp101` varchar(100) NOT NULL,
ADD `pgcp102` varchar(100) NOT NULL,
ADD `pgcp103` varchar(100) NOT NULL,
ADD `pgcp104` varchar(100) NOT NULL,
ADD `pgcp105` varchar(100) NOT NULL,
ADD `pgcp106` varchar(100) NOT NULL,
ADD `pgcp107` varchar(100) NOT NULL,
ADD `pgcp108` varchar(100) NOT NULL,
ADD `pgcp109` varchar(100) NOT NULL,
ADD `pgcp110` varchar(100) NOT NULL,
ADD `pgcp111` varchar(100) NOT NULL,
ADD `pgcp112` varchar(100) NOT NULL,
ADD `pgcp113` varchar(100) NOT NULL,
ADD `pgcp114` varchar(100) NOT NULL,
ADD `pgcp115` varchar(100) NOT NULL,
ADD `pgcp116` varchar(100) NOT NULL,
ADD `pgcp117` varchar(100) NOT NULL,
ADD `pgcp118` varchar(100) NOT NULL,
ADD `pgcp119` varchar(100) NOT NULL,
ADD `pgcp120` varchar(100) NOT NULL,
ADD `pgcp121` varchar(100) NOT NULL,
ADD `pgcp122` varchar(100) NOT NULL,
ADD `pgcp123` varchar(100) NOT NULL,
ADD `pgcp124` varchar(100) NOT NULL,
ADD `pgcp125` varchar(100) NOT NULL,
ADD `pgcp126` varchar(100) NOT NULL,
ADD `pgcp127` varchar(100) NOT NULL,
ADD `pgcp128` varchar(100) NOT NULL,
ADD `pgcp129` varchar(100) NOT NULL,
ADD `pgcp130` varchar(100) NOT NULL,
ADD `pgcp131` varchar(100) NOT NULL,
ADD `pgcp132` varchar(100) NOT NULL,
ADD `pgcp133` varchar(100) NOT NULL,
ADD `pgcp134` varchar(100) NOT NULL,
ADD `pgcp135` varchar(100) NOT NULL,
ADD `pgcp136` varchar(100) NOT NULL,
ADD `pgcp137` varchar(100) NOT NULL,
ADD `pgcp138` varchar(100) NOT NULL,
ADD `pgcp139` varchar(100) NOT NULL,
ADD `pgcp140` varchar(100) NOT NULL,
ADD `pgcp141` varchar(100) NOT NULL,
ADD `pgcp142` varchar(100) NOT NULL,
ADD `pgcp143` varchar(100) NOT NULL,
ADD `pgcp144` varchar(100) NOT NULL,
ADD `pgcp145` varchar(100) NOT NULL,
ADD `pgcp146` varchar(100) NOT NULL,
ADD `pgcp147` varchar(100) NOT NULL,
ADD `pgcp148` varchar(100) NOT NULL,
ADD `pgcp149` varchar(100) NOT NULL,
ADD `pgcp150` varchar(100) NOT NULL,
ADD `pgcp151` varchar(100) NOT NULL,
ADD `pgcp152` varchar(100) NOT NULL,
ADD `pgcp153` varchar(100) NOT NULL,
ADD `pgcp154` varchar(100) NOT NULL,
ADD `pgcp155` varchar(100) NOT NULL,
ADD `pgcp156` varchar(100) NOT NULL,
ADD `pgcp157` varchar(100) NOT NULL,
ADD `pgcp158` varchar(100) NOT NULL,
ADD `pgcp159` varchar(100) NOT NULL,
ADD `pgcp160` varchar(100) NOT NULL
";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};
		//********************** adiciona campos a conta_ncon
		$tabla = " recaudo_tnat";
		$anadir = "ALTER TABLE";
		$anadir .= $tabla;
		$anadir .= " ADD `vr_deb_16` decimal(20,2) NOT NULL,
ADD `vr_deb_17` decimal(20,2) NOT NULL,
ADD `vr_deb_18` decimal(20,2) NOT NULL,
ADD `vr_deb_19` decimal(20,2) NOT NULL,
ADD `vr_deb_20` decimal(20,2) NOT NULL,
ADD `vr_deb_21` decimal(20,2) NOT NULL,
ADD `vr_deb_22` decimal(20,2) NOT NULL,
ADD `vr_deb_23` decimal(20,2) NOT NULL,
ADD `vr_deb_24` decimal(20,2) NOT NULL,
ADD `vr_deb_25` decimal(20,2) NOT NULL,
ADD `vr_deb_26` decimal(20,2) NOT NULL,
ADD `vr_deb_27` decimal(20,2) NOT NULL,
ADD `vr_deb_28` decimal(20,2) NOT NULL,
ADD `vr_deb_29` decimal(20,2) NOT NULL,
ADD `vr_deb_30` decimal(20,2) NOT NULL,
ADD `vr_deb_31` decimal(20,2) NOT NULL,
ADD `vr_deb_32` decimal(20,2) NOT NULL,
ADD `vr_deb_33` decimal(20,2) NOT NULL,
ADD `vr_deb_34` decimal(20,2) NOT NULL,
ADD `vr_deb_35` decimal(20,2) NOT NULL,
ADD `vr_deb_36` decimal(20,2) NOT NULL,
ADD `vr_deb_37` decimal(20,2) NOT NULL,
ADD `vr_deb_38` decimal(20,2) NOT NULL,
ADD `vr_deb_39` decimal(20,2) NOT NULL,
ADD `vr_deb_40` decimal(20,2) NOT NULL,
ADD `vr_deb_41` decimal(20,2) NOT NULL,
ADD `vr_deb_42` decimal(20,2) NOT NULL,
ADD `vr_deb_43` decimal(20,2) NOT NULL,
ADD `vr_deb_44` decimal(20,2) NOT NULL,
ADD `vr_deb_45` decimal(20,2) NOT NULL,
ADD `vr_deb_46` decimal(20,2) NOT NULL,
ADD `vr_deb_47` decimal(20,2) NOT NULL,
ADD `vr_deb_48` decimal(20,2) NOT NULL,
ADD `vr_deb_49` decimal(20,2) NOT NULL,
ADD `vr_deb_50` decimal(20,2) NOT NULL,
ADD `vr_deb_51` decimal(20,2) NOT NULL,
ADD `vr_deb_52` decimal(20,2) NOT NULL,
ADD `vr_deb_53` decimal(20,2) NOT NULL,
ADD `vr_deb_54` decimal(20,2) NOT NULL,
ADD `vr_deb_55` decimal(20,2) NOT NULL,
ADD `vr_deb_56` decimal(20,2) NOT NULL,
ADD `vr_deb_57` decimal(20,2) NOT NULL,
ADD `vr_deb_58` decimal(20,2) NOT NULL,
ADD `vr_deb_59` decimal(20,2) NOT NULL,
ADD `vr_deb_60` decimal(20,2) NOT NULL,
ADD `vr_deb_61` decimal(20,2) NOT NULL,
ADD `vr_deb_62` decimal(20,2) NOT NULL,
ADD `vr_deb_63` decimal(20,2) NOT NULL,
ADD `vr_deb_64` decimal(20,2) NOT NULL,
ADD `vr_deb_65` decimal(20,2) NOT NULL,
ADD `vr_deb_66` decimal(20,2) NOT NULL,
ADD `vr_deb_67` decimal(20,2) NOT NULL,
ADD `vr_deb_68` decimal(20,2) NOT NULL,
ADD `vr_deb_69` decimal(20,2) NOT NULL,
ADD `vr_deb_70` decimal(20,2) NOT NULL,
ADD `vr_deb_71` decimal(20,2) NOT NULL,
ADD `vr_deb_72` decimal(20,2) NOT NULL,
ADD `vr_deb_73` decimal(20,2) NOT NULL,
ADD `vr_deb_74` decimal(20,2) NOT NULL,
ADD `vr_deb_75` decimal(20,2) NOT NULL,
ADD `vr_deb_76` decimal(20,2) NOT NULL,
ADD `vr_deb_77` decimal(20,2) NOT NULL,
ADD `vr_deb_78` decimal(20,2) NOT NULL,
ADD `vr_deb_79` decimal(20,2) NOT NULL,
ADD `vr_deb_80` decimal(20,2) NOT NULL,
ADD `vr_deb_81` decimal(20,2) NOT NULL,
ADD `vr_deb_82` decimal(20,2) NOT NULL,
ADD `vr_deb_83` decimal(20,2) NOT NULL,
ADD `vr_deb_84` decimal(20,2) NOT NULL,
ADD `vr_deb_85` decimal(20,2) NOT NULL,
ADD `vr_deb_86` decimal(20,2) NOT NULL,
ADD `vr_deb_87` decimal(20,2) NOT NULL,
ADD `vr_deb_88` decimal(20,2) NOT NULL,
ADD `vr_deb_89` decimal(20,2) NOT NULL,
ADD `vr_deb_90` decimal(20,2) NOT NULL,
ADD `vr_deb_91` decimal(20,2) NOT NULL,
ADD `vr_deb_92` decimal(20,2) NOT NULL,
ADD `vr_deb_93` decimal(20,2) NOT NULL,
ADD `vr_deb_94` decimal(20,2) NOT NULL,
ADD `vr_deb_95` decimal(20,2) NOT NULL,
ADD `vr_deb_96` decimal(20,2) NOT NULL,
ADD `vr_deb_97` decimal(20,2) NOT NULL,
ADD `vr_deb_98` decimal(20,2) NOT NULL,
ADD `vr_deb_99` decimal(20,2) NOT NULL,
ADD `vr_deb_100` decimal(20,2) NOT NULL,
ADD `vr_deb_101` decimal(20,2) NOT NULL,
ADD `vr_deb_102` decimal(20,2) NOT NULL,
ADD `vr_deb_103` decimal(20,2) NOT NULL,
ADD `vr_deb_104` decimal(20,2) NOT NULL,
ADD `vr_deb_105` decimal(20,2) NOT NULL,
ADD `vr_deb_106` decimal(20,2) NOT NULL,
ADD `vr_deb_107` decimal(20,2) NOT NULL,
ADD `vr_deb_108` decimal(20,2) NOT NULL,
ADD `vr_deb_109` decimal(20,2) NOT NULL,
ADD `vr_deb_110` decimal(20,2) NOT NULL,
ADD `vr_deb_111` decimal(20,2) NOT NULL,
ADD `vr_deb_112` decimal(20,2) NOT NULL,
ADD `vr_deb_113` decimal(20,2) NOT NULL,
ADD `vr_deb_114` decimal(20,2) NOT NULL,
ADD `vr_deb_115` decimal(20,2) NOT NULL,
ADD `vr_deb_116` decimal(20,2) NOT NULL,
ADD `vr_deb_117` decimal(20,2) NOT NULL,
ADD `vr_deb_118` decimal(20,2) NOT NULL,
ADD `vr_deb_119` decimal(20,2) NOT NULL,
ADD `vr_deb_120` decimal(20,2) NOT NULL,
ADD `vr_deb_121` decimal(20,2) NOT NULL,
ADD `vr_deb_122` decimal(20,2) NOT NULL,
ADD `vr_deb_123` decimal(20,2) NOT NULL,
ADD `vr_deb_124` decimal(20,2) NOT NULL,
ADD `vr_deb_125` decimal(20,2) NOT NULL,
ADD `vr_deb_126` decimal(20,2) NOT NULL,
ADD `vr_deb_127` decimal(20,2) NOT NULL,
ADD `vr_deb_128` decimal(20,2) NOT NULL,
ADD `vr_deb_129` decimal(20,2) NOT NULL,
ADD `vr_deb_130` decimal(20,2) NOT NULL,
ADD `vr_deb_131` decimal(20,2) NOT NULL,
ADD `vr_deb_132` decimal(20,2) NOT NULL,
ADD `vr_deb_133` decimal(20,2) NOT NULL,
ADD `vr_deb_134` decimal(20,2) NOT NULL,
ADD `vr_deb_135` decimal(20,2) NOT NULL,
ADD `vr_deb_136` decimal(20,2) NOT NULL,
ADD `vr_deb_137` decimal(20,2) NOT NULL,
ADD `vr_deb_138` decimal(20,2) NOT NULL,
ADD `vr_deb_139` decimal(20,2) NOT NULL,
ADD `vr_deb_140` decimal(20,2) NOT NULL,
ADD `vr_deb_141` decimal(20,2) NOT NULL,
ADD `vr_deb_142` decimal(20,2) NOT NULL,
ADD `vr_deb_143` decimal(20,2) NOT NULL,
ADD `vr_deb_144` decimal(20,2) NOT NULL,
ADD `vr_deb_145` decimal(20,2) NOT NULL,
ADD `vr_deb_146` decimal(20,2) NOT NULL,
ADD `vr_deb_147` decimal(20,2) NOT NULL,
ADD `vr_deb_148` decimal(20,2) NOT NULL,
ADD `vr_deb_149` decimal(20,2) NOT NULL,
ADD `vr_deb_150` decimal(20,2) NOT NULL,
ADD `vr_deb_151` decimal(20,2) NOT NULL,
ADD `vr_deb_152` decimal(20,2) NOT NULL,
ADD `vr_deb_153` decimal(20,2) NOT NULL,
ADD `vr_deb_154` decimal(20,2) NOT NULL,
ADD `vr_deb_155` decimal(20,2) NOT NULL,
ADD `vr_deb_156` decimal(20,2) NOT NULL,
ADD `vr_deb_157` decimal(20,2) NOT NULL,
ADD `vr_deb_158` decimal(20,2) NOT NULL,
ADD `vr_deb_159` decimal(20,2) NOT NULL,
ADD `vr_deb_160` decimal(20,2) NOT NULL,
ADD `vr_cre_16` decimal(20,2) NOT NULL,
ADD `vr_cre_17` decimal(20,2) NOT NULL,
ADD `vr_cre_18` decimal(20,2) NOT NULL,
ADD `vr_cre_19` decimal(20,2) NOT NULL,
ADD `vr_cre_20` decimal(20,2) NOT NULL,
ADD `vr_cre_21` decimal(20,2) NOT NULL,
ADD `vr_cre_22` decimal(20,2) NOT NULL,
ADD `vr_cre_23` decimal(20,2) NOT NULL,
ADD `vr_cre_24` decimal(20,2) NOT NULL,
ADD `vr_cre_25` decimal(20,2) NOT NULL,
ADD `vr_cre_26` decimal(20,2) NOT NULL,
ADD `vr_cre_27` decimal(20,2) NOT NULL,
ADD `vr_cre_28` decimal(20,2) NOT NULL,
ADD `vr_cre_29` decimal(20,2) NOT NULL,
ADD `vr_cre_30` decimal(20,2) NOT NULL,
ADD `vr_cre_31` decimal(20,2) NOT NULL,
ADD `vr_cre_32` decimal(20,2) NOT NULL,
ADD `vr_cre_33` decimal(20,2) NOT NULL,
ADD `vr_cre_34` decimal(20,2) NOT NULL,
ADD `vr_cre_35` decimal(20,2) NOT NULL,
ADD `vr_cre_36` decimal(20,2) NOT NULL,
ADD `vr_cre_37` decimal(20,2) NOT NULL,
ADD `vr_cre_38` decimal(20,2) NOT NULL,
ADD `vr_cre_39` decimal(20,2) NOT NULL,
ADD `vr_cre_40` decimal(20,2) NOT NULL,
ADD `vr_cre_41` decimal(20,2) NOT NULL,
ADD `vr_cre_42` decimal(20,2) NOT NULL,
ADD `vr_cre_43` decimal(20,2) NOT NULL,
ADD `vr_cre_44` decimal(20,2) NOT NULL,
ADD `vr_cre_45` decimal(20,2) NOT NULL,
ADD `vr_cre_46` decimal(20,2) NOT NULL,
ADD `vr_cre_47` decimal(20,2) NOT NULL,
ADD `vr_cre_48` decimal(20,2) NOT NULL,
ADD `vr_cre_49` decimal(20,2) NOT NULL,
ADD `vr_cre_50` decimal(20,2) NOT NULL,
ADD `vr_cre_51` decimal(20,2) NOT NULL,
ADD `vr_cre_52` decimal(20,2) NOT NULL,
ADD `vr_cre_53` decimal(20,2) NOT NULL,
ADD `vr_cre_54` decimal(20,2) NOT NULL,
ADD `vr_cre_55` decimal(20,2) NOT NULL,
ADD `vr_cre_56` decimal(20,2) NOT NULL,
ADD `vr_cre_57` decimal(20,2) NOT NULL,
ADD `vr_cre_58` decimal(20,2) NOT NULL,
ADD `vr_cre_59` decimal(20,2) NOT NULL,
ADD `vr_cre_60` decimal(20,2) NOT NULL,
ADD `vr_cre_61` decimal(20,2) NOT NULL,
ADD `vr_cre_62` decimal(20,2) NOT NULL,
ADD `vr_cre_63` decimal(20,2) NOT NULL,
ADD `vr_cre_64` decimal(20,2) NOT NULL,
ADD `vr_cre_65` decimal(20,2) NOT NULL,
ADD `vr_cre_66` decimal(20,2) NOT NULL,
ADD `vr_cre_67` decimal(20,2) NOT NULL,
ADD `vr_cre_68` decimal(20,2) NOT NULL,
ADD `vr_cre_69` decimal(20,2) NOT NULL,
ADD `vr_cre_70` decimal(20,2) NOT NULL,
ADD `vr_cre_71` decimal(20,2) NOT NULL,
ADD `vr_cre_72` decimal(20,2) NOT NULL,
ADD `vr_cre_73` decimal(20,2) NOT NULL,
ADD `vr_cre_74` decimal(20,2) NOT NULL,
ADD `vr_cre_75` decimal(20,2) NOT NULL,
ADD `vr_cre_76` decimal(20,2) NOT NULL,
ADD `vr_cre_77` decimal(20,2) NOT NULL,
ADD `vr_cre_78` decimal(20,2) NOT NULL,
ADD `vr_cre_79` decimal(20,2) NOT NULL,
ADD `vr_cre_80` decimal(20,2) NOT NULL,
ADD `vr_cre_81` decimal(20,2) NOT NULL,
ADD `vr_cre_82` decimal(20,2) NOT NULL,
ADD `vr_cre_83` decimal(20,2) NOT NULL,
ADD `vr_cre_84` decimal(20,2) NOT NULL,
ADD `vr_cre_85` decimal(20,2) NOT NULL,
ADD `vr_cre_86` decimal(20,2) NOT NULL,
ADD `vr_cre_87` decimal(20,2) NOT NULL,
ADD `vr_cre_88` decimal(20,2) NOT NULL,
ADD `vr_cre_89` decimal(20,2) NOT NULL,
ADD `vr_cre_90` decimal(20,2) NOT NULL,
ADD `vr_cre_91` decimal(20,2) NOT NULL,
ADD `vr_cre_92` decimal(20,2) NOT NULL,
ADD `vr_cre_93` decimal(20,2) NOT NULL,
ADD `vr_cre_94` decimal(20,2) NOT NULL,
ADD `vr_cre_95` decimal(20,2) NOT NULL,
ADD `vr_cre_96` decimal(20,2) NOT NULL,
ADD `vr_cre_97` decimal(20,2) NOT NULL,
ADD `vr_cre_98` decimal(20,2) NOT NULL,
ADD `vr_cre_99` decimal(20,2) NOT NULL,
ADD `vr_cre_100` decimal(20,2) NOT NULL,
ADD `vr_cre_101` decimal(20,2) NOT NULL,
ADD `vr_cre_102` decimal(20,2) NOT NULL,
ADD `vr_cre_103` decimal(20,2) NOT NULL,
ADD `vr_cre_104` decimal(20,2) NOT NULL,
ADD `vr_cre_105` decimal(20,2) NOT NULL,
ADD `vr_cre_106` decimal(20,2) NOT NULL,
ADD `vr_cre_107` decimal(20,2) NOT NULL,
ADD `vr_cre_108` decimal(20,2) NOT NULL,
ADD `vr_cre_109` decimal(20,2) NOT NULL,
ADD `vr_cre_110` decimal(20,2) NOT NULL,
ADD `vr_cre_111` decimal(20,2) NOT NULL,
ADD `vr_cre_112` decimal(20,2) NOT NULL,
ADD `vr_cre_113` decimal(20,2) NOT NULL,
ADD `vr_cre_114` decimal(20,2) NOT NULL,
ADD `vr_cre_115` decimal(20,2) NOT NULL,
ADD `vr_cre_116` decimal(20,2) NOT NULL,
ADD `vr_cre_117` decimal(20,2) NOT NULL,
ADD `vr_cre_118` decimal(20,2) NOT NULL,
ADD `vr_cre_119` decimal(20,2) NOT NULL,
ADD `vr_cre_120` decimal(20,2) NOT NULL,
ADD `vr_cre_121` decimal(20,2) NOT NULL,
ADD `vr_cre_122` decimal(20,2) NOT NULL,
ADD `vr_cre_123` decimal(20,2) NOT NULL,
ADD `vr_cre_124` decimal(20,2) NOT NULL,
ADD `vr_cre_125` decimal(20,2) NOT NULL,
ADD `vr_cre_126` decimal(20,2) NOT NULL,
ADD `vr_cre_127` decimal(20,2) NOT NULL,
ADD `vr_cre_128` decimal(20,2) NOT NULL,
ADD `vr_cre_129` decimal(20,2) NOT NULL,
ADD `vr_cre_130` decimal(20,2) NOT NULL,
ADD `vr_cre_131` decimal(20,2) NOT NULL,
ADD `vr_cre_132` decimal(20,2) NOT NULL,
ADD `vr_cre_133` decimal(20,2) NOT NULL,
ADD `vr_cre_134` decimal(20,2) NOT NULL,
ADD `vr_cre_135` decimal(20,2) NOT NULL,
ADD `vr_cre_136` decimal(20,2) NOT NULL,
ADD `vr_cre_137` decimal(20,2) NOT NULL,
ADD `vr_cre_138` decimal(20,2) NOT NULL,
ADD `vr_cre_139` decimal(20,2) NOT NULL,
ADD `vr_cre_140` decimal(20,2) NOT NULL,
ADD `vr_cre_141` decimal(20,2) NOT NULL,
ADD `vr_cre_142` decimal(20,2) NOT NULL,
ADD `vr_cre_143` decimal(20,2) NOT NULL,
ADD `vr_cre_144` decimal(20,2) NOT NULL,
ADD `vr_cre_145` decimal(20,2) NOT NULL,
ADD `vr_cre_146` decimal(20,2) NOT NULL,
ADD `vr_cre_147` decimal(20,2) NOT NULL,
ADD `vr_cre_148` decimal(20,2) NOT NULL,
ADD `vr_cre_149` decimal(20,2) NOT NULL,
ADD `vr_cre_150` decimal(20,2) NOT NULL,
ADD `vr_cre_151` decimal(20,2) NOT NULL,
ADD `vr_cre_152` decimal(20,2) NOT NULL,
ADD `vr_cre_153` decimal(20,2) NOT NULL,
ADD `vr_cre_154` decimal(20,2) NOT NULL,
ADD `vr_cre_155` decimal(20,2) NOT NULL,
ADD `vr_cre_156` decimal(20,2) NOT NULL,
ADD `vr_cre_157` decimal(20,2) NOT NULL,
ADD `vr_cre_158` decimal(20,2) NOT NULL,
ADD `vr_cre_159` decimal(20,2) NOT NULL,
ADD `vr_cre_160` decimal(20,2) NOT NULL,
ADD cheque_1 varchar(50) not null,
ADD cheque_2 varchar(50) not null,
ADD cheque_3 varchar(50) not null,
ADD cheque_4 varchar(50) not null,
ADD cheque_5 varchar(50) not null,
ADD cheque_6 varchar(50) not null,
ADD cheque_7 varchar(50) not null,
ADD cheque_8 varchar(50) not null,
ADD cheque_9 varchar(50) not null,
ADD cheque_10 varchar(50) not null,
ADD cheque_11 varchar(50) not null,
ADD cheque_12 varchar(50) not null,
ADD cheque_13 varchar(50) not null,
ADD cheque_14 varchar(50) not null,
ADD cheque_15 varchar(50) not null,
ADD cheque_16 varchar(50) not null,
ADD cheque_17 varchar(50) not null,
ADD cheque_18 varchar(50) not null,
ADD cheque_19 varchar(50) not null,
ADD cheque_20 varchar(50) not null
";


		if ($conexion->query($anadir)) {
			echo "";
		} else {
			echo "";
		};

		//************************* fin de act bd
		printf("<br><br><center class='Estilo1'>Base de Datos Actualizada con Exito<br><br><img src=\"../actualizacion_bd.png\" width='48' height='48' /></center>");

		printf("<br><br><u><center class='Estilo1' <br> <center>Este atento a nuevas actualizaciones del Sistema GCP<br>
		   Verifique constantemente su casilla de correo electronico</center></u>");


		printf("
<br><br>
<center class='Estilo4'>
<form method='post' action='../user.php'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

		$conexion = null;
	} else { // si no tiene persisos de usuario
		echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
		echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
	}
}
?><title>CONTAFACIL</title>