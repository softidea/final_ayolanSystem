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

        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
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
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <legend>Search Option-01</legend>
                                    <div class="form-group required">
                                       
                                        <form method="post" > 

                                            <div class="form-group required">
                                                <label class="control-label">Search Here:</label>
                                                <div class="form-inline required">
                                                    <input type="text" name="customer_search_bar" id="customer_searchbar" placeholder="Search Here" class="form-control" style="width: 86%;" required/>
                                                    <button type="submit" name="search" id="cservicebtn" class="btn btn">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST">
                                            <button type="submit" name="search_view_all" id="cservicebtn" class="btn btn">View All</button>
                                        </form>
                                        <?php
                                        if (isset($_POST['cbo_customer_search'])) {

                                            $com_cus = $_POST['cbo_customer_search'];
                                        }
                                        ?>
                                    </div>

                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <div id="searchOptionPanel">
                                    <fieldset id="account">
                                        <legend>Search Option-02</legend>
                                        <form method="post">
                                            <div class="form-group required">
                                                <div class="form-group required">
                                                    <label class="control-label">Registration Date:</label>
                                                    <div class="form-inline required">
                                                        <input type="date" name="install_date" id="service_searchbar" value="<?php echo $current_date;?>" class="form-control" style="width: 86%;" required/>
                                                        <button type="submit" name="searchByDate" id="cservicebtn" class="btn btn">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
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

                                             $sql_query = "SELECT SQL_CALC_FOUND_ROWS `pawn_id`,`deed_no`,`cus_nic`,`deed_reg_date`,`description`,`pawn_rental`,`period`,`area`,`pawn_status` FROM`land_pawns` WHERE `deed_no`='" . $_POST['customer_search_bar'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                            
                                        } elseif (isset($_POST['searchByDate'])) {

                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS `pawn_id`,`deed_no`,`cus_nic`,`deed_reg_date`,`description`,`pawn_rental`,`period`,`area`,`pawn_status` FROM`land_pawns` WHERE `deed_reg_date`='" . $_POST['install_date'] . "'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        } elseif (isset($_POST['search_view_all'])) {

                                           $sql_query = "SELECT SQL_CALC_FOUND_ROWS `pawn_id`,`deed_no`,`cus_nic`,`deed_reg_date`,`description`,`pawn_rental`,`period`,`area`,`pawn_status` FROM`land_pawns` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                        } else {
                                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS `pawn_id`,`deed_no`,`cus_nic`,`deed_reg_date`,`description`,`pawn_rental`,`period`,`area`,`pawn_status` FROM`land_pawns` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
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
                                                        <th>No</th>
                                                        <th>Deed No</th>
                                                        <th>Customer NIC</th>
                                                        <th>Reg Date</th>
                                                        <th>Description</th>
                                                        <th>Service Rental</th>
                                                        <th>Service Period</th>
                                                        <th>Area</th>
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
                                                        if ($row['pawn_status'] == "1") {
                                                            $status = "Active";
                                                        } else {
                                                            $status = "Deactive";
                                                        }
                                                        ?>

                                                        <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?> onclick="readValues(this);">

                                                            
                                                            <td><?php echo $row['pawn_id'] ?></td>
                                                            <td><?php echo $row['deed_no'] ?></td>
                                                            <td><?php echo $row['cus_nic'] ?></td>
                                                            <td><?php echo $row['deed_reg_date'] ?></td>
                                                            <td><?php echo $row['description'] ?></td>
                                                            <td><?php echo $row['pawn_rental'] ?></td>
                                                            <td><?php echo $row['period'] ?></td>
                                                            <td><?php echo $row['area'] ?></td>
                                                            <td><?php echo $status ?></td>

                                                        </tr>
                                                    <?php endwhile ?>
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                            </div>
                                        </div>
                                        <div class="form-inline col-sm-12">
                                            <div class="form" style="float: right;">

                                                <button type="submit" class="btn btn" id="cservicebtn"><a href="customer_serviceview_report.php" style="text-decoration: none;color: white;">Print</a></button>
                                                <button type="submit" class="btn btn" id="cservicebtn"><a href="customer_installment.php" style="text-decoration: none;color: white;">Add Installment</a></button>
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
    <script>
                                                            
                                                            var cel;
                                                            function readValues(x) {
                                                                
                                                                cel = x.cells[1].innerHTML;
                                                               
                                                                // alert(cus_id);
                                                                window.location.href = "land_pawn_payment_set.php?ser_number=" + cel;
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
