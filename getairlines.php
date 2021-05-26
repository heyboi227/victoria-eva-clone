<?php
function getAirlines()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $query = mysqli_query($DB, "SELECT * FROM airline ORDER BY icao_code ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $airlines = [];

    while ($airline = mysqli_fetch_object($query)) {
        $airlines[] = $airline;
    }

    return $airlines;
}
