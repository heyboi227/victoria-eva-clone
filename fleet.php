<?php
require("libs/Smarty.class.php");
require("getfleet.php");
require("getcriteria.php");

$fleet = getFleet();
$manufacturers = getManufacturers();
$types = getAircraftTypes();
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("fleet", $fleet);
$smarty->assign("manufacturers", $manufacturers);
$smarty->assign("types", $types);
$smarty->assign('airlineID', (int) $_GET['airline_id']);
$smarty->display("fleet.tpl");
