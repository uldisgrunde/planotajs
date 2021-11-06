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
$sql = "select * from plan_davis";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

$emparray = array();
while($row =mysqli_fetch_assoc($result))
{
    $emparray[] = $row;
}
echo json_encode($emparray);

$fp = fopen('empdata.json', 'w');
fwrite($fp, json_encode($emparray));
fclose($fp);

$file = 'file1.json';
file_put_contents($file, json_encode($emparray));
header("Content-type: application/json");
header('Content-Disposition: attachment; filename="'.basename($file).'"');
header('Content-Length: ' . filesize($file));
readfile($file);
?>