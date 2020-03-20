<!DOCTYPE html>
<html lang="en">

<?php
include_once $this->getPart('/web/common/header.php');
?>
<body>

    <div class="header_outer">
        <div class="header_inner">
            <div class="logo">
                <h1><a href="#" title="Jerry"><!--<img src="images/logo.png" alt="Jerry">-->Gist</a></h1>
            </div>
            <div class="menu_links">
                <a href="#" id="toggle_menu" title="Menu">
                  <span id="menu-lines-container">
                     <span id="menu-line-top"></span>
                     <span id="menu-line-bottom"></span>
                  </span>
                </a>
            </div>
        </div>
    </div>
    <div class="menu_list">
        <ul>
            <li><a href="signup" title="Sign Up">Sign Up</a></li>
            <li><a href="#" title="Login">Login</a></li>
            <li><a href="#" title="Login">Login</a></li>
            <li><a href="#" title="Support">Support</a></li>
            <li><a href="#" title="Colleges">Colleges</a></li>
            <li><a href="#" title="Employers">Employers</a></li>
            <li class="menu_term_link"><span>© I Think Therefore I am Ventures — <a href="#" title="Terms &amp; Privacy">Terms &amp; Privacy</a></span></li>
        </ul>
    </div>
  <div class="page_outer_section">
    <div class="login_outer">
        <div class="login_inner">
            <form name="login_form" id="login_form" method="POST" autocomplete="off" novalidate="novalidate">
                <h2>Login</h2>
                <div class="filds_outer">
                    <input class="form-control" autocomplete="off" placeholder="EMAIL" type="text" name="email">
                </div>
                <div class="filds_outer">
                    <input class="form-control" autocomplete="off" placeholder="PASSWORD" type="password" name="password">
                </div>
                <input type="hidden" id="redirect" value="<?= !empty($_GET['redirect']) ? $_GET['redirect'] : '' ?>">
                <div class="filds_outer form_btn">
                    <button class="submit_btn btn" title="Login">Login</button>
                </div>
                <div class="forgot_link">
                    <p><a href="signup" class="sign_in" title="Sign Up">Sign Up</a>  <a href="#" class="forgot" title="Forgot Password?">Forgot Password?</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>  
   <?php
include_once $this->getPart('/web/common/footer.php');
?>
</body>
</html>