<?php
require("libs/Smarty.class.php");
require("getaircraft.php");

$aircraft = getAircraft();
$airlines = getAirlines();
$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign("aircraft", $aircraft);
$smarty->assign("airlines", $airlines);

$smarty->display("editaircraft.tpl");
