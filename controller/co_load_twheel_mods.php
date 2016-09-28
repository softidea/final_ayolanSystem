<?php

$vt_id= intval($_GET['q']);

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';


$sql_query="SELECT DISTINCT tw_type FROM ser_threewheel_pre WHERE tw_mode=$vt_id";
$run_query=  mysqli_query($d_bc, $sql_query);
echo "<option value='0'>~~Select Pre Code~~</option>";
while($row_query=  mysqli_fetch_array($run_query)){
    $mod=$row_query['tw_type'];
    echo "<option value='$mod'>$mod</option>";
}
mysqli_close($d_bc);

?>
