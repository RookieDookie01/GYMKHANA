<?php
include "../Config/cms-config.php";
include "../Requires/function.php";
include "../Config/session.php";

$responce="300";
$position=escapeString($_POST['position']);
$id=escapeString($_POST['userid']);
$table="";
$errormessage="No Login or Parameter Error";

//check admin function

switch($position){
    case "member":
        $table=$table_customer;
    break;
    case "admin":
        $table=$table_admin;
    break;
    case "trainer":
        $table=$table_trainer;
    break;
    case "class":
        $table=$table_class;
    break;
    case "activity":
        $table=$table_activity;
    break;
    case "plan":
        $table=$table_plan;
    break;

}
if($table!="" && $Login){
    $query=$mysqli->query("UPDATE ".$table." SET ".$table."_delete_date = '".TODAY."' WHERE ".$table."_id = ".$id);
    if($mysqli->affected_rows>0){
        $responce="200";
        $errormessage="No error";
    }else{
        $errormessage="No data found";
    }
}
$array['responce']=$responce;
$array['error']=$errormessage;

echo json_encode($array);
