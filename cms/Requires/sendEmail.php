<?php
include "../Config/cms-config.php";
include "function.php";
include "email.php";

$responce="300";
$error="null";
$email=escapeString($_POST['email']);
$errormessage="No Login or Parameter Error";

$sql="SELECT * FROM ADMIN WHERE admin_email='".$email."' and admin_status='active' limit 1";

$query=$mysqli->query($sql);
if($query->num_rows>0){
    $data=$query->fetch_assoc();
    $_SESSION['forgotNumber']=generateRandomPassword();
    $_SESSION['currentTime']=time();
    $_SESSION['admin_id']=$data['admin_id'];
    $checkarray=sendEmail($email,$_SESSION['forgotNumber']);
    if($checkarray['status']=="200"){
        $responce="200";
    }else{
        $error=$checkarray['error'];
    }
}else{
    $error="No User Found Please check your email again";
}

$array['error']=$error;
$array['responce']=$responce;
$array['check']=$_SESSION;
echo json_encode($array);
function generateRandomPassword($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}