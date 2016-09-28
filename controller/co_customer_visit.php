<?php
require_once '../db/mysqliConnect.php';
$visit_id = filter_input(INPUT_GET, 'id');
$sql_query = "SELECT `visit_id`,`visit_date`,`ser_number`,`cus_nic`, `visit_cost`,`visit_des`,`visit_status` FROM`service_visit` WHERE visit_id='".$visit_id."'";
$result = mysqli_query($d_bc, $sql_query);
while ($row = mysqli_fetch_assoc($result)):

    $date=$row['visit_date'];
    $cost=$row['visit_cost'];
    $status=$row['visit_status'];
    
    echo  $date;
    echo  '#';
    echo  $cost;
     echo  '#';
    echo  $status;

endwhile;
