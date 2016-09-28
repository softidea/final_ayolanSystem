<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';

$cus_sno = filter_input(INPUT_GET, 'sno');

if ($cus_sno != null && $cus_sno != "") {
    
    $sql_query = "SELECT a.cus_fullname,c.vehicle_no,a.cus_address,c.`description`,c.`ser_status`,c.`fix_rate`,c.`installment`,c.`period` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE c.`ser_number`='".$cus_sno."'";
    $run_query = mysqli_query($d_bc, $sql_query);
    while ($row_query = mysqli_fetch_array($run_query)) {
        $name= $row_query['cus_fullname'];
        $address = $row_query['cus_address'];
        $status = $row_query['ser_status'];
        $facility = $row_query['description'];
        $vno = $row_query['vehicle_no'];
        $capital = $row_query['fix_rate'];
        $rental_no = $row_query['period'];
        $rental = $row_query['installment'];
        
        echo $name+'#'+$address+'#'+$status+'#'+$facility+'#'+$vno+'#'+$capital+'#'+$rental_no+'#'+$rental;
        
    }
}
