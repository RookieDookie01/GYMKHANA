<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";

$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="payment";
switch($page){
    case "excel":
        include "Includes/Excel/payment.php";
        exit;
    case "add":
    case "edit":
    case "all":
    default:
        $Subtab="payment_all";
}



include "Requires/header.php";
include "Requires/top.php";
switch($page){
    case "add":
        include "Includes/Payment/add.php";
        break;
    case "edit":
        include "Includes/Payment/edit.php";
        break;
    case "all":
    default:
        include "Includes/Payment/all.php";
        break;
}
include "Requires/footer.php";
