<?php
require("libs/Smarty.class.php");
require("getairlines.php");
require("getcountries.php");
require("getcriteria.php");

session_start();

$countries = getCountries();
$countryNames = getCountryNames();
$airlines = getAirlines();
$page = !isset($_GET["page"]) ? 1 : $_GET["page"];
$totalPages = totalPages();
$loggedIn = !isset($_SESSION["loggedin"]) ? null : $_SESSION["loggedin"];
$username = !isset($_SESSION["username"]) ? null : htmlspecialchars($_SESSION["username"]);
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("airlines", $airlines);
$smarty->assign("countries", $countries);
$smarty->assign("countryNames", $countryNames);
$smarty->assign("page", $page);
$smarty->assign("totalPages", $totalPages);
$smarty->assign("loggedIn", $loggedIn);
$smarty->assign("username", $username);
$smarty->display("index.tpl");
