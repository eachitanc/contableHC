<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	include('../config.php');

	// conexion				
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$tipa = $tipb = $tipc = $tipd = $tipe = $tipf = $tipg = $tiph = $tipi = $tipj = $tipk = $tipl = $tipm = $tipn = $tipo = '';
	// id_emp
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	$ter_nat = '';
	$ter_jur = '';
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
	}


	$id_reip = '';
	$id_caic = '';
	$id_unico_reip = '';
	$vr_orig_reip = 0;
	$id_manu_rcgt = 'TNAT' . $_POST['id_manu_rcgt'];
	$id_recau = $_POST['consec_ncbt'];
	$fecha_recaudo = $_POST['fecha_recaudo'];
	$des_recaudo = strtoupper($_POST['des_recaudo']);
	$filas = $_POST['filas'];

	//union de terceros
	$terd = explode("-", $_POST['tercero']);
	$tercero = $terd[1];
	$ter = $terd[0]; //


	$pgcp1 = isset($_POST['pgcp1']) ? $_POST['pgcp1'] : 0; // printf("<br>pgcp que llega %s<br>",$pgcp1);
	$pgcp2 = isset($_POST['pgcp2']) ? $_POST['pgcp2'] : 0;
	$pgcp3 = isset($_POST['pgcp3']) ? $_POST['pgcp3'] : 0;
	$pgcp4 = isset($_POST['pgcp4']) ? $_POST['pgcp4'] : 0;
	$pgcp5 = isset($_POST['pgcp5']) ? $_POST['pgcp5'] : 0;
	$pgcp6 = isset($_POST['pgcp6']) ? $_POST['pgcp6'] : 0;
	$pgcp7 = isset($_POST['pgcp7']) ? $_POST['pgcp7'] : 0;
	$pgcp8 = isset($_POST['pgcp8']) ? $_POST['pgcp8'] : 0;
	$pgcp9 = isset($_POST['pgcp9']) ? $_POST['pgcp9'] : 0;
	$pgcp10 = isset($_POST['pgcp10']) ? $_POST['pgcp10'] : 0;
	$pgcp11 = isset($_POST['pgcp11']) ? $_POST['pgcp11'] : 0;
	$pgcp12 = isset($_POST['pgcp12']) ? $_POST['pgcp12'] : 0;
	$pgcp13 = isset($_POST['pgcp13']) ? $_POST['pgcp13'] : 0;
	$pgcp14 = isset($_POST['pgcp14']) ? $_POST['pgcp14'] : 0;
	$pgcp15 = isset($_POST['pgcp15']) ? $_POST['pgcp15'] : 0;
	$pgcp16 = isset($_POST['pgcp16']) ? $_POST['pgcp16'] : 0;
	$pgcp17 = isset($_POST['pgcp17']) ? $_POST['pgcp17'] : 0;
	$pgcp18 = isset($_POST['pgcp18']) ? $_POST['pgcp18'] : 0;
	$pgcp19 = isset($_POST['pgcp19']) ? $_POST['pgcp19'] : 0;
	$pgcp20 = isset($_POST['pgcp20']) ? $_POST['pgcp20'] : 0;
	$pgcp21 = isset($_POST['pgcp21']) ? $_POST['pgcp21'] : 0;
	$pgcp22 = isset($_POST['pgcp22']) ? $_POST['pgcp22'] : 0;
	$pgcp23 = isset($_POST['pgcp23']) ? $_POST['pgcp23'] : 0;
	$pgcp24 = isset($_POST['pgcp24']) ? $_POST['pgcp24'] : 0;
	$pgcp25 = isset($_POST['pgcp25']) ? $_POST['pgcp25'] : 0;
	$pgcp26 = isset($_POST['pgcp26']) ? $_POST['pgcp26'] : 0;
	$pgcp27 = isset($_POST['pgcp27']) ? $_POST['pgcp27'] : 0;
	$pgcp28 = isset($_POST['pgcp28']) ? $_POST['pgcp28'] : 0;
	$pgcp29 = isset($_POST['pgcp29']) ? $_POST['pgcp29'] : 0;
	$pgcp30 = isset($_POST['pgcp30']) ? $_POST['pgcp30'] : 0;
	$pgcp31 = isset($_POST['pgcp31']) ? $_POST['pgcp31'] : 0;
	$pgcp32 = isset($_POST['pgcp32']) ? $_POST['pgcp32'] : 0;
	$pgcp33 = isset($_POST['pgcp33']) ? $_POST['pgcp33'] : 0;
	$pgcp34 = isset($_POST['pgcp34']) ? $_POST['pgcp34'] : 0;
	$pgcp35 = isset($_POST['pgcp35']) ? $_POST['pgcp35'] : 0;
	$pgcp36 = isset($_POST['pgcp36']) ? $_POST['pgcp36'] : 0;
	$pgcp37 = isset($_POST['pgcp37']) ? $_POST['pgcp37'] : 0;
	$pgcp38 = isset($_POST['pgcp38']) ? $_POST['pgcp38'] : 0;
	$pgcp39 = isset($_POST['pgcp39']) ? $_POST['pgcp39'] : 0;
	$pgcp40 = isset($_POST['pgcp40']) ? $_POST['pgcp40'] : 0;
	$pgcp41 = isset($_POST['pgcp41']) ? $_POST['pgcp41'] : 0;
	$pgcp42 = isset($_POST['pgcp42']) ? $_POST['pgcp42'] : 0;
	$pgcp43 = isset($_POST['pgcp43']) ? $_POST['pgcp43'] : 0;
	$pgcp44 = isset($_POST['pgcp44']) ? $_POST['pgcp44'] : 0;
	$pgcp45 = isset($_POST['pgcp45']) ? $_POST['pgcp45'] : 0;
	$pgcp46 = isset($_POST['pgcp46']) ? $_POST['pgcp46'] : 0;
	$pgcp47 = isset($_POST['pgcp47']) ? $_POST['pgcp47'] : 0;
	$pgcp48 = isset($_POST['pgcp48']) ? $_POST['pgcp48'] : 0;
	$pgcp49 = isset($_POST['pgcp49']) ? $_POST['pgcp49'] : 0;
	$pgcp50 = isset($_POST['pgcp50']) ? $_POST['pgcp50'] : 0;
	$pgcp51 = isset($_POST['pgcp51']) ? $_POST['pgcp51'] : 0;
	$pgcp52 = isset($_POST['pgcp52']) ? $_POST['pgcp52'] : 0;
	$pgcp53 = isset($_POST['pgcp53']) ? $_POST['pgcp53'] : 0;
	$pgcp54 = isset($_POST['pgcp54']) ? $_POST['pgcp54'] : 0;
	$pgcp55 = isset($_POST['pgcp55']) ? $_POST['pgcp55'] : 0;
	$pgcp56 = isset($_POST['pgcp56']) ? $_POST['pgcp56'] : 0;
	$pgcp57 = isset($_POST['pgcp57']) ? $_POST['pgcp57'] : 0;
	$pgcp58 = isset($_POST['pgcp58']) ? $_POST['pgcp58'] : 0;
	$pgcp59 = isset($_POST['pgcp59']) ? $_POST['pgcp59'] : 0;
	$pgcp60 = isset($_POST['pgcp60']) ? $_POST['pgcp60'] : 0;
	$pgcp61 = isset($_POST['pgcp61']) ? $_POST['pgcp61'] : 0;
	$pgcp62 = isset($_POST['pgcp62']) ? $_POST['pgcp62'] : 0;
	$pgcp63 = isset($_POST['pgcp63']) ? $_POST['pgcp63'] : 0;
	$pgcp64 = isset($_POST['pgcp64']) ? $_POST['pgcp64'] : 0;
	$pgcp65 = isset($_POST['pgcp65']) ? $_POST['pgcp65'] : 0;
	$pgcp66 = isset($_POST['pgcp66']) ? $_POST['pgcp66'] : 0;
	$pgcp67 = isset($_POST['pgcp67']) ? $_POST['pgcp67'] : 0;
	$pgcp68 = isset($_POST['pgcp68']) ? $_POST['pgcp68'] : 0;
	$pgcp69 = isset($_POST['pgcp69']) ? $_POST['pgcp69'] : 0;
	$pgcp70 = isset($_POST['pgcp70']) ? $_POST['pgcp70'] : 0;
	$pgcp71 = isset($_POST['pgcp71']) ? $_POST['pgcp71'] : 0;
	$pgcp72 = isset($_POST['pgcp72']) ? $_POST['pgcp72'] : 0;
	$pgcp73 = isset($_POST['pgcp73']) ? $_POST['pgcp73'] : 0;
	$pgcp74 = isset($_POST['pgcp74']) ? $_POST['pgcp74'] : 0;
	$pgcp75 = isset($_POST['pgcp75']) ? $_POST['pgcp75'] : 0;
	$pgcp76 = isset($_POST['pgcp76']) ? $_POST['pgcp76'] : 0;
	$pgcp77 = isset($_POST['pgcp77']) ? $_POST['pgcp77'] : 0;
	$pgcp78 = isset($_POST['pgcp78']) ? $_POST['pgcp78'] : 0;
	$pgcp79 = isset($_POST['pgcp79']) ? $_POST['pgcp79'] : 0;
	$pgcp80 = isset($_POST['pgcp80']) ? $_POST['pgcp80'] : 0;
	$pgcp81 = isset($_POST['pgcp81']) ? $_POST['pgcp81'] : 0;
	$pgcp82 = isset($_POST['pgcp82']) ? $_POST['pgcp82'] : 0;
	$pgcp83 = isset($_POST['pgcp83']) ? $_POST['pgcp83'] : 0;
	$pgcp84 = isset($_POST['pgcp84']) ? $_POST['pgcp84'] : 0;
	$pgcp85 = isset($_POST['pgcp85']) ? $_POST['pgcp85'] : 0;
	$pgcp86 = isset($_POST['pgcp86']) ? $_POST['pgcp86'] : 0;
	$pgcp87 = isset($_POST['pgcp87']) ? $_POST['pgcp87'] : 0;
	$pgcp88 = isset($_POST['pgcp88']) ? $_POST['pgcp88'] : 0;
	$pgcp89 = isset($_POST['pgcp89']) ? $_POST['pgcp89'] : 0;
	$pgcp90 = isset($_POST['pgcp90']) ? $_POST['pgcp90'] : 0;
	$pgcp91 = isset($_POST['pgcp91']) ? $_POST['pgcp91'] : 0;
	$pgcp92 = isset($_POST['pgcp92']) ? $_POST['pgcp92'] : 0;
	$pgcp93 = isset($_POST['pgcp93']) ? $_POST['pgcp93'] : 0;
	$pgcp94 = isset($_POST['pgcp94']) ? $_POST['pgcp94'] : 0;
	$pgcp95 = isset($_POST['pgcp95']) ? $_POST['pgcp95'] : 0;
	$pgcp96 = isset($_POST['pgcp96']) ? $_POST['pgcp96'] : 0;
	$pgcp97 = isset($_POST['pgcp97']) ? $_POST['pgcp97'] : 0;
	$pgcp98 = isset($_POST['pgcp98']) ? $_POST['pgcp98'] : 0;
	$pgcp99 = isset($_POST['pgcp99']) ? $_POST['pgcp99'] : 0;
	$pgcp100 = isset($_POST['pgcp100']) ? $_POST['pgcp100'] : 0;
	$pgcp101 = isset($_POST['pgcp101']) ? $_POST['pgcp101'] : 0;
	$pgcp102 = isset($_POST['pgcp102']) ? $_POST['pgcp102'] : 0;
	$pgcp103 = isset($_POST['pgcp103']) ? $_POST['pgcp103'] : 0;
	$pgcp104 = isset($_POST['pgcp104']) ? $_POST['pgcp104'] : 0;
	$pgcp105 = isset($_POST['pgcp105']) ? $_POST['pgcp105'] : 0;
	$pgcp106 = isset($_POST['pgcp106']) ? $_POST['pgcp106'] : 0;
	$pgcp107 = isset($_POST['pgcp107']) ? $_POST['pgcp107'] : 0;
	$pgcp108 = isset($_POST['pgcp108']) ? $_POST['pgcp108'] : 0;
	$pgcp109 = isset($_POST['pgcp109']) ? $_POST['pgcp109'] : 0;
	$pgcp110 = isset($_POST['pgcp110']) ? $_POST['pgcp110'] : 0;
	$pgcp111 = isset($_POST['pgcp111']) ? $_POST['pgcp111'] : 0;
	$pgcp112 = isset($_POST['pgcp112']) ? $_POST['pgcp112'] : 0;
	$pgcp113 = isset($_POST['pgcp113']) ? $_POST['pgcp113'] : 0;
	$pgcp114 = isset($_POST['pgcp114']) ? $_POST['pgcp114'] : 0;
	$pgcp115 = isset($_POST['pgcp115']) ? $_POST['pgcp115'] : 0;
	$pgcp116 = isset($_POST['pgcp116']) ? $_POST['pgcp116'] : 0;
	$pgcp117 = isset($_POST['pgcp117']) ? $_POST['pgcp117'] : 0;
	$pgcp118 = isset($_POST['pgcp118']) ? $_POST['pgcp118'] : 0;
	$pgcp119 = isset($_POST['pgcp119']) ? $_POST['pgcp119'] : 0;
	$pgcp120 = isset($_POST['pgcp120']) ? $_POST['pgcp120'] : 0;
	$pgcp121 = isset($_POST['pgcp121']) ? $_POST['pgcp121'] : 0;
	$pgcp122 = isset($_POST['pgcp122']) ? $_POST['pgcp122'] : 0;
	$pgcp123 = isset($_POST['pgcp123']) ? $_POST['pgcp123'] : 0;
	$pgcp124 = isset($_POST['pgcp124']) ? $_POST['pgcp124'] : 0;
	$pgcp125 = isset($_POST['pgcp125']) ? $_POST['pgcp125'] : 0;
	$pgcp126 = isset($_POST['pgcp126']) ? $_POST['pgcp126'] : 0;
	$pgcp127 = isset($_POST['pgcp127']) ? $_POST['pgcp127'] : 0;
	$pgcp128 = isset($_POST['pgcp128']) ? $_POST['pgcp128'] : 0;
	$pgcp129 = isset($_POST['pgcp129']) ? $_POST['pgcp129'] : 0;
	$pgcp130 = isset($_POST['pgcp130']) ? $_POST['pgcp130'] : 0;
	$pgcp131 = isset($_POST['pgcp131']) ? $_POST['pgcp131'] : 0;
	$pgcp132 = isset($_POST['pgcp132']) ? $_POST['pgcp132'] : 0;
	$pgcp133 = isset($_POST['pgcp133']) ? $_POST['pgcp133'] : 0;
	$pgcp134 = isset($_POST['pgcp134']) ? $_POST['pgcp134'] : 0;
	$pgcp135 = isset($_POST['pgcp135']) ? $_POST['pgcp135'] : 0;
	$pgcp136 = isset($_POST['pgcp136']) ? $_POST['pgcp136'] : 0;
	$pgcp137 = isset($_POST['pgcp137']) ? $_POST['pgcp137'] : 0;
	$pgcp138 = isset($_POST['pgcp138']) ? $_POST['pgcp138'] : 0;
	$pgcp139 = isset($_POST['pgcp139']) ? $_POST['pgcp139'] : 0;
	$pgcp140 = isset($_POST['pgcp140']) ? $_POST['pgcp140'] : 0;
	$pgcp141 = isset($_POST['pgcp141']) ? $_POST['pgcp141'] : 0;
	$pgcp142 = isset($_POST['pgcp142']) ? $_POST['pgcp142'] : 0;
	$pgcp143 = isset($_POST['pgcp143']) ? $_POST['pgcp143'] : 0;
	$pgcp144 = isset($_POST['pgcp144']) ? $_POST['pgcp144'] : 0;
	$pgcp145 = isset($_POST['pgcp145']) ? $_POST['pgcp145'] : 0;
	$pgcp146 = isset($_POST['pgcp146']) ? $_POST['pgcp146'] : 0;
	$pgcp147 = isset($_POST['pgcp147']) ? $_POST['pgcp147'] : 0;
	$pgcp148 = isset($_POST['pgcp148']) ? $_POST['pgcp148'] : 0;
	$pgcp149 = isset($_POST['pgcp149']) ? $_POST['pgcp149'] : 0;
	$pgcp150 = isset($_POST['pgcp150']) ? $_POST['pgcp150'] : 0;
	$pgcp151 = isset($_POST['pgcp151']) ? $_POST['pgcp151'] : 0;
	$pgcp152 = isset($_POST['pgcp152']) ? $_POST['pgcp152'] : 0;
	$pgcp153 = isset($_POST['pgcp153']) ? $_POST['pgcp153'] : 0;
	$pgcp154 = isset($_POST['pgcp154']) ? $_POST['pgcp154'] : 0;
	$pgcp155 = isset($_POST['pgcp155']) ? $_POST['pgcp155'] : 0;
	$pgcp156 = isset($_POST['pgcp156']) ? $_POST['pgcp156'] : 0;
	$pgcp157 = isset($_POST['pgcp157']) ? $_POST['pgcp157'] : 0;
	$pgcp158 = isset($_POST['pgcp158']) ? $_POST['pgcp158'] : 0;
	$pgcp159 = isset($_POST['pgcp159']) ? $_POST['pgcp159'] : 0;
	$pgcp160 = isset($_POST['pgcp160']) ? $_POST['pgcp160'] : 0;

	$des1 = isset($_POST['des1']) ? $_POST['des1'] : 0;
	$des2 = isset($_POST['des2']) ? $_POST['des2'] : 0;
	$des3 = isset($_POST['des3']) ? $_POST['des3'] : 0;
	$des4 = isset($_POST['des4']) ? $_POST['des4'] : 0;
	$des5 = isset($_POST['des5']) ? $_POST['des5'] : 0;
	$des6 = isset($_POST['des6']) ? $_POST['des6'] : 0;
	$des7 = isset($_POST['des7']) ? $_POST['des7'] : 0;
	$des8 = isset($_POST['des8']) ? $_POST['des8'] : 0;
	$des9 = isset($_POST['des9']) ? $_POST['des9'] : 0;
	$des10 = isset($_POST['des10']) ? $_POST['des10'] : 0;
	$des11 = isset($_POST['des11']) ? $_POST['des11'] : 0;
	$des12 = isset($_POST['des12']) ? $_POST['des12'] : 0;
	$des13 = isset($_POST['des13']) ? $_POST['des13'] : 0;
	$des14 = isset($_POST['des14']) ? $_POST['des14'] : 0;
	$des15 = isset($_POST['des15']) ? $_POST['des15'] : 0;

	$vr_deb_1 = str_replace(',', '', isset($_POST['vr_deb_1']) ? $_POST['vr_deb_1'] : 0);
	$vr_deb_2 = str_replace(',', '', isset($_POST['vr_deb_2']) ? $_POST['vr_deb_2'] : 0);
	$vr_deb_3 = str_replace(',', '', isset($_POST['vr_deb_3']) ? $_POST['vr_deb_3'] : 0);
	$vr_deb_4 = str_replace(',', '', isset($_POST['vr_deb_4']) ? $_POST['vr_deb_4'] : 0);
	$vr_deb_5 = str_replace(',', '', isset($_POST['vr_deb_5']) ? $_POST['vr_deb_5'] : 0);
	$vr_deb_6 = str_replace(',', '', isset($_POST['vr_deb_6']) ? $_POST['vr_deb_6'] : 0);
	$vr_deb_7 = str_replace(',', '', isset($_POST['vr_deb_7']) ? $_POST['vr_deb_7'] : 0);
	$vr_deb_8 = str_replace(',', '', isset($_POST['vr_deb_8']) ? $_POST['vr_deb_8'] : 0);
	$vr_deb_9 = str_replace(',', '', isset($_POST['vr_deb_9']) ? $_POST['vr_deb_9'] : 0);
	$vr_deb_10 = str_replace(',', '', isset($_POST['vr_deb_10']) ? $_POST['vr_deb_10'] : 0);
	$vr_deb_11 = str_replace(',', '', isset($_POST['vr_deb_11']) ? $_POST['vr_deb_11'] : 0);
	$vr_deb_12 = str_replace(',', '', isset($_POST['vr_deb_12']) ? $_POST['vr_deb_12'] : 0);
	$vr_deb_13 = str_replace(',', '', isset($_POST['vr_deb_13']) ? $_POST['vr_deb_13'] : 0);
	$vr_deb_14 = str_replace(',', '', isset($_POST['vr_deb_14']) ? $_POST['vr_deb_14'] : 0);
	$vr_deb_15 = str_replace(',', '', isset($_POST['vr_deb_15']) ? $_POST['vr_deb_15'] : 0);
	$vr_deb_16 = str_replace(',', '', isset($_POST['vr_deb_16']) ? $_POST['vr_deb_16'] : 0);
	$vr_deb_17 = str_replace(',', '', isset($_POST['vr_deb_17']) ? $_POST['vr_deb_17'] : 0);
	$vr_deb_18 = str_replace(',', '', isset($_POST['vr_deb_18']) ? $_POST['vr_deb_18'] : 0);
	$vr_deb_19 = str_replace(',', '', isset($_POST['vr_deb_19']) ? $_POST['vr_deb_19'] : 0);
	$vr_deb_20 = str_replace(',', '', isset($_POST['vr_deb_20']) ? $_POST['vr_deb_20'] : 0);
	$vr_deb_21 = str_replace(',', '', isset($_POST['vr_deb_21']) ? $_POST['vr_deb_21'] : 0);
	$vr_deb_22 = str_replace(',', '', isset($_POST['vr_deb_22']) ? $_POST['vr_deb_22'] : 0);
	$vr_deb_23 = str_replace(',', '', isset($_POST['vr_deb_23']) ? $_POST['vr_deb_23'] : 0);
	$vr_deb_24 = str_replace(',', '', isset($_POST['vr_deb_24']) ? $_POST['vr_deb_24'] : 0);
	$vr_deb_25 = str_replace(',', '', isset($_POST['vr_deb_25']) ? $_POST['vr_deb_25'] : 0);
	$vr_deb_26 = str_replace(',', '', isset($_POST['vr_deb_26']) ? $_POST['vr_deb_26'] : 0);
	$vr_deb_27 = str_replace(',', '', isset($_POST['vr_deb_27']) ? $_POST['vr_deb_27'] : 0);
	$vr_deb_28 = str_replace(',', '', isset($_POST['vr_deb_28']) ? $_POST['vr_deb_28'] : 0);
	$vr_deb_29 = str_replace(',', '', isset($_POST['vr_deb_29']) ? $_POST['vr_deb_29'] : 0);
	$vr_deb_30 = str_replace(',', '', isset($_POST['vr_deb_30']) ? $_POST['vr_deb_30'] : 0);
	$vr_deb_31 = str_replace(',', '', isset($_POST['vr_deb_31']) ? $_POST['vr_deb_31'] : 0);
	$vr_deb_32 = str_replace(',', '', isset($_POST['vr_deb_32']) ? $_POST['vr_deb_32'] : 0);
	$vr_deb_33 = str_replace(',', '', isset($_POST['vr_deb_33']) ? $_POST['vr_deb_33'] : 0);
	$vr_deb_34 = str_replace(',', '', isset($_POST['vr_deb_34']) ? $_POST['vr_deb_34'] : 0);
	$vr_deb_35 = str_replace(',', '', isset($_POST['vr_deb_35']) ? $_POST['vr_deb_35'] : 0);
	$vr_deb_36 = str_replace(',', '', isset($_POST['vr_deb_36']) ? $_POST['vr_deb_36'] : 0);
	$vr_deb_37 = str_replace(',', '', isset($_POST['vr_deb_37']) ? $_POST['vr_deb_37'] : 0);
	$vr_deb_38 = str_replace(',', '', isset($_POST['vr_deb_38']) ? $_POST['vr_deb_38'] : 0);
	$vr_deb_39 = str_replace(',', '', isset($_POST['vr_deb_39']) ? $_POST['vr_deb_39'] : 0);
	$vr_deb_40 = str_replace(',', '', isset($_POST['vr_deb_40']) ? $_POST['vr_deb_40'] : 0);
	$vr_deb_41 = str_replace(',', '', isset($_POST['vr_deb_41']) ? $_POST['vr_deb_41'] : 0);
	$vr_deb_42 = str_replace(',', '', isset($_POST['vr_deb_42']) ? $_POST['vr_deb_42'] : 0);
	$vr_deb_43 = str_replace(',', '', isset($_POST['vr_deb_43']) ? $_POST['vr_deb_43'] : 0);
	$vr_deb_44 = str_replace(',', '', isset($_POST['vr_deb_44']) ? $_POST['vr_deb_44'] : 0);
	$vr_deb_45 = str_replace(',', '', isset($_POST['vr_deb_45']) ? $_POST['vr_deb_45'] : 0);
	$vr_deb_46 = str_replace(',', '', isset($_POST['vr_deb_46']) ? $_POST['vr_deb_46'] : 0);
	$vr_deb_47 = str_replace(',', '', isset($_POST['vr_deb_47']) ? $_POST['vr_deb_47'] : 0);
	$vr_deb_48 = str_replace(',', '', isset($_POST['vr_deb_48']) ? $_POST['vr_deb_48'] : 0);
	$vr_deb_49 = str_replace(',', '', isset($_POST['vr_deb_49']) ? $_POST['vr_deb_49'] : 0);
	$vr_deb_50 = str_replace(',', '', isset($_POST['vr_deb_50']) ? $_POST['vr_deb_50'] : 0);
	$vr_deb_51 = str_replace(',', '', isset($_POST['vr_deb_51']) ? $_POST['vr_deb_51'] : 0);
	$vr_deb_52 = str_replace(',', '', isset($_POST['vr_deb_52']) ? $_POST['vr_deb_52'] : 0);
	$vr_deb_53 = str_replace(',', '', isset($_POST['vr_deb_53']) ? $_POST['vr_deb_53'] : 0);
	$vr_deb_54 = str_replace(',', '', isset($_POST['vr_deb_54']) ? $_POST['vr_deb_54'] : 0);
	$vr_deb_55 = str_replace(',', '', isset($_POST['vr_deb_55']) ? $_POST['vr_deb_55'] : 0);
	$vr_deb_56 = str_replace(',', '', isset($_POST['vr_deb_56']) ? $_POST['vr_deb_56'] : 0);
	$vr_deb_57 = str_replace(',', '', isset($_POST['vr_deb_57']) ? $_POST['vr_deb_57'] : 0);
	$vr_deb_58 = str_replace(',', '', isset($_POST['vr_deb_58']) ? $_POST['vr_deb_58'] : 0);
	$vr_deb_59 = str_replace(',', '', isset($_POST['vr_deb_59']) ? $_POST['vr_deb_59'] : 0);
	$vr_deb_60 = str_replace(',', '', isset($_POST['vr_deb_60']) ? $_POST['vr_deb_60'] : 0);
	$vr_deb_61 = str_replace(',', '', isset($_POST['vr_deb_61']) ? $_POST['vr_deb_61'] : 0);
	$vr_deb_62 = str_replace(',', '', isset($_POST['vr_deb_62']) ? $_POST['vr_deb_62'] : 0);
	$vr_deb_63 = str_replace(',', '', isset($_POST['vr_deb_63']) ? $_POST['vr_deb_63'] : 0);
	$vr_deb_64 = str_replace(',', '', isset($_POST['vr_deb_64']) ? $_POST['vr_deb_64'] : 0);
	$vr_deb_65 = str_replace(',', '', isset($_POST['vr_deb_65']) ? $_POST['vr_deb_65'] : 0);
	$vr_deb_66 = str_replace(',', '', isset($_POST['vr_deb_66']) ? $_POST['vr_deb_66'] : 0);
	$vr_deb_67 = str_replace(',', '', isset($_POST['vr_deb_67']) ? $_POST['vr_deb_67'] : 0);
	$vr_deb_68 = str_replace(',', '', isset($_POST['vr_deb_68']) ? $_POST['vr_deb_68'] : 0);
	$vr_deb_69 = str_replace(',', '', isset($_POST['vr_deb_69']) ? $_POST['vr_deb_69'] : 0);
	$vr_deb_70 = str_replace(',', '', isset($_POST['vr_deb_70']) ? $_POST['vr_deb_70'] : 0);
	$vr_deb_71 = str_replace(',', '', isset($_POST['vr_deb_71']) ? $_POST['vr_deb_71'] : 0);
	$vr_deb_72 = str_replace(',', '', isset($_POST['vr_deb_72']) ? $_POST['vr_deb_72'] : 0);
	$vr_deb_73 = str_replace(',', '', isset($_POST['vr_deb_73']) ? $_POST['vr_deb_73'] : 0);
	$vr_deb_74 = str_replace(',', '', isset($_POST['vr_deb_74']) ? $_POST['vr_deb_74'] : 0);
	$vr_deb_75 = str_replace(',', '', isset($_POST['vr_deb_75']) ? $_POST['vr_deb_75'] : 0);
	$vr_deb_76 = str_replace(',', '', isset($_POST['vr_deb_76']) ? $_POST['vr_deb_76'] : 0);
	$vr_deb_77 = str_replace(',', '', isset($_POST['vr_deb_77']) ? $_POST['vr_deb_77'] : 0);
	$vr_deb_78 = str_replace(',', '', isset($_POST['vr_deb_78']) ? $_POST['vr_deb_78'] : 0);
	$vr_deb_79 = str_replace(',', '', isset($_POST['vr_deb_79']) ? $_POST['vr_deb_79'] : 0);
	$vr_deb_80 = str_replace(',', '', isset($_POST['vr_deb_80']) ? $_POST['vr_deb_80'] : 0);
	$vr_deb_81 = str_replace(',', '', isset($_POST['vr_deb_81']) ? $_POST['vr_deb_81'] : 0);
	$vr_deb_82 = str_replace(',', '', isset($_POST['vr_deb_82']) ? $_POST['vr_deb_82'] : 0);
	$vr_deb_83 = str_replace(',', '', isset($_POST['vr_deb_83']) ? $_POST['vr_deb_83'] : 0);
	$vr_deb_84 = str_replace(',', '', isset($_POST['vr_deb_84']) ? $_POST['vr_deb_84'] : 0);
	$vr_deb_85 = str_replace(',', '', isset($_POST['vr_deb_85']) ? $_POST['vr_deb_85'] : 0);
	$vr_deb_86 = str_replace(',', '', isset($_POST['vr_deb_86']) ? $_POST['vr_deb_86'] : 0);
	$vr_deb_87 = str_replace(',', '', isset($_POST['vr_deb_87']) ? $_POST['vr_deb_87'] : 0);
	$vr_deb_88 = str_replace(',', '', isset($_POST['vr_deb_88']) ? $_POST['vr_deb_88'] : 0);
	$vr_deb_89 = str_replace(',', '', isset($_POST['vr_deb_89']) ? $_POST['vr_deb_89'] : 0);
	$vr_deb_90 = str_replace(',', '', isset($_POST['vr_deb_90']) ? $_POST['vr_deb_90'] : 0);
	$vr_deb_91 = str_replace(',', '', isset($_POST['vr_deb_91']) ? $_POST['vr_deb_91'] : 0);
	$vr_deb_92 = str_replace(',', '', isset($_POST['vr_deb_92']) ? $_POST['vr_deb_92'] : 0);
	$vr_deb_93 = str_replace(',', '', isset($_POST['vr_deb_93']) ? $_POST['vr_deb_93'] : 0);
	$vr_deb_94 = str_replace(',', '', isset($_POST['vr_deb_94']) ? $_POST['vr_deb_94'] : 0);
	$vr_deb_95 = str_replace(',', '', isset($_POST['vr_deb_95']) ? $_POST['vr_deb_95'] : 0);
	$vr_deb_96 = str_replace(',', '', isset($_POST['vr_deb_96']) ? $_POST['vr_deb_96'] : 0);
	$vr_deb_97 = str_replace(',', '', isset($_POST['vr_deb_97']) ? $_POST['vr_deb_97'] : 0);
	$vr_deb_98 = str_replace(',', '', isset($_POST['vr_deb_98']) ? $_POST['vr_deb_98'] : 0);
	$vr_deb_99 = str_replace(',', '', isset($_POST['vr_deb_99']) ? $_POST['vr_deb_99'] : 0);
	$vr_deb_100 = str_replace(',', '', isset($_POST['vr_deb_100']) ? $_POST['vr_deb_100'] : 0);
	$vr_deb_101 = str_replace(',', '', isset($_POST['vr_deb_101']) ? $_POST['vr_deb_101'] : 0);
	$vr_deb_102 = str_replace(',', '', isset($_POST['vr_deb_102']) ? $_POST['vr_deb_102'] : 0);
	$vr_deb_103 = str_replace(',', '', isset($_POST['vr_deb_103']) ? $_POST['vr_deb_103'] : 0);
	$vr_deb_104 = str_replace(',', '', isset($_POST['vr_deb_104']) ? $_POST['vr_deb_104'] : 0);
	$vr_deb_105 = str_replace(',', '', isset($_POST['vr_deb_105']) ? $_POST['vr_deb_105'] : 0);
	$vr_deb_106 = str_replace(',', '', isset($_POST['vr_deb_106']) ? $_POST['vr_deb_106'] : 0);
	$vr_deb_107 = str_replace(',', '', isset($_POST['vr_deb_107']) ? $_POST['vr_deb_107'] : 0);
	$vr_deb_108 = str_replace(',', '', isset($_POST['vr_deb_108']) ? $_POST['vr_deb_108'] : 0);
	$vr_deb_109 = str_replace(',', '', isset($_POST['vr_deb_109']) ? $_POST['vr_deb_109'] : 0);
	$vr_deb_110 = str_replace(',', '', isset($_POST['vr_deb_110']) ? $_POST['vr_deb_110'] : 0);
	$vr_deb_111 = str_replace(',', '', isset($_POST['vr_deb_111']) ? $_POST['vr_deb_111'] : 0);
	$vr_deb_112 = str_replace(',', '', isset($_POST['vr_deb_112']) ? $_POST['vr_deb_112'] : 0);
	$vr_deb_113 = str_replace(',', '', isset($_POST['vr_deb_113']) ? $_POST['vr_deb_113'] : 0);
	$vr_deb_114 = str_replace(',', '', isset($_POST['vr_deb_114']) ? $_POST['vr_deb_114'] : 0);
	$vr_deb_115 = str_replace(',', '', isset($_POST['vr_deb_115']) ? $_POST['vr_deb_115'] : 0);
	$vr_deb_116 = str_replace(',', '', isset($_POST['vr_deb_116']) ? $_POST['vr_deb_116'] : 0);
	$vr_deb_117 = str_replace(',', '', isset($_POST['vr_deb_117']) ? $_POST['vr_deb_117'] : 0);
	$vr_deb_118 = str_replace(',', '', isset($_POST['vr_deb_118']) ? $_POST['vr_deb_118'] : 0);
	$vr_deb_119 = str_replace(',', '', isset($_POST['vr_deb_119']) ? $_POST['vr_deb_119'] : 0);
	$vr_deb_120 = str_replace(',', '', isset($_POST['vr_deb_120']) ? $_POST['vr_deb_120'] : 0);
	$vr_deb_121 = str_replace(',', '', isset($_POST['vr_deb_121']) ? $_POST['vr_deb_121'] : 0);
	$vr_deb_122 = str_replace(',', '', isset($_POST['vr_deb_122']) ? $_POST['vr_deb_122'] : 0);
	$vr_deb_123 = str_replace(',', '', isset($_POST['vr_deb_123']) ? $_POST['vr_deb_123'] : 0);
	$vr_deb_124 = str_replace(',', '', isset($_POST['vr_deb_124']) ? $_POST['vr_deb_124'] : 0);
	$vr_deb_125 = str_replace(',', '', isset($_POST['vr_deb_125']) ? $_POST['vr_deb_125'] : 0);
	$vr_deb_126 = str_replace(',', '', isset($_POST['vr_deb_126']) ? $_POST['vr_deb_126'] : 0);
	$vr_deb_127 = str_replace(',', '', isset($_POST['vr_deb_127']) ? $_POST['vr_deb_127'] : 0);
	$vr_deb_128 = str_replace(',', '', isset($_POST['vr_deb_128']) ? $_POST['vr_deb_128'] : 0);
	$vr_deb_129 = str_replace(',', '', isset($_POST['vr_deb_129']) ? $_POST['vr_deb_129'] : 0);
	$vr_deb_130 = str_replace(',', '', isset($_POST['vr_deb_130']) ? $_POST['vr_deb_130'] : 0);
	$vr_deb_131 = str_replace(',', '', isset($_POST['vr_deb_131']) ? $_POST['vr_deb_131'] : 0);
	$vr_deb_132 = str_replace(',', '', isset($_POST['vr_deb_132']) ? $_POST['vr_deb_132'] : 0);
	$vr_deb_133 = str_replace(',', '', isset($_POST['vr_deb_133']) ? $_POST['vr_deb_133'] : 0);
	$vr_deb_134 = str_replace(',', '', isset($_POST['vr_deb_134']) ? $_POST['vr_deb_134'] : 0);
	$vr_deb_135 = str_replace(',', '', isset($_POST['vr_deb_135']) ? $_POST['vr_deb_135'] : 0);
	$vr_deb_136 = str_replace(',', '', isset($_POST['vr_deb_136']) ? $_POST['vr_deb_136'] : 0);
	$vr_deb_137 = str_replace(',', '', isset($_POST['vr_deb_137']) ? $_POST['vr_deb_137'] : 0);
	$vr_deb_138 = str_replace(',', '', isset($_POST['vr_deb_138']) ? $_POST['vr_deb_138'] : 0);
	$vr_deb_139 = str_replace(',', '', isset($_POST['vr_deb_139']) ? $_POST['vr_deb_139'] : 0);
	$vr_deb_140 = str_replace(',', '', isset($_POST['vr_deb_140']) ? $_POST['vr_deb_140'] : 0);
	$vr_deb_141 = str_replace(',', '', isset($_POST['vr_deb_141']) ? $_POST['vr_deb_141'] : 0);
	$vr_deb_142 = str_replace(',', '', isset($_POST['vr_deb_142']) ? $_POST['vr_deb_142'] : 0);
	$vr_deb_143 = str_replace(',', '', isset($_POST['vr_deb_143']) ? $_POST['vr_deb_143'] : 0);
	$vr_deb_144 = str_replace(',', '', isset($_POST['vr_deb_144']) ? $_POST['vr_deb_144'] : 0);
	$vr_deb_145 = str_replace(',', '', isset($_POST['vr_deb_145']) ? $_POST['vr_deb_145'] : 0);
	$vr_deb_146 = str_replace(',', '', isset($_POST['vr_deb_146']) ? $_POST['vr_deb_146'] : 0);
	$vr_deb_147 = str_replace(',', '', isset($_POST['vr_deb_147']) ? $_POST['vr_deb_147'] : 0);
	$vr_deb_148 = str_replace(',', '', isset($_POST['vr_deb_148']) ? $_POST['vr_deb_148'] : 0);
	$vr_deb_149 = str_replace(',', '', isset($_POST['vr_deb_149']) ? $_POST['vr_deb_149'] : 0);
	$vr_deb_150 = str_replace(',', '', isset($_POST['vr_deb_150']) ? $_POST['vr_deb_150'] : 0);
	$vr_deb_151 = str_replace(',', '', isset($_POST['vr_deb_151']) ? $_POST['vr_deb_151'] : 0);
	$vr_deb_152 = str_replace(',', '', isset($_POST['vr_deb_152']) ? $_POST['vr_deb_152'] : 0);
	$vr_deb_153 = str_replace(',', '', isset($_POST['vr_deb_153']) ? $_POST['vr_deb_153'] : 0);
	$vr_deb_154 = str_replace(',', '', isset($_POST['vr_deb_154']) ? $_POST['vr_deb_154'] : 0);
	$vr_deb_155 = str_replace(',', '', isset($_POST['vr_deb_155']) ? $_POST['vr_deb_155'] : 0);
	$vr_deb_156 = str_replace(',', '', isset($_POST['vr_deb_156']) ? $_POST['vr_deb_156'] : 0);
	$vr_deb_157 = str_replace(',', '', isset($_POST['vr_deb_157']) ? $_POST['vr_deb_157'] : 0);
	$vr_deb_158 = str_replace(',', '', isset($_POST['vr_deb_158']) ? $_POST['vr_deb_158'] : 0);
	$vr_deb_159 = str_replace(',', '', isset($_POST['vr_deb_159']) ? $_POST['vr_deb_159'] : 0);
	$vr_deb_160 = str_replace(',', '', isset($_POST['vr_deb_160']) ? $_POST['vr_deb_160'] : 0);

	$vr_cre_1 = str_replace(',', '', isset($_POST['vr_cre_1']) ? $_POST['vr_cre_1'] : 0);
	$vr_cre_2 = str_replace(',', '', isset($_POST['vr_cre_2']) ? $_POST['vr_cre_2'] : 0);
	$vr_cre_3 = str_replace(',', '', isset($_POST['vr_cre_3']) ? $_POST['vr_cre_3'] : 0);
	$vr_cre_4 = str_replace(',', '', isset($_POST['vr_cre_4']) ? $_POST['vr_cre_4'] : 0);
	$vr_cre_5 = str_replace(',', '', isset($_POST['vr_cre_5']) ? $_POST['vr_cre_5'] : 0);
	$vr_cre_6 = str_replace(',', '', isset($_POST['vr_cre_6']) ? $_POST['vr_cre_6'] : 0);
	$vr_cre_7 = str_replace(',', '', isset($_POST['vr_cre_7']) ? $_POST['vr_cre_7'] : 0);
	$vr_cre_8 = str_replace(',', '', isset($_POST['vr_cre_8']) ? $_POST['vr_cre_8'] : 0);
	$vr_cre_9 = str_replace(',', '', isset($_POST['vr_cre_9']) ? $_POST['vr_cre_9'] : 0);
	$vr_cre_10 = str_replace(',', '', isset($_POST['vr_cre_10']) ? $_POST['vr_cre_10'] : 0);
	$vr_cre_11 = str_replace(',', '', isset($_POST['vr_cre_11']) ? $_POST['vr_cre_11'] : 0);
	$vr_cre_12 = str_replace(',', '', isset($_POST['vr_cre_12']) ? $_POST['vr_cre_12'] : 0);
	$vr_cre_13 = str_replace(',', '', isset($_POST['vr_cre_13']) ? $_POST['vr_cre_13'] : 0);
	$vr_cre_14 = str_replace(',', '', isset($_POST['vr_cre_14']) ? $_POST['vr_cre_14'] : 0);
	$vr_cre_15 = str_replace(',', '', isset($_POST['vr_cre_15']) ? $_POST['vr_cre_15'] : 0);
	$vr_cre_16 = str_replace(',', '', isset($_POST['vr_cre_16']) ? $_POST['vr_cre_16'] : 0);
	$vr_cre_17 = str_replace(',', '', isset($_POST['vr_cre_17']) ? $_POST['vr_cre_17'] : 0);
	$vr_cre_18 = str_replace(',', '', isset($_POST['vr_cre_18']) ? $_POST['vr_cre_18'] : 0);
	$vr_cre_19 = str_replace(',', '', isset($_POST['vr_cre_19']) ? $_POST['vr_cre_19'] : 0);
	$vr_cre_20 = str_replace(',', '', isset($_POST['vr_cre_20']) ? $_POST['vr_cre_20'] : 0);
	$vr_cre_21 = str_replace(',', '', isset($_POST['vr_cre_21']) ? $_POST['vr_cre_21'] : 0);
	$vr_cre_22 = str_replace(',', '', isset($_POST['vr_cre_22']) ? $_POST['vr_cre_22'] : 0);
	$vr_cre_23 = str_replace(',', '', isset($_POST['vr_cre_23']) ? $_POST['vr_cre_23'] : 0);
	$vr_cre_24 = str_replace(',', '', isset($_POST['vr_cre_24']) ? $_POST['vr_cre_24'] : 0);
	$vr_cre_25 = str_replace(',', '', isset($_POST['vr_cre_25']) ? $_POST['vr_cre_25'] : 0);
	$vr_cre_26 = str_replace(',', '', isset($_POST['vr_cre_26']) ? $_POST['vr_cre_26'] : 0);
	$vr_cre_27 = str_replace(',', '', isset($_POST['vr_cre_27']) ? $_POST['vr_cre_27'] : 0);
	$vr_cre_28 = str_replace(',', '', isset($_POST['vr_cre_28']) ? $_POST['vr_cre_28'] : 0);
	$vr_cre_29 = str_replace(',', '', isset($_POST['vr_cre_29']) ? $_POST['vr_cre_29'] : 0);
	$vr_cre_30 = str_replace(',', '', isset($_POST['vr_cre_30']) ? $_POST['vr_cre_30'] : 0);
	$vr_cre_31 = str_replace(',', '', isset($_POST['vr_cre_31']) ? $_POST['vr_cre_31'] : 0);
	$vr_cre_32 = str_replace(',', '', isset($_POST['vr_cre_32']) ? $_POST['vr_cre_32'] : 0);
	$vr_cre_33 = str_replace(',', '', isset($_POST['vr_cre_33']) ? $_POST['vr_cre_33'] : 0);
	$vr_cre_34 = str_replace(',', '', isset($_POST['vr_cre_34']) ? $_POST['vr_cre_34'] : 0);
	$vr_cre_35 = str_replace(',', '', isset($_POST['vr_cre_35']) ? $_POST['vr_cre_35'] : 0);
	$vr_cre_36 = str_replace(',', '', isset($_POST['vr_cre_36']) ? $_POST['vr_cre_36'] : 0);
	$vr_cre_37 = str_replace(',', '', isset($_POST['vr_cre_37']) ? $_POST['vr_cre_37'] : 0);
	$vr_cre_38 = str_replace(',', '', isset($_POST['vr_cre_38']) ? $_POST['vr_cre_38'] : 0);
	$vr_cre_39 = str_replace(',', '', isset($_POST['vr_cre_39']) ? $_POST['vr_cre_39'] : 0);
	$vr_cre_40 = str_replace(',', '', isset($_POST['vr_cre_40']) ? $_POST['vr_cre_40'] : 0);
	$vr_cre_41 = str_replace(',', '', isset($_POST['vr_cre_41']) ? $_POST['vr_cre_41'] : 0);
	$vr_cre_42 = str_replace(',', '', isset($_POST['vr_cre_42']) ? $_POST['vr_cre_42'] : 0);
	$vr_cre_43 = str_replace(',', '', isset($_POST['vr_cre_43']) ? $_POST['vr_cre_43'] : 0);
	$vr_cre_44 = str_replace(',', '', isset($_POST['vr_cre_44']) ? $_POST['vr_cre_44'] : 0);
	$vr_cre_45 = str_replace(',', '', isset($_POST['vr_cre_45']) ? $_POST['vr_cre_45'] : 0);
	$vr_cre_46 = str_replace(',', '', isset($_POST['vr_cre_46']) ? $_POST['vr_cre_46'] : 0);
	$vr_cre_47 = str_replace(',', '', isset($_POST['vr_cre_47']) ? $_POST['vr_cre_47'] : 0);
	$vr_cre_48 = str_replace(',', '', isset($_POST['vr_cre_48']) ? $_POST['vr_cre_48'] : 0);
	$vr_cre_49 = str_replace(',', '', isset($_POST['vr_cre_49']) ? $_POST['vr_cre_49'] : 0);
	$vr_cre_50 = str_replace(',', '', isset($_POST['vr_cre_50']) ? $_POST['vr_cre_50'] : 0);
	$vr_cre_51 = str_replace(',', '', isset($_POST['vr_cre_51']) ? $_POST['vr_cre_51'] : 0);
	$vr_cre_52 = str_replace(',', '', isset($_POST['vr_cre_52']) ? $_POST['vr_cre_52'] : 0);
	$vr_cre_53 = str_replace(',', '', isset($_POST['vr_cre_53']) ? $_POST['vr_cre_53'] : 0);
	$vr_cre_54 = str_replace(',', '', isset($_POST['vr_cre_54']) ? $_POST['vr_cre_54'] : 0);
	$vr_cre_55 = str_replace(',', '', isset($_POST['vr_cre_55']) ? $_POST['vr_cre_55'] : 0);
	$vr_cre_56 = str_replace(',', '', isset($_POST['vr_cre_56']) ? $_POST['vr_cre_56'] : 0);
	$vr_cre_57 = str_replace(',', '', isset($_POST['vr_cre_57']) ? $_POST['vr_cre_57'] : 0);
	$vr_cre_58 = str_replace(',', '', isset($_POST['vr_cre_58']) ? $_POST['vr_cre_58'] : 0);
	$vr_cre_59 = str_replace(',', '', isset($_POST['vr_cre_59']) ? $_POST['vr_cre_59'] : 0);
	$vr_cre_60 = str_replace(',', '', isset($_POST['vr_cre_60']) ? $_POST['vr_cre_60'] : 0);
	$vr_cre_61 = str_replace(',', '', isset($_POST['vr_cre_61']) ? $_POST['vr_cre_61'] : 0);
	$vr_cre_62 = str_replace(',', '', isset($_POST['vr_cre_62']) ? $_POST['vr_cre_62'] : 0);
	$vr_cre_63 = str_replace(',', '', isset($_POST['vr_cre_63']) ? $_POST['vr_cre_63'] : 0);
	$vr_cre_64 = str_replace(',', '', isset($_POST['vr_cre_64']) ? $_POST['vr_cre_64'] : 0);
	$vr_cre_65 = str_replace(',', '', isset($_POST['vr_cre_65']) ? $_POST['vr_cre_65'] : 0);
	$vr_cre_66 = str_replace(',', '', isset($_POST['vr_cre_66']) ? $_POST['vr_cre_66'] : 0);
	$vr_cre_67 = str_replace(',', '', isset($_POST['vr_cre_67']) ? $_POST['vr_cre_67'] : 0);
	$vr_cre_68 = str_replace(',', '', isset($_POST['vr_cre_68']) ? $_POST['vr_cre_68'] : 0);
	$vr_cre_69 = str_replace(',', '', isset($_POST['vr_cre_69']) ? $_POST['vr_cre_69'] : 0);
	$vr_cre_70 = str_replace(',', '', isset($_POST['vr_cre_70']) ? $_POST['vr_cre_70'] : 0);
	$vr_cre_71 = str_replace(',', '', isset($_POST['vr_cre_71']) ? $_POST['vr_cre_71'] : 0);
	$vr_cre_72 = str_replace(',', '', isset($_POST['vr_cre_72']) ? $_POST['vr_cre_72'] : 0);
	$vr_cre_73 = str_replace(',', '', isset($_POST['vr_cre_73']) ? $_POST['vr_cre_73'] : 0);
	$vr_cre_74 = str_replace(',', '', isset($_POST['vr_cre_74']) ? $_POST['vr_cre_74'] : 0);
	$vr_cre_75 = str_replace(',', '', isset($_POST['vr_cre_75']) ? $_POST['vr_cre_75'] : 0);
	$vr_cre_76 = str_replace(',', '', isset($_POST['vr_cre_76']) ? $_POST['vr_cre_76'] : 0);
	$vr_cre_77 = str_replace(',', '', isset($_POST['vr_cre_77']) ? $_POST['vr_cre_77'] : 0);
	$vr_cre_78 = str_replace(',', '', isset($_POST['vr_cre_78']) ? $_POST['vr_cre_78'] : 0);
	$vr_cre_79 = str_replace(',', '', isset($_POST['vr_cre_79']) ? $_POST['vr_cre_79'] : 0);
	$vr_cre_80 = str_replace(',', '', isset($_POST['vr_cre_80']) ? $_POST['vr_cre_80'] : 0);
	$vr_cre_81 = str_replace(',', '', isset($_POST['vr_cre_81']) ? $_POST['vr_cre_81'] : 0);
	$vr_cre_82 = str_replace(',', '', isset($_POST['vr_cre_82']) ? $_POST['vr_cre_82'] : 0);
	$vr_cre_83 = str_replace(',', '', isset($_POST['vr_cre_83']) ? $_POST['vr_cre_83'] : 0);
	$vr_cre_84 = str_replace(',', '', isset($_POST['vr_cre_84']) ? $_POST['vr_cre_84'] : 0);
	$vr_cre_85 = str_replace(',', '', isset($_POST['vr_cre_85']) ? $_POST['vr_cre_85'] : 0);
	$vr_cre_86 = str_replace(',', '', isset($_POST['vr_cre_86']) ? $_POST['vr_cre_86'] : 0);
	$vr_cre_87 = str_replace(',', '', isset($_POST['vr_cre_87']) ? $_POST['vr_cre_87'] : 0);
	$vr_cre_88 = str_replace(',', '', isset($_POST['vr_cre_88']) ? $_POST['vr_cre_88'] : 0);
	$vr_cre_89 = str_replace(',', '', isset($_POST['vr_cre_89']) ? $_POST['vr_cre_89'] : 0);
	$vr_cre_90 = str_replace(',', '', isset($_POST['vr_cre_90']) ? $_POST['vr_cre_90'] : 0);
	$vr_cre_91 = str_replace(',', '', isset($_POST['vr_cre_91']) ? $_POST['vr_cre_91'] : 0);
	$vr_cre_92 = str_replace(',', '', isset($_POST['vr_cre_92']) ? $_POST['vr_cre_92'] : 0);
	$vr_cre_93 = str_replace(',', '', isset($_POST['vr_cre_93']) ? $_POST['vr_cre_93'] : 0);
	$vr_cre_94 = str_replace(',', '', isset($_POST['vr_cre_94']) ? $_POST['vr_cre_94'] : 0);
	$vr_cre_95 = str_replace(',', '', isset($_POST['vr_cre_95']) ? $_POST['vr_cre_95'] : 0);
	$vr_cre_96 = str_replace(',', '', isset($_POST['vr_cre_96']) ? $_POST['vr_cre_96'] : 0);
	$vr_cre_97 = str_replace(',', '', isset($_POST['vr_cre_97']) ? $_POST['vr_cre_97'] : 0);
	$vr_cre_98 = str_replace(',', '', isset($_POST['vr_cre_98']) ? $_POST['vr_cre_98'] : 0);
	$vr_cre_99 = str_replace(',', '', isset($_POST['vr_cre_99']) ? $_POST['vr_cre_99'] : 0);
	$vr_cre_100 = str_replace(',', '', isset($_POST['vr_cre_100']) ? $_POST['vr_cre_100'] : 0);
	$vr_cre_101 = str_replace(',', '', isset($_POST['vr_cre_101']) ? $_POST['vr_cre_101'] : 0);
	$vr_cre_102 = str_replace(',', '', isset($_POST['vr_cre_102']) ? $_POST['vr_cre_102'] : 0);
	$vr_cre_103 = str_replace(',', '', isset($_POST['vr_cre_103']) ? $_POST['vr_cre_103'] : 0);
	$vr_cre_104 = str_replace(',', '', isset($_POST['vr_cre_104']) ? $_POST['vr_cre_104'] : 0);
	$vr_cre_105 = str_replace(',', '', isset($_POST['vr_cre_105']) ? $_POST['vr_cre_105'] : 0);
	$vr_cre_106 = str_replace(',', '', isset($_POST['vr_cre_106']) ? $_POST['vr_cre_106'] : 0);
	$vr_cre_107 = str_replace(',', '', isset($_POST['vr_cre_107']) ? $_POST['vr_cre_107'] : 0);
	$vr_cre_108 = str_replace(',', '', isset($_POST['vr_cre_108']) ? $_POST['vr_cre_108'] : 0);
	$vr_cre_109 = str_replace(',', '', isset($_POST['vr_cre_109']) ? $_POST['vr_cre_109'] : 0);
	$vr_cre_110 = str_replace(',', '', isset($_POST['vr_cre_110']) ? $_POST['vr_cre_110'] : 0);
	$vr_cre_111 = str_replace(',', '', isset($_POST['vr_cre_111']) ? $_POST['vr_cre_111'] : 0);
	$vr_cre_112 = str_replace(',', '', isset($_POST['vr_cre_112']) ? $_POST['vr_cre_112'] : 0);
	$vr_cre_113 = str_replace(',', '', isset($_POST['vr_cre_113']) ? $_POST['vr_cre_113'] : 0);
	$vr_cre_114 = str_replace(',', '', isset($_POST['vr_cre_114']) ? $_POST['vr_cre_114'] : 0);
	$vr_cre_115 = str_replace(',', '', isset($_POST['vr_cre_115']) ? $_POST['vr_cre_115'] : 0);
	$vr_cre_116 = str_replace(',', '', isset($_POST['vr_cre_116']) ? $_POST['vr_cre_116'] : 0);
	$vr_cre_117 = str_replace(',', '', isset($_POST['vr_cre_117']) ? $_POST['vr_cre_117'] : 0);
	$vr_cre_118 = str_replace(',', '', isset($_POST['vr_cre_118']) ? $_POST['vr_cre_118'] : 0);
	$vr_cre_119 = str_replace(',', '', isset($_POST['vr_cre_119']) ? $_POST['vr_cre_119'] : 0);
	$vr_cre_120 = str_replace(',', '', isset($_POST['vr_cre_120']) ? $_POST['vr_cre_120'] : 0);
	$vr_cre_121 = str_replace(',', '', isset($_POST['vr_cre_121']) ? $_POST['vr_cre_121'] : 0);
	$vr_cre_122 = str_replace(',', '', isset($_POST['vr_cre_122']) ? $_POST['vr_cre_122'] : 0);
	$vr_cre_123 = str_replace(',', '', isset($_POST['vr_cre_123']) ? $_POST['vr_cre_123'] : 0);
	$vr_cre_124 = str_replace(',', '', isset($_POST['vr_cre_124']) ? $_POST['vr_cre_124'] : 0);
	$vr_cre_125 = str_replace(',', '', isset($_POST['vr_cre_125']) ? $_POST['vr_cre_125'] : 0);
	$vr_cre_126 = str_replace(',', '', isset($_POST['vr_cre_126']) ? $_POST['vr_cre_126'] : 0);
	$vr_cre_127 = str_replace(',', '', isset($_POST['vr_cre_127']) ? $_POST['vr_cre_127'] : 0);
	$vr_cre_128 = str_replace(',', '', isset($_POST['vr_cre_128']) ? $_POST['vr_cre_128'] : 0);
	$vr_cre_129 = str_replace(',', '', isset($_POST['vr_cre_129']) ? $_POST['vr_cre_129'] : 0);
	$vr_cre_130 = str_replace(',', '', isset($_POST['vr_cre_130']) ? $_POST['vr_cre_130'] : 0);
	$vr_cre_131 = str_replace(',', '', isset($_POST['vr_cre_131']) ? $_POST['vr_cre_131'] : 0);
	$vr_cre_132 = str_replace(',', '', isset($_POST['vr_cre_132']) ? $_POST['vr_cre_132'] : 0);
	$vr_cre_133 = str_replace(',', '', isset($_POST['vr_cre_133']) ? $_POST['vr_cre_133'] : 0);
	$vr_cre_134 = str_replace(',', '', isset($_POST['vr_cre_134']) ? $_POST['vr_cre_134'] : 0);
	$vr_cre_135 = str_replace(',', '', isset($_POST['vr_cre_135']) ? $_POST['vr_cre_135'] : 0);
	$vr_cre_136 = str_replace(',', '', isset($_POST['vr_cre_136']) ? $_POST['vr_cre_136'] : 0);
	$vr_cre_137 = str_replace(',', '', isset($_POST['vr_cre_137']) ? $_POST['vr_cre_137'] : 0);
	$vr_cre_138 = str_replace(',', '', isset($_POST['vr_cre_138']) ? $_POST['vr_cre_138'] : 0);
	$vr_cre_139 = str_replace(',', '', isset($_POST['vr_cre_139']) ? $_POST['vr_cre_139'] : 0);
	$vr_cre_140 = str_replace(',', '', isset($_POST['vr_cre_140']) ? $_POST['vr_cre_140'] : 0);
	$vr_cre_141 = str_replace(',', '', isset($_POST['vr_cre_141']) ? $_POST['vr_cre_141'] : 0);
	$vr_cre_142 = str_replace(',', '', isset($_POST['vr_cre_142']) ? $_POST['vr_cre_142'] : 0);
	$vr_cre_143 = str_replace(',', '', isset($_POST['vr_cre_143']) ? $_POST['vr_cre_143'] : 0);
	$vr_cre_144 = str_replace(',', '', isset($_POST['vr_cre_144']) ? $_POST['vr_cre_144'] : 0);
	$vr_cre_145 = str_replace(',', '', isset($_POST['vr_cre_145']) ? $_POST['vr_cre_145'] : 0);
	$vr_cre_146 = str_replace(',', '', isset($_POST['vr_cre_146']) ? $_POST['vr_cre_146'] : 0);
	$vr_cre_147 = str_replace(',', '', isset($_POST['vr_cre_147']) ? $_POST['vr_cre_147'] : 0);
	$vr_cre_148 = str_replace(',', '', isset($_POST['vr_cre_148']) ? $_POST['vr_cre_148'] : 0);
	$vr_cre_149 = str_replace(',', '', isset($_POST['vr_cre_149']) ? $_POST['vr_cre_149'] : 0);
	$vr_cre_150 = str_replace(',', '', isset($_POST['vr_cre_150']) ? $_POST['vr_cre_150'] : 0);
	$vr_cre_151 = str_replace(',', '', isset($_POST['vr_cre_151']) ? $_POST['vr_cre_151'] : 0);
	$vr_cre_152 = str_replace(',', '', isset($_POST['vr_cre_152']) ? $_POST['vr_cre_152'] : 0);
	$vr_cre_153 = str_replace(',', '', isset($_POST['vr_cre_153']) ? $_POST['vr_cre_153'] : 0);
	$vr_cre_154 = str_replace(',', '', isset($_POST['vr_cre_154']) ? $_POST['vr_cre_154'] : 0);
	$vr_cre_155 = str_replace(',', '', isset($_POST['vr_cre_155']) ? $_POST['vr_cre_155'] : 0);
	$vr_cre_156 = str_replace(',', '', isset($_POST['vr_cre_156']) ? $_POST['vr_cre_156'] : 0);
	$vr_cre_157 = str_replace(',', '', isset($_POST['vr_cre_157']) ? $_POST['vr_cre_157'] : 0);
	$vr_cre_158 = str_replace(',', '', isset($_POST['vr_cre_158']) ? $_POST['vr_cre_158'] : 0);
	$vr_cre_159 = str_replace(',', '', isset($_POST['vr_cre_159']) ? $_POST['vr_cre_159'] : 0);
	$vr_cre_160 = str_replace(',', '', isset($_POST['vr_cre_160']) ? $_POST['vr_cre_160'] : 0);
	$cheque_1 = isset($_POST['cheque_1']) ? $_POST['cheque_1'] : 0;
	$cheque_2 = isset($_POST['cheque_2']) ? $_POST['cheque_2'] : 0;
	$cheque_3 = isset($_POST['cheque_3']) ? $_POST['cheque_3'] : 0;
	$cheque_4 = isset($_POST['cheque_4']) ? $_POST['cheque_4'] : 0;
	$cheque_5 = isset($_POST['cheque_5']) ? $_POST['cheque_5'] : 0;
	$cheque_6 = isset($_POST['cheque_6']) ? $_POST['cheque_6'] : 0;
	$cheque_7 = isset($_POST['cheque_7']) ? $_POST['cheque_7'] : 0;
	$cheque_8 = isset($_POST['cheque_8']) ? $_POST['cheque_8'] : 0;
	$cheque_9 = isset($_POST['cheque_9']) ? $_POST['cheque_9'] : 0;
	$cheque_10 = isset($_POST['cheque_10']) ? $_POST['cheque_10'] : 0;
	$cheque_11 = isset($_POST['cheque_11']) ? $_POST['cheque_11'] : 0;
	$cheque_12 = isset($_POST['cheque_12']) ? $_POST['cheque_12'] : 0;
	$cheque_13 = isset($_POST['cheque_13']) ? $_POST['cheque_13'] : 0;
	$cheque_14 = isset($_POST['cheque_14']) ? $_POST['cheque_14'] : 0;
	$cheque_15 = isset($_POST['cheque_15']) ? $_POST['cheque_15'] : 0;
	$cheque_16 = isset($_POST['cheque_16']) ? $_POST['cheque_16'] : 0;
	$cheque_17 = isset($_POST['cheque_17']) ? $_POST['cheque_17'] : 0;
	$cheque_18 = isset($_POST['cheque_18']) ? $_POST['cheque_18'] : 0;
	$cheque_19 = isset($_POST['cheque_19']) ? $_POST['cheque_19'] : 0;
	$cheque_20 = isset($_POST['cheque_20']) ? $_POST['cheque_20'] : 0;


	$tot_deb = $vr_deb_1 + $vr_deb_2 + $vr_deb_3 + $vr_deb_4 + $vr_deb_5 + $vr_deb_6 + $vr_deb_7 + $vr_deb_8 + $vr_deb_9 + $vr_deb_10 + $vr_deb_11 + $vr_deb_12 + $vr_deb_13 + $vr_deb_14 + $vr_deb_15 + $vr_deb_16 + $vr_deb_17 + $vr_deb_18 + $vr_deb_19 + $vr_deb_20 + $vr_deb_21 + $vr_deb_22 + $vr_deb_23 + $vr_deb_24 + $vr_deb_25 + $vr_deb_26 + $vr_deb_27 + $vr_deb_28 + $vr_deb_29 + $vr_deb_30 + $vr_deb_31 + $vr_deb_32 + $vr_deb_33 + $vr_deb_34 + $vr_deb_35 + $vr_deb_36 + $vr_deb_37 + $vr_deb_38 + $vr_deb_39 + $vr_deb_40 + $vr_deb_41 + $vr_deb_42 + $vr_deb_43 + $vr_deb_44 + $vr_deb_45 + $vr_deb_46 + $vr_deb_47 + $vr_deb_48 + $vr_deb_49 + $vr_deb_50 + $vr_deb_51 + $vr_deb_52 + $vr_deb_53 + $vr_deb_54 + $vr_deb_55 + $vr_deb_56 + $vr_deb_57 + $vr_deb_58 + $vr_deb_59 + $vr_deb_60 + $vr_deb_61 + $vr_deb_62 + $vr_deb_63 + $vr_deb_64 + $vr_deb_65 + $vr_deb_66 + $vr_deb_67 + $vr_deb_68 + $vr_deb_69 + $vr_deb_70 + $vr_deb_71 + $vr_deb_72 + $vr_deb_73 + $vr_deb_74 + $vr_deb_75 + $vr_deb_76 + $vr_deb_77 + $vr_deb_78 + $vr_deb_79 + $vr_deb_80 + $vr_deb_81 + $vr_deb_82 + $vr_deb_83 + $vr_deb_84 + $vr_deb_85 + $vr_deb_86 + $vr_deb_87 + $vr_deb_88 + $vr_deb_89 + $vr_deb_90 + $vr_deb_91 + $vr_deb_92 + $vr_deb_93 + $vr_deb_94 + $vr_deb_95 + $vr_deb_96 + $vr_deb_97 + $vr_deb_98 + $vr_deb_99 + $vr_deb_100 + $vr_deb_101 + $vr_deb_102 + $vr_deb_103 + $vr_deb_104 + $vr_deb_105 + $vr_deb_106 + $vr_deb_107 + $vr_deb_108 + $vr_deb_109 + $vr_deb_110 + $vr_deb_111 + $vr_deb_112 + $vr_deb_113 + $vr_deb_114 + $vr_deb_115 + $vr_deb_116 + $vr_deb_117 + $vr_deb_118 + $vr_deb_119 + $vr_deb_120 + $vr_deb_121 + $vr_deb_122 + $vr_deb_123 + $vr_deb_124 + $vr_deb_125 + $vr_deb_126 + $vr_deb_127 + $vr_deb_128 + $vr_deb_129 + $vr_deb_130 + $vr_deb_131 + $vr_deb_132 + $vr_deb_133 + $vr_deb_134 + $vr_deb_135 + $vr_deb_136 + $vr_deb_137 + $vr_deb_138 + $vr_deb_139 + $vr_deb_140 + $vr_deb_141 + $vr_deb_142 + $vr_deb_143 + $vr_deb_144 + $vr_deb_145 + $vr_deb_146 + $vr_deb_147 + $vr_deb_148 + $vr_deb_149 + $vr_deb_150 + $vr_deb_151 + $vr_deb_152 + $vr_deb_153 + $vr_deb_154 + $vr_deb_155 + $vr_deb_156 + $vr_deb_157 + $vr_deb_158 + $vr_deb_159 + $vr_deb_160;
	$tot_cre = $vr_cre_1 + $vr_cre_2 + $vr_cre_3 + $vr_cre_4 + $vr_cre_5 + $vr_cre_6 + $vr_cre_7 + $vr_cre_8 + $vr_cre_9 + $vr_cre_10 + $vr_cre_11 + $vr_cre_12 + $vr_cre_13 + $vr_cre_14 + $vr_cre_15 + $vr_cre_16 + $vr_cre_17 + $vr_cre_18 + $vr_cre_19 + $vr_cre_20 + $vr_cre_21 + $vr_cre_22 + $vr_cre_23 + $vr_cre_24 + $vr_cre_25 + $vr_cre_26 + $vr_cre_27 + $vr_cre_28 + $vr_cre_29 + $vr_cre_30 + $vr_cre_31 + $vr_cre_32 + $vr_cre_33 + $vr_cre_34 + $vr_cre_35 + $vr_cre_36 + $vr_cre_37 + $vr_cre_38 + $vr_cre_39 + $vr_cre_40 + $vr_cre_41 + $vr_cre_42 + $vr_cre_43 + $vr_cre_44 + $vr_cre_45 + $vr_cre_46 + $vr_cre_47 + $vr_cre_48 + $vr_cre_49 + $vr_cre_50 + $vr_cre_51 + $vr_cre_52 + $vr_cre_53 + $vr_cre_54 + $vr_cre_55 + $vr_cre_56 + $vr_cre_57 + $vr_cre_58 + $vr_cre_59 + $vr_cre_60 + $vr_cre_61 + $vr_cre_62 + $vr_cre_63 + $vr_cre_64 + $vr_cre_65 + $vr_cre_66 + $vr_cre_67 + $vr_cre_68 + $vr_cre_69 + $vr_cre_70 + $vr_cre_71 + $vr_cre_72 + $vr_cre_73 + $vr_cre_74 + $vr_cre_75 + $vr_cre_76 + $vr_cre_77 + $vr_cre_78 + $vr_cre_79 + $vr_cre_80 + $vr_cre_81 + $vr_cre_82 + $vr_cre_83 + $vr_cre_84 + $vr_cre_85 + $vr_cre_86 + $vr_cre_87 + $vr_cre_88 + $vr_cre_89 + $vr_cre_90 + $vr_cre_91 + $vr_cre_92 + $vr_cre_93 + $vr_cre_94 + $vr_cre_95 + $vr_cre_96 + $vr_cre_97 + $vr_cre_98 + $vr_cre_99 + $vr_cre_100 + $vr_cre_101 + $vr_cre_102 + $vr_cre_103 + $vr_cre_104 + $vr_cre_105 + $vr_cre_106 + $vr_cre_107 + $vr_cre_108 + $vr_cre_109 + $vr_cre_110 + $vr_cre_111 + $vr_cre_112 + $vr_cre_113 + $vr_cre_114 + $vr_cre_115 + $vr_cre_116 + $vr_cre_117 + $vr_cre_118 + $vr_cre_119 + $vr_cre_120 + $vr_cre_121 + $vr_cre_122 + $vr_cre_123 + $vr_cre_124 + $vr_cre_125 + $vr_cre_126 + $vr_cre_127 + $vr_cre_128 + $vr_cre_129 + $vr_cre_130 + $vr_cre_131 + $vr_cre_132 + $vr_cre_133 + $vr_cre_134 + $vr_cre_135 + $vr_cre_136 + $vr_cre_137 + $vr_cre_138 + $vr_cre_139 + $vr_cre_140 + $vr_cre_141 + $vr_cre_142 + $vr_cre_143 + $vr_cre_144 + $vr_cre_145 + $vr_cre_146 + $vr_cre_147 + $vr_cre_148 + $vr_cre_149 + $vr_cre_150 + $vr_cre_151 + $vr_cre_152 + $vr_cre_153 + $vr_cre_154 + $vr_cre_155 + $vr_cre_156 + $vr_cre_157 + $vr_cre_158 + $vr_cre_159 + $vr_cre_160;

	$tot_deb_a = number_format($tot_deb, 2, ',', '.');
	$tot_cre_a = number_format($tot_cre, 2, ',', '.');

	// vigencia fiscal

	$consultax = $connectionxx->query("select * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"];
		$bx = $rowx["fecha_fin"];
	}


	// consulta tipo_dato de pgcp
	$sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
	$resultadoa = $connectionxx->query($sqla);
	while ($rowa = $resultadoa->fetch_assoc()) {
		$tipa = $rowa["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
	$resultadob = $connectionxx->query($sqlb);
	while ($rowb = $resultadob->fetch_assoc()) {
		$tipb = $rowb["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
	$resultadoc = $connectionxx->query($sqlc);
	while ($rowc = $resultadoc->fetch_assoc()) {
		$tipc = $rowc["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
	$resultadod = $connectionxx->query($sqld);
	while ($rowd = $resultadod->fetch_assoc()) {
		$tipd = $rowd["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
	$resultadoe = $connectionxx->query($sqle);
	while ($rowe = $resultadoe->fetch_assoc()) {
		$tipe = $rowe["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
	$resultadof = $connectionxx->query($sqlf);
	while ($rowf = $resultadof->fetch_assoc()) {
		$tipf = $rowf["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
	$resultadog = $connectionxx->query($sqlg);
	while ($rowg = $resultadog->fetch_assoc()) {
		$tipg = $rowg["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
	$resultadoh = $connectionxx->query($sqlh);
	while ($rowh = $resultadoh->fetch_assoc()) {
		$tiph = $rowh["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
	$resultadoi = $connectionxx->query($sqli);
	while ($rowi = $resultadoi->fetch_assoc()) {
		$tipi = $rowi["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
	$resultadoj = $connectionxx->query($sqlj);
	while ($rowj = $resultadoj->fetch_assoc()) {
		$tipj = $rowj["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
	$resultadok = $connectionxx->query($sqlk);
	while ($rowk = $resultadok->fetch_assoc()) {
		$tipk = $rowk["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
	$resultadol = $connectionxx->query($sqll);
	while ($rowl = $resultadol->fetch_assoc()) {
		$tipl = $rowl["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
	$resultadom = $connectionxx->query($sqlm);
	while ($rowm = $resultadom->fetch_assoc()) {
		$tipm = $rowm["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
	$resultadon = $connectionxx->query($sqln);
	while ($rown = $resultadon->fetch_assoc()) {
		$tipn = $rown["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
	$resultadoo = $connectionxx->query($sqlo);
	while ($rowo = $resultadoo->fetch_assoc()) {
		$tipo = $rowo["tip_dato"];
	}
	$tip_dato = '';


	// inicio del bloque

	if ($tercero == '') {
		printf("<br><br><center class='Estilo4'>No debe dejar casillas <b>EN BLANCOSSSSS</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
	} else {
		if (($tipa == 'M') or ($tipb == 'M') or ($tipc == 'M') or ($tipd == 'M') or ($tipe == 'M') or ($tipf == 'M') or ($tipg == 'M') or ($tiph == 'M') or ($tipi == 'M') or ($tipj == 'M') or ($tipk == 'M') or ($tipl == 'M') or ($tipm == 'M') or ($tipn == 'M') or ($tipo == 'M') or ($tip_dato == 'M')) {
			printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
		} else {

			if ($fecha_recaudo > $bx or $fecha_recaudo < $ax) {
				printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
			} else {

				if ($tot_deb_a != $tot_cre_a) {
					printf(
						"<br><br><center class='Estilo4'>Los <b>TOTALES</b> Debito (...::: " . $tot_deb_a . " :::...) y Credito (...::: " . $tot_cre_a . " :::...) del movimiento 					<br><br>
					<b>NO COINCIDEN</b> <BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>"
					);
				} else {
					// Para evitar doble registro
					$idv = '';
					$k = 0;
					$sq2 = "SELECT id,id_recau from recaudo_tnat where id_recau ='$id_recau' ";
					$rs2 = $connectionxx->query($sq2);
					$fil = $rs2->num_rows;
					while ($rw2 = $rs2->fetch_assoc()) {
						$idv .= $rw2['id'] . ',';
					}
					$idv2 = explode(",", $idv);
					for ($i = 1; $i < $filas; $i++) {	  // recibo variables 
						$cuenta = $_POST['cuenta_' . $i];
						$valor = str_replace(',', '', $_POST['valor_' . $i]);
						// consulto nombre del rubro
						$sql = "select * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
						$resultado = $connectionxx->query($sql);
						while ($row = $resultado->fetch_assoc()) {
							$tip_dato = $row["tip_dato"];
							$definitivo = $row["definitivo"];
							$nom_rubro = $row["nom_rubro"];
						}

						// inserto nuevo roit
						$sq5 = "UPDATE  recaudo_tnat set 
									id_emp='$id_emp',
									id_reip='$id_reip',
									id_caic='$id_caic',
									id_recau='$id_recau',
									fecha_recaudo='$fecha_recaudo',
									des_recaudo='$des_recaudo',
									cuenta = '$cuenta',
									vr_digitado = '$valor',
									id_manu_tnat = '$id_manu_rcgt',
									tercero= '$tercero',
									ter ='$ter'
									where id='$idv2[$k]'
										";

						$connectionxx->query($sq5) or die(mysqli_error($connectionxx));
						$k++;
					} // end for
					// se realiza el ultimo registro
					$cuenta = $_POST['cuenta_' . $i];
					$valor = str_replace(',', '', $_POST['valor_' . $i]);
					// consulto nombre del rubro
					$sql = "select * from car_ppto_ing where cod_pptal ='$cuenta'";
					$resultado = $connectionxx->query($sql);
					while ($row = $resultado->fetch_assoc()) {
						$tip_dato = $row["tip_dato"];
						$definitivo = $row["definitivo"];
						$nom_rubro = $row["nom_rubro"];
					}
					$nombre = '';
					// inserto nuevo roit
					$sq6 = "UPDATE  recaudo_tnat set 
									
										id_emp='$id_emp',id_reip='$id_reip',id_caic='$id_caic',id_recau='$id_recau',fecha_recaudo='$fecha_recaudo',des_recaudo='$des_recaudo',tercero='$tercero',pgcp1='$pgcp1',pgcp2='$pgcp2',pgcp3='$pgcp3',pgcp4='$pgcp4',pgcp5='$pgcp5',pgcp6='$pgcp6',pgcp7='$pgcp7',pgcp8='$pgcp8',pgcp9='$pgcp9',pgcp10='$pgcp10',pgcp11='$pgcp11',pgcp12='$pgcp12',pgcp13='$pgcp13',pgcp14='$pgcp14',pgcp15='$pgcp15',des1='$des1',des2='$des2',des3='$des3',des4='$des4',des5='$des5',des6='$des6',des7='$des7',des8='$des8',des9='$des9',des10='$des10',des11='$des11',des12='$des12',des13='$des13',des14='$des14',des15='$des15',vr_deb_1='$vr_deb_1',vr_deb_2='$vr_deb_2',vr_deb_3='$vr_deb_3',vr_deb_4='$vr_deb_4',vr_deb_5='$vr_deb_5',vr_deb_6='$vr_deb_6',vr_deb_7='$vr_deb_7',vr_deb_8='$vr_deb_8',vr_deb_9='$vr_deb_9',vr_deb_10='$vr_deb_10',vr_deb_11='$vr_deb_11',vr_deb_12='$vr_deb_12',vr_deb_13='$vr_deb_13',vr_deb_14='$vr_deb_14',vr_deb_15='$vr_deb_15',vr_cre_1='$vr_cre_1',vr_cre_2='$vr_cre_2',vr_cre_3='$vr_cre_3',vr_cre_4='$vr_cre_4',vr_cre_5='$vr_cre_5',vr_cre_6='$vr_cre_6',vr_cre_7='$vr_cre_7',vr_cre_8='$vr_cre_8',vr_cre_9='$vr_cre_9',vr_cre_10='$vr_cre_10',vr_cre_11='$vr_cre_11',vr_cre_12='$vr_cre_12',vr_cre_13='$vr_cre_13',vr_cre_14='$vr_cre_14',vr_cre_15='$vr_cre_15',tot_deb='$tot_deb',tot_cre='$tot_cre',id_unico_reip='$id_unico_reip',cuenta='$cuenta',nombre='$nombre',vr_orig_reip='$vr_orig_reip',vr_digitado='$valor',ter_nat='$ter_nat',ter_jur='$ter_jur',id_manu_tnat='$id_manu_rcgt',pgcp16='$pgcp16',pgcp17='$pgcp17',pgcp18='$pgcp18',pgcp19='$pgcp19',pgcp20='$pgcp20',pgcp21='$pgcp21',pgcp22='$pgcp22',pgcp23='$pgcp23',pgcp24='$pgcp24',pgcp25='$pgcp25',pgcp26='$pgcp26',pgcp27='$pgcp27',pgcp28='$pgcp28',pgcp29='$pgcp29',pgcp30='$pgcp30',pgcp31='$pgcp31',pgcp32='$pgcp32',pgcp33='$pgcp33',pgcp34='$pgcp34',pgcp35='$pgcp35',pgcp36='$pgcp36',pgcp37='$pgcp37',pgcp38='$pgcp38',pgcp39='$pgcp39',pgcp40='$pgcp40',pgcp41='$pgcp41',pgcp42='$pgcp42',pgcp43='$pgcp43',pgcp44='$pgcp44',pgcp45='$pgcp45',pgcp46='$pgcp46',pgcp47='$pgcp47',pgcp48='$pgcp48',pgcp49='$pgcp49',pgcp50='$pgcp50',pgcp51='$pgcp51',pgcp52='$pgcp52',pgcp53='$pgcp53',pgcp54='$pgcp54',pgcp55='$pgcp55',pgcp56='$pgcp56',pgcp57='$pgcp57',pgcp58='$pgcp58',pgcp59='$pgcp59',pgcp60='$pgcp60',pgcp61='$pgcp61',pgcp62='$pgcp62',pgcp63='$pgcp63',pgcp64='$pgcp64',pgcp65='$pgcp65',pgcp66='$pgcp66',pgcp67='$pgcp67',pgcp68='$pgcp68',pgcp69='$pgcp69',pgcp70='$pgcp70',pgcp71='$pgcp71',pgcp72='$pgcp72',pgcp73='$pgcp73',pgcp74='$pgcp74',pgcp75='$pgcp75',pgcp76='$pgcp76',pgcp77='$pgcp77',pgcp78='$pgcp78',pgcp79='$pgcp79',pgcp80='$pgcp80',pgcp81='$pgcp81',pgcp82='$pgcp82',pgcp83='$pgcp83',pgcp84='$pgcp84',pgcp85='$pgcp85',pgcp86='$pgcp86',pgcp87='$pgcp87',pgcp88='$pgcp88',pgcp89='$pgcp89',pgcp90='$pgcp90',pgcp91='$pgcp91',pgcp92='$pgcp92',pgcp93='$pgcp93',pgcp94='$pgcp94',pgcp95='$pgcp95',pgcp96='$pgcp96',pgcp97='$pgcp97',pgcp98='$pgcp98',pgcp99='$pgcp99',pgcp100='$pgcp100',pgcp101='$pgcp101',pgcp102='$pgcp102',pgcp103='$pgcp103',pgcp104='$pgcp104',pgcp105='$pgcp105',pgcp106='$pgcp106',pgcp107='$pgcp107',pgcp108='$pgcp108',pgcp109='$pgcp109',pgcp110='$pgcp110',pgcp111='$pgcp111',pgcp112='$pgcp112',pgcp113='$pgcp113',pgcp114='$pgcp114',pgcp115='$pgcp115',pgcp116='$pgcp116',pgcp117='$pgcp117',pgcp118='$pgcp118',pgcp119='$pgcp119',pgcp120='$pgcp120',pgcp121='$pgcp121',pgcp122='$pgcp122',pgcp123='$pgcp123',pgcp124='$pgcp124',pgcp125='$pgcp125',pgcp126='$pgcp126',pgcp127='$pgcp127',pgcp128='$pgcp128',pgcp129='$pgcp129',pgcp130='$pgcp130',pgcp131='$pgcp131',pgcp132='$pgcp132',pgcp133='$pgcp133',pgcp134='$pgcp134',pgcp135='$pgcp135',pgcp136='$pgcp136',pgcp137='$pgcp137',pgcp138='$pgcp138',pgcp139='$pgcp139',pgcp140='$pgcp140',pgcp141='$pgcp141',pgcp142='$pgcp142',pgcp143='$pgcp143',pgcp144='$pgcp144',pgcp145='$pgcp145',pgcp146='$pgcp146',pgcp147='$pgcp147',pgcp148='$pgcp148',pgcp149='$pgcp149',pgcp150='$pgcp150',pgcp151='$pgcp151',pgcp152='$pgcp152',pgcp153='$pgcp153',pgcp154='$pgcp154',pgcp155='$pgcp155',pgcp156='$pgcp156',pgcp157='$pgcp157',pgcp158='$pgcp158',pgcp159='$pgcp159',pgcp160='$pgcp160',vr_deb_16='$vr_deb_16',vr_deb_17='$vr_deb_17',vr_deb_18='$vr_deb_18',vr_deb_19='$vr_deb_19',vr_deb_20='$vr_deb_20',vr_deb_21='$vr_deb_21',vr_deb_22='$vr_deb_22',vr_deb_23='$vr_deb_23',vr_deb_24='$vr_deb_24',vr_deb_25='$vr_deb_25',vr_deb_26='$vr_deb_26',vr_deb_27='$vr_deb_27',vr_deb_28='$vr_deb_28',vr_deb_29='$vr_deb_29',vr_deb_30='$vr_deb_30',vr_deb_31='$vr_deb_31',vr_deb_32='$vr_deb_32',vr_deb_33='$vr_deb_33',vr_deb_34='$vr_deb_34',vr_deb_35='$vr_deb_35',vr_deb_36='$vr_deb_36',vr_deb_37='$vr_deb_37',vr_deb_38='$vr_deb_38',vr_deb_39='$vr_deb_39',vr_deb_40='$vr_deb_40',vr_deb_41='$vr_deb_41',vr_deb_42='$vr_deb_42',vr_deb_43='$vr_deb_43',vr_deb_44='$vr_deb_44',vr_deb_45='$vr_deb_45',vr_deb_46='$vr_deb_46',vr_deb_47='$vr_deb_47',vr_deb_48='$vr_deb_48',vr_deb_49='$vr_deb_49',vr_deb_50='$vr_deb_50',vr_deb_51='$vr_deb_51',vr_deb_52='$vr_deb_52',vr_deb_53='$vr_deb_53',vr_deb_54='$vr_deb_54',vr_deb_55='$vr_deb_55',vr_deb_56='$vr_deb_56',vr_deb_57='$vr_deb_57',vr_deb_58='$vr_deb_58',vr_deb_59='$vr_deb_59',vr_deb_60='$vr_deb_60',vr_deb_61='$vr_deb_61',vr_deb_62='$vr_deb_62',vr_deb_63='$vr_deb_63',vr_deb_64='$vr_deb_64',vr_deb_65='$vr_deb_65',vr_deb_66='$vr_deb_66',vr_deb_67='$vr_deb_67',vr_deb_68='$vr_deb_68',vr_deb_69='$vr_deb_69',vr_deb_70='$vr_deb_70',vr_deb_71='$vr_deb_71',vr_deb_72='$vr_deb_72',vr_deb_73='$vr_deb_73',vr_deb_74='$vr_deb_74',vr_deb_75='$vr_deb_75',vr_deb_76='$vr_deb_76',vr_deb_77='$vr_deb_77',vr_deb_78='$vr_deb_78',vr_deb_79='$vr_deb_79',vr_deb_80='$vr_deb_80',vr_deb_81='$vr_deb_81',vr_deb_82='$vr_deb_82',vr_deb_83='$vr_deb_83',vr_deb_84='$vr_deb_84',vr_deb_85='$vr_deb_85',vr_deb_86='$vr_deb_86',vr_deb_87='$vr_deb_87',vr_deb_88='$vr_deb_88',vr_deb_89='$vr_deb_89',vr_deb_90='$vr_deb_90',vr_deb_91='$vr_deb_91',vr_deb_92='$vr_deb_92',vr_deb_93='$vr_deb_93',vr_deb_94='$vr_deb_94',vr_deb_95='$vr_deb_95',vr_deb_96='$vr_deb_96',vr_deb_97='$vr_deb_97',vr_deb_98='$vr_deb_98',vr_deb_99='$vr_deb_99',vr_deb_100='$vr_deb_100',vr_deb_101='$vr_deb_101',vr_deb_102='$vr_deb_102',vr_deb_103='$vr_deb_103',vr_deb_104='$vr_deb_104',vr_deb_105='$vr_deb_105',vr_deb_106='$vr_deb_106',vr_deb_107='$vr_deb_107',vr_deb_108='$vr_deb_108',vr_deb_109='$vr_deb_109',vr_deb_110='$vr_deb_110',vr_deb_111='$vr_deb_111',vr_deb_112='$vr_deb_112',vr_deb_113='$vr_deb_113',vr_deb_114='$vr_deb_114',vr_deb_115='$vr_deb_115',vr_deb_116='$vr_deb_116',vr_deb_117='$vr_deb_117',vr_deb_118='$vr_deb_118',vr_deb_119='$vr_deb_119',vr_deb_120='$vr_deb_120',vr_deb_121='$vr_deb_121',vr_deb_122='$vr_deb_122',vr_deb_123='$vr_deb_123',vr_deb_124='$vr_deb_124',vr_deb_125='$vr_deb_125',vr_deb_126='$vr_deb_126',vr_deb_127='$vr_deb_127',vr_deb_128='$vr_deb_128',vr_deb_129='$vr_deb_129',vr_deb_130='$vr_deb_130',vr_deb_131='$vr_deb_131',vr_deb_132='$vr_deb_132',vr_deb_133='$vr_deb_133',vr_deb_134='$vr_deb_134',vr_deb_135='$vr_deb_135',vr_deb_136='$vr_deb_136',vr_deb_137='$vr_deb_137',vr_deb_138='$vr_deb_138',vr_deb_139='$vr_deb_139',vr_deb_140='$vr_deb_140',vr_deb_141='$vr_deb_141',vr_deb_142='$vr_deb_142',vr_deb_143='$vr_deb_143',vr_deb_144='$vr_deb_144',vr_deb_145='$vr_deb_145',vr_deb_146='$vr_deb_146',vr_deb_147='$vr_deb_147',vr_deb_148='$vr_deb_148',vr_deb_149='$vr_deb_149',vr_deb_150='$vr_deb_150',vr_deb_151='$vr_deb_151',vr_deb_152='$vr_deb_152',vr_deb_153='$vr_deb_153',vr_deb_154='$vr_deb_154',vr_deb_155='$vr_deb_155',vr_deb_156='$vr_deb_156',vr_deb_157='$vr_deb_157',vr_deb_158='$vr_deb_158',vr_deb_159='$vr_deb_159',vr_deb_160='$vr_deb_160',vr_cre_16='$vr_cre_16',vr_cre_17='$vr_cre_17',vr_cre_18='$vr_cre_18',vr_cre_19='$vr_cre_19',vr_cre_20='$vr_cre_20',vr_cre_21='$vr_cre_21',vr_cre_22='$vr_cre_22',vr_cre_23='$vr_cre_23',vr_cre_24='$vr_cre_24',vr_cre_25='$vr_cre_25',vr_cre_26='$vr_cre_26',vr_cre_27='$vr_cre_27',vr_cre_28='$vr_cre_28',vr_cre_29='$vr_cre_29',vr_cre_30='$vr_cre_30',vr_cre_31='$vr_cre_31',vr_cre_32='$vr_cre_32',vr_cre_33='$vr_cre_33',vr_cre_34='$vr_cre_34',vr_cre_35='$vr_cre_35',vr_cre_36='$vr_cre_36',vr_cre_37='$vr_cre_37',vr_cre_38='$vr_cre_38',vr_cre_39='$vr_cre_39',vr_cre_40='$vr_cre_40',vr_cre_41='$vr_cre_41',vr_cre_42='$vr_cre_42',vr_cre_43='$vr_cre_43',vr_cre_44='$vr_cre_44',vr_cre_45='$vr_cre_45',vr_cre_46='$vr_cre_46',vr_cre_47='$vr_cre_47',vr_cre_48='$vr_cre_48',vr_cre_49='$vr_cre_49',vr_cre_50='$vr_cre_50',vr_cre_51='$vr_cre_51',vr_cre_52='$vr_cre_52',vr_cre_53='$vr_cre_53',vr_cre_54='$vr_cre_54',vr_cre_55='$vr_cre_55',vr_cre_56='$vr_cre_56',vr_cre_57='$vr_cre_57',vr_cre_58='$vr_cre_58',vr_cre_59='$vr_cre_59',vr_cre_60='$vr_cre_60',vr_cre_61='$vr_cre_61',vr_cre_62='$vr_cre_62',vr_cre_63='$vr_cre_63',vr_cre_64='$vr_cre_64',vr_cre_65='$vr_cre_65',vr_cre_66='$vr_cre_66',vr_cre_67='$vr_cre_67',vr_cre_68='$vr_cre_68',vr_cre_69='$vr_cre_69',vr_cre_70='$vr_cre_70',vr_cre_71='$vr_cre_71',vr_cre_72='$vr_cre_72',vr_cre_73='$vr_cre_73',vr_cre_74='$vr_cre_74',vr_cre_75='$vr_cre_75',vr_cre_76='$vr_cre_76',vr_cre_77='$vr_cre_77',vr_cre_78='$vr_cre_78',vr_cre_79='$vr_cre_79',vr_cre_80='$vr_cre_80',vr_cre_81='$vr_cre_81',vr_cre_82='$vr_cre_82',vr_cre_83='$vr_cre_83',vr_cre_84='$vr_cre_84',vr_cre_85='$vr_cre_85',vr_cre_86='$vr_cre_86',vr_cre_87='$vr_cre_87',vr_cre_88='$vr_cre_88',vr_cre_89='$vr_cre_89',vr_cre_90='$vr_cre_90',vr_cre_91='$vr_cre_91',vr_cre_92='$vr_cre_92',vr_cre_93='$vr_cre_93',vr_cre_94='$vr_cre_94',vr_cre_95='$vr_cre_95',vr_cre_96='$vr_cre_96',vr_cre_97='$vr_cre_97',vr_cre_98='$vr_cre_98',vr_cre_99='$vr_cre_99',vr_cre_100='$vr_cre_100',vr_cre_101='$vr_cre_101',vr_cre_102='$vr_cre_102',vr_cre_103='$vr_cre_103',vr_cre_104='$vr_cre_104',vr_cre_105='$vr_cre_105',vr_cre_106='$vr_cre_106',vr_cre_107='$vr_cre_107',vr_cre_108='$vr_cre_108',vr_cre_109='$vr_cre_109',vr_cre_110='$vr_cre_110',vr_cre_111='$vr_cre_111',vr_cre_112='$vr_cre_112',vr_cre_113='$vr_cre_113',vr_cre_114='$vr_cre_114',vr_cre_115='$vr_cre_115',vr_cre_116='$vr_cre_116',vr_cre_117='$vr_cre_117',vr_cre_118='$vr_cre_118',vr_cre_119='$vr_cre_119',vr_cre_120='$vr_cre_120',vr_cre_121='$vr_cre_121',vr_cre_122='$vr_cre_122',vr_cre_123='$vr_cre_123',vr_cre_124='$vr_cre_124',vr_cre_125='$vr_cre_125',vr_cre_126='$vr_cre_126',vr_cre_127='$vr_cre_127',vr_cre_128='$vr_cre_128',vr_cre_129='$vr_cre_129',vr_cre_130='$vr_cre_130',vr_cre_131='$vr_cre_131',vr_cre_132='$vr_cre_132',vr_cre_133='$vr_cre_133',vr_cre_134='$vr_cre_134',vr_cre_135='$vr_cre_135',vr_cre_136='$vr_cre_136',vr_cre_137='$vr_cre_137',vr_cre_138='$vr_cre_138',vr_cre_139='$vr_cre_139',vr_cre_140='$vr_cre_140',vr_cre_141='$vr_cre_141',vr_cre_142='$vr_cre_142',vr_cre_143='$vr_cre_143',vr_cre_144='$vr_cre_144',vr_cre_145='$vr_cre_145',vr_cre_146='$vr_cre_146',vr_cre_147='$vr_cre_147',vr_cre_148='$vr_cre_148',vr_cre_149='$vr_cre_149',vr_cre_150='$vr_cre_150',vr_cre_151='$vr_cre_151',vr_cre_152='$vr_cre_152',vr_cre_153='$vr_cre_153',vr_cre_154='$vr_cre_154',vr_cre_155='$vr_cre_155',vr_cre_156='$vr_cre_156',vr_cre_157='$vr_cre_157',vr_cre_158='$vr_cre_158',vr_cre_159='$vr_cre_159',vr_cre_160='$vr_cre_160',cheque_1='$cheque_1',cheque_2='$cheque_2',cheque_3='$cheque_3',cheque_4='$cheque_4',cheque_5='$cheque_5',cheque_6='$cheque_6',cheque_7='$cheque_7',cheque_8='$cheque_8',cheque_9='$cheque_9',cheque_10='$cheque_10',cheque_11='$cheque_11',cheque_12='$cheque_12',cheque_13='$cheque_13',cheque_14='$cheque_14',cheque_15='$cheque_15',cheque_16='$cheque_16',cheque_17='$cheque_17',cheque_18='$cheque_18',cheque_19='$cheque_19',cheque_20='$cheque_20',ter='$ter'

									where id='$idv2[$k]'";

					$connectionxx->query($sq6) or die(mysqli_error($connectionxx));
				} // fin de ultimo registro			


				printf("<br><br><center class ='Estilo4'>REGISTRO INSERTADO CON EXITO</center><br /><br />");



				//}






			}
		}
	}
	//}

	printf("

<center class='Estilo9'>
<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
<input type='hidden' name='nn' value='TNAT'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo19' /> :::...
</form>
</center>
");

?>
<?php
}
?>
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
</style>