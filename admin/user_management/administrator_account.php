<!DOCTYPE html>
<?php
session_start();

    require_once '../../db/mysqliConnect.php';
    if (mysqli_connect_errno()) {
        echo "Falied to Connect the Database" . mysqli_connect_error();
    }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Accounts</title>
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
                            <h3 class="panel-title">Create New Account</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        <legend>Account Details</legend>
                                        <div class="form-group required" id="service_combo_div">
                                            <label class="control-label">Select User Type:</label>
                                            <select name="select_user_type" id="select_user_type" class="form-control" required>
                                                <!--<option value='0'>~~Select User Type~~</option>-->
                                                
                                                <option value="3">Administrator</option>
                                            </select>
                                        </div>
                                        <div class="form-group required" id="service_combo_div">
                                            <label class="control-label">Select Branch:</label>
                                            <select name="select_branch" id="select_branch" class="form-control" required>
                                                <option value="Horana">Horana</option>
                                                <option value="Bulathsinghala">Bulathsinghala</option>
                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">Full Name:</label>
                                                <input type="text" name="full_name" id="full_name" placeholder="Enter Full Name" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="form-group required">
                                                <label class="control-label">E-mail:</label>
                                                <input type="email" name="email" id="email" placeholder="Enter E-mail" class="form-control" required/>
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
                                                <input type="submit" class="btn btn" name="user_account_save" id="custcontinue" value="Create Account">
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
    if (isset($_POST['user_account_save'])) {
        $user_type = filter_input(INPUT_POST, 'select_user_type');
        $branch = filter_input(INPUT_POST, 'select_branch');
        $name = filter_input(INPUT_POST, 'full_name');
        $user_email = filter_input(INPUT_POST, 'email');
        $new_password = filter_input(INPUT_POST, 'new_password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');

        if ($user_type != "" && $branch != "" && $name != "" && $user_email != "" && $new_password != "" && $confirm_password != "") {
            if ($new_password == $confirm_password) {

                $query = "INSERT INTO userlogin (user_name,user_email,user_password,user_type,branch,user_status) VALUES (
                '$name',
                '$user_email',
                '$confirm_password',
                '$user_type',
                '$branch',
                '0')";

                $run_query = mysqli_query($d_bc, $query);
                if ($run_query) {
                    echo "<script>alert('User account has been created');</script>";
                } else {
                    echo "<script>alert('Error while creating an account,Please check the data');</script>";
                }
            } else {
                echo "<script>alert('Password is not matched,Please enter valid Password');</script>";
            }
        }
    }
    ?>
    <script type="text/javascript">
        function backtoHome(){
            window.location.href="../index.php";
        }
    </script>
</html>
