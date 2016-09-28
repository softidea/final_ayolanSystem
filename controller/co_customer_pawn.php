<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}

$conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_datahost");
if (mysqli_connect_errno()) {
    echo "Falied to Connect the Database" . mysqli_connect_error();
}
session_start();
$reference_person = $_SESSION['user_email'];

$cus_name = "";
$cus_address = "";
$cus_tp = "";
$cus_nic = "";
$cus_dob = "";
$cus_position = "";
$cus_salary = "";
$cus_emp_name = "";
$cus_emp_address = "";
$cus_ms = "";
$cus_dependdency = "";
$cus_addr_map_link = "";
$prop_name = "";
$prop_address = "";
$prop_tp = "";
$prop_dob = "";
$prop_nic = "";
$prop_ms = "";
//Asia/Colombo
date_default_timezone_set('Asia/Colombo');
$cus_regdate = date("Y-m-d");

if (isset($_POST['pawn_reg'])) {
    
    $cus_name = $_SESSION['cus_name'] = filter_input(INPUT_POST, 'cus_name');
    $cus_address = $_SESSION['cus_address'] = filter_input(INPUT_POST, 'cus_address');
    $cus_tp = $_SESSION['cus_tp'] = filter_input(INPUT_POST, 'cus_tp');
    $cus_nic = $_SESSION['cus_nic'] = filter_input(INPUT_POST, 'cus_nic');
    $cus_dob = $_SESSION['cus_dob'] = filter_input(INPUT_POST, 'cus_dob');
    $cus_position = $_SESSION['cus_position'] = filter_input(INPUT_POST, 'cus_position');
    $cus_salary = $_SESSION['cus_salary'] = filter_input(INPUT_POST, 'cus_salary');
    $cus_emp_name = $_SESSION['cus_emp_name'] = filter_input(INPUT_POST, 'cus_emp_name');
    $cus_emp_address = $_SESSION['cus_emp_address'] = filter_input(INPUT_POST, 'cus_emp_address');
    $cus_ms = $_SESSION['cus_ms'] = filter_input(INPUT_POST, 'cus_ms');
    $cus_dependdency = $_SESSION['cus_dependdency'] = filter_input(INPUT_POST, 'cus_dependdency');
    $cus_addr_map_link = $_SESSION['cus_addr_map_link'] = filter_input(INPUT_POST, 'cus_addr_map_link');

    $prop_name = $_SESSION['prop_name'] = filter_input(INPUT_POST, 'prop_name');
    $prop_address = $_SESSION['prop_address'] = filter_input(INPUT_POST, 'prop_address');
    $prop_tp = $_SESSION['prop_tp'] = filter_input(INPUT_POST, 'prop_tp');
    $prop_dob = $_SESSION['prop_dob'] = filter_input(INPUT_POST, 'prop_dob');
    $prop_nic = $_SESSION['prop_nic'] = filter_input(INPUT_POST, 'prop_nic');
    $prop_ms = $_SESSION['prop_ms'] = filter_input(INPUT_POST, 'prop_ms');
    $prop_spouse_name = $_SESSION['prop_spouse_name'] = filter_input(INPUT_POST, 'prop_spouse_name');
    $prop_postion = $_SESSION['prop_postion'] = filter_input(INPUT_POST, 'prop_postion');
    $prop_salary = $_SESSION['prop_salary'] = filter_input(INPUT_POST, 'prop_salary');
    $prop_emp_name = $_SESSION['prop_emp_name'] = filter_input(INPUT_POST, 'prop_emp_name');
    $prop_emp_address = $_SESSION['prop_emp_address'] = filter_input(INPUT_POST, 'prop_emp_address');
    
    
    $deed_no=$_SESSION['deed_no']=  filter_input(INPUT_POST, 'deed_no');
    $deed_reg_date=$_SESSION['deed_reg_date'] = filter_input(INPUT_POST, 'deed_reg_date');
    $deed_amount=$_SESSION['cbo_pawn_amount'] = filter_input(INPUT_POST, 'cbo_pawn_amount');
    $cbo_pawn_period=$_SESSION['cbo_pawn_period']=  filter_input(INPUT_POST, 'cbo_pawn_period');
    $pawn_rate=$_SESSION['pawn_rate']=  filter_input(INPUT_POST, 'pawn_rate');
    $fixed_rate=$_SESSION['fixed_rate']=  filter_input(INPUT_POST, 'fixed_rate');
    $area=$_SESSION['area']=  filter_input(INPUT_POST, 'area');
    $loan_description=$_SESSION['loan_description']=  filter_input(INPUT_POST, 'loan_description');
    
    //saving customer~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    global $conn;
    $query_customer = "INSERT INTO customer
            (
             cus_fullname,
             cus_address,
             cus_tp,
             cus_nic,
             cus_dob,
             cus_ms,
             cus_dependdency,
             cus_position,
             cus_monthly_salary,
             cus_emp_name,
             cus_emp_address,
             cus_addr_map_link,
             cus_reg_date,
             cus_status,
             wife_name,
             wife_dob,
             wife_position,
             wife_salary,
             wife_emp_name,
             proposer_name,
             proposer_address,
             proposer_tp,
             proposer_dob,
             proposer_nic,
             proposer_ms,
             proposer_spouse,
             proposer_position,
             proposer_salary,
             proposer_employer,
             proposer_emp_address)
VALUES (
        '$cus_name',
        '$cus_address',
        '$cus_tp',
        '$cus_nic',
        '$cus_dob',
        '$cus_ms',
        '$cus_dependdency',
        '$cus_position',
        '$cus_salary',
        '$cus_emp_name',
        '$cus_emp_address',
        '$cus_addr_map_link',
        '$cus_regdate',
        '1',
        'NA',
        'NA',
        'NA',
        'NA',
        'NA',
        '$prop_name',
        '$prop_address',
        '$prop_tp',
        '$prop_dob',
        '$prop_nic',
        '$prop_ms',
        '$prop_spouse_name',
        '$prop_postion',
        '$prop_salary',
        '$prop_emp_name',
        '$prop_emp_address')";

    $save_customer = mysqli_query($conn, $query_customer);
    if($save_customer){
        //saving land pawn~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $query_pawn = "INSERT INTO land_pawns
            (
             deed_no,
             deed_reg_date,
             amount,
             period,
             pawn_rental,
             description,
             cus_nic,
             area)
VALUES (
        '$deed_no',
        '$deed_reg_date',
        '$deed_amount',
        '$cbo_pawn_period',
        '$pawn_rate',
        '$loan_description',
        '$cus_nic',
        '$area')";
        
        $save_pawn=  mysqli_query($conn, $query_pawn);
        if($save_pawn){
            echo "Land Pawn successfully saved";
            echo "<script>window.location.href='../user/user_home.php';</script>";
        }else{
            echo "Error while saving lan pawn";
        }
    }else{
            echo "Error while saving lan pawn";
        }
}
?>