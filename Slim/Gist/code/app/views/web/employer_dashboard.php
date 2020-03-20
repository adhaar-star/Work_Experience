<!DOCTYPE html>
<html lang="en">

<?php
include_once $this->getPart('/web/common/header.php');
//$candidatedetails=$candidatedetails[0];
//print_r($candidatedetails);die;
?>
<body class="grey_bg">

    <div class="header_outer">
        <div class="header_inner">
            <div class="logo">
                <div class="back_icon">
                    <h1><a href="#" title="Gist">Gist</a></h1><span class="account_setting">Browsing <?php echo(count($candidatedetails)>150 ? "150+" : count($candidatedetails) );?> candidates<a class="filter_btn" id="modal-821375" href="#modal-container-821375" role="button" class="btn" data-toggle="modal" title="Filter"><img src="<?= $app['base_assets_url']; ?>/images/fillter_plus.png" alt=""><span>Filter</span></a></span>
                </div>
            </div>

            <div class="menu_links">
                <ul>
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
    <div class="menu_list">
        <ul>
            <li><a href="#" title="Sign Up">Sign Up</a></li>
            <li><a href="#" title="Login">Login</a></li>
            <li><a href="#" title="Login">Login</a></li>
            <li><a href="#" title="Support">Support</a></li>
            <li><a href="#" title="Colleges">Colleges</a></li>
            <li><a href="#" title="Employers">Employers</a></li>
            <li class="menu_term_link"><span>© I Think Therefore I am Ventures — <a href="#" title="Terms &amp; Privacy">Terms &amp; Privacy</a></span></li>
        </ul>
    </div>


    <div class="page_outer_section">
        <div class="coman_outer employer_dash">
            <div class="coman_inner">
               <?php  foreach($candidatedetails as $key=>$value){
              // print_r($candidateLatestEducationdetails[$key]['Degree']);die;

                ?>
                <div class="candidate_list">
                    <div class="candidate_video candidate_dashboard_video">
                        <video width="550" height="750" class="video_inner" muted="muted">
                            <source src="<?php  echo $value['video_url'];?>" type="video/mp4">
                        </video>
                        <div class="progres_outer">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="employer_candidate_id" name="candidate_id[<?php echo $key;?>]" value="<?php echo $value['user_id'];?>"/>
                    </div>
                    <div class="candidate_dec">
                        <div class="candidate_inner">
                            <h3><span class="position"><?php echo $candidateLatestJobdetails[$key]['job_title']; ?></span><span class="hide_icon"><a href="#"><img src="<?= $app['base_assets_url']; ?>/images/hide.png" alt="hide"></a></span></h3>
                            <h4><?php echo $candidateLatestEducationdetails[$key]['college']; ?><br> <?php echo                           
                            $candidateLocationDetails[$key][0]; ?></h4>
                              
                            <p> Hello, I'm  <?php echo $value['Name']; ?><?php if($value['Experience_level']!="Student") 


                            { ?> , a  <?php echo $candidateLatestJobdetails[$key]['job_title']; ?> in <?php echo 
                          
                            $candidateLocationDetails[$key][0]; ?> with <?php echo $value['Experience_level']." of Experience"; }  ?> <?php 

                            if($candidateLatestEducationdetails[$key]['Degree'] == "Student"){ echo ".I am a Student in";} else if($candidateLatestEducationdetails[$key]['Degree'] == "Bacholers"){ echo ".I have a Bacholer's Degree in";} else if($candidateLatestEducationdetails[$key]['Degree'] == "Masters"){ echo ".I have a Master's Degree in";} else { echo ".I have a ".$candidateLatestEducationdetails[$key]['Degree']."Degree in"; } echo " ".$candidateLatestEducationdetails[$key]['study_field']. " from the ".$candidateLatestEducationdetails[$key]['college'] ; echo " .My core skills include ".$skills_string[$key]; ?>   </p>
                        </div>
                        <div class="action_list">

                            <ul>
                                <li><a class="contact_btn"id="modal-215935" href="#modal-container-215935" role="button" class="btn" data-toggle="modal" title="Contact" >Contact</a></li>
                                <li><a class="action_btn downloadresume" href="#" title="Resume"><img src="<?= $app['base_assets_url']; ?>/images/resume_icon.png" alt="Resume"></a></li>
                                <li><a class="action_btn savefavorite" title="Save" ><img src="<?= $app['base_assets_url']; ?>/images/save_icon.png" alt="Save"></a></li>
                                <li><a class="action_btn" id="modal-215934" href="#modal-container-215934" role="button" class="btn shareresume" data-toggle="modal" title="Share"><img src="<?= $app['base_assets_url']; ?>/images/share.png" alt="Share"></a></li>
                            </ul>
                        </div>

                    </div>

           <div class="modal fade popup_outer complete_popup" id="gistModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Email <?php  echo $value['Name'];?></h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4 class="cancel_btn email"><a href="mailto:<?php echo $value['Email']; ?>?subject=Gist Invite" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/email_icon.png" alt="Share via Email"></span> <span><?php echo $value['Email'];?></span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

                   <!-- <div id="gistShareModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Share my gist</h4>
      </div>

      <div class="modal-body">     
           <p><a href="mailto:<?php echo $candidatedetails['Email']; ?>?subject=Gist Profile Link" id="candiateshare" onclick="triggerShare(this)">Share via Email</a></p>
           <p><a href="#" id="candidatelink" onclick="copyLink('<?php echo  $candidatedetails['profile_link'];?>');triggerShare(this)">Copy link</a></p>
           <p><a href="javascript:void(0)"  data-dismiss="modal">Cancel</a></p>
       
      </div>
      <div class="modal-footer">
       
      </div>
     
    </div>

  </div>
</div>-->


<div class="modal fade popup_outer complete_popup" id="gistShareModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Share Candidate</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4><a  href="mailto:<?php echo $value['Email']; ?>?subject=Gist Profile Link" id="candiateshare" onclick="triggerShare(this)" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/email.png" alt="Share via Email"></span> <span>Share via Email</span></a></h4>
                    <h4><a href="#"  id="candidatelink" onclick="copyLink('<?php echo  $value['profile_link'];?>');triggerShare(this)" title="Copy Link"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/copy_link.png" alt="Copy Link"></span> <span>Copy Link</span></a></h4>
                    <h4 class="cancel_btn"><a href="#" title="Cancel"><span class="icon_type">&nbsp;</span> <span>Cancel</span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

                </div>
              <?php  }?>

                <a id="loadMore" href="#">Load more</a>
            <a id="showLess" href="#">Show less</a>
               <!-- <div class="candidate_list">
                    <div class="candidate_video">
                        <video width="550" height="750" controls>
                            <source src="movie.mp4" type="video/mp4">
                        </video>
                        <div class="progres_outer">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="candidate_dec">
                        <div class="candidate_inner">
                            <h3><span class="position">Senior Software Engineer</span><span class="hide_icon"><a href="#"><img src="<?= $app['base_assets_url']; ?>/images/hide.png" alt="hide"></a></span></h3>
                            <h4>University of Southern California<br> Los Angeles, CA</h4>

                            <p>Hello, I’m Jason, a Senior Software <br>
                                Engineer in Los Angeles with 5+ years <br>
                                experience. I have a Bachelor’s Degree<br>
                                in Computer Science from the <br>
                                University of Southern California.<br>
                                My core skills include JavaScript, Java, <br>
                                Python, PHP, and Ruby.</p>
                        </div>
                        <div class="action_list">

                            <ul>
                                <li><a class="contact_btn" href="#" title="Contact">Contact</a></li>
                                <li><a class="action_btn" href="#" title="Resume"><img src="<?= $app['base_assets_url']; ?>/images/resume_icon.png" alt="Resume"></a></li>
                                <li><a class="action_btn" href="#" title="Save"><img src="<?= $app['base_assets_url']; ?>/images/save_icon.png" alt="Save"></a></li>
                                <li><a class="action_btn" href="#" title="Share"><img src="<?= $app['base_assets_url']; ?>/images/share.png" alt="Share"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>-->


            </div>
        </div>
    </div>







    <!--Share via Email code start here-->
    <div class="modal fade popup_outer complete_popup" id="modal-container-215935" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Email Jason</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>/images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4 class="cancel_btn email"><a href="#" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>/images/email_icon.png" alt="Share via Email"></span> <span>jason.d.terry@gmail.com</span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!--Share via Email code end here-->


    <!--Share via Email code start here-->
    <div class="modal fade popup_outer complete_popup" id="modal-container-215934" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Share Candidate</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>/images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4><a href="#" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>/images/email.png" alt="Share via Email"></span> <span>Share via Email</span></a></h4>
                    <h4><a href="#" title="Copy Link"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>/images/copy_link.png" alt="Copy Link"></span> <span>Copy Link</span></a></h4>
                    <h4 class="cancel_btn"><a href="#" title="Cancel"><span class="icon_type">&nbsp;</span> <span>Cancel</span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!--Share via Email code end here-->

    <!-- LogIn HTML Start here -->
    <div class="modal fade filter_popup" id="modal-container-821375" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"> <button type="button" class="close_btn btn" data-dismiss="modal"><span aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>/images/close_popup.png" title="Close" alt="Close"></span></button> <span class="talent_filters">Talent Filters</span> </h2>

                </div>
                <div class="modal-body">
                    <div class="filter_list_outer">

                        <div class="filter_list">
                            <h2>Saved Candidates</h2>
                            <div class="filter_switch">
                                <div class="saved_candidates">
                                    <p>Show only saved candidates</p>
                                </div>
                                <div class="on_off_switch">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Locations</h2>

                                <div class="specialties_check_outer">
                        <?php  $count = count($defaultlocations);
                               foreach($defaultlocations as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                          
                                     <div class="experience_type"><p><label class="check_boxes"><input type="checkbox"  name="candidatelocation[]" value="<?php echo $value['location_id'];?>"><span class="checkmark"></span></label><?php if($value['location']!=""){ ?><span class="label_name"><?php echo $value['location'];?></span><?php }?></p></div>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                         <?php  }
                          } 
                            
                           if ($count % 2 != 0) { ?> 
                            </div>
                        <?php  } if($count>8) {?>
                           <div class="show_all"><a href="#" title="Show all Locations" class="show_remaining"><span>Show all Locations</span><img alt="Drop Arrow" src="<?= $app['base_assets_url']; ?>/images/arrow_icon.png" /></a></div>
                           <?php }?>
                                </div>
                            </div>


                        </div>

                         <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Industry</h2>

                                <div class="specialties_check_outer">
                        <?php  $count = count($defaultexpertises);
                               foreach($defaultexpertises as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                          
                                     <div class="experience_type"><p><label class="check_boxes"><input type="checkbox"  name="candidateExpertise[]" value="<?php echo $value['expertise_id'];?>"><span class="checkmark"></span></label><?php if($value['expertise_level']!=""){ ?><span class="label_name"><?php echo $value['expertise_level'];?></span><?php }?></p></div>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                          } 
                          
                           if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  } if($count>8) {?>
                           <div class="show_all"><a href="#" class="show_remaining" title="Show all Expertises"><span>Show all Expertises</span><img alt="Drop Arrow" src="<?= $app['base_assets_url']; ?>/images/arrow_icon.png" /></a></div>
                           <?php }?>
                                </div>
                            </div>


                        </div>
                      


                       <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Experience</h2>

                                <div class="specialties_check_outer">
                        <?php  $count = count($defaultexperiences);
                               foreach($defaultexperiences as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                          
                                     <div class="experience_type"><p><label class="check_boxes"><input type="checkbox"  name="candidateExperience[]" value="<?php echo $value['Experience_Id'];?>"><span class="checkmark"></span></label><?php if($value['Experience_level']!=""){ ?><span class="label_name"><?php echo $value['Experience_level'];?></span><?php }?></p></div>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                          } 
                          
                           if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  } if($count>8) {?>
                           <div class="show_all"><a href="#" title="Show all Experiences" class="show_remaining"><span>Show all Experiences</span><img alt="Drop Arrow" src="<?= $app['base_assets_url']; ?>/images/arrow_icon.png" /></a></div>
                           <?php }?>
                            </div>


                        </div>
                        </div>

                          <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Degree</h2>

                                <div class="specialties_check_outer">
                        <?php  $count = count($defaultdegrees);
                               foreach($defaultdegrees as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                          
                                     <div class="experience_type"><p><label class="check_boxes"><input type="checkbox"  name="candidateDegree[]" value="<?php echo $value['degree_id'];?>"><span class="checkmark"></span></label><?php if($value['Degree']!=""){ ?><span class="label_name"><?php echo $value['Degree'];?></span><?php }?></p></div>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                          } 
                          
                           if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  } if($count>8) {?>
                           <div class="show_all"><a href="#" title="Show all Degrees" class="show_remaining"><span>Show all Degrees</span><img alt="Drop Arrow" src="<?= $app['base_assets_url']; ?>/images/arrow_icon.png" /></a></div>
                           <?php }?>
                             </div>


                        </div>
                        </div>

                       <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Fields</h2>

                                <div class="specialties_check_outer">
                        <?php  $count = count($defaultstudyfields);
                               foreach($defaultstudyfields as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                          
                                     <div class="experience_type"><p><label class="check_boxes"><input type="checkbox"  name="candidateStudyField[]" value="<?php echo $value['study_field_id'];?>"><span class="checkmark"></span></label><?php if($value['study_field']!=""){ ?><span class="label_name"><?php echo $value['study_field'];?></span><?php }?></p></div>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                          } 
                          
                           if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  } if($count>8) {?>
                           <div class="show_all"><a href="#" title="Show all Fields" class="show_remaining"><span>Show all Fields</span><img alt="Drop Arrow" src="<?= $app['base_assets_url']; ?>/images/arrow_icon.png" /></a></div>
                           <?php }?>
                             </div>


                        </div>
                        </div>

                         <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Colleges</h2>

                                <div class="specialties_check_outer">
                        <?php  $count = count($defaultcolleges);
                               foreach($defaultcolleges as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                          
                                     <div class="experience_type"><p><label class="check_boxes"><input type="checkbox"  name="candidateCollege[]" value="<?php echo $value['college_id'];?>"><span class="checkmark"></span></label><?php if($value['college']!=""){ ?><span class="label_name"><?php echo $value['college'];?></span><?php }?></p></div>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                          } 
                          
                           if ($count % 2 != 0) { ?> 
                            </div>
                        <?php  } if($count>8) {?>
                           <div class="show_all"><a href="#" title="Show all Colleges" class="show_remaining"><span>Show all Colleges</span><img alt="Drop Arrow" src="<?= $app['base_assets_url']; ?>/images/arrow_icon.png" /></a></div>
                           <?php }?>
                            </div>


                        </div>
                        </div>

                         <div class="filter_list">

                            <div class="fild_outer specialties_check">
                                <h2>Skill Tags</h2>
                                <div class="fild_outer">
                                    <div class="fild_inner">
                                        <textarea class="form-control"  name="candidateskills" id="candidateskills" placeholder="Enter skill tags seperated by commas (ex: JavaScript, Java, Python, PHP, Ruby)"></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>




                    </div>
                </div>
            </div>

        </div>

        <div class="filter_strip"><a href="#" id="clearchecked" title="Clear">Clear</a><button type="button" class="btn">Show <span class="count_num">56</span> Candidates</button></div>
    </div>
    <!-- LogIn HTML End here -->


  <?php
include_once $this->getPart('/web/common/footer.php');
?>
    <script>
        window.scrollTo(0, 0);
        window.addEventListener('scroll', function(e) {
            // console.log(window.scrollY);
            if (window.scrollY > 100) {
                document.getElementsByClassName('header_outer')[0].classList.add("sticky");
            } else {
                document.getElementsByClassName('header_outer')[0].classList.remove("sticky");
            }
        })


        $('.custom_textarea').on("keyup", function(e) {
            var maxlength = 10000;

            this.style.height = "1px";
            if (parseInt(this.scrollHeight) <= 50) {
                console.log(this.scrollHeight);
                this.style.height = "50px";
            } else {
                this.style.height = (this.scrollHeight) + "px";
            }

        });




        $(document).ready(function() {
            if (parseInt($(window).width()) <= 767) {
                $(".edit_side").slideUp();
            }

            $(".slide_down").click(function() {
                $(".edit_side").slideToggle();
            });
        });


         $(window).load(function(){
   // $('.progres_outer').hide();
   // $('.upload_video').hide();
 $('.candidate_dashboard_video').show();
 $('.search_box_hidden').hide();
 $('.hide_remaining').hide();
 $('#nocandidates').text($('.candidate_list').length)
 $('.count_num').val($('.candidate_list').length);
 $('#showLess').hide();
 //$('.candidate_dashboard_video video').play();
})

   size_li = $(".candidate_list").size();
   console.log("size"+"="+size_li)
    x=1;
      x=(x-5<0) ? 1 : x-5;
        $('.candidate_list').not(':lt('+x+')').hide();
   //debugger;
    $('#loadMore').click(function () {
        event.preventDefault()
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('.candidate_list:lt('+x+')').show();
        $(this).hide();
        $('#showLess').show();
    });
    $('#showLess').click(function () {
        event.preventDefault()
        //alert("clicked")
        x=(x-5<0) ? 1 : x-5;
        $('.candidate_list').not(':lt('+x+')').hide();
        $(this).hide();
         $('#loadMore').show();
     //   debugger;
    });

    // Get media - with autoplay disabled (audio or video)
    //var media = $('.video_inner').not("[autoplay='autoplay']");
    var tolerancePixel = 300;
    var counter = 0;
    function checkMedia(){
     //   console.log("scroll"+tolerancePixel)
        // Get current browser top and bottom
        var scrollTop = $(window).scrollTop() + tolerancePixel;
        var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;
        var media = $('.video_inner');
        media.each(function(index, el) {
       
          var yTopMedia = $(this).offset().top;
          var yPos = el.offsetTop - el.scrollTop + el.clientTop;
       //   console.log($(el).position())
                //console.log(yPos)
          var yBottomMedia = $(this).height() + yTopMedia;
            if(scrollTop < yBottomMedia && scrollBottom > yTopMedia){ //view explaination in `In brief` section above
         //   console.log("a")
              $(this).get(0).play();
            }
            else {
           //      console.log("b")
              $(this).get(0).pause();
               counter = 0;

            }
               $(this).get(0).ontimeupdate  = function() {
        console.log("The video is now playing");

         var currentTime = $(this)[0].currentTime

           var duration = $(this)[0].duration;
var percent = Math.floor((currentTime/this.duration) * 100);
var calc = percent+"%";

if (this.paused==false) {
    console.log(this.paused);
  $('.progress-bar').css("width",calc)
}

         console.log(currentTime)
              if(currentTime>3 && counter==0){
                  if($(this).hasClass("viewed")!=true){
                  var candidate_id = $(this).parents().closest(".candidate_dashboard_video").find('.employer_candidate_id').val();
                  var video_src = $(this)[0].currentSrc;
                  
                    var data = {};
                data.body = {"candidate_id" : candidate_id,"video_src" : video_src};

            //  $('.loader').show(); // show loader
                $.when(updateVideoViews(data)).then(function (data) {

                    if (data.meta.success) { // if success
                    console.log(data)
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
                $(this).addClass("viewed");
              counter ++;
              }
            }
            };
          });
        //}
      }

      $(window).on('scroll', checkMedia);

$(".video_inner").click(function() {
 // console.log($(this)); 
  if (this.paused) {
   //var width =  $('.progress-bar').width();
     var width = $(".progress-bar").width() / $('.progress-bar').parent().width() * 100;
    console.log("width - "+width);
    if(width=="100"){
      $('.progress-bar').css("width","0%")
   }
    this.play();
  } else {
    this.pause();
  }
});

      /* $('#about-video').on('ended',function(){
     $(this).attr('src','');
   });*/
       $(document).on('click','.savefavorite',function(){
           
           if($(this).hasClass("saved")!=true){
                  var candidate_id = $(this).parents().closest(".candidate_list").find('.employer_candidate_id').val();
                  
                    var data = {};
                data.body = {"candidate_id" : candidate_id,"is_saved" : 0};

            //  $('.loader').show(); // show loader
                $.when(updateVideoSaves(data)).then(function (data) {

                    if (data.meta.success) { // if success
                        toastr.success("Candidate Saved successfully");
                    console.log(data)
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
                $(this).addClass("saved");
              }
              else{
               var candidate_id = $(this).parents().closest(".candidate_list").find('.employer_candidate_id').val();
                  
                    var data = {};
                data.body = {"candidate_id" : candidate_id,"is_saved" : 1};

            //  $('.loader').show(); // show loader
                $.when(updateVideoSaves(data)).then(function (data) {

                    if (data.meta.success) { // if success
                toastr.success("Candidate Unsaved successfully");
                    console.log(data)
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
                $(this).removeClass("saved");

              }
       })
       
        $(document).on('click','#shareresume',function(){
           console.log("shared");
           $(this).parents().closest(".candidate_list").find('#gistShareModal').modal("show")
          
              
       })
        function triggerShare(element){
        // console.log($(this))
          if($(element).hasClass("shared")!=true){
            console.log($(element))
                  var candidate_id = $(element).parents().closest(".candidate_list").find('.employer_candidate_id').val();
                  
                    var data = {};
                data.body = {"candidate_id" : candidate_id};

            //  $('.loader').show(); // show loader
                $.when(updateVideoShares(data)).then(function (data) {

                    if (data.meta.success) { // if success
                    console.log(data)
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
                $(this).addClass("shared");
              }
        }
        $('.show_all a').click(function(event){
               event.preventDefault()
               var text =  $(this).parents().closest('.show_all').find('a').text();
               if(text.indexOf("Show") > -1){
                 var src = $(this).parents().closest('.show_all').find('img').attr("src") 
              src = src.replace("arrow_icon", "up_arrow_icon")
              $(this).parents().closest('.show_all').find('img').attr("src",src) 
              var img = $(this).parents().closest('.show_all').find('img');
              console.log($(img)[0].innerHTML)  
             text = text.replace("Show", "Hide");        
               $(this).find('span').text(text);           
           $(this).parents().closest('.specialties_check_outer').find('.search_box_hidden').show();
           }
           else{
           
            var src = $(this).parents().closest('.show_all').find('img').attr("src") 
               src = src.replace("up_", "")
               $(this).parents().closest('.show_all').find('img').attr("src",src)
                text = text.replace("Hide", "Show");        
               $(this).find('span').text(text);        
            $(this).parents().closest('.specialties_check_outer').find('.search_box_hidden').hide();
           }
           // $(this).hide();
        })

 
$(document).on('click','.submit_employers a',function(){
   $(this).parents().closest('.candidate_list').find('#gistModal').modal('show');
})

$(document).on('click','#downloadresume',function(){

  var candidate_id = $(this).parents().closest(".candidate_list").find('.employer_candidate_id').val();
  var data = {};
                data.body = {"candidate_id" : candidate_id};

            //  $('.loader').show(); // show loader
                $.when(createResumePdf(data)).then(function (data) {
                        console.log(data)
                    if (data.meta.success) { // if success
                    var return_url = data.data.return_url;
                   window.location.href = return_url;
                    //window.open(return_url,'_blank');
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
})
    </script>

</body>

</html>