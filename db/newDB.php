<?php

global $conn;
$conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_test");
//$conn = mysqli_connect("localhost", "root", "1234", "ayolanin_datahost");
if (mysqli_connect_errno()) {

    header("Location:../errors/error_page.php");
}
