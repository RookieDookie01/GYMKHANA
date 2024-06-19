<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";

$page = escapeString(isset($_GET['page']) ? $_GET['page'] : "");
$type = escapeString(isset($_GET['type']) ? $_GET['type'] : "");

$Maintab = "option";

switch ($page) {
    case "updateTrainer":
    case "updatePassword":
    default:
        $Subtab = "$page";
}


include "Requires/header.php";
include "Requires/top.php";

switch ($page) {
    case "updateTrainer":
        include "Includes/Option/updateTrainer.php";
        break;
    case "updatePassword":
        include "Includes/Option/updatePassword.php";
        break;
}

include "Requires/footer.php";