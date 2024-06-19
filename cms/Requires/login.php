<?php
include "../Config/cms-config.php";
include "function.php";

$responce="300";
$username=escapeString($_POST['username']);
$password=escapeString($_POST['password']);

$name='';
$query=$mysqli->query("SELECT * FROM ".$table_admin." WHERE 
                    admin_username ='".$username."' AND 
                    admin_password = MD5('".$password."') AND
                    admin_status= 'active' AND 
                    (admin_delete_date='0000-00-00 00:00:00' or admin_delete_date IS NULL)
                    LIMIT 1");
if($query->num_rows>0){
    $data=$query->fetch_assoc();
    $_SESSION['user_id']=$data['admin_id'];
    $_SESSION['user_name']=$data['admin_name'];
    $_SESSION['permission']=$data['admin_position'];
    $name=$data['admin_name'];
    $responce="200";
}

$array['responce']=$responce;
$array['name']=$name;

echo json_encode($array);
