<?php
// Here we get all the service and brand names from the database, then displaying them in navigation dropdown menus
$servicesQuery = mysqli_query($DB, "SELECT `name` FROM `service`");
$brandsQuery = mysqli_query($DB, "SELECT `name` FROM brand ORDER BY `name` ASC");
if (!$servicesQuery || !$brandsQuery) {
    die(mysqli_error($DB));
}

$services = $brands = [];

while ($service = mysqli_fetch_object($servicesQuery)) {
    $services[] = $service;
}

while ($brand = mysqli_fetch_object($brandsQuery)) {
    $brands[] = $brand;
}
