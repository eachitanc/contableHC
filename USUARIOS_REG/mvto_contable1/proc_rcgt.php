<?
session_start();
if(!isset($_SESSION["login"]))
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
$id_manu_rcgt = 'RIIP'.$_POST['id_manu_rcgt']; 
$id_recau = 'RIIP'.$_POST['consec_ncbt']; 
$fecha_recaudo = $_POST['fecha_recaudo'];
$des_recaudo = strtoupper($_POST['des_recaudo']);
$filas = $_POST['filas']; 

//union de terceros
$terd=split("-",$_POST['tercero']);
$tercero = $terd[1];
$ter = $terd[0];//


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
$pgcp161= $_POST['pgcp161'];
$pgcp162= $_POST['pgcp162'];
$pgcp163= $_POST['pgcp163'];
$pgcp164= $_POST['pgcp164'];
$pgcp165= $_POST['pgcp165'];
$pgcp166= $_POST['pgcp166'];
$pgcp167= $_POST['pgcp167'];
$pgcp168= $_POST['pgcp168'];
$pgcp169= $_POST['pgcp169'];
$pgcp170= $_POST['pgcp170'];
$pgcp171= $_POST['pgcp171'];
$pgcp172= $_POST['pgcp172'];
$pgcp173= $_POST['pgcp173'];
$pgcp174= $_POST['pgcp174'];
$pgcp175= $_POST['pgcp175'];
$pgcp176= $_POST['pgcp176'];
$pgcp177= $_POST['pgcp177'];
$pgcp178= $_POST['pgcp178'];
$pgcp179= $_POST['pgcp179'];
$pgcp180= $_POST['pgcp180'];
$pgcp181= $_POST['pgcp181'];
$pgcp182= $_POST['pgcp182'];
$pgcp183= $_POST['pgcp183'];
$pgcp184= $_POST['pgcp184'];
$pgcp185= $_POST['pgcp185'];
$pgcp186= $_POST['pgcp186'];
$pgcp187= $_POST['pgcp187'];
$pgcp188= $_POST['pgcp188'];
$pgcp189= $_POST['pgcp189'];
$pgcp190= $_POST['pgcp190'];
$pgcp191= $_POST['pgcp191'];
$pgcp192= $_POST['pgcp192'];
$pgcp193= $_POST['pgcp193'];
$pgcp194= $_POST['pgcp194'];
$pgcp195= $_POST['pgcp195'];
$pgcp196= $_POST['pgcp196'];
$pgcp197= $_POST['pgcp197'];
$pgcp198= $_POST['pgcp198'];
$pgcp199= $_POST['pgcp199'];
$pgcp200= $_POST['pgcp200'];
$pgcp201= $_POST['pgcp201'];
$pgcp202= $_POST['pgcp202'];
$pgcp203= $_POST['pgcp203'];
$pgcp204= $_POST['pgcp204'];
$pgcp205= $_POST['pgcp205'];
$pgcp206= $_POST['pgcp206'];
$pgcp207= $_POST['pgcp207'];
$pgcp208= $_POST['pgcp208'];
$pgcp209= $_POST['pgcp209'];
$pgcp210= $_POST['pgcp210'];
$pgcp211= $_POST['pgcp211'];
$pgcp212= $_POST['pgcp212'];
$pgcp213= $_POST['pgcp213'];
$pgcp214= $_POST['pgcp214'];
$pgcp215= $_POST['pgcp215'];
$pgcp216= $_POST['pgcp216'];
$pgcp217= $_POST['pgcp217'];
$pgcp218= $_POST['pgcp218'];
$pgcp219= $_POST['pgcp219'];
$pgcp220= $_POST['pgcp220'];
$pgcp221= $_POST['pgcp221'];
$pgcp222= $_POST['pgcp222'];
$pgcp223= $_POST['pgcp223'];
$pgcp224= $_POST['pgcp224'];
$pgcp225= $_POST['pgcp225'];
$pgcp226= $_POST['pgcp226'];
$pgcp227= $_POST['pgcp227'];
$pgcp228= $_POST['pgcp228'];
$pgcp229= $_POST['pgcp229'];
$pgcp230= $_POST['pgcp230'];
$pgcp231= $_POST['pgcp231'];
$pgcp232= $_POST['pgcp232'];
$pgcp233= $_POST['pgcp233'];
$pgcp234= $_POST['pgcp234'];
$pgcp235= $_POST['pgcp235'];
$pgcp236= $_POST['pgcp236'];
$pgcp237= $_POST['pgcp237'];
$pgcp238= $_POST['pgcp238'];
$pgcp239= $_POST['pgcp239'];
$pgcp240= $_POST['pgcp240'];
$pgcp241= $_POST['pgcp241'];
$pgcp242= $_POST['pgcp242'];
$pgcp243= $_POST['pgcp243'];
$pgcp244= $_POST['pgcp244'];
$pgcp245= $_POST['pgcp245'];
$pgcp246= $_POST['pgcp246'];
$pgcp247= $_POST['pgcp247'];
$pgcp248= $_POST['pgcp248'];
$pgcp249= $_POST['pgcp249'];
$pgcp250= $_POST['pgcp250'];
$pgcp251= $_POST['pgcp251'];
$pgcp252= $_POST['pgcp252'];
$pgcp253= $_POST['pgcp253'];
$pgcp254= $_POST['pgcp254'];
$pgcp255= $_POST['pgcp255'];
$pgcp256= $_POST['pgcp256'];
$pgcp257= $_POST['pgcp257'];
$pgcp258= $_POST['pgcp258'];
$pgcp259= $_POST['pgcp259'];
$pgcp260= $_POST['pgcp260'];
$pgcp261= $_POST['pgcp261'];
$pgcp262= $_POST['pgcp262'];
$pgcp263= $_POST['pgcp263'];
$pgcp264= $_POST['pgcp264'];
$pgcp265= $_POST['pgcp265'];
$pgcp266= $_POST['pgcp266'];
$pgcp267= $_POST['pgcp267'];
$pgcp268= $_POST['pgcp268'];
$pgcp269= $_POST['pgcp269'];
$pgcp270= $_POST['pgcp270'];
$pgcp271= $_POST['pgcp271'];
$pgcp272= $_POST['pgcp272'];
$pgcp273= $_POST['pgcp273'];
$pgcp274= $_POST['pgcp274'];
$pgcp275= $_POST['pgcp275'];
$pgcp276= $_POST['pgcp276'];
$pgcp277= $_POST['pgcp277'];
$pgcp278= $_POST['pgcp278'];
$pgcp279= $_POST['pgcp279'];
$pgcp280= $_POST['pgcp280'];
$pgcp281= $_POST['pgcp281'];
$pgcp282= $_POST['pgcp282'];
$pgcp283= $_POST['pgcp283'];
$pgcp284= $_POST['pgcp284'];
$pgcp285= $_POST['pgcp285'];
$pgcp286= $_POST['pgcp286'];
$pgcp287= $_POST['pgcp287'];
$pgcp288= $_POST['pgcp288'];
$pgcp289= $_POST['pgcp289'];
$pgcp290= $_POST['pgcp290'];
$pgcp291= $_POST['pgcp291'];
$pgcp292= $_POST['pgcp292'];
$pgcp293= $_POST['pgcp293'];
$pgcp294= $_POST['pgcp294'];
$pgcp295= $_POST['pgcp295'];
$pgcp296= $_POST['pgcp296'];
$pgcp297= $_POST['pgcp297'];
$pgcp298= $_POST['pgcp298'];
$pgcp299= $_POST['pgcp299'];
$pgcp300= $_POST['pgcp300'];


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
$vr_deb_161 = str_replace('.','',$_POST['vr_deb_161']);
$vr_deb_162 = str_replace('.','',$_POST['vr_deb_162']);
$vr_deb_163=str_replace('.','',$_POST['vr_deb_163']);
$vr_deb_164=str_replace('.','',$_POST['vr_deb_164']);
$vr_deb_165=str_replace('.','',$_POST['vr_deb_165']);
$vr_deb_166=str_replace('.','',$_POST['vr_deb_166']);
$vr_deb_167=str_replace('.','',$_POST['vr_deb_167']);
$vr_deb_168=str_replace('.','',$_POST['vr_deb_168']);
$vr_deb_169=str_replace('.','',$_POST['vr_deb_169']);
$vr_deb_170=str_replace('.','',$_POST['vr_deb_170']);
$vr_deb_171=str_replace('.','',$_POST['vr_deb_171']);
$vr_deb_172=str_replace('.','',$_POST['vr_deb_172']);
$vr_deb_173=str_replace('.','',$_POST['vr_deb_173']);
$vr_deb_174=str_replace('.','',$_POST['vr_deb_174']);
$vr_deb_175=str_replace('.','',$_POST['vr_deb_175']);
$vr_deb_176=str_replace('.','',$_POST['vr_deb_176']);
$vr_deb_177=str_replace('.','',$_POST['vr_deb_177']);
$vr_deb_178=str_replace('.','',$_POST['vr_deb_178']);
$vr_deb_179=str_replace('.','',$_POST['vr_deb_179']);
$vr_deb_180=str_replace('.','',$_POST['vr_deb_180']);
$vr_deb_181=str_replace('.','',$_POST['vr_deb_181']);
$vr_deb_182=str_replace('.','',$_POST['vr_deb_182']);
$vr_deb_183=str_replace('.','',$_POST['vr_deb_183']);
$vr_deb_184=str_replace('.','',$_POST['vr_deb_184']);
$vr_deb_185=str_replace('.','',$_POST['vr_deb_185']);
$vr_deb_186=str_replace('.','',$_POST['vr_deb_186']);
$vr_deb_187=str_replace('.','',$_POST['vr_deb_187']);
$vr_deb_188=str_replace('.','',$_POST['vr_deb_188']);
$vr_deb_189=str_replace('.','',$_POST['vr_deb_189']);
$vr_deb_190=str_replace('.','',$_POST['vr_deb_190']);
$vr_deb_191=str_replace('.','',$_POST['vr_deb_191']);
$vr_deb_192=str_replace('.','',$_POST['vr_deb_192']);
$vr_deb_193=str_replace('.','',$_POST['vr_deb_193']);
$vr_deb_194=str_replace('.','',$_POST['vr_deb_194']);
$vr_deb_195=str_replace('.','',$_POST['vr_deb_195']);
$vr_deb_196=str_replace('.','',$_POST['vr_deb_196']);
$vr_deb_197=str_replace('.','',$_POST['vr_deb_197']);
$vr_deb_198=str_replace('.','',$_POST['vr_deb_198']);
$vr_deb_199=str_replace('.','',$_POST['vr_deb_199']);
$vr_deb_200=str_replace('.','',$_POST['vr_deb_200']);
$vr_deb_201=str_replace('.','',$_POST['vr_deb_201']);
$vr_deb_202=str_replace('.','',$_POST['vr_deb_202']);
$vr_deb_203=str_replace('.','',$_POST['vr_deb_203']);
$vr_deb_204=str_replace('.','',$_POST['vr_deb_204']);
$vr_deb_205=str_replace('.','',$_POST['vr_deb_205']);
$vr_deb_206=str_replace('.','',$_POST['vr_deb_206']);
$vr_deb_207=str_replace('.','',$_POST['vr_deb_207']);
$vr_deb_208=str_replace('.','',$_POST['vr_deb_208']);
$vr_deb_209=str_replace('.','',$_POST['vr_deb_209']);
$vr_deb_210=str_replace('.','',$_POST['vr_deb_210']);
$vr_deb_211=str_replace('.','',$_POST['vr_deb_211']);
$vr_deb_212=str_replace('.','',$_POST['vr_deb_212']);
$vr_deb_213=str_replace('.','',$_POST['vr_deb_213']);
$vr_deb_214=str_replace('.','',$_POST['vr_deb_214']);
$vr_deb_215=str_replace('.','',$_POST['vr_deb_215']);
$vr_deb_216=str_replace('.','',$_POST['vr_deb_216']);
$vr_deb_217=str_replace('.','',$_POST['vr_deb_217']);
$vr_deb_218=str_replace('.','',$_POST['vr_deb_218']);
$vr_deb_219=str_replace('.','',$_POST['vr_deb_219']);
$vr_deb_220=str_replace('.','',$_POST['vr_deb_220']);
$vr_deb_221=str_replace('.','',$_POST['vr_deb_221']);
$vr_deb_222=str_replace('.','',$_POST['vr_deb_222']);
$vr_deb_223=str_replace('.','',$_POST['vr_deb_223']);
$vr_deb_224=str_replace('.','',$_POST['vr_deb_224']);
$vr_deb_225=str_replace('.','',$_POST['vr_deb_225']);
$vr_deb_226=str_replace('.','',$_POST['vr_deb_226']);
$vr_deb_227=str_replace('.','',$_POST['vr_deb_227']);
$vr_deb_228=str_replace('.','',$_POST['vr_deb_228']);
$vr_deb_229=str_replace('.','',$_POST['vr_deb_229']);
$vr_deb_230=str_replace('.','',$_POST['vr_deb_230']);
$vr_deb_231=str_replace('.','',$_POST['vr_deb_231']);
$vr_deb_232=str_replace('.','',$_POST['vr_deb_232']);
$vr_deb_233=str_replace('.','',$_POST['vr_deb_233']);
$vr_deb_234=str_replace('.','',$_POST['vr_deb_234']);
$vr_deb_235=str_replace('.','',$_POST['vr_deb_235']);
$vr_deb_236=str_replace('.','',$_POST['vr_deb_236']);
$vr_deb_237=str_replace('.','',$_POST['vr_deb_237']);
$vr_deb_238=str_replace('.','',$_POST['vr_deb_238']);
$vr_deb_239=str_replace('.','',$_POST['vr_deb_239']);
$vr_deb_240=str_replace('.','',$_POST['vr_deb_240']);
$vr_deb_241=str_replace('.','',$_POST['vr_deb_241']);
$vr_deb_242=str_replace('.','',$_POST['vr_deb_242']);
$vr_deb_243=str_replace('.','',$_POST['vr_deb_243']);
$vr_deb_244=str_replace('.','',$_POST['vr_deb_244']);
$vr_deb_245=str_replace('.','',$_POST['vr_deb_245']);
$vr_deb_246=str_replace('.','',$_POST['vr_deb_246']);
$vr_deb_247=str_replace('.','',$_POST['vr_deb_247']);
$vr_deb_248=str_replace('.','',$_POST['vr_deb_248']);
$vr_deb_249=str_replace('.','',$_POST['vr_deb_249']);
$vr_deb_250=str_replace('.','',$_POST['vr_deb_250']);
$vr_deb_251=str_replace('.','',$_POST['vr_deb_251']);
$vr_deb_252=str_replace('.','',$_POST['vr_deb_252']);
$vr_deb_253=str_replace('.','',$_POST['vr_deb_253']);
$vr_deb_254=str_replace('.','',$_POST['vr_deb_254']);
$vr_deb_255=str_replace('.','',$_POST['vr_deb_255']);
$vr_deb_256=str_replace('.','',$_POST['vr_deb_256']);
$vr_deb_257=str_replace('.','',$_POST['vr_deb_257']);
$vr_deb_258=str_replace('.','',$_POST['vr_deb_258']);
$vr_deb_259=str_replace('.','',$_POST['vr_deb_259']);
$vr_deb_260=str_replace('.','',$_POST['vr_deb_260']);
$vr_deb_261=str_replace('.','',$_POST['vr_deb_261']);
$vr_deb_262=str_replace('.','',$_POST['vr_deb_262']);
$vr_deb_263=str_replace('.','',$_POST['vr_deb_263']);
$vr_deb_264=str_replace('.','',$_POST['vr_deb_264']);
$vr_deb_265=str_replace('.','',$_POST['vr_deb_265']);
$vr_deb_266=str_replace('.','',$_POST['vr_deb_266']);
$vr_deb_267=str_replace('.','',$_POST['vr_deb_267']);
$vr_deb_268=str_replace('.','',$_POST['vr_deb_268']);
$vr_deb_269=str_replace('.','',$_POST['vr_deb_269']);
$vr_deb_270=str_replace('.','',$_POST['vr_deb_270']);
$vr_deb_271=str_replace('.','',$_POST['vr_deb_271']);
$vr_deb_272=str_replace('.','',$_POST['vr_deb_272']);
$vr_deb_273=str_replace('.','',$_POST['vr_deb_273']);
$vr_deb_274=str_replace('.','',$_POST['vr_deb_274']);
$vr_deb_275=str_replace('.','',$_POST['vr_deb_275']);
$vr_deb_276=str_replace('.','',$_POST['vr_deb_276']);
$vr_deb_277=str_replace('.','',$_POST['vr_deb_277']);
$vr_deb_278=str_replace('.','',$_POST['vr_deb_278']);
$vr_deb_279=str_replace('.','',$_POST['vr_deb_279']);
$vr_deb_280=str_replace('.','',$_POST['vr_deb_280']);
$vr_deb_281=str_replace('.','',$_POST['vr_deb_281']);
$vr_deb_282=str_replace('.','',$_POST['vr_deb_282']);
$vr_deb_283=str_replace('.','',$_POST['vr_deb_283']);
$vr_deb_284=str_replace('.','',$_POST['vr_deb_284']);
$vr_deb_285=str_replace('.','',$_POST['vr_deb_285']);
$vr_deb_286=str_replace('.','',$_POST['vr_deb_286']);
$vr_deb_287=str_replace('.','',$_POST['vr_deb_287']);
$vr_deb_288=str_replace('.','',$_POST['vr_deb_288']);
$vr_deb_289=str_replace('.','',$_POST['vr_deb_289']);
$vr_deb_290=str_replace('.','',$_POST['vr_deb_290']);
$vr_deb_291=str_replace('.','',$_POST['vr_deb_291']);
$vr_deb_292=str_replace('.','',$_POST['vr_deb_292']);
$vr_deb_293=str_replace('.','',$_POST['vr_deb_293']);
$vr_deb_294=str_replace('.','',$_POST['vr_deb_294']);
$vr_deb_295=str_replace('.','',$_POST['vr_deb_295']);
$vr_deb_296=str_replace('.','',$_POST['vr_deb_296']);
$vr_deb_297=str_replace('.','',$_POST['vr_deb_297']);
$vr_deb_298=str_replace('.','',$_POST['vr_deb_298']);
$vr_deb_299=str_replace('.','',$_POST['vr_deb_299']);
$vr_deb_300=str_replace('.','',$_POST['vr_deb_300']);


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
$vr_cre_161 = str_replace('.','',$_POST['vr_cre_161']);
$vr_deb_162=str_replace('.','',$_POST['vr_deb_162']);
$vr_deb_163=str_replace('.','',$_POST['vr_deb_163']);
$vr_deb_164=str_replace('.','',$_POST['vr_deb_164']);
$vr_deb_165=str_replace('.','',$_POST['vr_deb_165']);
$vr_deb_166=str_replace('.','',$_POST['vr_deb_166']);
$vr_deb_167=str_replace('.','',$_POST['vr_deb_167']);
$vr_deb_168=str_replace('.','',$_POST['vr_deb_168']);
$vr_deb_169=str_replace('.','',$_POST['vr_deb_169']);
$vr_deb_170=str_replace('.','',$_POST['vr_deb_170']);
$vr_deb_171=str_replace('.','',$_POST['vr_deb_171']);
$vr_deb_172=str_replace('.','',$_POST['vr_deb_172']);
$vr_deb_173=str_replace('.','',$_POST['vr_deb_173']);
$vr_deb_174=str_replace('.','',$_POST['vr_deb_174']);
$vr_deb_175=str_replace('.','',$_POST['vr_deb_175']);
$vr_deb_176=str_replace('.','',$_POST['vr_deb_176']);
$vr_deb_177=str_replace('.','',$_POST['vr_deb_177']);
$vr_deb_178=str_replace('.','',$_POST['vr_deb_178']);
$vr_deb_179=str_replace('.','',$_POST['vr_deb_179']);
$vr_deb_180=str_replace('.','',$_POST['vr_deb_180']);
$vr_deb_181=str_replace('.','',$_POST['vr_deb_181']);
$vr_deb_182=str_replace('.','',$_POST['vr_deb_182']);
$vr_deb_183=str_replace('.','',$_POST['vr_deb_183']);
$vr_deb_184=str_replace('.','',$_POST['vr_deb_184']);
$vr_deb_185=str_replace('.','',$_POST['vr_deb_185']);
$vr_deb_186=str_replace('.','',$_POST['vr_deb_186']);
$vr_deb_187=str_replace('.','',$_POST['vr_deb_187']);
$vr_deb_188=str_replace('.','',$_POST['vr_deb_188']);
$vr_deb_189=str_replace('.','',$_POST['vr_deb_189']);
$vr_deb_190=str_replace('.','',$_POST['vr_deb_190']);
$vr_deb_191=str_replace('.','',$_POST['vr_deb_191']);
$vr_deb_192=str_replace('.','',$_POST['vr_deb_192']);
$vr_deb_193=str_replace('.','',$_POST['vr_deb_193']);
$vr_deb_194=str_replace('.','',$_POST['vr_deb_194']);
$vr_deb_195=str_replace('.','',$_POST['vr_deb_195']);
$vr_deb_196=str_replace('.','',$_POST['vr_deb_196']);
$vr_deb_197=str_replace('.','',$_POST['vr_deb_197']);
$vr_deb_198=str_replace('.','',$_POST['vr_deb_198']);
$vr_deb_199=str_replace('.','',$_POST['vr_deb_199']);
$vr_deb_200=str_replace('.','',$_POST['vr_deb_200']);
$vr_deb_201=str_replace('.','',$_POST['vr_deb_201']);
$vr_deb_202=str_replace('.','',$_POST['vr_deb_202']);
$vr_deb_203=str_replace('.','',$_POST['vr_deb_203']);
$vr_deb_204=str_replace('.','',$_POST['vr_deb_204']);
$vr_deb_205=str_replace('.','',$_POST['vr_deb_205']);
$vr_deb_206=str_replace('.','',$_POST['vr_deb_206']);
$vr_deb_207=str_replace('.','',$_POST['vr_deb_207']);
$vr_deb_208=str_replace('.','',$_POST['vr_deb_208']);
$vr_deb_209=str_replace('.','',$_POST['vr_deb_209']);
$vr_deb_210=str_replace('.','',$_POST['vr_deb_210']);
$vr_deb_211=str_replace('.','',$_POST['vr_deb_211']);
$vr_deb_212=str_replace('.','',$_POST['vr_deb_212']);
$vr_deb_213=str_replace('.','',$_POST['vr_deb_213']);
$vr_deb_214=str_replace('.','',$_POST['vr_deb_214']);
$vr_deb_215=str_replace('.','',$_POST['vr_deb_215']);
$vr_deb_216=str_replace('.','',$_POST['vr_deb_216']);
$vr_deb_217=str_replace('.','',$_POST['vr_deb_217']);
$vr_deb_218=str_replace('.','',$_POST['vr_deb_218']);
$vr_deb_219=str_replace('.','',$_POST['vr_deb_219']);
$vr_deb_220=str_replace('.','',$_POST['vr_deb_220']);
$vr_deb_221=str_replace('.','',$_POST['vr_deb_221']);
$vr_deb_222=str_replace('.','',$_POST['vr_deb_222']);
$vr_deb_223=str_replace('.','',$_POST['vr_deb_223']);
$vr_deb_224=str_replace('.','',$_POST['vr_deb_224']);
$vr_deb_225=str_replace('.','',$_POST['vr_deb_225']);
$vr_deb_226=str_replace('.','',$_POST['vr_deb_226']);
$vr_deb_227=str_replace('.','',$_POST['vr_deb_227']);
$vr_deb_228=str_replace('.','',$_POST['vr_deb_228']);
$vr_deb_229=str_replace('.','',$_POST['vr_deb_229']);
$vr_deb_230=str_replace('.','',$_POST['vr_deb_230']);
$vr_deb_231=str_replace('.','',$_POST['vr_deb_231']);
$vr_deb_232=str_replace('.','',$_POST['vr_deb_232']);
$vr_deb_233=str_replace('.','',$_POST['vr_deb_233']);
$vr_deb_234=str_replace('.','',$_POST['vr_deb_234']);
$vr_deb_235=str_replace('.','',$_POST['vr_deb_235']);
$vr_deb_236=str_replace('.','',$_POST['vr_deb_236']);
$vr_deb_237=str_replace('.','',$_POST['vr_deb_237']);
$vr_deb_238=str_replace('.','',$_POST['vr_deb_238']);
$vr_deb_239=str_replace('.','',$_POST['vr_deb_239']);
$vr_deb_240=str_replace('.','',$_POST['vr_deb_240']);
$vr_deb_241=str_replace('.','',$_POST['vr_deb_241']);
$vr_deb_242=str_replace('.','',$_POST['vr_deb_242']);
$vr_deb_243=str_replace('.','',$_POST['vr_deb_243']);
$vr_deb_244=str_replace('.','',$_POST['vr_deb_244']);
$vr_deb_245=str_replace('.','',$_POST['vr_deb_245']);
$vr_deb_246=str_replace('.','',$_POST['vr_deb_246']);
$vr_deb_247=str_replace('.','',$_POST['vr_deb_247']);
$vr_deb_248=str_replace('.','',$_POST['vr_deb_248']);
$vr_deb_249=str_replace('.','',$_POST['vr_deb_249']);
$vr_deb_250=str_replace('.','',$_POST['vr_deb_250']);
$vr_deb_251=str_replace('.','',$_POST['vr_deb_251']);
$vr_deb_252=str_replace('.','',$_POST['vr_deb_252']);
$vr_deb_253=str_replace('.','',$_POST['vr_deb_253']);
$vr_deb_254=str_replace('.','',$_POST['vr_deb_254']);
$vr_deb_255=str_replace('.','',$_POST['vr_deb_255']);
$vr_deb_256=str_replace('.','',$_POST['vr_deb_256']);
$vr_deb_257=str_replace('.','',$_POST['vr_deb_257']);
$vr_deb_258=str_replace('.','',$_POST['vr_deb_258']);
$vr_deb_259=str_replace('.','',$_POST['vr_deb_259']);
$vr_deb_260=str_replace('.','',$_POST['vr_deb_260']);
$vr_deb_261=str_replace('.','',$_POST['vr_deb_261']);
$vr_deb_262=str_replace('.','',$_POST['vr_deb_262']);
$vr_deb_263=str_replace('.','',$_POST['vr_deb_263']);
$vr_deb_264=str_replace('.','',$_POST['vr_deb_264']);
$vr_deb_265=str_replace('.','',$_POST['vr_deb_265']);
$vr_deb_266=str_replace('.','',$_POST['vr_deb_266']);
$vr_deb_267=str_replace('.','',$_POST['vr_deb_267']);
$vr_deb_268=str_replace('.','',$_POST['vr_deb_268']);
$vr_deb_269=str_replace('.','',$_POST['vr_deb_269']);
$vr_deb_270=str_replace('.','',$_POST['vr_deb_270']);
$vr_deb_271=str_replace('.','',$_POST['vr_deb_271']);
$vr_deb_272=str_replace('.','',$_POST['vr_deb_272']);
$vr_deb_273=str_replace('.','',$_POST['vr_deb_273']);
$vr_deb_274=str_replace('.','',$_POST['vr_deb_274']);
$vr_deb_275=str_replace('.','',$_POST['vr_deb_275']);
$vr_deb_276=str_replace('.','',$_POST['vr_deb_276']);
$vr_deb_277=str_replace('.','',$_POST['vr_deb_277']);
$vr_deb_278=str_replace('.','',$_POST['vr_deb_278']);
$vr_deb_279=str_replace('.','',$_POST['vr_deb_279']);
$vr_deb_280=str_replace('.','',$_POST['vr_deb_280']);
$vr_deb_281=str_replace('.','',$_POST['vr_deb_281']);
$vr_deb_282=str_replace('.','',$_POST['vr_deb_282']);
$vr_deb_283=str_replace('.','',$_POST['vr_deb_283']);
$vr_deb_284=str_replace('.','',$_POST['vr_deb_284']);
$vr_deb_285=str_replace('.','',$_POST['vr_deb_285']);
$vr_deb_286=str_replace('.','',$_POST['vr_deb_286']);
$vr_deb_287=str_replace('.','',$_POST['vr_deb_287']);
$vr_deb_288=str_replace('.','',$_POST['vr_deb_288']);
$vr_deb_289=str_replace('.','',$_POST['vr_deb_289']);
$vr_deb_290=str_replace('.','',$_POST['vr_deb_290']);
$vr_deb_291=str_replace('.','',$_POST['vr_deb_291']);
$vr_deb_292=str_replace('.','',$_POST['vr_deb_292']);
$vr_deb_293=str_replace('.','',$_POST['vr_deb_293']);
$vr_deb_294=str_replace('.','',$_POST['vr_deb_294']);
$vr_deb_295=str_replace('.','',$_POST['vr_deb_295']);
$vr_deb_296=str_replace('.','',$_POST['vr_deb_296']);
$vr_deb_297=str_replace('.','',$_POST['vr_deb_297']);
$vr_deb_298=str_replace('.','',$_POST['vr_deb_298']);
$vr_deb_299=str_replace('.','',$_POST['vr_deb_299']);
$vr_deb_300=str_replace('.','',$_POST['vr_deb_300']);


$conta_1=str_replace('.','',$_POST['conta_1']);
$conta_2=str_replace('.','',$_POST['conta_2']);
$conta_3=str_replace('.','',$_POST['conta_3']);
$conta_4=str_replace('.','',$_POST['conta_4']);
$conta_5=str_replace('.','',$_POST['conta_5']);
$conta_6=str_replace('.','',$_POST['conta_6']);
$conta_7=str_replace('.','',$_POST['conta_7']);
$conta_8=str_replace('.','',$_POST['conta_8']);
$conta_9=str_replace('.','',$_POST['conta_9']);
$press_1=str_replace('.','',$_POST['press_1']);
$press_2=str_replace('.','',$_POST['press_2']);
$press_3=str_replace('.','',$_POST['press_3']);
$press_4=str_replace('.','',$_POST['press_4']);
$press_5=str_replace('.','',$_POST['press_5']);
$press_6=str_replace('.','',$_POST['press_6']);
$press_7=str_replace('.','',$_POST['press_7']);
$press_8=str_replace('.','',$_POST['press_8']);
$press_9=str_replace('.','',$_POST['press_9']);

$cheque1 = $_POST['cheque1'];
$cheque2 = $_POST['cheque2'];
$cheque3 = $_POST['cheque3'];
$cheque4 = $_POST['cheque4'];
$cheque5 = $_POST['cheque5'];
$cheque6 = $_POST['cheque6'];
$cheque7 = $_POST['cheque7'];
$cheque8 = $_POST['cheque8'];
$cheque9 = $_POST['cheque9'];
$cheque10 = $_POST['cheque10'];
$cheque11 = $_POST['cheque11'];
$cheque12 = $_POST['cheque12'];
$cheque13 = $_POST['cheque13'];
$cheque14 = $_POST['cheque14'];
$cheque15 = $_POST['cheque15'];
$cheque16 = $_POST['cheque16'];
$cheque17 = $_POST['cheque17'];
$cheque18 = $_POST['cheque18'];
$cheque19 = $_POST['cheque19'];
$cheque20 = $_POST['cheque20'];
$cheque21 = $_POST['cheque21'];
$cheque22 = $_POST['cheque22'];
$cheque23 = $_POST['cheque23'];
$cheque24 = $_POST['cheque24'];
$cheque25 = $_POST['cheque25'];
$cheque26 = $_POST['cheque26'];
$cheque27 = $_POST['cheque27'];
$cheque28 = $_POST['cheque28'];
$cheque29 = $_POST['cheque29'];
$cheque30 = $_POST['cheque30'];
$cheque31 = $_POST['cheque31'];
$cheque32 = $_POST['cheque32'];
$cheque33 = $_POST['cheque33'];
$cheque34 = $_POST['cheque34'];
$cheque35 = $_POST['cheque35'];
$cheque36 = $_POST['cheque36'];
$cheque37 = $_POST['cheque37'];
$cheque38 = $_POST['cheque38'];
$cheque39 = $_POST['cheque39'];
$cheque40 = $_POST['cheque40'];
$cheque41 = $_POST['cheque41'];
$cheque42 = $_POST['cheque42'];
$cheque43 = $_POST['cheque43'];
$cheque44 = $_POST['cheque44'];
$cheque45 = $_POST['cheque45'];
$cheque46 = $_POST['cheque46'];
$cheque47 = $_POST['cheque47'];
$cheque48 = $_POST['cheque48'];
$cheque49 = $_POST['cheque49'];
$cheque50 = $_POST['cheque50'];
$cheque51 = $_POST['cheque51'];
$cheque52 = $_POST['cheque52'];
$cheque53 = $_POST['cheque53'];
$cheque54 = $_POST['cheque54'];
$cheque55 = $_POST['cheque55'];
$cheque56 = $_POST['cheque56'];
$cheque57 = $_POST['cheque57'];
$cheque58 = $_POST['cheque58'];
$cheque59 = $_POST['cheque59'];
$cheque60 = $_POST['cheque60'];
$cheque61 = $_POST['cheque61'];
$cheque62 = $_POST['cheque62'];
$cheque63 = $_POST['cheque63'];
$cheque64 = $_POST['cheque64'];
$cheque65 = $_POST['cheque65'];
$cheque66 = $_POST['cheque66'];
$cheque67 = $_POST['cheque67'];
$cheque68 = $_POST['cheque68'];
$cheque69 = $_POST['cheque69'];
$cheque70 = $_POST['cheque70'];
$cheque71 = $_POST['cheque71'];
$cheque72 = $_POST['cheque72'];
$cheque73 = $_POST['cheque73'];
$cheque74 = $_POST['cheque74'];
$cheque75 = $_POST['cheque75'];
$cheque76 = $_POST['cheque76'];
$cheque77 = $_POST['cheque77'];
$cheque78 = $_POST['cheque78'];
$cheque79 = $_POST['cheque79'];
$cheque80 = $_POST['cheque80'];
$cheque81 = $_POST['cheque81'];
$cheque82 = $_POST['cheque82'];
$cheque83 = $_POST['cheque83'];
$cheque84 = $_POST['cheque84'];
$cheque85 = $_POST['cheque85'];
$cheque86 = $_POST['cheque86'];
$cheque87 = $_POST['cheque87'];
$cheque88 = $_POST['cheque88'];
$cheque89 = $_POST['cheque89'];
$cheque90 = $_POST['cheque90'];
$cheque91 = $_POST['cheque91'];
$cheque92 = $_POST['cheque92'];
$cheque93 = $_POST['cheque93'];
$cheque94 = $_POST['cheque94'];
$cheque95 = $_POST['cheque95'];
$cheque96 = $_POST['cheque96'];
$cheque97 = $_POST['cheque97'];
$cheque98 = $_POST['cheque98'];
$cheque99 = $_POST['cheque99'];
$cheque100 = $_POST['cheque100'];
$cheque101 = $_POST['cheque101'];
$cheque102 = $_POST['cheque102'];
$cheque103 = $_POST['cheque103'];
$cheque104 = $_POST['cheque104'];
$cheque105 = $_POST['cheque105'];
$cheque106 = $_POST['cheque106'];
$cheque107 = $_POST['cheque107'];
$cheque108 = $_POST['cheque108'];
$cheque109 = $_POST['cheque109'];
$cheque110 = $_POST['cheque110'];
$cheque111 = $_POST['cheque111'];
$cheque112 = $_POST['cheque112'];
$cheque113 = $_POST['cheque113'];
$cheque114 = $_POST['cheque114'];
$cheque115 = $_POST['cheque115'];
$cheque116 = $_POST['cheque116'];
$cheque117 = $_POST['cheque117'];
$cheque118 = $_POST['cheque118'];
$cheque119 = $_POST['cheque119'];
$cheque120 = $_POST['cheque120'];
$cheque121 = $_POST['cheque121'];
$cheque122 = $_POST['cheque122'];
$cheque123 = $_POST['cheque123'];
$cheque124 = $_POST['cheque124'];
$cheque125 = $_POST['cheque125'];
$cheque126 = $_POST['cheque126'];
$cheque127 = $_POST['cheque127'];
$cheque128 = $_POST['cheque128'];
$cheque129 = $_POST['cheque129'];
$cheque130 = $_POST['cheque130'];
$cheque131 = $_POST['cheque131'];
$cheque132 = $_POST['cheque132'];
$cheque133 = $_POST['cheque133'];
$cheque134 = $_POST['cheque134'];
$cheque135 = $_POST['cheque135'];
$cheque136 = $_POST['cheque136'];
$cheque137 = $_POST['cheque137'];
$cheque138 = $_POST['cheque138'];
$cheque139 = $_POST['cheque139'];
$cheque140 = $_POST['cheque140'];
$cheque141 = $_POST['cheque141'];
$cheque142 = $_POST['cheque142'];
$cheque143 = $_POST['cheque143'];
$cheque144 = $_POST['cheque144'];
$cheque145 = $_POST['cheque145'];
$cheque146 = $_POST['cheque146'];
$cheque147 = $_POST['cheque147'];
$cheque148 = $_POST['cheque148'];
$cheque149 = $_POST['cheque149'];
$cheque150 = $_POST['cheque150'];
$cheque151 = $_POST['cheque151'];
$cheque152 = $_POST['cheque152'];
$cheque153 = $_POST['cheque153'];
$cheque154 = $_POST['cheque154'];
$cheque155 = $_POST['cheque155'];
$cheque156 = $_POST['cheque156'];
$cheque157 = $_POST['cheque157'];
$cheque158 = $_POST['cheque158'];
$cheque159 = $_POST['cheque159'];
$cheque160 = $_POST['cheque160'];
$cheque161= $_POST['cheque161'];
$cheque162= $_POST['cheque162'];
$cheque163= $_POST['cheque163'];
$cheque164= $_POST['cheque164'];
$cheque165= $_POST['cheque165'];
$cheque166= $_POST['cheque166'];
$cheque167= $_POST['cheque167'];
$cheque168= $_POST['cheque168'];
$cheque169= $_POST['cheque169'];
$cheque170= $_POST['cheque170'];
$cheque171= $_POST['cheque171'];
$cheque172= $_POST['cheque172'];
$cheque173= $_POST['cheque173'];
$cheque174= $_POST['cheque174'];
$cheque175= $_POST['cheque175'];
$cheque176= $_POST['cheque176'];
$cheque177= $_POST['cheque177'];
$cheque178= $_POST['cheque178'];
$cheque179= $_POST['cheque179'];
$cheque180= $_POST['cheque180'];
$cheque181= $_POST['cheque181'];
$cheque182= $_POST['cheque182'];
$cheque183= $_POST['cheque183'];
$cheque184= $_POST['cheque184'];
$cheque185= $_POST['cheque185'];
$cheque186= $_POST['cheque186'];
$cheque187= $_POST['cheque187'];
$cheque188= $_POST['cheque188'];
$cheque189= $_POST['cheque189'];
$cheque190= $_POST['cheque190'];
$cheque191= $_POST['cheque191'];
$cheque192= $_POST['cheque192'];
$cheque193= $_POST['cheque193'];
$cheque194= $_POST['cheque194'];
$cheque195= $_POST['cheque195'];
$cheque196= $_POST['cheque196'];
$cheque197= $_POST['cheque197'];
$cheque198= $_POST['cheque198'];
$cheque199= $_POST['cheque199'];
$cheque200= $_POST['cheque200'];
$cheque201= $_POST['cheque201'];
$cheque202= $_POST['cheque202'];
$cheque203= $_POST['cheque203'];
$cheque204= $_POST['cheque204'];
$cheque205= $_POST['cheque205'];
$cheque206= $_POST['cheque206'];
$cheque207= $_POST['cheque207'];
$cheque208= $_POST['cheque208'];
$cheque209= $_POST['cheque209'];
$cheque210= $_POST['cheque210'];
$cheque211= $_POST['cheque211'];
$cheque212= $_POST['cheque212'];
$cheque213= $_POST['cheque213'];
$cheque214= $_POST['cheque214'];
$cheque215= $_POST['cheque215'];
$cheque216= $_POST['cheque216'];
$cheque217= $_POST['cheque217'];
$cheque218= $_POST['cheque218'];
$cheque219= $_POST['cheque219'];
$cheque220= $_POST['cheque220'];
$cheque221= $_POST['cheque221'];
$cheque222= $_POST['cheque222'];
$cheque223= $_POST['cheque223'];
$cheque224= $_POST['cheque224'];
$cheque225= $_POST['cheque225'];
$cheque226= $_POST['cheque226'];
$cheque227= $_POST['cheque227'];
$cheque228= $_POST['cheque228'];
$cheque229= $_POST['cheque229'];
$cheque230= $_POST['cheque230'];
$cheque231= $_POST['cheque231'];
$cheque232= $_POST['cheque232'];
$cheque233= $_POST['cheque233'];
$cheque234= $_POST['cheque234'];
$cheque235= $_POST['cheque235'];
$cheque236= $_POST['cheque236'];
$cheque237= $_POST['cheque237'];
$cheque238= $_POST['cheque238'];
$cheque239= $_POST['cheque239'];
$cheque240= $_POST['cheque240'];
$cheque241= $_POST['cheque241'];
$cheque242= $_POST['cheque242'];
$cheque243= $_POST['cheque243'];
$cheque244= $_POST['cheque244'];
$cheque245= $_POST['cheque245'];
$cheque246= $_POST['cheque246'];
$cheque247= $_POST['cheque247'];
$cheque248= $_POST['cheque248'];
$cheque249= $_POST['cheque249'];
$cheque250= $_POST['cheque250'];
$cheque251= $_POST['cheque251'];
$cheque252= $_POST['cheque252'];
$cheque253= $_POST['cheque253'];
$cheque254= $_POST['cheque254'];
$cheque255= $_POST['cheque255'];
$cheque256= $_POST['cheque256'];
$cheque257= $_POST['cheque257'];
$cheque258= $_POST['cheque258'];
$cheque259= $_POST['cheque259'];
$cheque260= $_POST['cheque260'];
$cheque261= $_POST['cheque261'];
$cheque262= $_POST['cheque262'];
$cheque263= $_POST['cheque263'];
$cheque264= $_POST['cheque264'];
$cheque265= $_POST['cheque265'];
$cheque266= $_POST['cheque266'];
$cheque267= $_POST['cheque267'];
$cheque268= $_POST['cheque268'];
$cheque269= $_POST['cheque269'];
$cheque270= $_POST['cheque270'];
$cheque271= $_POST['cheque271'];
$cheque272= $_POST['cheque272'];
$cheque273= $_POST['cheque273'];
$cheque274= $_POST['cheque274'];
$cheque275= $_POST['cheque275'];
$cheque276= $_POST['cheque276'];
$cheque277= $_POST['cheque277'];
$cheque278= $_POST['cheque278'];
$cheque279= $_POST['cheque279'];
$cheque280= $_POST['cheque280'];
$cheque281= $_POST['cheque281'];
$cheque282= $_POST['cheque282'];
$cheque283= $_POST['cheque283'];
$cheque284= $_POST['cheque284'];
$cheque285= $_POST['cheque285'];
$cheque286= $_POST['cheque286'];
$cheque287= $_POST['cheque287'];
$cheque288= $_POST['cheque288'];
$cheque289= $_POST['cheque289'];
$cheque290= $_POST['cheque290'];
$cheque291= $_POST['cheque291'];
$cheque292= $_POST['cheque292'];
$cheque293= $_POST['cheque293'];
$cheque294= $_POST['cheque294'];
$cheque295= $_POST['cheque295'];
$cheque296= $_POST['cheque296'];
$cheque297= $_POST['cheque297'];
$cheque298= $_POST['cheque298'];
$cheque299= $_POST['cheque299'];
$cheque300= $_POST['cheque300'];

$tot_deb = $vr_deb_1+$vr_deb_2+$vr_deb_3+$vr_deb_4+$vr_deb_5+$vr_deb_6+$vr_deb_7+$vr_deb_8+$vr_deb_9+$vr_deb_10+$vr_deb_11+$vr_deb_12+$vr_deb_13+$vr_deb_14+$vr_deb_15+$vr_deb_16+$vr_deb_17+$vr_deb_18+$vr_deb_19+$vr_deb_20+$vr_deb_21+$vr_deb_22+$vr_deb_23+$vr_deb_24+$vr_deb_25+$vr_deb_26+$vr_deb_27+$vr_deb_28+$vr_deb_29+$vr_deb_30+$vr_deb_31+$vr_deb_32+$vr_deb_33+$vr_deb_34+$vr_deb_35+$vr_deb_36+$vr_deb_37+$vr_deb_38+$vr_deb_39+$vr_deb_40+$vr_deb_41+$vr_deb_42+$vr_deb_43+$vr_deb_44+$vr_deb_45+$vr_deb_46+$vr_deb_47+$vr_deb_48+$vr_deb_49+$vr_deb_50+$vr_deb_51+$vr_deb_52+$vr_deb_53+$vr_deb_54+$vr_deb_55+$vr_deb_56+$vr_deb_57+$vr_deb_58+$vr_deb_59+$vr_deb_60+$vr_deb_61+$vr_deb_62+$vr_deb_63+$vr_deb_64+$vr_deb_65+$vr_deb_66+$vr_deb_67+$vr_deb_68+$vr_deb_69+$vr_deb_70+$vr_deb_71+$vr_deb_72+$vr_deb_73+$vr_deb_74+$vr_deb_75+$vr_deb_76+$vr_deb_77+$vr_deb_78+$vr_deb_79+$vr_deb_80+$vr_deb_81+$vr_deb_82+$vr_deb_83+$vr_deb_84+$vr_deb_85+$vr_deb_86+$vr_deb_87+$vr_deb_88+$vr_deb_89+$vr_deb_90+$vr_deb_91+$vr_deb_92+$vr_deb_93+$vr_deb_94+$vr_deb_95+$vr_deb_96+$vr_deb_97+$vr_deb_98+$vr_deb_99+$vr_deb_100+$vr_deb_101+$vr_deb_102+$vr_deb_103+$vr_deb_104+$vr_deb_105+$vr_deb_106+$vr_deb_107+$vr_deb_108+$vr_deb_109+$vr_deb_110+$vr_deb_111+$vr_deb_112+$vr_deb_113+$vr_deb_114+$vr_deb_115+$vr_deb_116+$vr_deb_117+$vr_deb_118+$vr_deb_119+$vr_deb_120+$vr_deb_121+$vr_deb_122+$vr_deb_123+$vr_deb_124+$vr_deb_125+$vr_deb_126+$vr_deb_127+$vr_deb_128+$vr_deb_129+$vr_deb_130+$vr_deb_131+$vr_deb_132+$vr_deb_133+$vr_deb_134+$vr_deb_135+$vr_deb_136+$vr_deb_137+$vr_deb_138+$vr_deb_139+$vr_deb_140+$vr_deb_141+$vr_deb_142+$vr_deb_143+$vr_deb_144+$vr_deb_145+$vr_deb_146+$vr_deb_147+$vr_deb_148+$vr_deb_149+$vr_deb_150+$vr_deb_151+$vr_deb_152+$vr_deb_153+$vr_deb_154+$vr_deb_155+$vr_deb_156+$vr_deb_157+$vr_deb_158+$vr_deb_159+$vr_deb_160+$vr_deb_161+$vr_deb_162+$vr_deb_163+$vr_deb_164+$vr_deb_165+$vr_deb_166+$vr_deb_167+$vr_deb_168+$vr_deb_169+$vr_deb_170+$vr_deb_171+$vr_deb_172+$vr_deb_173+$vr_deb_174+$vr_deb_175+$vr_deb_176+$vr_deb_177+$vr_deb_178+$vr_deb_179+$vr_deb_180+$vr_deb_181+$vr_deb_182+$vr_deb_183+$vr_deb_184+$vr_deb_185+$vr_deb_186+$vr_deb_187+$vr_deb_188+$vr_deb_189+$vr_deb_190+$vr_deb_191+$vr_deb_192+$vr_deb_193+$vr_deb_194+$vr_deb_195+$vr_deb_196+$vr_deb_197+$vr_deb_198+$vr_deb_199+$vr_deb_200+$vr_deb_201+$vr_deb_202+$vr_deb_203+$vr_deb_204+$vr_deb_205+$vr_deb_206+$vr_deb_207+$vr_deb_208+$vr_deb_209+$vr_deb_210+$vr_deb_211+$vr_deb_212+$vr_deb_213+$vr_deb_214+$vr_deb_215+$vr_deb_216+$vr_deb_217+$vr_deb_218+$vr_deb_219+$vr_deb_220+$vr_deb_221+$vr_deb_222+$vr_deb_223+$vr_deb_224+$vr_deb_225+$vr_deb_226+$vr_deb_227+$vr_deb_228+$vr_deb_229+$vr_deb_230+$vr_deb_231+$vr_deb_232+$vr_deb_233+$vr_deb_234+$vr_deb_235+$vr_deb_236+$vr_deb_237+$vr_deb_238+$vr_deb_239+$vr_deb_240+$vr_deb_241+$vr_deb_242+$vr_deb_243+$vr_deb_244+$vr_deb_245+$vr_deb_246+$vr_deb_247+$vr_deb_248+$vr_deb_249+$vr_deb_250+$vr_deb_251+$vr_deb_252+$vr_deb_253+$vr_deb_254+$vr_deb_255+$vr_deb_256+$vr_deb_257+$vr_deb_258+$vr_deb_259+$vr_deb_260+$vr_deb_261+$vr_deb_262+$vr_deb_263+$vr_deb_264+$vr_deb_265+$vr_deb_266+$vr_deb_267+$vr_deb_268+$vr_deb_269+$vr_deb_270+$vr_deb_271+$vr_deb_272+$vr_deb_273+$vr_deb_274+$vr_deb_275+$vr_deb_276+$vr_deb_277+$vr_deb_278+$vr_deb_279+$vr_deb_280+$vr_deb_281+$vr_deb_282+$vr_deb_283+$vr_deb_284+$vr_deb_285+$vr_deb_286+$vr_deb_287+$vr_deb_288+$vr_deb_289+$vr_deb_290+$vr_deb_291+$vr_deb_292+$vr_deb_293+$vr_deb_294+$vr_deb_295+$vr_deb_296+$vr_deb_297+$vr_deb_298+$vr_deb_299+$vr_deb_300;
$tot_cre = $vr_cre_1+$vr_cre_2+$vr_cre_3+$vr_cre_4+$vr_cre_5+$vr_cre_6+$vr_cre_7+$vr_cre_8+$vr_cre_9+$vr_cre_10+$vr_cre_11+$vr_cre_12+$vr_cre_13+$vr_cre_14+$vr_cre_15+$vr_cre_16+$vr_cre_17+$vr_cre_18+$vr_cre_19+$vr_cre_20+$vr_cre_21+$vr_cre_22+$vr_cre_23+$vr_cre_24+$vr_cre_25+$vr_cre_26+$vr_cre_27+$vr_cre_28+$vr_cre_29+$vr_cre_30+$vr_cre_31+$vr_cre_32+$vr_cre_33+$vr_cre_34+$vr_cre_35+$vr_cre_36+$vr_cre_37+$vr_cre_38+$vr_cre_39+$vr_cre_40+$vr_cre_41+$vr_cre_42+$vr_cre_43+$vr_cre_44+$vr_cre_45+$vr_cre_46+$vr_cre_47+$vr_cre_48+$vr_cre_49+$vr_cre_50+$vr_cre_51+$vr_cre_52+$vr_cre_53+$vr_cre_54+$vr_cre_55+$vr_cre_56+$vr_cre_57+$vr_cre_58+$vr_cre_59+$vr_cre_60+$vr_cre_61+$vr_cre_62+$vr_cre_63+$vr_cre_64+$vr_cre_65+$vr_cre_66+$vr_cre_67+$vr_cre_68+$vr_cre_69+$vr_cre_70+$vr_cre_71+$vr_cre_72+$vr_cre_73+$vr_cre_74+$vr_cre_75+$vr_cre_76+$vr_cre_77+$vr_cre_78+$vr_cre_79+$vr_cre_80+$vr_cre_81+$vr_cre_82+$vr_cre_83+$vr_cre_84+$vr_cre_85+$vr_cre_86+$vr_cre_87+$vr_cre_88+$vr_cre_89+$vr_cre_90+$vr_cre_91+$vr_cre_92+$vr_cre_93+$vr_cre_94+$vr_cre_95+$vr_cre_96+$vr_cre_97+$vr_cre_98+$vr_cre_99+$vr_cre_100+$vr_cre_101+$vr_cre_102+$vr_cre_103+$vr_cre_104+$vr_cre_105+$vr_cre_106+$vr_cre_107+$vr_cre_108+$vr_cre_109+$vr_cre_110+$vr_cre_111+$vr_cre_112+$vr_cre_113+$vr_cre_114+$vr_cre_115+$vr_cre_116+$vr_cre_117+$vr_cre_118+$vr_cre_119+$vr_cre_120+$vr_cre_121+$vr_cre_122+$vr_cre_123+$vr_cre_124+$vr_cre_125+$vr_cre_126+$vr_cre_127+$vr_cre_128+$vr_cre_129+$vr_cre_130+$vr_cre_131+$vr_cre_132+$vr_cre_133+$vr_cre_134+$vr_cre_135+$vr_cre_136+$vr_cre_137+$vr_cre_138+$vr_cre_139+$vr_cre_140+$vr_cre_141+$vr_cre_142+$vr_cre_143+$vr_cre_144+$vr_cre_145+$vr_cre_146+$vr_cre_147+$vr_cre_148+$vr_cre_149+$vr_cre_150+$vr_cre_151+$vr_cre_152+$vr_cre_153+$vr_cre_154+$vr_cre_155+$vr_cre_156+$vr_cre_157+$vr_cre_158+$vr_cre_159+$vr_cre_160+$vr_cre_161+$vr_cre_162+$vr_cre_163+$vr_cre_164+$vr_cre_165+$vr_cre_166+$vr_cre_167+$vr_cre_168+$vr_cre_169+$vr_cre_170+$vr_cre_171+$vr_cre_172+$vr_cre_173+$vr_cre_174+$vr_cre_175+$vr_cre_176+$vr_cre_177+$vr_cre_178+$vr_cre_179+$vr_cre_180+$vr_cre_181+$vr_cre_182+$vr_cre_183+$vr_cre_184+$vr_cre_185+$vr_cre_186+$vr_cre_187+$vr_cre_188+$vr_cre_189+$vr_cre_190+$vr_cre_191+$vr_cre_192+$vr_cre_193+$vr_cre_194+$vr_cre_195+$vr_cre_196+$vr_cre_197+$vr_cre_198+$vr_cre_199+$vr_cre_200+$vr_cre_201+$vr_cre_202+$vr_cre_203+$vr_cre_204+$vr_cre_205+$vr_cre_206+$vr_cre_207+$vr_cre_208+$vr_cre_209+$vr_cre_210+$vr_cre_211+$vr_cre_212+$vr_cre_213+$vr_cre_214+$vr_cre_215+$vr_cre_216+$vr_cre_217+$vr_cre_218+$vr_cre_219+$vr_cre_220+$vr_cre_221+$vr_cre_222+$vr_cre_223+$vr_cre_224+$vr_cre_225+$vr_cre_226+$vr_cre_227+$vr_cre_228+$vr_cre_229+$vr_cre_230+$vr_cre_231+$vr_cre_232+$vr_cre_233+$vr_cre_234+$vr_cre_235+$vr_cre_236+$vr_cre_237+$vr_cre_238+$vr_cre_239+$vr_cre_240+$vr_cre_241+$vr_cre_242+$vr_cre_243+$vr_cre_244+$vr_cre_245+$vr_cre_246+$vr_cre_247+$vr_cre_248+$vr_cre_249+$vr_cre_250+$vr_cre_251+$vr_cre_252+$vr_cre_253+$vr_cre_254+$vr_cre_255+$vr_cre_256+$vr_cre_257+$vr_cre_258+$vr_cre_259+$vr_cre_260+$vr_cre_261+$vr_cre_262+$vr_cre_263+$vr_cre_264+$vr_cre_265+$vr_cre_266+$vr_cre_267+$vr_cre_268+$vr_cre_269+$vr_cre_270+$vr_cre_271+$vr_cre_272+$vr_cre_273+$vr_cre_274+$vr_cre_275+$vr_cre_276+$vr_cre_277+$vr_cre_278+$vr_cre_279+$vr_cre_280+$vr_cre_281+$vr_cre_282+$vr_cre_283+$vr_cre_284+$vr_cre_285+$vr_cre_286+$vr_cre_287+$vr_cre_288+$vr_cre_289+$vr_cre_290+$vr_cre_291+$vr_cre_292+$vr_cre_293+$vr_cre_294+$vr_cre_295+$vr_cre_296+$vr_cre_297+$vr_cre_298+$vr_cre_299+$vr_cre_300;					
										
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

if($tercero =='')
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
				$sq2="select id_recau from recaudo_riip where id_recau ='$id_recau' ";
				$rs2=mysql_query($sq2);
				$fil=mysql_num_rows($rs2);
				if ($fil ==0)
				{

					for ($i=1;$i<$filas;$i++)
					{	  // recibo variables 
						$cuenta = $_POST['cuenta_'.$i];
						$valor = str_replace('.','',$_POST['valor_'.$i]);
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
										$sql = "INSERT INTO recaudo_riip ( 
									
										id_emp , id_reip , id_caic , id_recau , fecha_recaudo , des_recaudo , tercero ,
										id_unico_reip, cuenta, nombre, vr_orig_reip, vr_digitado, ter_nat, ter_jur, id_manu_rcgt,ter
									
										) VALUES ( 
													
										'$id_emp' , '$id_reip' , '$id_caic' , '$id_recau' , '$fecha_recaudo' , '$des_recaudo' ,'$tercero' ,
										'$id' , '$cuenta' , '$nom_rubro' , '$vr_orig_reip' , '$valor' , '$ter_nat', '$ter_jur', '$id_manu_rcgt','$ter'
									
										)";
										mysql_query($sql, $connectionxx) or die(mysql_error());
					} // end for
					// se realiza el ultimo registro
					$cuenta = $_POST['cuenta_'.$i];
						$valor = str_replace('.','',$_POST['valor_'.$i]);
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
										$sql = "INSERT INTO recaudo_riip ( 
									
										id_emp , id_reip , id_caic , id_recau , fecha_recaudo , des_recaudo , tercero ,
										pgcp1 , pgcp2 , pgcp3 , pgcp4 , pgcp5 , pgcp6 , pgcp7 , pgcp8 , pgcp9 , pgcp10 , pgcp11 , pgcp12 , pgcp13 , pgcp14 , pgcp15 , pgcp16,pgcp17,pgcp18,pgcp19,pgcp20,pgcp21,pgcp22,pgcp23,pgcp24,pgcp25,pgcp26,pgcp27,pgcp28,pgcp29,pgcp30,pgcp31,pgcp32,pgcp33,pgcp34,pgcp35,pgcp36,pgcp37,pgcp38,pgcp39,pgcp40,pgcp41,pgcp42,pgcp43,pgcp44,pgcp45,pgcp46,pgcp47,pgcp48,pgcp49,pgcp50,pgcp51,pgcp52,pgcp53,pgcp54,pgcp55,pgcp56,pgcp57,pgcp58,pgcp59,pgcp60,pgcp61,pgcp62,pgcp63,pgcp64,pgcp65,pgcp66,pgcp67,pgcp68,pgcp69,pgcp70,pgcp71,pgcp72,pgcp73,pgcp74,pgcp75,pgcp76,pgcp77,pgcp78,pgcp79,pgcp80,pgcp81,pgcp82,pgcp83,pgcp84,pgcp85,pgcp86,pgcp87,pgcp88,pgcp89,pgcp90,pgcp91,pgcp92,pgcp93,pgcp94,pgcp95,pgcp96,pgcp97,pgcp98,pgcp99,pgcp100,pgcp101,pgcp102,pgcp103,pgcp104,pgcp105,pgcp106,pgcp107,pgcp108,pgcp109,pgcp110,pgcp111,pgcp112,pgcp113,pgcp114,pgcp115,pgcp116,pgcp117,pgcp118,pgcp119,pgcp120,pgcp121,pgcp122,pgcp123,pgcp124,pgcp125,pgcp126,pgcp127,pgcp128,pgcp129,pgcp130,pgcp131,pgcp132,pgcp133,pgcp134,pgcp135,pgcp136,pgcp137,pgcp138,pgcp139,pgcp140,pgcp141,pgcp142,pgcp143,pgcp144,pgcp145,pgcp146,pgcp147,pgcp148,pgcp149,pgcp150,pgcp151,pgcp152,pgcp153,pgcp154,pgcp155,pgcp156,pgcp157,pgcp158,pgcp159,pgcp160,pgcp161,pgcp162,pgcp163,pgcp164,pgcp165,pgcp166,pgcp167,pgcp168,pgcp169,pgcp170,pgcp171,pgcp172,pgcp173,pgcp174,pgcp175,pgcp176,pgcp177,pgcp178,pgcp179,pgcp180,pgcp181,pgcp182,pgcp183,pgcp184,pgcp185,pgcp186,pgcp187,pgcp188,pgcp189,pgcp190,pgcp191,pgcp192,pgcp193,pgcp194,pgcp195,pgcp196,pgcp197,pgcp198,pgcp199,pgcp200,pgcp201,pgcp202,pgcp203,pgcp204,pgcp205,pgcp206,pgcp207,pgcp208,pgcp209,pgcp210,pgcp211,pgcp212,pgcp213,pgcp214,pgcp215,pgcp216,pgcp217,pgcp218,pgcp219,pgcp220,pgcp221,pgcp222,pgcp223,pgcp224,pgcp225,pgcp226,pgcp227,pgcp228,pgcp229,pgcp230,pgcp231,pgcp232,pgcp233,pgcp234,pgcp235,pgcp236,pgcp237,pgcp238,pgcp239,pgcp240,pgcp241,pgcp242,pgcp243,pgcp244,pgcp245,pgcp246,pgcp247,pgcp248,pgcp249,pgcp250,pgcp251,pgcp252,pgcp253,pgcp254,pgcp255,pgcp256,pgcp257,pgcp258,pgcp259,pgcp260,pgcp261,pgcp262,pgcp263,pgcp264,pgcp265,pgcp266,pgcp267,pgcp268,pgcp269,pgcp270,pgcp271,pgcp272,pgcp273,pgcp274,pgcp275,pgcp276,pgcp277,pgcp278,pgcp279,pgcp280,pgcp281,pgcp282,pgcp283,pgcp284,pgcp285,pgcp286,pgcp287,pgcp288,pgcp289,pgcp290,pgcp291,pgcp292,pgcp293,pgcp294,pgcp295,pgcp296,pgcp297,pgcp298,pgcp299,pgcp300,
										des1 , des2 , des3 , des4 , des5 , des6 , des7 , des8 , des9 , des10 , des11 , des12 , des13 , des14 , des15 , 
										vr_deb_1 , vr_deb_2 , vr_deb_3 , vr_deb_4 , vr_deb_5 , vr_deb_6 , vr_deb_7 , vr_deb_8 , vr_deb_9 , 
										vr_deb_10 , vr_deb_11 , vr_deb_12 , vr_deb_13 , vr_deb_14 , vr_deb_15 , 
										vr_deb_16,vr_deb_17,vr_deb_18,vr_deb_19,vr_deb_20,vr_deb_21,vr_deb_22,vr_deb_23,vr_deb_24,vr_deb_25,vr_deb_26,vr_deb_27,vr_deb_28,vr_deb_29,vr_deb_30,vr_deb_31,vr_deb_32,vr_deb_33,vr_deb_34,vr_deb_35,vr_deb_36,vr_deb_37,vr_deb_38,vr_deb_39,vr_deb_40,vr_deb_41,vr_deb_42,vr_deb_43,vr_deb_44,vr_deb_45,vr_deb_46,vr_deb_47,vr_deb_48,vr_deb_49,vr_deb_50,vr_deb_51,vr_deb_52,vr_deb_53,vr_deb_54,vr_deb_55,vr_deb_56,vr_deb_57,vr_deb_58,vr_deb_59,vr_deb_60,vr_deb_61,vr_deb_62,vr_deb_63,vr_deb_64,vr_deb_65,vr_deb_66,vr_deb_67,vr_deb_68,vr_deb_69,vr_deb_70,vr_deb_71,vr_deb_72,vr_deb_73,vr_deb_74,vr_deb_75,vr_deb_76,vr_deb_77,vr_deb_78,vr_deb_79,vr_deb_80,vr_deb_81,vr_deb_82,vr_deb_83,vr_deb_84,vr_deb_85,vr_deb_86,vr_deb_87,vr_deb_88,vr_deb_89,vr_deb_90,vr_deb_91,vr_deb_92,vr_deb_93,vr_deb_94,vr_deb_95,vr_deb_96,vr_deb_97,vr_deb_98,vr_deb_99,vr_deb_100,vr_deb_101,vr_deb_102,vr_deb_103,vr_deb_104,vr_deb_105,vr_deb_106,vr_deb_107,vr_deb_108,vr_deb_109,vr_deb_110,vr_deb_111,vr_deb_112,vr_deb_113,vr_deb_114,vr_deb_115,vr_deb_116,vr_deb_117,vr_deb_118,vr_deb_119,vr_deb_120,vr_deb_121,vr_deb_122,vr_deb_123,vr_deb_124,vr_deb_125,vr_deb_126,vr_deb_127,vr_deb_128,vr_deb_129,vr_deb_130,vr_deb_131,vr_deb_132,vr_deb_133,vr_deb_134,vr_deb_135,vr_deb_136,vr_deb_137,vr_deb_138,vr_deb_139,vr_deb_140,vr_deb_141,vr_deb_142,vr_deb_143,vr_deb_144,vr_deb_145,vr_deb_146,vr_deb_147,vr_deb_148,vr_deb_149,vr_deb_150,vr_deb_151,vr_deb_152,vr_deb_153,vr_deb_154,vr_deb_155,vr_deb_156,vr_deb_157,vr_deb_158,vr_deb_159,vr_deb_160,vr_deb_161,vr_deb_162,vr_deb_163,vr_deb_164,vr_deb_165,vr_deb_166,vr_deb_167,vr_deb_168,vr_deb_169,vr_deb_170,vr_deb_171,vr_deb_172,vr_deb_173,vr_deb_174,vr_deb_175,vr_deb_176,vr_deb_177,vr_deb_178,vr_deb_179,vr_deb_180,vr_deb_181,vr_deb_182,vr_deb_183,vr_deb_184,vr_deb_185,vr_deb_186,vr_deb_187,vr_deb_188,vr_deb_189,vr_deb_190,vr_deb_191,vr_deb_192,vr_deb_193,vr_deb_194,vr_deb_195,vr_deb_196,vr_deb_197,vr_deb_198,vr_deb_199,vr_deb_200,vr_deb_201,vr_deb_202,vr_deb_203,vr_deb_204,vr_deb_205,vr_deb_206,vr_deb_207,vr_deb_208,vr_deb_209,vr_deb_210,vr_deb_211,vr_deb_212,vr_deb_213,vr_deb_214,vr_deb_215,vr_deb_216,vr_deb_217,vr_deb_218,vr_deb_219,vr_deb_220,vr_deb_221,vr_deb_222,vr_deb_223,vr_deb_224,vr_deb_225,vr_deb_226,vr_deb_227,vr_deb_228,vr_deb_229,vr_deb_230,vr_deb_231,vr_deb_232,vr_deb_233,vr_deb_234,vr_deb_235,vr_deb_236,vr_deb_237,vr_deb_238,vr_deb_239,vr_deb_240,vr_deb_241,vr_deb_242,vr_deb_243,vr_deb_244,vr_deb_245,vr_deb_246,vr_deb_247,vr_deb_248,vr_deb_249,vr_deb_250,vr_deb_251,vr_deb_252,vr_deb_253,vr_deb_254,vr_deb_255,vr_deb_256,vr_deb_257,vr_deb_258,vr_deb_259,vr_deb_260,vr_deb_261,vr_deb_262,vr_deb_263,vr_deb_264,vr_deb_265,vr_deb_266,vr_deb_267,vr_deb_268,vr_deb_269,vr_deb_270,vr_deb_271,vr_deb_272,vr_deb_273,vr_deb_274,vr_deb_275,vr_deb_276,vr_deb_277,vr_deb_278,vr_deb_279,vr_deb_280,vr_deb_281,vr_deb_282,vr_deb_283,vr_deb_284,vr_deb_285,vr_deb_286,vr_deb_287,vr_deb_288,vr_deb_289,vr_deb_290,vr_deb_291,vr_deb_292,vr_deb_293,vr_deb_294,vr_deb_295,vr_deb_296,vr_deb_297,vr_deb_298,vr_deb_299,vr_deb_300,


										vr_cre_1 , vr_cre_2 , vr_cre_3 , vr_cre_4 , vr_cre_5 , vr_cre_6 , vr_cre_7 , vr_cre_8 , vr_cre_9 , 
										vr_cre_10 , vr_cre_11 , vr_cre_12 , vr_cre_13 , vr_cre_14 , vr_cre_15,vr_cre_16,vr_cre_17,vr_cre_18,vr_cre_19,vr_cre_20,vr_cre_21,vr_cre_22,vr_cre_23,vr_cre_24,vr_cre_25,vr_cre_26,vr_cre_27,vr_cre_28,vr_cre_29,vr_cre_30,vr_cre_31,vr_cre_32,vr_cre_33,vr_cre_34,vr_cre_35,vr_cre_36,vr_cre_37,vr_cre_38,vr_cre_39,vr_cre_40,vr_cre_41,vr_cre_42,vr_cre_43,vr_cre_44,vr_cre_45,vr_cre_46,vr_cre_47,vr_cre_48,vr_cre_49,vr_cre_50,vr_cre_51,vr_cre_52,vr_cre_53,vr_cre_54,vr_cre_55,vr_cre_56,vr_cre_57,vr_cre_58,vr_cre_59,vr_cre_60,vr_cre_61,vr_cre_62,vr_cre_63,vr_cre_64,vr_cre_65,vr_cre_66,vr_cre_67,vr_cre_68,vr_cre_69,vr_cre_70,vr_cre_71,vr_cre_72,vr_cre_73,vr_cre_74,vr_cre_75,vr_cre_76,vr_cre_77,vr_cre_78,vr_cre_79,vr_cre_80,vr_cre_81,vr_cre_82,vr_cre_83,vr_cre_84,vr_cre_85,vr_cre_86,vr_cre_87,vr_cre_88,vr_cre_89,vr_cre_90,vr_cre_91,vr_cre_92,vr_cre_93,vr_cre_94,vr_cre_95,vr_cre_96,vr_cre_97,vr_cre_98,vr_cre_99,vr_cre_100,vr_cre_101,vr_cre_102,vr_cre_103,vr_cre_104,vr_cre_105,vr_cre_106,vr_cre_107,vr_cre_108,vr_cre_109,vr_cre_110,vr_cre_111,vr_cre_112,vr_cre_113,vr_cre_114,vr_cre_115,vr_cre_116,vr_cre_117,vr_cre_118,vr_cre_119,vr_cre_120,vr_cre_121,vr_cre_122,vr_cre_123,vr_cre_124,vr_cre_125,vr_cre_126,vr_cre_127,vr_cre_128,vr_cre_129,vr_cre_130,vr_cre_131,vr_cre_132,vr_cre_133,vr_cre_134,vr_cre_135,vr_cre_136,vr_cre_137,vr_cre_138,vr_cre_139,vr_cre_140,vr_cre_141,vr_cre_142,vr_cre_143,vr_cre_144,vr_cre_145,vr_cre_146,vr_cre_147,vr_cre_148,vr_cre_149,vr_cre_150,vr_cre_151,vr_cre_152,vr_cre_153,vr_cre_154,vr_cre_155,vr_cre_156,vr_cre_157,vr_cre_158,vr_cre_159,vr_cre_160,vr_cre_161,vr_cre_162,vr_cre_163,vr_cre_164,vr_cre_165,vr_cre_166,vr_cre_167,vr_cre_168,vr_cre_169,vr_cre_170,vr_cre_171,vr_cre_172,vr_cre_173,vr_cre_174,vr_cre_175,vr_cre_176,vr_cre_177,vr_cre_178,vr_cre_179,vr_cre_180,vr_cre_181,vr_cre_182,vr_cre_183,vr_cre_184,vr_cre_185,vr_cre_186,vr_cre_187,vr_cre_188,vr_cre_189,vr_cre_190,vr_cre_191,vr_cre_192,vr_cre_193,vr_cre_194,vr_cre_195,vr_cre_196,vr_cre_197,vr_cre_198,vr_cre_199,vr_cre_200,vr_cre_201,vr_cre_202,vr_cre_203,vr_cre_204,vr_cre_205,vr_cre_206,vr_cre_207,vr_cre_208,vr_cre_209,vr_cre_210,vr_cre_211,vr_cre_212,vr_cre_213,vr_cre_214,vr_cre_215,vr_cre_216,vr_cre_217,vr_cre_218,vr_cre_219,vr_cre_220,vr_cre_221,vr_cre_222,vr_cre_223,vr_cre_224,vr_cre_225,vr_cre_226,vr_cre_227,vr_cre_228,vr_cre_229,vr_cre_230,vr_cre_231,vr_cre_232,vr_cre_233,vr_cre_234,vr_cre_235,vr_cre_236,vr_cre_237,vr_cre_238,vr_cre_239,vr_cre_240,vr_cre_241,vr_cre_242,vr_cre_243,vr_cre_244,vr_cre_245,vr_cre_246,vr_cre_247,vr_cre_248,vr_cre_249,vr_cre_250,vr_cre_251,vr_cre_252,vr_cre_253,vr_cre_254,vr_cre_255,vr_cre_256,vr_cre_257,vr_cre_258,vr_cre_259,vr_cre_260,vr_cre_261,vr_cre_262,vr_cre_263,vr_cre_264,vr_cre_265,vr_cre_266,vr_cre_267,vr_cre_268,vr_cre_269,vr_cre_270,vr_cre_271,vr_cre_272,vr_cre_273,vr_cre_274,vr_cre_275,vr_cre_276,vr_cre_277,vr_cre_278,vr_cre_279,vr_cre_280,vr_cre_281,vr_cre_282,vr_cre_283,vr_cre_284,vr_cre_285,vr_cre_286,vr_cre_287,vr_cre_288,vr_cre_289,vr_cre_290,vr_cre_291,vr_cre_292,vr_cre_293,vr_cre_294,vr_cre_295,vr_cre_296,vr_cre_297,vr_cre_298,vr_cre_299,vr_cre_300,

										cheque1,cheque2,cheque3,cheque4,cheque5,cheque6,cheque7,cheque8,cheque9,cheque10,cheque11,cheque12,cheque13,cheque14,cheque15,cheque16,cheque17,cheque18,
cheque19,cheque20,cheque21,cheque22,cheque23,cheque24,cheque25,cheque26,cheque27,cheque28,cheque29,cheque30,cheque31,cheque32,cheque33,cheque34,cheque35,cheque36,cheque37,cheque38,cheque39,cheque40,cheque41,cheque42,cheque43,cheque44,cheque45,cheque46,cheque47,cheque48,cheque49,cheque50,cheque51,cheque52,cheque53,cheque54,cheque55,cheque56,cheque57,cheque58,cheque59,cheque60,cheque61,cheque62,cheque63,cheque64,cheque65,cheque66,cheque67,cheque68,cheque69,cheque70,cheque71,cheque72,cheque73,cheque74,cheque75,cheque76,cheque77,cheque78,cheque79,cheque80,cheque81,cheque82,cheque83,cheque84,cheque85,cheque86,cheque87,cheque88,cheque89,cheque90,cheque91,cheque92,cheque93,cheque94,cheque95,cheque96,cheque97,cheque98,cheque99,cheque100,cheque101,cheque102,cheque103,cheque104,cheque105,cheque106,cheque107,cheque108,cheque109,cheque110,cheque111,cheque112,cheque113,cheque114,cheque115,cheque116,cheque117,cheque118,cheque119,cheque120,cheque121,cheque122,cheque123,cheque124,cheque125,cheque126,cheque127,cheque128,cheque129,cheque130,cheque131,cheque132,cheque133,cheque134,cheque135,cheque136,cheque137,cheque138,cheque139,cheque140,cheque141,cheque142,cheque143,cheque144,cheque145,cheque146,cheque147,cheque148,cheque149,cheque150,cheque151,cheque152,cheque153,cheque154,cheque155,cheque156,cheque157,cheque158,cheque159,cheque160,cheque161,cheque162,cheque163,cheque164,cheque165,cheque166,cheque167,cheque168,cheque169,cheque170,cheque171,cheque172,cheque173,cheque174,cheque175,cheque176,cheque177,cheque178,cheque179,cheque180,cheque181,cheque182,cheque183,cheque184,cheque185,cheque186,cheque187,cheque188,cheque189,cheque190,cheque191,cheque192,cheque193,cheque194,cheque195,cheque196,cheque197,cheque198,cheque199,cheque200,cheque201,cheque202,cheque203,cheque204,cheque205,cheque206,cheque207,cheque208,cheque209,cheque210,cheque211,cheque212,cheque213,cheque214,cheque215,cheque216,cheque217,cheque218,cheque219,cheque220,cheque221,cheque222,cheque223,cheque224,cheque225,cheque226,cheque227,cheque228,cheque229,cheque230,cheque231,cheque232,cheque233,cheque234,cheque235,cheque236,cheque237,cheque238,cheque239,cheque240,cheque241,cheque242,cheque243,cheque244,cheque245,cheque246,cheque247,cheque248,cheque249,cheque250,cheque251,cheque252,cheque253,cheque254,cheque255,cheque256,cheque257,cheque258,cheque259,cheque260,cheque261,cheque262,cheque263,cheque264,cheque265,cheque266,cheque267,cheque268,cheque269,cheque270,cheque271,cheque272,cheque273,cheque274,cheque275,cheque276,cheque277,cheque278,cheque279,cheque280,cheque281,cheque282,cheque283,cheque284,cheque285,cheque286,cheque287,cheque288,cheque289,cheque290,cheque291,cheque292,cheque293,cheque294,cheque295,cheque296,cheque297,cheque298,cheque299,cheque300,


 									tot_deb , tot_cre ,id_unico_reip, cuenta, nombre, vr_orig_reip, vr_digitado, ter_nat, ter_jur, id_manu_rcgt,
										conta_1,conta_2,conta_3,conta_4,conta_5,conta_6,conta_7,conta_8,conta_9,press_1,press_2,press_3,press_4,press_5,press_6,press_7,press_8,press_9,ter
									
										) VALUES ( 
													
										'$id_emp' , '$id_reip' , '$id_caic' , '$id_recau' , '$fecha_recaudo' , '$des_recaudo' ,'$tercero' ,
										'$pgcp1' , '$pgcp2' , '$pgcp3' , '$pgcp4' , '$pgcp5' , '$pgcp6' , '$pgcp7' , '$pgcp8' , '$pgcp9' , '$pgcp10' , '$pgcp11' , '$pgcp12' , '$pgcp13' , '$pgcp14' , '$pgcp15' , 
										'$pgcp16','$pgcp17','$pgcp18','$pgcp19','$pgcp20','$pgcp21','$pgcp22','$pgcp23','$pgcp24','$pgcp25','$pgcp26','$pgcp27','$pgcp28','$pgcp29','$pgcp30','$pgcp31','$pgcp32','$pgcp33','$pgcp34','$pgcp35','$pgcp36','$pgcp37','$pgcp38','$pgcp39','$pgcp40','$pgcp41','$pgcp42','$pgcp43','$pgcp44','$pgcp45','$pgcp46','$pgcp47','$pgcp48','$pgcp49','$pgcp50','$pgcp51','$pgcp52','$pgcp53','$pgcp54','$pgcp55','$pgcp56','$pgcp57','$pgcp58','$pgcp59','$pgcp60','$pgcp61','$pgcp62','$pgcp63','$pgcp64','$pgcp65','$pgcp66','$pgcp67','$pgcp68','$pgcp69','$pgcp70','$pgcp71','$pgcp72','$pgcp73','$pgcp74','$pgcp75','$pgcp76','$pgcp77','$pgcp78','$pgcp79','$pgcp80','$pgcp81','$pgcp82','$pgcp83','$pgcp84','$pgcp85','$pgcp86','$pgcp87','$pgcp88','$pgcp89','$pgcp90','$pgcp91','$pgcp92','$pgcp93','$pgcp94','$pgcp95','$pgcp96','$pgcp97','$pgcp98','$pgcp99','$pgcp100','$pgcp101','$pgcp102','$pgcp103','$pgcp104','$pgcp105','$pgcp106','$pgcp107','$pgcp108','$pgcp109','$pgcp110','$pgcp111','$pgcp112','$pgcp113','$pgcp114','$pgcp115','$pgcp116','$pgcp117','$pgcp118','$pgcp119','$pgcp120','$pgcp121','$pgcp122','$pgcp123','$pgcp124','$pgcp125','$pgcp126','$pgcp127','$pgcp128','$pgcp129','$pgcp130','$pgcp131','$pgcp132','$pgcp133','$pgcp134','$pgcp135','$pgcp136','$pgcp137','$pgcp138','$pgcp139','$pgcp140','$pgcp141','$pgcp142','$pgcp143','$pgcp144','$pgcp145','$pgcp146','$pgcp147','$pgcp148','$pgcp149','$pgcp150','$pgcp151','$pgcp152','$pgcp153','$pgcp154','$pgcp155','$pgcp156','$pgcp157','$pgcp158','$pgcp159','$pgcp160','$pgcp161','$pgcp162','$pgcp163','$pgcp164','$pgcp165','$pgcp166','$pgcp167','$pgcp168','$pgcp169','$pgcp170','$pgcp171','$pgcp172','$pgcp173','$pgcp174','$pgcp175','$pgcp176','$pgcp177','$pgcp178','$pgcp179','$pgcp180','$pgcp181','$pgcp182','$pgcp183','$pgcp184','$pgcp185','$pgcp186','$pgcp187','$pgcp188','$pgcp189','$pgcp190','$pgcp191','$pgcp192','$pgcp193','$pgcp194','$pgcp195','$pgcp196','$pgcp197','$pgcp198','$pgcp199','$pgcp200','$pgcp201','$pgcp202','$pgcp203','$pgcp204','$pgcp205','$pgcp206','$pgcp207','$pgcp208','$pgcp209','$pgcp210','$pgcp211','$pgcp212','$pgcp213','$pgcp214','$pgcp215','$pgcp216','$pgcp217','$pgcp218','$pgcp219','$pgcp220','$pgcp221','$pgcp222','$pgcp223','$pgcp224','$pgcp225','$pgcp226','$pgcp227','$pgcp228','$pgcp229','$pgcp230','$pgcp231','$pgcp232','$pgcp233','$pgcp234','$pgcp235','$pgcp236','$pgcp237','$pgcp238','$pgcp239','$pgcp240','$pgcp241','$pgcp242','$pgcp243','$pgcp244','$pgcp245','$pgcp246','$pgcp247','$pgcp248','$pgcp249','$pgcp250','$pgcp251','$pgcp252','$pgcp253','$pgcp254','$pgcp255','$pgcp256','$pgcp257','$pgcp258','$pgcp259','$pgcp260','$pgcp261','$pgcp262','$pgcp263','$pgcp264','$pgcp265','$pgcp266','$pgcp267','$pgcp268','$pgcp269','$pgcp270','$pgcp271','$pgcp272','$pgcp273','$pgcp274','$pgcp275','$pgcp276','$pgcp277','$pgcp278','$pgcp279','$pgcp280','$pgcp281','$pgcp282','$pgcp283','$pgcp284','$pgcp285','$pgcp286','$pgcp287','$pgcp288','$pgcp289','$pgcp290','$pgcp291','$pgcp292','$pgcp293','$pgcp294','$pgcp295','$pgcp296','$pgcp297','$pgcp298','$pgcp299','$pgcp300',



										'$des1' , '$des2' , '$des3' , '$des4' , '$des5' , '$des6' , '$des7' , '$des8' , '$des9' , '$des10' , '$des11' , '$des12' , 
										'$des13' , 
										'$des14' , '$des15' , 
										'$vr_deb_1' , '$vr_deb_2' , '$vr_deb_3' , '$vr_deb_4' , '$vr_deb_5' , '$vr_deb_6' , '$vr_deb_7' , '$vr_deb_8' , '$vr_deb_9' , '$vr_deb_10' , '$vr_deb_11' , '$vr_deb_12' , '$vr_deb_13' , '$vr_deb_14' , '$vr_deb_15' ,
										'$vr_deb_16','$vr_deb_17','$vr_deb_18','$vr_deb_19','$vr_deb_20','$vr_deb_21','$vr_deb_22','$vr_deb_23','$vr_deb_24','$vr_deb_25','$vr_deb_26','$vr_deb_27','$vr_deb_28','$vr_deb_29','$vr_deb_30','$vr_deb_31','$vr_deb_32','$vr_deb_33','$vr_deb_34','$vr_deb_35','$vr_deb_36','$vr_deb_37','$vr_deb_38','$vr_deb_39','$vr_deb_40','$vr_deb_41','$vr_deb_42','$vr_deb_43','$vr_deb_44','$vr_deb_45','$vr_deb_46','$vr_deb_47','$vr_deb_48','$vr_deb_49','$vr_deb_50','$vr_deb_51','$vr_deb_52','$vr_deb_53','$vr_deb_54','$vr_deb_55','$vr_deb_56','$vr_deb_57','$vr_deb_58','$vr_deb_59','$vr_deb_60','$vr_deb_61','$vr_deb_62','$vr_deb_63','$vr_deb_64','$vr_deb_65','$vr_deb_66','$vr_deb_67','$vr_deb_68','$vr_deb_69','$vr_deb_70','$vr_deb_71','$vr_deb_72','$vr_deb_73','$vr_deb_74','$vr_deb_75','$vr_deb_76','$vr_deb_77','$vr_deb_78','$vr_deb_79','$vr_deb_80','$vr_deb_81','$vr_deb_82','$vr_deb_83','$vr_deb_84','$vr_deb_85','$vr_deb_86','$vr_deb_87','$vr_deb_88','$vr_deb_89','$vr_deb_90','$vr_deb_91','$vr_deb_92','$vr_deb_93','$vr_deb_94','$vr_deb_95','$vr_deb_96','$vr_deb_97','$vr_deb_98','$vr_deb_99','$vr_deb_100','$vr_deb_101','$vr_deb_102','$vr_deb_103','$vr_deb_104','$vr_deb_105','$vr_deb_106','$vr_deb_107','$vr_deb_108','$vr_deb_109','$vr_deb_110','$vr_deb_111','$vr_deb_112','$vr_deb_113','$vr_deb_114','$vr_deb_115','$vr_deb_116','$vr_deb_117','$vr_deb_118','$vr_deb_119','$vr_deb_120','$vr_deb_121','$vr_deb_122','$vr_deb_123','$vr_deb_124','$vr_deb_125','$vr_deb_126','$vr_deb_127','$vr_deb_128','$vr_deb_129','$vr_deb_130','$vr_deb_131','$vr_deb_132','$vr_deb_133','$vr_deb_134','$vr_deb_135','$vr_deb_136','$vr_deb_137','$vr_deb_138','$vr_deb_139','$vr_deb_140','$vr_deb_141','$vr_deb_142','$vr_deb_143','$vr_deb_144','$vr_deb_145','$vr_deb_146','$vr_deb_147','$vr_deb_148','$vr_deb_149','$vr_deb_150','$vr_deb_151','$vr_deb_152','$vr_deb_153','$vr_deb_154','$vr_deb_155','$vr_deb_156','$vr_deb_157','$vr_deb_158','$vr_deb_159','$vr_deb_160','$vr_deb_161','$vr_deb_162','$vr_deb_163','$vr_deb_164','$vr_deb_165','$vr_deb_166','$vr_deb_167','$vr_deb_168','$vr_deb_169','$vr_deb_170','$vr_deb_171','$vr_deb_172','$vr_deb_173','$vr_deb_174','$vr_deb_175','$vr_deb_176','$vr_deb_177','$vr_deb_178','$vr_deb_179','$vr_deb_180','$vr_deb_181','$vr_deb_182','$vr_deb_183','$vr_deb_184','$vr_deb_185','$vr_deb_186','$vr_deb_187','$vr_deb_188','$vr_deb_189','$vr_deb_190','$vr_deb_191','$vr_deb_192','$vr_deb_193','$vr_deb_194','$vr_deb_195','$vr_deb_196','$vr_deb_197','$vr_deb_198','$vr_deb_199','$vr_deb_200','$vr_deb_201','$vr_deb_202','$vr_deb_203','$vr_deb_204','$vr_deb_205','$vr_deb_206','$vr_deb_207','$vr_deb_208','$vr_deb_209','$vr_deb_210','$vr_deb_211','$vr_deb_212','$vr_deb_213','$vr_deb_214','$vr_deb_215','$vr_deb_216','$vr_deb_217','$vr_deb_218','$vr_deb_219','$vr_deb_220','$vr_deb_221','$vr_deb_222','$vr_deb_223','$vr_deb_224','$vr_deb_225','$vr_deb_226','$vr_deb_227','$vr_deb_228','$vr_deb_229','$vr_deb_230','$vr_deb_231','$vr_deb_232','$vr_deb_233','$vr_deb_234','$vr_deb_235','$vr_deb_236','$vr_deb_237','$vr_deb_238','$vr_deb_239','$vr_deb_240','$vr_deb_241','$vr_deb_242','$vr_deb_243','$vr_deb_244','$vr_deb_245','$vr_deb_246','$vr_deb_247','$vr_deb_248','$vr_deb_249','$vr_deb_250','$vr_deb_251','$vr_deb_252','$vr_deb_253','$vr_deb_254','$vr_deb_255','$vr_deb_256','$vr_deb_257','$vr_deb_258','$vr_deb_259','$vr_deb_260','$vr_deb_261','$vr_deb_262','$vr_deb_263','$vr_deb_264','$vr_deb_265','$vr_deb_266','$vr_deb_267','$vr_deb_268','$vr_deb_269','$vr_deb_270','$vr_deb_271','$vr_deb_272','$vr_deb_273','$vr_deb_274','$vr_deb_275','$vr_deb_276','$vr_deb_277','$vr_deb_278','$vr_deb_279','$vr_deb_280','$vr_deb_281','$vr_deb_282','$vr_deb_283','$vr_deb_284','$vr_deb_285','$vr_deb_286','$vr_deb_287','$vr_deb_288','$vr_deb_289','$vr_deb_290','$vr_deb_291','$vr_deb_292','$vr_deb_293','$vr_deb_294','$vr_deb_295','$vr_deb_296','$vr_deb_297','$vr_deb_298','$vr_deb_299','$vr_deb_300',

 
										'$vr_cre_1' , '$vr_cre_2' , '$vr_cre_3' , '$vr_cre_4', '$vr_cre_5' , '$vr_cre_6' , '$vr_cre_7' , '$vr_cre_8' , '$vr_cre_9' , 
										'$vr_cre_10' , '$vr_cre_11' , '$vr_cre_12' , '$vr_cre_13' , '$vr_cre_14' , '$vr_cre_15' , 
										'$vr_cre_16','$vr_cre_17','$vr_cre_18','$vr_cre_19','$vr_cre_20','$vr_cre_21','$vr_cre_22','$vr_cre_23','$vr_cre_24','$vr_cre_25','$vr_cre_26','$vr_cre_27','$vr_cre_28','$vr_cre_29','$vr_cre_30','$vr_cre_31','$vr_cre_32','$vr_cre_33','$vr_cre_34','$vr_cre_35','$vr_cre_36','$vr_cre_37','$vr_cre_38','$vr_cre_39','$vr_cre_40','$vr_cre_41','$vr_cre_42','$vr_cre_43','$vr_cre_44','$vr_cre_45','$vr_cre_46','$vr_cre_47','$vr_cre_48','$vr_cre_49','$vr_cre_50','$vr_cre_51','$vr_cre_52','$vr_cre_53','$vr_cre_54','$vr_cre_55','$vr_cre_56','$vr_cre_57','$vr_cre_58','$vr_cre_59','$vr_cre_60','$vr_cre_61','$vr_cre_62','$vr_cre_63','$vr_cre_64','$vr_cre_65','$vr_cre_66','$vr_cre_67','$vr_cre_68','$vr_cre_69','$vr_cre_70','$vr_cre_71','$vr_cre_72','$vr_cre_73','$vr_cre_74','$vr_cre_75','$vr_cre_76','$vr_cre_77','$vr_cre_78','$vr_cre_79','$vr_cre_80','$vr_cre_81','$vr_cre_82','$vr_cre_83','$vr_cre_84','$vr_cre_85','$vr_cre_86','$vr_cre_87','$vr_cre_88','$vr_cre_89','$vr_cre_90','$vr_cre_91','$vr_cre_92','$vr_cre_93','$vr_cre_94','$vr_cre_95','$vr_cre_96','$vr_cre_97','$vr_cre_98','$vr_cre_99','$vr_cre_100','$vr_cre_101','$vr_cre_102','$vr_cre_103','$vr_cre_104','$vr_cre_105','$vr_cre_106','$vr_cre_107','$vr_cre_108','$vr_cre_109','$vr_cre_110','$vr_cre_111','$vr_cre_112','$vr_cre_113','$vr_cre_114','$vr_cre_115','$vr_cre_116','$vr_cre_117','$vr_cre_118','$vr_cre_119','$vr_cre_120','$vr_cre_121','$vr_cre_122','$vr_cre_123','$vr_cre_124','$vr_cre_125','$vr_cre_126','$vr_cre_127','$vr_cre_128','$vr_cre_129','$vr_cre_130','$vr_cre_131','$vr_cre_132','$vr_cre_133','$vr_cre_134','$vr_cre_135','$vr_cre_136','$vr_cre_137','$vr_cre_138','$vr_cre_139','$vr_cre_140','$vr_cre_141','$vr_cre_142','$vr_cre_143','$vr_cre_144','$vr_cre_145','$vr_cre_146','$vr_cre_147','$vr_cre_148','$vr_cre_149','$vr_cre_150','$vr_cre_151','$vr_cre_152','$vr_cre_153','$vr_cre_154','$vr_cre_155','$vr_cre_156','$vr_cre_157','$vr_cre_158','$vr_cre_159','$vr_cre_160','$vr_cre_161','$vr_cre_162','$vr_cre_163','$vr_cre_164','$vr_cre_165','$vr_cre_166','$vr_cre_167','$vr_cre_168','$vr_cre_169','$vr_cre_170','$vr_cre_171','$vr_cre_172','$vr_cre_173','$vr_cre_174','$vr_cre_175','$vr_cre_176','$vr_cre_177','$vr_cre_178','$vr_cre_179','$vr_cre_180','$vr_cre_181','$vr_cre_182','$vr_cre_183','$vr_cre_184','$vr_cre_185','$vr_cre_186','$vr_cre_187','$vr_cre_188','$vr_cre_189','$vr_cre_190','$vr_cre_191','$vr_cre_192','$vr_cre_193','$vr_cre_194','$vr_cre_195','$vr_cre_196','$vr_cre_197','$vr_cre_198','$vr_cre_199','$vr_cre_200','$vr_cre_201','$vr_cre_202','$vr_cre_203','$vr_cre_204','$vr_cre_205','$vr_cre_206','$vr_cre_207','$vr_cre_208','$vr_cre_209','$vr_cre_210','$vr_cre_211','$vr_cre_212','$vr_cre_213','$vr_cre_214','$vr_cre_215','$vr_cre_216','$vr_cre_217','$vr_cre_218','$vr_cre_219','$vr_cre_220','$vr_cre_221','$vr_cre_222','$vr_cre_223','$vr_cre_224','$vr_cre_225','$vr_cre_226','$vr_cre_227','$vr_cre_228','$vr_cre_229','$vr_cre_230','$vr_cre_231','$vr_cre_232','$vr_cre_233','$vr_cre_234','$vr_cre_235','$vr_cre_236','$vr_cre_237','$vr_cre_238','$vr_cre_239','$vr_cre_240','$vr_cre_241','$vr_cre_242','$vr_cre_243','$vr_cre_244','$vr_cre_245','$vr_cre_246','$vr_cre_247','$vr_cre_248','$vr_cre_249','$vr_cre_250','$vr_cre_251','$vr_cre_252','$vr_cre_253','$vr_cre_254','$vr_cre_255','$vr_cre_256','$vr_cre_257','$vr_cre_258','$vr_cre_259','$vr_cre_260','$vr_cre_261','$vr_cre_262','$vr_cre_263','$vr_cre_264','$vr_cre_265','$vr_cre_266','$vr_cre_267','$vr_cre_268','$vr_cre_269','$vr_cre_270','$vr_cre_271','$vr_cre_272','$vr_cre_273','$vr_cre_274','$vr_cre_275','$vr_cre_276','$vr_cre_277','$vr_cre_278','$vr_cre_279','$vr_cre_280','$vr_cre_281','$vr_cre_282','$vr_cre_283','$vr_cre_284','$vr_cre_285','$vr_cre_286','$vr_cre_287','$vr_cre_288','$vr_cre_289','$vr_cre_290','$vr_cre_291','$vr_cre_292','$vr_cre_293','$vr_cre_294','$vr_cre_295','$vr_cre_296','$vr_cre_297','$vr_cre_298','$vr_cre_299','$vr_cre_300',				
					'$cheque1','$cheque2','$cheque3','$cheque4','$cheque5','$cheque6','$cheque7','$cheque8','$cheque9','$cheque10','$cheque11','$cheque12','$cheque13','$cheque14','$cheque15','$cheque16','$cheque17','$cheque18','$cheque19','$cheque20','$cheque21','$cheque22','$cheque23','$cheque24','$cheque25','$cheque26','$cheque27','$cheque28','$cheque29','$cheque30','$cheque31','$cheque32','$cheque33','$cheque34','$cheque35','$cheque36','$cheque37','$cheque38','$cheque39','$cheque40','$cheque41','$cheque42','$cheque43','$cheque44','$cheque45','$cheque46','$cheque47','$cheque48','$cheque49','$cheque50','$cheque51','$cheque52','$cheque53','$cheque54','$cheque55','$cheque56','$cheque57','$cheque58','$cheque59','$cheque60','$cheque61','$cheque62','$cheque63','$cheque64','$cheque65','$cheque66','$cheque67','$cheque68','$cheque69','$cheque70','$cheque71','$cheque72','$cheque73','$cheque74','$cheque75','$cheque76','$cheque77','$cheque78','$cheque79','$cheque80','$cheque81','$cheque82','$cheque83','$cheque84','$cheque85','$cheque86','$cheque87','$cheque88','$cheque89','$cheque90','$cheque91','$cheque92','$cheque93','$cheque94','$cheque95','$cheque96','$cheque97','$cheque98','$cheque99','$cheque100','$cheque101','$cheque102','$cheque103','$cheque104','$cheque105','$cheque106','$cheque107','$cheque108','$cheque109','$cheque110','$cheque111','$cheque112','$cheque113','$cheque114','$cheque115','$cheque116','$cheque117','$cheque118','$cheque119','$cheque120','$cheque121','$cheque122','$cheque123','$cheque124','$cheque125','$cheque126','$cheque127','$cheque128','$cheque129','$cheque130','$cheque131','$cheque132','$cheque133','$cheque134','$cheque135','$cheque136','$cheque137','$cheque138','$cheque139','$cheque140','$cheque141','$cheque142','$cheque143','$cheque144','$cheque145','$cheque146','$cheque147','$cheque148','$cheque149','$cheque150','$cheque151','$cheque152','$cheque153','$cheque154','$cheque155','$cheque156','$cheque157','$cheque158','$cheque159','$cheque160','$cheque161','$cheque162','$cheque163','$cheque164','$cheque165','$cheque166','$cheque167','$cheque168','$cheque169','$cheque170','$cheque171','$cheque172','$cheque173','$cheque174','$cheque175','$cheque176','$cheque177','$cheque178','$cheque179','$cheque180','$cheque181','$cheque182','$cheque183','$cheque184','$cheque185','$cheque186','$cheque187','$cheque188','$cheque189','$cheque190','$cheque191','$cheque192','$cheque193','$cheque194','$cheque195','$cheque196','$cheque197','$cheque198','$cheque199','$cheque200','$cheque201','$cheque202','$cheque203','$cheque204','$cheque205','$cheque206','$cheque207','$cheque208','$cheque209','$cheque210','$cheque211','$cheque212','$cheque213','$cheque214','$cheque215','$cheque216','$cheque217','$cheque218','$cheque219','$cheque220','$cheque221','$cheque222','$cheque223','$cheque224','$cheque225','$cheque226','$cheque227','$cheque228','$cheque229','$cheque230','$cheque231','$cheque232','$cheque233','$cheque234','$cheque235','$cheque236','$cheque237','$cheque238','$cheque239','$cheque240','$cheque241','$cheque242','$cheque243','$cheque244','$cheque245','$cheque246','$cheque247','$cheque248','$cheque249','$cheque250','$cheque251','$cheque252','$cheque253','$cheque254','$cheque255','$cheque256','$cheque257','$cheque258','$cheque259','$cheque260','$cheque261','$cheque262','$cheque263','$cheque264','$cheque265','$cheque266','$cheque267','$cheque268','$cheque269','$cheque270','$cheque271','$cheque272','$cheque273','$cheque274','$cheque275','$cheque276','$cheque277','$cheque278','$cheque279','$cheque280','$cheque281','$cheque282','$cheque283','$cheque284','$cheque285','$cheque286','$cheque287','$cheque288','$cheque289','$cheque290','$cheque291','$cheque292','$cheque293','$cheque294','$cheque295','$cheque296','$cheque297','$cheque298','$cheque299','$cheque300',

					'$tot_deb' , '$tot_cre' ,
										'$id' , '$cuenta' , '$nom_rubro' , '$vr_orig_reip' , '$valor' , '$ter_nat', '$ter_jur', '$id_manu_rcgt',
										'$conta_1','$conta_2','$conta_3','$conta_4','$conta_5','$conta_6','$conta_7','$conta_8','$conta_9','$press_1','$press_2','$press_3','$press_4','$press_5','$press_6','$press_7','$press_8','$press_9','$ter'
									
										)";
										mysql_query($sql, $connectionxx) or die(mysql_error());
				}// fin de ultimo registro			
										printf("<br><br><center class ='Estilo4'>REGISTRO INSERTADO CON EXITO</center><br /><br />");
																	
										
										
										//}
										
				}
					 
							
				

    }
		
}
}
//}

printf("

<center class='Estilo9'>
<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
<input type='hidden' name='nn' value='RIIP'>
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