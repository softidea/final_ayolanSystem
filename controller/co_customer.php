<?php
if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
$conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
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
$cus_spouse_name = "";
$cus_spouse_dob = "";
$cus_spouse_position = "";
$cus_spouse_salary = "";
$cus_spouse_emp_name = "";
$cus_addr_map_link = "";
$prop_name = "";
$prop_address = "";
$prop_tp = "";
$prop_dob = "";
$prop_nic = "";
$prop_ms = "";
//Asia/Colombo
date_default_timezone_set('Asia/Colombo');
$cus_regdate = "";


$prop_spouse_name = "";
$prop_postion = "";
$prop_salary = "";
$prop_emp_name = "";
$prop_emp_address = "";

$g1_name = "";
$g1_address = "";
$g1_tp = "";
$g1_dob = "";
$g1_nic = "";
$g1_ms = "";
$g1_spouse = "";
$g1_position = "";
$g1_salary = "";
$g1_emp_name = "";
$g1_emp_address = "";

$g2_name = "";
$g2_address = "";
$g2_tp = "";
$g2_dob = "";
$g2_nic = "";
$g2_ms = "";
$g2_spouse = "";
$g2_position = "";
$g2_salary = "";
$g2_emp_name = "";
$g2_emp_address = "";

$real_prp_house_position = "";
$real_prp_house_size = "";
$real_prp_house_value = "";
$real_prp_house_pawned = "";
$real_prp_house_pawn_getter = "";

$real_prp_other_position = "";
$real_prp_other_size = "";
$real_prp_other_value = "";
$real_prp_other_pawned = "";
$real_prp_other_pawn_getter = "";

$cus_savings_bank_branch = "";
$cus_savings_facilities = "";
$cus_savings_account_no = "";

$cus_mobile_bank_branch = "";
$cus_mobile_facilities = "";
$cus_mobile_account_no = "";

$cus_daily_loan_bank_branch = "";
$cus_daily_loan_facilities = "";
$cus_daily_loan_account_no = "";

$cus_reg_date = "";
if (isset($_POST['customer_continue'])) {

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

    $cus_spouse_name = $_SESSION['cus_spouse_name'] = filter_input(INPUT_POST, 'cus_spouse_name');
    $cus_spouse_dob = $_SESSION['cus_spouse_dob'] = filter_input(INPUT_POST, 'cus_spouse_dob');
    $cus_spouse_position = $_SESSION['cus_spouse_position'] = filter_input(INPUT_POST, 'cus_spouse_position');
    $cus_spouse_salary = $_SESSION['cus_spouse_salary'] = filter_input(INPUT_POST, 'cus_spouse_salary');
    $cus_spouse_emp_name = $_SESSION['cus_spouse_emp_name'] = filter_input(INPUT_POST, 'cus_spouse_emp_name');
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

    $g1_name = $_SESSION['g1_name'] = filter_input(INPUT_POST, 'g1_name');
    $g1_address = $_SESSION['g1_address'] = filter_input(INPUT_POST, 'g1_address');
    $g1_tp = $_SESSION['g1_tp'] = filter_input(INPUT_POST, 'g1_tp');
    $g1_dob = $_SESSION['g1_dob'] = filter_input(INPUT_POST, 'g1_dob');
    $g1_nic = $_SESSION['g1_nic'] = filter_input(INPUT_POST, 'g1_nic');
    $g1_ms = $_SESSION['g1_ms'] = filter_input(INPUT_POST, 'g1_ms');
    $g1_spouse = $_SESSION['g1_spouse'] = filter_input(INPUT_POST, 'g1_spouse');
    $g1_position = $_SESSION['g1_position'] = filter_input(INPUT_POST, 'g1_position');
    $g1_salary = $_SESSION['g1_salary'] = filter_input(INPUT_POST, 'g1_salary');
    $g1_emp_name = $_SESSION['g1_emp_name'] = filter_input(INPUT_POST, 'g1_emp_name');
    $g1_emp_address = $_SESSION['g1_emp_address'] = filter_input(INPUT_POST, 'g1_emp_address');

    $g2_name = $_SESSION['g2_name'] = filter_input(INPUT_POST, 'g2_name');
    $g2_address = $_SESSION['g2_address'] = filter_input(INPUT_POST, 'g2_address');
    $g2_tp = $_SESSION['g2_tp'] = filter_input(INPUT_POST, 'g2_tp');
    $g2_dob = $_SESSION['g2_dob'] = filter_input(INPUT_POST, 'g2_dob');
    $g2_nic = $_SESSION['g2_nic'] = filter_input(INPUT_POST, 'g2_nic');
    $g2_ms = $_SESSION['g2_ms'] = filter_input(INPUT_POST, 'g2_ms');
    $g2_spouse = $_SESSION['g2_spouse'] = filter_input(INPUT_POST, 'g2_spouse');
    $g2_position = $_SESSION['g2_position'] = filter_input(INPUT_POST, 'g2_position');
    $g2_salary = $_SESSION['g2_salary'] = filter_input(INPUT_POST, 'g2_salary');
    $g2_emp_name = $_SESSION['g2_emp_name'] = filter_input(INPUT_POST, 'g2_emp_name');
    $g2_emp_address = $_SESSION['g2_emp_address'] = filter_input(INPUT_POST, 'g2_emp_address');

    $real_prp_house_position = $_SESSION['real_prp_house_position'] = filter_input(INPUT_POST, 'real_prp_house_position');
    $real_prp_house_size = $_SESSION['real_prp_house_size'] = filter_input(INPUT_POST, 'real_prp_house_size');
    $real_prp_house_value = $_SESSION['real_prp_house_value'] = filter_input(INPUT_POST, 'real_prp_house_value');
    $real_prp_house_pawned = $_SESSION['real_prp_house_pawned'] = filter_input(INPUT_POST, 'real_prp_house_pawned');
    $real_prp_house_pawn_getter = $_SESSION['real_prp_house_pawn_getter'] = filter_input(INPUT_POST, 'real_prp_house_pawn_getter');

    $real_prp_other_position = $_SESSION['real_prp_other_position'] = filter_input(INPUT_POST, 'real_prp_other_position');
    $real_prp_other_size = $_SESSION['real_prp_other_size'] = filter_input(INPUT_POST, 'real_prp_other_size');
    $real_prp_other_value = $_SESSION['real_prp_other_value'] = filter_input(INPUT_POST, 'real_prp_other_value');
    $real_prp_other_pawned = $_SESSION['real_prp_other_pawned'] = filter_input(INPUT_POST, 'real_prp_other_pawned');
    $real_prp_other_pawn_getter = $_SESSION['real_prp_other_pawn_getter'] = filter_input(INPUT_POST, 'real_prp_other_pawn_getter');

    $cus_savings_bank_branch = $_SESSION['cus_savings_bank_branch'] = filter_input(INPUT_POST, 'cus_savings_bank_branch');
    $cus_savings_facilities = $_SESSION['cus_savings_facilities'] = filter_input(INPUT_POST, 'cus_savings_facilities');
    $cus_savings_account_no = $_SESSION['cus_savings_account_no'] = filter_input(INPUT_POST, 'cus_savings_account_no');

    $cus_mobile_bank_branch = $_SESSION['cus_mobile_bank_branch'] = filter_input(INPUT_POST, 'cus_mobile_bank_branch');
    $cus_mobile_facilities = $_SESSION['cus_mobile_facilities'] = filter_input(INPUT_POST, 'cus_mobile_facilities');
    $cus_mobile_account_no = $_SESSION['cus_mobile_account_no'] = filter_input(INPUT_POST, 'cus_mobile_account_no');

    $cus_daily_loan_bank_branch = $_SESSION['cus_daily_loan_bank_branch'] = filter_input(INPUT_POST, 'cus_daily_loan_bank_branch');
    $cus_daily_loan_facilities = $_SESSION['cus_daily_loan_facilities'] = filter_input(INPUT_POST, 'cus_daily_loan_facilities');
    $cus_daily_loan_account_no = $_SESSION['cus_daily_loan_account_no'] = filter_input(INPUT_POST, 'cus_daily_loan_account_no');

    $cus_reg_date = $_SESSION['cus_reg_date'] = filter_input(INPUT_POST, 'cus_reg_date');


    header("location:../customer/customer_addlease.php");
}
if (isset($_POST['lease_reg'])) {

    $lease_reg_date_hide = $_SESSION['lease_reg_date_hide'] = filter_input(INPUT_POST, 'lease_reg_date_hide');
     $cus_reg_date = $_SESSION['lease_reg_date_hide'] = filter_input(INPUT_POST, 'lease_reg_date_hide');
    
    $cus_name = $_SESSION['cus_name'];
    $cus_address = $_SESSION['cus_address'];
    $cus_tp = $_SESSION['cus_tp'];
    $cus_nic = $_SESSION['cus_nic'];

    //set upload nic 
    $_SESSION['img_cus_nic'] = $cus_nic;
    //set upload nic

    $cus_dob = $_SESSION['cus_dob'];
    $cus_position = $_SESSION['cus_position'];
    $cus_salary = $_SESSION['cus_salary'];
    $cus_emp_name = $_SESSION['cus_emp_name'];
    $cus_emp_address = $_SESSION['cus_emp_address'];
    $cus_ms = $_SESSION['cus_ms'];
    $cus_dependdency = $_SESSION['cus_dependdency'];

    $cus_spouse_name = $_SESSION['cus_spouse_name'];
    $cus_spouse_dob = $_SESSION['cus_spouse_dob'];
    $cus_spouse_position = $_SESSION['cus_spouse_position'];
    $cus_spouse_salary = $_SESSION['cus_spouse_salary'];
    $cus_spouse_emp_name = $_SESSION['cus_spouse_emp_name'];
    $cus_addr_map_link = $_SESSION['cus_addr_map_link'];

    $prop_name = $_SESSION['prop_name'];
    $prop_address = $_SESSION['prop_address'];
    $prop_tp = $_SESSION['prop_tp'];
    $prop_dob = $_SESSION['prop_dob'];
    $prop_nic = $_SESSION['prop_nic'];
    $prop_ms = $_SESSION['prop_ms'];


    $prop_spouse_name = $_SESSION['prop_spouse_name'];
    $prop_postion = $_SESSION['prop_postion'];
    $prop_salary = $_SESSION['prop_salary'];
    $prop_emp_name = $_SESSION['prop_emp_name'];
    $prop_emp_address = $_SESSION['prop_emp_address'];

    $g1_name = $_SESSION['g1_name'];
    $g1_address = $_SESSION['g1_address'];
    $g1_tp = $_SESSION['g1_tp'];
    $g1_dob = $_SESSION['g1_dob'];
    $g1_nic = $_SESSION['g1_nic'];
    $g1_ms = $_SESSION['g1_ms'];
    $g1_spouse = $_SESSION['g1_spouse'];
    $g1_position = $_SESSION['g1_position'];
    $g1_salary = $_SESSION['g1_salary'];
    $g1_emp_name = $_SESSION['g1_emp_name'];
    $g1_emp_address = $_SESSION['g1_emp_address'];

    $g2_name = $_SESSION['g2_name'];
    $g2_address = $_SESSION['g2_address'];
    $g2_tp = $_SESSION['g2_tp'];
    $g2_dob = $_SESSION['g2_dob'];
    $g2_nic = $_SESSION['g2_nic'];
    $g2_ms = $_SESSION['g2_ms'];
    $g2_spouse = $_SESSION['g2_spouse'];
    $g2_position = $_SESSION['g2_position'];
    $g2_salary = $_SESSION['g2_salary'];
    $g2_emp_name = $_SESSION['g2_emp_name'];
    $g2_emp_address = $_SESSION['g2_emp_address'];

    $real_prp_house_position = $_SESSION['real_prp_house_position'];
    $real_prp_house_size = $_SESSION['real_prp_house_size'];
    $real_prp_house_value = $_SESSION['real_prp_house_value'];
    $real_prp_house_pawned = $_SESSION['real_prp_house_pawned'];
    $real_prp_house_pawn_getter = $_SESSION['real_prp_house_pawn_getter'];

    $real_prp_other_position = $_SESSION['real_prp_other_position'];
    $real_prp_other_size = $_SESSION['real_prp_other_size'];
    $real_prp_other_value = $_SESSION['real_prp_other_value'];
    $real_prp_other_pawned = $_SESSION['real_prp_other_pawned'];
    $real_prp_other_pawn_getter = $_SESSION['real_prp_other_pawn_getter'];

    $cus_savings_bank_branch = $_SESSION['cus_savings_bank_branch'];
    $cus_savings_facilities = $_SESSION['cus_savings_facilities'];
    $cus_savings_account_no = $_SESSION['cus_savings_account_no'];

    $cus_mobile_bank_branch = $_SESSION['cus_mobile_bank_branch'];
    $cus_mobile_facilities = $_SESSION['cus_mobile_facilities'];
    $cus_mobile_account_no = $_SESSION['cus_mobile_account_no'];

    $cus_daily_loan_bank_branch = $_SESSION['cus_daily_loan_bank_branch'];
    $cus_daily_loan_facilities = $_SESSION['cus_daily_loan_facilities'];
    $cus_daily_loan_account_no = $_SESSION['cus_daily_loan_account_no'];


    $service_code = $_SESSION['service_code'] = filter_input(INPUT_POST, 'service_code');
    $service_no = $_SESSION['service_no'] = filter_input(INPUT_POST, 'service_no');
    $service_number = $service_code . "-" . $service_no;
    $_SESSION['ser_number'] = $service_number;
    $vehicle_category = $_SESSION['vehicle_category'] = filter_input(INPUT_POST, 'vehicle_category');
    $vehicle_brand = $_SESSION['vehicle_brand'] = filter_input(INPUT_POST, 'vehicle_brand');
    $vehicle_type = $_SESSION['vehicle_type'] = filter_input(INPUT_POST, 'vehicle_type');
    $vehicle_num = $_SESSION['vehicle_no'] = filter_input(INPUT_POST, 'vehicle_no');
    

    $engine_number = $_SESSION['engine_number'] = filter_input(INPUT_POST, 'engine_number');
    $chassis_number = $_SESSION['chassis_number'] = filter_input(INPUT_POST, 'chassis_number');
    $fixed_rate = $_SESSION['fixed_rate'] = filter_input(INPUT_POST, 'fixed_rate');
    $cbo_loan_duration = $_SESSION['cbo_loan_duration'] = filter_input(INPUT_POST, 'cbo_loan_duration');
    $ser_installment = $_SESSION['ser_installment'] = filter_input(INPUT_POST, 'ser_installment');
    $loan_description = $_SESSION['loan_description'] = filter_input(INPUT_POST, 'loan_description');
    $province_code = $_SESSION['province_code'] = filter_input(INPUT_POST, 'province_code');

   

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
        '$cus_reg_date',
        '1',
        '$cus_spouse_name',
        '$cus_spouse_dob',
        '$cus_spouse_position',
        '$cus_spouse_salary',
        '$cus_spouse_emp_name',
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
    //saving customer~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    if ($save_customer) {

//Saving Cutomer Real Property~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $query_real_property1 = "INSERT INTO cus_real_property
            (
             category,
             place,
             size,
             val,
             is_pawned,
             pawn_getter,
             cus_nic,
             status)
VALUES (
        1,
        '$real_prp_house_position',
        '$real_prp_house_size',
        '$real_prp_house_value',
        '$real_prp_house_pawned',
        '$real_prp_house_pawn_getter',
        '$cus_nic',
        '1')";

        $save_property1 = mysqli_query($conn, $query_real_property1);

        $query_real_property2 = "INSERT INTO cus_real_property
            (
             category,
             place,
             size,
             val,
             is_pawned,
             pawn_getter,
             cus_nic,
             status)
VALUES (
        2,
        '$real_prp_other_position',
        '$real_prp_other_size',
        '$real_prp_other_value',
        '$real_prp_house_pawned',
        '$real_prp_house_pawn_getter',
        '$cus_nic',
        '1')";

        $save_property2 = mysqli_query($conn, $query_real_property2);

//Saving Cutomer Real Property~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//saving customer bank account details~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        $query_bank1 = "INSERT INTO cus_bnk_acc
        (
             cus_bnk_name_and_branch,
             cus_facilities,
             cus_bnk_account_no,
             idbank_acc_cat,
             cus_nic)
VALUES (
        '$cus_savings_bank_branch',
        '$cus_savings_facilities',
        '$cus_savings_account_no',
        '1',
        '$cus_nic')";

        $save_savings = mysqli_query($conn, $query_bank1);

        $query_bank2 = "INSERT INTO cus_bnk_acc
        (
             cus_bnk_name_and_branch,
             cus_facilities,
             cus_bnk_account_no,
             idbank_acc_cat,
             cus_nic)
VALUES (
        '$cus_mobile_bank_branch',
        '$cus_mobile_facilities',
        '$cus_mobile_account_no',
        '2',
        '$cus_nic')";

        $save_mobile = mysqli_query($conn, $query_bank2);

        $query_bank3 = "INSERT INTO cus_bnk_acc
        (
             cus_bnk_name_and_branch,
             cus_facilities,
             cus_bnk_account_no,
             idbank_acc_cat,
             cus_nic)
VALUES (
        '$cus_daily_loan_bank_branch',
        '$cus_daily_loan_facilities',
        '$cus_daily_loan_account_no',
        '3',
        '$cus_nic')";

        $save_daily_loan = mysqli_query($conn, $query_bank3);

//saving customer bank account details~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//saving leasing~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        
        $check_service = "SELECT * FROM service WHERE ser_number='$service_number'";
        $run_check = mysqli_query($conn, $check_service);
        if (mysqli_num_rows($run_check) > 0) {
            echo "<script>alert('Service already added');</script>";
            echo "<script>window.location.href='../customer/customer_addlease.php';</script>";
            
        } else {
            $query_lease = "INSERT INTO `ayolanin_test`.`service`
            (
             `ser_number`,
             `vehicle_category`,
             `vehicle_brand`,
             `vehicle_type`,
             `vehicle_no`,
             `engine_number`,
             `chassis_number`,
             `fix_rate`,
             `period`,
             `installment`,
             `description`,
             `province_code`,
             `ser_date`,
             `refrence_person`,
             `ser_status`,
             `cus_nic`)
VALUES (
        '$service_number',
        '$vehicle_category',
        '$vehicle_brand',
        '$vehicle_type',
        '$vehicle_num',
        '$engine_number',
        '$chassis_number',
        '$fixed_rate',
        '$cbo_loan_duration',
        '$ser_installment',
        '$loan_description',
        '$province_code',
        '$lease_reg_date_hide',
        '$reference_person',
        '1',
        '$cus_nic')";

            $save_lease = mysqli_query($conn, $query_lease);

//saving leasing~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// saving gurantors~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $query_guarantor1 = "INSERT INTO guarantor
            (
             ger_fullname,
             ger_address,
             ger_tp,
             ger_nic,
             ger_dob,
             ger_ms,
             ger_wife_name,
             ger_position,
             ger_salerry,
             ger_emp_name,
             ger_emp_address,
             ger_status,
             ser_number)
VALUES (
        '$g1_name',
        '$g1_address',
        '$g1_tp',
        '$g1_nic',
        '$g1_dob',
        '$g1_ms',
        '$g1_spouse',
        '$g1_position',
        '$g1_salary',
        '$g1_emp_name',
        '$g1_emp_address',
        '1',
        '$service_number');";

            $save_g1 = mysqli_query($conn, $query_guarantor1);

            $query_guarantor2 = "INSERT INTO guarantor
            (
             ger_fullname,
             ger_address,
             ger_tp,
             ger_nic,
             ger_dob,
             ger_ms,
             ger_wife_name,
             ger_position,
             ger_salerry,
             ger_emp_name,
             ger_emp_address,
             ger_status,
             ser_number)
VALUES (
        '$g2_name',
        '$g2_address',
        '$g2_tp',
        '$g2_nic',
        '$g2_dob',
        '$g2_ms',
        '$g2_spouse',
        '$g2_position',
        '$g2_salary',
        '$g2_emp_name',
        '$g2_emp_address',
        '1',
        '$service_number');";

            $save_g2 = mysqli_query($conn, $query_guarantor2);


            if ($save_lease) {
                if ($save_savings && $save_mobile && $save_daily_loan && $save_property1 && $save_property2 && $save_lease && $save_g1 && $save_g2) {
                    echo "<script>alert('Customer Lease has been sussfully added');</script>";
                    echo "<script>window.location.href='../user/user_home.php';</script>";
                    
                    $_SESSION['cus_nic'] = "";
                    $_SESSION['cus_name'] = "";
                } else {
                    echo "Error while Saving";
                }
            } else {
                echo "Error while Saving save lease";
            }
        }
// saving gurantors~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    } else {
        echo "Error";
    }
}
?>