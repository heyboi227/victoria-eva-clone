<?php
require("libs/Smarty.class.php");
require("getcountries.php");

$countries = getCountries();
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("countries", $countries);
$smarty->display("addairline.tpl");
