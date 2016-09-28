<?php

//fetch_state.php  
efine('db_host', '107.180.14.32');
define('db_port', '3306');
define('db_user', 'ayolandeveloper');
define('db_password', 'WelComeDB1129');
define('db_database', 'ayolan_datahost');

$connect = mysqli_connect(db_host, db_user, db_password, db_database)

        or die('Could not connect to MySql: ' . mysqli_connect_error());
$output = '';

$sql = "SELECT * FROM vehicle_type where brand_id= '" . $_POST["bid"] . "'";
$result = mysqli_query($connect, $sql);
$output = '<option value="">Select Vehicle Type</option>';
while ($row = mysqli_fetch_array($result)) {
    $output .= '<option value="' . $row["vehicle_type_id"] . '">' . $row["vehicle_type"] . '</option>';
}
echo $output;
?>  