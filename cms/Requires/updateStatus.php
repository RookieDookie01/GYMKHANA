<?php
include "../Config/cms-config.php";
include "function.php";

$responce="300";
$error="null";

$id=escapeString($_POST['id']);
$value=escapeString($_POST['value']);

$sql="UPDATE payment set payment_status='".$value."' WHERE paymet_id='$id'";
$query=$mysqli->query($sql);
if($mysqli->affected_rows>0){
    $responce="200";
}else{
    $error="0 row affected Please check the Payment is valid or not";
};
$array['responce']=$responce;
$array['error']=$error;
echo json_encode($array);