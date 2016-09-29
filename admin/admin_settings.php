<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['user_email']) && ($_SESSION['user_status']==="Active") && ($_SESSION['user_typel'] === "Admin")) {
}else{
    header("Location:../index.php");
    
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
