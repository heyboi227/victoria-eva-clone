<?php
function getFleet()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $airlineID = (int) $_GET['airline_id'];

    $query = mysqli_query($DB, "SELECT * FROM aircraft WHERE airline_id = $airlineID ORDER BY registration ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $fleet = [];

    while ($aircraft = mysqli_fetch_object($query)) {
        $fleet[] = $aircraft;
    }

    return $fleet;
}
