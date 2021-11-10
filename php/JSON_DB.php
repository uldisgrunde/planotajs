<?php

$db_host = "auth-db150.hostinger.com";
$db_name = "u353443769_beis";
$db_user = "u353443769_beis";
$db_pass = "testadmin";

$conn = new mysqli($db_host,$db_user,$db_pass,$db_name);

// Check connection
if ($conn -> connect_error) {
    echo "Failed to connect to MySQL: " . $connection -> connect_error;
}
$filename = "bestJSON.json";

$data = file_get_contents($filename);

$array = json_decode($data, true);

if (isset($_POST['submit'])) {
    foreach($array as $row) {
    $sql = "INSERT IGNORE INTO plan_diana(title, startdate, enddate) VALUES('".$row["Title"]."', '".$row["Start-date"]."', '".$row["End-date"]."')";
      
    mysqli_query($conn, $sql);
    }
}

$sql = "SELECT * FROM plan_diana";
$result = mysqli_query($conn, $sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result)) {
    $json_array[] = $row;   
}

echo json_encode($json_array);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="submit" name="submit" value="Send to DB">
    </form>
</body>
</html>
