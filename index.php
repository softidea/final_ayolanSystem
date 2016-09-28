<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="assets/css/login.css">
        <?php include './assets/include/head.php'; ?>

        <meta charset="utf-8">
        <title>User | Login</title>

        <link rel="icon" href="favicon.ico">
        <script type="text/javascript">
            function setregpanel()
            {

                if (document.getElementsById('panelreguser').style.display = "none")
                {
                    document.getElementsById('panelreguser').style.display = "block";
                    document.getElementsById('panelloginusers').style.display = "none";
                }
            }
            document.onkeydown = function (e) {
                if (e.ctrlKey &&
                        (e.keyCode === 67 ||
                                e.keyCode === 86 ||
                                e.keyCode === 85 ||
                                e.keyCode === 117)) {
                    alert('not allowed');
                    return false;
                } else {
                    return true;
                }
            };
        </script>
    </head>
    <body oncontextmenu="return false">
        <!--Container Panel Start-->
        <div class="container">
            <!--Login Panel Start-->
            <div id="panelloginusers">
                <div class="row">
                    <div class="col-sm-6"'>
                        <div>
                            <img class="log-wap"src="http://fourgenius.com/ayolan_src/images/login/Logo500x500_transpernt.png">
                        </div>
                    </div>
                    <aside id="column-right" class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading" style="background-color: #004D40;">
                                <h3 class="panel-title"><h2 style="color: white;">AYOLAN | INVESTMENTS</h2></h3>
                                <p class="sub_topic">Finance Management System</p>
                            </div>
                            <div class="panel-body">
                                <form action="controller/user_login.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label" for="input-email">E-Mail Address :</label>
                                        <input type="email" name="user_email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" min="10" max="100" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="input-password">Password :</label>
                                        <input type="password" autocomplete="Off" name="user_password" placeholder="Password" id="input-password" class="form-control" min="8" max="50" required/>
                                        <a href="controller/user_forgetPassword.php"><p id="para_forget">Did you forgot your password?</p></a>

                                    </div>

                                    <input type="submit" name="login_process" value="Login Here" class="btn" id='btn_login'/>

                                </form>
                            </div>
                            <div class="panel-footer">Powered by : <a href="http://www.fsczone.com/">Softidea Solutions</a></div>
                        </div>
                    </aside>
                </div>
            </div>
            <!--Login panel start-->
        </div>
        <!--Container Panel Start-->

        <?php include 'assets/include/footer.php'; ?>

    </body>
    <style>
        #para_forget
        {
            text-decoration: none;
            color:#004D40;
            margin-top: 8px;
            font-size: 12px;  
        }
        .panel-footer
        {
            background-color: #004D40;
            color: #CFD8DC;
            font-weight: 500;
            font-size: 12px;
            text-align: center;
        }
        .sub_topic
        {
            color: white;
            font-size:14px;
        }
        #btn_login
        {
            background-color: #009688;
            color: white;
        }
        #btn_login:hover
        {
            background-color: #004D40;
        }

        body
        {font-family: 'Source Sans Pro', sans-serif;background-image: url('http://fourgenius.com/ayolan_src/images/login/back.jpg');background-repeat: none;}
        .panel{border:1px solid #004D40;}
        #column-right
        {
            float: right;
            margin-top: 90px;
        }
        .log-wap
        {
            width: 350px;
            height: 350px;
            margin-top: 85px;
            margin-left: 130px;
        }
    </style>
</html>