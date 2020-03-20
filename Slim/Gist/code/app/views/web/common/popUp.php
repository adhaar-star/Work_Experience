<!--Login Modal Start-->

 <!--<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Apply with gist</h4>
      </div>
      <form method="POST" id="candidateInvitation">
      <div class="modal-body">     
           <div class="fild_outer">
                    <div class="fild_inner">
                        <input autofocus="" class="form-control" name="candidateEmployerEmail" placeholder="Enter employer's email" type="text">
                    </div>
                </div>

      </div>
      <div class="modal-footer">
       <div class="upload_btn">
<div class="upload_btn">
                                                <input name="poop" id="poop" class="upload changegist" type="submit">
                                                <label class="upload_text" for="poop">Send</label>
                                            </div>
       </div>
      </div>
      </form>
    </div>

  </div>
</div>-->

<!--Login Modal End-->
<?php if(!empty($candidatedetails) && count($candidatedetails)==1){?>
<div id="gistModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Share my gist</h4>
      </div>

      <div class="modal-body">     
           <p><a href="mailto:recipient@domain.com?cc=other@domain.com&subject=Gist Profile Link&body=Profile Link - <?php echo  $candidatedetails['url'];?>" id="candiateshare">Share via Email</a></p>
           <p><a href="#" id="candidatelink" onclick="copyLink('<?php echo  $candidatedetails['url'];?>')">Copy link</a></p>
           <p><a href="javascript:void(0)"  data-dismiss="modal">Cancel</a></p>
       
      </div>
      <div class="modal-footer">
       
     <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
     
    </div>

  </div>
</div>
<?php } ?>
<!--Forgot Modal Start-->

<div class="modal fade all_modal" id="forgot" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md log-inner" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button title="Close" type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                <h4 class="modal-title">Reset Password</h4>
            </div>
            <div class="modal-body">
                <form name="forgot_password_form" class="reset_fields" id="forgot_password_form"  method="POST" autocomplete="off">
                    <p>Lost your password? Please enter your email address. You will receive a link to create a new password via email.
                    </p>
                    <div class="form-group">
                        <input class="form-control" placeholder="Email Address" type="text" name="user_email" id="user_email" autocomplete="new-password">
                    </div>
                    <div class="submit_btn">
                        <button title="Submit" class="button-effects com_btn" type="submit" name="forgot_password_submit" id="forgot_password_submit">Submit</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<!--Forgot Modal End-->

<!--Signup Modal Start-->

<div class="modal fade all_modal sign_new common_drop" id="signup" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button title="Close" type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                <h4 class="modal-title">Signup</h4>
            </div>
            <div class="modal-body sign-inner">
                <form class="form-inner reset_fields" name="signup_form" id="signup_form"  method="POST" autocomplete="off">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-left space">
                        <div class="mandatory_note">
                            <p> Fields with <i class="fa fa-asterisk" style="color:red"></i> are mandatory.</p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-left space">
                        <div class="form-group usertype">
                            <h3>User Role<sup><i class="fa fa-asterisk" style="color:red;font-size: 8px;margin-left: 3px;"></i></sup></h3>

                            <ul>
                                <li>
                                    <input type="radio" id="f-option" name="user_type" value="caregiver">
                                    <label for="f-option">Caregiver</label>

                                    <div class="check"></div>
                                </li>

                                <li>
                                    <input type="radio" id="s-option" name="user_type" value="patient">
                                    <label for="s-option">Patient</label>

                                    <div class="check"><div class="inside"></div></div>
                                </li>

                            </ul>     
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-left space">
                        <div class="form-group asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="First Name" type="text" name="first_name" id="first_name">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 col-right space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="Last Name" type="text" name="last_name" id="last_name">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-left space">

                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="Username" type="text" name="new_username" id="new_username" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 col-right space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="Email" type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-left space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="Password" type="password" name="new_password" id="new_password" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 col-right space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password" id="confirm_password" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-left  col-right space">
                        <div class="form-group   asterisk_sign">

                            <div class="from_group_box angle"> 
                                <span class="asterisk_in"></span>
                               <!--<i class="fa fa-angle-down" aria-hidden="true"></i>-->
                               
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-left space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <div class="from_group_box angle-code"> 
                             
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 col-right space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <input class="form-control" placeholder="Telephone Number" type="text" name="phone_number" id="phone_number" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-left col-right space">
                        <div class="form-group  asterisk_sign">
                            <span class="asterisk_in"></span>
                            <textarea class="form-control area" maxlength="1000" rows="5" id="comment" name="diagnosis" id="diagnosis" placeholder="Diagnosis"></textarea>
                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col space agree_condition">

                        <label for="is_moderator" class="term_check">I wish to be a Moderator
                            <input type="checkbox"  id="is_moderator" name="is_moderator">
                            <span class="checkmark"></span>
                        </label>  
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-left col-right space" id="moderator_reason_section" style="display: none;">
                        <div class="form-group  asterisk_sign wish_textarea">
                            <span class="asterisk_in"></span>
                            <textarea class="form-control area" rows="5" maxlength="1000" id="moderator_reason" name="moderator_reason" placeholder="Why you wish to be a Moderator?"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 col space abc agree_condition">

                        <label for="agree_to_cond" class="term_check">I agree to the <a href="<?= $app['base_url'] ?>Terms&PrivacyPolicy/" target="_blank"><u>Terms of Use and Privacy Policy</u></a>
                            <input type="checkbox"  id="agree_to_cond" name="agree_to_cond">
                            <span class="checkmark"></span>
                        </label>  
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col space">
                        <div class="submit_btn for-sign">
                            <button title="Submit" class="button-effects com_btn" type="submit" id="signup_submit">Submit</button>
                        </div>

                        <div class="forgot-password text-center" style="padding-bottom: 15px;">
                            <p>Account already exists?<a data-toggle="modal" data-target="#login">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--Phone Number Mask Library-->
<script src="<?= $app['base_assets_url']; ?>js/jquery.maskedinput.js" type="text/javascript"></script>

