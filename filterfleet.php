<?php
require("libs/Smarty.class.php");
require("getfleet.php");
require("getfleetbycriteria.php");
require("getcriteria.php");

$manufacturerFleet = getFleetByManufacturer();
$typeFleet = getFleetByAircraftType();
$manufacturerAndTypeFleet = getFleetByManufacturerAndAircraftType();
$fleet = getFleet();

$manufacturers = getManufacturers();
$aircraftTypes = getAircraftTypes();

$smarty = new Smarty();

$smarty->setTemplateDir("./");

if ($_POST['selectManufacturer'] != "default" && $_POST['selectType'] != "default") {
    $smarty->assign("fleet", $manufacturerAndTypeFleet);
} else if ($_POST['selectManufacturer'] != "default" && $_POST['selectType'] == "default") {
    $smarty->assign("fleet", $manufacturerFleet);
} else if ($_POST['selectType'] == "default" && $_POST['selectType'] != "default") {
    $smarty->assign("fleet", $typeFleet);
} else {
    $smarty->assign("fleet", $fleet);
}

$smarty->assign("manufacturers", $manufacturers);
$smarty->assign("types", $aircraftTypes);
$smarty->assign('airlineID', (int) $_GET['airline_id']);
$smarty->display("fleet.tpl");
