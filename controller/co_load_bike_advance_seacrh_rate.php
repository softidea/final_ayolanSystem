<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/newDB.php';

if (isset($_GET['q'])) {
    $q = intval($_GET['q']);
    global $conn;
    $sql = "SELECT * FROM vehicle_type WHERE brand_id = '" . $q . "'";
    $result = mysqli_query($conn, $sql);
    echo "<option value='0'>~~Select Vehicle Type~~</option>";
    while ($row = mysqli_fetch_array($result)) {
        $v_type_id = $row['vehicle_type_id'];
        $type = $row['vehicle_type'];
        echo "<option value=$v_type_id><a href='view_vehicles.php?type=vehicle_type_id'>$type</a></option>";
    }
    echo "<option value='newtype'>~~Add New Type~~</option>";
}
if (isset($_GET['mode'])) {
    $vt_id = intval($_GET['mode']);
    global $conn;

    $sql_query = "SELECT DISTINCT type FROM ser_vehicles_pre WHERE vehicle_type_id=$vt_id";
    $run_query = mysqli_query($conn, $sql_query);
    echo "<option value='0'>~~Select Pre Code~~</option>";
    while ($row_query = mysqli_fetch_array($run_query)) {
        $mod = $row_query['type'];
        echo "<option value='$mod'>$mod</option>";
    }
    echo "<option value='newmodel'>~~Add New Model~~</option>";
}
if (isset($_GET['tw_mode'])) {
    $tw_id = intval($_GET['tw_mode']);
    global $conn;
    $sql_query = "SELECT DISTINCT tw_type FROM ser_threewheel_pre WHERE tw_mode=$tw_id";
    $run_query = mysqli_query($conn, $sql_query);
    echo "<option value='0'>~~Select Model~~</option>";
    while ($row_query = mysqli_fetch_array($run_query)) {
        $mod = $row_query['tw_type'];
        echo "<option value='$mod'>$mod</option>";
    }
    echo "<option value='new_tw_model'>~~Add New Model~~</option>";
}
?>