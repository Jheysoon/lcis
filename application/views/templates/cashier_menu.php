              
                <li class="list-group-item">
                    <a class="menu" href="<?php echo base_url('cshr_OpenCashWindow'); ?>">
                        <span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp; Cashier Log In - Start of Duty
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="menu">
                        <span class="glyphicon glyphicon-file"></span>&nbsp; &nbsp; Receive Payments
                    </a>

                    <ul class="sub-menu">
                        <li class="li-sub-menu">
                            <a class="menu" href="<?php echo base_url('cshr_addEnrolPayment'); ?>">
                                <span class="glyphicon glyphicon-chevron-right"></span>&nbsp; &nbsp; Enrolment
                            </a>
                        </li>
                        <li class="li-sub-menu">
                            <a class="menu" href="<?php echo base_url('cshr_addExamPayment'); ?>">
                                <span class="glyphicon glyphicon-chevron-right"></span>&nbsp; &nbsp; Examination
                            </a>
                        </li>
                        <li class="li-sub-menu">
                            <a class="menu" href="<?php echo base_url('cshr_listServiceRequested'); ?>">
                                <span class="glyphicon glyphicon-chevron-right"></span>&nbsp; &nbsp; Services
                            </a>
                        </li>
                    </ul>

                <li class="list-group-item">
                    <a class="menu" href="<?php echo base_url('cshr_addCashOut'); ?>">
                        <span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp; Cash Out
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="menu" href="<?php echo base_url('cshr_viewCashierMovement'); ?>">
                        <span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp; Cashier Log Out - End of Duty
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="menu" href="<?php echo base_url('account'); ?>">
                        <span class="glyphicon glyphicon-cog"></span>&nbsp; &nbsp; Account Settings
                    </a>
                </li>

