<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}


require '../db/newDB.php';



global $conn;
$sno_begin_ins = "HOR-1000";

$sql_query = "SELECT * FROM service WHERE ser_number='$sno_begin_ins'";
$run_query = mysqli_query($conn, $sql_query);
if (mysqli_num_rows($run_query) > 0) {
    if ($row = mysqli_fetch_assoc($run_query)) {
        $installment = $row['installment'];
        str_replace(",", "", $installment);
        $service_date = $row['ser_date'];




        list($year, $month, $date) = explode("-", $service_date);
        $fix_date = intval($date);

        date_default_timezone_set('Asia/Colombo');
        $paid_date = date("Y-m-d");
        $paid_date = "2016-07-20";


        list($current_year, $current_month, $current_date) = explode("-", $paid_date);



        if ($year == $current_year) {
            if ($month == $current_month) {
                $val = $current_date - $date;
                echo $val . "upper val<br>";
                if ($date == $current_date) {
                    if ($fix_date > 0 && $fix_date <= 5) {
                        $installment_date = $year . "-" . ($month + 1) . "-" . '5';
                        echo $installment_date . "#" . $installment;
                    } else if ($fix_date > 5 && $fix_date <= 10) {
                        $installment_date = $year . "-" . ($month + 1) . "-" . '10';
                        echo $installment_date . "#" . $installment;
                    } else if ($fix_date > 10 && $fix_date <= 15) {
                        $installment_date = $year . "-" . ($month + 1) . "-" . '15';
                        echo $installment_date . "#" . $installment;
                    } else if ($fix_date > 15 && $fix_date <= 20) {
                        $installment_date = $year . "-" . ($month + 1) . "-" . '20';
                        echo $installment_date . "#" . $installment;
                    } else if ($fix_date > 20 && $fix_date <= 25) {
                        $installment_date = $year . "-" . ($month + 1) . "-" . '25';
                        echo $installment_date . "#" . $installment;
                    } else if ($fix_date > 25 && $fix_date <= 31) {
                        $installment_date = $year . "-" . ($month + 1) . "-" . '25';
                        echo $installment_date . "#" . $installment;
                    }
                } else {
                    if ($current_date > $date) {
                        $date_range = $current_date - $date;
                        $month_range=$current_month-$month;
                        echo $val . "<br>";
                        if ($date_range>0 && $date_range < 7) {
                            
                            calculate_Interest($installment,0);
                            
                            if ($fix_date > 0 && $fix_date <= 5) {
                                $installment_date = $year . "-" . ($month + 1) . "-" . '5';
                                echo $installment_date . "#" . $installment;
                            } else if ($fix_date > 5 && $fix_date <= 10) {
                                $installment_date = $year . "-" . ($month + 1) . "-" . '10';
                                echo $installment_date . "#" . $installment;
                            } else if ($fix_date > 10 && $fix_date <= 15) {
                                $installment_date = $year . "-" . ($month + 1) . "-" . '15';
                                echo $installment_date . "#" . $installment;
                            } else if ($fix_date > 15 && $fix_date <= 20) {
                                $installment_date = $year . "-" . ($month + 1) . "-" . '20';
                                echo $installment_date . "#" . $installment;
                            } else if ($fix_date > 20 && $fix_date <= 25) {
                                $installment_date = $year . "-" . ($month + 1) . "-" . '25';
                                echo $installment_date . "#" . $installment;
                            } else if ($fix_date > 25 && $fix_date <= 31) {
                                $installment_date = $year . "-" . ($month + 1) . "-" . '25';
                                echo $installment_date . "#" . $installment;
                            }
                        } else if ($date_range > 7) {
                            
                            if ($date_range > 7 && $date_range < 15) {
                                
                                echo $date_range . "bttom";
                               calculate_Interest($installment, 5);
                               
                            } else if ($date_range>15 && $month_range==1) {
                                
                                calculate_Interest($installment, 10);
                            }
                            
                            
                        }
                        }
                    }
                }
            } else {
//                if () {
//                
//            }}
            }
        } else {
//            if () {
//            
//        }
        }
    }
    function calculate_Interest($installment,$presentage){
        $interest = ($installment * $presentage / 100) + $installment;
        echo $interest."--inner function---";
    }
?>