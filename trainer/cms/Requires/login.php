<?php
include "../Config/cms-config.php";
include "function.php";

$responce="300";
$username=escapeString($_POST['username']);
$password=escapeString($_POST['password']);

$name='';
$query=$mysqli->query("SELECT * FROM ".$table_trainer." WHERE 
                    trainer_username ='".$username."' AND 
                    trainer_password = MD5('".$password."') AND
                    (trainer_delete_date='0000-00-00 00:00:00' or trainer_delete_date IS NULL)
                    LIMIT 1");
if($query->num_rows>0){
    $data=$query->fetch_assoc();
    $_SESSION['trainer_id']=$data['trainer_id'];
    $_SESSION['trainer_name']=$data['trainer_name'];
    $name=$data['trainer_name'];
    $responce="200";
}

$array['responce']=$responce;
$array['name']=$name;

echo json_encode($array);
