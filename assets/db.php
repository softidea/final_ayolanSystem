<?php

$db_conx = mysqli_connect("localhost", "worldoi5_adam", "xxxxxxxx", "worldoi5_social");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} else {
    echo "Successful database connection, happy coding!!!";
}
?>