
<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}

include '../db/mysqliConnect.php';

$username = filter_input(INPUT_POST, "user_email", FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, "user_password");


if (!empty($username) && !empty($password)) {

    $_SESSION['user_email'] = $username;
    $_SESSION['user_password'] = $password;


    $qy_login = "CALL sp_login_User('" . $_SESSION['user_email'] . "','" . $_SESSION['user_password'] . "')";

    $qy = mysqli_query($d_bc, $qy_login);
    if (mysqli_num_rows($qy) == 1) {
        $url = "";
        $row = mysqli_fetch_assoc($qy);
        if ($row['user_status'] == '1') {
            
            $_SESSION['user_username'] = $row['user_name'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_branch'] = $row['branch'];
            
            
            
            if ($row['user_type'] == 1) {
                $_SESSION['user_typel']="User";
                $url = '../user/user_home.php';
            }
            if ($row['user_type'] == 2) {
                $_SESSION['user_typel']="Manager";
                $url = '../user/manager_home.php';
            }
            if ($row['user_type'] == 3) {
                $_SESSION['user_typel']="Admin";
                $url = '../admin/admin_home.php';
            }
        }else{
            
            echo '<script type="text/javascript">alert("You are not a Active user!");</script>';
        }
        

        echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
    } else {
        $url = '../index.php';


        echo '<script type="text/javascript">window.location.href="' . $url . '"; alert("Your Email Or Password is incorrect!");</script>';
        // echo '<script type="text/javascript">alert("Your Username Or Password is Incorrect");</script>';
    }

    mysql_close($d_bc);
} else {
    header("Location:../index.php");
}