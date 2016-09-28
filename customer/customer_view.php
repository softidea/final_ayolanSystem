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
        require_once '../db/mysqliConnect.php';
        
//        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
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
                                        <label class="control-label">Search by:</label>
                                        <form method="post"> 
                                            <select name="cbopayment" id="input-search-option" class="form-control" required onchange="setServiceOptionPanel();">
                                                <option value=""> --- Please Select --- </option>
                                                <option value="nic">Customer NIC</option>
                                                <option value="tp">Phone Number</option>
                                                <option value="sno">Service Number</option>
                                                <option value="vno">Vehicle Number</option>
                                            </select>
                                            <div class="form-group required">
                                                <label class="control-label" for="input-email">Search Here:</label>
                                                <input type="text" name="fname" id="fname" value="" placeholder="Search Here" id="input-email" class="form-control" maxlength="10" required/>
                                                <br>
                                                <button type="submit" name="search_buton"  id="cservicebtn" method="post" class="btn btn">Search</button>

                                            </div>
                                        </form>
                                        <form method="post">

                                            <div class="form-group required">
                                                <button type="submit" name="search_buton_view_All"  id="cservicebtn" method="post" class="btn btn">View All</button>
                                            </div>

                                        </form>
                                        <?php
                                        if (isset($_POST['cbopayment'])) {
                                            $com_vehi = $_POST['cbopayment'];
                                          echo '<script>alert("awa")</script>';
                                        }
                                        ?>
                                    </div>

                                </fieldset>
                            </div>

                            <fieldset id="account">
                                <legend>Search Option 02</legend>
                                <form method="post">
                                    <div class="form-group required">
                                        <label class="control-label">Start Date:</label>
                                        <input type="date" name="date1" id="date1" min="1900-12-31" max="<?php echo $date_setter; ?>" value="<?php echo $date_setter; ?>" placeholder="Registration Date" class="form-control"/>
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label">End Here:</label>
                                        <input type="date" name="date2" id="date2" min="1900-12-31" max="<?php echo $date_setter; ?>" value="<?php echo $date_setter; ?>" placeholder="Search Here" class="form-control" required/>
                                        <br>
                                        <button type="submit" on name="search_date" id="cservicebtn" class="btn btn">Search</button>
                                    </div>

                                    <select name="cbobranch" id="input-search-option" class="form-control" required onchange="setServiceOptionPanel();" style="width:400px;float: left;">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="HOR"> HOR </option>
                                        <option value="BLS"> BLS </option>
                                       
                                        <?php
                                        $query = "SELECT * FROM branch WHERE `status`='Active'";
                                        $result = mysqli_query($d_bc, $query);
                                        while ($row = mysqli_fetch_assoc($result)):
                                            ?>
                                            <option value="<?php echo $row['branch'] ?>"><?php echo $row['branch'] ?></option>
                                        <?php endwhile ?>
                                    </select><p style="color: white;float: left;">as</p>
                                    <button type="submit" on name="search_branch" id="cservicebtn" class="btn btn">Search</button>
                                    <br/>
                                    <br/>
                                    <?php
                                        if (isset($_POST['cbobranch'])) {
                                            $com_branch = $_POST['cbobranch'];
                                        }
                                        ?>
                                </form>
                            </fieldset>


                            <!--pagination for Customer View-->
                            <?php
                           
                            $sql_query = "";

                            $records_per_page = 10;
                            require 'Zebra_Pagination.php';
                            $pagination = new Zebra_Pagination();
                            if (isset($_POST['search_buton'])) {
                                if ($com_vehi == "sno") {

                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,c.`ser_number`,c.vehicle_no,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp FROM customer a INNER JOIN `service` c ON a.`cus_nic`=c.`cus_nic` WHERE c.`ser_number`='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                } elseif ($com_vehi == "tp") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,c.vehicle_no,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE a.`cus_tp`='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                } elseif ($com_vehi == "nic") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,c.vehicle_no,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE a.`cus_nic`='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                } elseif ($com_vehi == "vno") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,c.vehicle_no,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number` FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE c.vehicle_no='" . $_POST['fname'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }
                            } elseif (isset($_POST['search_date'])) {

                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number`,c.vehicle_no FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE a.`cus_reg_date` BETWEEN '" . $_POST['date1'] . "' AND '" . $_POST['date2'] . "' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            } elseif (isset($_POST['search_buton_view_All'])) {

                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number`,c.vehicle_no FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic  ORDER BY a.cus_id LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            }elseif (isset($_POST['search_branch'])) {
                                
                                if ($com_branch=="HOR") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number`,c.vehicle_no FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE ser_number LIKE 'HOR%'  ORDER BY c.`ser_number` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }
                                elseif ($com_branch=="BLS") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number`,c.vehicle_no FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE ser_number LIKE 'BLS%'  ORDER BY c.`ser_number` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }
                                elseif ($com_branch=="PLD") {
                                    $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number`,c.vehicle_no FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic WHERE ser_number LIKE 'PLD%'  ORDER BY c.`ser_number` LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                                }
                                
                                
                            }
                            else {
                                $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.cus_id,a.cus_fullname,a.cus_nic,a.cus_address,a.cus_reg_date,a.cus_tp,c.`ser_number`,c.vehicle_no FROM customer a INNER JOIN service c ON a.cus_nic=c.cus_nic  ORDER BY a.cus_id LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            }
                            $result = mysqli_query($d_bc, $sql_query);
                            $service_co = mysqli_num_rows($result);
                            if (!($result)) {

                                //stop execution and display error message
                                die(mysql_error());
                            }
                            $rows = mysqli_fetch_assoc(mysqli_query($d_bc, 'SELECT FOUND_ROWS() AS rows'));
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
                                            <th>Service Number</th>
                                            <th>Vehicle Number</th>
                                            <th>Permanent Address</th>
                                            <th>Registration Date</th>
                                            <th>Phone Number</th>
                                            <th>View More</th>
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
                                                <td><?php echo $row['ser_number'] ?></td>
                                                <td><?php echo $row['vehicle_no'] ?></td>
                                                <td><?php echo $row['cus_address'] ?></td>
                                                <td><?php echo $row['cus_reg_date'] ?></td>
                                                <td><?php echo $row['cus_tp'] ?></td>
                                                <td><?php echo '<button type="submit" name="view" id="cservicebtn" method="post" class="btn btn">View</button>' ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-inline">

                                            <button type="submit"  class="btn btn" id="cservicebtn">Save as PDF</button>

                                            <button type="submit"  class="btn btn" id="cservicebtn"><a href="customer_view_report.php" target="_parent" style="color: white; text-decoration: none">Print</a></button>
                                            <script>

                                                var cel;
                                                function readValues(x) {

                                                    cel = x.cells[3].innerHTML;
                                                    var cus_id = cel.substring(cel.lastIndexOf("#") + 3, cel.lastIndexOf("<"));
                                                   // alert(cus_id);
                                                    window.location.href = "customer_installment_set.php?ser_number=" + cel;
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
