<?php
include "../Config/cms-config.php";
include "function.php";

$responce="300";
$error="null";
$code=escapeString($_POST['code']);

if(isset($_SESSION['forgotNumber']) && $_SESSION['forgotNumber']!=""
&& isset($_SESSION['trainer_id']) && $_SESSION['trainer_id']!=""
&& isset($_SESSION['currentTime']) && $_SESSION['currentTime']!="" && (time() - $_SESSION['currentTime']<60)){
    //once every thing is correct check code is same or not
    if($code==$_SESSION['forgotNumber']){
        $responce="200";
        unset($_SESSION['forgotNumber']);
        unset($_SESSION['currentTime']);
        //match remove the session
    }else{
        $responce="304";
        $error="The code is not Match with that";
    }
}else{
    $responce="0";
    $error="This Session was expired Please Do it again";
    unset($_SESSION['forgotNumber']);
    unset($_SESSION['currentTime']);
    unset($_SESSION['trainer_id']);
}

$array['responce']=$responce;
$array['error']=$error;

echo json_encode($array);