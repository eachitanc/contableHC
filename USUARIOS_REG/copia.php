

<?php
    $toDay = date('d-m-Y');
    $dbhost =   "localhost";
    $dbuser =   "root";
    $dbpass =   "12345";
    $dbname =   "bd_esepotosi2013";

    exec("mysqldump --user=$dbuser --password='$dbpass' --host=$dbhost $dbname > /home/....../public_html/".$toDay."esta_DB.sql");


?>

