
<?php
include "../Config/cms-config.php";
include "function.php";

$responce="300";
$error="null";

$id=escapeString($_POST['id']);


//no problem
$sql="UPDATE comment set comment_status='Read' where comment_id='".$id."'";
$query=$mysqli->query($sql);
if($mysqli->affected_rows>0){
    $responce="200";
}else{
    $error="0 row affected";
}

$array['responce']=$responce;
$array['error']=$error;
echo json_encode($array);