<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}


require '../db/newDB.php';

$service_no= filter_input(INPUT_GET, 'service_no');

$visit_service_no= filter_input(INPUT_GET, 'visit_service_no');
$visit_cus_nic= filter_input(INPUT_GET, 'visit_cus_nic');
$visit_cost= filter_input(INPUT_GET, 'visit_cost');
$visit_date= filter_input(INPUT_GET, 'visit_date');
$visit_des= filter_input(INPUT_GET, 'visit_des');

//load service and customer details
if($service_no!=null && $service_no!=""){
    global $conn;
    $load_customer_data="SELECT s.`cus_nic`,s.`vehicle_no`,c.`cus_fullname` FROM service s LEFT JOIN customer c ON s.`cus_nic`=c.`cus_nic` WHERE s.`ser_number`='$service_no'";
    $run_load_customer_data=  mysqli_query($conn, $load_customer_data);
    if(mysqli_num_rows($run_load_customer_data)==0){
        echo "No data found for this Service No";
    }else{
        if($row_cus_data=  mysqli_fetch_assoc($run_load_customer_data)){
            $cus_nic=$row_cus_data['cus_nic'];
            $cus_name=$row_cus_data['cus_fullname'];
            $vehicle_no=$row_cus_data['vehicle_no'];
            echo $vehicle_no."#".$cus_nic."#".$cus_name;
        }
    }
}
//load service and customer details

//save customer service visit
if($visit_service_no!=null && $visit_service_no!="" && $visit_cus_nic!=null && $visit_cus_nic!="" && $visit_cost!=null && $visit_cost!="" && $visit_date!=null && $visit_date!="" && $visit_des!=null && $visit_des!=""){

    global $conn;
    $save_vehicle_visit="INSERT INTO `ayolanin_test`.`service_visit`
            (
             `visit_date`,
             `ser_number`,
             `cus_nic`,
             `visit_cost`,
             `visit_des`,visit_status)
VALUES (
        '$visit_date',
        '$visit_service_no',
        '$visit_cus_nic',
        '$visit_cost',
        '$visit_des','Active')";
    $run_save_visit=  mysqli_query($conn, $save_vehicle_visit);
    if($run_save_visit){
        echo 'Customer Visit saved successfully';
    }
    
    
}
//save customer service visit
