<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
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
}


$id_reip ='';
$id_caic ='';
$id_unico_reip='';
$vr_orig_reip='';
$id_manu_rcgt = 'RICA'.$_POST['id_manu_rcgt']; 
$id_recau = $_POST['consec_ncbt']; 
$fecha_recaudo = $_POST['fecha_recaudo'];
$des_recaudo = strtoupper($_POST['des_recaudo']);
$filas = $_POST['filas']; 
$tip_ica = $_POST['tipo']; 
$cod_ica = $_POST['ica']; 


//union de terceros
$terd=split("-",$_POST['tercero']);
$tercero = $terd[1];
$ter = $terd[0];//printf("<br>tercero %s<br>",$tercero);


$pgcp1 = $_POST['pgcp1']; // printf("<br>pgcp que llega %s<br>",$pgcp1);
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
$pgcp16= $_POST['pgcp16'];
$pgcp17= $_POST['pgcp17'];
$pgcp18= $_POST['pgcp18'];
$pgcp19= $_POST['pgcp19'];
$pgcp20= $_POST['pgcp20'];
$pgcp21= $_POST['pgcp21'];
$pgcp22= $_POST['pgcp22'];
$pgcp23= $_POST['pgcp23'];
$pgcp24= $_POST['pgcp24'];
$pgcp25= $_POST['pgcp25'];
$pgcp26= $_POST['pgcp26'];
$pgcp27= $_POST['pgcp27'];
$pgcp28= $_POST['pgcp28'];
$pgcp29= $_POST['pgcp29'];
$pgcp30= $_POST['pgcp30'];
$pgcp31= $_POST['pgcp31'];
$pgcp32= $_POST['pgcp32'];
$pgcp33= $_POST['pgcp33'];
$pgcp34= $_POST['pgcp34'];
$pgcp35= $_POST['pgcp35'];
$pgcp36= $_POST['pgcp36'];
$pgcp37= $_POST['pgcp37'];
$pgcp38= $_POST['pgcp38'];
$pgcp39= $_POST['pgcp39'];
$pgcp40= $_POST['pgcp40'];
$pgcp41= $_POST['pgcp41'];
$pgcp42= $_POST['pgcp42'];
$pgcp43= $_POST['pgcp43'];
$pgcp44= $_POST['pgcp44'];
$pgcp45= $_POST['pgcp45'];
$pgcp46= $_POST['pgcp46'];
$pgcp47= $_POST['pgcp47'];
$pgcp48= $_POST['pgcp48'];
$pgcp49= $_POST['pgcp49'];
$pgcp50= $_POST['pgcp50'];
$pgcp51= $_POST['pgcp51'];
$pgcp52= $_POST['pgcp52'];
$pgcp53= $_POST['pgcp53'];
$pgcp54= $_POST['pgcp54'];
$pgcp55= $_POST['pgcp55'];
$pgcp56= $_POST['pgcp56'];
$pgcp57= $_POST['pgcp57'];
$pgcp58= $_POST['pgcp58'];
$pgcp59= $_POST['pgcp59'];
$pgcp60= $_POST['pgcp60'];
$pgcp61= $_POST['pgcp61'];
$pgcp62= $_POST['pgcp62'];
$pgcp63= $_POST['pgcp63'];
$pgcp64= $_POST['pgcp64'];
$pgcp65= $_POST['pgcp65'];
$pgcp66= $_POST['pgcp66'];
$pgcp67= $_POST['pgcp67'];
$pgcp68= $_POST['pgcp68'];
$pgcp69= $_POST['pgcp69'];
$pgcp70= $_POST['pgcp70'];
$pgcp71= $_POST['pgcp71'];
$pgcp72= $_POST['pgcp72'];
$pgcp73= $_POST['pgcp73'];
$pgcp74= $_POST['pgcp74'];
$pgcp75= $_POST['pgcp75'];
$pgcp76= $_POST['pgcp76'];
$pgcp77= $_POST['pgcp77'];
$pgcp78= $_POST['pgcp78'];
$pgcp79= $_POST['pgcp79'];
$pgcp80= $_POST['pgcp80'];
$pgcp81= $_POST['pgcp81'];
$pgcp82= $_POST['pgcp82'];
$pgcp83= $_POST['pgcp83'];
$pgcp84= $_POST['pgcp84'];
$pgcp85= $_POST['pgcp85'];
$pgcp86= $_POST['pgcp86'];
$pgcp87= $_POST['pgcp87'];
$pgcp88= $_POST['pgcp88'];
$pgcp89= $_POST['pgcp89'];
$pgcp90= $_POST['pgcp90'];
$pgcp91= $_POST['pgcp91'];
$pgcp92= $_POST['pgcp92'];
$pgcp93= $_POST['pgcp93'];
$pgcp94= $_POST['pgcp94'];
$pgcp95= $_POST['pgcp95'];
$pgcp96= $_POST['pgcp96'];
$pgcp97= $_POST['pgcp97'];
$pgcp98= $_POST['pgcp98'];
$pgcp99= $_POST['pgcp99'];
$pgcp100= $_POST['pgcp100'];
$pgcp101= $_POST['pgcp101'];
$pgcp102= $_POST['pgcp102'];
$pgcp103= $_POST['pgcp103'];
$pgcp104= $_POST['pgcp104'];
$pgcp105= $_POST['pgcp105'];
$pgcp106= $_POST['pgcp106'];
$pgcp107= $_POST['pgcp107'];
$pgcp108= $_POST['pgcp108'];
$pgcp109= $_POST['pgcp109'];
$pgcp110= $_POST['pgcp110'];
$pgcp111= $_POST['pgcp111'];
$pgcp112= $_POST['pgcp112'];
$pgcp113= $_POST['pgcp113'];
$pgcp114= $_POST['pgcp114'];
$pgcp115= $_POST['pgcp115'];
$pgcp116= $_POST['pgcp116'];
$pgcp117= $_POST['pgcp117'];
$pgcp118= $_POST['pgcp118'];
$pgcp119= $_POST['pgcp119'];
$pgcp120= $_POST['pgcp120'];
$pgcp121= $_POST['pgcp121'];
$pgcp122= $_POST['pgcp122'];
$pgcp123= $_POST['pgcp123'];
$pgcp124= $_POST['pgcp124'];
$pgcp125= $_POST['pgcp125'];
$pgcp126= $_POST['pgcp126'];
$pgcp127= $_POST['pgcp127'];
$pgcp128= $_POST['pgcp128'];
$pgcp129= $_POST['pgcp129'];
$pgcp130= $_POST['pgcp130'];
$pgcp131= $_POST['pgcp131'];
$pgcp132= $_POST['pgcp132'];
$pgcp133= $_POST['pgcp133'];
$pgcp134= $_POST['pgcp134'];
$pgcp135= $_POST['pgcp135'];
$pgcp136= $_POST['pgcp136'];
$pgcp137= $_POST['pgcp137'];
$pgcp138= $_POST['pgcp138'];
$pgcp139= $_POST['pgcp139'];
$pgcp140= $_POST['pgcp140'];
$pgcp141= $_POST['pgcp141'];
$pgcp142= $_POST['pgcp142'];
$pgcp143= $_POST['pgcp143'];
$pgcp144= $_POST['pgcp144'];
$pgcp145= $_POST['pgcp145'];
$pgcp146= $_POST['pgcp146'];
$pgcp147= $_POST['pgcp147'];
$pgcp148= $_POST['pgcp148'];
$pgcp149= $_POST['pgcp149'];
$pgcp150= $_POST['pgcp150'];
$pgcp151= $_POST['pgcp151'];
$pgcp152= $_POST['pgcp152'];
$pgcp153= $_POST['pgcp153'];
$pgcp154= $_POST['pgcp154'];
$pgcp155= $_POST['pgcp155'];
$pgcp156= $_POST['pgcp156'];
$pgcp157= $_POST['pgcp157'];
$pgcp158= $_POST['pgcp158'];
$pgcp159= $_POST['pgcp159'];
$pgcp160= $_POST['pgcp160'];

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

$vr_deb_1 = str_replace('.','',$_POST['vr_deb_1']);
$vr_deb_2 = str_replace('.','',$_POST['vr_deb_2']);
$vr_deb_3 = str_replace('.','',$_POST['vr_deb_3']);
$vr_deb_4 = str_replace('.','',$_POST['vr_deb_4']);
$vr_deb_5 = str_replace('.','',$_POST['vr_deb_5']);
$vr_deb_6 = str_replace('.','',$_POST['vr_deb_6']);
$vr_deb_7 = str_replace('.','',$_POST['vr_deb_7']);
$vr_deb_8 = str_replace('.','',$_POST['vr_deb_8']);
$vr_deb_9 = str_replace('.','',$_POST['vr_deb_9']);
$vr_deb_10 = str_replace('.','',$_POST['vr_deb_10']);
$vr_deb_11 = str_replace('.','',$_POST['vr_deb_11']);
$vr_deb_12 = str_replace('.','',$_POST['vr_deb_12']);
$vr_deb_13 = str_replace('.','',$_POST['vr_deb_13']);
$vr_deb_14 = str_replace('.','',$_POST['vr_deb_14']);
$vr_deb_15 = str_replace('.','',$_POST['vr_deb_15']);
$vr_deb_16 = str_replace('.','',$_POST['vr_deb_16']);
$vr_deb_17 = str_replace('.','',$_POST['vr_deb_17']);
$vr_deb_18 = str_replace('.','',$_POST['vr_deb_18']);
$vr_deb_19 = str_replace('.','',$_POST['vr_deb_19']);
$vr_deb_20 = str_replace('.','',$_POST['vr_deb_20']);
$vr_deb_21 = str_replace('.','',$_POST['vr_deb_21']);
$vr_deb_22 = str_replace('.','',$_POST['vr_deb_22']);
$vr_deb_23 = str_replace('.','',$_POST['vr_deb_23']);
$vr_deb_24 = str_replace('.','',$_POST['vr_deb_24']);
$vr_deb_25 = str_replace('.','',$_POST['vr_deb_25']);
$vr_deb_26 = str_replace('.','',$_POST['vr_deb_26']);
$vr_deb_27 = str_replace('.','',$_POST['vr_deb_27']);
$vr_deb_28 = str_replace('.','',$_POST['vr_deb_28']);
$vr_deb_29 = str_replace('.','',$_POST['vr_deb_29']);
$vr_deb_30 = str_replace('.','',$_POST['vr_deb_30']);
$vr_deb_31 = str_replace('.','',$_POST['vr_deb_31']);
$vr_deb_32 = str_replace('.','',$_POST['vr_deb_32']);
$vr_deb_33 = str_replace('.','',$_POST['vr_deb_33']);
$vr_deb_34 = str_replace('.','',$_POST['vr_deb_34']);
$vr_deb_35 = str_replace('.','',$_POST['vr_deb_35']);
$vr_deb_36 = str_replace('.','',$_POST['vr_deb_36']);
$vr_deb_37 = str_replace('.','',$_POST['vr_deb_37']);
$vr_deb_38 = str_replace('.','',$_POST['vr_deb_38']);
$vr_deb_39 = str_replace('.','',$_POST['vr_deb_39']);
$vr_deb_40 = str_replace('.','',$_POST['vr_deb_40']);
$vr_deb_41 = str_replace('.','',$_POST['vr_deb_41']);
$vr_deb_42 = str_replace('.','',$_POST['vr_deb_42']);
$vr_deb_43 = str_replace('.','',$_POST['vr_deb_43']);
$vr_deb_44 = str_replace('.','',$_POST['vr_deb_44']);
$vr_deb_45 = str_replace('.','',$_POST['vr_deb_45']);
$vr_deb_46 = str_replace('.','',$_POST['vr_deb_46']);
$vr_deb_47 = str_replace('.','',$_POST['vr_deb_47']);
$vr_deb_48 = str_replace('.','',$_POST['vr_deb_48']);
$vr_deb_49 = str_replace('.','',$_POST['vr_deb_49']);
$vr_deb_50 = str_replace('.','',$_POST['vr_deb_50']);
$vr_deb_51 = str_replace('.','',$_POST['vr_deb_51']);
$vr_deb_52 = str_replace('.','',$_POST['vr_deb_52']);
$vr_deb_53 = str_replace('.','',$_POST['vr_deb_53']);
$vr_deb_54 = str_replace('.','',$_POST['vr_deb_54']);
$vr_deb_55 = str_replace('.','',$_POST['vr_deb_55']);
$vr_deb_56 = str_replace('.','',$_POST['vr_deb_56']);
$vr_deb_57 = str_replace('.','',$_POST['vr_deb_57']);
$vr_deb_58 = str_replace('.','',$_POST['vr_deb_58']);
$vr_deb_59 = str_replace('.','',$_POST['vr_deb_59']);
$vr_deb_60 = str_replace('.','',$_POST['vr_deb_60']);
$vr_deb_61 = str_replace('.','',$_POST['vr_deb_61']);
$vr_deb_62 = str_replace('.','',$_POST['vr_deb_62']);
$vr_deb_63 = str_replace('.','',$_POST['vr_deb_63']);
$vr_deb_64 = str_replace('.','',$_POST['vr_deb_64']);
$vr_deb_65 = str_replace('.','',$_POST['vr_deb_65']);
$vr_deb_66 = str_replace('.','',$_POST['vr_deb_66']);
$vr_deb_67 = str_replace('.','',$_POST['vr_deb_67']);
$vr_deb_68 = str_replace('.','',$_POST['vr_deb_68']);
$vr_deb_69 = str_replace('.','',$_POST['vr_deb_69']);
$vr_deb_70 = str_replace('.','',$_POST['vr_deb_70']);
$vr_deb_71 = str_replace('.','',$_POST['vr_deb_71']);
$vr_deb_72 = str_replace('.','',$_POST['vr_deb_72']);
$vr_deb_73 = str_replace('.','',$_POST['vr_deb_73']);
$vr_deb_74 = str_replace('.','',$_POST['vr_deb_74']);
$vr_deb_75 = str_replace('.','',$_POST['vr_deb_75']);
$vr_deb_76 = str_replace('.','',$_POST['vr_deb_76']);
$vr_deb_77 = str_replace('.','',$_POST['vr_deb_77']);
$vr_deb_78 = str_replace('.','',$_POST['vr_deb_78']);
$vr_deb_79 = str_replace('.','',$_POST['vr_deb_79']);
$vr_deb_80 = str_replace('.','',$_POST['vr_deb_80']);
$vr_deb_81 = str_replace('.','',$_POST['vr_deb_81']);
$vr_deb_82 = str_replace('.','',$_POST['vr_deb_82']);
$vr_deb_83 = str_replace('.','',$_POST['vr_deb_83']);
$vr_deb_84 = str_replace('.','',$_POST['vr_deb_84']);
$vr_deb_85 = str_replace('.','',$_POST['vr_deb_85']);
$vr_deb_86 = str_replace('.','',$_POST['vr_deb_86']);
$vr_deb_87 = str_replace('.','',$_POST['vr_deb_87']);
$vr_deb_88 = str_replace('.','',$_POST['vr_deb_88']);
$vr_deb_89 = str_replace('.','',$_POST['vr_deb_89']);
$vr_deb_90 = str_replace('.','',$_POST['vr_deb_90']);
$vr_deb_91 = str_replace('.','',$_POST['vr_deb_91']);
$vr_deb_92 = str_replace('.','',$_POST['vr_deb_92']);
$vr_deb_93 = str_replace('.','',$_POST['vr_deb_93']);
$vr_deb_94 = str_replace('.','',$_POST['vr_deb_94']);
$vr_deb_95 = str_replace('.','',$_POST['vr_deb_95']);
$vr_deb_96 = str_replace('.','',$_POST['vr_deb_96']);
$vr_deb_97 = str_replace('.','',$_POST['vr_deb_97']);
$vr_deb_98 = str_replace('.','',$_POST['vr_deb_98']);
$vr_deb_99 = str_replace('.','',$_POST['vr_deb_99']);
$vr_deb_100 = str_replace('.','',$_POST['vr_deb_100']);
$vr_deb_101 = str_replace('.','',$_POST['vr_deb_101']);
$vr_deb_102 = str_replace('.','',$_POST['vr_deb_102']);
$vr_deb_103 = str_replace('.','',$_POST['vr_deb_103']);
$vr_deb_104 = str_replace('.','',$_POST['vr_deb_104']);
$vr_deb_105 = str_replace('.','',$_POST['vr_deb_105']);
$vr_deb_106 = str_replace('.','',$_POST['vr_deb_106']);
$vr_deb_107 = str_replace('.','',$_POST['vr_deb_107']);
$vr_deb_108 = str_replace('.','',$_POST['vr_deb_108']);
$vr_deb_109 = str_replace('.','',$_POST['vr_deb_109']);
$vr_deb_110 = str_replace('.','',$_POST['vr_deb_110']);
$vr_deb_111 = str_replace('.','',$_POST['vr_deb_111']);
$vr_deb_112 = str_replace('.','',$_POST['vr_deb_112']);
$vr_deb_113 = str_replace('.','',$_POST['vr_deb_113']);
$vr_deb_114 = str_replace('.','',$_POST['vr_deb_114']);
$vr_deb_115 = str_replace('.','',$_POST['vr_deb_115']);
$vr_deb_116 = str_replace('.','',$_POST['vr_deb_116']);
$vr_deb_117 = str_replace('.','',$_POST['vr_deb_117']);
$vr_deb_118 = str_replace('.','',$_POST['vr_deb_118']);
$vr_deb_119 = str_replace('.','',$_POST['vr_deb_119']);
$vr_deb_120 = str_replace('.','',$_POST['vr_deb_120']);
$vr_deb_121 = str_replace('.','',$_POST['vr_deb_121']);
$vr_deb_122 = str_replace('.','',$_POST['vr_deb_122']);
$vr_deb_123 = str_replace('.','',$_POST['vr_deb_123']);
$vr_deb_124 = str_replace('.','',$_POST['vr_deb_124']);
$vr_deb_125 = str_replace('.','',$_POST['vr_deb_125']);
$vr_deb_126 = str_replace('.','',$_POST['vr_deb_126']);
$vr_deb_127 = str_replace('.','',$_POST['vr_deb_127']);
$vr_deb_128 = str_replace('.','',$_POST['vr_deb_128']);
$vr_deb_129 = str_replace('.','',$_POST['vr_deb_129']);
$vr_deb_130 = str_replace('.','',$_POST['vr_deb_130']);
$vr_deb_131 = str_replace('.','',$_POST['vr_deb_131']);
$vr_deb_132 = str_replace('.','',$_POST['vr_deb_132']);
$vr_deb_133 = str_replace('.','',$_POST['vr_deb_133']);
$vr_deb_134 = str_replace('.','',$_POST['vr_deb_134']);
$vr_deb_135 = str_replace('.','',$_POST['vr_deb_135']);
$vr_deb_136 = str_replace('.','',$_POST['vr_deb_136']);
$vr_deb_137 = str_replace('.','',$_POST['vr_deb_137']);
$vr_deb_138 = str_replace('.','',$_POST['vr_deb_138']);
$vr_deb_139 = str_replace('.','',$_POST['vr_deb_139']);
$vr_deb_140 = str_replace('.','',$_POST['vr_deb_140']);
$vr_deb_141 = str_replace('.','',$_POST['vr_deb_141']);
$vr_deb_142 = str_replace('.','',$_POST['vr_deb_142']);
$vr_deb_143 = str_replace('.','',$_POST['vr_deb_143']);
$vr_deb_144 = str_replace('.','',$_POST['vr_deb_144']);
$vr_deb_145 = str_replace('.','',$_POST['vr_deb_145']);
$vr_deb_146 = str_replace('.','',$_POST['vr_deb_146']);
$vr_deb_147 = str_replace('.','',$_POST['vr_deb_147']);
$vr_deb_148 = str_replace('.','',$_POST['vr_deb_148']);
$vr_deb_149 = str_replace('.','',$_POST['vr_deb_149']);
$vr_deb_150 = str_replace('.','',$_POST['vr_deb_150']);
$vr_deb_151 = str_replace('.','',$_POST['vr_deb_151']);
$vr_deb_152 = str_replace('.','',$_POST['vr_deb_152']);
$vr_deb_153 = str_replace('.','',$_POST['vr_deb_153']);
$vr_deb_154 = str_replace('.','',$_POST['vr_deb_154']);
$vr_deb_155 = str_replace('.','',$_POST['vr_deb_155']);
$vr_deb_156 = str_replace('.','',$_POST['vr_deb_156']);
$vr_deb_157 = str_replace('.','',$_POST['vr_deb_157']);
$vr_deb_158 = str_replace('.','',$_POST['vr_deb_158']);
$vr_deb_159 = str_replace('.','',$_POST['vr_deb_159']);
$vr_deb_160 = str_replace('.','',$_POST['vr_deb_160']);

$vr_cre_1 = str_replace('.','',$_POST['vr_cre_1']);
$vr_cre_2 = str_replace('.','',$_POST['vr_cre_2']);
$vr_cre_3 = str_replace('.','',$_POST['vr_cre_3']);
$vr_cre_4 = str_replace('.','',$_POST['vr_cre_4']);
$vr_cre_5 = str_replace('.','',$_POST['vr_cre_5']);
$vr_cre_6 = str_replace('.','',$_POST['vr_cre_6']);
$vr_cre_7 = str_replace('.','',$_POST['vr_cre_7']);
$vr_cre_8 = str_replace('.','',$_POST['vr_cre_8']);
$vr_cre_9 = str_replace('.','',$_POST['vr_cre_9']);
$vr_cre_10 = str_replace('.','',$_POST['vr_cre_10']);
$vr_cre_11 = str_replace('.','',$_POST['vr_cre_11']);
$vr_cre_12 = str_replace('.','',$_POST['vr_cre_12']);
$vr_cre_13 = str_replace('.','',$_POST['vr_cre_13']);
$vr_cre_14 = str_replace('.','',$_POST['vr_cre_14']);
$vr_cre_15 = str_replace('.','',$_POST['vr_cre_15']);
$vr_cre_16 = str_replace('.','',$_POST['vr_cre_16']);
$vr_cre_17 = str_replace('.','',$_POST['vr_cre_17']);
$vr_cre_18 = str_replace('.','',$_POST['vr_cre_18']);
$vr_cre_19 = str_replace('.','',$_POST['vr_cre_19']);
$vr_cre_20 = str_replace('.','',$_POST['vr_cre_20']);
$vr_cre_21 = str_replace('.','',$_POST['vr_cre_21']);
$vr_cre_22 = str_replace('.','',$_POST['vr_cre_22']);
$vr_cre_23 = str_replace('.','',$_POST['vr_cre_23']);
$vr_cre_24 = str_replace('.','',$_POST['vr_cre_24']);
$vr_cre_25 = str_replace('.','',$_POST['vr_cre_25']);
$vr_cre_26 = str_replace('.','',$_POST['vr_cre_26']);
$vr_cre_27 = str_replace('.','',$_POST['vr_cre_27']);
$vr_cre_28 = str_replace('.','',$_POST['vr_cre_28']);
$vr_cre_29 = str_replace('.','',$_POST['vr_cre_29']);
$vr_cre_30 = str_replace('.','',$_POST['vr_cre_30']);
$vr_cre_31 = str_replace('.','',$_POST['vr_cre_31']);
$vr_cre_32 = str_replace('.','',$_POST['vr_cre_32']);
$vr_cre_33 = str_replace('.','',$_POST['vr_cre_33']);
$vr_cre_34 = str_replace('.','',$_POST['vr_cre_34']);
$vr_cre_35 = str_replace('.','',$_POST['vr_cre_35']);
$vr_cre_36 = str_replace('.','',$_POST['vr_cre_36']);
$vr_cre_37 = str_replace('.','',$_POST['vr_cre_37']);
$vr_cre_38 = str_replace('.','',$_POST['vr_cre_38']);
$vr_cre_39 = str_replace('.','',$_POST['vr_cre_39']);
$vr_cre_40 = str_replace('.','',$_POST['vr_cre_40']);
$vr_cre_41 = str_replace('.','',$_POST['vr_cre_41']);
$vr_cre_42 = str_replace('.','',$_POST['vr_cre_42']);
$vr_cre_43 = str_replace('.','',$_POST['vr_cre_43']);
$vr_cre_44 = str_replace('.','',$_POST['vr_cre_44']);
$vr_cre_45 = str_replace('.','',$_POST['vr_cre_45']);
$vr_cre_46 = str_replace('.','',$_POST['vr_cre_46']);
$vr_cre_47 = str_replace('.','',$_POST['vr_cre_47']);
$vr_cre_48 = str_replace('.','',$_POST['vr_cre_48']);
$vr_cre_49 = str_replace('.','',$_POST['vr_cre_49']);
$vr_cre_50 = str_replace('.','',$_POST['vr_cre_50']);
$vr_cre_51 = str_replace('.','',$_POST['vr_cre_51']);
$vr_cre_52 = str_replace('.','',$_POST['vr_cre_52']);
$vr_cre_53 = str_replace('.','',$_POST['vr_cre_53']);
$vr_cre_54 = str_replace('.','',$_POST['vr_cre_54']);
$vr_cre_55 = str_replace('.','',$_POST['vr_cre_55']);
$vr_cre_56 = str_replace('.','',$_POST['vr_cre_56']);
$vr_cre_57 = str_replace('.','',$_POST['vr_cre_57']);
$vr_cre_58 = str_replace('.','',$_POST['vr_cre_58']);
$vr_cre_59 = str_replace('.','',$_POST['vr_cre_59']);
$vr_cre_60 = str_replace('.','',$_POST['vr_cre_60']);
$vr_cre_61 = str_replace('.','',$_POST['vr_cre_61']);
$vr_cre_62 = str_replace('.','',$_POST['vr_cre_62']);
$vr_cre_63 = str_replace('.','',$_POST['vr_cre_63']);
$vr_cre_64 = str_replace('.','',$_POST['vr_cre_64']);
$vr_cre_65 = str_replace('.','',$_POST['vr_cre_65']);
$vr_cre_66 = str_replace('.','',$_POST['vr_cre_66']);
$vr_cre_67 = str_replace('.','',$_POST['vr_cre_67']);
$vr_cre_68 = str_replace('.','',$_POST['vr_cre_68']);
$vr_cre_69 = str_replace('.','',$_POST['vr_cre_69']);
$vr_cre_70 = str_replace('.','',$_POST['vr_cre_70']);
$vr_cre_71 = str_replace('.','',$_POST['vr_cre_71']);
$vr_cre_72 = str_replace('.','',$_POST['vr_cre_72']);
$vr_cre_73 = str_replace('.','',$_POST['vr_cre_73']);
$vr_cre_74 = str_replace('.','',$_POST['vr_cre_74']);
$vr_cre_75 = str_replace('.','',$_POST['vr_cre_75']);
$vr_cre_76 = str_replace('.','',$_POST['vr_cre_76']);
$vr_cre_77 = str_replace('.','',$_POST['vr_cre_77']);
$vr_cre_78 = str_replace('.','',$_POST['vr_cre_78']);
$vr_cre_79 = str_replace('.','',$_POST['vr_cre_79']);
$vr_cre_80 = str_replace('.','',$_POST['vr_cre_80']);
$vr_cre_81 = str_replace('.','',$_POST['vr_cre_81']);
$vr_cre_82 = str_replace('.','',$_POST['vr_cre_82']);
$vr_cre_83 = str_replace('.','',$_POST['vr_cre_83']);
$vr_cre_84 = str_replace('.','',$_POST['vr_cre_84']);
$vr_cre_85 = str_replace('.','',$_POST['vr_cre_85']);
$vr_cre_86 = str_replace('.','',$_POST['vr_cre_86']);
$vr_cre_87 = str_replace('.','',$_POST['vr_cre_87']);
$vr_cre_88 = str_replace('.','',$_POST['vr_cre_88']);
$vr_cre_89 = str_replace('.','',$_POST['vr_cre_89']);
$vr_cre_90 = str_replace('.','',$_POST['vr_cre_90']);
$vr_cre_91 = str_replace('.','',$_POST['vr_cre_91']);
$vr_cre_92 = str_replace('.','',$_POST['vr_cre_92']);
$vr_cre_93 = str_replace('.','',$_POST['vr_cre_93']);
$vr_cre_94 = str_replace('.','',$_POST['vr_cre_94']);
$vr_cre_95 = str_replace('.','',$_POST['vr_cre_95']);
$vr_cre_96 = str_replace('.','',$_POST['vr_cre_96']);
$vr_cre_97 = str_replace('.','',$_POST['vr_cre_97']);
$vr_cre_98 = str_replace('.','',$_POST['vr_cre_98']);
$vr_cre_99 = str_replace('.','',$_POST['vr_cre_99']);
$vr_cre_100 = str_replace('.','',$_POST['vr_cre_100']);
$vr_cre_101 = str_replace('.','',$_POST['vr_cre_101']);
$vr_cre_102 = str_replace('.','',$_POST['vr_cre_102']);
$vr_cre_103 = str_replace('.','',$_POST['vr_cre_103']);
$vr_cre_104 = str_replace('.','',$_POST['vr_cre_104']);
$vr_cre_105 = str_replace('.','',$_POST['vr_cre_105']);
$vr_cre_106 = str_replace('.','',$_POST['vr_cre_106']);
$vr_cre_107 = str_replace('.','',$_POST['vr_cre_107']);
$vr_cre_108 = str_replace('.','',$_POST['vr_cre_108']);
$vr_cre_109 = str_replace('.','',$_POST['vr_cre_109']);
$vr_cre_110 = str_replace('.','',$_POST['vr_cre_110']);
$vr_cre_111 = str_replace('.','',$_POST['vr_cre_111']);
$vr_cre_112 = str_replace('.','',$_POST['vr_cre_112']);
$vr_cre_113 = str_replace('.','',$_POST['vr_cre_113']);
$vr_cre_114 = str_replace('.','',$_POST['vr_cre_114']);
$vr_cre_115 = str_replace('.','',$_POST['vr_cre_115']);
$vr_cre_116 = str_replace('.','',$_POST['vr_cre_116']);
$vr_cre_117 = str_replace('.','',$_POST['vr_cre_117']);
$vr_cre_118 = str_replace('.','',$_POST['vr_cre_118']);
$vr_cre_119 = str_replace('.','',$_POST['vr_cre_119']);
$vr_cre_120 = str_replace('.','',$_POST['vr_cre_120']);
$vr_cre_121 = str_replace('.','',$_POST['vr_cre_121']);
$vr_cre_122 = str_replace('.','',$_POST['vr_cre_122']);
$vr_cre_123 = str_replace('.','',$_POST['vr_cre_123']);
$vr_cre_124 = str_replace('.','',$_POST['vr_cre_124']);
$vr_cre_125 = str_replace('.','',$_POST['vr_cre_125']);
$vr_cre_126 = str_replace('.','',$_POST['vr_cre_126']);
$vr_cre_127 = str_replace('.','',$_POST['vr_cre_127']);
$vr_cre_128 = str_replace('.','',$_POST['vr_cre_128']);
$vr_cre_129 = str_replace('.','',$_POST['vr_cre_129']);
$vr_cre_130 = str_replace('.','',$_POST['vr_cre_130']);
$vr_cre_131 = str_replace('.','',$_POST['vr_cre_131']);
$vr_cre_132 = str_replace('.','',$_POST['vr_cre_132']);
$vr_cre_133 = str_replace('.','',$_POST['vr_cre_133']);
$vr_cre_134 = str_replace('.','',$_POST['vr_cre_134']);
$vr_cre_135 = str_replace('.','',$_POST['vr_cre_135']);


$vr_cre_136 = str_replace('.','',$_POST['vr_cre_136']);
$vr_cre_137 = str_replace('.','',$_POST['vr_cre_137']);
$vr_cre_138 = str_replace('.','',$_POST['vr_cre_138']);
$vr_cre_139 = str_replace('.','',$_POST['vr_cre_139']);
$vr_cre_140 = str_replace('.','',$_POST['vr_cre_140']);
$vr_cre_141 = str_replace('.','',$_POST['vr_cre_141']);
$vr_cre_142 = str_replace('.','',$_POST['vr_cre_142']);
$vr_cre_143 = str_replace('.','',$_POST['vr_cre_143']);
$vr_cre_144 = str_replace('.','',$_POST['vr_cre_144']);
$vr_cre_145 = str_replace('.','',$_POST['vr_cre_145']);
$vr_cre_146 = str_replace('.','',$_POST['vr_cre_146']);
$vr_cre_147 = str_replace('.','',$_POST['vr_cre_147']);
$vr_cre_148 = str_replace('.','',$_POST['vr_cre_148']);
$vr_cre_149 = str_replace('.','',$_POST['vr_cre_149']);
$vr_cre_150 = str_replace('.','',$_POST['vr_cre_150']);
$vr_cre_151 = str_replace('.','',$_POST['vr_cre_151']);
$vr_cre_152 = str_replace('.','',$_POST['vr_cre_152']);
$vr_cre_153 = str_replace('.','',$_POST['vr_cre_153']);
$vr_cre_154 = str_replace('.','',$_POST['vr_cre_154']);
$vr_cre_155 = str_replace('.','',$_POST['vr_cre_155']);
$vr_cre_156 = str_replace('.','',$_POST['vr_cre_156']);
$vr_cre_157 = str_replace('.','',$_POST['vr_cre_157']);
$vr_cre_158 = str_replace('.','',$_POST['vr_cre_158']);
$vr_cre_159 = str_replace('.','',$_POST['vr_cre_159']);
$vr_cre_160 = str_replace('.','',$_POST['vr_cre_160']);
$press_1=str_replace('.','',$_POST['conta_1']);
$press_2=str_replace('.','',$_POST['conta_2']);
$press_3=str_replace('.','',$_POST['conta_3']);
$press_4=str_replace('.','',$_POST['conta_4']);
$press_5=str_replace('.','',$_POST['conta_5']);
$press_6=str_replace('.','',$_POST['conta_6']);
$press_7=str_replace('.','',$_POST['conta_7']);
$press_8=str_replace('.','',$_POST['conta_8']);
$press_9=str_replace('.','',$_POST['conta_9']);
$press_10=str_replace('.','',$_POST['conta_10']);
$press_11=str_replace('.','',$_POST['conta_11']);
$press_12=str_replace('.','',$_POST['conta_12']);
$press_13=str_replace('.','',$_POST['conta_13']);
$cheque_1=$_POST['cheque_1'];
$cheque_2=$_POST['cheque_2'];
$cheque_3=$_POST['cheque_3'];
$cheque_4=$_POST['cheque_4'];
$cheque_5=$_POST['cheque_5'];
$cheque_6=$_POST['cheque_6'];
$cheque_7=$_POST['cheque_7'];
$cheque_8=$_POST['cheque_8'];
$cheque_9=$_POST['cheque_9'];
$cheque_10=$_POST['cheque_10'];
$cheque_11=$_POST['cheque_11'];
$cheque_12=$_POST['cheque_12'];
$cheque_13=$_POST['cheque_13'];
$cheque_14=$_POST['cheque_14'];
$cheque_15=$_POST['cheque_15'];
$cheque_16=$_POST['cheque_16'];
$cheque_17=$_POST['cheque_17'];
$cheque_18=$_POST['cheque_18'];
$cheque_19=$_POST['cheque_19'];
$cheque_20=$_POST['cheque_20'];
$cheque_21=$_POST['cheque_21'];
$cheque_22=$_POST['cheque_22'];
$cheque_23=$_POST['cheque_23'];
$cheque_24=$_POST['cheque_24'];
$cheque_25=$_POST['cheque_25'];
$cheque_26=$_POST['cheque_26'];
$cheque_27=$_POST['cheque_27'];
$cheque_28=$_POST['cheque_28'];
$cheque_29=$_POST['cheque_29'];
$cheque_30=$_POST['cheque_30'];
$cheque_31=$_POST['cheque_31'];
$cheque_32=$_POST['cheque_32'];
$cheque_33=$_POST['cheque_33'];
$cheque_34=$_POST['cheque_34'];
$cheque_35=$_POST['cheque_35'];
$cheque_36=$_POST['cheque_36'];
$cheque_37=$_POST['cheque_37'];
$cheque_38=$_POST['cheque_38'];
$cheque_39=$_POST['cheque_39'];
$cheque_40=$_POST['cheque_40'];
$cheque_41=$_POST['cheque_41'];
$cheque_42=$_POST['cheque_42'];
$cheque_43=$_POST['cheque_43'];
$cheque_44=$_POST['cheque_44'];
$cheque_45=$_POST['cheque_45'];
$cheque_46=$_POST['cheque_46'];
$cheque_47=$_POST['cheque_47'];
$cheque_48=$_POST['cheque_48'];
$cheque_49=$_POST['cheque_49'];
$cheque_50=$_POST['cheque_50'];


$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15+$vr_deb_16+$vr_deb_17+$vr_deb_18+$vr_deb_19+$vr_deb_20+$vr_deb_21+$vr_deb_22+$vr_deb_23+$vr_deb_24+$vr_deb_25+$vr_deb_26+$vr_deb_27+$vr_deb_28+$vr_deb_29+$vr_deb_30+$vr_deb_31+$vr_deb_32+$vr_deb_33+$vr_deb_34+$vr_deb_35+$vr_deb_36+$vr_deb_37+$vr_deb_38+$vr_deb_39+$vr_deb_40+$vr_deb_41+$vr_deb_42+$vr_deb_43+$vr_deb_44+$vr_deb_45+$vr_deb_46+$vr_deb_47+$vr_deb_48+$vr_deb_49+$vr_deb_50+$vr_deb_51+$vr_deb_52+$vr_deb_53+$vr_deb_54+$vr_deb_55+$vr_deb_56+$vr_deb_57+$vr_deb_58+$vr_deb_59+$vr_deb_60+$vr_deb_61+$vr_deb_62+$vr_deb_63+$vr_deb_64+$vr_deb_65+$vr_deb_66+$vr_deb_67+$vr_deb_68+$vr_deb_69+$vr_deb_70+$vr_deb_71+$vr_deb_72+$vr_deb_73+$vr_deb_74+$vr_deb_75+$vr_deb_76+$vr_deb_77+$vr_deb_78+$vr_deb_79+$vr_deb_80+$vr_deb_81+$vr_deb_82+$vr_deb_83+$vr_deb_84+$vr_deb_85+$vr_deb_86+$vr_deb_87+$vr_deb_88+$vr_deb_89+$vr_deb_90+$vr_deb_91+$vr_deb_92+$vr_deb_93+$vr_deb_94+$vr_deb_95+$vr_deb_96+$vr_deb_97+$vr_deb_98+$vr_deb_99+$vr_deb_100+$vr_deb_101+$vr_deb_102+$vr_deb_103+$vr_deb_104+$vr_deb_105+$vr_deb_106+$vr_deb_107+$vr_deb_108+$vr_deb_109+$vr_deb_110+$vr_deb_111+$vr_deb_112+$vr_deb_113+$vr_deb_114+$vr_deb_115+$vr_deb_116+$vr_deb_117+$vr_deb_118+$vr_deb_119+$vr_deb_120+$vr_deb_121+$vr_deb_122+$vr_deb_123+$vr_deb_124+$vr_deb_125+$vr_deb_126+$vr_deb_127+$vr_deb_128+$vr_deb_129+$vr_deb_130+$vr_deb_131+$vr_deb_132+$vr_deb_133+$vr_deb_134+$vr_deb_135+$vr_deb_136+$vr_deb_137+$vr_deb_138+$vr_deb_139+$vr_deb_140+$vr_deb_141+$vr_deb_142+$vr_deb_143+$vr_deb_144+$vr_deb_145+$vr_deb_146+$vr_deb_147+$vr_deb_148+$vr_deb_149+$vr_deb_150+$vr_deb_151+$vr_deb_152+$vr_deb_153+$vr_deb_154+$vr_deb_155+$vr_deb_156+$vr_deb_157+$vr_deb_158+$vr_deb_159+$vr_deb_160;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15+$vr_cre_16+$vr_cre_17+$vr_cre_18+$vr_cre_19+$vr_cre_20+$vr_cre_21+$vr_cre_22+$vr_cre_23+$vr_cre_24+$vr_cre_25+$vr_cre_26+$vr_cre_27+$vr_cre_28+$vr_cre_29+$vr_cre_30+$vr_cre_31+$vr_cre_32+$vr_cre_33+$vr_cre_34+$vr_cre_35+$vr_cre_36+$vr_cre_37+$vr_cre_38+$vr_cre_39+$vr_cre_40+$vr_cre_41+$vr_cre_42+$vr_cre_43+$vr_cre_44+$vr_cre_45+$vr_cre_46+$vr_cre_47+$vr_cre_48+$vr_cre_49+$vr_cre_50+$vr_cre_51+$vr_cre_52+$vr_cre_53+$vr_cre_54+$vr_cre_55+$vr_cre_56+$vr_cre_57+$vr_cre_58+$vr_cre_59+$vr_cre_60+$vr_cre_61+$vr_cre_62+$vr_cre_63+$vr_cre_64+$vr_cre_65+$vr_cre_66+$vr_cre_67+$vr_cre_68+$vr_cre_69+$vr_cre_70+$vr_cre_71+$vr_cre_72+$vr_cre_73+$vr_cre_74+$vr_cre_75+$vr_cre_76+$vr_cre_77+$vr_cre_78+$vr_cre_79+$vr_cre_80+$vr_cre_81+$vr_cre_82+$vr_cre_83+$vr_cre_84+$vr_cre_85+$vr_cre_86+$vr_cre_87+$vr_cre_88+$vr_cre_89+$vr_cre_90+$vr_cre_91+$vr_cre_92+$vr_cre_93+$vr_cre_94+$vr_cre_95+$vr_cre_96+$vr_cre_97+$vr_cre_98+$vr_cre_99+$vr_cre_100+$vr_cre_101+$vr_cre_102+$vr_cre_103+$vr_cre_104+$vr_cre_105+$vr_cre_106+$vr_cre_107+$vr_cre_108+$vr_cre_109+$vr_cre_110+$vr_cre_111+$vr_cre_112+$vr_cre_113+$vr_cre_114+$vr_cre_115+$vr_cre_116+$vr_cre_117+$vr_cre_118+$vr_cre_119+$vr_cre_120+$vr_cre_121+$vr_cre_122+$vr_cre_123+$vr_cre_124+$vr_cre_125+$vr_cre_126+$vr_cre_127+$vr_cre_128+$vr_cre_129+$vr_cre_130+$vr_cre_131+$vr_cre_132+$vr_cre_133+$vr_cre_134+$vr_cre_135+$vr_cre_136+$vr_cre_137+$vr_cre_138+$vr_cre_139+$vr_cre_140+$vr_cre_141+$vr_cre_142+$vr_cre_143+$vr_cre_144+$vr_cre_145+$vr_cre_146+$vr_cre_147+$vr_cre_148+$vr_cre_149+$vr_cre_150+$vr_cre_151+$vr_cre_152+$vr_cre_153+$vr_cre_154+$vr_cre_155+$vr_cre_156+$vr_cre_157+$vr_cre_158+$vr_cre_159+$vr_cre_160;					
										
$tot_deb_a = number_format($tot_deb,2,',','.'); 
$tot_cre_a = number_format($tot_cre,2,',','.');

// vigencia fiscal
 
$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; $bx=$rowx["fecha_fin"];
} 


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

if($tercero == '')
{
printf("<br><br><center class='Estilo4'>No debe dejar casillas <b>EN BLANCO</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
}
else
{
if (($tipa =='M')or($tipb =='M')or($tipc =='M')or($tipd =='M')or($tipe =='M')or($tipf =='M')or($tipg =='M')or($tiph =='M')or($tipi =='M')or($tipj =='M')or($tipk =='M')or($tipl =='M')or($tipm =='M')or($tipn =='M')or($tipo =='M') or ($tip_dato =='M'))
{
printf("<br><br><center class='Estilo4'>No debe realizar movimientos a cuentas de tipo <b>MAYOR</b><BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>");
}
else
{

	if($fecha_recaudo > $bx or $fecha_recaudo < $ax)
	{
	printf("<br><br><center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<BR><BR>");
	
	}
	else
	{ 
	
		 if($tot_deb_a != $tot_cre_a)
	   	  {
					printf("<br><br><center class='Estilo4'>Los <b>TOTALES</b> Debito (...::: ".$tot_deb_a." :::...) y Credito (...::: ".$tot_cre_a." :::...) del movimiento 					<br><br>
					<b>NO COINCIDEN</b> <BR><BR>Debe volver a realizar la operacion <b>VERIFICANDO</b> previamente su informacion<br><br><br>"
					);
				
     			}
		 else
		  {
			  	// Para evitar doble registro
				$k=0;
				$sq2="select id,id_recau from recaudo_rica2 where id_recau ='$id_recau' ";
				$rs2=mysql_query($sq2);
				$fil=mysql_num_rows($rs2);
				while ($rw2=mysql_fetch_array($rs2))
				{
					$idv .=$rw2['id'].',';
					
				}
					$idv2 = split(",",$idv); 
					for ($i=1;$i<$filas;$i++)
					{	  // recibo variables 
						$cuenta = $_POST['cuenta_'.$i];
						$vr_digitado = str_replace('.','',$_POST['valor_'.$i]);
						// consulto nombre del rubro
						$sql = "select * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
						$resultado = mysql_query($sql, $connectionxx);
						while($row = mysql_fetch_array($resultado)) 
						{
						  $tip_dato=$row["tip_dato"];
						  $definitivo=$row["definitivo"];
						  $nom_rubro = $row["nom_rubro"];
						}

										// inserto nuevo roit
										$sql = "UPDATE  recaudo_rica2 set
												id_emp='$id_emp',
												id_reip='$id_reip',
												id_caic='$id_caic',
												id_recau='$id_recau',
												fecha_recaudo='$fecha_recaudo',
												des_recaudo='$des_recaudo',
												cuenta = '$cuenta',
												vr_digitado = '$vr_digitado',
												id_manu_rcgt = '$id_manu_rcgt',
												tercero= '$tercero',
												ter ='$ter',
												tip_ica='$tip_ica',
												cod_ica='$cod_ica'
												where id='$idv2[$k]'";
										mysql_query($sql, $connectionxx) or die(mysql_error());
										$k++;
					} // end for
					// se realiza el ultimo registro
						$cuenta = $_POST['cuenta_'.$i];
						$vr_digitado  = str_replace('.','',$_POST['valor_'.$i]);
						// consulto nombre del rubro
						$sql = "select * from car_ppto_ing where id_emp ='$id_emp' and cod_pptal ='$cuenta'";
						$resultado = mysql_query($sql, $connectionxx);
						while($row = mysql_fetch_array($resultado)) 
						{
						  $tip_dato=$row["tip_dato"];
						  $definitivo=$row["definitivo"];
						  $nom_rubro = $row["nom_rubro"];
						}

										// inserto nuevo roit
										$sq2 = "UPDATE  recaudo_rica2 set id_emp='$id_emp',id_reip='$id_reip',id_caic='$id_caic',id_recau='$id_recau',fecha_recaudo='$fecha_recaudo',des_recaudo='$des_recaudo',tercero='$tercero',pgcp1='$pgcp1',pgcp2='$pgcp2',pgcp3='$pgcp3',pgcp4='$pgcp4',pgcp5='$pgcp5',pgcp6='$pgcp6',pgcp7='$pgcp7',pgcp8='$pgcp8',pgcp9='$pgcp9',pgcp10='$pgcp10',pgcp11='$pgcp11',pgcp12='$pgcp12',pgcp13='$pgcp13',pgcp14='$pgcp14',pgcp15='$pgcp15',des1='$des1',des2='$des2',des3='$des3',des4='$des4',des5='$des5',des6='$des6',des7='$des7',des8='$des8',des9='$des9',des10='$des10',des11='$des11',des12='$des12',des13='$des13',des14='$des14',des15='$des15',vr_deb_1='$vr_deb_1',vr_deb_2='$vr_deb_2',vr_deb_3='$vr_deb_3',vr_deb_4='$vr_deb_4',vr_deb_5='$vr_deb_5',vr_deb_6='$vr_deb_6',vr_deb_7='$vr_deb_7',vr_deb_8='$vr_deb_8',vr_deb_9='$vr_deb_9',vr_deb_10='$vr_deb_10',vr_deb_11='$vr_deb_11',vr_deb_12='$vr_deb_12',vr_deb_13='$vr_deb_13',vr_deb_14='$vr_deb_14',vr_deb_15='$vr_deb_15',vr_cre_1='$vr_cre_1',vr_cre_2='$vr_cre_2',vr_cre_3='$vr_cre_3',vr_cre_4='$vr_cre_4',vr_cre_5='$vr_cre_5',vr_cre_6='$vr_cre_6',vr_cre_7='$vr_cre_7',vr_cre_8='$vr_cre_8',vr_cre_9='$vr_cre_9',vr_cre_10='$vr_cre_10',vr_cre_11='$vr_cre_11',vr_cre_12='$vr_cre_12',vr_cre_13='$vr_cre_13',vr_cre_14='$vr_cre_14',vr_cre_15='$vr_cre_15',tot_deb='$tot_deb',tot_cre='$tot_cre',id_unico_reip='$id_unico_reip',cuenta='$cuenta',nombre='$nombre',vr_orig_reip='$vr_orig_reip',vr_digitado='$vr_digitado',ter_nat='$ter_nat',ter_jur='$ter_jur',id_manu_rcgt='$id_manu_rcgt',pgcp16='$pgcp16',pgcp17='$pgcp17',pgcp18='$pgcp18',pgcp19='$pgcp19',pgcp20='$pgcp20',pgcp21='$pgcp21',pgcp22='$pgcp22',pgcp23='$pgcp23',pgcp24='$pgcp24',pgcp25='$pgcp25',pgcp26='$pgcp26',pgcp27='$pgcp27',pgcp28='$pgcp28',pgcp29='$pgcp29',pgcp30='$pgcp30',pgcp31='$pgcp31',pgcp32='$pgcp32',pgcp33='$pgcp33',pgcp34='$pgcp34',pgcp35='$pgcp35',pgcp36='$pgcp36',pgcp37='$pgcp37',pgcp38='$pgcp38',pgcp39='$pgcp39',pgcp40='$pgcp40',pgcp41='$pgcp41',pgcp42='$pgcp42',pgcp43='$pgcp43',pgcp44='$pgcp44',pgcp45='$pgcp45',pgcp46='$pgcp46',pgcp47='$pgcp47',pgcp48='$pgcp48',pgcp49='$pgcp49',pgcp50='$pgcp50',pgcp51='$pgcp51',pgcp52='$pgcp52',pgcp53='$pgcp53',pgcp54='$pgcp54',pgcp55='$pgcp55',pgcp56='$pgcp56',pgcp57='$pgcp57',pgcp58='$pgcp58',pgcp59='$pgcp59',pgcp60='$pgcp60',pgcp61='$pgcp61',pgcp62='$pgcp62',pgcp63='$pgcp63',pgcp64='$pgcp64',pgcp65='$pgcp65',pgcp66='$pgcp66',pgcp67='$pgcp67',pgcp68='$pgcp68',pgcp69='$pgcp69',pgcp70='$pgcp70',pgcp71='$pgcp71',pgcp72='$pgcp72',pgcp73='$pgcp73',pgcp74='$pgcp74',pgcp75='$pgcp75',pgcp76='$pgcp76',pgcp77='$pgcp77',pgcp78='$pgcp78',pgcp79='$pgcp79',pgcp80='$pgcp80',pgcp81='$pgcp81',pgcp82='$pgcp82',pgcp83='$pgcp83',pgcp84='$pgcp84',pgcp85='$pgcp85',pgcp86='$pgcp86',pgcp87='$pgcp87',pgcp88='$pgcp88',pgcp89='$pgcp89',pgcp90='$pgcp90',pgcp91='$pgcp91',pgcp92='$pgcp92',pgcp93='$pgcp93',pgcp94='$pgcp94',pgcp95='$pgcp95',pgcp96='$pgcp96',pgcp97='$pgcp97',pgcp98='$pgcp98',pgcp99='$pgcp99',pgcp100='$pgcp100',pgcp101='$pgcp101',pgcp102='$pgcp102',pgcp103='$pgcp103',pgcp104='$pgcp104',pgcp105='$pgcp105',pgcp106='$pgcp106',pgcp107='$pgcp107',pgcp108='$pgcp108',pgcp109='$pgcp109',pgcp110='$pgcp110',pgcp111='$pgcp111',pgcp112='$pgcp112',pgcp113='$pgcp113',pgcp114='$pgcp114',pgcp115='$pgcp115',pgcp116='$pgcp116',pgcp117='$pgcp117',pgcp118='$pgcp118',pgcp119='$pgcp119',pgcp120='$pgcp120',pgcp121='$pgcp121',pgcp122='$pgcp122',pgcp123='$pgcp123',pgcp124='$pgcp124',pgcp125='$pgcp125',pgcp126='$pgcp126',pgcp127='$pgcp127',pgcp128='$pgcp128',pgcp129='$pgcp129',pgcp130='$pgcp130',pgcp131='$pgcp131',pgcp132='$pgcp132',pgcp133='$pgcp133',pgcp134='$pgcp134',pgcp135='$pgcp135',pgcp136='$pgcp136',pgcp137='$pgcp137',pgcp138='$pgcp138',pgcp139='$pgcp139',pgcp140='$pgcp140',pgcp141='$pgcp141',pgcp142='$pgcp142',pgcp143='$pgcp143',pgcp144='$pgcp144',pgcp145='$pgcp145',pgcp146='$pgcp146',pgcp147='$pgcp147',pgcp148='$pgcp148',pgcp149='$pgcp149',pgcp150='$pgcp150',pgcp151='$pgcp151',pgcp152='$pgcp152',pgcp153='$pgcp153',pgcp154='$pgcp154',pgcp155='$pgcp155',pgcp156='$pgcp156',pgcp157='$pgcp157',pgcp158='$pgcp158',pgcp159='$pgcp159',pgcp160='$pgcp160',vr_deb_16='$vr_deb_16',vr_deb_17='$vr_deb_17',vr_deb_18='$vr_deb_18',vr_deb_19='$vr_deb_19',vr_deb_20='$vr_deb_20',vr_deb_21='$vr_deb_21',vr_deb_22='$vr_deb_22',vr_deb_23='$vr_deb_23',vr_deb_24='$vr_deb_24',vr_deb_25='$vr_deb_25',vr_deb_26='$vr_deb_26',vr_deb_27='$vr_deb_27',vr_deb_28='$vr_deb_28',vr_deb_29='$vr_deb_29',vr_deb_30='$vr_deb_30',vr_deb_31='$vr_deb_31',vr_deb_32='$vr_deb_32',vr_deb_33='$vr_deb_33',vr_deb_34='$vr_deb_34',vr_deb_35='$vr_deb_35',vr_deb_36='$vr_deb_36',vr_deb_37='$vr_deb_37',vr_deb_38='$vr_deb_38',vr_deb_39='$vr_deb_39',vr_deb_40='$vr_deb_40',vr_deb_41='$vr_deb_41',vr_deb_42='$vr_deb_42',vr_deb_43='$vr_deb_43',vr_deb_44='$vr_deb_44',vr_deb_45='$vr_deb_45',vr_deb_46='$vr_deb_46',vr_deb_47='$vr_deb_47',vr_deb_48='$vr_deb_48',vr_deb_49='$vr_deb_49',vr_deb_50='$vr_deb_50',vr_deb_51='$vr_deb_51',vr_deb_52='$vr_deb_52',vr_deb_53='$vr_deb_53',vr_deb_54='$vr_deb_54',vr_deb_55='$vr_deb_55',vr_deb_56='$vr_deb_56',vr_deb_57='$vr_deb_57',vr_deb_58='$vr_deb_58',vr_deb_59='$vr_deb_59',vr_deb_60='$vr_deb_60',vr_deb_61='$vr_deb_61',vr_deb_62='$vr_deb_62',vr_deb_63='$vr_deb_63',vr_deb_64='$vr_deb_64',vr_deb_65='$vr_deb_65',vr_deb_66='$vr_deb_66',vr_deb_67='$vr_deb_67',vr_deb_68='$vr_deb_68',vr_deb_69='$vr_deb_69',vr_deb_70='$vr_deb_70',vr_deb_71='$vr_deb_71',vr_deb_72='$vr_deb_72',vr_deb_73='$vr_deb_73',vr_deb_74='$vr_deb_74',vr_deb_75='$vr_deb_75',vr_deb_76='$vr_deb_76',vr_deb_77='$vr_deb_77',vr_deb_78='$vr_deb_78',vr_deb_79='$vr_deb_79',vr_deb_80='$vr_deb_80',vr_deb_81='$vr_deb_81',vr_deb_82='$vr_deb_82',vr_deb_83='$vr_deb_83',vr_deb_84='$vr_deb_84',vr_deb_85='$vr_deb_85',vr_deb_86='$vr_deb_86',vr_deb_87='$vr_deb_87',vr_deb_88='$vr_deb_88',vr_deb_89='$vr_deb_89',vr_deb_90='$vr_deb_90',vr_deb_91='$vr_deb_91',vr_deb_92='$vr_deb_92',vr_deb_93='$vr_deb_93',vr_deb_94='$vr_deb_94',vr_deb_95='$vr_deb_95',vr_deb_96='$vr_deb_96',vr_deb_97='$vr_deb_97',vr_deb_98='$vr_deb_98',vr_deb_99='$vr_deb_99',vr_deb_100='$vr_deb_100',vr_deb_101='$vr_deb_101',vr_deb_102='$vr_deb_102',vr_deb_103='$vr_deb_103',vr_deb_104='$vr_deb_104',vr_deb_105='$vr_deb_105',vr_deb_106='$vr_deb_106',vr_deb_107='$vr_deb_107',vr_deb_108='$vr_deb_108',vr_deb_109='$vr_deb_109',vr_deb_110='$vr_deb_110',vr_deb_111='$vr_deb_111',vr_deb_112='$vr_deb_112',vr_deb_113='$vr_deb_113',vr_deb_114='$vr_deb_114',vr_deb_115='$vr_deb_115',vr_deb_116='$vr_deb_116',vr_deb_117='$vr_deb_117',vr_deb_118='$vr_deb_118',vr_deb_119='$vr_deb_119',vr_deb_120='$vr_deb_120',vr_deb_121='$vr_deb_121',vr_deb_122='$vr_deb_122',vr_deb_123='$vr_deb_123',vr_deb_124='$vr_deb_124',vr_deb_125='$vr_deb_125',vr_deb_126='$vr_deb_126',vr_deb_127='$vr_deb_127',vr_deb_128='$vr_deb_128',vr_deb_129='$vr_deb_129',vr_deb_130='$vr_deb_130',vr_deb_131='$vr_deb_131',vr_deb_132='$vr_deb_132',vr_deb_133='$vr_deb_133',vr_deb_134='$vr_deb_134',vr_deb_135='$vr_deb_135',vr_deb_136='$vr_deb_136',vr_deb_137='$vr_deb_137',vr_deb_138='$vr_deb_138',vr_deb_139='$vr_deb_139',vr_deb_140='$vr_deb_140',vr_deb_141='$vr_deb_141',vr_deb_142='$vr_deb_142',vr_deb_143='$vr_deb_143',vr_deb_144='$vr_deb_144',vr_deb_145='$vr_deb_145',vr_deb_146='$vr_deb_146',vr_deb_147='$vr_deb_147',vr_deb_148='$vr_deb_148',vr_deb_149='$vr_deb_149',vr_deb_150='$vr_deb_150',vr_deb_151='$vr_deb_151',vr_deb_152='$vr_deb_152',vr_deb_153='$vr_deb_153',vr_deb_154='$vr_deb_154',vr_deb_155='$vr_deb_155',vr_deb_156='$vr_deb_156',vr_deb_157='$vr_deb_157',vr_deb_158='$vr_deb_158',vr_deb_159='$vr_deb_159',vr_deb_160='$vr_deb_160',vr_cre_16='$vr_cre_16',vr_cre_17='$vr_cre_17',vr_cre_18='$vr_cre_18',vr_cre_19='$vr_cre_19',vr_cre_20='$vr_cre_20',vr_cre_21='$vr_cre_21',vr_cre_22='$vr_cre_22',vr_cre_23='$vr_cre_23',vr_cre_24='$vr_cre_24',vr_cre_25='$vr_cre_25',vr_cre_26='$vr_cre_26',vr_cre_27='$vr_cre_27',vr_cre_28='$vr_cre_28',vr_cre_29='$vr_cre_29',vr_cre_30='$vr_cre_30',vr_cre_31='$vr_cre_31',vr_cre_32='$vr_cre_32',vr_cre_33='$vr_cre_33',vr_cre_34='$vr_cre_34',vr_cre_35='$vr_cre_35',vr_cre_36='$vr_cre_36',vr_cre_37='$vr_cre_37',vr_cre_38='$vr_cre_38',vr_cre_39='$vr_cre_39',vr_cre_40='$vr_cre_40',vr_cre_41='$vr_cre_41',vr_cre_42='$vr_cre_42',vr_cre_43='$vr_cre_43',vr_cre_44='$vr_cre_44',vr_cre_45='$vr_cre_45',vr_cre_46='$vr_cre_46',vr_cre_47='$vr_cre_47',vr_cre_48='$vr_cre_48',vr_cre_49='$vr_cre_49',vr_cre_50='$vr_cre_50',vr_cre_51='$vr_cre_51',vr_cre_52='$vr_cre_52',vr_cre_53='$vr_cre_53',vr_cre_54='$vr_cre_54',vr_cre_55='$vr_cre_55',vr_cre_56='$vr_cre_56',vr_cre_57='$vr_cre_57',vr_cre_58='$vr_cre_58',vr_cre_59='$vr_cre_59',vr_cre_60='$vr_cre_60',vr_cre_61='$vr_cre_61',vr_cre_62='$vr_cre_62',vr_cre_63='$vr_cre_63',vr_cre_64='$vr_cre_64',vr_cre_65='$vr_cre_65',vr_cre_66='$vr_cre_66',vr_cre_67='$vr_cre_67',vr_cre_68='$vr_cre_68',vr_cre_69='$vr_cre_69',vr_cre_70='$vr_cre_70',vr_cre_71='$vr_cre_71',vr_cre_72='$vr_cre_72',vr_cre_73='$vr_cre_73',vr_cre_74='$vr_cre_74',vr_cre_75='$vr_cre_75',vr_cre_76='$vr_cre_76',vr_cre_77='$vr_cre_77',vr_cre_78='$vr_cre_78',vr_cre_79='$vr_cre_79',vr_cre_80='$vr_cre_80',vr_cre_81='$vr_cre_81',vr_cre_82='$vr_cre_82',vr_cre_83='$vr_cre_83',vr_cre_84='$vr_cre_84',vr_cre_85='$vr_cre_85',vr_cre_86='$vr_cre_86',vr_cre_87='$vr_cre_87',vr_cre_88='$vr_cre_88',vr_cre_89='$vr_cre_89',vr_cre_90='$vr_cre_90',vr_cre_91='$vr_cre_91',vr_cre_92='$vr_cre_92',vr_cre_93='$vr_cre_93',vr_cre_94='$vr_cre_94',vr_cre_95='$vr_cre_95',vr_cre_96='$vr_cre_96',vr_cre_97='$vr_cre_97',vr_cre_98='$vr_cre_98',vr_cre_99='$vr_cre_99',vr_cre_100='$vr_cre_100',vr_cre_101='$vr_cre_101',vr_cre_102='$vr_cre_102',vr_cre_103='$vr_cre_103',vr_cre_104='$vr_cre_104',vr_cre_105='$vr_cre_105',vr_cre_106='$vr_cre_106',vr_cre_107='$vr_cre_107',vr_cre_108='$vr_cre_108',vr_cre_109='$vr_cre_109',vr_cre_110='$vr_cre_110',vr_cre_111='$vr_cre_111',vr_cre_112='$vr_cre_112',vr_cre_113='$vr_cre_113',vr_cre_114='$vr_cre_114',vr_cre_115='$vr_cre_115',vr_cre_116='$vr_cre_116',vr_cre_117='$vr_cre_117',vr_cre_118='$vr_cre_118',vr_cre_119='$vr_cre_119',vr_cre_120='$vr_cre_120',vr_cre_121='$vr_cre_121',vr_cre_122='$vr_cre_122',vr_cre_123='$vr_cre_123',vr_cre_124='$vr_cre_124',vr_cre_125='$vr_cre_125',vr_cre_126='$vr_cre_126',vr_cre_127='$vr_cre_127',vr_cre_128='$vr_cre_128',vr_cre_129='$vr_cre_129',vr_cre_130='$vr_cre_130',vr_cre_131='$vr_cre_131',vr_cre_132='$vr_cre_132',vr_cre_133='$vr_cre_133',vr_cre_134='$vr_cre_134',vr_cre_135='$vr_cre_135',vr_cre_136='$vr_cre_136',vr_cre_137='$vr_cre_137',vr_cre_138='$vr_cre_138',vr_cre_139='$vr_cre_139',vr_cre_140='$vr_cre_140',vr_cre_141='$vr_cre_141',vr_cre_142='$vr_cre_142',vr_cre_143='$vr_cre_143',vr_cre_144='$vr_cre_144',vr_cre_145='$vr_cre_145',vr_cre_146='$vr_cre_146',vr_cre_147='$vr_cre_147',vr_cre_148='$vr_cre_148',vr_cre_149='$vr_cre_149',vr_cre_150='$vr_cre_150',vr_cre_151='$vr_cre_151',vr_cre_152='$vr_cre_152',vr_cre_153='$vr_cre_153',vr_cre_154='$vr_cre_154',vr_cre_155='$vr_cre_155',vr_cre_156='$vr_cre_156',vr_cre_157='$vr_cre_157',vr_cre_158='$vr_cre_158',vr_cre_159='$vr_cre_159',vr_cre_160='$vr_cre_160',press_1='$press_1',press_2='$press_2',press_3='$press_3',press_4='$press_4',press_5='$press_5',press_6='$press_6',press_7='$press_7',press_8='$press_8',press_9='$press_9',press_10='$press_10',press_11='$press_11',press_12='$press_12',press_13='$press_13',ter='$ter',tip_ica='$tip_ica',cod_ica='$cod_ica',cheque_1='$cheque_1',cheque_2='$cheque_2',cheque_3='$cheque_3',cheque_4='$cheque_4',cheque_5='$cheque_5',cheque_6='$cheque_6',cheque_7='$cheque_7',cheque_8='$cheque_8',cheque_9='$cheque_9',cheque_10='$cheque_10',cheque_11='$cheque_11',cheque_12='$cheque_12',cheque_13='$cheque_13',cheque_14='$cheque_14',cheque_15='$cheque_15',cheque_16='$cheque_16',cheque_17='$cheque_17',cheque_18='$cheque_18',cheque_19='$cheque_19',cheque_20='$cheque_20',cheque_21='$cheque_21',cheque_22='$cheque_22',cheque_23='$cheque_23',cheque_24='$cheque_24',cheque_25='$cheque_25',cheque_26='$cheque_26',cheque_27='$cheque_27',cheque_28='$cheque_28',cheque_29='$cheque_29',cheque_30='$cheque_30',cheque_31='$cheque_31',cheque_32='$cheque_32',cheque_33='$cheque_33',cheque_34='$cheque_34',cheque_35='$cheque_35',cheque_36='$cheque_36',cheque_37='$cheque_37',cheque_38='$cheque_38',cheque_39='$cheque_39',cheque_40='$cheque_40',cheque_41='$cheque_41',cheque_42='$cheque_42',cheque_43='$cheque_43',cheque_44='$cheque_44',cheque_45='$cheque_45',cheque_46='$cheque_46',cheque_47='$cheque_47',cheque_48='$cheque_48',cheque_49='$cheque_49',cheque_50='$cheque_50' where id='$idv2[$k]'";
										mysql_query($sq2, $connectionxx) or die(mysql_error());
				}// fin de ultimo registro			
										printf("<br><br><center class ='Estilo4'>REGISTRO INSERTADO CON EXITO</center><br /><br />");
																	
										
										
										//}
										
					 
							
				

    }
		
}
}
//}

printf("

<center class='Estilo9'>
<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
<input type='hidden' name='nn' value='RICA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo19' /> :::...
</form>
</center>
");

?>
<?
}
?>
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