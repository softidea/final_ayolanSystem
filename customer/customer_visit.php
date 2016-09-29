<!DOCTYPE html>
<html>
    <?php
    session_start();
    if (!isset($_SESSION['user_email'])) {
        header("Location:../index.php");
    } else {
        ?>
        <head>
            <meta charset="UTF-8">
            <title>Customer Visiting Registration</title>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
            <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,700,600italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
            <link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
            <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
            <link rel="stylesheet" type="text/css" href="../assets/css/customer_registration.css">
            <link rel="icon" href="favicon.ico">

            <script type="text/javascript">
                function check_logged_user() {
                    var lgged_user = "admin";
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
                    {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            alert(xmlhttp.responseText);
    //                            if(xmlhttp.responseText=="usr"){
    //                                document.getElementById('update_visit_panel').style.visibility=hidden;
    //                            }

                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_check_logged_user.php?lgged_user=" + lgged_user, true);
                    xmlhttp.send();
                }
            </script>

            <script type="text/javascript">
                function loadCustomerServiceData() {
                    var service_no = document.getElementById('service_no').value;
                    if (service_no != null && service_no != "") {
                        if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        }
                        else
                        { // code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                var value = xmlhttp.responseText;
                                var result_arr = value.split("#");
                                document.getElementById('vehicle_no').value = result_arr[0];
                                document.getElementById('cus_nic').value = result_arr[1];
                                document.getElementById('cus_name').value = result_arr[2];
                            }
                        }
                        xmlhttp.open("GET", "../controller/co_load_visit_customer.php?service_no=" + service_no, true);
                        xmlhttp.send();
                    }
                }
            </script>
            <script>
                function save_customer_visit() {
                    var service_no = document.getElementById('service_no').value;
                    var cus_nic = document.getElementById('cus_nic').value;
                    var visit_cost = document.getElementById('visit_cost').value;
                    var visit_date = document.getElementById('visit_date').value;
                    var visit_des = document.getElementById('visit_des').value;

                    if (service_no != null && service_no != "" && cus_nic != null && cus_nic != "" && visit_cost != null && visit_cost != "" && visit_date != null && visit_date != "" && visit_des != null && visit_des != "") {
                        if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        }
                        else
                        { // code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                alert(xmlhttp.responseText);
                                document.getElementById('vehicle_no').value = "";
                                document.getElementById('cus_nic').value = "";
                                document.getElementById('cus_name').value = "";
                                document.getElementById('visit_cost').value = "";
                                document.getElementById('visit_date').value = "";
                                document.getElementById('visit_des').value = "";
                                window.location = "report_template_visiting.php";

                            }
                        }
                        xmlhttp.open("GET", "../controller/co_load_visit_customer.php?visit_service_no=" + service_no + "&visit_cus_nic=" + cus_nic + "&visit_cost=" + visit_cost + "&visit_date=" + visit_date + "&visit_des=" + visit_des, true);
                        xmlhttp.send();

                    } else {
                        alert("Invalid data found,Please enter valid data");
                    }
                }
            </script>
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

                function check() {

                    var id = document.getElementById('visit_id_serch').value;
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {

                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                            alert("awaaaaa");
                            alert(xhttp.responseText);
                            var result_arr = xhttp.responseText.split("#");
                            document.getElementById('visit_date_serch').value = result_arr[0];
                            document.getElementById('visit_cost_serch').value = result_arr[1];
                            if (result_arr[2] == "Active") {

                                document.getElementById('search_category_serch').selectedIndex = 0;

                            } else {

                                document.getElementById('search_category_serch').selectedIndex = 1;

                            }



                        }

                    };

                    xhttp.open("GET", "../controller/co_customer_visit.php?id=" + id, true);
                    xhttp.send();

                }

            </script>
        </head>
        <body>
            <?php
            include '../assets/include/navigation_bar.php';
            require_once '../db/newDB.php';
            ?>
            <div class="container" style="margin-top: 80px;display: block;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Customer Visit Information</h3>
                            </div>
                            <div class="panel-body" style="background-color: #FAFAFA;">
                                <!--bike rate registration-->
                                <div class="new_vehicle" style="display: block;">
                                    <div class="col-sm-6">
                                        <fieldset id="account">
                                            <legend>Customer Visit Registration</legend>
                                            <div class="form-group required">
                                                <label class="control-label">Service No:</label>
                                                <div class="form-inline required">
                                                    <input type="text"  name="service_no" id="service_no" class="form-control" placeholder="Service No" style="width:85%;text-transform: uppercase;" maxlength="10" required/>
                                                    <input type="button" class="btn btn" id="custcontinue" value="Search" onclick="loadCustomerServiceData();">
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">Vehicle No:</label>
                                                <input type="text" readonly name="vehicle_no" id="vehicle_no" placeholder="Vehicle No" class="form-control" />
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">Customer NIC:</label>
                                                <input type="text" readonly name="cus_nic" id="cus_nic" placeholder="Customer NIC" class="form-control" />
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">Customer Name:</label>
                                                <input type="text" readonly name="cus_name" id="cus_name" placeholder="Customer NIC" class="form-control" />
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">Visit Cost:</label>
                                                <input type="text" name="visit_cost" id="visit_cost" placeholder="00.00" class="form-control" />
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">Visit Date:</label>
                                                <input type="date" name="visit_date" id="visit_date" class="form-control" value="<?php echo date("Y-m-d"); ?>"/>
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">Visit Description:</label>
                                                <input type="text" name="visit_des" id="visit_des" placeholder="Visit Description" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn" id="cservicebtn" onclick="save_customer_visit();">Save Visit</button>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <!--bike rate registration-->
                                <div class="new_vehicle" style="display: block;">
                                    <div class="col-sm-6">

                                        <fieldset id="account">
                                            <legend>Visit Information</legend>
                                            <div class="form-group required">
                                                <form method="post" action="#">
                                                    <label class="control-label">Service No:</label>
                                                    <div class="form-inline required">
                                                        <input type="text"  name="service_no" id="service_no" class="form-control" style="width:85%;text-transform: uppercase;" maxlength="10" required/>
                                                        <button type="submit" name="search_buton" method="post" class="btn btn" id="custcontinue" value="Search">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="form-group required">
                                                <form method="post" action="#">
                                                    <label class="control-label">Visit Date:</label>
                                                    <div class="form-inline required">
                                                        <input type="date" name="visit_date" id="visit_date" class="form-control" style="width:85%;" value="<?php echo date("Y-m-d"); ?>"/>
                                                        <button type="submit" name="search_buton_date" class="btn btn" id="custcontinue" method="post" value="Search">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </fieldset>

                                    </div>
                                    <div class="col-sm-6">
                                        <?php
                                        $records_per_page = 4;
                                        require 'Zebra_Pagination.php';
                                        $pagination = new Zebra_Pagination();
                                        $sql_query = "";
                                        if (isset($_POST['search_buton'])) {

                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS  `visit_id`,`visit_date`,`ser_number`,`cus_nic`, `visit_cost`,`visit_des`,`visit_status` from`service_visit` where ser_number='" . $_POST['service_no'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        } elseif (isset($_POST['search_buton_date'])) {
                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS  `visit_id`,`visit_date`,`ser_number`,`cus_nic`, `visit_cost`,`visit_des`,`visit_status` from`service_visit` where visit_date='" . $_POST['visit_date'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        } else {
                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS  `visit_id`,`visit_date`,`ser_number`,`cus_nic`, `visit_cost`,`visit_des`,`visit_status` from`service_visit`  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        }
                                        $result = mysqli_query($conn, $sql_query);

                                        if (!($result)) {
                                            echo '<script>alert("awaaa")</script>';
                                            // stop execution and display error message
                                        }

                                        $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
                                        $pagination->records($rows['rows']);
                                        $pagination->records_per_page($records_per_page);
                                        ?>

                                        <table class="table table-bordered table-striped table-hover">
                                            <tr>
                                                <th>Visit Id</th>
                                                <th>Visit Date</th>
                                                <th>Service No</th>
                                                <th>Customer</th>
                                                <th>Cost</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                            </tr>
                                            <?php $index = 0; ?>
                                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?>>

                                                    <td><?php echo $row['visit_id'] ?></td>
                                                    <td><?php echo $row['visit_date'] ?></td>
                                                    <td><?php echo $row['ser_number'] ?></td>
                                                    <td><?php echo $row['cus_nic'] ?></td>
                                                    <td><?php echo $row['visit_cost'] ?></td>
                                                    <td><?php echo $row['visit_des'] ?></td>
                                                    <td><?php echo $row['visit_status'] ?></td>


                                                </tr>
                                            <?php endwhile ?>
                                        </table>
                                        <div class="text-center">
                                            <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="update_visit_panel">
                                        <fieldset id="account">
                                            <form method="post" action="#">
                                                <legend>Update Visit</legend>
                                                <div class="form-group required">
                                                    <label class="control-label">Visit Id:</label>
                                                    <div class="form-inline required">
                                                        <input type="text"  name="visit_id_serch" id="visit_id_serch" class="form-control" style="width:85%;text-transform: uppercase;" placeholder="Visit Id" maxlength="10" required onKeyPress="return numbersonly(this, event);"/>
                                                        <button type="button" class="btn btn" id="custcontinue" value="Search" onclick="check()">Search</button>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="control-label">Visit Date:</label>
                                                    <input type="date" name="visit_date_serch" id="visit_date_serch" class="form-control" value="<?php echo date("Y-m-d"); ?>"/>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="control-label">Visit Cost:</label>
                                                    <input type="text" name="visit_cost_serch" id="visit_cost_serch" placeholder="00.00"  class="form-control" />
                                                </div>
                                                <div class="form-group required">
                                                    <label class="control-label">Visit Status:</label>
                                                    <div class="form-inline required">

                                                        <select name="search_category_serch" id="search_category_serch" class="form-control" style="width:80%;">
                                                            <option value="Active">Active</option>
                                                            <option value="Deactive">Deactive</option>
                                                        </select>
                                                        <button type="submit" class="btn btn" name="Update_Visit" id="custcontinue" value="Update Visit">Update Visit</button>

                                                    </div>

                                                </div>
                                            </form>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include '../assets/include/footer.php';

            if (isset($_POST['Update_Visit'])) {



                $quary_update_visit = " UPDATE
                `service_visit`
                SET
               
                `visit_date` = '" . $_POST['visit_date_serch'] . "',
                `visit_cost` = '" . $_POST['visit_cost_serch'] . "',
                `visit_status` = '" . $_POST['search_category_serch'] . "'
                WHERE `visit_id` = '" . $_POST['visit_id_serch'] . "'";

                $result_update_visit = mysqli_query($conn, $quary_update_visit);

                if ($result_update_visit) {

                    echo '<script>alert("Successfully Updated");</script>';
                } else {
                    echo '<script>alert("Updated Failed")</script>';
                    // echo '<script>alert("'.  mysqli_error().'")</script>';

                    die(mysql_error());
                }
            }
            ?>

        </body>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <?php
}
?>
</html>
