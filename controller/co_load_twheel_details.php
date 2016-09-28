<?php

define('db_host', '77.104.142.97');
define('db_port', '3306');
define('db_user', 'ayolanin_dev');
define('db_password', 'WelComeDB1129');
define('db_database', 'ayolanin_datahost');

$d_bc = mysqli_connect(db_host, db_user, db_password, db_database) or die('Could not connect to MySql: ' . mysqli_connect_error());
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';

//getting varibles from ajax method
$v_code = $_GET['v_type'];
$v_type = $_GET['v_code'];
//getting varibles from ajax method


echo $v_type+" output "+$v_code;

$sql_query="SELECT * FROM ser_threewheel_pre WHERE `type`='$v_type' AND `mode`='$v_code';";
$run_query=  mysqli_query($d_bc, $sql_query);
while($row_query=  mysqli_fetch_array($run_query)){
    $max_val=$row_query['max_value'];
    echo $max_val;
}
?>