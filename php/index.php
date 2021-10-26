<?php
include_once "config.php";

if (isset($_GET["uid"])) {
    $uid = $_GET["uid"];
    $seleceventssql = "SELECT * FROM `plan_rihardsl` WHERE uid='".$uid."'";

    $result = $connection->query($seleceventssql);
}

//$sql = "INSERT INTO events(title) VALUES ('sveiki')";
//$connection->query($sql);

if (isset($_POST["title"])) {
    $sql = "INSERT INTO plan_rihardsl(title,start_date,end_date,uid) VALUES ('".$_POST["title"]."','".$_POST["start_date"]."','".$_POST["end_date"]."','".$_POST["uid"]."')";
    $connection->query($sql);
    header("refresh: 0");
}

if ((isset($_POST["want_to_delete"])) && ($_POST["want_to_delete"] == "true")) {
    $sql = "DELETE FROM `plan_rihardsl` WHERE id=".$_POST["id"];
    $connection->query($sql);
    header("refresh: 0");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lāča kalendārs</title>
    <link rel="stylesheet" href="css/index.css">

    <!-- Calendar start -->
    <link href='libraries/fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='libraries/fullcalendar/lib/main.js'></script>
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
                    <form method='POST' action='https://dsp.tools/planotajs/RihardsL/index.php?uid=".$uid."'>
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
            <form method="POST" action="https://dsp.tools/planotajs/RihardsL/index.php?uid=<?php echo $uid;?>">
                <label for="name">Title:</label>
                <input name="title" type="text"><br>
                <label for="start_date">Start date:</label>
                <input name="start_date" type="date"><br>
                <label for="end_date">End date:</label>
                <input name="end_date" type="date"><br>
                <input hidden name="uid" type="text" value="<?php echo $uid;?>">
                <input id="submitbutton" type="submit" value="Submit">
            </form>
            <p>Dalies ar draugiem: <a href="https://dsp.tools/planotajs/RihardsL/index.php?uid=<?php echo $uid;?>">dsp.tools/planotajs/RihardsL/index.php?uid=<?php echo $uid;?></a></p>
        </div>

    </div>
</div>

</body>
</html>
