<!DOCTYPE html>
<?php
session_start();
//if (!isset($_SESSION['user_email'])) {
//    header("Location:../index.php");
//} else {
//    if (isset($_SESSION['cus_nic'])) {
//        $cus_nic = $_SESSION['cus_nic'];
//        $cus_name = $_SESSION['cus_name'];
//    } else {
//        $cus_nic = "";
//        $cus_name = "";
//    }
//}
?>
<html>
    <!--Variable Declaration-->
    <?php
    $deed_no = "";
    $reg_date = "";
    $cbo_period = "";
    $pawn_rate = "";
    $fixed_rate = "";
    date_default_timezone_set('Asia/Colombo');
    $reg_date = date("Y-m-d");
    ?>
    <!--Variable Declaration-->
    <head>
        <meta charset="UTF-8">
        <title>Land | Pawning</title>
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
        <link rel="icon" href="favicon.ico">

        <script type="text/javascript">
            function check() {
                var aid = document.getElementById('cbo_pawn_amount').value;
                var yid = document.getElementById('cbo_pawn_period').value;
                alert(aid + "###" + yid);
                if (aid != 0 && yid != 0) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                    else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                            if (xmlhttp.responseText == "No Interest Found") {
                                alert(xmlhttp.responseText);
                            }
                            else {
                                document.getElementById('pawn_rate').value = xmlhttp.responseText;
                            }
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_pawn_rate.php?aid=" + aid + "&yid=" + yid, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function setCusDependancy() {
                if (document.getElementById('c_m_status').value == "Single") {
                    //alert("Single");
                    document.getElementById('cus_dependdency').value = "0";
                    document.getElementById('cus_dependdency').readOnly = true;
                }
                else if (document.getElementById('c_m_status').value == "Married") {
                    // alert("Married");
                    document.getElementById('cus_dependdency').value = "0";
                    document.getElementById('cus_dependdency').readOnly = false;
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
        </script>
    </head>
    <body>
        <?php include '../assets/include/navigation_bar.php'; ?>

        <!--Lease Registration Panel-->
        <div class="container" style="margin-top: 80px;display: block;" id="one">
            <form action="../controller/co_customer_pawn.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Land Pawning Registration</h3>
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
                                        <div class="form-group  ">
                                            <label class="control-label" >Permanent Address :</label>
                                            <input type="text" id="cus_paddress" maxlength="255"  name="cus_address" placeholder="Permanent Address" class="form-control" maxlength="150"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Telephone:</label>
                                            <input type="number" id="cus_tp" name="cus_tp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" min="0" placeholder="077XXXXXXX" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <span style="color:red;">*</span>  <label class="control-label" >NIC Number:</label>
                                            <input type="text" id="cus_nic" name="cus_nic" maxlength="10" placeholder="XXXXXXXXXV"  class="form-control" style="text-transform: uppercase;" required/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Date of Birth (dd/mm/yyyy):</label>
                                            <input type="date" id="cus_dob" min="1900-12-31" max="<?php echo $reg_date; ?>" name="cus_dob" value="<?php echo $reg_date; ?>" placeholder="Date of Birth" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Employment/Position:</label>
                                            <input type="text" id="cus_position" maxlength="100" name="cus_position" placeholder="Employment/Position"  class="form-control" maxlength="80"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Monthly Salary/Net Income:</label>
                                            <input type="number" id="cus_salary" name="cus_salary" placeholder="XXXXXXXX"  class="form-control" min="0"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label" >Employer Name:</label>
                                            <input type="text" name="cus_emp_name" maxlength="100" placeholder="Employer Name"   class="form-control" maxlength="200"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="cus_emp_name" maxlength="100"  name="cus_emp_address" placeholder="No,Street,City"   class="form-control" maxlength="250"/>
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
                                        <legend>Proposer Personal Details</legend>
                                        <div class="form-group">
                                            <label class="control-label">Full Name:</label>
                                            <input type="text" id="prop_name" maxlength="100" name="prop_name" id="fname" placeholder="Full Name" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Permanent Address :</label>
                                            <input type="text" id="prop_address" maxlength="255" name="prop_address" placeholder="Permanent Address" class="form-control" />
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
                                            <input type="text" id="prop_spouse_name" readonly maxlength="100" name="prop_spouse_name" id="fname" placeholder="Spouse Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employment/Position:</label>
                                            <input type="text" id="prop_postion" name="prop_postion" placeholder="Employment/Position" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Monthly Salary/Net Income:</label>
                                            <input type="number" id="prop_salary" min="0" name="prop_salary" placeholder="XXXXXXXX" class="form-control" />
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Name:</label>
                                            <input type="text" id="prop_emp_name" maxlength="100" name="prop_emp_name" placeholder="Employer Name" class="form-control"/>
                                        </div>
                                        <div class="form-group  ">
                                            <label class="control-label">Employer Address:</label>
                                            <input type="text" id="prop_emp_address" maxlength="255" name="prop_emp_address" placeholder="No,Street,City" class="form-control"/>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Land Pawning Details</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Deed Number:</label>
                                            <input type="text" name="deed_no" id="deed_no" placeholder="Deed Number" class="form-control" required/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Registration Date:</label>
                                            <input type="date" name="deed_reg_date" id="deed_reg_date" value="<?php echo $reg_date; ?>" placeholder="Registration Date" class="form-control" required/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Select Amount:</label>
                                            <select name="cbo_pawn_amount" id="cbo_pawn_amount" class="form-control">
                                                <option value="0">~~Select Amount~~</option>
                                                <option value="1">100000.00</option>
                                                <option value="2">200000.00</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Select Period:</label>
                                            <select name="cbo_pawn_period" id="cbo_pawn_period" class="form-control" onchange="check();">
                                                <option value="0"> --- Select Period--- </option>
                                                <option value="1">1 Year</option>
                                                <option value="2">2 Year</option>
                                                <option value="3">3 Year</option>
                                                <option value="4">4 Year</option>
                                                <option value="5">5 Year</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Pawn Rental:</label>
                                            <input type="text" readonly name="pawn_rate" id="pawn_rate" placeholder="Pawn Rate" class="form-control" required=/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Area:</label>
                                            <input type="text" name="area" id="area" placeholder="Land Area" class="form-control"/>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-inline required">
                                                <label class="control-label">Land Position:</label>
                                                <input type="text" class="form-control" name="loan_description" id="loan_description" placeholder="Description of the Loan" style="width: 85%;">
                                                <input type="button" class="btn btn" id="custcontinue" value="Search" onclick="setPositiontoMap();">
                                            </div>
                                        </div>
                                        <div id="map_location" style="width: 100%" height="400">

                                        </div>


                                        <input type="submit" class="btn btn" id="custcontinue" name="pawn_reg" value="Register Pawn">
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
                                                    function setPositiontoMap() {
                                                        var maplocation = document.getElementById('loan_description').value;
                                                        var val = '<iframe style="width: 100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAZug4gv6zHg69WJ_5sInSlEYeTdGDrf_E &q=' + maplocation + ',sri lanka" allowfullscreen></iframe>';

                                                        document.getElementById('map_location').innerHTML = "";
                                                        document.getElementById('map_location').innerHTML = val;
                                                    }
    </script>
</html>
