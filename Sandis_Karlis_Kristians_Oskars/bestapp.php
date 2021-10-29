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

$sql = 'SELECT * FROM plan_rihardsl';

$result = mysqli_query($conn, $sql);

$activities = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>3 grupa</title>
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="activity-panel">
    <h1>Darāmās aktivitātes</h1>
  </div>
  <button class="activity-button">
    <h2>Pievienot jaunu aktivitāti</h2>
  </button>
  <h2 class="activity-next">Nākamā esošā aktivitāte:</h2>
  <?php $i = 0; foreach($activities as $activity){ ?>
    <h2 class="activity-main">
      <?php 
        echo htmlspecialchars($activity['title']); 
        echo "<br>"; 
        echo htmlspecialchars($activity['start_date']);
        echo "<br>"; 
        echo htmlspecialchars($activity['end_date']);
        $i++;
        if ($i > 2) exit;
      ?>
    </h2>
  <?php } ?>
</body>

</html>