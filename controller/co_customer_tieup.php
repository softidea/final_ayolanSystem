<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require '../db/newDB.php';

$customer_nic = filter_input(INPUT_GET, 'cus_nic');
$customer_tp = filter_input(INPUT_GET, 'cus_tp');
$c_s_nic = filter_input(INPUT_GET, 'c_s_nic');
$c_s_tp = filter_input(INPUT_GET, 'c_s_tp');
$ser_value = filter_input(INPUT_GET, 'ser_value');
$ser_no_g = filter_input(INPUT_GET, 'ser_no_g');
$gua_nic = filter_input(INPUT_GET, 'gua_nic');
$g_as_c_nic = filter_input(INPUT_GET, 'g_as_c_nic');
$g_sno_search = filter_input(INPUT_GET, 'g_sno_search');
$ser_value_cus_installment = filter_input(INPUT_GET, 'ser_value_cus_installment');
$cus_ins_ser_number = filter_input(INPUT_GET, 'cus_ins_ser_number');


if (isset($customer_nic)) {
    global $conn;
    $sql_customer = "SELECT * FROM customer WHERE cus_nic='$customer_nic'";
    $run_customer = mysqli_query($conn, $sql_customer);
    if (mysqli_num_rows($run_customer) > 0) {
        if ($row = mysqli_fetch_assoc($run_customer)) {
            $tp = $row['cus_tp'];
            $name = $row['cus_fullname'];
            $address = $row['cus_address'];
            echo $tp . "#" . $name . "#" . $address;
        }
    }
}
if (isset($customer_tp)) {
    global $conn;
    $sql_customer = "SELECT * FROM customer WHERE cus_tp='$customer_tp'";
    $run_customer = mysqli_query($conn, $sql_customer);
    if (mysqli_num_rows($run_customer) > 0) {
        if ($row = mysqli_fetch_assoc($run_customer)) {
            $nic = $row['cus_nic'];
            $name = $row['cus_fullname'];
            $address = $row['cus_address'];
            echo $nic . "#" . $name . "#" . $address;
        }
    }
}
if (isset($c_s_nic)) {
    global $conn;
    $sql_service = "SELECT ser_number FROM service WHERE cus_nic='$c_s_nic'";
    $run_service = mysqli_query($conn, $sql_service);
    if (mysqli_num_rows($run_service) > 0) {
        echo "<option value='0'> --- Please Select Service --- </option>";
        while ($row = mysqli_fetch_array($run_service)) {
            $service_no = $row['ser_number'];
            echo "<option value='$service_no'>$service_no</option>";
        }
    }
}
if (isset($c_s_tp)) {
    global $conn;
    $sql_query = "SELECT cus_nic FROM customer WHERE cus_tp='$c_s_tp'";
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {
        if ($row = mysqli_fetch_assoc($run_query)) {
            $nic = $row['cus_nic'];

            $sql_service = "SELECT ser_number FROM service WHERE cus_nic='$nic'";
            $run_service = mysqli_query($conn, $sql_service);
            if (mysqli_num_rows($run_service) > 0) {
                echo "<option value='0'> --- Please Select Service --- </option>";
                while ($row = mysqli_fetch_array($run_service)) {
                    $service_no = $row['ser_number'];
                    echo "<option value='$service_no'>$service_no</option>";
                }
            }
        }
    }
}
if (isset($ser_value)) {
    global $conn;
    $sql_query = "SELECT * FROM service WHERE ser_number='$ser_value'";
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {
        if ($row = mysqli_fetch_assoc($run_query)) {
            $rental = $row['fix_rate'];
            $period = $row['period'];
            $installment = $row['installment'];
            echo $rental . "#" . $period . "#" . $installment;
        }
    }
}
if (isset($ser_no_g)) {
    global $conn;
    $sql_query = "SELECT ger_nic FROM guarantor WHERE ser_number='$ser_no_g'";
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {
        echo "<option value='0'> --- Please Select --- </option>";
        while ($row = mysqli_fetch_array($run_query)) {
            $g_nic = $row['ger_nic'];
            echo "<option value='$g_nic'>$g_nic</option>";
        }
    }
}
if (isset($gua_nic)) {
    global $conn;
    $sql_query = "SELECT * FROM guarantor WHERE ger_nic='$gua_nic'";
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {
        if ($row = mysqli_fetch_assoc($run_query)) {
            $tp = $row['ger_tp'];
            $name = $row['ger_fullname'];
            $address = $row['ger_address'];
            echo $tp . "#" . $name . "#" . $address;
        }
    }
}
if (isset($g_as_c_nic)) {
    global $conn;
    $sql_query = "SELECT ser_number FROM service WHERE cus_nic='$g_as_c_nic'";
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {
        echo "<option value='0'> --- Please Select --- </option>";
        while ($row = mysqli_fetch_array($run_query)) {
            $service_num = $row['ser_number'];
            echo "<option value='$service_num'>$service_num</option>";
        }
    } else {
        echo "No Services Found";
    }
}
if (isset($g_sno_search)) {
    global $conn;
    $sql_query = "SELECT * FROM service WHERE ser_number='$g_sno_search'";
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {
        if ($row = mysqli_fetch_assoc($run_query)) {
            $rental = $row['fix_rate'];
            $period = $row['period'];
            $installment = $row['installment'];
            echo $rental . "#" . $period . "#" . $installment;
        }
    } else {
        echo 'No Gurantor Services Found';
    }
}

?>