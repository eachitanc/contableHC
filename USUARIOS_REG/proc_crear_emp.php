<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>
<?php
   include('config.php');				
   $connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
   
 
   $raz_soc=$_POST['raz_soc'];    
   $nit=$_POST['nit'];    
   $dv=$_POST['dv']; 
   $cod_ins=$_POST['cod_ins'];    
   $cod_cgn=$_POST['cod_cgn'];    
   $cod_dep=$_POST['cod_dep'];    
   $cod_mpio=$_POST['cod_mpio']; 
   $dir=$_POST['dir'];    
   $tel=$_POST['tel'];    
   $fax=$_POST['fax'];    
   $email=$_POST['email']; 
   $web_site=$_POST['web_site'];    
   $uni_eje=$_POST['uni_eje'];    
   $nom_rep_leg=$_POST['nom_rep_leg'];    
   $ced_rep_leg=$_POST['ced_rep_leg']; 
   $tp_rep_leg=$_POST['tp_rep_leg'];    
   $nom_cont=$_POST['nom_cont'];    
   $ced_cont=$_POST['ced_cont'];    
   $tp_cont=$_POST['tp_cont']; 
   $nom_rev_fis=$_POST['nom_rev_fis'];    
   $ced_rev_fis=$_POST['ced_rev_fis'];    
   $tp_rev_fis=$_POST['tp_rev_fis'];    
   $nom_ctrl_int=$_POST['nom_ctrl_int']; 
   $ced_ctrl_int=$_POST['ced_ctrl_int'];
   $tp_ctrl_int=$_POST['tp_ctrl_int'];    
   $nom_jefe_ppto=$_POST['nom_jefe_ppto'];    
   $ced_jefe_ppto=$_POST['ced_jefe_ppto']; 
   $tp_jefe_ppto=$_POST['tp_jefe_ppto'];    
   $otr_resp=$_POST['otr_resp'];    
   $nom_otr_resp=$_POST['nom_otr_resp'];    
   $ced_otr_resp=$_POST['ced_otr_resp']; 
   $tp_otr_resp=$_POST['tp_otr_resp'];    
   $ano=date("Y/m/d"); 
   $fut=$_POST['fut'];
   $cgr=$_POST['cgr']; 
   $otra_uni_eje=$_POST['otra_uni_eje']; 
   $tipo_entidad=$_POST['tipo_entidad'];
   $regional=$_POST['regional'];
   

$sql = "INSERT INTO empresa ( raz_soc , nit , dv , cod_ins , cod_cgn , cod_dep , cod_mpio , dir , tel , fax , email , web_site , uni_eje , nom_rep_leg , ced_rep_leg , tp_rep_leg , nom_cont , ced_cont , tp_cont , nom_rev_fis , ced_rev_fis , tp_rev_fis , nom_ctrl_int , ced_ctrl_int , tp_ctrl_int , nom_jefe_ppto , ced_jefe_ppto , tp_jefe_ppto , otr_resp , nom_otr_resp , ced_otr_resp , tp_otr_resp , dia , mes , ano , fut , cgr, otra_uni_eje, tipo_entidad, regional ) VALUES ( '$raz_soc', '$nit', '$dv', '$cod_ins', '$cod_cgn', '$cod_dep', '$cod_mpio', '$dir', '$tel', '$fax', '$email', '$web_site', '$uni_eje', '$nom_rep_leg', '$ced_rep_leg', '$tp_rep_leg', '$nom_cont', '$ced_cont', '$tp_cont', '$nom_rev_fis', '$ced_rev_fis', '$tp_rev_fis', '$nom_ctrl_int', '$ced_ctrl_int', '$tp_ctrl_int', '$nom_jefe_ppto', '$ced_jefe_ppto', '$tp_jefe_ppto', '$otr_resp', '$nom_otr_resp', '$ced_otr_resp', '$tp_otr_resp', '$dia', '$mes', '$ano', '$fut', '$cgr', '$otra_uni_eje', '$tipo_entidad', '$regional')";

$resultado = mysql_db_query($database, $sql, $connection);

   header("Location: crear_empresa.php");
?>
<?
}
?>