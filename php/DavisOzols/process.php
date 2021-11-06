<?php
//include_once './aktivitates.php';
$servername='auth-db150.hostinger.com';
$username='u353443769_beis';
$dbname = 'u353443769_beis';
$password="testadmin";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}
if(isset($_POST['save']))
{
    $nosaukums = $_POST['nosaukums'];
    $darbiba = $_POST['darbiba'];
    $sakums = $_POST['sakums'];
    $beigas = $_POST['beigas'];
    $sql = "INSERT INTO plan_davis (nosaukums, aktivitate, start_date, end_date)
	 VALUES ('$nosaukums','$darbiba', '$sakums', '$beigas')";
    if (mysqli_query($conn, $sql)) {
        $alert= "Dati ievietoti veiksmīgi !";
    } else {
        $alert= "Error: " . $sql . "
" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
header("Location: aktivitates.php?alert=$alert")
//$host = "dsp.tools";
//$path = "/planotajs/DavisOzols/php/aktivitates.php";
//$data = urlencode("alert=$alert");

//header("POST $path HTTP/1.1\r" );
//header("Host: $host\r" );
//header("Content-type: application/x-www-form-urlencoded\r" );
//header("Content-length: " . strlen($data) . "\r" );
//header("Connection: close\r\r" );
//header($data);
?>