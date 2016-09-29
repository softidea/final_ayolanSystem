<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}

require '../db/newDB.php';

$deed_no = filter_input(INPUT_GET, 'deed_no');
$deed_no_for_check_ins = filter_input(INPUT_GET, 'deed_no_for_check_ins');
$deed_number = filter_input(INPUT_GET, 'deed_number');
$save_installment_deed_no = filter_input(INPUT_GET, 'save_installment_deed_no');
$paid_date = filter_input(INPUT_GET, 'paid_date');
$payment = filter_input(INPUT_GET, 'payment');
$save_settlment_deed_no = filter_input(INPUT_GET, 'save_settlment_deed_no');
$requiredpayment = filter_input(INPUT_GET, 'requiredpayment');

$cus_nic = filter_input(INPUT_GET, 'cus_nic');

date_default_timezone_set('Asia/Colombo');
$current_date = date("Y-m-d");


if($cus_nic!=null && $cus_nic!=""){
    global $conn;
    $load_customer="SELECT cus_nic FROM land_pawns WHERE cus_nic='$cus_nic'";
    $load_query=  mysqli_query($conn, $load_customer);
    if(mysqli_num_rows($load_customer)>0){
        
        $load_details = "SELECT * FROM customer WHERE cus_nic='$cus_nic'";
        $run_details=  mysqli_query($conn, $load_details);
        if(mysqli_num_rows($run_details)>0){
            if($row_details=  mysqli_fetch_array($run_details)){
                $cus_name=$row_details['cus_fullname'];
                $cus_tp=$row_details['cus_tp'];
                $cus_address=$row_details['cus_address'];
                $cus_reg_date=$row_details['cus_reg_date'];
                echo $cus_name."#".$cus_tp."#".$cus_address."#".$cus_reg_date;
                
            }
        }
    }
    
}

if (isset($deed_no)) {
    $deed_query = "SELECT * FROM land_pawns WHERE deed_no='$deed_no'";
    $run_deed = mysqli_query($conn, $deed_query);
    if (mysqli_num_rows($run_deed) > 0) {
        if ($deed_row = mysqli_fetch_assoc($run_deed)) {
            $pawn_period = $deed_row['period'];
            $pawn_amount = $deed_row['amount'];
            $pawn_rental = $deed_row['pawn_rental'];
            $cus_nic = $deed_row['cus_nic'];
            $deed_reg_date = $deed_row['deed_reg_date'];
            $cus_query = "SELECT * FROM customer WHERE cus_nic='$cus_nic'";
            $cus_run = mysqli_query($conn, $cus_query);
            if (mysqli_num_rows($cus_run) > 0) {
                if ($cus_row = mysqli_fetch_assoc($cus_run)) {
                    $cus_name = $cus_row['cus_fullname'];
                    $cus_tp = $cus_row['cus_tp'];
                    $cus_address = $cus_row['cus_address'];
                    
                    $year_query = "SELECT year FROM land_pawn_year WHERE year_id='$pawn_period'";
                    $run_year = mysqli_query($conn, $year_query);
                    if (mysqli_num_rows($run_year) > 0) {
                        if ($row_year = mysqli_fetch_assoc($run_year)) {
                            $year = $row_year['year'];
                            $amount_query = "SELECT pawn_amount FROM pawn_amount WHERE amount_id='$pawn_amount'";
                            $run_amount = mysqli_query($conn, $amount_query);
                            if (mysqli_num_rows($run_amount) > 0) {
                                if ($row_amount = mysqli_fetch_assoc($run_amount)) {
                                    $amount = $row_amount['pawn_amount'];
                                    echo $year . "#" . $amount . "#" . $pawn_rental . "#" . $cus_nic . "#" . $cus_name . "#" . $cus_tp . "#" . $cus_address . "#" . $deed_reg_date;
                                }
                            } else {
                                echo 'No Pawn Amount Found';
                            }
                        }
                    } else {
                        echo "No Period Found";
                    }
                }
            } else {
                echo 'No Customer Found';
            }
        }
    } else {
        echo 'No Land Found';
    }
}


if (isset($save_installment_deed_no) && isset($paid_date) && isset($payment)) {

    $save_pawn_installment = "INSERT INTO pawn_installment (date,paid_date,payment,customer_due,company_due,deed_no) VALUES ('NA','$paid_date','$payment','NA','NA','$save_installment_deed_no')";
    $run_save_pawn_installment = mysqli_query($conn, $save_pawn_installment);
    if ($run_save_pawn_installment) {
        echo "Pawn Installment successfully addedf";
    } else {
        echo "Error while adding pawn installment";
    }
}
if (isset($save_settlment_deed_no) && isset($current_date) && isset($payment) && isset($requiredpayment)) {
    
    $check_status = "SELECT pawn_status FROM land_pawns WHERE deed_no='$save_settlment_deed_no' AND pawn_status='1'";
        $run_check = mysqli_query($conn, $check_status);
        if ($run_check_res=  mysqli_fetch_array($run_check)) {

    if ($payment == $requiredpayment) {
        $save_pawn_settlment = "INSERT INTO pawn_installment (date,paid_date,payment,customer_due,company_due,deed_no) VALUES ('NA','$current_date','$payment','NA','NA','$save_settlment_deed_no')";
        $run_save_pawn_settlment = mysqli_query($conn, $save_pawn_settlment);
        if ($run_save_pawn_settlment) {
            
            $update_pawn="UPDATE land_pawns SET pawn_status='0' WHERE deed_no='$save_installment_deed_no'";
            $run_update_pawn=  mysqli_query($conn, $update_pawn);
            if($run_update_pawn){
                 echo "Pawn Settled successfully";
            }
            
        } else {
            echo "Error while pawn Settling";
        }
    } else {
        echo 'Setllment payment must be qual to required amount';
    }
    
        }else{
            echo 'Cannot complete the Transaction,Lease already settled';
        }
}



if (isset($deed_no_for_check_ins)) {
    $installment_query = "SELECT * FROM pawn_installment WHERE deed_no='$deed_no_for_check_ins'";
    $installment_run = mysqli_query($conn, $installment_query);
    $current_row = 1;
    if (mysqli_num_rows($installment_run) > 0) {
        while ($installment_row = mysqli_fetch_array($installment_run)) {
            $date = $installment_row['date'];
            $paid_date = $installment_row['paid_date'];
            $payment = $installment_row['payment'];
            $customer_due = $installment_row['customer_due'];
            $company_due = $installment_row['company_due'];
            echo"<tr>";
            echo "<td>$current_row</td>";
            echo "<td>$date</td>";
            echo "<td>$paid_date</td>";
            echo "<td>$payment.00</td>";
            echo"</tr>";
            $current_row++;
        }
    } else {
        echo 'No Pawn Installment Found';
    }
}
if (isset($deed_number)) {
    PawnInstallment($deed_number);
    
}

function PawnInstallment($sno_begin_ins){
    global $conn;
    $issettled=false;
    $sql_query = "SELECT lp.*,pa.pawn_amount,py.year FROM land_pawns lp,pawn_amount pa,land_pawn_year py WHERE deed_no='$sno_begin_ins' AND lp.amount=pa.amount_id AND py.year_id=lp.period";
//    echo $sql_query;
    $run_query = mysqli_query($conn, $sql_query);
    if (mysqli_num_rows($run_query) > 0) {

        if ($row = mysqli_fetch_assoc($run_query)) {


            if (($row['pawn_status']) == 1) {

                $installment_amount = $row['pawn_rental'];
                $service_date = $row['deed_reg_date'];
                $fixed_rate = $row['year'] * 12 * $installment_amount;
            
               $period=$row['year'] * 12 ;
            
            //$service_date = "2016-04-26";

            $curr_ser_date = explode("-", $service_date)[2];

            $serv_mon_year = explode("-", $service_date)[0] . "-" . explode("-", $service_date)[1];

            $default_service_date = 1;

            if ($curr_ser_date >= 25) {
                $default_service_date = 25;
            } elseif ($curr_ser_date >= 20) {
                $default_service_date = 20;
            } elseif ($curr_ser_date >= 15) {
                $default_service_date = 15;
            } elseif ($curr_ser_date >= 10) {
                $default_service_date = 10;
            } elseif ($curr_ser_date >= 5) {
                $default_service_date = 5;
            }
            $tempservdate=$serv_mon_year . "-" . $default_service_date; 
            //echo $default_service_date;
            $rounded_off_date = $serv_mon_year . "-" . $default_service_date;           // Get the Payment Date
            // $_frst_serv_date = date('Y-m-d', strtotime('+1 month', strtotime($rounded_off_date)));
            $dis_round_date = date('Y-m-d', strtotime('+1 month', strtotime($rounded_off_date)));  //get the first payment date
            $rounded_off_date = $dis_round_date; //Assignin the First Payment Date
            $now_date = date("Y-m-d");          // Get Today's Date


            $d1 = new DateTime($rounded_off_date);  // Get First PAyment date as date
            $d2 = new DateTime($now_date);          // Get Today Date As date
            $diff = $d1->diff($d2);
            $no_of_months = (($diff->format('%y') * 12) + $diff->format('%m'));  // Get the number of months between 1st month to pay and this month
            //$d1=  strtotime($rounded_off_date);
            //$d2 = strtotime($now_date);
            //echo (($diff->format('%y') * 12) + $diff->format('%m')) . " full months difference";
            // $no_of_months = floor(($d2-$d1)/(60*60*24*30));
            
            
            
            
            
            $customer_due = 0.0;                    // Getting the initial customer due as 0
            $prv_round_date = $service_date;        // Getting the last Service date as first date
            //$installment_amount=4043;

            $now = time();                          //Get Now time
            $check_need_to_pistl = false;

            $customer_total_overpaid = 0;
            $customer_total_paid = 0;
            
            $temp_prv_round_date = "NONE";
            $balance_lease = $fixed_rate;
            $ft=true;
         
            $td2= strtotime($now_date);
            $td3= strtotime($prv_round_date);
                
            $no_of_days=  floor(($td2-$td3)/(60*60*24));
            $maxDays=date('t');
            
            //New Algorithm Change
                
           $flag_round_date=$rounded_off_date;     
           $flag_temp_prv_round = $temp_prv_round_date;
           $flag_prv_round = $prv_round_date;
                
           $payment_arr=  array(0);
           $payment_arr_calc=  array(0);
           $payment_overpaid=array(0);
           $payment_halfpaid=array(0);
           $is_arriers = array(false);
           $interstarray=array(1);
           
           for($i=0;$i<$no_of_months+3;$i++){
                array_push($is_arriers, false);
           }
           
            for($i=0;$i<$no_of_months+1;$i++){
                array_push($payment_arr_calc,0);
                array_push($payment_overpaid,0);
                array_push($payment_arr, $installment_amount);
                array_push($interstarray, 0);
                array_push($payment_halfpaid,0);
            }
            
           $lefttopay=$fixed_rate - $installment_amount*($no_of_months+1);
      

            
            
                     $mon_pay=0;
            for($i=0;$i<$no_of_months+1;$i++){
                
                  
                      
                 for($itr=(sizeof($interstarray)-1);$itr>=0;$itr--){
                      if($itr!=0){
                        $interstarray[$itr]=$interstarray[$itr-1];
                        
                        
                      }else{
                        $tempvar = $interstarray[0];
                        $interstarray[0]=$interstarray[1]+1;
                        $interstarray[1]=$tempvar;
                      }
                        
                    }
                   
                
                
                
                
                $monfreepay=0;
                $weekfreepay=0;
                $fiveppay=0;
                $tenppay=0;
                
                $freewkpass=true;
                $fivepwkpass=true;
                $tenpwkpass=true;
           
                if(true){
                    //first Month
                    
                        
                        $temp_due=$customer_due;
    
                        $sql_payment = "SELECT * FROM pawn_installment where paid_date<'$rounded_off_date' and paid_date>='$prv_round_date' and deed_no='$sno_begin_ins'";
                     //   echo $sql_payment."-1";
                        
                    
                        $run_payment = mysqli_query($conn, $sql_payment);
                        
                        $prvrounddate=  strtotime($prv_round_date);
                        
                        if($ft){
                        while($row = mysqli_fetch_assoc($run_payment)) {
                          $monfreepay+=$row['payment'];
                          $customer_total_paid+=$row['payment'];
                        }
                        
                        }else{
                           while($row = mysqli_fetch_assoc($run_payment)) {
                               $tempdate=  strtotime($row['paid_date']);
                               $tempdatediff=floor(($tempdate-$prvrounddate)/(60*60*24));
                               $customer_total_paid+=$row['payment'];
                               
                               if($tempdatediff==0){
                                   $monfreepay+=$row['payment'];
                               }elseif($tempdatediff<=7){
                                   $weekfreepay+=$row['payment'];
                               }elseif($tempdatediff<=14){
                                   $fiveppay+=$row['payment'];
                               }else{
                                   $tenppay+=$row['payment'];
                               }
                               
                           }
                            
                        }
                        
                        
                            
                      
                        $currentmonthpay=$monfreepay+$weekfreepay+$fiveppay+$tenppay;
                        
                        $temp_current_mon_pay=$currentmonthpay;
                        //echo $currentmonthpay."|$i|";
                        
                        
                        if($currentmonthpay>0){
                            
                            
                            
                           
                            for($tt=0;$tt<$i;$tt++){
                                
                                if($is_arriers[$tt]){
                                    
                                    if(($currentmonthpay!=0)&&($payment_arr_calc[$tt]-$currentmonthpay)>0){
                                         
                                        
                                        
                                        $tempvalue=$payment_arr_calc[$tt]-$currentmonthpay;
                                        $payment_arr_calc[$tt]=$tempvalue;
                                       
                                        $payment_arr[$tt]=$tempvalue;
                                        $payment_halfpaid[$tt]+=$currentmonthpay;
                                        //echo $payment_arr[$tt]."|".$tt."|".$i."|";
                                        $currentmonthpay=0;
                                        
                                    }else{
                                        if(($payment_arr_calc[$tt]-$currentmonthpay<=0)){
                                            
                                        $temparr=$payment_arr_calc[$tt];
                                        $payment_arr[$tt]=0;
                                        $payment_arr_calc[$tt]=0;
                                        $currentmonthpay=$currentmonthpay-$temparr;
                                        $is_arriers[$tt]=false;
                                        //echo $currentmonthpay."|".$tt."|".$i."|";
                                        
                                        }
                                    }
                                    
                                }else{
                                    
                                    $payment_arr_calc[$tt]=0;
                                    
                                   
                                }                               
                                
                            }      
                        }
                       //echo $currentmonthpay."|";
                       
                        //Check Period is over or not
                       
                      
                        if($currentmonthpay>0){
                            
                            $deducted=$temp_current_mon_pay-$currentmonthpay;
                            
                            if($deducted>=$monfreepay){
                                $deducted-=$monfreepay;
                                $monfreepay=0;
                             
                                
                            }else{
                                $monfreepay-=$deducted;
                                $deducted=0;
                            }
                            
                            if($deducted>=$weekfreepay){
                                $deducted-=$weekfreepay;
                                $weekfreepay=0;
                            }else{
                                $weekfreepay-=$deducted;
                                $deducted=0;
                            }
                            
                            if($deducted>=$fiveppay){
                                $deducted-=$fiveppay;
                                $fiveppay=0;
                            }else{
                                $fiveppay-=$deducted;
                                $deducted=0;
                            }
                            
                            if($deducted>=$tenppay){
                                $deducted-=$tenppay;
                                $tenppay=0;
                            }else{
                                $tenppay-=$deducted;
                                $deducted=0;
                            }
                             
                            
                            // echo $monfreepay."-".$weekfreepay."-".$fiveppay."-".$tenppay."|";
                            
                            $thismonthdue=$payment_arr[$i];
                            
                            
                            
                            
                            if($thismonthdue<=$monfreepay){
                                
                                $payment_arr[$i]=0;
                                $is_arriers[$i]=false;
                                $monfreepay-=$thismonthdue;
                                $thismonthdue=0;
                            }else{
                                $payment_arr[$i]=$thismonthdue-$monfreepay;
                                $thismonthdue=$thismonthdue-$monfreepay;
                                $monfreepay=0;
                            }
                            
                            if(($thismonthdue<=$weekfreepay)){
                                $payment_arr[$i]=0;
                                $is_arriers[$i]=false;
                                $weekfreepay-=$thismonthdue;
                                $thismonthdue=0;
                                $fivepwkpass=false;
                                
                                
                            }else{
                              
                                $payment_arr[$i]=$thismonthdue-$weekfreepay;
                                
                                $thismonthdue=$thismonthdue-$weekfreepay;
                                $weekfreepay=0;
                               
                            }
                            
                            
                            if($fivepwkpass){
                                
                                $thismonthdue*=(105/100);
                                
                                if(($thismonthdue<=$fiveppay)){
                                $payment_arr[$i]=0;
                                $is_arriers[$i]=false;
                                $payment_halfpaid[$i]+=$thismonthdue;
                                $fiveppay-=$thismonthdue;
                                $thismonthdue=0;
                                $tenpwkpass=false;
                                }else{
                                    $payment_arr[$i]=$thismonthdue-$fiveppay;
                                    $thismonthdue=$thismonthdue-$fiveppay;
                                    $fiveppay=0;
                                     
                                }
                                
                               $thismonthdue*=(100/105); 
                               
                            }
                            
                            if($tenpwkpass){
                                
                              
                                if(($thismonthdue<=$tenppay)){
                                $payment_arr[$i]=0;
                                $is_arriers[$i]=false;
                                $payment_halfpaid[$i]+=$thismonthdue;
                                $tenppay-=$thismonthdue;
                                $thismonthdue=0;
                                }else{
                                    //if($tenppay>0){
                                    $payment_arr[$i]=$thismonthdue-$tenppay;
                                    
                                    $thismonthdue=$thismonthdue-$tenppay;
                                    //echo $thismonthdue."|$i|";
                                    //}
                                    $tenppay=0;
                                   
                                    
                                }
                                
                               $thismonthdue*=(100/105); 
                             
                            }
                            //echo $monfreepay."-".$weekfreepay."-".$fiveppay."-".$tenppay."|";
                            
                            $temp_due+=$thismonthdue-($monfreepay+$weekfreepay+$fiveppay+$tenppay);
                           
                        }else{
                            
                            $temp_due+=$payment_arr[$i];
                            
                            //echo $temp_due."|$i|";
                        }
                        
                        
                        
                         
                        if($ft){
                            //$prv_round_date=date('Y-m-d', strtotime('+1 day', strtotime($prv_round_date)));
                            $ft=FALSE;
                        }
                        
                        if(($temp_due>0)){
                            
                           // $temp_due=($temp_due*(100/110));
                            //$customer_total_overpaid-=(($temp_due) * (10 / 100));
                            
                             if( $period>=$i){
                            $is_arriers[$i]=true;
                             
                            $payment_arr[$i]=$temp_due;
                            //echo $payment_arr[$i]."|$i|";
                            $temp_due=0;
                             }
                            
//                        
                        }
                        elseif($temp_due==0){
                            $payment_arr[$i]=$temp_due;
                        
                            
                        }elseif($temp_due<0){
                            
                            
                            $payment_arr[$i]=0;
                            $is_arriers[$i]=false;
                            for($tt=1;$tt<sizeof($payment_arr);$tt++){
                                
                                if($is_arriers[$tt]){
                                    
                                    if(($payment_arr[$tt]+$temp_due)>=0){
                                        
                                        $payment_arr[$tt]=$payment_arr[$tt]+$temp_due;
                                        $temp_due=0;
                                        
                                    }else{
                                        $temparr=$payment_arr[$tt];
                                        $payment_arr[$tt]=0;
                                        $temp_due=$temparr+$temp_due;
                                        $is_arriers[$tt]=false;
                                    }
                                }else{
                                
                                    $payment_arr_calc[$tt]=0;
                                
                                if($tt>$i){
                                   
                                    if(($payment_arr[$tt]+$temp_due)>=0){
                                        
                                        $payment_arr[$tt]=$payment_arr[$tt]+$temp_due;
                                        
                                        $temp_due=0;
                                    }else{
                                        
                                        $temparr=$payment_arr[$tt];
                                        $payment_arr[$tt]=0;
                                        $temp_due=$temparr+$temp_due;
                                        $is_arriers[$tt]=false;
                                        
                                    }
                                }
                                }
                                
                                
                            }
                          
                        }
                         
                       
                       
                       
                        for($x=0;$x<  sizeof($payment_arr);$x++){
                                                               
                                if($is_arriers[$x]){
                                    
                                   
                                    //Calulating Arriers
                                    $arriers= ((($interstarray[$x]*5)/100)+1)*$payment_arr[$x];
                                    //$customer_total_overpaid+=(($temp_due) * (10 / 100));
                                    $payment_arr_calc[$x]=$arriers;
//                                    echo $arriers."|$x|$i|";
                                    
                               }else{
                                    if($payment_arr[$x]==0){
                                    $payment_arr_calc[$x]=0;
                                    }
                               }
                              
                        }
                        
                        
                        
                       //print_r($payment_arr_calc);
                  }else{
                      
                      
                      echo "else";
                      
                      
                      
                  }
                 
                    if ($temp_prv_round_date == "NONE") {
                        $prv_round_date = $rounded_off_date;
                    } else {
                        $prv_round_date = $temp_prv_round_date;
                        
                        $temp_prv_round_date = "NONE";
                    }
                    $dis_round_date=$rounded_off_date;
                    $rounded_off_date = date('Y-m-d', strtotime('+1 month', strtotime($rounded_off_date)));
                    
                    $customer_due=$temp_due;
                    
                    
                  
//                    for($itr=(sizeof($interstarray)-1);$itr>=0;$itr--){
//                      if($itr!=0){
//                        $interstarray[$itr]=$interstarray[$itr-1];
//                        
//                        
//                      }else{
//                        $tempvar = $interstarray[0];
//                        $interstarray[0]=$interstarray[1]+1;
//                        $interstarray[1]=$tempvar;
//                      }
//                        
//                    }
                   for($op=0;$op<sizeof($payment_overpaid);$op++){
                       if($payment_overpaid[$op]<$payment_arr_calc[$op]){
                            $payment_overpaid[$op]=$payment_arr_calc[$op];
                           
                       }
                       
                       
                   }
                  
        //echo $payment_arr[10]."|$i|";
             
            }
           
            //// ENd of Big for///                   
                     for($x=0;$x<  sizeof($payment_arr);$x++){
                                                               
                                if($is_arriers[$x]){
                                   //print_r($interstarray);
                                    //Calulating Arriers
                                    $arriers= ((($interstarray[$x]*5)/100)+1)*$payment_arr[$x];
                                    //$customer_total_overpaid+=(($temp_due) * (10 / 100));
                                    $payment_arr_calc[$x]=$arriers;
                                    
                               }else{
                                    if($payment_arr[$x]==0){
                                    $payment_arr_calc[$x]=0;
                                    }
                               }
                              
                    }
                    //print_r($payment_arr_calc);
                    
                     for($op=0;$op<sizeof($payment_overpaid);$op++){
                       if($payment_overpaid[$op]<$payment_arr_calc[$op]){
                            $payment_overpaid[$op]=$payment_arr_calc[$op];
                           
                       }
                       
                       
                   }
                  
            
            
            ///////////////////////////////////From Last day to Today////////////////////////
            $datediff=floor(($now-  strtotime($prv_round_date))/(60*60*24));  
           
           $tenpwkpass=false;
           $fivepwkpass=false;
            if($datediff>14){
                $tenpwkpass=true;
                
            }elseif($datediff>7){
                $fivepwkpass=true;
                
            }
            
            $sql_payment = "SELECT * FROM pawn_installment where paid_date<='$now_date' and paid_date>='$prv_round_date' and deed_no='$sno_begin_ins'";
            
            
            $run_payment = mysqli_query($conn, $sql_payment);
                        
                        $prvrounddate=  strtotime($prv_round_date);
                        $monfreepay=0;
                        $weekfreepay=0;
                        $fiveppay=0;
                        $tenppay=0;
                        while($row = mysqli_fetch_assoc($run_payment)) {
                               $customer_total_paid+=$row['payment'];
                               $tempdate=  strtotime($row['paid_date']);
                               $tempdatediff=floor(($tempdate-$prvrounddate)/(60*60*24));
                               
                               if($tempdatediff==0){
                                   $monfreepay+=$row['payment'];
                               }elseif($tempdatediff<=7){
                                   $weekfreepay+=$row['payment'];
                               }elseif($tempdatediff<=14){
                                   $fiveppay+=$row['payment'];
                               }else{
                                   $tenppay+=$row['payment'];
                               }
                               
                        }
                        $temp_due=0; 
                        
                        $currentmonthpay=$monfreepay+$weekfreepay+$fiveppay+$tenppay;
                       // echo $currentmonthpay."|";
                        $temp_current_mon_pay=$currentmonthpay;
                        if($currentmonthpay>0){
                            
  
//                            
                            
                             for($tt=0;$tt<$i;$tt++){
                                
                                if($is_arriers[$tt]){
                                    
                                    if(($currentmonthpay!=0)&&($payment_arr_calc[$tt]-$currentmonthpay)>0){
                                      
                                        
                                        
                                        $tempvalue=$payment_arr_calc[$tt]-$currentmonthpay;
                                        $payment_arr_calc[$tt]=$tempvalue;
                                        $payment_halfpaid[$tt]+=$currentmonthpay;
                                        $payment_arr[$tt]=$tempvalue;
                                        $currentmonthpay=0;
                                       //  echo $payment_arr[$tt]."|".$tt."|".$i."|";
                                        
                                    }else{
                                        if((($payment_arr_calc[$tt]-$currentmonthpay)<=0)){
                                        $temparr=$payment_arr_calc[$tt];
                                        $payment_arr[$tt]=0;
                                        $payment_arr_calc[$tt]=0;
                                        $currentmonthpay=$currentmonthpay-$temparr;
                                        $is_arriers[$tt]=false;
                                        //echo $currentmonthpay."|".$tt."|".$i."|";
                                        }
                                    }
                                    
                                }else{
                                    
                                    $payment_arr_calc[$tt]=0;
                                    
                                   
                                }                               
                                
                            }      
                                            
                        }
                        
                        $need_to_calc=true;
                          if($currentmonthpay>0){
                            $need_to_calc=false;
                            $deducted=$temp_current_mon_pay-$currentmonthpay;
                           
                            
                            if($deducted>=$monfreepay){
                                $deducted-=$monfreepay;
                                $monfreepay=0;
                             
                                
                            }else{
                                $monfreepay-=$deducted;
                                $deducted=0;
                            }
                            
                            
                            if($deducted>=$weekfreepay){
                                $deducted-=$weekfreepay;
                                $weekfreepay=0;
                            }else{
                                $weekfreepay-=$deducted;
                                $deducted=0;
                            }
                            
                            if($deducted>=$fiveppay){
                                $deducted-=$fiveppay;
                                $fiveppay=0;
                            }else{
                                $fiveppay-=$deducted;
                                $deducted=0;
                            }
                            
                            if($deducted>=$tenppay){
                                $deducted-=$tenppay;
                                $tenppay=0;
                            }else{
                                $tenppay-=$deducted;
                                $deducted=0;
                            }
                            
                            
                             
                            
                            $thismonthdue=$payment_arr[sizeof($payment_arr)-1];
                            
                           
                            
                            
                            if($thismonthdue<=$monfreepay){
                                $payment_arr[sizeof($payment_arr)-1];
                                $is_arriers[$i]=false;
                                $monfreepay-=$thismonthdue;
                                $thismonthdue=0;
                            }else{
                                $payment_arr[sizeof($payment_arr)-1]=$thismonthdue-$monfreepay;
                                $thismonthdue=$thismonthdue-$monfreepay;
                                $monfreepay=0;
                            }
                            
                            if(($thismonthdue<=$weekfreepay)){
                                
                                $payment_arr[sizeof($payment_arr)-1]=0;
                                $is_arriers[sizeof($payment_arr)-1]=false;
                                $weekfreepay-=$thismonthdue;
                                $thismonthdue=0;
                                $fivepwkpass=false;
                            }else{
                                $payment_arr[sizeof($payment_arr)-1]=$thismonthdue-$weekfreepay;
                                $thismonthdue=$thismonthdue-$weekfreepay;
                                $weekfreepay=0;
                            }
                           
                            if($fivepwkpass){
                                 
                                $thismonthdue*=(105/100);
                                
                                if(($thismonthdue<=$fiveppay)){
                                $payment_arr[sizeof($payment_arr)-1]=0;
                                $is_arriers[sizeof($payment_arr)-1]=false;
                                $payment_halfpaid[sizeof($payment_arr)-1]+=$thismonthdue;
                                $fiveppay-=$thismonthdue;
                                $thismonthdue=0;
                                $tenpwkpass=false;
                                }else{
                                    $payment_arr[sizeof($payment_arr)-1]=$thismonthdue-$fiveppay;
                                    $thismonthdue=$thismonthdue-$fiveppay;
                                    $fiveppay=0;
                                }
                            }
                            
                            if($tenpwkpass){
                               
                                
                                if(($thismonthdue<=$tenppay)){
                                $payment_arr[sizeof($payment_arr)-1]=0;
                                $is_arriers[sizeof($payment_arr)-1]=false;
                                $payment_halfpaid[sizeof($payment_arr)-1]+=$thismonthdue;
                               // echo (sizeof($payment_arr)-1)."|";
                                $tenppay-=$thismonthdue;
                                $thismonthdue=0;
                                }else{
                                    $payment_arr[sizeof($payment_arr)-1]=$thismonthdue-$tenppay;
                                    $thismonthdue=$thismonthdue-$tenppay;
                                    $tenppay=0;
                                    if( $period>=(sizeof($payment_arr)-1)){
                                    $is_arriers[sizeof($payment_arr)-1]=true;
                                    }
                                }
                                
                            }
                            
                           
                           $temp_due+=$thismonthdue-($monfreepay+$weekfreepay+$fiveppay+$tenppay);
                            if($temp_due<=0){
                                $customer_due+=$temp_due;
                            }
                            
                        }
                       
          
                      
           //////////////////////////////////////////////////////////////////////////////////////////// 
            
            
            $datediff=floor(($now-  strtotime($dis_round_date))/(60*60*24));    
            
            
            $nextpayment=$payment_arr[sizeof($payment_arr)-1];
          
//            if($datediff>=0){
            
                
             
                
//            if($datediff==0){
              if($datediff<=0){
                     
                     for($x=0;$x<sizeof($payment_arr);$x++){
                                                               
                                if($is_arriers[$x]){
                                    $tempx=$interstarray[$x]-1;
                                    if($tempx>=0){
                                    $arriers= ((($tempx*5)/100)+1)*$payment_arr[$x];
                                    
                                    $payment_arr_calc[$x]=$arriers;
                                    }
                               }else{
                                    if($payment_arr[$x]==0){
                                    $payment_arr_calc[$x]=0;
                                    }
                               }
                              
                        }
                        
                for($op=0;$op<sizeof($payment_overpaid);$op++){
                       if($payment_overpaid[$op]<$payment_arr_calc[$op]){
                            $payment_overpaid[$op]=$payment_arr_calc[$op];
                           
                       }
                       
                 }
                 
               
               }
            
             // print_r($payment_arr_calc);
//            else{
//                $dis_round_date=date('Y-m-d', strtotime('+1 week', strtotime($dis_round_date)));
//            }  
            
              
            foreach ($payment_arr_calc as $value) {
                $customer_due+=$value;
            }
            
            
           
                    
            
//             foreach ($payment_arr_calc as $value) {
//                $customer_due+=$value;
//            }     
             
            if($datediff>0){
                    
            if($datediff>14){
                if($need_to_calc){
                $nextpayment*=(105/100);
                }
              
                $dis_round_date=$rounded_off_date;
            }elseif($datediff>7){
                if($need_to_calc){
                $nextpayment*=(105/100);
                }
                if($customer_due>=0){
                    $dis_round_date=date('Y-m-d', strtotime('+1 week', strtotime($dis_round_date)));
                }else{
                   $dis_round_date=$rounded_off_date;  
                }
                
            }
            
            if($datediff!=0){
                if( $period>=(sizeof($payment_arr)-1)){
                    $nextpayment+=$installment_amount;
                }
            }
            
            }
            
            
            ///////////////////////////////////////////
            
            
            if( $period>=(sizeof($payment_arr)-1)){
            $customer_due+=$nextpayment;
            }
            
           
            
         
            
            //Calculating Customer Overpaid
            $customer_total_overpaid=0;
            
            for($i=0;$i<sizeof($payment_arr);$i++){
                if($payment_halfpaid[$i]>0){
                    if($payment_halfpaid[$i]>=$installment_amount){
                    $customer_total_overpaid+=($payment_halfpaid[$i]-$installment_amount);
                    }
                    else{
                      $customer_total_overpaid+= $payment_halfpaid[$i]; 
                    }
                }elseif($payment_overpaid[$i]>0){
                    if($payment_overpaid[$i]>=$installment_amount){
                    $customer_total_overpaid+=($payment_overpaid[$i]-$installment_amount);
                    }                    
                }
            }print
//            print_r($payment_arr);
//               print_r($payment_arr_calc);
          //  print_r($payment_overpaid);
           // print_r($payment_halfpaid);
           
            
            $nextpayment = "";
            $nextpaydate = "NA";
            $totpaybleamnt = $customer_due;
            
            $balance_lease = $fixed_rate+$customer_total_overpaid-$customer_total_paid;
            
            if($balance_lease>0){
            
            $strperiod='+'.$period.' month';
            $leftmonths= date('Y-m-d', strtotime($strperiod, strtotime($tempservdate)));
            
            
            $d1 = new DateTime($leftmonths);  // Get First PAyment date as date
            $d2 = new DateTime($now_date);          // Get Today Date As date
            $diff = $d2->diff($d1);
            $leftmonths = (($diff->format('%y') * 12) + $diff->format('%m'));  // Ge
           
            
            $temp_fut_payment=$customer_due+($leftmonths*$installment_amount);
            $balance_lease = $temp_fut_payment;
            }
            
            
            if($no_of_months+1>$period){
                $balance_lease=$customer_due;
            }
            $no_of_installments =ceil(($balance_lease - $customer_total_overpaid) / $installment_amount);

            

            $customer_due = ceil($customer_due);
            $nextpayment = ceil($nextpayment);
            $totpaybleamnt = ceil($totpaybleamnt);
            $balance_lease = ceil($balance_lease);


            $settlement_amount = $balance_lease . ".00";
            $temp_settlement = $settlement_amount;
//            if ($no_of_installments > 5) {
//                $temp_settlement = $settlement_amount * (94 / 100);
//                $temp_settlement = ceil($temp_settlement);
//                $settlement_amount = $settlement_amount . " (With 6% Discount ($temp_settlement.00))";
//            }

//            if ($balance_lease <= 0) {
//                $update_service_status = "UPDATE service SET ser_status='0' WHERE ser_number='$sno_begin_ins'";
//                $run_update = mysqli_query($conn, $update_service_status);
//                
//            }
               
            
            
           
            
            if($balance_lease<=0){
                $issettled=true;
            }
            
            if ($customer_due == '-0') {
                $customer_due = '0';
            }
            
            if ($totpaybleamnt == '-0') {
                $totpaybleamnt = '0';
            }
             if($issettled){
                  echo 'NA' . "#" . '0' . "#" . '0' . "#" . 'NA' . "#" . '0' . ".00" . "#" . '0' . "#" . '0' . "#" . 'Lease is Already Settled!' . "#" . 'NA'. "#" . 'Lease is Already Settled!';

            }else{
            echo $dis_round_date . "#" . $customer_due . "#" . $nextpayment . "#" . $nextpaydate . "#" . $totpaybleamnt . ".00" . "#" . $balance_lease . "#" . $no_of_installments . "#" . $settlement_amount . "#" . $temp_settlement. "#" . $customer_total_paid;
            }

            //$temp_date =
            }else{
                echo 'NA' . "#" . '0' . "#" . '0' . "#" . 'NA' . "#" . '0' . ".00" . "#" . '0' . "#" . '0' . "#" . 'Lease is Already Settled!' . "#" . 'NA'. "#" . 'Lease is Already Settled!';

             }
        }
        
    }
}
?>