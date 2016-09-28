<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
?>
<html lang="en">
    <?php
    //Asia/Colombo
    date_default_timezone_set('Asia/Colombo');
//$reg_date= date("Y-m-d");
    $cus_salutation = "";
    $cus_fullname = "";
    $cus_initialname = "";
    $cus_address = "";
    $cus_tp = "";
    $cus_nic = "";
    $cus_dob = date("Y-m-d");
    $cus_ms = "";
    $cus_dependdency = "";
    $cus_position = "";
    $cus_monthly_salary = "";
    $cus_emp_name = "";
    $cus_emp_address = "";
    $cus_addr_map_link = "No add this one";



    $cus_hhalf_name = "";
    $cus_bhalf_dob = date("Y-m-d");
    $cus_bhalf_position = "";
    $cus_bhalf_monthly_salary = "";
    $cus_bhalf_emp_name = "";
//////////////////////////////////////////////////////////////

    $gua_fullname = "";
    $gua_initial_name = "";
    $gua_address = "";
    $gua_tp = "";
    $gua_dob = date("Y-m-d");
    $gua_ms = "";
    $gua_nic = "";
    $gua_dependency = "";
    $gua_position = "";
    $gua_monthly_salary = "";
    $gua_emp_name = "";
    $gua_emp_address = "";

    $gua_bhalf_fullname = "";
    $gua_bhalf_dob = date("Y-m-d");
    $gua_bhalf_position = "";
    $gua_bhalf_monthly_salary = "";
    $gua_bhalf_emp_name = "";

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

    $payable_loan_amount = "";
    $reg_date = date("Y-m-d");
///////////////////////////////////////////////////////

    $useremailtoname = $_SESSION['user_email'];
    $cbopayment = "";

    $service_no = "";
    $vehicle_mtype_brand = "";
    $vehicle_brand = "";
    $vehicle_type = "";
    $vehicle_code = "";
    $vehicle_no1 = "";
    $vehicle_no2 = "";
    $model_year = "";
    $lease_rate = "";
    $fixed_rate = "";
    $cbo_loan_duration = "";
    $loan_description = "";
    $deed_no = "";
    $cbo_period = "";
    $cbo_year = "";

    $pawn_rate = "";
    ?>
    <head>
        <meta charset="utf-8">
        <title>Customer</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../assets/css/customer_registration.css" >
        <?php require '../controller/co_load_vehicle_brands.php'; ?>
        <link rel="icon" href="favicon.ico">
        <script type="text/javascript">
            function showTypes(str) {
                if (document.getElementById('v_cat').selectedIndex == 1) {
                    if (str == "") {
                        document.getElementById("v_type").innerHTML = "";
                        return;
                    }
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("v_type").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_types.php?q=" + str, true);
                    xmlhttp.send();
                }

            }

        </script>
        <script type="text/javascript">
            function load_interest() {
                var aid = document.getElementById('aid').value;
                var yid = document.getElementById('yid').value;
                //alert(aid + "###" + yid);
                if (aid != 0 && yid != 0) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                            if (xmlhttp.responseText === "No Interest Found,Try Again") {
                                alert(xmlhttp.responseText);
                            } else {
                                document.getElementById('pawnrate').value = xmlhttp.responseText;
                            }
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_pawn_rate.php?aid=" + aid + "&yid=" + yid, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function showVehicleMods(str) {
                if (document.getElementById('v_cat').selectedIndex == 1) {
                    if (str == "") {
                        document.getElementById("v_code").innerHTML = "";
                        return;
                    }
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("v_code").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_mods.php?q=" + str, true);
                    xmlhttp.send();
                } else if (document.getElementById('v_cat').selectedIndex == 2) {
                    if (str == "") {
                        document.getElementById("v_code").innerHTML = "";
                        return;
                    }
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("v_code").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_twheel_mods.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function showDetails()
            {
                if (document.getElementById('v_cat').selectedIndex == 1) {
                    var v_type = document.getElementById('v_type').value;
                    var v_code = document.getElementById('v_code').value;
                    //alert(v_type + " " + v_code);
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            var value = xmlhttp.responseText;
                            var result_arr = value.split("#");

                            document.getElementById('m_year').value = result_arr[0];
                            document.getElementById('l_rate').value = result_arr[1];

                            if (v_code.length === 1) {
                                document.getElementById('v_no_code').maxLength = v_code.length;
                                document.getElementById('v_no_code').readOnly = false;
                                document.getElementById('v_no_code').value = "";
                                document.getElementById('v_no_num').value = "";
                            } else {
                                document.getElementById('v_no_code').value = "";
                                document.getElementById('v_no_num').value = "";
                                document.getElementById('v_no_code').readOnly = true;
                                document.getElementById('v_no_code').maxLength = v_code.length;
                                document.getElementById('v_no_code').value = document.getElementById('v_code').value;
                            }

                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_details.php?v_type=" + v_type + "&v_code=" + v_code, true);
                    xmlhttp.send();
                } else if (document.getElementById('v_cat').selectedIndex == 2) {
                    //alert('inner');
                    var v_tw_type = document.getElementById('v_type').value;
                    var v_tw_code = document.getElementById('v_code').value;
                    //alert(v_tw_type + "tw " + v_tw_code);
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                            //alert(xmlhttp.responseText);
                            document.getElementById('l_rate').value = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "del.php?v_tw_type=" + v_tw_type + "&v_tw_code=" + v_tw_code, true);
                    xmlhttp.send();
                }
            }

        </script>
        <script type="text/javascript">
            function set_vehicle_div(val) {

                if (val == 1) {
                    reset_form_values();
                    document.getElementById('v_brand').disabled = false;

                } else if (val == 2) {
                    reset_form_values();
                    document.getElementById('v_brand').disabled = true;

                    document.getElementById("v_type").innerHTML = "";
                    document.getElementById("v_type").innerHTML = "<option value='2'>2 Stroke</option><option value='4'>4 Stroke</option>";

                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('v_code').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/delete.php", true);
                    xmlhttp.send();
                }
            }
            function reset_form_values() {
                document.getElementById('v_brand').selectedIndex = "0";
                document.getElementById('v_type').selectedIndex = "0";
                document.getElementById('v_no_code').value = "";
                document.getElementById('v_no_num').value = "";
                document.getElementById('m_year').value = "";
                document.getElementById('l_rate').value = "";
                document.getElementById('f_rate').value = "";
            }
            function setSerInstallment() {
                var payment = document.getElementById('f_rate').value;
                var period = document.getElementById('setServiceInstallment').value;

                if (payment != "" && period != "" && payment != null && period != null) {

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
                    xmlhttp.open("GET", "../controller/co_load_lease_customer.php?payment=" + payment + "&period=" + period, true);
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
            function checkForm() {
                if (document.getElementById('cus_nic').value != "" || document.getElementById('cus_nic').value != null) {
                    form.customer_continue.disabled = true;
                    form.customer_continue.value = "Please wait...";
                    return true;
                } else {
                    return false;
                    alert('Please Enter Nic');
                }
            }
        </script>
    </head>
    <body>

        <?php include '../assets/include/navigation_bar.php'; ?>
        <!--Customer Panel Section-->
        <form action="../controller/co_customer.php" method="POST" enctype="multipart/form-data">
            <div class="container" style="margin-top: 80px;display: block;" id="one">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Customer Registration</h3>
                            </div>
                            <div class="panel-body" style="background-color: #FAFAFA;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <!-- Start.Customer Personal Details -->
                                        <legend>Customer Personal Details</legend>
                                        <div class="form-group  ">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="cus_name" maxlength="100" name="cus_name" placeholder="Full Name" class="form-control" maxlength="100" autofocus />
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-inline required">
                                                <label class="control-label" >Permanent Address :</label>
                                                <input type="text" id="cus_paddress" maxlength="255"  name="cus_address" placeholder="Permanent Address"   class="form-control" maxlength="150"style="width: 85%;"/>
                                                <input type="button" class="btn btn" id="custcontinue" value="Search" onclick="setPositiontoMap();">
                                            </div>
                                        </div>
                                        <div id="map_location" style="width: 100%" height="400">

                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Telephone:</label>
                                            <input type="number" id="cus_tp" name="cus_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0" placeholder="077XXXXXXX" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <span style="color:red;">*</span><label class="control-label" >NIC Number:</label>
                                            <input type="text" id="cus_nic" name="cus_nic" maxlength="10" placeholder="XXXXXXXXXV"  class="form-control" style="text-transform: uppercase;" required/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="cus_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" name="cus_dob" value="<?php echo $gua_dob; ?>" placeholder="Date of Birth" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Employment/Position:</label>
                                            <input type="text" id="cus_position" maxlength="100" name="cus_position" value="<?php echo $cus_position; ?>" placeholder="Employment/Position"  class="form-control" maxlength="80"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Monthly Salary/Net Income:</label>
                                            <input type="number" id="cus_salary" name="cus_salary" value="<?php echo $cus_monthly_salary; ?>" placeholder="XXXXXXXX"  class="form-control" min="0"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Employer Name:</label>
                                            <input type="text" name="cus_emp_name" maxlength="100" value="<?php echo $cus_emp_name; ?>" placeholder="Employer Name"   class="form-control" maxlength="200"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="cus_emp_name" maxlength="100"  name="cus_emp_address" value="<?php echo $cus_emp_address; ?>" placeholder="No,Street,City"   class="form-control" maxlength="250"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Married Status:</label>
                                            <select name="cus_ms" class="form-control" id="c_m_status" onchange="setCusDependancy();">
                                                <option value="">~~Select Status~~</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Have any Dependencies:</label>
                                            <input type="number" id="cus_dependdency" min="0" max="20" name="cus_dependdency" value="0" placeholder="Have any Dependencies"  class="form-control" maxlength="2" readonly/>
                                        </div>
                                    </fieldset>
                                    <fieldset id="account">
                                        <!-- Start.Customer Better Half Details --> 
                                        <legend>Customer Spouse Details</legend>

                                        <div class="form-group  ">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="cus_spouse_name"  readonly maxlength="100"  name="cus_spouse_name" id="fname" placeholder="Full Name" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="cus_spouse_dob" readonly min="1900-12-31" max="<?php echo $reg_date; ?>" value="<?php echo $reg_date; ?>" name="cus_spouse_dob" placeholder="Date of Birth" class="form-control" />
                                        </div>

                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="cus_spouse_position" readonly maxlength="100" name="cus_spouse_position" placeholder="Employment/Position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="cus_spouse_salary" readonly min="0" name="cus_spouse_salary" placeholder="XXXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="cus_spouse_emp_name" readonly maxlength="100"  name="cus_spouse_emp_name" placeholder="Employer Name" class="form-control" />
                                        </div>

                                        <div class="form-group  ">
                                            <label class="control-label">Map Link :</label>
                                            <input type="text" readonly id="cus_addr_map_link" name="cus_addr_map_link" value="<?php echo $cus_addr_map_link; ?>" placeholder="Map Link" class="form-control" form="f1_cus"/>
                                        </div>

                                    </fieldset>
                                    <fieldset id="account">
                                        <legend>Proposer Personal Details</legend>
                                        <div class="form-group">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="prop_name" maxlength="100" name="prop_name" id="fname" placeholder="Full Name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="prop_address" maxlength="255" name="prop_address" value="<?php echo $gua_address; ?>" placeholder="Permanent Address" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Telephone:</label>
                                            <input type="number" id="prop_tp" name="prop_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" value="<?php echo $gua_tp; ?>" placeholder="077XXXXXXX"  min="0" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="prop_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" value="<?php echo $reg_date; ?>" name="prop_dob" placeholder="Date of Birth" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">NIC Number:</label>
                                            <input type="text" id="prop_nic" name="prop_nic" maxlength="10" value="<?php echo $gua_nic; ?>" placeholder="XXXXXXXXXV" class="form-control" style="text-transform: uppercase;"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Married Status:</label>
                                            <select name="prop_ms" value="<?php echo $gua_ms; ?>" class="form-control" id="prop_ms" onchange="setPropDependancy();">
                                                <option value="">~~Select Status~~</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Spouse Name:</label>
                                            <input type="text" id="prop_spouse_name" readonly maxlength="100" name="prop_spouse_name" id="fname" placeholder="Spouse Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="prop_postion" name="prop_postion" placeholder="Employment/Position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="prop_salary" min="0" name="prop_salary" value="<?php echo $gua_monthly_salary; ?>" placeholder="XXXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="prop_emp_name" maxlength="100" name="prop_emp_name" value="<?php echo $gua_emp_name; ?>" placeholder="Employer Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="prop_emp_address" maxlength="255" name="prop_emp_address" value="<?php echo $gua_emp_address; ?>" placeholder="No,Street,City" class="form-control"/>
                                        </div>
                                    </fieldset>
                                </div>

                                <!-- Customer Guranter Details-->

                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Guarantor-01 Personal Details</legend>
                                        <div class="form-group  ">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="g1_name" maxlength="100"  name="g1_name" id="g1_name" placeholder="Full Name" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="g1_address" maxlength="255"  name="g1_address" placeholder="Permanent Address" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Telephone:</label>
                                            <input type="number" id="g1_tp" name="g1_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0" value="<?php echo $gua_tp; ?>" placeholder="077XXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="g1_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" name="g1_dob" value="<?php echo $gua_dob; ?>" placeholder="Date of Birth"   class="form-control" />

                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">NIC Number:</label>
                                            <input type="text" id="g1_nic" name="g1_nic" maxlength="10" value="<?php echo $gua_nic; ?>" placeholder="XXXXXXXXXV"   class="form-control" style="text-transform: uppercase;"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Married Status:</label>
                                            <select name="g1_ms" id="g1_ms" class="form-control"  onchange="setGua1Dependancy();">
                                                <option value="">~~Select Status~~</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Spouse Name:</label>
                                            <input type="text" id="g1_spouse" readonly maxlength="100" name="g1_spouse" id="fname" value="<?php echo $gua_bhalf_fullname; ?>" placeholder="Spouse Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="g1_position" name="g1_position" value="<?php echo $gua_position; ?>" placeholder="Employment/Position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="g1_salary" min="0" name="g1_salary" value="<?php echo $gua_monthly_salary; ?>" placeholder="XXXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="g1_emp_name" maxlength="100" name="g1_emp_name" value="<?php echo $gua_emp_name; ?>" placeholder="Employer Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="g1_emp_address" maxlength="255" name="g1_emp_address" value="<?php echo $gua_emp_address; ?>" placeholder="No,Street,City" class="form-control"/>
                                        </div>
                                    </fieldset>
                                    <fieldset id="account">
                                        <legend>Guarantor-02 Personal Details</legend>
                                        <div class="form-group">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="g2_name" maxlength="100"  name="g2_name" id="fname" value="<?php echo $gua_fullname; ?>" placeholder="Full Name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="g2_address" maxlength="255"  name="g2_address" value="<?php echo $gua_address; ?>" placeholder="Permanent Address" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Telephone:</label>
                                            <input type="number" id="g2_tp" name="g2_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" value="<?php echo $gua_tp; ?>" placeholder="077XXXXXXX"  min="0" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="g2_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" name="g2_dob" value="<?php echo $gua_dob; ?>" placeholder="Date of Birth"   class="form-control" />

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">NIC Number:</label>
                                            <input type="text" id="g2_nic" name="g2_nic" maxlength="10" value="<?php echo $gua_nic; ?>" placeholder="XXXXXXXXXV" class="form-control" style="text-transform: uppercase;"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Married Status:</label>
                                            <select name="g2_ms" value="<?php echo $gua_ms; ?>" class="form-control" id="g2_ms" onchange="setGua2Dependancy();">
                                                <option value="">~~Select Status~~</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <span style="color:red;"></span><label class="control-label">Spouse Name:</label>
                                            <input type="text" maxlength="100" readonly name="g2_spouse" id="g2_spouse" value="<?php echo $gua_bhalf_fullname; ?>" placeholder="Spouse Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="g2_position" name="g2_position" value="<?php echo $gua_position; ?>" placeholder="Employment/Position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="g2_salary" min="0" name="g2_salary" value="<?php echo $gua_monthly_salary; ?>" placeholder="XXXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="g2_emp_name" maxlength="100" name="g2_emp_name" value="<?php echo $gua_emp_name; ?>" placeholder="Employer Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="g2_emp_address" maxlength="255" name="g2_emp_address" value="<?php echo $gua_emp_address; ?>" placeholder="No,Street,City" class="form-control"/>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-12">
                                    <!--Real Property Details-->
                                    <fieldset id="account">
                                        <legend>Real Property</legend>
                                        <div class="form-group ">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="thcaption">Category</th>
                                                        <th class="thcaption">Address</th>
                                                        <th class="thcaption">Size</th>
                                                        <th class="thcaption">Value</th>
                                                        <th class="thcaption">Mortgage status</th>
                                                        <th class="thcaption">Mortgagee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>House<input type="hidden" value="House" name="home"></td>
                                                        <td>  <input type="text" id="house_property" name="real_prp_house_position" maxlength="100" value="<?php echo $real_prp_house_position; ?>" placeholder="Address" class="form-control"/></td>
                                                        <td>  <input type="text" id="house_size" name="real_prp_house_size" maxlength="100" value="<?php echo $real_prp_house_size; ?>" placeholder="Size" class="form-control" /></td>
                                                        <td>  <input type="text" id="house_value" name="real_prp_house_value" maxlength="10" value="<?php echo $real_prp_house_value; ?>" placeholder="XXXXXXXX" class="form-control" /></td>
                                                        <td>  <input type="text" id="house_pawned" name="real_prp_house_pawned" maxlength="10" value="<?php echo $real_prp_house_pawned; ?>" placeholder="Yes or No" class="form-control" /></td>
                                                        <td>  <input type="text" id="house_pawn_getter" name="real_prp_house_pawn_getter" maxlength="100" value="<?php echo $real_prp_house_pawn_getter; ?>" placeholder="Pawn Getter" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other Property<input type="hidden" value="Other Property" name="op"></td>
                                                        <td><input type="text" name="real_prp_other_position" maxlength="100" value="<?php echo $real_prp_other_position; ?>" placeholder="Address" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_size" maxlength="100" value="<?php echo $real_prp_other_size; ?>" placeholder="Size" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_value" maxlength="10" value="<?php echo $real_prp_other_value; ?>" placeholder="XXXXXXXX" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_pawned" maxlength="10" value="<?php echo $real_prp_other_pawned; ?>" placeholder="Yes or No" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_pawn_getter" maxlength="100" value="<?php echo $real_prp_other_pawn_getter; ?>" placeholder="Pawn Getter"   class="form-control" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                    <!--Bank Accounts Details-->

                                    <fieldset id="account">
                                        <legend>Bank Accounts</legend>
                                        <div class="form-group ">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="thcaption">Category</th>
                                                        <th class="thcaption">Bank Name & Branch</th>
                                                        <th class="thcaption">Facilities</th>
                                                        <th class="thcaption">Account Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Savings Account</td>
                                                        <td>  <input type="text" id="saving_account_bank" name="cus_savings_bank_branch" value="<?php echo $cus_savings_bank_branch; ?>" placeholder="Bank Name & Branch" maxlength="100"  class="form-control" /></td>
                                                        <td>  <input type="text" id="saving_facility" name="cus_savings_facilities" value="<?php echo $cus_savings_facilities; ?>" placeholder="Facilities" maxlength="100" class="form-control" /></td>
                                                        <td>  <input type="text" id="saving_acc_no" name="cus_savings_account_no" value="<?php echo $cus_savings_account_no; ?>" placeholder="Account Number" maxlength="50" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Current Account</td>
                                                        <td><input type="text" name="cus_mobile_bank_branch" value="<?php echo $cus_mobile_bank_branch; ?>" placeholder="Bank Name & Branch" maxlength="100"  class="form-control" /></td>
                                                        <td><input type="text" name="cus_mobile_facilities" value="<?php echo $cus_mobile_facilities; ?>" placeholder="Facilities" maxlength="100" class="form-control" /></td>
                                                        <td><input type="text" name="cus_mobile_account_no" value="<?php echo $cus_mobile_account_no; ?>" placeholder="Account Number" maxlength="50" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Daily Loan Service</td>
                                                        <td><input type="text" name="cus_daily_loan_bank_branch" value="<?php echo $cus_daily_loan_bank_branch; ?>" placeholder="Bank Name & Branch" maxlength="100" class="form-control" /></td>
                                                        <td><input type="text" name="cus_daily_loan_facilities" value="<?php echo $cus_daily_loan_facilities; ?>" placeholder="Facilities" maxlength="100"  class="form-control" /></td>
                                                        <td><input type="text" name="cus_daily_loan_account_no" value="<?php echo $cus_daily_loan_account_no; ?>" placeholder="Account Number" maxlength="50" class="form-control" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Registration Date</label>
                                        <div class="fomr-inline" id="msg_caption">
                                            <input type="date" id="cus_reg_date" name="cus_reg_date" value="<?php echo $reg_date; ?>" placeholder="Date" class="form-control" />
                                            <br><p><b>Warning</b> :~~  ~~ are mandatory fields, should not be empty</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn" name="customer_continue" id="custcontinue" value="Continue">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Over.Customer Panel Section-->
        </form>
        <!--Over.Property Panel Section-->


        <!--Footer Section-->
        <?php include '../assets/include/footer.php'; ?>
        <!--Footer Section-->

        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <style>
            #panelheading
            {
                background: #009688;
                color: white;          
            }
            #custcontinue
            {
                background-color: #009688;
                color: white;
                float: right;
            }
            #custcontinue:hover
            {
                background-color: #004D40;
            }
            #backregister
            {
                background-color: #009688;
                color: white;
                float: right;
                margin-right: 12px;
            }
            #backregister:hover
            {
                background-color: #004D40;
            }
        </style>
        <script type="text/javascript">
                                                function gotosecond()
                                                {
                                                    document.getElementById('one').style.display = "none";
                                                    document.getElementById('second').style.display = "block";
                                                }
                                                function gotoone()
                                                {
                                                    document.getElementById('one').style.display = "block";
                                                    document.getElementById('second').style.display = "none";
                                                }
                                                function setCusDependancy() {
                                                    if (document.getElementById('c_m_status').value == "Single") {
                                                        //alert("Single");
                                                        document.getElementById('cus_dependdency').value = "0";
                                                        document.getElementById('cus_dependdency').readOnly = true;
                                                        document.getElementById('cus_spouse_name').value = "None";
                                                        document.getElementById('cus_spouse_name').readOnly = true;
                                                        document.getElementById('cus_spouse_dob').readOnly = true;
                                                        document.getElementById('cus_spouse_position').value = "None";
                                                        document.getElementById('cus_spouse_position').readOnly = true;
                                                        document.getElementById('cus_spouse_salary').value = "0";
                                                        document.getElementById('cus_spouse_salary').readOnly = true;
                                                        document.getElementById('cus_spouse_emp_name').value = "None";
                                                        document.getElementById('cus_spouse_emp_name').readOnly = true;
                                                    }
                                                    else if (document.getElementById('c_m_status').value == "Married") {
                                                        // alert("Married");
                                                        document.getElementById('cus_dependdency').value = "0";
                                                        document.getElementById('cus_dependdency').readOnly = false;
                                                        document.getElementById('cus_spouse_name').value = "";
                                                        document.getElementById('cus_spouse_name').readOnly = false;
                                                        document.getElementById('cus_spouse_dob').readOnly = false;
                                                        document.getElementById('cus_spouse_position').value = "";
                                                        document.getElementById('cus_spouse_position').readOnly = false;
                                                        document.getElementById('cus_spouse_salary').value = "0";
                                                        document.getElementById('cus_spouse_salary').readOnly = false;
                                                        document.getElementById('cus_spouse_emp_name').value = "";
                                                        document.getElementById('cus_spouse_emp_name').readOnly = false;
                                                    }
                                                }
                                                function setGua1Dependancy() {
                                                    if (document.getElementById('g1_ms').value == "Single") {
                                                        document.getElementById('g1_spouse').value = "None";
                                                        document.getElementById('g1_spouse').readOnly = true;

                                                    }
                                                    else if (document.getElementById('g1_ms').value == "Married") {
                                                        document.getElementById('g1_spouse').value = "";
                                                        document.getElementById('g1_spouse').readOnly = false;
                                                    }
                                                }
                                                function setPropDependancy() {
                                                    if (document.getElementById('prop_ms').value == "Single") {
                                                        //alert(document.getElementById('prop_ms').value);
                                                        document.getElementById('prop_spouse_name').value = "None";
                                                        document.getElementById('prop_spouse_name').readOnly = true;

                                                    }
                                                    else if (document.getElementById('prop_ms').value == "Married") {
                                                        //alert(document.getElementById('prop_ms').value);
                                                        document.getElementById('prop_spouse_name').value = "";
                                                        document.getElementById('prop_spouse_name').readOnly = false;
                                                    }
                                                }

                                                function setGua2Dependancy() {
                                                    if (document.getElementById('g2_ms').value == "Single") {
                                                        document.getElementById('g2_spouse').value = "None";
                                                        document.getElementById('g2_spouse').readOnly = true;

                                                    }
                                                    else if (document.getElementById('g2_ms').value == "Married") {
                                                        document.getElementById('g2_spouse').value = "";
                                                        document.getElementById('g2_spouse').readOnly = false;
                                                    }
                                                }



        </script>
        <script>
            function check()
            {
                var property = document.getElementById('input-region').value;
                if (property == 'bike')
                {
                    //alert("Bike");
                    document.getElementById('landpanel').style.display = 'none';
                    document.getElementById('leasepanel').style.display = 'block';
                } else if (property == 'twheel')
                {
                    //alert("Three-Wheel");
                    document.getElementById('landpanel').style.display = 'none';
                    document.getElementById('leasepanel').style.display = 'block';
                } else if (property == 'land')
                {
                    //alert("Land");
                    document.getElementById('leasepanel').style.display = 'none';
                    document.getElementById('landpanel').style.display = 'block';
                }
            }
        </script>
        <script type="text/javascript">
            function checkCustomerValues() {

                var cus_fullname = document.getElementById('cus_fullname').value
                var cus_initial = document.getElementById('cus_initial').value
                var cus_paddress = document.getElementById('cus_paddress').value
                var cus_tp = document.getElementById('cus_tp').value
                var cus_nic = document.getElementById('cus_nic').value
                var cus_dob = document.getElementById('cus_dob').value
                var cus_depend = document.getElementById('cus_depend').value
                var cus_position = document.getElementById('cus_position').value
                var cus_salary = document.getElementById('cus_salary').value
                var cus_emp_name = document.getElementById('cus_emp_name').value

                var cus_bhalf_name = document.getElementById('cus_bhalf_name').value
                var cus_bhalf_dob = document.getElementById('cus_bhalf_dob').value
                var cus_bhalf_position = document.getElementById('cus_bhalf_position').value
                var cus_bhalf_salary = document.getElementById('cus_bhalf_salary').value
                var cus_bhalf_emp_name = document.getElementById('cus_bhalf_emp_name').value

                var g_fullname = document.getElementById('g_fullname').value
                var g_initial = document.getElementById('g_initial').value
                var g_address = document.getElementById('g_address').value
                var g_tp = document.getElementById('g_tp').value
                var g_dob = document.getElementById('g_dob').value
                var g_nic = document.getElementById('g_nic').value
                var g_depend = document.getElementById('g_depend').value
                var g_position = document.getElementById('g_position').value
                var g_salary = document.getElementById('g_salary').value
                var g_emp_name = document.getElementById('g_emp_name').value
                var g_emp_address = document.getElementById('g_emp_address').value

                var g_bhalf_fullname = document.getElementById('g_bhalf_fullname').value
                var g_bhalf_dob = document.getElementById('g_bhalf_dob').value
                var g_bhalf_position = document.getElementById('g_bhalf_position').value
                var g_bhalf_salary = document.getElementById('g_bhalf_salary').value
                var g_bhalf_emp_name = document.getElementById('g_bhalf_emp_name').value

                var house_property = document.getElementById('house_property').value
                var house_size = document.getElementById('house_size').value
                var house_value = document.getElementById('house_value').value
                var house_pawned = document.getElementById('house_pawned').value
                var house_pawn_getter = document.getElementById('house_pawn_getter').value

                var saving_account_bank = document.getElementById('saving_account_bank').value
                var saving_facility = document.getElementById('saving_facility').value
                var saving_acc_no = document.getElementById('saving_acc_no').value
                var cus_reg_date = document.getElementById('cus_reg_date').value

                if (cus_fullname != "" && cus_initial != "" && cus_paddress != "" && cus_tp != "" && cus_nic != "" && cus_dob != "" && cus_depend != "" &&
                        cus_position != "" && cus_salary != "" && cus_emp_name != "" && cus_bhalf_name != "" && cus_bhalf_dob != "" && cus_bhalf_position != "" &&
                        cus_bhalf_salary != "" && cus_bhalf_emp_name != "" && g_fullname != "" && g_initial != "" && g_address != "" &&
                        g_tp != "" && g_dob != "" && g_nic != "" && g_depend != "" && g_position != "" && g_salary != "" && g_emp_name != "" && g_emp_address != "" &&
                        g_bhalf_fullname != "" && g_bhalf_dob != "" && g_bhalf_position != "" && g_bhalf_salary != "" && g_bhalf_emp_name != "" &&
                        house_property != "" && house_size != "" && house_value != "" && house_pawned != "" && house_pawn_getter != "" &&
                        saving_account_bank != "" && saving_facility != "" && saving_acc_no != "" && cus_reg_date != "") {
                    document.getElementById('msg_caption').style.color = "black";
                    gotosecond();
                } else {
                    document.getElementById('msg_caption').style.color = "red";
                    alert("Empty Data Fields Found,Please Insert Valid Data");
                }
            }
        </script>
        <script type="text/javascript">
            function setPositiontoMap() {
                var maplocation = document.getElementById('cus_paddress').value;
                var val = '<iframe style="width: 100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAZug4gv6zHg69WJ_5sInSlEYeTdGDrf_E &q=' + maplocation + ',sri lanka" allowfullscreen></iframe>';

                document.getElementById('map_location').innerHTML = "";
                document.getElementById('map_location').innerHTML = val;
            }
        </script>
    </body>
</html>
