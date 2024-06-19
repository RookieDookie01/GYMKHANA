<?php
//check session in index.php only
if(!isset($_SESSION['user_id']) || $_SESSION['user_id']=="" || !isset($_SESSION['user_name']) || $_SESSION['user_name']==""){
    $Login=false;
    header("Location: index.php");
    exit;
}

//check position
if($_SESSION['permission']=='admin'  || $_SESSION['user_id']=='1'){
    $permission=true;
}else{
    $permission=false;
}
$Login=true;
