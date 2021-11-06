<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET['uid'])){
$uid=$_GET['uid'];
$sql="Select * from plan_markuss where uID='$uid'";
}
else{
$sql="Select * from plan_markuss";
}
?>