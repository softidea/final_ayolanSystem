<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../../db/mysqliConnect.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View User Account</title>
       <?php include '../../assets/include/head.php'; ?>
        <link rel="stylesheet" type="text/css" href="../../assets/css/user_common/user_common.css"/>
        <script type="text/javascript">
            function searchAccounts() {
                var value = document.getElementById('select_account_type').value;
                if (value != "") {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else { // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            if (xmlhttp.responseText != "") {
                                document.getElementById('account_tbody').innerHTML = "";
                                document.getElementById('account_tbody').innerHTML = xmlhttp.responseText;
                            }
                        }
                    }
                    xmlhttp.open("GET", "../../controller/admin_search_user_accounts.php?user_account_search_value=" + value, true);
                    xmlhttp.send();
                }
            }
        </script>
    </head>
    <body onload="searchAccounts();">
        <!--Service View Main Panel-->
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelheading">
                            <h3 class="panel-title">View User Accounts</h3>
                        </div>
                        <div class="panel-body" style="background-color: #FAFAFA;">
                            <div class="col-sm-6">
                                <fieldset id="account">
                                    <legend>Search Option 01</legend>
                                    <div class="form-group required">
                                        <label class="control-label">Select Account Type:</label>
                                        <select name="select_account_type" id="select_account_type" class="form-control" required onchange="searchAccounts();">
                                            <!--<option value=""> --- Please Select --- </option>-->
                                            <option value="1">User</option>
                                            <option value="2">Manager</option>
                                            <option value="3">Administrator</option>
                                        </select>
                                </fieldset>
                            </div>

                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>No</th>
                                            <th>Full Name</th>
                                            <th>E-mail</th>
                                            <th>User Type</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="account_tbody">

                                    </tbody>
                                </table> 
                                <input type="button" class="btn btn" name="back_home" id="custcontinue" value="Back Home" onclick="backtoHome();">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script type="text/javascript">
    function backtoHome() {
        window.location.href = "../index.php";
    }
    function readValues(x) {
        var cel = x.cells[6].innerHTML;
        var user_id = cel;
        alert(user_id);
        // window.location.href = "customer_updateinfo.php?nic=" + cus_nic;
    }
    function changeAcccountStatus(value, status) {
        alert(value + "###" + status);
        if (value != "" && status != "") {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    if (xmlhttp.responseText != "") {
                        if (xmlhttp.responseText == "Account status successfully updated") {
                            alert(xmlhttp.responseText);
                            searchAccounts();
                        } else if (xmlhttp.responseText == "Error while updating the account status,Please check the Values") {
                            alert(xmlhttp.responseText);
                        }
                    }
                }
            }
            xmlhttp.open("GET", "../../controller/admin_search_user_accounts.php?user_account_id=" + value + "&status=" + status, true);
            xmlhttp.send();
        }





    }
</script>
<script type="text/javascript">
    function backtoHome() {
        window.location.href = "../index.php";
    }
</script>
</html>
