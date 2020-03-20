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
                   <div class="edit_side">

                    <ul>
                        <li>
                            <a href="<?= $app['base_url']; ?>candidate/profile/edit" title="Edit Profile">Edit Profile</a>
                        </li>
                         <li class="active">
                            <a href="#" title="Edit Gist">Edit Gist</a>
                        </li>
                        <li>
                            <a href="#" title="Password">Password</a>
                        </li>
                        <li>
                            <a href="#" title="Billing">Billing</a>
                        </li>
                        <li>
                            <a href="#" title="Help">Help</a>
                        </li>
                    </ul>
                </div>

                <div class="page_edit_here">
 <div class="step_one_outer edit_candidate_firststep" style="display:none;">
    <h2 class="coman_heading">Choose a question</h2>

    <div class="ques_list_outer">

        <div class="ques_list">
            <div class="question_tab">
                <p>If you could have one<br>
                    superpower what would <br>
                    it be and why?</p>
                <div class="question_check"><a href="#"></a></div>
            </div>
        </div>

        <div class="ques_list">
            <div class="question_tab">
                <p>You are in charge of 20 people, describe how you<br> would organize them to <br>figure out how many <br>bicycles were sold in NYC<br>last year.</p>
                <div class="question_check"><a href="#"></a></div>
            </div>
        </div>

        <div class="ques_list">
            <div class="question_tab">
                <p>If you could have one<br>
                    superpower what would <br>
                    it be and why?</p>
                <div class="question_check"><a href="#"></a></div>
            </div>
        </div>


        <div class="ques_list">
            <div class="question_tab">
                <p>If you could have one<br>
                    superpower what would <br>
                    it be and why?</p>
                <div class="question_check"><a href="#"></a></div>
            </div>
        </div>

    </div>
</div>


                   <div class="user_form candidate_gist_form">
                        <form method="POST" id="candidateGistEdit_Form">

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

                             Change password HTML end here -->

                            <!--  Help html start here 

                          <div class="page_edit_inner">
                                <div class="fild_outer">
                                 <p>Talking is good. Get in touch below, or <br>email us anytime at support@trygist.com</p>
                               </div>
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
                                    <label class="tittle_heading">Message *</label>
                                    <div class="fild_inner">
                                        <textarea class="custom_textarea"></textarea>
                                    </div>
                                </div>

                                <div class="apply_now save_edit"><button class="submit_btn btn" title="Complete">Get Help</button></div>
                            </div> 

                             <!-- Help html end here-->

                            <!-- Billing Summary html start here    
                            
                         <div class="page_edit_inner">
                               <div class="fild_outer">
                                    <label class="tittle_heading">Billing Summary</label>
                                   <div class="billing_summary">
                                       <ul>
                                           <li><span class="date_format">Dec 1, 2018</span> <span class="charged">Charged $99.00</span></li>
                                            <li><span class="date_format">Jan 1, 2018</span> <span class="charged">Charged $99.00</span></li>
                                            <li><span class="date_format">Feb 1, 2018</span> <span class="charged">Charged $99.00</span></li>
                                            <li><span class="date_format">Mar 1, 2018</span> <span class="charged">$0.00</span></li>
                                       </ul>
                                   </div>
                               </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Credit Card *</label>
                                    <div class="fild_inner">
                                        <input autofocus="" class="form-control" placeholder="**** **** **** 5939" type="text">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Billing Zip *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="10010" type="text">
                                    </div>
                                </div>

                                <div class="fild_outer">
                                    <label class="tittle_heading">Expiration Date *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="02 / 2024" type="number">
                                    </div>
                                </div>


                                <div class="fild_outer">
                                    <label class="tittle_heading">Securtiy Code *</label>
                                    <div class="fild_inner">
                                        <input class="form-control" placeholder="672" type="text">
                                    </div>
                                </div>

                                <div class="apply_now save_edit"><button class="submit_btn btn" title="Complete">Save</button></div>


                            </div> 
                            
                          Billing Summary html start here  

                             Edit Gist html start here --> 

                            <div class="page_edit_inner">
                                <div class="talent_dash">
                                    <p class="tittle_heading">Edit your Gist <a href="#" title="">[?]</a></p>
                                    <div class="change_ques edit_candidate_ques">
                                        <p><?php echo $candidatedetails['question'];?> — <a title="Edit" href="#">Edit</a></p>
                                    </div>
                                    <input type="hidden" id="Candidate_Edit_Id" value="<?php  echo $candidatedetails['user_id']; ?>">
                                     <div class="apply_now submit_employers" style="text-align: left;
        margin: 0px 0px 5% 33%;"><button class="submit_btn btn" title="Retry" id="editretryvideo" style="display:block;">Retry</button></div> 

                                    <div class="upload_side">
                                        <div class="upload_video">
                                            <img alt="Upload" src="<?= $app['base_assets_url']; ?>images/upload.png">
                                            <h3>Upload Your Video</h3>
                                            <p>Your video should be vertical<br> and must be 30 seconds or less.</p>
                                            <div class="upload_btn">
                                                <input name="poop" id="poop" class="upload changegist" type="file" onchange="changeFileInfo(this)">
                                                <label class="upload_text" for="poop">Choose File</label>
                                            </div>
                                        </div>
                                           <div class="uploaded_video">
                <div class="progres_outer">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                        </div>
                    </div>
                    <span class="value">100%</span>
                </div>

                <div class="video_come_here">
                    <video width="348" height="542" controls>
                        <source src="movie.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
            <input type="hidden" id="videouserid" name="candidate_id" value="<?php echo $candidate_id;?>"/>
            <input type="hidden" id="videoid" name="video_id" value=""/>
                                    </div>
                                 
                                </div>
                            </div>

                           

                        </form>

                    </div>
             <div class="apply_now submit_employers change_video_button" style="display:none;"><button class="submit_btn btn" title="Change Video">Change Video</button></div>

                </div>


            </div>
        </div>


    </div>

   
    
     <?php
include_once $this->getPart('/web/common/footer.php');
?>
<script>
 window.addEventListener("beforeunload", function(event) {
       event.returnValue = "All page data will be lost.Are you sure?";
      });

  var question = ""
       var videourl = ""
$(document).on('click', '.edit_candidate_firststep .question_check a', function() { 
            $('.step_one_outer').hide()  
            $('.candidate_gist_form').show()
                console.log($(this))
   question += $(this)["0"].parentElement.parentElement.childNodes[1].innerText+" — "
$('.change_ques p')["0"].childNodes["0"].textContent = question
//var element1 = $('.steps_inner')["0"].children["0"].childNodes[1]
//var element2 = $('.steps_inner')["0"].children["0"].childNodes[3]
//$(element1).removeClass("active")
//$(element2).addClass("active")
   var candidateid = $('#Candidate_Edit_Id').val();
   var data = {};
   var user_data = {"question" : question ,"candidate_id" : candidateid};
   data.body = user_data;
console.log(data);
  $.when(candidateChangeQues(data)).then(function (data) { // call the update profile api

                            if (data.meta.success) { // ajax success
                     // $('.loader').hide(); // hide loader
                           //  toastr.success(data.data.message); // show toaster
                          toastr.success("Question updated successfully");
                                                    } else { // ajax error
                                                     toastr.error("Could not update question")
                                                     }   
                                                });

                                      
        });
</script>
</body>

</html>