
<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
?>
<?php
if (isset($_SESSION['cus_nic'])) {
    $cus_nic = $_SESSION['cus_nic'];
    $cus_name = $_SESSION['cus_name'];
    $lease_date = $_SESSION['cus_reg_date'];
} else {
    $cus_nic = "";
    $cus_name = "";
    $lease_date = "";
}
?>
<!DOCTYPE html>
<html>
    <!--Variable Declaration-->
    <?php
    $vehicle_no = "";
    $model_year = "";
    $lease_rate = "";
    $fixed_rate = "";
    $cbo_loan_duration = "";

    date_default_timezone_set('Asia/Colombo');
    $lease_reg_date = date("Y-m-d");
    ?>
    <!--Variable Declaration-->
    <head>
        <meta charset="UTF-8">
        <title>Quick Installment</title>

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
        <script src="../assets/js/jquery-3.0.0.js"></script>
        <script src="../assets/js/angular.js"></script>
        <link rel="icon" href="favicon.ico">

        <?php require '../controller/co_load_vehicle_brands.php'; ?>
        <script type="text/javascript">
            function imagepreview(input) {
                if (input.files && input.files[0]) {
                    var filerd = new FileReader();
                    filerd.onload = function (e) {
                        $('#imgpreview').attr('src', e.target.result);
                    };
                    filerd.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <script type="text/javascript">
            function checkInstallment()
            {
                var category = document.getElementById('cat_load').value;
                var amount = document.getElementById('lease_amount').value;
                var period = document.getElementById('v_lease_period').value;

                if (category == "1") {
                    var installment = ((amount / period) + ((3.96 / 100) * (amount)));
                    document.getElementById('installment_val').value = Math.round(installment) + 1 + ".00";
                } else if (category == "2") {
                    var installment = ((amount / period) + ((2.96 / 100) * (amount)));
                    document.getElementById('installment_val').value = Math.round(installment) + 1 + ".00";
                } else {
                    var installment = ((amount / period) + ((2.96 / 100) * (amount)));
                    document.getElementById('installment_val').value = Math.round(installment) + 1 + ".00";
                }




            }
        </script>
        <script type="text/javascript">
            function load_vehicle_categories() {
                var cat_load = "loadcat";
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('cat_load').innerHTML = xmlhttp.responseText;
                        document.getElementById('cat_load_brand').innerHTML = xmlhttp.responseText;
                        document.getElementById('cat_load_rate').innerHTML = xmlhttp.responseText;
                        document.getElementById('search_category').innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load=" + cat_load, true);
                xmlhttp.send();

            }
        </script>
        <script type="text/javascript">
            function resetFields() {
                document.getElementById('lease_amount').value = "";
//                document.getElementById('v_lease_period').innerHTML = selectedIndex = "0";
                document.getElementById('installment_val').value = "";
            }
        </script>
        <link rel="stylesheet" href="../assets/css/images-uploader.css">
    </head>
    <body onload="load_vehicle_categories()">

        <?php include '../assets/include/navigation_bar.php'; ?>
        <!--Lease Registration Panel-->
        <div ng-app="" class="container" style="margin-top: 80px;display: block;" id="one">
            <form action="../controller/co_customer.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Quick Installment</h3>
                            </div>
                            <div class="panel-body" style="background-color: #FAFAFA;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Check Installment</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Select Category:</label>
                                            <select name="cat_load" id="cat_load" class="form-control" onchange="resetFields();">
                                                <option value="0">~~Select Category~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Lease Amount:</label>
                                            <div class="form-group required">
                                                <input type="text" name="lease_amount" id="lease_amount" value="<?php echo $cus_nic; ?>" placeholder="Lease Amount" class="form-control" required maxlength="10" onKeyPress="return numbersonly(this, event)"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Select Period:</label>
                                            <select name="cbo_loan_duration" id="v_lease_period" class="form-control" required onchange="checkInstallment();">
                                                <option value="0">~~Select Period~~</option>
                                                <option value="3">3 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="9">9 Months</option>
                                                <option value="12">1 Year</option>
                                                <option value="18">1 Year & 6 Months</option>
                                                <option value="24">2 Years</option>
                                                <option value="30">2 Year & 6 Months</option>
                                                <option value="36">3 Years</option>
                                                <option value="42">3 Year & 6 Months</option>
                                                <option value="48">4 Years</option>
                                                <option value="54">4 Year & 6 Months</option>
                                                <option value="60">5 Years</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="lease_reg_date_hide" value="<?php echo $lease_date; ?>">
                                        <div class="form-group">
                                            <label class="control-label">Installment :</label>
                                            <input type="text" name="installment_val" readonly id="installment_val" placeholder="Installment" class="form-control"/>
                                        </div>
                                        <div class="form-inline" style="margin-bottom: 8px;">
                                            <a href="../user/user_home.php"><button type="button" id="cviewbuttons" class="btn btn">Back to Home</button></a>
                                        </div>
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
    <script type="text/javascript">
        function clearImgPreview() {
            document.getElementById('image-preview').innerHTML = "";
        }
    </script>
    <script src="../assets/js/images-uploader-min.js"></script>
</html>
