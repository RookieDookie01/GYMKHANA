<?php
include "Config/cms-config.php";
include "Config/session.php";
include "Requires/function.php";

$page = escapeString(isset($_GET['page']) ? $_GET['page'] : "");
$type = escapeString(isset($_GET['type']) ? $_GET['type'] : "");

$Maintab = "profile";
switch ($page) {
    case "viewProfile":
    case "viewTimetable":
    case "viewActivity":
    case "viewAttendance":
    case "viewMembers":
    default:
        $Subtab = "$page";
}

include "Requires/header.php";
include "Requires/top.php";

switch ($page) {
    case "viewProfile":
        include "Includes/Profile/viewProfile.php";
        break;
    case "viewTimetable":
        include "Includes/Profile/viewTimetable.php";
        break;
    case "viewActivity":
        include "Includes/Profile/viewActivity.php";
        break;
    case "viewAttendance":
        include "Includes/Profile/viewAttendance.php";
        break;
    case "viewMembers":
        include "Includes/Profile/viewMembers.php";
        break;
}


include "Requires/footer.php";