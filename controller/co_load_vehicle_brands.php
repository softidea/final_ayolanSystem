<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';


function load_vehicle_brands() {
    

    $sql_query = "CALL sp_lod_vehicle_brand();";
    $run_query = mysqli_query($d_bc, $sql_query);
    echo "<option value='0'>~~Select Brand~~</option>";
    while ($row_vehicle_brand = mysqli_fetch_array($run_query)) {
        $vehicle_brand_id = $row_vehicle_brand['brand_id'];
        $vehicle_brand = $row_vehicle_brand['brand'];
        echo "<option value='$vehicle_brand_id'>$vehicle_brand</option>";
    }
    }
function load_land_pawn_amounts(){
    
    $sql_query = "SELECT * FROM pawn_amount";
    $run_query = mysqli_query($d_bc, $sql_query);
    echo "<option value='0'>~~Select Amount~~</option>";
    while ($row = mysqli_fetch_array($run_query)) {
        $aid = $row['amount_id'];
        $amount = $row['pawn_amount'];
        echo "<option value='$aid'>.$amount.</option>";
    }
}



