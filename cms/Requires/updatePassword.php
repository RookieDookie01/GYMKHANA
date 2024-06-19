
<?php
include "../Config/cms-config.php";
include "function.php";

$responce="300";
$error="null";

$newPassword=escapeString($_POST['newpassword']);
$conPassword=escapeString($_POST['conpassword']);

//first check

if($newPassword!=$conPassword){
    $error="The new password does not match with confirm password";
    $array['responce']=$responce;
    $array['error']=$error;
    echo json_encode($array);
    exit;
}

if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""){
    $responce="404";
    $error="The session was expired please try it again";
    $array['responce']=$responce;
    $array['error']=$error;
    echo json_encode($array);
    exit;
}

//no problem
$sql="UPDATE admin set admin_password='".md5($conPassword)."' where admin_id='".$_SESSION['admin_id']."'";
$query=$mysqli->query($sql);
if($mysqli->affected_rows>0){
    $responce="200";
}else{
    
}

$array['responce']=$responce;
$array['error']=$error;
echo json_encode($array);