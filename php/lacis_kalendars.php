<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lāča kalendārs</title>
    <link rel="stylesheet" href="../css/lacis_kalendars.css">

    <!-- Calendar start -->
    <link href='../libraries/fullcalendar/lib/main.css' rel='stylesheet' />
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
                    {
                        title: 'TestEvent1',
                        start: '2021-09-21'
                    },
                    {
                        title: 'TestEvent2',
                        start: '2021-09-07',
                        end: '2021-09-10'
                    },
                ]
            });
            calendar.render();
        });
    </script>
    <!-- Calendar end -->

</head>

<body>

<div id='calendar'></div>

</body>
</html>
