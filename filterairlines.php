<?php
require("libs/Smarty.class.php");
require("getairlinesbycriteria.php");
require("getcountries.php");
require("getcriteria.php");

$airlinesByCountry = getAirlinesByCountryName();
$countries = getCountries();
$countryNames = getCountryNames();

$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("airlines", $airlinesByCountry);
$smarty->assign("countries", $countries);
$smarty->assign("countryNames", $countryNames);
$smarty->display("index.tpl");
