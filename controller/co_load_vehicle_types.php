<?php
$q = intval($_GET['q']);

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';



$sql="SELECT * FROM vehicle_type WHERE brand_id = '".$q."'";
$result = mysqli_query($d_bc,$sql);
 echo "<option value='0'>~~Select Vehicle Type~~</option>";
while($row = mysqli_fetch_array($result)) {
    $v_type_id=$row['vehicle_type_id'];
    echo "<option value=$v_type_id>" . $row['vehicle_type'] . "</option>";
}
mysqli_close($d_bc);
?>