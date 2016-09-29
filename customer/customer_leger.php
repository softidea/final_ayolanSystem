<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('Asia/Colombo');
$date_setter = date("Y-m-d");
$cus_seid = filter_input(INPUT_GET, 'ser_number');

$name = "";
$address = "";
$status = "";
$facility = "";
$vno = "";
$capital = "";
$rental_no = "";
$rental = "";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Customer Lager</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

        <?php if (isset($_GET['bootstrap']) && $_GET['bootstrap'] == 1): ?>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <?php else: ?>
            <link rel="stylesheet" type="text/css" href="../assets/css/zebra_pagination.css">
        <?php endif ?>

        <link rel="stylesheet" type="text/css" href="../assets/css/customer_registration.css">
        <link rel="icon" href="favicon.ico">

        <script>

            function loadInstallmentCustomer() {
                var sno = document.getElementById('sevis_id').value;
                alert(sno);
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        //alert(xmlhttp.responseText);

                        var value = xmlhttp.responseText;
                        var result_arr = value.split("#");

                        document.getElementById('name').innerHTML = "";
                        document.getElementById('address').innerHTML = "";
                        document.getElementById('status').innerHTML = "";
                        document.getElementById('facility').innerHTML = "";
                        document.getElementById('vno').innerHTML = "";
                        document.getElementById('capital').innerHTML = "";
                        document.getElementById('ren_no').innerHTML = "";
                        document.getElementById('rental').innerHTML = "";

                        document.getElementById('name').innerHTML = result_arr[0];
                        document.getElementById('address').innerHTML = result_arr[1];
                        document.getElementById('status').innerHTML = result_arr[2];
                        document.getElementById('facility').innerHTML = result_arr[3];
                        document.getElementById('vno').innerHTML = result_arr[4];
                        document.getElementById('capital').innerHTML = result_arr[5];
                        document.getElementById('ren_no').innerHTML = result_arr[6];
                        document.getElementById('rental').innerHTML = result_arr[7];

                    }
                }
                xmlhttp.open("GET", "../controller/co_customer_leder.php?sno=" + sno, true);
                xmlhttp.send();
            }

            function check() {
//                alert("awa");
                var serviceno = document.getElementById('sevis_id').value;
                //alert(serviceno);
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                // alert('ela 2');
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
//                        alert(xmlhttp.responseText);
                        var res_value = xmlhttp.responseText;
                        var res_arr = res_value.split("#");

                        if (res_arr.length > 1) {
//                            alert("awawrqer");
//                            //document.getElementById('payable_date').value = res_arr[0];
//                            document.getElementById('payble_installment').value = res_arr[1] + ".00";
                            //document.getElementById('next_installment').value = res_arr[2] + ".00";
                            document.getElementById('nedate').innerHTML = res_arr[0];
//                            document.getElementById('total_payable_payment').value = res_arr[4];

//                            document.getElementById('remain_amount').value = res_arr[5] + ".00";
//                            document.getElementById('total_payable_in_settlement').value = res_arr[7];
//                            document.getElementById('requiredpayment').value = res_arr[8];
//                            document.getElementById('maximumpayment').value = res_arr[5];
//                            document.getElementById('total_payable_installements').value = res_arr[6];
                        }
                    }
                }
                xmlhttp.open("GET", "../controller/co_load_installment_customer.php?sno_begin_ins=" + serviceno, true);
                xmlhttp.send();

            }
        </script>



    </head>
    <body onload="check()">
        <?php
        include '../assets/include/navigation_bar.php';
        require_once '../db/mysqliConnect.php';

//        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
        if (mysqli_connect_errno()) {
            echo "Falied to Connect the Database" . mysqli_connect_error();
        }







        if ($cus_seid != null && $cus_seid != "") {

            $sql_query = "SELECT a.cus_fullname,c.vehicle_no,a.cus_address,c.`description`,c.`ser_status`,c.`fix_rate`,c.`installment`,c.`period` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE c.`ser_number`='" . $cus_seid . "'";
            $run_query = mysqli_query($d_bc, $sql_query);
            while ($row_query = mysqli_fetch_array($run_query)) {
                $name = $row_query['cus_fullname'];
                $address = $row_query['cus_address'];
                if ($row_query['ser_status']==1) {
                    $status ="Active" ;
                }else{
                     $status ="Deactive" ;
                }
                
                $facility = $row_query['description'];
                $vno = $row_query['vehicle_no'];
                $capital = $row_query['fix_rate'];
                $rental_no = $row_query['period'];
                $rental = $row_query['installment'];
            }
        }
        ?>
        <!--Customer Panel Section-->
        <div class="container" style="margin-top: 80px;display: block;" id="one">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">Transaction History - Finance No <?php echo $cus_seid; ?></h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">

                            <div class="col-sm-6">

                                <fieldset id="account">
                                    <input type="hidden" name="sevis_id" id="sevis_id" value="<?php echo $cus_seid; ?>" />
                                    <legend>Customer Details</legend>
                                    <label>Name</label>
                                    <p id="name"><?php echo $name; ?></p>

                                    <label>Address</label> 
                                    <p id="address"><?php echo $address; ?></p>

                                    <label>Customer Status   </label>
                                    <p id="status"><?php echo $status; ?></p>

                                    <label>Vehicle No </label>
                                    <p id="vno"><?php echo $vno; ?></p>

                                </fieldset>

                            </div>
                            <div class="col-sm-6">

                                <fieldset id="account">
                                    <legend>Financial Details</legend>
                                    <label>Type Of Service </label> 
                                    <p id="facility"><?php echo $facility; ?></p>

                                    <label>Capital</label>
                                    <p id="capital"><?php echo $capital; ?>.00</p>

                                    <label>No Of Rental</label> 
                                    <p id="ren_no"><?php echo $rental_no; ?></p>

                                    <label>Rental</label>
                                    <p id="rental"><?php echo $rental; ?>.00</p>

                                     <label>Next Instalment Date</label>
                                    <p id="nedate"></p>


                                </fieldset>

                            </div>

                            <?php
                            $sql_query_table = "SELECT `int_id`,`paid_date`,`payment`,`customer_due`,`company_due` FROM `ser_installment` WHERE `ser_number`='" . $cus_seid . "'";
                            $result = mysqli_query($d_bc, $sql_query_table);
                            ?>

                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>Date</th>
                                            <th>Invoice No</th>
                                            <th>Payment</th>
                                            <th>Customer Due</th>
                                            <th>Company Due</th>
                                            <th>Next Payable Payment</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0;?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <?php $i++;?>
                                        <tr onload="check();" >

                                            <?php if ((int)$row['company_due']<0) { 
                                            ?>
                                             <td><?php echo $row['paid_date'] ?></td>
                                                <td>INV-<?php echo $row['int_id'] ?></td>
                                                <td><?php echo $row['payment'] ?>.00</td>
                                                <td><?php echo $row['customer_due'] ?>.00</td>
                                                <td>0.00</td>
                                                 <td><?php echo $row['payment'] - $row['company_due'] + $row['customer_due']+$rental ?>.00</td>
                                            <?php }  else {?>   
                                                 
                                                   <td><?php echo $row['paid_date'] ?></td>
                                                <td>INV-<?php echo $row['int_id'] ?></td>
                                                <td><?php echo $row['payment'] ?>.00</td>
                                                <td><?php echo $row['customer_due'] ?>.00</td>
                                                <td><?php echo $row['company_due'];?>.00</td>
                                                 <td><?php echo $row['payment'] - $row['company_due'] + $row['customer_due']+$rental ?>.00</td>
                                                 
                                                        <?php } ?>                 
                                                                                
                                                                          
                                               

                                            </tr>

                                        <?php endwhile ?>
                                    </tbody>
                                </table>




                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!--Customer Panel Section-->

        <?php include '../assets/include/footer.php'; ?>
    </body>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        function setServiceOptionPanel()
        {
            var sp_value = document.getElementById('input-search-option').value;
            if (sp_value == 'serviceno')
            {
                document.getElementById('cboservice').disabled = false;

                alert(sp_value);
            }
            else if (sp_value == 'cname' || sp_value == 'tp')
            {
                document.getElementById('cboservice').selectedIndex = "0";
                document.getElementById('cboservice').disabled = true;
                alert(sp_value);
            }
        }

    </script>

</html>
