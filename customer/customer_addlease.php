
<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
?>
<?php
if (isset($_SESSION['cus_nic'])) {
    $cus_nic = $_SESSION['cus_nic'];
    $cus_name = $_SESSION['cus_name'];
    $lease_date = $_SESSION['cus_reg_date'];
} else {
    $cus_nic = "";
    $cus_name = "";
    $lease_date = "";
}
?>
<!DOCTYPE html>
<html>
    <!--Variable Declaration-->
    <?php
    $vehicle_no = "";
    $model_year = "";
    $lease_rate = "";
    $fixed_rate = "";
    $cbo_loan_duration = "";

    date_default_timezone_set('Asia/Colombo');
    $lease_reg_date = date("Y-m-d");
    ?>
    <!--Variable Declaration-->
    <head>
        <meta charset="UTF-8">
        <title>Lease | Registration </title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Latest compiled and minified CSS -->

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <!-- Optional theme -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../assets/css/customer_service.css">
        <script src="../assets/js/jquery-3.0.0.js"></script>
        <script src="../assets/js/angular.js"></script>
        <link rel="icon" href="favicon.ico">

        <script type="text/javascript">
            function reset_form_values() {
                document.getElementById('v_brand').selectedIndex = "0";
                document.getElementById('v_type').innerHTML = "";
                document.getElementById('v_type').innerHTML = "<option value='0'>~~Select Vehicle Type~~</option>";
                document.getElementById('v_type').selectedIndex = "0";
                document.getElementById('v_code').innerHTML = "";
                document.getElementById('v_code').innerHTML = "<option value='0'>~~Select Vehicle Code~~</option>";
                document.getElementById('v_code').selectedIndex = "0";
                document.getElementById('v_no_num').value = "";
                document.getElementById('v_no_code').value = "";
                document.getElementById('m_year').value = "";
                document.getElementById('l_rate').value = "";
                document.getElementById('f_rate').value = "";
            }
        </script>
        <script type="text/javascript">
            function searchCustomerforLease() {
                if (document.getElementById('customer_nic').value != "") {
                    //alert('searchCustomerforLease');
                    var val = document.getElementById('customer_nic').value;
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            document.getElementById('customer_name').value = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_lease_customer.php?cus_nic=" + val, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function saveVehicleLease() {

                var service_code = document.getElementById('scode').value;
                var service_num = document.getElementById('sno').value;
                var service_no = service_code + "-" + service_num;
                var v_cat = document.getElementById('v_cat').value;
                var v_brand = document.getElementById('v_brand').value;
                var v_type = document.getElementById('v_type').value;
                var v_code = document.getElementById('v_code').value;
                var v_number = document.getElementById('v_no_code').value + "-" + document.getElementById('v_no_num').value;
                var v_myear = document.getElementById('m_year').value;
                var v_lrate = document.getElementById('l_rate').value;
                var v_frate = document.getElementById('f_rate').value;
                var v_lease_period = document.getElementById('v_lease_period').value;
                var v_lease_des = document.getElementById('lease_des').value;
                var c_nic = document.getElementById('customer_nic').value;
                var installment = document.getElementById('ser_installment').value;

                if (service_no != "" && v_cat != "" && v_brand != "" && v_type != "" && v_code != ""
                        && v_number != "" && v_myear != "" && v_lrate != ""
                        && v_frate != "" && v_lease_period != "" && v_lease_des != "" && c_nic != "" && installment != "") {

                    //alert("inside save code");
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            alert(xmlhttp.responseText);
                        }
                    }
                    xmlhttp.open("GET", "../controller/ser_external_v_service_save.php?cus_nic=" + c_nic + "&sno=" + service_no + "&v_cat=" + v_cat + "&v_brand=" + v_brand + "&v_type=" + v_type + "&v_code=" + v_code + "&v_number=" + v_number + "&v_myear=" + v_myear + "&v_lrate=" + v_lrate + "&v_frate=" + v_frate + "&v_period=" + v_lease_period + "&v_des=" + v_lease_des + "&installment=" + installment, true);
                    xmlhttp.send();
                }
            }
            function setServiceInstallment() {
                var fix_rate = document.getElementById('f_rate').value;
                var period = document.getElementById('v_lease_period').value;
                var vehicle_category = document.getElementById('vehicle_category').value;

                if (fix_rate != "" && period != "" && fix_rate != null && period != null) {
                   
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            document.getElementById('ser_installment').value = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_lease_customer.php?fix_rate=" + fix_rate + "&period=" + period + "&vehicle_category=" + vehicle_category, true);
                    xmlhttp.send();
                }
            }
            document.onkeydown = function (e) {
                if (e.keyCode === 13) {
                    // alert('not allowed');
                    return false;
                } else {
                    return true;
                }
            };
        </script>
        <script type="text/javascript">
            function load_branches() {
                var branch_load = "loadbranches";
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        if (xmlhttp.responseText != null && xmlhttp.responseText != "") {
                            document.getElementById('scode').innerHTML = xmlhttp.responseText;
                        }
                    }
                }
                xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?branch_load=" + branch_load, true);
                xmlhttp.send();

            }
        </script>
        <script type="text/javascript">
            function load_vehicle_categories() {
                var cat_load = "loadcat";
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('vehicle_category').innerHTML = xmlhttp.responseText;
                        load_branches();
                    }
                }
                xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load=" + cat_load, true);
                xmlhttp.send();

            }
        </script>
        <script type="text/javascript">
            function load_vehicle_brands() {
                var category = document.getElementById('vehicle_category').value;
                if (category != null && category != "") {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                    {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            if (xmlhttp.responseText != "" && xmlhttp.responseText != null) {
                                document.getElementById('vehicle_brand').innerHTML = "";
                                document.getElementById('vehicle_brand').innerHTML = xmlhttp.responseText;
                                document.getElementById('vehicle_type').innerHTML = "<option value'0'>~Select Brand~</option>";
                                document.getElementById('vehicle_no').value = "";
                                document.getElementById('engine_number').value = "";
                                document.getElementById('chassis_number').value = "";
                                document.getElementById('f_rate').value = "";
                                document.getElementById('v_lease_period').selectedIndex = "0";
                                document.getElementById('ser_installment').value = "";
                                document.getElementById('lease_des').value = "";
                                document.getElementById('province_code').selectedIndex = "0";
                            }
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load_brand=" + category, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function load_vehicle_rate_models() {
                var brand = document.getElementById('vehicle_brand').value;
                
                if (brand != null && brand != "") {
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                    {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('vehicle_type').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load_model=" + brand, true);
                    xmlhttp.send();
                }
            }
        </script>
        <link rel="stylesheet" href=" ../assets/css/images-uploader.css">
    </head>
    <body onload="load_vehicle_categories();">

        <?php include '../assets/include/navigation_bar.php'; ?>
        <!--Lease Registration Panel-->
        <div ng-app="" class="container" style="margin-top: 80px;display: block;" id="one">
            <form action="../controller/co_customer.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Lease Registration</h3>
                            </div>
                            <div class="panel-body" style="background-color: #FAFAFA;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Customer Details</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Customer NIC:</label>
                                            <div class="form-inline required">
                                                <input type="text" name="cus_nic" id="cus_nic" value="<?php echo $cus_nic; ?>" placeholder="Customer NIC" class="form-control" required style="width: 85%;text-transform: uppercase;" maxlength="10" readonly/>
                                                <button type="button" id="cviewbuttons" class="btn btn" onclick="searchCustomerforLease();">Search</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="lease_reg_date_hide" value="<?php echo $lease_date; ?>">
                                        <div class="form-group">
                                            <label class="control-label">Customer Name:</label>
                                            <input type="text" name="cus_name" readonly id="customer_name" value="<?php echo $cus_name; ?>" placeholder="Customer Name" class="form-control"/>
                                        </div>
                                        <div class="form-inline" style="margin-bottom: 8px;">
                                            <a href="customer_registration.php"><button type="button" id="cviewbuttons" class="btn btn">New Customer</button></a>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Leasing Details</legend>
                                        <div class="form-group">
                                            <label class="control-label">Service No:</label>
                                            <div class="form-inline">
                                                <select name="service_code" id="scode" class="form-control" style="width: 40%;" >
                                                    <option value="0">~Select Brance~</option>
                                                </select>
                                                <input ng-app="" type="text" name="service_no" id="sno" placeholder="Service No" class="form-control" onKeyPress="return numbersonly(this, event)" max="4" maxlength="4" style="width: 59%;" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Select Category:</label>
                                            <select name="vehicle_category" id="vehicle_category" class="form-control" onchange="load_vehicle_brands();">
                                                <option value="0">~~Select Category~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Select Vehicle Brand:</label>
                                            <select name="vehicle_brand" id="vehicle_brand" class="form-control" onchange="load_vehicle_rate_models();">
                                                <option value="0">~Select Brand~</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Select Vehicle Model:</label>
                                            <select name="vehicle_type" id="vehicle_type" class="form-control" required>
                                                <option value="0">~~Select Vehicle Type~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Vehicle No:</label>
                                            <input type="text" name="vehicle_no" id="vehicle_no" placeholder="Vehicle No" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Engine No:</label>
                                            <input type="text" name="engine_number" id="engine_number" placeholder="Engine No" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Chassis Number:</label>
                                            <input type="text" name="chassis_number" id="chassis_number" placeholder="Chassis Number" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Fixed Rental:</label>
                                            <input type="text" name="fixed_rate" id="f_rate" value="<?php echo $fixed_rate; ?>" placeholder="Fix Rate" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Select Period:</label>
                                            <select name="cbo_loan_duration" id="v_lease_period" class="form-control" required onchange="setServiceInstallment();">
                                                <option value="0">~~Select Period~~</option>
                                                <option value="3">3 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="9">9 Months</option>
                                                <option value="12">1 Year</option>
                                                <option value="18">1 Year & 6 Months</option>
                                                <option value="24">2 Years</option>
                                                <option value="30">2 Year & 6 Months</option>
                                                <option value="36">3 Years</option>
                                                <option value="42">3 Year & 6 Months</option>
                                                <option value="48">4 Years</option>
                                                <option value="54">4 Year & 6 Months</option>
                                                <option value="60">5 Years</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Service Installment:</label>
                                            <input type="text" name="ser_installment" id="ser_installment" placeholder="Fix Rate" class="form-control" required readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Vehicle Province Code:</label>
                                            <select name="province_code" id="province_code" class="form-control" required>
                                                <option value="0">~~Select Province Code~~</option>
                                                <option value="CP">CP-Central Province</option>
                                                <option value="EP">EP-Eastern Province</option>
                                                <option value="NC">NC-North Central Province</option>
                                                <option value="NP">NP-Nouthern Province</option>
                                                <option value="NW">NW-North West</option>
                                                <option value="SB">SB-Sabaragamuwa Province</option>
                                                <option value="SP">SP-Southern Province</option>
                                                <option value="UP">UP-Uva Province</option>
                                                <option value="WP">WP-Western Province</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description of the Loan:</label>
                                            <input type="text" id="lease_des" class="form-control" name="loan_description" placeholder="Description of the Loan">
                                        </div>
                                        <input type="hidden" name="lease_reg_date" value="<?php echo $lease_reg_date; ?>">
                                        <input type="submit" class="btn btn" id="custcontinue" name="lease_reg" value="Register Lease"/>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--Lease Registration Panel-->
        <?php include '../assets/include/footer.php'; ?>
    </body>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script type="text/javascript">

                                                function numbersonly(myfield, e, dec)
                                                {
                                                    var key;
                                                    var keychar;
                                                    if (window.event)
                                                        key = window.event.keyCode;
                                                    else if (e)
                                                        key = e.which;
                                                    else
                                                        return true;
                                                    keychar = String.fromCharCode(key);
                                                    if ((key == null) || (key == 0) || (key == 8) ||
                                                            (key == 9) || (key == 13) || (key == 27))
                                                        return true;
                                                    else if ((("0123456789").indexOf(keychar) > -1))
                                                        return true;
                                                    else if (dec && (keychar == ".")) {
                                                        myfield.form.elements[dec].focus();
                                                        return false;
                                                    } else
                                                        return false;
                                                }


    </script>
    <script type="text/javascript">
        function clearImgPreview() {
            document.getElementById('image-preview').innerHTML = "";
        }
    </script>
    <script src="../assets/js/images-uploader-min.js"></script>
</html>
