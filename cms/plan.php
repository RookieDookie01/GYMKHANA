<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";

$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="plan";
switch($page){
    case "excel":
        include "Includes/Excel/plan.php";
        exit;
    case "add":
    case "edit":
    case "all":
    default:
        $Subtab="plan_all";
}



include "Requires/header.php";
include "Requires/top.php";
switch($page){
    case "add":
        include "Includes/Plan/add.php";
        break;
    case "edit":
        include "Includes/Plan/edit.php";
        break;
    case "all":
    default:
        include "Includes/Plan/all.php";
        break;
}
include "Requires/footer.php";
