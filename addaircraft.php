<?php
require("libs/Smarty.class.php");

$smarty = new Smarty();

$smarty->setTemplateDir("./");
$smarty->assign('airlineID', (int) $_GET['airline_id']);
$smarty->display("addaircraft.tpl");
