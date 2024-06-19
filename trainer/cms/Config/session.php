<?php
//check session in index.php only
if(!isset($_SESSION['trainer_id']) || $_SESSION['trainer_id']=="" || !isset($_SESSION['trainer_name']) || $_SESSION['trainer_name']==""){
    $Login=false;
    header("Location: index.php");
    exit;
}

