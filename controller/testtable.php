<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location:../index.php");
}


?>
<html>

    <head>



    </head>
    <body>
        <table boader="1">
            <?php
          

            $ido = 1;

            $queryall = "CALL all_users('" . $ido . "')";
            $result = mysqli_query($d_bc, $queryall);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <tr>
                <td>
                    <?php echo $row['user_email'];?>
                </td>
            </tr>
                <?php
            }
            ?>
        </table>

    </body>
</html>