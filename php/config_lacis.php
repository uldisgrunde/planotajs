<?php
$db_host = "auth-db150.hostinger.com";
$db_name = "u353443769_beis";
$db_user = "u353443769_beis";
$db_pass = "testadmin";

$connection = new mysqli($db_host,$db_user,$db_pass,$db_name);

// Check connection
if ($connection -> connect_error) {
    echo "Failed to connect to MySQL: " . $connection -> connect_error;
}

?>