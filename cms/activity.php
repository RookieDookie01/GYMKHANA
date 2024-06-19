<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";
include "Config/permission.php";
$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="activity";
switch($page){
    case "excel":
        include "Includes/Excel/activity.php";
        exit;
    case "add":
    case "edit":
    case "all":
    default:
        $Subtab="activity_all";
}



include "Requires/header.php";
include "Requires/top.php";
switch($page){
    case "add":
        include "Includes/Activity/add.php";
        break;
    case "edit":
        include "Includes/Activity/edit.php";
        break;
    case "all":
    default:
        include "Includes/Activity/all.php";
        break;
}
include "Requires/footer.php";
