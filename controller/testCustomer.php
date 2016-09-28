<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/mysqliConnect.php';


    $sql = "SELECT * FROM cus";

    $result = mysqli_query($d_bc, $sql);
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
            echo $row['id'];
        }
        // Free result set
       // mysqli_free_result($result);
    

mysqli_close($con);
