<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";
include "Config/permission.php";
$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="admin";
switch($page){
    case "excel":
        include "Includes/Excel/admin.php";
        exit;
    case "add":
    case "edit":
    case "all":
    default:
        $Subtab="admin_all";
}

//before header

include "Requires/header.php";
include "Requires/top.php";
switch($page){
    case "add":
        include "Includes/Admin/add.php";
        break;
    case "edit":
        include "Includes/Admin/edit.php";
        break;
    case "all":
    default:
        include "Includes/Admin/all.php";
        break;
}
include "Requires/footer.php";

