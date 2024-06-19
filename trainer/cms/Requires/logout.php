<?php
include "../Config/cms-config.php";
include "../Requires/function.php";

session_destroy();
header("Location: ../index.php");
exit;
