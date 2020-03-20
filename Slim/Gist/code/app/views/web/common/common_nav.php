<div class="menu_list">
        <ul>
        <?php   if (!empty($_COOKIE['token'])) {  ?>
           <li><a href="profile/edit" title="Profile">Profile</a></li>
        <?php } else{ ?>
            <li><a href="#" title="Sign Up">Sign Up</a></li>
            <?php } ?>
          <?php   if (!empty($_COOKIE['token'])) {  ?>
          <li><a href="<?= $app['base_url']; ?>candidate/logout" title="Logout">Logout</a></li>
          <?php } else {?>
            <li><a href="<?= $app['base_url']; ?>candidate/login" title="Login">Login</a></li>
            <?php } ?>
            <li><a href="#" title="Support">Support</a></li>
            <li><a href="#" title="Colleges">Colleges</a></li>
            <li><a href="#" title="Employers">Employers</a></li>
            <li class="menu_term_link"><span>© I Think Therefore I am Ventures — <a href="#" title="Terms &amp; Privacy">Terms &amp; Privacy</a></span></li>
        </ul>
    </div>
