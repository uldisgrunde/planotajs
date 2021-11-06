<?php
$servername='auth-db150.hostinger.com';
$username='u353443769_beis';
$dbname = 'u353443769_beis';
$password="testadmin";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}
if(isset($_POST['save'])){
    $sql = "INSERT INTO 
	plan_davis (
		nosaukums, 
		aktivitate, 
		start_date, 
		end_date
	)
	 VALUES (
		 '".$_POST['nosaukums']."',
		 '".$_POST['darbiba']."', 
		 '".$_POST['sakums']."', 
		 '".$_POST['beigas']."'
	 )";
    if (mysqli_query($conn, $sql)) {
        $alert= "Dati ievietoti veiksmīgi !";
    } else {
        $alert= "Error: " . $sql . " " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
header("Location: aktivitates.php?alert=$alert")
?>