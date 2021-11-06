<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
//header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_GET['uid'])){
	$uid=$_GET['uid'];
	$sql="SELECT
	* 
FROM 
	plan_rihardsl 
WHERE 
	start_date>=CURDATE() AND 
	uid='$uid' 
ORDER BY
	START_date, 
	end_date";
}
elseif(isset($_GET['p'])){
	$sql="SELECT DISTINCT 
		uid 
	from 
		plan_rihardsl 
	order by 
		uid";
}
else{
	$sql="SELECT
	* 
FROM 
	plan_rihardsl 
ORDER BY
	START_date, 
	end_date,
	uid";
}
?>