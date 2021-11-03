<html lang="lv">
<?php
$servername='auth-db150.hostinger.com';
$username='u353443769_beis';
$dbname = 'u353443769_beis';
$password="testadmin";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}
?>
<head>
    <meta charset="UTF-8">
    <title>Aktivitates</title>
    <link rel="stylesheet" href="./../css/style.css">
</head>
<?php
include 'process.php';
// mysql apstrade
?>
<body>
<div class="container">
    <form method="post" action="./process.php">
        <p>
            <label for="nosaukums">Nosaukums:</label>
            <input type="text" name="nosaukums">
        </p>
        <p>
            <label for="darbiba">Darbiba:</label>
            <input type="text" name="darbiba">
        </p>

    <label for="sakums">Start date:</label>
    <input class="input-date" type="date" name="sakums"
           value="YYYY-MM-DD"
           min="2021-10-26" max="2022-12-31">

    <label for="beigas">End date:</label>
    <input class="input-date" type="date" name="beigas"
           value="YYYY-MM-DD"
           min="2021-10-26" max="2022-12-31">
</div>
<div style="text-align:center;">
    <input type="submit" name="save" value="Iesniegt">
</div>
</body>
</html>