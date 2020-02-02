<div id='main-nav-bg'></div>
<?php
$action = $this->uri->segment(1);
?>
<nav id='main-nav'>
    <div class='navigation'>
        <ul class='nav nav-stacked'>
            <li class='<?php echo ($action == 'home') ? "active" : ""; ?>'>
                <a href='<?php echo site_url('home'); ?>'>
                    <i class='icon-dashboard'></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class='<?php echo ($action == 'skills') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/skills'>
                    <i class='icon-cogs'></i>
                    <span>Manage Skills</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'users') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/users'>
                    <i class='icon-group'></i>
                    <span>Manage Users</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'users_bank_details') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/users_bank_details'>
                    <i class='icon-user'></i>
                    <span>Manage User's Bank Details</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'ads') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/ads'>
                    <i class='icon-film'></i>
                    <span>Manage Ads</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'countries') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/countries'>
                    <i class='icon-globe'></i>
                    <span>Manage Countries</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'banks') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/banks'>
                    <i class='icon-suitcase'></i>
                    <span>Manage Banks</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'branches') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/branches'>
                    <i class='icon-sitemap'></i>
                    <span>Manage Branches</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'payment') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/payment'>
                    <i class='icon-money'></i>
                    <span>Manage Payments</span>
                </a>
            </li>
            
            <li class='<?php echo ($action == 'complaints') ? "active" : ""; ?>'>
                <a href='<?php echo base_url() ?>index.php/complaints'>
                    <i class='icon-thumbs-down'></i>
                    <span>Manage Complaints</span>
                </a>
            </li>
        </ul>
    </div>
</nav>