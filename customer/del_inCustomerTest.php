<?php

    //$cus_addr_map_link = "No add this one";
    //$reg_date= date("Y-m-d");



    filter_input(INPUT_POST, 'cus_salutation') = $_SESSION['cus_salutation'];
    $a1=$_SESSION['cus_salutation'];
//    filter_input(INPUT_POST, 'cus_fullname') = $_SESSION['cus_fullname'];
//    $a2=$_SESSION['cus_fullname'];
//    filter_input(INPUT_POST, 'cus_initialname') = $_SESSION['cus_initialname'];
//    $a3=$_SESSION['cus_initialname'];
//    filter_input(INPUT_POST, 'cus_address') = $_SESSION['cus_address'];
//    $a4=$_SESSION['cus_address'];
//    filter_input(INPUT_POST, 'cus_tp') = $_SESSION['cus_tp'];
//    $a5=$_SESSION['cus_tp'];
//    filter_input(INPUT_POST, 'cus_nic') = $_SESSION['cus_nic'];
//    $a6=$_SESSION['cus_nic'];
//    filter_input(INPUT_POST, 'cus_dob') = $_SESSION['cus_dob'];
//    $a7=$_SESSION['cus_dob'];
//    filter_input(INPUT_POST, 'cus_ms') = $_SESSION['cus_ms'];
//    $a8=$_SESSION['cus_ms'];
//    filter_input(INPUT_POST, 'cus_dependdency') = $_SESSION['cus_dependdency'];
//    $a9=$_SESSION['cus_dependdency'];
//    filter_input(INPUT_POST, 'cus_position') = $_SESSION['cus_position'];
//    $a10=$_SESSION['cus_position'];
//    filter_input(INPUT_POST, 'cus_monthly_salary') = $_SESSION['cus_monthly_salary'];
//    $a11=$_SESSION['cus_monthly_salary'];
//    filter_input(INPUT_POST, 'cus_emp_name') = $_SESSION['cus_emp_name'];
//    $a12=$_SESSION['cus_emp_name'];
//    filter_input(INPUT_POST, 'cus_emp_address') = $_SESSION['cus_emp_address'];
//    $a13=$_SESSION['cus_emp_address'];
//    //filter_input(INPUT_POST, 'cus_addr_map_link') = $_SESSION['cus_addr_map_link'];
//    $_SESSION['cus_addr_map_link']= $cus_addr_map_link;
//    $a14=$_SESSION['cus_addr_map_link'];
//    filter_input(INPUT_POST, 'reg_date') = $_SESSION['reg_date'];
//    $a15=$_SESSION['reg_date'];
//    $a16='1';



$a2="bb";
$a3="cc";
$a4="dd";
$a5="ee";
$a6="ff";
$a7='01-01-2016';
$a8="B";
$a9="B";
$a10="B";
$a11="B";
$a12="B";
$a13="B";
$a14="B";
$a15='02-02-2016';
$a16="1";
include '../db/mysqliConnect.php';
    //start-up variable data into database

    $qu_sp_in_customerInformation = "CALL `sp_in_customerInformation`('$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11','$a12','$a13','$a14','$a15', '$a16')";


    if (mysqli_query($d_bc, $qu_sp_in_customerInformation)) {
        echo "New record created successfully";
        
    } else {
        echo "Error: " . $qu_sp_in_customerInformation . "<br>" . mysqli_error($d_bc);
    }
    
    mysqli_close($d_bc);


