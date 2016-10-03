<?php
session_start();

if (isset($_SESSION['user_email']) && ($_SESSION['user_status']==="Active") && ($_SESSION['user_typel'] === "Admin")) {
}else{
    header("Location:../index.php");
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Administrator | Home</title>
        <?php include '../assets/include/head.php'; ?>


        <link rel="stylesheet" href="../assets/css/admin.css">

    </head>
    <body>
        <!--Navigation Bar-->
        <nav id="top">
            <div class="container">
                <div id="top-links" class="nav pull-right">
                    <ul class="list-inline">
                        <li>
                            <a href="#">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <span class="hidden-xs hidden-sm hidden-md"><?php echo $_SESSION['user_username'];  ?></span>
                        </li>
                        <li><a href="../admin/user_management/update_user_account.php"  title="User Management"><i class="glyphicon glyphicon-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $_SESSION['user_typel']; ?> Account</span></a></li>
                        <li><a href=""  title="User Management"><i class="glyphicon glyphicon-object-align-vertical"></i> <span class="hidden-xs hidden-sm hidden-md">Re-Processes</span></a></li>
                        <li><a href=""  title="User Management"><i class="glyphicon glyphicon-sort-by-attributes"></i> <span class="hidden-xs hidden-sm hidden-md">Privileges</span></a></li>
                        <li><a href=""  title="User Management"><i class="glyphicon glyphicon-print"></i> <span class="hidden-xs hidden-sm hidden-md">Reports</span></a></li>
                        <li><a href="../user/user_home.php"  title="switch user"><i class="glyphicon glyphicon-transfer"></i> <span class="hidden-xs hidden-sm hidden-md">Switch to User</span></a></li>
                        <li><a  href="../controller/co_logout.php" style="text-decoration: none;"><i class="glyphicon glyphicon-off"></i> <span class="hidden-xs hidden-sm hidden-md">Logout</span></a></li>	
                    </ul>
                </div>
            </div>
        </nav>
        <!--Navigation Bar-->

        <!--Administrative Panel-->
        <div class="container">
            <!--Process Div Panel Set-->
            <div class="row">
                <div class="admin_wapper">
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">User Management</h3>
                            </div>
                            <div class="panel-body">
                                <img class="panelimage" src="../assets/images/admin/user management.png"/>
                            </div>
                            <div class="list-group">

                                <a href="../admin/user_management/administrator_account.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Create New Administrator Account</button></a>
                                <a href="../admin/user_management/manager_account.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Create New Manager Account</button></a>
                                <a href="../admin/user_management/user_account.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Create New User Account</button></a>
                                <a href="../admin/user_management/view_user_account.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">View All Accounts</button></a>
                                <a href="../admin/user_management/update_any_account.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Update User Account</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Update Administrator Account</button></a>
                            </div>
                            <div class="panel-footer">
                                <div style="height: 15px;clear: both;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Privilege Management(Pending)</h3>
                            </div>
                            <div class="panel-body">
                                <img class="panelimage" src="../assets/images/admin/privillege.png"/>
                            </div>
                            <div class="list-group">
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Allocate User Privileges</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Allocate Manager Privileges</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Restricted Processes</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Common Pages & Links</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Administrator Privileges</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Update Privileges</button></a>
                            </div>
                            <div class="panel-footer">
                                <div style="height: 15px;clear: both;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Report Management</h3>
                            </div>
                            <div class="panel-body">
                                <img class="panelimage" style="height: 140px;" src="../assets/images/admin/report.png"/>
                            </div>
                            <div class="list-group">
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Vehicle Lease Reports</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Land Pawn Reports</button></a>
                                <a href="user_management/view_dailyIncome_report.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Customer Income Reports</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Vehicle Rate Reports</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Land Rate Reports</button></a>
                                <a href="" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">User Reports</button></a>
                            </div>
                            <div class="panel-footer">
                                <div style="height: 15px;clear: both;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="panelheading">
                                <h3 class="panel-title">Re-Process Management</h3>
                            </div>
                            <div class="panel-body">
                                <img class="panelimage" src="../assets/images/admin/re-process.png"/>
                            </div>
                            <div class="list-group">
                                <a href="../customer/customer_registration.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">New Re-Process Registration</button></a>
                                <a href="../customer/customer_registration.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">View Re-Processes</button></a>
                                <a href="../customer/customer_registration.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Release Re-Processes</button></a>
                                <a href="../customer/customer_registration.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Check Available Re-Processes</button></a>
                                <a href="../customer/customer_registration.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Settlement Reports</button></a>
                                <a href="../customer/customer_registration.php" style="text-decoration: none;"><button type="button" class="list-group-item" id="listButton">Re-Process Reports</button></a>
                            </div>
                            <div class="panel-footer">
                                <div style="height: 15px;clear: both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Process Div Panel Set-->
        </div>
        <!--Administrative Panel-->
        <?php include '../assets/include/footer.php'; ?>
    </body>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="http://bootsnipp.com/dist/scripts.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <style>

    </style>
</html>