<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['user_email']) && ($_SESSION['user_status']==="Active") && ($_SESSION['user_typel'] === "Admin")) {
    header("Location:../admin_home.php");
}else{
    header("Location:../index.php");
    
}

    require_once '../../db/mysqliConnect.php';
    if (mysqli_connect_errno()) {
        echo "Falied to Connect the Database" . mysqli_connect_error();
    }

$current_date = date("Y-m-d");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Income Report</title>
         <?php include '../../assets/include/head.php'; 
require_once '../../db/mysqliConnect.php';?>
        <link rel="stylesheet" type="text/css" href="../../assets/css/user_common/user_common.css"/>
    </head>
    <body>
        <!--Service View Main Panel-->
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">View Daly Income</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <div class="form-group required">
                                         <?php
                                         
                                        $records_per_page = 10;
                                        require '../../customer/Zebra_Pagination.php';
                                        $pagination = new Zebra_Pagination();
                                        $sql_query1 = "SELECT SQL_CALC_FOUND_ROWS `ser_number`,`payment` FROM `ser_installment` WHERE `date`='".$current_date."'";
                                        $sql_query = " SELECT SUM(`payment`)As tot FROM `ser_installment` WHERE `date`='".$current_date."'";
                                        
                                     





                                        $result = mysqli_query($d_bc, $sql_query);
                                        $result1 = mysqli_query($d_bc, $sql_query1);
                                        $service_co1 = mysqli_num_rows($result1);
                                        if (!($result1)) {

                                            //stop execution and display error message
                                            die(mysql_error());
                                        }
                                        $rows1 = mysqli_fetch_assoc(mysqli_query($d_bc, 'SELECT FOUND_ROWS() AS rows'));
                                        $pagination->records($rows1['rows']);
                                        $pagination->records_per_page($records_per_page);
                                        ?>        
                                        <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>

                                                        <th>Service No</th>
                                                        <th>Payment</th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $index = 0;
                                                    $i = 1;
                                                    ?>
                                                    <?php while ($row1 = mysqli_fetch_assoc($result1)): ?>
                                                        <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?> >


                                                            <td><?php echo $row1['ser_number'] ?></td>
                                                            <td><?php echo $row1['payment'] ?></td>
                                                           
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endwhile ?>
                                                </tbody>
                                            </table>
                                                
                                         <?php while ($tot = mysqli_fetch_assoc($result)): ?>
                                        <h2>Total Is <u><?php echo $tot['tot'] ?>.00</u></h2>
                                         <?php endwhile ?>
                                               
                                        
                                            <div class="text-center">
                                                <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                            </div>
                                        
                                                <input type="button" class="btn btn" name="back_home" id="custcontinue" value="Back Home" onclick="backtoHome();">
                                            </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
    <script type="text/javascript">
        function backtoHome(){
            window.location.href="../index.php";
        }
    </script>
</html>
