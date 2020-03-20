<!DOCTYPE html>
<html lang="en">

<?php
include_once $this->getPart('/web/common/header.php');


?>
<body class="grey_bg">

    <div class="header_outer">
        <div class="header_inner">
            <div class="logo">
                <div class="back_icon">
                    <h1><a href="#" title="Gist">Gist</a></h1><span class="account_setting"><a href="#" title="Account Settings">Account Settings</a></span>
                </div>
            </div>

            <div class="menu_links">
                <ul>
                    <li> <a title="Help" class="btns" href="<?= $app['base_url']; ?>candidate/dashboard">Back to Recruiting</a> </li>
                    <li> <a href="#" id="toggle_menu" title="Menu">
                            <span id="menu-lines-container">
                                <span id="menu-line-top"></span>
                                <span id="menu-line-bottom"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php
include_once $this->getPart('/web/common/common_nav.php');
?>


    <div class="page_outer_section">

        <div class="account_outer">
            <div class="account_inner">
                <button type="button" class="slide_toggle btn">Slide Toggle</button>
                  
                <div class="page_edit_here">
 


                   <div class="user_form employer_registeration_form">
                        <form method="POST" id="EmployerGistRegisteration_Form">

                            <!-- Edit Profile HTML Start here 

                            <div class="page_edit_inner">

                                <div class="fild_outer">
                                    <label class="tittle_heading">Your Name *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="Enter your name" type="text">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Work Email *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="text">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Phone *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="number">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Job Title *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="text">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Company Name *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="text">
                                    </div>
                                </div>

                                <div class="apply_now save_edit"><button class="submit_btn btn" title="Complete">Save</button></div>


                            </div> 

                             <!-- Edit Profile HTML Start here -->

                            <!-- Change password HTML start here 

                             <div class="page_edit_inner">
                                <div class="fild_outer">
                                    <label class="tittle_heading">Current Password *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="Enter your name" type="text">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">New Password *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="text">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Confirm New Password *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="number">
                                    </div>
                                </div>


                                <div class="apply_now save_edit"><button class="submit_btn btn" title="Complete">Save</button></div>

                            </div> 

                             Change password HTML end here 

                             Help html start here -->

                          <div class="page_edit_inner">
                                <div class="fild_outer">
                                 <p>Talking is good. Get in touch below, or <br>email us anytime at support@trygist.com</p>
                               </div>
                                <div class="fild_outer">
                                    <label class="tittle_heading">Your Name *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="Enter your name" type="text" name="name">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Work Email *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your personal email" type="text" name="email">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Phone *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="Your Phone Number" type="number" name="phone">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Job Title *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="Enter your Job Title" type="text" name="job_title">
                                    </div>

                                </div>
                                    <div class="fild_outer">
                                    <label class="tittle_heading">Company Name *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="Enter your Company Name" type="text" name="company_name">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Company Industry *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="Enter your Company Industry" type="text" name="company_industry">
                                    </div>
                                </div>

                              <div class="fild_outer">
                                    <label class="tittle_heading">Credit Card *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="**** **** **** 5939" type="text" name="credit_card">
                                         <!-- <input autofocus="" class="inputCard" type="number" min="1000" max="9999" name="creditCard1" id="creditCard1" required/>
    -
      <input autofocus=""  class="inputCard" type="number" min="1000" max="9999" name="creditCard2" id="creditCard2" />
      -
      <input autofocus="" class="inputCard" type="number" min="1000" max="9999" name="creditCard3" id="creditCard3" />
      -
      <input autofocus="" class="inputCard" type="number" min="1000" max="9999"  name="creditCard4" id="creditCard4" />
      <br />-->
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Billing Zip *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="10010" type="text" name="billing_zip">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Expiration Date *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="02 / 2024" type="month" name="expiration_date">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Securtiy Code *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="672" type="text" name="securtiy_code">
                                    </div>
                                </div>
                                
                                 <div class="fild_outer">
                                 <label class="tittle_heading">Password *</label>
                                 <div class="fild_inner">
                                 <input class="form-control" placeholder="Create a password " type="text" name="employer_password">
                                    </div>
                                 </div>

                                <div class="apply_now save_edit"><button class="submit_btn btn" title="Complete">Register</button></div>

                            </div> 

                             <!-- Help html end here-->

                            <!-- Billing Summary html start here -->  
                            
                                                  

                        </form>

                    </div>
            
                </div>


            </div>
        </div>


    </div>

   
    
     <?php
include_once $this->getPart('/web/common/footer.php');
?>
</body>

</html>