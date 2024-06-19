<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";
$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="member";
switch($page){
    case "excel":
        include "Includes/Excel/Member.php";
        exit;
    case "add":
    case "edit":
    case "all":
    default:
        $Subtab="member_all";
}


include "Requires/header.php";
include "Requires/top.php";

switch($page){
    case "add":
        include "Includes/Member/add.php";
        break;
    case "edit":
        include "Includes/Member/edit.php";
        break;
    case "all":
    default:
        include "Includes/Member/all.php";
        break;
}


include "Requires/footer.php";