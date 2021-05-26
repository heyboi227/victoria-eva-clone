<?php
function getFleetByManufacturer()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $airlineID = (int) $_GET['airline_id'];
    $manufacturer = mysqli_real_escape_string($DB, $_POST['selectManufacturer']);

    $query = mysqli_query($DB, "SELECT * FROM aircraft WHERE airline_id = $airlineID AND manufacturer = '$manufacturer' ORDER BY registration ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $fleet = [];

    while ($aircraft = mysqli_fetch_object($query)) {
        $fleet[] = $aircraft;
    }

    return $fleet;
}

function getFleetByAircraftType()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $airlineID = (int) $_GET['airline_id'];
    $type = mysqli_real_escape_string($DB, $_POST['selectType']);

    $query = mysqli_query($DB, "SELECT * FROM aircraft WHERE airline_id = $airlineID AND `type` = '$type' ORDER BY registration ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $fleet = [];

    while ($aircraft = mysqli_fetch_object($query)) {
        $fleet[] = $aircraft;
    }

    return $fleet;
}

function getFleetByManufacturerAndAircraftType()
{
    $DB = mysqli_connect("127.0.0.1", "mjeknic", "Ackostar1999!", "mjeknic");

    if (!$DB) {
        die("There was an error while connecting to database.");
        die(mysqli_connect_error());
    }

    $airlineID = (int) $_GET['airline_id'];
    $manufacturer = mysqli_real_escape_string($DB, $_POST['selectManufacturer']);
    $type = mysqli_real_escape_string($DB, $_POST['selectType']);

    $query = mysqli_query($DB, "SELECT * FROM aircraft WHERE airline_id = $airlineID AND manufacturer = '$manufacturer' AND `type` = '$type' ORDER BY registration ASC");

    if (!$query) {
        die(mysqli_error($DB));
    }

    $fleet = [];

    while ($aircraft = mysqli_fetch_object($query)) {
        $fleet[] = $aircraft;
    }

    return $fleet;
}
