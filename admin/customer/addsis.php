<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['user_email']) && ($_SESSION['user_status'] === "Active") && ($_SESSION['user_typel'] === "Admin")) {
    //Asia/Colombo
    date_default_timezone_set('Asia/Colombo');
    $sis_date = date("Y-m-d");
} else {
    header("Location:../index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Re-processes</title>
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
<?php include '../../assets/include/navigation_bar_forAdmin.php'; ?>

        <style type="text/css">
            body
            {
                font-family: 'Source Sans Pro', sans-serif;
            }
            .modal-backdrop {
                z-index: -1;
            }
            ul {
                list-style-type: square;
                list-style-position: outside;
                list-style-image: none;
            }
            #cviewbuttons
            {
                background-color: #004D40;
                color: white;

            }
            #cviewbuttons:hover
            {
                background-color: #009688;
            }
            #panelheading
            {
                background: #009688;
                color: white;          
            }
            #cservicebtn
            {
                background-color: #009688;
                color: white;
                margin-top: 12px;
            }
            #cservicebtn:hover
            {
                background-color: #004D40;
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
                background-color: #004D40;
                color: white;
                float: right;
                margin-right: 12px;
            }
            #backregister:hover
            {
                background-color: #009688;
            }
        </style>
        <script type="text/javascript">
            function searchServiceDetails() {
                var ser_number = document.getElementById('ser_no').value;
                if (ser_number != "" && ser_number != null) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                            alert(xmlhttp.responseText);
                            var result_arr = xmlhttp.responseText.split("#");
                            document.getElementById('cus_nic').value = result_arr[0];
                            document.getElementById('cus_name').value = result_arr[1];
                            document.getElementById('cus_address').value = result_arr[2];
                            document.getElementById('reg_date').value = result_arr[3];
                            document.getElementById('vehicle_no').value = result_arr[4];
                            document.getElementById('ser_date').value = result_arr[5];
                            document.getElementById('no_of_installments').value = result_arr[6];
                            document.getElementById('installment').value = result_arr[7] + ".00";
                            document.getElementById('rental_cost').value = result_arr[8];
                            document.getElementById('hidden_ser_number').value = ser_number;
                            loadServiceDetails(ser_number);

                        }
                    }
                    xmlhttp.open("GET", "../../controller/re_process_registration.php?ser_number=" + ser_number, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function loadServiceDetails(serviceno) {
                alert(serviceno);
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {

                        alert(xmlhttp.responseText);
                        var res_value = xmlhttp.responseText;
                        var res_arr = res_value.split("#");

                        if (res_arr.length > 1) {

//                            document.getElementById('total_payable_payment').value = res_arr[4];
//
                            document.getElementById('due_payment').value = res_arr[5] + ".00";
//                            document.getElementById('maximumpayment').value = res_arr[5];
                            document.getElementById('due_installments').value = res_arr[6];
                            document.getElementById('paid_payment').value = res_arr[9] + ".00";
                            document.getElementById('paid_installment').value = document.getElementById('no_of_installments').value - document.getElementById('due_installments').value;
                            document.getElementById('rent_cost_with_interest').value = document.getElementById('no_of_installments').value * document.getElementById('installment').value + ".00";
                        }
                    }
                }
                xmlhttp.open("GET", "../../controller/co_load_installment_customer.php?sno_begin_ins=" + serviceno, true);
                xmlhttp.send();

            }
        </script>
        <script type="text/javascript">
            function saveSis() {
                var ser_number = document.getElementById('ser_no').value;
                var sis_cost = document.getElementById('sis_cost').value;
                var sis_date = document.getElementById('sis_date').value;
                var sis_des = document.getElementById('re_process_des').value;
                if (ser_number != "" && ser_number != null) {
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
                    xmlhttp.open("GET", "../../controller/re_process_registration.php?ser_no_sis=" + ser_number + "&sis_cost=" + sis_cost + "&sis_date=" + sis_date + "&sis_des=" + sis_des, true);
                    xmlhttp.send();
                }
            }
        </script>
    </head>
    <body>
<?php include '../../assets/include/navigation_bar_forAdmin_step2.php'; ?>

        <!--Service View Main Panel-->
        <form method="post" action="#">
            <div class="container" style="margin-top: 80px;display: block;" id="one">
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Add New Re-Process</h3>
                            </div>
                            <div class="panel-body" style="background-color: #FAFAFA;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Customer Information</legend>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">NIC:</label>
                                                <input type="text" disabled name="cus_nic" id="cus_nic" placeholder="NIC" class="form-control" value="<?php echo ''; ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Customer Name:</label>
                                                <input type="text" disabled name="cus_name" id="cus_name" placeholder="Customer Name" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Address :</label>
                                                <input type="text" disabled name="cus_address" id="cus_address" placeholder="Address" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Registered Date :</label>
                                                <input type="text" disabled name="reg_date" id="reg_date" placeholder="Address" class="form-control" required/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6">
                                    <div id="searchOptionPanel">
                                        <fieldset id="account">
                                            <form method="post" action="#">
                                                <legend>Service Information</legend>
                                                <div class="form-group required">
                                                    <label class="control-label">Service No:</label>
                                                    <div class="form-inline required">
                                                        <div class="form-inline required">
                                                            <input type="text"  name="ser_no" id="ser_no" placeholder="Service No" class="form-control" style="width:85%;" maxlength="10" required/>
                                                            <input type="button" class="btn btn" id="custcontinue" value="Search" onclick="searchServiceDetails();">
                                                            <input type="hidden" id="hidden_ser_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Vehicle No:</label>
                                                        <input type="text" disabled name="vehicle_no" id="vehicle_no"  placeholder="Vehicle No" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Service Date:</label>
                                                        <input type="text" disabled name="ser_date" id="ser_date" value="" placeholder="Service Date" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Sis Date :</label>
                                                        <input type="date" name="sis_date" id="sis_date"  min="1900-12-31" max="<?php echo $sis_date; ?>" value="<?php echo $sis_date; ?>" placeholder="Ex:2016-07-25" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </form>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">No of Installments :</label>
                                            <input type="text" disabled name="no_of_installments" id="no_of_installments" placeholder="No of Installments" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Due Installments :</label>
                                            <input type="text" disabled name="due_installments" id="due_installments" placeholder="Due Installments" class="form-control" required/>

                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Due Payment :</label>
                                            <input type="text" disabled name="due_payment" id="due_payment" placeholder="Due Payment" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Installment :</label>
                                            <input type="text" disabled name="installment" id="installment" placeholder="Installment" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Paid Installment :</label>
                                            <input type="text" disabled name="paid_installment" id="paid_installment" placeholder="Paid Installment" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Paid Payment :</label>
                                            <input type="text" disabled name="paid_payment" id="paid_payment" placeholder="Paid Payment" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Value of Lease :</label>
                                            <input type="text" disabled name="rental_cost" id="rental_cost" placeholder="Rental Cost" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Lease with Interest :</label>
                                            <input type="text" disabled name="rent_cost_with_interest" id="rent_cost_with_interest" placeholder="Total Customer Due" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="form-group required">
                                            <label class="control-label">Sis Cost :</label>
                                            <input type="text" name="sis_cost" id="sis_cost" placeholder="Sis Cost" class="form-control" required onKeyPress="return numbersonly(this, event);"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>Re-Process Description:</legend>
                                        <textarea  style="height: 100px;width: 100%;" maxlength="250" name="re_process_des" id="re_process_des" placeholder="Enter Re-Process Description" required maxlength="500"></textarea>

                                        <button type="submit"  class="btn btn" id="cservicebtn" onclick="saveSis();">Save Re-Process</button>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <!--Customer Service Loader-->


<?php include '../../assets/include/footer.php'; ?>
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
</html>
