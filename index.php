<?php
require("libs/Smarty.class.php");
require("getairlines.php");
require("getcountries.php");
require("getcriteria.php");

$countries = getCountries();
$countryNames = getCountryNames();
$airlines = getAirlines();
$page = !isset($_GET["page"]) ? 1 : $_GET["page"];
$totalPages = totalPages();
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("airlines", $airlines);
$smarty->assign("countries", $countries);
$smarty->assign("countryNames", $countryNames);
$smarty->assign("page", $page);
$smarty->assign("totalPages", $totalPages);
$smarty->display("index.tpl");
