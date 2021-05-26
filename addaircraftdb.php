<?php
$DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

if (!$DB) {
    die("There was an error while connecting to database.");
    die(mysqli_connect_error());
}

$airlineID = (int) $_POST['airline_id'];
$registration = mysqli_real_escape_string($DB, $_POST['registration']);
$manufacturer = mysqli_real_escape_string($DB, $_POST['manufacturer']);
$type = mysqli_real_escape_string($DB, $_POST['type']);
$msn = mysqli_real_escape_string($DB, $_POST['msn']);
$name = mysqli_real_escape_string($DB, $_POST['name']);

$query = mysqli_query($DB, "INSERT INTO aircraft (airline_id, registration, manufacturer, `type`, msn, `name`) VALUES ($airlineID, '$registration', '$manufacturer', '$type', '$msn', '$name')");

if (!$query) {
    die(mysqli_error($DB));
}

die(header("Location: fleet.php?airline_id=$airlineID"));
