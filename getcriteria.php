<?php
function getManufacturers()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $airlineID = (int) $_GET['airline_id'];

    $query = mysqli_query($DB, "SELECT DISTINCT manufacturer, COUNT(manufacturer) AS `count` FROM aircraft WHERE airline_id = $airlineID GROUP BY manufacturer ORDER BY manufacturer ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $manufacturers = [];

    while ($manufacturer = mysqli_fetch_object($query)) {
        $manufacturers[] = $manufacturer;
    }

    return $manufacturers;
}

function getAircraftTypes()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $airlineID = (int) $_GET['airline_id'];

    $query = mysqli_query($DB, "SELECT DISTINCT `type`, COUNT(`type`) AS `count` FROM aircraft WHERE airline_id = $airlineID GROUP BY `type` ORDER BY `type` ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $types = [];

    while ($aircraftType = mysqli_fetch_object($query)) {
        $types[] = $aircraftType;
    }

    return $types;
}

function getCountryNames()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "BelgradeIsMyCapitalCity123!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $query = mysqli_query($DB, "SELECT c.country_id, c.`name`, COUNT(airline_id) AS `count` FROM airline a, country c WHERE a.country_id = c.country_id GROUP BY c.country_id ORDER BY c.`name` ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $countries = [];

    while ($country = mysqli_fetch_object($query)) {
        $countries[] = $country;
    }

    return $countries;
}
