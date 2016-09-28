<?php
//test comment
define('db_host', '77.104.142.97');
define('db_port', '3306');
define('db_user', 'ayolanin_dev');
define('db_password', 'WelComeDB1129');
define('db_database', 'ayolanin_datahost');

$d_bc = mysqli_connect(db_host, db_user, db_password, db_database) or die('Could not connect to MySql: ' . mysqli_connect_error());

//getting varibles from ajax method
$code=  filter_input(INPUT_GET, 'v_tw_type');
$type=  filter_input(INPUT_GET, 'v_tw_code');

//getting varibles from ajax method


$sql_query="SELECT max_val FROM ser_threewheel_pre WHERE tw_type='$type' AND tw_mode='$code'";

$run_query=  mysqli_query($d_bc, $sql_query);

if($row=mysqli_fetch_array($run_query)){
    $max_val=$row['max_val'];
    echo $max_val;
}

?>