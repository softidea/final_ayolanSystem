<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Re-processes</title>
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
        <?php include '../../assets/include/navigation_bar_forAdmin_step2.php'; ?>
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
    </head>
    <body>

        <?php
        include '../../assets/include/navigation_bar_forAdmin_step2.php';
        require_once '../../db/newDB.php';
        ?>

        <!--Service View Main Panel-->
        <div class="container" style="margin-top: 80px;display: block;" id="one">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">Re-Process Information</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-4">
                                <form method="post" action="#">
                                    <fieldset id="account">
                                        <legend>Search Option-01</legend>
                                        <div class="form-group required">
                                            <label class="control-label" for="input-email">Select Service:</label>
                                            <select name="cbopayment" id="cboservice" class="form-control" required>
                                                <option value=""> --- All Services --- </option>
                                                <option value="land">Land</option>
                                                <option value="vehicls">Vehicle</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label" for="input-email">Service No:</label>
                                                <input type="text"  name="Ser_search" id="fname" value="" placeholder="Enter Service No Here" id="input-email" class="form-control" required/>
                                                <button type="submit"  class="btn btn" name="customer_Ser_search" id="cservicebtn">Search</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <div id="searchOptionPanel">
                                    <fieldset id="account">
                                        <form method="post"action="#">
                                            <legend>Search Option-02</legend>
                                            <div class="form-group required">
                                                <label class="control-label">Select Customer:</label>

                                                <select name="cbopayment" id="cboservice" class="form-control" required onchange="check();">
                                                    <option value=""> --- Please Select --- </option>
                                                    <option value="vno">Vehicle Number</option>
                                                    <option value="nic">NIC</option>
                                                    <option value="pno">Phone Number</option>
                                                </select>
                                            </div>
                                            <div class="form-group required">
                                                <div class="form-group required">
                                                    <label class="control-label">Search Customer:</label>
                                                    <input type="text" name="fname" id="fname" value="" placeholder="Enter Customer Search" id="input-email" class="form-control" required/>
                                                    <button type="submit" name="customer_id_search" class="btn btn" id="cservicebtn">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['cbopayment'])) {

                                            $com_cus = $_POST['cbopayment'];
                                        }
                                        ?>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="searchOptionPanel">
                                    <fieldset id="account">

                                        <form method="post" action="#">
                                            <legend>Search Option-03</legend>
                                            <div class="form-group required">
                                                <label class="control-label">From Date:</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control"/>
                                            </div>
                                            <div class="form-group required">
                                                <label class="control-label">To Date:</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control"/>
                                                <button type="submit"  class="btn btn" name="customer_date_search" id="cservicebtn">Search</button>
                                            </div>
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
                            <!--Service View Main Panel-->

                            <?php
                            $records_per_page = 10;
                            require '../../customer/Zebra_Pagination.php';
                            $pagination = new Zebra_Pagination();

                            if (isset($_POST['customer_id_search'])) {

                                if ($com_cus == "vno") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS  c.`sis_reg_id`,c.`sis_date`,a.`cus_fullname`,c.`ser_number`,c.`sis_des`,i.`customer_due`,c.`sis_cost` 
FROM `sis_registration` c INNER JOIN `service` s ON c.`ser_number`=s.`ser_number` INNER JOIN `customer` a ON s.`cus_nic`=a.`cus_nic` INNER JOIN `ser_installment` i ON s.`ser_number`=i.`ser_number` WHERE s.`vehicle_no`='" . $_POST['fname'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }

                                if ($com_cus == "nic") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS  c.`sis_reg_id`,c.`sis_date`,a.`cus_fullname`,c.`ser_number`,c.`sis_des`,i.`customer_due`,c.`sis_cost` 
FROM `sis_registration` c INNER JOIN `service` s ON c.`ser_number`=s.`ser_number` INNER JOIN `customer` a ON s.`cus_nic`=a.`cus_nic` INNER JOIN `ser_installment` i ON s.`ser_number`=i.`ser_number` WHERE a.`cus_nic`='" . $_POST['fname'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }

                                if ($com_cus == "pno") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS  c.`sis_reg_id`,c.`sis_date`,a.`cus_fullname`,c.`ser_number`,c.`sis_des`,i.`customer_due`,c.`sis_cost` 
FROM `sis_registration` c INNER JOIN `service` s ON c.`ser_number`=s.`ser_number` INNER JOIN `customer` a ON s.`cus_nic`=a.`cus_nic` INNER JOIN `ser_installment` i ON s.`ser_number`=i.`ser_number` WHERE a.`cus_tp`='" . $_POST['fname'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }
                            } else if (isset($_POST['customer_Ser_search'])) {

                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS c.`sis_reg_id`,c.`sis_date`,a.`cus_fullname`,c.`ser_number`,c.`sis_des`,i.`customer_due`,c.`sis_cost` 
FROM `sis_registration` c INNER JOIN `service` s ON c.`ser_number`=s.`ser_number` INNER JOIN `customer` a ON s.`cus_nic`=a.`cus_nic` INNER JOIN `ser_installment` i ON s.`ser_number`=i.`ser_number` WHERE s.`ser_number`='" . $_POST['Ser_search'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            } elseif (isset($_POST['customer_date_search'])) {

                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS c.`sis_reg_id`,c.`sis_date`,a.`cus_fullname`,c.`ser_number`,c.`sis_des`,i.`customer_due`,c.`sis_cost` 
FROM `sis_registration` c INNER JOIN `service` s ON c.`ser_number`=s.`ser_number` INNER JOIN `customer` a ON s.`cus_nic`=a.`cus_nic` INNER JOIN `ser_installment` i ON s.`ser_number`=i.`ser_number` WHERE c.`sis_date` BETWEEN '" . $_POST['start_date'] . "' AND '" . $_POST['end_date'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            } else {
                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS c.`sis_reg_id`,c.`sis_date`,a.`cus_fullname`,c.`ser_number`,c.`sis_des`,i.`customer_due`,c.`sis_cost` 
                                               FROM `sis_registration` c INNER JOIN `service` s ON c.`ser_number`=s.`ser_number` INNER JOIN `customer` a ON s.`cus_nic`=a.`cus_nic` INNER JOIN `ser_installment` i ON s.`ser_number`=i.`ser_number` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            }

                            $result = mysqli_query($conn, $sql_query);
                            if (!($result)) {

                                // stop execution and display error message
                                die(mysql_error());
                            }
                            $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
                            $pagination->records($rows['rows']);
                            $pagination->records_per_page($records_per_page);
                            ?>

                            <!--Customer Service Loader-->
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <fieldset>
                                            <legend>Re-Process Results</legend>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sis No</th>
                                                        <th>Sis Date</th>
                                                        <th>Customer Name</th>
                                                        <th>Service No</th>
                                                        <th>Description</th>
                                                        <th>Due Amount</th>
                                                        <th>Sis Cost</th>
                                                        <th>Total Payable</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="bike_tbody">
<?php
$index = 0;
$status = "";
?>
                                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>



                                                        <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?> onclick="readValues(this);">

                                                            <td><input type="radio" name="check"/></td>
                                                            <td><?php echo $row['sis_reg_id'] ?></td>
                                                            <td><?php echo $row['sis_date'] ?></td>
                                                            <td><?php echo $row['cus_fullname'] ?></td>
                                                            <td><?php echo $row['ser_number'] ?></td>
                                                            <td><?php echo $row['sis_des'] ?></td>
                                                            <td><?php echo $row['customer_due'] ?></td>
                                                            <td><?php echo $row['sis_cost'] ?></td>
                                                            <td><?php echo $row['customer_due'] + $row['sis_cost'] ?></td>


                                                        </tr>
<?php endwhile ?>
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                            </div>

                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <!--single sis view components panel-->

                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <fieldset>
                                            <legend>Re-Process Release</legend>
                                            <div class="col-sm-4">
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Due Installments:</label>
                                                        <input type="text" disabled placeholder="Due Installments" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Due Installments Cost:</label>
                                                        <input type="text" disabled placeholder="Due Installments Cost" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Payable Installment:</label>
                                                        <select name="cbopayment" id="cboservice" class="form-control" required onchange="check();">
                                                            <option value=""> --- Please Select --- </option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Payable Installment:</label>
                                                        <input type="text" disabled placeholder="Payable Installment" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Sis Cost:</label>
                                                        <input type="text" disabled placeholder="Sis Cost" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="form-group required">
                                                        <label class="control-label">Total Payable Cost:</label>
                                                        <input type="text" placeholder="Total Payable Cost" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit"  class="btn btn" id="cservicebtn">Release Service</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Customer Service Loader-->

<?php include '../../assets/include/footer.php'; ?>
    </body>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</html>
