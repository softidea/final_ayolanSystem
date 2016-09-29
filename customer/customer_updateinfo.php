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

    $gua_emp_address = "";
    $gua_emp_name = "";
    $gua_position = "";
    $gua_bhalf_fullname = "";
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
        <?php
        require '../controller/co_load_vehicle_brands.php';
        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
//         require_once '../db/newDB.php';
        if (mysqli_connect_errno()) {
            echo "Falied to Connect the Database" . mysqli_connect_error();
        }
        ?>
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
            function searchUpdateCustomer() {
                var customer_nic = document.getElementById('search_cus_nic').value;


                if (customer_nic != "" && customer_nic != null) {

                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            var result = xmlhttp.responseText;
                            var result_arr = result.split("#");

//                          Cusomer Informations

                            document.getElementById('cus_name').value = result_arr[0];
                            document.getElementById('cus_address').value = result_arr[1];
                            document.getElementById('cus_tp').value = result_arr[2];
                            document.getElementById('cus_nic').value = result_arr[3];
                            document.getElementById('cus_dob').value = result_arr[4];
                            document.getElementById('cus_position').value = result_arr[5];
                            document.getElementById('cus_salary').value = result_arr[6];
                            document.getElementById('cus_emp_name').value = result_arr[7];
                            document.getElementById('cus_emp_address').value = result_arr[8];
                            document.getElementById('cus_ms').value = result_arr[9];
                            document.getElementById('cus_dependdency').value = result_arr[10];
                            document.getElementById('cus_spouse_dob').value = result_arr[11];
                            document.getElementById('cus_spouse_position').value = result_arr[12];
                            document.getElementById('cus_spouse_salary').value = result_arr[13];
                            document.getElementById('cus_spouse_emp_name').value = result_arr[14];
                            document.getElementById('cus_addr_map_link').value = result_arr[15];
                            document.getElementById('prop_name').value = result_arr[16];
                            document.getElementById('prop_address').value = result_arr[17];
                            document.getElementById('prop_tp').value = result_arr[18];
                            document.getElementById('prop_dob').value = result_arr[19];
                            document.getElementById('prop_nic').value = result_arr[20];
                            document.getElementById('prop_ms').value = result_arr[21];


                            document.getElementById('reg_date').value = result_arr[22];

                            document.getElementById('prop_spouse_name').value = result_arr[23];
                            document.getElementById('prop_postion').value = result_arr[24];
                            document.getElementById('prop_salary').value = result_arr[25];
                            document.getElementById('prop_emp_name').value = result_arr[26];
                            document.getElementById('prop_emp_address').value = result_arr[27];

//                            Gerunter 1 Informations

                            document.getElementById('g1_name').value = result_arr[28];
                            document.getElementById('g1_address').value = result_arr[29];
                            document.getElementById('g1_tp').value = result_arr[30];
                            document.getElementById('g1_dob').value = result_arr[31];
                            document.getElementById('g1_nic').value = result_arr[32];
                            document.getElementById('g1_ms').value = result_arr[33];
                            document.getElementById('g1_spouse').value = result_arr[34];
                            document.getElementById('g1_position').value = result_arr[35];
                            document.getElementById('g1_salary').value = result_arr[36];
                            document.getElementById('g1_emp_name').value = result_arr[37];
                            document.getElementById('g1_emp_address').value = result_arr[38];

//                            Gerunter 2 Informations

                            document.getElementById('g2_name').value = result_arr[39];
                            document.getElementById('g2_address').value = result_arr[40];
                            document.getElementById('g2_tp').value = result_arr[41];
                            document.getElementById('g2_dob').value = result_arr[42];
                            document.getElementById('g2_nic').value = result_arr[43];
                            document.getElementById('g2_ms').value = result_arr[44];
                            document.getElementById('g2_spouse').value = result_arr[45];
                            document.getElementById('g2_position').value = result_arr[46];
                            document.getElementById('g2_salary').value = result_arr[47];
                            document.getElementById('g2_emp_name').value = result_arr[48];
                            document.getElementById('g2_emp_address').value = result_arr[49];

//                            Real Property House Details

                            document.getElementById('real_prp_house_position').value = result_arr[50];
                            document.getElementById('real_prp_house_size').value = result_arr[51];
                            document.getElementById('real_prp_house_value').value = result_arr[52];
                            document.getElementById('real_prp_house_pawned').value = result_arr[53];
                            document.getElementById('real_prp_house_pawn_getter').value = result_arr[54];

//                            Other Property House Details

                            document.getElementById('real_prp_other_position').value = result_arr[55];
                            document.getElementById('real_prp_other_size').value = result_arr[56];
                            document.getElementById('real_prp_other_value').value = result_arr[57];
                            document.getElementById('real_prp_other_pawned').value = result_arr[58];
                            document.getElementById('real_prp_other_pawn_getter').value = result_arr[59];

//                            Saving Bank Details

                            document.getElementById('cus_savings_bank_branch').value = result_arr[60];
                            document.getElementById('cus_savings_facilities').value = result_arr[61];
                            document.getElementById('cus_savings_account_no').value = result_arr[62];

//                            Mobile Bank Details

                            document.getElementById('cus_mobile_bank_branch').value = result_arr[63];
                            document.getElementById('cus_mobile_facilities').value = result_arr[64];
                            document.getElementById('cus_mobile_account_no').value = result_arr[65];

//                            Saving Bank Details

                            document.getElementById('cus_daily_loan_bank_branch').value = result_arr[66];
                            document.getElementById('cus_daily_loan_facilities').value = result_arr[67];
                            document.getElementById('cus_daily_loan_account_no').value = result_arr[67];

                            document.getElementById('g1_id').value = result_arr[68];
                            document.getElementById('g2_id').value = result_arr[69];

                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_update.php?customer_nic=" + customer_nic, true);
                    xmlhttp.send();
                }
            }
        </script>

    </head>
    <body>

        <?php include '../assets/include/navigation_bar.php'; ?>

        <!--Customer Panel Section-->
        <form  method="POST" enctype="multipart/form-data">
            <div class="container" style="margin-top: 80px;display: block;" id="one">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Update Customer Informations</h3>
                            </div>
                            <div class="panel-body" style="background-color: #FAFAFA;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <!-- Start.Customer Personal Details -->
                                        <div class="form-group required">
                                            <label class="control-label">Enter Customer NIC:</label>
                                            <div class="form-inline required">
                                                <input type="text"  name="search_cus_nic" id="search_cus_nic" placeholder="NIC" class="form-control" style="width:85%;text-transform: uppercase;" maxlength="10" required autofocus/>
                                                <input type="button" class="btn btn" id="custcontinue" onclick="searchUpdateCustomer();" value="Search">
                                            </div>
                                        </div>
                                        <legend>Customer Personal Details</legend>
                                        <div class="form-group  ">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="cus_name" maxlength="100"  name="cus_name" class="form-control" maxlength="100"  />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Permanent Address :</label>
                                            <input type="text" id="cus_address" maxlength="255"  name="cus_address" class="form-control" maxlength="150"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Telephone:</label>
                                            <input type="number" id="cus_tp" name="cus_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0" placeholder="077XXXXXXX" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <span style="color:red;">*</span>  <label class="control-label" >NIC Number:</label>
                                            <input type="text" id="cus_nic" name="cus_nic" maxlength="10" class="form-control" disabled style="text-transform: uppercase;" required/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="cus_dob" min="1900-12-31"  name="cus_dob" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Employment/Position:</label>
                                            <input type="text" id="cus_position" maxlength="100" name="cus_position"  class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Monthly Salary/Net Income:</label>
                                            <input type="number" id="cus_salary" name="cus_salary"  class="form-control" min="0"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Employer Name:</label>
                                            <input type="text" name="cus_emp_name" id="cus_emp_name" class="form-control" maxlength="100"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="cus_emp_address" name="cus_emp_address" class="form-control" maxlength="250"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Married Status:</label>
                                            <select name="cus_ms" class="form-control" id="cus_ms" onchange="setCusDependancy();">
                                                <option value="">~~Select Status~~</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Have any Dependencies:</label>
                                            <input type="number" id="cus_dependdency" min="0" max="20" name="cus_dependdency" class="form-control" maxlength="2" readonly/>
                                        </div>
                                    </fieldset>
                                    <fieldset id="account">
                                        <!-- Start.Customer Better Half Details --> 
                                        <legend>Customer Spouse Details</legend>

                                        <div class="form-group  ">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="cus_spouse_name"  readonly maxlength="100"  name="cus_spouse_name" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="cus_spouse_dob" readonly min="1900-12-31" max="<?php echo $reg_date; ?>"  name="cus_spouse_dob" class="form-control" />
                                        </div>

                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="cus_spouse_position" readonly maxlength="100" name="cus_spouse_position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="cus_spouse_salary" readonly min="0" name="cus_spouse_salary" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="cus_spouse_emp_name" readonly maxlength="100"  name="cus_spouse_emp_name" class="form-control" />
                                        </div>

                                        <div class="form-group  ">
                                            <label class="control-label">Map Link :</label>
                                            <input type="text" readonly id="cus_addr_map_link" name="cus_addr_map_link"  class="form-control" form="f1_cus"/>
                                        </div>

                                    </fieldset>
                                    <fieldset id="account">
                                        <legend>Proposer Personal Details</legend>
                                        <div class="form-group">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" maxlength="100" name="prop_name" id="prop_name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="prop_address" maxlength="255" name="prop_address"  class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Telephone:</label>
                                            <input type="number" id="prop_tp" name="prop_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10"  min="0" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="prop_dob" min="1900-12-31"  name="prop_dob" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">NIC Number:</label>
                                            <input type="text" id="prop_nic" name="prop_nic" maxlength="10" placeholder="XXXXXXXXXV" class="form-control" style="text-transform: uppercase;"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Married Status:</label>
                                            <select name="prop_ms" class="form-control" id="prop_ms" onchange="setPropDependancy();">
                                                <option value="">~~Select Status~~</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Spouse Name:</label>
                                            <input type="text" id="prop_spouse_name" readonly maxlength="100" name="prop_spouse_name" id="fname"  class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="prop_postion" name="prop_postion" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="prop_salary" min="0" name="prop_salary" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="prop_emp_name" maxlength="100" name="prop_emp_name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="prop_emp_address" maxlength="255" name="prop_emp_address"  class="form-control"/>
                                        </div>
                                    </fieldset>
                                </div>

                                <!-- Customer Guranter Details-->

                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Guarantor-01 Personal Details</legend>
                                        <div class="form-group  ">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="g1_name" maxlength="100"  name="g1_name"  class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="g1_address" maxlength="255"  name="g1_address" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Telephone:</label>
                                            <input type="number" id="g1_tp" name="g1_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0"  class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="g1_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" name="g1_dob" placeholder="Date of Birth"   class="form-control" />

                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">NIC Number:</label>
                                            <input type="text" id="g1_nic" name="g1_nic" maxlength="10" placeholder="XXXXXXXXXV"   class="form-control" style="text-transform: uppercase;"/>
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
                                            <input type="text" id="g1_spouse" readonly maxlength="100" name="g1_spouse" id="fname"  placeholder="Spouse Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="g1_position" name="g1_position"  placeholder="Employment/Position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="g1_salary" min="0" name="g1_salary"  placeholder="XXXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="g1_emp_name" maxlength="100" name="g1_emp_name"  placeholder="Employer Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="g1_emp_address" maxlength="255" name="g1_emp_address"  placeholder="No,Street,City" class="form-control"/>
                                        </div>
                                    </fieldset>
                                    <fieldset id="account">
                                        <legend>Guarantor-02 Personal Details</legend>
                                        <div class="form-group">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="g2_name" maxlength="100"  name="g2_name" id="fname"  placeholder="Full Name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="g2_address" maxlength="255"  name="g2_address" placeholder="Permanent Address" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Telephone:</label>
                                            <input type="number" id="g2_tp" name="g2_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" value="<?php echo $gua_tp; ?>" placeholder="077XXXXXXX"  min="0" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="g2_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" name="g2_dob"  placeholder="Date of Birth"   class="form-control" />

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">NIC Number:</label>
                                            <input type="text" id="g2_nic" name="g2_nic" maxlength="10" placeholder="XXXXXXXXXV" class="form-control" style="text-transform: uppercase;"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Married Status:</label>
                                            <select name="g2_ms"  class="form-control" id="g2_ms" onchange="setGua2Dependancy();">
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
                                        <div class="form-group  ">

                                            <input type="hidden" id="g1_id" maxlength="255" name="g1_id"  class="form-control" />
                                        </div>
                                        <div class="form-group  ">

                                            <input type="hidden" id="g2_id" maxlength="255" name="g2_id"  class="form-control" />
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
                                                        <td><input type="text" name="real_prp_house_position" id="real_prp_house_position" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_house_size" id="real_prp_house_size" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_house_value" id="real_prp_house_value" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_house_pawned" id="real_prp_house_pawned" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_house_pawn_getter" id="real_prp_house_pawn_getter" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other Property<input type="hidden" value="Other Property" name="op"></td>
                                                        <td><input type="text" name="real_prp_other_position" id="real_prp_other_position" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_size" id="real_prp_other_size" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_value" id="real_prp_other_value" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_pawned"  id="real_prp_other_pawned" class="form-control" /></td>
                                                        <td><input type="text" name="real_prp_other_pawn_getter" id="real_prp_other_pawn_getter" class="form-control" /></td>
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
                                                        <td><input type="text" name="cus_savings_bank_branch" id="cus_savings_bank_branch" class="form-control" maxlength="100"/></td>
                                                        <td><input type="text" name="cus_savings_facilities" id="cus_savings_facilities" class="form-control" maxlength="100"/></td>
                                                        <td><input type="text" name="cus_savings_account_no"  id="cus_savings_account_no" class="form-control"maxlength="50" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile Account</td>
                                                        <td><input type="text" name="cus_mobile_bank_branch" id="cus_mobile_bank_branch" class="form-control" maxlength="100"/></td>
                                                        <td><input type="text" name="cus_mobile_facilities" id="cus_mobile_facilities" class="form-control"maxlength="100" /></td>
                                                        <td><input type="text" name="cus_mobile_account_no" id="cus_mobile_account_no" class="form-control" maxlength="50"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Daily Loan Service</td>
                                                        <td><input type="text" name="cus_daily_loan_bank_branch" id="cus_daily_loan_bank_branch" class="form-control" maxlength="100"/></td>
                                                        <td><input type="text" name="cus_daily_loan_facilities" id="cus_daily_loan_facilities" class="form-control" maxlength="100"/></td>
                                                        <td><input type="text" name="cus_daily_loan_account_no" id="cus_daily_loan_account_no" class="form-control" maxlength="50"/></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label" for="input-email">Registration Date</label>   
                                    <input type="date" name="reg_date" id="reg_date" class="form-control" disabled />

                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn" name="customer_update" id="custcontinue" value="Update">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Over.Customer Panel Section-->
        </form>
        <!--Over.Property Panel Section-->

        <!--Update customers start--> 
        <?php
        if (isset($_POST['customer_update'])) {

            //update customer
            $quary_update_customer = "UPDATE 
  `customer` 
SET

 
  `cus_address` = '" . $_POST['cus_address'] . "',
  `cus_tp` = '" . $_POST['cus_tp'] . "',
  `cus_dob` = '" . $_POST['cus_dob'] . "',
  `cus_ms` = '" . $_POST['cus_ms'] . "',
  `cus_dependdency` = '" . $_POST['cus_dependdency'] . "',
  `cus_position` = '" . $_POST['cus_position'] . "',
  `cus_monthly_salary` = '" . $_POST['cus_salary'] . "',
  `cus_emp_name` = '" . $_POST['cus_emp_name'] . "',
  `cus_emp_address` = '" . $_POST['cus_emp_address'] . "',
  `cus_addr_map_link` = '" . $_POST['cus_addr_map_link'] . "',
  `wife_name` = '" . $_POST['cus_spouse_name'] . "',
  `wife_dob` = '" . $_POST['cus_spouse_dob'] . "',
  `wife_position` = '" . $_POST['cus_spouse_position'] . "',
  `wife_salary` = '" . $_POST['cus_spouse_salary'] . "',
  `wife_emp_name` = '" . $_POST['cus_spouse_emp_name'] . "',
  `proposer_name` = '" . $_POST['prop_name'] . "',
  `proposer_address` = '" . $_POST['prop_address'] . "',
  `proposer_tp` = '" . $_POST['prop_tp'] . "',
  `proposer_dob` = '" . $_POST['prop_dob'] . "',
  `proposer_nic` = '" . $_POST['prop_nic'] . "',
  `proposer_ms` = '" . $_POST['prop_ms'] . "',
  `proposer_spouse` = '" . $_POST['prop_spouse_name'] . "',
  `proposer_position` = '" . $_POST['prop_postion'] . "',
  `proposer_salary` = '" . $_POST['prop_salary'] . "',
  `proposer_employer` = '" . $_POST['prop_emp_name'] . "',
  `proposer_emp_address` = '" . $_POST['prop_emp_address'] . "' 
WHERE `cus_nic` = '" . $_POST['search_cus_nic'] . "'    
";

//            update Gerenter 1

            $quary_update_gernter1 = "UPDATE 
 `guarantor` 
SET

 
  `ger_address` = '" . $_POST['g1_address'] . "',
  `ger_tp` = '" . $_POST['g1_tp'] . "',
  `ger_nic` = '" . $_POST['g1_nic'] . "',
  `ger_dob` = '" . $_POST['g1_dob'] . "',
  `ger_ms` = '" . $_POST['g1_ms'] . "',
  `ger_wife_name` = '" . $_POST['g1_spouse'] . "',
  `ger_position` = '" . $_POST['g1_position'] . "',
  `ger_salerry` = '" . $_POST['g1_salary'] . "',
  `ger_emp_name` = '" . $_POST['g1_emp_name'] . "',
  `ger_emp_address` = '" . $_POST['g1_emp_address'] . "'


WHERE `ger_id` = '" . $_POST['g1_id'] . "' 


";
//            update Gerenter 2

            $quary_update_gernter2 = "UPDATE 
  `guarantor` 
SET

 
  `ger_address` = '" . $_POST['g2_address'] . "',
  `ger_tp` = '" . $_POST['g2_tp'] . "',
  `ger_nic` = '" . $_POST['g2_nic'] . "',
  `ger_dob` = '" . $_POST['g2_dob'] . "',
  `ger_ms` = '" . $_POST['g2_ms'] . "',
  `ger_wife_name` = '" . $_POST['g2_spouse'] . "',
  `ger_position` = '" . $_POST['g2_position'] . "',
  `ger_salerry` = '" . $_POST['g2_salary'] . "',
  `ger_emp_name` = '" . $_POST['g2_emp_name'] . "',
  `ger_emp_address` = '" . $_POST['g2_emp_address'] . "'


WHERE `ger_id` = '" . $_POST['g2_id'] . "' 


";

//            Update property House

            $quary_update_house = "UPDATE 
 `cus_real_property` 
SET

  `place` = '" . $_POST['real_prp_house_position'] . "',
  `size` = '" . $_POST['real_prp_house_size'] . "',
  `val` = '" . $_POST['real_prp_house_value'] . "',
  `is_pawned` = '" . $_POST['real_prp_house_pawned'] . "',
  `pawn_getter` = '" . $_POST['real_prp_house_pawn_getter'] . "'
WHERE `category`='1' AND `cus_nic`='" . $_POST['search_cus_nic'] . "'

";

//            Update property Other

            $quary_update_other = "UPDATE 
  `cus_real_property` 
SET

  `place` = '" . $_POST['real_prp_other_position'] . "',
  `size` = '" . $_POST['real_prp_other_size'] . "',
  `val` = '" . $_POST['real_prp_other_value'] . "',
  `is_pawned` = '" . $_POST['real_prp_other_pawned'] . "',
  `pawn_getter` = '" . $_POST['real_prp_other_pawn_getter'] . "'
WHERE `category`='2' AND `cus_nic`='" . $_POST['search_cus_nic'] . "'

";

//            Update Savings Bank

            $quary_update_savings_bank = "UPDATE 
  `cus_bnk_acc` 
SET

  `cus_bnk_name_and_branch` = '" . $_POST['cus_savings_bank_branch'] . "',
  `cus_facilities` = '" . $_POST['cus_savings_facilities'] . "',
  `cus_bnk_account_no` = '" . $_POST['cus_savings_account_no'] . "'
 
WHERE `idbank_acc_cat` = '1' AND `cus_nic` = '" . $_POST['search_cus_nic'] . "'
";

//            Update Mobile Bank

            $quary_update_mobile_bank = "UPDATE 
  `cus_bnk_acc` 
SET

  `cus_bnk_name_and_branch` = '" . $_POST['cus_mobile_bank_branch'] . "',
  `cus_facilities` = '" . $_POST['cus_mobile_facilities'] . "',
  `cus_bnk_account_no` = '" . $_POST['cus_mobile_account_no'] . "'
 
WHERE `idbank_acc_cat` = '2' AND `cus_nic` = '" . $_POST['search_cus_nic'] . "'
";

//            Update Daily Loan Bank

            $quary_update_daily_loan_bank = "UPDATE 
  `cus_bnk_acc` 
SET

  `cus_bnk_name_and_branch` = '" . $_POST['cus_daily_loan_bank_branch'] . "',
  `cus_facilities` = '" . $_POST['cus_daily_loan_facilities'] . "',
  `cus_bnk_account_no` = '" . $_POST['cus_daily_loan_account_no'] . "'
 
WHERE `idbank_acc_cat` = '3' AND `cus_nic` = '" . $_POST['search_cus_nic'] . "'
";

//            Update Quary Execution
            $result_update_customer = mysqli_query($conn, $quary_update_customer);
            $result_update_gernter1 = mysqli_query($conn, $quary_update_gernter1);
            $result_update_gernter2 = mysqli_query($conn, $quary_update_gernter2);
            $result_update_house = mysqli_query($conn, $quary_update_house);
            $result_update_other = mysqli_query($conn, $quary_update_other);
            $result_update_savings_bank = mysqli_query($conn, $quary_update_savings_bank);
            $result_update_mobile_bank = mysqli_query($conn, $quary_update_mobile_bank);
            $result_update_daily_loan_bank = mysqli_query($conn, $quary_update_daily_loan_bank);


            if ($result_update_customer and $result_update_gernter1 and $result_update_gernter2 and $result_update_house and $result_update_other and $result_update_savings_bank and $result_update_mobile_bank and $result_update_daily_loan_bank) {

                echo '<script>alert("Successfully Updated")</script>';
            } else {
                echo '<script>alert("Updated Failed")</script>';
                // echo '<script>alert("'.  mysqli_error().'")</script>';

                die(mysql_error());
            }
            $na = $_POST['cus_fullname'];
            echo '<script>alert("' . $na . '")</script>';
        }
        ?>
        <!--update customers end-->


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
    </body>
</html>
