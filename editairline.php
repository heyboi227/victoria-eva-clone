<?php
require("libs/Smarty.class.php");
require("getairline.php");
require("getcountries.php");

$airline = getAirline();
$countries = getCountries();
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("airline", $airline);
$smarty->assign("countries", $countries);
$smarty->display("editairline.tpl");
