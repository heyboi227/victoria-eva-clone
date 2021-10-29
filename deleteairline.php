<?php
$DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

if (!$DB) {
    die("There was an error while connecting to database.");
    die(mysqli_connect_error());
}

$airlineID = (int) $_GET['airline_id'];

$query = mysqli_query($DB, "DELETE FROM airline WHERE airline_id = $airlineID");

if (!$query) {
    die(mysqli_error($DB));
}

die(header("Location: index.php"));
