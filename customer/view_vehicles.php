<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Vehicle Rates</title>
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
            function load_vehicle_brands() {
                var category = document.getElementById('cat_load_brand').value;
                if (category != null && category != "") {
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
                            document.getElementById('brand_load').innerHTML = "";
                            document.getElementById('brand_load').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load_brand=" + category, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function save_vehicle_brand() {
                var category = document.getElementById('cat_load').value;
                var brand = document.getElementById('new_brand').value;
                if (category != null && category != "" && brand != null && brand != "") {
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
                            document.getElementById('cat_load').selectedIndex = "0";
                            var brand = document.getElementById('new_brand').value = "";
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?brand_category_id=" + category + "&save_brand=" + brand, true);
                    xmlhttp.send();
                } else {
                    alert("Missing Data,Please enter valid Data");
                }
            }
        </script>
        <script>
            function save_vehicle_model() {
                var category = document.getElementById('cat_load_brand').value;
                var brand = document.getElementById('brand_load').value;
                var model = document.getElementById('new_model').value;
                if (category != null && category != "" && brand != null && brand != "" && model != "" && model != null) {
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
                            document.getElementById('cat_load_brand').selectedIndex = "0";
                            document.getElementById('brand_load').innerHTML = "<option>~Select Brand~</option>";
                            var model = document.getElementById('new_model').value = "";
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?model_category_id=" + category + "&model_brand=" + brand + "&save_model=" + model, true);
                    xmlhttp.send();
                } else {
                    alert("Missing Data,Please enter valid Data");
                }
            }
        </script>
        <script type="text/javascript">
            function load_vehicle_rate_brands() {
                var category = document.getElementById('cat_load_rate').value;
                if (category != null && category != "") {
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
                            document.getElementById('brand_load_rate').innerHTML = "";
                            document.getElementById('brand_load_rate').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load_brand=" + category, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function load_vehicle_rate_models() {
                var brand = document.getElementById('brand_load_rate').value;
                if (brand != null && brand != "") {
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
                            document.getElementById('model_load_rate').innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?cat_load_model=" + brand, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script type="text/javascript">
            function save_rate() {
                var category = document.getElementById('cat_load_rate').value;
                var brand = document.getElementById('brand_load_rate').value;
                var model = document.getElementById('model_load_rate').value;
                var model_year = document.getElementById('model_year').value;
                var min_value = document.getElementById('min_val').value;
                var max_value = document.getElementById('max_val').value;
                var vehicle_pre_code = document.getElementById('vehicle_pre_code').value;
                if (category != null && category != "0" && brand != null && brand != "0" && model != null && model != "0" && model_year != null && model_year != "" && min_value != null && min_value != "" && max_value != null && max_value != "") {
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
                            document.getElementById('cat_load_rate').selectedIndex = "0";
                            document.getElementById('brand_load_rate').innerHTML = "<option value='0'>~Select Brand~</option>"
                            document.getElementById('model_load_rate').innerHTML = "<option value='0'>~Select Model~</option>"
                            document.getElementById('model_year').value = "";
                            document.getElementById('min_val').value = "";
                            document.getElementById('max_val').value = "";
                        }
                    }
                    xmlhttp.open("GET", "../controller/co_load_vehicle_category.php?rate_category=" + category + "&rate_brand=" + brand + "&rate_model=" + model + "&model_year=" + model_year + "&min_value=" + min_value + "&max_value=" + max_value + "&vehicle_pre_code=" + vehicle_pre_code, true);
                    xmlhttp.send();
                } else {
                    alert("Invalid data,Please enter valid data");
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

            function checker(type) {


                if (type == 1) {

                    document.getElementById('bike_div').style.display = 'block';
                    document.getElementById('tw_div').style.display = 'none';
                    document.getElementById('van_div').style.display = 'none';

                }
                if (type == 2) {

                    document.getElementById('bike_div').style.display = 'none';
                    document.getElementById('tw_div').style.display = 'block';
                    document.getElementById('van_div').style.display = 'none';

                }
                if (type == 3) {

                    document.getElementById('bike_div').style.display = 'none';
                    document.getElementById('tw_div').style.display = 'none';
                    document.getElementById('van_div').style.display = 'block';

                }

            }


        </script>
</html>
</head>
<body onload="load_vehicle_categories()">
    <?php
    include '../assets/include/navigation_bar.php';
    require_once '../db/newDB.php';
    ?>
    <!--Customer Panel Section-->
    <div class="container" style="margin-top: 80px;display: block;" id="one">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" id="panelheading">
                        <h3 class="panel-title">Vehicle and Land Rates</h3>
                    </div>
                    <div class="panel-body" style="background-color: #FAFAFA;">
                        <div class="col-sm-6">
                            <fieldset id="account">
                                <legend>Search Option 01</legend>
                                <div class="form-group required">
                                    <label class="control-label">Search by Category:</label>
                                    <select name="search_category" id="search_category" class="form-control" onchange="checker(this.value);">
                                        <option value="0">~~Select Category~~</option>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset id="account">
                                <legend style="color: #FAFAFA;">Search Option 02</legend>
                                <div class="form-group">
                                    <label class="control-label" id="hidecaption">Admin Options:</label>
                                    <div class="form-inline required">
                                        <a href="../print_report/Print_vehicleRate_bike.php"><button type="submit"  class="btn btn" id="cservicebtn" onclick="PrintDoc();">Print Report</button></a>
                                        <button type="submit"  class="btn btn" id="cservicebtn" onclick="PrintPreview();">Preview</button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!--pagination for bick values-->
                        <?php
                        $records_per_page = 10;
                        require 'Zebra_Pagination.php';
                        $pagination = new Zebra_Pagination();
                        $sql_query = "SELECT SQL_CALC_FOUND_ROWS  a.`model_year`,a.`min_value`,a.`max_value`,a.`pre_code`,b.`brand`,c.`vehicle_type` from`vehicle_rates` a  inner Join `vehicle_brand` b on a.`brand_id`=b.`brand_id` inner join `vehicle_type` c on a.`type_id`=c.`type_id` where a.`category_id`='1' LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                        $result = mysqli_query($conn, $sql_query);
                        
                         if (!($result)) {
                             echo '<script>alert("awaaa")</script>';
                            // stop execution and display error message
                          
                        }
                        
                        $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
                        $pagination->records($rows['rows']);
                        $pagination->records_per_page($records_per_page);
                        ?>

                        <div class="col-sm-12">
                            <div id="bike_div" style="display: block;background: white;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>

                                            <th>Model Year</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Min Value</th>
                                            <th>Max Value</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bike_tbody">

                                        <?php $index = 0; ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?>>
                                                
                                                <td><?php echo $row['model_year'] ?></td>
                                                <td><?php echo $row['brand'] ?></td>
                                                <td><?php echo $row['vehicle_type'] ?></td>
                                                <td><?php echo $row['min_value'] ?></td>
                                                <td><?php echo $row['max_value'] ?></td>

                                            </tr>
                                        <?php endwhile ?>

                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                </div>
                            </div>
                            <!--pagination for 3whele values-->
                             <?php
                            global $conn;
                            $records_per_page = 10;
                            $pagination = new Zebra_Pagination();

                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.`model_year`,a.`min_value`,a.`max_value`,a.`pre_code`,b.`brand`,c.`vehicle_type` from`vehicle_rates` a  inner Join `vehicle_brand` b on a.`brand_id`=b.`brand_id` inner join `vehicle_type` c on a.`type_id`=c.`type_id` where a.`category_id`='2'  LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            $result = mysqli_query($conn, $sql_query);
                            if (!($result)) {

                                // stop execution and display error message
                                die(mysql_error());
                            }
                            $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
                            $pagination->records($rows['rows']);
                            $pagination->records_per_page($records_per_page);
                            ?>
                            
                            <div id="tw_div" style="display: none;">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>Model Year</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Min Value</th>
                                            <th>Max Value</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tw_tbody">

                                        <?php $index = 0; ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?>>
                                                
                                                <td><?php echo $row['model_year'] ?></td>
                                                <td><?php echo $row['brand'] ?></td>
                                                <td><?php echo $row['vehicle_type'] ?></td>
                                                <td><?php echo $row['min_value'] ?></td>
                                                <td><?php echo $row['max_value'] ?></td>

                                            </tr>
                                        <?php endwhile ?>
                                        
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                </div>
                            </div>
                            <!--pagination for Land values-->

                             <?php
                            global $conn;
                            $records_per_page = 10;
                            $pagination = new Zebra_Pagination();

                            $sql_query = "SELECT SQL_CALC_FOUND_ROWS a.`model_year`,a.`min_value`,a.`max_value`,a.`pre_code`,b.`brand`,c.`vehicle_type` from`vehicle_rates` a  inner Join `vehicle_brand` b on a.`brand_id`=b.`brand_id` inner join `vehicle_type` c on a.`type_id`=c.`type_id` where a.`category_id`='3'   LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . "," . $records_per_page;
                            $result = mysqli_query($conn, $sql_query);
                            if (!($result)) {

                                // stop execution and display error message
                                die(mysql_error());
                            }
                            $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
                            $pagination->records($rows['rows']);
                            $pagination->records_per_page($records_per_page);
                            ?>
                            
                            <div id="van_div" style="display: none;">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>Model Year</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Min Value</th>
                                            <th>Max Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $index = 0; ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <tr<?php echo $index++ % 2 ? ' class="even"' : '' ?>>
                                                
                                                <td><?php echo $row['model_year'] ?></td>
                                                <td><?php echo $row['brand'] ?></td>
                                                <td><?php echo $row['vehicle_type'] ?></td>
                                                <td><?php echo $row['min_value'] ?></td>
                                                <td><?php echo $row['max_value'] ?></td>

                                            </tr>
                                        <?php endwhile ?>
                                        
                                    </tbody>
                                </table>
                                 <div class="text-center">
                                    <nav> <ul class="pagination"><li> <?php $pagination->render(); ?></li></ul></nav>
                                </div>
                            </div>
                            <!--bike rate registration-->
                            <div class="new_vehicle" style="display: block;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Vehicle Brand Registration</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Select Category:</label>
                                            <select name="cat_load" id="cat_load" class="form-control">
                                                <option value="0">~~Select Category~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">New Brand:</label>
                                            <input type="text" name="new_brand" id="new_brand" placeholder="New Brand" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn" id="cservicebtn" onclick="save_vehicle_brand();">Save Brand</button>
                                        </div>
                                    </fieldset>
                                    <fieldset id="account">
                                        <legend>Vehicle Type Registration</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Select Category:</label>
                                            <select name="cat_load_brand" id="cat_load_brand" class="form-control" onchange="load_vehicle_brands();">
                                                <option value="0">~~Select Category~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Select Brand:</label>
                                            <select name="brand_load" id="brand_load" class="form-control" onchange="">
                                                <option value="0">~~Select Brand~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">New Model:</label>
                                            <input type="text" name="new_model" id="new_model" placeholder="New Model" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn" id="cservicebtn" onclick="save_vehicle_model();">Save Type</button>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!--bike rate registration-->
                            <div class="new_vehicle" style="display: block;">
                                <div class="col-sm-6">
                                    <fieldset id="account">
                                        <legend>Vehicle Rate Registration</legend>
                                        <div class="form-group required">
                                            <label class="control-label">Select Category:</label>
                                            <select name="cat_load_rate" id="cat_load_rate" class="form-control" onchange="load_vehicle_rate_brands();">
                                                <option value="0">~~Select Category~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">

                                            <label class="control-label">Select Brand:</label>
                                            <select name="brand_load_rate" id="brand_load_rate" class="form-control" onchange="load_vehicle_rate_models();">
                                                <option>~~Select Brand~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Select Model:</label>
                                            <select name="model_load_rate" id="model_load_rate" class="form-control">
                                                <option>~~Select Model~~</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Vehicle Pre Code:</label>
                                            <input type="text" name="vehicle_pre_code" id="vehicle_pre_code" placeholder="Vehicle Pre Code" class="form-control" />
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Model Year:</label>
                                            <input type="text" name="model_year" id="model_year" placeholder="Model Year" class="form-control" />
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Min Value:</label>
                                            <input type="text" name="min_val" id="min_val" placeholder="Min Value" class="form-control" onKeyPress="return numbersonly(this, event)"/>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Max Value:</label>
                                            <input type="text" name="max_val" id="max_val" placeholder="Max Value" class="form-control" onKeyPress="return numbersonly(this, event)" />
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn" id="cservicebtn" onclick="save_rate();">Save Rate</button>
                                        </div>
                                    </fieldset>
                                </div>
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
<style type="text/css">
    #hidecaption{
        color: #FAFAFA;
    }
    body{
        -webkit-user-select: none;  /* Chrome all / Safari all */
        -moz-user-select: none;     /* Firefox all */
        -ms-user-select: none;      /* IE 10+ */
        user-select: none;
    }
</style>

</html>
