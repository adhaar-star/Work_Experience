<div class="uk-panel-box uk-panel-box-secondary" >
    <span class="uk-text-small uk-badge-warning uk-badge">
    Version: <?php echo HDPHP_VERSION ?>
    </span>
    <br/>
    <span class="uk-text-small uk-badge-success uk-badge">Admin Functionality</span>
    <br/>
    <ul class="uk-nav uk-text-bold uk-nav-side uk-nav-parent-icon" data-uk-nav="">
        <li class="<?php echo ($this->uri->segment(2) == 'articles') ? 'uk-active' : ''; ?>">
            <a href="<?php echo site_url('admin/articles') ?>"><i class="uk-icon-youtube-play"></i> Videos</a></li>
        <li class="<?php echo ($this->uri->segment(2) == 'users') ? 'uk-active' : ''; ?>"><a
                href="<?php echo site_url('admin/users') ?>"><i class="uk-icon-users"></i> Users</a></li>
        <li class="<?php echo ($this->uri->segment(2) == 'categories') ? 'uk-active' : ''; ?>"><a
                href="<?php echo site_url('admin/categories') ?>"><i class="uk-icon-folder-open"></i> Languages</a></li>
        <li class="<?php echo ($this->uri->segment(2) == 'custom_style') ? 'uk-active' : ''; ?>"><a
                href="<?php echo site_url('admin/custom_style') ?>"><i class="uk-icon-paint-brush"></i> Custom Style</a>
        </li>
        <li class="<?php echo ($this->uri->segment(2) == 'setting') ? 'uk-active' : ''; ?>">
            <a href="<?php echo site_url('admin/setting') ?>"><i class="uk-icon-cog"></i> Setting</a>
        </li>
    </ul>

</div>