<?php
function getCountries()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $query = mysqli_query($DB, "SELECT * FROM country ORDER BY `name` ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $countries = [];

    while ($country = mysqli_fetch_object($query)) {
        $countries[] = $country;
    }

    return $countries;
}
