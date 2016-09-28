<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
require_once '../db/newDB.php';


$user_account_search_value = filter_input(INPUT_GET, 'user_account_search_value');
$user_account_id = filter_input(INPUT_GET, 'user_account_id');
$account_status = filter_input(INPUT_GET, 'status');


if ($user_account_search_value != "") {
    global $conn;
    $query = "SELECT * FROM userlogin WHERE user_type='$user_account_search_value'";
    $run_query = mysqli_query($conn, $query);
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $account_id = $row['iduser'];
            $name = $row['user_name'];
            $email = $row['user_email'];
            $user_type = $row['user_type'];
            $branch = $row['branch'];
            $status = $row['user_status'];

            echo "<tr>";
            echo "<td>$account_id</td>";
            echo "<td>$name</td>";
            echo "<td>$email</td>";
            echo "<td>$user_type</td>";
            echo "<td>$branch</td>";
            if ($status == 1) {
                echo "<td><select name='user_status' id='user_status' class='form-control' onchange='changeAcccountStatus($account_id,this.value);'>
                                                    <option value='1'>Active</option>
                                                    <option value='0'>Deactive</option>
                                                </select></td>";
            } else if($status==0){
                echo "<td><select name='user_status' id='user_status' class='form-control' onchange='changeAcccountStatus($account_id,this.value);'>
                                                    <option value='0'>Deactive</option>
                                                    <option value='1'>Active</option>
                                                </select></td>";
            }


            echo "</tr>";
        }
    }
}
if ($user_account_id != "" && $account_status != "") {
    global $conn;
    $query = "UPDATE userlogin SET user_status = '$account_status' WHERE iduser = '$user_account_id'";
    $run_query = mysqli_query($conn, $query);
    if ($run_query) {
        echo "Account status successfully updated";
    } else {
        echo "Error while updating the account status,Please check the Values";
    }
}
?>