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
                    <li> <a title="Help" class="btns" href="#">Back to Recruiting</a> </li>
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
                <button id="clearchecked">Clear</button>
                <div> Show <span id="nocandidates"></span>Candidates</div>
                 <div class="type_head">
                        <label class="tittle_heading">Saved Candidates</label>
                    </div>
                    <input type="checkbox" class="check_saved" name="check_saved"/>
                  <!-- <div class="edit_side">

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
                </div>-->
                <div class="filter_div">
               <div class="fild_outer specialties_check location_filter">
                    <div class="type_head">
                        <label class="tittle_heading">Location</label>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($defaultlocations);
                               foreach($defaultlocations as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>

                                    <p><input type="checkbox"  name="candidatelocation[]" value="<?php echo $value['location_id'];?>"><?php if($value['location']!=""){ ?><span class="label_name"><?php echo $value['location'];?></span><?php }?></p>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                         <?php  }
                          }
                           if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  }
                           if($count>8){?>
                           <div class="parent_hidden">
                           <div class="show_remaining"><a href="#" id="show_remaining_locations">Show all Locations</a></div><div class="hide_remaining"><a href="#" id="hide_remaining_locations">Hide Locations</a></div>   
                           </div>    
                           <?php }?> 
                    </div>                 
                    </div>
  

                 <div class="fild_outer specialties_check industry_filter">
                    <div class="type_head">
                        <label class="tittle_heading">Industry</label>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($defaultexpertises);
                               foreach($defaultexpertises as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div  <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>

                                    <p><input type="checkbox"  name="candidateExpertise[]" value="<?php echo $value['expertise_id'];?>"><?php if($value['expertise_level']!=""){ ?><span class="label_name"><?php echo $value['expertise_level'];?></span><?php }?></p>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                         <?php  }
                           } 
                            if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  }
                           if($count>8){?>
                           <div class="parent_hidden">
                           <div class="show_remaining"><a href="#" id="show_remaining_expertises">Show all Expertises</a></div><div class="hide_remaining"><a href="#" id="hide_remaining_expertises">Hide Expertises</a></div>       
                           </div>
                           <?php }?> 
                             </div>   
                           </div>               
                    
          
                 <div class="fild_outer specialties_check experience_filter">
                    <div class="type_head">
                        <label class="tittle_heading">Experience</label>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($defaultexperiences);
                               foreach($defaultexperiences as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div  <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>

                                    <p><input type="checkbox"  name="candidateExperience[]" value="<?php echo $value['Experience_Id'];?>"><?php if($value['Experience_level']!=""){ ?><span class="label_name"><?php echo $value['Experience_level'];?></span><?php }?></p>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                           }
                              if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  }
                            if($count>8){?>
                          <div class="parent_hidden">
                           <div class="show_remaining"><a href="#" id="show_remaining_experiences">Show all Experiences</a></div><div class="hide_remaining"><a href="#" id="hide_remaining_experiences">Hide Experiences</a></div>  
                           </div>     
                           <?php }?> 
                                            
                    </div>
                </div>

                 <div class="fild_outer specialties_check degree_filter">
                    <div class="type_head">
                        <label class="tittle_heading">Degree</label>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($defaultdegrees);
                               foreach($defaultdegrees as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div  <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>

                                    <p><input type="checkbox"  name="candidateDegree[]" value="<?php echo $value['degree_id'];?>"><?php if($value['Degree']!=""){ ?><span class="label_name"><?php echo $value['Degree'];?></span><?php }?></p>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                           }
                              if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  }
                            if($count>8){?>
                         <div class="parent_hidden">
                           <div class="show_remaining"><a href="#" id="show_remaining_degrees">Show all Degrees</a></div><div class="hide_remaining"><a href="#" id="hide_remaining_degrees">Hide Degrees</a></div>      </div>
                           <?php }?> 
                                            
                    </div>
                </div>

                 <div class="fild_outer specialties_check study_field_filter">
                    <div class="type_head">
                        <label class="tittle_heading">Field of Study</label>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($defaultstudyfields);
                               foreach($defaultstudyfields as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div  <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>

                                    <p><input type="checkbox"  name="candidateStudyField[]" value="<?php echo $value['study_field_id'];?>"><?php if($value['study_field']!=""){ ?><span class="label_name"><?php echo $value['study_field'];?></span><?php }?></p>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                         <?php  }
                           }
                            if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  }
                           if($count>8){?>
                           <div class="parent_hidden">
                           <div class="show_remaining"><a href="#" id="show_remaining_fields">Show all Fields</a></div><div class="hide_remaining"><a href="#" id="hide_remaining_fields">Hide Fields</a></div>       
                           </div>
                           <?php }?> 
                                            
                    </div>
                </div>

                 <div class="fild_outer specialties_check college_filter">
                    <div class="type_head">
                        <label class="tittle_heading">College</label>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($defaultcolleges);
                               foreach($defaultcolleges as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div  <?php echo($key > 7 ? 'class="specialties_check_list search_box_hidden"' : 'class="specialties_check_list  search_box"' ); ?>>
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>

                                    <p><input type="checkbox"  name="candidateCollege[]" value="<?php echo $value['college_id'];?>"><?php if($value['college']!=""){ ?><span class="label_name"><?php echo $value['college'];?></span><?php }?></p>
        
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?> 
                            </div>
                        <?php  }
                           } 
                            if ($count % 2 != 0) { ?> 
                            </div>
                         <?php  }
                           if($count>8){?>
                           <div class="parent_hidden">
                           <div class="show_remaining"><a href="#" id="show_remaining_colleges">Show all Colleges</a></div><div class="hide_remaining"><a href="#" id="hide_remaining_colleges">Hide Colleges</a></div>  </div>  
                           <?php }?> 
                </div>

                 <div class="fild_outer specialties_check skill_filter">
                    <div class="type_head">
                        <label class="tittle_heading">Skill Tags</label>
                    </div>
                    <div class="specialties_check_outer">
                      <input class="form-control" name="candidateskills" id="candidateskills" placeholder="Enter skill tags seperated by commas(ex: Javascript, Java, Python, PHP, Ruby)" type="text">
                                            
                    </div>
                </div>
                </div>
                  </div>
                <div class="candidate_outer_div">
   <?php  foreach($candidatedetails as $key=>$value){ ?>
                <div class="page_edit_here candidate_dashboard_here">
                      <p class="candidate_name"><strong><?php  echo $value['Name'];?></strong></p>
                      <p class="candidate_job_title"><?php echo $candidateLatestJobdetails[$key]['job_title'];?></p>
                       <p class="candidate_email"><?php echo $value['Email'];?></p>
                        <div class="apply_now submit_employers" style="display:block;"><a class="submit_btn btn" title="Contact" >Contact</a></div>
             <div class="upload_btn">
                                                <input name="downloadresume" id="downloadresume" class="upload" type="submit">
                                                <label class="upload_text" for="downloadresume">Download</label>
                                            </div>
                      <div class="upload_btn">
                                                <input name="savefavorite" id="savefavorite" class="upload" type="submit">
                                                <label class="upload_text" for="savefavorite">Save as Favorite</label>
                                            </div>
                    
                    <div class="upload_btn">
                        <input name="shareresume" id="shareresume" class="upload" type="submit">
                                                <label class="upload_text" for="shareresume">Share</label>
                                            </div>
                      
                    <div class="user_form">
                        <form method="POST">

                            <!-- Edit Profile HTML Start here
 
                            
                          Billing Summary html start here  -->

                            <!-- Edit Gist html start here  -->

                            <div class="page_edit_inner">
                                <div class="talent_dash">
                                  <!--  <p class="tittle_heading">Edit your Gist <a href="#" title="">[?]</a></p>
                                    <div class="change_ques">
                                        <p>If you could have one superpower, what would it be and why? — <a title="Edit" href="#">Edit</a></p>
                                    </div> -->


                                    <div class="upload_side">
                                       <!-- <div class="upload_video">
                                            <img alt="Upload" src="<?= $app['base_assets_url']; ?>images/upload.png">
                                            <h3>Upload Your Video</h3>
                                            <p>Your video should be vertical<br> and must be 30 seconds or less.</p>
                                            <div class="upload_btn">
                                                <input name="poop" id="poop" class="upload changegist" type="file" onchange="changeFileInfo(this)">
                                                <label class="upload_text" for="poop">Choose File</label>
                                            </div>
                                        </div> -->
                                           <div class="uploaded_video candidate_dashboard_video">
                <div class="progres_outer">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                        </div>
                    </div>
                    <span class="value">100%</span>
                </div>

                <div class="video_come_here">
                    <video width="348" height="542" class="video_inner" muted="muted"controls>
                        <source src="<?php echo $value['video_url'];?>" type="video/mp4">
                    </video>
                </div>
            </div>
            <input type="hidden" class="employer_candidate_id" name="candidate_id[<?php echo $key;?>]" value="<?php echo $value['user_id'];?>"/>
            <input type="hidden" name="video_id<?php echo $key;?>" value=""/>
                                    </div>
                                 
                                </div>
                            </div>

                            <!--  Edit Gist html start here  -->

                        </form>
                    
                    </div>

                    <div id="gistModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

    <!-- Modal content-->
             <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email <?php  echo $value['Name'];?></h4>
      </div>

      <div class="modal-body">     
           <p><a href="mailto:<?php echo $value['Email']; ?>?subject=Gist Invite"><?php echo $value['Email']; ?></a></p>
       
       
      </div>
      <div class="modal-footer">
       
     <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
     
    </div>

  </div>
</div>

<div id="gistShareModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Share my gist</h4>
      </div>

      <div class="modal-body">     
           <p><a href="mailto:<?php echo $value['Email']; ?>?subject=Gist Profile Link" id="candiateshare" onclick="triggerShare(this)">Share via Email</a></p>
           <p><a href="#" id="candidatelink" onclick="copyLink('<?php echo  $value['url'];?>');triggerShare(this)">Copy link</a></p>
           <p><a href="javascript:void(0)"  data-dismiss="modal">Cancel</a></p>
       
      </div>
      <div class="modal-footer">
       
     <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
     
    </div>

  </div>
</div>
          
                </div>
            <?php   }?>
             </div>
             <div id="loadMore">Load more</div>
            <div id="showLess">Show less</div>
            </div>
        </div>


    </div>

   
    
     <?php
include_once $this->getPart('/web/common/footer.php');
?>
<script>

  
  $(window).load(function(){
    $('.progres_outer').hide();
   // $('.upload_video').hide();
 $('.candidate_dashboard_video').show();
 $('.search_box_hidden').hide();
 $('.hide_remaining').hide();
 $('#nocandidates').text($('.candidate_dashboard_here').length)
 //$('.candidate_dashboard_video video').play();
})

   size_li = $(".candidate_dashboard_here").size();
   console.log("size"+"="+size_li)
    x=1;
      x=(x-5<0) ? 1 : x-5;
        $('.candidate_dashboard_here').not(':lt('+x+')').hide();
   //debugger;
    $('#loadMore').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('.candidate_dashboard_here:lt('+x+')').show();
    });
    $('#showLess').click(function () {
        //alert("clicked")
        x=(x-5<0) ? 1 : x-5;
        $('.candidate_dashboard_here').not(':lt('+x+')').hide();
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
         console.log(currentTime)
              if(currentTime>3 && counter==0){
                  if($(this).hasClass("viewed")!=true){
                  var candidate_id = $(this).parents().closest(".upload_side").find('.employer_candidate_id').val();
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


      /* $('#about-video').on('ended',function(){
     $(this).attr('src','');
   });*/
       $(document).on('click','#savefavorite',function(){
           
           if($(this).hasClass("saved")!=true){
                  var candidate_id = $(this).parents().closest(".candidate_dashboard_here").find('.employer_candidate_id').val();
                  
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
               var candidate_id = $(this).parents().closest(".candidate_dashboard_here").find('.employer_candidate_id').val();
                  
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
           $(this).parents().closest(".candidate_dashboard_here").find('#gistShareModal').modal("show")
          
              
       })
        function triggerShare(element){
        // console.log($(this))
          if($(element).hasClass("shared")!=true){
            console.log($(element))
                  var candidate_id = $(element).parents().closest(".candidate_dashboard_here").find('.employer_candidate_id').val();
                  
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
        $('.show_remaining').click(function(event){
               event.preventDefault()
            $(this).parents().closest('.parent_hidden').find('.hide_remaining').show();
           $(this).parents().closest('.specialties_check_outer').find('.search_box_hidden').show();
            $(this).hide();
        })

 $('.hide_remaining').click(function(event){
        event.preventDefault()
          $(this).parents().closest('.parent_hidden').find('.show_remaining').show();
             $(this).parents().closest('.specialties_check_outer').find('.search_box_hidden').hide();
            $(this).hide();

        })
$(document).on('click','.submit_employers a',function(){
   $(this).parents().closest('.candidate_dashboard_here').find('#gistModal').modal('show');
})

$(document).on('click','#downloadresume',function(){

  var candidate_id = $(this).parents().closest(".candidate_dashboard_here").find('.employer_candidate_id').val();
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