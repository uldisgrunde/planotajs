<?php
//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Headers: *");
$data = json_decode(file_get_contents("php://input"),true);
$sql="insert into 
	plan_rihardsl(
	title,
	start_date,
	end_date,
	uid
) values(
	'".$data["title"]."',
	'".$data["start_date"]."',
	'".$data["end_date"]."',
	'".$data["uid"]."'
)";
?>

