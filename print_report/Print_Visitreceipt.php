<!DOCTYPE html>
<html>
    <head>
        <script src="jquery.js" type="text/JavaScript" language="javascript"></script>
        <script src="jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>

        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            
            
            tr:nth-child(even){background-color: #f2f2f2}

            th {
                background-color: #4CAF50;
                color: white;
            }
        </style>

    </head>
    <body style=" margin:0px;background:#F5F5F5;">

        <?php
        $conn = mysqli_connect("77.104.142.97", "ayolanin_dev", "WelComeDB1129", "ayolanin_datahost");
        if (mysqli_connect_errno()) {
            echo "Falied to Connect the Database" . mysqli_connect_error();
        }
        global $conn;


        $sql_query = "SELECT SQL_CALC_FOUND_ROWS `ser_vehicles_pre_id`,`vehicle_type_id`,`model_year`,`model`,`type`,`min_value`,`max_value` FROM`ser_vehicles_pre`";
        $result = mysqli_query($conn, $sql_query);
        if (!($result)) {

            // stop execution and display error message
            die(mysql_error());
        }
        $rows = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT FOUND_ROWS() AS rows'));
        ?>

        <div class="wrapper" style="width: 1000px;padding-left: 10px;">
            <div style="width: 1000px;float: left;">
               <!-- <a href="javascript:void(0);" id="print_button1" style="width: 100px; padding: 5px 8px 5px 8px;text-align: center;float: right;background-color: #02A6D8;color: #fff;text-decoration: none; margin: 10px;">Print Full Page</a> -->
                <a href="javascript:void(0);" id="print_button2" style="width: 130px; padding: 5px 8px 5px 8px;text-align: center;float: right;background-color: #02A6D8;color: #fff;text-decoration: none; margin: 10px;">Print Header</a>
                <a href="javascript:void(0);" id="print_button3" style="width: 130px; padding: 5px 8px 5px 8px;text-align: center;float: right;background-color: #02A6D8;color: #fff;text-decoration: none; margin: 10px;">Print Body</a>
            </div>
            <br/>
            <div class="content" style="width: 950px;height:auto;border: solid 2px #333;text-align: center; padding-bottom: 10x;margin: 20px;">
                <div  class="header" style="background-color: #919191">
                    <img src="logo.png" style="overflow: hidden; height: 50px; width: 50px;margin-right: 30px;padding-left:  50x; margin-bottom: 20px;">
                    <h3 style="size: 65px; font-family: sans-serif">Ayolan Investments </h3>
                    <h4 style="size: 45px; font-family: sans-serif">View Vahicle Rate</h4>
                </div>





                <div style=" border-collapse: collapse; width: 100%;">
                    <div id="bike_div" style="display: block;background: white;">
                        <div style="padding-left: 50px;padding-right: 50px;" id="printarea">


                            <table style=" border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: left; padding: 8px; background-color: #4CAF50;color: white;">Id</th>
                                        <th style="text-align: right; padding: 8px; background-color: #4CAF50;color: white;">Model Year</th>
                                        <th style="text-align: right; padding: 8px; background-color: #4CAF50;color: white;">Model</th>
                                        <th style="text-align: right; padding: 8px; background-color: #4CAF50;color: white;">Type</th>
                                        <th style="text-align: right; padding: 8px; background-color: #4CAF50;color: white;">Min Value</th>
                                        <th style="text-align: right; padding: 8px; background-color: #4CAF50;color: white;">Max Value</th>
                                    </tr>
                                </thead>
                                <tbody id="bike_tbody">
                                    <?php $index = 0; ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr style="border: 2px #009688 solid;" <?php echo $index++ % 2 ? ' class="even"' : '' ?>>

                                            <td style="text-align: left;padding: 8px; overflow-x:auto;background-color: #02A6D8;color: #fff;" ><?php echo $row['ser_vehicles_pre_id'] ?></td>
                                            <td style="padding-left:10px;  text-align: right; overflow-x:auto;background-color: #02A6D8;color: #fff;"><?php echo $row['model_year'] ?></td>
                                            <td style="padding-left:10px;  text-align: right; overflow-x:auto;background-color: #02A6D8;color: #fff;"><?php echo $row['model'] ?></td>
                                            <td style="padding-left:10px;  text-align: right; overflow-x:auto;background-color: #02A6D8;color: #fff;"><?php echo $row['type'] ?></td>
                                            <td style="padding-left:10px;  text-align: right; overflow-x:auto;background-color: #02A6D8;color: #fff;"><?php echo $row['min_value'] ?></td>
                                            <td style="padding-left:10px;  text-align: right;overflow-x:auto;background-color: #02A6D8;color: #fff;"><?php echo $row['max_value'] ?></td>

                                        </tr>

                                    <?php endwhile ?>
                                </tbody>
                            </table>



                        </div>
                    </div>



                </div>
            </div>
       
        

                <div class="footer" style="width: 950px;height: 80px;text-align: center; padding: 5px;margin: 20px;">
                    <hr/>
                    <h5>Ayolan Investments</h5>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $("#print_button1").click(function () {
                        var mode = 'iframe'; // popup
                        var close = mode == "popup";
                        var options = {mode: mode, popClose: close};
                        $("div.wrapper").printArea(options);
                    });
                    $("#print_button2").click(function () {
                        var mode = 'iframe'; // popup
                        var close = mode == "popup";
                        var options = {mode: mode, popClose: close};
                        $("div.header").printArea(options);
                    });
                    $("#print_button3").click(function () {
                        var mode = 'iframe'; // popup
                        var close = mode == "popup";
                        var options = {mode: mode, popClose: close};
                        $("div.content").printArea(options);
                    });
                });

            </script>
    </body>
</html>