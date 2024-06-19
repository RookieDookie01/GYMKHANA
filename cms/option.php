<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";

$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="option";

switch($page){
    case "changePassword":
    default:
        $Subtab="change_password";
}


include "Requires/header.php";
include "Requires/top.php";

switch($page){
    case "changePassword":
        include "Includes/Option/updatePassword.php";
    break;
}

include "Requires/footer.php";