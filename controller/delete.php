<?php

define('db_host', '77.104.142.97');
define('db_port', '3306');
define('db_user', 'ayolanin_dev');
define('db_password', 'WelComeDB1129');
define('db_database', 'ayolanin_datahost');

$d_bc = mysqli_connect(db_host, db_user, db_password, db_database)or die('Could not connect to MySql: '. mysqli_connect_error());

$sql_query="SELECT DISTINCT tw_type FROM ser_threewheel_pre";
$run_query=  mysqli_query($d_bc, $sql_query);

while($row_query=mysqli_fetch_array($run_query)){
    $wheel_mod=$row_query['tw_type'];
    echo "<option value='$wheel_mod'>$wheel_mod</option>";
}
?>