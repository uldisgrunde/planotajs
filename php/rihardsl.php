<?php
include_once "config_lacis.php"; // Iekopē config failu iekš šī faila, lai var lietot mysql savienojumu.

if (isset($_GET["uid"])) { // Pārbauda vai ir unique id uzsetots. Tam būtu jāatnāk caur GET uz lapu.
    $uid = $_GET["uid"];
    $seleceventssql = "SELECT * FROM `plan_rihardsl` WHERE uid='".$uid."'"; // Ja ir, tad izņem visus datus priekš tā kalendāra.

    $result = $connection->query($seleceventssql);
} else {
    $uid = uniqid("uid"); // Ja nav, tad uzģenerē jaunu unikālo id priekš jaunā kalendāra.
}


if (isset($_POST["title"])) {  // Pārbauda vai lietotājs centās ievietot kaut ko kalendārā, tas tiek veikts skatoties vai ir caur POST metodi uzsetots kaut kas iekš "title".
    $sql = "INSERT INTO plan_rihardsl(title,start_date,end_date,uid) VALUES ('".mysqli_real_escape_string($connection, htmlspecialchars($_POST["title"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["start_date"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["end_date"], ENT_QUOTES))."'
    ,'".mysqli_real_escape_string($connection, htmlspecialchars($_POST["uid"], ENT_QUOTES))."')";
    $connection->query($sql); // Izveido drošu MYSQL pieprasījum un tad nosūta to uz datubāzi.

    header("Location: rihardsl.php?uid=".$uid); // Atsvaidzina lapu automātiski, ievietojot tajā iepriekš izveidoto (vai jau eksistējošo) unikālo id.
}

if ((isset($_POST["want_to_delete"])) && ($_POST["want_to_delete"] == "true")) { // Pārbauda vai ir uzspiesta dzēšanas poga kāddiem no pasākumiem. To dara caur POST metodi.
    $sql = "DELETE FROM `plan_rihardsl` WHERE id=".mysqli_real_escape_string($connection, htmlspecialchars($_POST["id"], ENT_QUOTES));
    $connection->query($sql); // Ja lietotājs patiešām vēlējās kaut ko izdzēst tad šeit tiek aizsūtīts pieprasījums, kurā idzēsts izvēlētais pasākums.
    header("Location: rihardsl.php?uid=".$uid); // Atsvaidzina lapu, lai redzētu izmaiņas. Tādēļ, ka lapa jau ir bijusi ielādētā, šis lapas atsvaidzinājums notiek ļoti ātri.
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lāča kalendārs</title>
    <link rel="stylesheet" href="../css/rihardsl_style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Importējam google fontiem nepieciešamo un tad vienu fontu "Lato 300" -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    <!-- Calendar start -->
    <link href='../libraries/fullcalendar/lib/main.css' rel='stylesheet' /> <!-- Ievietojam šeit iekšā galvenos divus failus priekš kalendāra bibliotēkas -->
    <script src='../libraries/fullcalendar/lib/main.js'></script>
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
                    if ($result->num_rows > 0) { // Šeit tiek apstrādāti rezultāti no iepriekš veiktā mysql pieprasījuma. Šeit kaut kas tiek apstrādāts tikai tad, ja iepriekš bija unikāls id nākot uz lapu.
                        while($row = $result->fetch_assoc()) {
                            echo"
                            {
                            title: '".$row["title"]."',
                            start: '".$row["start_date"]."',
                            end: '".$row["end_date"]."'
                            },
                            "; // Ievietojas iekšā pasākums ar tā nosaukumu, sākuma datuma un beigu datuma.
                        }
                    }
                    ?>
                ]
            });
            calendar.render(); <!-- Kalendārs tiek izvadīts. -->
        });
    </script>
    <!-- Calendar end -->

</head>

<body>

<div class="scrolldiv"> <!-- Divs, kurā tiks, saraksta formā, parādīti visi nosaukumi. Vieglāks veids, kā tos parādīt nekā modificēt kalendāra bibliotēku. -->

    <?php
    $result = $connection->query($seleceventssql); // Nosūta iepriekš-izveidoto pieprasījumu, lai satvertu info par pasākumiem.

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { // Apstrādā pieprasījumu, lai spētu to viegli izvadīt.
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
            
            "; // Katram pasākumam tiek izveidots jauns divs ar klasi "item", tādejādi, sakārtojoties skaisti iekš vecāku diva.
        }
    }
    ?>

</div>

<div class="flex1">
    <div class="flex2">
        <div id='calendar'></div> <!-- Tiek izveidota forma priekš jaunu pasākumu ievadīšanas. -->

        <div class="epicform">
            <form method="POST" action="https://dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=<?php echo $uid;?>"> <!-- Automātiski tiek ievietots Unikālais ID, lai var datubāzē ievietot pareizi. -->
                <label for="name">Title:</label>
                <input name="title" type="text"><br>
                <label for="start_date">Start date:</label>
                <input name="start_date" type="date"><br>
                <label for="end_date">End date:</label>
                <input name="end_date" type="date"><br>
                <input hidden name="uid" type="text" value="<?php echo $uid;?>">
                <input id="submitbutton" type="submit" value="Submit">
            </form>
            <p>Dalies ar draugiem: <a href="https://dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=<?php echo $uid;?>">dsp.tools/planotajs/RihardsL/php/rihardsl.php?uid=<?php echo $uid;?></a></p> <!-- Automātiski izveidots links, kas ļauj dalīties ar kalendāru jebkuram citam cilvēkam. -->
        </div>

    </div>
</div>

</body>
</html>
