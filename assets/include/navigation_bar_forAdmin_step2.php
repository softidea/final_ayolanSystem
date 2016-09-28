<!--Customer Navigation Bar-->
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Ayolan Investments</a>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo('../../user/user_home.php'); ?>" style="text-decoration: none;">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Customer<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ('../../customer/customer_registration.php'); ?>" style="text-decoration: none;">New Registration</a></li>
                            <li><a href="<?php echo ('../../customer/customer_updateinfo'); ?>" style="text-decoration: none;">Update Customer</a></li>
                            <li><a href="<?php echo ('../../customer/customer_view_2.php'); ?>" style="text-decoration: none;">View Customers</a></li>
                            <li><a href="<?php echo ('../../customer/customer_installment.php'); ?>" style="text-decoration: none;">Pay Installment</a></li>
                            <li><a href="<?php echo ('../../customer/customer_tieup.php'); ?>" style="text-decoration: none;">Customer Tie-Up</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ('../../customer/customer_addlease.php'); ?>" style="text-decoration: none;">Add a Lease</a></li>
                            <li><a href="<?php echo ('../../customer/customer_addpawn.php'); ?>" style="text-decoration: none;">Add a Pawn</a></li>
                            <li><a href="<?php echo ('../../customer/customer_serviceview.php'); ?>" style="text-decoration: none;">View Leasings</a></li>
                            <li><a href="<?php echo ('../../customer/customer_serviceview.php'); ?>" style="text-decoration: none;">View Land Pawns</a></li>
                            <li><a href="<?php echo ('../../customer/customer_installment.php'); ?>" style="text-decoration: none;">Settle Service</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Installments<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ('../../customer/customer_installment.php'); ?>" style="text-decoration: none;">Pay Installment</a></li>
                             <li><a href="<?php echo ('../../land_pawn_payment.php'); ?>" style="text-decoration: none;">Pay Pawn Installment</a></li>
                            <li><a href="<?php echo ('../../customer/customer_installment.php'); ?>" style="text-decoration: none;">View Installment</a></li>
                            <li><a href="<?php echo ('../../customer/customer_installment.php'); ?>" style="text-decoration: none;">Update Installment</a></li>
                            <li><a href="<?php echo ('../../customer/customer_installment.php'); ?>" style="text-decoration: none;">Settle Service</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Re-Process Management<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ('../customer/addsis.php'); ?>">Add New Re-process</a></li>
                            <li><a href="<?php echo ('../customer/viewsis.php'); ?>">View Re-Process</a></li>
                            <li><a href="<?php echo ('../customer/viewsis.php'); ?>">Release Sis</a></li>
                            <!--<li><a href="<?php echo ('../customer/checksis.php'); ?>">Check Re-Process</a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ('customer_view.php'); ?>">Customer Report</a></li>
                            <li><a href="<?php echo ('customer_serviceview.php'); ?>">Service Report</a></li>
                            <li><a href="<?php echo ('customer_installment.php'); ?>">Installment Report</a></li>
                            <li><a href="<?php echo ('customer_installment.php'); ?>">Service Settle Report</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="q">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>        
            </div>
        </nav>
    </div>
</div>
<!--Customer Navigation Bar-->