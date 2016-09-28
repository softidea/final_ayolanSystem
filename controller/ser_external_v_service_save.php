<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}

require '../db/newDB.php';


$customer_nic = filter_input(INPUT_GET, 'cus_nic');
$service_no = filter_input(INPUT_GET, 'sno');
$v_cat = filter_input(INPUT_GET, 'v_cat');
$v_brand = filter_input(INPUT_GET, 'v_brand');
$v_type = filter_input(INPUT_GET, 'v_type');
$v_code = filter_input(INPUT_GET, 'v_code');
$v_number = filter_input(INPUT_GET, 'v_number');
$v_myear = filter_input(INPUT_GET, 'v_myear');
$v_lrate = filter_input(INPUT_GET, 'v_lrate');
$v_frate = filter_input(INPUT_GET, 'v_frate');
$v_period = filter_input(INPUT_GET, 'v_period');
$v_des = filter_input(INPUT_GET, 'v_des');
$reg_date = date("Y-m-d");
$installment=  filter_input(INPUT_GET, 'installment');

$sql_query = "INSERT INTO service
            (
             ser_number,
             cbopayment,
             ser_caty,
             ser_vbrand,
             ser_vtype,
             ser_v_code,
             ser_v_d_number,
             ser_v_d_modelyear,
             ser_leserate,
             ser_land_pond_amount,
             ser_period,
             ser_fixedrental,
             ser_duration,
             ser_date,
             ser_details,
             ser_instalment,
             refrence_person,
             ser_status,
             cus_nic,
             land_reg_date)
VALUES (
        '$service_no',
        '$v_cat',
        '$v_cat',
        '$v_brand',
        '$v_type',
        '$v_code',
        '$v_number',
        '$v_myear',
        '$v_lrate',
        'No Land Pawn Amount',
        'No Pawn Period',
        '$v_frate',
        '$v_period',
        '$reg_date',
        '$v_des',
        '$installment',
        '" . $_SESSION['user_email'] . "',
        '1',
        '$customer_nic',
        'No Land Reg Date')";

$run_query = mysqli_query($conn, $sql_query);
if ($run_query) {
    echo "Lease has been succesfully added";
} else {
    echo "Error While Saving the Leasing,Please check and Re register";
}
