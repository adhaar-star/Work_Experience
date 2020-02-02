<a data-uk-offcanvas="{target:'#my-id'}"><span> </span> </a>
<!-- This is the off-canvas sidebar -->
<div id="my-id" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
        <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
            <?php if (isset($this->authority->user->user_id) && is_object($this->authority->user)) { ?>
                <li class="uk-link"
                    onclick="window.location.href='<?php echo base_url() ?>users/profile/<?php echo $this->authority->user->user_username ?>';">
                    <br/><img
                        class="uk-border-circle uk-align-center"
                        src="<?php echo display_image_path($this->authority->user->user_photo) ?>"
                        title="<?php echo $this->authority->user->user_username ?>"/>

                    <span class="uk-badge uk-badge-success uk-text-large uk-width-1-1">
                                    <i class="uk-icon-star" style="color: #ffff00"></i><?php echo $points ?><br/>
                                    Points
                            </span>
                    <span class="uk-badge uk-badge-danger uk-text-large uk-width-1-1">
                                    <?php echo $this->authority->user->user_username ?>
                            </span>

                </li>
            <?php } ?>
            <li>&nbsp;</li>
            <li><a href="<?php echo base_url() ?>"><i class="uk-icon-home uk-icon-medium"></i> Home</a></li>
            <li class="uk-parent">
                <a href="#">
                    <i class="uk-icon-folder-open uk-icon-medium"></i>
                    Categories
                </a>
                <ul class="uk-nav-sub uk-text-left uk-text-nowrap uk-height-viewport">
                    <li class="uk-margin-bottom">
                        <a href="<?php echo base_url() ?>"><i class="uk-icon-navicon"></i> All</a>
                    </li>
                    <?php foreach ($categories as $row) { ?>
                        <li class="uk-margin-bottom">
                            <a href="<?php echo site_url('articles/category/' . $row->category_name) ?>">
                                <i class="uk-icon-<?php echo $row->category_icon_code ?>"></i> <?php echo $row->category_name ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="<?php echo site_url('articles/most-views') ?>"><i class="uk-icon-star uk-icon-medium"></i> Most
                    Viewed</a></li>
            <li><a href="<?php echo site_url('articles/random') ?>"><i class="uk-icon-random uk-icon-medium"></i> Random
                    </a></li>
            <li><a href="<?php echo site_url('articles/create') ?>"><i class="uk-icon-edit uk-icon-medium"></i> Ask A Question</a></li>

            <?php if (isset($this->authority->user->user_id) && is_object($this->authority->user)) { ?>
                <li>&nbsp;</li>
                <li class="uk-text-center" onclick="window.location.href = '<?php echo site_url('users/sign_out') ?>'">
                    &nbsp;
                    <span class="uk-button uk-button-danger uk-width-1-1">
                         Logout
                    </span>
                </li>
            <?php } else { ?>
                <li><a href="<?php echo site_url('articles/create') ?>"><i class="uk-icon-medium uk-icon-sign-in"></i>
                        Login</a></li>
            <?php } ?>
        </ul>

    </div>
</div>