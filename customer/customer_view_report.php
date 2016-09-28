<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('Asia/Colombo');
$date_setter = date("Y-m-d");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Customer Information</title>
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
    </head>
    <body>
        <?php
        include '../assets/include/navigation_bar.php';

        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
        if (mysqli_connect_errno()) {
            echo "Falied to Connect the Database" . mysqli_connect_error();
        }
        ?>
        <!--Customer Panel Section-->
        <div class="container" style="margin-top: 80px;display: block;" id="one">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">Customer Information</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <legend>Search Option 01</legend>
                                    <div class="form-group required">
                                        <label class="control-label">Search By Date:</label>
                                        <div class="form-inline required">
                                            <input type="date"  name="report_date" id="report_date" class="form-control" style="width:85%;text-transform: uppercase;" maxlength="10" value="<?php echo date("Y-m-d");?>" required/>
                                            <input type="button" class="btn btn" id="custcontinue" value="Search" onclick="loadInstallmentCustomer();">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <!--pagination for Customer View-->
                            <?php
                            global $conn;
                            $sql_query = "";

                            $records_per_page = 10;
                            require 'Zebra_Pagination.php';
                            $pagination = new Zebra_Pagination();
                            if (isset($_POST['search_buton'])) {
                                if ($com_vehi == "sno") {

                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,c.`ser_number`,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp FROM customer a INNER JOIN `service` c ON a.`cus_nic`=c.`cus_nic` WHERE c.`ser_number`='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                } elseif ($com_vehi == "tp") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE a.`cus_tp`='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                } elseif ($com_vehi == "nic") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE a.`cus_nic`='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }
                            } elseif (isset($_POST['search_date'])) {

                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE a.`cus_reg_date` BETWEEN '" . $_POST['date1'] . "' AND '" . $_POST['date2'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            } elseif (isset($_POST['search_buton_view_All'])) {

                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic  ORDER BY a.cus_id LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            } else {
                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic  ORDER BY a.cus_id ";
                            }
                            $result = mysqli_query($conn, $sql_query);
                            $service_co = mysqli_num_rows($result);
                            if (!($result)) {

                                //stop execution and display error message
                                die(mysql_error());
                            }
                            $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
                            $pagination->records($rows['rows']);
                            $pagination->records_per_page($records_per_page);
                            ?>

                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>No</th>
                                            <th>Full Name</th>
                                            <th>NIC</th>
                                            <th>HOR</th>
                                            <th>Permanent Address</th>
                                            <th>Registration Date</th>
                                            <th>Phone Number</th>
                                            <th>Arrears</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $index = 0;
                                        $i = 1;
                                        ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?> onclick="readValues(this)">


                                                <td><?php echo $row['cus_id'] ?></td>
                                                <td><?php echo $row['cus_fullname'] ?></td>
                                                <td><?php echo $row['cus_nic'] ?></td>
                                                <td> <a href="#"><?php echo $row['ser_number'] ?></a></td>
                                                <td><?php echo $row['cus_address'] ?></td>
                                                <td><?php echo $row['cus_reg_date'] ?></td>
                                                <td><?php echo $row['cus_tp'] ?></td>
                                                <td></td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-inline">

                                            <button type="submit"  class="btn btn" id="cservicebtn" onclick="window.print()">Print</button>
                                            <script>

                                                var cel;
                                                function readValues(x) {
                                                    cel = x.cells[3].innerHTML;
                                                    var cus_id = cel.substring(cel.lastIndexOf("#") + 3, cel.lastIndexOf("<"));
                                                    alert(cus_id);
                                                    window.location.href = "customer_installment_set.php?ser_number=" + cus_id;
                                                }
                                            </script>                                           

                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="col-sm-12">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-body" style="height: 250px;">
                                
                                
                                
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </div>
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
