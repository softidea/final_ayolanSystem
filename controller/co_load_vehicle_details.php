<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';


//getting varibles from ajax method
$v_type = $_GET['v_type'];
$v_code = $_GET['v_code'];
//getting varibles from ajax method

$sql_query="SELECT * FROM ser_vehicles_pre WHERE vehicle_type_id='$v_type' AND type='$v_code'";
$run_query=  mysqli_query($d_bc, $sql_query);
if($row_query=  mysqli_fetch_assoc($run_query)){
    $model_year=$row_query['model_year'];
    $max_value=$row_query['max_value'];
    echo $model_year."#".$max_value;
}
?>