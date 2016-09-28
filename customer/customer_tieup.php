<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Customer|Tie up</title>
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
            function searchCustomerbyNIC() {
                var cus_nic = document.getElementById('customer_nic').value;
                if (cus_nic !== "" && cus_nic !== null) {
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
                            document.getElementById('customer_tp').value = result_arr[0];
                            document.getElementById('customer_name').value = result_arr[1];
                            document.getElementById('customer_address').value = result_arr[2];
                            loadCustomerServiceNobyNIC(cus_nic);
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?cus_nic=" + cus_nic, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function searchCustomerbyTP() {
                var cus_tp = document.getElementById('customer_tp').value;
                alert(cus_tp);
                if (cus_tp !== "" && cus_tp !== null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            // alert(xmlhttp.responseText);
                            var value = xmlhttp.responseText;
                            var result_arr = value.split("#");
                            document.getElementById('customer_nic').value = result_arr[0];
                            document.getElementById('customer_name').value = result_arr[1];
                            document.getElementById('customer_address').value = result_arr[2];
                            loadCustomerServiceNobyTP(cus_tp);
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?cus_tp=" + cus_tp, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadCustomerServiceNobyNIC(nic) {
                if (nic !== "" && nic !== null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            // alert(xmlhttp.responseText);
                            var result = xmlhttp.responseText;
                            document.getElementById('cbo_service_search').innerHTML = "";
                            document.getElementById('cbo_service_search').innerHTML = result;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?c_s_nic=" + nic, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadCustomerServiceNobyTP(tp) {
                if (tp !== "" && tp !== null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            // alert(xmlhttp.responseText);
                            var result = xmlhttp.responseText;
                            document.getElementById('cbo_service_search').innerHTML = "";
                            document.getElementById('cbo_service_search').innerHTML = result;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?c_s_tp=" + tp, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadServiceDetailsCustomerSide(value) {
                if (value !== "" && value !== null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var val = xmlhttp.responseText;
                            //alert(val);
                            var result_arr = val.split("#");
                            document.getElementById('service_rental').value = result_arr[0];
                            document.getElementById('service_period').value = result_arr[1];
                            document.getElementById('cus_installment').value = result_arr[2];
                            loadGurantorNICs(value);
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?ser_value=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadServiceIntallmentDetailsCus(value) {
                if (value !== "" && value !== null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var val = xmlhttp.responseText;
                            //alert(val);
                            var result_arr = val.split("#");
                            document.getElementById('service_rental').value = result_arr[0];
                            document.getElementById('service_period').value = result_arr[1];
                            document.getElementById('cus_installment').value = result_arr[2];
                            loadGurantorNICs(value);
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?ser_value_cus_installment=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadServiceGurantors(value) {
                if (value !== "" && value !== null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var val = xmlhttp.responseText;
                            //alert(val);
                            var result_arr = val.split("#");
                            document.getElementById('service_rental').value = result_arr[0];
                            document.getElementById('service_period').value = result_arr[1];
                            document.getElementById('cus_installment').value = result_arr[2];
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?ser_value=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadGurantorNICs(value) {
                if (value != "" && value != null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var val = xmlhttp.responseText;
                            //alert(val);
                            document.getElementById('cbo_customer_nic').innerHTML = "";
                            document.getElementById('cbo_customer_nic').innerHTML = val;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?ser_no_g=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadGuratorDetails(value) {
                if (value != "" && value != null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var val = xmlhttp.responseText;
                            //alert(val);
                            var result_arr = val.split("#");
                            document.getElementById('guarantor_tp').value = result_arr[0];
                            document.getElementById('guarantor_name').value = result_arr[1];
                            document.getElementById('guarantor_address').value = result_arr[2];
                            loadServiceNoG_as_Cus(value);
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?gua_nic=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadServiceNoG_as_Cus(value) {
                if (value != "" && value != null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var val = xmlhttp.responseText;
                            if (val == "No Services Found") {
                                alert(val);
                                document.getElementById('cbo_service_as_customer').innerHTML="<option value='0'> --- Please Select --- </option>";
                                document.getElementById('service_rental_g').value = "";
                                document.getElementById('service_period_g').value = "";
                                document.getElementById('g_installment').value = "";
                                createNotTieupNote();
                            } else {
                                document.getElementById('cbo_service_as_customer').innerHTML = "";
                                document.getElementById('cbo_service_as_customer').innerHTML = val;
                            }
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_customer_tieup.php?g_as_c_nic=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>

    </head>
    <body>
        <?php include '../assets/include/navigation_bar.php'; ?>

        <!--Service View Main Panel-->
        <div class="container" style="margin-top: 80px;display: block;" id="one">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">Customer Tie-up Information</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <legend>Customer Information</legend>
                                    <div class="form-group required">
                                        <span style="color:red;">*</span><label class="control-label">Customer NIC:</label>
                                        <div class="form-inline required">
                                            <input type="text" name="customer_nic" id="customer_nic" placeholder="Enter Customer NIC" class="form-control" style="width: 85%;" required/>
                                            <button type="button" id="cservicebtn" class="btn btn" onclick="searchCustomerbyNIC();">Search</button>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <span style="color:red;">*</span><label class="control-label">Customer Telephone:</label>
                                        <div class="form-inline required">
                                            <input type="text" name="customer_tp" id="customer_tp" placeholder="Enter Customer Telephone" class="form-control" style="width: 85%;" required/>
                                            <button type="button" id="cservicebtn" class="btn btn" onclick="searchCustomerbyTP();">Search</button>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label">Customer Name:</label>
                                        <input type="text" readonly name="customer_name" id="customer_name"  placeholder="Customer Name" class="form-control" required/>
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label">Permanent Address:</label>
                                        <input type="text" readonly name="customer_address" id="customer_address" placeholder="Permanent Address" class="form-control" required/>
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label">Service No:</label>
                                        <select name="cbo_service_search" id="cbo_service_search" class="form-control" required onchange="loadServiceDetailsCustomerSide(this.value);">
                                            <option value=""> --- Please Select Service --- </option>
                                        </select>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Service Rental:</label>
                                            <input type="text" readonly name="service_rental" id="service_rental" placeholder="Service Rental" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Service Period:</label>
                                            <input type="text" readonly name="service_period" id="service_period" placeholder="Service Period" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Installment:</label>
                                            <input type="text" readonly name="cus_installment" id="cus_installment" placeholder="Installment" class="form-control" required/>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <div id="searchOptionPanel">
                                    <fieldset id="account">
                                        <legend>Guarantor Information</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Guarantor NIC's:</label>
                                            <select name="cbo_customer_nic" id="cbo_customer_nic" class="form-control" required onchange="loadGuratorDetails(this.value);">
                                                <option value=""> --- Please Select --- </option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <span style="color:red;">*</span><label class="control-label">Guarantor Telephone:</label>
                                            <input type="text" readonly name="guarantor_tp" id="guarantor_tp" placeholder="Customer Telephone" class="form-control" required/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Guarantor Name:</label>
                                            <input type="text" readonly name="guarantor_name" id="guarantor_name"  placeholder="Customer Name" class="form-control" required/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Permanent Address:</label>
                                            <input type="text" readonly name="guarantor_address" id="guarantor_address" placeholder="Permanent Address" class="form-control" required/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Services as a Customer:</label>
                                            <select name="cbo_service_as_customer" id="cbo_service_as_customer" class="form-control" onchange="check();">
                                                <option value="0"> --- Please Select --- </option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Service Rental:</label>
                                                <input type="text" readonly name="service_rental_g" id="service_rental_g" placeholder="Service Rental" id="input-email" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Service Period:</label>
                                                <input type="text" readonly name="service_period_g" id="service_period_g" placeholder="Service Period" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Installment:</label>
                                                <input type="text" readonly name="g_installment" id="g_installment" placeholder="Installment" class="form-control" required/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!--Service View Main Panel-->

                            <!--Customer Service Loader-->
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-body" style="height: 100px;">
                                        <h4 id="tieup_note"></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form">

                                    <button type="submit" class="btn btn" id="cservicebtn">Print</button>
                                    <button type="submit" class="btn btn" id="cservicebtn"><a href="customer_installment.php" style="text-decoration: none;color: white;">Add Installment</a></button>
                                    <button type="submit" class="btn btn" id="cservicebtn"><a href="customer_installment.php" style="text-decoration: none;color: white;">View Installments</a></button>
                                    <button type="submit" class="btn btn" id="cservicebtn"><a href="customer_addlease.php" style="text-decoration: none;color: white;">Add New Lease</a></button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Customer Service Loader-->

        <?php include '../assets/include/footer.php'; ?>
    </body>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script type="text/javascript">
                                                function check() {
                                                    var value = document.getElementById('cbo_service_as_customer').value;

                                                    if (value != "" && value != null) {
                                                        if (window.XMLHttpRequest) {
                                                            // code for IE7+, Firefox, Chrome, Opera, Safari
                                                            xmlhttp = new XMLHttpRequest();
                                                        } else { // code for IE6, IE5
                                                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                                        }
                                                        xmlhttp.onreadystatechange = function () {
                                                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                                var val = xmlhttp.responseText;
                                                                if (val == "No Gurantor Services Found") {
                                                                    alert(val);
                                                                    document.getElementById('cbo_service_as_customer').innerHTML="<option value='0'> --- Please Select --- </option>";
                                                                    document.getElementById('service_rental_g').value = "";
                                                                    document.getElementById('service_period_g').value = "";
                                                                    document.getElementById('g_installment').value= "";
                                                                    createNotTieupNote();
                                                                } else {
                                                                    var val = xmlhttp.responseText;
                                                                    //alert(val);
                                                                    var result_arr = val.split("#");
                                                                    document.getElementById('service_rental_g').value = result_arr[0];
                                                                    document.getElementById('service_period_g').value = result_arr[1];
                                                                    document.getElementById('g_installment').value = result_arr[2];
                                                                    createTieupNote();
                                                                }
                                                            }
                                                        }
                                                        xmlhttp.open("GET", "../controller/co_customer_tieup.php?g_sno_search=" + value, true);
                                                        xmlhttp.send();
                                                    }

                                                }


    </script>
    <script type="text/javascript">
        function createTieupNote() {
            var customer_name = document.getElementById('customer_name').value;
            var cus_service = document.getElementById('cbo_service_search').value;
            var gurantor_name = document.getElementById('guarantor_name').value;
            var gua_service = document.getElementById('cbo_service_as_customer').value;

            var note = gurantor_name + " of " + gua_service + " tie-up with " + customer_name + " of " + cus_service;
            document.getElementById('tieup_note').innerHTML = note;
            document.getElementById('tieup_note').style.color = "#e53935";
        }
    </script>
    <script type="text/javascript">
        function createNotTieupNote() {
            var customer_name = document.getElementById('customer_name').value;
            var cus_service = document.getElementById('cbo_service_search').value;
            var gurantor_name = document.getElementById('guarantor_name').value;

            var note = gurantor_name + " not tie-up with " + customer_name + " of " + cus_service;
            document.getElementById('tieup_note').innerHTML = note;
            document.getElementById('tieup_note').style.color = "#43A047";
        }
    </script>
</html>
