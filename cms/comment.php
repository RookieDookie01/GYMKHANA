<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";

$page=escapeString(isset($_GET['page'])?$_GET['page']:"");
$type=escapeString(isset($_GET['type'])?$_GET['type']:"");

$Maintab="comment";
switch($page){
    case "all":
    default:
        $Subtab="comment_all";
}

//before header

include "Requires/header.php";
include "Requires/top.php";
switch($page){
    case "all":
    default:
        include "Includes/Comment/all.php";
        break;
}
include "Requires/footer.php";

