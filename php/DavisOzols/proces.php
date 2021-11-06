<?php
include_once './../../inc/db.inc';
if(isset($_POST['save']))
{
    $nosaukums = $_POST['nosaukums'];
    $darbiba = $_POST['darbiba'];
    $sakums = $_POST['sakums'];
    $beigas = $_POST['beigas'];
    $sql = "INSERT INTO 
	plan_davis (
		nosaukums, 
		aktivitate, 
		start_date, 
		end_date
	) VALUES (
		'$nosaukums',
		'$darbiba', 
		'$sakums', 
		'$beigas'
	)";
    if (mysqli_query($conn, $sql)) {
        echo "Dati ievietoti veiksmīgi !";
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($conn);
    }
    mysqli_close($conn);
	header("Location: ./../../html/aktivitates.html?alert=$alert");

}
?>