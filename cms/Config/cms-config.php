<?php
session_start();

//connet
$databaseName="localhost";
$database="gymkhana_db1";
$DBusername="root";
$DBpassword="";

$mysqli = new mysqli($databaseName,$DBusername,$DBpassword,$database);
$mysqli->set_charset("utf8");
date_default_timezone_set('Asia/Kuala_Lumpur') ;

//check connection
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error()) ;
    exit;
}


//define word
define('TODAY',date('Y-m-d H:i:s'));
define('TODAYDATE',date('Y-m-d'));
define('TODAYNAME',date('YmdHis'));
define('THISMONTH',date('M'));
define('TRAINERIMGPATH','http://localhost/GYMKHANA/cms/upload/');

//default variable
$more_script='';
$page='';
$type='';
$table_admin='admin';
$table_trainer='trainer';
$table_customer='customer';
$table_activity='activity';
$table_class='class';
$table_payment='payment';

$table_plan='plan';

// no cache in this
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');