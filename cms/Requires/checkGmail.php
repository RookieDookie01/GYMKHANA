<?php
include "../Config/cms-config.php";
include "function.php";

$responce="200";
$error="null";

$type=escapeString($_POST['type']);
$value=escapeString($_POST['value']);

//to check duplicated only

$sql="SELECT * FROM ".$type." WHERE 
".$type."_email = '".$value."' AND
(".$type."_delete_date='0000-00-00 00:00:00' or ".$type."_delete_date IS NULL) ";
if(isset($_POST['id'])){
    $sql.= "AND ".$type."_id != '".escapeString($_POST['id'])."' ";
}
$query=$mysqli->query($sql);
if($query->num_rows>0){
    $responce="300";
    $error="The Gmail was Exist on our database pleace change another";
}

$array['responce']=$responce;
$array['error']=$error;

echo json_encode($array);