<?php
function getAirlinesByCountryName()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $countryID = (int) $_POST['selectCountry'];

    $query = mysqli_query($DB, "SELECT * FROM airline WHERE country_id = '$countryID' ORDER BY iata_code ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $countries = [];

    while ($country = mysqli_fetch_object($query)) {
        $countries[] = $country;
    }

    return $countries;
}
