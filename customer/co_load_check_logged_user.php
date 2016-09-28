<?php

session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
} else {
    require '../db/newDB.php';
    $lgged_user = filter_input(INPUT_GET, 'lgged_user');
    if ($lgged_user != null && $lgged_user != "") {
        global $conn;
        $process_user=$_SESSION['user_email'];
        $check_user_type="SELECT * FROM userlogin WHERE user_email='$process_user'";
        $run_check_user=  mysqli_query($conn, $check_user_type);
        if(mysqli_num_rows($run_check_user)>0){
            if($row_user=  mysqli_fetch_assoc($run_check_user)){
                $user_type=$row_user['user_type'];
                if($user_type=="3"){
                    echo "admn";
                }else if($user_type=="2"){
                    echo "mngr";
                }else{
                    echo "usr";
                }
            }
        }
        
        
        
    }
}