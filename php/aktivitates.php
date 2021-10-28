<!DOCTYPE html>
<html lang="lv">
<?php include 'connect.php';
?>
<head>
    <meta charset="UTF-8">
    <title>Aktivitates</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="container">
    <form action="aktivitates.html" id="aktform">
        Nosaukums <input type="text" name="name">
        <input type="submit">
    </form>
    <br>
    <textarea rows="4" cols="50" name="comment" form="aktform">
Ievadiet aktivitati</textarea>

    <label for="start">Start date:</label>
    <input class="input-date" type="date" id="start" name="akt-sakums"
           value="YYYY-MM-DD"
           min="2021-10-26" max="2022-12-31">

    <label for="beigas">End date:</label>
    <input class="input-date" type="date" id="beigas" name="akt-beigas"
           value="YYYY-MM-DD"
           min="2021-10-26" max="2022-12-31">
</div>
</body>
</html>