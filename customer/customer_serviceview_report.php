<!DOCTYPE html>
<html>
    <?php
    date_default_timezone_set('Asia/Colombo');
    $current_date = date("Y-m-d");
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Services View</title>
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


        <?php if (isset($_GET['bootstrap']) && $_GET['bootstrap'] == 1): ?>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <?php else: ?>
            <link rel="stylesheet" type="text/css" href="../assets/css/zebra_pagination.css">
        <?php endif ?>

        <link rel="stylesheet" type="text/css" href="../assets/css/customer_service.css">
        <link rel="icon" href="favicon.ico">
    </head>
    <body>
        <?php
        include '../assets/include/navigation_bar.php';

        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_datahost");
        if (mysqli_connect_errno()) {
            echo "Falied to Connect the Database" . mysqli_connect_error();
        }
        ?>

        <!--Service View Main Panel-->
        <div class="container" style="margin-top: 80px;display: block;" id="one">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">Customer Service Information</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                           
                            
                            <!--Service View Main Panel-->

                            <!--Customer Service Loader-->
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <!--pagination for view service-->
                                        <?php
                                        global $conn;
                                        $records_per_page = 10;
                                        require 'Zebra_Pagination.php';
                                        $pagination = new Zebra_Pagination();

                                        if (isset($_POST['search'])) {

                                            if ($com_cus == "sno") {
                                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` WHERE `ser_number`='" . $_POST['customer_search_bar'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                            }

                                            if ($com_cus == "nic") {
                                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` WHERE `cus_nic`='" . $_POST['customer_search_bar'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                            }

                                            if ($com_cus == "phone") {
                                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS s.`ser_number`,s.`ser_date`,s.`description`,s.`fix_rate`,s.`period`,s.`installment`,s.`ser_status` FROM `service` s LEFT JOIN `customer` c ON s.`cus_nic`=c.`cus_nic` WHERE c.`cus_tp`='" . $_POST['customer_search_bar'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                            }
                                        } else if (isset($_POST['searchByVehicle'])) {

                                            if ($com_ser == "bike") {
                                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` WHERE `ser_category`=1  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                            }
                                            if ($com_ser == "twheel") {
                                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` WHERE `ser_category`=2  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                            }
                                        } elseif (isset($_POST['searchByDate'])) {

                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` WHERE `ser_date`='" . $_POST['install_date'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        } elseif (isset($_POST['search_view_all'])) {

                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        } else {
                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`ser_date`,`description`,`fix_rate`,`period`,`installment`,`ser_status` FROM `service` ";
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
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Service No</th>
                                                        <th>Reg Date</th>
                                                        <th>Service</th>
                                                        <th>Service Rental</th>
                                                        <th>Service Period</th>
                                                        <th>Installment</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bike_tbody">
                                                    <?php
                                                    $index = 0;
                                                    $status = "";
                                                    ?>
                                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                                                        <?php
                                                        if ($row['ser_status'] == "1") {
                                                            $status = "Active";
                                                        } else {
                                                            $status = "Deactive";
                                                        }
                                                        ?>

                                                        <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?> onclick="readValues(this);">

                                                            <td><input type="radio" name="check"/></td>
                                                            <td><?php echo $row['ser_number'] ?></td>
                                                            <td><?php echo $row['ser_date'] ?></td>
                                                            <td><?php echo $row['description'] ?></td>
                                                            <td><?php echo $row['fix_rate'] ?></td>
                                                            <td><?php echo $row['period'] ?></td>
                                                            <td><?php echo $row['installment'] ?></td>
                                                            <td><?php echo $status ?></td>

                                                        </tr>
                                                    <?php endwhile ?>
                                                </tbody>
                                            </table>
                                           
                                        </div>
                                        <div class="form-inline col-sm-12">
                                            <div class="form" style="float: right;">

                                                <button type="submit" class="btn btn" id="cservicebtn" onclick="window.print()">Print</button>
                                              
                                            </div>
                                        </div>
                                    </div>
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
    <script type="text/javascript">

        var cel;
        function readValues(x) {

            cel = x.cells[1].innerHTML;
            var cus_nic = cel;
            // alert(cus_nic);
<?php
$ser_no = 'documrnt.w';
echo cel;
?>
        }
    </script>
    <?php
    $ser_no = "<script>document.write(cel)</script>";
    echo '<script>alert(' . "This Is var " . $ser_no . ');</script>';
    ?>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</html>
