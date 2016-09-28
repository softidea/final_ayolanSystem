<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/newDB.php';


$aid = $_GET['aid'];
$yid=$_GET['yid'];

//echo $aid."%$".$yid;
global $conn;
$sql_query="SELECT * FROM ser_land_pre WHERE year_id='$yid' AND amount_id='$aid'";
$run_query=  mysqli_query($conn, $sql_query);
if(mysqli_num_rows($run_query)>0){
    if($row=mysqli_fetch_assoc($run_query)){
        $interest=$row['interest'];
        echo $interest;
    }
}
else{
    echo "No Interest Found,Try Again";
}



?>