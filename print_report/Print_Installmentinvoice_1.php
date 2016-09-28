<!DOCTYPE html>
<html>
    <head>
        <script src="jquery.js" type="text/JavaScript" language="javascript"></script>
        <script src="jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>

        <style>
            
            
             div.container {
                width: 100%;
                border: 1px solid gray;
            }

            header{
                padding: 2em;
                height:120px;
                color: black;
                padding-top: 0px;
                margin: 0px;
                clear: left;
                text-align: center;
            }
            footer {
                padding: 1px;
                color: black;
                /*background-color: #009688; */
                clear: left;
                text-align: center;
            }
            img{
                height: 100px;
                width: 100px;
                float: left;
            }
            article {
                margin-left: 170px;
                padding: 1em;
                overflow: hidden;
            }
            h1 {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 20px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                line-height: 26.4px;
            }
            h3 {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;
                font-weight: 500;
                line-height: 15.4px;
            }
            #address1 {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                /*line-height: 20px;*/

            }
            #address2 {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                /*line-height: 20px;*/

            }
            #address3 {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                /*line-height: 20px;*/
                /*margin-bottom: 40px;*/   
            }
            p {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 13px;
                font-style: normal;
                font-variant: normal;
                font-weight: 50;
                line-height: 15px;
            }
            footer {
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 13px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                line-height: 13px;
            }
            tr{
                font-family: sans-serif,Tahoma, Verdana, Segoe;
                font-size: 14px;
                padding-bottom: 5px;
                margin: 10px;

            }
            
        </style>

    </head>
    <body style=" margin:0px;background:#F5F5F5;">
        <div class="container">
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
                    <header>
                <img src="http://ayolaninvestments.com/system/assets/images/admin/ayolan_logo.png" alt="img" style="width: 100px;height: 100px;"/>


                <h1 style="font-family: sans-serif,Tahoma, Verdana, Segoe">CUSTOMER INVOICE | AYOLAN INVESTMENTS </h1>
                <hr/>
                <table style="float: left;margin: 0px;padding: 0px;">
                    <tr style="text-align: left">
                        <td>Hot Line:<br/> +94 77 27 77 770</td>
                    </tr>
                    <tr style="text-align: left">
                        <td>Main Branch:<br/> +94 034 22 65 107</td>
                    </tr>
                </table>
                <table style="width: 300px;float:right;font-family: sans-serif,Tahoma, Verdana, Segoe;">
                    <tr>
                        <td style="width:50px;text-align: right;">
                            <address id="address1">
                                Head Office<br/>
                                No: 141,<br/>
                                Rathnapura Rd,<br/>
                                Horana.
                            </address>
                        </td>
                        <td style="width:50px;text-align: right;">
                            <address id="address2">
                                Branch:<br/>
                                No: 18,<br/>
                                Horana Rd,<br/>
                                Bulathsinhale.
                            </address>
                        </td>
                        <td style="width:50px;text-align: right;">
                            <address id="address3">
                                Branch:<br/>
                                No: 53,<br/>
                                Horana Rd,<br/>
                                Piliyandala.
                            </address>
                        </td>
                    </tr>
                </table>
            </header>
            <hr style="padding-top: 0px;margin: 0px;"/>
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
        </div>
    </body>
</html>