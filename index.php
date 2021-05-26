<?php
require("libs/Smarty.class.php");
require("getairlines.php");
require("getcountries.php");
require("getcriteria.php");

$airlines = getAirlines();
$countries = getCountries();
$countryNames = getCountryNames();
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("airlines", $airlines);
$smarty->assign("countries", $countries);
$smarty->assign("countryNames", $countryNames);
$smarty->display("index.tpl");
