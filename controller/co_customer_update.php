<?php

require '../db/newDB.php';

$cust_nic = filter_input(INPUT_GET, 'customer_nic');

$conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
if (mysqli_connect_errno()) {
    echo "Falied to Connect the Database" . mysqli_connect_error();
}

if ($cust_nic != "" && $cust_nic != null) {


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
    $cus_regdate = date("Y-m-d");

    $prop_spouse_name = "";
    $prop_postion = "";
    $prop_salary = "";
    $prop_emp_name = "";
    $prop_emp_address = "";

    $g1_id = "";
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

    $g2_id = "";
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




    $customer_table_data_quarry = "SELECT 

  `cus_fullname`,
  `cus_address`,
  `cus_tp`,
  `cus_nic`,
  `cus_dob`,
  `cus_ms`,
  `cus_dependdency`,
  `cus_position`,
  `cus_monthly_salary`,
  `cus_emp_name`,
  `cus_emp_address`,
  `cus_addr_map_link`,
  `cus_reg_date`,
  `cus_status`,
  `wife_name`,
  `wife_dob`,
  `wife_position`,
  `wife_salary`,
  `wife_emp_name`,
  `proposer_name`,
  `proposer_address`,
  `proposer_tp`,
  `proposer_dob`,
  `proposer_nic`,
  `proposer_ms`,
  `proposer_spouse`,
  `proposer_position`,
  `proposer_salary`,
  `proposer_employer`,
  `proposer_emp_address` 
FROM
  `customer` 
  where `cus_nic` ='" . $cust_nic . "'";
    $result_customer_all = mysqli_query($conn, $customer_table_data_quarry);

    if ($result_customer_all) {
        $cus_row = mysqli_fetch_assoc($result_customer_all);


        $cus_name = $cus_row['cus_fullname'];
        $cus_address = $cus_row['cus_address'];
        $cus_tp = $cus_row['cus_tp'];
        $cus_nic = $cus_row['cus_nic'];
        $cus_dob = $cus_row['cus_dob'];
        $cus_position = $cus_row['cus_position'];
        $cus_salary = $cus_row['cus_monthly_salary'];
        $cus_emp_name = $cus_row['cus_emp_name'];
        $cus_emp_address = $cus_row['cus_emp_address'];
        $cus_ms = $cus_row['cus_ms'];
        $cus_dependdency = $cus_row['cus_dependdency'];
        $cus_spouse_name = $cus_row['wife_name'];
        $cus_spouse_dob = $cus_row['wife_dob'];
        $cus_spouse_position = $cus_row['wife_position'];
        $cus_spouse_salary = $cus_row['wife_salary'];
        $cus_spouse_emp_name = $cus_row['wife_emp_name'];
        $cus_addr_map_link = $cus_row['cus_addr_map_link'];
        $prop_name = $cus_row['proposer_name'];
        $prop_address = $cus_row['proposer_address'];
        $prop_tp = $cus_row['proposer_tp'];
        $prop_dob = $cus_row['proposer_dob'];
        $prop_nic = $cus_row['proposer_nic'];
        $prop_ms = $cus_row['proposer_ms'];
//Asia/Colombo
        date_default_timezone_set('Asia/Colombo');
        $cus_regdate = $cus_row['cus_reg_date'];

        $prop_spouse_name = $cus_row['proposer_spouse'];
        $prop_postion = $cus_row['proposer_position'];
        $prop_salary = $cus_row['proposer_salary'];
        $prop_emp_name = $cus_row['proposer_employer'];
        $prop_emp_address = $cus_row['proposer_emp_address'];
    } else {
        die(mysql_error());
    }
    $gerenter_table_data_quarry = "select 
  g.`ger_id`,
  g.`ger_fullname`,
  g.`ger_address`,
  g.`ger_tp`,
  g.`ger_nic`,
  g.`ger_dob`,
  g.`ger_ms`,
  g.`ger_wife_name`,
  g.`ger_position`,
  g.`ger_salerry`,
  g.`ger_emp_name`,
  g.`ger_emp_address`,
  g.`ger_status`
from
  `guarantor` g left join `service` s on g.`ser_number`=s.`ser_number` where s.`cus_nic` ='" . $cust_nic . "'";
    $result_ger_all = mysqli_query($conn, $gerenter_table_data_quarry);
    $count = 1;

    if ($ger_row = mysqli_fetch_assoc($result_ger_all)) {
        $g1_id = $ger_row['ger_id'];
        $g1_name = $ger_row['ger_fullname'];
        $g1_address = $ger_row['ger_address'];
        $g1_tp = $ger_row['ger_tp'];
        $g1_dob = $ger_row['ger_dob'];
        $g1_nic = $ger_row['ger_nic'];
        $g1_ms = $ger_row['ger_ms'];
        $g1_spouse = $ger_row['ger_wife_name'];
        $g1_position = $ger_row['ger_position'];
        $g1_salary = $ger_row['ger_salerry'];
        $g1_emp_name = $ger_row['ger_emp_name'];
        $g1_emp_address = $ger_row['ger_emp_address'];
    }

    while ($ger_row = mysqli_fetch_assoc($result_ger_all)) {


        $count = 2;
        if ($count = 2) {
            $g2_id = $ger_row['ger_id'];
            $g2_name = $ger_row['ger_fullname'];
            $g2_address = $ger_row['ger_address'];
            $g2_tp = $ger_row['ger_tp'];
            $g2_dob = $ger_row['ger_dob'];
            $g2_nic = $ger_row['ger_nic'];
            $g2_ms = $ger_row['ger_ms'];
            $g2_spouse = $ger_row['ger_wife_name'];
            $g2_position = $ger_row['ger_position'];
            $g2_salary = $ger_row['ger_salerry'];
            $g2_emp_name = $ger_row['ger_emp_name'];
            $g2_emp_address = $ger_row['ger_emp_address'];
        }
    }




    if (!($result_ger_all)) {
        die(mysql_error());
    }

    $real_prp_house_quarry = "SELECT 
  `real_property_id`,
  `category`,
  `place`,
  `size`,
  `val`,
  `is_pawned`,
  `pawn_getter`,
  `cus_nic`,
  `status` 
FROM
  `cus_real_property` WHERE `category`='1' AND `cus_nic`='" . $cust_nic . "'";

    $real_prp_other_quarry = "SELECT 
  `real_property_id`,
  `category`,
  `place`,
  `size`,
  `val`,
  `is_pawned`,
  `pawn_getter`,
  `cus_nic`,
  `status` 
FROM
  `cus_real_property` WHERE `category`='2' AND `cus_nic`='" . $cust_nic . "'";

    $result_prop_home = mysqli_query($conn, $real_prp_house_quarry);
    $result_prop_other = mysqli_query($conn, $real_prp_other_quarry);

    if ($result_prop_home and $result_prop_other) {

        $real_prp_house_row = mysqli_fetch_assoc($result_prop_home);
        $real_prp_other_row = mysqli_fetch_assoc($result_prop_other);

        $real_prp_house_position = $real_prp_house_row['place'];
        $real_prp_house_size = $real_prp_house_row['size'];
        $real_prp_house_value = $real_prp_house_row['val'];
        $real_prp_house_pawned = $real_prp_house_row['is_pawned'];
        $real_prp_house_pawn_getter = $real_prp_house_row['pawn_getter'];

        $real_prp_other_position = $real_prp_other_row['place'];
        $real_prp_other_size = $real_prp_other_row['size'];
        $real_prp_other_value = $real_prp_other_row['val'];
        $real_prp_other_pawned = $real_prp_other_row['is_pawned'];
        $real_prp_other_pawn_getter = $real_prp_other_row['pawn_getter'];
    }

    $cus_savings_bank_quarry = "SELECT 
  `idcus_bnk_acc`,
  `cus_bnk_name_and_branch`,
  `cus_facilities`,
  `cus_bnk_account_no`,
  `idbank_acc_cat`,
  `cus_nic` 
FROM
  `cus_bnk_acc` 
WHERE `idbank_acc_cat`='1' AND `cus_nic`='" . $cust_nic . "'
";
    $cus_mobile_bank_quarry = "SELECT 
  `idcus_bnk_acc`,
  `cus_bnk_name_and_branch`,
  `cus_facilities`,
  `cus_bnk_account_no`,
  `idbank_acc_cat`,
  `cus_nic` 
FROM
  `cus_bnk_acc` 
WHERE `idbank_acc_cat`='2' AND `cus_nic`='" . $cust_nic . "'
";
    $cus_daily_loan_bank_quarry = "SELECT 
  `idcus_bnk_acc`,
  `cus_bnk_name_and_branch`,
  `cus_facilities`,
  `cus_bnk_account_no`,
  `idbank_acc_cat`,
  `cus_nic` 
FROM
  `cus_bnk_acc` 
WHERE `idbank_acc_cat`='3' AND `cus_nic`='" . $cust_nic . "'
";

    $result_cus_savings_bank = mysqli_query($conn, $cus_savings_bank_quarry);
    $result_mobile_bank_quarry = mysqli_query($conn, $cus_mobile_bank_quarry);
    $result_cus_daily_loan_bank = mysqli_query($conn, $cus_daily_loan_bank_quarry);

    if ($result_cus_savings_bank and $result_mobile_bank_quarry and $result_cus_daily_loan_bank) {

        $cus_savings_bank_row = mysqli_fetch_assoc($result_cus_savings_bank);
        $cus_mobile_bank_row = mysqli_fetch_assoc($result_mobile_bank_quarry);
        $cus_daily_loan_bank_row = mysqli_fetch_assoc($result_cus_daily_loan_bank);

        $cus_savings_bank_branch = $cus_savings_bank_row['cus_bnk_name_and_branch'];
        $cus_savings_facilities = $cus_savings_bank_row['cus_facilities'];
        $cus_savings_account_no = $cus_savings_bank_row['cus_bnk_account_no'];

        $cus_mobile_bank_branch = $cus_mobile_bank_row['cus_bnk_name_and_branch'];
        $cus_mobile_facilities = $cus_mobile_bank_row['cus_facilities'];
        $cus_mobile_account_no = $cus_mobile_bank_row['cus_bnk_account_no'];

        $cus_daily_loan_bank_branch = $cus_daily_loan_bank_row['cus_bnk_name_and_branch'];
        $cus_daily_loan_facilities = $cus_daily_loan_bank_row['cus_facilities'];
        $cus_daily_loan_account_no = $cus_daily_loan_bank_row['cus_bnk_account_no'];
    }
    echo $cus_name . "#" . $cus_address . "#" . $cus_tp . "#" . $cus_nic . "#" . $cus_dob . "#" . $cus_position . "#" . $cus_salary . "#" . $cus_emp_name . "#" . $cus_emp_address . "#" . $cus_ms . "#" . $cus_dependdency . "#" . $cus_spouse_name . "#" . $cus_spouse_dob . "#" . $cus_spouse_position . "#" . $cus_spouse_salary . "#" . $cus_spouse_emp_name . "#" . $prop_name . "#" . $prop_address . "#" . $prop_tp . "#" . $prop_dob . "#" . $prop_nic . "#" . $prop_ms . "#" . $cus_regdate . "#" . $prop_spouse_name . "#" . $prop_postion . "#" . $prop_salary . "#" . $prop_emp_name . "#" . $prop_emp_address . "#" . $g1_name . "#" . $g1_address . "#" . $g1_tp . "#" . $g1_dob . "#" . $g1_nic . "#" . $g1_ms . "#" . $g1_spouse . "#" . $g1_position . "#" . $g1_salary . "#" . $g1_emp_name . "#" . $g1_emp_address . "#" . $g2_name . "#" . $g2_address . "#" . $g2_tp . "#" . $g2_dob . "#" . $g2_nic . "#" . $g2_ms . "#" . $g2_spouse . "#" . $g2_position . "#" . $g2_emp_name . "#" . $g2_emp_address . "#" . $real_prp_house_position . "#" . $real_prp_house_size . "#" . $real_prp_house_value . "#" . $real_prp_house_pawned . "#" . $real_prp_house_pawn_getter . "#" . $real_prp_other_position . "#" . $real_prp_other_size . "#" . $real_prp_other_value . "#" . $real_prp_other_pawned . "#" . $real_prp_other_pawn_getter . "#" . $cus_savings_bank_branch . "#" . $cus_savings_facilities . "#" . $cus_savings_account_no . "#" . $cus_mobile_bank_branch . "#" . $cus_mobile_facilities . "#" . $cus_mobile_account_no . "#" . $cus_daily_loan_bank_branch . "#" . $cus_daily_loan_facilities . "#" . $cus_daily_loan_account_no . "#" . $g1_id . "#" . $g2_id;
}
?>