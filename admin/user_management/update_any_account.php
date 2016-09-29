<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['user_email']) && !($_SESSION['user_status']==="Active")) {
    header("Location:../index.php");
}

require_once '../../db/newDB.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update User Accounts</title>
        <?php include '../../assets/include/head.php'; ?>
        <link rel="stylesheet" type="text/css" href="../../assets/css/user_common/user_common.css"/>
    </head>
    <body>
        <!--Service View Main Panel-->
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">Change Password</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        <legend>Password Details</legend>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">E-mail:</label>
                                                <input type="text" name="email" id="email" placeholder="Enter E-mail" class="form-control" value="<?php echo $_SESSION['user_email']; ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Current Password:</label>
                                                <input type="password" name="current_password" id="current_password" placeholder="Enter Current Password" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">New Password:</label>
                                                <input type="password" name="new_password" id="new_password" placeholder="Enter New Password" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Confirm Password:</label>
                                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" class="form-control" required/>
                                                <input type="submit" class="btn btn" name="password_update" id="custcontinue" value="Change Password">
                                                <input type="button" class="btn btn" name="back_home" id="custcontinue" value="Back Home" onclick="backtoHome();">
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
    if (isset($_POST['password_update'])) {

        global $conn;

        $email = filter_input(INPUT_POST, 'email');
        $current_password = filter_input(INPUT_POST, 'current_password');
        $new_password = filter_input(INPUT_POST, 'new_password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');
        
        if ($email != "" && $current_password != "" && $new_password != "" && $confirm_password != "") {
            if ($new_password == $confirm_password) {
                $query = "SELECT * FROM userlogin WHERE user_email='$email'";
                $run_query = mysqli_query($conn, $query);
                if (mysqli_num_rows($run_query) == 1) {
                    $change_pass = "UPDATE userlogin SET user_password = '$confirm_password' WHERE user_email = '$email'";
                    $run_change = mysqli_query($conn, $change_pass);
                    if ($run_change) {
                        echo "<script>alert('Account Password successfully changed');document.getElementById('email').value='';</script>";
                        $emailu = "";
                    } else {
                        echo "<script>alert('Error while changing password,please check again');</script>";
                    }
                } else {
                    echo "<script>alert('Please enter valid user email and password');</script>";
                }
            } else {
                echo "<script>alert('Passwords are not matched,Please enter matched Password');</script>";
            }
        }
    }
    ?>
    <script type="text/javascript">
        function backtoHome() {
            window.location.href = "../../controller/co_logout.php";
        }
    </script>
</html>
