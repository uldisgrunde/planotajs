<?php
include_once "config_lacis.php";

if (isset($_GET["uid"])) {
    $uid = $_GET["uid"];
    $seleceventssql = "SELECT * FROM `plan_rihardsl` WHERE uid='".$uid."'";

    $result = $connection->query($seleceventssql);
} else {
    $uid = uniqid("uid");
}


if (isset($_POST["title"])) {
    $sql = "INSERT INTO plan_rihardsl(title,start_date,end_date,uid) VALUES ('".mysqli_real_escape_string($connection, htmlspecialchars($_POST["title"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["start_date"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["end_date"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["uid"], ENT_QUOTES))."')";

    header("Location: rihardsl.php?uid=".$uid);
}

if ((isset($_POST["want_to_delete"])) && ($_POST["want_to_delete"] == "true")) {
    $sql = "DELETE FROM `plan_rihardsl` WHERE id=".mysqli_real_escape_string($connection, htmlspecialchars($_POST["id"], ENT_QUOTES));
    $connection->query($sql);
    header("Location: rihardsl.php?uid=".$uid);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lāča kalendārs</title>
    <link rel="stylesheet" href="./css/rihardsl_style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    <!-- Calendar start -->
    <link href='./libraries/fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='./libraries/fullcalendar/lib/main.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'UTC+3',
                locale: 'lv',
                eventColor: '#378006',
                firstDay: 1,
                events: [
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo"
                            {
                            title: '".$row["title"]."',
                            start: '".$row["start_date"]."',
                            end: '".$row["end_date"]."'
                            },
                            ";
                        }
                    }
                    ?>
                ]
            });
            calendar.render();
        });
    </script>
    <!-- Calendar end -->

</head>

<body>

<div class="scrolldiv">

    <?php
    $result = $connection->query($seleceventssql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo"
            
            <div class='item'>
                <label for='".$row["title"]."'>".$row["start_date"]." - ".$row["end_date"]."</label>
                <div class='iteminfo'>
                    <span name='".$row["title"]."'>".$row["title"]."</span>
                    <form method='POST' action='https://dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=".$uid."'>
                        <input hidden name='id' type='number' value='".$row["id"]."'>
                        <input hidden name='want_to_delete' type='text' value='true'>
                        <input id='deletesubmit' type='submit' value='X'>
                    </form>
                </div>
            </div>
            
            ";
        }
    }
    ?>

</div>

<div class="flex1">
    <div class="flex2">
        <div id='calendar'></div>

        <div class="epicform">
            <form method="POST" action="https://dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=<?php echo $uid;?>">
                <label for="name">Title:</label>
                <input name="title" type="text"><br>
                <label for="start_date">Start date:</label>
                <input name="start_date" type="date"><br>
                <label for="end_date">End date:</label>
                <input name="end_date" type="date"><br>
                <input hidden name="uid" type="text" value="<?php echo $uid;?>">
                <input id="submitbutton" type="submit" value="Submit">
            </form>
            <p>Dalies ar draugiem: <a href="https://dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=<?php echo $uid;?>">dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=<?php echo $uid;?></a></p>
        </div>

    </div>
</div>

</body>
</html>
