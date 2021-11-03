<?php if (isset($_GET["uid"])) {
    $sql = "SELECT * FROM `plan_rihardsl` WHERE uid='".$uid."'";
    $result = $connection->query($seleceventssql);
} else {
    $uid = uniqid("uid");
}


//add sql
    $sql = "INSERT INTO plan_rihardsl(title,start_date,end_date,uid) VALUES ('".mysqli_real_escape_string($connection, htmlspecialchars($_POST["title"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["start_date"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["end_date"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["uid"], ENT_QUOTES))."')";


    if (!$connection->query($sql)) {
        alert("Kaut kas nesagaja!");
    }


// delete sql
$sql = "DELETE FROM `plan_rihardsl` WHERE id=".mysqli_real_escape_string($connection, htmlspecialchars($_POST["id"], ENT_QUOTES));

?>


