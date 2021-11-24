<?
set_time_limit(600);
require_once("excel.php"); 
require_once("excel-ext.php"); 
include("../config.php");

$conEmp = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $conEmp);
$queEmp = "SELECT
    d
    , nivel
    , cuenta
    , nombre
    , inicial
    , debito
    , credito
    , saldo
    , corriente
    , no_corriente
FROM
    tesoreria_aldana.aux_contaduria_gral_may
WHERE (inicial + debito + credito + saldo<>0);";
$resEmp = mysql_query($queEmp, $conEmp) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

while($datatmp = mysql_fetch_assoc($resEmp)) 
{ 
	$data[] = $datatmp; 
}  
createExcel("aux_cgn.xls", $data);
exit;
?>