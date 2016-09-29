<?php
session_start();

if (isset($_SESSION['user_email']) && ($_SESSION['user_status']==="Active") && ($_SESSION['user_typel'] === "Admin")) {
    header("Location:admin_home.php");
}else{
    header("Location:../index.php");
    
}
