<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("./inc/conn.inc");
$sql="";
$outp =array();
$repo = new stdClass();
if(isset($_GET["q"]) ){
	include_once("./srv/".trim($_GET["q"]).".inc");
	//echo $sql."\n";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	echo '{ "records":'.json_encode($outp)."}";
}

	if(isset($_GET["i"]) ){
		include_once("./srv/".trim($_GET["i"]).".inc");
		echo $sql;
		$stmt = $conn->prepare($sql);
		if ($stmt->execute()){
			$repo->alert="Dati saglabāti!";
		}else{
			$repo->alert="Dati netika saglabāti!".$sql;
		}
		$outp=$repo;
	}

	?>
