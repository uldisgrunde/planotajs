<?php
include("config.php");
//Izveidos jaunu profilu, tikai, ja veiks jauna profila lietotaja registraciju
if (isset($_POST["newAccountUsername"])) {
    $username = mysqli_real_escape_string($connection, $_POST["newAccountUsername"]);
    $password = mysqli_real_escape_string($connection, $_POST["newAccountPassword"]);
    //Parbauda vai ir laukumi tuksi
    if ($username != "" && $password != "") {
        //Parbauda vai lietotajvards nav jau aiznemts
        if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM dungeon_users WHERE username = '$username'")) == 0) {
            //Ievieto jaunu profilu datubaze uz noteikto tabulu un kollonam
            mysqli_query($connection, "INSERT INTO dungeon_users (username, password) VALUES ('$username', '$password')");
            echo "Tika izveidots lietotajs ar Lietotajvardu: " . $username ."";
        //Ja aiznemts tad izvada tekstu
        } else {
            echo "Sis lietotajvards nav pieejams!";
        }
    //Ja kads no laukumiem neizpildits tad izvada tekstu
    } else {
        echo "Abi laukumi jaizpilda.";
    }
//Savadak tad pieslegsies tikai eksitejosa lietotaja profilam
} else if (isset($_POST["loginUsername"])) {
    $username = mysqli_real_escape_string($connection, $_POST["loginUsername"]);
    $password = mysqli_real_escape_string($connection, $_POST["loginPassword"]);
    //Ja abi laukumi aizpilditi tad
    if ($username != "" && $password != "") {
        //No datubazes parbauda vai iavaditais lietotajvards un parole sakrit
        $sql = "Select * FROM dungeon_users WHERE username = '$username' AND password = '$password'";
        if (mysqli_num_rows(mysqli_query($connection, $sql)) > 0) {
            echo "1";
        } else {
            echo "Nepareizs ietotajvards un/vai parole!";
        }
    } else {
        echo "Abi laukumi jaizpilda.";
    }
} else {
    echo "";
}
?>
