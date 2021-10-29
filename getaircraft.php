<?php
function getAircraft()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $aircraftID = (int) $_GET['aircraft_id'];

    $query = mysqli_query($DB, "SELECT * FROM aircraft WHERE aircraft_id = $aircraftID");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $aircraft = mysqli_fetch_object($query);

    return $aircraft;
}

function getAirlines()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $query = mysqli_query($DB, "SELECT * FROM airline ORDER BY `name` ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $airlines = [];

    while ($airline = mysqli_fetch_object($query)) {
        $airlines[] = $airline;
    }

    return $airlines;
}
