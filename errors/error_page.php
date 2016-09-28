<?php

session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
    <center>
        <h2 style="color: red">Directory access is forbidden.</h2>
        <img src="access-denied.jpg"/>
        
        <a href="../index.php">Back to Home</a>
    </center>
    </body>
</html>
