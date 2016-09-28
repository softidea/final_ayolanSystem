<?php


define('db_host', '77.104.142.97');
define('db_port', '3306');
define('db_user', 'ayolanin_dev');
define('db_password', 'WelComeDB1129');
define('db_database', 'ayolanin_test');

//define('db_host', 'localhost');
//define('db_port', '3306');
//define('db_user', 'root');
//define('db_password', '1234');
//define('db_database', 'ayolanin_datahost');


$d_bc = mysqli_connect(db_host, db_user, db_password, db_database)

or die(
        header("Location:../errors/error_page.php")
        );

mysqli_set_charset($d_bc, "UTF8");


