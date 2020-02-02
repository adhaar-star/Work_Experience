<a data-uk-offcanvas="{target:'#my-id'}"><span> </span> </a>
<!-- This is the off-canvas sidebar -->
<div id="my-id" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
        <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
            <?php if (isset($this->authority->user->user_id) && is_object($this->authority->user)) { ?>
                <li class="uk-link uk-text-center "
                    onclick="window.location.href='<?php echo base_url() ?>users/profile/<?php echo $this->authority->user->user_username ?>';">
                    <br/><img
                        class="uk-border-circle"
                        src="<?php echo display_image_path($this->authority->user->user_photo) ?>"
                        title="<?php echo $this->authority->user->user_username ?>"/><br/>
                    <span class=" uk-text-large uk-width-1-1 text-white uk-text-center">
                                    <?php echo $this->authority->user->user_username ?>
                            </span>
                </li>
                <li class="uk-text-center">
                    <span class="uk-text-large uk-width-1-1 text-white uk-align-center">
                                    <i class="uk-icon-star" style="color: #ffff00"></i> <?php echo $points ?>
                        Points
                    </span>
                </li>
                <li>&nbsp;</li>
            <?php } ?>
            <li><a href="<?php echo base_url() ?>"><i class="uk-icon-home uk-icon-medium"></i> Home</a></li>
            <li><a href="<?php echo site_url('articles/create') ?>"><i class="uk-icon-edit uk-icon-medium"></i> Add Video</a></li>

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