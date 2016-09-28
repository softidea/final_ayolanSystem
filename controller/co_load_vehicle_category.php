<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}


require '../db/newDB.php';

$cat_load = filter_input(INPUT_GET, 'cat_load');
$cat_load_brand = filter_input(INPUT_GET, 'cat_load_brand');
$brand_category_id = filter_input(INPUT_GET, 'brand_category_id');
$save_brand = filter_input(INPUT_GET, 'save_brand');

$model_category_id = filter_input(INPUT_GET, 'model_category_id');
$model_brand = filter_input(INPUT_GET, 'model_brand');
$save_model = filter_input(INPUT_GET, 'save_model');

$cat_load_model = filter_input(INPUT_GET, 'cat_load_model');

$rate_category = filter_input(INPUT_GET, 'rate_category');
$rate_brand = filter_input(INPUT_GET, 'rate_brand');
$rate_model = filter_input(INPUT_GET, 'rate_model');
$rate_model_year = filter_input(INPUT_GET, 'model_year');
$min_value = filter_input(INPUT_GET, 'min_value');
$max_value = filter_input(INPUT_GET, 'max_value');
$vehicle_pre_code = filter_input(INPUT_GET, 'vehicle_pre_code');

$branch_load = filter_input(INPUT_GET, 'branch_load');

if ($branch_load != null && $branch_load != "") {
    global $conn;
    $sql_query = "SELECT * FROM branch WHERE status='Active'";
    $run_query = mysqli_query($conn, $sql_query);
    echo "<option value='0'>~Select Branch~</option>";
    while ($row_query = mysqli_fetch_array($run_query)) {
        $branch_id = $row_query['branch_id'];
        $branch = $row_query['branch'];
        echo "<option value='$branch'>$branch</option>";
    }
}

if ($cat_load != null && $cat_load != "") {
    global $conn;
    $sql_query = "SELECT * FROM vehicle_category WHERE status='Active'";
    $run_query = mysqli_query($conn, $sql_query);
    echo "<option value='0'>~Select Category~</option>";
    while ($row_query = mysqli_fetch_array($run_query)) {
        $category_id = $row_query['category_id'];
        $category = $row_query['category'];
        echo "<option value='$category_id'>$category</option>";
    }
}

if ($cat_load_brand != null && $cat_load_brand != "") {
    global $conn;
    $sql_query_brand_load = "SELECT * FROM vehicle_brand WHERE category_id='$cat_load_brand' AND status='Active'";
    $run_query_brand = mysqli_query($conn, $sql_query_brand_load);
    if (mysqli_num_rows($run_query_brand) == 0) {
        echo "<option>~No Brand Found~</option>";
    } else {
        echo "<option value='0'>~Select Brand~</option>";
        while ($row_brand_query = mysqli_fetch_array($run_query_brand)) {
            $brand_id = $row_brand_query['brand_id'];
            $brand = $row_brand_query['brand'];
            echo "<option value='$brand_id'>$brand</option>";
        }
    }
}
if ($brand_category_id != null && $brand_category_id != "" && $save_brand != null && $save_brand != "") {
    global $conn;
    $check_brand = "SELECT * FROM vehicle_brand WHERE brand='$save_brand'";
    $run_check_brand = mysqli_query($conn, $check_brand);
    if (mysqli_num_rows($run_check_brand) == 0) {
        $save_brand_query = "INSERT INTO vehicle_brand (brand,status,category_id) VALUES ('$save_brand','Active','$brand_category_id')";
        $run_save_brand = mysqli_query($conn, $save_brand_query);
        echo "Brand saved successfully";
    } else {
        echo "Brand is already added";
    }
}
if ($model_category_id != null && $model_category_id != "" && $model_brand != null && $model_brand != "" && $save_model != "" && $save_model != null) {
    global $conn;
    $check_model = "SELECT * FROM vehicle_type WHERE vehicle_type='$save_model' AND brand_id='$model_brand'";
    $run_check_model = mysqli_query($conn, $check_model);
    if (mysqli_num_rows($run_check_model) == 0) {
        $save_model = "INSERT INTO vehicle_type(vehicle_type,status,brand_id) VALUES ('$save_model','Active','$model_brand')";
        $run_save_model = mysqli_query($conn, $save_model);
        echo "Model saved successfully";
    } else {
        echo "Model is already added";
    }
}
if ($cat_load_model != null && $cat_load_model != "") {
    global $conn;
    $load_models = "SELECT * FROM vehicle_type WHERE brand_id='$cat_load_model' AND status='Active'";
    $run_load_models = mysqli_query($conn, $load_models);
    if (mysqli_num_rows($run_load_models) == 0) {
        echo "<option>~No Model Found~</option>";
    } else {
        echo "<option value='0'>~Select Model~</option>";
        while ($row_load_model = mysqli_fetch_assoc($run_load_models)) {
            $model_id = $row_load_model['type_id'];
            $model = $row_load_model['vehicle_type'];
            echo "<option value='$model_id'>$model</option>";
        }
    }
}
if ($rate_category != null && $rate_category != "" && $rate_brand != null && $rate_brand != "" && $rate_model != null && $rate_model != "" && $rate_model_year != null && $rate_model_year != "" && $min_value != null && $min_value != "" && $max_value != null && $max_value != "" && $vehicle_pre_code != null && $vehicle_pre_code != "") {
    global $conn;

    $check_rate_available = "SELECT * FROM vehicle_rates WHERE category_id='$rate_category' AND brand_id='$rate_brand' AND type_id='$rate_model' AND pre_code='$vehicle_pre_code'";
    $run_check_available = mysqli_query($conn, $check_rate_available);
    if (mysqli_num_rows($run_check_available) == 0) {

        $save_vehicle_rate = "INSERT INTO vehicle_rates (category_id,brand_id,type_id,model_year,min_value,max_value,pre_code) VALUES ('$rate_category','$rate_brand','$rate_model','$rate_model_year','$min_value','$max_value','$vehicle_pre_code')";
        $run_save_rate = mysqli_query($conn, $save_vehicle_rate);
        echo "Vehicle Rate saved successfully";
    } else {

        $update_current_rate = "UPDATE vehicle_rates SET model_year='$rate_model_year',min_value='$min_value',max_value='$max_value',pre_code='$vehicle_pre_code' WHERE category_id='$rate_category' AND brand_id='$rate_brand' AND type_id='$rate_model' AND pre_code='$vehicle_pre_code'";
        $run_update_rate = mysqli_query($conn, $update_current_rate);
        echo "Vehicle Rate updated successfully";
    }
} else {
    echo "Saving error,Please enter valid data";
}


//if (isset($_GET['mode'])) {
//    $vt_id = intval($_GET['mode']);
//
//    define('db_host', '107.180.14.32');
//    define('db_port', '3306');
//    define('db_user', 'ayolandeveloper');
//    define('db_password', 'WelComeDB1129');
//    define('db_database', 'ayolan_datahost');
//
//    $d_bc = mysqli_connect(db_host, db_user, db_password, db_database) or die('Could not connect to MySql: ' . mysqli_connect_error());
//
//    $sql_query = "SELECT DISTINCT type FROM ser_vehicles_pre WHERE vehicle_type_id=$vt_id";
//    $run_query = mysqli_query($d_bc, $sql_query);
//    echo "<option value='0'>~~Select Pre Code~~</option>";
//    while ($row_query = mysqli_fetch_array($run_query)) {
//        $mod = $row_query['type'];
//        echo "<option value='$mod'>$mod</option>";
//    }
//    echo "<option value='newmodel'>~~Add New Model~~</option>";
//}
?>