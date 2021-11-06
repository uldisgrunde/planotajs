<?php
$alert="";
if(isset($_GET['alert'])){
	$alert=$_GET['alert'];
}
if(isset($_POST['alert'])){
	$alert=$_POST['alert'];
}
?>
<html lang="lv">
<head>
    <meta charset="UTF-8">
	<meta name="Author" content="Davis Ozols">
    <title>Aktivitates</title>
    <link rel="stylesheet" href="./../css/style_davis.css">
</head>
<body>

<div class="container">
<p class="alert"><?php echo $alert;?></p>
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