<?php
$ss = basename($_SERVER['REQUEST_URI']);
if ($ss == '') {
    ?>
    <section id="banner" class="banner">
        <div class="bg-color">
            <?php
        } else {
            ?>
            <section class="banner">
                <div class="bg-color2">		
                    <?php
                }
                ?>	
                <header class="register">
                    <div class="container-wide">
                        <div class="left">
                            <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(asset('new_images/common/logo.png')); ?>" width="140"></a>
                        </div>
                        <div class="right hide-on-large-only mobile-menu-icon">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                        <div class="right nav-container">
                            <div class="hide-on-large-only mobile-menu-close">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </div>
                            <nav class="z-depth-0">
                                <ul>
                                    <li>
                                        <a href="#" class='dropdown-button' data-activates='dropdown' data-beloworigin="true">Features <span class="fa fa-angle-down right"></span></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('/pricing')); ?>">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="#" class='dropdown-button' data-activates='dropdown1' data-beloworigin="true">How it Works <span class="fa fa-angle-down right"></span></a>
                                    </li>
                                    <li>
                                        <a href="#">Customers</a>
                                    </li>
                                    <li>
                                        <a href="#">Support</a>
                                    </li>
                                </ul>
                                <ul id='dropdown' class='dropdown-content'>
                                    <li><a href="#">All Features</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Task Management</a></li>
                                </ul>
                                <ul id='dropdown1' class='dropdown-content'>
                                    <li><a href="#">Plan</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Collaborate</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Organize</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Deliver</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </header>
                <?php
                if ($ss == '') {
                    ?>

                    <div class="container">
                        <div class="row">
                            <div class="banner-info">
                                <div class="banner-text text-center">
                                    <h1 class="lead">A portfolio and project management software to <b>plan</b>, <b>analyze</b>, <br> <b>execute</b> and <b>deliver</b> projects of all sizes.</h1>
                                    <p><a class="btn btn-default btn-lg" role="button">Give PPMHub a try. It's Free!</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section> 