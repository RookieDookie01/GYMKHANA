<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";
include "Config/permission.php";
$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="class";

switch($page){
    case "excel":
        //include "Includes/Excel/class.php";
        exit;
    case "add":
    case "edit":
    case "all":
    default:
        $Subtab="class_all";
}

include "Requires/header.php";
include "Requires/top.php";

switch($page){
    case "add":
        include "Includes/Class/add.php";
        break;
    case "edit":
        include "Includes/Class/edit.php";
        break;
    case "all":
    default:
        include "Includes/Class/all.php";
        break;
}
include "Requires/footer.php";


